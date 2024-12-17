<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_scout_group($region_id=NULL) {
        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('office_groups');
        if($region_id){
            $this->db->where('grp_region_id', $region_id);
        }
        $query = $this->db->get()->row();
        return $query->count;
    }

    public function count_censes_by_member_id_section_id_gender($region_id=NULL, $sc_district_id=NULL, $sc_upa_tha_id=NULL, $sc_group_id=NULL) {

        $this->db->select("
                gender,
                COUNT(CASE WHEN member_id = 1 AND sc_section_id = 1 AND gender = 'Male' THEN 1 END) AS na_cub_scout_m,
                COUNT(CASE WHEN member_id = 1 AND sc_section_id = 2 AND gender = 'Male' THEN 1 END) AS na_scout_m,
                COUNT(CASE WHEN member_id = 1 AND sc_section_id = 3 AND gender = 'Male' THEN 1 END) AS na_rober_scout_m,

                COUNT(CASE WHEN member_id = 1 AND sc_section_id = 1 AND gender = 'Female' THEN 1 END) AS na_cub_scout_f,
                COUNT(CASE WHEN member_id = 1 AND sc_section_id = 2 AND gender = 'Female' THEN 1 END) AS na_scout_f,
                COUNT(CASE WHEN member_id = 1 AND sc_section_id = 3 AND gender = 'Female' THEN 1 END) AS na_rober_scout_f,

                COUNT(CASE WHEN member_id = 2 AND sc_section_id = 1 AND gender = 'Male' THEN 1 END) AS cub_scout_m,
                COUNT(CASE WHEN member_id = 2 AND sc_section_id = 2 AND gender = 'Male' THEN 1 END) AS scout_m,
                COUNT(CASE WHEN member_id = 2 AND sc_section_id = 3 AND gender = 'Male' THEN 1 END) AS rober_scout_m,

                COUNT(CASE WHEN member_id = 2 AND sc_section_id = 1 AND gender = 'Female' THEN 1 END) AS cub_scout_f,
                COUNT(CASE WHEN member_id = 2 AND sc_section_id = 2 AND gender = 'Female' THEN 1 END) AS scout_f,
                COUNT(CASE WHEN member_id = 2 AND sc_section_id = 3 AND gender = 'Female' THEN 1 END) AS rober_scout_f,

                COUNT(CASE WHEN member_id = 8 AND gender = 'Male' THEN 1 END) AS scouter_s_m,
                COUNT(CASE WHEN member_id = 10 AND gender = 'Male' THEN 1 END) AS non_warrant_m,
                COUNT(CASE WHEN member_id = 12 AND gender = 'Male' THEN 1 END) AS warrant_m,
                COUNT(CASE WHEN member_id = 9 AND gender = 'Male' THEN 1 END) AS professional_scouts_m,
                COUNT(CASE WHEN member_id = 13 AND gender = 'Male' THEN 1 END) AS support_staff_m,

                COUNT(CASE WHEN member_id = 8 AND gender = 'Female' THEN 1 END) AS scouter_s_f,
                COUNT(CASE WHEN member_id = 10 AND gender = 'Female' THEN 1 END) AS non_warrant_f,
                COUNT(CASE WHEN member_id = 12 AND gender = 'Female' THEN 1 END) AS warrant_f,
                COUNT(CASE WHEN member_id = 9 AND gender = 'Female' THEN 1 END) AS professional_scouts_f,
                COUNT(CASE WHEN member_id = 13 AND gender = 'Female' THEN 1 END) AS support_staff_f,
            ");

        if($region_id != NULL){
            $this->db->where('sc_region_id', $region_id);
        }
        if($sc_district_id != NULL){
            $this->db->where('sc_district_id', $sc_district_id);
        }
        if($sc_upa_tha_id != NULL){
            $this->db->where('sc_upa_tha_id', $sc_upa_tha_id);
        }
        if($sc_group_id != NULL){
            $this->db->where('sc_group_id', $sc_group_id);
        }
        $q = $this->db->get('users')->row();
        //echo $this->db->last_query(); //exit;
        return $q;
    }

    public function total_member_count_by_status($region_id=NULL, $sc_district_id=NULL, $sc_upa_tha_id=NULL, $sc_group_id=NULL)
    {
        $this->db->select("
                COUNT(CASE WHEN member_id != '0' THEN 1 END) AS count,
                COUNT(CASE WHEN member_id != '0' AND is_request = '1' AND scout_id IS NULL THEN 1 END) AS request,
                COUNT(CASE WHEN member_id != '0' AND is_verify = '1' AND status = '1' AND scout_id IS NOT NULL THEN 1 END) AS verify,
                COUNT(CASE WHEN member_id != '0' AND is_verify = '1' AND status = '2' AND scout_id IS NOT NULL THEN 1 END) AS archive,
            ");
        $this->db->where('member_id !=', 0);

        if($region_id != NULL){
            $this->db->where('sc_region_id', $region_id);
        }
        if($sc_district_id != NULL){
            $this->db->where('sc_district_id', $sc_district_id);
        }
        if($sc_upa_tha_id != NULL){
            $this->db->where('sc_upa_tha_id', $sc_upa_tha_id);
        }
        if($sc_group_id != NULL){
            $this->db->where('sc_group_id', $sc_group_id);
        }
        return $this->db->get('users')->row();

    }

    public function get_members_count() {
        // count query
        $this->db->select('COUNT(*) as count');
        $this->db->from('users');
        $q = $this->db->get()->result();

        $tmp = $q;
        $ret['num_rows'] = $tmp[0]->count;

        return $ret;
    }

    public function get_count_online_register($region_id=NULL, $sc_district_id=NULL, $sc_upa_tha_id=NULL, $sc_group_id=NULL) {
        $this->db->select('COUNT(*) as count');
        $this->db->where('member_id !=', 0);
        if($region_id != NULL){
            $this->db->where('sc_region_id', $region_id);
        }
        if($sc_district_id != NULL){
            $this->db->where('sc_district_id', $sc_district_id);
        }
        if($sc_upa_tha_id != NULL){
            $this->db->where('sc_upa_tha_id', $sc_upa_tha_id);
        }
        if($sc_group_id != NULL){
            $this->db->where('sc_group_id', $sc_group_id);
        }
        $tmp = $this->db->get('users')->result();
        // echo $this->db->last_query(); exit;
        $ret['count'] = $tmp[0]->count;
        return $ret;
    }
    // public function get_count_online_register_today() {
    //     $tmp = $this->db->select('COUNT(*) as count')->where('member_id !=', 0)->where('created_on', strtotime(date('Y-m-d')))->get('users')->result();
    //     // echo $this->db->last_query(); exit;
    //     $ret['count'] = $tmp[0]->count;
    //     return $ret;
    // }
    // public function get_count_online_register_this_month() {
    //     $tmp = $this->db->select('COUNT(*) as count')->where('member_id !=', 0)->where('STR_TO_DATE(created_on, "%m")', date('m'))->get('users')->result();
    //     echo $this->db->last_query(); exit;
    //     $ret['count'] = $tmp[0]->count;
    //     return $ret;
    // }

    public function get_count_member_by_office($region_id=NULL, $sc_district_id=NULL, $sc_upa_tha_id=NULL) {
        // count query
        //, u.sc_district_id, od.dis_name, ou.upa_name, og.grp_name
        $this->db->select('COUNT(u.id) as count_id');
        $this->db->from('users u');
        $this->db->where('u.scout_id IS NOT NULL', NULL);
        $this->db->join('office_district od', 'od.id = u.sc_district_id', 'LEFT');
        $this->db->join('office_upazila ou', 'ou.id = u.sc_upa_tha_id', 'LEFT');
        $this->db->join('office_groups og', 'og.id = u.sc_group_id', 'LEFT');
        if($region_id != NULL){
            $this->db->where('u.sc_region_id', $region_id);
            $this->db->group_by('u.sc_district_id');
            // $this->db->having('u.sc_district_id > 0');
        }
        if($sc_district_id != NULL){
            $this->db->where('u.sc_district_id', $sc_district_id);
            $this->db->group_by('u.sc_upa_tha_id');
            // $this->db->having('u.sc_upa_tha_id > 0');
        }
        if($sc_upa_tha_id != NULL){
            $this->db->where('u.sc_upa_tha_id', $sc_upa_tha_id);
            $this->db->group_by('u.sc_group_id');
        }
        // echo $this->db->last_query(); exit;
        // $this->db->where("HAVING COUNT(u.id) > 0");
        // $this->db->having('COUNT(count_id) > 0');
        $q = $this->db->get()->result();
        // $tmp = $q;
        // $ret['count'] = $tmp[0]->count;

        return $q;
    }

    public function get_scouts_gorup($sc_upazila_id=NULL){
        $this->db->select('id, grp_name');
        $this->db->from('office_groups');
        if($sc_upazila_id != NULL){
            $this->db->where('grp_scout_upa_id', $sc_upazila_id);
        }
        $q = $this->db->get()->result();

        return $q;
    }

    public function get_scouts_upazila_name($sc_district_id=NULL){
        $this->db->select('id, upa_name');
        $this->db->from('office_upazila');
        if($sc_district_id != NULL){
            $this->db->where('upa_scout_dis_id', $sc_district_id);
        }
        $q = $this->db->get()->result();
        // echo $this->db->last_query(); exit;
        return $q;
    }

    public function get_scouts_district_name($sc_region_id=NULL){
        $this->db->select('id, dis_name_en');
        $this->db->from('office_district');
        if($sc_region_id != NULL){
            $this->db->where('dis_scout_region_id', $sc_region_id);
        }
        $q = $this->db->get()->result();
        // echo $this->db->last_query(); exit;
        return $q;
    }

    public function get_count_scouts_member_by_office_id($region=NULL, $district=NULL, $upazila=NULL, $group=NULL){
        $this->db->select('COUNT(*) as count');
        $this->db->where('scout_id IS NOT NULL', NULL);
        $this->db->where('member_id !=', 0);
        $this->db->where('is_verify', 1);
        $this->db->where('status', 1);

        // $this->db->where('gender != ', NULL);

        if(!empty($region)){
            $this->db->where('sc_region_id', $region);
        }
        if(!empty($district)){
            $this->db->where('sc_district_id', $district);
        }
        if(!empty($upazila)){
            $this->db->where('sc_upa_tha_id', $upazila);
        }
        if(!empty($group)){
            $this->db->where('sc_group_id', $group);
        }

        $tmp = $this->db->get('users')->result();
        // echo $this->db->last_query(); exit;
        $ret['count'] = $tmp[0]->count;
        return $ret;
    }

    public function get_count_scouts_group_office_id($region=NULL, $district=NULL, $upazila=NULL){
        $this->db->select('COUNT(*) as count');
        $this->db->where('grp_status', 1);
        if(!empty($region)){
            $this->db->where('grp_region_id', $region);
        }
        if(!empty($district)){
            $this->db->where('grp_scout_dis_id', $district);
        }
        if(!empty($upazila)){
            $this->db->where('grp_scout_upa_id', $upazila);
        }
        $tmp = $this->db->get('office_groups')->result();
        // echo $this->db->last_query(); exit;
        $ret['count'] = $tmp[0]->count;
        return $ret;
    }

    public function get_count_member_by_office_test($region_id=NULL, $sc_district_id=NULL, $sc_upa_tha_id=NULL) {
        // count query
        //, u.sc_district_id, od.dis_name, ou.upa_name, og.grp_name
        $this->db->select('COUNT(u.id) as count_id, u.sc_district_id, od.dis_name, ou.upa_name, og.grp_name');
        $this->db->from('users u');
        $this->db->where('u.scout_id IS NOT NULL', NULL);
        $this->db->join('office_district od', 'od.id = u.sc_district_id', 'LEFT');
        $this->db->join('office_upazila ou', 'ou.id = u.sc_upa_tha_id', 'LEFT');
        $this->db->join('office_groups og', 'og.id = u.sc_group_id', 'LEFT');
        if($region_id != NULL){
            $this->db->where('u.sc_region_id', $region_id);
            $this->db->group_by('u.sc_district_id');
            // $this->db->having('u.sc_district_id > 0');
        }
        if($sc_district_id != NULL){
            $this->db->where('u.sc_district_id', $sc_district_id);
            $this->db->group_by('u.sc_upa_tha_id');
            // $this->db->having('u.sc_upa_tha_id > 0');
        }
        if($sc_upa_tha_id != NULL){
            $this->db->where('u.sc_upa_tha_id', $sc_upa_tha_id);
            $this->db->group_by('u.sc_group_id');
            //$this->db->group_by('og.grp_name');
            // $this->db->where("HAVING COUNT(u.sc_group_id) > 0");
        }
        // echo $this->db->last_query(); exit;
        // $this->db->having('COUNT(count_id) > 0');
        $q = $this->db->get()->result();
        // $tmp = $q;
        // $ret['count'] = $tmp[0]->count;

        return $q;
    }


    /*
    public function get_count_online_members($region_id=NULL, $sc_district_id=NULL, $sc_upa_tha_id=NULL, $sc_group_id=NULL) {
        // count query
        $this->db->select('COUNT(*) as count');
        // $this->db->where('scout_id IS NOT NULL', NULL);
        // $this->db->where('member_id !=', 0);
        // $this->db->where('gender !=', NULL);
        $this->db->where('scout_id', NULL);
        $this->db->where('is_office', 0);
        $this->db->where('is_verify', '1');
        $this->db->where('status', 1);

        if($region_id != NULL){
            $this->db->where('sc_region_id', $region_id);
        }
        if($sc_district_id != NULL){
            $this->db->where('sc_district_id', $sc_district_id);
        }
        if($sc_upa_tha_id != NULL){
            $this->db->where('sc_upa_tha_id', $sc_upa_tha_id);
        }
        if($sc_group_id != NULL){
            $this->db->where('sc_group_id', $sc_group_id);
        }
        $q = $this->db->get('users')->result();
        // echo $this->db->last_query(); exit;
        $tmp = $q;
        $ret['count'] = $tmp[0]->count;

        return $ret;
    }
    */

    public function get_count_online_members($region_id=NULL, $sc_district_id=NULL, $sc_upa_tha_id=NULL, $sc_group_id=NULL) {
        // count query
        $this->db->select('COUNT(*) as count');
        $this->db->where('scout_id IS NOT NULL', NULL);
        $this->db->where('member_id !=', 0);
        $this->db->where('is_verify', 1);
        $this->db->where('status', 1);
        // $this->db->where('gender !=', NULL);
        // $this->db->where('is_office', 0);
        // $this->db->where('scout_id', NULL);

        if($region_id != NULL){
            $this->db->where('sc_region_id', $region_id);
        }
        if($sc_district_id != NULL){
            $this->db->where('sc_district_id', $sc_district_id);
        }
        if($sc_upa_tha_id != NULL){
            $this->db->where('sc_upa_tha_id', $sc_upa_tha_id);
        }
        if($sc_group_id != NULL){
            $this->db->where('sc_group_id', $sc_group_id);
        }
        $q = $this->db->get('users')->result();
        // echo $this->db->last_query(); exit;
        $tmp = $q;
        $ret['count'] = $tmp[0]->count;

        return $ret;
    }

    public function get_count_request_members($region_id=NULL, $sc_district_id=NULL, $sc_upa_tha_id=NULL, $sc_group_id=NULL) {
        // count query
        $this->db->select('COUNT(*) as count');
        // $this->db->where('gender !=', NULL);
        // $this->db->where('is_office', 0);
        // $this->db->where('scout_id', NULL);
        // $this->db->where('scout_id IS NOT NULL', NULL);
        $this->db->where('scout_id', NULL);
        $this->db->where('member_id !=', 0);
        $this->db->where('is_request', 1);
        // $this->db->where('is_verify', 0);
        // $this->db->where('status', 1);

        if($region_id != NULL){
            $this->db->where('sc_region_id', $region_id);
        }
        if($sc_district_id != NULL){
            $this->db->where('sc_district_id', $sc_district_id);
        }
        if($sc_upa_tha_id != NULL){
            $this->db->where('sc_upa_tha_id', $sc_upa_tha_id);
        }
        if($sc_group_id != NULL){
            $this->db->where('sc_group_id', $sc_group_id);
        }
        $q = $this->db->get('users')->result();
        // echo $this->db->last_query(); exit;
        $tmp = $q;
        $ret['count'] = $tmp[0]->count;

        return $ret;
    }

    public function get_count_archive_members($region_id=NULL, $sc_district_id=NULL, $sc_upa_tha_id=NULL, $sc_group_id=NULL) {
        // count query
        $this->db->select('COUNT(*) as count');
        $this->db->where('scout_id IS NOT NULL', NULL);
        $this->db->where('member_id !=', 0);
        $this->db->where('is_verify', 1);
        $this->db->where('status', 2);
        // $this->db->where('gender !=', NULL);
        // $this->db->where('is_office', 0);
        // $this->db->where('scout_id', NULL);

        if($region_id != NULL){
            $this->db->where('sc_region_id', $region_id);
        }
        if($sc_district_id != NULL){
            $this->db->where('sc_district_id', $sc_district_id);
        }
        if($sc_upa_tha_id != NULL){
            $this->db->where('sc_upa_tha_id', $sc_upa_tha_id);
        }
        if($sc_group_id != NULL){
            $this->db->where('sc_group_id', $sc_group_id);
        }
        $q = $this->db->get('users')->result();
        // echo $this->db->last_query(); exit;
        $tmp = $q;
        $ret['count'] = $tmp[0]->count;

        return $ret;
    }



    public function get_count_online_members_by_gender($gender) {
        // count query
        $this->db->select('COUNT(*) as count');
        $this->db->from('users');
        $this->db->where('scout_id IS NOT NULL', NULL);
        $this->db->where('member_id !=', 0);
        $this->db->where('is_verify', 1);
        $this->db->where('status', 1);
        $this->db->where('gender', $gender);
        $q = $this->db->get()->result();
        // echo $this->db->last_query(); exit;
        $tmp = $q;
        $ret['count'] = $tmp[0]->count;

        return $ret;
    }




    public function get_count_by_member_type($memberType) {
        $result = array();
        // count query
        $this->db->select('COUNT(*) as count');
        $this->db->from('users');
        $this->db->where('member_id', $memberType);
        $this->db->where('scout_id IS NOT NULL', NULL);
        $q = $this->db->get()->result();

        $result = $q;
        $result['count'] = $result[0]->count;

        return $result;
    }


    public function get_count_event_total() {
        // count query
        $tmp = $this->db->select('COUNT(*) as count')->get('events')->result();
        // echo $this->db->last_query(); exit;
        $ret['count'] = $tmp[0]->count;
        return $ret;
    }
    public function get_count_event_total_by_level($level) {
        // count query
        $tmp = $this->db->select('COUNT(*) as count')->where('event_level', $level)->get('events')->result();
        // echo $this->db->last_query(); exit;
        $ret['count'] = $tmp[0]->count;
        return $ret;
    }

    public function get_count_online_member_by_region($region_id) {
        // count query
        $tmp = $this->db->select('COUNT(*) as count')->where('scout_id IS NOT NULL', NULL)->where('sc_region_id', $region_id)->get('users')->result();
        // echo $this->db->last_query(); exit;
        $ret['count'] = $tmp[0]->count;
        return $ret;
    }

    public function get_censes_by_member_id_section_id_gender($member_id, $sc_section_id, $gender, $region_id=NULL, $sc_district_id=NULL, $sc_upa_tha_id=NULL, $sc_group_id=NULL) {
        $result = array();
        $this->db->select('COUNT(*) as count, gender');
        $this->db->where('scout_id IS NOT NULL', NULL);
        $this->db->where('member_id', $member_id);
        $this->db->where('sc_section_id', $sc_section_id);
        $this->db->where('gender', $gender);
        if($region_id != NULL){
            $this->db->where('sc_region_id', $region_id);
        }
        if($sc_district_id != NULL){
            $this->db->where('sc_district_id', $sc_district_id);
        }
        if($sc_upa_tha_id != NULL){
            $this->db->where('sc_upa_tha_id', $sc_upa_tha_id);
        }
        if($sc_group_id != NULL){
            $this->db->where('sc_group_id', $sc_group_id);
        }
        $q = $this->db->get('users')->result();
        //echo $this->db->last_query(); //exit;
        $result = $q;
        $result['count'] = $result[0]->count;
        return $result;
    }

    public function get_censes_by_member_id_gender($member_id, $gender, $region_id=NULL, $sc_district_id=NULL, $sc_upa_tha_id=NULL, $sc_group_id=NULL) {
        $result = array();
        $this->db->select('COUNT(*) as count,gender');
        $this->db->where('scout_id IS NOT NULL', NULL);
        $this->db->where('member_id', $member_id);
        $this->db->where('gender', $gender);
        if($region_id != NULL){
            $this->db->where('sc_region_id', $region_id);
        }
        if($sc_district_id != NULL){
            $this->db->where('sc_district_id', $sc_district_id);
        }
        if($sc_upa_tha_id != NULL){
            $this->db->where('sc_upa_tha_id', $sc_upa_tha_id);
        }
        if($sc_group_id != NULL){
            $this->db->where('sc_group_id', $sc_group_id);
        }
        $q = $this->db->get('users')->result();
        $result = $q;
        $result['count'] = $result[0]->count;
        return $result;
    }

    public function get_members_count_by_sc_section_id($sc_section_id, $gender) {
        // count query
        $this->db->select('COUNT(*) as count,gender');
        $this->db->from('users');
       // $this->db->group_by('gender');

        $this->db->where('sc_section_id', $sc_section_id);
        $this->db->where('scout_id IS NOT NULL', NULL);
        $this->db->where('gender', $gender);
        //$this->db->where('YEAR(join_date)',$year);
        $q = $this->db->get()->result();

        $result = array();
        $result = $q;
       //echo '<pre>';
         // print_r($result);
         // exit;
     //  $result['gender'] = $result['gender'];
        $result['count'] = $result[0]->count;

        return $result;
    }
     public function get_members_count_by_member_type($member_type,$gender) {
        // count query
        $this->db->select('COUNT(*) as count,gender');
        $this->db->from('users');
       // $this->db->group_by('gender');
        $this->db->where('member_id',$member_type);
        $this->db->where('gender',$gender);
        //$this->db->where('YEAR(join_date)',$year);
        $q = $this->db->get()->result();

        $result = array();
        $result = $q;
       //echo '<pre>';
         // print_r($result);
         // exit;
     //  $result['gender'] = $result['gender'];
        $result['count'] = $result[0]->count;

        return $result;
    }

    public function get_scout_info($user_id){
        $this->db->select('u.id, scout_id, r.region_type, r.region_name, od.dis_name, ou.upa_name, og.grp_name, unit.unit_name');
        $this->db->from('users u');
        $this->db->join('office_unit unit', 'unit.id = u.sc_unit_id', 'LEFT');
        $this->db->join('office_groups og', 'og.id = u.sc_group_id', 'LEFT');
        $this->db->join('office_upazila ou', 'ou.id = u.sc_upa_tha_id', 'LEFT');
        $this->db->join('office_district od', 'od.id = u.sc_district_id', 'LEFT');
        $this->db->join('office_region r', 'r.id = u.sc_region_id', 'LEFT');
        $this->db->where('u.id', $user_id);
        $query = $this->db->get()->row();

        return $query;
    }
    public function get_members_count_by_sc_region_id($sc_region_id) {
        // count query
        $this->db->select('COUNT(CASE WHEN u.gender="Male" THEN u.id END ) as count_male, COUNT(CASE WHEN u.gender="Female" THEN u.id END) as count_female, COUNT(CASE WHEN u.gender="Others" THEN u.id END) as count_other,COUNT(u.id) as count_total,u.sc_section_id');
        $this->db->from('users u');
       // $this->db->group_by('gender');
        $this->db->where('u.scout_id IS NOT NULL');
        $this->db->where('u.sc_region_id', $sc_region_id);
        //$this->db->where('gender',$gender);
        $this->db->group_by('u.sc_section_id');
        $q = $this->db->get()->result();

        //echo $this->db->last_query(); exit;
        $result = array();
        $result = $q;
        /*echo '<pre>';
        print_r($result);
        exit;*/
     //  $result['gender'] = $result['gender'];
        //$result['count'] = $result[0]->count;

        return $result;
    }

    public function get_members_count_by_sc_district_id($sc_district_id) {
        // count query
        $this->db->select('COUNT(CASE WHEN u.gender="Male" THEN u.id END ) as count_male, COUNT(CASE WHEN u.gender="Female" THEN u.id END) as count_female, COUNT(CASE WHEN u.gender="Others" THEN u.id END) as count_other,COUNT(u.id) as count_total, u.sc_section_id');
        $this->db->from('users u');
       // $this->db->group_by('gender');
        $this->db->where('u.scout_id IS NOT NULL');
        $this->db->where('u.sc_district_id',$sc_district_id);
        //$this->db->where('gender',$gender);
        $this->db->group_by('u.sc_section_id');
        $q = $this->db->get()->result();

        $result = array();
        $result = $q;
        /*echo '<pre>';
        print_r($result);
        exit;*/
     //  $result['gender'] = $result['gender'];
        //$result['count'] = $result[0]->count;

        return $result;
    }
    public function get_members_count_by_sc_upa_tha_id($sc_upa_tha_id) {
        // count query
        $this->db->select('COUNT(CASE WHEN u.gender="Male" THEN u.id END ) as count_male, COUNT(CASE WHEN u.gender="Female" THEN u.id END) as count_female, COUNT(CASE WHEN u.gender="Others" THEN u.id END) as count_other,COUNT(u.id) as count_total,u.sc_section_id');
        $this->db->from('users u');
       // $this->db->group_by('gender');
        $this->db->where('u.scout_id IS NOT NULL');
        $this->db->where('u.sc_upa_tha_id',$sc_upa_tha_id);
        //$this->db->where('gender',$gender);
        $this->db->group_by('u.sc_section_id');
        $q = $this->db->get()->result();

        $result = array();
        $result = $q;
        /*echo '<pre>';
        print_r($result);
        exit;*/
     //  $result['gender'] = $result['gender'];
        //$result['count'] = $result[0]->count;

        return $result;
    }
    public function get_members_count_by_sc_group_id($sc_group_id) {
        // count query
        $this->db->select('COUNT(CASE WHEN u.gender="Male" THEN u.id END ) as count_male, COUNT(CASE WHEN u.gender="Female" THEN u.id END) as count_female, COUNT(CASE WHEN u.gender="Others" THEN u.id END) as count_other,COUNT(u.id) as count_total,u.sc_section_id');
        $this->db->from('users u');
       // $this->db->group_by('gender');
        $this->db->where('u.scout_id IS NOT NULL');
        $this->db->where('u.sc_group_id',$sc_group_id);
        //$this->db->where('gender',$gender);
        $this->db->group_by('u.sc_section_id');
        $q = $this->db->get()->result();

        $result = array();
        $result = $q;
        /*echo '<pre>';
        print_r($result);
        exit;*/
     //  $result['gender'] = $result['gender'];
        //$result['count'] = $result[0]->count;

        return $result;
    }

    public function get_region_office_by_user($userID){
        $this->db->select('office_id');
        $this->db->from('users_region');
        $this->db->where('user_id', $userID);
        $query = $this->db->get()->row();

        return $query;
    }

}
