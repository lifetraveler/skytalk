<?php
include_once("application\\models\\entities\E_LT_SYS_USER.php");

/**
 * Created by PhpStorm.
 * User: zhn
 * Date: 2017/2/6
 * Time: 14:56
 */
class Login extends CI_Controller
{
    protected $time;

    //登陆验证


    /**
     * Login constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user/usermodel','user');
        $this->load->helper('url_helper');
        //$this->load->liberary('')
        //$this->load->library('encryption');
    }

    public function login()
    {
        //$key = $this->encryption->create_key(16);
//        echo 1;
        $name=$this->input->post_get('name');
        $pwd=$this->input->post_get('pwd');
        $email=$this->input->post_get('email');
        $data=$this->user->getUser($name);
        //var_dump($data);
        $hashedPWD=$data->USER_PWD;
        if( password_verify($pwd,$hashedPWD))
        {
            //密码校验通过后，分配session
            $logindata=array(
                'name'=>$name,
                'email'=>$email,
                'logged_in'=>true
            );
            $this->session->set_userdata($logindata);
//            var_dump($_SESSION);
            $this->load->helper('cookie');

            $data=array(
                "errorcode"=>'0000',
                "message"=>'登陆成功'
            );
        }else
        {
            $logindata=array(
            'name'=>$name,
            'email'=>$email,
            'logged_in'=>false
        );
            $this->session->set_userdata($logindata);
//            var_dump($_SESSION);
            $data=array(
                "errorcode"=>'0001',
                "message"=>'密码错误,登陆失败'
            );
        }
        $this->output->set_content_type('application/json');
        $this->output->set_header("Access-Control-Allow-Headers: Content-type");
        $this->output->set_header("Access-Control-Allow-Origin", "*");
        $this->output->set_header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
        $this->output->set_output(json_encode($data));//->_display();

    }

    //注销
    public function logout()
    {

    }

    //注销
    public function getalluser()
    {
        $data=$this->user->getalluser();
        $this->output->set_content_type('application/json');
        $this->output->set_header("Access-Control-Allow-Headers: Content-type");
        $this->output->set_header("Access-Control-Allow-Origin", "*");
        $this->output->set_header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
        $this->output->set_output(json_encode($data));//->_display();

    }

    public function register()
    {
        $post=$_POST;
        var_dump($post);
//      安全过滤
//      $request = $this->security->xss_clean($request);
//      $session = $this->security->xss_clean($session);
//      $name=$request['name'];
//      $pwd=$request['pwd'];
//      采用ci的输入类直接获取，第二个参数true，进行xss过滤，等于上卖弄的xss_cleans
        $name=$this->input->post('name',true);
        $pwd=$this->input->post('pwd',true);
        echo "name=".$name;
        echo "pwd=".$pwd;
        //进行用户校验，是否存在
       // var_dump($_SESSION);
        $count=$this->user->search($name);
        //echo "count=".$count;
        if ($count>0)
        {
            $data=array(
                "errorcode"=>'0001',
                "message"=>'已经存在此用户名'
            );
        }else{
        $options = [
            'cost' => 12,
        ];
        $hashedPWD=password_hash($pwd,PASSWORD_DEFAULT,$options);
        $user=new E_LT_SYS_USER;
        //参数赋值给对象，传入model
        $user->setUSERNAME($name);
        $user->setUSERPWD($hashedPWD);
        $data=$this->user->register($user);
        //echo $hashedPWD."\n";
        }
        $this->output->set_content_type('application/json');
        $this->output->set_header("Access-Control-Allow-Headers: Content-type");
        $this->output->set_header("Access-Control-Allow-Origin", "*");
        $this->output->set_header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
        $this->output->set_output(json_encode($data));//->_display();
    }
}