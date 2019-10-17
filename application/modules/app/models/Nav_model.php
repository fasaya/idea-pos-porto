<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nav_model extends CI_Model
{

    function get_navigation($email)
    {
        // return $this->db->select("*")
        //     ->from("category")
        //     ->where("delete", '0')
        //     ->order_by("category", "ASC")
        //     ->get();

        //get id_role
        $user = $this->db->get_where('tb_login', ['email' => $email])->row_array();
        $id_role = $user['id_role'];

        //get role
        $get_role = $this->db->get_where('tb_role', ['id_role' => $id_role])->row_array();

        $role['name'] = $get_role['name'];
        // $role['type'] = $get_role['type'];
        $role['b_dashboard'] = $get_role['b_dashboard'];
        $role['b_reports'] = $get_role['b_reports'];
        $role['b_library'] = $get_role['b_library'];
        $role['b_inventory'] = $get_role['b_inventory'];
        $role['b_customer'] = $get_role['b_customer'];
        $role['b_employee'] = $get_role['b_employee'];
        $role['b_acc_setting'] = $get_role['b_acc_setting'];

        return $role;
    }
} //end model
