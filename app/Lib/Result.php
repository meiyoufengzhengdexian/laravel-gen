<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/27
 * Time: 9:19
 */

namespace App\Lib;



class Result
{
    public $code;
    public $message;
    public function __construct($res, $message='', $code='')
    {
        if($res && $code == ''){
            $this->code = 1;
        }else{
            $this->code = $code == '' ? 0 : $code;
        }
        $this->message = $message;

    }
}
