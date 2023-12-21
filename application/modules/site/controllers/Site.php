<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include 'classes/BanglaConverter.php';

class Site extends Frontend_Controller {

	function __construct (){
		parent::__construct();
        // print_r($this->session->all_userdata());   
        // print_r($this->lang);
        $this->load->model('dashboard/Dashboard_model'); 
        $this->load->model('offices/Offices_model'); 

        // comment this this line shahajahan 20-12-2023
        // Dropdown  
        // $this->data['regions'] = $this->Common_model->get_regions();
        // $this->data['districts'] = $this->Common_model->get_scout_districts();
        // $this->data['upazilas'] = $this->Common_model->get_scout_upazila_thana();
        // comment this this line shahajahan 20-12-2023
    }        

    public function index(){

        // $result = $this->Dashboard_model->get_count_online_register();          
        // $this->data['total_online_register'] = $result['count'];
        //Today
        //$result = $this->Dashboard_model->get_count_online_register_today();          
        //$this->data['total_online_register_today'] = $result['count'];            
        //This Month
        //$result = $this->Dashboard_model->get_count_online_register_this_month();         
        //$this->data['total_online_register_today'] = $result['count'];

        //Total Online Member
        // $result = $this->Dashboard_model->get_count_online_members();           
        // $this->data['total_online_member'] = $result['count'];
        // $result = $this->Dashboard_model->get_count_online_members_by_gender('Male');           
        // $this->data['total_online_member_male'] = $result['count'];
        // $result = $this->Dashboard_model->get_count_online_members_by_gender('Female');         
        // $this->data['total_online_member_female'] = $result['count'];
        // $result = $this->Dashboard_model->get_count_online_members_by_gender('Others');         
        // $this->data['total_online_member_others'] = $result['count'];

        //Total Online Member by Member Type
        // $result = $this->Dashboard_model->get_count_by_member_type(1);          
        // $this->data['total_new_applicant'] = $result['count'];
        // $result = $this->Dashboard_model->get_count_by_member_type(2);          
        // $this->data['total_scout'] = $result['count'];
        // $result = $this->Dashboard_model->get_count_by_member_type(8);          
        // $this->data['total_adult_leader'] = $result['count'];
        // $result = $this->Dashboard_model->get_count_by_member_type(9);          
        // $this->data['total_professional'] = $result['count'];
        // $result = $this->Dashboard_model->get_count_by_member_type(10);         
        // $this->data['total_non_warrent'] = $result['count'];
        // $result = $this->Dashboard_model->get_count_by_member_type(12);         
        // $this->data['total_warrent'] = $result['count'];
        // $result = $this->Dashboard_model->get_count_by_member_type(13);         
        // $this->data['total_support_staff'] = $result['count'];

        //Online Member Percent statistics
        // $this->data['new_applicant_percent'] = round(($this->data['total_new_applicant']*100)/$this->data['total_online_member'], 2); 
        // $this->data['scout_percent'] = round(($this->data['total_scout']*100)/$this->data['total_online_member'], 2);
        // $this->data['adult_leader_percent'] = round(($this->data['total_adult_leader']*100)/$this->data['total_online_member'], 2);
        // $this->data['professional_percent'] = round(($this->data['total_professional']*100)/$this->data['total_online_member'], 2);
        // $this->data['non_warren_percent'] = round(($this->data['total_non_warrent']*100)/$this->data['total_online_member'], 2);
        // $this->data['warrent_percent'] = round(($this->data['total_warrent']*100)/$this->data['total_online_member'], 2);
        // $this->data['support_staff_percent'] = round(($this->data['total_support_staff']*100)/$this->data['total_online_member'], 2);
        // exit;
        // echo $total_online_member;

        //Event
        // $result = $this->Dashboard_model->get_count_event_total();          
        // $this->data['total_event'] = $result['count'];
        // $result = $this->Dashboard_model->get_count_event_total_by_level('nhq');            
        // $this->data['total_event_nhq'] = $result['count'];
        // $result = $this->Dashboard_model->get_count_event_total_by_level('region');         
        // $this->data['total_event_region'] = $result['count'];
        // $result = $this->Dashboard_model->get_count_event_total_by_level('district');           
        // $this->data['total_event_district'] = $result['count'];

        //Total Region
        // $result = $this->Dashboard_model->get_count_online_member_by_region(1);         
        // $this->data['total_member_region_dhk'] = $result['count'];
        // $result = $this->Dashboard_model->get_count_online_member_by_region(2);         
        // $this->data['total_member_region_ctg'] = $result['count'];
        // $result = $this->Dashboard_model->get_count_online_member_by_region(3);         
        // $this->data['total_member_region_raj'] = $result['count'];
        // $result = $this->Dashboard_model->get_count_online_member_by_region(4);         
        // $this->data['total_member_region_khl'] = $result['count'];
        // $result = $this->Dashboard_model->get_count_online_member_by_region(5);         
        // $this->data['total_member_region_bar'] = $result['count'];
        // $result = $this->Dashboard_model->get_count_online_member_by_region(6);         
        // $this->data['total_member_region_syl'] = $result['count'];
        // $result = $this->Dashboard_model->get_count_online_member_by_region(7);         
        // $this->data['total_member_region_cum'] = $result['count'];
        // $result = $this->Dashboard_model->get_count_online_member_by_region(8);         
        // $this->data['total_member_region_din'] = $result['count'];
        // $result = $this->Dashboard_model->get_count_online_member_by_region(9);         
        // $this->data['total_member_region_may'] = $result['count'];
        // $result = $this->Dashboard_model->get_count_online_member_by_region(10);            
        // $this->data['total_member_region_rov'] = $result['count'];
        // $result = $this->Dashboard_model->get_count_online_member_by_region(11);            
        // $this->data['total_member_region_ral'] = $result['count'];
        // $result = $this->Dashboard_model->get_count_online_member_by_region(12);            
        // $this->data['total_member_region_nav'] = $result['count'];
        // $result = $this->Dashboard_model->get_count_online_member_by_region(13);            
        // $this->data['total_member_region_air'] = $result['count'];


     //Censes Statistics
        // $result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 1, 'Male');
        // $this->data['count_cub_scout_m'] = $result['count'];
        // $result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 2, 'Male');
        // $this->data['count_scout_m'] = $result['count'];
        // $result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 3, 'Male');
        // $this->data['count_rober_scout_m'] = $result['count'];

        // $result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 1, 'Female');
        // $this->data['count_cub_scout_f'] = $result['count'];
        // $result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 2, 'Female');
        // $this->data['count_scout_f'] = $result['count'];
        // $result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 3, 'Female');
        // $this->data['count_rober_scout_f'] = $result['count'];

        // $result = $this->Dashboard_model->get_censes_by_member_id_gender(8, 'Male');
        // $this->data['scouter_s_m'] = $result['count'];
        // $result = $this->Dashboard_model->get_censes_by_member_id_gender(10,'Male');
        // $this->data['non_warrant_m'] = $result['count'];
        // $result = $this->Dashboard_model->get_censes_by_member_id_gender(12,'Male');
        // $this->data['warrant_m'] = $result['count'];
        // $result = $this->Dashboard_model->get_censes_by_member_id_gender(9,'Male');
        // $this->data['professional_scouts_m'] = $result['count'];
        // $result = $this->Dashboard_model->get_censes_by_member_id_gender(13,'Male');
        // $this->data['support_staff_m'] = $result['count'];          

        // $result = $this->Dashboard_model->get_censes_by_member_id_gender(8,'Female');
        // $this->data['scouter_s_f'] = $result['count'];
        // $result = $this->Dashboard_model->get_censes_by_member_id_gender(10,'Female');
        // $this->data['non_warrant_f'] = $result['count'];
        // $result = $this->Dashboard_model->get_censes_by_member_id_gender(12,'Female');
        // $this->data['warrant_f'] = $result['count'];
        // $result = $this->Dashboard_model->get_censes_by_member_id_gender(9,'Female');
        // $this->data['professional_scouts_f'] = $result['count'];
        // $result = $this->Dashboard_model->get_censes_by_member_id_gender(13,'Female');
        // $this->data['support_staff_f'] = $result['count'];

        //view
        $this->data['meta_title'] = 'Home';
        $this->data['subview'] = 'service';
        $this->load->view('frontend/_layout_main', $this->data);
    }

