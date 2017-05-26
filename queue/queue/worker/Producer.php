<?php
/* *****************************************************************
 * @Author: huangxiolu
 * @Created Time : 六  5/20 17:57:13 2017
 *
 * @File Name: Producer.php
 * @Description:
 * *****************************************************************/
namespace Queue\worker;

use Queue\lib\Db;
use Queue\lib\Queue;


class Producer
{

    // word
    public function __construct()
    {
        $this->db = new Db('beibei');
        $this->queue = new Queue();
    }

    public function db2queue()
    {
        $sql = sprintf("select name from word");
        $allWord = $this->db->query($sql)->fetch_all();
        foreach ($allWord as $word) {
            $this->queue->push($word[0]);
//            $cnt++;
//            if ($cnt>5) {
//                break;
//            }
        }
    }

}
