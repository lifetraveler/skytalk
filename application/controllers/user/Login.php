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
        $name = $this->input->post_get('name');
        $pwd = $this->input->post_get('pwd');
        $email = $this->input->post_get('email');
        $data = $this->user->getUser($name);
        //var_dump($data);
        $hashedPWD = $data->USER_PWD;
        $salt = $data->USER_SALT;

        if (verifyPWD($pwd,$hashedPWD,$salt)) {
            //密码校验通过后，分配session
            $logindata = array(
                'name' => $name,
                'email' => $email,
                'logged_in' => true
            );
            $this->session->set_userdata($logindata);
            //            var_dump($_SESSION);
            $this->load->helper('cookie');

            $data = array(
                "errorcode" => '0000',
                "message" => '登陆成功'
            );
        } else
        {
            $logindata = array(
                'name' => $name,
                'email' => $email,
                'logged_in' => false
            );
            $this->session->set_userdata($logindata);
            //            var_dump($_SESSION);
            $data = array(
                "errorcode" => '0001',
                "message" => '密码错误,登陆失败'
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

//      安全过滤
//      $request = $this->security->xss_clean($request);
//      $session = $this->security->xss_clean($session);
//      $name=$request['name'];
//      $pwd=$request['pwd'];
//      采用ci的输入类直接获取，第二个参数true，进行xss过滤，等于上卖弄的xss_cleans
        $name=$this->input->post('name',true);
        $pwd=$this->input->post('pwd',true);
        $email=$this->input->post('email',true);
        $mobile=$this->input->post('mobile',true);
        //进行用户校验，是否存在
       // var_dump($_SESSION);
        $count=$this->user->search($name);
        //echo "pwd=".$pwd;
        if ($count>0)
        {
            $data=array(
                "errorcode"=>'0001',
                "message"=>'已经存在此用户名'
            );
        }else
        {
            //当php版本大于等于5.5的时候，密码hash用新的hash函数
            if(version_compare(PHP_VERSION, '5.5.0') >= 0)
            {
                $options = array(
                    'cost' => 12
                );
                $hashedPWD=password_hash($pwd,PASSWORD_DEFAULT,$options);
                $salt='';

            }else
            {
                //用旧的
                $salt=base64_encode(mcrypt_create_iv(32,MCRYPT_DEV_RANDOM));
                $hashedPWD=hash('sha256',$pwd.$salt);

            }
            //echo "hashedPWD=".$hashedPWD."\n";
            $user=new E_LT_SYS_USER;
            //参数赋值给对象，传入model
            $user->setUSERNAME($name);
            $user->setUSERPWD($hashedPWD);
            $user->setUSERSALT($salt);
            $user->setUSEREMAIL($email);
            $user->setUSERMOBILE($mobile);
            $data=$this->user->register($user);
        }
        $this->output->set_content_type('application/json');
        $this->output->set_header("Access-Control-Allow-Headers: Content-type");
        $this->output->set_header("Access-Control-Allow-Origin", "*");
        $this->output->set_header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
        $this->output->set_output(json_encode($data));//->_display();
    }

    public function verifyPWD($pwd,$hashedPWD,$salt){
        $verified=false;

        if(version_compare(PHP_VERSION, '5.5.0')>= 0)
        {
            if (password_verify($pwd, $hashedPWD))
            {
                $verified=true;
            }
        }
        else
        {
            if($hashedPWD==hash('sha256',$pwd.$salt))
            {
                $verified=true;
            }
        }

        return $verified;
    }
}