<?php

/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/5/7
 * Time: 下午4:19
 */
class Log extends CI_Controller
{
    public function top_url()
    {
        $num = $this->input->post_get('num');
        $data = [
            'num' => $num ?: 7,
        ];
        $query = http_build_query($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://ci.dev/api/access/top_url?" . $query);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        //执行并获取HTML文档内容
        $output = curl_exec($ch);
        $apiInfo = json_decode($output, true);
//        var_dump($apiInfo);die;
        //执行并获取HTML文档内容
        $this->load->view('access/topUrl.html', [
            'logList' => $apiInfo['data'],
        ]);
    }

    public function pvuv()
    {
        $startDay = $this->input->get('startDay');
        $endDay =  $this->input->get('endDay');
        var_dump($startDay,$endDay);
        $data = [
            'startDay' => $startDay ?: '2017-04-23' ,
            'endDay' => $endDay ? : '2017-04-28',
        ];
//        var_dump($data);die;
        $query = http_build_query($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://ci.dev/api/access/pvuv?".$query);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        //执行并获取HTML文档内容
        $output = curl_exec($ch);
        $pvuv = json_decode($output, true);
//        var_dump($pvuv);die;
        //执行并获取HTML文档内容
        $this->load->view('access/pvuv.html', [
            'pvuv' => $pvuv['data'],
        ]);
    }

}