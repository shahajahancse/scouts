<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Slider_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_data() {
        $this->db->select('*');
        $this->db->from('slider');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get()->result();

        return $query;
    }    

    public function get_info($id) {
        $this->db->select('*');
        $this->db->from('slider');        
        $this->db->where('id', $id);
        $query = $this->db->get();

        $num = $query->num_rows();
        if($num){
            $query = $query->row();
            return $query;
        }else{
            return false;
        }
        //return $query;
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('slider');
        
        return TRUE;
    }

}
