<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/6/14
 * Time: 下午5:13
 */
require_once "general.php";
require_once "claw.php";

class weather extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $claw = new Claw();

    }

    public function index()
    {
        // 取到的是id,要根据id去找对应的值
        $city_id = $this->input->post('las_sel');
        $city = $this->getCity($city_id);
        $data = $this->claw->getWeahter($city);
        $this->load->view('weather/index',$data);

    }

    public function getCity($city_id)
    {
        require_once __DIR__ . '/../../../../mysql/Db.php';
        $db = new DB('weather');
        $sqlP = sprintf('select distinct province from city');
        $sqlC = sprintf('select city from city');
        $city = $db->query($sqlC)->fetch_all();
        $province = $db->query($sqlP)->fetch_all();
        $name_array = [];
        foreach ($province as $p) {
            $name_array[] = $p[0];
        }
        foreach ($city as $c) {
            $name_array[] = $c[0];
        }
        return $name_array[$city_id-1];
    }


}
