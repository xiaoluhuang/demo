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
        $article = $this->art->get_articles();
        $count = $this->art->count_article();
        $data = [
            'count' => $count,
            'article' => $article,
            'links' => $links,
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

        $category = $this->cate->get_id($category_name[0]);

        $article = [
            'user_id' => $user_id,
            'category_id' => $category['category_id'],
            'title' => $title,
            'content' => $content,
            'user' => $user['name'],
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
        $data = [
            'article' => $article,
            'user' => $user,
            'category' => $category,
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
        $article['article'] = $this->art->get($article_id);
        $this->load->view('cms/admin-article-edit.html', $article);

    }

    public function edit()
    {

    }
}