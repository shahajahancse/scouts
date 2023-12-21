<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Event_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // public function get_user_id_from_scout_id($scoutID){
    //     return $this->db->select('id, scout_id')->where('scout_id', $scoutID)->get('users')->row()->id;
    // }

    public function get_scout_member_by_group($groupID){
        $data[''] = '-- Select One --';
        $this->db->select('u.id, u.scout_id, u.first_name, u.sc_section_id, u.profile_img, bt.badge_type_name_bn');
        $this->db->from('users u'); 
        $this->db->join('member_type mt', 'mt.id = u.member_id', 'LEFT');
        $this->db->join('scout_badge sb', 'sb.id = u.sc_badge_id', 'LEFT');
        $this->db->join('badge_type bt','bt.id = sb.badge_type_id', 'LEFT');
        $this->db->where('u.scout_id IS NOT NULL', NULL);
        $this->db->where('u.sc_group_id', $groupID);        
        $this->db->order_by('u.scout_id', 'DESC');
        $query = $this->db->get();
        // echo $this->db->last_query(); exit;
        foreach ($query->result_array() AS $rows) {
            $data[$rows['id']] =  $rows['scout_id'].' - '.$rows['first_name'] .' ('.$rows['badge_type_name_bn'].')';
        }
        return $data;
    }

    public function get_data($limit = 1000, $offset = 0, $officeLevel=NULL, $region=NULL, $district=NULL) {
        $this->db->select('*');
        $this->db->from('events');
        $this->db->limit($limit);
        $this->db->offset($offset);
        $this->db->order_by('id', 'DESC');
        
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

        // echo $this->db->last_query(); exit;

        $result['rows'] = $query;

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('events');  
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

    public function get_info($id) {
        $this->db->select('e.*, ec.event_cate_name, ear.office_rules_name, r.region_name, od.dis_name, ou.upa_name, og.grp_name');
        $this->db->from('events e');

        $this->db->join('event_category ec', 'ec.id = e.event_category', 'LEFT');
        $this->db->join('event_approve_rules ear', 'ear.id = e.approve_role', 'LEFT');
        $this->db->join('office_groups og', 'og.id = e.sc_group_id', 'LEFT');
        $this->db->join('office_upazila ou', 'ou.id = e.sc_upa_tha_id', 'LEFT');
        $this->db->join('office_district od', 'od.id = e.sc_district_id', 'LEFT');
        $this->db->join('office_region r', 'r.id = e.sc_region_id', 'LEFT');
        $this->db->where('e.id', $id);
        $query = $this->db->get()->row();

        return $query;
    }  

    public function get_attachment($id){
        $this->db->select('id, event_id, file_name');
        $this->db->from('event_attachment');
        $this->db->where('event_id', $id);
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_attachment_single($id){
        $this->db->select('id, event_id, file_name');
        $this->db->from('event_attachment');
        $this->db->where('id', $id);
        $query = $this->db->get()->row();

        return $query;
    }

    public function get_attachment_delete($id) {
        // Delete Event Attachment
        if($this->db->delete('event_attachment', array('id' => $id))){
            return TRUE;
        }
    }


    public function upcomming_event_search($info) {
        // , ep.event_id, ep.scout_id
        $this->db->select('e.*');
        $this->db->from('events e');
        // $this->db->join('event_participant ep', 'ep.event_id = e.id', 'LEFT');
        $this->db->where('e.ept_category', 1);         
        $this->db->where('e.published', 'Yes');  
        $this->db->where('e.event_reg_end <=', date('Y-m-d'));
        
        // Event type 
        if($this->db->where('e.et_national', 1)){
            $this->db->or_where_in('e.et_region_ids', $info->sc_region_id);
            $this->db->or_where_in('e.et_district_ids', $info->sc_district_id);         
            $this->db->or_where_in('e.et_upazila_ids', $info->sc_upa_tha_id);             
        }
        if($this->db->where('e.et_international', 1)){
            $this->db->or_where_in('e.et_region_ids', $info->sc_region_id);
            $this->db->or_where_in('e.et_district_ids', $info->sc_district_id);         
            $this->db->or_where_in('e.et_upazila_ids', $info->sc_upa_tha_id);                      
        }
     
        // Event Participants Type
        if($info->member_id == 2 && $info->sc_section_id == 1){
            if($this->db->where('e.ept_cub', 1)){
                $this->db->where('e.cub_stage_id >=', $info->sc_badge_id);
                $this->db->where('e.cub_stage_id <=', 6);
                $this->db->where('e.event_reg_end >=', date('Y-m-d'));
            }
        }

        if($info->member_id == 2 && $info->sc_section_id == 2){
            if($this->db->where('e.ept_scout', 1)){
                $this->db->where('e.scout_stage_id >=', $info->sc_badge_id);
                $this->db->where('e.scout_stage_id <=', 12);
                $this->db->where('e.event_reg_end >=', date('Y-m-d'));
            }
        }

        if($info->member_id == 2 && $info->sc_section_id == 3){
            if($this->db->where('e.ept_rover', 1)){
                $this->db->where('e.rover_stage_id >=', $info->sc_badge_id);
                $this->db->where('e.rover_stage_id <=', 17);
                $this->db->where('e.event_reg_end >=', date('Y-m-d'));
            }
        }

        if($info->member_id == 8){
            if($this->db->where('e.ept_leader', 1)){
                if($info->sc_section_id == 1){
                    $this->db->where('e.leader_stage_id >=', $info->sc_badge_id);
                    $this->db->where('e.leader_stage_id <=', 111);    
                }elseif($info->sc_section_id == 2){
                    $this->db->where('e.leader_stage_id >=', $info->sc_badge_id);
                    $this->db->where('e.leader_stage_id <=', 102);    
                }elseif($info->sc_section_id == 3){
                    $this->db->where('e.leader_stage_id >=', $info->sc_badge_id);
                    $this->db->where('e.leader_stage_id <=', 93);    
                }elseif($info->sc_section_id == 4){
                    $this->db->where('e.leader_stage_id >=', $info->sc_badge_id);
                    $this->db->where('e.leader_stage_id <=', 84);    
                }
                $this->db->where('e.event_reg_end >=', date('Y-m-d'));
            }
        }

        
        $this->db->order_by('e.id', 'DESC');
        $query = $this->db->get()->result();
        // echo $this->db->last_query(); exit;
        return $query;
    }

    public function upcomming_event_group_unit($info) {
        // print_r($info); exit;
        // , ep.event_id, ep.scout_id
        // echo $info->grp_scout_upa_id; exit;
        $this->db->select('e.*');
        $this->db->from('events e');
        $this->db->or_where_in('e.et_region_ids', $info->grp_region_id);
        $this->db->or_where_in('e.et_district_ids', $info->grp_scout_dis_id);         
        $this->db->or_where_in('e.et_upazila_ids', $info->grp_scout_upa_id); 
        $this->db->where('e.event_reg_end >=', date('Y-m-d'));      
        $this->db->where('e.ept_category', 2);   
        $this->db->where('e.published', 'Yes');
        
        $this->db->order_by('e.id', 'DESC');
        $query = $this->db->get()->result();
        // echo $this->db->last_query(); exit;
        return $query;
    }

    public function get_my_group_application($groupID) {
        $this->db->select('ejg.*, e.event_title, e.event_venue, e.event_organizer, ou.unit_name');
        $this->db->from('event_join_group ejg');
        $this->db->join('events e', 'e.id = ejg.event_id', 'LEFT');
        $this->db->join('office_unit ou', 'ou.id = ejg.unit_id', 'LEFT');
        // $this->db->join('events e', 'e.id = ejg.event_id', 'LEFT');
        // $this->db->join('event_category ec', 'ec.id = e.ept_category', 'LEFT');
        // $this->db->join('office_district od', 'od.id = e.sc_district_id', 'LEFT');
        $this->db->where('ejg.group_id', $groupID);
        $this->db->order_by('ejg.id', 'DESC');
        $query = $this->db->get()->result();
        // echo $this->db->last_query(); exit;

        return $query;
    }

    public function get_group_application($id) {
        $this->db->select('ejg.*, e.event_title, e.event_venue, e.event_organizer');
        $this->db->from('event_join_group ejg');
        $this->db->join('events e', 'e.id = ejg.event_id', 'LEFT');
        // $this->db->join('office_unit ou', 'ou.id = ejg.unit_id', 'LEFT');
        // $this->db->join('events e', 'e.id = ejg.event_id', 'LEFT');
        // $this->db->join('event_category ec', 'ec.id = e.ept_category', 'LEFT');
        // $this->db->join('office_district od', 'od.id = e.sc_district_id', 'LEFT');
        $this->db->where('ejg.event_id', $id);
        $this->db->order_by('ejg.id', 'DESC');
        $query = $this->db->get()->result();
        // echo $this->db->last_query(); exit;

        return $query;
    }

    public function get_application_details($id) {
        $this->db->select('ejg.*, e.event_title, e.event_venue, e.event_organizer, e.event_start_date, e.event_end_date, e.event_reg_start, e.event_reg_end, e.ep_qty, e.ept_cub, e.ept_scout, e.ept_rover, e.ept_leader, e.cub_stage_id, e.scout_stage_id, e.rover_stage_id, e.leader_stage_id, ec.event_cate_name, ou.unit_name');
        $this->db->from('event_join_group ejg');
        $this->db->join('events e', 'e.id = ejg.event_id', 'LEFT');
        $this->db->join('office_unit ou', 'ou.id = ejg.unit_id', 'LEFT');
        $this->db->join('event_category ec', 'ec.id = e.event_category', 'LEFT');

        // $this->db->join('event_category ec', 'ec.id = e.event_category', 'LEFT');
        // $this->db->join('event_approve_rules ear', 'ear.id = e.approve_role', 'LEFT');
        // $this->db->join('office_groups og', 'og.id = e.sc_group_id', 'LEFT');
        // $this->db->join('office_upazila ou', 'ou.id = e.sc_upa_tha_id', 'LEFT');
        // $this->db->join('office_district od', 'od.id = e.sc_district_id', 'LEFT');
        // $this->db->join('office_region r', 'r.id = e.sc_region_id', 'LEFT');
        $this->db->where('ejg.id', $id);
        $query = $this->db->get()->row();

        return $query;
    }



    public function is_apply_event($eventID, $scout_id){
        // echo 'Hello'; exit;
        $this->db->select('event_id, scout_id');
        $this->db->from('event_participant');
        $this->db->where('event_id', $eventID);
        $this->db->where('scout_id', $scout_id);
        $query = $this->db->get()->row();

        return $query; 
        // print_r($query); exit;
    }


    public function get_applicant_data($limit = 1000, $offset = 0, $eventLevel=NULL, $region=NULL, $district=NULL){
        $this->db->select('ep.*, e.id as eventid, e.event_title, e.event_start_date, e.event_end_date, e.event_level, u.id as user_id, u.scout_id, u.first_name');
        $this->db->from('event_participant ep');
        $this->db->join('events e', 'e.id = ep.event_id', 'LEFT');
        $this->db->join('users u', 'u.id = ep.scout_id', 'LEFT');
        $this->db->limit($limit);
        $this->db->offset($offset);
        // $this->db->where('e.event_level', $eventLevel);
        $this->db->order_by('ep.id', 'DESC');
        if($region){
            $this->db->where('ep.curr_region_id', $region);
        }
        if($district){
            $this->db->where('ep.curr_district_id', $district);
        }
        $query = $this->db->get()->result();
        // echo $this->db->last_query(); exit;        
        $result['rows'] = $query;

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('event_participant');  
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

    public function get_event_applicant_list($id){
        $this->db->select('e.*, r.region_name, od.dis_name, ou.upa_name, og.grp_name');
        $this->db->from('events e');
        $this->db->join('office_groups og', 'og.id = e.sc_group_id', 'LEFT');
        $this->db->join('office_upazila ou', 'ou.id = e.sc_upa_tha_id', 'LEFT');
        $this->db->join('office_district od', 'od.id = e.sc_district_id', 'LEFT');
        $this->db->join('office_region r', 'r.id = e.sc_region_id', 'LEFT');
        $this->db->where('e.id', $id);
        $query['info'] = $this->db->get()->row();
        // echo $this->db->last_query(); exit;

        $this->db->select('ep.*, u.id as user_id, u.scout_id, u.first_name, u.profile_img, mt.member_type_name');
        $this->db->from('event_participant ep');
        $this->db->join('users u', 'u.id = ep.scout_id', 'LEFT');
        $this->db->join('member_type mt', 'mt.id = u.member_id', 'LEFT');
        $this->db->where('ep.event_id', $id);
        $query['member_list'] = $this->db->get()->result();

        return $query;
    }

    public function get_event_participant_list($id){
        $this->db->select('e.*, r.region_name, od.dis_name, ou.upa_name, og.grp_name');
        $this->db->from('events e');
        $this->db->join('office_groups og', 'og.id = e.sc_group_id', 'LEFT');
        $this->db->join('office_upazila ou', 'ou.id = e.sc_upa_tha_id', 'LEFT');
        $this->db->join('office_district od', 'od.id = e.sc_district_id', 'LEFT');
        $this->db->join('office_region r', 'r.id = e.sc_region_id', 'LEFT');
        $this->db->where('e.id', $id);
        $query['info'] = $this->db->get()->row();
        // echo $this->db->last_query(); exit;
        // print_r($query['info']); 
        
        $this->db->select('ep.*, u.id as user_id, u.scout_id, u.first_name, u.profile_img, mt.member_type_name, e.created_office_by');        
        $this->db->from('event_participant ep');
        $this->db->join('events e', 'e.id = ep.event_id', 'LEFT');
        $this->db->join('users u', 'u.id = ep.scout_id', 'LEFT');
        $this->db->join('member_type mt', 'mt.id = u.member_id', 'LEFT');
        $this->db->where('ep.event_id', $id);
        $this->db->where('e.published', 'Yes');

        if($query['info']->created_office_by == 1){
            $this->db->where('ep.verify_nhq', 'Approved');
        }elseif($query['info']->created_office_by == 2){
            $this->db->where('ep.verify_region', 'Approved');
        }elseif($query['info']->created_office_by == 3){
            $this->db->where('ep.verify_district', 'Approved');
        }elseif($query['info']->created_office_by == 4){
            $this->db->where('ep.verify_upazila', 'Approved');
        }
        
        $query['member_list'] = $this->db->get()->result();

        return $query;
    }

    public function get_event_certificate($id) {
        // result query
        $this->db->select('e.*, u.first_name, u.full_name_bn, u.scout_id, u.dob, u.phone, og.grp_name, og.grp_name_bn');
        $this->db->from('event_participant e');
        $this->db->join('users u', 'u.id = e.scout_id', 'LEFT');
        $this->db->join('office_groups og', 'og.id = u.sc_group_id', 'LEFT');
        $this->db->where('e.verify_nhq', 'Approved');
        $this->db->where('e.id', $id);
        $result = $this->db->get()->row();  

        // echo $this->db->last_query(); exit;  

        return $result;
    }

    public function get_scout_sort_info($id){
        $this->db->select('id, scout_id, first_name, profile_img');
        $this->db->from('users');
        $this->db->where('id', $id);
        $query = $this->db->get()->row();

        return $query;
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

    public function get_badges_single($id){
        return $query = $this->db->select('b.id, bt.badge_type_name_bn')->join('badge_type bt', 'b.badge_type_id=bt.id', 'LEFT')->where('b.id', $id)->get('scout_badge b')->row()->badge_type_name_bn;
    }

    public function upcomming_event() {
        $this->db->select('*');
        $this->db->where('event_start_date >',date('Y-m-d'));
        $this->db->from('events');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get()->result();

        return $query;
    }

    public function my_application() {
        $this->db->select('ep.*, ep.id as app_id, e.*, ec.event_cate_name, r.region_name, od.dis_name');
        $this->db->from('event_participant ep');
        $this->db->join('events e', 'e.id = ep.event_id', 'LEFT');
        $this->db->join('event_category ec', 'ec.id = e.ept_category', 'LEFT');
        $this->db->join('office_district od', 'od.id = e.sc_district_id', 'LEFT');
        $this->db->join('office_region r', 'r.id = e.sc_region_id', 'LEFT');
        $this->db->where('ep.scout_id', $this->session->userdata('user_id'));
        $this->db->order_by('ep.id', 'DESC');
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_application($id) {
        $this->db->select('ep.*, ep.id as participant_id, e.*, r.region_name, od.dis_name, u.scout_id AS scoutID, u.first_name, u.profile_img');
        $this->db->from('event_participant ep');
        $this->db->join('events e', 'e.id = ep.event_id', 'LEFT');
        $this->db->join('office_district od', 'od.id = e.sc_district_id', 'LEFT');
        $this->db->join('office_region r', 'r.id = e.sc_region_id', 'LEFT');
        $this->db->join('users u', 'u.id = ep.scout_id', 'LEFT');
        $this->db->where('ep.id', $id);
        $query = $this->db->get()->row();
        // echo $this->db->last_query(); exit;
        return $query;
    }

    public function upcomming_events($region=NULL, $district=NULL) {
        $this->db->select('e.*, ep.participant_type_req, ep.event_id AS parti_event_id');
        $this->db->from('events e');
        $this->db->join('event_participant ep', 'ep.event_id = e.id', 'LEFT');
        $this->db->where('e.event_reg_end >=', date('Y-m-d'));

        if($region != NULL){
            $this->db->where('e.sc_region_id', $region);         
        }
        if($district != NULL){
            $this->db->where('e.sc_district_id', $district);         
        }

        // $this->db->or_where('e.event_level', 'nhq');         
        $this->db->order_by('e.id', 'DESC');
        $query = $this->db->get()->result();

        return $query;
    }

    function application_delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('event_participant');
        return TRUE;
    }





















   //  public function scout_member_event() {
   //      $this->users= $this->ion_auth->user()->row();
   //      $this->db->select('*');
   //      $this->db->from('events');
   //      if($this->users->sc_section_id==NULL){
   //          $this->db->like('event_notify', 'NULL');
   //      }
   //      $this->db->where('event_start_date >',date('Y-m-d'));
   //      // $this->db->where('sc_region_id', $this->users->sc_region_id);
   //      // $this->db->where('sc_district_id', $this->users->sc_district_id);
   //      // $this->db->where('sc_upa_tha_id', $this->users->sc_upa_tha_id);
   //      // $this->db->where('sc_group_id', $this->users->sc_group_id);
   //      $this->db->order_by('id', 'DESC');
   //      $query = $this->db->get()->result();

   //      $results_arr=array();

   //      foreach ($query as  $item) {
   //          $notify=explode(',', $item->event_notify);
   //          if(!empty(in_array('All', $notify)) OR !empty(in_array($this->users->sc_section_id, $notify))){
   //             $results_arr[]=$item; 
   //         }
   //     }

   //     return $results_arr;
   // }




    public function get_scout_member_list($id) {
        $this->db->select('event_to_scouts.id, event_to_scouts.scout_id, event_to_scouts.event_id, event_to_scouts.status, event_to_scouts.comments, users.first_name, users.scout_id as scoutid');
        $this->db->from('event_to_scouts');
        $this->db->join('users', 'users.id=event_to_scouts.scout_id');
        $this->db->where('event_to_scouts.event_id', $id);
        $query = $this->db->get()->result();
        return $query;
    }

    public function get_scout_member($id, $scout_id) {
        $this->db->select('*');
        $this->db->from('event_to_scouts');
        $this->db->where('event_id', $id);
        $this->db->where('scout_id', $scout_id);
        $query = $this->db->get()->row();
        return $query;
    }

    public function get_scout_member_approved() {

        $this->users= $this->ion_auth->user()->row();

        $this->db->select('e.*, es.comments');
        $this->db->from('events e');
        $this->db->join('event_to_scouts es', 'e.id=es.event_id');
        $this->db->where('e.event_end_date <=',date('Y-m-d'));
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

    public function get_event_valid($id) {

        $this->users= $this->ion_auth->user()->row();

        $this->db->select('e.*');
        $this->db->from('events e');
        $this->db->join('event_to_scouts es', 'e.id=es.event_id','LEFT');
        $this->db->where('e.id', $id);
        $this->db->where('e.event_end_date <=',date('Y-m-d'));
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

    public function edit($table, $scout_id, $event_id, $data) {
        $this->db->where('scout_id', $scout_id);
        $this->db->where('event_id', $event_id);
        if ($this->db->update($table, $data)) {
            return true;
        }else{
            return false;
        }
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('events');

        $this->db->where('event_id', $id);
        $this->db->delete('event_to_scouts');

        return TRUE;
    }

}
