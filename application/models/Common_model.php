<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Common_model extends CI_Model {

   public function __construct() {
      parent::__construct();
   }

   public function get_ebook_category(){
      $data[''] = '-- Select Category --';
      $this->db->select('id, category_name_en');
      $this->db->from('ebook_category');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['category_name_en'];
      }
      return $data;
   } 

   // Convert English to Bangla Number
   public static $bn = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
   public static $en = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
   
   public static function bn2en($number) {
      return str_replace(self::$bn, self::$en, $number);
   }

   public static function en2bn($number) {
      return str_replace(self::$en, self::$bn, $number);
   }

   public function get_single_ingo($table, $field, $id){
      $this->db->select('*');
      $this->db->from($table);
      $this->db->where($field, $id);
      $query = $this->db->get();
      return $query->row();
   }

   /************************* Cropper Model ************************/

   public function setUserID($userID) {
      $this->userID = $userID;
   }
   public function seturl($url) {
      $this->field = $url;
   }
   // get user details
   public function getUserDetails() {
      $this->db->select(array('m.id as user_id', 'CONCAT(m.first_name, " ", m.last_name) as full_name', 'm.first_name', 'm.last_name', 'm.email', 'up.url'));
      $this->db->from('users as m');
      $this->db->join('users_profile_picture as up', 'm.id=up.user_id');
      $this->db->where('m.id', $this->userID);
      $query = $this->db->get();
      if ($query->num_rows() > 0) {
         return $query->row_array();
      } else {
         return FALSE;
      }
   }

   public function setProfilePicture() {
      $tableName = 'users_profile_picture';
      $this->db->select(array('lpp.id', 'lpp.url', 'lpp.user_id'));
      $this->db->from($tableName . ' as lpp');
      $this->db->where('lpp.user_id', $this->userID);
      $query = $this->db->get();
      if ($query->num_rows() > 0) {
         $data = array(
            'url' => $this->field
            );
         $this->db->where('user_id', $this->userID);
         $this->db->update($tableName, $data);
      } else {
         $data = array(
           'url' => $this->field,
           'user_id' => $this->userID
           );
         $this->db->insert($tableName, $data);
      }
   }

   public function set_profile_image($id, $fileName){
      $data = array(
         'profile_img' => $fileName
         );
      $this->db->where('id', $id);
      $this->db->update('users', $data);

      return true;
   }

   /************************* End Cropper Model ************************/



   function get_client_ip() {
      $ipaddress = '';
      if (getenv('HTTP_CLIENT_IP'))
         $ipaddress = getenv('HTTP_CLIENT_IP');
      else if(getenv('HTTP_X_FORWARDED_FOR'))
         $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
      else if(getenv('HTTP_X_FORWARDED'))
         $ipaddress = getenv('HTTP_X_FORWARDED');
      else if(getenv('HTTP_FORWARDED_FOR'))
         $ipaddress = getenv('HTTP_FORWARDED_FOR');
      else if(getenv('HTTP_FORWARDED'))
         $ipaddress = getenv('HTTP_FORWARDED');
      else if(getenv('REMOTE_ADDR'))
         $ipaddress = getenv('REMOTE_ADDR');
      else
         $ipaddress = 'UNKNOWN';
      return $ipaddress;
   }


   public function get_single_data($table, $id) {
      $this->db->select('*');
      $this->db->from($table);
      $this->db->where('id', $id);
      $query =  $this->db->get();

      if($query->num_rows() > 0){
         return $query->row();
      }else{
         return FALSE;
      }
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

   public function get_data_array($table) {
      $this->db->select('*');
      $this->db->from($table);
      $query =  $this->db->get();

      if($query->num_rows() > 0){
         return $query->result_array();
      }else{
         return FALSE;
      }
   }

   public function get_count($table) {
      $this->db->select('*');
      $this->db->from($table);
      $query =  $this->db->get();
      return $query->num_rows();

   }

   public function save($table, $data) {
      if ($this->db->insert($table, $data)) {
         return true;
      }else{
         return false;
      }
   }

   public function edit($table, $id, $field, $data) {
      $this->db->where($field, $id);
      if ($this->db->update($table, $data)) {
         return true;
      }else{
         return false;
      }
   }

   public function delete($table, $field, $id) {
      $this->db->where($field, $id);
      $this->db->delete($table);
      return TRUE;
   }

   public function exists($table, $field, $item ) {
      $this->db->from($table);
      $this->db->where($field, $item);
      $query = $this->db->get();
      // echo $this->db->last_query(); exit;

      return ($query->num_rows() >= 1);
   }

   public function exists_like($table, $field, $item ) {
      $this->db->from($table);
      $this->db->like($field, $item, 'after');
      $query = $this->db->get();

      return $query->num_rows();
   }

   public function get_all($select, $from, $where){
        $sql = "SELECT $select FROM $from where $where";

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
             return $query->result_array();
        }
    }

   public function get_dropdown($table, $field, $id){
      $data[''] = '-- Select One --';
      $this->db->select("$id, $field");
      $this->db->from($table);
      $this->db->order_by($id, 'ASC');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows[$id]] = $rows[$field];
      }

      return $data;
   }   

   public function get_dropdown_office($table, $field, $where, $id){
      $data[''] = '-- Select One --';
      $this->db->select("id, $field");
      $this->db->from($table);
      $this->db->where($where, $id);
      // if($table == 'office_groups'){
      //    $this->db->where('grp_status', 1);
      // }
      $this->db->order_by('id', 'ASC');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows[$field];
      }
      return $data;
   }

   public function get_office_info($table, $id){
      $this->db->select("*");
      $this->db->from($table);
      $this->db->where('id', $id);
      $this->db->limit('1');
      $query = $this->db->get()->row();
      return $query;
   }


   public function get_latest_news($limit){
   
      $this->db->select('id, news_title');
      $this->db->from('scout_news');
      $this->db->where('status', 1);
      $this->db->limit($limit);
      $query = $this->db->get()->result();

      return $query;

   }

   public function get_event_approve_role(){
      $data[''] = '-- Select Type --';
      $this->db->select('id, office_rules_name');
      $this->db->from('event_approve_rules');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['office_rules_name'];
      }
      return $data;
   }   

   public function get_event_category(){
      $data[''] = '-- Select Type --';
      $this->db->select('id, event_cate_name');
      $this->db->from('event_category');
      $this->db->where('status', 1);
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['event_cate_name'];
      }
      return $data;
   }   

   public function get_adult_leader_badges(){
      $data[''] = '-- Select Badge --';
      $this->db->select('b.id, bt.badge_type_name_bn, bt.badge_type_name_en, b.section_id, section_name_en');
      $this->db->from('scout_badge b');
      $this->db->join('badge_type bt', 'b.badge_type_id=bt.id', 'LEFT');
      $this->db->join('scout_section ss', 'ss.id=b.section_id', 'LEFT');
      $this->db->where('b.status', 1);
      $this->db->where('b.member_id', 8);

      $this->db->order_by('b.id ASC');      
      // $this->db->order_by('bt.id ASC');
      // $this->db->order_by('b.section_id', 'DESC');
      // $this->db->order_by("name", "asc"); 
      $query = $this->db->get();
      $result = $query->result_array();

        // echo $this->db->last_query(); exit;
      return $result;
   }

   public function upcoming_events($region=NULL, $district=NULL) {
      // $this->db->select('*');
      $this->db->select('COUNT(*) as count');
      $this->db->from('events');

      $this->db->where('event_reg_end >', date('Y-m-d'));
      if($region != NULL){
         $this->db->where('sc_region_id', $region);         
      }
      if($district != NULL){
         $this->db->where('sc_district_id', $district);         
      }
      $this->db->or_where('event_level', 'nhq');         
      $this->db->order_by('id', 'DESC');
      $query = $this->db->get()->result();

        // echo $query->count; exit;
      return $query[0]->count;
   }

   public function get_regions(){
      $lan_region_name=$this->session->userdata('site_lang')=='bangla'?'region_name':'region_name_en';
      $data[''] = lang('site_select_scout_region');
      $this->db->select("id, $lan_region_name");
      $this->db->from('office_region');
      // $this->db->where('is_current',1);
      $this->db->order_by('id', 'ASC');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows[$lan_region_name];
      }        
      return $data;
   }   

   public function get_scout_districts($id=NULL){
      $lang_field=$this->session->userdata('site_lang')=='bangla'?'dis_name':'dis_name_en';
      $data[''] = lang('site_select_scout_district');
      $this->db->select("id, $lang_field");
      $this->db->from('office_district');
      if($id){
         $this->db->where('dis_scout_region_id', $id);
      }
      $this->db->order_by('id', 'ASC');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows[$lang_field];
      }
      return $data;
   }

   public function get_scout_upazila_thana($id=NULL){
      $lang_field=$this->session->userdata('site_lang')=='bangla'?'upa_name':'upa_name_en';
      $data[''] = lang('site_select_scout_upazila');
      $this->db->select("id, $lang_field");
      $this->db->from('office_upazila');
      if($id){
         $this->db->where('upa_scout_dis_id', $id);
      }
      $this->db->order_by('id', 'ASC');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows[$lang_field];
      }
      return $data;
   }

   public function get_scout_group_office($id=NULL, $upazila_id=NULL){
      $data[''] = '-Select Scouts Group-';
      $this->db->select('id, grp_name');
      $this->db->from('office_groups');
      if($id){
         $this->db->where('grp_scout_dis_id', $id);
      }
      if($upazila_id){
         $this->db->where('grp_scout_upa_id', $upazila_id);
      }
      $this->db->order_by('id', 'ASC');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['grp_name'];
      }
      return $data;
   }

   public function get_scout_unit_office($id=NULL){
      $data[''] = 'Select Scouts Unit';
      $this->db->select('id, unit_name');
      $this->db->from('office_unit');
      if($id){
         $this->db->where('unit_sc_grp_id', $id);
      }
      $this->db->order_by('id', 'ASC');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['unit_name'];
      }
      return $data;
   }


   public function get_site_regions(){
      $lan_region_name=$this->session->userdata('site_lang')=='bangla'?'region_name':'region_name_en';
      $data[''] = lang('site_select_scout_region');
      $this->db->select("id, $lan_region_name");
      $this->db->from('office_region');
      // $this->db->where('is_current',1);
      $this->db->order_by('id', 'ASC');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows[$lan_region_name];
      }        
      return $data;
   }

   // public function get_committee_session_current(){
   //    $this->db->select('id, committee_session_name');
   //    $this->db->from('committee_session');
   //    // $this->db->where('is_current',1);
   //    $this->db->order_by('id', 'DESC');
   //    $query = $this->db->get();

   //    foreach ($query->result_array() AS $rows) {
   //       $data[$rows['id']] = $rows['committee_session_name'];
   //    }        
   //    return $data;
   // }

   public function get_scout_id_with_designation(){
      $data[''] = 'Select Scout ID';
      $this->db->select('id, scout_id, first_name');
      $this->db->from('users');
      $this->db->where('scout_id !=', '');
      $this->db->order_by('id', 'ASC');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['scout_id'].' - '.$rows['first_name'];
      }        
      return $data;
   }    

   public function get_upazila_thana($id=NULL){
      $field= $this->session->userdata('site_lang')=='bangla'?'up_th_name_bn':'up_th_name';
      $data[''] = $this->session->userdata('site_lang')=='bangla'?'উপজেলা / থানা নির্বাচন করুন':'Select Upazila/Thana District';
      $this->db->select("id, up_th_name_bn, up_th_name");
      $this->db->from('upazila_thana');
      $this->db->where('status',1);
      if($id){
         $this->db->where('dis_id', $id);
      }
      $this->db->order_by('up_th_name', 'ASC');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows["$field"] != '' ? $rows["$field"]:$rows["up_th_name"];
      }
      return $data;
   }

   public function get_district($id=NULL){
      $field= $this->session->userdata('site_lang')=='bangla'?'district_name_bn':'district_name';
      $data[''] = $this->session->userdata('site_lang')=='bangla'?'জেলা নির্বাচন করুন':'Select District';
      $this->db->select("id, $field");
      $this->db->from('district');
      $this->db->where('status',1);
      if($id){
         $this->db->where('div_id', $id);
      }
      $this->db->order_by('district_name', 'ASC');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows["$field"];
      }
      return $data;
   }

   public function get_division($id=NULL){
      $field= $this->session->userdata('site_lang')=='bangla'?'div_name_bn':'div_name';
      $data[''] = $this->session->userdata('site_lang')=='bangla'?'বিভাগ নির্বাচন করুন':'Select Division';
      $this->db->select("id, $field");
      $this->db->from('division');
      $this->db->where('status',1);
      if($id){
         $this->db->where('id', $id);
      }
      $this->db->order_by('id', 'ASC');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows["$field"];
      }
      return $data;
   }

   public function get_office_type(){
      $data[''] = '-- Select Office --';
      $this->db->select('id, office_type_name');
      $this->db->from('office_type');      
      $this->db->order_by('id', 'ASC');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['office_type_name'];
      }
      return $data;
   }

   public function get_member_type(){
      $data[''] = '-- Select Member Type --';
      $this->db->select('id, member_type_name');
      $this->db->from('member_type');
      $this->db->where('is_delete', 0);
      $this->db->order_by('sort_order', 'ASC');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['member_type_name'];
      }
      return $data;
   }


   public function get_badge_type(){
      $data[''] = '-- Select Badge Type --';
      $this->db->select('id, badge_type_name_bn');
      $this->db->from('badge_type');
      $this->db->where('is_delete', 0);
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['badge_type_name_bn'];
      }
      return $data;
   }

   public function get_role_type(){
      $data[''] = '-- Select Role Type --';
      $this->db->select('id, role_type_name_bn');
      $this->db->from('role_type');
      $this->db->where('is_delete', 0);
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['role_type_name_bn'];
      }
      return $data;
   }

   public function get_badges($memberID=NULL, $sectionID=NULL){
      $data[''] = '-- Select Badge --';
      $this->db->select('b.id, bt.badge_type_name_bn');
      $this->db->from('scout_badge b');
      $this->db->join('badge_type bt', 'b.badge_type_id=bt.id', 'LEFT');
      $this->db->where('b.status', 1);
      if($memberID){
         $this->db->where('b.member_id', $memberID);
      }
      if($sectionID){
         $this->db->where('b.section_id', $sectionID);
      }
      $this->db->order_by('b.id', 'ASC');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['badge_type_name_bn'];
      }
      return $data;
   }

   public function get_roles($memberID=NULL, $sectionID=NULL){
      $data[''] = '-- Select Role --';
      $this->db->select('r.id, rt.role_type_name_bn');
      $this->db->from('scout_role r');
      $this->db->join('role_type rt', 'rt.id=r.role_type_id', 'LEFT');
      if($memberID){
         $this->db->where('r.member_id', $memberID);
      }
      if($sectionID){
         $this->db->where('r.section_id', $sectionID);
      }
      $this->db->where('r.status', 1);
      $this->db->order_by('r.id', 'ASC');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['role_type_name_bn'];
      }
      return $data;
   }   

   public function get_occupations(){
      $district[''] = 'Select Occupation';
      $this->db->select('id, occupation_name');
      $this->db->from('occupation');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $district[$rows['id']] = $rows['occupation_name'];
      }
      $district['Other'] = 'Other';
      return $district;
   }

   public function get_department(){
      $data[''] = 'Select Department';
      $this->db->select('id, department_name');
      $this->db->from('department');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['department_name'];
      }
      // $district['Other'] = 'Other';
      return $data;
   }

   public function get_scouts_nhq_award(){
      $data[''] = '-- Select Scouts Award --';
      $this->db->select('id, award_name_bn');
      $this->db->from('scout_nhq_award');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['award_name_bn'];
      }
      // $district['Other'] = 'Other';
      return $data;
   }

   public function get_scout_institute(){
      $district[''] = 'Select Institute';
      $this->db->select('id, name');
      $this->db->from('institute');
      $this->db->limit('100');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $district[$rows['id']] = $rows['name'];
      }
      return $district;
   }

   public function get_blood_group(){
      $field= $this->session->userdata('site_lang')=='bangla'?'bg_name_bn':'bg_name_en';
      $district[''] = $this->session->userdata('site_lang')=='bangla'?'রক্ত গ্রুপ নির্বাচন করুন':'Select Blood Group';
      $this->db->select("id, $field");
      $this->db->from('blood_group');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $district[$rows['id']] = $rows["$field"];
      }
      return $district;
   }

   public function get_committee_session_active(){
      $data[''] = 'Select Committee';
      $this->db->select('id, committee_session_name, committee_status');
      $this->db->from('committee_session');
      $this->db->where('committee_status',1);
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['committee_session_name'];
      }
      return $data;
   }

   public function get_scout_district_type(){
      $data[''] = 'Select District Type';
      $this->db->select('id, district_type_name');
      $this->db->from('scout_district_type');        
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['district_type_name'];
      }
      return $data;
   }

   public function get_district_by_div_id($id){
      $field= $this->session->userdata('site_lang')=='bangla'?'district_name_bn':'district_name';
      $data['0'] = $this->session->userdata('site_lang')=='bangla'?'জেলা নির্বাচন করুন':'Select District';
      $this->db->select("id, $field");
      $this->db->from('district');
      $this->db->where('div_id', $id);
      $this->db->where('status',1);
      $this->db->order_by('district_name', 'ASC');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows["$field"];
         

      }
      return $data;
   }

   public function get_upa_tha_by_dis_id($id){
      $field= $this->session->userdata('site_lang')=='bangla'?'up_th_name_bn':'up_th_name';
      $data['0'] = $this->session->userdata('site_lang')=='bangla'?'উপজেলা / থানা নির্বাচন করুন':'Select Upazila / Thana';
      $this->db->select("id, up_th_name_bn, up_th_name");
      $this->db->from('upazila_thana');
      $this->db->where('dis_id',$id);
      $this->db->where('status',1);
      $this->db->order_by('up_th_name', 'ASC');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         // $data[$rows['id']] = $rows["$field"];
         $data[$rows['id']] = $rows["$field"] != '' ? $rows["$field"]:$rows["up_th_name"];
      }
      
      return $data;
   }

   public function get_question_by_badge_id($id){
      $data['0'] = 'Select One';
      $this->db->select('id, questions');
      $this->db->from('scout_badge_question');
      $this->db->where('badge_type_id', $id);
      $this->db->where('is_delete', '0');
      $this->db->order_by('id', 'ASC');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['questions'];
      }
      return $data;
   }

   public function get_expert_group_by_badge($id){
      $data['0'] = 'Select One';
      $this->db->select('id, expert_group_name');
      $this->db->from('scout_expertness_group');
      $this->db->where('badge_type_id', $id);
      $this->db->where('is_delete', '0');
      $this->db->order_by('id', 'ASC');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['expert_group_name'];
      }
      return $data;
   }

   public function get_sc_dis_by_region_id($id){
      $lan_dis_name=$this->session->userdata('site_lang')=='bangla'?'dis_name':'dis_name_en';
      $data['0'] = lang('site_select_scout_district');
      $this->db->select("id, $lan_dis_name");
      $this->db->from('office_district');
      $this->db->where('dis_scout_region_id', $id);
      $this->db->order_by('id', 'ASC');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows[$lan_dis_name];
      }
      return $data;
   }

   public function get_sc_dis_data_by_region_id($id){
      $lan_dis_name=$this->session->userdata('site_lang')=='bangla'?'dis_name':'dis_name_en';
      $this->db->select("id, $lan_dis_name");
      $this->db->from('office_district');
      $this->db->where('dis_scout_region_id', $id);
      $this->db->order_by('id', 'ASC');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows[$lan_dis_name];
      }
      return $data;
   }

   public function get_sc_upazila_by_district_id($id){
      $lan_upa_name=$this->session->userdata('site_lang')=='bangla'?'upa_name':'upa_name_en';
      $data['0'] = lang('site_select_scout_upazila');
      $this->db->select("id, $lan_upa_name");
      $this->db->from('office_upazila');
      $this->db->where('upa_scout_dis_id', $id);
      $this->db->order_by('id', 'ASC');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows[$lan_upa_name];
      }
      return $data;
   }

   public function get_sc_upazila_data_by_district_id($id){
      $lan_upa_name=$this->session->userdata('site_lang')=='bangla'?'upa_name':'upa_name_en';
      $this->db->select("id, $lan_upa_name");
      $this->db->from('office_upazila');
      $this->db->where('upa_scout_dis_id', $id);
      $this->db->order_by('id', 'ASC');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows[$lan_upa_name];
      }
      return $data;
   }

   public function get_sc_group_by_district_id($id){
      $data['0'] = 'Select Scout Group';
      $this->db->select('id, grp_name');
      $this->db->from('office_groups');
      $this->db->where('grp_scout_dis_id', $id);
      $this->db->order_by('id', 'ASC');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['grp_name'];
      }
      return $data;
   }

   public function get_sc_group_by_upazila_thana_id($id){
      $lan_grp_name=$this->session->userdata('site_lang')=='bangla'?'grp_name_bn':'grp_name';
      $data['0'] = lang('site_select_scout_group');
      $this->db->select("id, $lan_grp_name");
      $this->db->from('office_groups');
      $this->db->where('grp_scout_upa_id', $id);
      $this->db->order_by('id', 'ASC');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows[$lan_grp_name];
      }
      return $data;
   }

   public function get_sc_group_by_upazila_id($id){
      $data[''] = 'Select Scout Group';
      $this->db->select('id, grp_name');
      $this->db->from('office_groups');
      $this->db->where('grp_scout_upa_id', $id);
      $this->db->order_by('id', 'ASC');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['grp_name'];
      }
      return $data;
   }

   public function get_sc_unit_list_by_group_id($id){
      $data['0'] = 'Select Scout Unit';
      $this->db->select('id, unit_name');
      $this->db->from('office_unit');
      $this->db->where('unit_sc_grp_id', $id);
      $this->db->order_by('id', 'ASC');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['unit_name'];
      }
      return $data;
   }

   public function get_sc_group_data_by_district_id($id){
      $lan_grp_name=$this->session->userdata('site_lang')=='bangla'?'grp_name_bn':'grp_name';
      $data['0'] = 'Select Scouts Group';
      $this->db->select("id, $lan_grp_name");
      $this->db->from('office_groups');
      $this->db->where('grp_scout_dis_id', $id);
      $this->db->order_by('id', 'ASC');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows["$lan_grp_name"];
      }
      return $data;
   }

   public function get_sc_group_data_by_upazila_thana_id($id){
      $lan_grp_name=$this->session->userdata('site_lang')=='bangla'?'grp_name_bn':'grp_name';
      $this->db->select("id, $lan_grp_name");
      $this->db->from('office_groups');
      $this->db->where('grp_scout_upa_id', $id);
      $this->db->order_by('id', 'ASC');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows[$lan_grp_name];
      }
      return $data;
   }

   public function get_sc_unit_data_by_scout_group_id($id){
      $lan_unit_name=$this->session->userdata('site_lang')=='bangla'?'unit_name_bn':'unit_name';
      $this->db->select("id, $lan_unit_name");
      $this->db->from('office_unit');
      $this->db->where('unit_sc_grp_id', $id);
      $this->db->order_by('id', 'ASC');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows[$lan_unit_name];
      }
      return $data;
   }



   // Scout Region Multi Select
   public function get_regions_multi(){
      // $lan_region_name=$this->session->userdata('site_lang')=='bangla'?'region_name':'region_name_en';
      // $data[''] = '';
      $this->db->select("id, region_name_en");
      $this->db->from('office_region');
      // $this->db->where('is_current',1);
      $this->db->order_by('id', 'ASC');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['region_name_en'];
      }        
      return $data;
   }

   public function get_sc_districts_multi($ids=NULL){
      //$lang_field=$this->session->userdata('site_lang')=='bangla'?'dis_name':'dis_name_en';
      //$data[''] = lang('site_select_scout_district');
      $this->db->select("id, dis_name_en");
      $this->db->from('office_district');
      if($ids){
         $this->db->where_in('dis_scout_region_id', $ids);
      }
      $this->db->order_by('id', 'ASC');
      $query = $this->db->get();
      // echo $this->db->last_query(); exit;

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['dis_name_en'];
      }

      return $data;
   }


   public function get_sc_upazila_multi($ids=NULL, $regionId=NULL, $districtId=NULL){
      // print_r($this->input->post('ids')); exit;
      if(!$ids){
         $ids = $this->input->post('ids');
      }

      // $lan_upa_name=$this->session->userdata('site_lang')=='bangla'?'upa_name':'upa_name_en';
      //$data['0'] = ''; //lang('site_select_scout_upazila');
      $this->db->select("id, upa_name_en");
      $this->db->from('office_upazila');
      if(!$ids){
         $this->db->where_in('upa_scout_dis_id', $ids);         
      }
      if($regionId != NULL){
         $this->db->where('upa_region_id', $regionId);  
      }
      if($districtId != NULL){
         $this->db->where('upa_scout_dis_id', $districtId);  
      }

      $this->db->order_by('id', 'ASC');
      $query = $this->db->get();
      // echo $this->db->last_query(); exit;

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['upa_name_en'];
      }
      return $data;
   }

   // Scout District Multi Select
   public function get_sc_dis_by_region_id_multi(){
      // print_r($this->input->post('ids')); exit;
      $ids = $this->input->post('ids');

      // $lan_dis_name=$this->session->userdata('site_lang')=='bangla'?'dis_name':'dis_name_en';
      //$data['0'] = ''; // lang('site_select_scout_district');
      $this->db->select("id, dis_name_en");
      $this->db->from('office_district');
      $this->db->where_in('dis_scout_region_id', $ids);
      $this->db->order_by('id', 'ASC');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['dis_name_en'];
      }
      return $data;
   }

   // Scout Upazila Multi Select
   public function get_sc_upazila_by_district_id_multi(){
      // print_r($this->input->post('ids')); exit;
      $ids = $this->input->post('ids');

      // $lan_upa_name=$this->session->userdata('site_lang')=='bangla'?'upa_name':'upa_name_en';
      //$data['0'] = ''; //lang('site_select_scout_upazila');
      $this->db->select("id, upa_name_en");
      $this->db->from('office_upazila');
      $this->db->where_in('upa_scout_dis_id', $ids);
      $this->db->order_by('id', 'ASC');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['upa_name_en'];
      }
      return $data;
   }



   public function get_badge_by_member_section($mType, $sectionID){
      $data['0'] = '--- Select Badge ---';
      $this->db->select('sb.id, bt.badge_type_name_bn');
      $this->db->from('scout_badge sb');
      $this->db->join('badge_type bt','bt.id=sb.badge_type_id', 'LEFT');
      $this->db->where('sb.member_id', $mType);
      $this->db->where('sb.section_id', $sectionID);
      $this->db->where('sb.status', 1);
      // $this->db->order_by('badge_name_bn', 'ASC');
      $query = $this->db->get();

      // echo $this->db->last_query(); exit;

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['badge_type_name_bn'];
      }
      return $data;
   }

   public function get_role_by_member_section($mType, $sectionID){
      $data['0'] = '-- Select Role --';
      $this->db->select('sr.id, rt.role_type_name_bn');
      $this->db->from('scout_role sr');
      $this->db->join('role_type rt', 'rt.id=sr.role_type_id', 'LEFT');
      $this->db->where('sr.member_id', $mType);
      $this->db->where('sr.section_id', $sectionID);
      $this->db->where('sr.status', 1);
      // $this->db->order_by('role_name', 'ASC');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['role_type_name_bn'];
      }
      return $data;
   }

   public function get_comm_designation_by_office($officeID){
      $data[''] = '-- Select Designation --';
      $this->db->select('id, committee_designation_name');
      $this->db->from('committee_designation');
      $where = "FIND_IN_SET('".$officeID."', office_level)";  
      $this->db->where( $where ); 
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['committee_designation_name'];
      }

      return $data;
   }

   public function get_edirectory_designation_by_office($officeID){
      $data[''] = '-- Select Designation --';
      $this->db->select('id, committee_designation_name_en');
      $this->db->from('edirectory_designation');
      $where = "FIND_IN_SET('".$officeID."', office_level)";  
      $this->db->where( $where ); 
      $this->db->order_by('short_order', 'ASC');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['committee_designation_name_en'];
      }

      return $data;
   }

   public function get_edirectory_designation($officeID){
      $data[''] = '-- Select Designation --';
      $this->db->select('id, committee_designation_name_en');
      $this->db->from('edirectory_designation');
      $where = "FIND_IN_SET('".$officeID."', office_level)";  
      $this->db->where( $where ); 
      $this->db->order_by('short_order', 'ASC');
      $query = $this->db->get()->result();

      return $query;
   }

   public function get_training_centers(){
      $data[''] = '-- Select Training Center --';
      $this->db->select('id, tc_name');
      $this->db->from('training_center');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['tc_name'];
      }

      return $data;
   }

   public function get_comm_type_by_office($officeID){
      $data[''] = '-- Select Committee Type --';
      $this->db->select('id, committee_type_name');
      $this->db->from('committee_type');
      $this->db->where('office_type_id', $officeID);
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['committee_type_name'];
      }

      return $data;
   }

   public function get_course_by_progress_section($progressType, $sectionID){
      $data[''] = '--- Select Course ---';
      $this->db->select('id, course_name');
      $this->db->from('scout_progress_course');
      $this->db->where('progress_id', $progressType);
      $this->db->where('section_id', $sectionID);
      $this->db->where('is_delete', '0');
      $query = $this->db->get();
      // echo $this->db->last_query(); exit;

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['course_name'];
      }
      $data['100'] = 'Others Course';
      return $data;
   }

   public function get_archive_arward_by_type($id){
      //$field= $this->session->userdata('site_lang')=='bangla'?'district_name_bn':'district_name';
      $data['0'] = '-- Select One --';
      $this->db->select("id, archive_award_name");
      $this->db->from('archive_award_type');
      $this->db->where('member_type', $id);
      $this->db->order_by('id', 'ASC');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows["archive_award_name"];
         

      }
      return $data;
   }

   public function get_get_designation_by_service($id){
      $data[''] = '--- Select Designation ---';
      $this->db->select('id, designation_name');
      $this->db->from('designation');
      $this->db->where('short_order', $id);
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['designation_name'];
      }
      return $data;
   }

   public function get_department_single($id){
        return $query = $this->db->select('department_name')->where('id', $id)->get('department')->row()->department_name;
    }

   public function get_region_office_single($id){
        return $query = $this->db->select('region_name_en')->where('id', $id)->get('office_region')->row()->region_name_en;
    }
    public function get_district_office_single($id){
        return $query = $this->db->select('dis_name_en')->where('id', $id)->get('office_district')->row()->dis_name_en;
    }
    public function get_upazila_office_single($id){
        return $query = $this->db->select('upa_name_en')->where('id', $id)->get('office_upazila')->row()->upa_name_en;
    }


    public function get_marital_status(){
      $data[''] = '- Select One -';
      $this->db->select('id, ms_name_en');
      $this->db->from('marital_status');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['ms_name_en'];
      }

      return $data;
   }

   public function get_exam() {
        // result query
        $this->db->select('*');
        $this->db->from('education_level');
        $this->db->order_by('sort_order', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() AS $rows) {
            $data[$rows['id']] = $rows['edu_level_name'];
        }
        return $data;
    }

   public function get_award_type() {
        // result query
         $data[''] = '- Select One -';
        $this->db->select('id, at_name_en');
        $this->db->from('award_type');
        $query = $this->db->get();

        foreach ($query->result_array() AS $rows) {
            $data[$rows['id']] = $rows['at_name_en'];
        }
        return $data;
    }

    public function get_user_group(){
      $data[''] = 'Select Group';
      $this->db->select("id, description");
      $this->db->from('groups');
      $this->db->order_by('id', 'ASC');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows["description"];
      }
      return $data;
   }

   // public function get_badge_by_section($id, $id2){
   //    $data['0'] = 'Select Badge';
   //    $this->db->select('id, badge_name_bn');
   //    $this->db->from('scout_badge');
   //    if($id2 !=NULL){
   //       $this->db->where('member_id',$id2);
   //    }
   //    $this->db->where('section_id',$id);
   //    $this->db->where('status',1);
   //    $this->db->order_by('badge_name_bn', 'ASC');
   //    $query = $this->db->get();

   //    foreach ($query->result_array() AS $rows) {
   //       $data[$rows['id']] = $rows['badge_name_bn'];
   //    }
   //    return $data;
   // }

   // public function get_role_by_section($id, $id2){
   //    $data['0'] = 'Select Role';
   //    $this->db->select('id, role_name');
   //    $this->db->from('scout_role');
   //    if($id2 !=NULL){
   //       $this->db->where('member_id',$id2);
   //    }
   //    $this->db->where('section_id',$id);
   //    $this->db->where('status',1);
   //    $this->db->order_by('role_name', 'ASC');
   //    $query = $this->db->get();

   //    foreach ($query->result_array() AS $rows) {
   //       $data[$rows['id']] = $rows['role_name'];
   //    }
   //    return $data;
   // }

   // public function get_role_by_badge($id){
   //    $data['0'] = 'Select Role';
   //    $this->db->select('id, role_name');
   //    $this->db->from('scout_role');
   //    $this->db->where('sc_badge_id',$id);
   //    $this->db->where('status',1);
   //    $this->db->order_by('role_name', 'ASC');
   //    $query = $this->db->get();

   //    foreach ($query->result_array() AS $rows) {
   //       $data[$rows['id']] = $rows['role_name'];
   //    }
   //    return $data;
   // }

   public function get_sc_unit_by_scout_group_id($id=NULL, $sele=NULL){
      // $data['0'] = 'Select Scout Unit';
      $this->db->select('id, unit_name');
      $this->db->from('office_unit');
      $this->db->where('unit_sc_grp_id', $id);
      $this->db->order_by('id', 'ASC');
      $query = $this->db->get();

      if(sizeof($query->result()) > 0 ){       
         $str = '<h5 style="text-align: center; margin-bottom: 10px; font-weight: bold;"> Choose your scout unit </h5>
         <table class="table table-hover table-striped" border="1"> ';
            foreach ($query->result() as $row) {
               $selected = '';
               if($sele == $row->id){
                  $selected = 'checked';
               } 
               $str .= '<tr>
               <td>
                  <label>
                    <input type="radio" name="sc_unit_id" value="'.$row->id.'" style="float: left; margin-top: 1px;" '.$selected.'><h6 style="margin:0px 0 0 10px; float: left;"> <b>'.$row->unit_name.'</b> </h6>
                 </label>
              </td>
           </tr>';
        }     
        $str .= '</table>';
     }else{
      $str = '<h5 style="text-align: center; margin-bottom: 10px; font-weight: bold;">Data is not available.</5>'; 
   }
   return $str;
      // return $query;
}

