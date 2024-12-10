<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Dashboard extends Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->call->model('Dashboard_model', 'dash');
    }

    public function dashboard() {

        $this->call->view('admin/dashboard', 'dash');
    }

    public function count_users() {
        $count = $this->dash->count_users();

        echo json_encode(['success' => true, 'count' => $count ?: 0]);

    }

    public function top_services() {

        $top_services = $this->dash->get_top_services();

        echo json_encode(['success' => true, 'top_services' => $top_services ?: []]);

    }

    public function count_appointments() {

        $count = $this->dash->count_appointments();

        echo json_encode(['success' => true, 'count' => $count ?: 0]);

    }
}
?>
