<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Award_model extends CI_Model {

   public function __construct() {
      parent::__construct();
   }   

   public function get_cub_recommended_list($circularID) {
      // result query
      $this->db->select('*');
      $this->db->from('award_circular');        
      $this->db->where('id', $circularID);
      $result['info'] = $this->db->get()->row();            

      $this->db->select('r.*, u.first_name, u.father_name, u.phone, og.grp_name');
      $this->db->from('award_cub_recommendation r');
      $this->db->join('users u', 'u.id = r.scout_id', 'LEFT');
      $this->db->join('office_groups og', 'og.id = r.sc_group_id', 'LEFT');
      $this->db->order_by('r.id', 'DESC');
      $this->db->where('r.circular_id', $circularID);
      $result['rows'] = $this->db->get()->result();    

      return $result;
   }

   // dv.div_name as pre_div_name, dv2.div_name as per_div_name, ds.district_name as pre_district_name, ds2.district_name as per_district_name, ut.up_th_name as pre_up_th_name, ut2.up_th_name as per_up_th_name, r.region_name, od.dis_name, ou.upa_name, og.grp_name, unit.unit_name,  bg.bg_name_en, it.name as institute_name, u.curr_class, u.curr_role_no

   public function get_cub_recommendation_details($recommID) {
      $this->db->select('r.*, u.first_name, u.full_name_bn, u.scout_id, u.father_name, u.father_name_bn, u.mother_name, u.mother_name_bn, u.dob, u.gender, u.birth_id, u.phone, u.phone_emergency, u.email, u.pre_village_house, u.pre_road_block, u.pre_post_office, u.per_village_house, u.per_road_block, u.per_post_office, u.curr_class, u.curr_role_no, u.passport_no, u.join_date, bg.bg_name_en, dv.div_name as pre_div_name, dv2.div_name as per_div_name, ds.district_name as pre_district_name, ds2.district_name as per_district_name, ut.up_th_name as pre_up_th_name, ut2.up_th_name as per_up_th_name, it.name as institute_name, ro.region_name, ro.region_name_en, od.dis_name, od.dis_name_en, ou.upa_name, ou.upa_name_en, og.grp_name, og.grp_name_bn, unit.unit_name');
      $this->db->from('award_cub_recommendation r');
      $this->db->join('users u', 'u.id = r.scout_id', 'LEFT');
      $this->db->join('blood_group bg', 'bg.id=u.blood_group', 'LEFT');
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
      $this->db->join('office_region ro', 'ro.id = u.sc_region_id', 'LEFT');
      $this->db->join('institute it', 'it.id = u.curr_institute_id', 'LEFT');

      // $this->db->join('member_type mt', 'mt.id = u.member_id', 'LEFT');
      // $this->db->join('scout_badge sb', 'sb.id = u.sc_badge_id', 'LEFT');
      // $this->db->join('badge_type bt','bt.id = sb.badge_type_id', 'LEFT');
      // $this->db->join('scout_role so', 'so.id = u.sc_role_id', 'LEFT');
      // $this->db->join('role_type rt', 'rt.id = so.role_type_id', 'LEFT');
      $this->db->where('r.id', $recommID);
      $result['info'] = $this->db->get()->row();    

      return $result;
   }


   public function get_cub_evaluation($recommID) {
      $this->db->select('r.*, ac.circular_title, u.first_name, u.scout_id, u.dob, u.phone, u.pre_village_house, u.pre_road_block, u.pre_post_office, dv.div_name as pre_div_name, ds.district_name as pre_district_name, ut.up_th_name as pre_up_th_name, or.region_name, od.dis_name, ou.upa_name, og.grp_name');
      $this->db->from('award_cub_recommendation r');
      $this->db->join('award_circular ac', 'ac.id = r.circular_id', 'LEFT');
      $this->db->join('users u', 'u.id = r.scout_id', 'LEFT');
      $this->db->join('upazila_thana ut', 'ut.id = u.pre_upa_tha_id', 'LEFT');
      $this->db->join('district ds', 'ds.id = u.pre_district_id', 'LEFT');
      $this->db->join('division dv', 'dv.id = u.pre_division_id', 'LEFT');
      $this->db->join('office_region or', 'or.id = u.sc_region_id', 'LEFT');   
      $this->db->join('office_district od', 'od.id = u.sc_district_id', 'LEFT');   
      $this->db->join('office_upazila ou', 'ou.id = u.sc_upa_tha_id', 'LEFT');
      $this->db->join('office_groups og', 'og.id = u.sc_group_id', 'LEFT');
      $this->db->where('r.id', $recommID);
      $query = $this->db->get()->row();    

      return $query;
   }

   public function get_cub_approved_list($circularID) {
      // result query
      $this->db->select('*');
      $this->db->from('award_circular');        
      $this->db->where('id', $circularID);
      $result['info'] = $this->db->get()->row();            

      $this->db->select('r.*, u.first_name, u.scout_id, u.dob, u.phone, og.grp_name');
      $this->db->from('award_cub_recommendation r');
      $this->db->join('users u', 'u.id = r.scout_id', 'LEFT');
      $this->db->join('office_groups og', 'og.id = u.sc_group_id', 'LEFT');
      $this->db->where('r.circular_id', $circularID);
      $this->db->where('r.verify_nhq', 'Approved');
      $this->db->order_by('r.id', 'DESC');
      $result['rows'] = $this->db->get()->result();    

      return $result;
   }

   public function get_cub_certificate($id) {
      // result query
      $this->db->select('r.*, u.first_name, u.full_name_bn, u.scout_id, u.dob, u.phone, og.grp_name, og.grp_name_bn');
      $this->db->from('award_cub_recommendation r');
      $this->db->join('users u', 'u.id = r.scout_id', 'LEFT');
      $this->db->join('office_groups og', 'og.id = u.sc_group_id', 'LEFT');
      $this->db->where('r.verify_nhq', 'Approved');
      $this->db->where('r.id', $id);
      $result = $this->db->get()->row();  

      // echo $this->db->last_query(); exit;  
      return $result;
   }


   /************************* Award Circular ***********************
   /****************************************************************/
   public function is_apply_nhq_award($awardID){
        // echo 'Hello'; exit;
        $this->db->select('id, circular_id, scout_id');
        $this->db->from('award_recommendation');
        $this->db->where('circular_id', $awardID);
        $this->db->where('scout_id', $this->session->userdata('user_id'));
        $query = $this->db->get()->row();

        return $query; 
        // print_r($query); exit;
    }

   public function get_award_circular($limit, $offset, $awardType=NULL, $status=NULL) {
      $today = date('Y-m-d');
      // result query
      $this->db->select('a.*, t.at_name_en, t.at_name_bn');
      $this->db->from('award_circular a');
      $this->db->join('award_type t', 't.id = a.award_type_id', 'LEFT');
      $this->db->limit($limit);
      $this->db->offset($offset);        
      if($awardType){
         $this->db->where('a.award_type_id', $awardType);            
      }
      if($status){
         $this->db->where('a.status', $status);            
      }
      // if($this->ion_auth->is_region_admin()){
      //     $this->db->where('a.region_end_date >=', $today);
      // }
      // if($this->ion_auth->is_district_admin()){
      //     $this->db->where('a.district_end_date >=', $today);
      // }
      // if($this->ion_auth->is_upazila_admin()){
      //     $this->db->where('a.upazila_end_date >=', $today);
      // }
      // if($this->ion_auth->is_group_admin()){
      //     $this->db->where('a.group_end_date >=', $today);
      // }
      // if($this->ion_auth->is_scout_member()){
      //    $this->db->where('a.group_end_date >=', $today);  
      // }

      // $this->db->join('committee_type ct', 'ct.id = c.comm_type_id', 'LEFT');
      $this->db->order_by('id', 'DESC');
      $query = $this->db->get()->result();
      $result['rows'] = $query;

      // echo $this->db->last_query(); exit;

      // count query
      $this->db->select('COUNT(*) as count');
      if($awardType){
         $this->db->where('award_type_id', $awardType);
      }
      if($status){
         $this->db->where('status', $status);
      }
      // if($this->ion_auth->is_region_admin()){
      //     $this->db->where('region_end_date >=', $today);
      // }
      // if($this->ion_auth->is_district_admin()){
      //     $this->db->where('district_end_date >=', $today);
      // }
      // if($this->ion_auth->is_upazila_admin()){
      //     $this->db->where('upazila_end_date >=', $today);
      // }
      // if($this->ion_auth->is_group_admin()){
      //     $this->db->where('group_end_date >=', $today);
      // }
      $query = $this->db->get('award_circular')->result();
      $tmp = $query;
      $result['num_rows'] = $tmp[0]->count;
      // echo $this->db->last_query(); exit;

      return $result;
   }

   public function get_award_circular_info($id){
      $this->db->select('*');
      $this->db->from('award_circular');
      $this->db->where('id', $id);
      $query = $this->db->get()->row();

      return $query;
   }

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
      $this->db->select('u.id, u.first_name, u.full_name_bn, u.father_name, u.mother_name, u.dob, DATE_FORMAT(u.dob,"%d-%m-%Y") AS dobDate, YEAR(CURDATE()) - YEAR(dob) AS ageYear, MONTH(dob) - MONTH(CURDATE()) AS ageMonth, DAY(CURDATE()) - DAY(dob) AS ageDay, u.gender, u.phone, u.email, u.join_date, DATE_FORMAT(u.join_date,"%d-%m-%Y") AS joindate, u.pre_village_house, u.pre_road_block, u.pre_post_office, u.per_village_house, u.per_road_block, u.per_post_office, u.scout_designation, dv.div_name as pre_div_name, dv2.div_name as per_div_name, ds.district_name as pre_district_name, ds2.district_name as per_district_name, ut.up_th_name as pre_up_th_name, ut2.up_th_name as per_up_th_name, r.region_name, od.dis_name, ou.upa_name, og.grp_name, unit.unit_name, bt.badge_type_name_bn, rt.role_type_name_bn, bg.bg_name_en, it.name as institute_name, u.curr_class, u.curr_role_no');
      $this->db->from('users u');
      // $this->db->join('occupation oc', 'oc.id=u.occupation_id', 'LEFT');
      $this->db->join('blood_group bg', 'bg.id=u.blood_group', 'LEFT');
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
      $this->db->join('institute it', 'it.id = u.curr_institute_id', 'LEFT');
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
   public function get_recommended_list_by_office($circularID, $regionID=NULL, $districtID=NULL, $upazilaID=NULL, $groupID=NULL) {
      // result query
      $this->db->select('*');
      $this->db->from('award_circular');        
      $this->db->where('id', $circularID);
      $result['info'] = $this->db->get()->row();            

      //, ro.region_name, od.dis_name, ou.upa_name, og.grp_name,
      $this->db->select('r.id, r.name_bn, r.phone, r.sc_region_name, r.sc_district_name, r.sc_group_name, r.verify_nhq, r.verify_region, r.verify_district, r.verify_upazila, a.award_name_bn');
      $this->db->from('award_recommendation r');
      $this->db->join('scout_nhq_award a', 'a.id = r.recom_award_id', 'LEFT');
      /*$this->db->join('office_groups og', 'og.id = r.sc_group_id', 'LEFT');
      $this->db->join('office_upazila ou', 'ou.id = r.sc_upzaila_id', 'LEFT');
      $this->db->join('office_district od', 'od.id = r.sc_district_id', 'LEFT');
      $this->db->join('office_region ro', 'ro.id = r.sc_region_id', 'LEFT');*/
      $this->db->order_by('r.id', 'DESC');
      // $this->db->limit($limit);
      // $this->db->offset($offset);
      $this->db->where('r.circular_id', $circularID);      

      if($regionID){
         $this->db->where('r.sc_region_id', $regionID);            
      }
      if($districtID){
         $this->db->where('r.sc_district_id', $districtID);
      }
      if($upazilaID){
         $this->db->where('r.sc_upzaila_id', $upazilaID);
      }
      if($groupID){
         $this->db->where('r.sc_group_id', $groupID);
      }

      // Search Filter
      if($this->input->get('award') != NULL){
         $this->db->where('r.recom_award_id', $this->input->get('award')); 
      }

      if($this->input->get('region') != NULL){
         $this->db->where('r.sc_region_id', $this->input->get('region')); 
      }

      if($this->input->get('district') > 0){
         $this->db->where('r.sc_district_id', $this->input->get('district')); 
      }
      
      $result['rows'] = $this->db->get()->result();    


      // count query
      /*$q = $this->db->select('COUNT(*) as count');
      $this->db->from('award_recommendation');        
      $this->db->where('circular_id', $circularID);

      if($regionID){
         $this->db->where('sc_region_id', $regionID);            
      }
      if($districtID){
         $this->db->where('sc_district_id', $districtID);
      }
      if($upazilaID){
         $this->db->where('sc_upzaila_id', $upazilaID);
      }
      if($groupID){
         $this->db->where('sc_group_id', $groupID);
      }      

      // Search Filter
      if($this->input->get('region') != NULL){
         $this->db->where('sc_region_id', $this->input->get('region')); 
      }

      $tmp = $query;
      $result['num_rows'] = $tmp[0]->count;*/

      return $result;
   }

   public function get_award_approved_list_by_circular($circularID) {
      // result query
      $this->db->select('*');
      $this->db->from('award_circular');        
      $this->db->where('id', $circularID);
      $result['info'] = $this->db->get()->row();            


      $this->db->select('r.id, r.name_bn, r.phone, r.sc_district_name, r.sc_group_name, a.award_name_bn');
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
      /*, ecn.event_cate_name as ec_name_nhq, ecr.event_cate_name as ec_name_region, ecd.event_cate_name as ec_name_district, ecu.event_cate_name as ec_name_upazila*/
      $this->db->select('r.*, a.award_name_bn, u.scout_id');
      $this->db->from('award_recommendation r');
      $this->db->join('scout_nhq_award a', 'a.id = r.recom_award_id', 'LEFT');
      $this->db->join('users u', 'u.id = r.scout_id', 'LEFT');
      // $this->db->join('event_category ecn', 'ecn.id = r.event_id_nhq', 'LEFT');
      // $this->db->join('event_category ecr', 'ecr.id = r.event_id_region', 'LEFT');
      // $this->db->join('event_category ecd', 'ecd.id = r.event_id_district', 'LEFT');
      // $this->db->join('event_category ecu', 'ecu.id = r.event_id_upazila', 'LEFT');
      $this->db->where('r.id', $recommID);
      $result['info'] = $this->db->get()->row();    

      $this->db->select('are.*, o.office_type_name, e.event_cate_name');
      $this->db->from('award_recom_events are');        
      $this->db->join('office_type o', 'o.id = are.evt_office_id', 'LEFT');
      $this->db->join('event_category e', 'e.id = are.evtent_id', 'LEFT');        
      $this->db->where('are.data_id', $recommID);                
      $result['event_list'] = $this->db->get()->result();

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


   /************************* Archive Award ***********************
   /****************************************************************/

   public function get_archive_award($limit, $offset, $awardType=NULL) {
      // result query
      $this->db->select('a.*, t.archive_award_name');
      $this->db->from('archive_award a');
      $this->db->join('archive_award_type t', 't.id = a.award_id', 'LEFT');
      $this->db->limit($limit);
      $this->db->offset($offset);        
      if($awardType){
         $this->db->where('a.award_id', $awardType);            
      }
      if($_GET['year'] != NULL){
         $this->db->where('a.archive_year', $_GET['year']);            
      }
      // $this->db->join('committee_type ct', 'ct.id = c.comm_type_id', 'LEFT');
      $this->db->order_by('id', 'DESC');
      $query = $this->db->get()->result();
      $result['rows'] = $query;

      // count query
      $this->db->select('COUNT(*) as count');
      if($awardType){
         $this->db->where('award_id', $awardType);
      }
      $query = $this->db->get('archive_award')->result();
      $tmp = $query;
      $result['num_rows'] = $tmp[0]->count;
      // echo $this->db->last_query(); exit;

      return $result;
   }

   public function get_archive_certificate($id) {
      // result query
      $this->db->select('a.*, og.grp_name, og.grp_name_bn');
      $this->db->from('archive_award a');        
      $this->db->join('office_groups og', 'og.id = a.group_id', 'LEFT');
      $this->db->where('a.id', $id);
      $result = $this->db->get()->row();  
      // echo $this->db->last_query(); exit;  

      return $result;
   }

}
