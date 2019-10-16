<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EmpAccess_model extends CI_Model
{
    function update_access($id_role, $data)
    {
        $this->db->update('tb_role', $data);
        $this->db->where('id_role', $id_role);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Role access updated!</div>');
        redirect('backoffice/employee/edit_access/' . $id_role);
    }

    function delete_access($id_role)
    {
        //cek apakah ada yang menggunakan role tsb
        $isUsed = $this->isRoleUsed($id_role);

        //cek apakah data deletable
        $isDeletable = $this->isRoleDeletable($id_role);

        if (!$isUsed) {
            if ($isDeletable) {
                $this->db->delete('tb_role', array('id_role' => $id_role));
                redirect('backoffice/employee/access');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">This is a special role and cannot be deleted by owner, because the employee page can only be accessed in this role.</div>');
                redirect('backoffice/employee/edit_access/' . $id_role);
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">This role cannot be deleted because it has been associated with one or several employees. Please first unassigned the employees and try again.</div>');
            redirect('backoffice/employee/edit_access/' . $id_role);
        }
    }



    //###############################################################

    function get_role()
    {
        return $this->db->select("*")
            ->from("tb_role")
            ->where("is_editable", '1')
            ->order_by("id_role", "ASC")
            ->get();
    }

    // function get_role_access($id_role)
    // {
    //     //get role
    //     $get_role = $this->db->get_where('tb_role', ['id_role' => $id_role])->row_array();

    //     $role['name'] = $get_role['name'];
    //     $role['type'] = $get_role['type'];
    //     $role['reports'] = $get_role['reports'];
    //     $role['reports_a'] = $get_role['role2'];
    //     $role['reports_b'] = $get_role['role3'];
    //     // $role['reports_c'] = $get_role['name'];

    //     return $role;
    // }

    function get_emp_access($id_role)
    {
        //get role
        return $this->db->get_where('tb_role', ['id_role' => $id_role])->row_array();

        // $role['name'] = $get_role['name'];
    }

    function count_role_access($id_role)
    {
        //get role
        $role = $this->db->get_where('tb_role', ['id_role' => $id_role])->row_array();

        $hitung_role =
            intval($role['b_dashboard']) +
            intval($role['b_reports']) +
            intval($role['b_library']) +
            intval($role['b_inventory']) +
            intval($role['b_customer']) +
            intval($role['b_employee']) +
            intval($role['b_acc_setting']);

        return $hitung_role;
    }

    function get_assigned_employee($id_role)
    {
        return $this->db
            ->select("tb_user.nama, tb_login.email")
            ->from("tb_user, tb_login")
            ->where("tb_user.id_login=tb_login.id_login")
            ->where("tb_login.id_role", $id_role)
            // ->order_by("category", "ASC")
            ->get();
    }

    function count_assigned_employee($id_role)
    {
        $query = $this->db
            ->select("tb_role.id_role, tb_login.id_role")
            ->from("tb_role, tb_login")
            ->where("tb_role.id_role=tb_login.id_role")
            ->where("tb_role.id_role", $id_role);
        // ->order_by("category", "ASC")
        // ->get();
        $count = $query->count_all_results();

        if ($count > 0) {
            return $count . " Employee";
        } else {
            return "No employee assigned";
        }
    }

    function isRoleExist($id_role)
    {
        $query = $this->db->get_where('tb_role', array(
            'id_role' => $id_role
        ));

        //counting result from query
        $count = $query->num_rows();

        if ($count > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function isRoleUsed($id_role)
    {
        //cek apakah ada yang menggunakan role tsb
        $query = $this->db->get_where('tb_login', ['id_role' => $id_role]);
        $count = $query->num_rows();
        if ($count > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function isRoleDeletable($id_role)
    {
        //cek apakah role tersebut deletable
        $query = $this->db->get_where('tb_role', ['id_role' => $id_role])->row_array();
        $cek = $query['is_deletable'];
        if ($cek == "1") {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function isRoleEditable($id_role)
    {
        //cek apakah role tersebut deletable
        $query = $this->db->get_where('tb_role', ['id_role' => $id_role])->row_array();
        $cek = $query['is_editable'];
        if ($cek == "1") {
            return TRUE;
        } else {
            return FALSE;
        }
    }
} 
//end model
