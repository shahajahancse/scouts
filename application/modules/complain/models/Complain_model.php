<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Complain_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    public function get_data() {
        $this->db->select('*');
        $this->db->from('complain');
        $query = $this->db->get()->result();

        return $query;
    }
            

    public function get_info($id) {
        $this->db->select('*');
        $this->db->from('complain');
        $this->db->where('id', $id);
        $query = $this->db->get()->row();

        return $query;
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('complain');     
        return TRUE;
    }

}
