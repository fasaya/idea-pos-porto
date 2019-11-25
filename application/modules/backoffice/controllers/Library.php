<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Library extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Help_model', 'Helper');
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
        $main['category'] = $this->Library->get_category()->result();
        $main['outlet'] = $this->Library->get_outlet()->result();
        $main['items'] = $this->Library->get_item();
        $this->Helper->view('library/item_library', $main, 'b_library');
    }

    function fetch_item()
    {
        if ($this->input->post('id_outlet') || $this->input->post('id_kategori') || $this->input->post('alert')) {
            echo $this->Library->fetch_item($this->input->post('id_outlet'), $this->input->post('id_kategori'), $this->input->post('alert'));
        }
    }

    //###########################################################
    // Modifiers

    public function modifiers()
    {
        $main['outlet'] = $this->Library->get_outlet()->result();
        $this->Helper->view('library/modifiers', $main, 'b_library');
    }

    function fetch_modifiers()
    {
        if ($this->input->post('id_outlet')) {
            echo $this->Library->fetch_modifiers($this->input->post('id_outlet'));
        }
    }

    function addmodifier()
    {
        $this->form_validation->set_rules('nama', 'Modifier Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('id_outlet', 'Outlet', 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {

            $this->modifiers();
        } else {
            if (isset($_POST['saveall'])) {
                $add = [
                    'nama' => $this->input->post('nama', TRUE)
                ];
                $this->Library->addModifier('saveall', $add);
            } elseif (isset($_POST['save'])) {
                $add = [
                    'id_outlet' => $this->input->post('id_outlet', TRUE),
                    'nama' => $this->input->post('nama', TRUE)
                ];
                $this->Library->addModifier('save', $add);
            }
        }
    }
}
