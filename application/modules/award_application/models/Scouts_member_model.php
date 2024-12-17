<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Scouts_member_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_scout_member() {
        $this->db->select('id, first_name, last_name, phone, email, active, req_group, profile_img');
        $this->db->from('users');
        $this->db->where('appr_group != 0');
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_request_member() {
        $this->db->select('id, first_name, last_name, phone, email, active, req_group, profile_img');
        $this->db->from('users');
        $this->db->where('active', '0');
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_info($id) {
        $this->db->select('id, first_name, last_name, phone, email, active, req_group, profile_img');
        $this->db->from('users');
        $this->db->where('id', $id);
        $query = $this->db->get()->row();

        return $query;
    }

    public function get_verify($id) {
        $this->db->select('id, first_name, last_name, phone, email, active, dob, req_group, profile_img');
        $this->db->from('users');
        $this->db->where('id', $id);
        $query = $this->db->get()->row();

        return $query;
    }

    function delete($id) {
        $img_path = base_url().'profile_img/';
        $img_path_thumbs = base_url().'profile_img/thumbs/';
        $info = $this->get_info($id);

        if(file_exists($img_path.$info->profile_img)){
           @unlink($img_path.$info->profile_img);
           @unlink($img_path_thumbs.$info->profile_img);
        }

        $this->db->where('id', $id);
        $this->db->delete('courses');
        
        return TRUE;
    }

}
