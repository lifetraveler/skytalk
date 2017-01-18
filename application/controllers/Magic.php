<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Magic extends CI_Controller {
    public function index()
    {
        //echo 1;
        $this->load->view('lifetraveler/index');
    }
}
