<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Image_gallery_model extends CI_Model {

    var $img_path; 

    public function __construct() {
        parent::__construct();
        $this->img_path = realpath(APPPATH . '../image_gallery');
    }

    public function get_image_gallery($region_id=NULL, $sc_district_id=NULL, $sc_upa_tha_id=NULL, $sc_group_id=NULL) {
        $this->db->select('id, ig_file_name');
        $this->db->from('image_gallery');  

        if($region_id){
            $this->db->where('ig_region_id', $region_id);
            $query = $this->db->get()->result();
        }elseif($sc_district_id){
            $this->db->where('ig_district_id', $sc_district_id);
            $query = $this->db->get()->result();
        }elseif($sc_upa_tha_id){
            $this->db->where('ig_upazila_id', $sc_upa_tha_id);
            $query = $this->db->get()->result();
        }elseif($sc_group_id){
            $this->db->where('ig_group_id', $sc_group_id);
            $query = $this->db->get()->result();
            // echo $this->db->last_query(); exit;
        }else{
            $query = $this->db->get()->result();
        }  

        // $query = $this->db->get()->result();        

        return $query;
    }

    public function get_info($id) {
        $this->db->select('id, ig_file_name, ig_group_id, ig_upazila_id, ig_district_id,  ig_region_id, user_id');
        $this->db->from('image_gallery');     
        $this->db->where('id', $id);
        $this->db->limit('1');   
        $query = $this->db->get()->row();        

        return $query;
    }    

    function delete($id) {
        //$img_path = base_url().'image_gallery/';
        $info = $this->get_info($id);

        if(file_exists($this->img_path.'/'.$info->ig_file_name)){
           @unlink($this->img_path.'/'.$info->ig_file_name);           
        }

        $this->db->where('id', $id);
        $this->db->delete('image_gallery');
        
        return TRUE;
    }

}
