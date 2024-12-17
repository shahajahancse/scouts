<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Committee_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /************************* Distirct Committee *********************
    /****************************************************************/

    public function get_scout_group_committee($limit=1000, $offset=0, $region_id=NULL, $district_id=NULL, $upazila_id=NULL, $group_id=NULL) {
        // result query
        $this->db->select('c.*, or.region_name, od.dis_name, ou.upa_name, og.grp_name, ct.committee_type_name');
        $this->db->from('committee_group c');
        $this->db->join('office_region or', 'or.id = c.region_id', 'LEFT');   
        $this->db->join('office_district od', 'od.id = c.district_id', 'LEFT');   
        $this->db->join('office_upazila ou', 'ou.id = c.upazila_id', 'LEFT');  
        $this->db->join('office_groups og', 'og.id = c.group_id', 'LEFT');  
        $this->db->join('committee_type ct', 'ct.id = c.comm_type_id', 'LEFT');
        $this->db->limit($limit);
        $this->db->offset($offset);     
        $this->db->order_by('c.id', 'DESC');

        if($region_id){
            $this->db->where('c.region_id', $region_id);
            $query = $this->db->get()->result();
        }elseif($district_id){
            $this->db->where('c.district_id', $district_id);
            $query = $this->db->get()->result();
        }elseif($upazila_id){
            $this->db->where('c.upazila_id', $upazila_id);
            $query = $this->db->get()->result();
        }elseif($group_id){
            $this->db->where('c.group_id', $group_id);
            $query = $this->db->get()->result();    
        }else{
            $query = $this->db->get()->result();
        }      
        $result['rows'] = $query;  

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('committee_group');  

        // Scout office
        if($region_id){
            $this->db->where('region_id', $region_id);
            $query = $this->db->get()->result();
        }elseif($district_id){
            $this->db->where('district_id', $district_id);
            $query = $this->db->get()->result();
        }elseif($upazila_id){
            $this->db->where('upazila_id', $upazila_id);
            $query = $this->db->get()->result();
        }elseif($group_id){
            $this->db->where('group_id', $group_id);
            $query = $this->db->get()->result(); 
        }else{
            $query = $this->db->get()->result();
        }

        $tmp = $query;
        $result['num_rows'] = $tmp[0]->count;
        // echo $this->db->last_query(); exit;

        return $result;
    }

    public function get_scout_group_committee_info($id) {
        // result query 
        $query = array();

        $this->db->select('c.*, or.region_name, od.dis_name, ou.upa_name, og.grp_name, ct.committee_type_name');
        $this->db->from('committee_group c');
        $this->db->join('office_region or', 'or.id = c.region_id', 'LEFT');   
        $this->db->join('office_district od', 'od.id = c.district_id', 'LEFT');   
        $this->db->join('office_upazila ou', 'ou.id = c.upazila_id', 'LEFT');  
        $this->db->join('office_groups og', 'og.id = c.group_id', 'LEFT');  
        $this->db->join('committee_type ct', 'ct.id = c.comm_type_id', 'LEFT');
        $this->db->where('c.id', $id);
        $query['info'] = $this->db->get()->row();

        // Committee Members
        $this->db->select('cm.*, u.scout_id, u.first_name, u.first_name, u.phone, u.email, u.id AS user_id, dg.committee_designation_name');
        $this->db->from('committee_group_member cm');
        $this->db->join('users u', 'u.id = cm.member_scout_id', 'LEFT');
        $this->db->join('committee_designation dg', 'dg.id = cm.member_comm_desig_id', 'LEFT');
        $this->db->where('cm.committee_id', $id);
        $this->db->order_by('cm.sl_no', 'ASC');
        $query['members'] = $this->db->get()->result();

        return $query;        
    }

    public function get_scout_group_member_check_duplicate($form_data) {
        $this->db->select('*');
        $this->db->from('committee_group_member');         
        $this->db->where('member_scout_id', $form_data['member_scout_id']);        
        $this->db->where('committee_id', $form_data['committee_id']);
        $result = $this->db->get()->result();
        
        return $result;
    }

    public function get_scout_group_committee_member($form_data) {
        $query = array();

        $this->db->select('cm.*, u.scout_id, u.first_name, u.phone, u.email, u.id AS user_id, dg.committee_designation_name');
        $this->db->from('committee_group_member cm');
        $this->db->join('users u', 'u.id = cm.member_scout_id', 'LEFT');
        $this->db->join('committee_designation dg', 'dg.id = cm.member_comm_desig_id', 'LEFT');
        $this->db->where('cm.committee_id', $form_data['committee_id']);
        $this->db->order_by('cm.sl_no', 'ASC');
        $query = $this->db->get()->result();

        return $query;        
    }

    public function scout_group_destroy($id) {
        // Delete committee member
        if($this->db->delete('committee_group_member', array('committee_id' => $id))){
            // Delete committee
            $this->db->delete('committee_group', array('id' => $id));
            return TRUE;
        }
        return FALSE;
    }

    /************************* Distirct Committee *********************
    /****************************************************************/

    public function get_upazila_committee($limit=1000, $offset=0, $region_id=NULL, $district_id=NULL, $upazila_id=NULL) {
        // result query
        $this->db->select('c.*, or.region_name, od.dis_name, ou.upa_name, ct.committee_type_name');
        $this->db->from('committee_upazila c');
        $this->db->join('office_region or', 'or.id = c.region_id', 'LEFT');   
        $this->db->join('office_district od', 'od.id = c.district_id', 'LEFT');   
        $this->db->join('office_upazila ou', 'ou.id = c.upazila_id', 'LEFT');  
        $this->db->join('committee_type ct', 'ct.id = c.comm_type_id', 'LEFT');
        $this->db->limit($limit);
        $this->db->offset($offset);     
        $this->db->order_by('c.id', 'DESC');

        if($region_id){
            $this->db->where('c.region_id', $region_id);
            $query = $this->db->get()->result();
        }elseif($district_id){
            $this->db->where('c.district_id', $district_id);
            $query = $this->db->get()->result();
        }elseif($upazila_id){
            $this->db->where('c.upazila_id', $upazila_id);
            $query = $this->db->get()->result();
        }else{
            $query = $this->db->get()->result();
        }      
        $result['rows'] = $query;  

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('committee_upazila');  

        // Scout office
        if($region_id){
            $this->db->where('region_id', $region_id);
            $query = $this->db->get()->result();
        }elseif($district_id){
            $this->db->where('district_id', $district_id);
            $query = $this->db->get()->result();
        }elseif($upazila_id){
            $this->db->where('upazila_id', $upazila_id);
            $query = $this->db->get()->result();
        }else{
            $query = $this->db->get()->result();
        }

        $tmp = $query;
        $result['num_rows'] = $tmp[0]->count;
        // echo $this->db->last_query(); exit;

        return $result;
    }

    public function get_upazila_committee_info($id) {
        // result query 
        $query = array();

        $this->db->select('c.*, or.region_name, od.dis_name, ou.upa_name, ct.committee_type_name');
        $this->db->from('committee_upazila c');
        $this->db->join('office_region or', 'or.id = c.region_id', 'LEFT');   
        $this->db->join('office_district od', 'od.id = c.district_id', 'LEFT');   
        $this->db->join('office_upazila ou', 'ou.id = c.upazila_id', 'LEFT');   
        $this->db->join('committee_type ct', 'ct.id = c.comm_type_id', 'LEFT');
        $this->db->where('c.id', $id);
        $query['info'] = $this->db->get()->row();

        // Committee Members
        $this->db->select('cm.*, u.scout_id, u.first_name, u.first_name, u.phone, u.email, u.id AS user_id, dg.committee_designation_name');
        $this->db->from('committee_upazila_member cm');
        $this->db->join('users u', 'u.id = cm.member_scout_id', 'LEFT');
        $this->db->join('committee_designation dg', 'dg.id = cm.member_comm_desig_id', 'LEFT');
        $this->db->where('cm.committee_id', $id);
        $this->db->order_by('cm.sl_no', 'ASC');
        $query['members'] = $this->db->get()->result();

        return $query;        
    }

    public function get_upazila_member_check_duplicate($form_data) {
        $this->db->select('*');
        $this->db->from('committee_upazila_member');         
        $this->db->where('member_scout_id', $form_data['member_scout_id']);        
        $this->db->where('committee_id', $form_data['committee_id']);
        $result = $this->db->get()->result();
        
        return $result;
    }

    public function get_upazila_committee_member($form_data) {
        $query = array();

        $this->db->select('cm.*, u.scout_id, u.first_name, u.phone, u.email, u.id AS user_id, dg.committee_designation_name');
        $this->db->from('committee_upazila_member cm');
        $this->db->join('users u', 'u.id = cm.member_scout_id', 'LEFT');
        $this->db->join('committee_designation dg', 'dg.id = cm.member_comm_desig_id', 'LEFT');
        $this->db->where('cm.committee_id', $form_data['committee_id']);
        $this->db->order_by('cm.sl_no', 'ASC');
        $query = $this->db->get()->result();

        return $query;        
    }

    public function upazila_destroy($id) {
        // Delete committee member
        if($this->db->delete('committee_upazila_member', array('committee_id' => $id))){
            // Delete committee
            $this->db->delete('committee_upazila', array('id' => $id));
            return TRUE;
        }
        return FALSE;
    }

    /************************* Distirct Committee *********************
    /****************************************************************/

    public function get_district_committee($limit=1000, $offset=0, $region_id=NULL, $district_id=NULL) {
        // result query
        $this->db->select('c.*, or.region_name, od.dis_name, ct.committee_type_name');
        $this->db->from('committee_district c');
        $this->db->join('office_region or', 'or.id = c.region_id', 'LEFT');   
        $this->db->join('office_district od', 'od.id = c.district_id', 'LEFT');   
        $this->db->join('committee_type ct', 'ct.id = c.comm_type_id', 'LEFT');
        $this->db->limit($limit);
        $this->db->offset($offset);     
        $this->db->order_by('c.id', 'DESC');

        if($region_id){
            $this->db->where('c.region_id', $region_id);
            $query = $this->db->get()->result();
        }elseif($district_id){
            $this->db->where('c.district_id', $district_id);
            $query = $this->db->get()->result();
        }else{
            $query = $this->db->get()->result();
        }      
        $result['rows'] = $query;  

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('committee_district');  

        // Scout office
        if($region_id){
            $this->db->where('region_id', $region_id);
            $query = $this->db->get()->result();
        }elseif($district_id){
            $this->db->where('district_id', $district_id);
            $query = $this->db->get()->result();
        }else{
            $query = $this->db->get()->result();
        }

        $tmp = $query;
        $result['num_rows'] = $tmp[0]->count;
        // echo $this->db->last_query(); exit;

        return $result;
    }

    public function get_district_committee_info($id) {
        // result query 
        $query = array();

        $this->db->select('c.*, or.region_name, od.dis_name, ct.committee_type_name');
        $this->db->from('committee_district c');
        $this->db->join('office_region or', 'or.id = c.region_id', 'LEFT');   
        $this->db->join('office_district od', 'od.id = c.district_id', 'LEFT');   
        $this->db->join('committee_type ct', 'ct.id = c.comm_type_id', 'LEFT');
        $this->db->where('c.id', $id);
        $query['info'] = $this->db->get()->row();

        // Committee Members
        $this->db->select('cm.*, u.scout_id, u.first_name, u.first_name, u.phone, u.email, u.id AS user_id, dg.committee_designation_name');
        $this->db->from('committee_district_member cm');
        $this->db->join('users u', 'u.id = cm.member_scout_id', 'LEFT');
        $this->db->join('committee_designation dg', 'dg.id = cm.member_comm_desig_id', 'LEFT');
        $this->db->where('cm.committee_id', $id);
        $this->db->order_by('cm.sl_no', 'ASC');
        $query['members'] = $this->db->get()->result();

        return $query;        
    }

    public function get_district_member_check_duplicate($form_data) {
        $this->db->select('*');
        $this->db->from('committee_district_member');         
        $this->db->where('member_scout_id', $form_data['member_scout_id']);        
        $this->db->where('committee_id', $form_data['committee_id']);
        $result = $this->db->get()->result();
        
        return $result;
    }

    public function get_district_committee_member($form_data) {
        $query = array();

        $this->db->select('cm.*, u.scout_id, u.first_name, u.phone, u.email, u.id AS user_id, dg.committee_designation_name');
        $this->db->from('committee_district_member cm');
        $this->db->join('users u', 'u.id = cm.member_scout_id', 'LEFT');
        $this->db->join('committee_designation dg', 'dg.id = cm.member_comm_desig_id', 'LEFT');
        $this->db->where('cm.committee_id', $form_data['committee_id']);
        $this->db->order_by('cm.sl_no', 'ASC');
        $query = $this->db->get()->result();

        return $query;        
    }

    public function district_destroy($id) {
        // Delete committee member
        if($this->db->delete('committee_district_member', array('committee_id' => $id))){
            // Delete committee
            $this->db->delete('committee_district', array('id' => $id));
            return TRUE;
        }
        return FALSE;
    }


    /************************* Region Committee *********************
    /****************************************************************/
    public function get_region_committee($limit=1000, $offset=0, $region_id=NULL) {
        // result query
        $this->db->select('c.*, or.region_name, ct.committee_type_name');
        $this->db->from('committee_region c');
        $this->db->join('office_region or', 'or.id = c.region_id', 'LEFT');   
        $this->db->join('committee_type ct', 'ct.id = c.comm_type_id', 'LEFT');
        $this->db->limit($limit);
        $this->db->offset($offset);     
        $this->db->order_by('c.id', 'DESC');

        if($region_id){
            $this->db->where('c.region_id', $region_id);
            $query = $this->db->get()->result();  
        }else{
            $query = $this->db->get()->result();
        }      
        $result['rows'] = $query;  

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('committee_region');  

        // Scout office
        if($region_id){
            $this->db->where('region_id', $region_id);
            $query = $this->db->get()->result();
        }else{
            $query = $this->db->get()->result();
        }

        $tmp = $query;
        $result['num_rows'] = $tmp[0]->count;
        // echo $this->db->last_query(); exit;

        return $result;
    }

    public function get_region_committee_info($id) {
        // result query 
        $query = array();

        $this->db->select('c.*, or.region_name, ct.committee_type_name');
        $this->db->from('committee_region c');
        $this->db->join('office_region or', 'or.id = c.region_id', 'LEFT');   
        $this->db->join('committee_type ct', 'ct.id = c.comm_type_id', 'LEFT');
        $this->db->where('c.id', $id);
        $query['info'] = $this->db->get()->row();

        // Committee Members
        $this->db->select('cm.*, u.scout_id, u.first_name, u.first_name, u.phone, u.email, u.id AS user_id, dg.committee_designation_name');
        $this->db->from('committee_region_member cm');
        $this->db->join('users u', 'u.id = cm.member_scout_id', 'LEFT');
        $this->db->join('committee_designation dg', 'dg.id = cm.member_comm_desig_id', 'LEFT');
        $this->db->where('cm.committee_id', $id);
        $this->db->order_by('cm.sl_no', 'ASC');
        $query['members'] = $this->db->get()->result();

        return $query;        
    }

    public function get_region_committee_member($form_data) {
        $query = array();

        $this->db->select('cm.*, u.scout_id, u.first_name, u.phone, u.email, u.id AS user_id, dg.committee_designation_name');
        $this->db->from('committee_region_member cm');
        $this->db->join('users u', 'u.id = cm.member_scout_id', 'LEFT');
        $this->db->join('committee_designation dg', 'dg.id = cm.member_comm_desig_id', 'LEFT');
        $this->db->where('cm.committee_id', $form_data['committee_id']);
        $this->db->order_by('cm.sl_no', 'ASC');
        $query = $this->db->get()->result();

        return $query;        
    }

    public function get_region_member_check_duplicate($form_data) {
        $this->db->select('*');
        $this->db->from('committee_region_member');         
        $this->db->where('member_scout_id', $form_data['member_scout_id']);        
        $this->db->where('committee_id', $form_data['committee_id']);
        $result = $this->db->get()->result();
        
        return $result;
    }

    public function region_destroy($id) {
        // Delete committee member
        if($this->db->delete('committee_region_member', array('committee_id' => $id))){
            // Delete committee
            $this->db->delete('committee_region', array('id' => $id));
            return TRUE;
        }
        return FALSE;
    }


    /************************ National Committee ********************
    /****************************************************************/

    public function get_national_committee() {
        // result query
        $this->db->select('c.*, ct.committee_type_name');
        $this->db->from('committee_national c');
        $this->db->join('committee_type ct', 'ct.id = c.comm_type_id', 'LEFT');
        $this->db->order_by('c.id', 'DESC');
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_national_committee_info($id) {
        // result query 
        $query = array();

        $this->db->select('c.*, ct.committee_type_name');
        $this->db->from('committee_national c');
        $this->db->join('committee_type ct', 'ct.id = c.comm_type_id', 'LEFT');
        $this->db->where('c.id', $id);
        $query['info'] = $this->db->get()->row();

        // Committee Members
        $this->db->select('nm.*, u.scout_id, u.first_name, u.first_name, u.phone, u.email, u.id AS user_id, dg.committee_designation_name');
        $this->db->from('committee_national_member nm');
        $this->db->join('users u', 'u.id = nm.member_scout_id', 'LEFT');
        $this->db->join('committee_designation dg', 'dg.id = nm.member_comm_desig_id', 'LEFT');
        $this->db->where('nm.committee_id', $id);
        $this->db->order_by('nm.sl_no', 'ASC');
        $query['members'] = $this->db->get()->result();

        return $query;        
    }

    public function get_national_committee_member($form_data) {
        $query = array();

        $this->db->select('nm.*, u.scout_id, u.first_name, u.phone, u.email, u.id AS user_id, dg.committee_designation_name');
        $this->db->from('committee_national_member nm');
        $this->db->join('users u', 'u.id = nm.member_scout_id', 'LEFT');
        $this->db->join('committee_designation dg', 'dg.id = nm.member_comm_desig_id', 'LEFT');
        $this->db->where('nm.committee_id', $form_data['committee_id']);
        $this->db->order_by('nm.sl_no', 'ASC');
        $query = $this->db->get()->result();

        return $query;        
    }

    public function get_member_check_duplicate($form_data) {
        $this->db->select('*');
        $this->db->from('committee_national_member');         
        $this->db->where('member_scout_id', $form_data['member_scout_id']);        
        $this->db->where('committee_id', $form_data['committee_id']);
        $result = $this->db->get()->result();
        return $result;
    }

    public function national_destroy($id) {
        // Delete committee member
        if($this->db->delete('committee_national_member', array('committee_id' => $id))){
            // Delete committee
            $this->db->delete('committee_national', array('id' => $id));
            return TRUE;
        }
        return FALSE;
    }
    

    /************************** Common Function *********************
    /****************************************************************/

    







    

    // public function get_scout_unit_committee_info($id) {
    //     // result query 
    //     $query = array();

    //     $this->db->select('csu.*, or.region_name, od.dis_name, ou.upa_name, og.grp_name, unit.unit_name');
    //     $this->db->from('committee_exe_scout_unit csu');
    //     $this->db->join('office_unit unit', 'unit.id = csu.office_sc_unit_id', 'LEFT');
    //     $this->db->join('office_groups og', 'og.id = csu.office_sc_group_id', 'LEFT');
    //     $this->db->join('office_upazila ou', 'ou.id = csu.office_upazila_id', 'LEFT');
    //     $this->db->join('office_district od', 'od.id = csu.office_district_id', 'LEFT');
    //     $this->db->join('office_region or', 'or.id = csu.office_region_id', 'LEFT');    
    //     $this->db->order_by('csu.id', 'DESC');
    //     $this->db->where('csu.id', $id);
    //     $query['info'] = $this->db->get()->row();        

    //     // Executive Members
    //     $this->db->select('msu.*, u.scout_id, u.first_name, u.id AS user_id, dg.committee_designation_name');
    //     $this->db->from('committee_member_scout_unit msu');
    //     $this->db->join('users u', 'u.id = msu.member_scout_id', 'LEFT');
    //     $this->db->join('committee_designation dg', 'dg.id = msu.member_scout_desig_id', 'LEFT');
    //     $this->db->where('msu.committee_id', $id);                
    //     $query['members'] = $this->db->get()->result();

    //     return $query;        
    // }

    // public function get_scout_group_committee_info($id) {
    //     // result query 
    //     $query = array();

    //     $this->db->select('csg.*, or.region_name, od.dis_name, ou.upa_name, og.grp_name');
    //     $this->db->from('committee_exe_scout_group csg');
    //     $this->db->join('office_groups og', 'og.id = csg.office_sc_group_id', 'LEFT');
    //     $this->db->join('office_upazila ou', 'ou.id = csg.office_upa_tha_id', 'LEFT');
    //     $this->db->join('office_district od', 'od.id = csg.office_district_id', 'LEFT');
    //     $this->db->join('office_region or', 'or.id = csg.office_region_id', 'LEFT');
    //     $this->db->order_by('csg.id', 'DESC');
    //     $this->db->where('csg.id', $id);
    //     $query['info'] = $this->db->get()->row();

    //     // Executive Members
    //     $this->db->select('msg.*, u.scout_id, u.first_name, u.id AS user_id, dg.committee_designation_name');
    //     $this->db->from('committee_member_scout_group msg');
    //     $this->db->join('users u', 'u.id = msg.member_scout_id', 'LEFT');
    //     $this->db->join('committee_designation dg', 'dg.id = msg.member_scout_desig_id', 'LEFT');
    //     $this->db->where('msg.committee_id', $id);                
    //     $query['members'] = $this->db->get()->result();

    //     return $query;        
    // }

    // public function get_upazila_committee_info($id) {
    //     // result query 
    //     $query = array();

    //     $this->db->select('cu.*,  ro.region_name, od.dis_name, ou.upa_name');
    //     $this->db->from('committee_exe_upazila cu');
    //     $this->db->join('office_upazila ou', 'ou.id = cu.office_upa_tha_id', 'LEFT');
    //     $this->db->join('office_district od', 'od.id = cu.office_district_id', 'LEFT');
    //     $this->db->join('office_region ro', 'ro.id=cu.office_region_id', 'LEFT');
    //     $this->db->where('cu.id', $id);
    //     $query['info'] = $this->db->get()->row();

    //     // Executive Members
    //     $this->db->select('mu.*, u.scout_id, u.first_name, u.id AS user_id, dg.committee_designation_name');
    //     $this->db->from('committee_member_upazila mu');
    //     $this->db->join('users u', 'u.id = mu.member_scout_id', 'LEFT');
    //     $this->db->join('committee_designation dg', 'dg.id = mu.member_scout_desig_id', 'LEFT');
    //     $this->db->where('mu.committee_id', $id);                
    //     $query['members'] = $this->db->get()->result();

    //     return $query;        
    // }

    

    




    
    

    // public function get_scout_unit_committee($region_id=NULL, $sc_district_id=NULL, $sc_upa_tha_id=NULL, $sc_group_id=NULL) {
    //     // result query
    //     $this->db->select('csu.*, or.region_name, od.dis_name, ou.upa_name, og.grp_name, unit.unit_name');
    //     $this->db->from('committee_exe_scout_unit csu');
    //     $this->db->join('office_unit unit', 'unit.id = csu.office_sc_unit_id', 'LEFT');
    //     $this->db->join('office_groups og', 'og.id = csu.office_sc_group_id', 'LEFT');
    //     $this->db->join('office_upazila ou', 'ou.id = csu.office_upazila_id', 'LEFT');
    //     $this->db->join('office_district od', 'od.id = csu.office_district_id', 'LEFT');
    //     $this->db->join('office_region or', 'or.id = csu.office_region_id', 'LEFT');    
    //     $this->db->order_by('csu.id', 'DESC');

    //     if($region_id){
    //         $this->db->where('csu.office_region_id', $region_id);
    //         $query = $this->db->get()->result();
    //     }elseif($sc_district_id){
    //         $this->db->where('csu.office_district_id', $sc_district_id);
    //         $query = $this->db->get()->result();
    //     }elseif($sc_upa_tha_id){
    //         $this->db->where('csu.office_upazila_id', $sc_upa_tha_id);
    //         $query = $this->db->get()->result();
    //     }elseif($sc_group_id){
    //         $this->db->where('csu.office_sc_group_id', $sc_group_id);
    //         $query = $this->db->get()->result();
    //         // echo $this->db->last_query(); exit;
    //     }else{
    //         $query = $this->db->get()->result();
    //     }
    //     return $query;
    // }


    // public function get_scout_group_committee($region_id=NULL, $sc_district_id=NULL, $sc_upa_tha_id=NULL, $sc_group_id=NULL) {
    //     // result query
    //     $this->db->select('csg.*, or.region_name, od.dis_name, ou.upa_name, og.grp_name');
    //     $this->db->from('committee_exe_scout_group csg');
    //     $this->db->join('office_groups og', 'og.id = csg.office_sc_group_id', 'LEFT');
    //     $this->db->join('office_upazila ou', 'ou.id = csg.office_upa_tha_id', 'LEFT');
    //     $this->db->join('office_district od', 'od.id = csg.office_district_id', 'LEFT');
    //     $this->db->join('office_region or', 'or.id = csg.office_region_id', 'LEFT');    
    //     $this->db->order_by('csg.id', 'DESC');

    //     if($region_id){
    //         $this->db->where('csg.office_region_id', $region_id);
    //         $query = $this->db->get()->result();
    //     }elseif($sc_district_id){
    //         $this->db->where('csg.office_district_id', $sc_district_id);
    //         $query = $this->db->get()->result();
    //     }elseif($sc_upa_tha_id){
    //         $this->db->where('csg.office_upa_tha_id', $sc_upa_tha_id);
    //         $query = $this->db->get()->result();
    //     }elseif($sc_group_id){
    //         $this->db->where('csg.office_sc_group_id', $sc_group_id);
    //         $query = $this->db->get()->result();
    //         // echo $this->db->last_query(); exit;
    //     }else{
    //         $query = $this->db->get()->result();
    //     }
    //     return $query;
    // }

    // public function get_upazila_thana_committee($region_id=NULL, $sc_district_id=NULL) {
    //     // result query
    //     $this->db->select('cu.*,  or.region_name, od.dis_name, ou.upa_name');
    //     $this->db->from('committee_exe_upazila cu');
    //     $this->db->join('office_upazila ou', 'ou.id = cu.office_region_id', 'LEFT');
    //     $this->db->join('office_district od', 'od.id = cu.office_district_id', 'LEFT');
    //     $this->db->join('office_region or', 'or.id = cu.office_region_id', 'LEFT');    
    //     $this->db->order_by('cu.id', 'DESC');

    //     if($region_id){
    //         $this->db->where('cu.office_region_id', $region_id);
    //         $query = $this->db->get()->result();
    //         // echo $this->db->last_query(); exit;
    //     }elseif($sc_district_id){
    //         $this->db->where('cu.office_district_id', $sc_district_id);
    //         $query = $this->db->get()->result();
    //     }else{
    //         $query = $this->db->get()->result();
    //     }
    //     return $query;
    // }

    // public function get_upazila_committee($upazila_id=NULL) {
    //     // result query
    //     $this->db->select('cu.*, cs.committee_session_name, or.region_name, od.dis_name, ou.upa_name');
    //     $this->db->from('committee_exe_upazila cu');
    //     $this->db->join('committee_session cs', 'cs.id = cu.comm_session_id', 'LEFT');
    //     $this->db->join('office_upazila ou', 'ou.id = cu.office_upa_tha_id', 'LEFT');
    //     $this->db->join('office_district od', 'od.id = cu.office_district_id', 'LEFT');
    //     $this->db->join('office_region or', 'or.id = cu.office_region_id', 'LEFT');        
    //     $this->db->order_by('cu.id', 'DESC');

    //     if($upazila_id){
    //         $this->db->where('cu.office_region_id', $region_id);
    //         $query = $this->db->get()->result();
    //     }else{
    //         $query = $this->db->get()->result();
    //     }

    //     return $query;
    // }
    
        
    
    

    

    // public function get_current_scout_unit_from_committee($user_id=null) {
    //     // result query
    //     $this->db->select('msu.committee_id, csu.office_region_id, csu.office_district_id, csu.office_upazila_id, csu.office_sc_group_id, csu.office_sc_unit_id, csu.is_current');
    //     $this->db->from('committee_member_scout_unit msu');
    //     $this->db->join('committee_exe_scout_unit csu', 'csu.id = msu.committee_id', 'LEFT');
    //     $this->db->where('msu.member_scout_id', $user_id);
    //     $this->db->order_by('msu.committee_id', 'DESC');
    //     $this->db->limit(1);
    //     $query = $this->db->get()->row();
    //     // echo $this->db->last_query(); exit;
    //     return $query;
    // }

    // public function get_current_scout_group_from_committee($user_id=null) {
    //     // result query
    //     $this->db->select('msg.committee_id, esg.office_region_id, esg.office_district_id, esg.office_upa_tha_id, esg.office_sc_group_id, esg.is_current');
    //     $this->db->from('committee_member_scout_group msg');
    //     $this->db->join('committee_exe_scout_group esg', 'esg.id = msg.committee_id', 'LEFT');
    //     $this->db->where('msg.member_scout_id', $user_id);
    //     $this->db->order_by('msg.committee_id', 'DESC');
    //     $this->db->limit(1);
    //     $query = $this->db->get()->row();
    //     // echo $this->db->last_query(); exit;
    //     return $query;
    // }

    // public function get_current_upazila_thana_from_committee($user_id=null) {
    //     // result query
    //     $this->db->select('mu.committee_id, eu.office_region_id, eu.office_district_id, eu.office_upa_tha_id, eu.is_current');
    //     $this->db->from('committee_member_upazila mu');
    //     $this->db->join('committee_exe_upazila eu', 'eu.id = mu.committee_id', 'LEFT');
    //     $this->db->where('mu.member_scout_id', $user_id);
    //     $this->db->order_by('mu.committee_id', 'DESC');
    //     $this->db->limit(1);
    //     $query = $this->db->get()->row();
    //     // echo $this->db->last_query(); exit;
    //     return $query;
    // }

    // public function get_current_district_from_committee($user_id=null) {
    //     // result query
    //     $this->db->select('md.committee_id, ed.office_region_id, ed.office_district_id, ed.is_current');
    //     $this->db->from('committee_member_district md');
    //     $this->db->join('committee_exe_district ed', 'ed.id = md.committee_id', 'LEFT');
    //     $this->db->where('md.member_scout_id', $user_id);
    //     // $this->db->where('ed.is_current', '1');
    //     $this->db->order_by('md.committee_id', 'DESC');
    //     $this->db->limit(1);
    //     $query = $this->db->get()->row();
    //     // echo $this->db->last_query(); exit;
    //     return $query;
    // }

    // public function get_current_region_from_committee($user_id=null) {
    //     // result query
    //     $this->db->select('mr.committee_id, er.office_region_id, er.is_current');
    //     $this->db->from('committee_member_region mr');
    //     $this->db->join('committee_exe_region er', 'er.id = mr.committee_id', 'LEFT');
    //     $this->db->where('mr.member_scout_id', $user_id);
    //     $this->db->order_by('mr.committee_id', 'DESC');
    //     $this->db->limit(1);
    //     $query = $this->db->get()->row();
    //     // echo $this->db->last_query(); exit;
    //     return $query;
    // }

    // public function get_post_office() {
    //     // result query
    //     $this->db->select('p.id, p.dis_id, p.po_name, p.code, p.status, ds.district_name');
    //     $this->db->from('post_office p');
    //     $this->db->join('district ds', 'ds.id=p.dis_id');

    //     $query = $this->db->get()->result();

    //     return $query;
    // }

    // public function get_district() {
    //     // result query
    //     $this->db->select('di.id, di.div_id, di.district_name, di.status, dv.div_name');
    //     $this->db->from('district di');
    //     $this->db->join('division dv', 'dv.id=di.div_id');
    //     $query = $this->db->get()->result();

    //     return $query;
    // }



    // public function get_info($id) {
    //     $query = $this->db->from('')
    //     ->where('id', $id)
    //     ->get()->row();
    //     return $query;
    // }

    // function delete($id) {

    //     $info = $this->get_info($id);

    //     // if(file_exists($img_path.$info->image_file)){
    //     //    @unlink($img_path.$info->image_file);
    //     //    @unlink($img_path_thumbs.$info->image_file);
    //     // }

    //     $this->db->where('id', $id);
    //     $this->db->delete('');
        
    //     return TRUE;
    // }

    //Name      :       get_scout_district
    //Created   :       3-10-17
    //Modified  :       4-10-17
    // public function get_scout_district() {
    //     // result query
    //     $this->db->select('A.*, B.div_name, C.district_name, D.region_name');
    //     $this->db->from('office_district A');
    //     $this->db->join('division B', 'B.id = A.dis_div_id', 'LEFT');     
    //     $this->db->join('district C', 'C.id = A.dis_dis_id', 'LEFT');       //4-10-17
    //     $this->db->join('office_region D', 'D.id = A.dis_scout_region_id', 'LEFT');       //4-10-17
    //     $query = $this->db->get()->result();

    //     return $query;
    // }

    //Name      :       get_scount_district_info
    //Created   :       3-10-17
    // public function get_scount_district_info($id) {
    //     $query = $this->db->from('office_district')->where('id', $id)->get()->row();
    //     return $query;
    // }

    //Name      :       get_scout_upazila
    //Created   :       4-10-17
    // public function get_scout_upazila() {
    //     // result query
    //     $this->db->select('A.*, B.div_name, C.dis_name');
    //     $this->db->from('office_upazila A');
    //     $this->db->join('division B', 'B.id = A.upa_div_id', 'LEFT');     
    //     $this->db->join('office_district C', 'C.id = A.upa_scout_dis_id', 'LEFT');       //4-10-17
    //     $query = $this->db->get()->result();

    //     return $query;
    // }

    //Name      :       get_scount_upazila_info
    //Created   :       4-10-17
    // public function get_scount_upazila_info($id) {
    //     $query = $this->db->from('office_upazila')->where('id', $id)->get()->row();
    //     return $query;
    // }

}
