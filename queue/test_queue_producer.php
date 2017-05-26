<?php
/* *****************************************************************
 * @Author: huangxiolu
 * @Created Time : 六  5/20 17:47:07 2017
 *
 * @File Name: test_queue.php
 * @Description:
 * *****************************************************************/

include_once __DIR__ . '/vendor/autoload.php';


use Queue\worker\Consumer;
use Queue\worker\Producer;

$producer = new Producer();
$producer->db2queue();

