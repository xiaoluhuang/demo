<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/5/15
 * Time: 上午9:26
 */
/**
 *  老公讲的,如何在数据库存储图片
 */
define('PICTURE_DIR', '/Users/huangxiaolu/workspace/demo/test/pictures');
define('PICTURE_WEB', '/test/pictures');
require_once __DIR__ . '/../mysql/Db.php';

// 获取文件格式，后缀
if ($_SERVER['REQUEST_METHOD'] == 'POST') { // 表单提交方式
    function getPicType($str) {
        $arr = explode('.', $str);
        return array_pop($arr);
    }


    $pircture = $_FILES['picture']; // 经由 HTTP POST 文件上传而提交至脚本的变量
    var_dump($pircture);
    /**
     *  ["name"]=> string(36) "4e7d82aec8a0d7177a0fe3814fb434e5.jpg"
     * ["type"]=> string(10) "image/jpeg"
     * ["tmp_name"]=> string(26) "/private/var/tmp/phpEQsPke"
     * ["error"]=> int(0)
     * ["size"]=> int(6169)
     */
    // 原来文件名,和新的文件名
    $originName = $_FILES['picture']['tmp_name'];
    $newName    = sprintf('%s%d.%s',
        date('YmdHis'),
        rand(10,99),
        getPicType($_FILES['picture']['name']));

    $path = sprintf('%s/%s', PICTURE_DIR, $newName);
    // 把上传到缓冲区的文件,保存到服务器,重命名新文件名
    move_uploaded_file($originName, $path);

    // 把新的文件名入库   存的是文件名,时间戳+随机数字+后缀获取的
    $db = new Db('beibei');
    $sql = sprintf('insert into picture(path) values("%s")', $newName);
    $ret = $db->query($sql);
    echo $ret ? '插入成功' : '插入失败';

    //  取数据的时候,也是用文件名（路径）来获取
    $sql = sprintf('select * from picture where path="%s"', $newName);
    $picture = $db->query($sql);
//    var_dump($picture);
    $img = sprintf('%s/%s', PICTURE_WEB, $newName);// 为什么要用这个路径来着
}
?>



<form action="/test/picture.php" method="post" enctype="multipart/form-data">
    <label for="file">文件名：</label>
    <input type="file" name="picture" id="file"><br>
    <input type="submit" name="submit" value="提交">
</form>

<?php if (isset($img)) { ?>
    <img src="<?= $img ?>">
<?php } ?>