<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Program_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_prof_badge_group_section($sectionID){
      $data[''] = '-- Select Proficiency Badge Group --';
      $this->db->select('id, prof_badge_group_name');
      $this->db->from('scout_prof_badge_group');
      $this->db->where('section_id', $sectionID);      
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['prof_badge_group_name'];
      }
      return $data;
   }

   public function get_prof_badge_by_section($sectionID){
      $data[''] = '- Select Proficiency Badge Name -';
      $this->db->select('id, prof_badge_name');
      $this->db->from('scout_prof_badge');
      $this->db->where('section_id', $sectionID);
      $this->db->where('is_delete', 1);
      $query = $this->db->get();
      // echo $this->db->last_query(); exit;

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['prof_badge_name'];
      }
      return $data;
   }

    public function get_scout_badge_by_member_section_type($memberID, $sectionID){
      $data[''] = '-- Select Badge Type --';
      $this->db->select('sb.*, bt.badge_type_name_bn, bt.badge_type_name_en');
      $this->db->from('scout_badge sb');
      $this->db->join('badge_type bt','sb.badge_type_id=bt.id', 'LEFT');
      $this->db->where('sb.member_id', $memberID);
      $this->db->where('sb.section_id', $sectionID);
      $this->db->where('sb.is_delete', 0);
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['badge_type_name_en'].' ('.$rows['badge_type_name_bn'].')';
      }
      return $data;
   }

   public function get_scout_role_by_member_section_type($memberID, $sectionID){
      $data[''] = '-- Select Role Type --';
      $this->db->select('sr.*, rt.role_type_name_bn');
      $this->db->from('scout_role sr');
      $this->db->join('role_type rt','sr.role_type_id=rt.id', 'LEFT');
      $this->db->where('sr.member_id', $memberID);
      $this->db->where('sr.section_id', $sectionID);
      $this->db->where('sr.is_delete', 0);
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['role_type_name_bn'];
      }
      return $data;
   }

	public function get_badge_details($form_data) {
        $this->db->select('p.id, p.status, au.id as ex_id, u.scout_id, au.scout_id as examiner_id, bt.badge_type_name_bn, sb.questions, p.achive_date, p.badge_id, p.question_id');
        $this->db->from('prog_badge_question_value p');
        $this->db->join('users u', 'u.id = p.user_id', 'LEFT');
        $this->db->join('users au', 'au.id = p.examiner_id', 'LEFT');
        $this->db->join('scout_badge sbg', 'sbg.id = p.badge_id', 'LEFT');
        $this->db->join('badge_type bt','bt.id=sbg.badge_type_id', 'LEFT');
        $this->db->join('scout_badge_question sb', 'sb.id = p.question_id', 'LEFT');
        
		$this->db->where('p.scout_id',$form_data['scout_id']);
        $this->db->where('p.section_id',$form_data['section_id']);     
        
		$query = $this->db->get()->result();
        //echo $this->db->last_query();

        return $query;
    }

    public function get_badge_details_expertness($form_data) {
        $this->db->select('p.id, p.status, au.id as ex_id, u.scout_id, au.scout_id as examiner_id, bt.badge_type_name_bn, sb.expert_group_name, p.achive_date, p.badge_id, p.expert_group_id, p.extra_badge');
        $this->db->from('prog_badge_expertness p');
        $this->db->join('users u', 'u.id = p.user_id', 'LEFT');
        $this->db->join('users au', 'au.id = p.examiner_id', 'LEFT');
        $this->db->join('scout_badge sbg', 'sbg.id = p.badge_id', 'LEFT');
        $this->db->join('badge_type bt', 'bt.id = sbg.badge_type_id', 'LEFT');
        $this->db->join('scout_expertness_group sb', 'sb.id = p.expert_group_id', 'LEFT');

        $this->db->where('p.scout_id', $form_data['scout_id']);
        $this->db->where('p.section_id', $form_data['section_id']);     
        
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_proficiency_badge($form_data) {
        $this->db->select('p.id, p.scout_id, p.achieved_date, p.extra_badge, p.evaluated_by, bt.badge_type_name_bn, spb.prof_badge_name, bt.badge_type_name_en, pbg.prof_badge_group_name, u.scout_id AS evaluat_scout_id, u.first_name');
        $this->db->from('prog_proficiency_badge p');
        $this->db->join('users u', 'u.id = p.evaluated_by', 'LEFT');
        $this->db->join('scout_badge sbg', 'sbg.id = p.badge_id', 'LEFT');
        $this->db->join('badge_type bt', 'bt.id = sbg.badge_type_id', 'LEFT');
        $this->db->join('scout_prof_badge spb', 'spb.id = p.prof_badge_id', 'LEFT');
        $this->db->join('scout_prof_badge_group pbg', 'pbg.id = p.prof_badge_group_id', 'LEFT');
        $this->db->where('p.scout_id', $form_data['scout_id']);
        $this->db->where('p.section_id', $form_data['section_id']);     
        
        $query = $this->db->get()->result();
        // echo $this->db->last_query(); exit;
        return $query;
    }

    public function get_proficiency_badge_by_id($id){
        $this->db->select('p.*, u.scout_id, u.first_name');
        $this->db->from('prog_proficiency_badge p');
        $this->db->join('users u', 'u.id = p.evaluated_by', 'LEFT');
        $this->db->where('p.id', $id);

        $query = $this->db->get()->row();

        return $query;
    }

    // r.region_name, od.dis_name, ou.upa_name, og.grp_name,
    public function get_promotions($form_data) {
        $this->db->select('p.*, mt.member_type_name, rt.role_type_name_en, rt.role_type_name_bn, og.grp_name, og.grp_name_bn');
        $this->db->from('prog_promotions p');
        $this->db->join('member_type mt', 'mt.id = p.promo_member_id', 'LEFT');
        $this->db->join('scout_role so', 'so.id = p.promo_role_id', 'LEFT');
        $this->db->join('role_type rt', 'rt.id = so.role_type_id', 'LEFT');
        // $this->db->join('department d', 'd.id = p.promo_department_id', 'LEFT');
        // $this->db->join('office_unit uni', 'uni.id = p.promo_unit_id', 'LEFT');
        $this->db->join('office_groups og', 'og.id = p.promo_gorup_id', 'LEFT');
        // $this->db->join('office_upazila ou', 'ou.id = p.promo_upazila_id', 'LEFT');
        // $this->db->join('office_district od', 'od.id = p.promo_district_id', 'LEFT');
        // $this->db->join('office_region r', 'r.id = p.promo_region_id', 'LEFT');
        $this->db->where('p.scout_id', $form_data['scout_id']);
        $this->db->where('p.section_id', $form_data['section_id']);     
        
        $query = $this->db->get()->result();
        // echo $this->db->last_query(); exit;
        return $query;
    }    

    public function get_promotion_by_id($id){
        $this->db->select('p.*, og.grp_name, og.grp_name_bn');
        $this->db->from('prog_promotions p');
        $this->db->join('office_groups og', 'og.id = p.promo_gorup_id', 'LEFT');
        // $this->db->join('users u', 'u.id = p.evaluated_by', 'LEFT');
        $this->db->where('p.id', $id);

        $query = $this->db->get()->row();

        return $query;
    }

    public function get_trainings($form_data) {
        $this->db->select('p.*, c.course_name');
        $this->db->from('prog_training p');
        $this->db->join('scout_progress_course c', 'c.id = p.course_id', 'LEFT');
        $this->db->where('p.scout_id', $form_data['scout_id']);
        $this->db->where('p.section_id', $form_data['section_id']);     
        $this->db->order_by('p.id', 'DESC');
        $query = $this->db->get()->result();
        // echo $this->db->last_query(); exit;
        return $query;
    }

    public function get_activities($form_data) {
        $this->db->select('p.*, e.event_cate_name');
        $this->db->from('prog_activities p');
        $this->db->join('event_category e', 'e.id = p.activity_type_id', 'LEFT');
        $this->db->where('p.scout_id', $form_data['scout_id']);
        $this->db->where('p.section_id', $form_data['section_id']);     
        
        $query = $this->db->get()->result();
        // echo $this->db->last_query(); exit;
        return $query;
    }

    public function get_group_change($form_data) {
        $this->db->select('p.*');
        $this->db->from('prog_group_resign p');
        $this->db->where('p.scout_id', $form_data['scout_id']);
        $this->db->where('p.section_id', $form_data['section_id']);     
        
        $query = $this->db->get()->result();
        // echo $this->db->last_query(); exit;
        return $query;
    }

    public function get_badge_details_achievement($form_data) {
        $this->db->select('p.id, p.scout_id as user_id, p.status, au.id as ex_id, u.scout_id, au.scout_id as examiner_id, au.first_name, bt.badge_type_name_bn, bt.badge_type_name_en, p.achive_date, p.badge_id');
        $this->db->from('prog_badge_achievement p');
        $this->db->join('users u', 'u.id = p.user_id', 'LEFT');
        $this->db->join('users au', 'au.id = p.examiner_id', 'LEFT');
        $this->db->join('scout_badge sbg', 'sbg.id = p.badge_id', 'LEFT');
        $this->db->join('badge_type bt', 'bt.id = sbg.badge_type_id', 'LEFT');
        $this->db->where('p.scout_id', $form_data['scout_id']);
        $this->db->where('p.section_id', $form_data['section_id']);     
        
        $query = $this->db->get()->result();
        //echo $this->db->last_query();

        return $query;
    }    

    public function get_achievement_by_id($id){
        $this->db->select('p.*, u.scout_id, u.first_name');
        $this->db->from('prog_badge_achievement p');
        $this->db->join('users u', 'u.id = p.examiner_id', 'LEFT');
        $this->db->where('p.id', $id);

        $query = $this->db->get()->row();

        return $query;
    }

    public function get_progress_award($form_data) {
        $this->db->select('id, scout_id, award_name, certificate_no, issue_date,    issue_authority');
        $this->db->from('prog_award');        
        $this->db->where('scout_id', $form_data['scout_id']);                
        $query = $this->db->get()->result();
        //echo $this->db->last_query();

        return $query;
    }

    public function get_progress_award_by_id($id){
        $this->db->select('*');
        $this->db->from('prog_award');
        $this->db->where('id', $id);
        $query = $this->db->get()->row();

        return $query;
    }

    public function get_badge_details_camping($form_data) {
        $this->db->select('p.id, p.status, au.id as ex_id, u.scout_id, au.scout_id as examiner_id, p.area,  p.camp_date,  p.camp_name, p.certificate_no');
        $this->db->from('prog_camping p');
        $this->db->join('users u', 'u.id = p.user_id', 'LEFT');
        $this->db->join('users au', 'au.id = p.examiner_id', 'LEFT');        
        $this->db->where('p.scout_id',$form_data['scout_id']);
        $this->db->where('p.section_id',$form_data['section_id']);     
        
        $query = $this->db->get()->result();
        //echo $this->db->last_query();

        return $query;
    }

     public function get_badge_details_training($form_data) {
        $this->db->select('p.id, p.status, au.id as ex_id, u.scout_id, au.scout_id as examiner_id, bt.badge_type_name_bn,  p.training_date, p.badge_id, p.training_name, p.certificate_no');
        $this->db->from('prog_training p');
        $this->db->join('users u', 'u.id = p.user_id', 'LEFT');
        $this->db->join('users au', 'au.id = p.examiner_id', 'LEFT');
        // $this->db->join('scout_badge sbg', 'sbg.id = p.badge_id', 'LEFT');
        $this->db->join('badge_type bt', 'bt.id = p.badge_id', 'LEFT');
        $this->db->where('p.scout_id', $form_data['scout_id']);
        $this->db->where('p.section_id', $form_data['section_id']);     
        
        $query = $this->db->get()->result();
        //echo $this->db->last_query();

        return $query;
    }

    public function get_badge_details_health($form_data) {
        $this->db->select('h.*,au.id as ex_id, u.scout_id as scout_id2, au.scout_id as examiner_id,');
        $this->db->from('prog_physical_health h');
        $this->db->join('users u', 'u.id = h.user_id', 'LEFT');
        $this->db->join('users au', 'au.id = h.examiner_id', 'LEFT');
        $this->db->where('h.scout_id',$form_data['scout_id']);
        $this->db->where('h.section_id',$form_data['section_id']);     
        
        $query = $this->db->get()->result();
        //echo $this->db->last_query();

        return $query;
    }


    public function get_badge_details_institute($form_data) {
        $this->db->select('h.*,au.id as ex_id, u.scout_id as scout_id2, au.scout_id as examiner_id,');
        $this->db->from('prog_institute_promotion h');
        $this->db->join('users u', 'u.id = h.user_id', 'LEFT');
        $this->db->join('users au', 'au.id = h.examiner_id', 'LEFT');
        $this->db->where('h.scout_id',$form_data['scout_id']);
        $this->db->where('h.section_id',$form_data['section_id']);     
        
        $query = $this->db->get()->result();
        //echo $this->db->last_query();

        return $query;
    }

     public function get_badge_details_promotion($form_data) {
        $this->db->select('p.id, p.status, au.id as ex_id, u.scout_id, au.scout_id as examiner_id, bt.badge_type_name_bn,  p.from_date, p.badge_id,  p.role_id, p.to_date, rt.role_type_name_bn');
        $this->db->from('prog_section_promotion p');
        $this->db->join('users u', 'u.id = p.user_id', 'LEFT');
        $this->db->join('users au', 'au.id = p.examiner_id', 'LEFT');
        $this->db->join('scout_badge sbg', 'sbg.id = p.badge_id', 'LEFT');
        $this->db->join('badge_type bt', 'bt.id = sbg.badge_type_id', 'LEFT');
        $this->db->join('scout_role sr', 'sr.id = p.role_id', 'LEFT');
        $this->db->join('role_type rt', 'rt.id = sr.role_type_id', 'LEFT');
        
        $this->db->where('p.scout_id',$form_data['scout_id']);
        $this->db->where('p.section_id',$form_data['section_id']);     
        
        $query = $this->db->get()->result();
        //echo $this->db->last_query();

        return $query;
    }

    public function get_badge_details_resign($form_data) {
        $this->db->select('p.id, p.status, au.id as ex_id, u.scout_id, au.scout_id as examiner_id,  p.resign_date, p.resign_reason');
        $this->db->from('prog_group_resign p');
        $this->db->join('users u', 'u.id = p.user_id', 'LEFT');
        $this->db->join('users au', 'au.id = p.examiner_id', 'LEFT');
        $this->db->where('p.scout_id',$form_data['scout_id']);
        $this->db->where('p.section_id',$form_data['section_id']);     
        
        $query = $this->db->get()->result();
        //echo $this->db->last_query();

        return $query;
    }

	function delete_prgram($table,$id) {

		$this->db->where('id', $id);
		$this->db->delete($table);
		
		return TRUE;
	}

	public function checkduplicate($form_data) {
        $this->db->select('*');
        $this->db->from('prog_badge_question_value'); 
        $this->db->where('scout_id',$form_data['scout_id']);
        $this->db->where('section_id',$form_data['section_id']);
        $this->db->where('badge_id',$form_data['badge_id']);
        $this->db->where('question_id',$form_data['question_id']);
        $result = $this->db->get()->result();
        return $result;
    }

    public function expertness_checkduplicate($form_data) {
        $this->db->select('*');
        $this->db->from('prog_badge_expertness'); 
        $this->db->where('scout_id',$form_data['scout_id']);
        $this->db->where('section_id',$form_data['section_id']);
        $this->db->where('badge_id',$form_data['badge_id']);
        $this->db->where('expert_group_id',$form_data['expert_group_id']);
        $result = $this->db->get()->result();
        return $result;
    }
    public function achievement_checkduplicate($form_data) {
        $this->db->select('*');
        $this->db->from('prog_badge_achievement'); 
        $this->db->where('scout_id',$form_data['scout_id']);
        $this->db->where('section_id',$form_data['section_id']);
        $this->db->where('badge_id',$form_data['badge_id']);
        $result = $this->db->get()->result();
        return $result;
    }

     public function camping_checkduplicate($form_data) {
        $this->db->select('*');
        $this->db->from('prog_camping'); 
        $this->db->where('scout_id',$form_data['scout_id']);
        $this->db->where('section_id',$form_data['section_id']);
        $this->db->where('camp_name',$form_data['camp_name']);
        $this->db->where('certificate_no',$form_data['certificate_no']);
        $result = $this->db->get()->result();
        return $result;
    }

     public function training_checkduplicate($form_data) {
        $this->db->select('*');
        $this->db->from('prog_training'); 
        $this->db->where('scout_id',$form_data['scout_id']);
        $this->db->where('section_id',$form_data['section_id']);
        $this->db->where('badge_id',$form_data['badge_id']);
        $this->db->where('training_name',$form_data['training_name']);
        $this->db->where('certificate_no',$form_data['certificate_no']);
        $result = $this->db->get()->result();
        return $result;
    }

    public function health_checkduplicate($form_data) {
        $this->db->select('*');
        $this->db->from('prog_physical_health'); 
        $this->db->where('scout_id',$form_data['scout_id']);
        $this->db->where('section_id',$form_data['section_id']);
        $this->db->where('years',$form_data['years']);
        $result = $this->db->get()->result();
        return $result;
    }

    public function institute_checkduplicate($form_data) {
        $this->db->select('*');
        $this->db->from('prog_institute_promotion'); 
        $this->db->where('scout_id',$form_data['scout_id']);
        $this->db->where('section_id',$form_data['section_id']);
        $this->db->where('years',$form_data['years']);
        $result = $this->db->get()->result();
        return $result;
    }

    public function promotion_checkduplicate($form_data) {
        $this->db->select('*');
        $this->db->from('prog_section_promotion'); 
        $this->db->where('scout_id',$form_data['scout_id']);
        $this->db->where('section_id',$form_data['section_id']);
        $this->db->where('badge_id',$form_data['badge_id']);
        $this->db->where('role_id',$form_data['role_id']);
        $this->db->where('from_date',$form_data['from_date']);
        $result = $this->db->get()->result();
        return $result;
    }

    public function resign_checkduplicate($form_data) {
        $this->db->select('*');
        $this->db->from('prog_group_resign'); 
        $this->db->where('scout_id',$form_data['scout_id']);
        $this->db->where('section_id',$form_data['section_id']);
        $this->db->where('resign_date',$form_data['resign_date']);
        $this->db->where('resign_reason',$form_data['resign_reason']);
        $result = $this->db->get()->result();
        return $result;
    }
   

    public function get_info($id) {
        $this->db->select('u.*, u.scout_id, oc.occupation_name, bg.bg_name_en, dv.div_name as pre_div_name, dv2.div_name as per_div_name, ds.district_name as pre_district_name, ds2.district_name as per_district_name, ut.up_th_name as pre_up_th_name, ut2.up_th_name as per_up_th_name, r.region_name, od.dis_name, ou.upa_name, og.grp_name, unit.unit_name, bt.badge_type_name_bn, rt.role_type_name_bn, it.name as institute_name');
        $this->db->from('users u');
        $this->db->join('occupation oc', 'oc.id=u.occupation_id', 'LEFT');
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
        $this->db->join('institute it', 'it.id = u.curr_institute_id', 'LEFT');
        $this->db->join('scout_badge sb', 'sb.id = u.sc_badge_id', 'LEFT');
        $this->db->join('badge_type bt', 'bt.id = sb.badge_type_id', 'LEFT');
        $this->db->join('scout_role so', 'so.id = u.sc_role_id', 'LEFT');
        $this->db->join('role_type rt', 'rt.id = so.role_type_id', 'LEFT');
        $this->db->join('office_region r', 'r.id = u.sc_region_id', 'LEFT');

        $this->db->where('u.id', $id);
        $query = $this->db->get()->row();

        // echo $this->db->last_query(); exit;

        return $query;
    }


    public function get_proficiency_badge_group_by_id($id=NULL){
      // $field= $this->session->userdata('site_lang')=='bangla'?'district_name_bn':'district_name';
      $data['0'] ='-Select One- ';
      $this->db->select("id, prof_badge_name");
      $this->db->from('scout_prof_badge');      
      $this->db->where('prof_badge_id', $id);
      $this->db->order_by('id', 'ASC');
      $query = $this->db->get();
        
      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['prof_badge_name'];
      }
      return $data;
   }


}
