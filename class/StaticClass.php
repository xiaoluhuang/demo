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
//        echo __METHOD__, " name=", $this->name, PHP_EOL;
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

/*/ 凡是使用$this->的方式，无论是static与否,都是只是普通对象的使用方式
$obj1 = new StaticClass();
$obj1->setAge('huangxiaolu');
$obj2 = new StaticClass();
$obj2->setAge('wushuiyong');

$obj1->getAge();
$obj2->getAge();
*/

/*/ static:: 与 $this->混用,变量是隔离不相关的。
// static还是会影响到全局,$this->只影响的对象
$obj1 = new StaticClass();
$obj1->setAge('huangxiaolu');

$obj2 = new StaticClass();
$obj2->setAge('foo');
$obj2::$age = 'wushuiyong';

$obj1->getAge();
$obj2->getAge();
var_dump(StaticClass::$age);
die;
*/


$obj2 = new StaticClass();
$obj2->getAge();
$obj2->setAge('wushuiyong');
$obj2->getAge();
$obj1->getAge();

return true;


$obj1 = new StaticClass();
$obj1->setName('huangxiaolu');
$obj1->getName();

$obj2 = new StaticClass();
$obj2->getName();
$obj2->setName('wushuiyong');
$obj2->getName();
$obj1->getName();



