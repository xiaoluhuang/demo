<?php
/* *****************************************************************
 * @Author: huangxiolu
 * @Created Time : 六  5/20 17:37:43 2017
 *
 * @File Name: Queue.php
 * @Description:
 * *****************************************************************/
namespace Queue\lib;

class Queue {

    /**
     * 队列句柄
     * 可能是redis
     * 也可能是beanstalk
     *
     * @var null
     */
    private $_instance = null;

    private $_redis;

    protected $topic;

    public function __construct($topic = 'default')
    {
        $this->topic = $topic;
        $this->_redis = new \Redis();
        $this->_redis->connect('127.0.0.1', 6379);
    }

    /**
     * 插入队列
     *
     * @param $item
     * @return bool
     */
    function push($item) {
        return $this->_redis->rpush($this->topic, $item);
        // return $this->_instance->push($item);
    }


    /**
     * 取出队列的内容
     *
     * @return string
     */
    function pop() {

        return $this->_redis->lpop($this->topic);
    }

}
