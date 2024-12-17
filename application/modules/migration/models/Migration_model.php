<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    public function get_data() {
        $this->db->select('m.*, u.scout_id, u.first_name');
        $this->db->from('migration_group m');
        $this->db->join('users u', 'u.id = m.mig_user_id', 'LEFT');
        // $this->db->where('id', 'DESC');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_my_migration_list() {
        $this->db->select('m.*, u.scout_id, u.first_name');
        $this->db->from('migration_group m');
        $this->db->join('users u', 'u.id = m.mig_user_id', 'LEFT');
        $this->db->where('mig_user_id', $this->session->userdata('user_id'));
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_my_section_migration_list() {
        $this->db->select('m.*, u.scout_id, u.first_name');
        $this->db->from('migration_section m');
        $this->db->join('users u', 'u.id = m.mig_user_id', 'LEFT');
        $this->db->where('mig_user_id', $this->session->userdata('user_id'));
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_release_group_request_list($curr_group_id)
    {
        $this->db->select('m.*, u.scout_id, u.first_name');
        $this->db->from('migration_group m');
        $this->db->join('users u', 'u.id = m.mig_user_id', 'LEFT');
        $this->db->where('curr_group_id', $curr_group_id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_release_section_request_list($curr_group_id)
    {
        $this->db->select('m.*, u.scout_id, u.first_name');
        $this->db->from('migration_section m');
        $this->db->join('users u', 'u.id = m.mig_user_id', 'LEFT');
        $this->db->where('curr_group_id', $curr_group_id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_migrate_group_request_list($mig_group_id)
    {
        $this->db->select('m.*, u.scout_id, u.first_name');
        $this->db->from('migration_group m');
        $this->db->join('users u', 'u.id = m.mig_user_id', 'LEFT');
        $this->db->where('mig_group_id', $mig_group_id);
        $this->db->where('curr_group_verify', 'Approved');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_migrate_section_request_list($mig_group_id)
    {
        $this->db->select('m.*, u.scout_id, u.first_name');
        $this->db->from('migration_section m');
        $this->db->join('users u', 'u.id = m.mig_user_id', 'LEFT');
        $this->db->where('curr_group_id', $mig_group_id);
        $this->db->where('mig_group_verify', 'Pending');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_info($id) {
        $this->db->select('m.*, u.*, m.id as migration_id, 
                            cr.region_name as current_region_name, cod.dis_name as current_dis_name, cou.upa_name as current_upa_name, cog.grp_name as current_grp_name, cunit.unit_name as current_unit_name,
                            r.region_name, od.dis_name, ou.upa_name, og.grp_name, unit.unit_name, bt.badge_type_name_bn, rt.role_type_name_bn');
        $this->db->from('migration_group m');
        $this->db->join('users u', 'u.id = m.mig_user_id', 'LEFT');
        
        $this->db->join('office_unit cunit', 'cunit.id = m.curr_unit_id', 'LEFT');        
        $this->db->join('office_groups cog', 'cog.id = m.curr_group_id', 'LEFT');
        $this->db->join('office_upazila cou', 'cou.id = m.curr_upazila_id', 'LEFT');
        $this->db->join('office_district cod', 'cod.id = m.curr_district_id', 'LEFT');
        $this->db->join('office_region cr', 'cr.id = m.curr_region_id', 'LEFT');

        $this->db->join('office_unit unit', 'unit.id = m.mig_unit_id', 'LEFT');        
        $this->db->join('office_groups og', 'og.id = m.mig_group_id', 'LEFT');
        $this->db->join('office_upazila ou', 'ou.id = m.mig_upazila_id', 'LEFT');
        $this->db->join('office_district od', 'od.id = m.mig_district_id', 'LEFT');
        $this->db->join('office_region r', 'r.id = m.mig_region_id', 'LEFT');
        $this->db->join('scout_badge sb', 'sb.id = u.sc_badge_id', 'LEFT');
        $this->db->join('badge_type bt', 'bt.id = sb.badge_type_id', 'LEFT');
        $this->db->join('scout_role so', 'so.id = u.sc_role_id', 'LEFT');
        $this->db->join('role_type rt', 'rt.id = so.role_type_id', 'LEFT');
        $this->db->where('m.id', $id);
        $query = $this->db->get()->row();

        return $query;
    }

    public function get_section_info($id) {
        $this->db->select('m.*, u.*, m.id as migration_id, cm.member_type_name as current_member_type, cr.region_name as current_region_name, cod.dis_name as current_dis_name, cou.upa_name as current_upa_name, cog.grp_name as current_grp_name, cunit.unit_name as current_unit_name,
            mg.member_type_name as member_type,r.region_name, od.dis_name, ou.upa_name, og.grp_name, unit.unit_name, bt.badge_type_name_bn, rt.role_type_name_bn as current_role_name, mrt.role_type_name_bn as mig_role_name, mbt.badge_type_name_bn as mig_badge_name');
        $this->db->from('migration_section m');
        $this->db->join('users u', 'u.id = m.mig_user_id', 'LEFT');
        
        $this->db->join('office_unit cunit', 'cunit.id = m.curr_unit_id', 'LEFT');        
        $this->db->join('office_groups cog', 'cog.id = m.curr_group_id', 'LEFT');
        $this->db->join('office_upazila cou', 'cou.id = m.curr_upazila_id', 'LEFT');
        $this->db->join('office_district cod', 'cod.id = m.curr_district_id', 'LEFT');
        $this->db->join('office_region cr', 'cr.id = m.curr_region_id', 'LEFT');
        $this->db->join('member_type cm', 'cm.id = m.curr_member_id', 'LEFT');


        $this->db->join('office_unit unit', 'unit.id = m.mig_unit_id', 'LEFT');        
        $this->db->join('office_groups og', 'og.id = m.mig_group_id', 'LEFT');
        $this->db->join('office_upazila ou', 'ou.id = m.mig_upazila_id', 'LEFT');
        $this->db->join('office_district od', 'od.id = m.mig_district_id', 'LEFT');
        $this->db->join('office_region r', 'r.id = m.mig_region_id', 'LEFT');
        $this->db->join('member_type mg', 'mg.id = m.mig_member_id', 'LEFT');

        $this->db->join('scout_badge sb', 'sb.id = u.sc_badge_id', 'LEFT');
        $this->db->join('badge_type bt', 'bt.id = sb.badge_type_id', 'LEFT');
        $this->db->join('scout_role so', 'so.id = u.sc_role_id', 'LEFT');
        $this->db->join('role_type rt', 'rt.id = so.role_type_id', 'LEFT');

        $this->db->join('scout_badge msb', 'msb.id = m.mig_badge_id', 'LEFT');
        $this->db->join('badge_type mbt', 'mbt.id = msb.badge_type_id', 'LEFT');
        $this->db->join('scout_role msr', 'msr.id = m.mig_role_id', 'LEFT');
        $this->db->join('role_type mrt', 'mrt.id = msr.role_type_id', 'LEFT');
        $this->db->where('m.id', $id);
        $query = $this->db->get()->row();

        return $query;
    }

    public function upcomming_event() {
        $this->db->select('*');
        $this->db->where('event_start_date >',date('Y-m-d'));
        $this->db->from('events');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get()->result();

        return $query;
    }

     public function scout_member_event() {
        $this->users= $this->ion_auth->user()->row();
        $this->db->select('*');
        $this->db->where('event_start_date >',date('Y-m-d'));
        if($this->users->sc_section_id==NULL){
            $this->db->like('event_notify', 'NULL');
        }else{
            $this->db->like('event_notify', $this->users->sc_section_id);
        }
        $this->db->where('sc_region_id', $this->users->sc_region_id);
        $this->db->where('sc_district_id', $this->users->sc_district_id);
        $this->db->where('sc_upa_tha_id', $this->users->sc_upa_tha_id);
        $this->db->where('sc_group_id', $this->users->sc_group_id);
        $this->db->from('events');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get()->result();
        if(!empty($query)){
           return $query;
       }else{
            $this->db->select('*');
            $this->db->where('event_start_date >',date('Y-m-d'));
            $this->db->like('event_notify', 'All'); 
            $this->db->where('sc_region_id', $this->users->sc_region_id);
            $this->db->where('sc_district_id', $this->users->sc_district_id);
            $this->db->where('sc_upa_tha_id', $this->users->sc_upa_tha_id);
            $this->db->where('sc_group_id', $this->users->sc_group_id);
            $this->db->from('events');
            $this->db->order_by('id', 'DESC');
            $query = $this->db->get()->result();
            return $query; 
       }
        
    }

    

    public function get_scout_member_list($id) {
        $this->db->select('event_to_scouts.id, event_to_scouts.scout_id, event_to_scouts.event_id, event_to_scouts.status, event_to_scouts.comments, users.first_name');
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
        $this->db->where('e.event_end_date <',date('Y-m-d'));
        if($this->users->sc_section_id==NULL){
            $this->db->like('e.event_notify', 'NULL');
        }else{
            $this->db->like('e.event_notify', $this->users->sc_section_id);
        }
        $this->db->where('e.sc_region_id', $this->users->sc_region_id);
        $this->db->where('e.sc_district_id', $this->users->sc_district_id);
        $this->db->where('e.sc_upa_tha_id', $this->users->sc_upa_tha_id);
        $this->db->where('e.sc_group_id', $this->users->sc_group_id);
        $this->db->where('es.scout_id', $this->users->id);
        $this->db->where('es.status', 'Approved');
        $this->db->order_by('e.id', 'DESC');
        $query = $this->db->get()->result();
        if(!empty($query)){
           return $query;
       }else{
            $this->db->select('e.*, es.comments');
            $this->db->from('events e');
            $this->db->join('event_to_scouts es', 'e.id=es.event_id');
            $this->db->where('e.event_end_date <',date('Y-m-d'));
            $this->db->like('e.event_notify', 'All'); 
            $this->db->where('e.sc_region_id', $this->users->sc_region_id);
            $this->db->where('e.sc_district_id', $this->users->sc_district_id);
            $this->db->where('e.sc_upa_tha_id', $this->users->sc_upa_tha_id);
            $this->db->where('e.sc_group_id', $this->users->sc_group_id);
            $this->db->where('es.scout_id', $this->users->id);
            $this->db->where('es.status', 'Approved');
            $this->db->order_by('e.id', 'DESC');
            $query = $this->db->get()->result();
            return $query;
       }
    }

    public function get_event_valid($id) {

        $this->users= $this->ion_auth->user()->row();

        $this->db->select('e.*');
        $this->db->from('events e');
        $this->db->join('event_to_scouts es', 'e.id=es.event_id');
        $this->db->where('e.id', $id);
        $this->db->where('e.event_end_date <',date('Y-m-d'));
        if($this->users->sc_section_id==NULL){
            $this->db->like('e.event_notify', 'NULL');
        }else{
            $this->db->like('e.event_notify', $this->users->sc_section_id);
        }
        $this->db->where('e.sc_region_id', $this->users->sc_region_id);
        $this->db->where('e.sc_district_id', $this->users->sc_district_id);
        $this->db->where('e.sc_upa_tha_id', $this->users->sc_upa_tha_id);
        $this->db->where('e.sc_group_id', $this->users->sc_group_id);
        $this->db->where('es.scout_id', $this->users->id);
        $this->db->where('es.status', 'Approved');
        $this->db->order_by('e.id', 'DESC');
        $query = $this->db->get()->row();
        if(!empty($query)){
           return true;
        }else{
            $this->db->select('e.*');
            $this->db->from('events e');
            $this->db->join('event_to_scouts es', 'e.id=es.event_id');
            $this->db->where('e.id', $id);
            $this->db->where('e.event_end_date <',date('Y-m-d'));
            $this->db->like('e.event_notify', 'All'); 
            $this->db->where('e.sc_region_id', $this->users->sc_region_id);
            $this->db->where('e.sc_district_id', $this->users->sc_district_id);
            $this->db->where('e.sc_upa_tha_id', $this->users->sc_upa_tha_id);
            $this->db->where('e.sc_group_id', $this->users->sc_group_id);
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
