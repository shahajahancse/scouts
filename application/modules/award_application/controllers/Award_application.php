<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Award_application extends Backend_Controller {

	public function __construct(){
        parent::__construct();
        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;

        $this->data['module_title'] = 'Award Application';
        $this->load->model('Common_model'); 
        $this->load->model('scout_member/Scouts_member_model');   
        $this->load->model('program/Program_model');   
        $this->load->model('committee/Committee_model');   
        $this->load->model('Award_model');    
    }

    public function index(){
        redirect('award_application/award_request_list');
    }

    public function shapla_cub_form(){
        $this->form_validation->set_rules('award_id', 'award Id', 'required|trim');
        $this->data['info'] = $this->Scouts_member_model->get_info($this->session->userdata('user_id'));
        $form_user_data = array(
            'scout_id'        => $this->data['info']->id,
            'section_id'      => $this->data['info']->sc_section_id
            );
        $this->data['badge_details']  = $this->Program_model->get_badge_details($form_user_data);
        $this->data['expertness']     = $this->Program_model->get_badge_details_expertness($form_user_data);
        $this->data['achievement']    = $this->Program_model->get_badge_details_achievement($form_user_data);    

        if ($this->form_validation->run() == true){
            $form_data = array(
                'app_scout_id'     => $this->session->userdata('user_id'),
                'curr_region_id'   => $this->data['info']->sc_region_id,
                'curr_district_id' => $this->data['info']->sc_district_id,
                'curr_upazila_id'  => $this->data['info']->sc_upa_tha_id,
                'curr_group_id'    => $this->data['info']->sc_group_id,
                'curr_unit_id'     => $this->data['info']->sc_unit_id,
                'app_award_id'     => $this->input->post('award_id'),
                'app_date'         => date('Y-m-d')
                );
            // print_r($form_data);exit();
            if($this->Award_model->get_exits($this->data['info']->id, $this->data['info']->sc_section_id)<1){
                if($this->Common_model->save('award_application', $form_data)){                
                    $this->session->set_flashdata('success', 'Cub Award request sent successfully.');
                    $this->data['info'] = $this->Training_model->trainer_delete($id);
                    /***********Activity Logs Start**********/
                    $insert_id = $this->db->insert_id();
                    func_activity_log(1, 'shapla cub create data ID :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                    /***********Activity Logs End**********/

                    redirect("award_application/award_request_list");
                }  
            }else{
                $this->session->set_flashdata('success', 'Warring ! Already 3 Times Request Send.');
            }
        }

        // Load page
        $this->data['meta_title'] = 'শাপলা কাব অ্যাওয়ার্ডসুপারিশ ফরম';
        $this->data['subview'] = 'shapla_cub_form';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function president_scout_form(){
        $this->form_validation->set_rules('award_id', 'award Id', 'required|trim');
        $this->data['info'] = $this->Scouts_member_model->get_info($this->session->userdata('user_id'));
        $form_user_data = array(
            'scout_id'        => $this->data['info']->id,
            'section_id'      => $this->data['info']->sc_section_id
            );
        $this->data['badge_details']  = $this->Program_model->get_badge_details($form_user_data);
        $this->data['expertness']     = $this->Program_model->get_badge_details_expertness($form_user_data);
        $this->data['achievement']    = $this->Program_model->get_badge_details_achievement($form_user_data);    

        if ($this->form_validation->run() == true){
            $form_data = array(
                'app_scout_id'     => $this->session->userdata('user_id'),
                'curr_region_id'   => $this->data['info']->sc_region_id,
                'curr_district_id' => $this->data['info']->sc_district_id,
                'curr_upazila_id'  => $this->data['info']->sc_upa_tha_id,
                'curr_group_id'    => $this->data['info']->sc_group_id,
                'curr_unit_id'     => $this->data['info']->sc_unit_id,
                'app_award_id'     => $this->input->post('award_id'),
                'app_date'         => date('Y-m-d')
                );
            // print_r($form_data);exit();
            if($this->Award_model->get_exits($this->data['info']->id, $this->data['info']->sc_section_id)<1){
                if($this->Common_model->save('award_application', $form_data)){

                    /***********Activity Logs Start**********/
                    $insert_id = $this->db->insert_id();
                    func_activity_log(1, 'president scout create data ID :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                    /***********Activity Logs End**********/

                    $this->session->set_flashdata('success', 'President Scout Award request sent successfully.');
                    redirect("award_application/award_request_list");
                }  
            }else{
                $this->session->set_flashdata('success', 'Warring ! Already 3 Times Request Send.');
            }
        }

        // Load page
        $this->data['meta_title'] = "প্রসিডেন্ট'স স্কাউট অ্যাওয়ার্ড সুপারিশ ফরম";
        $this->data['subview'] = 'president_scout_form';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function president_rover_form(){
        $this->form_validation->set_rules('award_id', 'award Id', 'required|trim');
        $this->data['info'] = $this->Scouts_member_model->get_info($this->session->userdata('user_id'));
        $form_user_data = array(
            'scout_id'        => $this->data['info']->id,
            'section_id'      => $this->data['info']->sc_section_id
            );
        $this->data['badge_details']  = $this->Program_model->get_badge_details($form_user_data);
        $this->data['expertness']     = $this->Program_model->get_badge_details_expertness($form_user_data);
        $this->data['achievement']    = $this->Program_model->get_badge_details_achievement($form_user_data);    

        if ($this->form_validation->run() == true){
            $form_data = array(
                'app_scout_id'     => $this->session->userdata('user_id'),
                'curr_region_id'   => $this->data['info']->sc_region_id,
                'curr_district_id' => $this->data['info']->sc_district_id,
                'curr_upazila_id'  => $this->data['info']->sc_upa_tha_id,
                'curr_group_id'    => $this->data['info']->sc_group_id,
                'curr_unit_id'     => $this->data['info']->sc_unit_id,
                'app_award_id'     => $this->input->post('award_id'),
                'app_date'         => date('Y-m-d')
                );
            // print_r($form_data);exit();
            if($this->Award_model->get_exits($this->data['info']->id, $this->data['info']->sc_section_id)<1){
                if($this->Common_model->save('award_application', $form_data)){                
                    $this->session->set_flashdata('success', 'President Rover Award request sent successfully.');
                    /***********Activity Logs Start**********/
                    $insert_id = $this->db->insert_id();
                    func_activity_log(1, ' president rover create data ID :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                    /***********Activity Logs End**********/
                    redirect("award_application/award_request_list");
                }  
            }else{
                $this->session->set_flashdata('success', 'Warring ! Already 3 Times Request Send.');
            }
        }

        // Load page
        $this->data['meta_title'] = "প্রসিডেন্ট'স রোভার স্কাউট অ্যাওয়ার্ড সুপারিশ ফরম";
        $this->data['subview'] = 'president_rover_form';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function award_request_list(){
        $this->data['results'] = $this->Award_model->my_award_request_list();

        // Load page
        $this->data['meta_title'] = 'অ্যাওয়ার্ড সুপারিশ তালিকা';
        $this->data['subview'] = 'award_request_list';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function all_award_request_list(){
        if($this->ion_auth->is_admin() || $this->ion_auth->in_group('award')){
            $this->data['results'] = $this->Award_model->all_award_request_list();

        }elseif($this->ion_auth->is_region_admin()){  
            // $result = $this->Committee_model->get_current_region_from_committee($this->session->userdata('user_id'));
            $officeID = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
            if($officeID){
                $this->data['results'] = $this->Award_model->get_release_region_request_list($officeID);
            }else{
                redirect('dashboard/no_assign');
            }

        }elseif($this->ion_auth->is_district_admin()){
            // $result = $this->Committee_model->get_current_district_from_committee($this->session->userdata('user_id'));
            $officeID = $this->Offices_model->get_district_office_by_user_id($this->userSessID)->id;
            if($officeID){
                $this->data['results'] = $this->Award_model->get_release_district_request_list($officeID);
            }else{
                redirect('dashboard/no_assign');
            }

        }elseif($this->ion_auth->is_upazila_admin()){
            // $result = $this->Committee_model->get_current_upazila_thana_from_committee($this->session->userdata('user_id'));
            $officeID = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID)->id;
            if($officeID){
                $this->data['results'] = $this->Award_model->get_release_upazila_request_list($officeID);
            }else{
                redirect('dashboard/no_assign');
            }

        }elseif($this->ion_auth->is_group_admin()){
            // $result = $this->Committee_model->get_current_scout_group_from_committee($this->session->userdata('user_id'));
            $officeID = $this->Offices_model->get_scout_group_by_user_id($this->userSessID)->id;
            if($officeID){
                $this->data['results'] = $this->Award_model->get_release_group_request_list($officeID);
            }else{
                redirect('dashboard/no_assign');
            }
        }else{
            redirect('dashboard/no_assign');
        }

        // Load page
        $this->data['meta_title'] = 'অ্যাওয়ার্ড সুপারিশ তালিকা';
        $this->data['subview'] = 'award_request_list';
        $this->load->view('backend/_layout_main', $this->data);
    }

    /*************all_award_request_list_pdf function pdf start**************/
    public function all_award_request_list_pdf(){
        
        if($this->ion_auth->is_admin() || $this->ion_auth->in_group('award')){
            $this->data['results'] = $this->Award_model->all_award_request_list();

        }elseif($this->ion_auth->is_region_admin()){  
            // $result = $this->Committee_model->get_current_region_from_committee($this->session->userdata('user_id'));
            $officeID = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
            if($officeID){
                $this->data['results'] = $this->Award_model->get_release_region_request_list($officeID);
            }else{
                redirect('dashboard/no_assign');
            }

        }elseif($this->ion_auth->is_district_admin()){
            // $result = $this->Committee_model->get_current_district_from_committee($this->session->userdata('user_id'));
            $officeID = $this->Offices_model->get_district_office_by_user_id($this->userSessID)->id;
            if($officeID){
                $this->data['results'] = $this->Award_model->get_release_district_request_list($officeID);
            }else{
                redirect('dashboard/no_assign');
            }

        }elseif($this->ion_auth->is_upazila_admin()){
            // $result = $this->Committee_model->get_current_upazila_thana_from_committee($this->session->userdata('user_id'));
            $officeID = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID)->id;
            if($officeID){
                $this->data['results'] = $this->Award_model->get_release_upazila_request_list($officeID);
            }else{
                redirect('dashboard/no_assign');
            }

        }elseif($this->ion_auth->is_group_admin()){
            // $result = $this->Committee_model->get_current_scout_group_from_committee($this->session->userdata('user_id'));
            $officeID = $this->Offices_model->get_scout_group_by_user_id($this->userSessID)->id;
            if($officeID){
                $this->data['results'] = $this->Award_model->get_release_group_request_list($officeID);
            }else{
                redirect('dashboard/no_assign');
            }
        }else{
            redirect('dashboard/no_assign');
        }
        //...............................................................................
        $this->data['meta_title'] = 'অ্যাওয়ার্ড সুপারিশ তালিকা';
        $html = $this->load->view('all_award_request_list_pdf', $this->data, true);   
        $file_name ="all_award_request_list_pdf.pdf";

        //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

        //generate the PDF from the given html
        $mpdf->WriteHTML($html);

        //download it for 'D'. 
        $mpdf->Output($file_name, "D");
    }

    /*************all_award_request_list_pdf function pdf End**************/


    public function award_verify(){
        $id = $_POST['id'];
        $data = array();
        $this->db->trans_begin();

        if($this->ion_auth->is_region_admin()){  
            // $result = $this->Committee_model->get_current_region_from_committee($this->session->userdata('user_id'));
            $officeID = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
            if($officeID){
                $data['app_rgn_id'] = $this->session->userdata('user_id');
                $data['app_rgn_cmnt'] = $_POST['cmnt'];
                $data['app_rgn_approve'] = $_POST['action'];
                $data['app_rgn_approve_date'] = date('Y-m-d');
                $this->Common_model->edit('award_application', $id, 'id', $data);
            }else{
                redirect('dashboard/no_assign');
            }

        }elseif($this->ion_auth->is_district_admin()){
            // $result = $this->Committee_model->get_current_district_from_committee($this->session->userdata('user_id'));
            $officeID = $this->Offices_model->get_district_office_by_user_id($this->userSessID)->id;
            if($officeID){
                $data['app_dis_id'] = $this->session->userdata('user_id');
                $data['app_dis_cmnt'] = $_POST['cmnt'];
                $data['app_dis_approve'] = $_POST['action'];
                $data['app_dis_approve_date'] = date('Y-m-d');
                $this->Common_model->edit('award_application', $id, 'id', $data);
            }else{
                redirect('dashboard/no_assign');
            }

        }elseif($this->ion_auth->is_upazila_admin()){
            // $result = $this->Committee_model->get_current_upazila_thana_from_committee($this->session->userdata('user_id'));
            $officeID = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID)->id;
            if($officeID){
                $data['app_upa_id'] = $this->session->userdata('user_id');
                $data['app_upa_cmnt'] = $_POST['cmnt'];
                $data['app_upa_approve'] = $_POST['action'];
                $data['app_upa_approve_date'] = date('Y-m-d');
                $this->Common_model->edit('award_application', $id, 'id', $data);
            }else{
                redirect('dashboard/no_assign');
            }

        }elseif($this->ion_auth->is_group_admin()){
            // $result = $this->Committee_model->get_current_scout_group_from_committee($this->session->userdata('user_id'));
            $officeID = $this->Offices_model->get_scout_group_by_user_id($this->userSessID)->id;
            if($officeID){
                $data['app_grp_id'] = $this->session->userdata('user_id');
                $data['app_grp_cmnt'] = $_POST['cmnt'];
                $data['app_grp_approve'] = $_POST['action'];
                $data['app_grp_approve_date'] = date('Y-m-d');
                $this->Common_model->edit('award_application', $id, 'id', $data);
            }else{
                redirect('dashboard/no_assign');
            }

        }elseif($this->ion_auth->is_scout_member()){
            redirect('dashboard/no_assign');
        }

        if($this->db->trans_status() == TRUE){
            $this->db->trans_commit();
            echo 1;
        }else{
            echo $this->db->error();
            $this->db->trans_rollback();
        }
    }

    public function award_details($id){
        $this->data['info'] = $this->Scouts_member_model->get_info($this->session->userdata('user_id'));
        if($this->ion_auth->is_admin() || $this->ion_auth->in_group('award')){
            $this->data['info'] = $this->Award_model->get_info($id);

        }elseif($this->ion_auth->is_region_admin()){  
            // $result = $this->Committee_model->get_current_region_from_committee($this->session->userdata('user_id'));
            $officeID = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
            if($officeID){
                $this->data['info'] = $this->Award_model->get_info($id);
            }else{
                redirect('dashboard/no_assign');
            }
        }elseif($this->ion_auth->is_district_admin()){
            // $result = $this->Committee_model->get_current_district_from_committee($this->session->userdata('user_id'));
            $officeID = $this->Offices_model->get_district_office_by_user_id($this->userSessID)->id;
            if($officeID){
                $this->data['info'] = $this->Award_model->get_info($id);
            }else{
                redirect('dashboard/no_assign');
            }
        }elseif($this->ion_auth->is_upazila_admin()){
            // $result = $this->Committee_model->get_current_upazila_thana_from_committee($this->session->userdata('user_id'));
            $officeID = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID)->id;
            if($officeID){
                $this->data['info'] = $this->Award_model->get_info($id);
            }else{
                redirect('dashboard/no_assign');
            }
        }elseif($this->ion_auth->is_group_admin()){
            // $result = $this->Committee_model->get_current_scout_group_from_committee($this->session->userdata('user_id'));
            $officeID = $this->Offices_model->get_scout_group_by_user_id($this->userSessID)->id;
            if($officeID){
                $this->data['info'] = $this->Award_model->get_info($id);
            }else{
                redirect('dashboard/no_assign');
            }
        }elseif($this->ion_auth->is_scout_member()){
            if($this->Award_model->get_exits($this->data['info']->id, $this->data['info']->sc_section_id, $id)>0){
                $this->data['info'] = $this->Award_model->get_info($id);
            }else{
                redirect('dashboard/no_assign');
            }
        }

        $form_user_data = array(
            'scout_id'        => $this->data['info']->id,
            'section_id'      => $this->data['info']->sc_section_id
            );

        $this->data['badge_details']  = $this->Program_model->get_badge_details($form_user_data);
        $this->data['expertness']     = $this->Program_model->get_badge_details_expertness($form_user_data);
        $this->data['achievement']    = $this->Program_model->get_badge_details_achievement($form_user_data);

        $this->data['meta_title'] = 'Details of '.$this->data['info']->award_name;
        $this->data['subview'] = 'details';
        $this->load->view('backend/_layout_main', $this->data);
    }

    /*************award_details_pdf function pdf start**************/
    public function award_details_pdf($id){
        
        $this->data['info'] = $this->Scouts_member_model->get_info($this->session->userdata('user_id'));
        if($this->ion_auth->is_admin() || $this->ion_auth->in_group('award')){
            $this->data['info'] = $this->Award_model->get_info($id);

        }elseif($this->ion_auth->is_region_admin()){  
            // $result = $this->Committee_model->get_current_region_from_committee($this->session->userdata('user_id'));
            $officeID = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
            if($officeID){
                $this->data['info'] = $this->Award_model->get_info($id);
            }else{
                redirect('dashboard/no_assign');
            }
        }elseif($this->ion_auth->is_district_admin()){
            // $result = $this->Committee_model->get_current_district_from_committee($this->session->userdata('user_id'));
            $officeID = $this->Offices_model->get_district_office_by_user_id($this->userSessID)->id;
            if($officeID){
                $this->data['info'] = $this->Award_model->get_info($id);
            }else{
                redirect('dashboard/no_assign');
            }
        }elseif($this->ion_auth->is_upazila_admin()){
            // $result = $this->Committee_model->get_current_upazila_thana_from_committee($this->session->userdata('user_id'));
            $officeID = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID)->id;
            if($officeID){
                $this->data['info'] = $this->Award_model->get_info($id);
            }else{
                redirect('dashboard/no_assign');
            }
        }elseif($this->ion_auth->is_group_admin()){
            // $result = $this->Committee_model->get_current_scout_group_from_committee($this->session->userdata('user_id'));
            $officeID = $this->Offices_model->get_scout_group_by_user_id($this->userSessID)->id;
            if($officeID){
                $this->data['info'] = $this->Award_model->get_info($id);
            }else{
                redirect('dashboard/no_assign');
            }
        }elseif($this->ion_auth->is_scout_member()){
            if($this->Award_model->get_exits($this->data['info']->id, $this->data['info']->sc_section_id, $id)>0){
                $this->data['info'] = $this->Award_model->get_info($id);
            }else{
                redirect('dashboard/no_assign');
            }
        }

        //...............................................................................
        $this->data['meta_title'] = "Details of প্রসিডেন্ট'স স্কাউট অ্যাওয়ার্ড";
        $html = $this->load->view('award_details_pdf', $this->data, true);   
        $file_name ="award_details_pdf.pdf";

        //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

        //generate the PDF from the given html
        $mpdf->WriteHTML($html);

        //download it for 'D'. 
        $mpdf->Output($file_name, "D");
    }

    /*************award_details_pdf function pdf End**************/

    function delete($id) {
        if($this->ion_auth->is_admin() || $this->ion_auth->in_group('award')){
            $this->data['info'] = $this->Award_model->delete($id);

            /***********Activity Logs Start**********/
            //$insert_id = $this->db->insert_id();
            func_activity_log(3, 'Award Request delete ID :'.$id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/

            $this->session->set_flashdata('success', 'Information delete successfully.');
            redirect('award_application/award_request_list');
        }else{
            redirect('dashboard/no_assign'); 
        }  
    }

}