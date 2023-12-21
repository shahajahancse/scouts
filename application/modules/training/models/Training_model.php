<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Training_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_scout_training_data($limit = 1000, $offset = 0, $officeLevel=NULL, $region=NULL, $district=NULL) {
        $this->db->select('st.*, pc.course_name');
        $this->db->from('scout_training st');
        $this->db->join('scout_progress_course pc', 'pc.id = st.course_id', 'LEFT');
        $this->db->limit($limit);
        $this->db->offset($offset);
        $this->db->order_by('st.id', 'DESC');
        
        if($officeLevel){
            $this->db->where('st.created_office_by', $officeLevel);
        }        
        if($region){
            $this->db->where('st.sc_region_id', $region);
        }
        if($district){
            $this->db->where('st.sc_district_id', $district);
        }
        $query = $this->db->get()->result();
        // echo $this->db->last_query(); exit;

        $result['rows'] = $query;

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('scout_training');  
        if($officeLevel){
            $this->db->where('created_office_by', $officeLevel);
        }
        if($region){
            $this->db->where('sc_region_id', $region);
        }
        if($district){
            $this->db->where('sc_district_id', $district);
        }
        $query = $this->db->get()->result();
        $tmp = $query;
        $result['num_rows'] = $tmp[0]->count;
        // echo $this->db->last_query(); exit;

        return $result;
    }  

    public function get_scout_training_info($id) {
        $this->db->select('st.*, ear.office_rules_name, r.region_name, od.dis_name, ou.upa_name');
        $this->db->from('scout_training st');
        $this->db->join('event_approve_rules ear', 'ear.id = st.approve_role', 'LEFT');
        $this->db->join('office_upazila ou', 'ou.id = st.sc_upa_tha_id', 'LEFT');
        $this->db->join('office_district od', 'od.id = st.sc_district_id', 'LEFT');
        $this->db->join('office_region r', 'r.id = st.sc_region_id', 'LEFT');
        $this->db->where('st.id', $id);
        $query = $this->db->get()->row();

        return $query;
    }

    public function get_attachment($id){
        $this->db->select('id, training_id, file_name');
        $this->db->from('training_attachment');
        $this->db->where('training_id', $id);
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_attachment_single($id){
        $this->db->select('id, training_id, file_name');
        $this->db->from('training_attachment');
        $this->db->where('id', $id);
        $query = $this->db->get()->row();

        return $query;
    }

    public function get_attachment_delete($id) {
        // Delete Event Attachment
        if($this->db->delete('training_attachment', array('id' => $id))){
            return TRUE;
        }
    }


    public function upcomming_training_search($info) {
        // , ep.event_id, ep.scout_id
        $this->db->select('t.*');
        $this->db->from('scout_training t');
        // $this->db->join('event_participant ep', 'ep.event_id = e.id', 'LEFT');
        // $this->db->where('e.ept_category', 1);         
        
        // Event type 
        if($this->db->where('t.tt_national', 1)){
            $this->db->or_where_in('t.tt_region_ids', $info->sc_region_id);
            $this->db->or_where_in('t.tt_district_ids', $info->sc_district_id);         
            $this->db->or_where_in('t.tt_upazila_ids', $info->sc_upa_tha_id); 
        }
        if($this->db->where('t.tt_international', 1)){
            $this->db->or_where_in('t.tt_region_ids', $info->sc_region_id);
            $this->db->or_where_in('t.tt_district_ids', $info->sc_district_id);         
            $this->db->or_where_in('t.tt_upazila_ids', $info->sc_upa_tha_id);         
        }

        $this->db->where('t.published', 'Yes');         
        
        $this->db->order_by('t.id', 'DESC');
        $query = $this->db->get()->result();
        // echo $this->db->last_query(); exit;
        return $query;
    }


    public function is_apply_training($trainingID, $scout_id){
        // echo 'Hello'; exit;
        $this->db->select('training_id, scout_id');
        $this->db->from('training_participant');
        $this->db->where('training_id', $trainingID);
        $this->db->where('scout_id', $scout_id);
        $query = $this->db->get()->row();

        return $query; 
        // print_r($query); exit;
    }

    public function get_my_application() {
        $this->db->select('tp.*, tp.id as app_id, t.*, pc.course_name, r.region_name, od.dis_name');
        $this->db->from('training_participant tp');
        $this->db->join('scout_training t', 't.id = tp.training_id', 'LEFT');
        $this->db->join('scout_progress_course pc', 'pc.id = t.course_id', 'LEFT');
        $this->db->join('office_district od', 'od.id = t.sc_district_id', 'LEFT');
        $this->db->join('office_region r', 'r.id = t.sc_region_id', 'LEFT');
        $this->db->where('tp.scout_id', $this->session->userdata('user_id'));
        $this->db->order_by('tp.id', 'DESC');
        $query = $this->db->get()->result();

        return $query;
    }

    function application_delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('training_participant');
        return TRUE;
    }


    public function get_applicant_data($limit = 1000, $offset = 0, $eventLevel=NULL, $region=NULL, $district=NULL){
        $this->db->select('tp.*, t.id as triningid, t.training_title, t.start_date, t.end_date, u.id as user_id, u.scout_id, u.first_name');
        $this->db->from('training_participant tp');
        $this->db->join('scout_training t', 't.id = tp.training_id', 'LEFT');
        $this->db->join('users u', 'u.id = tp.scout_id', 'LEFT');
        $this->db->limit($limit);
        $this->db->offset($offset);
        // $this->db->where('e.event_level', $eventLevel);
        $this->db->order_by('tp.id', 'DESC');
        if($region){
            $this->db->where('tp.curr_region_id', $region);
        }
        if($district){
            $this->db->where('tp.curr_district_id', $district);
        }
        $query = $this->db->get()->result();
        // echo $this->db->last_query(); exit;        
        $result['rows'] = $query;

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('training_participant');  
        if($region){
            $this->db->where('curr_region_id', $region);
        }
        if($district){
            $this->db->where('curr_district_id', $district);
        }
        $query = $this->db->get()->result();
        $tmp = $query;
        $result['num_rows'] = $tmp[0]->count;
        // echo $this->db->last_query(); exit;

        return $result;
    }


    public function get_application($id) {
        $this->db->select('tp.*, tp.id as participant_id, t.*, pc.course_name, r.region_name, od.dis_name, u.scout_id AS scoutID, u.first_name, u.profile_img');
        $this->db->from('training_participant tp');
        $this->db->join('scout_training t', 't.id = tp.training_id', 'LEFT');
        $this->db->join('scout_progress_course pc', 'pc.id = t.course_id', 'LEFT');
        $this->db->join('office_district od', 'od.id = t.sc_district_id', 'LEFT');
        $this->db->join('office_region r', 'r.id = t.sc_region_id', 'LEFT');
        $this->db->join('users u', 'u.id = tp.scout_id', 'LEFT');
        $this->db->where('tp.id', $id);
        $query = $this->db->get()->row();
        // echo $this->db->last_query(); exit;
        return $query;
    }


    public function get_applicant_list($id){
        $this->db->select('st.*, pc.course_name, r.region_name, od.dis_name, ou.upa_name');
        $this->db->from('scout_training st');
        $this->db->join('scout_progress_course pc', 'pc.id = st.course_id', 'LEFT');
        $this->db->join('office_upazila ou', 'ou.id = st.sc_upa_tha_id', 'LEFT');
        $this->db->join('office_district od', 'od.id = st.sc_district_id', 'LEFT');
        $this->db->join('office_region r', 'r.id = st.sc_region_id', 'LEFT');
        $this->db->where('st.id', $id);
        $query['info'] = $this->db->get()->row();
        // echo $this->db->last_query(); exit;

        $this->db->select('tp.*, u.id as user_id, u.scout_id, u.first_name, u.profile_img, mt.member_type_name');
        $this->db->from('training_participant tp');
        $this->db->join('users u', 'u.id = tp.scout_id', 'LEFT');
        $this->db->join('member_type mt', 'mt.id = u.member_id', 'LEFT');
        $this->db->where('tp.training_id', $id);
        $query['member_list'] = $this->db->get()->result();

        return $query;
    }

    public function get_participant_list($id){
        $this->db->select('st.*, pc.course_name, r.region_name, od.dis_name, ou.upa_name');
        $this->db->from('scout_training st');     
        $this->db->join('scout_progress_course pc', 'pc.id = st.course_id', 'LEFT');   
        $this->db->join('office_upazila ou', 'ou.id = st.sc_upa_tha_id', 'LEFT');
        $this->db->join('office_district od', 'od.id = st.sc_district_id', 'LEFT');
        $this->db->join('office_region r', 'r.id = st.sc_region_id', 'LEFT');
        $this->db->where('st.id', $id);
        $query['info'] = $this->db->get()->row();
        // echo $this->db->last_query(); exit;
        // print_r($query['info']); 
        
        $this->db->select('tp.*, u.id as user_id, u.scout_id, u.first_name, u.profile_img, mt.member_type_name, st.created_office_by');        
        $this->db->from('training_participant tp');
        $this->db->join('scout_training st', 'st.id = tp.training_id', 'LEFT');
        $this->db->join('users u', 'u.id = tp.scout_id', 'LEFT');
        $this->db->join('member_type mt', 'mt.id = u.member_id', 'LEFT');
        $this->db->where('tp.training_id', $id);

        if($query['info']->created_office_by == 1){
            $this->db->where('tp.verify_nhq', 'Approved');
        }elseif($query['info']->created_office_by == 2){
            $this->db->where('tp.verify_region', 'Approved');
        }elseif($query['info']->created_office_by == 3){
            $this->db->where('tp.verify_district', 'Approved');
        }elseif($query['info']->created_office_by == 4){
            $this->db->where('tp.verify_upazila', 'Approved');
        }
        
        $query['member_list'] = $this->db->get()->result();

        // echo $this->db->last_query(); exit;

        return $query;
    }


    public function get_trining_certificate($id) {
        // result query
        $this->db->select('tp.*, u.first_name, u.full_name_bn, u.scout_id, u.dob, u.phone, og.grp_name, og.grp_name_bn');
        $this->db->from('training_participant tp');
        $this->db->join('users u', 'u.id = tp.scout_id', 'LEFT');
        $this->db->join('office_groups og', 'og.id = u.sc_group_id', 'LEFT');
        $this->db->where('tp.verify_nhq', 'Approved');
        $this->db->where('tp.id', $id);
        $result = $this->db->get()->row();  

        // echo $this->db->last_query(); exit;  

        return $result;
    }


    public function get_trainers($limit = 1000, $offset = 0) {
        $this->db->select('t.*, u.id as user_id, u.scout_id, u.first_name, u.phone, u.email');
        $this->db->from('trainers t');
        $this->db->join('users u', 'u.id = t.trainer_scout_id', 'LEFT');
        $this->db->limit($limit);
        $this->db->offset($offset);
        $this->db->order_by('t.id', 'DESC');
            
        $query = $this->db->get()->result();
        //echo $this->db->last_query(); // exit;
        $result['rows'] = $query;

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('trainers');  
        $query = $this->db->get()->result();
        $tmp = $query;
        $result['num_rows'] = $tmp[0]->count;
        // echo $this->db->last_query(); exit;

        return $result;
    }  

    public function get_trainer_info($id) {
        $this->db->select('t.*, u.scout_id, u.first_name');
        $this->db->from('trainers t');
        $this->db->join('users u', 'u.id = t.trainer_scout_id', 'LEFT');
        $this->db->where('t.id', $id);
        $query = $this->db->get()->row();

        return $query;
    }

    // public function get_trainers() {
    //     $this->db->select('*');
    //     $this->db->from('trainer');
    //     $this->db->order_by('id', 'DESC');
    //     $query = $this->db->get()->result();

    //     return $query;
    // }


    






    public function get_data() {
        $this->db->select('*');
        $this->db->from('training');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_trainer() {
        $this->db->select('id, trainer_name');
        $this->db->from('trainer');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        $data=array();
        foreach ($query->result_array() AS $rows) {
            $data[$rows['id']] = $rows['trainer_name'];
        }
        return $data;
    }
     

    
    public function upcomming_training() {
        $this->db->select('*');
        $this->db->where('training_start_date >',date('Y-m-d'));
        $this->db->from('training');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get()->result();

        return $query;
    }

     public function scout_member_training() {
        $this->users= $this->ion_auth->user()->row();
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

    public function get_info($id) {
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

    public function get_scout_member_list($id) {
        $this->db->select('training_to_scouts.id, training_to_scouts.scout_id, training_to_scouts.training_id, training_to_scouts.status, training_to_scouts.comments, users.first_name, users.scout_id as scoutid');
        $this->db->from('training_to_scouts');
        $this->db->join('users', 'users.id=training_to_scouts.scout_id');
        $this->db->where('training_to_scouts.training_id', $id);
        $query = $this->db->get()->result();
        return $query;
    }
    public function get_scout_member($id, $scout_id) {
        $this->db->select('*');
        $this->db->from('training_to_scouts');
        $this->db->where('training_id', $id);
        $this->db->where('scout_id', $scout_id);
        $query = $this->db->get()->row();
        return $query;
    }

    public function get_scout_member_approved() {

        $this->users= $this->ion_auth->user()->row();

        $this->db->select('e.*, es.comments');
        $this->db->from('training e');
        $this->db->join('training_to_scouts es', 'e.id=es.training_id');
        $this->db->where('e.training_end_date <=',date('Y-m-d'));
        
        // $this->db->where('e.sc_region_id', $this->users->sc_region_id);
        // $this->db->where('e.sc_district_id', $this->users->sc_district_id);
        // $this->db->where('e.sc_upa_tha_id', $this->users->sc_upa_tha_id);
        // $this->db->where('e.sc_group_id', $this->users->sc_group_id);
        $this->db->where('es.scout_id', $this->users->id);
        $this->db->where('es.status', 'Approved');
        $this->db->order_by('e.id', 'DESC');
        $query = $this->db->get()->result();
       
        return $query;
       
    }

    public function get_training_valid($id) {

        $this->users= $this->ion_auth->user()->row();

        $this->db->select('e.*');
        $this->db->from('training e');
        $this->db->join('training_to_scouts es', 'e.id=es.training_id');
        $this->db->where('e.id', $id);
        $this->db->where('e.training_end_date <=',date('Y-m-d'));
        
        // $this->db->where('e.sc_region_id', $this->users->sc_region_id);
        // $this->db->where('e.sc_district_id', $this->users->sc_district_id);
        // $this->db->where('e.sc_upa_tha_id', $this->users->sc_upa_tha_id);
        // $this->db->where('e.sc_group_id', $this->users->sc_group_id);
        $this->db->where('es.scout_id', $this->users->id);
        $this->db->where('es.status', 'Approved');
        $this->db->order_by('e.id', 'DESC');
        $query = $this->db->get();

        if($query->num_rows()>0){
            return true;
        }else{
            return false;
        }
        
    }

    public function edit($table, $scout_id, $training_id, $data) {
      $this->db->where('scout_id', $scout_id);
      $this->db->where('training_id', $training_id);
      if ($this->db->update($table, $data)) {
         return true;
      }else{
         return false;
      }
   }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('scout_training');

        // $this->db->where('training_id', $id);
        // $this->db->delete('training_to_scouts');
        
        return TRUE;
    }

    function trainer_delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('trainer');
        
        return TRUE;
    }

}
