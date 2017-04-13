<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/3/16
 * Time: 下午2:20
 */
require_once 'Comment.php';

$username = $_POST['author'];
$content = $_POST['comment'];
$blog_id = $_GET['blog_id'];
$comment = new Comment();
$message = $comment->add($blog_id,$username,$content);


echo '评论提交成功!感谢!';
