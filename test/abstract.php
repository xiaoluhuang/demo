<?php

/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/3/17
 * Time: 下午3:20

abstract class Operation
{
    abstract public function getValue($num1, $num2);
}



//加法类
class OperationAdd
{
    public function getValue($num1, $num2)
    {
        // TODO: Implement getValue() method.
        return $num1 + $num2;
    }
}

//减法类
class OperationSub extends Operation
{
    public function getValue($num1, $num2)
    {
        // TODO: Implement getValue() method.
        return $num1 - $num2;
    }
}

//乘法类
class OperationMulti extends Operation
{
    public function getValue($num1, $num2)
    {
        // TODO: Implement getValue() method.
        return $num1 * $num2;
    }
}

//除法类 除法要考虑的因素比较多,比如:出书不能为0;
class OperationDiv extends Operation
{
    public function getValue($num1, $num2)
    {
        // TODO: Implement getValue() method.
        if ($num2 == 0) {
            echo '除数不能为0';
        } else {
            return $num1 / $num2;
        }
    }//为什么老是有黄的,哼
}


class Factory
{
    public static function createObj($operate){
        switch ($operate){
            case '+':
                return new OperationAdd();
                break;
            case '-':
                return new OperationSub();
                break;
            case '*':
                return new OperationMulti();
                break;
            case '/':
                return new OperationDiv();
                break;
        }
    }

}

$test = Factory::createObj('/');
$result = $test->getValue(2,9);
echo $result;

*/
class MyObserver1 implements SplObserver {
    public function update(SplSubject $subject) {
        echo __CLASS__ . ' - ' . $subject->getName();
    }
}

class MyObserver2 implements SplObserver {
    public function update(SplSubject $subject) {
        echo __CLASS__ . ' - ' . $subject->getName();
    }
}

class MySubject implements SplSubject {
    private $_observers;
    private $_name;

    public function __construct($name) {
        $this->_observers = new SplObjectStorage();
        $this->_name = $name;
    }

    public function attach(SplObserver $observer) {
        $this->_observers->attach($observer);
    }

    public function detach(SplObserver $observer) {
        $this->_observers->detach($observer);
    }

    public function notify() {
        foreach ($this->_observers as $observer) {
            $observer->update($this);
        }
    }

    public function getName() {
        return $this->_name;
    }
}

$observer1 = new MyObserver1();
$observer2 = new MyObserver2();

$subject = new MySubject("test");

$subject->attach($observer1);
$subject->attach($observer2);