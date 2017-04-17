<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/3/29
 * Time: 下午7:53
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 文章管理模型
 */
class Article_model extends CI_Model
{
    /**
     * @param $data插入文章
     */
    public function add($data)
    {
        // data = ['title' => 'a title', 'content' => 'this is a content',]
        // sql : insert into article (title, content) values('a title', 'this is a content');
        $this->db->insert('article', $data);
    }

    /**
     * 查看文章
     */
    public function article_category()
    {
        $data = $this->db->select('aid,title,content,info,time,cname')->from('article')->
        join('category', 'article.cid=category.cid')
            ->order_by('aid', 'asc')->get()->result_array();
//        p($data);die;
        return $data;
    }

    /*
     * 查询文章
     */


    public function check_article($aid)
    {
        $data = $this->db->where(['aid' => $aid])->get('article')->row_array();
        return $data;
    }

    public function get_category($cid)
    {
        return $this->db
            ->where(['cid' => $cid])
            ->get('category')
            ->row_array();

    }

    /*
     * 删除文章
     */
    public function del($aid)
    {
        $this->db->delete('article', ['aid' => $aid]);
    }

    /*
     * 修改文章
     */
    public function update_article($aid, $data)
    {
//        var_dump('article', $data, array('aid' => $aid));
        return $this->db->update('article', $data, array('aid' => $aid));
    }


}