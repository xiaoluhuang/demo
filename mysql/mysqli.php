<?php

$mysql_server_name = "localhost"; //数据库服务器名称
$mysql_username = "root"; // 连接数据库用户名
$mysql_password = ""; // 连接数据库密码
$mysql_database = "demo"; // 数据库的名字
$mysql_port = "3306"; //端口号
//Open a new connection to the MySQL server
$mysqli = new mysqli($mysql_server_name, $mysql_username, $mysql_password, $mysql_database, $mysql_port);


$oldContent = 'test value';

echo "======= insert ========\n";
// insert
$insertSql = sprintf('insert into comments (author_id, blog_id, content) values ("%s", "%s", "%s")',
    1, 2, $oldContent
);
var_dump($insertSql);
$return  = $mysqli->query($insertSql);
var_dump($return);

echo "======= update ========\n";
// update
$updateSql = sprintf('update comments set content="%s" where content="%s"', 'new value', $oldContent);
var_dump($updateSql);
$return  = $mysqli->query($updateSql);
var_dump($return);

echo "======= select ========\n";
// select
$selectSql = sprintf('select * from comments where content="%s"', 'new value');
var_dump($selectSql);
$return  = $mysqli->query($selectSql)->fetch_assoc();
var_dump($return);

echo "======= delete ========\n";
// delete
$deleteSql = sprintf('delete from comments where content="%s"', 'new value');
var_dump($deleteSql);
$return  = $mysqli->query($deleteSql);
var_dump($return);

