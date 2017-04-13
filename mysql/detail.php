<?php
require_once 'Blog.php';
require_once 'Comment.php';

$id = $_GET['id'];

$blog = new Blog();//生成blog对象?Blog是一个类,one是一个方法,但是对象是什么?
$comment = new Comment();
$detail = $blog->one($id);//这个函数需要传参,所以上一条语句是获取一个参数,这个参数可以是用户自己从url上输入的,也可以从index页面获取;
$list = $comment->getList($id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>blog</title>
    <link rel="stylesheet" href="../css/blog.css">
    <!--<link rel="stylesheet" href="/css/blog.css">-->

</head>
<body>

<div class="header">
    <div class="aside">
        vivi安 | to be a better programmer
    </div>

</div>

<div id="title-bg">
    <h1 id="title" class="center"><?= $detail['title'] ?>
        <span class="lr_blog_entry_head">发表于:<?= $detail['updated_at'] ?> </span>
    </h1>
</div>
<div class="content center">
    <div id="quote">
        <?= $detail['quote'] ?>
    </div>
    <div class="text">
        <?= $detail['content'] ?>
    </div>
</div>
<h2 class="comments-title">
    24 Comments
</h2>
<?php foreach ($list as $k => $v) { ?>
    <div class="comment-author">
        <div class="fn">
            <?php echo $v['author_id']; ?><!--在标题上通过foreach获取的ID来传这个参数-->
        </div>                  <!-- .comment-author -->
        <div><?= $v['updated_at'] ?></div>
    </div>
    <div class="comment-content">
        <p><?= $v['content'] ?></p>
    </div>
<?php } ?>

<div class="content center">
    <h3>留下评论</h3>
    <form action="/mysql/message.php?blog_id=<?= $id ?>" method="post">
        <div>
            <textarea class="form-control" id="comment" name="comment" cols="45" rows="8"
                      aria-required="true"></textarea>
        </div>
        <div>
            <label for="author">姓名</label>
            <input name="author" type="text" value="" size="30" aria-required="true">
        </div>
        <p class="form-submit">
            <input name="submit" type="submit" class="submit btn btn-sm" value="提交评论">
        </p>
    </form>
</div>

</body>
</html>
