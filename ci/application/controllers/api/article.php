<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/3/23
 * Time: 上午10:57
 */
/**
 *  老公写的,让我理解什么是api;
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller
{
    /**
     * @return object
     */
    public function category()
    {
        // 获取参数
        $page = $this->input->get('page');
        $size = $this->input->get('size');
        $pos = $page * $size;

        // model获取数据
        $this->load->model('category_model', 'category');
        $categoryList = $this->category->lists($pos, $size);
        $count = $this->category->count_category();

        // 构造返回格式
        $list = [
            'list' => $categoryList,
            'count' => $count,
        ];
        $data = [
            'code' => 0,
            'data' => $list,
            'msg'  => '',
        ];
        echo json_encode($data);
    }

    /*
     * 分类页面显示
     */



}


