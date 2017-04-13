<?php

/**
 * 1.添加博客
 * 2.查询博客列表
 * 3.查询具体某博客详情
 *
 * Class Blog
 */
require_once 'Db.php';

class Blog extends Db
{

    public function __construct()
    {
        // 父类的
        parent::__construct();
        // 自己的特殊性
    }

    /**
     * 添加博客,这个是不是要用到表单呢?
     *
     * @return bool
     */
    public function add($title, $quote, $content, $authorId)
    {
        $insertsql = sprintf('insert into blog (title, quote, content, author_id) values ("%s","%s","%s","%s")',
            $title, $quote, $content, $authorId
        );
       return $this->query($insertsql);
    }

    /**
     * 查询博客列表
     *
     * @return array
     */
    public function getList()
    {
        // 从blog表中取出所有的内容,应该算是个数组;?为什么这个命令是黄色的?
        $sql = 'SELECT id, title, updated_at FROM blog';
        // 这个取出来的值不能直接用,要用另外一个变量,转化一下;为什么要写mysqli
        $return = $this->query($sql);
        // 给取出的内容正确的格式;
        return $this->_format($return);

    }

    /**
     * 查询具体某博客详情
     *
     * @param $id
     * @return array
     */
    public function one($id)
    {
        $sql = "SELECT * FROM blog where id=$id";
        return $this->query($sql)->fetch_assoc();

    }

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