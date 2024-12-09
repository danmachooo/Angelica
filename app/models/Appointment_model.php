<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Appointment_model extends Model {
    
    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_appointments() {
        return $this->db->table('appointments as a')->join('users as u', 'a.user_id = u.id')->join('services as s', 'a.service_id = s.id')->get_all();
    }

    
    public function get_all_appointments_by_user($user_id) {
        return $this->db->table('appointments as a')
                ->select('a.id AS appointment_id, a.appointment_date,
                        u.firstname, u.lastname, 
                        s.name AS service_name, s.price AS service_price, s.duration AS service_duration')
                ->join('users as u', 'a.user_id = u.id')
                ->join('services as s', 'a.service_id = s.id')
                ->where('a.user_id', $user_id)
                ->get_all();

    }


    public function book_appointment($data) {
        $bind = array(
            'user_id' => $data['user_id'],
            'service_id' => $data['service_id'],
            'appointment_date' => $data['appointment_date']
        );
        $this->db->table('appointments')->insert($bind);
        
        return $this->db->last_id();
    }
}
?>