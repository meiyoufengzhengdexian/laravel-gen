<?php

namespace App\Http\Controllers\Code;

use App\Lib\Result;
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
        if ($table && false) {
            $basicInfo = [
                'controller_name' => '',
                'model_name' => '',
                'view_name' => ''
            ];
        } else {
            $basicInfo = [
                'controller_name' => camel_case($name . 'Controller'),
                'model_name' => ucfirst(camel_case($name)),
                'view_name' => camel_case($name)
            ];
            $fields = Schema::getColumnListing($name);
            $fieldres = collect();
            foreach ($fields as $fieldName) {
                $field = new Field();
                $type = Schema::getColumnType($name, $fieldName);
                $field->name = $fieldName;
                $field->lable = $fieldName;
                $field->type = $type;
                $field->show_type = $type;
                $field->search = 1;
                $field->index = 1;
                $field->create = 1;
                $field->show = 1;
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
        ], $basicInfo);


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
            'result'=>new Result(true, '数据保存更新成功'),
            'next'=>'/genModel'
        ];
    }

    public function genModel(Request $request)
    {
        $modelDir = '../app/Model';
        $tableName = $request->table_name;
        $basicInfo = $request->basic_info;
        $fields = $request->fields;

        $modelContent = "<?php\n". view('code.model',
                compact('tableName', 'basicInfo', 'fields'))->__toString();

        if(!is_dir($modelDir)){
            mkdir($modelDir, '0755');
        }

        $modelFileName = $modelDir .'/'. $basicInfo['model_name']. '.php';


        file_put_contents($modelFileName, $modelContent);

        return [
            'result'=>new Result(true, '模型生成成功'),
            'next'=>'/genRequest'
        ];
    }

    public function genRequest(Request $request)
    {
        $RequestDir = '../app/Http/Requests';
        $tableName = $request->table_name;
        $basicInfo = $request->basic_info;
        $fields = $request->fields;

        foreach($fields as $field){
//                dd($rule['rule']);
//                $str  = implode('|', collect($field['field_rules'])->pluck('rule')->toArray());

            foreach ($field['field_rules'] as $rule){
//                strpos($rule['rule'], ':');
            }
        }
        $createRequest = "<?php\n". view('code.requestCreate',
                compact('tableName', 'basicInfo', 'fields'))->__toString();
        $updateRequest = "<?php\n". view('code.requestUpdate',
                compact('tableName', 'basicInfo', 'fields'))->__toString();

        if(!is_dir($RequestDir)){
            mkdir($RequestDir, '0755');
        }

        $createRequestFileName = $RequestDir .'/'. $basicInfo['model_name']. 'CreateRequest.php';
        $updateRequestFileName = $RequestDir .'/'. $basicInfo['model_name']. 'UpDateRequest.php';


        file_put_contents($createRequestFileName, $createRequest);
        file_put_contents($updateRequestFileName, $updateRequest);

        return [
            'result'=>new Result(true, '验证规则生成成功'),
            'next'=>'/genController'
        ];
    }

    public function genController(Request $request)
    {
        $controllerDir = '../app/Http/Controllers/Admin';
        $tableName = $request->table_name;
        $basicInfo = $request->basic_info;
        $fields = $request->fields;

        $ControllerContent = "<?php\n". view('code.controller',
                compact('tableName', 'basicInfo', 'fields'))->__toString();

        if(!is_dir($controllerDir)){
            mkdir($controllerDir, '0755');
        }

        $controllerFileName = $controllerDir .'/'. $basicInfo['controller_name']. '.php';
        file_put_contents($controllerFileName, $ControllerContent);

        return [
            'result'=>new Result(true, '控制器生成成功'),
            'next'=>'/genStoreModule'
        ];
    }

    public function genStoreModule(Request $request)
    {
        $storeDir = env('Vue_Home').'/src/vuex/modules/admin';
        $tableName = $request->table_name;
        $basicInfo = $request->basic_info;
        $fields = $request->fields;

        $StoreContent = view('code.storeModule',
                compact('tableName', 'basicInfo', 'fields'))->__toString();

        if(!is_dir($storeDir)){
            mkdir($storeDir, '0755');
        }

        $storeFileName = $storeDir .'/'. $basicInfo['view_name']. '.js';
        file_put_contents($storeFileName, $StoreContent);

        return [
            'result'=>new Result(true, '控制器生成成功'),
            'next'=>'/genComponents'
        ];
    }

    public function genComponents(Request $request)
    {

    }

}
