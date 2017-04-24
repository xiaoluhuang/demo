<?php
/* *****************************************************************
 * @Author: huangxiolu
 * @Created Time : 一  4/24 14:37:47 2017
 *
 * @File Name: practise.php
 *
 * @Description:
 * *****************************************************************/
abstract class Car{
    abstract function bmw() {
    echo 'everybady is having this!';
    } 
}

class Bike extends Car{

    echo 'this is just to practise,i do not know what to do!';
}
