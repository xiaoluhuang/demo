<?php

/**
 * 1.添加评论
 * 2.查询评论列表
 * 3.查询具体某评论详情
 * 4.计算有多少条评论
 *
 * Class Blog
 */
require_once 'Db.php';


class Comment extends Db
{

    public function __construct()
    {
        // 父类的 构造函数
        parent::__construct();
        // 自己的特殊性
    }

    /**
     * 添加评论
     *
     * @return bool
     */
    public function add($blog_id, $author_id, $content)
    {
        $insertsql = sprintf('insert into comments(blog_id,author_id,content) values ("%s","%s","%s")', $blog_id, $author_id, $content);
        return $this->mysqli->query($insertsql);
    }

    /**
     * 查询评论列表
     *
     * @param $id
     * @return array
     */
    public function getList($id)
    {
        // 从blog表中取出所有的内容,应该算是个数组;?为什么这个命令是黄色的?
        $sql = "SELECT * FROM comments where blog_id=$id";
        // 这个取出来的值不能直接用,要用另外一个变量,转化一下;为什么要写mysqli
        $return = $this->mysqli->query($sql);
        // 给取出的内容正确的格式;

        return $this->_format($return);


    }

    /**
     * 查询具体某评论详情
     *
     * @param $id
     * @return array
     */
    /* public function one($id)
     {
         $sql = "SELECT * FROM comments where blog_id=$id";
         return $this->mysqli->query($sql)->fetch_assoc();
     }
 */
    /**
     * @param $data
     */
    private function _format($fetchData)
    {

        $data = [];
        foreach ($fetchData as $item) {//item这个变量是什么呢?
            $data[] = $item;
        }

        return $data;//为什么这样返回的就是ID呢?
    }
}