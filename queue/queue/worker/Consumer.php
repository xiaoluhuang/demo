<?php
/* *****************************************************************
 * @Author: huangxiolu
 * @Created Time : 六  5/20 17:58:41 2017
 *
 * @File Name: Consumer.php
 * @Description:
 * *****************************************************************/
namespace Queue\worker;

use Queue\lib\Queue;
use Queue\lib\ClawSentence;


class Consumer
{
    public function __construct()
    {
        $this->queue = new Queue();
        $this->claw = new ClawSentence();
    }

    // 通过队列获取单词
    public function fetchWordFromQueue($cycle = false)
    {
        // f
        // 调用queue里面的pop方法
        $word = $this->queue->pop();
        if (!$word) {
            return false;
        }
        // e
        if ($cycle) {
            while ($word) {
                // 调用抓取单词方法,获得例句
                $ret = $this->claw->sentence($word);
                printf("%s ==> %s\n", $word, $ret ? '成功' : '失败');

                // 调用queue里面的pop方法
                $word = $this->queue->pop();
                // a
            }
            // b

        } else {
            // c
            // 调用抓取单词方法,获得例句
            $ret = $this->claw->sentence($word);
            printf("%s ==> %s\n", $word, $ret ? '成功' : '失败');
            return (bool)$ret;
        }
        // d
        // mmm
        return false;

    }
}
