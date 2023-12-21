<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration extends Backend_Controller {	

	public function __construct(){
        parent::__construct();
        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;

        $this->data['module_title'] = 'Migration';
        $this->load->model('Common_model'); 
        $this->load->model('Scouts_member_model'); 
        $this->load->model('Migration_model'); 
    }

	public function index(){
        redirect('migration/my_group_migration_list');
	}

    public function group_migration_application(){
        $this->form_validation->set_rules('mig_reasons', 'migration reasons', 'required|trim');
        $this->form_validation->set_rules('mig_region_id', 'scout region', 'required|trim');
        $this->form_validation->set_rules('mig_district_id', 'scout district', 'required|trim');
        $this->form_validation->set_rules('mig_group_id', 'scout group', 'required|trim');
        // $this->form_validation->set_rules('sc_unit_id', 'scout unit', 'required|trim');
        $this->data['info'] = $this->Scouts_member_model->get_info($this->session->userdata('user_id')); 

        // echo '<pre>';  
        // print_r($this->data['info']); exit;

        if ($this->form_validation->run() == true){
            $form_data = array(
                'mig_user_id'     => $this->session->userdata('user_id'),
                'curr_region_id'   => $this->data['info']->sc_region_id,
                'curr_district_id' => $this->data['info']->sc_district_id,
                'curr_upazila_id'  => $this->data['info']->sc_upa_tha_id,
                'curr_group_id'    => $this->data['info']->sc_group_id,
                'curr_unit_id'     => $this->data['info']->sc_unit_id,
                'mig_reasons'      => $this->input->post('mig_reasons'),
                'mig_region_id'    => $this->input->post('mig_region_id'),
                'mig_district_id'  => $this->input->post('mig_district_id'),
                'mig_upazila_id'   => $this->input->post('mig_upazila_id'),
                'mig_group_id'     => $this->input->post('mig_group_id'),
                'mig_unit_id'      => $this->input->post('sc_unit_id'),
                'created'          => date('Y-m-d H:i:s')
            );
            // print_r($form_data);exit();
            if($this->Common_model->save('migration_group', $form_data)){                
                $this->session->set_flashdata('success', 'Migration request sent successfully.');
                $insert_id = $this->db->insert_id();
                func_activity_log(1, 'Group migration application create ID :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                redirect("migration/my_group_migration_list");
            } 
        }
        $this->data['regions'] = $this->Common_model->get_regions(); 

        // Load page
        $this->data['meta_title'] = 'Application for migration group';
        $this->data['subview'] = 'group_migration_application';
        $this->load->view('backend/_layout_main', $this->data);
    }

    /*************group_migration_application_pdf funtion Start for pdf*************/
    public function group_migration_application_pdf(){
        $this->data['info'] = $this->Scouts_member_model->get_info($this->session->userdata('user_id'));

        //...............................................................................
        $this->data['meta_title'] = 'Application for migration group';
        $html = $this->load->view('group_migration_application_pdf', $this->data, true);   
        $file_name ="group_migration_application_pdf.pdf";

        //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

        //generate the PDF from the given html
        $mpdf->WriteHTML($html);

        //download it for 'D'. 
        $mpdf->Output($file_name, "D");
    }
    /*************group_migration_application_pdf funtion End for pdf*************/

    public function section_migration_application(){
        $this->form_validation->set_rules('mig_reasons', 'migration reasons', 'required|trim');
        $this->form_validation->set_rules('mig_section_id', 'scout section', 'required|trim');
        $this->form_validation->set_rules('mig_section_id', 'scout section', 'required|trim');
        // $this->form_validation->set_rules('mig_region_id', 'scout region', 'required|trim');
        // $this->form_validation->set_rules('mig_district_id', 'scout district', 'required|trim');
        // $this->form_validation->set_rules('mig_group_id', 'scout group', 'required|trim');

        $this->data['info'] = $this->Scouts_member_model->get_info($this->session->userdata('user_id'));  
        /*echo '<pre>';
        print_r($this->data['info']); exit;*/

        if ($this->form_validation->run() == true){
            $form_data = array(
                'mig_user_id'       => $this->session->userdata('user_id'),
                'curr_member_id'    => $this->data['info']->member_id,
                'curr_section_id'   => $this->data['info']->sc_section_id,
                'curr_badge_id'     => $this->data['info']->sc_badge_id,
                'curr_role_id'      => $this->data['info']->sc_role_id,
                'curr_region_id'    => $this->data['info']->sc_region_id,
                'curr_district_id'  => $this->data['info']->sc_district_id,
                'curr_upazila_id'   => $this->data['info']->sc_upa_tha_id,
                'curr_group_id'     => $this->data['info']->sc_group_id,
                'curr_unit_id'      => $this->data['info']->sc_unit_id,
                'mig_member_id'     => $this->input->post('mig_member_id'),
                'mig_reasons'       => $this->input->post('mig_reasons'),
                'mig_section_id'    => $this->input->post('mig_section_id'),
                'mig_badge_id'      => $this->input->post('mig_badge_id'),
                'mig_role_id'       => $this->input->post('mig_role_id'),
                /*'mig_region_id'    => $this->input->post('mig_region_id'),
                'mig_district_id'  => $this->input->post('mig_district_id'),
                'mig_upazila_id'   => $this->input->post('mig_upazila_id'),
                'mig_group_id'     => $this->input->post('mig_group_id'),
                'mig_unit_id'      => $this->input->post('sc_unit_id'),*/
                'created'          => date('Y-m-d H:i:s')
            );
            // print_r($form_data);exit();
            if($this->Common_model->save('migration_section', $form_data)){                
                $this->session->set_flashdata('success', 'Migration request sent successfully.');
                $insert_id = $this->db->insert_id();
                func_activity_log(1, 'Section migration application create ID :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                redirect("migration/my_section_migration_list");
            } 
        }

        $this->data['member_type'] = $this->Common_model->get_member_type();
        // $this->data['regions'] = $this->Common_model->get_regions(); 
        $this->data['scout_section'] = $this->Common_model->set_scout_section();

        // Load page
        $this->data['meta_title'] = 'Application for migration section';
        $this->data['subview'] = 'section_migration_application';
        $this->load->view('backend/_layout_main', $this->data);
    }

    /*********section_migration_application_pdf funtion start*****************/
    public function section_migration_application_pdf(){
        $this->data['info'] = $this->Scouts_member_model->get_info($this->session->userdata('user_id'));

        //...............................................................................
        $this->data['meta_title'] = 'Current Scout Information';
        $html = $this->load->view('section_migration_application_pdf', $this->data, true);   
        $file_name ="section_migration_application_pdf.pdf";

        //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

        //generate the PDF from the given html
        $mpdf->WriteHTML($html);

        //download it for 'D'. 
        $mpdf->Output($file_name, "D");

    }
    /*********section_migration_application_pdf funtion End*****************/

    public function my_group_migration_list(){
        $this->data['results'] = $this->Migration_model->get_my_migration_list();

        // Load page
        $this->data['meta_title'] = 'My Group Migration List';
        $this->data['subview'] = 'my_group_migration_list';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function my_group_migration_list_pdf(){
        $this->data['results'] = $this->Migration_model->get_my_migration_list();

        //...............................................................................
        $this->data['meta_title'] = 'My Group Migration List';
        $html = $this->load->view('my_group_migration_list_pdf', $this->data, true);   
        $file_name ="my_group_migration_list_pdf.pdf";

        //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

        //generate the PDF from the given html
        $mpdf->WriteHTML($html);

        //download it for 'D'. 
        $mpdf->Output($file_name, "D");
    }

    public function my_section_migration_list(){
        $this->data['results'] = $this->Migration_model->get_my_section_migration_list();

        // Load page
        $this->data['meta_title'] = 'My Section Migration List';
        $this->data['subview'] = 'my_section_migration_list';
        $this->load->view('backend/_layout_main', $this->data);
    }

    /*************my_section_migration_list_pdf function pdf start**************/
    public function my_section_migration_list_pdf(){
        $this->data['results'] = $this->Migration_model->get_my_migration_list();

        //...............................................................................
        $this->data['meta_title'] = 'My Section Migration List';
        $html = $this->load->view('my_section_migration_list_pdf', $this->data, true);   
        $file_name ="my_section_migration_list_pdf.pdf";

        //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

        //generate the PDF from the given html
        $mpdf->WriteHTML($html);

        //download it for 'D'. 
        $mpdf->Output($file_name, "D");
    }

    /*************my_section_migration_list_pdf function pdf End**************/

    // public function details($id){
    //     // $this->data['users'] = $this->ion_auth->user()->row();
    //     $this->data['info'] = $this->Migration_model->get_info($id);
    //     // $this->data['scout_member_list'] = $this->Migration_model->get_scout_member_list($id);
    //     // $this->data['scout_member'] = $this->Migration_model->get_scout_member($id, $this->data['users']->id);

    //     $this->data['meta_title'] = 'Details Migration ';
    //     $this->data['subview'] = 'details';
    //     $this->load->view('backend/_layout_main', $this->data);
    // }

    public function release_group_verify($id)
    {
        $this->data['info'] = $this->Migration_model->get_info($id);

        $this->data['meta_title'] = 'Details Migration Application ';
        $this->data['subview'] = 'release_group_verify_details';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function release_section_verify($id)
    {
        $this->data['info'] = $this->Migration_model->get_section_info($id);

        $this->data['meta_title'] = 'Details Migration Application ';
        $this->data['subview'] = 'release_section_verify_details';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function migrate_group_verify($id)
    {
        $this->data['info'] = $this->Migration_model->get_info($id);

        $this->data['meta_title'] = 'Details Migration Verify ';
        $this->data['subview'] = 'migrate_group_verify_details';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function migrate_section_verify($id)
    {
        $this->data['info'] = $this->Migration_model->get_section_info($id);

        $this->data['meta_title'] = 'Details Migration Verify ';
        $this->data['subview'] = 'migrate_section_verify_details';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function upcomming_event_list(){
        $this->data['event'] = $this->Migration_model->upcomming_event();
        // Load page
        $this->data['meta_title'] = 'Upcomming Event List';
        $this->data['subview'] = 'event_list';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function upcomming_event(){       
        $this->data['event'] = $this->Migration_model->scout_member_event();
        // Load page
        $this->data['meta_title'] = 'Upcomming Event';
        $this->data['subview'] = 'event_list';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function my_event(){       
        $this->data['event'] = $this->Migration_model->get_scout_member_approved();
        // Load page
        $this->data['meta_title'] = 'Upcomming Event';
        $this->data['subview'] = 'my_event_list';
        $this->load->view('backend/_layout_main', $this->data);
    }
 

    

    public function comments($id){
        $this->data['users'] = $this->ion_auth->user()->row();
        $this->data['event_id'] = $id;

        $this->data['training'] = $this->Migration_model->get_info($id);

        if($this->Migration_model->get_event_valid($id)==false){
            redirect('events/my_event');
        }

        $this->form_validation->set_rules('comments', 'comments', 'required|trim');

        if ($this->form_validation->run() == true){
            
            $form_data = array(
                'comments' => $this->input->post('comments')
            );
            //print_r($form_data);exit();
            
           if($this->Migration_model->edit('event_to_scouts', $this->data['users']->id, $id,  $form_data)){                
                $this->session->set_flashdata('success', 'Successfully send your comments.');
                redirect('events/my_event'); 
            } 
            redirect('events/my_event');     
        }

        $this->data['meta_title'] = 'Event Comments';
        $this->data['subview'] = 'comments';
        $this->load->view('backend/_layout_main', $this->data);
    }

   public function edit($id){

        $this->data['users'] = $this->ion_auth->user()->row();

        $this->form_validation->set_rules('event_title', 'Event Title', 'required|trim');
        $this->form_validation->set_rules('event_venu', 'Event Venu', 'required|trim');
        $this->form_validation->set_rules('event_details', 'Event Details', 'required|trim');
        $this->form_validation->set_rules('event_start_date', ' To Date', 'required|trim');
        $this->form_validation->set_rules('event_end_date', 'From Date', 'required|trim');
        $this->form_validation->set_rules('event_type', 'Event Type', 'required|trim');
        $this->form_validation->set_rules('event_notify[]', 'Event Notify', 'required|trim');
        $this->form_validation->set_rules('sc_region_id', 'scout region', 'required|trim');
        $this->form_validation->set_rules('sc_district_id', 'scout district', 'required|trim');
        $this->form_validation->set_rules('sc_upa_tha_id', 'scout upazila/thana', 'required|trim');
        $this->form_validation->set_rules('sc_group_id', 'scout group', 'required|trim');

        if(count($this->input->post('event_notify'))>0){
            $this->data['event_notify_data']=$this->input->post('event_notify');
        }else{
            $this->data['event_notify_data']=array();
        }

        if ($this->form_validation->run() == true){

            $this->data['event_notify']=implode(',', $this->input->post('event_notify'));
            
            $form_data = array(
                'event_title'       => $this->input->post('event_title'),
                'event_venu'        => $this->input->post('event_venu'),
                'event_details'     => $this->input->post('event_details'),
                'event_start_date'  => $this->input->post('event_start_date'),
                'event_end_date'    => $this->input->post('event_end_date'),
                'event_type'        => $this->input->post('event_type'),
                'sc_region_id'      => $this->input->post('sc_region_id'),
                'sc_district_id'    => $this->input->post('sc_district_id'),
                'sc_upa_tha_id'     => $this->input->post('sc_upa_tha_id'),
                'sc_group_id'       => $this->input->post('sc_group_id'),
                'event_notify'      => $this->data['event_notify'],
                'created_by'        => $this->data['users']->id,
            );
            //print_r($form_data);exit();
           
            if($this->input->post('event_end_date')>=$this->input->post('event_start_date')){
               if($this->Common_model->edit('events', $id, 'id', $form_data)){                
                    $this->session->set_flashdata('success', 'Event Update successfully.');
                    redirect("events/event_list");
                } 
            }else{
                $this->session->set_flashdata('warning', 'End Date Lessthen Start Date');
            }       
        }

        $this->data['event'] = $this->Migration_model->get_info($id);
        //dropdown
       
        $this->data['divisions'] = $this->Common_model->get_division(); 
        $this->data['districts'] = $this->Common_model->get_district(); 
        $this->data['upazilas'] = $this->Common_model->get_upazila_thana(); 
        $this->data['regions'] = $this->Common_model->get_regions(); 
        $this->data['scout_districts'] = $this->Common_model->get_scout_districts(); 
        $this->data['scout_upazila_thana'] = $this->Common_model->get_scout_upazila_thana(); 
        $this->data['scout_group'] = $this->Common_model->get_scout_group_office(); 
        $this->data['scout_unit'] = $this->Common_model->get_scout_unit_office();
        $this->data['scout_section'] = $this->Common_model->set_scout_section();

        // Load page
        $this->data['meta_title'] = 'Edit Event';
        $this->data['subview'] = 'edit_event';
        $this->load->view('backend/_layout_main', $this->data);
    }

    function status($scout_id, $event_id, $status) {
        $this->data['users'] = $this->ion_auth->user()->row();

        if($status==1){
            $status_data='Interested';
        }
        if($status==2){
            $status_data='Not Interested';
        }
        if($status==3){
            $status_data='Approved';
        }
        if($status==4){
            $status_data='Not Approved';
        }
        $form_data = array(
            'status'       => $status_data,
            'approved_by'  => $this->data['users']->id
        );

        $form_data2 = array(
            'scout_id'     => $this->data['users']->id,
            'event_id'     => $event_id,
            'status'       => $status_data
        );

        if(empty($this->Migration_model->get_scout_member($event_id, $scout_id))){

            if($this->Common_model->save('event_to_scouts', $form_data2)){
                $this->session->set_flashdata('success', 'Information update successfully.'); 
            }else{
                $this->session->set_flashdata('warning', 'Information update unsuccessfully.');
            }
        }else{
            if($this->Migration_model->edit('event_to_scouts', $scout_id, $event_id, $form_data)){
                $this->session->set_flashdata('success', 'Information update successfully.'); 
            }else{
                $this->session->set_flashdata('warning', 'Information update unsuccessfully.');
            }
        }

        redirect('events/details/'.$event_id);
    }

    function delete($id) {
        $this->data['info'] = $this->Migration_model->delete($id);
        $this->session->set_flashdata('success', 'Information delete successfully.');
        redirect('events/event_list');
    }

    public function current_group_verify()
    {
        $migration_id = $_POST['id'];

        $data = array();
        $data['curr_group_admin_id'] = $this->session->userdata('user_id');
        $data['curr_group_admin_cmnts'] = $_POST['cmnt'];
        $data['curr_group_verify'] = $_POST['action'];

        if($this->Common_model->edit('migration_group', $migration_id, 'id', $data))
        {
            echo 1;
        }
    }

    public function current_section_verify()
    {
        $migration_id = $_POST['id'];

        $data = array();
        $data['curr_group_admin_id'] = $this->session->userdata('user_id');
        $data['curr_group_admin_cmnts'] = $_POST['cmnt'];
        $data['curr_group_verify'] = $_POST['action'];

        if($this->Common_model->edit('migration_section', $migration_id, 'id', $data))
        {
            echo 1;
        }
    }

    public function migration_group_verify()
    {
        $migration_id = $_POST['id'];

        $data = array();
        $data['mig_group_verify_id'] = $this->session->userdata('user_id');
        $data['mig_group_cmnts'] = $_POST['cmnt'];
        $data['mig_group_verify'] = $_POST['action'];

        $this->db->trans_begin();

        $this->Common_model->edit('migration_group', $migration_id, 'id', $data);
        
        $migration_details = $this->Migration_model->get_info($migration_id);

        $update_user_data = array();
        $update_user_data['sc_region_id'] = $migration_details->mig_region_id;
        $update_user_data['sc_district_id'] = $migration_details->mig_district_id;
        $update_user_data['sc_upa_tha_id'] = $migration_details->mig_upazila_id;
        $update_user_data['sc_group_id'] = $migration_details->mig_group_id;
        $update_user_data['sc_unit_id'] = $migration_details->mig_unit_id;

        $this->Common_model->edit('users', $migration_details->mig_user_id, 'id', $update_user_data);

        if($this->db->trans_status() == TRUE)
        {
            $this->db->trans_commit();

            echo 1;
        }
        else
        {
            echo $this->db->error();

            $this->db->trans_rollback();
        }
    }

    public function migration_section_verify()
    {
        $migration_id = $_POST['id'];

        $data = array();
        $data['mig_group_verify_id'] = $this->session->userdata('user_id');
        $data['mig_group_cmnts'] = $_POST['cmnt'];
        $data['mig_group_verify'] = $_POST['action'];

        $this->db->trans_begin();
        $this->Common_model->edit('migration_section', $migration_id, 'id', $data);
        
        $migration_details = $this->Migration_model->get_section_info($migration_id);

        /*echo '<pre>';
        print_r($migration_details); exit;*/

        $update_user_data = array();

        $update_user_data['sc_section_id'] = $migration_details->mig_section_id;
        $update_user_data['sc_badge_id'] = $migration_details->mig_badge_id;
        $update_user_data['sc_role_id'] = $migration_details->mig_role_id;

        /*$update_user_data['sc_region_id'] = $migration_details->mig_region_id;
        $update_user_data['sc_district_id'] = $migration_details->mig_district_id;
        $update_user_data['sc_upa_tha_id'] = $migration_details->mig_upazila_id;
        $update_user_data['sc_group_id'] = $migration_details->mig_group_id;
        $update_user_data['sc_unit_id'] = $migration_details->mig_unit_id;*/

        $this->Common_model->edit('users', $migration_details->mig_user_id, 'id', $update_user_data);

        if($this->db->trans_status() == TRUE){
            $this->db->trans_commit();
            echo 1;
        } else {
            echo $this->db->error();
            $this->db->trans_rollback();
        }
    }

    public function release_group_request_list(){
        if($this->ion_auth->is_group_admin()){
           // $result = $this->Committee_model->get_current_scout_group_from_committee($this->session->userdata('user_id'));
            $officeID = $this->Offices_model->get_scout_group_by_user_id($this->userSessID);
            if($officeID){
                // die($result->office_sc_group_id);
                $this->data['results'] = $this->Migration_model->get_release_group_request_list($officeID->id);
                
                // Load page
                $this->data['meta_title'] = 'Release Member Request List';
                $this->data['subview'] = 'release_group_request_list';
                $this->load->view('backend/_layout_main', $this->data);

                // $this->data['results'] = $this->Scouts_member_model->get_request_member($result->office_sc_group_id); 
            } else {
                redirect('dashboard/no_assign');
            }
        }
    }

    public function release_section_request_list() {
        if($this->ion_auth->is_group_admin()) {
            //$result = $this->Committee_model->get_current_scout_group_from_committee($this->session->userdata('user_id'));
            $officeID = $this->Offices_model->get_scout_group_by_user_id($this->userSessID);
            if($officeID){
                $this->data['results'] = $this->Migration_model->get_release_section_request_list($officeID->id);
                
                // Load page
                $this->data['meta_title'] = 'Release Section Request List';
                $this->data['subview'] = 'release_section_request_list';
                $this->load->view('backend/_layout_main', $this->data); 
            } else {
                redirect('dashboard/no_assign');
            }
        }
    }

    public function migrate_group_request_list() {
        if($this->ion_auth->is_group_admin()) {
            // $result = $this->Committee_model->get_current_scout_group_from_committee($this->session->userdata('user_id'));
            $officeID = $this->Offices_model->get_scout_group_by_user_id($this->userSessID);
            if($officeID){
                $this->data['results'] = $this->Migration_model->get_migrate_group_request_list($officeID->id);
                
                // Load page
                $this->data['meta_title'] = 'Migrate Member Request List';
                $this->data['subview'] = 'migrate_group_request_list';
                $this->load->view('backend/_layout_main', $this->data); 
            } else {
                redirect('dashboard/no_assign');
            }
        }
    }

    public function migrate_section_request_list() {
        if($this->ion_auth->is_group_admin()) {
            //$result = $this->Committee_model->get_current_scout_group_from_committee($this->session->userdata('user_id'));
            $officeID = $this->Offices_model->get_scout_group_by_user_id($this->userSessID);
            if($officeID){
                $this->data['results'] = $this->Migration_model->get_migrate_section_request_list($officeID->id);
                
                // Load page
                $this->data['meta_title'] = 'Migrate Section Request List';
                $this->data['subview'] = 'migrate_section_request_list';
                $this->load->view('backend/_layout_main', $this->data); 
            } else {
                redirect('dashboard/no_assign');
            }
        }
    }

}