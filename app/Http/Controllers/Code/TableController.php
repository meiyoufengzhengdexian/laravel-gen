<?php

namespace App\Http\Controllers\Code;

use Lib\Result;
use App\Model\Code\DefaultValue;
use App\Model\Code\Field;
use App\Model\Code\FieldRule;
use App\Model\Code\Table;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TableController extends Controller
{
    public function index(Request $request)
    {
        $tables = DB::select('show tables');

        return [
            'result' => new Result(true),
            'list' => $tables
        ];
    }

    /**
     * 获取某个表的字段
     * @param $name
     * @param Request $request
     * @return array
     */
    public function show($name, Request $request)
    {
        $table = Table::where('name', $name)->first();
        if ($table) {
            $basicInfo = $table;
            $fields = $table->fields;
            $fields->load('defaultValues');
            $fields->load('fieldRules');

            return [
                'result' => new Result(true),
                'fields' => $fields,
                'basic_info' => $basicInfo
            ];
        } else {
            $basicInfo = [
                'controller_name' => camel_case($name . 'Controller'),
                'model_name' => ucfirst(camel_case($name)),
                'view_name' => ($name)
            ];
            $fields = Schema::getColumnListing($name);
            $fieldres = collect();
            foreach ($fields as $fieldName) {
                $field = new Field();
                $type = Schema::getColumnType($name, $fieldName);
                $field->name = $fieldName;
                $field->label = $fieldName;
                $field->type = $type;
                $field->show_type = $type;
                if(!in_array($field['name'], ['deleted_at'])){
                    $field->search = 1;
                }else{
                    $field->search = 0;
                }
                if(!in_array($field['name'], ['deleted_at', 'updated_at', 'created_at'])){
                    $field->index = 1;
                }else{
                    $field->index = 0;
                }
                if(!in_array($field['name'], ['deleted_at', 'updated_at', 'created_at', 'id'])){
                    $field->create = 1;
                }else{
                    $field->create = 0;
                }
                if(!in_array($field['name'], ['deleted_at', 'updated_at', 'created_at', 'id'])){
                    $field->show = 1;
                }else{
                    $field->show = 0;
                }
                $field->is_ref = 0;
                $field->ref_class = '';
                $field->ref_method = '';
                $field->ref_type = '';
                $field->field_rules = [];
                $field->default_values = [];
                $fieldres->push($field);
            }

        }

        return [
            'result' => new Result(true),
            'fields' => $fieldres,
            'basic_info' => $basicInfo
        ];
    }

    public function storage(Request $request)
    {
        $table = $request->table_name;
        $basicInfo = $request->basic_info;

        $fields = $request->input('fields');

        $table = Table::updateOrCreate([
            'name' => $table,
        ], collect($basicInfo)->only(['name', 'controller_name', 'model_name', 'view_name', 'label'])->toArray());


        $tableId = $table->id;

        foreach ($fields as $fieldInput) {
            //保存字段本身
            $fieldInput['ref_class'] = $fieldInput['ref_class']
                ? $fieldInput['ref_class']
                : '';
            $fieldInput['ref_method'] = $fieldInput['ref_method']
                ? $fieldInput['ref_method']
                : '';
            $fieldInput['ref_type'] = $fieldInput['ref_type']
                ? $fieldInput['ref_type']
                : '';
            $field = Field::updateOrCreate([
                'gen_table_id' => $tableId,
                'name' => $fieldInput['name']
            ], collect($fieldInput)->except(['field_rules', 'default_values'])->toArray());

            $fieldId = $field->id;
            //保存字段验证规则
            if ($fieldInput['field_rules']) {
                $inputRuleIds = [];
                foreach ($fieldInput['field_rules'] as $fieldRuleInput) {
                    $fieldRule = FieldRule::updateOrCreate([
                        'field_id' => $fieldId,
                        'rule' => $fieldRuleInput['rule'],
                        'message' => $fieldRuleInput['message']
                    ], $fieldRuleInput);
                    $inputRuleIds[] = $fieldRule->id;
                }

            }

            if ($fieldInput['default_values']) {
                $inputDefaultValueIds = [];
                foreach ($fieldInput['default_values'] as $defaultValueInput) {
                    $fieldRule = DefaultValue::updateOrCreate([
                        'field_id' => $fieldId,
                        'value' => $defaultValueInput['value']
                    ], $defaultValueInput);
                    $inputDefaultValueIds[] = $fieldRule->id;
                }

                $field->defaultValues->sync($inputRuleIds);
            }
        }

        return [
            'result' => new Result(true, '数据保存更新成功'),
            'next' => '/genModel'
        ];
    }

    public function genModel(Request $request)
    {
        $modelDir = '../app/Model';
        $tableName = $request->table_name;
        $basicInfo = $request->basic_info;
        $fields = $request->fields;

        $modelContent = "<?php\n" . view('code.model',
                compact('tableName', 'basicInfo', 'fields'))->__toString();

        if (!is_dir($modelDir)) {
            mkdir($modelDir, 0755, true);
        }

        $modelFileName = $modelDir . '/' . $basicInfo['model_name'] . '.php';


        file_put_contents($modelFileName, $modelContent);

        return [
            'result' => new Result(true, '模型生成成功'),
            'next' => '/genRequest'
        ];
    }

    public function genRequest(Request $request)
    {
        $RequestDir = '../app/Http/Requests';
        $tableName = $request->table_name;
        $basicInfo = $request->basic_info;
        $fields = $request->fields;

        foreach ($fields as $field) {
//                dd($rule['rule']);
//                $str  = implode('|', collect($field['field_rules'])->pluck('rule')->toArray());

            foreach ($field['field_rules'] as $rule) {
//                strpos($rule['rule'], ':');
            }
        }
        $createRequest = "<?php\n" . view('code.requestCreate',
                compact('tableName', 'basicInfo', 'fields'))->__toString();
        $updateRequest = "<?php\n" . view('code.requestUpdate',
                compact('tableName', 'basicInfo', 'fields'))->__toString();

        if (!is_dir($RequestDir)) {
            mkdir($RequestDir, 0755, true);
        }

        $createRequestFileName = $RequestDir . '/' . $basicInfo['model_name'] . 'CreateRequest.php';
        $updateRequestFileName = $RequestDir . '/' . $basicInfo['model_name'] . 'UpDateRequest.php';


        file_put_contents($createRequestFileName, $createRequest);
        file_put_contents($updateRequestFileName, $updateRequest);

        return [
            'result' => new Result(true, '验证规则生成成功'),
            'next' => '/genController'
        ];
    }

    public function genController(Request $request)
    {
        $controllerDir = '../app/Http/Controllers/Admin';
        $tableName = $request->table_name;
        $basicInfo = $request->basic_info;
        $fields = $request->fields;

        $ControllerContent = "<?php\n" . view('code.controller',
                compact('tableName', 'basicInfo', 'fields'))->__toString();

        if (!is_dir($controllerDir)) {
            mkdir($controllerDir, 0755, true);
        }

        $controllerFileName = $controllerDir . '/' . $basicInfo['controller_name'] . '.php';
        file_put_contents($controllerFileName, $ControllerContent);

        return [
            'result' => new Result(true, '控制器生成成功'),
            'next' => '/genStoreModule'
        ];
    }

    public function genStoreModule(Request $request)
    {
        $storeDir = config('app.Vue_Home') . '/src/vuex/modules/admin';
        $tableName = $request->table_name;
        $basicInfo = $request->basic_info;
        $fields = $request->fields;

        $StoreContent = view('code.storeModule',
            compact('tableName', 'basicInfo', 'fields'))->__toString();

        if (!is_dir($storeDir)) {
            mkdir($storeDir, 0755, true);
        }

        $storeFileName = $storeDir . '/' . $basicInfo['view_name'] . '.js';
        file_put_contents($storeFileName, $StoreContent);

        // vuex hook

        if (file_exists(config('app.Vue_Home') . '/src/vuex/index.js')) {
            $vuexIndexContent = file_get_contents(config('app.Vue_Home') . '/src/vuex/index.js');
            // 查找文件中是否存已经在import
            $import = "import $basicInfo[view_name] from './modules/admin/$basicInfo[view_name]'";
            if (strpos($vuexIndexContent, $import) === false) {
                $vuexIndexContent = str_replace('//import hook',
                    $import . "\r\n//import hook", $vuexIndexContent);
            }

            $module = "$basicInfo[view_name],";
            if (strpos($vuexIndexContent, $module) === false) {
                $vuexIndexContent = str_replace('//modules hook',
                    $module . "\r\n//modules hook", $vuexIndexContent);
            }

            file_put_contents(config('app.Vue_Home') . '/src/vuex/index.js', $vuexIndexContent);

        } else {
            return [
                'result' => new Result(true, '前端store代码生成成功， 但是未找到vuex/index.js, 未添加vuex代码'),
                'next' => '/genListComponents'
            ];
        }


        return [
            'result' => new Result(true, '前端vuex生成成功'),
            'next' => '/genListComponents'
        ];
    }

    public function genListComponents(Request $request)
    {
        $tableName = $request->table_name;
        $basicInfo = $request->basic_info;
        $fields = $request->fields;
        $listDir = config('app.Vue_Home') . '/src/components/admin/' . $basicInfo['view_name'];

        $listContent = view('code.list',
            compact('tableName', 'basicInfo', 'fields'))->__toString();

        if (!is_dir($listDir)) {
            mkdir($listDir, 0755, true);
        }

        $listFileName = $listDir . '/' . $basicInfo['model_name'] . '.vue';


        file_put_contents($listFileName, $listContent);


        //router hook
        if (file_exists(config('app.Vue_Home') . '/src/router/admin.js')) {
            $vueRuterAdminIndexContent = file_get_contents(config('app.Vue_Home') . '/src/router/admin.js');
            // 查找文件中是否存已经在import
            $import = "import $basicInfo[model_name] from '@/components/admin/$basicInfo[view_name]/$basicInfo[model_name]'";

            if (strpos($vueRuterAdminIndexContent, $import) === false) {
                $vueRuterAdminIndexContent = str_replace("//import hook",
                    $import . "\r\n//import hook", $vueRuterAdminIndexContent);
            }
            //查找文件是否已经存在路由
            $search = $search = "name: '{$basicInfo['model_name']}'";
            $router = <<<ROUTER
      {
        path: '/admin/$basicInfo[view_name]',
        name: '$basicInfo[model_name]',
        component: $basicInfo[model_name],
      },
      //router hook
ROUTER;

            if (strpos($vueRuterAdminIndexContent, $search) === false) {
                $vueRuterAdminIndexContent = str_replace('//router hook',
                    $router, $vueRuterAdminIndexContent);
                file_put_contents(config('app.Vue_Home') . '/src/router/admin.js', $vueRuterAdminIndexContent);
            }
        } else {
            return [
                'result' => new Result(true, '前端store代码生成成功， 但是未找到vuex/index.js, 未添加vuex代码'),
                'next' => '/genRefOptionComponent'
            ];
        }


        return [
            'result' => new Result(true, '模型生成成功'),
            'next' => '/genRefOptionComponent'
        ];
    }


    public function genRefOptionComponent(Request $request)
    {
        $tableName = $request->table_name;
        $basicInfo = $request->basic_info;
        $fields = $request->fields;
        $dir = config('app.Vue_Home') . '/src/components/admin/' . $basicInfo['view_name'];

        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        foreach ($fields as $field) {
            if ($field['is_ref'] && $field['ref_type'] == 'belongsTo') {
                $optionContent = view('code.option',
                    compact('tableName', 'basicInfo', 'fields', 'field'))->__toString();
                $refDir = config('app.Vue_Home').'/src/components/admin/'. camel_case($field['ref_class']);
                if(!is_dir($refDir)){
                    mkdir($refDir, 0755, true);
                }
                $listFileName = config('app.Vue_Home').'/src/components/admin/'. camel_case($field['ref_class']) . '/' . ucfirst(camel_case($field['ref_class'].'Option')) . '.vue';
                file_put_contents($listFileName, $optionContent);
            }
        }

        return [
            'result' => new Result(true, '前端store代码生成成功， 但是未找到router/admin.js, 未添加router代码'),
            'next' => '/genSearchComponent'
        ];
    }

    public function genSearchComponent(Request $request)
    {
        $tableName = $request->table_name;
        $basicInfo = $request->basic_info;
        $fields = $request->fields;
        $dir = config('app.Vue_Home') . '/src/components/admin/' . $basicInfo['view_name'];

        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $searchContent = view('code.search',
            compact('tableName', 'basicInfo', 'fields', 'field'))->__toString();

        $searchFileName = config('app.Vue_Home').'/src/components/admin/'. camel_case($basicInfo['view_name']) . '/' . ucfirst(camel_case($basicInfo['model_name'].'Search')) . '.vue';

        file_put_contents($searchFileName, $searchContent);

        return [
            'result' => new Result(true, '前端search代码生成成功'),
            'next' => '/genCreateComponent'
        ];
    }

    public function genCreateComponent(Request $request)
    {
        $tableName = $request->table_name;
        $basicInfo = $request->basic_info;
        $fields = $request->fields;
        $createDir = config('app.Vue_Home') . '/src/components/admin/' . $basicInfo['view_name'];


        foreach ($fields as $field) {
            if (!isset($field['label'])) {
                dd($field);

            }
        }

        $createContent = view('code.create',
            compact('tableName', 'basicInfo', 'fields'))->__toString();

        if (!is_dir($createDir)) {
            mkdir($createDir, 0755, true);
        }

        $listFileName = $createDir . '/' . $basicInfo['model_name'] . 'Create.vue';


        file_put_contents($listFileName, $createContent);

        //router hook
        if (file_exists(config('app.Vue_Home') . '/src/router/admin.js')) {
            $vueRuterAdminIndexContent = file_get_contents(config('app.Vue_Home') . '/src/router/admin.js');
            // 查找文件中是否存已经在import
            $import = "import $basicInfo[model_name]Create from '@/components/admin/$basicInfo[view_name]/$basicInfo[model_name]Create'";

            if (strpos($vueRuterAdminIndexContent, $import) === false) {
                $vueRuterAdminIndexContent = str_replace("//import hook",
                    $import . "\r\n//import hook", $vueRuterAdminIndexContent);
            }

            $search = $search = "name: '{$basicInfo['model_name']}Create'";
            $router = <<<ROUTER
      {
        path: '/admin/$basicInfo[view_name]/create',
        name: '$basicInfo[model_name]Create',
        component: $basicInfo[model_name]Create,
      },
      //router hook
ROUTER;

            if (strpos($vueRuterAdminIndexContent, $search) === false) {
                $vueRuterAdminIndexContent = str_replace('//router hook',
                    $router, $vueRuterAdminIndexContent);
                file_put_contents(config('app.Vue_Home') . '/src/router/admin.js', $vueRuterAdminIndexContent);
            }
        } else {
            return [
                'result' => new Result(true, '前端store代码生成成功， 但是未找到router/admin.js, 未添加router代码'),
                'next' => '/genEditComponent'
            ];
        }


        return [
            'result' => new Result(true, "$basicInfo[model_name]组件生成成功"),
            'next' => '/genEditComponent'
        ];
    }

    public function genEditComponent(Request $request)
    {
        $tableName = $request->table_name;
        $basicInfo = $request->basic_info;
        $fields = $request->fields;
        $editDir = config('app.Vue_Home') . '/src/components/admin/' . $basicInfo['view_name'];


        $editContent = view('code.edit',
            compact('tableName', 'basicInfo', 'fields'))->__toString();

        if (!is_dir($editDir)) {
            mkdir($editDir, 0755, true);
        }

        $editFileName = $editDir . '/' . $basicInfo['model_name'] . 'Edit.vue';

        file_put_contents($editFileName, $editContent);

        //router hook
        if (file_exists(config('app.Vue_Home') . '/src/router/admin.js')) {
            $vueRuterAdminIndexContent = file_get_contents(config('app.Vue_Home') . '/src/router/admin.js');

            // 查找文件中是否存已经import
            $import = "import $basicInfo[model_name]Edit from '@/components/admin/$basicInfo[view_name]/$basicInfo[model_name]Edit'";

            if (strpos($vueRuterAdminIndexContent, $import) === false) {
                $vueRuterAdminIndexContent = str_replace("//import hook",
                    $import . "\r\n//import hook", $vueRuterAdminIndexContent);
            }
            // 查找文件中是否存已经在router
            //name: 'Cate'
            $search = "name: '{$basicInfo['model_name']}Edit'";
            $router = <<<ROUTER
      {
        path: '/admin/$basicInfo[view_name]/:id/edit',
        name: '$basicInfo[model_name]Edit',
        component: $basicInfo[model_name]Edit,
        props:true
      },
      //router hook
ROUTER;

            if (strpos($vueRuterAdminIndexContent, $search) === false) {
                $vueRuterAdminIndexContent = str_replace('//router hook',
                    $router, $vueRuterAdminIndexContent);
                file_put_contents(config('app.Vue_Home') . '/src/router/admin.js', $vueRuterAdminIndexContent);
            }
        } else {
            return [
                'result' => new Result(true, '前端edit代码生成成功， 但是未找到router/admin.js, 未添加router代码'),
                'next' => '/genCreateEdit'
            ];
        }


        return [
            'result' => new Result(true, "$basicInfo[model_name]组件生成成功"),
            'next' => '/genCreateEdit'
        ];
    }
}
