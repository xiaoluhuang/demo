<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/3/13
 * Time: 下午5:51
 */
//公鸡五文钱一只,母鸡散文钱一只,小鸡一文钱三只;一百蚊钱,买了多少只公鸡,母鸡和小鸡;把逻辑想通了这些就都不难了。

$total = 100;
for ($a = 1; $a <= 20; $a++) {
    for ($b = 1; $b <= 100; $b++) {
        $c = 100 - $b - $a;
        if ($a + $b + $c == 100 && 5 * $a + 3 * $b + $c / 3 == 100)
            echo "公鸡 母鸡 小鸡各:", $a, '&nbsp;', $b, '&nbsp;', $c, '<br />';
    }
}