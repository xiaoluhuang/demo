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
$db = new DB('beibei');

$sqlP = sprintf('select name, id from phase');
$phase  = $db->query($sqlP)->fetch_all();

$sqlV = sprintf('select name, id, phase_id from version');
$version  = $db->query($sqlV)->fetch_all();

$sqlG = sprintf('select name, id, version_id from grade');
$grade  = $db->query($sqlG)->fetch_all();

$sqlU = sprintf('select name, id, grade_id from unit');
$unit  = $db->query($sqlU)->fetch_all();

//var_dump($phase, $version, $grade, $unit);
// 循环时,对count++作为id_array
$id_array = [];
$count =0;
$order = 0;
$name_array = [];
$mappingx = [];
$mappingy = [];
$parent_array = [];
// 依次对四个数组循环添加到name_array

foreach ($phase as $p)
{
    $count++;
    $order++;
    $name_array[] = $p[0];
    $id_array[] = $count;
    $parent_array[] = 0;
    $mappingy[$p[0].'_'.$p[1]] = $order;

}
foreach ($version as $v)
{
    $count++;
    $order++;
    $name_array[] = $v[0];
    $id_array[] = $count;
    $sql = sprintf('select name,id from phase where id = "%d"',$v[2]);
    $p = $db->query($sql)->fetch_row();
    $mappingx[] = [
        // 当前元素的name+id => 父级元素的name+id;
        $v[0].'_'.$v[1] => $p[0].'_'.$p[1],
    ];
    $mappingy[$v[0].'_'.$v[1]] = $order;
    $parent_array[] = $mappingy[$p[0].'_'.$p[1]];
}

foreach ($grade as $g)
{
    $count++;
    $order++;
    $name_array[] = $g[0];
    $id_array[] = $count;
    $sql = sprintf('select name,id from version where id = "%d"',$g[2]);
    $v = $db->query($sql)->fetch_row();
    $mappingx[] = [
        // 当前元素的name+id => 父级元素的name+id;
        $g[0].'_'.$g[1] => $v[0].'_'.$v[1],
    ];
    $mappingy[$g[0].'_'.$g[1]] = $order;

    $parent_array[] = $mappingy[$v[0].'_'.$v[1]];
}

foreach ($unit as $u)
{
    $count++;
    $order++;
    $name_array[] = $u[0];
    $id_array[] = $count;
    $sql = sprintf('select name,id from grade where id = "%d"',$u[2]);
    $g = $db->query($sql)->fetch_row();
    $mappingx[] = [
        // 当前元素的name+id => 父级元素的name+id;
        $u[0].'_'.$u[1] => $g[0].'_'.$g[1],
    ];
    $parent_array[] = $mappingy[$g[0].'_'.$g[1]];
}

$id = sprintf('new Array(%s)', implode(',', $id_array));
$name = sprintf('new Array("%s")', implode('","', $name_array));
$parent = sprintf('new Array(%s)', implode(',', $parent_array));



//$name = implode(',', $id_array);
// parent_array  获取当前元素的父级元素的序号
// 建立两个映射表,其实是两个数组
// 如何将这些内容写入缓存?
