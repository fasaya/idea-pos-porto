<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Outlet_model extends CI_Model
{

    function get_outlet()
    {
        return $this->db->select("*")
            ->from("tb_outlet")
            ->order_by("id_outlet", "ASC")
            ->get();
    }

    function update_outlet($id_outlet, $data)
    {
        $this->db->update('tb_outlet', $data, "id_outlet = " . $id_outlet);

        $this->session->set_flashdata('message', '<div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        Outlet updated!
        </div>');
        redirect('backoffice/outlets/editoutlets/' . $id_outlet);
    }

    function get_outlet_byid($id_outlet)
    {
        return $this->db->get_where('tb_outlet', ['id_outlet' => $id_outlet])->row_array();
    }

    function add_outlet($data)
    {
        $this->db->insert('tb_outlet', $data);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            New outlet added!
            </div>'
        );
        redirect('backoffice/outlets');
    }


    //######################################################################################################

    // COMBOBOX
    function fetch_provinsi()
    {
        return $this->db->select("*")
            ->from("provinsi")
            ->order_by("name", "ASC")
            ->get()
            ->result();
    }

    function fetch_kota($id_provinsi)
    {
        $query = $this->db->select("*")
            ->from("kota")
            ->order_by("name", "ASC")
            ->where("id_provinsi", $id_provinsi)
            ->get()
            ->result();

        $output = '<option value="">--- SELECT CITY/KABUPATEN ---</option>';

        foreach ($query as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->name . '</option>';
        }

        return $output;
    }

    function fetch_kecamatan($id_kota)
    {
        $query = $this->db->select("*")
            ->from("kecamatan")
            ->order_by("name", "ASC")
            ->where("id_kota", $id_kota)
            ->get()
            ->result();

        $output = '<option value="">--- SELECT KECAMATAN ---</option>';

        foreach ($query as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->name . '</option>';
        }

        return $output;
    }

    // FETCH BY ID_OUTLET
    function fetch_kota_byid($id_outlet)
    {
        $query1 = $this->db->query(" SELECT provinsi, kota
                                    FROM tb_outlet
                                    WHERE id_outlet = " . $id_outlet);
        $d = $query1->row_array();
        $id_provinsi = $d['provinsi'];
        $id_kota = $d['kota'];

        $query = $this->db->select("*")
            ->from("kota")
            ->order_by("name", "ASC")
            ->where("id_provinsi", $id_provinsi)
            ->get()
            ->result();

        $output = '<option value="">--- SELECT CITY/KABUPATEN ---</option>';

        foreach ($query as $row) {
            if ($row->id == $id_kota) {
                $selected = "selected";
            } else {
                $selected = "";
            }

            $output .= '<option value="' . $row->id . '"' . $selected . '>' . $row->name . '</option>';
        }

        return $output;
    }

    function fetch_kecamatan_byid($id_outlet)
    {
        $query1 = $this->db->query(" SELECT kota, kecamatan
                                    FROM tb_outlet
                                    WHERE id_outlet = " . $id_outlet);
        $d = $query1->row_array();
        $id_kota = $d['kota'];
        $id_kecamatan = $d['kecamatan'];

        $query = $this->db->select("*")
            ->from("kecamatan")
            ->order_by("name", "ASC")
            ->where("id_kota", $id_kota)
            ->get()
            ->result();

        $output = '<option value="">--- SELECT KECAMATAN ---</option>';

        foreach ($query as $row) {
            if ($row->id == $id_kecamatan) {
                $selected = "selected";
            } else {
                $selected = "";
            }

            $output .= '<option value="' . $row->id . '"' . $selected . '>' . $row->name . '</option>';
        }

        return $output;
    }

    //##############################################################################################

    function idtokota($id_kota)
    {
        $query = $this->db->query(" SELECT name
                                    FROM kota
                                    WHERE id = " . $id_kota);
        $dt = $query->row_array();

        echo $dt['name'];
    }

    function idtoprovinsi($id_provinsi)
    {
        $query = $this->db->query(" SELECT name
                                    FROM provinsi
                                    WHERE id = " . $id_provinsi);
        $dt = $query->row_array();

        echo $dt['name'];
    }

    function slctdOpt($id1, $id2)
    {
        if ($id1 == $id2) {
            echo "selected";
        }
    }
} //end model
