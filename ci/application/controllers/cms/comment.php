<?php
class Comment extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('cms_user_model', 'user');
        $this->load->model('cms_category_model', 'cate');
        $this->load->model('cms_comment_model', 'com');
        $this->load->model('cms_article_model', 'art');
        $this->load->helper('form');

    }

    public function write_reply()
    {
        $article_id = $this->uri->segment(4);
        $name = $this->input->post('name');
        $comment = $this->input->post('comment');
        $message = [
            'article_id' =>$article_id,
            'name' =>$name,
            'comment' =>$comment,
        ];
        $this->com->write_reply($message);
        success('cms/home/article/'.$article_id,'评论添加成功');
    }
}