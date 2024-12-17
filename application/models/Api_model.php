<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Api_model extends CI_Model {

   public function __construct() {
      parent::__construct();
   }

   public function get_sc_district(){
      $this->db->select("id, dis_scout_region_id, dis_name_en");
      $this->db->from('office_district');      
      $this->db->order_by('id', 'ASC');
      $query = $this->db->get()->result_array();
       
      return $query;
   }

   public function get_sc_upazila(){
      $this->db->select("id, upa_region_id, upa_scout_dis_id, upa_name_en");
      $this->db->from('office_upazila');      
      $this->db->order_by('id', 'ASC');
      $query = $this->db->get()->result_array();
       
      return $query;
   }

   /******************************* E-Directory *******************************/
   /***************************************************************************/

   public function get_contact_details($id) {
      $this->db->select('d.committee_designation_name_en, t.tc_name, e.tc_designation_name, e.id, e.scout_id, u.scout_id as scoutID, e.scout_desig_id, e.responsibility, e.name, e.name_bn, e.gender, e.phone, e.email, e.phone_official, e.email_official, e.address, e.profe_desig,  u.profile_img, e.image_file, e.others_info, e.office_level, r.region_name_en, od.dis_name_en, ou.upa_name_en, og.grp_name, e.status, bg.bg_name_en');
      $this->db->from('edirectory e');
      $this->db->join('edirectory_designation d', 'd.id = e.scout_desig_id', 'LEFT');
      $this->db->join('users u', 'u.id = e.scout_id', 'LEFT');
      $this->db->join('blood_group bg', 'bg.id=e.bg_id', 'LEFT');
      $this->db->join('training_center t', 't.id = e.tc_id', 'LEFT');
      $this->db->join('office_region r', 'r.id = e.sc_region_id', 'LEFT');
      $this->db->join('office_district od', 'od.id = e.sc_district_id', 'LEFT');
      $this->db->join('office_upazila ou', 'ou.id = e.sc_upzaila_id', 'LEFT');
      $this->db->join('office_groups og', 'og.id = e.sc_group_id', 'LEFT');
      $this->db->where('e.id', $id);
      $query = $this->db->get()->row();

      return $query;
   }

   public function get_listing($designation=NULL, $office_type=NULL, $region=NULL, $district=NULL, $upazill=NULL, $sgroup=NULL, $tc_id=NULL) {
      $this->db->select('o.office_type_name, d.committee_designation_name, d.committee_designation_name_en, e.scout_id, u.scout_id as scoutID, e.id, e.scout_desig_id, e.tc_id, t.tc_name, e.tc_designation_name, e.name, e.name_bn, e.gender, e.phone, e.email, e.address, e.profe_desig, e.sc_region_id, e.sc_district_id, e.sc_upzaila_id, e.sc_group_id, u.profile_img, e.image_file, e.others_info, e.office_level, r.region_name_en, od.dis_name_en, ou.upa_name_en, og.grp_name, e.status, bg.bg_name_en');
      $this->db->from('edirectory e');
      $this->db->join('office_type o', 'o.id = e.office_level', 'LEFT');
      $this->db->join('edirectory_designation d', 'd.id = e.scout_desig_id', 'LEFT');
      $this->db->join('users u', 'u.id = e.scout_id', 'LEFT');
      $this->db->join('blood_group bg', 'bg.id=e.bg_id', 'LEFT');
      $this->db->join('training_center t', 't.id = e.tc_id', 'LEFT');
      $this->db->join('office_region r', 'r.id = e.sc_region_id', 'LEFT');
      $this->db->join('office_district od', 'od.id = e.sc_district_id', 'LEFT');
      $this->db->join('office_upazila ou', 'ou.id = e.sc_upzaila_id', 'LEFT');
      $this->db->join('office_groups og', 'og.id = e.sc_group_id', 'LEFT');
      if($office_type){
         $this->db->where('e.office_level', $office_type);
      }
      if($designation){
         $this->db->where('e.scout_desig_id', $designation);
      }
      if($region){
         $this->db->where('e.sc_region_id', $region);            
      }
      if($district){
         $this->db->where('e.sc_district_id', $district);            
      }
      if($upazila){
         $this->db->where('e.sc_upzaila_id', $upazila);            
      }
      if($sgroup){
         $this->db->where('e.sc_group_id', $sgroup);            
      }
      if($tc_id){
         $this->db->where('e.tc_id', $tc_id);            
      }
      $this->db->where('e.status', 1);
      $this->db->limit(1000);
      $query = $this->db->get()->result();
      // print_r($query[1]);
      // echo count($query); exit;
      
      for ($i=0; $i < count($query); $i++) {
         $office = $query[$i]->office_level;     
         // Working Area
         if($office == 1){
            $query[$i]->working_area = $query[$i]->committee_designation_name_en.', National Headquarter';
         }elseif($office == 2){
            $query[$i]->working_area = $query[$i]->committee_designation_name_en.', '.$query[$i]->region_name_en;
         }elseif($office == 3){
            $query[$i]->working_area = $query[$i]->committee_designation_name_en.', '.$query[$i]->dis_name_en;
         }elseif($office == 4){
            $query[$i]->working_area = $query[$i]->committee_designation_name_en.', '.$query[$i]->upa_name_en;
         }elseif($office == 5){
            $query[$i]->working_area = $query[$i]->committee_designation_name_en.', '.$query[$i]->grp_name;
         }elseif($office == 6){
            $query[$i]->working_area = $query[$i]->tc_designation_name.', '.$query[$i]->tc_name;
         }
      }
      
      // echo $this->db->last_query(); exit;
      return $query;
   }

   public function get_search_listing($name=NULL, $mobile=NULL, $email=NULL, $group=NULL, $upazila=NULL, $district=NULL, $region=NULL) {
      $this->db->select('o.office_type_name, d.committee_designation_name, d.committee_designation_name_en, e.scout_id, u.scout_id as scoutID, e.id, e.scout_desig_id, e.tc_id, t.tc_name, e.tc_designation_name, e.name, e.name_bn, e.phone, e.email, e.address, e.profe_desig, u.profile_img, e.image_file, e.others_info, e.office_level, r.region_name_en, od.dis_name_en, ou.upa_name_en, og.grp_name, e.status');
      $this->db->from('edirectory e');
      $this->db->join('office_type o', 'o.id = e.office_level', 'LEFT');
      $this->db->join('edirectory_designation d', 'd.id = e.scout_desig_id', 'LEFT');
      $this->db->join('users u', 'u.id = e.scout_id', 'LEFT');
      $this->db->join('training_center t', 't.id = e.tc_id', 'LEFT');
      $this->db->join('office_region r', 'r.id = e.sc_region_id', 'LEFT');
      $this->db->join('office_district od', 'od.id = e.sc_district_id', 'LEFT');
      $this->db->join('office_upazila ou', 'ou.id = e.sc_upzaila_id', 'LEFT');
      $this->db->join('office_groups og', 'og.id = e.sc_group_id', 'LEFT');
      // $this->db->where('e.office_level', $office_type);
      if($name != NULL){
         $this->db->like('e.name', $name);
      }
      if($mobile != NULL){
         $this->db->like('e.phone', $mobile);
      }
      if($email != NULL){
         $this->db->like('e.email', $email);
      }

      if($group > 0){
         $this->db->where('e.sc_group_id', $group);       
         $this->db->where('e.office_level', 5);        
     }elseif($upazila > 0){
         $this->db->where('e.sc_upzaila_id', $upazila);  
         $this->db->where('e.office_level', 4);             
     }elseif($district > 0){
         $this->db->where('e.sc_district_id', $district);
         $this->db->where('e.office_level', 3);               
     }elseif($region != NULL){
         $this->db->where('e.sc_region_id', $region);   
         $this->db->where('e.office_level', 2);   
     }

      $this->db->where('e.status', 1);
      $query = $this->db->get()->result();
      // print_r($query[1]);
      // echo count($query); exit;
      
      for ($i=0; $i < count($query); $i++) {
         $office = $query[$i]->office_level;     
         // Working Area
         if($office == 1){
            $query[$i]->working_area = $query[$i]->committee_designation_name_en.', National Headquarter';
         }elseif($office == 2){
            $query[$i]->working_area = $query[$i]->committee_designation_name_en.', '.$query[$i]->region_name_en;
         }elseif($office == 3){
            $query[$i]->working_area = $query[$i]->committee_designation_name_en.', '.$query[$i]->dis_name_en;
         }elseif($office == 4){
            $query[$i]->working_area = $query[$i]->committee_designation_name_en.', '.$query[$i]->upa_name_en;
         }elseif($office == 5){
            $query[$i]->working_area = $query[$i]->committee_designation_name_en.', '.$query[$i]->grp_name;
         }elseif($office == 6){
            $query[$i]->working_area = $query[$i]->tc_designation_name.', '.$query[$i]->tc_name;
         }
      }
      
      // echo $this->db->last_query(); exit;
      return $query;
   }

   public function get_designation($officeID){      
      $this->db->select('id, committee_designation_name_en');
      $this->db->from('edirectory_designation');
      $where = "FIND_IN_SET('".$officeID."', office_level)";  
      $this->db->where( $where ); 
      $this->db->order_by('short_order', 'ASC');
      $query = $this->db->get()->result();

      return $query;
   }

   public function get_training_center(){      
      $this->db->select('id, tc_name');
      $this->db->from('training_center');
      $query = $this->db->get()->result();

      return $query;
   }

   public function get_region_info($id){      
      $this->db->select('id, region_name_en as office_name, region_phone as office_phone, region_email as office_email, region_address as office_address, region_url as office_url');
      $this->db->from('office_region');
      $this->db->where('id', $id); 
      $query = $this->db->get()->row();

      return $query;
   }

   public function get_district_info($id){      
      $this->db->select('id, dis_name_en as office_name, dis_phone as office_phone, dis_email as office_email, dis_address  as office_address, dis_url as office_url');
      $this->db->from('office_district');
      $this->db->where('id', $id); 
      $query = $this->db->get()->row();

      return $query;
   }

   public function get_upazila_info($id){      
      $this->db->select('id, upa_name_en as office_name, upa_phone as office_phone, upa_email as office_email, upa_address as office_address, upa_url as office_url');
      $this->db->from('office_upazila');
      $this->db->where('id', $id); 
      $query = $this->db->get()->row();

      return $query;
   }

   public function get_sgroup_info($id){      
      $this->db->select('id, grp_name as office_name, grp_mobile as office_phone, grp_email as office_email, grp_address as office_address, grp_url as office_url');
      $this->db->from('office_groups');
      $this->db->where('id', $id); 
      $query = $this->db->get()->row();

      return $query;
   }


   /*******************************             *******************************/
   /***************************************************************************/


   public function get_banbeis_institute(){
      $this->db->select('id, name, eiin');
      $this->db->from('institute');
      // $this->db->where('id', $id);
      // $this->db->limit(10000);
      $query = $this->db->get()->result_array();

      return $query;
   }

   public function get_institute($keyword) {
      $this->db->select('id, name');
      $this->db->from('institute');
      $this->db->where("name LIKE '%$keyword%'");
      $this->db->limit('10');

      $query = $this->db->get()->result();
      //print_r($query);exit;
      $storearr=array();
      for($i=0;$i<sizeof($query);$i++){
         $storearr[]=array('id'=>$query[$i]->id,'name'=>$query[$i]->name);
      }
      //echo $this->db->last_query(); exit;

      return $storearr;
   }


   /*********************** Training ************************/
   public function get_my_training($id) {
      $this->db->select('ts.*, t.training_name, t.training_center, t.training_type, t.training_start_date');
      $this->db->from('training_to_scouts ts');
      $this->db->join('training t', 't.id=ts.training_id');
      $this->db->where('ts.scout_id', $id);
      $this->db->where('ts.status', 'Approved');
      $query = $this->db->get()->result();
      return $query;
   }

   public function get_training_info($id) {
      $this->db->select('e.*,r.region_name, od.dis_name, ou.upa_name, og.grp_name, tr.trainer_name');
      $this->db->from('training e');
      $this->db->join('office_groups og', 'og.id = e.sc_group_id', 'LEFT');
      $this->db->join('office_upazila ou', 'ou.id = e.sc_upa_tha_id', 'LEFT');
      $this->db->join('office_district od', 'od.id = e.sc_district_id', 'LEFT');
      $this->db->join('office_region r', 'r.id = e.sc_region_id', 'LEFT');
      $this->db->join('trainer tr', 'tr.id = e.trainer_id', 'LEFT');
      $this->db->where('e.id', $id);
      $query = $this->db->get()->row();

      return $query;
   }

   public function upcomming_training($id) {
      $this->users= $this->ion_auth->user($id)->row();
      $this->db->select('*');
      $this->db->where('training_start_date >',date('Y-m-d'));
      if($this->users->sc_section_id==NULL){
         $this->db->like('training_notify', 'NULL');
      }
      // $this->db->where('sc_region_id', $this->users->sc_region_id);
      // $this->db->where('sc_district_id', $this->users->sc_district_id);
      // $this->db->where('sc_upa_tha_id', $this->users->sc_upa_tha_id);
      // $this->db->where('sc_group_id', $this->users->sc_group_id);
      $this->db->from('training');
      $this->db->order_by('id', 'DESC');
      $query = $this->db->get()->result();

      $results_arr=array();

      foreach ($query as  $item) {
         $notify=explode(',', $item->training_notify);
         if(!empty(in_array('All', $notify)) OR !empty(in_array($this->users->sc_section_id, $notify))){
            $results_arr[]=$item; 
         }
      }

      return $results_arr;
   }

   public function get_training_member($id, $scout_id) {
      $this->db->select('*');
      $this->db->from('training_to_scouts');
      $this->db->where('training_id', $id);
      $this->db->where('scout_id', $scout_id);
      $query = $this->db->get()->row();
      return $query;
   }

   /*********************** Events ************************/
   public function get_my_events($id) {
      $this->db->select('es.*, e.event_title, e.event_venu, e.event_type, e.event_start_date');
      $this->db->from('event_to_scouts es');
      $this->db->join('events e', 'e.id=es.event_id');
      $this->db->where('es.scout_id', $id);
      $this->db->where('es.status', 'Approved');
      $query = $this->db->get()->result();
      return $query;
   }

   public function get_events_info($id) {
      $this->db->select('e.id, e.event_title, e.event_venu,e.event_details, e.event_start_date,e.event_end_date,e.event_type,e.event_notify,r.region_name, od.dis_name, ou.upa_name, og.grp_name');
      $this->db->from('events e');
      $this->db->join('office_groups og', 'og.id = e.sc_group_id', 'LEFT');
      $this->db->join('office_upazila ou', 'ou.id = e.sc_upa_tha_id', 'LEFT');
      $this->db->join('office_district od', 'od.id = e.sc_district_id', 'LEFT');
      $this->db->join('office_region r', 'r.id = e.sc_region_id', 'LEFT');
      $this->db->where('e.id', $id);
      $query = $this->db->get()->row();

      return $query;
   }

   public function upcomming_event($id) {
      $this->users= $this->ion_auth->user($id)->row();
      $this->db->select('*');
      $this->db->from('events');
      if($this->users->sc_section_id==NULL){
         $this->db->like('event_notify', 'NULL');
      }
      $this->db->where('event_start_date >',date('Y-m-d'));
      // $this->db->where('sc_region_id', $this->users->sc_region_id);
      // $this->db->where('sc_district_id', $this->users->sc_district_id);
      // $this->db->where('sc_upa_tha_id', $this->users->sc_upa_tha_id);
      // $this->db->where('sc_group_id', $this->users->sc_group_id);
      $this->db->order_by('id', 'DESC');
      $query = $this->db->get()->result();

      $results_arr=array();

      foreach ($query as  $item) {
         $notify=explode(',', $item->event_notify);
         if(!empty(in_array('All', $notify)) OR !empty(in_array($this->users->sc_section_id, $notify))){
            $results_arr[]=$item; 
         }
      }

      return $results_arr;
   }

   public function get_scout_member($id, $scout_id) {
      $this->db->select('*');
      $this->db->from('event_to_scouts');
      $this->db->where('event_id', $id);
      $this->db->where('scout_id', $scout_id);
      $query = $this->db->get()->row();
      return $query;
   }

   public function get_service_info($id){
      $this->db->select('id, service_name');
      $this->db->from('service_list');
      $this->db->where('id', $id);
      $query = $this->db->get()->row();

      return $query;
   }

   /*********************** Award ************************/

   public function get_my_award($id) {
      // result query
      $this->db->select('as.*, sa.award_name');
      $this->db->from('award_to_scouts as');
      $this->db->join('scout_award sa', 'as.award_id=sa.id', 'LEFT');
      $this->db->where('scout_id', $id);

      $query = $this->db->get()->result();

      return $query;
   }


   public function search_blood_donate($blood, $div, $dis, $up) {
      $date = date('Y-m-d', strtotime('-90 days'));

      $this->db->select('u.first_name, u.full_name_bn, u.scout_id, u.profile_img, u.phone, ut.up_th_name, ds.district_name,ut.up_th_name_bn, ds.district_name_bn, (YEAR(NOW()) - YEAR(u.dob)) AS age');
      $this->db->from('users u');
      $this->db->where('u.pre_division_id', $div);
      if(!empty($dis)){
         $this->db->where('u.pre_district_id', $dis); 
      }
      if(!empty($up)){
         $this->db->where('u.pre_upa_tha_id', $up); 
      }
      $this->db->where('u.scout_id IS NOT NULL', NULL);
      // $this->db->where('scout_id', 'IS NOT NULL');
      $this->db->where('u.blood_group', $blood);
      $this->db->where('u.blood_donate_interested', 'yes');
      $this->db->where('u.last_donate_date <=', $date);
      $this->db->where('(YEAR(NOW()) - YEAR(u.dob)) >=', 18);
      $this->db->join('upazila_thana ut', 'ut.id=u.pre_upa_tha_id', 'LEFT');
      $this->db->join('district ds', 'ds.id=u.pre_district_id', 'LEFT');
      $this->db->limit(500);
      $query = $this->db->get()->result();        

      return $query;
   }

   public function find_scout_id($scoutID) {
      $this->db->select('u.first_name, u.full_name_bn, u.scout_id, u.father_name, u.mother_name, u.profile_img, u.phone, u.email, u.sc_section_id, bg.bg_name_en, u.member_id, mt.member_type_name, r.region_type, r.region_name, r.region_name_en, od.dis_name, od.dis_name_en, ou.upa_name, ou.upa_name_en, og.grp_name, og.grp_name_bn, unit.unit_name, unit.unit_name_bn');
      $this->db->from('users u');
      $this->db->join('blood_group bg', 'bg.id = u.blood_group', 'LEFT');      
      $this->db->join('member_type mt', 'mt.id = u.member_id', 'LEFT');
      $this->db->join('office_unit unit', 'unit.id = u.sc_unit_id', 'LEFT');
      $this->db->join('office_groups og', 'og.id = u.sc_group_id', 'LEFT');
      $this->db->join('office_upazila ou', 'ou.id = u.sc_upa_tha_id', 'LEFT');
      $this->db->join('office_district od', 'od.id = u.sc_district_id', 'LEFT');
      $this->db->join('office_region r', 'r.id = u.sc_region_id', 'LEFT');
      $this->db->where('u.scout_id', $scoutID);
      $this->db->limit(1);
      $query = $this->db->get()->row();
      // echo $this->db->last_query(); exit;        

      return $query;
   }

}
