<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Scout_news_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_data() {
        $this->db->select('*');
        $this->db->from('scout_news');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get()->result();

        return $query;
    }    

    public function get_info($id) {
        $this->db->select('id, news_title, news_details, created, status');
        $this->db->from('scout_news');        
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
        $this->db->delete('scout_news');
        
        return TRUE;
    }

}
