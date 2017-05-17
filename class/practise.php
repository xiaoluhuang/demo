<?php
/* *****************************************************************
 * @Author: huangxiolu
 * @Created Time : 一  4/24 14:37:47 2017
 *
 * @File Name: practise.php
 *
 * @Description:
 * *****************************************************************/
abstract class Car {
    abstract function bmw();
}

class Bike extends Car {

     public function bmw()
     {
         // TODO: Implement bmw() method.
         echo 'i love bmw';
     }
     public function own() {
         echo 'this is just to practise,i do not know what to do!';
     }

}
