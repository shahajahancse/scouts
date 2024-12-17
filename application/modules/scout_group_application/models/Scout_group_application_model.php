<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Scout_group_application_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    public function get_data($region_id=NULL, $sc_district_id=NULL, $sc_upa_tha_id=NULL) {
        $this->db->select('*');
        $this->db->from('scout_group_application');
        if($region_id != NULL){
            $this->db->where('region_id', $region_id); 
        }
        if($sc_district_id != NULL){
            $this->db->where('district_id', $sc_district_id);     
        }
        if($sc_upa_tha_id != NULL){
            $this->db->where('upazila_id', $sc_upa_tha_id);     
        }
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get()->result();

        return $query;
    }
            

    public function get_info($id) {
        $this->db->select('*');
        $this->db->from('scout_group_application');
        $this->db->where('id', $id);
        $query = $this->db->get()->row();

        return $query;
    }

    public function get_scout_application($id){
        $this->db->select('sga.*, r.region_name, r.region_name_en, od.dis_name, od.dis_name_en, od.dis_name_en, ou.upa_name, ou.upa_name_en');
        $this->db->from('scout_group_application sga');
        $this->db->join('office_upazila ou', 'ou.id = sga.upazila_id', 'LEFT');
        $this->db->join('office_district od', 'od.id = sga.district_id', 'LEFT');
        $this->db->join('office_region r', 'r.id = sga.region_id', 'LEFT');
        $this->db->where('sga.id', $id);
        $query = $this->db->get()->row();
        // echo $this->db->last_query(); exit;

        return $query;
    }
    

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('scout_group_application');     
        return TRUE;
    }

}
