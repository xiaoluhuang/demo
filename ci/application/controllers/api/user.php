<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/4/16
 * Time: 下午5:56
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends  CI_Controller
{
    public function info()
    {
        $userInfo = [
            'username' => 'huangxiaolu',
            'message' => 'i love my husband so much',
            'menu' => ['artitle', 'category'],
        ];
        $data = [
            'code' => 0,
            'message' => '',
            'data' => $userInfo,
        ];
        echo json_encode($data);
    }


    public function error()
    {
        $data = [
            'code' => 1001,
            'message' => '没有权限,请联系管理员',
            'data' => '',
        ];
        echo json_encode($data);
    }
}
