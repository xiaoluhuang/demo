<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/3/23
 * Time: 下午7:13
 */
defined('BASEPATH') OR exit('No direct scripted');

class Article extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('article_model', 'art');
        $this->load->model('category_model', 'cate');
    }

    /**
     * 查看文章
     */
    public function index()
    {
        //载入分页类配置项设置
        $this->load->library('pagination');
        $perPage = 3;
        $config['base_url'] = site_url('admin/article/index');
        $config['total_rows'] = $this->db->count_all_results('article');
        $config['per_page'] = $perPage;
        $config['uri_segment'] = 4;
//        $config['first_link'] = '第一页';
        $config['prev_link'] = '上一页';
        $config['next_link'] = '下一页';
//        $config['last_link'] = '最后一页';

        $this->pagination->initialize($config);
        //创建a连接
        $links = $this->pagination->create_links();
//        p($data);die;
//        p($links);die;
        $offset = $this->uri->segment(4);
        $this->db->limit($perPage, $offset);


        $article = $this->art->article_category();

        $this->load->view('admin/check_article.html', [
            'links' => $links,
            'article' => $article,
        ]);
    }

    /*
     * 发表文章模板
     */
    public function send_article()
    {
        $data['category'] = $this->cate->check();
        $this->load->helper('form');

//        $this->load->view('admin/head.html');
//        $this->load->view('admin/article_v2.html');
//        $this->load->view('admin/foot.html');
        $this->load->view('admin/article.html', $data);
    }

    /*
     * 发表文章动作
     */
    public function send()
    {
        /**
         * 文件上传----------------------------
         * 配置
         * //         */
//        $config['upload_path'] = './uploads/';
//        $config['allowed_types'] = 'gif|jpg|png|jpeg';
//        $config['max_size'] = '10000';
////        $config['max_width'] = '1024';
////        $config['max_height'] = '768';
//        $config['file_name'] = time() . mt_rand(1000, 9999);
//        //载入上传类
//        $this->load->library('upload',$config);
//        //执行上传
//        $status = $this->upload->do_upload('thumb');
//        //
////        if(!$status){
////            error('必须上传图片');
////        }
////
//        $wrong = $this->upload->dispaly_errors();
//        if($wrong){
//            error($wrong);
//        }
//        //返回信息
//        $info = $this->upload->data();


        //载入表单验证类
        $this->load->library('form_validation');
        //设置规则
//        $this->form_validation->set_rules('title', '文章标题', 'required|min_length[5]');
//        $this->form_validation->set_rules('type', '类型', 'required|integer');
//        $this->form_validation->set_rules('cid', '栏目', 'integer');
//        $this->form_validation->set_rules('info', '摘要', 'required|max_length[100]');
//        $this->form_validation->set_rules('content', '内容', 'required|max_length[2000]');


        //执行验证
        $status = $this->form_validation->run('article');
//        var_dump($status);
        if ($status) {
//            echo '数据库操作';
            $data = array(
                'title' => $this->input->post('title'),
                'type' => $this->input->post('type'),
                'cid' => $this->input->post('cid'),
//                'thumb' => $this->input->post('thumb'),
                'info' => $this->input->post('info'),
                'content' => $this->input->post('content'),
                'time' => time()
            );
//            p($data);die;
            $this->art->add($data);
            success('admin/article/index', '发布成功');


        } else {
            $this->load->helper('form');
            $this->load->view('admin/article.html');
        }


    }

    /*
    * 编辑文章
    */
    /**
     * @return object
     */
    public function edit_article()
    {
        $aid = $this->uri->segment(4);
        $article = $this->art->check_article($aid);
        $cname = $this->art->get_category($article['cid']);
//p($cname);die;
        $this->load->helper('form');
        $this->load->view('admin/edit_article.html', [
            'article' => $article,
            'cname' => $cname,
        ]);
    }

    /*
   * 编辑动作
   */
    public function edit()
    {
        $this->load->library('form_validation');
        $status = $this->form_validation->run('article');
//        $error = $this->form_validation->error_array();
//        var_dump($status,$error);die;
        if ($status) {
//            echo '数据库操作';
//            $aid = $this->input->post('aid');
            $info = $this->input->post('info');
            $aid = $this->uri->segment(4);
            $content = $this->input->post('content');
            $title = $this->input->post('title');
            $data = [
                'content' => $content,
                'info' => $info,
                'title' => $title
            ];
//            p($data);
            $article = $this->art->update_article($aid, $data);
//            p($article);die;
            success('admin/article/index', '修改成功');
        } else {
            $this->load->helper('form');
            $this->load->view('admin/edit_article.html');
        }
    }


    /*
     * 删除文章
     */
    public function del()
    {
        $aid = $this->uri->segment(4);
        $this->art->del($aid);
        success('admin/article/index', '删除成功');
    }
}