    public function index2(){ 
        // View
        $this->data['meta_title'] = 'Home';        
        $this->data['subview'] = 'index';
        $this->load->view('frontend/_layout_main', $this->data);
    }

    public function ebook(){

        $this->data['ebook_cub_list'] = $this->Site_model->get_ebook_category(1);
        // echo '<pre>';
        // print_r($this->data['ebook_cub_list']); exit;
        $this->data['ebook_scout_list'] = $this->Site_model->get_ebook_category(2);
        $this->data['ebook_rover_list'] = $this->Site_model->get_ebook_category(3);
        $this->data['ebook_adult_list'] = $this->Site_model->get_ebook_category(4);
        $this->data['ebook_other_list'] = $this->Site_model->get_ebook_category(5);

        // Load View
        $this->data['meta_title'] = 'E-Book';        
        $this->data['subview'] = 'ebook';
        $this->load->view('frontend/_layout_main', $this->data);
    }

    function ajax_get_book_details($id){
        // echo $id; exit;
        // print_r($this->Site_model->get_ebook_details($id)); exit;
        header('Content-Type: application/x-json; charset=utf-8');
        // echo $this->Site_model->get_ebook_details($id); exit;
        echo (json_encode($this->Site_model->get_ebook_details($id))); //exit;
    }

    public function edirectory(){ 
        // View
        $this->data['meta_title'] = 'Bangladesh Scouts E-Directory';        
        $this->data['subview'] = 'edirectory';
        $this->load->view('frontend/_layout_main', $this->data);
    }

    public function edirectory_search($terms=NULL){ 

        //echo $terms; exit;

        $this->data['results'] = $this->Site_model->get_listing_search();

        // print_r($this->data['results']); exit;

        // print_r(expression)

        // View
        $this->data['meta_title'] = 'Bangladesh Scouts E-Directory';        
        $this->data['subview'] = 'edirectory_search';
        $this->load->view('frontend/_layout_main', $this->data);
    }

    public function edirectory_nhq(){ 
        $this->data['results'] = 0;
        $data_arr = [];
        // if($this->input->get('designation')){
        //     $this->data['results'] = $this->Site_model->get_listing(1, $this->input->get('designation'));
        // }

        // Dropdown
        // $this->data['regions'] = $this->Common_model->get_regions();
        // $this->data['districts'] = $this->Common_model->get_scout_districts();
        // $this->data['upazilas'] = $this->Common_model->get_scout_upazila_thana();
        // $this->data['designations'] = $this->Common_model->get_comm_designation_by_office(1); 
        $this->data['designations'] = $this->Common_model->get_edirectory_designation(1);

        // Count contact
        foreach ($this->data['designations'] as $item) {
            $data_arr[$item->id]['contact_count'] = count($this->Site_model->get_listing(1, $item->id));
        }
        $this->data['result_data'] = $data_arr;

        // for ( $i=0; $i < count($this->data['designations']); $i++) {
        //     # code...
        // }$this->Reports_model->get_count_representative($data_sheet_type, $this->input->post('office_type'), $item->id);

        // View
        $this->data['meta_title'] = 'E-Directory NHQ';        
        $this->data['subview'] = 'edirectory_nhq';
        $this->load->view('frontend/_layout_main', $this->data);
    }

    public function edirectory_training_center(){ 

        $this->data['results'] = 0;

        if($this->input->get('designation')){
            $this->data['results'] = $this->Site_model->get_listing(6, '', '', '', '', '', $this->input->get('designation'));
        }

        // Dropdown
        // $this->data['regions'] = $this->Common_model->get_regions();
        // $this->data['districts'] = $this->Common_model->get_scout_districts();
        // $this->data['upazilas'] = $this->Common_model->get_scout_upazila_thana();
        $this->data['designations'] = $this->Common_model->get_training_centers();    

        // View
        $this->data['meta_title'] = 'E-Directory Training Center';        
        $this->data['subview'] = 'edirectory_training_center';
        $this->load->view('frontend/_layout_main', $this->data);
    }

