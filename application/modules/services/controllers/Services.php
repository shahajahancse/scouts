<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
> Public request a service to NHQ or Region
> Every level office can change service request, cancel request, complete list, cencel list
> NHQ can Assign to Region, Distric, Upazila or Scouts Group
> Region can Assign to District, Upazila or Scouts Group
>
*/

class Services extends Backend_Controller {	

	public function __construct(){
        parent::__construct();
        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;

        $this->data['module_title'] = 'Services';
        $this->load->model('Common_model'); 
        $this->load->model('Services_model');     
        $this->load->model('offices/Offices_model');
    }

    public function index(){
        if(!$this->ion_auth->is_admin()){
            redirect('dashboard');
        }
        redirect('services/services_list');
    }



    public function request_list($offset=0){
        $limit = 25;
        
        if($this->ion_auth->is_admin()){
            $requestTo = 'NHQ';
            //Result
            $results = $this->Services_model->get_data($limit, $offset, 1, 'Pending');            
        }elseif($this->ion_auth->is_region_admin()){
            $requestTo = 'Region';
            //Result
            $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
            $results = $this->Services_model->get_data($limit, $offset, 2, 'Pending',$region);
        }else{
            redirect('dashboard');
        }

        //Results
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = count($results['rows']);

        //pagination
        $this->data['pagination'] = create_pagination('services/request_list/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

        // Load page
        $this->data['meta_title'] = $requestTo .' Service Request List';
        $this->data['subview'] = 'request_list';
        $this->load->view('backend/_layout_main', $this->data);
    } 

    /*************request_list_pdf function pdf start**************/
    public function request_list_pdf($offset=0){
        $limit = 25;
        
        if($this->ion_auth->is_admin()){
            $requestTo = 'NHQ';
            //Result
            $results = $this->Services_model->get_data($limit, $offset, 1, 'Pending');            
        }elseif($this->ion_auth->is_region_admin()){
            $requestTo = 'Region';
            //Result
            $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
            $results = $this->Services_model->get_data($limit, $offset, 2, 'Pending',$region);
        }else{
            redirect('dashboard');
        }

        //Results
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = count($results['rows']);
      
      //...............................................................................
      $this->data['meta_title'] = "Service Request List";
      $html = $this->load->view('request_list_pdf', $this->data, true);   
      $file_name ="request_list_pdf.pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'. 
      $mpdf->Output($file_name, "D");
   }
   /*************request_list_pdf function pdf End**************/

    public function complete_list($offset=0){
        $limit = 25;

        if($this->ion_auth->is_admin()){
            $requestTo = 'NHQ';
            //Result
            $results = $this->Services_model->get_data($limit, $offset, 1, 'Complete');            
        }elseif($this->ion_auth->is_region_admin()){
            $requestTo = 'Region';
            //Result
            $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
            $results = $this->Services_model->get_data($limit, $offset, 2, 'Complete',$region);
        }else{
            redirect('dashboard');
        }

        //Results
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = count($results['rows']);

        //pagination
        $this->data['pagination'] = create_pagination('services/complete_list/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

        // Load page
        $this->data['meta_title'] = $requestTo .' Service Complete List';
        $this->data['subview'] = 'complete_list';
        $this->load->view('backend/_layout_main', $this->data);
    }

    /*************complete_list_pdf function pdf start**************/
    
    public function complete_list_pdf($offset=0){
         $limit = 25;

        if($this->ion_auth->is_admin()){
            $requestTo = 'NHQ';
            //Result
            $results = $this->Services_model->get_data($limit, $offset, 1, 'Complete');            
        }elseif($this->ion_auth->is_region_admin()){
            $requestTo = 'Region';
            //Result
            $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
            $results = $this->Services_model->get_data($limit, $offset, 2, 'Complete',$region);
        }else{
            redirect('dashboard');
        }

        //Results
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = count($results['rows']);
      
      //...............................................................................
      $this->data['meta_title'] = "Service Complete List";
      $html = $this->load->view('complete_list_pdf', $this->data, true);   
      $file_name ="complete_list_pdf.pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'. 
      $mpdf->Output($file_name, "D");
   }
   /*************complete_list_pdf function pdf End**************/

    public function cancel_list($offset=0){
        $limit = 25;

        if($this->ion_auth->is_admin()){
            $requestTo = 'NHQ';
            //Result
            $results = $this->Services_model->get_data($limit, $offset, 1, 'Reject');            
        }elseif($this->ion_auth->is_region_admin()){
            $requestTo = 'Region';
            //Result
            $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
            $results = $this->Services_model->get_data($limit, $offset, 2, 'Reject',$region);
        }else{
            redirect('dashboard');
        }

        //Results
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = count($results['rows']);

        //pagination
        $this->data['pagination'] = create_pagination('services/cancel_list/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

        // Load page
        $this->data['meta_title'] = $requestTo .' Service Cancle List';
        $this->data['subview'] = 'cancel_list';
        $this->load->view('backend/_layout_main', $this->data);
    }

    /*************cancel_list_pdf function pdf start**************/
    public function cancel_list_pdf($offset=0){
        $limit = 25;

        if($this->ion_auth->is_admin()){
            $requestTo = 'NHQ';
            //Result
            $results = $this->Services_model->get_data($limit, $offset, 1, 'Reject');            
        }elseif($this->ion_auth->is_region_admin()){
            $requestTo = 'Region';
            //Result
            $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
            $results = $this->Services_model->get_data($limit, $offset, 2, 'Reject',$region);
        }else{
            redirect('dashboard');
        }

        //Results
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = count($results['rows']);
      
      //...............................................................................
      $this->data['meta_title'] = "Service cancel List";
      $html = $this->load->view('cancel_list_pdf', $this->data, true);   
      $file_name ="cancel_list_pdf.pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'. 
      $mpdf->Output($file_name, "D");
   }
   /*************cancel_list_pdf function pdf End**************/

    public function on_process_list($offset=0){
        $limit = 25;

        if($this->ion_auth->is_admin()){
            $requestTo = 'NHQ';
            //Result
            $results = $this->Services_model->get_data($limit, $offset, 1, 'Processing');            
        }elseif($this->ion_auth->is_region_admin()){
            $requestTo = 'Region';
            //Result
            $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
            $results = $this->Services_model->get_data($limit, $offset, 2, 'Processing',$region);
        }else{
            redirect('dashboard');
        }

        //Results
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = count($results['rows']);

        //pagination
        $this->data['pagination'] = create_pagination('services/on_process_list/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

        // Load page
        $this->data['meta_title'] = $requestTo .' Service Cancle List';
        $this->data['subview'] = 'on_process_list';
        $this->load->view('backend/_layout_main', $this->data);
    } 


    /*************on_process_list_pdf function pdf start**************/
    
    public function on_process_list_pdf($offset=0){
         $limit = 25;

        if($this->ion_auth->is_admin()){
            $requestTo = 'NHQ';
            //Result
            $results = $this->Services_model->get_data($limit, $offset, 1, 'Processing');            
        }elseif($this->ion_auth->is_region_admin()){
            $requestTo = 'Region';
            //Result
            $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
            $results = $this->Services_model->get_data($limit, $offset, 2, 'Processing',$region);
        }else{
            redirect('dashboard');
        }

        //Results
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = count($results['rows']);
      
      //...............................................................................
      $this->data['meta_title'] = "On Process Service Request List";
      $html = $this->load->view('on_process_list_pdf', $this->data, true);   
      $file_name ="on_process_list_pdf.pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'. 
      $mpdf->Output($file_name, "D");
   }
   /*************on_process_list_pdf function pdf End**************/

    public function details($id){
        $serviceReqID = (int) decrypt_url($id);
        if (!$this->Common_model->exists('service_request', 'id', $serviceReqID)) { 
            show_404('services - details - exitsts', TRUE);
        }

        $this->data['info'] = $this->Services_model->get_info($serviceReqID);

        if($this->ion_auth->is_admin()){ 
            $this->data['results'] = $this->Services_model->get_assign_to_list_by_request_id($serviceReqID);
        }elseif($this->ion_auth->is_region_admin()){
            //Region Admin
            $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
            if($this->data['info']->serv_region_id == $region OR !empty($this->Services_model->get_assign_to_list_by_request_id($serviceReqID,$region))){
            }else{
                redirect('dashboard');
            }
            $this->data['results'] = $this->Services_model->get_assign_to_list_by_request_id($serviceReqID,$region);
        }elseif($this->ion_auth->is_district_admin()){
            //District Admin
            $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID);  
            $region     = $office->dis_scout_region_id;
            $district   = $office->id;

            $this->data['results'] = $this->Services_model->get_assign_to_list_by_request_id($serviceReqID,$region,$district);
            if(empty($this->data['results']))
                redirect('dashboard');
           
        }elseif($this->ion_auth->is_upazila_admin()){
            //Upazila Admin
            $office = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
            $region     = $office->upa_region_id;
            $district   = $office->upa_scout_dis_id;
            $upazila    = $office->id;

            $this->data['results'] = $this->Services_model->get_assign_to_list_by_request_id($serviceReqID,$region,$district,$upazila);
            if(empty($this->data['results']))
                redirect('dashboard');
            
        }elseif($this->ion_auth->is_group_admin()){
            // Group Admin
            $groupInfo = $this->Offices_model->get_scout_group_by_user_id($this->userSessID);
            $region     = $groupInfo->grp_region_id;
            $district   = $groupInfo->grp_scout_dis_id;
            $upazila    = $groupInfo->grp_scout_upa_id;
            $group      = $groupInfo->id;

            $this->data['results'] = $this->Services_model->get_assign_to_list_by_request_id($serviceReqID,$region,$district,$upazila,$group);
            if(empty($this->data['results']))
                redirect('dashboard');

        }else{
            redirect('dashboard');
        }

        // Load view
        $this->data['meta_title'] = 'Details Services Request';
        $this->data['subview'] = 'details';
        $this->load->view('backend/_layout_main', $this->data);
    }


    /*************details_pdf function pdf start**************/
    public function details_pdf($id){
        $serviceReqID = (int) decrypt_url($id);
        if (!$this->Common_model->exists('service_request', 'id', $serviceReqID)) { 
            show_404('services - details_pdf - exitsts', TRUE);
        }

        $this->data['info'] = $this->Services_model->get_info($serviceReqID);

        if($this->ion_auth->is_admin()){ 
            $this->data['results'] = $this->Services_model->get_assign_to_list_by_request_id($serviceReqID);
        }elseif($this->ion_auth->is_region_admin()){
            //Region Admin
            $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
            if($this->data['info']->serv_region_id == $region OR !empty($this->Services_model->get_assign_to_list_by_request_id($serviceReqID,$region))){
            }else{
                redirect('dashboard');
            }
            $this->data['results'] = $this->Services_model->get_assign_to_list_by_request_id($serviceReqID,$region);
        }elseif($this->ion_auth->is_district_admin()){
            //District Admin
            $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID);  
            $region     = $office->dis_scout_region_id;
            $district   = $office->id;

            $this->data['results'] = $this->Services_model->get_assign_to_list_by_request_id($serviceReqID,$region,$district);
            if(empty($this->data['results']))
                redirect('dashboard');
           
        }elseif($this->ion_auth->is_upazila_admin()){
            //Upazila Admin
            $office = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
            $region     = $office->upa_region_id;
            $district   = $office->upa_scout_dis_id;
            $upazila    = $office->id;

            $this->data['results'] = $this->Services_model->get_assign_to_list_by_request_id($serviceReqID,$region,$district,$upazila);
            if(empty($this->data['results']))
                redirect('dashboard');
            
        }elseif($this->ion_auth->is_group_admin()){
            // Group Admin
            $groupInfo = $this->Offices_model->get_scout_group_by_user_id($this->userSessID);
            $region     = $groupInfo->grp_region_id;
            $district   = $groupInfo->grp_scout_dis_id;
            $upazila    = $groupInfo->grp_scout_upa_id;
            $group      = $groupInfo->id;

            $this->data['results'] = $this->Services_model->get_assign_to_list_by_request_id($serviceReqID,$region,$district,$upazila,$group);
            if(empty($this->data['results']))
                redirect('dashboard');

        }else{
            redirect('dashboard');
        }
      
      //...............................................................................
      $this->data['meta_title'] = "Details Services Request";
      $html = $this->load->view('details_pdf', $this->data, true);   
      $file_name ="details_pdf.pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'. 
      $mpdf->Output($file_name, "D");
   }
   /*************details_pdf function pdf End**************/

    public function assign_to($id){
        $serviceID = (int) decrypt_url($id); 
        if (!$this->Common_model->exists('service_request', 'id', $serviceID)) { 
            show_404('services - assign_to - exitsts', TRUE);
        }        

        $this->data['info'] = $this->Services_model->get_info($serviceID);

        //Check authentication
        if($this->ion_auth->is_admin()){
            //Superadmin
            $assignFrom = 'NHQ';

        }elseif($this->ion_auth->is_region_admin()){
            $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
            if($this->data['info']->serv_region_id != $region ){
                redirect('dashboard');
            }
            //Region Admin
            $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id; 
            $assignFrom = 'Region';

        }else{
            redirect('dashboard');
        }
        // elseif($this->ion_auth->is_district_admin()){
        //     //District Admin
        //     $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID);  
        //     $region     = $office->dis_scout_region_id;
        //     $district   = $office->id;
        //     $assignFrom = 'District';

        // }elseif($this->ion_auth->is_upazila_admin()){
        //     //Upazila Admin
        //     $office = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
        //     $region     = $office->upa_region_id;
        //     $district   = $office->upa_scout_dis_id;
        //     $upazila    = $office->id;
        //     $assignFrom = 'Upazila';

        // }

        
        //CI validation
        $this->form_validation->set_rules('assign_office_id', 'assign office type', 'required|trim'); 
        $this->form_validation->set_rules('region_id', 'region', 'required|trim');          
        $this->form_validation->set_rules('note', 'note', 'required|trim');          

        //Validate and input data
        if ($this->form_validation->run() == true){
            $form_data = array(
                'assign_from'       => $assignFrom,
                'req_service_id'    => $this->data['info']->id, 
                'ass_to_office_id'  => $this->input->post('assign_office_id'),
                'ass_region_id'     => $this->input->post('region_id'),
                'ass_district_id'   => $this->input->post('district_id')?$this->input->post('district_id'):NULL,
                'ass_upazila_id'    => $this->input->post('upazila_id')?$this->input->post('upazila_id'):NULL,
                'ass_group_id'      => $this->input->post('group_id')?$this->input->post('group_id'):NULL,
                'note'              => $this->input->post('note'),
                'ass_datetime'      => date('Y-m-d H:i:s')
                );

            // print_r($form_data); exit;
            if($this->Common_model->save('service_assign', $form_data)){
                $this->session->set_flashdata('success', 'Public service request assign to scouts office successfully.');
                redirect('services/assign_to_list');
            }
        }

        //Dropdown
        $this->data['assign_to_office'] = $this->Common_model->set_service_assign_office_type();
        $this->data['regions'] = $this->Common_model->get_regions(); 

        //Load view
        $this->data['meta_title'] = 'Assign Public Service Task to Scouts Office';
        $this->data['subview'] = 'assign_to';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function assign_to_list(){
        $limit = 25;

        if($this->ion_auth->is_admin()){
            //Super Admin
            $results = $this->Services_model->get_assign_to_list($limit, $offset, 'NHQ');

        }elseif($this->ion_auth->is_region_admin()){  
            //Region Admin
            $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
           
            //Result
            $results = $this->Services_model->get_assign_to_list($limit, $offset, 'Region',$region);

        }elseif($this->ion_auth->is_district_admin()){
            //District Admin
            $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID);  
            $region     = $office->dis_scout_region_id;
            $district   = $office->id;
            
            //Result
            $results = $this->Services_model->get_assign_to_list($limit, $offset, 'District',$region,$district);

        }elseif($this->ion_auth->is_upazila_admin()){
            //Upazila Admin
            $office = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
            $region     = $office->upa_region_id;
            $district   = $office->upa_scout_dis_id;
            $upazila    = $office->id;
            //Result
            $results = $this->Services_model->get_assign_to_list($limit, $offset, 'Upazila',$region,$district,$upazila);

        }else{
            redirect('dashboard');
        }

         //Results
        $this->data['results']    = $results['rows'];
        $this->data['total_rows'] = count($results['rows']);

        //pagination
        $this->data['pagination'] = create_pagination('services/assign_to_list/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

        // Load page
        $this->data['meta_title'] = 'Services List';
        $this->data['subview'] = 'assign_to_list';
        $this->load->view('backend/_layout_main', $this->data);
    } 


    /*************assign_to_list_pdf function pdf start**************/
    public function assign_to_list_pdf($offset=0){
        $limit = 25;

        if($this->ion_auth->is_admin()){
            //Super Admin
            $results = $this->Services_model->get_assign_to_list($limit, $offset, 'NHQ');

        }elseif($this->ion_auth->is_region_admin()){  
            //Region Admin
            $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
           
            //Result
            $results = $this->Services_model->get_assign_to_list($limit, $offset, 'Region',$region);

        }elseif($this->ion_auth->is_district_admin()){
            //District Admin
            $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID);  
            $region     = $office->dis_scout_region_id;
            $district   = $office->id;
            
            //Result
            $results = $this->Services_model->get_assign_to_list($limit, $offset, 'District',$region,$district);

        }elseif($this->ion_auth->is_upazila_admin()){
            //Upazila Admin
            $office = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
            $region     = $office->upa_region_id;
            $district   = $office->upa_scout_dis_id;
            $upazila    = $office->id;
            //Result
            $results = $this->Services_model->get_assign_to_list($limit, $offset, 'Upazila',$region,$district,$upazila);

        }else{
            redirect('dashboard');
        }

         //Results
        $this->data['results']    = $results['rows'];
        $this->data['total_rows'] = count($results['rows']);
      
      //...............................................................................
      $this->data['meta_title'] = "Services List";
      $html = $this->load->view('assign_to_list_pdf', $this->data, true);   
      $file_name ="assign_to_list_pdf.pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'. 
      $mpdf->Output($file_name, "D");
   }
   /*************assign_to_list_pdf function pdf End**************/

    public function task_assign_list(){
        $limit = 25;

        if($this->ion_auth->is_admin()){
            //Super Admin
            $results = $this->Services_model->get_task_assign_list($limit, $offset);

        }elseif($this->ion_auth->is_region_admin()){  
            //Region Admin
            $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
            
            //Result
            $results = $this->Services_model->get_task_assign_list($limit, $offset, '1',$region);

        }elseif($this->ion_auth->is_district_admin()){
            //District Admin
            $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID);  
            $region     = $office->dis_scout_region_id;
            $district   = $office->id;
            
            //Result
            $results = $this->Services_model->get_task_assign_list($limit, $offset, '2',$region,$district);

        }elseif($this->ion_auth->is_upazila_admin()){
            //Upazila Admin
            $office = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
            $region     = $office->upa_region_id;
            $district   = $office->upa_scout_dis_id;
            $upazila    = $office->id;
            
            //Result
            $results = $this->Services_model->get_task_assign_list($limit, $offset, '3',$region,$district,$upazila);

        }elseif($this->ion_auth->is_group_admin()){
            // Group Admin
            $groupInfo = $this->Offices_model->get_scout_group_by_user_id($this->userSessID);
            $region     = $groupInfo->grp_region_id;
            $district   = $groupInfo->grp_scout_dis_id;
            $upazila    = $groupInfo->grp_scout_upa_id;
            $group      = $groupInfo->id;
            //Result
            $results = $this->Services_model->get_task_assign_list($limit, $offset, '4',$region,$district,$upazila,$group);

        }else{
            redirect('dashboard');
        }

         //Results
        $this->data['results']    = $results['rows'];
        $this->data['total_rows'] = count($results['rows']);

        //pagination
        $this->data['pagination'] = create_pagination('services/task_assign_list/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

        // Load page
        $this->data['meta_title'] = 'Task Assign List';
        $this->data['subview'] = 'task_assign_list';
        $this->load->view('backend/_layout_main', $this->data);
    }

    /*************task_assign_list_pdf function pdf start**************/

    public function task_assign_list_pdf($offset=0){
        $limit = 25;

        if($this->ion_auth->is_admin()){
            //Super Admin
            $results = $this->Services_model->get_task_assign_list($limit, $offset);

        }elseif($this->ion_auth->is_region_admin()){  
            //Region Admin
            $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
            
            //Result
            $results = $this->Services_model->get_task_assign_list($limit, $offset, '1',$region);

        }elseif($this->ion_auth->is_district_admin()){
            //District Admin
            $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID);  
            $region     = $office->dis_scout_region_id;
            $district   = $office->id;
            
            //Result
            $results = $this->Services_model->get_task_assign_list($limit, $offset, '2',$region,$district);

        }elseif($this->ion_auth->is_upazila_admin()){
            //Upazila Admin
            $office = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
            $region     = $office->upa_region_id;
            $district   = $office->upa_scout_dis_id;
            $upazila    = $office->id;
            
            //Result
            $results = $this->Services_model->get_task_assign_list($limit, $offset, '3',$region,$district,$upazila);

        }elseif($this->ion_auth->is_group_admin()){
            // Group Admin
            $groupInfo = $this->Offices_model->get_scout_group_by_user_id($this->userSessID);
            $region     = $groupInfo->grp_region_id;
            $district   = $groupInfo->grp_scout_dis_id;
            $upazila    = $groupInfo->grp_scout_upa_id;
            $group      = $groupInfo->id;
            //Result
            $results = $this->Services_model->get_task_assign_list($limit, $offset, '4',$region,$district,$upazila,$group);

        }else{
            redirect('dashboard');
        }

         //Results
        $this->data['results']    = $results['rows'];
        $this->data['total_rows'] = count($results['rows']);
      
      //...............................................................................
      $this->data['meta_title'] = "Task Assign List";
      $html = $this->load->view('task_assign_list_pdf', $this->data, true);   
      $file_name ="task_assign_list_pdf.pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'. 
      $mpdf->Output($file_name, "D");
   }
   /*************task_assign_list_pdf function pdf End**************/

    public function request_status($id){
        $serviceID = (int) decrypt_url($id);        
        if (!$this->Common_model->exists('service_request', 'id', $serviceID)) { 
            show_404('service - request_status - exists', TRUE);
        } 

        //Result
        $this->data['info'] = $this->Services_model->get_info($serviceID);          

        //Check authentication
        if($this->ion_auth->is_admin()){
            //Superadmin
            $actionBy = 'NHQ';

        }elseif($this->ion_auth->is_region_admin()){
            //Region Admin
            $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
            if($this->data['info']->serv_region_id == $region OR !empty($this->Services_model->get_assign_to_list_by_request_id($serviceID,$region))){
            }else{
                redirect('dashboard');
            } 

            $actionBy = 'Region';

        }elseif($this->ion_auth->is_district_admin()){
            //District Admin
            $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID);  
            $region     = $office->dis_scout_region_id;
            $district   = $office->id;

            $this->data['results'] = $this->Services_model->get_assign_to_list_by_request_id($serviceID,$region,$district,$upazila);
            if(empty($this->data['results']))
                redirect('dashboard');

            $actionBy = 'District';

        }elseif($this->ion_auth->is_upazila_admin()){
            //Upazila Admin
            $office = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
            $region     = $office->upa_region_id;
            $district   = $office->upa_scout_dis_id;
            $upazila    = $office->id;

            $this->data['results'] = $this->Services_model->get_assign_to_list_by_request_id($serviceID,$region,$district,$upazila);
            if(empty($this->data['results']))
                redirect('dashboard');

            $actionBy = 'Upazila';

        }elseif($this->ion_auth->is_group_admin()){
            // Group Admin
            $groupInfo = $this->Offices_model->get_scout_group_by_user_id($this->userSessID);
            $region     = $groupInfo->grp_region_id;
            $district   = $groupInfo->grp_scout_dis_id;
            $upazila    = $groupInfo->grp_scout_upa_id;
            $group      = $groupInfo->id;

            $this->data['results'] = $this->Services_model->get_assign_to_list_by_request_id($serviceID,$region,$district,$upazila,$group);
            if(empty($this->data['results']))
                redirect('dashboard');

            $actionBy = 'Group';

        }else{
            redirect('dashboard');
        }


        //CI validation
        $this->form_validation->set_rules('status', 'task status', 'required|trim'); 
        $this->form_validation->set_rules('note', 'note', 'required|trim');          

        //Validate and input data
        if ($this->form_validation->run() == true){
            $form_data = array(
                'action_by'       => $actionBy,
                'status'          => $this->input->post('status'),
                'act_datetime'    => date('Y-m-d H:i:s'),
                'act_region_id'   => $region?$region:NULL,
                'act_district_id' => $district?$district:NULL,
                'act_upazila_id'  => $upazila?$upazila:NULL,
                'act_group_id'    => $group?$group:NULL,
                'act_note'        => $this->input->post('note')
                );           

            // print_r($form_data); exit;
            if($this->Common_model->edit('service_request', $serviceID, 'id', $form_data)){
                /***********Activity Logs Start**********/
                //$insert_id = $this->db->insert_id();
                func_activity_log(2, 'Task status change ID :'.$serviceID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                /***********Activity Logs End**********/
                $this->session->set_flashdata('success', 'Task status change successfully.');
                redirect('services/request_list');
            }
        }


        //Dropdown
        // $this->data['action_office'] = $this->Common_model->set_service_assign_office_type();
        $this->data['status'] = $this->Common_model->set_service_status();
        // $this->data['regions'] = $this->Common_model->get_regions(); 

        //Load view
        $this->data['meta_title'] = 'Public Service Request Change Status';
        $this->data['subview'] = 'request_status';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function assign_cancel($id){    
        //Encrypt
        $serviceID = (int) decrypt_url($id); //exit;
        if (!$this->Common_model->exists('service_request', 'id', $serviceID)) { 
            show_404('services - assign_cancel - exitsts', TRUE);
        }

        if($this->ion_auth->is_admin()){


        }elseif($this->ion_auth->is_region_admin()){
            //Region Admin
            $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
            if($this->data['info']->serv_region_id == $region OR !empty($this->Services_model->get_assign_to_list_by_request_id($serviceID,$region))){
            }else{
                redirect('dashboard');
            } 

        }elseif($this->ion_auth->is_district_admin()){
            //District Admin
            $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID);  
            $region     = $office->dis_scout_region_id;
            $district   = $office->id;

            $this->data['results'] = $this->Services_model->get_assign_to_list_by_request_id($serviceID,$region,$district,$upazila);
            if(empty($this->data['results']))
                redirect('dashboard');

        }elseif($this->ion_auth->is_upazila_admin()){
            //Upazila Admin
            $office = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
            $region     = $office->upa_region_id;
            $district   = $office->upa_scout_dis_id;
            $upazila    = $office->id;

            $this->data['results'] = $this->Services_model->get_assign_to_list_by_request_id($serviceID,$region,$district,$upazila);
            if(empty($this->data['results']))
                redirect('dashboard');

        }elseif($this->ion_auth->is_group_admin()){
            // Group Admin
            $groupInfo = $this->Offices_model->get_scout_group_by_user_id($this->userSessID);
            $region     = $groupInfo->grp_region_id;
            $district   = $groupInfo->grp_scout_dis_id;
            $upazila    = $groupInfo->grp_scout_upa_id;
            $group      = $groupInfo->id;

            $this->data['results'] = $this->Services_model->get_assign_to_list_by_request_id($serviceID,$region,$district,$upazila,$group);
            if(empty($this->data['results']))
                redirect('dashboard');

        }else{
            redirect('dashboard');
        }
        

        //Delete user and all related information
        if($this->Services_model->destroy_assign_to($serviceID)){
            /***********Activity Logs Start**********/
            //$insert_id = $this->db->insert_id();
            func_activity_log(3, 'Delete assign task ID :'.$serviceID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/
            $this->session->set_flashdata('success', 'Delete assign task successfully.');
            redirect('services/request_list');
        }else{
            $this->session->set_flashdata('warning', 'Someting is wrong.');
            redirect('services/assign_to_list');
        }
    }

    // public function services_list(){

    //     //Result
    //     $this->data['services'] = $this->Services_model->get_data();

    //     // Load page
    //     $this->data['meta_title'] = 'Services List';
    //     $this->data['subview'] = 'services_list';
    //     $this->load->view('backend/_layout_main', $this->data);
    // } 


    // public function comments($id){
    //     $this->data['users'] = $this->ion_auth->user()->row();
    //     $this->data['services_id'] = $id;

    //     $this->data['training'] = $this->Services_model->get_info($id);

    //     if($this->Services_model->get_services_valid($id)==false){
    //         redirect('Services/my_services');
    //     }

    //     $this->form_validation->set_rules('comments', 'comments', 'required|trim');

    //     if ($this->form_validation->run() == true){

    //         $form_data = array(
    //             'comments' => $this->input->post('comments')
    //             );
    //         //print_r($form_data);exit();

    //         if($this->Services_model->edit('services_to_scouts', $this->data['users']->id, $id,  $form_data)){                
    //             $this->session->set_flashdata('success', 'Successfully send your comments.');
    //             redirect('Services/my_services'); 
    //         } 
    //         redirect('Services/my_services');     
    //     }

    //     $this->data['meta_title'] = 'services Comments';
    //     $this->data['subview'] = 'comments';
    //     $this->load->view('backend/_layout_main', $this->data);
    // }

    // function status($scout_id, $services_id, $status) {
    //     $this->data['users'] = $this->ion_auth->user()->row();

    //     if($status==1){
    //         $status_data='Interested';
    //     }
    //     if($status==2){
    //         $status_data='Not Interested';
    //     }
    //     if($status==3){
    //         $status_data='Approved';
    //     }
    //     if($status==4){
    //         $status_data='Not Approved';
    //     }
    //     $form_data = array(
    //         'status'       => $status_data,
    //         'approved_by'  => $this->data['users']->id
    //         );

    //     $form_data2 = array(
    //         'scout_id'     => $this->data['users']->id,
    //         'services_id'     => $services_id,
    //         'status'       => $status_data
    //         );

    //     if(empty($this->Services_model->get_scout_member($services_id, $scout_id))){

    //         if($this->Common_model->save('services_to_scouts', $form_data2)){
    //             $this->session->set_flashdata('success', 'Information update successfully.'); 
    //         }else{
    //             $this->session->set_flashdata('warning', 'Information update unsuccessfully.');
    //         }
    //     }else{
    //         if($this->Services_model->edit('services_to_scouts', $scout_id, $services_id, $form_data)){
    //             $this->session->set_flashdata('success', 'Information update successfully.'); 
    //         }else{
    //             $this->session->set_flashdata('warning', 'Information update unsuccessfully.');
    //         }
    //     }

    //     redirect('Services/details/'.$services_id);
    // }

    // function delete($id) {
    //     $this->data['info'] = $this->Services_model->delete($id);
    //     $this->session->set_flashdata('success', 'Information delete successfully.');
    //     redirect('Services/services_list');
    // }

}