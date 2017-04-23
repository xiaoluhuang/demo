<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/3/27
 * Time: 下午8:28
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * 用户管理模型
 */

class  CMS_Comment_model extends CI_Model
{
    /**
     * 添加用户,增
     */
    public function write_reply($message)
    {
        $this->db->insert('comment', $message);
    }

    /**
     * 查看用户,查所有内容
     */
    public function get_user()
    {
        $user = $this->db->get('user')->result_array();
        return $user;
    }

    /**
     * 查询对应的用户
     */
    public function get($article_id)
    {
        $comment = $this->db->where(['article_id' => $article_id])->get('comment')->result_array();
//        p($data);
        return $comment;


    }
    public function get_rows($article_id)
    {
        $comment = $this->db->where(['article_id' => $article_id])->get('comment');
//        p($data);
        return $comment;
    }

    public function get_name($user_name)
    {
        $user = $this->db->where(['name' => $user_name])->get('user')->row_array();
//        p($user);
        return $user;
    }


    /*
     * 计算专栏总数
     */
    public function count_user()
    {
        return $this->db->count_results('user');
    }

    /**
     * 修改用户
     */
    public function edit_user($user_id, $user)
    {
        $this->db->update('user', $user, ['user_id' => $user_id]);
    }

    /**
     * 删除用户
     */
    public function delete_user($user_id)
    {
        $this->db->delete('user', ['user_id' => $user_id]);

    }
}




















