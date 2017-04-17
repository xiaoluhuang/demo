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

    public function __construct()
    {
        parent::__construct();
        $this->load->model('category_model', 'cate');
        $this->load->model('article_model', 'art');
        $this->load->model('comment_model', 'com');
    }

    /**
     * @return object
     */
    public function index()
    {
//        $this->load->library('beauty');
//        $this->beauty=load_class('beauty');
//        $this->beauty->flower();
//        die;

        //加载分页配置
        $this->load->library('pagination');
        $config['base_url'] = site_url('index/home/index');
        $config['total_rows'] = $this->db->count_all_results('article');
        $config['per_page'] = 4;
        $config['uri_segment'] = 4;
        $config['first_link'] = '第一页';
        $config['prev_link'] = '上一页';
        $config['next_link'] = '下一页';
        $config['last_link'] = '最后一页';
        $this->pagination->initialize($config);

        $links = $this->pagination->create_links();
        $offset = $this->uri->segment(4);
        $this->db->limit(4, $offset);

        $article = $this->art->article_category();//从数据库获取文章信息
//        p($article);die;
        $this->load->view('index/index.html', [
            'links' => $links,
            'article' => $article,
        ]);

    }

    /*
     * 显示博客内容
     */
    public function single()
    {
        $aid = $this->uri->segment(4);
        $blog = $this->art->check_article($aid);
//        p($blog);die;
        $cname = $this->art->get_category($blog['cid']);
        $this->load->view('index/single.html', [
            'blog' => $blog,
            'cname' => $cname,
        ]);
    }

    /*
     * 提交评论
     */
    public function add_comments()
    {
        $this->load->helper('form');
        $blog_id = $this->uri->segment(4);
//        echo $blog_id;die;
        $content = $this->input->post('content');
        $name = $this->input->post('name');

        $comments = [
            'blog_id' => $blog_id,
            'content' => $content,
            'name' => $name,
        ];
//        p($comments);die;
        $this->com->add_comments($comments);
        success('index/home/single', '发布成功');

    }


}
