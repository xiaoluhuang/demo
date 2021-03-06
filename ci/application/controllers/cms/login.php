<?php

/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/4/17
 * Time: 下午1:38
 */
class Login extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('cms_user_model', 'user');
        $this->load->model('cms_category_model', 'cate');
        $this->load->helper('form');
    }

    /*
     * 加载管理员首页
     */
    public function index_admin()
    {
        $this->load->view('cms/admin-index.html');
    }

    /*
     * 登出页面
     */
    public function logout()
    {
        $this->load->view('cms/index.html');

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
        $user = $this->user->get_name($username);
//        var_dump($username,md5($passwd),$user);die;
        //将两者数据进行比较
        if (!$username || md5($passwd )!= $user['passwd']) {
            error('用户名不存在或密码错误');
        }
        $session = [
            'user_id' => $user['user_id'],
            'user_name' => $username
        ];
//        var_dump($session);die;
        $this->session->set_userdata($session);
        $session1 = $this->session->userdata();
//        $_SESSION['xxxxxxx'] = 'yyyyyyyyy';
//        var_dump($session1, $_SESSION);die;
//        $this->session->userdata('username');
//        $this->session->userdata('uid');
        success('cms/login/index_user/', '登录成功');



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
        $user = $this->user->get_user();
        foreach($user as $value){
            if(in_array($username,$value)){
                error('已经注册过,请登录');
            };
        }

        //将获取到的数据插入数据库
        $this->user->add_user($registerdata);
        //跳转页面
        success('cms/user/index_user', '注册成功');
    }



    public function index_user()
    {
        $category = $this->cate->get_category();
        $user_name = $this->session->userdata('user_name');
        $user_id = $this->session->userdata('user_id');
        $session = $this->session->userdata();
//        var_dump($session, $_SESSION);die;
        $data = [
            'user_name' =>$user_name,
            'user_id' => $user_id,
//            'user_name' => $user_name,
            'category' => $category
        ];
//        var_dump($data);die;
        $this->load->view('cms/admin-index.html',$data);
    }



}