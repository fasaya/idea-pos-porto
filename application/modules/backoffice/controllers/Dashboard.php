<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->model('Nav_model');
    }

    public function index()
    {
        $cek = $this->Auth_model->validasi_role('b_dashboard');

        $data['title'] = 'Dashboard';

        $data['email'] = $this->session->userdata('email');
        $data['log_stat'] = $this->session->userdata('log_stat');

        if ($cek) {

            // $user = $this->db->get_where('tb_login', ['email' => $this->session->userdata('email')])->row_array();
            /*tulis ini di view <?=$user['email'];?>*/

            //get id_role
            // $id_role = $user['id_role'];
            // $data['role'] = $this->db->get_where('tb_role', ['id_role' => $id_role])->row_array();

            if ($data['log_stat']) {
                //get data untuk navigation
                $data['nav'] = $this->Nav_model->get_navigation($data['email']);
                // $data['menu1'] = $nav['reports'];
                $this->load->view('v_header', $data);
                $this->load->view('dashboard');
                $this->load->view('v_footer');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Please log in first!</div>');
                redirect('auth');
            }
        } else {
            //get data untuk navigation
            $data['nav'] = $this->Nav_model->get_navigation($data['email']);
            // $data['menu1'] = $nav['reports'];
            $this->load->view('v_header', $data);
            $this->load->view('unaccessible');
            $this->load->view('v_footer');
        }
    }
}
