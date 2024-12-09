<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Invoices extends Controller {
    protected $user_id;

    public function __construct()
    {
        parent::__construct();
        $this->user_id = $this->session->userdata('user_id');;
        $this->call->model('Invoices_model', 'invoice');
    }

    public function get_invoice_by_user () {
        $data['invoices'] = $this->invoice->get_invoice_by_user($this->user_id);
        $this->call->view('patient/invoices', $data);
    }

    public function get_invoice_by_id ($id) {
        $data['invoice'] = $this->invoice->get_invoice_by_id($this->user_id, $id);
        header('Content-Type: application/json');
        echo json_encode( $data);
    }

    public function add_invoice() {
        $data = array(
            'appointment_id' => $this->io->post('appointment_id'),
            'user_id' => $this->user_id,
            'service_id' => $this->io->post('service_id'),
        );
        header('Content-Type: application/json');

        if($this->invoice->add_invoice($data)) {
            echo json_encode(['success' => true, 'message' => 'Invoice has been added!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to create invoice']);
        }   
    }
}
?>
