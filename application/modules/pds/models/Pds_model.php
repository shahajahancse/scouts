<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pds_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_info($id){
        $this->db->select('p.*, bg.bg_name_en, ms.ms_name_en');
        $this->db->from('pds p');
        $this->db->join('blood_group bg', 'bg.id = p.bg_id', 'LEFT');
        $this->db->join('marital_status ms', 'ms.id = p.ms_id', 'LEFT'); 
        $this->db->where('p.id', $id);
        $query = $this->db->get()->row();

        return $query;
    }

    public function set_emp_qrcode($id, $filename) {
        $data = array('qr_img' => $filename);
        $this->db->where('id', $id);
        $this->db->update('pds', $data); 

        return true;
    }

    public function get_pds_details($id){
        $this->db->select('p.*, bg.bg_name_en, ms.ms_name_en');
        $this->db->from('pds p');
        $this->db->join('blood_group bg', 'bg.id = p.bg_id', 'LEFT');
        $this->db->join('marital_status ms', 'ms.id = p.ms_id', 'LEFT'); 
        $this->db->where('p.id', $id);
        $result['info'] = $this->db->get()->row();

        //Education
        $this->db->select('pe.*, e.edu_level_name');
        $this->db->from('pds_education pe');        
        $this->db->join('education_level e', 'e.id = pe.exam_id', 'LEFT');
        $this->db->where('pe.data_id', $id);                
        $result['education'] = $this->db->get()->result();

        //Work Station
        $this->db->select('*, TIMESTAMPDIFF( YEAR, date_from, date_to ) as _year, TIMESTAMPDIFF( MONTH, date_from, date_to ) % 12 as _month, FLOOR( TIMESTAMPDIFF( DAY, date_from, date_to ) % 30.4375 ) as _day');
        $this->db->from('pds_work_station');        
        $this->db->where('data_id', $id);                
        $result['work_station'] = $this->db->get()->result();
        // echo $this->db->last_query(); exit;

        return $result;
    }

    public function get_pds_report(){
        $this->db->select('*');
        $this->db->from('pds');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get()->result();
        // $result['pds_rows'] = $query;

        // $this->db->select('*');
        // $this->db->from('pds');
        // $this->db->order_by('id', 'DESC');
        // $query = $this->db->get()->result();
        // $result['working_rows'] = $query;

        return $query;
    }

    public function get_work_station_by_id($id){
        $this->db->select('*, TIMESTAMPDIFF( YEAR, date_from, date_to ) as _year, TIMESTAMPDIFF( MONTH, date_from, date_to ) % 12 as _month, FLOOR( TIMESTAMPDIFF( DAY, date_from, date_to ) % 30.4375 ) as _day');
        $this->db->from('pds_work_station');        
        $this->db->where('data_id', $id);                
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_pds_list($limit, $offset) {
        // result query
        $this->db->select('*');
        $this->db->from('pds');
        $this->db->limit($limit);
        $this->db->offset($offset);
        // $this->db->join('committee_type ct', 'ct.id = c.comm_type_id', 'LEFT');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get()->result();
        $result['rows'] = $query;

        // count query
        $this->db->select('COUNT(*) as count');
        $query = $this->db->get('pds')->result();
        $tmp = $query;
        $result['num_rows'] = $tmp[0]->count;
        // echo $this->db->last_query(); exit;

        return $result;
    }

    public function get_last_pds_id() {
        //$row = $this->db->query('SELECT scout_id, MAX(id) AS `maxid` FROM `users` WHERE scout_id != NULL')->row();
        $row = $this->db->query('SELECT MAX(pds_id) AS `pdsID` FROM `pds`')->row();
        // echo $this->db->last_query(); exit;
        if ($row) {
            $maxid = $row->pdsID; 
        }else{
            echo 'Something is wrong!'; exit;
        }

        return $maxid;
    }

    /************************* Award Circular ***********************
    /****************************************************************/

    

    

    public function get_award_circular_current(){
        $data[''] = '-- Select Award Circular --';
        $this->db->select('id, circular_title');
        $this->db->from('award_circular');
        $this->db->where('group_end_date >=', date('Y-m-d'));
        $this->db->where('status', 1);
        $query = $this->db->get();

        foreach ($query->result_array() AS $rows) {
            $data[$rows['id']] = $rows['circular_title'];
        }

        return $data;
    }

    public function get_scouts_member_info($id) {
        $this->db->select('u.id, u.first_name, u.full_name_bn, u.father_name, u.mother_name, u.dob, DATE_FORMAT(dob,"%d-%m-%Y") AS dobDate, YEAR(CURDATE()) - YEAR(dob) AS ageYear, MONTH(dob) - MONTH(CURDATE()) AS ageMonth, DAY(CURDATE()) - DAY(dob) AS ageDay, u.gender, u.phone, u.email, u.pre_village_house, u.pre_road_block, u.pre_post_office, u.per_village_house, u.per_road_block, u.per_post_office, dv.div_name as pre_div_name, dv2.div_name as per_div_name, ds.district_name as pre_district_name, ds2.district_name as per_district_name, ut.up_th_name as pre_up_th_name, ut2.up_th_name as per_up_th_name, r.region_name, od.dis_name, ou.upa_name, og.grp_name, unit.unit_name, bt.badge_type_name_bn, rt.role_type_name_bn');
        $this->db->from('users u');
        // $this->db->join('occupation oc', 'oc.id=u.occupation_id', 'LEFT');
        // $this->db->join('blood_group bg', 'bg.id=u.blood_group', 'LEFT');
        $this->db->join('upazila_thana ut', 'ut.id=u.pre_upa_tha_id', 'LEFT');
        $this->db->join('upazila_thana ut2', 'ut2.id=u.per_upa_tha_id', 'LEFT');
        $this->db->join('district ds', 'ds.id=u.pre_district_id', 'LEFT');
        $this->db->join('district ds2', 'ds2.id=u.per_district_id', 'LEFT');
        $this->db->join('division dv', 'dv.id=u.pre_division_id', 'LEFT');
        $this->db->join('division dv2', 'dv2.id=u.per_division_id', 'LEFT');
        $this->db->join('office_unit unit', 'unit.id = u.sc_unit_id', 'LEFT');
        $this->db->join('office_groups og', 'og.id = u.sc_group_id', 'LEFT');
        $this->db->join('office_upazila ou', 'ou.id = u.sc_upa_tha_id', 'LEFT');
        $this->db->join('office_district od', 'od.id = u.sc_district_id', 'LEFT');
        $this->db->join('office_region r', 'r.id = u.sc_region_id', 'LEFT');
        // $this->db->join('institute it', 'it.id = u.curr_institute_id', 'LEFT');
        // $this->db->join('member_type mt', 'mt.id = u.member_id', 'LEFT');
        $this->db->join('scout_badge sb', 'sb.id = u.sc_badge_id', 'LEFT');
        $this->db->join('badge_type bt','bt.id = sb.badge_type_id', 'LEFT');
        $this->db->join('scout_role so', 'so.id = u.sc_role_id', 'LEFT');
        $this->db->join('role_type rt', 'rt.id = so.role_type_id', 'LEFT');

        $this->db->where('u.id', $id);
        $query = $this->db->get()->row();

        return $query;
    }


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

    //or.region_name, od.dis_name, ou.upa_name, og.grp_name, ct.committee_type_name
    public function get_sc_gourp_recommended_circular_list($limit=1000, $offset=0, $region_id=NULL, $district_id=NULL, $upazila_id=NULL, $group_id=NULL) {
        // result query
        $this->db->select('r.*, ac.circular_title');
        $this->db->from('award_recommendation r');
        $this->db->join('award_circular ac', 'ac.id = r.circular_id', 'LEFT');
        // $this->db->join('office_region or', 'or.id = c.region_id', 'LEFT');   
        // $this->db->join('office_district od', 'od.id = c.district_id', 'LEFT');   
        // $this->db->join('office_upazila ou', 'ou.id = c.upazila_id', 'LEFT');  
        // $this->db->join('office_groups og', 'og.id = c.group_id', 'LEFT');  
        $this->db->limit($limit);
        $this->db->offset($offset);     
        $this->db->group_by('r.circular_id');
        $this->db->order_by('r.id', 'DESC');

        if($region_id){
            $this->db->where('r.sc_region_id', $region_id);
            $query = $this->db->get()->result();
        }elseif($district_id){
            $this->db->where('r.sc_district_id', $district_id);
            $query = $this->db->get()->result();
        }elseif($upazila_id){
            $this->db->where('r.sc_upzaila_id', $upazila_id);
            $query = $this->db->get()->result();
        }elseif($group_id){
            $this->db->where('r.sc_group_id', $group_id);
            $query = $this->db->get()->result();    
        }else{
            $query = $this->db->get()->result();
        }      
        $result['rows'] = $query;  

        // count query
        // $q = $this->db->select('COUNT(*) as count');
        // $this->db->from('award_recommendation');  
        // $this->db->group_by('circular_id');

        // // Scout office
        // if($region_id){
        //     $this->db->where('region_id', $region_id);
        //     $query = $this->db->get()->result();
        // }elseif($district_id){
        //     $this->db->where('district_id', $district_id);
        //     $query = $this->db->get()->result();
        // }elseif($upazila_id){
        //     $this->db->where('upazila_id', $upazila_id);
        //     $query = $this->db->get()->result();
        // }elseif($group_id){
        //     $this->db->where('sc_group_id', $group_id);
        //     $query = $this->db->get()->result(); 
        // }else{
        //     $query = $this->db->get()->result();
        // }

        // $tmp = $query;
        // $result['num_rows'] = $tmp[0]->count;
        // echo $this->db->last_query(); exit;

        return $result;
    }


    //or.region_name, od.dis_name, ou.upa_name, og.grp_name, ct.committee_type_name
    public function get_recommended_list_by_office($circularID) {
        // result query
        $this->db->select('*');
        $this->db->from('award_circular');        
        $this->db->where('id', $circularID);
        $result['info'] = $this->db->get()->row();            


        $this->db->select('r.*, a.award_name_bn');
        $this->db->from('award_recommendation r');
        $this->db->join('scout_nhq_award a', 'a.id = r.recom_award_id', 'LEFT');
        $this->db->order_by('r.id', 'DESC');
        $this->db->where('r.circular_id', $circularID);
        $result['rows'] = $this->db->get()->result();    

        return $result;
    }

    public function get_award_approved_list_by_circular($circularID) {
        // result query
        $this->db->select('*');
        $this->db->from('award_circular');        
        $this->db->where('id', $circularID);
        $result['info'] = $this->db->get()->row();            


        $this->db->select('r.*, a.award_name_bn');
        $this->db->from('award_recommendation r');
        $this->db->join('scout_nhq_award a', 'a.id = r.recom_award_id', 'LEFT');
        $this->db->order_by('r.id', 'DESC');
        $this->db->where('r.circular_id', $circularID);
        $this->db->where('r.verify_nhq', 'Approved');
        $result['rows'] = $this->db->get()->result();    

        return $result;
    }

    public function get_recommendation_status($recommID) {
        $this->db->select('r.*, a.award_name_bn, ac.circular_title');
        $this->db->from('award_recommendation r');
        $this->db->join('scout_nhq_award a', 'a.id = r.recom_award_id', 'LEFT');
        $this->db->join('award_circular ac', 'ac.id = r.circular_id', 'LEFT');
        $this->db->where('r.id', $recommID);
        $query = $this->db->get()->row();    

        return $query;
    }

    public function get_recommendation_details($recommID) {
        $this->db->select('r.*, a.award_name_bn');
        $this->db->from('award_recommendation r');
        $this->db->join('scout_nhq_award a', 'a.id = r.recom_award_id', 'LEFT');
        $this->db->where('r.id', $recommID);
        $result['info'] = $this->db->get()->row();    

        //Experience
        $this->db->select('a.*, o.office_type_name, c.committee_designation_name');
        $this->db->from('award_recom_scouter_responsibility a');        
        $this->db->join('office_type o', 'o.id = a.res_office_id', 'LEFT');
        $this->db->join('committee_designation c', 'c.id = a.res_desig_id', 'LEFT');        
        $this->db->where('a.data_id', $recommID);                
        $result['scouter_respon'] = $this->db->get()->result();

        //Experience
        $this->db->select('a.*, o.office_type_name, c.committee_designation_name');
        $this->db->from('award_recom_exe_non_exe_responsibility a');        
        $this->db->join('office_type o', 'o.id = a.noe_office_id', 'LEFT');
        $this->db->join('committee_designation c', 'c.id = a.noe_desig_id', 'LEFT');        
        $this->db->where('a.data_id', $recommID);                
        $result['non_exe_respon'] = $this->db->get()->result();

        //Experience
        $this->db->select('a.*, s.award_name_bn');
        $this->db->from('award_recom_archived a');        
        $this->db->join('scout_nhq_award s', 's.id = a.award_nhq_id', 'LEFT');
        $this->db->where('a.data_id', $recommID);                
        $result['award_achived'] = $this->db->get()->result();        

        return $result;
    }

    public function recommendation_destroy($id) {
        // Delete data
        if($this->db->delete('award_recommendation', array('id' => $id))){
            return TRUE;
        }
        return FALSE;
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
