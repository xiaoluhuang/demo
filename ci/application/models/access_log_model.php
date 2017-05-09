<?php

/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/5/7
 * Time: 下午12:36
 */
class Access_log_model extends CI_Model
{

    public function insert($log)
    {
        $this->db->insert('access_log', $log);
    }

    /**
     * @return mixed
     */
    public function topNUrl($num = 10)
    {
        $sql = sprintf("select request, count(id) cnt from access_log group by request order by cnt desc limit %d", $num);
        return $this->db->query($sql)->result_array();
    }

    /**
     * @return mixed
     */
    public function pvuv($startDay, $endDay)
    {
        $sql = sprintf("select the_day, count(*) pv, count(distinct remote_addr) uv from access_log"
            . " where time_local >= '%s' and time_local <= '%s'"
            . " group by the_day",
            $startDay, $endDay );
        return $this->db->query($sql)->result_array();
    }

}