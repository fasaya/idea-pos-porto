<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Backoffice extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        // $this->load->model('Auth_model', 'Auth');
    }

    public function index()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('log_type');

        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->load->view('login');
        } else {
            $this->login();
        }
    }

    private function login()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('log_type');

        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('tb_login', ['email' => $email])->row_array();

        //contoh password hash
        //nanti pas register dikasih password_hash($pass1, $pass2)
        //trus yang passdrdb ganti dgn $user['pwd']
        $passdrdb = password_hash($user['pwd'], PASSWORD_DEFAULT);

        //cek jika user terdaftar
        if ($user) {
            //cek apabila user aktif
            if ($user['is_active'] == 1) {
                //cek apabila password benar
                // if (password_verify($password, $user['pwd']){}
                if (password_verify($password, $passdrdb)) {
                    //cek role
                    $id_role = $user['id_role'];
                    $cek_role = $this->db->get_where('tb_role', ['id_role' => $id_role])->row_array();

                    //new session
                    $new_session = [
                        'email'     => $user['email'],
                        'id_role' => $id_role,
                        'log_stat' => TRUE
                    ];
                    $this->session->set_userdata($new_session);

                    //insert ke tabel login_history
                    $timezone = new DateTimeZone('Asia/Makassar');
                    $dt = new DateTime();
                    $dt->setTimeZone($timezone);
                    $date = $dt->format('Y-m-d H:i:s');

                    $data = [
                        'email' => $user['email'],
                        'date' => $date
                    ];
                    $this->db->insert('login_history', $data);

                    redirect('backoffice/dashboard');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
                    redirect('backoffice');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Please verify your email!</div>');
                redirect('backoffice');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered!</div>');
            redirect('backoffice');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('log_type');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out!</div>');
        redirect('backoffice');
    }
}
