<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Dashboard_model extends Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_top_services() {
        return $this->db->table('services as s')
                ->select('s.name, COUNT(a.id) as booking_count')
                ->join('appointments as a', 'a.service_id = s.id')
                ->group_by(['s.id', 's.name'])
                ->order_by('booking_count', 'DESC') 
                ->limit(3) 
                ->get_all();

    }

    public function count_users() {
        $result = $this->db->table('users')->select_count('id', 'total_users')->get();
        return $result ? $result['total_users'] : 0;

    }
    public function count_appointments() {
        $result = $this->db->table('appointments')->select_count('id', 'total_appointments')->get();
        return $result ? $result['total_appointments'] : 0; 
    }
}
?>
