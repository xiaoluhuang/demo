<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/3/31
 * Time: 下午3:25
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * 后台用户管理模型
 */

class Admin_model extends CI_Model
{
    /*
     * 查询后台用户数据
     */
    public function check($username)
    {
//        $this->db->where(array('username'=>$username))->get('admin');
        $data = $this->db->get_where('admin', array('username' => $username))->result_array();
        return $data;
    }
}