<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Complain extends Backend_Controller {	

	public function __construct(){
        parent::__construct();
        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;

        $this->data['module_title'] = 'Complain';
        $this->load->model('Common_model'); 
        $this->load->model('Complain_model');     
    }

	public function index(){    
        redirect('Complain/Complain_list');
	}

    public function complain_list(){
        if(!$this->ion_auth->is_admin()){
            redirect('dashboard');
        }

        $this->data['complain'] = $this->Complain_model->get_data();

        // Load page
        $this->data['meta_title'] = 'Complain List';
        $this->data['subview'] = 'complain_list';
        $this->load->view('backend/_layout_main', $this->data);
    } 

    /*************complain_list_pdf function pdf start**************/
    public function complain_list_pdf($offset=0){
        if(!$this->ion_auth->is_admin()){
            redirect('dashboard');
        }

        $this->data['complain'] = $this->Complain_model->get_data();
      
      //...............................................................................
      $this->data['meta_title'] = "Complain List";
      $html = $this->load->view('complain_list_pdf', $this->data, true);   
      $file_name ="complain_list_pdf.pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'. 
      $mpdf->Output($file_name, "D");
   }
   /*************complain_list_pdf function pdf End**************/

    public function details($id){
        if(!$this->ion_auth->is_admin()){
            redirect('dashboard');
        }

        $encriptID = (int) decrypt_url($id);

        $this->data['users'] = $this->ion_auth->user()->row();

        $this->data['complain'] = $this->Complain_model->get_info($encriptID);
        // $this->data['scout_member_list'] = $this->Complain_model->get_scout_member_list($id);
        // $this->data['scout_member'] = $this->Complain_model->get_scout_member($id, $this->data['users']->id);

        $this->data['meta_title'] = 'Details Feedback on Complain';
        $this->data['subview'] = 'details';
        $this->load->view('backend/_layout_main', $this->data);
    }


    /*************details_pdf function pdf start**************/
    public function details_pdf($id=0){
        if(!$this->ion_auth->is_admin()){
            redirect('dashboard');
        }

        $encriptID = (int) decrypt_url($id);

        $this->data['users'] = $this->ion_auth->user()->row();

        $this->data['complain'] = $this->Complain_model->get_info($encriptID);
      
      //...............................................................................
      $this->data['meta_title'] = "Details Feedback on Complain";
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

    function delete($id) {
        if(!$this->ion_auth->is_admin()){
            redirect('dashboard');
        }
        $this->data['info'] = $this->Complain_model->delete($id);
        /***********Activity Logs Start**********/
        //$insert_id = $this->db->insert_id();
        func_activity_log(3, 'Delete complain ID :'.$serviceID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
        /***********Activity Logs End**********/
        $this->session->set_flashdata('success', 'Information delete successfully.');
        redirect('complain/complain_list');
    }

}