    public function edirectory_region($region_id){ 

        $this->data['results'] = 0;
        $data_arr = [];

        $this->data['info'] = $this->Site_model->get_region_info($region_id); 
        if($this->data['info'] == FALSE){
            redirect('not-found');
        }

        // print_r($this->data['info']); exit;

        // Dropdown List
        $this->data['office_list'] = $this->Offices_model->get_scout_district($region_id);
        $this->data['designations'] = $this->Common_model->get_edirectory_designation(2); 

        // Count contact
        foreach ($this->data['designations'] as $item) {
            $data_arr[$item->id]['contact_count'] = count($this->Site_model->get_listing(2, $item->id, $region_id));
        }
        $this->data['result_data'] = $data_arr;

        // View
        $this->data['meta_title'] = 'E-Directory '.$this->data['info']->region_name_en;        
        $this->data['subview'] = 'edirectory_region';
        // $this->data['subview'] = 'edirectory_nhq';
        $this->load->view('frontend/_layout_main', $this->data);
    }

    public function edirectory_district($district_id){ 
        $this->data['results'] = 0;
        $data_arr = [];

        $this->data['info'] = $this->Site_model->get_scount_district_info($district_id); 
        if($this->data['info'] == FALSE){
            redirect('not-found');
        } 
        $this->data['office_list'] = $this->Offices_model->get_scout_upazila('', $district_id);
        $this->data['designations'] = $this->Common_model->get_edirectory_designation(3); 

        // Count contact
        foreach ($this->data['designations'] as $item) {
            $data_arr[$item->id]['contact_count'] = count($this->Site_model->get_listing(3, $item->id, '', $district_id));
        }
        $this->data['result_data'] = $data_arr;

        // View
        $this->data['meta_title'] = 'E-Directory '.$this->data['info']->dis_name_en;        
        $this->data['subview'] = 'edirectory_district';
        // $this->data['subview'] = 'edirectory_nhq';
        $this->load->view('frontend/_layout_main', $this->data);
    }

    public function edirectory_upazila($upazila_id){ 
        $this->data['results'] = 0;
        $data_arr = [];

        $this->data['info'] = $this->Site_model->get_scount_upazila_info($upazila_id); 
        if($this->data['info'] == FALSE){
            redirect('not-found');
        } 
        // $this->data['office_list'] = $this->Offices_model->get_scout_upazila('', $upazila_id);
        $result = $this->Offices_model->get_scout_group($limit=1000, $offset=0, '', '', $upazila_id);
        $this->data['office_list'] = $result['rows'];
        $this->data['designations'] = $this->Common_model->get_edirectory_designation(4); 

        // Count contact
        foreach ($this->data['designations'] as $item) {
            $data_arr[$item->id]['contact_count'] = count($this->Site_model->get_listing(4, $item->id, '', '', $upazila_id));
        }
        $this->data['result_data'] = $data_arr;

        // View
        $this->data['meta_title'] = 'E-Directory '.$this->data['info']->upa_name_en;        
        $this->data['subview'] = 'edirectory_upazila';
        // $this->data['subview'] = 'edirectory_nhq';
        $this->load->view('frontend/_layout_main', $this->data);
    }

    public function edirectory_scouts_group($id){ 
        $this->data['results'] = 0;
        $data_arr = [];

        $this->data['info'] = $this->Site_model->get_scout_group_info($id); 
        if($this->data['info'] == FALSE){
            redirect('not-found');
        } 
        // $this->data['office_list'] = $this->Offices_model->get_scout_upazila('', $upazila_id);
        $result = $this->Offices_model->get_scout_group($limit=1000, $offset=0, '', '', $id);
        $this->data['office_list'] = $result['rows'];
        $this->data['designations'] = $this->Common_model->get_edirectory_designation(5); 

        // Count contact
        foreach ($this->data['designations'] as $item) {
            $data_arr[$item->id]['contact_count'] = count($this->Site_model->get_listing(5, $item->id, '', '', '', $id));
        }
        $this->data['result_data'] = $data_arr;

        // View
        $this->data['meta_title'] = 'E-Directory '.$this->data['info']->grp_name;        
        $this->data['subview'] = 'edirectory_scouts_group';
        // $this->data['subview'] = 'edirectory_nhq';
        $this->load->view('frontend/_layout_main', $this->data);
    }


    public function edirectory_nhq_listing($designation_id){ 
        $this->data['results'] = $this->Site_model->get_listing(1, $designation_id);

        // View
        $this->data['meta_title'] = 'E-Directory NHQ Contact List';        
        $this->data['subview'] = 'edirectory_nhq_listing';
        $this->load->view('frontend/_layout_main', $this->data);
    }

    public function edirectory_region_listing($region_id, $designation_id){ 
        $this->data['info'] = $this->Site_model->get_region_info($region_id); 
        $this->data['results'] = $this->Site_model->get_listing(2, $designation_id, $region_id);

        // View
        $this->data['meta_title'] = 'E-Directory '.$this->data['info']->region_name_en.' Contact';
        $this->data['subview'] = 'edirectory_region_listing';
        $this->load->view('frontend/_layout_main', $this->data);
    }

    public function edirectory_district_listing($district_id, $designation_id){ 
        $this->data['info'] = $this->Site_model->get_scount_district_info($district_id); 
        $this->data['results'] = $this->Site_model->get_listing(3, $designation_id, '', $district_id);

        // View
        $this->data['meta_title'] = 'E-Directory '.$this->data['info']->dis_name_en .' Contact';
        $this->data['subview'] = 'edirectory_district_listing';
        $this->load->view('frontend/_layout_main', $this->data);
    }

    public function edirectory_upazila_listing($upazila_id, $designation_id){ 
        $this->data['info'] = $this->Site_model->get_scount_upazila_info($upazila_id); 
        $this->data['results'] = $this->Site_model->get_listing(4, $designation_id, '', '', $upazila_id);

        // View
        $this->data['meta_title'] = 'E-Directory '.$this->data['info']->upa_name_en .' Contact';
        $this->data['subview'] = 'edirectory_upazila_listing';
        $this->load->view('frontend/_layout_main', $this->data);
    }

    public function edirectory_sgroup_listing($group_id, $designation_id){ 
        $this->data['info'] = $this->Site_model->get_scout_group_info($group_id); 
        $this->data['results'] = $this->Site_model->get_listing(5, $designation_id, '', '', '', $group_id);

        // View
        $this->data['meta_title'] = 'E-Directory '.$this->data['info']->grp_name .' Contact';
        $this->data['subview'] = 'edirectory_sgroup_listing';
        $this->load->view('frontend/_layout_main', $this->data);
    }

