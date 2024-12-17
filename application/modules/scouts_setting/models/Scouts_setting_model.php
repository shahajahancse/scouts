<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Scouts_setting_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_data() {
        // count query
        $this->db->select('*');
        $this->db->from('courses');
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_info($id) {
        $query = $this->db->from('courses')
                        ->where('id', $id)
                        ->get()->row();
        return $query;
    }

    function delete($id) {
        $img_path = base_url().'course_img/';
        $img_path_thumbs = base_url().'course_img/thumbs/';
        $info = $this->get_info($id);

        if(file_exists($img_path.$info->image_file)){
           @unlink($img_path.$info->image_file);
           @unlink($img_path_thumbs.$info->image_file);
        }

        $this->db->where('id', $id);
        $this->db->delete('courses');
        
        return TRUE;
    }

}
