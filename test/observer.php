<?php

/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/3/17
 * Time: 下午4:55
 */
class MyObserver1 implements SplObserver
{
    public function update(SplSubject $subject)
    {
        // TODO: Implement update() method.
        echo __CLASS__ . '-' . $subject->getName();
    }
}

class MyObserver2 implements SplObserver
{
    public function update(SplSubject $subject)
    {
        echo __CLASS__ . ' - ' . $subject->getName();
    }
}

class MySubject implements SplSubject
{
    private $_observers;
    private $_name;

    public function __construct($name)
    {
        $this->_observers = new SqlObjectstorage();
        $this->_name = $name;
    }

    public function attach(SplObserver $observer)
    {
        // TODO: Implement attach() method.
        $this->_observers->attach($observer);
    }

    public function detach(SplObserver $observer)
    {
        // TODO: Implement detach() method.
        $this->_observers->detach($observer);
    }

    public function notify()
    {
        // TODO: Implement notify() method.
        foreach ($this->_observers as $observer) {
            $observer->update($this);
        }
    }

    public function getName()
    {
        return $this->_name;
    }
}

$observer1 = new MyObserver1();
$observer2 = new MyObserver2();

$subject = new MySubject('test');

$subject->attach($observer1);
$subject->attach($observer1);

$subject->notify();

