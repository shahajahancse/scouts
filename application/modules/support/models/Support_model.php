<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Support_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /*************************** Scouts complain box ******************************
    ****************************************************************************/
    public function get_complain_list($limit=1000, $offset=0, $user_id = NULL) {
        $this->db->select('c.id, c.complain, c.created_at, u.scout_id, u.first_name, u.phone, u.email');
        $this->db->from('user_complains c');
        $this->db->join('users u', 'u.id = c.user_id', 'LEFT');
        if (!empty($user_id)) {
            $this->db->where('c.user_id', $user_id);
        }
        $this->db->limit($limit);
        $this->db->offset($offset);
        $this->db->order_by('c.id', 'DESC');
        $query = $this->db->get()->result();
        $result['rows'] = $query;

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('user_complains');
        $this->db->where('user_id', $user_id);
        $result['num_rows'] = $this->db->get()->row()->count;
        return $result;
    }


}
