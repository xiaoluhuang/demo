<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/4/20
 * Time: 下午11:48
 */
class Base_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('cms_user_model', 'user');
        $this->load->model('cms_category_model', 'cate');
        $this->load->helper('form');
        $this->userInfo = [
            'user_id' => 9,
            'user_name' => 'linda',
        ];

    }
}