public function get_region_type(){
   return array( ''=>'-- Select Region Type --', 'divisional' => 'Divisional Region', 'special'=>'Special Region');
}

public function get_days(){
   $data[''] = 'Day';
   for ($i=1; $i <= 31; $i++) { 
      $value = sprintf('%02d', $i);
      $data[$value] = $value;
   }
   return $data;
}

public function get_months(){
   return array(''=>'Month', '01' => 'Jan', '02'=>'Feb', '03'=>'Mar', '04'=>'Apr', '05'=>'May', '06'=>'Jun', '07'=>'Jul', '08'=>'Aug', '09'=>'Sep', '10'=>'Oct', '11'=>'Nov', '12'=>'Dec');
}

public function get_years(){
   $data[''] = 'Year';
   for ($i=date('Y', strtotime('-5 years')); $i >= 1910; $i--) {             
      $data[$i] = $i;
   }
   return $data;
}

public function get_archive_award_years(){
   $data[''] = '-- Select Year --';
   for ($i=date('Y'); $i >= 1971; $i--) {             
      $data[$i] = $i;
   }
   return $data;
}

public function get_custom_adult_badge(){
   return array('' => '-Select-', '86,95,104' => 'বেসিক কোর্স সম্পন্ন', '87,96,105' => 'অ্যাডভান্স কোর্স সম্পন্ন', '88,97,106' => 'স্কিল কোর্স সম্পন্ন', '89,98,107' => 'উডব্যাজার', '90,99,108' => 'সিএএলটি সম্পন্ন', '91,100,109' => 'সহকারী লিডার ট্রেনার', '92,101,110' => 'সিএলটি সম্পন্ন', '93,102,111' => 'লিডার ট্রেনার');
}

