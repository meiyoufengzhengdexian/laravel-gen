<?php
/**
 * Created by PhpStorm.
 * User: x
 * Date: 2018/7/16
 * Time: 22:12
 */

namespace Lib;


class Code
{
    /**
     * @param $lable
     * @param $model
     * @param $name
     * @return string
     * 返回element-ui 组件
     */
    public static function string($label, $model, $name)
    {
        return <<<INPUT
<el-form-item label="$label" prop="$name">
        <el-input v-model="$model.$name"></el-input>
      </el-form-item>
INPUT;
    }

    public static function integer($label, $model, $name)
    {
        return <<<INTEGER
<el-form-item label="$label" prop="$name">
    <el-input-number v-model="$model.$name"></el-input-number>
</el-form-item>
INTEGER;
    }

    public static function datetime($label, $model, $name)
    {
        return <<<INTEGER
<el-form-item label="$label" prop="$name">
    <el-date-picker
      v-model="$model.$name"
      type="datetime"
      placeholder="选择{$label}时间">
    </el-date-picker>
</el-form-item>
INTEGER;
    }

    public static function switch($label, $model, $name)
    {
        return <<<SWITCH
<el-form-item label="$label" prop="$name">
        <el-switch
                  v-model="$model.$name"
                  :active-value="1"
                  :inactive-value="0"
        ></el-switch>
</el-form-item>
SWITCH;
    }
}
