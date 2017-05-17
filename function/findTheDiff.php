<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/5/10
 * Time: 上午11:03
 */
// 有两个相似文件A，B（自己生成两列，url取access log，用\t分割：账号id、url）
// 逐行读取access.log文件

const ACCESS_LOG_FILE = '/usr/local/var/log/nginx/access.log';

if (!file_exists(ACCESS_LOG_FILE)) {
    echo '文件不存在';
    return false;
}
// 1.读取文件
// a.file_get_contents
// b.fopen
$fp = fopen(ACCESS_LOG_FILE, 'rw');
if ($fp === false || $fp === false) {
    return true;
}
$logA = [];
$logB = [];
while (!feof($fp)) {
    // 逐行格式化
    $line = trim(fgets($fp));
    $lineInfo = explode(' ', $line);
    $logA[] = [
        'url' => $lineInfo[10],
        'aid' => rand(1,5),
    ];
    $logB[] = [
        'url' => $lineInfo[10],
        'bid' => rand(1,5),
    ];
}

// 取出url列,分别存进A,B两个数组,并且两个文件有ID是自动生成的
//
$diff = array_diff($logA,$logB);
var_dump($diff);