<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Outlets extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Outlet_model', 'Outlet');
        $this->load->model('Help_model', 'Helper');
    }

    public function index()
    {
        $main['provinsi'] = $this->Outlet->fetch_provinsi();
        $main['outlet'] = $this->Outlet->get_outlet()->result();

        $this->Helper->view('setting/outlet', $main, 'b_acc_setting');
    }

    public function add()
    {
        $this->form_validation->set_rules('nama_outlet', 'Outlet Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('phone', 'Phone Number', 'trim|required|xss_clean|numeric');
        $this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
        $this->form_validation->set_rules('provinsi', 'Province', 'trim|required|xss_clean');
        $this->form_validation->set_rules('kota', 'City/Kabupaten', 'trim|required|xss_clean');
        $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'trim|required|xss_clean');
        $this->form_validation->set_rules('postal', 'Postal Code', 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {

            $this->index();
        } else {
            $data = [
                'is_active' => '1',
                'nama' => $this->input->post('nama_outlet', TRUE),
                'address' => $this->input->post('address', TRUE),
                'phone' => $this->input->post('phone', TRUE),
                'provinsi' => $this->input->post('provinsi', TRUE),
                'kota' => $this->input->post('kota', TRUE),
                'kecamatan' => $this->input->post('kecamatan', TRUE),
                'postal' => $this->input->post('postal', TRUE)
            ];
            $this->Outlet->add_outlet($data);
        }
    }

    public function editOutlets($id_outlet = '0')
    {
        $main['provinsi'] = $this->Outlet->fetch_provinsi();
        $main['outlet'] = $this->Outlet->get_outlet_byid($id_outlet);
        $main['id_outlet'] = $id_outlet;
        $this->Helper->view('setting/outlet_edit', $main, 'b_acc_setting');
    }

    public function update($id_outlet = '0')
    {
        $this->form_validation->set_rules('nama_outlet', 'Outlet Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('phone', 'Phone Number', 'trim|required|xss_clean|numeric');
        $this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
        $this->form_validation->set_rules('provinsi', 'Province', 'trim|required|xss_clean');
        $this->form_validation->set_rules('kota', 'City/Kabupaten', 'trim|required|xss_clean');
        $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'trim|required|xss_clean');
        $this->form_validation->set_rules('postal', 'Postal Code', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $this->editOutlets($id_outlet);
        } else {

            $data = [
                'is_active' => '1',
                'nama' => $this->input->post('nama_outlet', TRUE),
                'address' => $this->input->post('address', TRUE),
                'phone' => $this->input->post('phone', TRUE),
                'provinsi' => $this->input->post('provinsi', TRUE),
                'kota' => $this->input->post('kota', TRUE),
                'kecamatan' => $this->input->post('kecamatan', TRUE),
                'postal' => $this->input->post('postal', TRUE)
            ];
            $this->Outlet->update_outlet($id_outlet, $data);
        }
    }

    // #############################################

    function fetch_kota()
    {
        if ($this->input->post('id_provinsi')) {
            echo $this->Outlet->fetch_kota($this->input->post('id_provinsi'));
        }
    }

    function fetch_kecamatan()
    {
        if ($this->input->post('id_kota')) {
            echo $this->Outlet->fetch_kecamatan($this->input->post('id_kota'));
        }
    }

    function fetch_kota_byid()
    {
        if ($this->input->post('id_outlet')) {
            echo $this->Outlet->fetch_kota_byid($this->input->post('id_outlet'));
        }
    }

    function fetch_kecamatan_byid()
    {
        if ($this->input->post('id_outlet')) {
            echo $this->Outlet->fetch_kecamatan_byid($this->input->post('id_outlet'));
        }
    }
}
