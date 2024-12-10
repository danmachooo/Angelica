<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Services_model extends Model {
    protected $table;
    public function __construct()
    {
        parent::__construct();
        $this->table = 'services';
    }

    public function get_all_services() {
        return $this->db->table($this->table)->get_all();
    }

    public function get_service_by_id ($id) {
        return $this->db->table($this->table)->where('id', $id)->get();
    }

    public function add_service($data) {
        $bind = array(
            'name' => $data['name'],
            'price' => $data['price'],
            'duration' => $data['duration'],
            'description' => $data['description']
        );

        return $this->db->table($this->table)->insert($bind);
    }

    public function update_service($id, $data) {
        $bind = array(
            'name' => $data['name'],
            'price' => $data['price'],
            'duration' => $data['duration'],
            'description' => $data['description']        
        );

        return $this->db->table($this->table)->update($bind)->where('id', $id);
    }

    public function delete_service($id) {
        $current_timestamp = date('Y-m-d H:i:s');

        $delete = array(
            'deleted_at' => $current_timestamp
        );

        return $this->db->table($this->table)->update($delete)->where('id', $id);
    }

    public function get_amount_by_service_id ($id): mixed {
        return $this->db->table($this->table)->select('price')->where('id', $id)->get();
    }
}
?>