public function get_application_verify_satus(){
   return array('' => '-- Select Status --', 'Approved' => 'Approved', 'Reject' => 'Reject');
}

public function event_participant_type(){
   return array('' => '-- Select One --', '1' => 'Individual', '2' => 'Group/Unit');
}

public function set_event_status(){
   return array('' => '-- Select Status --', 'Approved' => 'Approved', 'Reject' => 'Reject', 'Pending' => 'Pending', 'Not Applicable' => 'Not Applicable');
}

public function set_event_participant_type(){
   return array('' => '-- Select Participant Type --', '1' => 'Participant', '2' => 'Volunteer', '3' => 'Official', '4' => 'Leader', '5' => 'Not Allowed');
}

public function set_religion(){
   return array(''=>'-- Select Religion --', '1' => 'Islam', '2'=> 'Hinduism', '3'=>'Christianity', '4'=>'Buddhism', '5'=>'Sikhism', '6'=>'Jainism', '7'=>'Judaism');
}

public function set_office_type(){
   return array(''=>'-- Select Office --', '1' => 'National', '2' => 'Region', '3'=> 'District', '4'=>'Upazila', '5'=>'Scout Group');
}

public function set_service_status(){
   return array('' => '-- Select Status --', 'Pending' => 'Pending', 'Processing'=> 'On Process', 'Complete'=>'Complete', 'Reject'=>'Cancel');
}

