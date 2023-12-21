<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Scouts_member_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function get_book($booksClue, $column){
        $this->db->select($column);
        $this->db->from('users');
        $this->db->like('scout_id', $booksClue);
        return $this->db->get()->result_array();
    }

    /******************************** Get List **********************************
    *****************************************************************************/

    public function get_scout_member($limit=1000, $offset=0, $region_id=NULL, $sc_district_id=NULL, $sc_upa_tha_id=NULL, $sc_scout_group_id=NULL, $status=NULL) {
        // echo 'hello'; exit;
        $this->db->select('u.id, u.username, u.scout_id, u.first_name, u.phone, u.email, u.active, u.sc_section_id, u.profile_img, u.is_printed, mt.member_type_name, og.grp_name');
        $this->db->from('users u');         
        $this->db->join('member_type mt', 'mt.id = u.member_id', 'LEFT');
        $this->db->join('office_groups og', 'og.id = u.sc_group_id', 'LEFT');
        $this->db->where('u.scout_id IS NOT NULL', NULL);
        $this->db->where('u.member_id !=', 0);
        $this->db->where('u.is_verify', 1);        
        $this->db->where('u.status', $status);
        // $this->db->where('u.is_request', '0');        
        // $this->db->where('u.is_office', 0);        
        $this->db->limit($limit);
        $this->db->offset($offset);
        $this->db->order_by('u.id', 'DESC');

        // Search Filter
        if($this->input->get('region') != NULL){
            $this->db->where('u.sc_region_id', $this->input->get('region')); 
        }
        if($this->input->get('district') > '0'){
            $this->db->where('u.sc_district_id', $this->input->get('district'));     
        }
        if($this->input->get('upazila') > '0'){
            $this->db->where('u.sc_upa_tha_id', $this->input->get('upazila'));     
        }
        if($this->input->get('sgroup') > '0'){
            $this->db->where('u.sc_group_id', $this->input->get('sgroup'));     
        }
        if($this->input->get('memberType') > '0'){
            $this->db->where('u.member_id', $this->input->get('memberType'));     
        }
        if($this->input->get('scoutID') != NULL){
            $this->db->where('u.scout_id', $this->input->get('scoutID')); 
        }
        if($this->input->get('name') != NULL){
            $this->db->like('u.first_name', $this->input->get('name'));
        }
        if($this->input->get('username') != NULL){
            $this->db->where('u.username', $this->input->get('username')); 
        }
        if($this->input->get('gender') != NULL){
            $this->db->where('u.gender', $this->input->get('gender')); 
        }
        if($this->input->get('section') != NULL){
            $this->db->where('u.sc_section_id', $this->input->get('section')); 
        }

        //Data Access
        if($region_id){
            $this->db->where('u.sc_region_id', $region_id);
            $query = $this->db->get()->result();
        }elseif($sc_district_id){
            $this->db->where('u.sc_district_id', $sc_district_id);
            $query = $this->db->get()->result();
        }elseif($sc_upa_tha_id){
            $this->db->where('u.sc_upa_tha_id', $sc_upa_tha_id);
            $query = $this->db->get()->result();
        }elseif($sc_scout_group_id){
            $this->db->where('u.sc_group_id', $sc_scout_group_id);
            $query = $this->db->get()->result();                      
        }else{
            $query = $this->db->get()->result();
        }       
        $result['rows'] = $query;
        // echo $this->db->last_query(); exit;

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('users');        
        // $this->db->where('is_request', '0');
        // if($this->ion_auth->is_admin()){
        $this->db->where('scout_id IS NOT NULL', NULL);
        $this->db->where('member_id !=', 0);
        $this->db->where('is_verify', 1);        
        $this->db->where('status', $status);
        // }
        // $this->db->where('is_office', 0);

        // Search Filter
        if($this->input->get('region') != NULL){
            $this->db->where('sc_region_id', $this->input->get('region')); 
        }
        if($this->input->get('district') > '0'){
            $this->db->where('sc_district_id', $this->input->get('district'));     
        }
        if($this->input->get('upazila') > '0'){
            $this->db->where('sc_upa_tha_id', $this->input->get('upazila'));     
        }
        if($this->input->get('sgroup') > '0'){
            $this->db->where('sc_group_id', $this->input->get('sgroup'));     
        }
        if($this->input->get('memberType') > '0'){
            $this->db->where('member_id', $this->input->get('memberType'));     
        }
        if($this->input->get('scoutID') != NULL){
            $this->db->where('scout_id', $this->input->get('scoutID')); 
        }
        if($this->input->get('name') != NULL){
            $this->db->like('first_name', $this->input->get('name'));
        }
        if($this->input->get('username') != NULL){
            $this->db->where('username', $this->input->get('username')); 
        }
        if($this->input->get('gender') != NULL){
            $this->db->where('gender', $this->input->get('gender')); 
        }
        if($this->input->get('section') != NULL){
            $this->db->where('sc_section_id', $this->input->get('section')); 
        }

        //Data Access
        if($region_id){
            $this->db->where('sc_region_id', $region_id);
            $query = $this->db->get()->result();
        }elseif($sc_district_id){
            $this->db->where('sc_district_id', $sc_district_id);
            $query = $this->db->get()->result();
        }elseif($sc_upa_tha_id){
            $this->db->where('sc_upa_tha_id', $sc_upa_tha_id);
            $query = $this->db->get()->result();
        }elseif($sc_scout_group_id){
            $this->db->where('sc_group_id', $sc_scout_group_id);
            $query = $this->db->get()->result();                     
        }else{
            $query = $this->db->get()->result();
        }

        $tmp = $query;
        $result['num_rows'] = $tmp[0]->count;
        // echo $this->db->last_query(); exit;

        return $result;
    }    

    public function get_verified_member($group_id=NULL) {
        $this->db->select('u.id, u.first_name, u.username, mt.member_type_name, u.phone, u.is_request, u.sc_section_id, u.profile_img, ou.unit_name');
        $this->db->from('users u');
        $this->db->join('office_unit ou', 'ou.id = u.sc_unit_id', 'LEFT');
        $this->db->join('member_type mt', 'mt.id = u.member_id', 'LEFT');
        if($group_id){
            $this->db->where('u.sc_group_id', $group_id);
        }        
        // $this->db->where('scout_id', NULL);        
        // $this->db->where('u.is_office', 0);  
        $this->db->where('u.scout_id IS NOT NULL', NULL);
        $this->db->where('u.member_id !=', 0);
        $this->db->where('u.is_verify', '1');        
        $this->db->where('u.status', 1);
        $query = $this->db->get()->result();
        // echo $this->db->last_query(); exit;

        return $query;
    }

    public function get_request_member($group_id=NULL) {
        $this->db->select('u.id, u.first_name, u.username, mt.member_type_name, u.phone, u.is_request, u.sc_section_id, u.profile_img, ou.unit_name');
        $this->db->from('users u');
        $this->db->join('office_unit ou', 'ou.id = u.sc_unit_id', 'LEFT');
        $this->db->join('member_type mt', 'mt.id = u.member_id', 'LEFT');
        if($group_id){
            $this->db->where('u.sc_group_id', $group_id);
        }

        $this->db->where('u.scout_id', NULL); 
        $this->db->where('u.member_id !=', 0);
        $this->db->where('u.is_request', 1);     
        // $this->db->where('u.is_verify', '1');     
        $query = $this->db->get()->result();
        // echo $this->db->last_query(); exit;

        return $query;
    }

    public function get_request_member_cancel($group_id=NULL) {
        $this->db->select('u.id, u.first_name, u.username, u.phone, u.is_request, u.sc_section_id, u.profile_img, og.grp_name');
        $this->db->from('users u');
        $this->db->join('office_groups og', 'og.id = u.sc_group_id', 'LEFT');
        if($group_id){
            $this->db->where('u.sc_group_id', $group_id);
        }
        $this->db->where('u.scout_id', NULL);
        $this->db->where('u.is_request !=', 1);        

        // $this->db->where('u.member_id !=', 0);

        $query = $this->db->get()->result();
        // echo $this->db->last_query(); exit;

        return $query;
    }

    public function get_scout_member_by_unit($sc_scout_unit_id) {
        $this->db->select('u.id, u.username, u.scout_id, u.first_name, u.father_name, u.mother_name,  bg.bg_name_en, u.phone, u.pre_village_house, u.active, u.sc_section_id, u.profile_img, od.dis_name_en, og.grp_name, mt.member_type_name');
        $this->db->from('users u'); 
        $this->db->join('blood_group bg', 'bg.id=u.blood_group', 'LEFT');
        $this->db->join('office_district od', 'od.id = u.sc_district_id', 'LEFT');
        $this->db->join('office_groups og', 'og.id = u.sc_group_id', 'LEFT');
        $this->db->join('member_type mt', 'mt.id = u.member_id', 'LEFT');
        $this->db->where('u.is_office', 0);

        // $this->db->from('users'); 
        $this->db->where('u.scout_id IS NOT NULL', NULL);
        $this->db->order_by('u.id', 'DESC');
        $this->db->where('u.sc_unit_id', $sc_scout_unit_id);
        $query = $this->db->get()->result();            

        return $query;
    }    


    /********************************** Get Info ********************************
    *****************************************************************************/

    public function get_info($id) {
        $this->db->select('u.*, u.scout_id, oc.occupation_name, bg.bg_name_en, dv.div_name as pre_div_name, dv2.div_name as per_div_name, ds.district_name as pre_district_name, ds2.district_name as per_district_name, ut.up_th_name as pre_up_th_name, ut2.up_th_name as per_up_th_name, r.region_name, r.region_type, od.dis_name, ou.upa_name, og.grp_name, unit.unit_name, bt.badge_type_name_bn, rt.role_type_name_bn, it.name as institute_name, mt.member_type_name');
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
        $this->db->join('member_type mt', 'mt.id = u.member_id', 'LEFT');
        $this->db->join('scout_badge sb', 'sb.id = u.sc_badge_id', 'LEFT');
        $this->db->join('badge_type bt','bt.id = sb.badge_type_id', 'LEFT');
        $this->db->join('scout_role so', 'so.id = u.sc_role_id', 'LEFT');
        $this->db->join('role_type rt', 'rt.id = so.role_type_id', 'LEFT');
        $this->db->join('office_region r', 'r.id = u.sc_region_id', 'LEFT');

        $this->db->where('u.id', $id);
        $query = $this->db->get()->row();

        return $query;
    }

    public function get_verify($id) {
        $this->db->select('u.*, scout_id, mt.member_type_name, oc.occupation_name, bg.bg_name_en, dv.div_name as pre_div_name, dv2.div_name as per_div_name, ds.district_name as pre_district_name, ds2.district_name as per_district_name, ut.up_th_name as pre_up_th_name, ut2.up_th_name as per_up_th_name, r.region_name, od.dis_name, ou.upa_name, og.grp_name, unit.unit_name, bt.badge_type_name_bn, rt.role_type_name_bn, it.name as institute_name');
        $this->db->from('users u');
        $this->db->join('blood_group bg', 'bg.id=u.blood_group', 'LEFT');
        $this->db->join('occupation oc', 'oc.id=u.occupation_id', 'LEFT');
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
        $this->db->join('member_type mt', 'mt.id = u.member_id', 'LEFT');
        $this->db->join('scout_badge sb', 'sb.id = u.sc_badge_id', 'LEFT');
        $this->db->join('badge_type bt', 'bt.id = sb.badge_type_id', 'LEFT');
        $this->db->join('scout_role so', 'so.id = u.sc_role_id', 'LEFT');
        $this->db->join('role_type rt', 'rt.id = so.role_type_id', 'LEFT');
        $this->db->join('office_region r', 'r.id = u.sc_region_id', 'LEFT');

        $this->db->where('u.id', $id);
        $query = $this->db->get()->row();

        return $query;
    }



    /*************************** Scouts Experinace ******************************
    *****************************************************************************/

    public function get_expreance_info($id, $section) {
        $this->db->select('se.*, r.region_name, od.dis_name, ou.upa_name, og.grp_name, unit.unit_name, bt.badge_type_name_bn, rt.role_type_name_bn');
        $this->db->from('scout_experience se');
        $this->db->join('office_unit unit', 'unit.id = se.sc_unit_id', 'LEFT');
        $this->db->join('office_groups og', 'og.id = se.sc_group_id', 'LEFT');
        $this->db->join('office_upazila ou', 'ou.id = se.sc_upa_tha_id', 'LEFT');
        $this->db->join('office_district od', 'od.id = se.sc_district_id', 'LEFT');
        $this->db->join('scout_badge sb', 'sb.id = se.sc_badge_id', 'LEFT');
        $this->db->join('badge_type bt', 'bt.id = sb.badge_type_id', 'LEFT');
        $this->db->join('scout_role so', 'so.id = se.sc_role_id', 'LEFT');
        $this->db->join('role_type rt', 'rt.id = so.role_type_id', 'LEFT');
        $this->db->join('office_region r', 'r.id = se.sc_region_id', 'LEFT');
        $this->db->where('se.scout_id', $id);
        $this->db->where('se.section_id', $section);
        $query = $this->db->get()->row();
        // echo $this->db->last_query(); exit;
        return $query;
    }

    public function get_badge_details($form_data) {
        $this->db->select('p.id, p.section_id, p.status, au.id as ex_id, u.scout_id, au.scout_id as examiner_id, bt.badge_type_name_bn, sb.questions, p.achive_date, p.badge_id, p.question_id');
        $this->db->from('prog_badge_question_value p');
        $this->db->join('users u', 'u.id = p.user_id', 'LEFT');
        $this->db->join('users au', 'au.id = p.examiner_id', 'LEFT');
        $this->db->join('scout_badge sbg', 'sbg.id = p.badge_id', 'LEFT');
        $this->db->join('badge_type bt','bt.id = sbg.badge_type_id', 'LEFT');
        $this->db->join('scout_badge_question sb', 'sb.id = p.question_id', 'LEFT');
        
        $this->db->where('p.scout_id',$form_data['scout_id']);
        $this->db->where('p.status',1);
        // $this->db->where('p.section_id',$form_data['section_id']);     
        
        $query = $this->db->get()->result();
        //echo $this->db->last_query();

        return $query;
    }

    public function get_badge_details_expertness($form_data) {
        $this->db->select('p.id, p.section_id, p.status, au.id as ex_id, u.scout_id, au.scout_id as examiner_id, bt.badge_type_name_bn, sb.expert_group_name, p.achive_date, p.badge_id, p.expert_group_id, p.extra_badge');
        $this->db->from('prog_badge_expertness p');
        $this->db->join('users u', 'u.id = p.user_id', 'LEFT');
        $this->db->join('users au', 'au.id = p.examiner_id', 'LEFT');
        $this->db->join('scout_badge sbg', 'sbg.id = p.badge_id', 'LEFT');
        $this->db->join('badge_type bt','bt.id = sbg.badge_type_id', 'LEFT');
        $this->db->join('scout_expertness_group sb', 'sb.id = p.expert_group_id', 'LEFT');
        
        $this->db->where('p.scout_id',$form_data['scout_id']);
        $this->db->where('p.status',1);
        // $this->db->where('p.section_id',$form_data['section_id']);     
        
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_badge_details_achievement($form_data) {
        $this->db->select('p.id, p.section_id, p.status, au.id as ex_id, u.scout_id, au.scout_id as examiner_id, bt.badge_type_name_bn,  p.achive_date, p.badge_id');
        $this->db->from('prog_badge_achievement p');
        $this->db->join('users u', 'u.id = p.user_id', 'LEFT');
        $this->db->join('users au', 'au.id = p.examiner_id', 'LEFT');
        $this->db->join('scout_badge sbg', 'sbg.id = p.badge_id', 'LEFT');
        $this->db->join('badge_type bt', 'bt.id = sbg.badge_type_id', 'LEFT');
        $this->db->where('p.scout_id',$form_data['scout_id']);
        $this->db->where('p.status',1);
        // $this->db->where('p.section_id',$form_data['section_id']);     
        
        $query = $this->db->get()->result();
        //echo $this->db->last_query();

        return $query;
    }

    public function get_badge_details_camping($form_data) {
        $this->db->select('p.id, p.section_id, p.status, au.id as ex_id, u.scout_id, au.scout_id as examiner_id, p.area,  p.camp_date, p.camp_name, p.certificate_no');
        $this->db->from('prog_camping p');
        $this->db->join('users u', 'u.id = p.user_id', 'LEFT');
        $this->db->join('users au', 'au.id = p.examiner_id', 'LEFT');
        
        $this->db->where('p.scout_id',$form_data['scout_id']);
        $this->db->where('p.status',1);
        // $this->db->where('p.section_id',$form_data['section_id']);     
        
        $query = $this->db->get()->result();
        //echo $this->db->last_query();

        return $query;
    }

    public function get_badge_details_training($form_data) {
        $this->db->select('p.id, p.section_id, p.status, au.id as ex_id, u.scout_id, au.scout_id as examiner_id, bt.badge_type_name_bn, p.training_date, p.badge_id, p.training_name, p.certificate_no');
        $this->db->from('prog_training p');
        $this->db->join('users u', 'u.id = p.user_id', 'LEFT');
        $this->db->join('users au', 'au.id = p.examiner_id', 'LEFT');
        $this->db->join('scout_badge sbg', 'sbg.id = p.badge_id', 'LEFT');
        $this->db->join('badge_type bt', 'bt.id = sbg.badge_type_id', 'LEFT');
        $this->db->where('p.scout_id', $form_data['scout_id']);
        $this->db->where('p.status', 1);
        // $this->db->where('p.section_id',$form_data['section_id']);     
        
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
        $this->db->where('h.status',1);
        // $this->db->where('h.section_id',$form_data['section_id']);     
        
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
        $this->db->where('h.status',1);
        // $this->db->where('h.section_id',$form_data['section_id']);     
        
        $query = $this->db->get()->result();
        //echo $this->db->last_query();

        return $query;
    }

    public function get_badge_details_promotion($form_data) {
        $this->db->select('p.id, p.section_id, p.status, au.id as ex_id, u.scout_id, au.scout_id as examiner_id, bt.badge_type_name_bn,  p.from_date, p.badge_id,  p.role_id, p.to_date, rt.role_type_name_bn');
        $this->db->from('prog_section_promotion p');
        $this->db->join('users u', 'u.id = p.user_id', 'LEFT');
        $this->db->join('users au', 'au.id = p.examiner_id', 'LEFT');
        $this->db->join('scout_badge sbg', 'sbg.id = p.badge_id', 'LEFT');
        $this->db->join('badge_type bt', 'bt.id = sbg.badge_type_id', 'LEFT');
        $this->db->join('scout_role sr', 'sr.id = p.role_id', 'LEFT');
        $this->db->join('role_type rt', 'rt.id = sr.role_type_id', 'LEFT');
        
        $this->db->where('p.scout_id', $form_data['scout_id']);
        $this->db->where('p.status', 1);
        // $this->db->where('p.section_id',$form_data['section_id']);     
        
        $query = $this->db->get()->result();
        //echo $this->db->last_query();

        return $query;
    }

    public function get_badge_details_resign($form_data) {
        $this->db->select('p.id, p.section_id, p.status, au.id as ex_id, u.scout_id, au.scout_id as examiner_id,  p.resign_date,  p.resign_reason');
        $this->db->from('prog_group_resign p');
        $this->db->join('users u', 'u.id = p.user_id', 'LEFT');
        $this->db->join('users au', 'au.id = p.examiner_id', 'LEFT');
        $this->db->where('p.scout_id',$form_data['scout_id']);
        $this->db->where('p.status',1);
        // $this->db->where('p.section_id',$form_data['section_id']);     
        
        $query = $this->db->get()->result();
        //echo $this->db->last_query();

        return $query;
    }


    

    /*********************** Section and Group Migration **********************
    ***************************************************************************/

    public function get_release_group_migration_request($group_id=NULL) {
        $this->db->select('mg.id');
        $this->db->from('migration_group mg');
        // $this->db->join('office_unit ou', 'ou.id = u.sc_unit_id', 'LEFT');
        if($group_id){
            $this->db->where('mg.curr_group_id', $group_id);
        }

        $this->db->where('mg.curr_group_verify', 'Pending');

        $query = $this->db->get()->result();

        return $query;
    }

    public function get_migrate_group_migration_request($group_id=NULL) {
        $this->db->select('mg.id');
        $this->db->from('migration_group mg');
        // $this->db->join('office_unit ou', 'ou.id = u.sc_unit_id', 'LEFT');
        if($group_id){
            $this->db->where('mg.mig_group_id', $group_id);
        }

        $this->db->where('mg.curr_group_verify', 'Approved');
        $this->db->where('mg.mig_group_verify', 'Pending');
        $this->db->where('mg.mig_group_verify_id', 0);

        $query = $this->db->get()->result();

        return $query;
    }

    public function get_release_section_migration_request($group_id=NULL) {
        $this->db->select('mg.id');
        $this->db->from('migration_section mg');
        // $this->db->join('office_unit ou', 'ou.id = u.sc_unit_id', 'LEFT');
        if($group_id){
            $this->db->where('mg.mig_group_verify_id', $group_id);
        }

        $this->db->where('mg.mig_group_verify', 'Pending');

        $query = $this->db->get()->result();

        return $query;
    }

    public function get_migrate_section_migration_request($group_id=NULL) {
        $this->db->select('mg.id');
        $this->db->from('migration_section mg');
        // $this->db->join('office_unit ou', 'ou.id = u.sc_unit_id', 'LEFT');
        if($group_id){
            $this->db->where('mg.curr_group_id', $group_id);
        }

        // $this->db->where('mg.curr_group_verify', 'Approved');
        $this->db->where('mg.mig_group_verify', 'Pending');
        // $this->db->where('mg.mig_group_verify_id', 0);

        $query = $this->db->get()->result();

        return $query;
    }



    /******************************* Destroy Data *******************************
    *****************************************************************************/

    public function destroy_user_information($id) {
        // Should be delete form table Award, Event, Training and related table
        $image = $this->db->select('profile_img')->where('id', $id)->limit(1)->get('users')->row()->profile_img;
        if($image != NULL){
            $path = $this->img_path."\\".$image; 
            if(file_exists($path)){                
                @unlink($path);
            }
        }

        $sql = "DELETE users, prog_badge_achievement, prog_badge_expertness, prog_badge_question_value, prog_camping, prog_group_resign, prog_institute_promotion, prog_physical_health, prog_section_promotion, prog_training, migration_group, migration_section, committee_national_member
        FROM users                 
        LEFT JOIN prog_badge_achievement ON users.id = prog_badge_achievement.scout_id
        LEFT JOIN prog_badge_expertness ON users.id = prog_badge_expertness.scout_id
        LEFT JOIN prog_badge_question_value ON users.id = prog_badge_question_value.scout_id
        LEFT JOIN prog_camping ON users.id = prog_camping.scout_id
        LEFT JOIN prog_group_resign ON users.id = prog_group_resign.scout_id
        LEFT JOIN prog_institute_promotion ON users.id = prog_institute_promotion.scout_id
        LEFT JOIN prog_physical_health ON users.id = prog_physical_health.scout_id
        LEFT JOIN prog_section_promotion ON users.id = prog_section_promotion.scout_id
        LEFT JOIN prog_training ON users.id = prog_training.scout_id 
        LEFT JOIN migration_group ON users.id = migration_group.mig_user_id
        LEFT JOIN migration_section ON users.id = migration_section.mig_user_id
        LEFT JOIN committee_national_member ON users.id = committee_national_member.member_scout_id 
        WHERE users.id = $id"; 

        $result = $this->db->query($sql);
        return $result?TRUE:FALSE;
    }
    

    
    /*************************** Other's methods ******************************
    ***************************************************************************/
    public function set_scout_id($id, $generteID) {
        $data = array('scout_id' => $generteID);
        $this->db->where('id', $id);
        $this->db->update('users', $data); 

        return true;

    }

    public function set_scout_qrcode($id, $filename) {
        $data = array('qr_img' => $filename);
        $this->db->where('id', $id);
        $this->db->update('users', $data); 

        return true;

    }
    
    public function get_last_scout_id() {
        //$row = $this->db->query('SELECT scout_id, MAX(id) AS `maxid` FROM `users` WHERE scout_id != NULL')->row();
        $row = $this->db->query('SELECT MAX(scout_id) AS `scoutID` FROM `users`')->row();
        // echo $this->db->last_query(); exit;
        if ($row) {
            $maxid = $row->scoutID; 
        }else{
            echo 'Something is wrong!'; exit;
        }

        return $maxid;
    }

    // public function get_scout_row_id($scoutID){
    //     $this->db->select('id, scout_id');
    //     $this->db->from('users');
    //     $this->db->where('scout_id', $scoutID);
    //     $this->db->limit(1);
    //     $query = $this->db->get()->row();

    //     return $query;
    // }


    // public function get_scout_member_reject($limit=1000, $offset=0, $region_id=NULL, $sc_district_id=NULL, $sc_upa_tha_id=NULL, $sc_scout_group_id=NULL, $sc_scout_unit_id=NULL) {
    //     // echo 'hello'; exit;
    //     $this->db->select('u.id, u.username, u.scout_id, u.first_name, u.phone, u.email, u.active, u.sc_section_id, u.profile_img, mt.member_type_name, og.grp_name');
    //     $this->db->from('users u'); 
    //     $this->db->join('member_type mt', 'mt.id = u.member_id', 'LEFT');
    //     $this->db->join('office_groups og', 'og.id = u.sc_group_id', 'LEFT');
    //     $this->db->where('u.is_request', '0');
    //     $this->db->where('u.status', '3');
    //     $this->db->limit($limit);
    //     $this->db->offset($offset);
    //     $this->db->order_by('u.id', 'DESC');
    //     //$this->db->where('scout_id IS NOT NULL', NULL);
    //     if($this->ion_auth->is_admin()){
    //         // $this->db->where('scout_id IS NOT NULL', NULL);
    //         $this->db->where('u.is_office', 0);
    //     }

    //     // Search
    //     if($this->input->get('scout_id') != NULL){
    //         $this->db->where('u.scout_id', $this->input->get('scout_id')); 
    //     }
    //     if($this->input->get('username') != NULL){
    //         $this->db->where('u.username', $this->input->get('username')); 
    //     }
    //     if($this->input->get('region') != NULL){
    //         $this->db->where('u.sc_region_id', $this->input->get('region')); 
    //     }
    //     if($this->input->get('district') > '0'){
    //         $this->db->where('u.sc_district_id', $this->input->get('district'));     
    //     }
    //     if($this->input->get('upazila') > '0'){
    //         $this->db->where('u.sc_upa_tha_id', $this->input->get('upazila'));     
    //     }

    //     if($region_id){
    //         $this->db->where('u.sc_region_id', $region_id);
    //         $query = $this->db->get()->result();
    //     }elseif($sc_district_id){
    //         $this->db->where('u.sc_district_id', $sc_district_id);
    //         $query = $this->db->get()->result();
    //     }elseif($sc_upa_tha_id){
    //         $this->db->where('u.sc_upa_tha_id', $sc_upa_tha_id);
    //         $query = $this->db->get()->result();
    //     }elseif($sc_scout_group_id){
    //         $this->db->where('u.sc_group_id', $sc_scout_group_id);
    //         $query = $this->db->get()->result();            
    //     }elseif($sc_scout_unit_id){
    //         $this->db->where('u.sc_unit_id', $sc_scout_unit_id);
    //         $query = $this->db->get()->result();            
    //     }else{
    //         $query = $this->db->get()->result();
    //     }       
    //     $result['rows'] = $query;

    //     // count query
    //     $q = $this->db->select('COUNT(*) as count');
    //     $this->db->from('users');        
    //     $this->db->where('active', '4');
    //     if($this->ion_auth->is_admin()){
    //         // $this->db->where('scout_id IS NOT NULL', NULL);
    //         $this->db->where('is_office', 0);
    //     }

    //     // Search
    //     if($this->input->get('scout_id') != NULL){
    //         $this->db->where('scout_id', $this->input->get('scout_id')); 
    //     }
    //     if($this->input->get('username') != NULL){
    //         $this->db->where('username', $this->input->get('username')); 
    //     }
    //     if($this->input->get('region') != NULL){
    //         $this->db->where('sc_region_id', $this->input->get('region')); 
    //     }
    //     if($this->input->get('district') > '0'){
    //         $this->db->where('sc_district_id', $this->input->get('district'));     
    //     }
    //     if($this->input->get('upazila') > '0'){
    //         $this->db->where('sc_upa_tha_id', $this->input->get('upazila'));     
    //     }
        
    //     if($region_id){
    //         $this->db->where('sc_region_id', $region_id);
    //         $query = $this->db->get()->result();
    //     }elseif($sc_district_id){
    //         $this->db->where('sc_district_id', $sc_district_id);
    //         $query = $this->db->get()->result();
    //     }elseif($sc_upa_tha_id){
    //         $this->db->where('sc_upa_tha_id', $sc_upa_tha_id);
    //         $query = $this->db->get()->result();
    //     }elseif($sc_scout_group_id){
    //         $this->db->where('sc_group_id', $sc_scout_group_id);
    //         $query = $this->db->get()->result();            
    //     }elseif($sc_scout_unit_id){
    //         $this->db->where('sc_unit_id', $sc_scout_unit_id);
    //         $query = $this->db->get()->result();            
    //     }else{
    //         $query = $this->db->get()->result();
    //     }

    //     $tmp = $query;
    //     $result['num_rows'] = $tmp[0]->count;
    //     // echo $this->db->last_query(); exit;

    //     return $result;
    // }
    
    
    // 10677 prog_camping, prog_badge_question_value, prog_badge_expertness, prog_badge_achievement, prog_group_resign, prog_section_promotion, prog_training, committee_national_member, migration_group

    // public function scout_member_destroy($id) {
    //     $query = $this->db->delete('users', array('id' => $id));
    //     return $query;
    // }    

    // function delete($id) {
    //     $img_path = base_url().'profile_img/';
    //     $img_path_thumbs = base_url().'profile_img/thumbs/';
    //     $info = $this->get_info($id);

    //     if(file_exists($img_path.$info->profile_img)){
    //        @unlink($img_path.$info->profile_img);
    //        @unlink($img_path_thumbs.$info->profile_img);
    //     }

    //     $this->db->where('id', $id);
    //     $this->db->delete('courses');

    //     return TRUE;
    // }    

    
    // public function update_active_last_scout_id($scout_id, $data) {
    //     $this->db->where('scout_id', $scout_id);
    //     if ($this->db->update('users', $data)) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    

}
