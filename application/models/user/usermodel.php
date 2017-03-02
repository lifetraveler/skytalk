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

    public function getUser($name)
    {
        $this->db->db_select('u632335946_main');
        $query = $this->db->get_where('lt_sys_user', array('USER_NAME' => $name));
        return $query->row();
    }

    public function getalluser()
    {
        $this->db->db_select('u632335946_main');
        $this->db->select('USER_ID, USER_NAME, USER_PWD');
        $query = $this->db->get_where('lt_sys_user');
        return $query->result();
    }

    public function getuserbyid($id)
    {
        $this->db->db_select('u632335946_main');
        $this->db->select('USER_ID, USER_NAME, USER_PWD');
        $query = $this->db->get_where('lt_sys_user',array('USER_ID'=>$id));
        return $query->result();
    }

    public function register(E_LT_SYS_USER $obj)
    {

        $this->db->db_select('u632335946_main');
        if($obj->getUSERNAME() !='' && $obj->getUSERPWD() !='')
        {
           if($this->db->insert('lt_sys_user',$obj))
           {
               $result=array(
                    "errorcode"=>'0000',
                    "message"=>'插入成功',
                   "userid"=>$this->db->insert_id()
               );
           }else
           {
               $result=array(
                   "errorcode"=>'0001',
                   "message"=>'插入失败'
               );
           }

        }else
        {
            $result=array(
                "errorcode"=>'0001',
                "message"=>'姓名或者密码为空'
            );

        }
        return $result;

    }

public function search($name)
{
    $count=$this->db->where('USER_NAME',$name)->count_all_results('lt_sys_user');
    //echo $count;
    return $count;
}

    public function delUser()
    {

    }
}