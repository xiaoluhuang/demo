<?php
/**
 * Created by huangxiaolu.
 * User: huangxiaolu
 * Date: 2017/3/27
 * Time: 上午10:06
 */
defined('BASEPATH') OR exit('No direct script access allowed');


class Login extends CI_Controller
{
    public function index()
    {
        // 写入1
        $this->session->set_userdata([
            'login_user' => 'huangxiaolu',
        ]);
        // 写入2
        $this->session->set_userdata('login_user', 'huangxiaolu');

        // 获取
        $this->session->userdata('login_user');



        $this->load->helper('captcha');
        $speed = 'ahwrmlp798262biueyebmzksx';
        $word = '';
        for ($i = 0; $i < 4; $i++) {
            $word .= $speed[mt_rand(0, strlen($speed) - 1)];
        }
        $vals = array(
            'img_path' => './captcha/',
            'img_url' => base_url() . '/captcha/',
            'img_width' => 200,
            'img_height' => 50,
            'expiration' => 30,
            'font_size' => 40,
            'word_length' => 20,
            'word' => $word
        );

        $cap = create_captcha($vals);
//        p($cap);die;
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['code'] = $cap['word'];
        $data['captcha'] = $cap['image'];
        $this->load->view('admin/login_v2.html', $data);
    }

    public function login_in()
    {

        $code = $this->input->post('captcha');
        if (!isset($_SESSION)) {
            session_start();
        }
        if ($code != $_SESSION['code']) {
            error('验证码错误');
        }
        $username = $this->input->post('username');
        $this->load->model('admin_model', 'admin');
        $userData = $this->admin->check($username);
        $passwd = $this->input->post('passwd');
        if (!$userData || $userData[0]['passwd'] != md5($passwd)) {
            error('用户名不存在或密码错误');
        }
        $sessionData = array(
            'username' => $username,
            'uid' => $userData[0]['uid'],
            'logintime' => time()
        );

        $this->session->set_userdata($sessionData);
//        $data = $this->session->userdata('username');
        // 写入
        $this->session->set_userdata([
            'login_user' => 'huangxiaolu',
        ]);
        // 获取
        $this->session->userdata('login_user');


        $this->session->userdata('username');
        $this->session->userdata('uid');
        success('admin/admin/disp', '登录成功');
    }

    /*
     * 退出登录
     */
    /**
     * @return object
     */
    public function login_out()
    {
        $this->session->sess_destroy();
        success('admin/login/index', '退出成功');
    }

}