<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/5/20
 * Time: 下午12:30
 */
require_once './Word_script.php';
require_once '../mysql/Db.php';

class Work_consumer
{
    public function __construct()
    {
        $this->script = new Word_script();
        $this->db = new Db('beibei');
    }

    public function sentence($word)
    {
        $url = "http://www.youdao.com/w/$word/#keyfrom=dict2.top";
        $html = $this->script->curl($url);
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
