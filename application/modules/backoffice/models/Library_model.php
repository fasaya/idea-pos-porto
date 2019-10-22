<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Library_model extends CI_Model
{
    function add_item()
    {
        // 
    }

    // ####################################################################################################

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
            <td class="actions-hover actions-fade text-center"><a href="<?= base_url() ?>backoffice/library/edit_item"><i class="fas fa-pencil-alt"></i></a></td>
            </tr>';
        }

        return $output;
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
            ->order_by("id_outlet", "ASC")
            ->get();
    }
} //end model