public function set_service_assign_office_type(){
   return array('' => '-- Select Office --', '1'=>'Scouts Region', '2'=> 'Scouts District', '3'=>'Scouts Upazila', '4' => 'Scouts Group');
}

   // public function set_member_type(){
   //    return array(''=>'--- Select Member Type ---', '1' => 'New Applicant', '2' => 'Scout', '3'=> 'Adult Leader', '4'=>'Professional Executive', '5'=>'Warrant', '6' => 'Non-Warrant', '7'=>'Support Staff');
   // }

public function set_scout_section(){
   return array(''=>'-- Select Section --', '1' => 'Cub Scout', '2'=> 'Scout', '3'=>'Rover Scout', '4'=>'Not Applicable');
}

public function get_set_scout_section(){
   return array('1' => 'Cub Scout', '2'=> 'Scout', '3'=>'Rover Scout', '4'=>'Not Applicable');
}

public function set_scout_progress(){
   return array(''=>'-- Select Progress --', '1' => 'Cub Progress', '2'=> 'Scout Progress', '3'=>'Rover Scout Progress', '4'=>'Adult Leader Progress');
}

public function set_archive_member_type(){
   return array(''=>'-- Select Type --', '1' => 'Cub Scout', '2'=> 'Scout', '3'=>'Rover Scout', '4'=>'Adult Leader');
}

