<?php
/**
 * Created by PhpStorm.
 * User: zhn
 * Date: 2017/1/18
 * Time: 11:32
 */
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
//        echo 1;
        //$this->load->view('lifetraveler/index');
        $data['news'] = $this->editdb->get_article(1,1);
        $string=implode(',',$data['news']);
        echo $string;
        //$this->load->view('news/index', $data);
    }

    public function read($articleid,$userid){

    }
}