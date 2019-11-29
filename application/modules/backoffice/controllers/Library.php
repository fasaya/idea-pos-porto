<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Library extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Help_model', 'Helper');
        $this->load->model('Library_model', 'Library');
    }

    public function index()
    {
        redirect('backoffice/library/lists');
    }

    //###########################################################
    // ITEM LIBRARY

    public function lists()
    {
        // $this->form_validation->set_rules('id_outlet', 'Outlet', 'xss_clean');
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'xss_clean');

        $main['category'] = $this->Library->get_category()->result();
        $main['outlet'] = $this->Library->get_outlet()->result();

        if ($this->form_validation->run() == FALSE) {
            $main['items'] = $this->Library->get_item();
            $main['id_kategori'] = "";
            $this->Helper->view('library/item_library', $main, 'b_library');
        } else {
            $main['id_kategori'] = $this->input->post('id_kategori');

            $main['items'] = $this->Library->get_item($main['id_kategori']);
            $this->Helper->view('library/item_library', $main, 'b_library');
        }
    }

    public function additem()
    {
        $this->form_validation->set_rules('nama', 'Item Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('kategori', 'Category', 'trim|required|xss_clean');
        $this->form_validation->set_rules('harga', 'Price', 'trim|required|numeric|xss_clean');

        if ($this->form_validation->run() == false) {
            $this->lists();
        } else {
            $data = [
                'nama' => $this->input->post('nama', TRUE),
                'harga' => $this->input->post('harga', TRUE),
                'id_kategori' => $this->input->post('kategori', TRUE)
            ];
            $this->Library->addItem($data);
        }
    }

    public function edititem($id_item)
    {
        $query = $this->db->query(" SELECT id_item
                                    FROM tb_product
                                    WHERE id_item = '" . $id_item . "'");
        if ($query->num_rows() > 0) {
            $main['id_item'] = $id_item;
            $main['variant'] = $this->Library->get_item_variant_byID($id_item);
            $main['outlets'] = $this->Library->get_item_outlet_byID($id_item);
            $main['outletAssign'] = $this->Library->get_outlet()->result();
            $this->Helper->view('library/item_edit', $main, 'b_library');
        } else {
            redirect('backoffice/library/lists');
        }
    }

    function itemAddVar($id_item = "")
    {
        $this->form_validation->set_rules('nama', 'Variant Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('price', 'Price', 'trim|required|numeric|xss_clean');

        $query = $this->db->query(" SELECT id_item
                                    FROM tb_product
                                    WHERE id_item = '" . $id_item . "'");
        if ($query->num_rows() > 0) {

            if ($this->form_validation->run() == false) {

                $this->edititem($id_item);
            } else {
                $data = [
                    'id_item' => $id_item,
                    'nama' => $this->input->post('nama', TRUE),
                    'harga' => $this->input->post('price', TRUE),
                    'is_deleted' => "0"
                ];
                $this->db->insert('tb_product_variant', $data);
                $this->session->set_flashdata(
                    'message_1',
                    '<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    New variant added!
                    </div>'
                );
                redirect('backoffice/library/edititem/' . $id_item);
            }
        } else {
            redirect('backoffice/library/lists');
        }
    }

    function itemDelete($id_item)
    {
        // cek berapa isinya variant dari item itu
        $query1 = $this->db->query(" SELECT id_item
                                    FROM tb_product
                                    WHERE id_item = '" . $id_item . "'");
        if ($query1->num_rows() > 0) {
            //Start database transaction
            $this->db->trans_start();

            $data = [
                'is_deleted' => "1"
            ];
            $this->db->update('tb_product', $data, "id_item = '" . $id_item . "'");
            $this->db->update('tb_product_variant', $data, "id_item = '" . $id_item . "'");

            //Start database transaction
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    Item delete failed!
                    </div>'
                );
                redirect('backoffice/library/lists');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    Item deleted!
                    </div>'
                );
                redirect('backoffice/library/lists');
            }
        }
    }
    function itemDelVar($id_variant)
    {
        // cek berapa isinya variant dari item itu
        $query1 = $this->db->query(" SELECT id_item
                                    FROM tb_product_variant
                                    WHERE id_variant = '" . $id_variant . "'");
        if ($query1->num_rows() > 0) {
            $result1 = $query1->row_array();
            $id_item = $result1['id_item'];

            $data = [
                'is_deleted' => "1"
            ];
            $this->db->update('tb_product_variant', $data, "id_variant = '" . $id_variant . "'");

            $this->session->set_flashdata(
                'message_1',
                '<div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                Varian deleted!
                </div>'
            );
            redirect('backoffice/library/edititem/' . $id_item);
        }
    }

    function itemUpdateVar($id_variant)
    {
        $this->form_validation->set_rules('nama', 'Variant Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('price', 'Price', 'trim|required|numeric|xss_clean');

        $query = $this->db->query(" SELECT id_item
                                    FROM tb_product_variant
                                    WHERE id_variant = '" . $id_variant . "'");
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $id_item = $result['id_item'];
            if ($this->form_validation->run() == false) {
                $this->edititem($id_item);
            } else {
                $data = [
                    'nama' => $this->input->post('nama', TRUE),
                    'harga' => $this->input->post('price', TRUE)
                ];
                $this->db->update('tb_product_variant', $data, "id_variant = '" . $id_variant . "'");
                $this->session->set_flashdata(
                    'message_1',
                    '<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    Variant updated!
                    </div>'
                );
                redirect('backoffice/library/edititem/' . $id_item);
            }
        } else {
            redirect('backoffice/library/lists');
        }
    }

    function itemAssign($id_item = "")
    {
        $this->form_validation->set_rules('outlet', 'Outlet', 'trim|required|xss_clean');

        $query = $this->db->query(" SELECT id_item
                                    FROM tb_product
                                    WHERE id_item = '" . $id_item . "'");
        if ($query->num_rows() > 0) {

            if ($this->form_validation->run() == false) {

                $this->edititem($id_item);
            } else {
                $data = [
                    'id_item' => $id_item,
                    'id_outlet' => $this->input->post('outlet', TRUE)
                    // ,
                    // 'is_deleted' => "0"
                ];

                $query = $this->db->query(" SELECT id_prd_rel_outlet
                                            FROM tb_product_rel_outlet
                                            WHERE id_item = '" . $id_item . "' 
                                                AND id_outlet = '" . $data['id_outlet'] . "'");
                if ($query->num_rows() <= 0) {
                    $this->db->insert('tb_product_rel_outlet', $data);
                    $this->session->set_flashdata(
                        'message_2',
                        '<div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        New outlet assigned!
                        </div>'
                    );
                    redirect('backoffice/library/edititem/' . $id_item);
                } else {
                    $this->session->set_flashdata(
                        'message_2',
                        '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Outlet already assigned!
                        </div>'
                    );
                    redirect('backoffice/library/edititem/' . $id_item);
                }
            }
        } else {
            redirect('backoffice/library/lists');
        }
    }

    function itemUnassign($id_prd_rel_outlet)
    {
        // // update
        // $data = [
        //     'is_deleted' => "1"
        // ];
        // $this->db->update('tb_product_mod_rel_outlet', $data, "id_mod_rel = '" . $id_mod_rel . "'");

        $query = $this->db->query(" SELECT id_item
                                            FROM tb_product_rel_outlet
                                            WHERE id_prd_rel_outlet = '" . $id_prd_rel_outlet . "'");
        $result = $query->row_array();
        $id_item = $result['id_item'];

        // delete
        $this->db->delete('tb_product_rel_outlet', array('id_prd_rel_outlet' => $id_prd_rel_outlet));

        $this->session->set_flashdata(
            'message_2',
            '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            Outlet unassigned!
            </div>'
        );
        redirect('backoffice/library/edititem/' . $id_item);
    }

    function fetch_datavariant()
    {
        if ($this->input->post('id_variant')) {
            echo $this->Library->fetch_dataVariant($this->input->post('id_variant'));
        }
    }
    function fetch_delitem()
    {
        if ($this->input->post('id_item')) {
            echo $this->Library->fetch_delItem($this->input->post('id_item'));
        }
    }

    //###########################################################
    // Modifiers

    public function modifiers()
    {
        $main['modifiers'] = $this->Library->get_modifiers();
        $main['outlet'] = $this->Library->get_outlet()->result();
        $this->Helper->view('library/modifiers', $main, 'b_library');
    }

    function fetch_modifiers()
    {
        if ($this->input->post('id_outlet')) {
            echo $this->Library->fetch_modifiers($this->input->post('id_outlet'));
        }
    }

    function addmodifier()
    {
        $this->form_validation->set_rules('nama', 'Modifier Name', 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {

            $this->modifiers();
        } else {
            $data = [
                'nama' => $this->input->post('nama', TRUE)
            ];
            $this->Library->addModifier($data);
        }
    }

    function modDelOpt($id_mod_opt)
    {
        $data = [
            'is_deleted' => "1"
        ];
        $this->db->update('tb_product_mod_opt', $data, "id_mod_opt = '" . $id_mod_opt . "'");

        $query = $this->db->query(' SELECT id_mod
                                    FROM tb_product_mod_opt
                                    WHERE id_mod_opt = "' . $id_mod_opt . '" ');
        $result = $query->row_array();
        $id_mod = $result['id_mod'];

        $this->session->set_flashdata(
            'message_1',
            '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            Options deleted!
            </div>'
        );
        redirect('backoffice/library/editmodifier/' . $id_mod);
    }

    function modUnassign($id_mod_rel)
    {
        // // update
        // $data = [
        //     'is_deleted' => "1"
        // ];
        // $this->db->update('tb_product_mod_rel_outlet', $data, "id_mod_rel = '" . $id_mod_rel . "'");

        $query = $this->db->query(" SELECT id_mod
                                            FROM tb_product_mod_rel_outlet
                                            WHERE id_mod_rel = '" . $id_mod_rel . "'");
        $result = $query->row_array();
        $id_mod = $result['id_mod'];

        // delete
        $this->db->delete('tb_product_mod_rel_outlet', array('id_mod_rel' => $id_mod_rel));

        $this->session->set_flashdata(
            'message_2',
            '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            Outlet unassigned!
            </div>'
        );
        redirect('backoffice/library/editmodifier/' . $id_mod);
    }

    function modAddOpt($id_mod = "")
    {
        $this->form_validation->set_rules('nama', 'Option Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('price', 'Price', 'trim|required|numeric|xss_clean');

        $query = $this->db->query(" SELECT id_mod
                                    FROM tb_product_mod
                                    WHERE id_mod = '" . $id_mod . "'");
        if ($query->num_rows() > 0) {

            if ($this->form_validation->run() == false) {

                $this->editmodifier($id_mod);
            } else {
                $data = [
                    'id_mod' => $id_mod,
                    'nama' => $this->input->post('nama', TRUE),
                    'harga' => $this->input->post('price', TRUE),
                    'is_deleted' => "0"
                ];
                $this->db->insert('tb_product_mod_opt', $data);
                $this->session->set_flashdata(
                    'message_1',
                    '<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    New options added!
                    </div>'
                );
                redirect('backoffice/library/editmodifier/' . $id_mod);
            }
        } else {
            redirect('backoffice/library/modifiers');
        }
    }

    function modAssign($id_mod = "")
    {
        $this->form_validation->set_rules('outlet', 'Outlet', 'trim|required|xss_clean');

        $query = $this->db->query(" SELECT id_mod
                                    FROM tb_product_mod
                                    WHERE id_mod = '" . $id_mod . "'");
        if ($query->num_rows() > 0) {

            if ($this->form_validation->run() == false) {

                $this->editmodifier($id_mod);
            } else {
                $data = [
                    'id_mod' => $id_mod,
                    'id_outlet' => $this->input->post('outlet', TRUE),
                    'is_deleted' => "0"
                ];

                $query = $this->db->query(" SELECT id_mod_rel
                                            FROM tb_product_mod_rel_outlet
                                            WHERE id_mod = '" . $id_mod . "' 
                                                AND id_outlet = '" . $data['id_outlet'] . "'");
                if ($query->num_rows() <= 0) {
                    $this->db->insert('tb_product_mod_rel_outlet', $data);
                    $this->session->set_flashdata(
                        'message_2',
                        '<div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        New outlet assigned!
                        </div>'
                    );
                    redirect('backoffice/library/editmodifier/' . $id_mod);
                } else {
                    $this->session->set_flashdata(
                        'message_2',
                        '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Outlet already assigned!
                        </div>'
                    );
                    redirect('backoffice/library/editmodifier/' . $id_mod);
                }
            }
        } else {
            redirect('backoffice/library/modifiers');
        }
    }

    function editmodifier($id_mod = "")
    {
        $query = $this->db->query(" SELECT id_mod
                                    FROM tb_product_mod
                                    WHERE id_mod = '" . $id_mod . "'");
        if ($query->num_rows() > 0) {

            $main['id_mod'] = $id_mod;
            $main['options'] = $this->Library->get_mod_options_byID($id_mod);
            $main['outlets'] = $this->Library->get_mod_outlet_byID($id_mod);
            $main['outletAssign'] = $this->Library->get_outlet()->result();
            $this->Helper->view('library/modifiers_edit', $main, 'b_library');
        } else {
            redirect('backoffice/library/modifiers');
        }
    }


    //###########################################################
    // CATEGORIES


}