    public function edirectory_details($id){ 

        $this->data['result'] = $this->Site_model->get_contact_details($id);

        // View
        $this->data['meta_title'] = 'E-Directory Contact Details';        
        $this->data['subview'] = 'edirectory_details';
        $this->load->view('frontend/_layout_main', $this->data);
    }



    

    

    

    // public function edirectory_district(){ 
    //     $this->data['results'] = 0;

    //     if($this->input->get('region') && $this->input->get('district')){
    //         $this->data['results'] = $this->Site_model->get_listing(3, $this->input->get('designation'), $this->input->get('region'), $this->input->get('district'));
    //     }

    //     // Dropdown
    //     $this->data['regions'] = $this->Common_model->get_regions();
    //     $this->data['districts'] = $this->Common_model->get_scout_districts();
    //     // $this->data['upazilas'] = $this->Common_model->get_scout_upazila_thana();
    //     $this->data['designations'] = $this->Common_model->get_comm_designation_by_office(4); 

    //     // View
    //     $this->data['meta_title'] = 'E-Directory Upazila';        
    //     $this->data['subview'] = 'edirectory_district';
    //     $this->load->view('frontend/_layout_main', $this->data);
    // }

    // public function edirectory_upazila(){ 
    //     $this->data['results'] = 0;

    //     if($this->input->get('region') && $this->input->get('district')){
    //         $this->data['results'] = $this->Site_model->get_listing(4, $this->input->get('designation'), $this->input->get('region'), $this->input->get('district'), $this->input->get('upazila'));
    //     }

    //     // Dropdown
    //     $this->data['regions'] = $this->Common_model->get_regions();
    //     $this->data['districts'] = $this->Common_model->get_scout_districts();
    //     $this->data['upazilas'] = $this->Common_model->get_scout_upazila_thana();
    //     $this->data['designations'] = $this->Common_model->get_comm_designation_by_office(4); 

    //     // View
    //     $this->data['meta_title'] = 'E-Directory Upazila';        
    //     $this->data['subview'] = 'edirectory_upazila';
    //     $this->load->view('frontend/_layout_main', $this->data);
    // }

    // public function edirectory_scouts_group(){ 
    //     $this->data['results'] = 0;

    //     if($this->input->get('region') && $this->input->get('district') && $this->input->get('group')){
    //         $this->data['results'] = $this->Site_model->get_listing(5, $this->input->get('designation'), $this->input->get('region'), $this->input->get('district'), $this->input->get('upazila'), $this->input->get('group'));
    //     }

    //     // Dropdown
    //     $this->data['regions'] = $this->Common_model->get_regions();
    //     $this->data['districts'] = $this->Common_model->get_scout_districts();
    //     $this->data['upazilas'] = $this->Common_model->get_scout_upazila_thana();
    //     $this->data['designations'] = $this->Common_model->get_comm_designation_by_office(5); 

    //     // View
    //     $this->data['meta_title'] = 'E-Directory Scouts Group';        
    //     $this->data['subview'] = 'edirectory_scouts_group';
    //     $this->load->view('frontend/_layout_main', $this->data);
    // }

    public function service(){
        //view
        $this->data['meta_title'] = 'Service';
        $this->data['subview'] = 'service';
        $this->load->view('frontend/_layout_main', $this->data);
    }

    public function region(){   
        $this->data['info'] = $this->Common_model->get_data('office_region'); 

        $this->data['meta_title'] = lang('site_meta_title_scout_region');        
        $this->data['subview'] = 'region';
        $this->load->view('frontend/_layout_main', $this->data);
    } 

    public function region_details($id){   
        $this->data['info'] = $this->Site_model->get_region_info($id); 
        if($this->data['info'] == FALSE){
            redirect('not-found');
        }

        // User List
        $this->data['user_list'] = $this->Offices_model->get_office_users(2, $id); 
        $this->data['office_list'] = $this->Offices_model->get_scout_district($id);
        // $this->data['office_list'] = $this->Offices_model->get_scout_upazila('', $id);
        // $this->data['office_list'] = $this->Offices_model->get_scout_group($limit=1000, $offset=0, '', '', $id);

        //$this->data['image_gallery'] = $this->Site_model->get_region_image_gallery($id);         
        //$title= $this->session->userdata('site_lang')=='bangla'?$this->data['info']->region_name:$this->data['info']->region_name_en;
        $this->data['meta_title'] = lang('site_meta_title_scout_region_details');        
        $this->data['subview'] = 'region_details';
        $this->load->view('frontend/_layout_main', $this->data);
    }

    public function district($offset=0){
        $limit = 15;

        if($this->input->get('dRegion')){
            $results = $this->Site_model->get_scout_district($limit, $offset, $this->input->get('dRegion'));
        }else{
            $results = $this->Site_model->get_scout_district($limit, $offset);
        }

        // $results = $this->Site_model->get_pagination_data($limit, $offset, 'office_district');
        // print_r($results); exit;

        //pagination
        $this->data['info'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];
        $this->data['pagination'] = create_pagination_site('district/', $this->data['total_rows'], $limit, 2, $full_tag_wrap = true);
        $this->data['regions'] = $this->Common_model->get_site_regions();

        // Lode View
        $this->data['meta_title'] = lang('site_meta_title_scout_district');   
        $this->data['subview'] = 'district';
        $this->load->view('frontend/_layout_main', $this->data);
    } 

    public function district_details($id){        
        $this->data['info'] = $this->Site_model->get_scount_district_info($id); 
        if($this->data['info'] == FALSE){
            redirect('not-found');
        } 
        //$this->data['image_gallery'] = $this->Site_model->get_district_image_gallery($id);         
        //$title= $this->session->userdata('site_lang')=='bangla'?$this->data['info']->dis_name:$this->data['info']->dis_name_en;

        $this->data['user_list'] = $this->Offices_model->get_office_users(3, $id); 
        $this->data['office_list'] = $this->Offices_model->get_scout_upazila('', $id);
        // print_r($this->data['office_list']);
        // exit;

        // Load View
        $this->data['meta_title'] = lang('site_meta_title_scout_district_details');
        $this->data['subview'] = 'district_details';
        $this->load->view('frontend/_layout_main', $this->data);
    }    

