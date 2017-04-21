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
        $this->load->library('session');
        parent::__construct();
        $username = $this->session->userdata('user_name');
        $uid = $this->session->userdata('user_id');
        if (!$username || !$uid) {
            redirect('admin/login/index');
        }
        $this->load->model('cms_user_model', 'user');
        $this->load->model('cms_category_model', 'cate');
        $this->load->helper('form');
        $this->userInfo = [
            'user_id' => $uid,
            'user_name' => $username,
        ];

    }


}