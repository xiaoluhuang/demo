<?php

/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/5/7
 * Time: 下午12:35
 */

/**
 * Class Access
 *  access.log获取最高访问页面和pv,uv的方法
 */
class Access extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        header('Content-type: application/json');
    }

    /**
     * 获取访问量最高的url
     */
    public function index()
    {
        $data = [
            'code' => 0,
            'data' => [
                'apple' => [
                    'yinbiao' => 'apple',
                    'jieshi' => [
                        ['cixing' => 'n', 'liju' => 'xxx'],
                        ['cixing' => 'v', 'liju' => 'vvv'],
                        ['cixing' => 'adj', 'liju' => 'adj'],
                    ]
                ]
            ],
            'msg' => '',
        ];
        echo json_encode($data);
    }

    /**
     * 获取访问量最高的url
     */
    public function top_url()
    {
        $num = $this->input->get('num', 10);
        $this->load->model('access_log_model', 'access');
        $top = $this->access->topNUrl($num);
        $data = [
            'code' => 0,
            'data' => $top,
            'msg' => '',
        ];
        echo json_encode($data);
    }

    /**
     * 获取访问pvuv
     */
    public function pvuv()
    {
        $startDay = $this->input->get('startDay', 10);
        $endDay = $this->input->get('endDay', 10);
        $this->load->model('access_log_model', 'access');
        $top = $this->access->pvuv($startDay, $endDay);
        $data = [
            'code' => 0,
            'data' => $top,
            'msg' => '',
        ];
        echo json_encode($data);
    }
}
