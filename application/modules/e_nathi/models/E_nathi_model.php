<?php
// Create by: Mafizur
// Create Date: 07-06-2018
// Modify by: mafizur
// last modify date: 12-08-2018
if (!defined('BASEPATH')) exit('No direct script access allowed');

class E_nathi_model extends CI_Model {

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

    public function get_dropdown($table, $field, $id, $department){
      $data[''] = '-- একটি নির্বাচন করুন --';
      $this->db->select("$id, $field");
      $this->db->from($table);
      $this->db->where('department', $department);
      $this->db->order_by($id, 'ASC');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows[$id]] = $rows[$field];
      }

      return $data;
   }

    public function get_file_list($field,$id) {
        $this->db->select('f.*, d.department_name');
        $this->db->from('e_nathi f');
        $this->db->join('department d', 'd.id = f.department', 'LEFT');
        $this->db->where("f.$field", $id);
        $this->db->where("f.status", 1);
        $query=$this->db->get()->result();
        return $query;
    }

    public function get_file_list1($field,$id) {
        $this->db->select('f.*, d.department_name');
        $this->db->from('e_nathi_paragraph f');
        $this->db->join('department d', 'd.id = f.department', 'LEFT');
        $this->db->like("f.$field", $id);
        $this->db->where("f.status", 1);
        $query=$this->db->get()->result();

        $i=0;
        foreach ($query as $key => $value) {
            $query[$i]->attachment=$this->nathi_attachment($value->id);
            $query[$i]->note=$this->get_note2($value->id);
            $i++;
        }
        return $query;
    }

    public function get_file_list2($field,$id, $folder=0, $status=1) {
        $this->db->select('f.*, d.department_name');
        $this->db->from('e_nathi f');
        $this->db->join('department d', 'd.id = f.department', 'LEFT');
        if(!empty($folder)){
            $this->db->where("f.folder_id", $folder);
        }
        $this->db->like("f.$field", $id);
        if($status==1){
            $this->db->where("f.status", 1);
        }else{
            $this->db->where("f.status", 0);
        }
        $query=$this->db->get()->result();
        return $query;
    }

    public function get_file_list3($field,$id) {
        $user = $this->ion_auth->user()->row();
        $e_nathi_department=$this->e_nathi_department($user->id);
        $this->db->select('f.*, d.department_name, n.nathi_no, n.title, de.designation_name');
        $this->db->from('e_nathi_suggestion f');
        $this->db->join('department d', 'd.id = f.department', 'LEFT');
        $this->db->join('designation de', 'de.id = f.nathi_desk', 'LEFT');
        $this->db->join('e_nathi n', 'n.id = f.nathi_id', 'LEFT');
        if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin())){
            
            $this->db->like("f.$field", $id);
        }
        
        if($e_nathi_department->emp_department!=1){
            $this->db->like("f.nathi_desk_department", $e_nathi_department->emp_department);
        }

        // Search Filter
        if($this->input->get('department') != NULL){
            $this->db->where('f.nathi_desk_department', $this->input->get('department')); 
        }
        if($this->input->get('designation') != NULL){
            $this->db->where('f.nathi_desk', $this->input->get('designation')); 
        }

        $this->db->where("f.status", 1);
        $query=$this->db->get()->result();
        return $query;
    }

    public function e_nathi_department($id){
        $this->db->select('*');
        $this->db->from('e_nathi_department');
        $this->db->where('emp_id', $id);
        $this->db->where('status', 1);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_file_list10($field,$id) {
        $this->db->select('f.*, d.department_name, n.nathi_no, n.title, de.designation_name');
        $this->db->from('e_nathi_suggestion f');
        $this->db->join('department d', 'd.id = f.department', 'LEFT');
        $this->db->join('designation de', 'de.id = f.nathi_desk', 'LEFT');
        $this->db->join('e_nathi n', 'n.id = f.nathi_id', 'LEFT');
        $this->db->like("f.$field", $id);
        $query=$this->db->get()->result();
        return $query;
    }


    public function get_file_done_list() {
        $this->db->select('f.*, d.department_name, n.nathi_no, n.title, , de.designation_name');
        $this->db->from('e_nathi_suggestion f');
        $this->db->join('department d', 'd.id = f.department', 'LEFT');
        $this->db->join('designation de', 'de.id = f.nathi_desk', 'LEFT');
        $this->db->join('e_nathi n', 'n.id = f.nathi_id', 'LEFT');
        $this->db->where("f.status", 2);
        $query=$this->db->get()->result();
        return $query;
    }

    public function get_folder($table,$dep) {
        $this->db->select('*');
        $this->db->from("$table");
        $this->db->like("department", $dep);
        $this->db->where("status", 1);
        $query=$this->db->get()->result();
        return $query;
    }

    public function get_file($id) {
        $this->db->select('f.*, d.department_name,  u.first_name');
        $this->db->from('e_nathi f');
        $this->db->join('department d', 'd.id = f.department', 'LEFT');
        $this->db->join('users u', 'u.id = f.created_by', 'LEFT');
        $this->db->where("f.id", $id);
        $query=$this->db->get()->row();
        return $query;
    }

    public function get_suggestion($id) {
        $this->db->select('*');
        $this->db->from('e_nathi_suggestion');
        $this->db->where("id", $id);
        $query=$this->db->get()->row();
        return $query;
    }

    public function get_paragraph($id) {
        $this->db->select('*');
        $this->db->from('e_nathi_paragraph');
        $this->db->where("page_id", $id);
        $query=$this->db->get()->result();
        $i=0;
        foreach ($query as $key => $value) {
            $query[$i]->attachment=$this->nathi_attachment($value->id);
            $query[$i]->note=$this->get_note2($value->paragraph_no);
            $i++;
        }
        return $query;
    }

    public function get_note2($id) {
        $this->db->select('n.*, d.department_name, de.designation_name, u.first_name');
        $this->db->from('e_nathi_note n');
        $this->db->join('department d', 'd.id = n.department_id', 'LEFT');
        $this->db->join('designation de', 'de.id = n.designation_id', 'LEFT');
        $this->db->join('users u', 'u.id = n.user_id', 'LEFT');
        $this->db->where("n.paragraph_no", $id);
        $query=$this->db->get()->result();
        return $query;
    }

    public function get_note($id) {
        $this->db->select('n.*, d.department_name, de.designation_name, u.first_name');
        $this->db->from('e_nathi_note n');
        $this->db->join('department d', 'd.id = n.department_id', 'LEFT');
        $this->db->join('designation de', 'de.id = n.designation_id', 'LEFT');
        $this->db->join('users u', 'u.id = n.user_id', 'LEFT');
        $this->db->where("n.file_id", $id);
        $query=$this->db->get()->result();
        return $query;
    }

    public function get_log($id) {
        $this->db->select('l.*,  d1.designation_name, d2.designation_name as designation_name2,  de1.department_name, de2.department_name as department_name2');
        $this->db->from('e_nathi_log l');
        $this->db->join('designation d1', 'd1.id = l.from_designation', 'LEFT');
        $this->db->join('designation d2', 'd2.id = l.to_designation', 'LEFT');
        $this->db->join('department de1', 'de1.id = l.from_department', 'LEFT');
        $this->db->join('department de2', 'de2.id = l.to_department', 'LEFT');
        $this->db->where("l.file_id", $id);
        $query=$this->db->get()->result();
        return $query;
    }

    public function last_page($id){
        $this->db->select('*');
        $this->db->from('e_nathi_suggestion');
        $this->db->where("nathi_id", $id);
        $this->db->order_by("id", 'DESC');
        $query=$this->db->get()->row();
        return $query->id;
    }

     public function last_paragraph($field,$id) {
        $this->db->select('*');
        $this->db->from('e_nathi_paragraph');
        $this->db->where("$field", $id);
        $this->db->order_by("id", 'DESC');
        $query=$this->db->get()->row();
        return $query->id;
    }

    public function nathi_attachment($id){
        $this->db->select('*');
        $this->db->from('paragraph_attachment');
        $this->db->where("paragraph_id", $id);
        $query=$this->db->get()->result();
        return $query;
    }

}
