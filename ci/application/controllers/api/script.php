<?php

/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/5/7
 * Time: 下午12:35
 */
class Script extends CI_Controller
{
    const ACCESS_LOG_FILE = '/usr/local/var/log/nginx/access.log';

    /**
     * 获取Access.log数据插入数据库
     */
    public function access()
    {
        if (!file_exists(self::ACCESS_LOG_FILE)) {
            echo '文件不存在';
            return false;
        }
        // 1.读取文件
        // a.file_get_contents
        // b.fopen
        $fp = fopen(self::ACCESS_LOG_FILE, 'rw');
        if ($fp===false || $fp===false) {
            return true;
        }
        $count = 0;
        while (!feof($fp)) {
            // 逐行格式化
            $line = trim(fgets($fp));
            if (!$line) {
                continue;
            }
            $lineInfo = explode(' ', $line);
            // time format 09/Mar/2017:09:00:36
            //             2017-03-09  09:00:36
            $localTime = $this->_formatLocalTime(trim($lineInfo[3], '['));
            $log = [
                'id' => null,
                'remote_addr' => $lineInfo[0],
                'time_local' => $localTime,
                'method' => trim($lineInfo[5], '"'),
                'request' => $lineInfo[6],
                'protocol' => trim($lineInfo[7], '"'),
                'status' => $lineInfo[8],
                'bytes_sent' => $lineInfo[9],
                'referer' => trim($lineInfo[10], '"'),
                'user_agent' => trim($lineInfo[11], '"'),
                'the_day' => substr($localTime, 0, 10)
            ];
            // 插入数据表
            $this->load->model('access_log_model', 'access');
            $this->access->insert($log);
            ++$count;
        }

        echo "共插入$count<BR>";
    }

    /**
     * @param $time
     * @return mixed
     */
    private function _formatLocalTime($time) {
        $month = substr($time, 3, 3);
        $mapping = [
            'Jan' => '01',
            'Feb' => '02',
            'Mar' => '03',
            'Apr' => '04',
            'May' => '05',
            'Jun' => '06',
            'Jul' => '07',
            'Aug' => '08',
            'Sep' => '09',
            'Oct' => '10',
            'Nov' => '11',
            'Dec' => '12',
        ];
        $month = isset($mapping[$month]) ? $mapping[$month] : '00';
        return sprintf('%d-%s-%s %s',
            substr($time, 7, 4), $month, substr($time, 0, 2), substr($time, 12)
        );
    }
}
