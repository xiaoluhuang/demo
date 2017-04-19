<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/4/19
 * Time: 下午9:03
 */
class Article extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('cms_article_model','cms');
    }
    /*
     * 发表文章
     */
    public function publish_article()
    {
        $this->load->view('cms/admin-dashboard.html');
    }

}