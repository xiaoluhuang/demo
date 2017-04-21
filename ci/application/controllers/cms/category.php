<?php

/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/4/19
 * Time: 下午12:46
 */
class  Category extends MY_controller
{

    public function __construct()
    {
        parent::__construct();

    }

    /*
    * 显示专栏
    */
    public function index()
    {
        $category = $this->cate->get_category();
        $count = $this->cate->count_category();
        $data = [
            'count' => $count,
            'category' => $category,
        ];
//        var_dump($data);die;
        $this->load->view('cms/admin-category.html', $data);
    }
    /*
     * 新增专栏
     */
    public function add_category()
    {

        $this->load->view('cms/admin-category.html');
    }

    public function add()
    {
        $category = [
            'category' => $this->input->post('category'),
        ];
        $this->cate->add_category($category);
        success('cms/category/index', '栏目增加成功');
    }

    /*
     * 删除专栏
     */
    public function delete_category()
    {
        $category_id = $this->uri->segment(4);
//        var_dump($category_id);die;
        $this->cate->delete_category($category_id);
        success('cms/category/index', '专栏删除成功');
    }

    /*
     * 修改专栏,先获取原来的内容,然后再修改
     */
    public function edit_category()
    {
        $category_id = $this->uri->segment(4);
        $category['category'] = $this->cate->get($category_id);
//        var_dump( $category_id,$category);die;
//        $data= ['category'=> $category];
//        var_dump($data);die;

        $this->load->view('cms/admin-edit-category.html',$category);
//        $this->cate->edit_category($category_id,$category);
    }

    public function edit()
    {
        $name = $this->input->post('category');
        $category_id = $this->input->post('category_id');
        $category =[
            'category' => $name,
        ];
        $this->cate->edit_category($category_id,$category);
        success('cms/category/index','修改成功');
    }
}













