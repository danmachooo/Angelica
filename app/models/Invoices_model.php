<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Invoices_model extends Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    public function get_invoice_by_user($user_id) {
        return $this->db->table('invoices as i')
                    ->select('i.id AS invoice_id, a.appointment_date, u.firstname, u.lastname, s.name AS service_name, s.price AS service_price, s.duration AS service_duration, i.issue_date')
                    ->join('users as u', 'i.user_id = u.id')
                    ->join('appointments as a', 'i.user_id = a.id')
                    ->join('services s', 'i.user_id = s.id')
                    ->where('i.user_id', $user_id)
                    ->get_all();
    }

    public function get_invoice_by_id($user_id, $id) {
        return $this->db->table('invoices as i')
                ->select('i.id AS invoice_id, a.appointment_date, u.firstname, u.lastname, s.name AS service_name, s.price AS service_price, s.duration AS service_duration, i.issue_date')
                ->join('users as u', 'i.user_id = u.id')
                ->join('appointments as a', 'a.user_id = u.id')
                ->join('services as s', 'i.service_id = s.id')
                ->where('i.user_id', $user_id)->where('i.id', $id)
                ->get();
    }

    public function add_invoice($data) {
        $bind = array(
            'appointment_id' => $data['appointment_id'],
            'service_id' => $data['service_id'],
            'user_id' => $data['user_id']
        );

        return $this->db->table('invoices')->insert($bind);
    }
}
?>