    public function upazila($offset=0){
        $limit = 15;

        if($this->input->get('uRegion') && $this->input->get('uDistrict')){
            $results = $this->Site_model->get_scout_upazila($limit, $offset, $this->input->get('uRegion'), $this->input->get('uDistrict'));
        }else{
            $results = $this->Site_model->get_scout_upazila($limit, $offset);
        }

        // print_r($results); exit;
        
        //pagination
        $this->data['info'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];
        $this->data['pagination'] = create_pagination_site('upazila/', $this->data['total_rows'], $limit, 2, $full_tag_wrap = true);   

        $this->data['regions'] = $this->Common_model->get_regions();
        $this->data['districts'] = $this->Common_model->get_scout_districts(); 

        //Load View
        $this->data['meta_title'] = lang('site_meta_title_scout_upazila');  
        $this->data['subview'] = 'upazila';
        $this->load->view('frontend/_layout_main', $this->data);
    }

    public function upazila_details($id){   
        $id = (int) $id;
        $this->data['info'] = $this->Site_model->get_scount_upazila_info($id); 
        if($this->data['info'] == FALSE){
            redirect('not-found');
        }

        $this->data['user_list'] = $this->Offices_model->get_office_users(4, $id); 
        $result = $this->Offices_model->get_scout_group($limit=1000, $offset=0, '', '', $id);
        $this->data['office_list'] = $result['rows'];
        // echo '<pre>';
        // print_r($this->data['office_list']); exit;

        //load view
        $this->data['meta_title'] = lang('site_meta_title_scout_upazila_details');
        $this->data['subview'] = 'upazila_details';
        $this->load->view('frontend/_layout_main', $this->data);
    }

    public function groups($offset=0){
        $limit = 15;

        if($this->input->get('gRegion') || $this->input->get('gDistrict') || $this->input->get('gName')){
            $results = $this->Site_model->get_scout_group_list($limit, $offset, $this->input->get('gRegion'), $this->input->get('gDistrict'), $this->input->get('gUpazila'), $this->input->get('gName'));
        }else{
            $results = $this->Site_model->get_scout_group_list($limit, $offset);
        }

        // $results = $this->Site_model->get_pagination_data($limit, $offset, 'office_groups');
        // print_r($results); exit;

        //pagination
        $this->data['info'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];
        $this->data['pagination'] = create_pagination_site('groups/', $this->data['total_rows'], $limit, 2, $full_tag_wrap = true);

        $this->data['regions'] = $this->Common_model->get_regions();
        $this->data['districts'] = $this->Common_model->get_scout_districts();
        $this->data['upazilas'] = $this->Common_model->get_scout_upazila_thana(); 


        //Load View
        $this->data['meta_title'] = lang('site_meta_title_scout_group');      
        $this->data['subview'] = 'group';
        $this->load->view('frontend/_layout_main', $this->data);
    } 

    public function group_details($id){   
        $id = (int) $id;
        $this->data['info'] = $this->Site_model->get_scout_group_info($id); 
        if($this->data['info'] == FALSE){
            redirect('not-found');
        }
        // $this->data['image_gallery'] = $this->Site_model->get_group_image_gallery($id);         
        //$title= $this->session->userdata('site_lang')=='bangla'?$this->data['info']->grp_name_bn:$this->data['info']->grp_name;
        $this->data['user_list'] = $this->Offices_model->get_office_users(5, $id);   
        $this->data['office_list'] = $this->Offices_model->get_scout_unit_by_group_office_id($id);

        //Load View
        $this->data['meta_title'] = lang('site_meta_title_scout_group_details');
        $this->data['subview'] = 'group_details';
        $this->load->view('frontend/_layout_main', $this->data);
    }

    public function unit($offset=0){
        $limit = 15;

        if($this->input->get('unRegion') && $this->input->get('unDistrict')){
            $results = $this->Site_model->get_scout_unit_list($limit, $offset, $this->input->get('unRegion'), $this->input->get('unDistrict'), $this->input->get('unUpazila'), $this->input->get('unGroup'));
        }else{
            $results = $this->Site_model->get_scout_unit_list($limit, $offset);
        }

        // $results = $this->Site_model->get_pagination_data($limit, $offset, 'office_unit');
        // print_r($results); exit;

        //pagination
        $this->data['info'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];
        $this->data['pagination'] = create_pagination_site('unit/', $this->data['total_rows'], $limit, 2, $full_tag_wrap = true);   

        $this->data['regions'] = $this->Common_model->get_regions();
        $this->data['districts'] = $this->Common_model->get_scout_districts();
        $this->data['upazilas'] = $this->Common_model->get_scout_upazila_thana(); 

        //Load View
        $this->data['meta_title'] = lang('site_meta_title_scout_unit');       
        $this->data['subview'] = 'unit';
        $this->load->view('frontend/_layout_main', $this->data);
    } 

    public function unit_details($id){   
        $id = (int) $id;
        $this->data['info'] = $this->Site_model->get_scout_unit_info($id); 
        if($this->data['info'] == FALSE){
            redirect('not-found');
        }

        $title= $this->session->userdata('site_lang')=='bangla'?$this->data['info']->unit_name_bn:$this->data['info']->unit_name;
        $this->data['meta_title'] = lang('site_meta_title_scout_unit_details').': <em>'.$title.'</em>';

        //Load View
        $this->data['subview'] = 'unit_details';
        $this->load->view('frontend/_layout_main', $this->data);
    }

    public function scout_department(){
        $this->data['meta_title'] = 'Bangladesh Scout Department';
        $this->data['subview'] = 'department';
        $this->load->view('frontend/_layout_main', $this->data);
    } 

    public function scout_news(){
        $this->data['results'] = $this->Site_model->get_news_data(); 

        $this->data['meta_title'] = lang('site_news');
        $this->data['subview'] = 'scout_news';
        $this->load->view('frontend/_layout_main', $this->data);
    } 

    public function scout_news_details($id){
        $this->data['info'] = $this->Site_model->get_news_details($id); 

        if($this->data['info'] == FALSE){
            redirect('not-found');
        }

        $this->data['meta_title'] = lang('site_news_details');
        $this->data['subview'] = 'news_details';
        $this->load->view('frontend/_layout_main', $this->data);
    } 

    public function scout_events(){
        $this->data['results'] = $this->Site_model->get_events_data(); 

        $this->data['meta_title'] = lang('site_events_title');
        $this->data['subview'] = 'events';
        $this->load->view('frontend/_layout_main', $this->data);
    } 

