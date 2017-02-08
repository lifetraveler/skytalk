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

    public function login($name,$pwd,$email)
    {
        //$key = $this->encryption->create_key(16);

        $data=$this->user->login($name,$email);
        $hashedPWD=$data['PWD'];
        if( password_verify($pwd,$hashedPWD))
        {
            $this->output->set_content_type('application/json');
            $this->output->set_header("Access-Control-Allow-Headers: Content-type");
            $this->output->set_header("Access-Control-Allow-Origin", "*");
            $this->output->set_header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
            $this->output->set_output(json_encode($data));//->_display();
        }else
        {
        }


    }

    //注销
    public function logout()
    {

    }

    public function register()
    {
        //new User

        $request=$_GET;

        //$session=$_SESSION;
        //安全过滤
        $request = $this->security->xss_clean($request);
        //$session = $this->security->xss_clean($session);
        $name=$request['name'];
        $pwd=$request['pwd'];
        //echo $this->input->post['pwd'];
        //进行用户校验，是否存在

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