public function set_gender(){
   return array('Male'=>'Male', 'Female'=>'Female', 'Others'=>'Others'); 
}

   // public function set_member_status(){
   //    return array(''=>'-- Select Member Status --', '1'=> 'Current', '2'=>'Archive', '3'=>'Delete');
   // }
   // array(''=>'-- Select Status --', '0' => 'Inactive', '1'=> 'Active/Verified', '2' => 'Disabled', '3'=>'Archive', '4'=>'Reject');

   // public function set_scout_section_application(){
   //    return array(''=>'--- Select Section ---', '0' => 'Applicant', '1' => 'Cub Scout', '2'=> 'Scout', '3'=>'Rover Scout', '4'=>'Scouter', '5'=>'Non Warrant', '6'=>'Professional Scout Executive', '7'=> 'Support Staff');
   // }

public function set_scout_section_basic(){
   return array(''=>'-- Select Section --', '1' => 'Cub Scout', '2'=> 'Scout', '3'=>'Rover Scout');
} 



public function set_scout_section_checkbox(){
   return array('All' => 'All Member', '2' => 'Scout Member', '8'=> 'Adult Leader (Scouter)', '12' => 'Warrant Member', '10' => 'Non-Warrent Member', '9'=>'Professional Executive', '13'=>'Support Staff');
}

   // public function set_office_type_checkbox(){
   //    return array('1' => 'National', '2' => 'Region', '3'=> 'District', '4'=>'Upazila', '5'=>'Scout Group');
   // }

   // public function set_scout_group_type(){
   //    return array('' => 'Select Type', '1' => 'কাব দল', '2' => 'স্কাউট দল', '3' => 'গার্ল ইন কাব', '4' => 'গার্ল ইন স্কাউট', '5' => 'ওপেন স্কাউট');
   // }

