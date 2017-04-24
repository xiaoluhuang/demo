<?php

/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/4/21
 * Time: 下午4:24
 */
class A extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

    public function index()
    {
        $_SESSION['name'] = 'wushuiyong';
        var_dump($_SESSION);

    }

    public function about()
    {
//        $_SESSION['category'] = 'user';
        var_dump($_SESSION);
    }

}