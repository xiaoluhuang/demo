<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/5/24
 * Time: 上午9:43
 */
namespace Src;

use SebastianBergmann\CodeCoverage\TestCase;

class Clean extends TestCase
{
    public $array =[];

    public function clean()
    {

        $a = array_map('$this->myTrim', $this->array);

        return $a;
    }

    function myTrim($value) {

        $value = trim($value, ' "\'');
        return $value;
    }
}