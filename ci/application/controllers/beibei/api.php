<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/5/15
 * Time: 下午5:26
 */

/**
 * Class Api
 *  从数据库提取数据,展示到前台页面
 */
class Api extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('beibei_model','beibei');
    }

    // 展示阶段:小学,初中,高中,大学
    public function getPhase()
    {
        $phase = $this->beibei->getPhase();
        $data = [
            'phase' => $phase,
        ];
        $this->load->view('beibei/index.html',$data);
    }

}