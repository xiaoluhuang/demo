<?php

/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/4/17
 * Time: 下午1:38
 */
class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('cms_user_model', 'cms');
        $this->load->helper('form');

    }

    /*
     * 加载管理员首页
     */
    public function index_admin()
    {
        $this->load->view('cms/admin-dashboard.html');
    }

    /*
     * 加载用户首页
     */
    public function index_user()
    {
        $this->load->view('cms/admin-dashboard.html');
    }


    /*
     * 登出页面
     */
    public function logout()
    {
        $this->load->view('cms/index.html');

    }

    /*
     * 管理者登录
     */
    public function admin_login_index()
    {

        $this->load->view('cms/index-admin.html');
    }

    public function admin_login()
    {
        //从表单获取用户名和密码
        $username = $this->input->post('username');
        $passwd = $this->input->post('passwd');

        //从数据库获取用户名和密码

        $admin = $this->cms->get_admin($username);
//        var_dump($admin,$username,$passwd);die;
        //将两者数据进行比较
        if (!$username || md5($passwd) != $admin['admin_passwd']) {
            error('用户名不存在或密码错误');
        }
        success('cms/login/index_admin', '登录成功');

    }

    /*
    * 用户登录
    */
    public function user_login_index()
    {
        $this->load->view('cms/index-user.html');
    }

    public function user_login()
    {
        //从表单获取用户名和密码
        $username = $this->input->post('username');
        $passwd = $this->input->post('passwd');

        //从数据库获取用户名和密码
        $user = $this->cms->get_user($username);
//        var_dump($username,md5($passwd),$user);die;
        //将两者数据进行比较
        if (!$username || md5($passwd )!= $user['passwd']) {
            error('用户名不存在或密码错误');
        }
        success('cms/login/index_user', '登录成功');

    }

    /*
     * 用户注册
     */
    public function register()
    {
        //从表单获取用户名和密码
        $username = $this->input->post('username');
        $passwd = $this->input->post('passwd');
        $registerdata = [
            'name' => $username,
            'passwd' => md5($passwd),
        ];
        //判断这个用户名是否存在
        $user = $this->cms->get_user();
        foreach($user as $value){
            if(in_array($username,$value)){
                error('已经注册过,请登录');
            };
        }

        //将获取到的数据插入数据库
        $this->cms->add_user($registerdata);
        //跳转页面
        success('cms/login/index_user', '注册成功');
    }



}