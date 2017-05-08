<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
	    // magic number
        // 魔术数字 < 自由字符串 < 常量
	    $cache = new MY_Cache(MY_Cache::DRIVER_MEMCACHED);
	    $cache->set('cache', 'cache_value', 10);

		$this->load->view('welcome_message');

	}

}

/*
 * 添加action
 * 添加view
 * 添加controller
 * 添加model
 */