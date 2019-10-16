<?php
defined('BASEPATH') or exit('No direct script access allowed');

class App extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['isi'] = "Ini APP";
        $this->load->view('v_show', $data);
    }

    public function test()
    {
        $data['isi'] = "Ini APP test";
        $this->load->view('v_show', $data);
    }
}
