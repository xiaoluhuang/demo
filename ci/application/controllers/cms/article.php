<?php

/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/4/19
 * Time: 下午9:03
 */
class Article extends MY_controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /*
     * 文章列表
     */
    public function index()
    {
        $this->load->library('pagination');
        $config['base_url'] = site_url('cms/article/index');
        $config['total_rows'] = $this->db->count_all_results('article');
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
//        unset($offset);
        $article = $this->art->get_articles();
        $count = $this->art->count_article();
        $user_id = $this->session->userdata('user_id');
        $user_name = $this->session->userdata('user_name');

        $data = [
            'count' => $count,
            'article' => $article,
            'links' => $links,
            'user_id' => $user_id,
            'user_name' => $user_name,
        ];
//        var_dump($data);die;
        $this->load->view('cms/admin-article.html', $data);
    }


    /*
     * 发表文章
     */

    public function publish_article()
    {
        $user_id = $this->uri->segment(4);
        $user = $this->user->get($user_id);
        $category_name = $_POST['category'];

        $title = $this->input->post('title');
        $content = $this->input->post('content');
        $user = $this->session->userdata('user_name');

        $category = $this->cate->get_id($category_name[0]);

        $article = [
            'user_id' => $user_id,
            'category_id' => $category['category_id'],
            'title' => $title,
            'content' => $content,
            'user' => $user,
            'category' => $category['category'],
        ];
//        var_dump($article);die;
        $this->art->publish_article($user_id, $article);
        success('cms/login/index_user/' . $user_id, '文章发布成功');
    }

    /*
     * 查看文章
     */
    public function detail()
    {
        $article_id = $this->uri->segment(4);
        $article = $this->art->get($article_id);
        $category = $this->cate->get($article['category_id']);
        $user = $this->user->get($article['user_id']);
        $user_id = $this->session->userdata('user_id');
        $user_name = $this->session->userdata('user_name');
        $data = [
            'article' => $article,
            'user' => $user,
            'category' => $category,
            'user_id' => $user_id,
            'user_name' => $user_name,
        ];
//        var_dump($article);die;
        $this->load->view('cms/admin-article-detail.html', $data);
    }

    /*
     * 删除文章
     */
    public function delete_article()
    {
        $article_id = $this->uri->segment(4);
        $this->art->delete_article($article_id);
        success('cms/article/index/' . $article_id, '文章删除成功');


    }

    /*
     * 修改文章
     */
    public function edit_article()
    {
        $article_id = $this->uri->segment(4);
        $article = $this->art->get($article_id);
        $user_name = $this->session->userdata('user_name');
//        var_dump($user_name);die;
        $category = $this->cate->get_category();
        $cateChose = $this->cate->get($article['category_id']);
        $user_id = $this->session->userdata('user_id');
        $data = [
            'user' => $user_name,
            'article' => $article,
            'category' => $category,
            'cateChose' => $cateChose['category'],
            'user_id' => $user_id,
            'user_name' => $user_name,
        ];
        $this->load->view('cms/admin-article-edit.html', $data);

    }

    public function edit()
    {
        $article_id = $this->uri->segment(4);
        $category_name = $_POST['category'];
//        var_dump($category_name);die;
        $title = $this->input->post('title');
        $content = $this->input->post('content');
        $user = $this->session->userdata('user_id');
        $user_name = $this->session->userdata('user_id');
//        $category = $this->cate->get_id($category_name[0]);
        $article = [
            'article_id' => $article_id,
            'content' => $content,
            'title' => $title,
            'user_id' => $user ,
            'user_name' => $user_name ,
            'category_id' => $category_name[0],
        ];
        $this->art->edit_article($article_id,$article);
        success('cms/article/index','文章修改成功');

    }
}