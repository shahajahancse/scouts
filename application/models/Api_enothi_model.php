<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Api_enothi_model extends CI_Model {

   public function __construct() {
      parent::__construct();
   }

   public function get_folder($table, $dep) {
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

   public function last_page($id){
      $this->db->select('*');
      $this->db->from('e_nathi_suggestion');
      $this->db->where("nathi_id", $id);
      $this->db->order_by("id", 'DESC');
      $query=$this->db->get()->row();
      return $query->id;
   }

   public function get_suggestion($id) {
      $this->db->select('*');
      $this->db->from('e_nathi_suggestion');
      $this->db->where("id", $id);
      $query=$this->db->get()->row();
      return $query;
   }

   public function last_paragraph($field, $id) {
      $this->db->select('*');
      $this->db->from('e_nathi_paragraph');
      $this->db->where("$field", $id);
      $this->db->order_by("id", 'DESC');
      $query=$this->db->get()->row();
      return $query->id;
   }

   public function get_basic_user_info($id) {
      $query = $this->db->select('id, first_name, pds_id, pds_id_type, office_id_type, service_area_id, email, emp_office, desk_officer, emp_singature')->where('id', $id)->get('users')->row();
      return $query;
   }

   public function get_general_attachment($deptID) {
      $query = $this->db->from('e_nathi_attach')->where('department_id', $deptID)->get()->result();
      // echo $this->db->last_query(); exit;
      return $query;
   }


   public function get_profile_details($id) {
      // $data = $this->db->select('emp_id, emp_department, emp_designation')->where('emp_id', $id)->where('status', 1)->get('e_nathi_department')->row();

      $this->db->select('u.id, u.scout_id, u.username, u.first_name, u.is_employee, u.email, u.desk_officer, u.pds_id, u.pds_id_type, u.profile_img, u.emp_singature, d.department_name, dg.designation_name, bg.bg_name_en');
      $this->db->from('users u');
      $this->db->join('e_nathi_department end', 'end.emp_id = u.id', 'LEFT');
      $this->db->join('department d', 'd.id = end.emp_department', 'LEFT');
      $this->db->join('designation dg', 'dg.id = end.emp_designation', 'LEFT');
      $this->db->join('blood_group bg', 'bg.id = u.blood_group', 'LEFT');      
      $this->db->where('u.id', $id);
      $this->db->where('end.status', 1);
      $query = $this->db->get()->row();

      return $query;
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

   public function get_file_list2($field, $id, $folder=0, $status=1) {
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
        // echo $this->db->last_query(); exit;
      return $query;
   }

   public function get_file_list3($field, $id, $userID) {
      // echo $field; exit;
      // $user = $this->ion_auth->user()->row();

      // print_r($user); exit;
      $e_nathi_department=$this->e_nathi_department($userID);

      if(!$this->ion_auth->is_admin()){ 
         $flag = 1;
      }

      $this->db->select('f.*, d.department_name, n.nathi_no, n.title, de.designation_name');
      $this->db->from('e_nathi_suggestion f');
      $this->db->join('department d', 'd.id = f.department', 'LEFT');
      $this->db->join('designation de', 'de.id = f.nathi_desk', 'LEFT');
      $this->db->join('e_nathi n', 'n.id = f.nathi_id', 'LEFT');
      $this->db->where("f.status", 1);

      if($e_nathi_department->emp_department!=1){
         $this->db->where("f.nathi_desk_department", $e_nathi_department->emp_department);
      }

      if($flag == 1){
         $this->db->where("f.$field", $id);
      }

      $query=$this->db->get()->result();
      // echo $this->db->last_query(); exit;
      // print_r($query); exit;
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
         $query[$i]->attachment = $this->nathi_attachment($value->id);
         $query[$i]->note = $this->get_note2($value->id);
         $i++;
      }
      return $query;
   }

   public function get_file_list10($field, $id) {
      $this->db->select('f.*, d.department_name, n.nathi_no, n.title, de.designation_name');
      $this->db->from('e_nathi_suggestion f');
      $this->db->join('department d', 'd.id = f.department', 'LEFT');
      $this->db->join('designation de', 'de.id = f.nathi_desk', 'LEFT');
      $this->db->join('e_nathi n', 'n.id = f.nathi_id', 'LEFT');
      $this->db->like("f.$field", $id);
      $query=$this->db->get()->result();
      return $query;
   }

   public function nathi_attachment($id){
      $this->db->select('*');
      $this->db->from('paragraph_attachment');
      $this->db->where("paragraph_id", $id);
      $query=$this->db->get()->result();
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

   public function e_nathi_department($id){
      $this->db->select('*');
      $this->db->from('e_nathi_department');
      $this->db->where('emp_id', $id);
      $this->db->where('status', 1);
      $query = $this->db->get();
      return $query->row();
   }

   public function get_data($table) {
      $this->db->select('*');
      $this->db->from($table);
      $query =  $this->db->get();

      if($query->num_rows() > 0){
         return $query->result();
      }else{
         return FALSE;
      }
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

   public function get_data_field($table, $field, $id){
      // $data = array();
      $this->db->select("$id, $field");
      $this->db->from($table);
      $this->db->order_by($id, 'ASC');
      $query = $this->db->get()->result();

      // foreach ($query->result_array() AS $rows) {
      //    $data[$rows[$id]] = $rows[$field];
      // }

      return $query;
   }     

   public function get_department($id=0){
      $this->db->select("ed.id, d.department_name");
      $this->db->from('e_nathi_department ed');
      $this->db->join('department d', 'ed.emp_department=d.id', 'LEFT');
      if($id>0){
         $this->db->where('ed.emp_id', $id);         
      }
      $this->db->order_by('ed.id', 'ASC');
      $query = $this->db->get()->result();

      return $query;
   }   
}
