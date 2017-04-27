<?php

/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/4/19
 * Time: 下午5:52
 */
class User extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('cms_user_model', 'user');
        $this->load->model('cms_category_model', 'cate');
        $this->load->model('cms_article_model', 'art');
        $this->load->helper('form');
    }

    /*
     * 查看所有用户
     */
    public function index()
    {
        $this->load->library('pagination');
        $config['base_url'] = site_url('cms/user/index');
        $config['total_rows'] = $this->db->count_all_results('user');
        $config['per_page'] = 5;
        $config['uri_segment'] = 4;
        $config['first_link'] = '第一页';
        $config['prev_link'] = '上一页';
        $config['next_link'] = '下一页';
        $config['last_link'] = '最后一页';

        $this->pagination->initialize($config);
        //创建a连接
        $links = $this->pagination->create_links();
//        p($data);die;
        $offset = $this->uri->segment(4);
        $this->db->limit(4, $offset);
//        p($links);die;
        $user = $this->user->get_user();
        $count = $this->user->count_user();
        $user_id = $this->session->userdata('user_id');
        $user_name = $this->session->userdata('user_name');

        $data = [
            'count' => $count,
            'user' => $user,
            'links' => $links,
            'user_id' => $user_id,
            'user_name' => $user_name,
        ];
//        var_dump($data);die;
        $this->load->view('cms/admin-user.html', $data);
    }
    /*
        * 加载用户首页
        */

    /*
     * 添加新用户
     */
    public function add_user()
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
        foreach ($user as $value) {
            if (in_array($username, $value)) {
                error('已经注册过,请登录');
            };
        }
        $this->user->add_user($registerdata);
        //跳转页面
        success('user/user/index', '添加成功');
    }

    /*
     * 删除用户
     */
    public function delete_user()
    {
        $user_id = $this->uri->segment(4);
//        var_dump($category_id);die;
        $this->user->delete_user($user_id);
        success('cms/user/index', '用户删除成功');
    }

    /*
     * 修改密码
     */
    public function change_passwd()
    {

        $user_id = $this->uri->segment(4);
        $userId = $this->session->userdata('user_id');
        $user_name = $this->session->userdata('user_name');
        $user = $this->user->get($user_id);
        $data = [
            'user' => $user,
            'user_id' => $userId,
            'user_name' => $user_name,
        ];
        $this->load->view('cms/admin-change-password.html', $data);
    }

    public function change()
    {
        $user_id = $this->uri->segment(4);
        $user = $this->user->get($user_id);
        $old_passwd = $this->input->post('old_passwd');
        $new_passwd1 = $this->input->post('new_passwd1');
        $new_passwd2 = $this->input->post('new_passwd2');
//        var_dump($b,$a,$user_id);die;
        if ($user['passwd'] !== md5($old_passwd)) {
            error('密码错误,请重新输入');
        }
        if ($new_passwd1 !== $new_passwd2) {
            error('两次密码不一致,请重新输入');
        }
        $data = [
            'passwd' => md5($new_passwd2),
            'user_id' => $user_id,
        ];
        $this->user->edit_user($user_id, $data);
        success('cms/user/index', '密码修改成功');
    }

    /*
     * 修改用户名
     */
    public function change_name()
    {
        $user_id = $this->uri->segment(4);
        $userId = $this->session->userdata('user_id');
        $user_name = $this->session->userdata('user_name');
        $user = $this->user->get($user_id);
        $data = [
            'user' => $user,
            'user_id' => $userId,
            'user_name' => $user_name,
        ];
        $this->load->view('cms/admin-change-name.html', $data);
    }

    public function change_username()
    {
        $user_id = $this->uri->segment(4);
        $name = $this->input->post('name');
        $data = [
            'name' => $name,
        ];
        $this->user->edit_user($user_id, $data);
        success('cms/user/index', '用户名修改成功');
    }

}