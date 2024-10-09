<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Backend_Controller {
	var $userData;

	public function __construct(){
		parent::__construct();
		if (!$this->ion_auth->logged_in()){
			redirect('login');
		}

		$this->data['module_name'] = 'Dashboard';
		$this->load->model('Dashboard_model');
		$this->load->model('committee/Committee_model');
		$this->load->model('offices/Offices_model');
		$this->load->model('e_filing/E_filing_model');
		$this->load->model('e_nathi/E_nathi_model');
		$this->userData = $this->Common_model->get_user_details();

		// $this->userSessID = $this->session->userdata('user_id');
      	// print_r($this->session->all_userdata());
		//$this->session->set_userdata('current_group', 'superadmin');
		// echo '<pre>';
		// echo $_SERVER['HTTP_USER_AGENT'];
		// print_r($this->session->all_userdata()); //exit;
	}

	public function index(){
		// $browser = get_browser(null, true);
		// print_r($browser);
		// echo $this->session->userdata('current_group'); exit;
		// echo $this->userSessID;
		// print_r($userDetails);

		if(!$this->session->userdata('current_group')){
			if($this->ion_auth->is_admin()){
				$this->session->set_userdata('current_group', 1);
				$this->session->set_userdata('current_group_name', 'Superadmin');

			}else if($this->ion_auth->is_scout_admin()){
				$this->session->set_userdata('current_group', 2);
				$this->session->set_userdata('current_group_name', 'Scout Admin');

			}else if($this->ion_auth->in_group('monitor_team')){
				// echo 'Hellofff'; exit;
				$this->session->set_userdata('current_group', 3);
				$this->session->set_userdata('current_group_name', 'Monitoring');

			}else if($this->ion_auth->in_group('award')){
				$this->session->set_userdata('current_group', 13);
				$this->session->set_userdata('current_group_name', 'Award');

			}else if($this->ion_auth->in_group('event')){
				$this->session->set_userdata('current_group', 14);
				$this->session->set_userdata('current_group_name', 'Event');

			}else if($this->ion_auth->in_group('training')){
				$this->session->set_userdata('current_group', 15);
				$this->session->set_userdata('current_group_name', 'Training');

			}else if($this->ion_auth->is_region_admin()){
				$this->session->set_userdata('current_group', 4);
				$this->session->set_userdata('current_group_name', 'Regional Admin');

			}else if($this->ion_auth->is_district_admin()){
				$this->session->set_userdata('current_group', 5);
				$this->session->set_userdata('current_group_name', 'District Admin');

			}else if($this->ion_auth->is_upazila_admin()){
				$this->session->set_userdata('current_group', 6);
				$this->session->set_userdata('current_group_name', 'Upazila Admin');

			}else if($this->ion_auth->is_group_admin()){
				$this->session->set_userdata('current_group', 7);
				$this->session->set_userdata('current_group_name', 'Group Admin');

			}else if($this->ion_auth->is_scout_member()){
				$this->session->set_userdata('current_group', 9);
				$this->session->set_userdata('current_group_name', 'Scout Member');

			}else if($this->ion_auth->is_vendor()){
				$this->session->set_userdata('current_group', 11);
				$this->session->set_userdata('current_group_name', 'Vendor');

			}else if($this->ion_auth->is_guest()){
				$this->session->set_userdata('current_group', 10);
				$this->session->set_userdata('current_group_name', 'Guest Member');
			}
		}

		$user_grp_session = $this->session->userdata('current_group');

		if(($this->ion_auth->is_admin() && $user_grp_session == 1) || ($this->ion_auth->is_scout_admin() && $user_grp_session == 2 || ($this->ion_auth->in_group('monitor_team') && $user_grp_session == 3))){
			//Total Register
			// $result = $this->Dashboard_model->get_count_online_register();
			// $this->data['total_online_register'] = $result['count'];
			// $result = $this->Dashboard_model->get_count_request_members();
			// $this->data['total_request_member'] = $result['count'];
			// $result = $this->Dashboard_model->get_count_archive_members();
			// $this->data['total_archive_member'] = $result['count'];

			//Total Online Member
			// shahajahan 12-05-24
			$row = $this->Dashboard_model->total_member_count_by_status();
			// dd($row);
			$this->data['total_request_member'] = $row->request;
			$this->data['total_online_member'] = $row->verify;
			$this->data['total_archive_member'] = $row->archive;
			$this->data['total_online_member_male'] = $row->online_member_male;
			$this->data['total_online_member_female'] = $row->online_member_female;
			$this->data['total_online_member_others'] = $row->online_member_others;

			//Total Region
			// $rowsss = $this->Dashboard_model->get_count_online_member_by_region_wise();
			$this->data['total_member_region_dhk'] = $row->total_member_region_dhk;
			$this->data['total_member_region_ctg'] = $row->total_member_region_ctg;
			$this->data['total_member_region_raj'] = $row->total_member_region_raj;
			$this->data['total_member_region_khl'] = $row->total_member_region_khl;
			$this->data['total_member_region_bar'] = $row->total_member_region_bar;
			$this->data['total_member_region_syl'] = $row->total_member_region_syl;
			$this->data['total_member_region_cum'] = $row->total_member_region_cum;
			$this->data['total_member_region_din'] = $row->total_member_region_din;
			$this->data['total_member_region_may'] = $row->total_member_region_may;
			$this->data['total_member_region_rov'] = $row->total_member_region_rov;
			$this->data['total_member_region_ral'] = $row->total_member_region_ral;
			$this->data['total_member_region_nav'] = $row->total_member_region_nav;
			$this->data['total_member_region_air'] = $row->total_member_region_air;
			// write end shahajahan 12-05-24

			// commend shahajahan 12-05-24
			// $result = $this->Dashboard_model->get_count_online_members();
			// $this->data['total_online_member'] = $result['count'];
			// $result = $this->Dashboard_model->get_count_online_members_by_gender('Male');
			// $this->data['total_online_member_male'] = $result['count'];
			// $result = $this->Dashboard_model->get_count_online_members_by_gender('Female');
			// $this->data['total_online_member_female'] = $result['count'];
			// $result = $this->Dashboard_model->get_count_online_members_by_gender('Others');
			// $this->data['total_online_member_others'] = $result['count'];


			//Total Online Member by Member Type
			/*$result = $this->Dashboard_model->get_count_by_member_type(1);
			$this->data['total_new_applicant'] = $result['count'];
			$result = $this->Dashboard_model->get_count_by_member_type(2);
			$this->data['total_scout'] = $result['count'];
			$result = $this->Dashboard_model->get_count_by_member_type(8);
			$this->data['total_adult_leader'] = $result['count'];
			$result = $this->Dashboard_model->get_count_by_member_type(9);
			$this->data['total_professional'] = $result['count'];
			$result = $this->Dashboard_model->get_count_by_member_type(10);
			$this->data['total_non_warrent'] = $result['count'];
			$result = $this->Dashboard_model->get_count_by_member_type(12);
			$this->data['total_warrent'] = $result['count'];
			$result = $this->Dashboard_model->get_count_by_member_type(13);
			$this->data['total_support_staff'] = $result['count'];*/

			$rows = $this->Dashboard_model->get_count_by_member_by_type_wise();
			$this->data['total_new_applicant'] = $rows->total_new_applicant;
			$this->data['total_scout'] = $rows->total_scout;
			$this->data['total_adult_leader'] = $rows->total_adult_leader;
			$this->data['total_professional'] = $rows->total_professional;
			$this->data['total_non_warrent'] = $rows->total_non_warrent;
			$this->data['total_warrent'] = $rows->total_warrent;
			$this->data['total_support_staff'] = $rows->total_support_staff;
			// shahajahan 12-05-24

			//Online Member Percent statistics
			$this->data['new_applicant_percent'] = round(($this->data['total_new_applicant']*100)/$this->data['total_online_member'], 2);
			$this->data['scout_percent'] = round(($this->data['total_scout']*100)/$this->data['total_online_member'], 2);
			$this->data['adult_leader_percent'] = round(($this->data['total_adult_leader']*100)/$this->data['total_online_member'], 2);
			$this->data['professional_percent'] = round(($this->data['total_professional']*100)/$this->data['total_online_member'], 2);
			$this->data['non_warren_percent'] = round(($this->data['total_non_warrent']*100)/$this->data['total_online_member'], 2);
			$this->data['warrent_percent'] = round(($this->data['total_warrent']*100)/$this->data['total_online_member'], 2);
			$this->data['support_staff_percent'] = round(($this->data['total_support_staff']*100)/$this->data['total_online_member'], 2);
        	// exit;
        	// echo $total_online_member;

        	//Event
			// commend shahajahan 12-05-24
			/*$result = $this->Dashboard_model->get_count_event_total();
			$this->data['total_event'] = $result['count'];
			$result = $this->Dashboard_model->get_count_event_total_by_level('nhq');
			$this->data['total_event_nhq'] = $result['count'];
			$result = $this->Dashboard_model->get_count_event_total_by_level('region');
			$this->data['total_event_region'] = $result['count'];
			$result = $this->Dashboard_model->get_count_event_total_by_level('district');
			$this->data['total_event_district'] = $result['count'];*/
			// commend end shahajahan 12-05-24

			// write shahajahan 12-05-24
			$rowss = $this->Dashboard_model->get_count_event_total_by_level_wise();
			$this->data['total_event'] = $rowss->count;
			$this->data['total_event_nhq'] = $rowss->total_event_nhq;
			$this->data['total_event_region'] = $rowss->total_event_region;
			$this->data['total_event_district'] = $rowss->total_event_district;

			// commend shahajahan 12-05-24
			/*$result = $this->Dashboard_model->get_count_online_member_by_region(1);
			$this->data['total_member_region_dhk'] = $result['count'];
			$result = $this->Dashboard_model->get_count_online_member_by_region(2);
			$this->data['total_member_region_ctg'] = $result['count'];
			$result = $this->Dashboard_model->get_count_online_member_by_region(3);
			$this->data['total_member_region_raj'] = $result['count'];
			$result = $this->Dashboard_model->get_count_online_member_by_region(4);
			$this->data['total_member_region_khl'] = $result['count'];
			$result = $this->Dashboard_model->get_count_online_member_by_region(5);
			$this->data['total_member_region_bar'] = $result['count'];
			$result = $this->Dashboard_model->get_count_online_member_by_region(6);
			$this->data['total_member_region_syl'] = $result['count'];
			$result = $this->Dashboard_model->get_count_online_member_by_region(7);
			$this->data['total_member_region_cum'] = $result['count'];
			$result = $this->Dashboard_model->get_count_online_member_by_region(8);
			$this->data['total_member_region_din'] = $result['count'];
			$result = $this->Dashboard_model->get_count_online_member_by_region(9);
			$this->data['total_member_region_may'] = $result['count'];
			$result = $this->Dashboard_model->get_count_online_member_by_region(10);
			$this->data['total_member_region_rov'] = $result['count'];
			$result = $this->Dashboard_model->get_count_online_member_by_region(11);
			$this->data['total_member_region_ral'] = $result['count'];
			$result = $this->Dashboard_model->get_count_online_member_by_region(12);
			$this->data['total_member_region_nav'] = $result['count'];
			$result = $this->Dashboard_model->get_count_online_member_by_region(13);
			$this->data['total_member_region_air'] = $result['count'];*/
			// commend end shahajahan 12-05-24

         	//Censes Statistics
         	//Member Type: New Applicant (na)
         	// commend shahajahan 12-05-24
			/*$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(1, 1, 'Male');
			$this->data['count_na_cub_scout_m'] = $result['count'];
			$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(1, 2, 'Male');
			$this->data['count_na_scout_m'] = $result['count'];
			$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(1, 3, 'Male');
			$this->data['count_na_rober_scout_m'] = $result['count'];
			$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(1, 1, 'Female');
			$this->data['count_na_cub_scout_f'] = $result['count'];
			$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(1, 2, 'Female');
			$this->data['count_na_scout_f'] = $result['count'];
			$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(1, 3, 'Female');
			$this->data['count_na_rober_scout_f'] = $result['count'];

			//Member Type: Scout
			$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 1, 'Male');
			$this->data['count_cub_scout_m'] = $result['count'];
			$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 2, 'Male');
			$this->data['count_scout_m'] = $result['count'];
			$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 3, 'Male');
			$this->data['count_rober_scout_m'] = $result['count'];
			$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 1, 'Female');
			$this->data['count_cub_scout_f'] = $result['count'];
			$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 2, 'Female');
			$this->data['count_scout_f'] = $result['count'];
			$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 3, 'Female');
			$this->data['count_rober_scout_f'] = $result['count'];*/
			// commend end shahajahan 12-05-24

			// write shahajahan 12-05-24
			$this->data['count_na_cub_scout_m'] = $row->na_cub_scout_m;
			$this->data['count_na_scout_m'] = $row->na_scout_m;
			$this->data['count_na_rober_scout_m'] = $row->n_rober_scout_m;
			$this->data['count_na_cub_scout_f'] = $row->n_cub_scout_f;
			$this->data['count_na_scout_f'] = $row->na_scout_f;
			$this->data['count_na_rober_scout_f'] = $row->rober_scut_f;

			$this->data['count_cub_scout_m'] = $row->cub_scout_m;
			$this->data['count_scout_m'] = $row->count_scout_m;
			$this->data['count_rober_scout_m'] = $row->rober_scout_m;
			$this->data['count_cub_scout_f'] = $row->cub_scout_f;
			$this->data['count_scout_f'] = $row->count_scout_f;
			$this->data['count_rober_scout_f'] = $row->rober_scout_f;

			$this->data['scouter_s_m'] = $row->scouter_s_m;
			$this->data['non_warrant_m'] = $row->non_warrant_m;
			$this->data['warrant_m'] = $row->warrant_m;
			$this->data['professional_scouts_m'] = $row->professional_scouts_m;
			$this->data['support_staff_m'] = $row->support_staff_m;
			$this->data['scouter_s_f'] = $row->scouter_s_f;
			$this->data['non_warrant_f'] = $row->non_warrant_f;
			$this->data['warrant_f'] = $row->warrant_f;
			$this->data['professional_scouts_f'] = $row->professional_scouts_f;
			$this->data['support_staff_f'] = $row->support_staff_f;
			// write end shahajahan 12-05-24

			//Member Type: Other's
         	// commend shahajahan 12-05-24
			/*$result = $this->Dashboard_model->get_censes_by_member_id_gender(8, 'Male');
			$this->data['scouter_s_m'] = $result['count'];
			$result = $this->Dashboard_model->get_censes_by_member_id_gender(10,'Male');
			$this->data['non_warrant_m'] = $result['count'];
			$result = $this->Dashboard_model->get_censes_by_member_id_gender(12,'Male');
			$this->data['warrant_m'] = $result['count'];
			$result = $this->Dashboard_model->get_censes_by_member_id_gender(9,'Male');
			$this->data['professional_scouts_m'] = $result['count'];
			$result = $this->Dashboard_model->get_censes_by_member_id_gender(13,'Male');
			$this->data['support_staff_m'] = $result['count'];

			$result = $this->Dashboard_model->get_censes_by_member_id_gender(8,'Female');
			$this->data['scouter_s_f'] = $result['count'];
			$result = $this->Dashboard_model->get_censes_by_member_id_gender(10,'Female');
			$this->data['non_warrant_f'] = $result['count'];
			$result = $this->Dashboard_model->get_censes_by_member_id_gender(12,'Female');
			$this->data['warrant_f'] = $result['count'];
			$result = $this->Dashboard_model->get_censes_by_member_id_gender(9,'Female');
			$this->data['professional_scouts_f'] = $result['count'];
			$result = $this->Dashboard_model->get_censes_by_member_id_gender(13,'Female');
			$this->data['support_staff_f'] = $result['count'];*/
			// commend end shahajahan 12-05-24

			// Load Page
			$this->data['meta_title'] = 'Dashboard';
			$this->data['subview'] = 'superadmin_dashboard';
			$this->load->view('backend/_layout_main', $this->data);

			// }elseif($this->ion_auth->is_scout_admin() && $user_grp_session == 2){
			// 	$this->data['info'] = $this->userData['user_info'];
			// 	// $this->data['scout_info'] = $this->Dashboard_model->get_scout_info($this->userData['user_info']->id);

			// 	// load page
			// 	$this->data['meta_title'] = 'Dashboard';
			// 	$this->data['subview'] = 'admin_dashboard';
			// 	$this->load->view('backend/_layout_main', $this->data);


		}elseif($this->ion_auth->is_region_admin() && $user_grp_session == 4){
			$data_arr = [];
			// To get current user for scout regional_head table
			// Region access also define from ACL 'regional_head' group
			$regionID = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;

			if($regionID){
				//Office Info
				$this->data['info'] = $this->Offices_model->get_region_info($regionID);

				$this->data['total_district'] = count($this->Offices_model->get_scout_district($regionID));
				$this->data['total_upazila'] = count($this->Offices_model->get_scout_upazila($regionID));

				// $c_group = $this->Offices_model->get_scout_group(30000, 0, $regionID);
				$this->data['total_group'] = $this->Offices_model->get_scout_group_count($regionID);
				// print_r($this->data['total_group']); exit;

				$this->data['office_list'] = $this->Dashboard_model->get_count_member_by_office($regionID);
				// print_r($this->data['office_list']); exit;

				$this->data['officelist'] = $this->Dashboard_model->get_scouts_district_name($regionID);
				// print_r($this->data['officelist']); exit;
				foreach ($this->data['officelist'] as $value) {
					$data_arr[$value->id]['totalSCgroup'] = $this->Dashboard_model->get_count_scouts_group_office_id('', $value->id);
					$data_arr[$value->id]['totalmember'] = $this->Dashboard_model->get_count_scouts_member_by_office_id('', $value->id);
	         	//echo '<tr> <td>'.$value->grp_name.'</td><td>'.$data_arr[$value->id]['totalmember']['count'].'</td></tr>';
				}
				$this->data['result_data'] = $data_arr;


				// $result = $this->Dashboard_model->get_count_online_register($regionID);
				// $this->data['total_online_register'] = $result['count'];
				$result = $this->Dashboard_model->get_count_online_members($regionID);
				$this->data['total_online_member'] = $result['count'];
				$result = $this->Dashboard_model->get_count_request_members($regionID);
				$this->data['total_request_member'] = $result['count'];
				$result = $this->Dashboard_model->get_count_archive_members($regionID);
				$this->data['total_archive_member'] = $result['count'];

				//Censes Statistics
				//Member Type: New Applicant (na)
				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(1, 1, 'Male', $regionID);
				$this->data['count_na_cub_scout_m'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(1, 2, 'Male', $regionID);
				$this->data['count_na_scout_m'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(1, 3, 'Male', $regionID);
				$this->data['count_na_rober_scout_m'] = $result['count'];

				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(1, 1, 'Female', $regionID);
				$this->data['count_na_cub_scout_f'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(1, 2, 'Female', $regionID);
				$this->data['count_na_scout_f'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(1, 3, 'Female', $regionID);
				$this->data['count_na_rober_scout_f'] = $result['count'];

				//Member Type: Scout
				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 1, 'Male', $regionID);
				$this->data['count_cub_scout_m'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 2, 'Male', $regionID);
				$this->data['count_scout_m'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 3, 'Male', $regionID);
				$this->data['count_rober_scout_m'] = $result['count'];

				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 1, 'Female', $regionID);
				$this->data['count_cub_scout_f'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 2, 'Female', $regionID);
				$this->data['count_scout_f'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 3, 'Female', $regionID);
				$this->data['count_rober_scout_f'] = $result['count'];

				//Member Type: Other's
				$result = $this->Dashboard_model->get_censes_by_member_id_gender(8, 'Male', $regionID);
				$this->data['scouter_s_m'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_gender(10, 'Male', $regionID);
				$this->data['non_warrant_m'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_gender(12, 'Male', $regionID);
				$this->data['warrant_m'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_gender(9, 'Male', $regionID);
				$this->data['professional_scouts_m'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_gender(13, 'Male', $regionID);
				$this->data['support_staff_m'] = $result['count'];

				$result = $this->Dashboard_model->get_censes_by_member_id_gender(8, 'Female', $regionID);
				$this->data['scouter_s_f'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_gender(10, 'Female', $regionID);
				$this->data['non_warrant_f'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_gender(12, 'Female', $regionID);
				$this->data['warrant_f'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_gender(9, 'Female', $regionID);
				$this->data['professional_scouts_f'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_gender(13, 'Female', $regionID);
				$this->data['support_staff_f'] = $result['count'];

			}else{
				$this->data['info'] = (object) ['id' => 0];
			}

			// load page
			$this->data['meta_title'] = 'Dashboard';
			$this->data['subview'] = 'region_dashboard';
			$this->load->view('backend/_layout_main', $this->data);

		}elseif($this->ion_auth->is_district_admin() && $this->session->userdata('sc_region_id') == 10){
			// To get current user for scout district_office table
			// Region access also define from ACL 'district_office' admin group
			//Office Info
			$this->data['info'] = $this->Offices_model->get_scout_district_info($this->session->userdata('sc_district_id'));
			$this->data['total_group'] = $this->Offices_model->get_scout_group_count('', $this->session->userdata('sc_district_id'));
			$this->data['row'] = $this->Dashboard_model->total_member_count_by_status('', $this->session->userdata('sc_district_id'));

			// load page
			$this->data['meta_title'] = 'Dashboard';
			$this->data['subview'] = 'rover_district_dashboard';
			$this->load->view('backend/_layout_main', $this->data);

		}elseif($this->ion_auth->is_district_admin() && $user_grp_session == 5){
			$data_arr = [];
			// To get current user for scout district_office table
			// Region access also define from ACL 'district_office' admin group
			$districtID = $this->Offices_model->get_district_office_by_user_id($this->userSessID)->id;

			if($districtID){
				//Office Info
				$this->data['info'] = $this->Offices_model->get_scout_district_info($districtID);

				$this->data['total_district'] = count($this->Offices_model->get_scout_district('', $districtID));
				$this->data['total_upazila'] = count($this->Offices_model->get_scout_upazila('', $districtID));

				/*$c_group=$this->Offices_model->get_scout_group(30000,0,'',$districtID);
				$this->data['total_group'] = count($c_group['rows']);*/
				$this->data['total_group'] = $this->Offices_model->get_scout_group_count('', $districtID);


				$this->data['office_list'] = $this->Dashboard_model->get_count_member_by_office('', $districtID);
				// echo '<pre>';
				// print_r($this->data['office_list']); exit;

				$this->data['officelist'] = $this->Dashboard_model->get_scouts_upazila_name($districtID);
				// print_r($this->data['officelist']); exit;
				foreach ($this->data['officelist'] as $value) {
					$data_arr[$value->id]['totalSCgroup'] = $this->Dashboard_model->get_count_scouts_group_office_id('', '', $value->id);
					$data_arr[$value->id]['totalmember'] = $this->Dashboard_model->get_count_scouts_member_by_office_id('', '', $value->id);
	         	//echo '<tr> <td>'.$value->grp_name.'</td><td>'.$data_arr[$value->id]['totalmember']['count'].'</td></tr>';
				}
				$this->data['result_data'] = $data_arr;


				// $result = $this->Dashboard_model->get_count_online_register('', $districtID);
				// $this->data['total_online_register'] = $result['count'];
				$result = $this->Dashboard_model->get_count_online_members('', $districtID);
				$this->data['total_online_member'] = $result['count'];
				$result = $this->Dashboard_model->get_count_request_members('', $districtID);
				$this->data['total_request_member'] = $result['count'];
				$result = $this->Dashboard_model->get_count_archive_members('', $districtID);
				$this->data['total_archive_member'] = $result['count'];

				//Censes Statistics
				//Member Type: New Applicant (na)
				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(1, 1, 'Male', '', $districtID);
				$this->data['count_na_cub_scout_m'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(1, 2, 'Male', '', $districtID);
				$this->data['count_na_scout_m'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(1, 3, 'Male', '', $districtID);
				$this->data['count_na_rober_scout_m'] = $result['count'];

				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(1, 1, 'Female', '', $districtID);
				$this->data['count_na_cub_scout_f'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(1, 2, 'Female', '', $districtID);
				$this->data['count_na_scout_f'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(1, 3, 'Female', '', $districtID);
				$this->data['count_na_rober_scout_f'] = $result['count'];

				//Member Type: Scout
				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 1, 'Male', '', $districtID);
				$this->data['count_cub_scout_m'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 2, 'Male', '', $districtID);
				$this->data['count_scout_m'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 3, 'Male', '', $districtID);
				$this->data['count_rober_scout_m'] = $result['count'];

				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 1, 'Female', '', $districtID);
				$this->data['count_cub_scout_f'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 2, 'Female', '', $districtID);
				$this->data['count_scout_f'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 3, 'Female', '', $districtID);
				$this->data['count_rober_scout_f'] = $result['count'];

				//Member Type: Other's
				$result = $this->Dashboard_model->get_censes_by_member_id_gender(8, 'Male', '', $districtID);
				$this->data['scouter_s_m'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_gender(10,'Male', '', $districtID);
				$this->data['non_warrant_m'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_gender(12,'Male', '', $districtID);
				$this->data['warrant_m'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_gender(9,'Male', '', $districtID);
				$this->data['professional_scouts_m'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_gender(13,'Male', '', $districtID);
				$this->data['support_staff_m'] = $result['count'];

				$result = $this->Dashboard_model->get_censes_by_member_id_gender(8,'Female', '', $districtID);
				$this->data['scouter_s_f'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_gender(10,'Female', '', $districtID);
				$this->data['non_warrant_f'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_gender(12,'Female', '', $districtID);
				$this->data['warrant_f'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_gender(9,'Female', '', $districtID);
				$this->data['professional_scouts_f'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_gender(13,'Female', '', $districtID);
				$this->data['support_staff_f'] = $result['count'];

				// Statistics Data
				// $result = $this->Dashboard_model->get_members_count_by_sc_district_id($officeID);
				// $this->data['dis_deshboard_data'] = $result;

				// // Scout unit type
				// $result = $this->Common_model->set_scout_unit_type();
				// $this->data['unit_type'] = $result;

			}else{
				$this->data['info'] = (object) ['id' => 0];
			}

			// load page
			$this->data['meta_title'] = 'Dashboard';
			$this->data['subview'] = 'district_dashboard';
			$this->load->view('backend/_layout_main', $this->data);

		}elseif($this->ion_auth->is_upazila_admin() && $user_grp_session == 6){
			$data_arr = [];
			// echo 'Test'; exit;
			// To get current user for scout upazila_office table
			// Region access also define from ACL 'upazila_office' admin group
			$upazilaID = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID)->id;
			// print_r($this->userSessID); //exit;
			// echo 'Under maintainance<br>';

			if($upazilaID){
				//Office Info
				$this->data['info'] = $this->Offices_model->get_scout_upazila_info($upazilaID);
				// print_r($this->data['info']); exit;


				// $this->data['total_district'] = count($this->Offices_model->get_scout_district('', '', $upazilaID));
				// $this->data['total_upazila'] = count($this->Offices_model->get_scout_upazila('', '', $upazilaID));

				$this->data['officelist'] = $this->Dashboard_model->get_scouts_gorup($upazilaID);
				// $c_group=$this->Offices_model->get_scout_group(10000,0,'','',$upazilaID);
				$this->data['total_group'] = count($this->data['officelist']);

				// $this->data['office_list'] = $this->Dashboard_model->get_count_member_by_office('', '', $upazilaID);
				// print_r($this->data['office_list']); exit;


				/*
				foreach ($this->data['officelist'] as $value) {
					$data_arr[$value->id]['totalmember'] = $this->Dashboard_model->get_count_scouts_member_by_office_id('', '', '', $value->id);
	         		//echo '<tr> <td>'.$value->grp_name.'</td><td>'.$data_arr[$value->id]['totalmember']['count'].'</td></tr>';
				}
				$this->data['result_data'] = $data_arr;
				*/
	         // print_r($data_arr); exit;


				// $result = $this->Dashboard_model->get_count_online_register('', '', $upazilaID);
				// $this->data['total_online_register'] = $result['count'];
				$result = $this->Dashboard_model->get_count_online_members('', '', $upazilaID);
				$this->data['total_online_member'] = $result['count'];
				$result = $this->Dashboard_model->get_count_request_members('', '', $upazilaID);
				$this->data['total_request_member'] = $result['count'];
				$result = $this->Dashboard_model->get_count_archive_members('', '', $upazilaID);
				$this->data['total_archive_member'] = $result['count'];

				//Censes Statistics
				//Member Type: New Applicant (na)
				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(1, 1, 'Male', '', '', $upazilaID);
				$this->data['count_na_cub_scout_m'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(1, 2, 'Male', '', '', $upazilaID);
				$this->data['count_na_scout_m'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(1, 3, 'Male', '', '', $upazilaID);
				$this->data['count_na_rober_scout_m'] = $result['count'];

				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(1, 1, 'Female', '', '', $upazilaID);
				$this->data['count_na_cub_scout_f'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(1, 2, 'Female', '', '', $upazilaID);
				$this->data['count_na_scout_f'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(1, 3, 'Female', '', '', $upazilaID);
				$this->data['count_na_rober_scout_f'] = $result['count'];

				//Member Type: Scout
				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 1, 'Male', '', '', $upazilaID);
				$this->data['count_cub_scout_m'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 2, 'Male', '', '', $upazilaID);
				$this->data['count_scout_m'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 3, 'Male', '', '', $upazilaID);
				$this->data['count_rober_scout_m'] = $result['count'];

				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 1, 'Female', '', '', $upazilaID);
				$this->data['count_cub_scout_f'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 2, 'Female', '', '', $upazilaID);
				$this->data['count_scout_f'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 3, 'Female', '', '', $upazilaID);
				$this->data['count_rober_scout_f'] = $result['count'];

				//Member Type: Other's
				$result = $this->Dashboard_model->get_censes_by_member_id_gender(8, 'Male', '', '', $upazilaID);
				$this->data['scouter_s_m'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_gender(10,'Male', '', '', $upazilaID);
				$this->data['non_warrant_m'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_gender(12,'Male', '', '', $upazilaID);
				$this->data['warrant_m'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_gender(9,'Male', '', '', $upazilaID);
				$this->data['professional_scouts_m'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_gender(13,'Male', '', '', $upazilaID);
				$this->data['support_staff_m'] = $result['count'];

				$result = $this->Dashboard_model->get_censes_by_member_id_gender(8,'Female', '', '', $upazilaID);
				$this->data['scouter_s_f'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_gender(10,'Female', '', '', $upazilaID);
				$this->data['non_warrant_f'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_gender(12,'Female', '', '', $upazilaID);
				$this->data['warrant_f'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_gender(9,'Female', '', '', $upazilaID);
				$this->data['professional_scouts_f'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_gender(13,'Female', '', '', $upazilaID);
				$this->data['support_staff_f'] = $result['count'];

				// Statistics Data
				// $result = $this->Dashboard_model->get_members_count_by_sc_upa_tha_id($officeID);
				// $this->data['upa_deshboard_data'] = $result;

				// // Scout unit type
				// $result = $this->Common_model->set_scout_unit_type();
				// $this->data['unit_type'] = $result;
			}else{
				$this->data['info'] = (object) ['id' => 0];
			}


			// load page
			$this->data['meta_title'] = 'Dashboard';
			$this->data['subview'] = 'upazila_dashboard';
			$this->load->view('backend/_layout_main', $this->data);

		}elseif($this->ion_auth->is_group_admin() && $user_grp_session == 7){
			// To get current user for scout group_office table
			// Region access also define from ACL 'group_office' admin group
			$groupID = $this->Offices_model->get_scout_group_by_user_id($this->userSessID)->id;

			if($groupID){
				//Office Info
				$this->data['info'] = $this->Offices_model->get_scout_group_info($groupID);
				$this->data['scout_units'] = $this->Offices_model->get_scout_unit_by_group_office_id($groupID);

				// $this->data['total_district'] = count($this->Offices_model->get_scout_district('', '', '', $groupID));
				// $this->data['total_upazila'] = count($this->Offices_model->get_scout_upazila('', '', '', $groupID));
				// $this->data['total_group'] = count($this->Offices_model->get_scout_group('', '', '', $groupID));


				// $result = $this->Dashboard_model->get_count_online_register('', '', '', $groupID);
				// $this->data['total_online_register'] = $result['count'];
				$result = $this->Dashboard_model->get_count_online_members('', '', '', $groupID);
				$this->data['total_online_member'] = $result['count'];
				$result = $this->Dashboard_model->get_count_request_members('', '', '', $groupID);
				$this->data['total_request_member'] = $result['count'];
				$result = $this->Dashboard_model->get_count_archive_members('', '', '', $groupID);
				$this->data['total_archive_member'] = $result['count'];

				//Censes Statistics
				//Member Type: New Applicant (na)
				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(1, 1, 'Male', '', '', '', $groupID);
				$this->data['count_na_cub_scout_m'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(1, 2, 'Male', '', '', '', $groupID);
				$this->data['count_na_scout_m'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(1, 3, 'Male', '', '', '', $groupID);
				$this->data['count_na_rober_scout_m'] = $result['count'];

				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(1, 1, 'Female', '', '', '', $groupID);
				$this->data['count_na_cub_scout_f'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(1, 2, 'Female', '', '', '', $groupID);
				$this->data['count_na_scout_f'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(1, 3, 'Female', '', '', '', $groupID);
				$this->data['count_na_rober_scout_f'] = $result['count'];

				//Member Type: Scout
				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 1, 'Male', '', '', '', $groupID);
				$this->data['count_cub_scout_m'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 2, 'Male', '', '', '', $groupID);
				$this->data['count_scout_m'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 3, 'Male', '', '', '', $groupID);
				$this->data['count_rober_scout_m'] = $result['count'];

				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 1, 'Female', '', '', '', $groupID);
				$this->data['count_cub_scout_f'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 2, 'Female', '', '', '', $groupID);
				$this->data['count_scout_f'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 3, 'Female', '', '', '', $groupID);
				$this->data['count_rober_scout_f'] = $result['count'];

				//Member Type: Other's
				$result = $this->Dashboard_model->get_censes_by_member_id_gender(8, 'Male', '', '', '', $groupID);
				$this->data['scouter_s_m'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_gender(10,'Male', '', '', '', $groupID);
				$this->data['non_warrant_m'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_gender(12,'Male', '', '', '', $groupID);
				$this->data['warrant_m'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_gender(9,'Male', '', '', '', $groupID);
				$this->data['professional_scouts_m'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_gender(13,'Male', '', '', '', $groupID);
				$this->data['support_staff_m'] = $result['count'];

				$result = $this->Dashboard_model->get_censes_by_member_id_gender(8,'Female', '', '', '', $groupID);
				$this->data['scouter_s_f'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_gender(10,'Female', '', '', '', $groupID);
				$this->data['non_warrant_f'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_gender(12,'Female', '', '', '', $groupID);
				$this->data['warrant_f'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_gender(9,'Female', '', '', '', $groupID);
				$this->data['professional_scouts_f'] = $result['count'];
				$result = $this->Dashboard_model->get_censes_by_member_id_gender(13,'Female', '', '', '', $groupID);
				$this->data['support_staff_f'] = $result['count'];

				// Statistics Data
				// $res = $this->Dashboard_model->get_members_count_by_sc_group_id($officeID);
				// $this->data['group_deshboard_data'] = $res;

				// // Scout unit type
				// $resu = $this->Common_model->set_scout_unit_type();
				// $this->data['unit_type'] = $resu;

			}else{
				// $this->data['office_info'] = (object) ['id' => 0];
				redirect('dashboard/no_assign');
			}

			// load page
			$this->data['meta_title'] = 'Dashboard';
			$this->data['subview'] = 'group_dashboard';
			$this->load->view('backend/_layout_main', $this->data);

			// }elseif($this->ion_auth->is_unit_admin() && $user_grp_session == 8){
			// 	// To get current district committee from 'committee_member_district' table
			// 	// Region access also define from ACL 'district_office' admin group
			// 	$result = $this->Committee_model->get_current_scout_unit_from_committee($this->session->userdata('user_id'));
			// 	if($result){
			// 		// Region and Executive Committee info
			// 		$results = $this->Committee_model->get_scout_unit_committee_info($result->committee_id);
			// 		$this->data['info'] = $results['info'];
			// 		$this->data['members'] = $results['members'];

			// 		foreach ($results['members'] as $k => $members){
			// 			// print_r($members); exit;
			// 			$results['members'][$k]->groups = $this->ion_auth->get_users_groups($members->user_id)->result();
			// 		}
			// 	}else{
			// 		// $this->data['info'] = (object) ['id' => 0];
			// 		redirect('dashboard/no_assign');
			// 	}

			// 	// load page
			// 	$this->data['meta_title'] = 'Dashboard';
			// 	$this->data['subview'] = 'unit_dashboard';
			// 	$this->load->view('backend/_layout_main', $this->data);

		}elseif($this->ion_auth->is_scout_member() && $user_grp_session == 9){
			$this->data['info'] = $this->userData['user_info'];
			$this->data['scout_info'] = $this->Dashboard_model->get_scout_info($this->userData['user_info']->id);

			redirect('my_profile');

			// load page
			$this->data['meta_title'] = 'Dashboard';
			$this->data['subview'] = 'scout_member_dashboard';
			$this->load->view('backend/_layout_main', $this->data);

		}elseif($this->ion_auth->is_vendor() && $user_grp_session == 11){
			$this->data['info'] = $this->userData['user_info'];
			// $this->data['scout_info'] = $this->Dashboard_model->get_scout_info($this->userData['user_info']->id);

			// load page
			$this->data['meta_title'] = 'Dashboard';
			$this->data['subview'] = 'vendor_dashboard';
			$this->load->view('backend/_layout_main', $this->data);


		}elseif($this->ion_auth->in_group('award') && $user_grp_session == 13){
			$this->data['info'] = $this->userData['user_info'];
			// $this->data['scout_info'] = $this->Dashboard_model->get_scout_info($this->userData['user_info']->id);

			// load page
			$this->data['meta_title'] = 'Award Dashboard';
			$this->data['subview'] = 'vendor_dashboard';
			$this->load->view('backend/_layout_main', $this->data);


		}elseif($this->ion_auth->in_group('event') && $user_grp_session == 14){
			$this->data['info'] = $this->userData['user_info'];
			// $this->data['scout_info'] = $this->Dashboard_model->get_scout_info($this->userData['user_info']->id);

			// load page
			$this->data['meta_title'] = 'Event Dashboard';
			$this->data['subview'] = 'vendor_dashboard';
			$this->load->view('backend/_layout_main', $this->data);


		}elseif($this->ion_auth->in_group('training') && $user_grp_session == 15){
			$this->data['info'] = $this->userData['user_info'];
			// $this->data['scout_info'] = $this->Dashboard_model->get_scout_info($this->userData['user_info']->id);

			// load page
			$this->data['meta_title'] = 'Training Dashboard';
			$this->data['subview'] = 'vendor_dashboard';
			$this->load->view('backend/_layout_main', $this->data);


		}elseif($this->ion_auth->is_guest() && $user_grp_session == 10){
			// print_r($this->userData); exit;

			if($this->userData['user_info']->is_request == 2){
				//Load page
				$this->data['meta_title'] = 'Dashboard';
				$this->data['subview'] = 'guest_dashboard_cancel';
				$this->load->view('backend/_layout_main', $this->data);
			}else if($this->userData['user_info']->is_request == 1){
				//Load page
				$this->data['meta_title'] = 'Dashboard';
				$this->data['subview'] = 'guest_dashboard';
				$this->load->view('backend/_layout_main', $this->data);
			}else{
				redirect('scout-application-request');
			}

		}elseif($this->ion_auth->is_employee()){
         //Load page
			$this->data['user'] = $this->ion_auth->user()->row();

			$this->data['results2']=$this->E_filing_model->get_file_list1('file_copy', $this->data['user']->emp_designation);

			$this->data['results1']=$this->E_nathi_model->get_file_list3('nathi_desk', $this->data['user']->emp_designation);

			$this->data['meta_title'] = 'Dashboard';
			$this->data['subview'] = 'efile';
			$this->load->view('backend/_layout_main', $this->data);
		}
	}

	public function region_overview($regionID){
		if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('monitor_team'))){
			redirect('dashboard');
		}

		// comment on 21-12-2023 shahajahan
		// new method added shahajahan
		$this->data['total_online'] = $this->Dashboard_model->total_member_count_by_status($regionID);
		// dd($this->data['total_online']);

		/*$result = $this->Dashboard_model->get_count_online_register($regionID);
		$this->data['total_online_register'] = $result['count'];
		$result = $this->Dashboard_model->get_count_online_members($regionID);
		$this->data['total_online_member'] = $result['count'];
		$result = $this->Dashboard_model->get_count_request_members($regionID);
		$this->data['total_request_member'] = $result['count'];
		$result = $this->Dashboard_model->get_count_archive_members($regionID);
		$this->data['total_archive_member'] = $result['count'];*/
		// comment on 21-12-2023 shahajahan


		$this->data['info'] = $this->Offices_model->get_region_info($regionID);
		$this->data['total_district'] = count($this->Offices_model->get_scout_district($regionID));
		$this->data['total_upazila'] = count($this->Offices_model->get_scout_upazila($regionID));
		// $c_group = $this->Offices_model->get_scout_group(10000, 0, $regionID);   //comment on 11-05-2024 shahajahan
		$this->data['total_group'] = $this->Dashboard_model->get_scout_group($regionID);

		$this->data['office_list'] = $this->Dashboard_model->get_count_member_by_office($regionID);
		$this->data['officelist'] = $this->Dashboard_model->get_scouts_district_name($regionID);

		//Censes Statistics
		//Member Type: New Applicant (na)
		$row = $this->Dashboard_model->count_censes_by_member_id_section_id_gender($regionID);
		$this->data['count_na_cub_scout_m'] = $row->na_cub_scout_m;
		$this->data['count_na_scout_m'] = $row->na_scout_m;
		$this->data['count_na_rober_scout_m'] = $row->na_rober_scout_m;
		$this->data['count_na_cub_scout_f'] = $row->na_cub_scout_f;
		$this->data['count_na_scout_f'] = $row->na_scout_f;
		$this->data['count_na_rober_scout_f'] = $row->na_rober_scout_f;
		$this->data['count_cub_scout_m'] = $row->cub_scout_m;
		$this->data['count_scout_m'] = $row->scout_m;
		$this->data['count_rober_scout_m'] = $row->rober_scout_m;
		$this->data['count_cub_scout_f'] = $row->cub_scout_f;
		$this->data['count_scout_f'] = $row->scout_f;
		$this->data['count_rober_scout_f'] = $row->rober_scout_f;

		// this code comment on 11-06-2024 shahajahan
		// to new method added shahajahan
		/*
		$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(1, 1, 'Male', $regionID);
		$this->data['count_na_cub_scout_m'] = $result['count'];
		$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(1, 2, 'Male', $regionID);
		$this->data['count_na_scout_m'] = $result['count'];
		$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(1, 3, 'Male', $regionID);
		$this->data['count_na_rober_scout_m'] = $result['count'];

		$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(1, 1, 'Female', $regionID);
		$this->data['count_na_cub_scout_f'] = $result['count'];
		$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(1, 2, 'Female', $regionID);
		$this->data['count_na_scout_f'] = $result['count'];
		$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(1, 3, 'Female', $regionID);
		$this->data['count_na_rober_scout_f'] = $result['count'];

		//Member Type: Scout
		$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 1, 'Male', $regionID);
		$this->data['count_cub_scout_m'] = $result['count'];
		$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 2, 'Male', $regionID);
		$this->data['count_scout_m'] = $result['count'];
		$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 3, 'Male', $regionID);
		$this->data['count_rober_scout_m'] = $result['count'];

		$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 1, 'Female', $regionID);
		$this->data['count_cub_scout_f'] = $result['count'];
		$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 2, 'Female', $regionID);
		$this->data['count_scout_f'] = $result['count'];
		$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 3, 'Female', $regionID);
		$this->data['count_rober_scout_f'] = $result['count'];
		*/
		// to new method added shahajahan
		// this code comment on 11-06-2024 shahajahan
		//Member Type: Other's
		$this->data['scouter_s_m'] = $row->scouter_s_m;
		$this->data['non_warrant_m'] = $row->non_warrant_m;
		$this->data['warrant_m'] = $row->warrant_m;
		$this->data['professional_scouts_m'] = $row->professional_scouts_m;
		$this->data['support_staff_m'] = $row->support_staff_m;
		$this->data['scouter_s_f'] = $row->scouter_s_f;
		$this->data['non_warrant_f'] = $row->non_warrant_f;
		$this->data['warrant_f'] = $row->warrant_f;
		$this->data['professional_scouts_f'] = $row->professional_scouts_f;
		$this->data['support_staff_f'] = $row->support_staff_f;

		// to new method added shahajahan
		// this code comment on 11-06-2024 shahajahan
		/*
		$result = $this->Dashboard_model->get_censes_by_member_id_gender(8, 'Male', $regionID);
		$this->data['scouter_s_m'] = $result['count'];
		$result = $this->Dashboard_model->get_censes_by_member_id_gender(10,'Male', $regionID);
		$this->data['non_warrant_m'] = $result['count'];
		$result = $this->Dashboard_model->get_censes_by_member_id_gender(12,'Male', $regionID);
		$this->data['warrant_m'] = $result['count'];
		$result = $this->Dashboard_model->get_censes_by_member_id_gender(9,'Male', $regionID);
		$this->data['professional_scouts_m'] = $result['count'];
		$result = $this->Dashboard_model->get_censes_by_member_id_gender(13,'Male', $regionID);
		$this->data['support_staff_m'] = $result['count'];

		$result = $this->Dashboard_model->get_censes_by_member_id_gender(8,'Female', $regionID);
		$this->data['scouter_s_f'] = $result['count'];
		$result = $this->Dashboard_model->get_censes_by_member_id_gender(10,'Female', $regionID);
		$this->data['non_warrant_f'] = $result['count'];
		$result = $this->Dashboard_model->get_censes_by_member_id_gender(12,'Female', $regionID);
		$this->data['warrant_f'] = $result['count'];
		$result = $this->Dashboard_model->get_censes_by_member_id_gender(9,'Female', $regionID);
		$this->data['professional_scouts_f'] = $result['count'];
		$result = $this->Dashboard_model->get_censes_by_member_id_gender(13,'Female', $regionID);
		$this->data['support_staff_f'] = $result['count'];
		*/
		// to new method added shahajahan
		// this code comment on 11-06-2024 shahajahan

		// Load Page
		$this->data['meta_title'] = 'Region Overview';
		$this->data['subview'] = 'region_overview';
		$this->load->view('backend/_layout_main', $this->data);
	}


	public function region_overview_copy_remove_20_05_24($regionID){
		if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('monitor_team'))){
			redirect('dashboard');
		}

		// comment on 21-12-2023 shahajahan
		// new method added shahajahan
		$this->data['total_online'] = $this->Dashboard_model->total_member_count_by_status($regionID);
		// dd($this->data['total_online']);

		/*$result = $this->Dashboard_model->get_count_online_register($regionID);
		$this->data['total_online_register'] = $result['count'];
		$result = $this->Dashboard_model->get_count_online_members($regionID);
		$this->data['total_online_member'] = $result['count'];
		$result = $this->Dashboard_model->get_count_request_members($regionID);
		$this->data['total_request_member'] = $result['count'];
		$result = $this->Dashboard_model->get_count_archive_members($regionID);
		$this->data['total_archive_member'] = $result['count'];*/
		// comment on 21-12-2023 shahajahan



		$this->data['info'] = $this->Offices_model->get_region_info($regionID);
		$this->data['total_district'] = count($this->Offices_model->get_scout_district($regionID));
		$this->data['total_upazila'] = count($this->Offices_model->get_scout_upazila($regionID));
		$c_group = $this->Offices_model->get_scout_group(10000, 0, $regionID);
		$this->data['total_group'] = count($c_group['rows']);
		// $this->data['total_group'] = count($this->Offices_model->get_scout_group($regionID));

		$this->data['office_list'] = $this->Dashboard_model->get_count_member_by_office($regionID);

		$this->data['officelist'] = $this->Dashboard_model->get_scouts_district_name($regionID);
		foreach ($this->data['officelist'] as $value) {
			$data_arr[$value->id]['totalSCgroup'] = $this->Dashboard_model->get_count_scouts_group_office_id('', $value->id);
			$data_arr[$value->id]['totalmember'] = $this->Dashboard_model->get_count_scouts_member_by_office_id('', $value->id);
      	//echo '<tr> <td>'.$value->grp_name.'</td><td>'.$data_arr[$value->id]['totalmember']['count'].'</td></tr>';
		}
		$this->data['result_data'] = $data_arr;


		//Censes Statistics
		//Member Type: New Applicant (na)
		$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(1, 1, 'Male', $regionID);
		$this->data['count_na_cub_scout_m'] = $result['count'];
		$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(1, 2, 'Male', $regionID);
		$this->data['count_na_scout_m'] = $result['count'];
		$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(1, 3, 'Male', $regionID);
		$this->data['count_na_rober_scout_m'] = $result['count'];

		$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(1, 1, 'Female', $regionID);
		$this->data['count_na_cub_scout_f'] = $result['count'];
		$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(1, 2, 'Female', $regionID);
		$this->data['count_na_scout_f'] = $result['count'];
		$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(1, 3, 'Female', $regionID);
		$this->data['count_na_rober_scout_f'] = $result['count'];

		//Member Type: Scout
		$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 1, 'Male', $regionID);
		$this->data['count_cub_scout_m'] = $result['count'];
		$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 2, 'Male', $regionID);
		$this->data['count_scout_m'] = $result['count'];
		$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 3, 'Male', $regionID);
		$this->data['count_rober_scout_m'] = $result['count'];

		$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 1, 'Female', $regionID);
		$this->data['count_cub_scout_f'] = $result['count'];
		$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 2, 'Female', $regionID);
		$this->data['count_scout_f'] = $result['count'];
		$result = $this->Dashboard_model->get_censes_by_member_id_section_id_gender(2, 3, 'Female', $regionID);
		$this->data['count_rober_scout_f'] = $result['count'];

		//Member Type: Other's
		$result = $this->Dashboard_model->get_censes_by_member_id_gender(8, 'Male', $regionID);
		$this->data['scouter_s_m'] = $result['count'];
		$result = $this->Dashboard_model->get_censes_by_member_id_gender(10,'Male', $regionID);
		$this->data['non_warrant_m'] = $result['count'];
		$result = $this->Dashboard_model->get_censes_by_member_id_gender(12,'Male', $regionID);
		$this->data['warrant_m'] = $result['count'];
		$result = $this->Dashboard_model->get_censes_by_member_id_gender(9,'Male', $regionID);
		$this->data['professional_scouts_m'] = $result['count'];
		$result = $this->Dashboard_model->get_censes_by_member_id_gender(13,'Male', $regionID);
		$this->data['support_staff_m'] = $result['count'];

		$result = $this->Dashboard_model->get_censes_by_member_id_gender(8,'Female', $regionID);
		$this->data['scouter_s_f'] = $result['count'];
		$result = $this->Dashboard_model->get_censes_by_member_id_gender(10,'Female', $regionID);
		$this->data['non_warrant_f'] = $result['count'];
		$result = $this->Dashboard_model->get_censes_by_member_id_gender(12,'Female', $regionID);
		$this->data['warrant_f'] = $result['count'];
		$result = $this->Dashboard_model->get_censes_by_member_id_gender(9,'Female', $regionID);
		$this->data['professional_scouts_f'] = $result['count'];
		$result = $this->Dashboard_model->get_censes_by_member_id_gender(13,'Female', $regionID);
		$this->data['support_staff_f'] = $result['count'];

		// Load Page
		$this->data['meta_title'] = 'Region Overview';
		$this->data['subview'] = 'region_overview';
		$this->load->view('backend/_layout_main', $this->data);
	}

	public function find_group(){

		//Load page
		$this->data['meta_title'] = 'Find Your Group';
		$this->data['subview'] = 'find_group';
		$this->load->view('backend/_layout_main', $this->data);
	}

	public function no_assign(){
		//Load page
		$this->data['meta_title'] = 'No Assign';
		$this->data['subview'] = 'no_assign';
		$this->load->view('backend/_layout_main', $this->data);
	}

	// public function switch_user(){
	// 	$grp_id = $_POST['gid'];

	// 	if($grp_id == 1){
	// 		$this->session->set_userdata('current_group', 1);
	// 		$this->session->set_userdata('current_group_name', 'Superadmin');
	// 	}else if($grp_id == 2){
	// 		$this->session->set_userdata('current_group', 2);
	// 		$this->session->set_userdata('current_group_name', 'Scout Admin');
	// 	}else if($grp_id == 3){
	// 		$this->session->set_userdata('current_group', 3);
	// 		$this->session->set_userdata('current_group_name', 'Monitoring Team');
	// 	}else if($grp_id == 4){
	// 		$this->session->set_userdata('current_group', 4);
	// 		$this->session->set_userdata('current_group_name', 'Regional Admin');
	// 	}else if($grp_id == 5){
	// 		$this->session->set_userdata('current_group', 5);
	// 		$this->session->set_userdata('current_group_name', 'District Admin');
	// 	}else if($grp_id == 6){
	// 		$this->session->set_userdata('current_group', 6);
	// 		$this->session->set_userdata('current_group_name', 'Upazila Admin');
	// 	}else if($grp_id == 7){
	// 		$this->session->set_userdata('current_group', 7);
	// 		$this->session->set_userdata('current_group_name', 'Group Admin');
	// 	}else if($grp_id == 8){
	// 		$this->session->set_userdata('current_group', 8);
	// 		$this->session->set_userdata('current_group_name', 'Unit Admin');
	// 	}else if($grp_id == 9){
	// 		$this->session->set_userdata('current_group', 9);
	// 		$this->session->set_userdata('current_group_name', 'Scout Member');
	// 	}else if($grp_id == 10){
	// 		$this->session->set_userdata('current_group', 10);
	// 		$this->session->set_userdata('current_group_name', 'Guest Member');
	// 	}
	// 	echo 1;
	// }

}
