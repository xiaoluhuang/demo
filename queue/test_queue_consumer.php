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

$consumer = new Consumer();

while (true) {
    $ret = $consumer->fetchWordFromQueue(true);
    if (!$ret) {
        sleep(3);
        echo 'waiting...', PHP_EOL;
    }
}

