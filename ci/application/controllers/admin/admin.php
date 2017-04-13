<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/3/27
 * Time: 下午3:04
 */
defined('BASEPATH') OR exit('No direct script access allowed');


class Admin extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

    }

    public function index()
    {

        $str= $this->load->view('admin/blank.html',true);
//        p($str);die;
    }

    public function disp()
    {

        $this->load->view('admin/head.html');
        $this->load->view('admin/content.html');
        $this->load->view('admin/foot.html');
    }
}
