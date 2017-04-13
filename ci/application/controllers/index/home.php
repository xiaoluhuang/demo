<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/3/23
 * Time: 上午10:57
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
    /**
     * @return object
     */
    public function index()
    {
        $this->load->view('index/index.html');
    }

    /*
     * 分类页面显示
     */



}
