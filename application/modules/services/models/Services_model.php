<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Services_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_data($limit=1000, $offset=0, $request_type=NULL, $status=NULL, $region_id=NULL, $sc_district_id=NULL, $sc_upa_tha_id=NULL) {
        $this->db->select('sr.*, sl.service_name');
        $this->db->from('service_request sr');
        $this->db->join('service_list sl', 'sl.id=sr.service_id');
        $this->db->limit($limit);
        $this->db->offset($offset);
        $this->db->order_by('sr.id', 'DESC');

        if($status){
            $this->db->where('sr.status', $status);
        }
        if($request_type){
            $this->db->where('sr.request_to', $request_type);
        }

        if($region_id){
            $this->db->where('sr.serv_region_id', $region_id);
            $query = $this->db->get()->result();
        }elseif($sc_district_id){
            $this->db->where('sr.serv_district_id', $sc_district_id);
            $query = $this->db->get()->result();
        }elseif($sc_upa_tha_id){
            $this->db->where('sr.serv_upazila_id', $sc_upa_tha_id);
            $query = $this->db->get()->result();      
        }else{
            $query = $this->db->get()->result();
            // echo $this->db->last_query(); exit;
        } 

        $result['rows'] = $query;

        // count query
        // $q = $this->db->select('COUNT(*) as count');
        // $this->db->from('service_request');  

        // if($request_type){
        //     $this->db->where('request_to', $request_type);
        // }

        // if($region_id){
        //     $this->db->where('serv_region_id', $region_id);
        //     $query = $this->db->get()->result();
        // }elseif($sc_district_id){
        //     $this->db->where('serv_district_id', $sc_district_id);
        //     $query = $this->db->get()->result();
        // }elseif($sc_upa_tha_id){
        //     $this->db->where('serv_upazila_id', $sc_upa_tha_id);
        //     $query = $this->db->get()->result();
        // }else{
        //     $query = $this->db->get()->result();
        // }

        // $tmp = $query;
        // $result['num_rows'] = $tmp[0]->count;

        return $result;
    }    

    public function get_info($id) {
        $this->db->select('sr.*, sl.service_name, or.region_name, od.dis_name, ou.upa_name, 
            or2.region_name AS action_region_name, 
            od2.dis_name AS action_dis_name,  
            ou2.upa_name AS action_upa_name, 
            og2.grp_name AS action_grp_name');
        $this->db->from('service_request sr');
        $this->db->join('service_list sl', 'sl.id = sr.service_id', 'LEFT');
        $this->db->join('office_region or', 'or.id = sr.serv_region_id', 'LEFT');
        $this->db->join('office_district od', 'od.id = sr.serv_district_id', 'LEFT');
        $this->db->join('office_upazila ou', 'ou.id = sr.serv_upazila_id', 'LEFT');

        $this->db->join('office_region or2', 'or2.id = sr.act_region_id', 'LEFT');
        $this->db->join('office_district od2', 'od2.id = sr.act_district_id', 'LEFT');
        $this->db->join('office_upazila ou2', 'ou2.id = sr.act_upazila_id', 'LEFT');
        $this->db->join('office_groups og2', 'og2.id = sr.act_group_id', 'LEFT');

        $this->db->where('sr.id', $id);
        $query = $this->db->get()->row();

        return $query;
    }


    public function get_assign_to_list($limit=1000, $offset=0, $officeType=NULL, $region=NULL, $district=NULL, $upazila=NULL, $group=NULL) {
        $this->db->select('sa.*, sr.*, sa.id AS assign_id, sl.service_name, r.region_name, od.dis_name, ou.upa_name, og.grp_name');
        $this->db->from('service_assign sa');
        $this->db->join('service_request sr', 'sr.id=sa.req_service_id', 'LEFT');
        $this->db->join('service_list sl', 'sl.id=sr.service_id', 'LEFT');
        $this->db->join('office_groups og', 'og.id = sa.ass_group_id', 'LEFT');
        $this->db->join('office_upazila ou', 'ou.id = sa.ass_upazila_id', 'LEFT');
        $this->db->join('office_district od', 'od.id = sa.ass_district_id', 'LEFT');
        $this->db->join('office_region r', 'r.id = sa.ass_region_id', 'LEFT');
        $this->db->where('sa.assign_from', $officeType);
        if($region!=NULL){
            $this->db->where('sa.ass_region_id', $region);
        }
        if($district!=NULL){
            $this->db->where('sa.ass_district_id', $district);
        }
        if($upazila!=NULL){
            $this->db->where('sa.ass_district_id', $upazila);
        }
        if($group!=NULL){
            $this->db->where('sa.ass_upazila_id', $group);
        }
        $this->db->limit($limit);
        $this->db->offset($offset);
        $this->db->order_by('sa.id', 'DESC');
        $query = $this->db->get()->result();
        // echo $this->db->last_query(); exit;

        $result['rows'] = $query;

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('service_assign');  
        $this->db->where('assign_from', $officeType);
        $query = $this->db->get()->result();

        $tmp = $query;
        $result['num_rows'] = $tmp[0]->count;

        return $result;
    }

    public function get_task_assign_list($limit=1000, $offset=0, $officeID=NULL,$region=NULL, $district=NULL, $upazila=NULL, $group=NULL) {

        $this->db->select('sa.*, sr.*, sa.id AS assign_id, sl.service_name, r.region_name, od.dis_name, ou.upa_name, og.grp_name');
        $this->db->from('service_assign sa');
        $this->db->join('service_request sr', 'sr.id=sa.req_service_id', 'LEFT');
        $this->db->join('service_list sl', 'sl.id=sr.service_id', 'LEFT');
        $this->db->join('office_groups og', 'og.id = sa.ass_group_id', 'LEFT');
        $this->db->join('office_upazila ou', 'ou.id = sa.ass_upazila_id', 'LEFT');
        $this->db->join('office_district od', 'od.id = sa.ass_district_id', 'LEFT');
        $this->db->join('office_region r', 'r.id = sa.ass_region_id', 'LEFT');
        if($request_type){
            $this->db->where('sa.ass_to_office_id', $officeID);
        }
        if($region!=NULL){
            $this->db->where('sa.ass_region_id', $region);
        }
        if($district!=NULL){
            $this->db->where('sa.ass_district_id', $district);
        }
        if($upazila!=NULL){
            $this->db->where('sa.ass_district_id', $upazila);
        }
        if($group!=NULL){
            $this->db->where('sa.ass_upazila_id', $group);
        }
        $this->db->limit($limit);
        $this->db->offset($offset);
        $this->db->order_by('sa.id', 'DESC');
        $query = $this->db->get()->result();
        // echo $this->db->last_query(); exit;

        $result['rows'] = $query;

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('service_assign');  
        $this->db->where('assign_from', $officeType);
        $query = $this->db->get()->result();

        $tmp = $query;
        $result['num_rows'] = $tmp[0]->count;

        return $result;
    }

    public function get_assign_to_list_by_request_id($requestID = NULL, $region=NULL, $district= NULL, $upazila=NULL, $group=NULL) {
        $this->db->select('sa.*, sr.*, sa.id AS assign_id, sl.service_name, r.region_name, od.dis_name, ou.upa_name, og.grp_name');
        $this->db->from('service_assign sa');
        $this->db->join('service_request sr', 'sr.id=sa.req_service_id', 'LEFT');
        $this->db->join('service_list sl', 'sl.id=sr.service_id', 'LEFT');
        $this->db->join('office_groups og', 'og.id = sa.ass_group_id', 'LEFT');
        $this->db->join('office_upazila ou', 'ou.id = sa.ass_upazila_id', 'LEFT');
        $this->db->join('office_district od', 'od.id = sa.ass_district_id', 'LEFT');
        $this->db->join('office_region r', 'r.id = sa.ass_region_id', 'LEFT');
        $this->db->where('sa.req_service_id', $requestID);
        if($region!=NULL){
            $this->db->where('sa.ass_region_id', $region);
        }
        if($district!=NULL){
            $this->db->where('sa.ass_district_id', $district);
        }
        if($upazila!=NULL){
            $this->db->where('sa.ass_district_id', $upazila);
        }
        if($group!=NULL){
            $this->db->where('sa.ass_upazila_id', $group);
        }
        $this->db->order_by('sa.ass_group_id', 'ASC');
        $query = $this->db->get()->result();
        // echo $this->db->last_query(); exit;

        return $query;
    }

    public function destroy_assign_to($id) {

        $this->db->where('req_service_id', $id);
        $result = $this->db->delete('service_assign');
        // echo $this->db->last_query(); exit;
        return $result?TRUE:FALSE;
    }


    // public function get_scout_member_approved() {

    //     $this->users= $this->ion_auth->user()->row();

    //     $this->db->select('e.*, es.comments');
    //     $this->db->from('services e');
    //     $this->db->join('services_to_scouts es', 'e.id=es.services_id');
    //     $this->db->where('e.services_end_date <',date('Y-m-d'));
    //     if($this->users->sc_section_id==NULL){
    //         $this->db->like('e.services_notify', 'NULL');
    //     }else{
    //         $this->db->like('e.services_notify', $this->users->sc_section_id);
    //     }
    //     $this->db->where('e.sc_region_id', $this->users->sc_region_id);
    //     $this->db->where('e.sc_district_id', $this->users->sc_district_id);
    //     $this->db->where('e.sc_upa_tha_id', $this->users->sc_upa_tha_id);
    //     $this->db->where('e.sc_group_id', $this->users->sc_group_id);
    //     $this->db->where('es.scout_id', $this->users->id);
    //     $this->db->where('es.status', 'Approved');
    //     $this->db->order_by('e.id', 'DESC');
    //     $query = $this->db->get()->result();
    //     if(!empty($query)){
    //         return $query;
    //     }else{
    //         $this->db->select('e.*, es.comments');
    //         $this->db->from('services e');
    //         $this->db->join('services_to_scouts es', 'e.id=es.services_id');
    //         $this->db->where('e.services_end_date <',date('Y-m-d'));
    //         $this->db->like('e.services_notify', 'All'); 
    //         $this->db->where('e.sc_region_id', $this->users->sc_region_id);
    //         $this->db->where('e.sc_district_id', $this->users->sc_district_id);
    //         $this->db->where('e.sc_upa_tha_id', $this->users->sc_upa_tha_id);
    //         $this->db->where('e.sc_group_id', $this->users->sc_group_id);
    //         $this->db->where('es.scout_id', $this->users->id);
    //         $this->db->where('es.status', 'Approved');
    //         $this->db->order_by('e.id', 'DESC');
    //         $query = $this->db->get()->result();
    //         return $query;
    //     }
    // }

    // function delete($id) {
    //     $this->db->where('id', $id);
    //     $this->db->delete('service_request');     
    //     return TRUE;
    // }

}
