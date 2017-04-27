<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/3/31
 * Time: 下午4:17
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
//        session_start();
//        var_dump($_SESSION);
        $username = $this->session->userdata('user_name');
        $uid = $this->session->userdata('user_id');
//        var_dump($this->session->userdata());
        if (!$username || !$uid) {
            redirect('cms/login/user_login_index');
        }
        $this->load->model('cms_user_model', 'user');
        $this->load->model('cms_category_model', 'cate');
        $this->load->model('cms_article_model', 'art');
        $this->load->helper('form');
        $this->userInfo = [
            'user_id' => 9,
            'user_name' =>'linda',
        ];

    }


}