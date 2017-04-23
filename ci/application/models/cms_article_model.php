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
    public function publish_article($user_id, $article)
    {
        $this->db->insert('article',$article);
    }

    /**
     * 查看文章,查所有内容
     */
    public function get_article()
    {
        $articles = $this->db->get('article')->result_array();
        // ---- 第一种:先取所有id,二次查表得到[id => name]键值对,再逐条回填name字段
        // 取该数组里的所有去重uid
        // $userInfo = select * from user where id in (uids)

        // 取该数组里的所有去重category
        // $categoryInfo = select * from category where id in (category_ids)

        // foreach ($articles as &$article) {
        //  $article['user_name'] = $userInfo[$article['user_id']]
        //  $article['category_name'] = $userInfo[$article['category_id']]
        // }
        $userName = $this->db->select('name')->from('user')
            ->join('article','user.user_id=article.user_id')
            ->get()->result_array();
        $category = $this->db->select('category')->from('category')
            ->join('article','category.category_id=article.category_id')
            ->get()->result_array();
//        var_dump($category,$userName);
        foreach ($articles as &$article){
            $article['name'] = $userName[$article['user_id']];
            $article['category'] = $category[$article['category_id']];
        }

        return $articles;
    }

    public function get_articles()
    {
        $this->db->select('article_id');
        $this->db->select('title');
        $this->db->select('article.created_at');
        $this->db->select('category.category');
        $this->db->select('user.name');
        $this->db->from('article');
        $this->db->join('category','category.category_id=article.category_id','left');
        $this->db->join('user','user.user_id=article.user_id','left');
        $article = $this->db->get()->result_array();
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




















