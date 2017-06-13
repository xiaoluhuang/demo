<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/6/8
 * Time: 下午2:58
 */

namespace app\controllers;


use app\components\Controller;

class ScoreController extends Controller
{
    // 登录,加积分
    // 判断用户是否登录,如没有,返回false;
    public function isLogin()
    {

    }
    // 如果登录,判断今天是否登录过,如果是重复登录,返回false;
    // 如果为今天第一次登录,积分+1;

    // 打卡,加积分
    // 打卡,积分+3;
    // 连续打卡,如果连续n打卡,积分+n-1;

    // 积分明细 select * from scoreInfo where id = *;

    // 积分前10名

    // 月排行榜 zrevrange('201701',0,9,withscores)
}