    public function scout_event_details($id){
        // if($this->data['info'] == FALSE){
        //     redirect('not-found');
        // }

        $this->data['info'] = $this->Site_model->get_event_details($id); 
        $this->data['attachments'] = $this->Site_model->get_attachment($id);
        

        $this->data['meta_title'] = lang('site_event_details_details');
        $this->data['subview'] = 'event_details';
        $this->load->view('frontend/_layout_main', $this->data);
    } 

    public function national_committee(){
        $this->data['meta_title'] = 'Bangladesh Scout National Committee';
        $this->data['subview'] = 'national_committee';
        $this->load->view('frontend/_layout_main', $this->data);
    }

    public function user_manual(){
        $this->data['meta_title'] = 'User Manual';
        $this->data['subview'] = 'user_manual';
        $this->load->view('frontend/_layout_main', $this->data);
    }

    public function organogram(){
        $this->data['meta_title'] = 'Organogram';
        $this->data['subview'] = 'organogram';
        $this->load->view('frontend/_layout_main', $this->data);
    }

    public function contact(){
        $this->data['meta_title'] = 'Contact';
        $this->data['subview'] = 'contact';
        $this->load->view('frontend/_layout_main', $this->data);
    }

    public function faqs(){
        $this->data['meta_title'] = 'Frequently Asked Questions';
        $this->data['subview'] = 'faqs';
        $this->load->view('frontend/_layout_main', $this->data);
    }

    public function blood_donation($id){ 
        $this->form_validation->set_rules('bDivision', 'Division', 'required|trim');
        $this->form_validation->set_rules('bDistrict', 'District', 'trim');
        $this->form_validation->set_rules('upaThana', 'Upzila / Thana', 'trim');
        $this->form_validation->set_rules('bg', 'Blood Group', 'required|trim');

        // print_r($this->input->get()); 

        // if ($this->form_validation->run() == true){
        if (!empty($this->input->get())){

            $current_div_id  = $this->input->get('bDivision');
            $current_district_id  = $this->input->get('bDistrict'); //exit;
            $current_upazila_id   = $this->input->get('bUpaThana'); //exit;
            $blood           = $this->input->get('bg');
            // echo 'hello'; exit;
            $this->data['bg_name'] = $this->Common_model->get_single_data('blood_group', $blood);
            $this->data['result'] = $this->Site_model->search_blood_donate($blood, $current_div_id, $current_district_id, $current_upazila_id);
        }

        $this->data['info'] = $this->Site_model->get_info('service_list', $id);  
        $this->data['divisions'] = $this->Common_model->get_division(); 
        $this->data['districts'] = $this->Common_model->get_district(); 
        $this->data['upazilas'] = $this->Common_model->get_upazila_thana();
        $this->data['blood'] = $this->Common_model->get_blood_group(); 

        $this->data['meta_title'] = 'Blood Donation';        
        $this->data['subview'] = 'blood_donation';
        $this->load->view('frontend/_layout_main', $this->data);
    }    

    public function search(){ 
        // $this->form_validation->set_rules('region', 'region', 'required|trim');
        // $this->form_validation->set_rules('district', 'District', 'trim');
        $region = $this->input->get('region');
        // if ($this->form_validation->run() == true && !empty($region)){
        if (!empty($region)){

            $this->data['info'] = $this->Site_model->search_scout_groups($this->input->get('region'), $this->input->get('district'));

            $this->data['district'] = $this->Common_model->get_sc_dis_by_region_id($this->input->get('region'));
            
            $this->data['region_name'] = $this->Common_model->get_single_data('office_region',$this->input->get('region'));
            $this->data['district_name'] = $this->Common_model->get_single_data('office_district',$this->input->get('district'));

            $this->data['meta_title'] = lang('site_meta_title_scout_group');;        
            $this->data['subview'] = 'search';
            $this->load->view('frontend/_layout_main', $this->data);
        }else{
            redirect('upazila');
        }  

    }

    public function services_request($id){   
        $id = (int) $id;
        if(!$id){
            redirect('not-found');
        }elseif(!$this->Common_model->exists('service_list', 'id', $id)){         
            redirect('not-found');            
        }

        $this->form_validation->set_rules('region_id', 'Region', 'trim');
        $this->form_validation->set_rules('problem_details', 'Problem details', 'required|trim');
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required|max_length[11]|max_length[11]|trim');
        $this->form_validation->set_rules('email', 'Email', 'valid_email|trim');        
        $this->form_validation->set_rules('address', 'Address', 'required|trim');

        if ($this->form_validation->run() == true){

            $form_data = array(
                'service_id'        => $id,
                'request_to'        => $this->input->post('request_to'),
                'serv_region_id'    => $this->input->post('region_id'),
                'serv_problem'      => $this->input->post('problem_details'),
                'name'              => $this->input->post('name'),
                'phone'             => $this->input->post('mobile'),
                'email'             => $this->input->post('email'),
                'address'           => $this->input->post('address'),
                'status'            => 2,
                'created'           => date('Y-m-d H:i:s')
                );


            // print_r($form_data); exit;
            if($this->Common_model->save('service_request', $form_data)){
                $this->session->set_flashdata('success', '<strong>Well done!</strong> Thank you for your request. <i class="fa fa fa-check"></i>');
                redirect('success');
            }
        }

        $this->data['info'] = $this->Site_model->get_info('service_list', $id);
        // $this->data['divisions'] = $this->Common_model->get_division(); 
        // $this->data['districts'] = $this->Common_model->get_district(); 
        // $this->data['upazilas'] = $this->Common_model->get_upazila_thana(); 
        // $this->data['regions'] = array('100' => 'National Headquarter')j;
        $this->data['regions'] = $this->Common_model->get_regions();

        $this->data['meta_title'] = 'Services';        
        $this->data['subview'] = 'services_request';
        $this->load->view('frontend/_layout_main', $this->data);
    } 

    public function service_traking(){ 
        // $this->form_validation->set_rules('mobile', 'Mobile number', 'required|max_length[11]|max_length[11]|trim');

        // if ($this->form_validation->run() == true){
        if (!empty($this->input->get('mobile'))){
            $mobile             = $this->input->get('mobile'); 
            $this->data['result'] = $this->Site_model->search_service_traking($mobile);
        }        

        $this->data['meta_title'] = 'Service Traking';        
        $this->data['subview'] = 'service_traking';
        $this->load->view('frontend/_layout_main', $this->data);
    }

