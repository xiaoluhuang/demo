<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/3/14
 * Time: 上午9:05
 */
?>


<form action="/mysql/publish.php?user_id=1&category=history" method="post">
    <p>标题: <input type="text" name="title" style="width: 100px"/></p>
    <p>引言: <textarea name="quote" style="width:500px;height:100px;"></textarea>
    <p>内容: <textarea name="content" style="width:500px;height:200px;"></textarea>
    <p><input type="submit" value="提交"/></p>
</form>

<?php
/*
$userName = $_POST['user_name'];
$comments = $_POST['comment'];
echo "user_id: {$_GET['user_id']}<BR>";
echo "category: {$_GET['category']}<BR>";
echo "username: {$userName}<BR>";
echo "comments: $comments<BR>";

echo "======= _POST =======<BR>";
var_dump($_POST);
echo "======= _GET =======<BR>";
var_dump($_GET);

//require_once  'mysqli.php';
$insertSql = sprintf('insert into comments (author_id, blog_id, content) values ("%s, "%s", "%s")',
    1, 2, $comments
);
var_dump($insertSql);
//$return  = $mysqli->query($insertSql);
//var_dump($return);

*/
//?>