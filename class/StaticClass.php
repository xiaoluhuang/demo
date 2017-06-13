<?php
/* *****************************************************************
 * @Author: huangxiolu
 * @Created Time : 日  3/19 20:25:45 2017
 *
 * @File Name: StaticClass.php
 * @Description:
 * *****************************************************************/
class StaticClass {

    public static $name;

    public static $age;

    public function setAge($age) {
        $this->age = $age;
    }

    public function getAge() {
        echo __METHOD__, " age=", $this->age, PHP_EOL;
        echo __METHOD__, " name=", $this->name, PHP_EOL;
        return $this->age;
    }

    public static function setName($name) {
        static::$name = $name;
    }

    public static function getName() {
        echo __METHOD__, " name=", static::$name, PHP_EOL;
        return static::$name;
    }
}



$obj1 = new StaticClass();
$obj1->setName('huangxiaolu');
$obj1->getName();

$obj2 = new StaticClass();
$obj2->getName();
$obj2->setName('wushuiyong');
$obj2->getName();
$obj1->getName();



