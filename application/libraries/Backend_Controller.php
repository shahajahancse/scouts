<?php
include 'classes/BanglaConverter.php';

class Backend_Controller extends MY_Controller{	
	var $userSessID;
	var $officeSess;

	function __construct (){
		parent::__construct();
		$this->ci_minifier->init(0);

		$this->session->set_userdata('site_lang', 'english');
		$this->lang->load('scouts', 'english');
		
		
		// $this->ci_minifier->init('html');
		
		// $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->form_validation->set_error_delimiters('<div class="alert alert-warning"> <i class="fa fa-warning"></i> ', '</div>');		
		$this->lang->load('auth');
		$this->data['meta_title'] = 'Page Title';			
		$this->data['domain_title'] = 'Bangladesh Scouts';		
		$this->load->model('Common_model');	
		$this->load->model('scouts_member/Scouts_member_model');
		$this->load->model('offices/Offices_model');
		$this->load->model('committee/Committee_model');
		$this->userSessID = $this->session->userdata('user_id');
		$this->officeSess = $this->session->userdata('is_office');

		if($this->ion_auth->logged_in()){
			// echo '<pre>';
			// print_r($this->session->all_userdata()); exit;

			if($this->ion_auth->is_scout_member() || $this->ion_auth->is_guest()){
				$this->data['userDetails'] = $this->Common_model->get_user_details();	
				// print_r($this->data['userDetails']['user_info']); exit;
				// $region = $this->data['userDetails']['user_info']->sc_region_id;
				// $district = $this->data['userDetails']['user_info']->sc_district_id;
				// $this->data['count_upcoming_event'] = $this->Common_model->upcoming_events($region, $district);
				// $this->data['officeDetails'] = array();
				// $this->data['officeName'] ='';
				$newSessData = array(
					'sc_nhq_id'			=> NULL,
					'sc_region_id'  	=> $this->data['userDetails']['user_info']->sc_region_id,
					'sc_district_id'	=> $this->data['userDetails']['user_info']->sc_district_id,
					'sc_upazila_id' 	=> $this->data['userDetails']['user_info']->sc_upa_tha_id,
					'sc_group_id' 		=> $this->data['userDetails']['user_info']->sc_group_id
					);
				$this->session->set_userdata($newSessData);

			}elseif($this->ion_auth->is_admin() || $this->ion_auth->in_group('monitor_team')){
				$officeID = $this->Offices_model->get_nhq_office_by_user_id($this->userSessID)->id;
				$this->data['officeDetails'] = $this->Offices_model->get_nhq_user_info($officeID);
				$this->data['officeName'] = $this->data['officeDetails']->nhq_office_name;
				// print_r($this->data['officeName']); exit;
				$newSessData = array(
					'sc_nhq_id'			=> $this->data['officeDetails']->id,
					'sc_region_id'  	=> NULL,
					'sc_district_id'	=> NULL,
					'sc_upazila_id' 	=> NULL,
					'sc_group_id' 		=> NULL
					);
				$this->session->set_userdata($newSessData);

			}elseif($this->ion_auth->in_group('monitor_team')){
				$officeID = $this->Offices_model->get_nhq_office_by_user_id($this->userSessID)->id;
				$this->data['officeDetails'] = $this->Offices_model->get_nhq_user_info($officeID);
				$this->data['officeName'] = $this->data['officeDetails']->nhq_office_name;
				// print_r($this->data['officeName']); exit;
				$newSessData = array(
					'sc_nhq_id'			=> $this->data['officeDetails']->id,
					'sc_region_id'  	=> NULL,
					'sc_district_id'	=> NULL,
					'sc_upazila_id' 	=> NULL,
					'sc_group_id' 		=> NULL
					);
				$this->session->set_userdata($newSessData);

			}elseif($this->ion_auth->is_scout_admin()){
				$officeID = $this->Offices_model->get_nhq_office_by_user_id($this->userSessID)->id;
				$this->data['officeDetails'] = $this->Offices_model->get_nhq_user_info($officeID);
				$this->data['officeName'] = $this->data['officeDetails']->nhq_office_name;
				$newSessData = array(
					'sc_nhq_id'			=> $this->data['officeDetails']->id,
					'sc_region_id'  	=> NULL,
					'sc_district_id'	=> NULL,
					'sc_upazila_id' 	=> NULL,
					'sc_group_id' 		=> NULL
					);
				$this->session->set_userdata($newSessData);

			}elseif($this->ion_auth->in_group('award')){
				$officeID = $this->Offices_model->get_nhq_office_by_user_id($this->userSessID)->id;
				$this->data['officeDetails'] = $this->Offices_model->get_nhq_user_info($officeID);
				$this->data['officeName'] = $this->data['officeDetails']->nhq_office_name;
				$newSessData = array(
					'sc_nhq_id'			=> $this->data['officeDetails']->id,
					'sc_region_id'  	=> NULL,
					'sc_district_id'	=> NULL,
					'sc_upazila_id' 	=> NULL,
					'sc_group_id' 		=> NULL
					);
				$this->session->set_userdata($newSessData);

			}elseif($this->ion_auth->in_group('event')){
				$officeID = $this->Offices_model->get_nhq_office_by_user_id($this->userSessID)->id;
				$this->data['officeDetails'] = $this->Offices_model->get_nhq_user_info($officeID);
				$this->data['officeName'] = $this->data['officeDetails']->nhq_office_name;
				$newSessData = array(
					'sc_nhq_id'			=> $this->data['officeDetails']->id,
					'sc_region_id'  	=> NULL,
					'sc_district_id'	=> NULL,
					'sc_upazila_id' 	=> NULL,
					'sc_group_id' 		=> NULL
					);
				$this->session->set_userdata($newSessData);

			}elseif($this->ion_auth->in_group('training')){
				$officeID = $this->Offices_model->get_nhq_office_by_user_id($this->userSessID)->id;
				$this->data['officeDetails'] = $this->Offices_model->get_nhq_user_info($officeID);
				$this->data['officeName'] = $this->data['officeDetails']->nhq_office_name;
				$newSessData = array(
					'sc_nhq_id'			=> $this->data['officeDetails']->id,
					'sc_region_id'  	=> NULL,
					'sc_district_id'	=> NULL,
					'sc_upazila_id' 	=> NULL,
					'sc_group_id' 		=> NULL
					);
				$this->session->set_userdata($newSessData);


			}elseif($this->ion_auth->is_region_admin()){
				$officeID = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
				$this->data['officeDetails'] = $this->Offices_model->get_region_info($officeID);
				$this->data['officeName'] = $this->data['officeDetails']->region_name_en;
				$newSessData = array(
					'sc_nhq_id'			=> NULL,
					'sc_region_id'  	=> $this->data['officeDetails']->id,
					'sc_district_id'	=> NULL,
					'sc_upazila_id' 	=> NULL,
					'sc_group_id' 		=> NULL
					);
				$this->session->set_userdata($newSessData);				

			}elseif($this->ion_auth->is_district_admin()){
				$officeID = $this->Offices_model->get_district_office_by_user_id($this->userSessID)->id;
				$this->data['officeDetails'] = $this->Offices_model->get_scout_district_info($officeID);
				$this->data['officeName'] = $this->data['officeDetails']->dis_name_en;
				$newSessData = array(
					'sc_nhq_id'			=> NULL,
					'sc_region_id'  	=> $this->data['officeDetails']->dis_scout_region_id,
					'sc_district_id'	=> $this->data['officeDetails']->id,
					'sc_upazila_id' 	=> NULL,
					'sc_group_id' 		=> NULL
					);
				$this->session->set_userdata($newSessData);				

			}elseif($this->ion_auth->is_upazila_admin()){
				$officeID = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID)->id;
				$this->data['officeDetails'] = $this->Offices_model->get_scout_upazila_info($officeID);
				// print_r($this->data['officeDetails']);
				$this->data['officeName'] = $this->data['officeDetails']->upa_name;	
				$newSessData = array(
					'sc_nhq_id'			=> NULL,
					'sc_region_id'  	=> $this->data['officeDetails']->upa_region_id,
					'sc_district_id'	=> $this->data['officeDetails']->upa_scout_dis_id,
					'sc_upazila_id' 	=> $this->data['officeDetails']->id,
					'sc_group_id' 		=> NULL
					);
				$this->session->set_userdata($newSessData);	

			}elseif($this->ion_auth->is_group_admin()){
				$officeID = $this->Offices_model->get_scout_group_by_user_id($this->userSessID)->id;
				$this->data['officeDetails'] = $this->Offices_model->get_scout_group_info($officeID);
				$this->data['officeName'] = $this->data['officeDetails']->grp_name;	
				$newSessData = array(
					'sc_nhq_id'			=> NULL,
					'sc_region_id'  	=> $this->data['officeDetails']->grp_region_id,
					'sc_district_id'	=> $this->data['officeDetails']->grp_scout_dis_id,
					'sc_upazila_id' 	=> $this->data['officeDetails']->grp_scout_upa_id,
					'sc_group_id' 		=> $this->data['officeDetails']->id
					);
				$this->session->set_userdata($newSessData);
				

				// Scout new member request
				$this->data['count_member_req'] = 0;
				$results = $this->Scouts_member_model->get_request_member($officeID); 
				$this->data['count_member_req'] = count($results);

				// Release Group Request List 
				$release_grp_mig_results = $this->Scouts_member_model->get_release_group_migration_request($officeID);
				$this->data['count_req_release_grp_mig'] = count($release_grp_mig_results);

				// Migration Group Request List 
				$migrate_grp_mig_results = $this->Scouts_member_model->get_migrate_group_migration_request($officeID);
				//die($this->db->last_query());
				$this->data['count_req_migrate_grp_mig'] = count($migrate_grp_mig_results);

				// Release Section Request List 
				/*$release_sec_mig_results = $this->Scouts_member_model->get_release_section_migration_request($officeID); 
				$this->data['count_req_release_section_mig'] = count($release_sec_mig_results);*/

				// Migration Section Request List 
				$migrate_sec_mig_results = $this->Scouts_member_model->get_migrate_section_migration_request($officeID); 
				//die($this->db->last_query());
				$this->data['count_req_migrate_section_mig'] = count($migrate_sec_mig_results);

				// Total Migration Request List
				$this->data['count_req_total_grp_mig'] = $this->data['count_req_release_grp_mig'] + $this->data['count_req_migrate_grp_mig'] + $this->data['count_req_migrate_section_mig'];

			}elseif($this->ion_auth->is_vendor()){
				$officeID = $this->Offices_model->get_nhq_office_by_user_id($this->userSessID)->id;
				$this->data['officeDetails'] = $this->Offices_model->get_nhq_user_info($officeID);
				$this->data['officeName'] = $this->data['officeDetails']->nhq_office_name;
				$newSessData = array(
					'sc_nhq_id'			=> $this->data['officeDetails']->id,
					'sc_region_id'  	=> NULL,
					'sc_district_id'	=> NULL,
					'sc_upazila_id' 	=> NULL,
					'sc_group_id' 		=> NULL
					);
				$this->session->set_userdata($newSessData);
            
			}elseif($this->ion_auth->is_employee()){
				$this->data['userDetails'] = $this->Common_model->get_user_details();

				$this->data['e_nathi_department'] = $this->Common_model->e_nathi_department($this->data['userDetails']['user_info']->id);

				$this->data['departmentDetails'] = $this->Common_model->get_single_ingo('department','id',$this->data['e_nathi_department']->emp_department);

       			$this->data['designationDetails'] = $this->Common_model->get_single_ingo('designation','id',$this->data['e_nathi_department']->emp_designation);
			}

			// Profile completeness score
			//$this->data['userDetails'] = $this->Common_model->get_user_details();
			// print_r($userDetails); exit;			

			// User Groups
			// $users_groups = $this->ion_auth_model->get_users_groups()->result();
			// $groups_array = array();
			// foreach ($users_groups as $group){
			// 	$groups_array[$group->id] = $group->description;
			// }
			// $this->data['userGroups'] = implode(',', $groups_array);

			// $this->data['count_req_menter']=0;
		}
	}

}