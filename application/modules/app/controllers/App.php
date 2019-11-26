<?php
defined('BASEPATH') or exit('No direct script access allowed');

class App extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('id_role');
        $this->session->unset_userdata('log_stat');

        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->load->view('login');
        } else {
            // $this->login();
        }
    }
}
