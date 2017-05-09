<?php

/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/4/19
 * Time: 下午5:52
 */
class B extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
//        $this->load->model('cms_user_model', 'user');
//        $this->load->model('cms_category_model', 'cate');
//        $this->load->model('cms_article_model', 'art');
//        $this->load->helper('form');
    }

    /*
     * 查看所有用户
     */
    public function index()
    {
        $user_name = $this->session->set_userdata('user_name', 'yyyyy');
//        $user_id = $this->session->userdata('user_id');
//        $session = $this->session->userdata();
//        $_SESSION['name'] = 'xxxxx';
        var_dump($_SESSION);die;

    }
    public function about()
    {
//        $_SESSION['category'] = 'user';
        var_dump($_SESSION);
    }
}