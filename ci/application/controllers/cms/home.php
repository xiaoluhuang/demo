<?php

/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/4/21
 * Time: 下午4:24
 */
class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('cms_user_model', 'user');
        $this->load->model('cms_article_model', 'art');
        $this->load->model('cms_category_model', 'cate');
        $this->load->model('cms_comment_model', 'com');
        $this->load->helper('form');

    }

    public function index()
    {
//        $_SESSION['name'] = 'wushuiyong';
//        var_dump($_SESSION);
        $this->load->library('pagination');
        $config['base_url'] = site_url('cms/home/index');
        $config['total_rows'] = $this->db->count_all_results('article');
        $config['per_page'] = 4;
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

        $article = $this->art->get_articles();
        $category = $this->cate->get_category();
        $data = [
            'article' => $article,
            'category' => $category,
            'links' => $links,
        ];
        $this->load->view('cms/home.html', $data);
    }

    public function about()
    {
//        $_SESSION['category'] = 'user';
//        var_dump($_SESSION);
        $this->load->view('cms/about.html');
    }

    public function contact()
    {
        $this->load->view('cms/contact.html');
    }

    public function article()
    {
        $article_id = $this->uri->segment(4);
        $article = $this->art->get($article_id);
        $category = $this->cate->get_category();
        $user = $this->user->get($article['user_id']);
        $cate = $this->cate->get($article['category_id']);
        $comment = $this->com->get($article_id);
        $query = $this->com->get_rows($article_id);
        $count = $query->num_rows();

//        p($count);die;
        $data = [
            'article' => $article,
            'category' => $category,
            'name' => $user,
            'cate' => $cate,
            'comment' =>$comment,
            'count' => $count,
        ];

        $this->load->view('cms/article.html', $data);

    }

    public function category()
    {
        $category['category'] = $this->cate->get_category();
        $this->load->view('cms/category.html', $category);
    }



}