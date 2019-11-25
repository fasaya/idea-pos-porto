<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->model('Nav_model');
        $this->load->model('Help_model', 'Helper');
    }

    public function index()
    {
        $main['kosong'] = "";
        $this->Helper->view('dashboard', $main, 'b_dashboard');
    }
}
