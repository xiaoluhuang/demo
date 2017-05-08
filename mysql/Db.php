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

    /**
     * 数据库服务器名称
     * @var string
     */
    private $mysql_server_name = "localhost";

    /**
     * 连接数据库用户名
     * @var string
     */
    private $mysql_username = "root";

    /**
     * 连接数据库密码
     * @var string
     */
    private $mysql_password = "";

    /**
     * 数据库的名字
     * @var string
     */
    private $mysql_database = "demo";

    /**
     * 端口号
     * @var string
     */
    private $mysql_port = "3306";

    protected $mysqli;

    public function __construct()
    {
        $this->mysqli = new mysqli($this->mysql_server_name, $this->mysql_username, $this->mysql_password, $this->mysql_database, $this->mysql_port);
        $this->mysqli->set_charset('utf-8');
    }

    /**
     * 执行queryquery
     *
     * @param $sql
     * @return bool|mysqli_result
     */
    public function query($sql) {
        return $this->mysqli->query($sql);
    }


}

