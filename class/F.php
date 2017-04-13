<?php
/* *****************************************************************
 * @Author: huangxiolu
 * @Created Time : 二  3/21 22:59:40 2017
 *
 * @File Name: F.php
 * @Description:
 * *****************************************************************/

class F {

    function set($name) {
        $this->name = $name;
    }

    function get() {
        return $this->name;
    }
}

$f = new F();
$f->set('huangxiaolu');
var_dump($f->get());