    public function user_verify(){ 
        // $this->form_validation->set_rules('user_id', 'User ID', 'required|max_length[6]|max_length[6]|trim');

        if (!empty($this->input->get('scoutID'))){
            $user_id             = $this->input->get('scoutID');
            $this->data['result'] = $this->Site_model->get_user_info($user_id);
        }        

        $this->data['meta_title'] = 'User Verify';        
        $this->data['subview'] = 'user_verify';
        $this->load->view('frontend/_layout_main', $this->data);
    }

    public function user($id){ 
        $this->data['result'] = $this->Site_model->get_user_info($id);      

        $this->data['meta_title'] = 'User Verify';        
        $this->data['subview'] = 'user';
        $this->load->view('frontend/_layout_main', $this->data);
    }

    public function official_id($id){ 
        $this->data['result'] = $this->Site_model->get_pds_info($id);      

        $this->data['meta_title'] = 'Official ID';        
        $this->data['subview'] = 'official_id';
        $this->load->view('frontend/_layout_main', $this->data);
    }

    public function complain(){   
        $this->form_validation->set_rules('details', 'Details', 'required|trim');
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required|max_length[11]|max_length[11]|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');        
        $this->form_validation->set_rules('address', 'Address', 'required|trim');

        if ($this->form_validation->run() == true){

            $form_data = array(
                'complain_details'  => $this->input->post('details'),
                'name'              => $this->input->post('name'),
                'phone'             => $this->input->post('mobile'),
                'email'             => $this->input->post('email'),
                'address'           => $this->input->post('address'),
                );


            // print_r($form_data); exit;
            if($this->Common_model->save('complain', $form_data)){
                $this->session->set_flashdata('success', '<strong>Well done!</strong> Thank you for your Feedback. <i class="fa fa fa-check"></i>');
                redirect('success');
            }
        }


        $this->data['meta_title'] = 'Feedback Form';        
        $this->data['subview'] = 'complain';
        $this->load->view('frontend/_layout_main', $this->data);
    }

    /************************** Scouts Group Application ************************/
    /****************************************************************************/

    public function scout_group_application(){
         // echo encrypt_url(1); exit;
         // echo encrypt_url(1);
         // Validation
        $this->form_validation->set_rules('grp_open_date', 'group open', 'required|trim');
        $this->form_validation->set_rules('region_id', 'region name', 'required|trim');
        $this->form_validation->set_rules('district_id', 'district name', 'required|trim');
        $this->form_validation->set_rules('contact_mobile', 'Mobile', 'required|max_length[11]|max_length[11]|trim');
        $this->form_validation->set_rules('grp_name_en', 'group name english', 'required|trim');        

        // Validate and Insert
        if ($this->form_validation->run() == true){

            $form_data = array(
                'grp_type'              => $this->input->post('grp_type'),
                'grp_open_date'         => $this->input->post('grp_open_date'),
                'region_id'             => $this->input->post('region_id'),
                'district_id'           => $this->input->post('district_id'),
                'upazila_id'            => $this->input->post('upazila_id'),
                'grp_address'           => $this->input->post('grp_address'),
                'instituete_code'       => $this->input->post('instituete_code'),
                'institute_name'        => $this->input->post('institute_name'),
                'grp_name_en'           => $this->input->post('grp_name_en'),
                'grp_name_bn'           => $this->input->post('grp_name_bn'),
                'contact_mobile'        => $this->input->post('contact_mobile'),
                'contact_email'         => $this->input->post('contact_email'),
                'grp_president'         => $this->input->post('grp_president'),
                'grp_president_add'     => $this->input->post('grp_president_add'),
                'grp_secretary'         => $this->input->post('grp_secretary'),
                'grp_secretary_add'     => $this->input->post('grp_secretary_add'),
                
                'leader_name1'          => $this->input->post('leader_name1'),
                'training_date1'        => $this->input->post('training_date1'),
                'certificate_no1'       => $this->input->post('certificate_no1'),
                'training_place1'       => $this->input->post('training_place1'),
                'group_res1'            => $this->input->post('group_res1'),

                'leader_name2'          => $this->input->post('leader_name2'),
                'training_date2'        => $this->input->post('training_date2'),
                'certificate_no2'       => $this->input->post('certificate_no2'),
                'training_place2'       => $this->input->post('training_place2'),
                'group_res2'            => $this->input->post('group_res2'),

                'leader_name3'          => $this->input->post('leader_name3'),
                'training_date3'        => $this->input->post('training_date3'),
                'certificate_no3'       => $this->input->post('certificate_no3'),
                'training_place3'       => $this->input->post('training_place3'),
                'group_res3'            => $this->input->post('group_res3'),

                'leader_name4'          => $this->input->post('leader_name4'),
                'training_date4'        => $this->input->post('training_date4'),
                'certificate_no4'       => $this->input->post('certificate_no4'),
                'training_place4'       => $this->input->post('training_place4'),
                'group_res4'            => $this->input->post('group_res4'),

                'member_badge_cub'      => $this->input->post('member_badge_cub'),
                'member_badge_boy'      => $this->input->post('member_badge_boy'),
                'moon_standard_cub'     => $this->input->post('moon_standard_cub'),
                'moon_standard_boy'     => $this->input->post('moon_standard_boy'),
                'moon_progress_cub'     => $this->input->post('moon_progress_cub'),
                'moon_progress_boy'     => $this->input->post('moon_progress_boy'),
                'moon_service_cub'      => $this->input->post('moon_service_cub'),
                'moon_service_boy'      => $this->input->post('moon_service_boy'),
                'president_shapla_cub'  => $this->input->post('president_shapla_cub'),
                'president_shapla_boy'  => $this->input->post('president_shapla_boy'),
                );

            // echo '<pre>';
            // print_r($form_data); exit;

            if($this->Common_model->save('scout_group_application', $form_data)){
                $lastID = $this->db->insert_id();
                $this->session->set_flashdata('success', '<strong>Congratulations!</strong> Your scout group application submitted successfully <i class="fa fa fa-check"></i>');
                redirect('success-scout-application/'.encrypt_url($lastID));
            }
        }


        $this->data['meta_title'] = 'Scout Group Application';        
        $this->data['subview'] = 'scout_group_application';
        $this->load->view('frontend/_layout_main', $this->data);
    }

