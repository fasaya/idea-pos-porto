<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Help_model extends CI_Model
{
    function view($view, $main, $validasi)
    {
        $header['title'] = 'Backoffice';
        $header['email'] = $this->session->userdata('email');
        $data['log_stat'] = $this->session->userdata('log_stat');
        $header['nav'] = $this->Nav_model->get_navigation($header['email']);

        $header['kosong'] = "";
        $main['kosong'] = "";

        $cek = $this->Auth_model->validasi_role($validasi);
        if ($cek) {

            if ($data['log_stat']) {
                $this->load->view('v_header', $header);
                $this->load->view($view, $main);
                $this->load->view('v_footer');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Please log in first!</div>');
                redirect('backoffice');
            }
        } else {
            $this->load->view('v_header', $header);
            $this->load->view('unaccessible');
            $this->load->view('v_footer');
        }
    }

    function check_log_stat()
    {
        $keterangan = $this->session->userdata('keterangan');

        if ($keterangan != 'member') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You have been logged out because your session is not valid.</div>');
            redirect('home');
        }
    }

    // #####################################

    function checktonumber($value)
    {
        //SYARAT: pada form value harus set 1
        if ($value == "1") {
            return "1";
        } else {
            return "0";
        }
    }

    function numbertocheck($value)
    {
        if ($value == "1") {
            return "checked";
        } else {
            return "";
        }
    }

    function setting($kode = null, $ket = "nilai")
    {
        //$ket dapat berupa 'nilai' atau 'status'
        $query = $this->db->query(' SELECT nilai, status
                                    FROM setting
                                    WHERE kode = "' . $kode . '" ');
        $result = $query->row_array();
        if ($result) {
            return $result[$ket];
        }
    }
} //end model
