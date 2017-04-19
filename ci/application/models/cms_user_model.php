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

class  CMS_User_model extends CI_Model
{
    /**
     * 添加用户,增
     */
    public function add_user($user)
    {
        $this->db->insert('user', $user);
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
    public function get($user_id)
    {
        $user = $this->db->where(['user_id' => $user_id])->get('user')->row_array();
//        p($data);
        return $user;
    }

    /*
     * 计算专栏总数
     */
    public function count_user()
    {
        return $this->db->count_all_results('user');
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




















