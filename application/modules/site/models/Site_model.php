<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Site_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_data($table) {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('status', 1);
        $query = $this->db->get()->result();        

        return $query;
    }
     public function get_info($table, $id) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $this->db->from($table);
        $query = $this->db->get()->row();        

        return $query;
    }

    public function get_ebook_category($id) {
        $this->db->select('id, book_title, description, image_file, pdf_file, total_page');
        $this->db->from('ebook');
        $this->db->order_by('id', 'DESC');
        $this->db->where('category_id', $id);
        $this->db->where('status', '1');
        $books = $this->db->get()->result();

        $i=0;
        foreach($books as $row){
            $books[$i]->pages = $this->get_book_indexs($row->id);
            $i++;
        }

        return $books;
    } 

    public function get_ebook_details($id){
        $this->db->select('id, book_title, description, image_file, pdf_file, total_page');
        $this->db->from('ebook');
        $this->db->where('id', $id);
        $book = $this->db->get()->row();

        $book->pages = $this->get_book_indexs($book->id);

        return $book;
    }

    public function get_book_indexs($id) {
        $this->db->select('index_title, page_no');
        $this->db->from('ebook_index');
        $this->db->where('ebook_id', $id);
        $this->db->order_by('page_no', 'ASC');
        $query = $this->db->get()->result_array();

        return $query;
    }    



    public function get_news_data() {
        $this->db->select('*');
        $this->db->from('scout_news');
        $this->db->order_by('id', 'DESC');
        $this->db->where('status', '1');
        $query = $this->db->get()->result();

        return $query;
    }    

    public function get_news_details($id) {
        $this->db->select('id, news_title, news_details, attachment_file, created, status');
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

    public function get_contact_details($id){
      $this->db->select('e.*, o.office_type_name, d.committee_designation_name, d.committee_designation_name_en, u.profile_img, bg.bg_name_en');
      $this->db->from('edirectory e');
      $this->db->join('office_type o', 'o.id = e.office_level', 'LEFT');
      $this->db->join('edirectory_designation d', 'd.id = e.scout_desig_id', 'LEFT');
      $this->db->join('users u', 'u.id = e.scout_id', 'LEFT');
      $this->db->join('blood_group bg', 'bg.id=e.bg_id', 'LEFT');
      $this->db->where('e.id', $id);
      $query = $this->db->get()->row();

      return $query;
   }

    public function get_events_data() {
        $this->db->select('*');
        $this->db->from('events');
        $this->db->or_where('et_national', 1);
        $this->db->or_where('et_international', 1);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get()->result();

        return $query;
    } 


    public function get_event_details($id) {
        $this->db->select('e.*, ec.event_cate_name, ear.office_rules_name, r.region_name, od.dis_name, ou.upa_name, og.grp_name');
        $this->db->from('events e');

        $this->db->join('event_category ec', 'ec.id = e.event_category', 'LEFT');
        $this->db->join('event_approve_rules ear', 'ear.id = e.approve_role', 'LEFT');
        $this->db->join('office_groups og', 'og.id = e.sc_group_id', 'LEFT');
        $this->db->join('office_upazila ou', 'ou.id = e.sc_upa_tha_id', 'LEFT');
        $this->db->join('office_district od', 'od.id = e.sc_district_id', 'LEFT');
        $this->db->join('office_region r', 'r.id = e.sc_region_id', 'LEFT');
        $this->db->where('e.id', $id);
        $query = $this->db->get()->row();

        return $query;
    }  

    public function get_attachment($id){
        $this->db->select('id, event_id, file_name');
        $this->db->from('event_attachment');
        $this->db->where('event_id', $id);
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_district_office_single($id){
        return $query = $this->db->select('dis_name_en')->where('id', $id)->get('office_district')->row()->dis_name_en;
    }

    // public function get_event_details($id) {
    //     $this->db->select('e.*,r.region_name, od.dis_name, ou.upa_name, og.grp_name');
    //     $this->db->from('events e');
    //     $this->db->join('office_groups og', 'og.id = e.sc_group_id', 'LEFT');
    //     $this->db->join('office_upazila ou', 'ou.id = e.sc_upa_tha_id', 'LEFT');
    //     $this->db->join('office_district od', 'od.id = e.sc_district_id', 'LEFT');
    //     $this->db->join('office_region r', 'r.id = e.sc_region_id', 'LEFT');
    //     $this->db->where('e.id', $id);
    //     $query = $this->db->get();

    //     $num = $query->num_rows();
    //     if($num){
    //         $query = $query->row();
    //         return $query;
    //     }else{
    //         return false;
    //     }

    //     return $query;
    // }

    public function search_blood_donate($blood, $div=NULL, $dis=NULL, $up=NULL) {
        $date = date('Y-m-d', strtotime('-90 days'));

        $this->db->select('u.first_name, u.scout_id, u.profile_img, u.phone, ut.up_th_name, ds.district_name, (YEAR(NOW()) - YEAR(u.dob)) AS age');
        $this->db->from('users u');
        $this->db->where('u.pre_division_id', $div);
        if($dis != NULL){
           $this->db->where('u.pre_district_id', $dis); 
        }
        if($up != NULL){
          $this->db->where('u.pre_upa_tha_id', $up); 
        }
        $this->db->where('u.scout_id IS NOT NULL', NULL);
        // $this->db->where('scout_id', 'IS NOT NULL');
        $this->db->where('u.blood_group', $blood);
        $this->db->where('u.blood_donate_interested', 'yes');
        $this->db->where('u.last_donate_date <=', $date);
        $this->db->where('(YEAR(NOW()) - YEAR(u.dob)) >=', 18);
        $this->db->join('upazila_thana ut', 'ut.id=u.pre_upa_tha_id', 'LEFT');
        $this->db->join('district ds', 'ds.id=u.pre_district_id', 'LEFT');
        $this->db->limit(500);
        $query = $this->db->get()->result();  
        // echo $this->db->last_query(); exit;      

        return $query;
    }

    public function search_service_traking($mobile) {
        $this->db->select('sr.*, sl.service_name, r.region_name, sl.service_name_bn, r.region_name_en');
        $this->db->from('service_request sr');
        $this->db->where('phone', $mobile);
        $this->db->join('service_list sl', 'sl.id=sr.service_id', 'LEFT');
        $this->db->join('office_region r', 'r.id=sr.serv_region_id', 'LEFT');
        $this->db->order_by('sr.id', 'DESC');
        $query = $this->db->get()->result();  
        // echo $this->db->last_query(); exit;      

        return $query;
    }

    public function get_scout_application($id){
        $this->db->select('sga.*, r.region_name, r.region_name_en, od.dis_name, od.dis_name_en, od.dis_name_en, ou.upa_name, ou.upa_name_en');
        $this->db->from('scout_group_application sga');
        $this->db->join('office_upazila ou', 'ou.id = sga.upazila_id', 'LEFT');
        $this->db->join('office_district od', 'od.id = sga.district_id', 'LEFT');
        $this->db->join('office_region r', 'r.id = sga.region_id', 'LEFT');
        $this->db->where('sga.id', $id);
        $query = $this->db->get()->row();
        // echo $this->db->last_query(); exit;

        return $query;
    }

    public function get_user_info($id) {
        $this->db->select('u.id, u.blood_donate_interested, u.last_donate_date, u.scout_id, u.member_id, u.username, u.first_name, u.full_name_bn, u.father_name, u.father_name_bn, u.mother_name, u.mother_name_bn, u.gender, u.dob, u.nid, u.birth_id, u.phone, u.email, u.join_date, u.sc_section_id, u.created_on, u.last_login, u.is_verify, u.sc_badge_id, u.sc_role_id, u.profile_img, u.qr_img, u.occupation_id, u.occp_others, u.is_interested, u.phone_emergency, u.blood_group, u.is_request, u.is_verify, u.sc_section_id, u.sc_region_id, u.sc_district_id, u.sc_upa_tha_id, u.sc_group_id, u.sc_unit_id, u.full_name_bn, u.father_name_bn, u.mother_name_bn, u.phone2, u.phone_emergency, u.passport_no, u.religion_id, u.occp_others, u.sc_cub, u.sc_scout, u.sc_rover, u.pre_village_house, u.pre_village_house_bn, u.pre_road_block, u.pre_road_block_bn, u.pre_division_id, u.pre_district_id, u.pre_upa_tha_id, u.pre_post_office, u.per_village_house, u.per_road_block, u.per_division_id, u.per_district_id, u.per_upa_tha_id, u.per_post_office, u.curr_institute_id, u.curr_class,  u.curr_role_no, u.curr_org, u.curr_desig, u.expire_date, oc.occupation_name, bg.bg_name_en, bg.bg_name_bn, dv.div_name as pre_div_name, dv.div_name_bn as pre_div_name_bn, dv2.div_name as per_div_name, ds.district_name as pre_district_name, ds.district_name_bn as pre_district_name_bn, ds2.district_name as per_district_name, ut.up_th_name as pre_up_th_name, ut.up_th_name_bn as pre_up_th_name_bn, ut2.up_th_name as per_up_th_name, po.po_name as pre_po_name, po2.po_name as per_po_name, r.region_name, r.region_name_en, od.dis_name, od.dis_name_en, od.dis_name_en, ou.upa_name, ou.upa_name_en, og.grp_name, og.grp_name_bn, og.grp_address, unit.unit_name, bt.badge_type_name_bn, rt.role_type_name_bn, it.name as institute_name, mt.member_type_name, mt.member_type_name_bn');
        $this->db->from('users u');
        $this->db->join('blood_group bg', 'bg.id=u.blood_group', 'LEFT');
        $this->db->join('occupation oc', 'oc.id=u.occupation_id', 'LEFT');
        $this->db->join('upazila_thana ut', 'ut.id=u.pre_upa_tha_id', 'LEFT');
        $this->db->join('upazila_thana ut2', 'ut2.id=u.per_upa_tha_id', 'LEFT');
        $this->db->join('district ds', 'ds.id=u.pre_district_id', 'LEFT');
        $this->db->join('district ds2', 'ds2.id=u.per_district_id', 'LEFT');
        $this->db->join('division dv', 'dv.id=u.pre_division_id', 'LEFT');
        $this->db->join('division dv2', 'dv2.id=u.per_division_id', 'LEFT');
        $this->db->join('post_office po', 'po.id=u.pre_post_office', 'LEFT');
        $this->db->join('post_office po2', 'po2.id=u.per_post_office', 'LEFT');
        $this->db->join('office_unit unit', 'unit.id = u.sc_unit_id', 'LEFT');
        $this->db->join('office_groups og', 'og.id = u.sc_group_id', 'LEFT');
        $this->db->join('office_upazila ou', 'ou.id = u.sc_upa_tha_id', 'LEFT');
        $this->db->join('office_district od', 'od.id = u.sc_district_id', 'LEFT');
        $this->db->join('office_region r', 'r.id = u.sc_region_id', 'LEFT');
        $this->db->join('institute it', 'it.id = u.curr_institute_id', 'LEFT');
        $this->db->join('scout_badge sb', 'sb.id = u.sc_badge_id', 'LEFT');
        $this->db->join('badge_type bt', 'bt.id = sb.badge_type_id', 'LEFT');        
        $this->db->join('member_type mt', 'mt.id = u.member_id', 'LEFT');
        $this->db->join('scout_role so', 'so.id = u.sc_role_id', 'LEFT');
        $this->db->join('role_type rt', 'rt.id = so.role_type_id', 'LEFT');
        $this->db->where('u.scout_id', $id);

        $query = $this->db->get()->row();
        // echo $this->db->last_query(); exit;

        return $query;
    }

    public function get_pds_info($id){
        $this->db->select('u.*, bg.bg_name_en, bg.bg_name_bn, dp.department_name, dg.designation_name, dg.designation_name_en');
        $this->db->from('users u');
        $this->db->join('blood_group bg', 'bg.id = u.blood_group', 'LEFT');
        $this->db->join('department dp', 'dp.id = u.emp_department', 'LEFT'); 
        $this->db->join('designation dg', 'dg.id = u.emp_designation', 'LEFT'); 
        $this->db->where('u.pds_id', $id);
        $query = $this->db->get()->row();

        return $query;
    }

    public function get_id_from_scout_id($scoutID){
        $this->db->select('id, scout_id');
        $this->db->from('users');
        $this->db->limit(1);
        $this->db->where('scout_id', $scoutID);
        $query = $this->db->get()->row();
        // echo $this->db->last_query(); exit;
        return $query;
    }

    public function search_scout_groups($div, $dis) {

        $this->db->select('id, grp_name, grp_name_bn');
        $this->db->where('grp_region_id', $div); 
        if(!empty($dis)){
          $this->db->where('grp_scout_dis_id', $dis); 
        }
        $this->db->from('office_groups');
        $query = $this->db->get()->result();        

        return $query;
    }

    public function search_upa_thana($div, $dis) {

        $this->db->select('id, upa_name');
        $this->db->where('upa_region_id', $div); 
        if(!empty($dis)){
          $this->db->where('upa_scout_dis_id', $dis); 
        }
        $this->db->from('office_upazila');
        $query = $this->db->get()->result();        

        return $query;
    }

    public function get_pagination_data($limit = 1000, $offset = 0, $table) {
        // result query
        $this->db->select('*');
        $this->db->from($table);
        $this->db->limit($limit);
        $this->db->offset($offset);        
        $this->db->order_by('id', 'DESC');;
        $result['rows'] = $this->db->get()->result();

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from($table);
        
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;

        return $result;
    }

    public function get_scout_district($limit = 1000, $offset = 0, $region=NULL) {
        // result query
        $this->db->select('*');
        $this->db->from('office_district');
        $this->db->limit($limit);
        $this->db->offset($offset);        
        $this->db->order_by('id', 'DESC');
        if($region){
            $this->db->where('dis_scout_region_id', $region);
        }
        $result['rows'] = $this->db->get()->result();
        // echo $this->db->last_query(); exit;

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('office_district');
        if($region){
            $this->db->where('dis_scout_region_id', $region);
        }
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;

        return $result;
    }

    public function get_scout_upazila($limit = 1000, $offset = 0, $region=NULL, $sc_district=NULL) {
        // result query
        $this->db->select('*');
        $this->db->from('office_upazila');
        $this->db->limit($limit);
        $this->db->offset($offset);        
        $this->db->order_by('id', 'DESC');
        if($region){
            $this->db->where('upa_region_id', $region);
        }
        if($sc_district){
            $this->db->where('upa_scout_dis_id', $sc_district);
        }
        $result['rows'] = $this->db->get()->result();        
        // echo $this->db->last_query(); exit;

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('office_upazila');
        if($region){
            $this->db->where('upa_region_id', $region);
        }
        if($sc_district){
            $this->db->where('upa_scout_dis_id', $sc_district);
        }
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;

        return $result;
    }

    public function get_scout_group_list($limit = 1000, $offset = 0, $region=NULL, $sc_district=NULL, $sc_upazila=NULL, $name=NULL) {
        // result query
        $this->db->select('*');
        $this->db->from('office_groups');
        $this->db->limit($limit);
        $this->db->offset($offset);        
        $this->db->order_by('id', 'DESC');
        if($region){
            $this->db->where('grp_region_id', $region);
        }
        if($sc_district){
            $this->db->where('grp_scout_dis_id', $sc_district);
        }
        if($sc_upazila){
            $this->db->where('grp_scout_upa_id', $sc_upazila);
        }
        if($name != NULL){
            $this->db->like('grp_name', $name);
        }
        $result['rows'] = $this->db->get()->result();        
        // echo $this->db->last_query(); exit;

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('office_groups');
        if($region){
            $this->db->where('grp_region_id', $region);
        }
        if($sc_district){
            $this->db->where('grp_scout_dis_id', $sc_district);
        }
        if($sc_upazila){
            $this->db->where('grp_scout_upa_id', $sc_upazila);
        }
        if($name != NULL){
            $this->db->like('grp_name', $name);
        }
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;

        return $result;
    }

    public function get_scout_unit_list($limit = 1000, $offset = 0, $region=NULL, $sc_district=NULL, $sc_upazila=NULL, $sc_group=NULL) {
        // result query
        $this->db->select('*');
        $this->db->from('office_unit');
        $this->db->limit($limit);
        $this->db->offset($offset);        
        $this->db->order_by('id', 'DESC');
        if($region){
            $this->db->where('unit_region_id', $region);
        }
        if($sc_district){
            $this->db->where('unit_scout_dis_id', $sc_district);
        }
        if($sc_upazila){
            $this->db->where('unit_scout_upa_id', $sc_upazila);
        }
        if($sc_group){
            $this->db->where('unit_sc_grp_id', $sc_group);
        }
        $result['rows'] = $this->db->get()->result();        
        // echo $this->db->last_query(); exit;

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('office_unit');
        if($region){
            $this->db->where('unit_region_id', $region);
        }
        if($sc_district){
            $this->db->where('unit_scout_dis_id', $sc_district);
        }
        if($sc_upazila){
            $this->db->where('unit_scout_upa_id', $sc_upazila);
        }
        if($sc_group){
            $this->db->where('unit_sc_grp_id', $sc_group);
        }
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;

        return $result;
    }

    public function get_scout_group_info($id) {
        $this->db->select('og.*, r.region_name, od.dis_name, ou.upa_name, i.name, r.region_name_en, od.dis_name_en, ou.upa_name_en, i.name_bn');
        $this->db->from('office_groups og');
        $this->db->join('office_region r', 'r.id = og.grp_region_id', 'LEFT');
        $this->db->join('office_district od', 'od.id = og.grp_scout_dis_id', 'LEFT');
        $this->db->join('office_upazila ou', 'ou.id = og.grp_scout_upa_id', 'LEFT');        
        $this->db->join('institute i', 'i.id = og.grp_institute_id', 'LEFT');        
        $this->db->where('og.id', $id);
        $this->db->where('og.grp_status', 1);
        $query = $this->db->get();

        $num = $query->num_rows();
        if($num){
            $query = $query->row();
            return $query;
        }else{
            return false;
        }
    }

    public function get_scout_unit_info($id) {
        $this->db->select('u.*, r.region_name, od.dis_name, ou.upa_name, og.grp_name, og.grp_charter,r.region_name_en, od.dis_name_en, ou.upa_name_en, og.grp_name_bn,');
        $this->db->from('office_unit u');
        $this->db->join('office_groups og', 'og.id = u.unit_sc_grp_id', 'LEFT');
        $this->db->join('office_region r', 'r.id = u.unit_region_id', 'LEFT');
        $this->db->join('office_district od', 'od.id = u.unit_scout_dis_id', 'LEFT');
        $this->db->join('office_upazila ou', 'ou.id = u.unit_scout_upa_id', 'LEFT');        
        $this->db->where('u.id', $id);
        $this->db->where('u.unit_status', 1);
        $query = $this->db->get();

        $num = $query->num_rows();
        if($num){
            $query = $query->row();
            return $query;
        }else{
            return false;
        }
    }

     public function get_scount_upazila_info($id) {
        $this->db->select('ou.*, r.region_name, r.region_name_en, od.dis_name, od.dis_name_en');
        $this->db->from('office_upazila ou');
        $this->db->join('office_region r', 'r.id = ou.upa_region_id', 'LEFT');
        $this->db->join('office_district od', 'od.id = ou.upa_scout_dis_id', 'LEFT');
        $this->db->where('ou.id', $id);
        $this->db->where('ou.upa_status', 1);
        $query = $this->db->get();

        $num = $query->num_rows();
        if($num){
            $query = $query->row();
            return $query;
        }else{
            return false;
        }
    }

    public function get_scount_district_info($id) {
        $this->db->select('od.*, r.region_name,r.region_name_en');
        $this->db->from('office_district od');
        $this->db->join('office_region r', 'r.id = od.dis_scout_region_id', 'LEFT');
        $this->db->where('od.id', $id);
        $this->db->where('od.dis_status', 1);
        $query = $this->db->get();

        $num = $query->num_rows();
        if($num){
            $query = $query->row();
            return $query;
        }else{
            return false;
        }
    }

    public function get_region_info($id) {
        $this->db->from('office_region');
        $this->db->where('id', $id);
        $this->db->where('region_status', 1);
        $query = $this->db->get();

        $num = $query->num_rows();
        if($num){
            $query = $query->row();
            return $query;
        }else{
            return false;
        }
    }

    public function get_region_image_gallery($id) {
        $this->db->select('id, ig_file_name');
        $this->db->from('image_gallery');
        $this->db->where('ig_region_id', $id);        
        $query = $this->db->get()->result();
        
        return $query;
    }

    public function get_district_image_gallery($id) {
        $this->db->select('id, ig_file_name');
        $this->db->from('image_gallery');
        $this->db->where('ig_district_id', $id);        
        $query = $this->db->get()->result();
        
        return $query;
    }

    public function get_upazila_image_gallery($id) {
        $this->db->select('id, ig_file_name');
        $this->db->from('image_gallery');
        $this->db->where('ig_upazila_id', $id);        
        $query = $this->db->get()->result();
        
        return $query;
    }

    public function get_group_image_gallery($id) {
        $this->db->select('id, ig_file_name');
        $this->db->from('image_gallery');
        $this->db->where('ig_group_id', $id);        
        $query = $this->db->get()->result();
        
        return $query;
    }


    public function get_listing($office_level=NULL, $designation=NULL, $region=NULL, $sc_district=NULL, $sc_upazila=NULL, $sc_group=NULL, $tc_id=NULL) {
        // result query
        $this->db->select('e.*, o.office_type_name, d.committee_designation_name, d.committee_designation_name_en, u.profile_img, t.tc_name');
        $this->db->from('edirectory e');
        $this->db->join('office_type o', 'o.id = e.office_level', 'LEFT');
        $this->db->join('edirectory_designation d', 'd.id = e.scout_desig_id', 'LEFT');
        $this->db->join('users u', 'u.id = e.scout_id', 'LEFT');
        $this->db->join('training_center t', 't.id = e.tc_id', 'LEFT');
        $this->db->where('e.status', 1);
        // $this->db->order_by('id', 'DESC');

        if($office_level){
            $this->db->where('e.office_level', $office_level);            
        }
        if($designation){
            $this->db->where('e.scout_desig_id', $designation);            
        }
        if($region){
            $this->db->where('e.sc_region_id', $region);            
        }
        if($sc_district){
            $this->db->where('e.sc_district_id', $sc_district);            
        }
        if($sc_upazila){
            $this->db->where('e.sc_upzaila_id', $sc_upazila);            
        }
        if($sc_group){
            $this->db->where('e.sc_group_id', $sc_group);            
        } 
        if($tc_id){
            $this->db->where('e.tc_id', $tc_id);            
        }        

        $result = $this->db->get()->result();        
        // echo $this->db->last_query(); exit;

        return $result;
    }

    public function get_listing_search($office_level=NULL, $designation=NULL, $region=NULL, $sc_district=NULL, $sc_upazila=NULL, $sc_group=NULL, $tc_id=NULL) {
        // result query
        $this->db->select('e.*, o.office_type_name, d.committee_designation_name, d.committee_designation_name_en, u.profile_img, t.tc_name');
        $this->db->from('edirectory e');
        $this->db->join('office_type o', 'o.id = e.office_level', 'LEFT');
        $this->db->join('edirectory_designation d', 'd.id = e.scout_desig_id', 'LEFT');
        $this->db->join('users u', 'u.id = e.scout_id', 'LEFT');
        $this->db->join('training_center t', 't.id = e.tc_id', 'LEFT');
        $this->db->where('e.status', 1);
        // $this->db->order_by('id', 'DESC');

        if($this->input->get('name') != NULL){
            $this->db->like('e.name', $this->input->get('name'));
        }
        if($this->input->get('mobile') != NULL){
            $this->db->like('e.phone', $this->input->get('mobile'));
        }
        if($this->input->get('email') != NULL){
            $this->db->like('e.email', $this->input->get('email'));
        }


        if($this->input->get('group') > 0){
            $this->db->where('e.sc_group_id', $this->input->get('group'));       
            $this->db->where('e.office_level', 5);        
        }elseif($this->input->get('upazila') > 0){
            $this->db->where('e.sc_upzaila_id', $this->input->get('upazila'));  
            $this->db->where('e.office_level', 4);             
        }elseif($this->input->get('district') > 0){
            $this->db->where('e.sc_district_id', $this->input->get('district'));
            $this->db->where('e.office_level', 3);               
        }elseif($this->input->get('region') != NULL){
            $this->db->where('e.sc_region_id', $this->input->get('region'));   
            $this->db->where('e.office_level', 2);   
        }
        

        $this->db->where('e.status', 1);
        $result = $this->db->get()->result();        
        // echo $this->db->last_query(); exit;

        return $result;
    }

}
