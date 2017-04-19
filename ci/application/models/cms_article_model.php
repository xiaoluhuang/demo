<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/3/27
 * Time: 下午8:28
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * 文章管理模型
 */

class  CMS_Article_model extends CI_Model
{
    /**
     * 添加文章,增
     */
    public function add_article($article)
    {
        $this->db->insert('article', $article);
    }

    /**
     * 查看文章,查所有内容
     */
    public function get_article()
    {
        $article = $this->db->get('article')->result_array();
        return $article;
    }

    /**
     * 查询对应的文章
     */
    public function get($article_id)
    {
        $article = $this->db->where(['article_id' => $article_id])->get('article')->row_array();
//        p($data);
        return $article;
    }

    /*
     * 计算专栏总数
     */
    public function count_article()
    {
        return $this->db->count_all_results('article');
    }

    /**
     * 修改文章
     */
    public function edit_article($article_id, $article)
    {
        $this->db->update('article', $article, ['article_id' => $article_id]);
    }

    /**
     * 删除文章
     */
    public function delete_article($article_id)
    {
        $this->db->delete('article', ['article_id' => $article_id]);

    }
}




















