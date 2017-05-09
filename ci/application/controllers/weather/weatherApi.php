<?php

/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/5/8
 * Time: 下午5:58
 */
class weatherApi
{
    public $weatherUrl = 'http://www.weather.com.cn/data/sk/101110101.html';

    public function getWeather($city)
    {
        $paramsArray = [
            'cityname' => $city,
        ];
        $params = http_build_query($paramsArray);
        $content = $this->curl($this->weatherUrl, $params);
        return $this->returnArray($content);

    }

    public function curl($url, $params = false, $ispost = 0)
    {
//        $httpInfo = array();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.157 Safari/537.36');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($ispost) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_URL, $url);
        } else {
            if ($params) {
                curl_setopt($ch, CURLOPT_URL, $url . '?' . $params);
            } else {
                curl_setopt($ch, CURLOPT_URL, $url);
            }
        }
        $response = curl_exec($ch);
        if ($response === FALSE) {
            echo "cURL Error: " . curl_error($ch);
            return false;
        }
//        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//        $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
//        curl_close($ch);
        return $response;
    }

    public function returnArray($content){
        return json_decode($content,true);
    }
}