<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Acl_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_user_data($id) {
        $query = $this->db->select('u.id, u.password, u.email, u.created_on, u.last_login, u.first_name, u.last_name, u.company, u.phone, ug.group_id, g.description ')
                ->join('users_groups ug', 'ug.user_id = u.id', 'left')
                ->join('groups g', 'g.id = ug.user_id', 'left')
                ->limit(1)
                ->order_by('u.id', 'ASC')
                ->get_where('users u', array('u.id' => $id));
        return $query->row();
    }

    public function get_users($limit = 1000, $offset = 0) {
        // result query
        $this->db->select('u.id, u.scout_id, u.username, u.first_name, u.phone, u.email, u.created_on, u.last_login, u.active');
        $this->db->from('users u');
        $this->db->limit($limit);
        $this->db->offset($offset);        
        $this->db->order_by('u.id', 'DESC');

        // join and then run a where_in against the group ids
        // if (isset($groups) && !empty($groups))
        if($this->input->get('group') != NULL)
        {
            $this->db->distinct();
            // $this->db->join('task_register tr', 'tr.id=al.task_register_id', 'LEFT');
            $this->db->join('users_groups ug', 'ug.user_id=u.id', 'inner');
            $this->db->where_in('ug.group_id', $this->input->get('group'));
        }

        if($this->input->get('scoutID') != NULL){
            $this->db->where('u.scout_id', $this->input->get('scoutID')); 
        }
        if($this->input->get('name') != NULL){
            $this->db->like('u.first_name', $this->input->get('name'));
        }
        if($this->input->get('username') != NULL){
            $this->db->where('u.username', $this->input->get('username')); 
        }
        $this->db->where('u.id !=', 3); 
        // echo $this->db->last_query(); exit;
        $result['rows'] = $this->db->get()->result();

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('users u');
        // join and then run a where_in against the group ids
        // if (isset($groups) && !empty($groups))
        if($this->input->get('group') != NULL)
        {
            $this->db->distinct();
            // $this->db->join('task_register tr', 'tr.id=al.task_register_id', 'LEFT');
            $this->db->join('users_groups ug', 'ug.user_id=u.id', 'inner');
            $this->db->where_in('ug.group_id', $this->input->get('group'));
        }
        if($this->input->get('scoutID') != NULL){
            $this->db->where('u.scout_id', $this->input->get('scoutID')); 
        }
        if($this->input->get('name') != NULL){
            $this->db->like('u.first_name', $this->input->get('name'));
        }
        if($this->input->get('username') != NULL){
            $this->db->where('u.username', $this->input->get('username')); 
        }
        $this->db->where('u.id !=', 3); 
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;

        return $result;
    }

    public function get_access_level() {
        // count query
        $this->db->select('al.id, tr.task_name_en, tr.task_name_bn, g.name, g.description, gr.role_name_en, gr.role_name_bn, gt.group_type_en, gt.group_type_bn');
        $this->db->from('access_level al');
        $this->db->join('task_register tr', 'tr.id=al.task_register_id', 'LEFT');
        $this->db->join('groups g', 'g.id=al.groups_id', 'LEFT');
        $this->db->join('groups_role gr', 'gr.id=al.groups_role_id', 'LEFT');
        $this->db->join('groups_type gt', 'gt.id=al.groups_type_id', 'LEFT');
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_access_level_info($id) {
        $query = $this->db->from('access_level')->where('id', $id)->get()->row();
        return $query;
    }

    public function get_task_register() {
        // count query
        $this->db->select('id, task_name_en, task_name_bn, controller_name, controller_function');
        $this->db->from('task_register');
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_task_register_info($id) {
        $query = $this->db->from('task_register')->where('id', $id)->get()->row();
        return $query;
    }

    public function get_group_type() {
        // count query
        $this->db->select('id, group_type_en, group_type_bn, type_description');
        $this->db->from('groups_type');
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_group_type_info($id) {
        $query = $this->db->from('groups_type')->where('id', $id)->get()->row();
        return $query;
    }

    public function get_role_group() {
        // count query
        $this->db->select('id, role_name_en, role_name_bn, role_description');
        $this->db->from('groups_role');
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_role_group_info($id) {
        $query = $this->db->from('groups_role')->where('id', $id)->get()->row();
        return $query;
    }

    public function get_group_name() {
        // count query
        $this->db->select('id, name, description');
        $this->db->from('groups');
        $query = $this->db->get()->result();

        return $query;
    }


    public function get_dd_task_register(){
        $data[''] = 'Select Task Register';
        $this->db->select('id, task_name_en, task_name_bn');
        $this->db->from('task_register');
        $this->db->order_by('task_name_en', 'ASC');
        $query = $this->db->get();

         foreach ($query->result_array() AS $rows) {
            $data[$rows['id']] = $rows['task_name_en'];
        }

        return $data;
    }

    public function get_dd_groups(){
        $data[''] = 'Select Groups';
        $this->db->select('id, description');
        $this->db->from('groups');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();

         foreach ($query->result_array() AS $rows) {
            $data[$rows['id']] = $rows['description'];
        }

        return $data;
    }

    public function get_dd_groups_role(){
        $data[''] = 'Select Groups Role';
        $this->db->select('id, role_name_en, role_name_bn');
        $this->db->from('groups_role');
        $this->db->order_by('role_name_en', 'ASC');
        $query = $this->db->get();

         foreach ($query->result_array() AS $rows) {
            $data[$rows['id']] = $rows['role_name_en'];
        }

        return $data;
    }

    public function get_dd_groups_type(){
        $data[''] = 'Select Groups Type';
        $this->db->select('id, group_type_en, group_type_bn');
        $this->db->from('groups_type');
        $this->db->order_by('group_type_en', 'ASC');
        $query = $this->db->get();

         foreach ($query->result_array() AS $rows) {
            $data[$rows['id']] = $rows['group_type_en'];
        }

        return $data;
    }
    
    public function user_destroy($id) {        
        $query = $this->db->delete('users', array('id' => $id));
        return $query;
    } 

    // public function get_members_count() {
    //     // count query
    //     $this->db->select('COUNT(*) as count');
    //     $this->db->from('members');
    //     $q = $this->db->get()->result();

    //     $tmp = $q;
    //     $ret['num_rows'] = $tmp[0]->count;

    //     return $ret;
    // }

}
