<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/3/16
 * Time: 上午8:48
 */

require_once 'Blog.php';
$title = $_POST['title'];
$content = $_POST['content'];
$quote = $_POST['quote'];
$id = $_GET['user_id'];
// 1.生成blog对象
$blog = new Blog();
$insert = $blog->add($title, $quote, $content, $id);


