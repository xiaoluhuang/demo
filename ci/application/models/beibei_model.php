<?php

/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/5/15
 * Time: 下午5:32
 */
class beibei_model extends CI_Model
{
    public function getPhase()
    {
        $this->db->select('name');
        $query = $this->db->get('phase')->result_array();
        return $query;
    }
}