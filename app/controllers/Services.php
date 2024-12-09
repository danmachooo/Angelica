<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Services extends Controller {
    protected $user_id;

    public function __construct()
    {
        parent::__construct();
        $this->user_id = $this->session->userdata('user_id');;
        $this->call->model('Services_model', 'service');
    }
    public function add_services() {
        $data = array(
            'name' => $this->io->post('name'),
            'price' => $this->io->post('price'),
            'duration' => $this->io->post('duration'),
            'description' => $this->io->post('description')
        );

        if($this->service->add_services($data)) {
            echo json_encode(['success' => true, 'message' => 'Service has been added!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to add an service']);
        }
    }

    public function update_services($id) {
        $data = array(
            'name' => $this->io->post('name'),
            'price' => $this->io->post('price'),
            'duration' => $this->io->post('duration'),
            'description' => $this->io->post('description')
        );

        if($this->service->update_service($id, $data)) {
            echo json_encode(['success' => true, 'message' => 'Service has been updated!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update an service']);
        }
    }

    public function get_all_services_for_admin() {
       $data['services'] = $this->service->get_all_services();
       $this->call->view('admin/services', $data);
    }

    public function get_all_services_for_user() {
        $data['services'] = $this->service->get_all_services();
        $this->call->view('patient/services', $data);
     }

    public function get_service_by_id() {
        $data['service'] = $this->service->get_service_by_id($this->user_id);
        $this->call->view('admin/service', $data);
    }

    public function delete_service($id) {
        if($this->service->delete_service($id)) {
            echo json_encode(['success' => true, 'message' => 'Service has been delete!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete service']);
        }
    }
}
?>
