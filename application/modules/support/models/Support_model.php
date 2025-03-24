<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Support_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /*************************** Scouts complain box ******************************
    ****************************************************************************/
    public function get_complain_list($limit=1000, $offset=0) {
        $this->db->select('c.*');
        $this->db->from('user_complains c');
        $this->db->limit($limit);
        $this->db->offset($offset);
        $this->db->order_by('c.id', 'DESC');
        $query = $this->db->get()->result();
        $result['rows'] = $query;

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('user_complains');
        $result['num_rows'] = $this->db->get()->row()->count;
        return $result;
    }
}
