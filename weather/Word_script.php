<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/5/14
 * Time: 上午10:34
 */

/**
 * 抓取单词和例句
 * 解释txt文件,获取到单词,并存入数据库
 */
require_once '../mysql/Db.php';

class Word_script
{
    const FILE = '/Users/huangxiaolu/Downloads/英语单词库.txt';

    public function __construct()
    {
        $this->db = new Db('beibei');
    }

    /**
     *  用curl打开网页信息
     */
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

    public function getWord()
    {
        if (!file_exists(self::FILE)) {
            file_put_contents('/tmp/error.beibei.log', date('Y-m-d H:i:s' . "打开文件" . self::FILE . "出错"));
            return false;
        }
        $fp = fopen(self::FILE, 'rw');
        if ($fp === false) {
            return false;
        }
        while (!feof($fp)) {
            $line = fgets($fp);
            $lineInfo = explode('[ ]', $line);
//            var_dump($lineInfo);
            foreach ($lineInfo as $one) {
                $oneLine = trim($one);
                $start = strpos($oneLine, '[');
                $end = strpos($oneLine, ']');
                $name = trim(substr($oneLine, 0, $start), "\xEF\xBB\xBF");
                $phonetic = substr($oneLine, $start, $end - $start + 1);
                $definition = substr($oneLine, $end + 1);
                if (!$name || !$phonetic || !$definition) {
                    continue;
                }
                $deleteSql = sprintf(
                    "delete from word where name='%s'",
                    $name);
                $ret = $this->db->query($deleteSql);
                $sql = sprintf('insert into word (name,phonetic,definition) VALUES ("%s","%s","%s")',
                    $name, $phonetic, $definition);
                $ret = $this->db->query($sql);
            }
        }
        return true;
    }

    /**
     *  抓取例句,并存入数据库
     */
    public function getSentence()
    {
        $sql = sprintf("select name from word");
        $allWord = $this->db->query($sql)->fetch_all();
        $count = 0;
        foreach ($allWord as $word) {

            $url = "http://www.youdao.com/w/$word[0]/#keyfrom=dict2.top";
            $html = $this->curl($url);
            $startPos = strpos($html, '<!--例句选项卡 begin-->');
            $endPos = strpos($html, '<!--例句选项卡 end-->');
            $valuableContent = substr($html, $startPos + 600, $endPos - $startPos);

//        // 正则匹配
//        $matchS = preg_match('<!--例句选项卡 begin-->', $html,$matchStart );
//        $matchE = preg_match('<a(.*)target=_blank rel="nofollow">(.+)</a>', $html,$matchEnd );
//        var_dump($matchE,$matchS);die;

            $sent = trim(strip_tags($valuableContent));
            $allSentence = preg_replace('/\s{2,}/', ' ', $sent);
            $sentencePos = strpos($allSentence, '。');
            $sentence = substr($allSentence, 0, $sentencePos);
            if (!$sentence) {
                file_put_contents('/tmp/weather.error.log', date('Y-m-d H:i:s') . " {$word[0]}:例句抓取失败\n", FILE_APPEND);
                $delSql = sprintf('delete from table word where name = "%s"', $word[0]);
                $this->db->query($delSql);
                continue;
            }
            // 存入数据库
            $sql = sprintf('update word set sentence = "%s" where name = "%s"', $sentence, $word[0]);
            $ret = $this->db->query($sql);
            if (!$ret) {
                file_put_contents('/tmp/weather.error.log', date('Y-m-d H:i:s') . " {$word[0]}:例句插入失败\n", FILE_APPEND);
            }
            var_dump($ret);
            ++$count;
        }
        echo "共插入$count<BR>";
    }

    /**
     * 给所有的版本里面插入单词
     */
    public function insertWord()
    {
        // 忘word_unit表里面插入unit_id 和word_id
        // 先取出所有的unit_id,做循环,把word_id打乱,每个unit_id插入4个单词
        $sql = sprintf('select id from unit');
        $allUnits = $this->db->query($sql)->fetch_all();
        if (!$allUnits) {
            echo '取unit失败';
            return false;
        }
        $count = 0;
        foreach ($allUnits as $unit) {
            for ($i = 0; $i < 4; $i++) {
                $word_id = rand(1, 1609);
//                $deleteSql = sprintf('delete from word_unit wher')
                $insertSql = sprintf('insert into word_unit (word_id,unit_id) values (%d,%d)',$word_id,$unit[0]);
                $ret = $this->db->query($insertSql);
                var_dump($insertSql,$ret);
                if (!$ret) {
                    echo $unit[0] . '插入失败';
                }

            }
            ++$count;
        }
        return  $count;
    }
}
