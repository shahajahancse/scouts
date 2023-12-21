<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Offices_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }     

    /********************** Scouts Group Office *********************
    ****************************************************************/

    public function get_scout_group($limit=1000, $offset=0, $region_id=NULL, $sc_district_id=NULL, $sc_upa_tha_id=NULL, $office_sc_group_id=NULL) {
        // result query
    	  // 
        $this->db->select('og.*, r.region_name, od.dis_name, ou.upa_name, u.username');
        $this->db->from('office_groups og');
        $this->db->join('office_region r', 'r.id = og.grp_region_id', 'LEFT');
        $this->db->join('office_district od', 'od.id = og.grp_scout_dis_id', 'LEFT');
        $this->db->join('office_upazila ou', 'ou.id = og.grp_scout_upa_id', 'LEFT');
        $this->db->join('users u', 'u.id = og.user_id', 'LEFT');
        $this->db->limit($limit);
        $this->db->offset($offset);
        $this->db->order_by('id', 'DESC');
        
        if($this->input->get('region') != NULL){
            $this->db->where('og.grp_region_id', $this->input->get('region')); 
        }
        if($this->input->get('district') > '0'){
            $this->db->where('og.grp_scout_dis_id', $this->input->get('district'));     
        }
        if($this->input->get('upazila') > '0'){
            $this->db->where('og.grp_scout_upa_id', $this->input->get('upazila'));     
        }
        if($this->input->get('grpName') != NULL){
            $this->db->like('og.grp_name', $this->input->get('grpName'));
            // $this->db->or_like('og.grp_name_bn', $this->input->get('grpName'));
        }
        if($this->input->get('uName') != NULL){
            $this->db->where('u.username', $this->input->get('uName')); 
        }
        if($this->input->get('charter') != NULL){
            $this->db->like('og.grp_charter', $this->input->get('charter'));
            // $this->db->or_like('og.grp_name_bn', $this->input->get('grpName'));
        }
        

        // Scout office
        if($region_id){
            $this->db->where('og.grp_region_id', $region_id);
            $query = $this->db->get()->result();
        }elseif($sc_district_id){
            $this->db->where('og.grp_scout_dis_id', $sc_district_id);
            $query = $this->db->get()->result();
        }elseif($sc_upa_tha_id){
            $this->db->where('og.grp_scout_upa_id', $sc_upa_tha_id);
            $query = $this->db->get()->result();
        }elseif($office_sc_group_id){
            $this->db->where('og.id', $office_sc_group_id);
            $query = $this->db->get()->result();
        }else{
            $query = $this->db->get()->result();
        }        
        $result['rows'] = $query;

        // count query
        //,  u.username
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('office_groups');        
        $this->db->join('users u', 'u.id = office_groups.user_id', 'LEFT');
        if($this->input->get('region') != NULL){
            $this->db->where('grp_region_id', $this->input->get('region')); 
        }
        if($this->input->get('district') > '0'){
            $this->db->where('grp_scout_dis_id', $this->input->get('district'));     
        }
        if($this->input->get('upazila') > '0'){
            $this->db->where('grp_scout_upa_id', $this->input->get('upazila'));     
        }
        if($this->input->get('grpName') != NULL){
            $this->db->like('grp_name', $this->input->get('grpName'));
            // $this->db->or_like('grp_name_bn', $this->input->get('grpName'));
        }
        if($this->input->get('uName') != NULL){
            $this->db->where('u.username', $this->input->get('uName')); 
        }
        if($this->input->get('charter') != NULL){
            $this->db->like('grp_charter', $this->input->get('charter'));
            // $this->db->or_like('og.grp_name_bn', $this->input->get('grpName'));
        }

        // Scout office
        if($region_id){
            $this->db->where('grp_region_id', $region_id);
            $query = $this->db->get()->result();
        }elseif($sc_district_id){
            $this->db->where('grp_scout_dis_id', $sc_district_id);
            $query = $this->db->get()->result();
        }elseif($sc_upa_tha_id){
            $this->db->where('grp_scout_upa_id', $sc_upa_tha_id);
            //echo $this->db->last_query();
            $query = $this->db->get()->result();
        }elseif($office_sc_group_id){
            $this->db->where('id', $office_sc_group_id);
            $query = $this->db->get()->result();
        }else{
            $query = $this->db->get()->result();
        }

        $tmp = $query;
        $result['num_rows'] = $tmp[0]->count;
        // echo $this->db->last_query(); exit;

        return $result;
    }

    public function get_scout_group_count($region_id=NULL, $sc_district_id=NULL, $sc_upa_tha_id=NULL) {
        // count query
        $this->db->select('COUNT(*) as count');
        $this->db->where('grp_status', 1);
        // Scout office
        if(!empty($region_id)){
            $this->db->where('grp_region_id', $region_id);
        }
        if(!empty($sc_district_id)){
            $this->db->where('grp_scout_dis_id', $sc_district_id);
        }
        if(!empty($sc_upa_tha_id)){
            $this->db->where('grp_scout_upa_id', $sc_upa_tha_id);
        }

        $tmp = $this->db->get('office_groups')->result();
        // echo $this->db->last_query(); exit;        
        $ret = $tmp[0]->count;
        return $ret;

        /*if($region_id){
            $this->db->where('grp_region_id', $region_id);
            $query = $this->db->get()->result();
        }elseif($sc_district_id){
            $this->db->where('grp_scout_dis_id', $sc_district_id);
            $query = $this->db->get()->result();
        }elseif($sc_upa_tha_id){
            $this->db->where('grp_scout_upa_id', $sc_upa_tha_id);
            $query = $this->db->get()->result();
        }else{
            $query = $this->db->get()->result();
        }*/
        // echo $this->db->last_query();
        // $tmp = $query;
        // $result = $tmp[0]->count;
        // echo $this->db->last_query(); exit;



        // return $result;
    }

    public function get_scout_group_pdf($region_id=NULL, $sc_district_id=NULL, $sc_upa_tha_id=NULL, $office_sc_group_id=NULL) {
        // result query
          // 
        $this->db->select('og.*, r.region_name, od.dis_name, ou.upa_name, u.username');
        $this->db->from('office_groups og');
        $this->db->join('office_region r', 'r.id = og.grp_region_id', 'LEFT');
        $this->db->join('office_district od', 'od.id = og.grp_scout_dis_id', 'LEFT');
        $this->db->join('office_upazila ou', 'ou.id = og.grp_scout_upa_id', 'LEFT');
        $this->db->join('users u', 'u.id = og.user_id', 'LEFT');
        $this->db->order_by('id', 'DESC');
        
        if($this->input->get('region') != NULL){
            $this->db->where('og.grp_region_id', $this->input->get('region')); 
        }
        if($this->input->get('district') > '0'){
            $this->db->where('og.grp_scout_dis_id', $this->input->get('district'));     
        }
        if($this->input->get('upazila') > '0'){
            $this->db->where('og.grp_scout_upa_id', $this->input->get('upazila'));     
        }
        if($this->input->get('grpName') != NULL){
            $this->db->like('og.grp_name', $this->input->get('grpName'));
            // $this->db->or_like('og.grp_name_bn', $this->input->get('grpName'));
        }
        if($this->input->get('uName') != NULL){
            $this->db->where('u.username', $this->input->get('uName')); 
        }

        // Scout office
        if($region_id){
            $this->db->where('og.grp_region_id', $region_id);
            $query = $this->db->get()->result();
        }elseif($sc_district_id){
            $this->db->where('og.grp_scout_dis_id', $sc_district_id);
            $query = $this->db->get()->result();
        }elseif($sc_upa_tha_id){
            $this->db->where('og.grp_scout_upa_id', $sc_upa_tha_id);
            $query = $this->db->get()->result();
        }elseif($office_sc_group_id){
            $this->db->where('og.id', $office_sc_group_id);
            $query = $this->db->get()->result();
        }else{
            $query = $this->db->get()->result();
        }        
        $result['rows'] = $query;

        // count query
        //,  u.username
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('office_groups');        
        $this->db->join('users u', 'u.id = office_groups.user_id', 'LEFT');
        if($this->input->get('region') != NULL){
            $this->db->where('grp_region_id', $this->input->get('region')); 
        }
        if($this->input->get('district') > '0'){
            $this->db->where('grp_scout_dis_id', $this->input->get('district'));     
        }
        if($this->input->get('upazila') > '0'){
            $this->db->where('grp_scout_upa_id', $this->input->get('upazila'));     
        }
        if($this->input->get('grpName') != NULL){
            $this->db->like('grp_name', $this->input->get('grpName'));
            // $this->db->or_like('grp_name_bn', $this->input->get('grpName'));
        }
        if($this->input->get('uName') != NULL){
            $this->db->where('u.username', $this->input->get('uName')); 
        }

        // Scout office
        if($region_id){
            $this->db->where('grp_region_id', $region_id);
            $query = $this->db->get()->result();
        }elseif($sc_district_id){
            $this->db->where('grp_scout_dis_id', $sc_district_id);
            $query = $this->db->get()->result();
        }elseif($sc_upa_tha_id){
            $this->db->where('grp_scout_upa_id', $sc_upa_tha_id);
            //echo $this->db->last_query();
            $query = $this->db->get()->result();
        }elseif($office_sc_group_id){
            $this->db->where('id', $office_sc_group_id);
            $query = $this->db->get()->result();
        }else{
            $query = $this->db->get()->result();
        }

        $tmp = $query;
        $result['num_rows'] = $tmp[0]->count;
        // echo $this->db->last_query(); exit;

        return $result;
    }

    public function get_scout_group_info($id) {
        $this->db->select('og.*, r.region_name, r.region_name_en, od.dis_name, od.dis_name_en, ou.upa_name, ou.upa_name_en, i.name AS institute_name, u.username, ugl.scout_id, ugl.first_name');
        $this->db->from('office_groups og');
        $this->db->join('office_region r', 'r.id = og.grp_region_id', 'LEFT');
        $this->db->join('office_district od', 'od.id = og.grp_scout_dis_id', 'LEFT');
        $this->db->join('office_upazila ou', 'ou.id = og.grp_scout_upa_id', 'LEFT');        
        $this->db->join('institute i', 'i.id = og.grp_institute_id', 'LEFT');  
        $this->db->join('users ugl', 'ugl.id = og.grp_leader', 'LEFT');      
        $this->db->join('users u', 'u.id = og.user_id', 'LEFT');      
        $this->db->where('og.id', $id);
        $query = $this->db->get()->row();
        return $query;
    }

    public function get_scout_group_by_user_id($id) {
        // $this->db->select('username');
        $this->db->from('office_groups');
        $this->db->where('user_id', $id);
        $query =  $this->db->get()->row();
        return $query;
    }

    public function get_committee_by_scout_group_office_id($group_office_id) {
        // result query
        $this->db->select('csg.*, or.region_name, od.dis_name, ou.upa_name, og.grp_name');
        $this->db->from('committee_exe_scout_group csg');
        $this->db->join('office_groups og', 'og.id = csg.office_sc_group_id', 'LEFT');
        $this->db->join('office_upazila ou', 'ou.id = csg.office_upa_tha_id', 'LEFT');
        $this->db->join('office_district od', 'od.id = csg.office_district_id', 'LEFT');
        $this->db->join('office_region or', 'or.id = csg.office_region_id', 'LEFT');    
        $this->db->order_by('csg.id', 'DESC');

        $this->db->where('csg.office_sc_group_id', $group_office_id);
        $query = $this->db->get()->result();
        // echo $this->db->last_query(); exit;

        return $query;
    }

    public function get_scout_unit_by_group_office_id($group_office_id) {
        // result query
        $this->db->select('u.*, r.region_name, od.dis_name, ou.upa_name, og.id AS group_id, og.grp_name, og.grp_charter, og.grp_type');
        $this->db->from('office_unit u');
        $this->db->join('office_groups og', 'og.id = u.unit_sc_grp_id', 'LEFT');
        $this->db->join('office_upazila ou', 'ou.id = u.unit_scout_upa_id', 'LEFT');
        $this->db->join('office_district od', 'od.id = u.unit_scout_dis_id', 'LEFT');
        $this->db->join('office_region r', 'r.id = u.unit_region_id', 'LEFT');

        $this->db->where('u.unit_sc_grp_id', $group_office_id);
        $query = $this->db->get()->result();
        //echo $this->db->last_query(); exit;

        return $query;
    }

    public function get_count_scouts_members($group_id) {
        $result = array();
        
        // count query
        $this->db->select('COUNT(*) as count');
        $this->db->from('users');
        $this->db->where('scout_id IS NOT NULL', NULL);
        $this->db->where('sc_group_id', $group_id); 
        $q = $this->db->get()->result();

        $result = $q[0]->count;
        return $result;
    }

    public function get_count_scouts_group_by_district($districtID) {
        $result = array();
        
        // count query
        $this->db->select('COUNT(*) as count');
        $this->db->from('office_groups');
        $this->db->where('grp_scout_dis_id', $districtID); 
        $q = $this->db->get()->result();
        // echo $this->db->last_query();
        // print_r($q); exit;
        $result = $q[0]->count;
        return $result;
    }    


    public function scout_group_destroy($id) {
        $info = $this->get_scout_group_info($id);
        
        // Delete User
        if($this->db->delete('users', array('id' => $info->user_id))){
            // Delete Unit
            $this->db->delete('office_unit', array('unit_sc_grp_id' => $id));

            // Delete Scouts Group
            $this->db->delete('office_groups', array('id' => $id));
            return TRUE;
        }
        return FALSE;
    }

    public function scout_unit_destroy($id) {
        if($this->db->delete('office_unit', array('id' => $id))){
            return TRUE;
        }
        return FALSE;
    }

    /********************** Scouts Upazila Office *******************
    ****************************************************************/

    public function get_scout_upazila($region_id=NULL, $sc_district_id=NULL, $office_upa_tha_id=NULL) {
        // result query
        $this->db->select('ou.*, r.region_name, od.dis_name, u.username');
        $this->db->from('office_upazila ou');
        $this->db->join('office_region r', 'r.id = ou.upa_region_id', 'LEFT');
        $this->db->join('office_district od', 'od.id = ou.upa_scout_dis_id', 'LEFT');
        $this->db->join('users u', 'u.id = ou.user_id', 'LEFT');

        if($this->input->get('region') != NULL){
            $this->db->where('ou.upa_region_id', $this->input->get('region')); 
        }
        if($this->input->get('district') > '0'){
            $this->db->where('ou.upa_scout_dis_id', $this->input->get('district'));     
        }  
        if($this->input->get('upaName') != NULL){
            $this->db->like('ou.upa_name', $this->input->get('upaName'));
            $this->db->or_like('ou.upa_name_en', $this->input->get('upaName'));
        }
        if($this->input->get('uName') != NULL){
            $this->db->where('u.username', $this->input->get('uName')); 
        }      

        if($region_id){
            $this->db->where('ou.upa_region_id', $region_id);
            $query = $this->db->get()->result();
        }elseif($sc_district_id){
            $this->db->where('ou.upa_scout_dis_id', $sc_district_id);
            $query = $this->db->get()->result();
        }elseif($office_upa_tha_id){
            $this->db->where('ou.id', $office_upa_tha_id);
            $query = $this->db->get()->result();    
        }else{
            $query = $this->db->get()->result();
        }

        return $query;
    }

    public function get_scout_upazila_info($id) {
        $this->db->select('ou.*, r.region_name, od.dis_name, u.username, ut.up_th_name, ds.district_name, dv.div_name');
        $this->db->from('office_upazila ou');
        $this->db->join('office_region r', 'r.id = ou.upa_region_id', 'LEFT');
        $this->db->join('office_district od', 'od.id = ou.upa_scout_dis_id', 'LEFT');
        $this->db->join('users u', 'u.id = ou.user_id', 'LEFT');   
        $this->db->join('upazila_thana ut', 'ut.id=ou.upa_upa_id', 'LEFT');
        $this->db->join('district ds', 'ds.id=ou.upa_dis_id', 'LEFT');
        $this->db->join('division dv', 'dv.id=ou.upa_div_id', 'LEFT');
        $this->db->where('ou.id', $id);
        $query = $this->db->get()->row();
        return $query;
    }

    public function get_upazila_office_by_user_id($id) {
        // $this->db->select('username');
        $this->db->from('office_upazila');
        $this->db->where('user_id', $id);
        $query =  $this->db->get()->row();
        return $query;
    }

    public function upazila_reset_username($id) {
        $this->db->where('id', $id);
        $this->db->update('office_upazila', array('user_id' => 0 ));
        return $query;
    }

    public function upazila_destroy($id) {
        $info = $this->get_scout_upazila_info($id);

        // Delete User
        if($this->db->delete('users', array('id' => $info->user_id))){
            // Delete Scouts District
            $this->db->delete('office_upazila', array('id' => $id));
            return TRUE;
        }
        return FALSE;
    }
    
    public function get_count_scouts_group_by_upazila($upazilaID) {
        $result = array();
        
        // count query
        $this->db->select('COUNT(*) as count');
        $this->db->from('office_groups');
        $this->db->where('grp_scout_upa_id', $upazilaID); 
        $q = $this->db->get()->result();
        // echo $this->db->last_query();
        // print_r($q); exit;
        $result = $q[0]->count;
        return $result;
    }    

    /********************** Scouts District Office ******************
    ****************************************************************/

    public function get_scout_district_info($id) {
        $this->db->select('od.*, r.region_name, sd.district_type_name, u.username, ds.district_name, dv.div_name');
        $this->db->from('office_district od');
        $this->db->join('office_region r', 'r.id = od.dis_scout_region_id', 'LEFT');
        $this->db->join('scout_district_type sd', 'sd.id = od.dis_type', 'LEFT');
        $this->db->join('users u', 'u.id = od.user_id', 'LEFT');   
        $this->db->join('district ds', 'ds.id=od.dis_dis_id', 'LEFT');
        $this->db->join('division dv', 'dv.id=od.dis_div_id', 'LEFT');     
        $this->db->where('od.id', $id);
        $query = $this->db->get()->row();
        return $query;
    }

    public function get_district_office_by_user_id($id) {
        // $this->db->select('username');
        $this->db->from('office_district');
        $this->db->where('user_id', $id);
        $query =  $this->db->get()->row();
        return $query;
    }

    public function get_scout_district($region_id=NULL) {
        // result query
        $this->db->select('od.*, d.div_name, ds.district_name, r.region_name, u.username');
        $this->db->from('office_district od');
        $this->db->join('division d', 'd.id = od.dis_div_id', 'LEFT');
        $this->db->join('district ds', 'ds.id = od.dis_dis_id', 'LEFT');
        $this->db->join('office_region r', 'r.id = od.dis_scout_region_id', 'LEFT');
        $this->db->join('users u', 'u.id = od.user_id', 'LEFT');       

        if($this->input->get('region') > '0'){
            $this->db->where('od.dis_scout_region_id', $this->input->get('region'));     
        }
        if($this->input->get('disName') != NULL){
            $this->db->like('od.dis_name', $this->input->get('disName'));
            $this->db->or_like('od.dis_name_en', $this->input->get('disName'));
        }
        if($this->input->get('uName') != NULL){
            $this->db->where('u.username', $this->input->get('uName')); 
        }
        
        // Result
        if($region_id){
            $this->db->where('od.dis_scout_region_id', $region_id);
            $query = $this->db->get()->result();
        }else{
            $query = $this->db->get()->result();
        }
        // echo $this->db->last_query(); exit;

        return $query;
    }

    public function district_destroy($id) {
        $info = $this->get_scout_district_info($id);

        // Delete User
        if($this->db->delete('users', array('id' => $info->user_id))){
            // Delete Scouts District
            $this->db->delete('office_district', array('id' => $id));
            return TRUE;
        }
        return FALSE;
    }

    /********************** Scouts Region Office ********************
    ****************************************************************/

    public function get_region_info($id) {
        $this->db->select('r.*, u.username, d.div_name');
        $this->db->from('office_region r');
        $this->db->join('users u', 'u.id=r.region_user_id', 'LEFT');
        $this->db->join('division d', 'd.id=r.region_div_id', 'LEFT');
        $this->db->where('r.id', $id);
        $query =  $this->db->get()->row();
        return $query;
    }    

    public function get_region_office_by_user_id($id) {
        // $this->db->select('username');
        $this->db->from('office_region');
        $this->db->where('region_user_id', $id);
        $query =  $this->db->get()->row();
        return $query;
    }    

    public function get_region($region_id=NULL) {
        // result query
        $this->db->select('r.*, d.div_name, u.username');
        $this->db->from('office_region r');
        $this->db->join('division d', 'd.id=r.region_div_id', 'LEFT');        
        $this->db->join('users u', 'u.id=r.region_user_id', 'LEFT');        

        if($region_id){
            $this->db->where('r.id', $region_id);
            $query = $this->db->get()->result();
        }else{
            $query = $this->db->get()->result();
        }

        return $query;
    }

    public function get_count_scouts_district_by_region($regionID) {
        $result = array();
        
        // count query
        $this->db->select('COUNT(*) as count');
        $this->db->from('office_district');
        $this->db->where('dis_scout_region_id', $regionID); 
        $q = $this->db->get()->result();
        // echo $this->db->last_query();
        // print_r($q); exit;
        $result = $q[0]->count;
        return $result;
    }

    public function region_destroy($id) {
        $info = $this->get_region_info($id);

        // Delete User
        if($this->db->delete('users', array('id' => $info->region_user_id))){
            // Delete Scouts Region
            $this->db->delete('office_region', array('id' => $id));
            return TRUE;
        }
        return FALSE;
    }  
    

    /*********************** Scouts NHQ Office *********************
    ****************************************************************/

    public function get_nhq() {
        // result query
        $this->db->select('o.*, u.id as userid, u.username');
        $this->db->from('office_nhq o');
        $this->db->join('users u', 'u.id=o.nhq_user_id', 'LEFT');        
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_nhq_office_by_user_id($id) {
        // $this->db->select('username');
        $this->db->from('office_nhq');
        $this->db->where('nhq_user_id', $id);
        $query =  $this->db->get()->row();
        return $query;
    }

    public function get_nhq_office_user_id($id) {
        $this->db->select('id, nhq_user_id');
        $this->db->from('office_nhq');
        $this->db->where('id', $id);
        $query = $this->db->get()->row();
        return $query;
    }

    public function get_nhq_user_info($id) {
        $this->db->select('o.*, u.username');
        $this->db->from('office_nhq o');
        $this->db->join('users u', 'u.id = o.nhq_user_id', 'LEFT');      
        $this->db->where('o.id', $id);
        $query = $this->db->get()->row();
        return $query;
    }

    public function nhq_user_destroy($officeID) {
        $userID = $this->Offices_model->get_nhq_office_user_id($officeID)->nhq_user_id;

        // Delete User
        if($this->db->delete('users', array('id' => $userID))){
            // Delete Scouts Region
            $this->db->delete('office_nhq', array('id' => $officeID));
            return TRUE;
        }
        return FALSE;
    }


    /********************** Scout Unit Office *********************
    ****************************************************************/

    public function get_scout_unit($region_id=NULL, $sc_district_id=NULL, $sc_upa_tha_id=NULL, $sc_scout_group_id=NULL ) {
        // result query
        $this->db->select('u.*, r.region_name, od.dis_name, ou.upa_name, og.grp_name, og.grp_charter, og.   grp_type');
        $this->db->from('office_unit u');
        $this->db->join('office_groups og', 'og.id = u.unit_sc_grp_id', 'LEFT');
        $this->db->join('office_upazila ou', 'ou.id = u.unit_scout_upa_id', 'LEFT');
        $this->db->join('office_district od', 'od.id = u.unit_scout_dis_id', 'LEFT');
        $this->db->join('office_region r', 'r.id = u.unit_region_id', 'LEFT');

        if($region_id){
            $this->db->where('u.unit_region_id', $region_id);
            $query = $this->db->get()->result();
        }elseif($sc_district_id){
            $this->db->where('u.unit_scout_dis_id', $sc_district_id);
            $query = $this->db->get()->result();
        }elseif($sc_upa_tha_id){
            $this->db->where('u.unit_scout_upa_id', $sc_upa_tha_id);
            $query = $this->db->get()->result();
        }elseif($sc_scout_group_id){
            $this->db->where('u.unit_sc_grp_id', $sc_scout_group_id);
            $query = $this->db->get()->result();
            //echo $this->db->last_query(); exit;
        }else{
            $query = $this->db->get()->result();
        }

        return $query;
    }

    public function get_scout_unit_info($id) {
        $this->db->select('u.*, r.region_name, r.region_name_en, od.dis_name, od.dis_name_en,  ou.upa_name, ou.upa_name_en, og.grp_name, og.grp_charter, us.username, us.scout_id, us.first_name');
        $this->db->from('office_unit u');
        $this->db->join('office_groups og', 'og.id = u.unit_sc_grp_id', 'LEFT');
        $this->db->join('office_region r', 'r.id = u.unit_region_id', 'LEFT');
        $this->db->join('office_district od', 'od.id = u.unit_scout_dis_id', 'LEFT');
        $this->db->join('office_upazila ou', 'ou.id = u.unit_scout_upa_id', 'LEFT');     
        $this->db->join('users us', 'us.id = u.unit_leader', 'LEFT');        
        $this->db->where('u.id', $id);
        $query = $this->db->get()->row();
        return $query;
    }
    
    public function exists_scout_group_charter_no($item) {       
        $this->db->from('office_groups');
        $this->db->where('grp_charter', $item);
        $query = $this->db->get();
        // return ($query->num_rows() >= 1);
        if ($query->num_rows() == 0) {
            return 'true';
        }else{
            return 'false';
        }
    }

    public function update_username($data, $user_id){
        $this->db->where('id', $user_id);
        if($this->db->update('users', $data)){
            return true;
        }else{
            return false;
        }
    }

    public function get_user_group($ids) {
        // result query
        $this->db->select('id, name, description');
        $this->db->from('groups');
        $this->db->where_in('id', $ids);
        $query = $this->db->get();
        return $query;
    }


    /******************* Office Admin User List ********************
    ****************************************************************/

    public function get_scout_member_by_group($regionID=NULL, $districtID=NULL, $upazilaID=NULL, $groupID=NULL){
        $data[''] = '-- Select One --';
        $this->db->select('u.id, u.scout_id, u.first_name, u.sc_section_id, u.profile_img, bt.badge_type_name_bn');
        $this->db->from('users u'); 
        $this->db->join('member_type mt', 'mt.id = u.member_id', 'LEFT');
        $this->db->join('scout_badge sb', 'sb.id = u.sc_badge_id', 'LEFT');
        $this->db->join('badge_type bt','bt.id = sb.badge_type_id', 'LEFT');
        $this->db->where('u.scout_id IS NOT NULL', NULL);

        if($regionID){
            $this->db->where('u.sc_region_id', $regionID);            
        }
        if($districtID){
            $this->db->where('u.sc_district_id', $districtID);
        }
        if($upazilaID){
            $this->db->where('u.sc_upa_tha_id', $upazilaID);
        }
        if($groupID){
            $this->db->where('u.sc_group_id', $groupID);
        }

                
        $this->db->order_by('u.scout_id', 'DESC');
        $query = $this->db->get();
        // echo $this->db->last_query(); exit;
        foreach ($query->result_array() AS $rows) {
            $data[$rows['id']] =  $rows['scout_id'].' - '.$rows['first_name'] .' ('.$rows['badge_type_name_bn'].')';
        }
        return $data;
    }

    public function get_office_users($officeType, $officeID) {
        $this->db->select('oou.*, u.member_id, u.sc_section_id, u.scout_id, u.first_name, u.phone, u.email, u.scout_designation, or.region_name_en, od.dis_name_en, ou.upa_name_en, og.grp_name, rt.role_type_name_bn, rt.role_type_name_en');
        $this->db->from('office_users oou');
        $this->db->join('users u', 'u.id = oou.scout_member_id', 'LEFT');
        $this->db->join('office_region or', 'or.id = oou.sc_region_id', 'LEFT');
        $this->db->join('office_district od', 'od.id = oou.sc_district_id', 'LEFT');
        $this->db->join('office_upazila ou', 'ou.id = oou.sc_upazila_id', 'LEFT');
        $this->db->join('office_groups og', 'og.id = oou.sc_group_id', 'LEFT');
        $this->db->join('scout_role so', 'so.id = u.sc_role_id', 'LEFT');
        $this->db->join('role_type rt', 'rt.id = so.role_type_id', 'LEFT');

        if($officeType == 2){
            $this->db->where('oou.sc_region_id', $officeID);
        }elseif($officeType == 3){
            $this->db->where('oou.sc_district_id', $officeID);
        }elseif($officeType == 4){
            $this->db->where('oou.sc_upazila_id', $officeID);
        }elseif($officeType == 5){
            $this->db->where('oou.sc_group_id', $officeID);
        }

        $query =  $this->db->get()->result();
        // echo $this->db->last_query(); exit;
        return $query;
    }

    public function get_office_user_info($id) {
        $this->db->select('o.*, u.scout_id, u.first_name, or.region_name_en, od.dis_name_en, ou.upa_name_en, og.grp_name');   
        $this->db->from('office_users o');
        $this->db->join('users u', 'u.id = o.scout_member_id', 'LEFT');
        $this->db->join('office_region or', 'or.id = o.sc_region_id', 'LEFT');
        $this->db->join('office_district od', 'od.id = o.sc_district_id', 'LEFT');
        $this->db->join('office_upazila ou', 'ou.id = o.sc_upazila_id', 'LEFT');
        $this->db->join('office_groups og', 'og.id = o.sc_group_id', 'LEFT');
        $this->db->where('o.id', $id);
        $query = $this->db->get()->row();
        return $query;
    }

    public function office_user_destroy($id) {
        // Delete User
        if($this->db->delete('office_users', array('id' => $id))){
            return TRUE;
        }
        return FALSE;
    }  


    /********************** Cross Check Office *********************
    ****************************************************************/

    public function check_office_access_district($officeID, $region_id=NULL, $sc_district_id=NULL){

        $this->db->select('COUNT(*) as count');

        $this->db->where('id', $officeID);
        if($region_id){ $this->db->where('dis_scout_region_id', $region_id);}
        if($sc_district_id){ $this->db->where('id', $sc_district_id); }

        $query = $this->db->get('office_district')->row();
        // echo $this->db->last_query(); exit;

        return $query->count >= 1 ? TRUE : FALSE;      
    }

    public function check_office_access_upazila($officeID, $region_id=NULL, $sc_district_id=NULL, $sc_upa_tha_id=NULL){

        $this->db->select('COUNT(*) as count');
        $this->db->where('id', $officeID);
        if($region_id){ $this->db->where('upa_region_id', $region_id);}
        if($sc_district_id){ $this->db->where('upa_scout_dis_id', $sc_district_id); }
        if($sc_upa_tha_id){ $this->db->where('id', $sc_upa_tha_id); }

        $query = $this->db->get('office_upazila')->row();
        // echo $this->db->last_query(); exit;

        return $query->count >= 1 ? TRUE : FALSE;      
    } 

    public function check_office_access_scouts_group($region_id=NULL, $sc_district_id=NULL, $sc_upa_tha_id=NULL){

        $this->db->select('COUNT(*) as count');

        if($region_id){ $this->db->where('grp_region_id', $region_id); }
        if($sc_district_id){ $this->db->where('grp_scout_dis_id', $sc_district_id); }
        if($sc_upa_tha_id){ $this->db->where('grp_scout_upa_id', $sc_upa_tha_id); }
        $query = $this->db->get('office_groups')->row();

        return $query->count >= 1 ? TRUE : FALSE;
    } 


    public function cross_check_scouts_member($scoutID, $region_id=NULL, $district_id=NULL, $upazila_id=NULL, $group_id=NULL){

        $this->db->select('COUNT(*) as count');
        if($region_id){ $this->db->where('sc_region_id', $region_id); }
        if($district_id){ $this->db->where('sc_district_id', $district_id); }
        if($upazila_id){ $this->db->where('sc_upa_tha_id', $upazila_id); }
        if($group_id){ $this->db->where('sc_group_id', $group_id); }

        $this->db->where('id', $scoutID);    
        $query = $this->db->get('users')->row();
        //echo $this->db->last_query(); exit;

        return $query->count >= 1 ? TRUE : FALSE;
    }


    public function check_access_scouts_group($groupID, $region_id=NULL, $sc_district_id=NULL, $sc_upa_tha_id=NULL){

        $this->db->select('COUNT(*) as count');
        $this->db->from('office_groups');    
        $this->db->where('id', $groupID);    

        if($region_id){
            $this->db->where('grp_region_id', $region_id);
        }elseif($sc_district_id){
            $this->db->where('grp_scout_dis_id', $sc_district_id);
        }elseif($sc_upa_tha_id){
            $this->db->where('grp_scout_upa_id', $sc_upa_tha_id);
        }
        $query = $this->db->get()->row();
        // echo $this->db->last_query();
        // print_r($query); exit;
        // echo $query->count; exit;

        if($query->count){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    // function pri_email_exists($email){
    //     $this->db->from('users');   
    //     $this->db->where('email',$email);
    //     $this->db->limit(1);
    //     $query = $this->db->get();

    //     if($query->num_rows()==1){
    //         return true;
    //     }else{
    //         return false;
    //     }
    // }

    
    // public function region_reset_username($id) {
    //     $this->db->where('id', $id);
    //     $this->db->update('office_region', array('region_user_id' => 0 ));
    //     return $query;
    // }

    // public function district_reset_username($id) {
    //     $this->db->where('id', $id);
    //     $this->db->update('office_district', array('user_id' => 0 ));
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

}
