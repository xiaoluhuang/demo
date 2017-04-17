<?php

/**
 * 1.添加评论
 * 2.查询评论列表
 * 3.查询具体某评论详情
 *
 * Class Blog
 */
//这个文件的作用就是连接PHP与mysql
class Db
{

    private $mysql_server_name = "localhost"; //数据库服务器名称
    private $mysql_username = "root"; // 连接数据库用户名
    private $mysql_password = ""; // 连接数据库密码
    private $mysql_database = "demo"; // 数据库的名字
    private $mysql_port = "3306"; //端口号

    protected $mysqli;

    public function __construct()
    {
        $this->mysqli = new mysqli($this->mysql_server_name, $this->mysql_username, $this->mysql_password, $this->mysql_database, $this->mysql_port);
        $this->mysqli->set_charset('utf-8');
    }

    /**
     * 执行query
     *
     * @param $sql
     * @return bool|mysqli_result
     */
    protected function query($sql)
    {
        return $this->mysqli->query($sql);
    }


    /**
     * @param $table article
     * @param $data ['title' => 'a title', 'content' => 'this is a content',]
     * @return string
     */
    public function getInsertSql($table, $data)
    {

//        $sql = "insert into article (title, content) values('a title', 'this is a content')"php;
        $a = array_keys($data);
        $keys = implode(',',$a);
        $b = array_values($data);
        $values = implode("','",$b);
        $sql = 'insert  into ' . $table . "($keys)" .' values' . "('$values')";

//

        return $sql;
    }
}

$db = new Db();
$sql = $db->getInsertSql('table', ['title' => 'a title', 'content' => 'this is a content',]);
echo $sql,PHP_EOL;
