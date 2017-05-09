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

class  CMS_Category_model extends CI_Model
{
    /**
     * 添加栏目,增
     */
    public function add_category($category)
    {
        $this->db->insert('category', $category);
    }

    /**
     * 查看栏目,查所有内容
     */
    public function get_category()
    {
        $category = $this->db->get('category')->result_array();
        return $category;
    }

    /**
     * 查询对应的栏目,根据id查栏目,根据栏目查id
     */
    public function get($category_id)
    {
        $category = $this->db->where(['category_id' => $category_id])->get('category')->row_array();
//        p($data);
        return $category;
    }

    public function get_id($category_name)
    {
        $category = $this->db->where(['category' => $category_name])->get('category')->row_array();
//        p($data);
        return $category;
    }

    /*
     * 计算专栏总数
     */
    public function count_category()
    {
        return $this->db->count_all_results('category');
    }

    /**
     * 修改栏目
     */
    public function edit_category($category_id, $category)
    {
        $this->db->update('category', $category, ['category_id' => $category_id]);
    }

    /**
     * 删除栏目
     */
    public function delete_category($category_id)
    {
        $this->db->delete('category', ['category_id' => $category_id]);

    }


}




















