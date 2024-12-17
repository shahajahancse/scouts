<?php
// Create by: Mafizur
// Create Date: 07-06-2018
// Modify by: mafizur
// last modify date: 12-08-2018
if (!defined('BASEPATH')) exit('No direct script access allowed');

class E_filing_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_data($table) {
        $query = $this->db->from($table)
                        ->get()->result();
        return $query;
    }

    public function get_info($table,$id) {
        $query = $this->db->from($table)
                        ->where('id', $id)
                        ->get()->row();
        return $query;
    }

    public function get_file_list($field,$id) {
        $this->db->select('f.*, d.department_name');
        $this->db->from('e_filie f');
        $this->db->join('department d', 'd.id = f.department', 'LEFT');
        $this->db->where("f.$field", $id);
        $this->db->where("f.status", 1);
        $query=$this->db->get()->result();
        return $query;
    }
     public function get_file_list1($field,$id) {
        $this->db->select('f.*, d.department_name');
        $this->db->from('e_filie f');
        $this->db->join('department d', 'd.id = f.department', 'LEFT');
        $this->db->like("f.$field", $id);
        $this->db->where("f.status", 1);
        $query=$this->db->get()->result();
        return $query;
    }

    public function get_file_list2($field,$id) {
        $this->db->select('f.*, d.department_name, de.designation_name');
        $this->db->from('e_filie f');
        $this->db->join('department d', 'd.id = f.department', 'LEFT');
        $this->db->join('designation de', 'de.id = f.file_desk', 'LEFT');
        $this->db->like("f.$field", $id);
        $this->db->where("f.status", 1);
        $query=$this->db->get()->result();
        return $query;
    }
     public function get_file_done_list() {
        $this->db->select('f.*, d.department_name');
        $this->db->from('e_filie f');
        $this->db->join('department d', 'd.id = f.department', 'LEFT');
        $this->db->where("f.status", 2);
        $query=$this->db->get()->result();
        return $query;
    }

    public function get_file($id) {
        $this->db->select('f.*, d.department_name,  de.designation_name, dee.nathi_no as nathi_title, u.first_name');
        $this->db->from('e_filie f');
        $this->db->join('department d', 'd.id = f.created_department', 'LEFT');
        $this->db->join('designation de', 'de.id = f.created_designation', 'LEFT');
        $this->db->join('e_nathi dee', 'dee.id = f.file_approval', 'LEFT');
        $this->db->join('users u', 'u.id = f.created_by', 'LEFT');
        $this->db->where("f.id", $id);
        $query=$this->db->get()->row();
        return $query;
    }

    public function get_note($id) {
        $this->db->select('n.*, d.department_name, de.designation_name, u.first_name');
        $this->db->from('e_file_note n');
        $this->db->join('department d', 'd.id = n.department_id', 'LEFT');
        $this->db->join('designation de', 'de.id = n.designation_id', 'LEFT');
        $this->db->join('users u', 'u.id = n.user_id', 'LEFT');
        $this->db->where("n.file_id", $id);
        $query=$this->db->get()->result();
        return $query;
    }

    public function get_log($id) {
        $this->db->select('l.*,  d1.designation_name, d2.designation_name as designation_name2');
        $this->db->from('e_file_log l');
        $this->db->join('designation d1', 'd1.id = l.from_designation', 'LEFT');
        $this->db->join('designation d2', 'd2.id = l.to_designation', 'LEFT');
        $this->db->where("l.file_id", $id);
        $query=$this->db->get()->result();
        return $query;
    }

}
