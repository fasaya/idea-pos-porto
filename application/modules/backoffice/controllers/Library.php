<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Library extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Library_model', 'Library');
    }

    public function index()
    {
        redirect('backoffice/library/lists');
    }

    //###########################################################
    // ITEM LIBRARY

    public function lists()
    {
        $data['title'] = 'Item Library';
        $data['email'] = $this->session->userdata('email');
        $data['log_stat'] = $this->session->userdata('log_stat');

        $cek = $this->Auth_model->validasi_role('b_library');
        if ($cek) {

            if ($data['log_stat']) {

                $main['category'] = $this->Library->get_category()->result();
                $main['outlet'] = $this->Library->get_outlet()->result();

                $data['nav'] = $this->Nav_model->get_navigation($data['email']);
                $this->load->view('v_header', $data);
                $this->load->view('library/item_library', $main);
                $this->load->view('v_footer');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Please log in first!</div>');
                redirect('backoffice');
            }
        } else {
            //get data untuk navigation
            $data['nav'] = $this->Nav_model->get_navigation($data['email']);
            $this->load->view('v_header', $data);
            $this->load->view('unaccessible');
            $this->load->view('v_footer');
        }
    }

    function fetch_item()
    {
        if ($this->input->post('id_outlet') || $this->input->post('id_kategori') || $this->input->post('alert')) {
            echo $this->Library->fetch_item($this->input->post('id_outlet'), $this->input->post('id_kategori'), $this->input->post('alert'));
        }
    }
}