public function set_scout_unit_type(){
   return array('' => 'Select Type', '1' => 'কাব দল', '2' => 'স্কাউট দল', '3' => 'রোভার স্কাউট দল', '4' => 'গার্ল-ইন কাব', '5' => 'গার্ল-ইন স্কাউট', '6' => 'গার্ল-ইন রোভার স্কাউট');
}   

public function set_scout_event_type(){
   return array('' => '-- Select One --', '1' => 'National', '2' => 'International');
}

public function get_dd_training_list(){
   return array(''=>'--- Select Category ---', '1' => 'ওরিয়েন্টেশন কোর্স', '2'=>'বেসিক কোর্স', '3'=>'এডভান্স কোর্স', '4' => 'স্কিল কোর্স', '5'=>'প্রশিক্ষকদের কোর্স', '6'=>'ইউনিট লিডার কোর্স', '7'=>'অন্যান্য লিডার কোর্স');
}

public function explote_array($array, $id){

   foreach ($array as $key => $value) {
     if($key==$id){
      return $value;
   } 
}
return 'No Data';
}

   // public function get_user_office() {
   //    $this->db->select('u.id, u.sc_region_id, u.sc_district_id, u.sc_upa_tha_id, u.sc_group_id, u.sc_unit_id,  or.region_name, od.dis_name, ou.upa_name, og.grp_name, unit.unit_name');
   //    $this->db->from('users u');
   //    $this->db->join('office_unit unit', 'unit.id = u.sc_unit_id', 'LEFT');
   //    $this->db->join('office_groups og', 'og.id = u.sc_group_id', 'LEFT');
   //    $this->db->join('office_upazila ou', 'ou.id = u.sc_upa_tha_id', 'LEFT');
   //    $this->db->join('office_district od', 'od.id = u.sc_district_id', 'LEFT');
   //    $this->db->join('office_region or', 'or.id = u.sc_region_id', 'LEFT');  
   //    $this->db->where('u.id', $this->session->userdata('user_id'));
   //    $this->db->limit(1);
   //    $query = $this->db->get()->row();  

   //    return $query;
   // }

