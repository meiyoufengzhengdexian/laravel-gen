<?php
/**
 * Created by PhpStorm.
 * User: x
 * Date: 2018/7/29
 * Time: 21:15
 */

namespace Lib\Fz\src;


class Test
{
    public $str = 'is run';
    public $server = null;
    public function run()
    {
//        dd($this->str);
        return $this->str;
    }

    public function getServer()
    {
        dd($this->server);
    }
}
