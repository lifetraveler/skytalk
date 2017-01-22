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

    public function get_TargetArticle($userid="1"){
        //选择数据库
        $this->db->db_select('u632335946_main');
        //采用ci的查询构造器方法
        $query = $this->db->get_where('lt_talk_main', array('M_Userid_FK' => $userid));
        //
        return $query->result();
    }


    public function get_talk($userid="1",$articleid ="1",$typeid="1"){
        //选择数据库
        $this->db->db_select('u632335946_main');
        //根据入参个数来处理不同的业务
        switch (func_get_args())  // 通过function_num_args()函数计算传入参数的个数，根据个数来判断接下来的操作
        {
            case 1:
                $query = get_talk_data1($userid);
                //$query = $this->db->get_where('lt_talk_main', array('M_Userid_FK' => $userid));
                break;
            case 2:
                $query = get_talk_data2($userid, $articleid);
                break;
            case 3:
                $query = get_talk_data3($userid, $articleid, $typeid);
                break;
        }
        //
        return $query->result();
    }

    private function get_talk_data1($userid)
    {
        //采用ci的查询构造器方法
        $query = $this->db->get_where('lt_talk_main', array('M_Userid_FK' => $userid));
        return  $query;

    }

    private function get_talk_data2($userid,$articleid)
    {
        //采用ci的查询构造器方法
        $query = $this->db->get_where('lt_talk_main', array('M_Userid_FK' => $userid,'M_Id'=>$articleid));
        return  $query;

    }

    private function get_talk_data3($userid, $articleid, $typeid)
    {
        //采用ci的查询构造器方法
        $query = $this->db->get_where('lt_talk_main', array('M_Userid_FK' => $userid,'M_Id'=>$articleid,'M_Type_fk'=>$typeid));
        return  $query;

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