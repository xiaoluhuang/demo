<?php
// 新的方式
require_once 'Blog.php';
// 1.生成blog对象
$blog = new Blog();

// 2.用blog对象的成员方式来获取所有的文章
$list = $blog->getList();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>blog</title>
    <link rel="stylesheet" href="../css/blog.css">
    <!--<link rel="stylesheet" href="/css/blog.css">因为所有的根目录就到demo-->

</head>
<body>

<div class="header">
    <div class="aside">
        vivi安 | to be a better programmer
    </div>

</div>

<div id="title-bg">
    <?php foreach ($list as $k => $v) { ?>
        <h1 id="title" class="center">
            <a href="/mysql/detail.php?id=<?= $v['id'] ?>">
                <?= $v['title'] ?><!--在标题上通过foreach获取的ID来传这个参数-->
            </a>
            <span class="lr_blog_entry_head">发表于:<?=$v['updated_at']?> </span>
        </h1>
    <?php } ?>

</div>

