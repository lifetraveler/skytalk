<?php
/**
 * Created by PhpStorm.
 * User: zhn
 * Date: 2017/2/7
 * Time: 9:53
 */
Class usermodel extends CI_Model
{
    public function __construct(){
        $this->load->database();
        // echo $this->db;
        //选择数据库
    }

    public function login($name,$pwd)
    {
        $this->db->db_select('u632335946_main');
        $query = $this->db->get_where('lt_sys_user', array('USER_NAME' => $name,'USER_PWD'=>$pwd));
        return $query->result();
    }

}