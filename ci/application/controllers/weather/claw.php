<?php
/**
 *
 * 抓取天气信息的爬虫
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/5/9
 * Time: 上午8:15
 */
require_once __DIR__ . '/../../../../mysql/Db.php';

class Claw
{
    public function __construct()
    {
        $this->db = new  Db('weather');
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

    /**
     *  获取城市列表
     */
    public function getCity()
    {
        $sql = sprintf("select code,city from city");
        $cityInfo = $this->db->query($sql)->fetch_all();
        /**
         *  [0]=>
        string(9) "101340201"
        [1]=>
        string(6) "高雄"
         */
        foreach ($cityInfo as $city) {
            $this->weatherInfo($city['1'], $city['0']);
        }
        $city = [
            'data' => $cityInfo,
        ];
        return json_encode($city);
    }

    /**
     * @param $url
     * 抓去天气信息,存进数据库
     */
    public function weatherInfo($city, $code)
    {
        $db = new Db('weather');
        $cityUrl = 'http://www.weather.com.cn/weather/' . $code . '.shtml';
        $html = $this->curl($cityUrl);


        $startPos = strpos($html, '<ul class="t clearfix">');
        $endPos = strpos($html, '<em class="on">分时段预报</em>');
        $valuableContent = substr($html, $startPos, $endPos - $startPos - 25);
        $valuableContent = str_replace(['', "\n"], '', $valuableContent);
        $matchs = [];
        preg_match_all('(<li class.*?li>)', $valuableContent, $matchs);
        $weatherData = [];

        $days = 0;
        $pattern = '((<h1.*?</h1>).*(<p.*class="wea".*?</p>).*(<p class="tem".*?</p>).*(<p class="win".*?</p>))';


        foreach ($matchs[0] as $itemLine) {
            $lineMatch = [];
            $weatherOne = [];
            $ret = preg_match_all($pattern, $itemLine, $lineMatch);
            if (!$ret) {
                echo "正在匹配出错\n";
                file_put_contents('/tmp/weather.error.log', date('Y-m-d H:i:s') . " 正在匹配出错:{$city} {$pattern}\n", FILE_APPEND);
                continue;
            }

            for ($i = 1; $i < 5; $i++) {
                $weatherOne[] = strip_tags($lineMatch[$i][0]);
            }
            $weatherOne[0] = date('Y-m-d', time() + $days++ * 86400);

            $weatherData[] = $weatherOne;
        }

        foreach ($weatherData as $value) {
//            $db = new Db('weather');
            $deleteSql = sprintf(
                "delete from weatherInfo where city='%s' and the_day='%s'",
                $city, $value[0]);
            $ret = $db->query($deleteSql);
            if (!$ret) {
                echo "删除出错\n";
                file_put_contents('/tmp/weather.error.log', date('Y-m-d H:i:s') . " 正在匹配出错:{$city} {$pattern}\n", FILE_APPEND);
            }
            $sql = sprintf("insert into weatherInfo 
                    values (null, '%s','%s', '%s', '%s', '%s')",
                $city, $value[0], $value[1], $value[2], $value[1], $value[3]);
            $ret = $db->query($sql);

            // select update/insert
        }

    }

    /**
     * @param $city
     * @return mixed
     *  获取城市信息
     */
    public function getWeather($city)
    {
        $sql = sprintf("select * from weatherInfo where city='%s'", $city);
        $cityWeather = $this->db->query($sql)->fetch_row();
        $weather = [
            'data' => $cityWeather,
        ];
        return json_encode($weather);
    }


    /**
     * @param $url
     * 抓去天气信息,存进数据库
     */
    public function fetchWeatherInfo($code)
    {
        $cityUrl = 'http://www.weather.com.cn/weather/' . $code . '.shtml';
        $html = $this->curl($cityUrl);


        $startPos = strpos($html, '<ul class="t clearfix">');
        $endPos = strpos($html, '<em class="on">分时段预报</em>');
        $valuableContent = substr($html, $startPos, $endPos - $startPos - 25);
        $valuableContent = str_replace(['', "\n"], '', $valuableContent);
        $matchs = [];
        preg_match_all('(<li class.*?li>)', $valuableContent, $matchs);
//        $pattern = '((<h1.*?</h1>).*(<p.*class="wea".*?</p>).*(<p class="tem".*?</p>).*(<p class="win".*?</p>))';


        return $matchs[0];
    }

}



