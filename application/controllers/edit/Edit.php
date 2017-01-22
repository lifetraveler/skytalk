<?php
/**
 * Created by PhpStorm.
 * User: zhn
 * Date: 2017/1/18
 * Time: 11:32
 */

header('Access-Control-Allow-Origin:*');
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit extends CI_Controller{

    /*
     * 默认构造器，这里面实现加载model层
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('edit/editmodel','editdb');
        $this->load->helper('url_helper');
    }

    public function index()
    {
//      echo 1;
//      $this->load->view('lifetraveler/index');
//        $data = $this->editdb->get_TargetArticle('1','');
        $data = $this->editdb->get_TargetArticle('1');
        $this->output->set_content_type('application/json');
        $this->output->set_header("Access-Control-Allow-Headers: Content-type");
        $this->output->set_header("Access-Control-Allow-Origin", "*");
        $this->output->set_header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
        $this->output->set_output(json_encode($data));//->_display();
    }

    public function read($articleid,$userid){

    }
}