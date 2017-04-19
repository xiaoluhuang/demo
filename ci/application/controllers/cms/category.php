<?php

/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/4/19
 * Time: 下午12:46
 */
class  Category extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('cms_category_model', 'cms');
        $this->load->helper('form');

    }

    /*
    * 显示专栏
    */
    public function index()
    {
        $category = $this->cms->get_category();
        $count = $this->cms->count_category();
        $data = [
            'count' => $count,
            'category' => $category,
        ];
//        var_dump($data);die;
        $this->load->view('cms/admin-support-cat.html', $data);
    }
    /*
     * 新增专栏
     */
    public function add_category()
    {

        $this->load->view('cms/admin-support-cat.html');
    }

    public function add()
    {
        $category = [
            'category' => $this->input->post('category'),
        ];
        $this->cms->add_category($category);
        success('cms/category/index', '栏目增加成功');
    }

    /*
     * 删除专栏
     */
    public function delete_category()
    {
        $category_id = $this->uri->segment(4);
//        var_dump($category_id);die;
        $this->cms->delete_category($category_id);
        success('cms/category/index', '专栏删除成功');
    }

    /*
     * 修改专栏,先获取原来的内容,然后再修改
     */
    public function edit_category()
    {
        $category_id = $this->uri->segment(4);
        $category['category'] = $this->cms->get($category_id);
//        var_dump( $category_id,$category);die;
//        $data= ['category'=> $category];
//        var_dump($data);die;

        $this->load->view('cms/admin-support-edit-cat.html',$category);
//        $this->cms->edit_category($category_id,$category);
    }

    public function edit()
    {
        $name = $this->input->post('category');
        $category_id = $this->input->post('category_id');
        $category =[
            'category' => $name,
        ];
        $this->cms->edit_category($category_id,$category);
        success('cms/category/index','修改成功');
    }
}













