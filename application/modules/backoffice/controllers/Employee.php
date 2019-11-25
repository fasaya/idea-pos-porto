<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // $this->load->model('Nav_model');
        $this->load->model('EmpAccess_model', 'EmpAccess');
        $this->load->model('EmpSlot_model', 'EmpSlot');
        $this->load->model('Help_model', 'Helper');
        $this->load->library('form_validation');
    }

    public function index()
    {
        redirect('backoffice/employee/staff');
    }

    //###########################################################
    //EMPLOYEE SLOTS

    public function staff($status = 'active')
    {

        $main['outlet'] = $this->EmpSlot->get_outlet()->result();
        $main['role'] = $this->EmpAccess->get_role()->result();

        if ($status == 'inactive') {
            $main['opt'] = "Inactive Employee";
            $main['user'] = $this->EmpSlot->get_user_off()->result();
            $this->Helper->view('employee/employee_slots', $main, 'b_employee');
        } else {
            $main['opt'] = "Active Employee";
            $main['user'] = $this->EmpSlot->get_user()->result();
            $this->Helper->view('employee/employee_slots', $main, 'b_employee');
        }
    }

    public function add_user($status = 'active')
    {
        $this->form_validation->set_rules('nama', 'Full Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'valid_email|trim|required');
        $this->form_validation->set_rules('no_hp', 'Phone Number', 'trim|required|xss_clean|numeric');
        $this->form_validation->set_rules('id_role', 'Role Name', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('pin', 'PIN', 'trim|xss_clean');
        $this->form_validation->set_rules('id_outlet', 'Outlet', 'trim|required|xss_clean');
        $this->form_validation->set_rules('deskripsi', 'Description', 'trim|xss_clean');

        if ($this->form_validation->run() == false) {
            $this->staff();
        } else {
            $insert = [
                'id_role' => $this->input->post('id_role', TRUE),
                'email' => $this->input->post('email', TRUE),
                'nama' => $this->input->post('nama', TRUE),
                'phone' => $this->input->post('no_hp', TRUE),
                'pin' => "",
                'id_outlet' => $this->input->post('id_outlet', TRUE),
                'deskripsi' => $this->input->post('deskripsi', TRUE)
            ];
            $this->EmpSlot->add_user($insert);
        }
    }

    public function edit_slot($id_user = '0')
    {
        $isUserExist = $this->EmpSlot->isUserExist($id_user);
        if ($isUserExist) {

            //hanya employee yang dapat diedit datanya, user utama tidak bisa

            // $main['user'] = $this->EmpSlot->get_user()->result();
            $main['id_user'] = $id_user;
            $main['outlet'] = $this->EmpSlot->get_outlet()->result();
            $main['data_user'] = $this->EmpSlot->show_data_user($id_user);
            $main['role'] = $this->EmpAccess->get_role()->result();
            $main['user'] = $this->EmpSlot->get_assignedUser($id_user)->result();
            $main['btn'] = $this->EmpSlot->activate_button($id_user);

            $this->Helper->view('employee/employee_slots_edit', $main, 'b_employee');
        } else {
            $this->Helper->view('blank', '', 'b_employee');
        }
    }

    public function update_user($id_user, $id_login)
    {
        $this->form_validation->set_rules('email', 'Email', 'valid_email|trim|required');
        $this->form_validation->set_rules('id_role', 'Role Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('nama', 'Full Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('no_hp', 'Phone Number', 'trim|required|xss_clean|numeric');
        $this->form_validation->set_rules('check_pin', 'Checkbox', 'trim|xss_clean');
        $this->form_validation->set_rules('pin', 'PIN', 'trim|xss_clean|exact_length[4]|numeric');
        $this->form_validation->set_rules('deskripsi', 'Description', 'trim|xss_clean');

        if ($this->form_validation->run() == false) {
            $this->edit_slot();
        } else {
            $data = [
                'id_user' => $id_user,
                'id_login' => $id_login,
                'email' => $this->input->post('email', TRUE),
                'id_role' => $this->input->post('id_role', TRUE),
                'nama' => $this->input->post('nama', TRUE),
                'phone' => $this->input->post('no_hp', TRUE),
                'pin' => "",
                'deskripsi' => $this->input->post('deskripsi', TRUE)
            ];
            if ($this->input->post('check_pin', TRUE) == '1') {
                $data['pin'] = $this->input->post('pin', TRUE);
            }
            $this->EmpSlot->update_user($data);
        }
    }

    public function assign_employee($id_user)
    {
        $this->form_validation->set_rules('id_outlet', 'Outlet', 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {
            $this->edit_slot();
        } else {
            $assign = [
                'id_outlet' => $this->input->post('id_outlet', TRUE),
                'id_user' => $id_user
            ];
            $this->EmpSlot->assign_user($assign);
        }
    }

    public function unassign($id_user, $id_assignment)
    {
        $data = [
            'id_user' => $id_user,
            'id_assignment' => $id_assignment
        ];
        $this->EmpSlot->unassign_user($data);
    }

    public function deactivate($id_user)
    {
        $this->EmpSlot->deactivate_user($id_user);
    }

    public function reactivate($id_user)
    {
        $this->EmpSlot->reactivate_user($id_user);
    }

    //###########################################################
    // EMPLOYEE ACCESS

    public function access()
    {
        $main['role'] = $this->EmpAccess->get_role()->result();
        $this->Helper->view('employee/employee_access', $main, 'b_employee');
    }

    public function add_role()
    {
        $this->form_validation->set_rules('add_role_name', 'Role Name', 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {
            $this->access();
        } else {
            $add_role = [
                'name' => $this->input->post('add_role_name', TRUE),
                'is_deletable' => "1",
                'b_dashboard' => $this->Helper->checktonumber($this->input->post('b_dashboard')),
                'b_reports' => $this->Helper->checktonumber($this->input->post('b_reports')),
                'b_library' => $this->Helper->checktonumber($this->input->post('b_library')),
                'b_inventory' => $this->Helper->checktonumber($this->input->post('b_inventory')),
                'b_customer' => $this->Helper->checktonumber($this->input->post('b_customer')),
                'b_employee' => $this->Helper->checktonumber($this->input->post('b_employee')),
                'b_acc_setting' => $this->Helper->checktonumber($this->input->post('b_acc_setting'))
            ];
            $this->db->insert('tb_role', $add_role);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                New role added!
                </div>'
            );
            redirect('backoffice/employee/access');
        }
    }

    public function edit_access($id_role = '0')
    {

        $isRoleExist = $this->EmpAccess->isRoleExist($id_role);
        if ($isRoleExist) {

            $main['emp'] = $this->EmpAccess->get_assigned_employee($id_role)->result();
            $main['ea'] = $this->EmpAccess->get_emp_access($id_role);
            $main['id_role'] = $id_role;

            $this->Helper->view('employee/employee_access_edit', $main, 'b_employee');
        } elseif (!$isRoleExist) {
            $main['kosong'] = "";
            $this->Helper->view('blank', $main, 'b_employee');
        }
    }


    public function update_emp_access($id_role)
    {
        $this->form_validation->set_rules('edit_role_name', 'Role Name', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $this->edit_access($id_role);
        } else {

            if ($this->EmpAccess->isRoleEditable($id_role)) {

                $data = [
                    'name' => $this->input->post('edit_role_name', TRUE),
                    'is_deletable' => "1",
                    'b_dashboard' => $this->Helper->checktonumber($this->input->post('b_dashboard')),
                    'b_reports' => $this->Helper->checktonumber($this->input->post('b_reports')),
                    'b_library' => $this->Helper->checktonumber($this->input->post('b_library')),
                    'b_inventory' => $this->Helper->checktonumber($this->input->post('b_inventory')),
                    'b_customer' => $this->Helper->checktonumber($this->input->post('b_customer')),
                    'b_employee' => $this->Helper->checktonumber($this->input->post('b_employee')),
                    'b_acc_setting' => $this->Helper->checktonumber($this->input->post('b_acc_setting'))
                ];
                // $this->EmpAccess->update_access($id_role, $data);
                // $this->db->update('tb_role', $data);
                // $this->db->where('id_role', $id_role);
                $this->db->update('tb_role', $data, "id_role = " . $id_role);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Role access updated!</div>');
                redirect('backoffice/employee/edit_access/' . $id_role);
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">This role is uneditable!</div>');
                redirect('backoffice/employee/edit_access/' . $id_role);
            }
        }
    }

    public function delete_emp_access($id_role)
    {
        $this->EmpAccess->delete_access($id_role);
    }


    //###########################################################

    public function pin()
    {
        $main['role'] = $this->EmpAccess->get_role()->result();
        $this->Helper->view('employee/employee_pin', $main, 'b_employee');
    }
}
