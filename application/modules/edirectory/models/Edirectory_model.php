<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Edirectory_model extends CI_Model {

   public function __construct() {
      parent::__construct();
   }

   public function get_listing($limit, $offset, $office_level=NULL, $status=NULL, $region=NULL, $district=NULL, $upazila=NULL, $sgroup=NULL) {
      // result query
      $this->db->select('e.*, o.office_type_name, d.committee_designation_name_en, d.committee_designation_name_en, u.profile_img, t.tc_name');
      $this->db->from('edirectory e');
      $this->db->join('office_type o', 'o.id = e.office_level', 'LEFT');
      $this->db->join('edirectory_designation d', 'd.id = e.scout_desig_id', 'LEFT');
      $this->db->join('users u', 'u.id = e.scout_id', 'LEFT');
      $this->db->join('training_center t', 't.id = e.tc_id', 'LEFT');
      $this->db->limit($limit);
      $this->db->offset($offset);        
      if($office_level){
         $this->db->where('e.office_level', $office_level);            
      }
      if($region){
         $this->db->where('e.sc_region_id', $region);            
      }
      if($district){
         $this->db->where('e.sc_district_id', $district);            
      }
      if($upazila){
         $this->db->where('e.sc_upzaila_id', $upazila);            
      }
      if($sgroup){
         $this->db->where('e.sc_group_id', $sgroup);            
      }
      if($status){
         $this->db->where('e.status', $status);            
      }

      if($this->input->get('designation') != NULL){
         $this->db->where('e.scout_desig_id', $this->input->get('designation')); 
      }
      if($this->input->get('name') != NULL){
         $this->db->like('e.name', $this->input->get('name'));
      }
      if($this->input->get('mobile') != NULL){
         $this->db->where('e.phone', $this->input->get('mobile'));
      }
      if($this->input->get('email') != NULL){
         $this->db->like('e.email', $this->input->get('email'));
      }
      if($this->input->get('gender') != NULL){
         $this->db->where('e.gender', $this->input->get('gender')); 
      }
        

      // $this->db->join('committee_type ct', 'ct.id = c.comm_type_id', 'LEFT');
      $this->db->order_by('id', 'DESC');
      $query = $this->db->get()->result();
      $result['rows'] = $query;
      // echo $this->db->last_query(); exit;

      // count query
      $this->db->select('COUNT(*) as count');
      if($office_level){
         $this->db->where('office_level', $office_level);
      }
      if($region){
         $this->db->where('sc_region_id', $region);            
      }
      if($district){
         $this->db->where('sc_district_id', $district);            
      }
      if($upazila){
         $this->db->where('sc_upzaila_id', $upazila);            
      }
      if($sgroup){
         $this->db->where('sc_group_id', $sgroup);            
      }
      if($status){
         $this->db->where('status', $status);
      }

      $query = $this->db->get('edirectory')->result();
      $tmp = $query;
      $result['num_rows'] = $tmp[0]->count;
      // echo $this->db->last_query(); exit;

      return $result;
   }

   public function get_contact_details($id){
      $this->db->select('e.*, o.office_type_name, d.committee_designation_name_en, d.committee_designation_name_en, u.profile_img, bg.bg_name_en');
      $this->db->from('edirectory e');
      $this->db->join('office_type o', 'o.id = e.office_level', 'LEFT');
      $this->db->join('edirectory_designation d', 'd.id = e.scout_desig_id', 'LEFT');
      $this->db->join('users u', 'u.id = e.scout_id', 'LEFT');
      $this->db->join('blood_group bg', 'bg.id=e.bg_id', 'LEFT');
      $this->db->where('e.id', $id);
      $query = $this->db->get()->row();

      return $query;
   }

   public function set_image_file($id, $fileName){
      $data = array(
         'image_file' => $fileName
         );
      $this->db->where('id', $id);
      $this->db->update('edirectory', $data);

      return true;
   }


   public function get_scouts_member_info($id) {
      $this->db->select('u.id, u.first_name, u.full_name_bn, u.father_name, u.mother_name, u.dob, DATE_FORMAT(dob,"%d-%m-%Y") AS dobDate, YEAR(CURDATE()) - YEAR(dob) AS ageYear, MONTH(dob) - MONTH(CURDATE()) AS ageMonth, DAY(CURDATE()) - DAY(dob) AS ageDay, u.gender, u.phone, u.email, u.pre_village_house, u.pre_road_block, u.pre_post_office, u.per_village_house, u.per_road_block, u.per_post_office, dv.div_name as pre_div_name, dv2.div_name as per_div_name, u.profile_img, ds.district_name as pre_district_name, ds2.district_name as per_district_name, ut.up_th_name as pre_up_th_name, ut2.up_th_name as per_up_th_name, r.region_name, od.dis_name, ou.upa_name, og.grp_name, unit.unit_name, bt.badge_type_name_bn, rt.role_type_name_bn, u.blood_group, bg.bg_name_en, it.name as institute_name, u.curr_class, u.curr_role_no');
      $this->db->from('users u');
      // $this->db->join('occupation oc', 'oc.id=u.occupation_id', 'LEFT');
      $this->db->join('blood_group bg', 'bg.id=u.blood_group', 'LEFT');
      $this->db->join('upazila_thana ut', 'ut.id=u.pre_upa_tha_id', 'LEFT');
      $this->db->join('upazila_thana ut2', 'ut2.id=u.per_upa_tha_id', 'LEFT');
      $this->db->join('district ds', 'ds.id=u.pre_district_id', 'LEFT');
      $this->db->join('district ds2', 'ds2.id=u.per_district_id', 'LEFT');
      $this->db->join('division dv', 'dv.id=u.pre_division_id', 'LEFT');
      $this->db->join('division dv2', 'dv2.id=u.per_division_id', 'LEFT');
      $this->db->join('office_unit unit', 'unit.id = u.sc_unit_id', 'LEFT');
      $this->db->join('office_groups og', 'og.id = u.sc_group_id', 'LEFT');
      $this->db->join('office_upazila ou', 'ou.id = u.sc_upa_tha_id', 'LEFT');
      $this->db->join('office_district od', 'od.id = u.sc_district_id', 'LEFT');
      $this->db->join('office_region r', 'r.id = u.sc_region_id', 'LEFT');
      $this->db->join('institute it', 'it.id = u.curr_institute_id', 'LEFT');
      // $this->db->join('member_type mt', 'mt.id = u.member_id', 'LEFT');
      $this->db->join('scout_badge sb', 'sb.id = u.sc_badge_id', 'LEFT');
      $this->db->join('badge_type bt','bt.id = sb.badge_type_id', 'LEFT');
      $this->db->join('scout_role so', 'so.id = u.sc_role_id', 'LEFT');
      $this->db->join('role_type rt', 'rt.id = so.role_type_id', 'LEFT');

      $this->db->where('u.id', $id);
      $query = $this->db->get()->row();

      return $query;
   }


   public function get_scout_member_by_group($regionID=NULL, $districtID=NULL, $upazilaID=NULL, $groupID=NULL){
      $data[''] = '-- Select One --';
      $this->db->select('u.id, u.scout_id, u.first_name, u.sc_section_id, u.profile_img, bt.badge_type_name_bn');
      $this->db->from('users u'); 
      $this->db->join('member_type mt', 'mt.id = u.member_id', 'LEFT');
      $this->db->join('scout_badge sb', 'sb.id = u.sc_badge_id', 'LEFT');
      $this->db->join('badge_type bt','bt.id = sb.badge_type_id', 'LEFT');
      $this->db->where('u.scout_id IS NOT NULL', NULL);

      if($regionID){
         $this->db->where('u.sc_region_id', $regionID);            
      }
      if($districtID){
         $this->db->where('u.sc_district_id', $districtID);
      }
      if($upazilaID){
         $this->db->where('u.sc_upa_tha_id', $upazilaID);
      }
      if($groupID){
         $this->db->where('u.sc_group_id', $groupID);
      }

      $this->db->order_by('u.scout_id', 'DESC');
      $query = $this->db->get();
        // echo $this->db->last_query(); exit;
      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] =  $rows['scout_id'].' - '.$rows['first_name'] .' ('.$rows['badge_type_name_bn'].')';
      }
      return $data;
   }


    //or.region_name, od.dis_name, ou.upa_name, og.grp_name, ct.committee_type_name
   public function get_recommended_list_by_office($circularID) {
      // result query
      $this->db->select('*');
      $this->db->from('award_circular');        
      $this->db->where('id', $circularID);
      $result['info'] = $this->db->get()->row();            


      $this->db->select('r.*, a.award_name_bn');
      $this->db->from('award_recommendation r');
      $this->db->join('scout_nhq_award a', 'a.id = r.recom_award_id', 'LEFT');
      $this->db->order_by('r.id', 'DESC');
      $this->db->where('r.circular_id', $circularID);
      $result['rows'] = $this->db->get()->result();    

      return $result;
   }

   
   public function destroy_contact($id) {
      // Delete data
      if($this->db->delete('edirectory', array('id' => $id))){
         return TRUE;
      }
      return FALSE;
   }


   public function get_edirectory_designation() {
        // result query
        $this->db->select('ed.*, ot.office_type_name, d.department_name');
        $this->db->from('edirectory_designation ed');
        $this->db->join('office_type ot','ot.id = ed.office_id','LEFT');
        $this->db->join('department d','d.id = ed.department_id', 'LEFT');
        $this->db->where('ed.is_delete', 0);
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_info($table,$id) {
        $query = $this->db->from($table)
                        ->where('id', $id)
                        ->get()->row();
        return $query;
    }

}