public function e_nathi_department($id){
      $this->db->select('*');
      $this->db->from('e_nathi_department');
      $this->db->where('emp_id', $id);
      $this->db->where('status', 1);
      $query = $this->db->get();
      return $query->row();
}

public function e_nathi_department_list($id){
      $this->db->select('*');
      $this->db->from('e_nathi_department');
      $this->db->where('emp_id', $id);
      $query = $this->db->get();
      return $query->result();
}

public function get_user_details() {
   $id = $this->session->userdata('user_id');
   $result = array();

   $this->db->select('id, member_id, scout_id, username, first_name, father_name, mother_name, gender, dob, blood_group, nid, birth_id, phone, email, profile_img, occupation_id, is_request, is_verify, join_date, sc_section_id, sc_cub, sc_scout, sc_rover, sc_region_id, sc_district_id, sc_upa_tha_id, sc_group_id, sc_unit_id, sc_badge_id, sc_role_id, pre_division_id, pre_district_id, pre_upa_tha_id, pre_post_office, created_on, last_login, active,emp_designation,emp_department,desk_officer');
   $this->db->from('users');
   $this->db->where('id', $id);
   $query = $this->db->get()->row();

   $point=0;
   if($query->first_name != ''){ $point += 1; }
   if($query->father_name != NULL){ $point += 1; }
   if($query->mother_name != NULL){ $point += 1; }
   if($query->dob != '0000-00-00'){ $point += 1; }
   if($query->gender != NULL){ $point += 1; }
   if($query->blood_group != NULL){ $point += 1; }
   if($query->nid != NULL){ $point += 1; }
   if($query->birth_id != NULL){ $point += 1; }
   if($query->phone != 0){ $point += 1; }
   if($query->email != ''){ $point += 1; }
   if($query->pre_division_id != ''){ $point += 1; }
   if($query->pre_district_id != NULL){ $point += 1; }
   if($query->occupation_id != NULL){ $point += 1; }
   if($query->join_date != '0000-00-00'){ $point += 1; }
   if($query->pre_district_id != 0){ $point += 1; }
   if($query->pre_upa_tha_id != 0){ $point += 1; }
   if($query->scout_id != NULL){ $point += 1; }
   if($query->sc_section_id != NULL){ $point += 1; }
   if($query->sc_badge_id != NULL){ $point += 1; }      
   if($query->profile_img != NULL){ $point += 1; }

      //echo $total_field = count((array) $query);  exit;
   $total_field = 20;      
   $percentage = $point/$total_field;
   $result['profile_score'] = $percentage * 100;
   $result['user_info'] = $query;

            // print_r($result); exit;
   return $result;
}

