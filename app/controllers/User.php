<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class User extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->model('User_model', 'user');
    }
    public function get_all_users() {
        $data['users'] = $this->user->get_all_users();
        $this->call->view('admin/users');
    }
    public function get_user() {
        $data['profile'] = $this->user->get_user($this->session->userdata('user_id'));
        $this->call->view('patient/profile', $data);
    }

    public function change_user_pass($id) {
        $data = array(
            'password' => $this->lauth->passwordhash($this->io->post('password')),
        );

        if($this->user->update_user($id, $data)) {
            echo json_encode(['success' => true, 'message' => 'User password has been updated!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update password']);
        }
    }
    public function update_user(){
        $data = array(
            'firstname' => $this->io->post('firstname'),
            'lastname' => $this->io->post('lastname'),
            'address' => $this->io->post('address'),
            'birthday' => $this->io->post('birthday'),
            'contact_number' => $this->io->post('contact_number')
        );

        if ($this->user->update_user($this->session->userdata('user_id'), $data)) {
            echo json_encode(['success' => true, 'data' => $data]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update user profile.']);
        }
    }

    

}
?>
