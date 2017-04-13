<?php

/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/3/21
 * Time: 下午3:38
 */
class Blog_model extends CI_Model
{

    public $title;
    public $content;
    public $quote;
    public $author_id;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        // Your own constructor code
    }

    public function getList()
    {
        $query = $this->db->query('SELECT id, title, updated_at FROM blog');
        //var_dump($query);

        return $query->result_array();

    }

    public function one($id)
    {

        $sql = "SELECT * FROM blog WHERE id = ? ";
        $query = $this->db->query($sql, array($id));
        return $query->row_array();
    }

    public function getComments($id)
    {
        $sql = "SELECT * FROM comments WHERE blog_id = ? ";
        $query = $this->db->query($sql, array($id));
        return $query->result_array();
    }

}
