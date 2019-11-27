<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Help_model', 'Helper');
    }

    public function index()
    {
        $main['kosong'] = "";
        $this->Helper->view('home/home', $main, 'b_dashboard');
    }
}
