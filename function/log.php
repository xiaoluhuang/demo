<?php
/* *****************************************************************
 * @Author: huangxiolu
 * @Created Time : 二  5/ 2 10:45:53 2017
 *
 * @File Name: log.php
 * @Description:
 * *****************************************************************/
require_once __DIR__ . '/../mysql/DB.php';

$db = new DB();
$file_path = '/usr/local/var/log/nginx/access.log';
$file_arr = [];
//$sql = sprintf("insert into access_log values(null,'%s','%s','%s','%s','%s','%s','%s','%s')",
//    null,'1','1','1','1','1','1','1','1'
//);
//echo $sql;
//$db->query($sql);die;
//$file_path = "test.txt";
if (file_exists($file_path)) {
    $file_str = file($file_path);
    for ($i = 0; $i < count($file_str); $i++) {//逐行读取文件内容
        $file_arr[$i] = explode(' ', $file_str[$i]);
//        var_dump($file_arr);die;
        $sql = sprintf("insert into access_log values(null,'%s','%s','%s','%s', '%s',%d, %d,'%s','%s')",
        $file_arr[$i][0],
        $file_arr[$i][3],
        $file_arr[$i][5],$file_arr[$i][6],$file_arr[$i][7],
        $file_arr[$i][8],$file_arr[$i][9],$file_arr[$i][10],$file_arr[$i][11]);
//        echo $sql;
        $db->query($sql);

//        echo $file_arr[$i]."<br />";
    }
//    var_dump($file_arr);
    /*
    foreach($file_arr as $value){
    echo $value."<br />";
    }*/
    //insert into access_log values(null,$file_arr[$i][0],$file_arr[$i][3].$file_arr[$i][4],$file_arr[$i][5],$file_arr[$i][6].$file_arr[$i][7],,$file_arr[$i][8],$file_arr[$i][9],$file_arr[$i][10],$file_arr[$i][23]);
}
