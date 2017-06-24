<?php
/* *****************************************************************
 * @Author: wushuiyong
 * @Created Time : 六  6/24 13:22:59 2017
 *
 * @File Name: palindrome.php
 * @Description:
 * *****************************************************************/

// 把strA直接反转得到strB
// 如果strA == strB即回文数
function palindrome1($str) {
    $strA = strval($str);
    // php原生函数，当然，也可以foreach手写实现
    $strB = strrev($strA);

    return $strA == $strB;
}

// 从两头分别循环str，start, end。当str{start} == str{end} && start == end时，即为回文数
// 如果strA == strB即回文数
function palindrome2($str) {
    for ($start = 0, $end = strlen($str); $start < $end; $start++, $end--) {
        if ($str{$start} != $str{$end-1}) {
            return false;
        }
    }
    return true;
}

$str = '1221';
var_dump(palindrome1($str));
var_dump(palindrome2($str));

$str = '1';
var_dump(palindrome1($str));
var_dump(palindrome2($str));

