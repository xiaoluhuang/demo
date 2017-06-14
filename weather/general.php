<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/5/16
 * Time: 上午8:36
 */
/**
 *  构造id_array,name_array,parent_array并传给javascript;
 * 构造字符串,用sprint_f();
 */
require_once __DIR__ . '/../mysql/Db.php';
$db = new DB('weather');

//$sqlP = sprintf('select name, id from phase');
//$phase  = $db->query($sqlP)->fetch_all();
//
//$sqlV = sprintf('select name, id, phase_id from version');
//$version  = $db->query($sqlV)->fetch_all();
//
//$sqlG = sprintf('select name, id, version_id from grade');
//$grade  = $db->query($sqlG)->fetch_all();
//
//$sqlU = sprintf('select name, id, grade_id from unit');
//$unit  = $db->query($sqlU)->fetch_all();
$sqlP = sprintf('select distinct province from city');
$sqlC = sprintf('select city from city');
$city  = $db->query($sqlC)->fetch_all();
$province  = $db->query($sqlP)->fetch_all();

// 循环时,对count++作为id_array
$id_array = [];
$count =0;
$order = 0;
$name_array = [];
$mappingx = [];
$mappingy = [];
$parent_array = [];
$cid = 0;
// 依次对四个数组循环添加到name_array

foreach ($province as $p)
{
    $count++;
    $order++;
    $name_array[] = $p[0];
    $id_array[] = $count;
    $parent_array[] = 0;
    $mappingy[$p[0]] = $order;

}
foreach ($city as $c)
{
    $count++;
    $order++;
    $name_array[] = $c[0];
    $id_array[] = $count;
    // 找出当前元素的父级元素
    $sql = sprintf('select province from city where city = "%s"',$c[0]);
    $p = $db->query($sql)->fetch_row();
    $mappingx[] = [
        // 当前元素的name => 父级元素的name;
        $c[0] => $p[0],
    ];
    $parent_array[] = $mappingy[$p[0]];
}

$id = sprintf('new Array(%s)', implode(',', $id_array));
$name = sprintf('new Array("%s")', implode('","', $name_array));
$parent = sprintf('new Array(%s)', implode(',', $parent_array));


$cities = [];
foreach ($city as $name) {
    $cities[] =  $name[0];
}
var_dump($name_array);

//$name = implode(',', $id_array);
// parent_array  获取当前元素的父级元素的序号
// 建立两个映射表,其实是两个数组
// 如何将这些内容写入缓存?
