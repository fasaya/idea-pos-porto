<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Library_model extends CI_Model
{

    function get_item($id_outlet = '1', $id_kategori = 'all', $alert = 'all')
    {
        $this->db->select("tb_product.nama as nama, tb_product_category.nama as kategori");
        $this->db->from("tb_product, tb_product_category");
        $this->db->where("tb_product.id_kategori = tb_product_category.id_kategori");
        if ($id_kategori != 'all') {
            $this->db->where("tb_product.id_kategori = " . $id_kategori);
        }
        // if ($alert != 'all') {
        //     $this->db->where("tb_product.id_kategori = " . $id_kategori);
        // }
        $this->db->where("tb_product.id_outlet = " . $id_outlet);
        $this->db->order_by("tb_product.id_item", "ASC");
        return $this->db->get()->result();
    }

    function get_category()
    {
        return $this->db->select("*")
            ->from("tb_product_category")
            ->where("is_deleted", '0')
            ->order_by("id_kategori", "ASC")
            ->get();
    }

    function get_outlet()
    {
        return $this->db->select("id_outlet, nama")
            ->from("tb_outlet")
            ->where("is_active", '1')
            ->order_by("id_outlet", "ASC")
            ->get();
    }

    // ####################################################################################################
    // Item Library

    function fetch_item($id_outlet, $id_kategori, $alert)
    {
        $this->db->select("tb_product.nama as nama, tb_product_category.nama as kategori");
        $this->db->from("tb_product, tb_product_category");
        $this->db->where("tb_product.id_kategori = tb_product_category.id_kategori");
        if ($id_kategori != 'all') {
            $this->db->where("tb_product.id_kategori = " . $id_kategori);
        }
        // if ($alert != 'all') {
        //     $this->db->where("tb_product.id_kategori = " . $id_kategori);
        // }
        $this->db->where("tb_product.id_outlet = " . $id_outlet);
        $this->db->order_by("tb_product.id_item", "ASC");
        $query = $this->db->get()->result();


        $output = "";

        foreach ($query as $row) {
            $output .= '
            <tr>
            <td>' . $row->nama . '</td>
            <td>' . $row->kategori . '</td>
            <td></td>
            <td></td>
            <td></td>
            <td class="actions-hover actions-fade text-center"><a href="' . base_url() . 'backoffice/library/editItem"><i class="fas fa-pencil-alt"></i></a></td>
            </tr>';
        }

        return $output;
    }

    function add_item()
    {
        // 
    }



    // ####################################################################################################
    // Modifiers

    function fetch_modifiers($id_outlet)
    {
        $this->db->select("*");
        $this->db->from("tb_product_mod");
        $this->db->where("id_outlet = " . $id_outlet);
        $this->db->order_by("id_mod", "ASC");
        $query = $this->db->get()->result();


        $output = "";

        foreach ($query as $row) {
            $output .= '
            <tr>
            <td>' . $row->nama . '</td>
            <td></td>
            <td class="actions-hover actions-fade text-center"><a href="' . base_url() . 'backoffice/library/editModofier"><i class="fas fa-pencil-alt"></i></a></td>
            </tr>';
        }

        return $output;
    }

    function addModifier($tipe, $data)
    {
        // CONTOH
        // $array_values = "";
        // if (isset($_POST["input_array_name"]) && is_array($_POST["input_array_name"])) {
        //     $input_array_name = array_filter($_POST["input_array_name"]);
        //     foreach ($input_array_name as $field_value) {
        //         $array_values .= $field_value . "<br />";
        //     }
        // }
        // END CONTOH


        if ($tipe == "saveall") {
            $outlet = $this->get_outlet()->result();
            foreach ($outlet as $o) {
                $data['id_outlet'] = $o->id_outlet;
                $this->db->insert('tb_product_mod', $data);
            }
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            New modifier added to all! You can now add the modifier options.
            </div>'
            );
        } elseif ($tipe == "save") {
            $this->db->insert('tb_product_mod', $data);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            New modifier added! You can now add the modifier options.
            </div>'
            );
        }

        redirect('backoffice/library/modifiers');
    }
} //end model
