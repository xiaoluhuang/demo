<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/4/14
 * Time: 下午5:32
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment_model extends CI_Model
{
    /*
     * 插入评论
     */

    public function add_comments($comments)
    {
        $this->db->insert('comment', $comments);
    }

    /*
     * 显示评论
     */
    public function get_comments($blog_id)
    {
        $comments = $this->db->where(['blog_id' => $blog_id])->get('comment')->row_array();
        return $comments;
    }
}