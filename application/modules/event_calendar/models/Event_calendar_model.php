<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Event_calendar_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_nhq_event($limit, $offset) {
        // result query
        $this->db->select('*');
        $this->db->from('event_calendar_nhq');
        $this->db->limit($limit);
        $this->db->offset($offset);
        // $this->db->join('committee_type ct', 'ct.id = c.comm_type_id', 'LEFT');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get()->result();
        $result['rows'] = $query;

        // count query
        $this->db->select('COUNT(*) as count');
        $query = $this->db->get('event_calendar_nhq')->result();
        $tmp = $query;
        $result['num_rows'] = $tmp[0]->count;
        // echo $this->db->last_query(); exit;

        return $result;
    }

    public function get_nstc_event($limit, $offset) {
        // result query
        $this->db->select('*');
        $this->db->from('event_calendar_nstc');
        $this->db->limit($limit);
        $this->db->offset($offset);
        // $this->db->join('committee_type ct', 'ct.id = c.comm_type_id', 'LEFT');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get()->result();
        $result['rows'] = $query;

        // count query
        $this->db->select('COUNT(*) as count');
        $query = $this->db->get('event_calendar_nstc')->result();
        $tmp = $query;
        $result['num_rows'] = $tmp[0]->count;
        // echo $this->db->last_query(); exit;

        return $result;
    }

    public function get_members_count() {
        // count query
        // $this->db->select('COUNT(*) as count');
        // $this->db->from('members');
        // $q = $this->db->get()->result();

        // $tmp = $q;
        // $ret['num_rows'] = $tmp[0]->count;

        // return $ret;
    }

}
