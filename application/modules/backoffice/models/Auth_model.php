<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    //untuk validasi apa user dapat mengakses role tersebut
    function validasi_role($role)
    {
        // $role merupakan nama kolom pada tb_role

        $email = $this->session->userdata('email');

        if (isset($email)) {

            // get id_role
            $user = $this->db->get_where('tb_login', ['email' => $email])->row_array();
            $id_role = $user['id_role'];

            //get role
            $get_role = $this->db->get_where('tb_role', ['id_role' => $id_role])->row_array();

            $cek = $get_role[$role];

            if ($cek == '1') {
                return TRUE;
            } elseif ($cek == '0') {
                return FALSE;
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Please log in first!</div>');
            redirect('backoffice/backoffice');
        }
    }
} //end model
