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
            $this->login();
        }
    }

    private function login()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('id_role');
        $this->session->unset_userdata('log_stat');

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

                    $data = [
                        'email' => $user['email'],
                        'ip_address' => $this->getRealIP(),
                        'user_agent' => $_SERVER['HTTP_USER_AGENT'],
                        'date' => new_date()
                    ];
                    $this->db->insert('login_history', $data);

                    redirect('app/home');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
                    redirect('app');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Please verify your email!</div>');
                redirect('app');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered!</div>');
            redirect('app');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('id_role');
        $this->session->unset_userdata('log_stat');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out!</div>');
        redirect('app');
    }

    private function getRealIP()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) //CHEK IP YANG DISHARE DARI INTERNET  
        {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) //UNTUK CEK IP DARI PROXY  
        {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
}
