<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/3/27
 * Time: 下午8:28
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * 栏目管理模型
 */

class Category_model extends CI_Model
{
    /**
     * 添加栏目,增
     */
    public function add($data)
    {
        $this->db->insert('category', $data);
    }

    /**
     * 查看栏目,查所有内容
     */
    public function check()
    {
        $data = $this->db->get('category')->result_array();
        return $data;
    }

    /**
     * 查询对应的栏目
     */
    public function check_cate($cid)
    {
        $data = $this->db->where(array('cid' => $cid))->get('category')->result_array();
//        p($data);
        return $data;
    }

    /**
     * 修改栏目
     */
    public function update_cate($cid, $data)
    {
        $this->db->update('category', $data, array('cid' => $cid));
    }

    /**
     * 删除栏目
     */
    public function del($cid)
    {
        $this->db->delete('category', array('cid' => $cid));

    }

}




















