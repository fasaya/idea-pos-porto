<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Library_model extends CI_Model
{

    function get_item($id_kategori = 'all', $alert = 'all')
    {
        $this->db->select("tb_product.nama as nama, tb_product_category.nama as kategori, tb_product.id_item");
        $this->db->from("tb_product, tb_product_category");
        $this->db->where("tb_product.id_kategori = tb_product_category.id_kategori");
        if ($id_kategori != 'all') {
            $this->db->where("tb_product.id_kategori = " . $id_kategori);
        }
        // if ($alert != 'all') {
        //     $this->db->where("tb_product.id_kategori = " . $id_kategori);
        // }
        $this->db->where("tb_product.is_deleted = '0'");
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

    function item_pricing_byID($id_item)
    {
        $query = $this->db->query(" SELECT id_item
                                    FROM tb_product_variant
                                    WHERE id_item = '" . $id_item . "' AND is_deleted = '0'");
        if ($query->num_rows() > 3) {
            return $query->num_rows() . " price available";
        } elseif ($query->num_rows() > 0 && $query->num_rows() <= 3) {
            $this->db->select("harga");
            $this->db->where("id_item", $id_item);
            $this->db->where("is_deleted", "0");
            $this->db->from("tb_product_variant");
            $this->db->order_by("id_variant", "ASC");
            $res = $this->db->get()->result();

            $opt = "";
            foreach ($res as $r) {
                $opt .= "IDR " . rupiah($r->harga) . ", ";
            }
            return substr($opt, 0, -2);
        } elseif ($query->num_rows() <= 0) {
            return "No price available";
        }
    }

    function get_item_variant_byID($id_item)
    {
        $this->db->select("tb_product_variant.nama, tb_product_variant.harga, tb_product_variant.id_variant");
        $this->db->from("tb_product_variant, tb_product");
        $this->db->where("tb_product.id_item", $id_item);
        $this->db->where("tb_product_variant.id_item = tb_product.id_item");
        $this->db->where("tb_product_variant.is_deleted", "0");
        $this->db->order_by("id_variant", "ASC");
        return $this->db->get()->result();
    }

    function get_item_outlet_byID($id_item)
    {
        $this->db->select("*");
        $this->db->from("tb_product_rel_outlet, tb_outlet");
        $this->db->where("id_item", $id_item);
        // $this->db->where("tb_product_rel_outlet.is_deleted", "0");
        $this->db->where("tb_outlet.id_outlet = tb_product_rel_outlet.id_outlet");
        $this->db->order_by("id_prd_rel_outlet", "ASC");
        return $this->db->get()->result();
    }

    function addItem($data)
    {
        //Start database transaction
        $this->db->trans_start();

        $data1 = [
            'id_kategori' => $data['id_kategori'],
            'nama' => $data['nama'],
            'is_deleted' => '0'
        ];
        $this->db->insert('tb_product', $data1);

        $id_item = $this->db->insert_id();

        $data2 = [
            'id_item' => $id_item,
            'nama' => $data['nama'],
            'harga' => $data['harga'],
            'is_deleted' => '0'
        ];
        $this->db->insert('tb_product_variant', $data2);

        //Start database transaction
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    Add new item failed!
                    </div>'
            );
            redirect('backoffice/library/lists');
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    New item added!
                    </div>'
            );
            redirect('backoffice/library/lists');
        }
    }

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

    function fetch_dataVariant($id_variant = "")
    {
        if ($id_variant != "") {

            $query1 = $this->db->query(" SELECT nama, harga
                                    FROM tb_product_variant
                                    WHERE id_variant = '" . $id_variant . "' AND is_deleted = '0'");
            if ($query1->num_rows() > 0) {
                $result = $query1->row_array();
                $nama = $result['nama'];
                $harga = $result['harga'];
                $output =
                    '<header class="card-header">
                        <h2 class="card-title">Edit Variant</h2>
                    </header>
                    <div class="card-body">
                        <form method="post" action="' . base_url() . 'backoffice/library/itemUpdateVar/' . $id_variant . '">
                            <div class="form-group">
                                <label>Variant Name</label>
                                <input type="text" class="form-control" placeholder="Variant Name" name="nama" value="' . $nama . '">
                            </div>
                            <div class="form-group">
                                <label>Price</label>
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <span class="input-group-text">
                                            ' . $this->Helper->setting("CURRENCY") . '
                                        </span>
                                    </span>
                                    <input type="number" name="price" class="form-control" placeholder="20000" value="' . $harga . '">
                                </div>
                            </div>
                            <div class="form-group float-right">
                            <button class="btn btn-primary" type="submit">Submit</button>
                            <button class="btn btn-default modal-dismiss">Close</button>
                            </div>
                        </form>
                    </div>';
            }
            return $output;
        }
    }

    function fetch_delItem($id_item = "")
    {
        if ($id_item != "") {

            $query1 = $this->db->query(" SELECT id_item
                                    FROM tb_product
                                    WHERE id_item = '" . $id_item . "'");
            if ($query1->num_rows() > 0) {
                $result = $query1->row_array();
                $id_item = $result['id_item'];
                $output =
                    '<header class="card-header">
                        <h2 class="card-title">Delete this item?</h2>
                    </header>
                    <div class="card-body">
                        <form method="post" action="' . base_url() . 'backoffice/library/itemDelete/' . $id_item . '">
                            <div class="form-group">
                                <h4>Are you sure you want to delete?</h4>
                            </div>
                            <div class="form-group float-right">
                                <button class="btn btn-danger" type="submit">Delete</button>
                                <button class="btn btn-default modal-dismiss">Close</button>
                            </div>
                        </form>
                    </div>';
            }
            return $output;
        }
    }



    // ####################################################################################################
    // Modifiers

    function get_modifiers()
    {
        $this->db->select("*");
        $this->db->from("tb_product_mod");
        $this->db->where("is_deleted", "0");
        $this->db->order_by("id_mod", "ASC");
        return $this->db->get()->result();
    }

    function get_mod_options_byID($id_mod)
    {
        $this->db->select("*");
        $this->db->from("tb_product_mod_opt");
        $this->db->where("id_mod", $id_mod);
        $this->db->where("is_deleted", "0");
        $this->db->order_by("id_mod_opt", "ASC");
        return $this->db->get()->result();
    }

    function get_mod_outlet_byID($id_mod)
    {
        $this->db->select("*");
        $this->db->from("tb_product_mod_rel_outlet, tb_outlet");
        $this->db->where("id_mod", $id_mod);
        // $this->db->where("tb_product_mod_rel_outlet.is_deleted", "0");
        $this->db->where("tb_outlet.id_outlet = tb_product_mod_rel_outlet.id_outlet");
        $this->db->order_by("id_mod_rel", "ASC");
        return $this->db->get()->result();
    }

    function mod_options_byID($id_mod)
    {
        $query = $this->db->query(" SELECT nama
                                    FROM tb_product_mod_opt
                                    WHERE id_mod = '" . $id_mod . "' AND is_deleted = '0'");
        if ($query->num_rows() > 3) {
            return $query->num_rows() . " options";
        } elseif ($query->num_rows() > 0 && $query->num_rows() <= 3) {
            $this->db->select("nama");
            $this->db->where("id_mod", $id_mod);
            $this->db->where("is_deleted", "0");
            $this->db->from("tb_product_mod_opt");
            $this->db->order_by("id_mod_opt", "ASC");
            $res = $this->db->get()->result();

            $opt = "";
            foreach ($res as $r) {
                $opt .= $r->nama . ", ";
            }
            return substr($opt, 0, -2);
        } elseif ($query->num_rows() <= 0) {
            return "No options yet";
        }
    }

    function mod_outlet_byID($id_mod)
    {
        $query = $this->db->query(" SELECT id_mod_rel
                                    FROM tb_product_mod_rel_outlet
                                    WHERE id_mod = '" . $id_mod . "' AND is_deleted = '0'");
        if ($query->num_rows() > 3) {
            return $query->num_rows() . " assigned outlets";
        } elseif ($query->num_rows() > 0 && $query->num_rows() <= 3) {
            $this->db->select("nama");
            $this->db->from("tb_product_mod_rel_outlet, tb_outlet");
            $this->db->where("id_mod", $id_mod);
            $this->db->where("tb_product_mod_rel_outlet.is_deleted", "0");
            $this->db->where("tb_outlet.id_outlet = tb_product_mod_rel_outlet.id_outlet");
            $this->db->order_by("id_mod_rel", "ASC");
            $res = $this->db->get()->result();

            $outlet = "";
            foreach ($res as $r) {
                $outlet .= $r->nama . ", ";
            }
            return substr($outlet, 0, -2);
        } elseif ($query->num_rows() <= 0) {
            return "No outlet assigned";
        }
    }

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

    function addModifier($data)
    {

        $this->db->insert('tb_product_mod', $data);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            New modifier added! You can now add the modifier options.
            </div>'
        );

        redirect('backoffice/library/modifiers');
    }
} //end model