    public function success_scout_application($id){   

        $dataID = (int) decrypt_url($id); //exit; $id;
        if (!$this->Common_model->exists('scout_group_application', 'id', $dataID)) { 
            show_404('site - success_scout_application - exitsts', TRUE);
        }

        $this->data['meta_title'] = 'Success Scout Group Application';        
        $this->data['subview'] = 'success_scout_application';
        $this->load->view('frontend/_layout_main', $this->data);
    } 

    public function scout_application_pdf($id){ 

        $dataID = (int) decrypt_url($id); //exit;
        if (!$this->Common_model->exists('scout_group_application', 'id', $dataID)) { 
            show_404('site - scout_application_pdf - exitsts', TRUE);
        }

        //Results
        $this->data['info'] = $this->Site_model->get_scout_application($dataID);
        // echo '<pre>';
        // print_r($this->data['info']); exit;
        $this->data['meta_title'] = "স্কাউটস গ্রুপের আবেদন";
        $html = $this->load->view('scout_application_pdf', $this->data, true);   
        $file_name = $dataID."-scout-group-application.pdf";

        //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

        //generate the PDF from the given html
        $mpdf->WriteHTML($html);

        //download it for 'D'. 
        $mpdf->Output($file_name, "I");
    } 

    public function id_card_pdf($scoutID){
        exit;
        // $scoutID = (int) decrypt_url($id);
        if(!$this->Common_model->exists('users', 'scout_id', $scoutID)){
            show_404('site - id_card_pdf - exists', TRUE);
        }
        $this->load->model('my_profile/My_profile_model'); 
        // ID from scout id
        $id = $this->Site_model->get_id_from_scout_id($scoutID)->id; //exit;

        // Generate QR Code
        // $this->qrcode_generator($id);

        // Scout Information      
        $this->data['info'] = $this->My_profile_model->get_info($id);
        // echo $this->data['info']->scout_id; exit;   
        // print_r($this->data['info']); exit;     

        //Generate HTML
        $html = $this->load->view('pdf_id_card_front', $this->data, true);
        $html2 = $this->load->view('pdf_id_card_back', $this->data, true);    

        $mpdf = new mPDF('', array(349, 225), 10, 'arial', 0, 0, 0, 0);
        $file_name ="scout-id-".$this->data['info']->scout_id.".pdf";

        // $mpdf->showImageErrors = true;
        // $mpdf->debug = true;
        //$mpdf->img_dpi = 72;

        //generate the PDF from the given html
        $mpdf->WriteHTML($html);
        $mpdf->AddPage(); // Adds a new page in Landscape orientation
        $mpdf->WriteHTML($html2);

        //download it for 'D'. 
        $mpdf->Output($file_name, 'I');
    }   

    public function success(){   
        $this->data['meta_title'] = 'Feedback Form';        
        $this->data['subview'] = 'success';
        $this->load->view('frontend/_layout_main', $this->data);
    } 


    public function err404(){
        // $this->data['related_item'] = $this->Site_model->get_related_course_not_found();

        $this->data['meta_title'] = 'Page not found';
        $this->data['subview'] = 'err404';
        $this->load->view('frontend/_layout_main', $this->data);
    }

    public function sendemail(){
        $this->data['setting'] = $this->Common_model->get_info('setting');
        $this->load->library('email');
        $this->email->initialize(array(
          'protocol' => 'smtp',
          'smtp_host' => 'smtp.sendgrid.net',
          'smtp_user' => 'sendgridusername',
          'smtp_pass' => 'sendgridpassword',
          'smtp_port' => 587,
          'crlf' => "\r\n",
          'newline' => "\r\n"
          ));

        $this->email->from($this->input->post('email'), $this->input->post('name'));
        $this->email->to($this->data['setting']->contact_email);
        $this->email->subject($this->input->post('subject'));
        $this->email->message($this->input->post('message'));
        $this->email->send();

        // echo $this->email->print_debugger();
        redirect('contact-us');
    }

    /************************** Generate QR Code ******************************
   ***************************************************************************/

    public function qrcode_generator($id){
        $this->load->model('scouts_member/Scouts_member_model'); 
        // echo FCPATH;
        $info = $this->Scouts_member_model->get_info($id);
        //echo '<pre>';
        //print_r($info); exit;
        $scout_id   = $info->scout_id;
        $url        = base_url("user/").$scout_id;

        $codeContents = 'URL: '.$url."\n"; 

        $data['img_url']="";
        $this->load->library('ciqrcode');
        $qr_image=$id.'.png';
        // print_r($codeContents); exit();

        $params['data'] = $codeContents;
        $params['level'] = 'H';
        $params['size'] = 8;
        $params['savename'] = $this->qr_path."/".$qr_image;

        if($this->ciqrcode->generate($params)){
            $this->Scouts_member_model->set_scout_qrcode($id, $qr_image);
            $data['img_url']=$qr_image;
        }

        //$this->load->view('qrcode', $data);
        return true;
    }

    public function switchlang($language = NULL){
        $this->session->set_userdata('site_lang', $language);
        redirect($_SERVER['HTTP_REFERER']);
    }

    function ajax_get_scout_dis_by_region($id){
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Common_model->get_sc_dis_by_region_id($id)));
    }

    function ajax_get_scout_dis_data_by_region($id){
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Common_model->get_sc_dis_data_by_region_id($id)));
    }

    function ajax_get_scout_upazila_thana_data_by_district($id){
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Common_model->get_sc_upazila_data_by_district_id($id)));
    }

    function ajax_get_scout_upazila_thana_by_district($id){
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Common_model->get_sc_upazila_by_district_id($id)));
    }

    function ajax_get_scout_group_data_by_district($id){
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Common_model->get_sc_group_data_by_district_id($id)));
    }

    function ajax_get_scout_group_data_by_upazila($id){
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Common_model->get_sc_group_data_by_upazila_thana_id($id)));
    }

    function ajax_get_scout_group_by_upazila($id){
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Common_model->get_sc_group_by_upazila_thana_id($id)));
    }

    function get_sc_unit_data_by_scout_group_id($id){
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Common_model->get_sc_unit_data_by_scout_group_id($id)));
    }

    function ajax_get_district_by_div($id){
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Common_model->get_district_by_div_id($id)));
    }

    function ajax_get_upa_tha_by_dis($dis_id){
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Common_model->get_upa_tha_by_dis_id($dis_id)));
    }

    public function not_found(){
        $this->data['meta_title'] = 'Not found';        
        $this->data['subview'] = 'not_found';
        $this->load->view('frontend/_layout_main', $this->data);
    }
}