<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class User_model extends Model {
    
    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_users() {
        return $this->db->table('users')->get_all();
    }
    public function get_user($id) {
        return $this->db->table('users')->where('id', $id)->get();
    }

    public function update_user($id, $data) {
        $bind = array(
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'address' => $data['address'],
            'birthday' => $data['birthday'],
            'contact_number' => $data['contact_number'],
        );
        return $this->db->table('users')->where('id', $id)->update($bind);
    }

    public function change_user_pass($id, $data) {
        $bind = array(
            'password' => $data['password']
        );
        return $this->db->table('users')->where('id', $id)->update($bind);
    }

    
}
?>