// public function get_user_details() {
//    $id = $this->session->userdata('user_id');
//    $result = array();

//    $this->db->select('id, member_id, scout_id, username, first_name, father_name, mother_name, gender, dob, blood_group, nid, birth_id, phone, email, profile_img, occupation_id, is_request, is_verify, join_date, sc_section_id, sc_cub, sc_scout, sc_rover, sc_region_id, sc_district_id, sc_upa_tha_id, sc_group_id, sc_unit_id, sc_badge_id, sc_role_id, pre_division_id, pre_district_id, pre_upa_tha_id, pre_post_office, created_on, last_login, active');
//    $this->db->from('users');
//    $this->db->where('id', $id);
//    $query = $this->db->get()->row();

//    $point=0;
//    if($query->first_name != ''){ $point += 1; }
//    if($query->father_name != NULL){ $point += 1; }
//    if($query->mother_name != NULL){ $point += 1; }
//    if($query->dob != '0000-00-00'){ $point += 1; }
//    if($query->gender != NULL){ $point += 1; }
//    if($query->blood_group != NULL){ $point += 1; }
//    if($query->nid != NULL){ $point += 1; }
//    if($query->birth_id != NULL){ $point += 1; }
//    if($query->phone != 0){ $point += 1; }
//    if($query->email != ''){ $point += 1; }
//    if($query->pre_division_id != ''){ $point += 1; }
//    if($query->pre_district_id != NULL){ $point += 1; }
//    if($query->occupation_id != NULL){ $point += 1; }
//    if($query->join_date != '0000-00-00'){ $point += 1; }
//    if($query->pre_district_id != 0){ $point += 1; }
//    if($query->pre_upa_tha_id != 0){ $point += 1; }
//    if($query->scout_id != NULL){ $point += 1; }
//    if($query->sc_section_id != NULL){ $point += 1; }
//    if($query->sc_badge_id != NULL){ $point += 1; }      
//    if($query->profile_img != NULL){ $point += 1; }

//       //echo $total_field = count((array) $query);  exit;
//    $total_field = 20;      
//    $percentage = $point/$total_field;
//    $result['profile_score'] = $percentage * 100;
//    $result['user_info'] = $query;

//             // print_r($result); exit;
//    return $result;
// }

}
