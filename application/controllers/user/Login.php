<?php
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
        //$this->load->library('encryption');
    }

    public function login($name,$pwd)
    {
        //$key = $this->encryption->create_key(16);

        $data=$this->user->login($name,$pwd);
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


}