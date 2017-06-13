<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 *  用队列实现单词抓取
 * Date: 2017/5/20
 * Time: 下午12:14
 */
require_once '../mysql/Db.php';
require_once './Word_script.php';

class Work_producer
{
    // 连接redis
    public function __construct()
    {
        $this->redis = new Redis();
        $this->redis->connect('127.0.0.1', 6379);
        $this->db = new Db('beibei');
    }

// 写一个worker,从数据库提取单词列表
    public function getWords()
    {
        $sql = sprintf("select name from word");
        $allWord = $this->db->query($sql)->fetch_all();
        foreach ($allWord as $word) {
            $this->redis->rPush('wordList', $word[0]);
        }

        $word = $this->redis->lpop('wordList');
        return $word;
    }

}

