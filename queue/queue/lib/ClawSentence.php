<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/5/20
 * Time: 下午6:34
 */
namespace Queue\lib;

use Queue\lib\Db;

class ClawSentence
{
    public function __construct()
    {
        $this->db = new Db('beibei');
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
        return $response;
    }
    public function sentence($word)
    {
        $url = "http://www.youdao.com/w/$word/#keyfrom=dict2.top";
        $html = $this->curl($url);
        $startPos = strpos($html, '<!--例句选项卡 begin-->');
        $endPos = strpos($html, '<!--例句选项卡 end-->');
        $valuableContent = substr($html, $startPos + 600, $endPos - $startPos);
        $sent = trim(strip_tags($valuableContent));
        $allSentence = preg_replace('/\s{2,}/', ' ', $sent);
        $sentencePos = strpos($allSentence, '。');
        $sentence = substr($allSentence, 0, $sentencePos);
        if (!$sentence) {
            file_put_contents('/tmp/weather.error.log', date('Y-m-d H:i:s') . " {$word}:例句抓取失败\n", FILE_APPEND);
        }
        $sql = sprintf('update word set sentence = "%s" where name = "%s"', $sentence, $word);
        $ret = $this->db->query($sql);
        if (!$ret) {
            file_put_contents('/tmp/weather.error.log', date('Y-m-d H:i:s') . " {$word}:例句插入失败\n", FILE_APPEND);
            return $ret;
        }
        return $ret;
    }

}