<?php
// Create by: Mafizur
// Create Date: 07-06-2018
// Modify by: mafizur
// last modify date: 12-08-2018
if (!defined('BASEPATH')) exit('No direct script access allowed');

class E_attachment_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_data($table,$department) {
        $query = $this->db->from($table)
                        ->where('department_id', $department)
                        ->get()->result();
        return $query;
    }

    public function get_info($table,$id) {
        $query = $this->db->from($table)
                        ->where('id', $id)
                        ->get()->row();
        return $query;
    }
}
