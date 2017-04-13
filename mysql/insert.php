<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/3/12
 * Time: 下午10:28
 */
/*
title varchar(100) not null comment '标题',
content text default null comment '内容',
quote text default null comment '引用',
author_id varchar(100) not null comment '作者id = author.id',
 */
require_once 'mysqli.php';

$title = '信息时代的独立阅读者（一）：内心的小声音';
$quote = '只要读书就一定会有好事发生';
$content = '我是一个热爱阅读的人，不管是进入什么领域，精读和细读都是我会首先做的事情，从03年开始写博客（http://mindhacks.cn）直到现在，我把很多业余时间花在了泛心理学领域（认知科学、神经科学、社会心理学、亲子关系、心理咨询，等等）。'
    . '<br>'
    .'但比阅读更重要的，其实是阅读中的思考，带着脑和心去阅读，我把这个称为「独立阅读」。'

    . '<br>'
    . '在独立阅读中，我们对知识进行再次的深度加工，和自己既有的知识&经验体系去对照、印证，去碰撞，去对比，去分辨，然后破立、融合、存疑、延展、细化。经过了这样一个过程的阅读，看起来我们是阅读一篇文章，但其实我们代入了自己整个身心、思维、切身经验中的第一手素材。'

    . '<br>'
.'在这样的阅读中，一篇文本可能会帮助纠正我们知识体系中有问题的结论或预设，可能会为我们已经相对确立的结论提供更深刻的佐证，可能会帮助弥补我们知识体系中的短板，可能帮助我们去进一步反思我们的知识体系中那些含糊、泛而泛之的初步结论，可能打开了另外一条新的知识分支。';

$authorId = 1;


$insert = sprintf('insert into blog (title, quote, content, author_id) values ("%s","%s","%s","%s")',
    $title, $quote, $content, $authorId
);
var_dump($insert);
$return = $mysqli->query($insert);
var_dump($return);//var_dump($return);die;
//$row = $mysqli->query($sql)->fetch_assoc();

//foreach($mysqli->query($sql) as $row) {
//    var_dump($row);
//}
