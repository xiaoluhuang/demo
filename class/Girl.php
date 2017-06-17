<?php
/* *****************************************************************
 * @Author: huangxiolu
 * @Created Time : 日  3/19 10:10:19 2017
 *
 * @File Name: Girl.php
 * @Description:
 * *****************************************************************/


/*
终极应用
class Redis {

    public function __construct()
    {

    }

    function __call($name, $arguments)
    {
        // $name = delete, arguments= key1, key2
        $redis = 'x';
        if (count($arguments) == 1) {
            $redis->$name($arguments[0]);
        } elseif (count($arguments) == 2) {
            $redis->$name($arguments[0], $arguments[1]);
        }
        // TODO: Implement __call() method.
    }
}
$redis = new Redis();
$redis->del('boy');
$redis->get('girl');
*/
class Boy {

    /**
     * @param $name
     * @return string
     */
    public function cutTree($name) {
        return __METHOD__ . " name=$name ". PHP_EOL;
    }

}
class Girl {
    protected $boy;
    protected $name;

    /**
     * 2.构造函数
     * Girl constructor.
     */
    public function __construct($name = null) {
        $this->name = $name;
        $this->boy = new Boy();
        echo __METHOD__, " name= ", $this->name, PHP_EOL;
    }

    /**
     * 4.析构函数
     */
    public function __destruct() {
        unset($boy);
        unset($girl);
        // 记录日志
        // 清理
        echo __METHOD__, " name= ", $this->name, PHP_EOL;
        exit;
    }

    /**
     * 这个魔术方法表示，当所有的方法都找不到的时候，会被调用
     *
     * @param $name
     * @param $arguments
     */
    public function __call($method, $arguments)
    {
        /*
        $vars = var_export($arguments, 1);
        echo "method= $method, arguments=$vars", PHP_EOL;
        $this->say($arguments[0]);
        // TODO: Implement __call() method.
        */
        return $this->boy->$method($arguments[0]);
    }

    public function say($content = '') {
        echo "{$this->name} say $content", PHP_EOL;
    }

}

// 1
$girl = new Girl('huangxiaolu');
$girl->say('unknow method');
//$girl->callUndefineFunction('unknow method');
$string = $girl->cutTree('christmas');
$string = $girl->cutTree('christmas');
var_dump($string);

/**
// 3
echo "unset start", PHP_EOL;
unset($girl);
echo "unset end", PHP_EOL;
// 5
echo __FILE__, " end", PHP_EOL;
 * */
