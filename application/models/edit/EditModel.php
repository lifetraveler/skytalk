<?php
/**
 * Created by PhpStorm.
 * User: zhn
 * Date: 2017/1/18
 * Time: 16:49
 */
Class EditModel extends CI_Model{

    public function __construct(){
        $this->load->database();
        // echo $this->db;
    }

    public function get_article($articleid ="1",$userid="1"){
        //选择数据库
        $this->db->db_select('u632335946_main');
        //采用ci的查询构造器方法
        $query = $this->db->get_where('main', array('user_id' => $userid,'id'=>$articleid));
        //
        return $query->result();
    }
    public function set_news()
    {
        $this->load->helper('url');

        $slug = url_title($this->input->post('title'), 'dash', TRUE);

        $data = array(
            'title' => $this->input->post('title'),
            'slug' => $slug,
            'text' => $this->input->post('text')
        );

        return $this->db->insert('news', $data);
    }
}