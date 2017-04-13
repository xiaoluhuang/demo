<?php

/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/3/19
 * Time: 下午9:09
 */
abstract class Person
{
    abstract public function pee();
}

class Girl extends Person
{
    public function pee()
    {
        // TODO: Implement pee() method.
        echo '我要蹲着撒尿', PHP_EOL;

    }
}


class Boy extends Person
{
    public function pee()
    {
        // TODO: Implement pee() method.
        echo '我要站着撒尿', PHP_EOL;

    }
}

class Gender
{
    public static function sex($sex){
        switch ($sex) {
            case 'boy':
                return new Boy();
            break;
            case 'girl':
                return new Girl();
                break;
            default :
                echo '不男不女';
        }
    }
}

$boy = Gender::sex('boy');
$girl = Gender::sex('girl');

$boy->pee();
$girl->pee();
