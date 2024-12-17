<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Employee_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_employee($limit=1000, $offset=0, $region_id=NULL, $sc_district_id=NULL, $sc_upa_tha_id=NULL, $sc_scout_group_id=NULL, $active=NULL) {
        // echo 'hello'; exit;
        $this->db->select('u.id, u.pds_id, u.sl_no, u.active, u.username, u.first_name, u.phone, u.email, u.active, u.profile_img, og.grp_name, d.department_name, dg.designation_name');
        $this->db->from('users u'); 
        $this->db->join('department d', 'd.id = u.emp_department', 'LEFT');
        $this->db->join('designation dg', 'dg.id = u.emp_designation', 'LEFT');
        $this->db->join('office_groups og', 'og.id = u.sc_group_id', 'LEFT');
        // }
        $this->db->where('u.active', $active);
        $this->db->where('u.is_employee', 1);        
        $this->db->limit($limit);
        $this->db->offset($offset);
        $this->db->order_by('u.sl_no', 'ASC');

        // Search Filter
        if($this->input->get('department') != NULL){
            $this->db->where('u.emp_department', $this->input->get('department')); 
        }
        if($this->input->get('designation') != NULL){
            $this->db->where('u.emp_designation', $this->input->get('designation')); 
        }

        $query = $this->db->get()->result();    
        $result['rows'] = $query;
        // echo $this->db->last_query(); exit;

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('users');        

        $this->db->where('active',  $active);
        $this->db->where('is_employee', 1);

       
        // Search Filter
        if($this->input->get('department') != NULL){
            $this->db->where('emp_department', $this->input->get('department')); 
        }
        if($this->input->get('designation') != NULL){
            $this->db->where('emp_designation', $this->input->get('designation')); 
        }

        $query = $this->db->get()->result();

        $tmp = $query;
        $result['num_rows'] = $tmp[0]->count;

        return $result;
    }

    public function get_employee2($limit=1000, $offset=0, $region_id=NULL, $sc_district_id=NULL, $sc_upa_tha_id=NULL, $sc_scout_group_id=NULL, $active=NULL) {
        // echo 'hello'; exit;
        $this->db->select('u.id, u.pds_id, u.active, u.username,  u.first_name, u.phone, u.email, u.active,  u.profile_img, og.grp_name, d.department_name, dg.designation_name');
        $this->db->from('users u'); 
        $this->db->join('department d', 'd.id = u.emp_department', 'LEFT');
        $this->db->join('designation dg', 'dg.id = u.emp_designation', 'LEFT');
        $this->db->join('office_groups og', 'og.id = u.sc_group_id', 'LEFT');
        // }
        $this->db->where('u.active', $active);
        $this->db->where('u.is_employee', 1);        
        $this->db->where('u.office_id_type', 1);        
        $this->db->limit($limit);
        $this->db->offset($offset);
        $this->db->order_by('u.id', 'DESC');

        // Search Filter
        if($this->input->get('department') != NULL){
            $this->db->where('u.emp_department', $this->input->get('department')); 
        }
        if($this->input->get('designation') != NULL){
            $this->db->where('u.emp_designation', $this->input->get('designation')); 
        }

        $query = $this->db->get()->result();    
        $result['rows'] = $query;
        // echo $this->db->last_query(); exit;

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('users');        

        $this->db->where('active',  $active);
        $this->db->where('is_employee', 1);

       
        // Search Filter
        if($this->input->get('department') != NULL){
            $this->db->where('emp_department', $this->input->get('department')); 
        }
        if($this->input->get('designation') != NULL){
            $this->db->where('emp_designation', $this->input->get('designation')); 
        }

        $query = $this->db->get()->result();

        $tmp = $query;
        $result['num_rows'] = $tmp[0]->count;

        return $result;
    }

    public function get_single_employee($id) {
        $this->db->select('u.id, u.pds_id, u.username, u.office_id_type,  u.first_name, u.phone, u.email, u.active,  u.profile_img, og.grp_name, d.department_name, dg.designation_name, dg.designation_name_en, u.qr_img, bg.bg_name_en');
        $this->db->from('users u'); 
        $this->db->join('department d', 'd.id = u.emp_department', 'LEFT');
        $this->db->join('designation dg', 'dg.id = u.emp_designation', 'LEFT');
        $this->db->join('office_groups og', 'og.id = u.sc_group_id', 'LEFT');
        $this->db->join('blood_group bg', 'bg.id = u.blood_group', 'LEFT');

        $this->db->where('u.id', $id);
        $this->db->where('u.is_employee', 1);        
        $this->db->order_by('u.id', 'DESC');

        // Search Filter
        if($this->input->get('department') != NULL){
            $this->db->where('u.emp_department', $this->input->get('department')); 
        }
        if($this->input->get('designation') != NULL){
            $this->db->where('u.emp_designation', $this->input->get('designation')); 
        }

        $query = $this->db->get()->row();    

        return $query;
    }

    public function get_last_pds_id($pdsIDType) {
        $maxid=0;
        $query = $this->db->from('users')
                        ->where('pds_id_type', $pdsIDType)
                        ->order_by('id', DESC)
                        ->get()->row();
        if ($query) {
            $maxid = $query->pds_id; 
        }
        return $maxid;
    }

    public function set_emp_qrcode($id, $filename) {
        $data = array('qr_img' => $filename);
        $this->db->where('id', $id);
        $this->db->update('users', $data); 

        return true;
    }

}
