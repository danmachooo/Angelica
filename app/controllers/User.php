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
        $this->call->view('admin/users', $data);
    }
    public function get_user() {
        $id = $this->session->userdata('user_id');
        $data['profile'] = $this->user->get_user($id);
        $this->call->view('patient/profile', $data);
    }

    public function get_user_for_admin($id) {
        header('Content-Type: application/json');
        $data['user'] = $this->user->get_user($id);
        echo json_encode(['success' => true, 'data' => $data['user']]);
    }

    public function update_user_for_admin($id){
        $data = array(
            'firstname' => $this->io->post('firstname'),
            'lastname' => $this->io->post('lastname'),
            'address' => $this->io->post('address'),
            'birthday' => $this->io->post('birthday'),
            'contact_number' => $this->io->post('contact_number')
        );

        if ($this->user->update_user_for_admin($id, $data)) {
            echo json_encode(['success' => true, 'data' => $data]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update user profile.']);
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
