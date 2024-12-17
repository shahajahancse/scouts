<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Award_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

     public function get_info($id) {
        $this->db->select('aw.*, aw.id as award_app_id, u.*, aw.id as migration_id, sa.award_name, 
                            cr.region_name as current_region_name, cod.dis_name as current_dis_name, cou.upa_name as current_upa_name, cog.grp_name as current_grp_name, cunit.unit_name as current_unit_name, bt.badge_type_name_bn, rt.role_type_name_bn, bg.bg_name_en, dv.div_name as pre_div_name, ds.district_name as pre_district_name, ut.up_th_name as pre_up_th_name, urgn.scout_id as region_scout_id, udis.scout_id as district_scout_id, uupa.scout_id as upazila_scout_id, ugrp.scout_id as group_scout_id');
        $this->db->from('award_application aw');
        $this->db->join('scout_award sa', 'sa.id = aw.app_award_id', 'LEFT');
        $this->db->join('users u', 'u.id = aw.app_scout_id', 'LEFT');
        $this->db->join('office_unit cunit', 'cunit.id = aw.curr_unit_id', 'LEFT');        
        $this->db->join('office_groups cog', 'cog.id = aw.curr_group_id', 'LEFT');
        $this->db->join('office_upazila cou', 'cou.id = aw.curr_upazila_id', 'LEFT');
        $this->db->join('office_district cod', 'cod.id = aw.curr_district_id', 'LEFT');
        $this->db->join('office_region cr', 'cr.id = aw.curr_region_id', 'LEFT');
        $this->db->join('blood_group bg', 'bg.id=u.blood_group', 'LEFT');
        $this->db->join('upazila_thana ut', 'ut.id=u.pre_upa_tha_id', 'LEFT');
        $this->db->join('district ds', 'ds.id=u.pre_district_id', 'LEFT');
        $this->db->join('division dv', 'dv.id=u.pre_division_id', 'LEFT');
        $this->db->join('scout_badge sb', 'sb.id = u.sc_badge_id', 'LEFT');
        $this->db->join('badge_type bt','bt.id = sb.badge_type_id', 'LEFT');
        $this->db->join('scout_role so', 'so.id = u.sc_role_id', 'LEFT');
        $this->db->join('role_type rt', 'rt.id = so.role_type_id', 'LEFT');
        $this->db->join('users urgn', 'aw.app_rgn_id = urgn.id', 'LEFT');
        $this->db->join('users udis', 'aw.app_dis_id = udis.id', 'LEFT');
        $this->db->join('users uupa', 'aw.app_upa_id = uupa.id', 'LEFT');
        $this->db->join('users ugrp', 'aw.app_grp_id = ugrp.id', 'LEFT');
        $this->db->where('aw.id', $id);
        $query = $this->db->get()->row();

        return $query;
    }

    public function get_exits($scout_id, $award_id, $id=NULL) {
        $this->db->select('*');
        $this->db->from('award_application');
        $this->db->where('app_scout_id', $scout_id);
        $this->db->where('app_award_id', $award_id);
        if($id!=NULL){
          $this->db->where('id', $id);  
        }
        $query = $this->db->get()->num_rows();

        return $query;
    }

    public function all_award_request_list() {
        $this->db->select('ap.*, u.scout_id, u.first_name, u.last_name, u.phone,u.profile_img, sa.award_name');
        $this->db->from('award_application ap');
        $this->db->join('users u', 'u.id = ap.app_scout_id', 'LEFT');
        $this->db->join('scout_award sa', 'sa.id = ap.app_award_id', 'LEFT');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get()->result();

        return $query;
    }

    public function my_award_request_list() {
        $this->db->select('ap.*, u.scout_id, u.first_name, u.last_name, u.phone,u.profile_img, sa.award_name');
        $this->db->from('award_application ap');
        $this->db->join('users u', 'u.id = ap.app_scout_id', 'LEFT');
        $this->db->join('scout_award sa', 'sa.id = ap.app_award_id', 'LEFT');
        $this->db->where('app_scout_id', $this->session->userdata('user_id'));
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_release_group_request_list($curr_group_id)
    {
        $this->db->select('ap.*, u.scout_id, u.first_name, u.last_name, u.phone,u.profile_img, sa.award_name');
        $this->db->from('award_application ap');
        $this->db->join('users u', 'u.id = ap.app_scout_id', 'LEFT');
        $this->db->join('scout_award sa', 'sa.id = ap.app_award_id', 'LEFT');
        $this->db->where('curr_group_id', $curr_group_id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_release_upazila_request_list($curr_upazila_id)
    {
        $this->db->select('ap.*, u.scout_id, u.first_name, u.last_name, u.phone,u.profile_img, sa.award_name');
        $this->db->from('award_application ap');
        $this->db->join('users u', 'u.id = ap.app_scout_id', 'LEFT');
        $this->db->join('scout_award sa', 'sa.id = ap.app_award_id', 'LEFT');
        $this->db->where('ap.curr_upazila_id', $curr_upazila_id);
        $this->db->where('ap.app_grp_approve', 'Approved');
        $this->db->order_by('ap.id', 'DESC');
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_release_district_request_list($curr_district_id)
    {
        $this->db->select('ap.*, u.scout_id, u.first_name, u.last_name, u.phone,u.profile_img, sa.award_name');
        $this->db->from('award_application ap');
        $this->db->join('users u', 'u.id = ap.app_scout_id', 'LEFT');
        $this->db->join('scout_award sa', 'sa.id = ap.app_award_id', 'LEFT');
        $this->db->where('curr_district_id', $curr_district_id);
        $this->db->where('app_grp_approve', 'Approved');
        $this->db->where('app_upa_approve', 'Approved');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_release_region_request_list($curr_region_id)
    {
        $this->db->select('ap.*, u.scout_id, u.first_name, u.last_name, u.phone,u.profile_img, sa.award_name');
        $this->db->from('award_application ap');
        $this->db->join('users u', 'u.id = ap.app_scout_id', 'LEFT');
        $this->db->join('scout_award sa', 'sa.id = ap.app_award_id', 'LEFT');
        $this->db->where('curr_region_id', $curr_region_id);
        $this->db->where('app_grp_approve', 'Approved');
        $this->db->where('app_upa_approve', 'Approved');
        $this->db->where('app_dis_approve', 'Approved');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get()->result();

        return $query;
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('award_application');

        return TRUE;
    }

}
