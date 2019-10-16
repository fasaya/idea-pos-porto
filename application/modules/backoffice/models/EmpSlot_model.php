<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EmpSlot_model extends CI_Model
{
    function show_data_user($id_user)
    {
        $query = $this->db->query(" SELECT 
                                        tb_user.id_user,
                                        tb_user.nama,
                                        tb_user.phone,
                                        tb_user.deskripsi,
                                        tb_user.pin,
                                        tb_login.id_login,
                                        tb_login.email,
                                        tb_login.id_role

                                    FROM tb_user, tb_login 
                                    WHERE tb_user.id_login = tb_login.id_login 
                                        AND tb_user.id_user = " . $id_user);

        return $query->row_array();
    }

    function add_user($value)
    {
        //Start database transaction
        $this->db->trans_start();

        //insert into table login
        $login = [
            'id_role' => $value['id_role'],
            'email' => $value['email'],
            'pwd' => "",
            'is_verified' => "0",
            'is_active' => "1",
            'is_deletable' => "1"
        ];
        $this->db->insert('tb_login', $login);

        // get id_login
        $id_login = $this->db->insert_id();

        //insert into table user
        $user = [
            'id_login' => $id_login,
            'nama' => $value['nama'],
            'phone' => $value['phone'],
            'deskripsi' => $value['deskripsi'],
            'pin' => $value['pin'],
            'status' => "1"
        ];
        $this->db->insert('tb_user', $user);

        // get user
        $id_user = $this->db->insert_id();

        //insert into table assignment (outlet)
        $assign = [
            'id_user' => $id_user,
            'id_outlet' => $value['id_outlet']
        ];
        $this->db->insert('tb_assignment', $assign);

        //Start database transaction
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                Failed to add new employee!
                </div>'
            );
            redirect('backoffice/employee/staff');
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                New employee added! Waiting for verification.
                </div>'
            );
            redirect('backoffice/employee/staff');
        }
    }

    function update_user($data)
    {

        //Start database transaction
        $this->db->trans_start();


        //cek email
        $dt_cek = $this->db->get_where('tb_login', ['id_login' => $data['id_login']])->row_array();
        $cek = FALSE;
        if ($data['email'] == $dt_cek['email']) {

            $dt_login = [
                'email' => $data['email'],
                'id_role' => $data['id_role']
            ];
            $this->db->update('tb_login', $dt_login, "id_login = " . $data['id_login']);
        } else {
            //cek apakah email sudah terdaftar
            $query = $this->db->get_where('tb_login', array(
                'email' => $data['email']
            ));

            //counting result from query
            $count = $query->num_rows();

            if ($count > 0) {
                $dt_login = [
                    'id_role' => $data['id_role']
                ];
                $this->db->update('tb_login', $dt_login, "id_login = " . $data['id_login']);
                $cek = TRUE;
            } else {
                $dt_login = [
                    'email' => $data['email'],
                    'id_role' => $data['id_role']
                ];
                $this->db->update('tb_login', $dt_login, "id_login = " . $data['id_login']);
            }
        }



        $dt_user = [
            'nama' => $data['nama'],
            'phone' => $data['phone'],
            // 'pin' => password_hash($data['pin'], PASSWORD_DEFAULT),
            'pin' => $data['pin'],
            'deskripsi' => $data['deskripsi']
        ];
        $this->db->update('tb_user', $dt_user, "id_user = " . $data['id_user']);

        //Start database transaction
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade in" role="alert">
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
                 Failed to edit data!
                 </div>'
            );
            redirect('backoffice/employee/edit_slot/' . $data['id_user']);
        } else {
            if ($cek) {
                $this->session->set_flashdata(
                    'cek_email',
                    '<small class="text-danger pl-3">Error. Email already registered.</small>'
                );
            }
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade in" role="alert">
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
                 Data updated!
                 </div>'
            );
            redirect('backoffice/employee/edit_slot/' . $data['id_user']);
        }
    }

    function assign_user($value)
    {
        $query = $this->db
            ->select("id_assignment")
            ->from("tb_assignment")
            ->where("id_user", $value['id_user'])
            ->where("id_outlet", $value['id_outlet']);
        $hasil = $query->count_all_results();

        if ($hasil <= 0) {
            $assign = [
                'id_outlet' => $value['id_outlet'],
                'id_user' => $value['id_user']
            ];
            $this->db->insert('tb_assignment', $assign);

            $this->session->set_flashdata(
                'message_outlet',
                '<div class="alert alert-success alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                New outlet assigned!
                </div>'
            );
            redirect('backoffice/employee/edit_slot/' . $value['id_user']);
        } else {
            $this->session->set_flashdata(
                'message_outlet',
                '<div class="alert alert-danger alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                Failed! Outlet have already assigned.
                </div>'
            );
            redirect('backoffice/employee/edit_slot/' . $value['id_user']);
        }
    }

    function unassign_user($data)
    {
        $id_user = $data['id_user'];
        $id_assignment = $data['id_assignment'];

        $query = $this->db
            ->select("id_user")
            ->from("tb_assignment")
            ->where("id_user", $id_user)
            ->where("id_assignment", $id_assignment);
        $jml = $query->count_all_results();

        if ($jml > 0) {
            $this->db->delete('tb_assignment', array('id_assignment' => $id_assignment));

            $this->session->set_flashdata('message_outlet', '<div class="alert alert-success alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            Employee unassignment success!
            </div>');
            redirect('backoffice/employee/edit_slot/' . $id_user);
        } else {
            $this->session->set_flashdata('message_outlet', '<div class="alert alert-danger alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            Failed to unassign employee!
            </div>');
            redirect('backoffice/employee/edit_slot/' . $id_user);
        }
    }

    function deactivate_user($id_user)
    {

        $data_user = $this->db->get_where('tb_user', ['id_user' => $id_user])->row_array();
        $data_login = $this->db->get_where('tb_login', ['id_login' => $data_user['id_login']])->row_array();

        if ($data_login['is_deletable']) {

            $deactivate = [
                'is_active' => '0'
            ];
            $this->db->update('tb_login', $deactivate, "id_login = " . $data_user['id_login']);

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            User deactivated.
            </div>');
            redirect('backoffice/employee/staff');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            Failed to deactivate user.
            </div>');
            redirect('backoffice/employee/edit_slot/' . $id_user);
        }
    }

    function reactivate_user($id_user)
    {

        $data_user = $this->db->get_where('tb_user', ['id_user' => $id_user])->row_array();
        $data_login = $this->db->get_where('tb_login', ['id_login' => $data_user['id_login']])->row_array();

        if ($data_login['is_deletable']) {

            $deactivate = [
                'is_active' => '1'
            ];
            $this->db->update('tb_login', $deactivate, "id_login = " . $data_user['id_login']);

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            User reactivated.
            </div>');
            redirect('backoffice/employee/staff');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            Failed to reactivate user.
            </div>');
            redirect('backoffice/employee/edit_slot/' . $id_user);
        }
    }

    // ########################################################################################

    function get_user()
    {
        return $this->db->select("tb_user.id_user, tb_user.nama, tb_role.name, tb_login.is_verified")
            ->from("tb_user, tb_login, tb_role")
            ->where("tb_user.id_login = tb_login.id_login")
            ->where("tb_login.id_role = tb_role.id_role")
            ->where("tb_login.is_active", '1')
            ->where("tb_login.is_deletable", '1')
            ->order_by("id_user", "ASC")
            ->get();
    }

    function get_user_off()
    {
        return $this->db->select("tb_user.id_user, tb_user.nama, tb_role.name, tb_login.is_verified")
            ->from("tb_user, tb_login, tb_role")
            ->where("tb_user.id_login = tb_login.id_login")
            ->where("tb_login.id_role = tb_role.id_role")
            ->where("tb_login.is_active", '0')
            ->where("tb_login.is_deletable", '1')
            ->order_by("id_user", "ASC")
            ->get();
    }

    function get_role()
    {
        return $this->db->select("id_role, name")
            ->from("tb_role")
            // ->where("delete", '0')
            ->order_by("id_role", "ASC")
            ->get();
    }

    function get_outlet()
    {
        return $this->db->select("id_outlet, nama")
            ->from("tb_outlet")
            // ->where("delete", '0')
            ->order_by("id_outlet", "ASC")
            ->get();
    }

    function get_assignedOutlet($id_user)
    {

        $jml = $this->db->from("tb_assignment")
            ->where(['id_user' => $id_user])
            ->count_all_results();

        $jmlOutlet = $this->db->from("tb_outlet")
            ->count_all_results();

        // echo $jml . " and " . $jmlOutlet;

        if ($jml == $jmlOutlet) {
            echo "All Outlets";
        } else {
            echo  $jml . " Outlet";
        }
    }

    function isUserExist($id_user)
    {
        $query = $this->db->get_where('tb_user', array(
            'id_user' => $id_user
        ));

        //counting result from query
        $count = $query->num_rows();

        if ($count > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function get_assignedUser($id_user)
    {
        return $this->db->select("tb_assignment.id_assignment, tb_outlet.nama")
            ->from("tb_assignment, tb_outlet")
            ->where("tb_assignment.id_outlet = tb_outlet.id_outlet")
            ->where("tb_assignment.id_user", $id_user)
            ->order_by("id_assignment", "DESC")
            ->get();
    }

    function slctdOpt($optRole, $id_role)
    {
        if ($optRole == $id_role) {
            echo "selected";
        }
    }

    function activate_button($id_user)
    {
        $query = $this->db->query(" SELECT tb_login.is_active
                                    FROM tb_user, tb_login 
                                    WHERE tb_user.id_login = tb_login.id_login 
                                        AND tb_user.id_user = " . $id_user);

        $dt = $query->row_array();

        if ($dt['is_active'] == '1') {
            $data = [
                'desc' => 'Deactivate Employee',
                'link' => 'employee/deactivate/',
                'type' => 'btn-danger',
                'icon' => 'fa fa-ban'
            ];
            return $data;
        } else {
            $data = [
                'desc' => 'Reactivate Employee',
                'link' => 'employee/reactivate/',
                'type' => 'btn-success',
                'icon' => 'fa fa-power-off'
            ];
            return $data;
        }
    }
}
