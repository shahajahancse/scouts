<?php defined('BASEPATH') OR exit('No direct script access allowed');
// include 'classes/php-excel.class.php';

class Scouts_member extends Backend_Controller {
   var $userSessID;
   var $img_path;
   var $qr_path;

   var $img_orginal_path;
   var $img_thumb_path;

   public function __construct(){
      parent::__construct();
      if (!$this->ion_auth->logged_in()):
         redirect('login');
      endif;

      $this->data['module_title'] = 'Scouts Member';
      $this->userSessID = $this->session->userdata('user_id');

      $this->load->model('Common_model');
      $this->load->model('Scouts_member_model');
      $this->load->model('my_profile/My_profile_model');
      $this->load->model('offices/Offices_model');
      $this->load->model('committee/Committee_model');
      $this->img_path = realpath(APPPATH . '../profile_img');
      $this->qr_path = realpath(APPPATH . '../qrcode_img');

      $this->img_orginal_path = realpath(APPPATH . '../temp_dir/');
      $this->img_thumb_path = realpath(APPPATH . '../temp_dir/_thumb/');
   }

   public function index(){
      redirect('scouts_member/all');
   }

   // public function file_xls()
   //  {
   //     // $this->load->helper('php-excel');
   //     $data_array =  array (
   //     $data_array[] = array ("Oliver", "Peter", "Paul"),
   //                      array ("Marlene", "Mica", "Lina")
   //              );
   //     $xls = new Excel_XML;
   //     $xls->addArray ($data_array);
   //     $xls->generateXML ( "output_name" );
   //  }

   /******************* Scouts Member All Kind of List ***********************
   ***************************************************************************/

   public function all($offset=0){
      $limit = 25;

      //Check authentication
      if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group(array('award', 'event', 'training'))){
         // Superadmin
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, '', '', '', '', 1);
         //Dropdown
         $this->data['regions'] = $this->Common_model->get_regions();
         // print_r($this->data['regions']) ; exit();
         $this->data['scouts_district'] = array(''=>'Scouts District');
         $this->data['scouts_upazila'] = array(''=>'Scouts Upazila');
         $this->data['scouts_group'] = array(''=>'Scouts Group');

      }elseif($this->ion_auth->is_vendor()){
         // Superadmin
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, '', '', '', '', 1);
         //Dropdown
         $this->data['regions'] = $this->Common_model->get_regions();
         // print_r($this->data['regions']) ; exit();
         $this->data['scouts_district'] = array(''=>'Scouts District');
         $this->data['scouts_upazila'] = array(''=>'Scouts Upazila');
         $this->data['scouts_group'] = array(''=>'Scouts Group');

      }elseif($this->ion_auth->is_region_admin()){
         // Region Admin
         $office = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
         //Result
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, $office, '', '', '', 1);
         //Dropdown
         // $this->data['scout_district'] = $this->Common_model->get_dropdown_office('office_district', 'dis_name', 'dis_scout_region_id', $office);

         $this->data['scouts_district'] =  $this->Common_model->get_scout_districts($office);
         $this->data['scouts_upazila'] = array(''=>'Scouts Upazila');
         $this->data['scouts_group'] = array(''=>'Scouts Group');

      }elseif($this->ion_auth->is_district_admin() && $this->session->userdata('sc_region_id') == 10){
         // District Admin Rover
         //Result
         $sc_dis_id = $this->session->userdata('sc_district_id');
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, 10, $sc_dis_id, '', '', 1);
         //Dropdown
         $this->data['scouts_group'] = $this->Common_model->get_scout_group_office($sc_dis_id);

      }elseif($this->ion_auth->is_district_admin()){
         // District Admin
         $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID)->id;
         //Result
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, '', $office, '', '', 1);
         //Dropdown

         $this->data['scouts_upazila'] =  $this->Common_model->get_scout_upazila_thana($office);
         $this->data['scouts_group'] = array(''=>'Scouts Group');

      }elseif($this->ion_auth->is_upazila_admin()){
         // Upazila Admin
         $office = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID)->id;
         //Result
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, '', '', $office, '', 1);

         $this->data['scouts_group'] =  $this->Common_model->get_scout_group_office('', $office);

      }elseif($this->ion_auth->is_group_admin()){
         // Group Admin
         $office = $this->Offices_model->get_scout_group_by_user_id($this->userSessID)->id;
         //Result
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, '', '', '', $office, 1);
      }else{
         redirect('dashboard');
      }


      if($_GET['region']>0 && $_GET['region'] !=NULL){
         $this->data['scouts_district'] =  $this->Common_model->get_scout_districts($_GET['region']);
      }

      if($_GET['district']>0 && $_GET['district'] !=NULL){
         $this->data['scouts_upazila'] =  $this->Common_model->get_scout_upazila_thana($_GET['district']);
      }

      if($_GET['upazila']>0 && $_GET['upazila'] !=NULL){
         $this->data['scouts_group'] =  $this->Common_model->get_scout_group_office('', $_GET['upazila']);
      }

      // echo $this->db->last_query();
      // Fethch User Group
      // foreach ($results['rows'] as $k => $user){
      //    $results['rows'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
      // }

      //Results
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      //pagination
      $this->data['pagination'] = create_pagination('scouts_member/all/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      //Dropdown
      $this->data['member_type'] = $this->Common_model->get_member_type();
      $this->data['scout_section'] = $this->Common_model->set_scout_section();

      /********Costom Url Create for Pdf and Doc file Start**************/
      $this->data['region'] = $this->input->get('region');
      $this->data['download_url'] = base_url('scouts_member/scout_member_pdf')."?region=".$this->input->get('region')."&district=".$this->input->get('district')."&upazila=".$this->input->get('upazila')."&sgroup=".$this->input->get('sgroup')."&memberType=".$this->input->get('memberType')."&scoutID=".$this->input->get('scoutID')."&name=".$this->input->get('name')."&username=".$this->input->get('username')."&gender=".$this->input->get('gender')."&section=".$this->input->get('section');


      $this->data['doc_url'] = base_url('scouts_member/scout_member_doc')."?region=".$this->input->get('region')."&district=".$this->input->get('district')."&upazila=".$this->input->get('upazila')."&sgroup=".$this->input->get('sgroup')."&memberType=".$this->input->get('memberType')."&scoutID=".$this->input->get('scoutID')."&name=".$this->input->get('name')."&username=".$this->input->get('username')."&gender=".$this->input->get('gender')."&section=".$this->input->get('section');

      $this->data['excel_url'] = base_url('scouts_member/scout_member_Excel')."?region=".$this->input->get('region')."&district=".$this->input->get('district')."&upazila=".$this->input->get('upazila')."&sgroup=".$this->input->get('sgroup')."&memberType=".$this->input->get('memberType')."&scoutID=".$this->input->get('scoutID')."&name=".$this->input->get('name')."&username=".$this->input->get('username')."&gender=".$this->input->get('gender')."&section=".$this->input->get('section');

      /********Costom Url Create for Pdf and Doc file end**************/

      // Load page
      $this->data['meta_title'] = 'All Scouts Member';
      $this->data['subview'] = 'all';
      $this->load->view('backend/_layout_main', $this->data);
   }

   /****************Scout Member Pdf Function start****Date:11-02-2019* Alomgir******/
   public function scout_member_pdf($offset=0){


      //Check authentication
      if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group(array('award', 'event', 'training'))){
         // Superadmin
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, '', '', '', '', 1);
         //Dropdown
         $this->data['regions'] = $this->Common_model->get_regions();
         // print_r($this->data['regions']) ; exit();
         $this->data['scouts_district'] = array(''=>'Scouts District');
         $this->data['scouts_upazila'] = array(''=>'Scouts Upazila');
         $this->data['scouts_group'] = array(''=>'Scouts Group');

      }elseif($this->ion_auth->is_region_admin()){
         // Region Admin
         $office = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
         //Result
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, $office, '', '', '', 1);

         $this->data['scouts_district'] =  $this->Common_model->get_scout_districts($office);
         $this->data['scouts_upazila'] = array(''=>'Scouts Upazila');
         $this->data['scouts_group'] = array(''=>'Scouts Group');

      }elseif($this->ion_auth->is_district_admin()){
         // District Admin
         $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID)->id;
         //Result
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, '', $office, '', '', 1);
         //Dropdown

         $this->data['scouts_upazila'] =  $this->Common_model->get_scout_upazila_thana($office);
         $this->data['scouts_group'] = array(''=>'Scouts Group');

      }elseif($this->ion_auth->is_upazila_admin()){
         // Upazila Admin
         $office = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID)->id;
         //Result
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, '', '', $office, '', 1);

         $this->data['scouts_group'] =  $this->Common_model->get_scout_group_office('', $office);

      }elseif($this->ion_auth->is_group_admin()){
         // Group Admin
         $office = $this->Offices_model->get_scout_group_by_user_id($this->userSessID)->id;
         //Result
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, '', '', '', $office, 1);
      }else{
         redirect('dashboard');
      }


      if($_GET['region']>0 && $_GET['region'] !=NULL){
         $this->data['scouts_district'] =  $this->Common_model->get_scout_districts($_GET['region']);
      }

      if($_GET['district']>0 && $_GET['district'] !=NULL){
         $this->data['scouts_upazila'] =  $this->Common_model->get_scout_upazila_thana($_GET['district']);
      }

      if($_GET['upazila']>0 && $_GET['upazila'] !=NULL){
         $this->data['scouts_group'] =  $this->Common_model->get_scout_group_office('', $_GET['upazila']);
      }

      //Results
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];


      //...............................................................................
      $this->data['meta_title'] = 'Scouts Member';
      $html = $this->load->view('scout_member_pdf', $this->data, true);
      $file_name ="scout_member_pdf.pdf";

        //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

        //generate the PDF from the given html
      $mpdf->WriteHTML($html);

        //download it for 'D'.
      $mpdf->Output($file_name, "D");

   }
   /****************Scout Member Pdf Function end******************/

   public function scout_member_Excel($offset=0){

      $this->load->library("excel");
      $this->load->library("PHPExcel");
      $object = new PHPExcel();

      // Set document properties

      $object->setActiveSheetIndex(0)->mergeCells('A1:F1');
      $object->getActiveSheet()->setCellValue('A1','                          BANGLADESH SCOUTS');
      $table_columns = array(" SL"," FULL NAME", "  SCOUT ID", " MEMBER TYPE", "SECTION", "GROUP NAME"," USERNAME");

      $column = 0;

      foreach($table_columns as $field)
      {
         $object->getActiveSheet()->setCellValueByColumnAndRow($column, 2, $field);
         $column++;
      }

      //Check authentication
      if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group(array('award', 'event', 'training'))){
            // Superadmin
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, '', '', '', '', 1);
               //Dropdown
         $this->data['regions'] = $this->Common_model->get_regions();
               // print_r($this->data['regions']) ; exit();
         $this->data['scouts_district'] = array(''=>'Scouts District');
         $this->data['scouts_upazila'] = array(''=>'Scouts Upazila');
         $this->data['scouts_group'] = array(''=>'Scouts Group');

      }elseif($this->ion_auth->is_region_admin()){
            // Region Admin
         $office = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
               //Result
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, $office, '', '', '', 1);

         $this->data['scouts_district'] =  $this->Common_model->get_scout_districts($office);
         $this->data['scouts_upazila'] = array(''=>'Scouts Upazila');
         $this->data['scouts_group'] = array(''=>'Scouts Group');

      }elseif($this->ion_auth->is_district_admin()){
            // District Admin
         $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID)->id;
               //Result
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, '', $office, '', '', 1);
               //Dropdown

         $this->data['scouts_upazila'] =  $this->Common_model->get_scout_upazila_thana($office);
         $this->data['scouts_group'] = array(''=>'Scouts Group');

      }elseif($this->ion_auth->is_upazila_admin()){
            // Upazila Admin
         $office = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID)->id;
               //Result
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, '', '', $office, '', 1);

         $this->data['scouts_group'] =  $this->Common_model->get_scout_group_office('', $office);

      }elseif($this->ion_auth->is_group_admin()){
            // Group Admin
         $office = $this->Offices_model->get_scout_group_by_user_id($this->userSessID)->id;
            //Result
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, '', '', '', $office, 1);
      }else{
         redirect('dashboard');
      }


      if($_GET['region']>0 && $_GET['region'] !=NULL){
         $this->data['scouts_district'] =  $this->Common_model->get_scout_districts($_GET['region']);
      }

      if($_GET['district']>0 && $_GET['district'] !=NULL){
         $this->data['scouts_upazila'] =  $this->Common_model->get_scout_upazila_thana($_GET['district']);
      }

      if($_GET['upazila']>0 && $_GET['upazila'] !=NULL){
         $this->data['scouts_group'] =  $this->Common_model->get_scout_group_office('', $_GET['upazila']);
      }

      //Results
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      $excel_row = 3;

      $sl = 1;


      foreach ($results['rows'] as $row){
         $sl++;
               // Profile Image
         $path = base_url().'profile_img/';
         if($row->profile_img != NULL){
            $img_url = '<img src="'.$path.$row->profile_img.'" height="20">';
         }else{
            $img_url = '<img src="'.$path.'no-img.png" height="20">';
         }

         $cont = 'Some content <br> <strong>inside</strong> the popover';


         $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $sl);
         $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->first_name);
         $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->scout_id);
         $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->member_type_name);
         $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, get_scout_section($row->sc_section_id));
         $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->grp_name);
         $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row->username);
         $excel_row++;
      }

      $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="scout_member_Excel.xls"');
      $object_writer->save('php://output');
   }

   /****************Scout Member Doc FIle Function start******************/
   public function scout_member_doc(){

      $limit = 25;

         //Check authentication
      if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group(array('award', 'event', 'training'))){
            // Superadmin
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, '', '', '', '', 1);
            //Dropdown
         $this->data['regions'] = $this->Common_model->get_regions();
            // print_r($this->data['regions']) ; exit();
         $this->data['scouts_district'] = array(''=>'Scouts District');
         $this->data['scouts_upazila'] = array(''=>'Scouts Upazila');
         $this->data['scouts_group'] = array(''=>'Scouts Group');

      }elseif($this->ion_auth->is_region_admin()){
            // Region Admin
         $office = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
            //Result
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, $office, '', '', '', 1);

         $this->data['scouts_district'] =  $this->Common_model->get_scout_districts($office);
         $this->data['scouts_upazila'] = array(''=>'Scouts Upazila');
         $this->data['scouts_group'] = array(''=>'Scouts Group');

      }elseif($this->ion_auth->is_district_admin()){
            // District Admin
         $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID)->id;
            //Result
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, '', $office, '', '', 1);
            //Dropdown

         $this->data['scouts_upazila'] =  $this->Common_model->get_scout_upazila_thana($office);
         $this->data['scouts_group'] = array(''=>'Scouts Group');

      }elseif($this->ion_auth->is_upazila_admin()){
            // Upazila Admin
         $office = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID)->id;
            //Result
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, '', '', $office, '', 1);

         $this->data['scouts_group'] =  $this->Common_model->get_scout_group_office('', $office);

      }elseif($this->ion_auth->is_group_admin()){
            // Group Admin
         $office = $this->Offices_model->get_scout_group_by_user_id($this->userSessID)->id;
            //Result
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, '', '', '', $office, 1);
      }else{
         redirect('dashboard');
      }


      if($_GET['region']>0 && $_GET['region'] !=NULL){
         $this->data['scouts_district'] =  $this->Common_model->get_scout_districts($_GET['region']);
      }

      if($_GET['district']>0 && $_GET['district'] !=NULL){
         $this->data['scouts_upazila'] =  $this->Common_model->get_scout_upazila_thana($_GET['district']);
      }

      if($_GET['upazila']>0 && $_GET['upazila'] !=NULL){
         $this->data['scouts_group'] =  $this->Common_model->get_scout_group_office('', $_GET['upazila']);
      }

         //Results
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

         //...............................................................................
         // generate doc
      require_once 'vendor/autoload.php';
      $phpWord = new \PhpOffice\PhpWord\PhpWord();
         //echo '<pre>'; print_r(111);die();
         // 27-08-18
      $phpWord->setDefaultFontName('Courier New');
      $phpWord->setDefaultFontSize(11);

         //our docx will have 'lanscape' paper orientation
      $section = $phpWord->createSection(array('marginTop' => 2000));

      $header = $section->addHeader();

         // Add footer
      $footer = $section->createFooter();
      $footer->addPreserveText('Page {PAGE} of {NUMPAGES}.', array('margin-top' => '2.9pt','align'=>'center'));


      $section->addTextBreak(1);

         // Define font style for first row
      $fontStyle = array('bold'=>true, 'align'=>'center', 'underline' => 'single');
      $fontStyleTwo = array('align'=>'center', 'underline' => 'single');
      $fontStyleThree = array('bold' => true, 'align'=>'center');
      $fontStyleFour = array('bold' => false);
      $styleTable = array('cellMargin'=>10);
      $styleTableTwo = array('cellMargin'=>10, 'borderSize' => 1, 'borderColor'=>'000000');
      $styleCell = array('valign'=>'center');
      $styleCellTwo = array('valign'=>'top');
      $styleCellBTLR = array('valign'=>'center');

      $cellColSpan = array('gridSpan' => 4);

         // Add table style
      $phpWord->addTableStyle('myOwnTableStyle', $styleTable);

         // Add table
      $table = $section->addTable('myOwnTableStyle');

         // Add row
      $table->addRow(90);

         // Add cells

      $table->addCell(10000, $styleCell)->addText('All Scouts Member' , $fontStyle,array('align' => 'center'));


      $phpWord->addTableStyle('myOwnTableTwoStyle', $styleTableTwo);

      $tableTwo = $section->addTable('myOwnTableTwoStyle');

      $tableTwo->addRow(10);

         // Add cells
      $tableTwo->addCell(900, $styleCellTwo)->addText("SL", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
      $tableTwo->addCell(3300, $styleCell)->addText("Image", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
      $tableTwo->addCell(1800, $styleCellTwo)->addText("Full Name", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
      $tableTwo->addCell(2000, $styleCellTwo)->addText("Scout ID", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
      $tableTwo->addCell(2500, $styleCellTwo)->addText("Member Type", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
      /*$tableTwo->addCell(1500, $styleCellTwo)->addText("Group Name", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));*/
      $tableTwo->addCell(1500, $styleCellTwo)->addText("Username", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));

      $sln=0;
      foreach ($results['rows'] as $row){
         $sln++;

         $path = base_url().'profile_img/';
         if($row->profile_img != NULL){
            $image =  $path.$row->profile_img;
         }

         $tableTwo->addRow(10);

         $tableTwo->addCell(1000, $styleCellTwo)->addText($sln, $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));

         if($row->profile_img != NULL){
            $tableTwo->addCell(3300, $styleCellTwo)->addImage($image, array('width' => 35,
         'height' => 40, 'marginTop' => -1, 'marginLeft' => -1, 'wrappingStyle' => 'behind' ));
         }else{
            $tableTwo->addCell(3300, $styleCellTwo)->addText(' ', $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
         }

         $tableTwo->addCell(2000, $styleCellTwo)->addText($row->first_name, $fontStyleFour, array('align' => 'left', 'space' => array('before' => 50, 'after' => 0)));
         $tableTwo->addCell(2500, $styleCellTwo)->addText($row->scout_id, $fontStyleFour, array('align' => 'left', 'space' => array('before' => 50, 'after' => 0), 'indentation' => array('right' => 100)));
         $tableTwo->addCell(2000, $styleCellTwo)->addText($row->member_type_name, $fontStyleFour, array('align' => 'left', 'space' => array('before' => 50, 'after' => 0)));
         /*$tableTwo->addCell(3000, $styleCellTwo)->addText($row->grp_name, $fontStyleFour, array('align' => 'left', 'space' => array('before' => 50, 'after' => 0)));*/
         $tableTwo->addCell(1500, $styleCellTwo)->addText($row->username, $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0), 'indentation' => array('right' => 100)));
      }

      $section->addTextBreak(1);

      if($_SERVER['HTTP_HOST'] === 'localhost'){
         $file_name = './report_doc/scout_member_doc.docx';
         $phpWord->save($file_name, 'Word2007');
         header("Content-Disposition: attachment; filename='scout_member_doc.docx'");
         readfile($file_name);
         unlink($file_name);
      } else {
         $file_name = './report_doc/scout_member_doc.docx';
         header("Content-Disposition: attachment; filename='scout_member_doc.docx'");
         readfile($file_name);
      }
   }
   /****************Scout Member Doc FIle Function End******************/


   public function archive_list($offset=0){
      $limit = 25;

      if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){
            //Super Admin
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, '', '', '', '', 2);
            //Dropdown
         $this->data['regions'] = $this->Common_model->get_regions();
         $this->data['scouts_district'] = array(''=>'Scouts District');
         $this->data['scouts_upazila'] = array(''=>'Scouts Upazila');
         $this->data['scouts_group'] = array(''=>'Scouts Group');

      }elseif($this->ion_auth->is_region_admin()){
            //Region Admin
         $office = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
            //Result
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, $office, '', '', '', 2);
            //Dropdown
         $this->data['scouts_district'] =  $this->Common_model->get_scout_districts($office);
         $this->data['scouts_upazila'] = array(''=>'Scouts Upazila');
         $this->data['scouts_group'] = array(''=>'Scouts Group');

      }elseif($this->ion_auth->is_district_admin()){
            //District Admin
         $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID)->id;
            //Result
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, '', $office, '', '', 2);

         $this->data['scouts_upazila'] =  $this->Common_model->get_scout_upazila_thana($office);
         $this->data['scouts_group'] = array(''=>'Scouts Group');

      }elseif($this->ion_auth->is_upazila_admin()){
            //Upazila Admin
         $office = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID)->id;
            //Result
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, '', '', $office, '', 2);

         $this->data['scouts_group'] =  $this->Common_model->get_scout_group_office('', $office);

      }elseif($this->ion_auth->is_group_admin()){
            //Group Admin
         $office = $this->Offices_model->get_scout_group_by_user_id($this->userSessID)->id;
            //Result
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, '', '', '', $office, 2);
      }else{
         redirect('dashboard');
      }


      if($_GET['region']>0 && $_GET['region'] !=NULL){
         $this->data['scouts_district'] =  $this->Common_model->get_scout_districts($_GET['region']);
      }

      if($_GET['district']>0 && $_GET['district'] !=NULL){
         $this->data['scouts_upazila'] =  $this->Common_model->get_scout_upazila_thana($_GET['district']);
      }

      if($_GET['upazila']>0 && $_GET['upazila'] !=NULL){
         $this->data['scouts_group'] =  $this->Common_model->get_scout_group_office('', $_GET['upazila']);
      }

         //Results
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

         //pagination
      $this->data['pagination'] = create_pagination('scouts_member/archive_list/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      $this->data['member_type'] = $this->Common_model->get_member_type();
      $this->data['scout_section'] = $this->Common_model->set_scout_section();

         // Load page
      $this->data['meta_title'] = 'Scouts Member Archive List';
      $this->data['subview'] = 'archive_list';
      $this->load->view('backend/_layout_main', $this->data);
   }

   /****************Scout archive_list_pdf pdf FIle Function start******************/
   public function archive_list_pdf()
   {
      $limit = 25;

      if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){
            //Super Admin
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, '', '', '', '', 2);
            //Dropdown
         $this->data['regions'] = $this->Common_model->get_regions();
         $this->data['scouts_district'] = array(''=>'Scouts District');
         $this->data['scouts_upazila'] = array(''=>'Scouts Upazila');
         $this->data['scouts_group'] = array(''=>'Scouts Group');

      }elseif($this->ion_auth->is_region_admin()){
            //Region Admin
         $office = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
            //Result
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, $office, '', '', '', 2);
            //Dropdown
         $this->data['scouts_district'] =  $this->Common_model->get_scout_districts($office);
         $this->data['scouts_upazila'] = array(''=>'Scouts Upazila');
         $this->data['scouts_group'] = array(''=>'Scouts Group');

      }elseif($this->ion_auth->is_district_admin()){
            //District Admin
         $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID)->id;
            //Result
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, '', $office, '', '', 2);

         $this->data['scouts_upazila'] =  $this->Common_model->get_scout_upazila_thana($office);
         $this->data['scouts_group'] = array(''=>'Scouts Group');

      }elseif($this->ion_auth->is_upazila_admin()){
            //Upazila Admin
         $office = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID)->id;
            //Result
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, '', '', $office, '', 2);

         $this->data['scouts_group'] =  $this->Common_model->get_scout_group_office('', $office);

      }elseif($this->ion_auth->is_group_admin()){
            //Group Admin
         $office = $this->Offices_model->get_scout_group_by_user_id($this->userSessID)->id;
            //Result
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, '', '', '', $office, 2);
      }else{
         redirect('dashboard');
      }


      if($_GET['region']>0 && $_GET['region'] !=NULL){
         $this->data['scouts_district'] =  $this->Common_model->get_scout_districts($_GET['region']);
      }

      if($_GET['district']>0 && $_GET['district'] !=NULL){
         $this->data['scouts_upazila'] =  $this->Common_model->get_scout_upazila_thana($_GET['district']);
      }

      if($_GET['upazila']>0 && $_GET['upazila'] !=NULL){
         $this->data['scouts_group'] =  $this->Common_model->get_scout_group_office('', $_GET['upazila']);
      }

         //Results
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

         //...............................................................................
      $this->data['meta_title'] = 'Scouts Member Archive List';
      $html = $this->load->view('archive_list_pdf', $this->data, true);
      $file_name ="archive_list_pdf.pdf";

         //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

         //generate the PDF from the given html
      $mpdf->WriteHTML($html);

         //download it for 'D'.
      $mpdf->Output($file_name, "D");
   }

   /****************Scout archive_list_pdf pdf FIle Function end******************/

   /****************Scout archive_list_doc doc FIle Function start******************/
   public function archive_list_doc()
   {
      $limit = 25;

      if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){
            //Super Admin
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, '', '', '', '', 2);
            //Dropdown
         $this->data['regions'] = $this->Common_model->get_regions();
         $this->data['scouts_district'] = array(''=>'Scouts District');
         $this->data['scouts_upazila'] = array(''=>'Scouts Upazila');
         $this->data['scouts_group'] = array(''=>'Scouts Group');

      }elseif($this->ion_auth->is_region_admin()){
            //Region Admin
         $office = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
            //Result
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, $office, '', '', '', 2);
            //Dropdown
         $this->data['scouts_district'] =  $this->Common_model->get_scout_districts($office);
         $this->data['scouts_upazila'] = array(''=>'Scouts Upazila');
         $this->data['scouts_group'] = array(''=>'Scouts Group');

      }elseif($this->ion_auth->is_district_admin()){
            //District Admin
         $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID)->id;
            //Result
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, '', $office, '', '', 2);

         $this->data['scouts_upazila'] =  $this->Common_model->get_scout_upazila_thana($office);
         $this->data['scouts_group'] = array(''=>'Scouts Group');

      }elseif($this->ion_auth->is_upazila_admin()){
            //Upazila Admin
         $office = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID)->id;
            //Result
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, '', '', $office, '', 2);

         $this->data['scouts_group'] =  $this->Common_model->get_scout_group_office('', $office);

      }elseif($this->ion_auth->is_group_admin()){
            //Group Admin
         $office = $this->Offices_model->get_scout_group_by_user_id($this->userSessID)->id;
            //Result
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, '', '', '', $office, 2);
      }else{
         redirect('dashboard');
      }


      if($_GET['region']>0 && $_GET['region'] !=NULL){
         $this->data['scouts_district'] =  $this->Common_model->get_scout_districts($_GET['region']);
      }

      if($_GET['district']>0 && $_GET['district'] !=NULL){
         $this->data['scouts_upazila'] =  $this->Common_model->get_scout_upazila_thana($_GET['district']);
      }

      if($_GET['upazila']>0 && $_GET['upazila'] !=NULL){
         $this->data['scouts_group'] =  $this->Common_model->get_scout_group_office('', $_GET['upazila']);
      }

         //Results
      $this->data['results'] = $results;
      $this->data['total_rows'] = $results['num_rows'];

         //...............................................................................
         // generate doc
      require_once 'vendor/autoload.php';
      $phpWord = new \PhpOffice\PhpWord\PhpWord();
         //echo '<pre>'; print_r(111);die();
         // 27-08-18
      $phpWord->setDefaultFontName('Courier New');
      $phpWord->setDefaultFontSize(11);

         //our docx will have 'lanscape' paper orientation
      $section = $phpWord->createSection(array('marginTop' => 2000));

      $header = $section->addHeader();

         // Add footer
      $footer = $section->createFooter();
      $footer->addPreserveText('Page {PAGE} of {NUMPAGES}.', array('margin-top' => '2.9pt','align'=>'center'));


      $section->addTextBreak(1);

         // Define font style for first row
      $fontStyle = array('bold'=>true, 'align'=>'center', 'underline' => 'single');
      $fontStyleTwo = array('align'=>'center', 'underline' => 'single');
      $fontStyleThree = array('bold' => true, 'align'=>'center');
      $fontStyleFour = array('bold' => false);
      $styleTable = array('cellMargin'=>10);
      $styleTableTwo = array('cellMargin'=>10, 'borderSize' => 1, 'borderColor'=>'000000');
      $styleCell = array('valign'=>'center');
      $styleCellTwo = array('valign'=>'top');
      $styleCellBTLR = array('valign'=>'center');

      $cellColSpan = array('gridSpan' => 4);

         // Add table style
      $phpWord->addTableStyle('myOwnTableStyle', $styleTable);

         // Add table
      $table = $section->addTable('myOwnTableStyle');

         // Add row
      $table->addRow(90);

         // Add cells

      $table->addCell(10000, $styleCell)->addText('Scouts Member Archive List' , $fontStyle,array('align' => 'center'));


      $phpWord->addTableStyle('myOwnTableTwoStyle', $styleTableTwo);

      $tableTwo = $section->addTable('myOwnTableTwoStyle');

      $tableTwo->addRow(10);

         // Add cells
      $tableTwo->addCell(900, $styleCellTwo)->addText("SL", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
      $tableTwo->addCell(3300, $styleCell)->addText("Image", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
      $tableTwo->addCell(1800, $styleCellTwo)->addText("Full Name", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
      $tableTwo->addCell(2000, $styleCellTwo)->addText("Scout ID", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
      $tableTwo->addCell(2500, $styleCellTwo)->addText("Member Type", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
      $tableTwo->addCell(1500, $styleCellTwo)->addText("Group Name", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
      $tableTwo->addCell(1500, $styleCellTwo)->addText("Username", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));

      $sln=0;
      foreach ($results['rows'] as $row){
         $sln++;


         if($row->profile_img != NULL){
            $image =  __DIR__ . '/../../../../profile_img/'.$row->profile_img;
         }

         $tableTwo->addRow(10);

         $tableTwo->addCell(1000, $styleCellTwo)->addText($sln, $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));

         if($row->profile_img != NULL){
            $tableTwo->addCell(3300, $styleCellTwo)->addImage($image, array('width' => 35,
            'height' => 40, 'marginTop' => -1, 'marginLeft' => -1, 'wrappingStyle' => 'behind' ));
         }else{
            $tableTwo->addCell(3300, $styleCellTwo)->addText(' ', $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
         }

         $tableTwo->addCell(2000, $styleCellTwo)->addText($row->first_name, $fontStyleFour, array('align' => 'left', 'space' => array('before' => 50, 'after' => 0)));
         $tableTwo->addCell(2000, $styleCellTwo)->addText($row->scout_id, $fontStyleFour, array('align' => 'left', 'space' => array('before' => 50, 'after' => 0)));
         $tableTwo->addCell(2000, $styleCellTwo)->addText($row->member_type_name, $fontStyleFour, array('align' => 'left', 'space' => array('before' => 50, 'after' => 0)));
         $tableTwo->addCell(2500, $styleCellTwo)->addText($row->grp_name, $fontStyleFour, array('align' => 'left', 'space' => array('before' => 50, 'after' => 0), 'indentation' => array('right' => 100)));
         $tableTwo->addCell(1500, $styleCellTwo)->addText($row->username, $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0), 'indentation' => array('right' => 100)));
      }

      $section->addTextBreak(1);

      if($_SERVER['HTTP_HOST'] === 'localhost'){

         $file_name = './report_doc/archive_list_doc.docx';
         $phpWord->save($file_name, 'Word2007');
         header("Content-Disposition: attachment; filename='archive_list_doc.docx'");
         readfile($file_name);
         unlink($file_name);
      } else {
         $file_name = './report_doc/archive_list_doc.docx';
         header("Content-Disposition: attachment; filename='archive_list_doc.docx'");
         readfile($file_name);
      }
   }
   /****************Scout archive_list_doc doc FIle Function end******************/

   public function delete_request($offset=0){
      $limit = 25;

      if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){
            //Superadmin
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, '', '', '', '', 3);
            //Dropdown
         $this->data['regions'] = $this->Common_model->get_regions();
         $this->data['scouts_district'] = array(''=>'Scouts District');
         $this->data['scouts_upazila'] = array(''=>'Scouts Upazila');
         $this->data['scouts_group'] = array(''=>'Scouts Group');

      }elseif($this->ion_auth->is_region_admin()){
            //Region Admin
         $office = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
            //Result
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, $office, '', '', '', 3);
            //Dropdown
         $this->data['scouts_district'] =  $this->Common_model->get_scout_districts($office);
         $this->data['scouts_upazila'] = array(''=>'Scouts Upazila');
         $this->data['scouts_group'] = array(''=>'Scouts Group');

      }elseif($this->ion_auth->is_district_admin()){
            //District Admin
         $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID)->id;
            //Result
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, '', $office, '', '', 3);

         $this->data['scouts_upazila'] =  $this->Common_model->get_scout_upazila_thana($office);
         $this->data['scouts_group'] = array(''=>'Scouts Group');

      }elseif($this->ion_auth->is_upazila_admin()){
            //Upazila Admin
         $office = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID)->id;
            //Result
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, '', '', $office, '', 3);

         $this->data['scouts_group'] =  $this->Common_model->get_scout_group_office('', $office);

      }elseif($this->ion_auth->is_group_admin()){
            //Group Admin
         $office = $this->Offices_model->get_scout_group_by_user_id($this->userSessID)->id;
            //Result
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, '', '', '', $office, 3);
      }else{
         redirect('dashboard');
      }


      if($_GET['region']>0 && $_GET['region'] !=NULL){
         $this->data['scouts_district'] =  $this->Common_model->get_scout_districts($_GET['region']);
      }

      if($_GET['district']>0 && $_GET['district'] !=NULL){
         $this->data['scouts_upazila'] =  $this->Common_model->get_scout_upazila_thana($_GET['district']);
      }

      if($_GET['upazila']>0 && $_GET['upazila'] !=NULL){
         $this->data['scouts_group'] =  $this->Common_model->get_scout_group_office('', $_GET['upazila']);
      }

         //Result
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

         //pagination
      $this->data['pagination'] = create_pagination('scouts_member/delete_request/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      $this->data['member_type'] = $this->Common_model->get_member_type();
      $this->data['scout_section'] = $this->Common_model->set_scout_section();

         // Load page
      $this->data['meta_title'] = 'Scouts Member Delete Request List';
      $this->data['subview'] = 'delete_request';
      $this->load->view('backend/_layout_main', $this->data);
   }


   /****************Scout delete_request_pdf pdf FIle Function start******************/
   public function delete_request_pdf()
   {
      $limit = 25;

      if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){
            //Superadmin
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, '', '', '', '', 3);
            //Dropdown
         $this->data['regions'] = $this->Common_model->get_regions();
         $this->data['scouts_district'] = array(''=>'Scouts District');
         $this->data['scouts_upazila'] = array(''=>'Scouts Upazila');
         $this->data['scouts_group'] = array(''=>'Scouts Group');

      }elseif($this->ion_auth->is_region_admin()){
            //Region Admin
         $office = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
            //Result
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, $office, '', '', '', 3);
            //Dropdown
         $this->data['scouts_district'] =  $this->Common_model->get_scout_districts($office);
         $this->data['scouts_upazila'] = array(''=>'Scouts Upazila');
         $this->data['scouts_group'] = array(''=>'Scouts Group');

      }elseif($this->ion_auth->is_district_admin()){
            //District Admin
         $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID)->id;
            //Result
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, '', $office, '', '', 3);

         $this->data['scouts_upazila'] =  $this->Common_model->get_scout_upazila_thana($office);
         $this->data['scouts_group'] = array(''=>'Scouts Group');

      }elseif($this->ion_auth->is_upazila_admin()){
            //Upazila Admin
         $office = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID)->id;
            //Result
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, '', '', $office, '', 3);

         $this->data['scouts_group'] =  $this->Common_model->get_scout_group_office('', $office);

      }elseif($this->ion_auth->is_group_admin()){
            //Group Admin
         $office = $this->Offices_model->get_scout_group_by_user_id($this->userSessID)->id;
            //Result
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, '', '', '', $office, 3);
      }else{
         redirect('dashboard');
      }


      if($_GET['region']>0 && $_GET['region'] !=NULL){
         $this->data['scouts_district'] =  $this->Common_model->get_scout_districts($_GET['region']);
      }

      if($_GET['district']>0 && $_GET['district'] !=NULL){
         $this->data['scouts_upazila'] =  $this->Common_model->get_scout_upazila_thana($_GET['district']);
      }

      if($_GET['upazila']>0 && $_GET['upazila'] !=NULL){
         $this->data['scouts_group'] =  $this->Common_model->get_scout_group_office('', $_GET['upazila']);
      }

         //Result
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

         //...............................................................................
      $this->data['meta_title'] = 'Scouts Member Delete Request List';
      $html = $this->load->view('delete_request_pdf', $this->data, true);
      $file_name ="delete_request_pdf.pdf";

         //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

         //generate the PDF from the given html
      $mpdf->WriteHTML($html);

         //download it for 'D'.
      $mpdf->Output($file_name, "D");
   }

   /****************Scout delete_request_pdf pdf FIle Function end******************/

   /****************Scout delete_request_doc doc FIle Function start******************/
   public function delete_request_doc()
   {
      $limit = 25;

      if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){
            //Superadmin
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, '', '', '', '', 3);
            //Dropdown
         $this->data['regions'] = $this->Common_model->get_regions();
         $this->data['scouts_district'] = array(''=>'Scouts District');
         $this->data['scouts_upazila'] = array(''=>'Scouts Upazila');
         $this->data['scouts_group'] = array(''=>'Scouts Group');

      }elseif($this->ion_auth->is_region_admin()){
            //Region Admin
         $office = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
            //Result
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, $office, '', '', '', 3);
            //Dropdown
         $this->data['scouts_district'] =  $this->Common_model->get_scout_districts($office);
         $this->data['scouts_upazila'] = array(''=>'Scouts Upazila');
         $this->data['scouts_group'] = array(''=>'Scouts Group');

      }elseif($this->ion_auth->is_district_admin()){
            //District Admin
         $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID)->id;
            //Result
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, '', $office, '', '', 3);

         $this->data['scouts_upazila'] =  $this->Common_model->get_scout_upazila_thana($office);
         $this->data['scouts_group'] = array(''=>'Scouts Group');

      }elseif($this->ion_auth->is_upazila_admin()){
            //Upazila Admin
         $office = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID)->id;
            //Result
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, '', '', $office, '', 3);

         $this->data['scouts_group'] =  $this->Common_model->get_scout_group_office('', $office);

      }elseif($this->ion_auth->is_group_admin()){
            //Group Admin
         $office = $this->Offices_model->get_scout_group_by_user_id($this->userSessID)->id;
            //Result
         $results = $this->Scouts_member_model->get_scout_member($limit, $offset, '', '', '', $office, 3);
      }else{
         redirect('dashboard');
      }


      if($_GET['region']>0 && $_GET['region'] !=NULL){
         $this->data['scouts_district'] =  $this->Common_model->get_scout_districts($_GET['region']);
      }

      if($_GET['district']>0 && $_GET['district'] !=NULL){
         $this->data['scouts_upazila'] =  $this->Common_model->get_scout_upazila_thana($_GET['district']);
      }

      if($_GET['upazila']>0 && $_GET['upazila'] !=NULL){
         $this->data['scouts_group'] =  $this->Common_model->get_scout_group_office('', $_GET['upazila']);
      }

         //Result
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

         //...............................................................................
         // generate doc
      require_once 'vendor/autoload.php';
      $phpWord = new \PhpOffice\PhpWord\PhpWord();
         //echo '<pre>'; print_r(111);die();
         // 27-08-18
      $phpWord->setDefaultFontName('Courier New');
      $phpWord->setDefaultFontSize(11);

         //our docx will have 'lanscape' paper orientation
      $section = $phpWord->createSection(array('marginTop' => 2000));

      $header = $section->addHeader();

         // Add footer
      $footer = $section->createFooter();
      $footer->addPreserveText('Page {PAGE} of {NUMPAGES}.', array('margin-top' => '2.9pt','align'=>'center'));


      $section->addTextBreak(1);

         // Define font style for first row
      $fontStyle = array('bold'=>true, 'align'=>'center', 'underline' => 'single');
      $fontStyleTwo = array('align'=>'center', 'underline' => 'single');
      $fontStyleThree = array('bold' => true, 'align'=>'center');
      $fontStyleFour = array('bold' => false);
      $styleTable = array('cellMargin'=>10);
      $styleTableTwo = array('cellMargin'=>10, 'borderSize' => 1, 'borderColor'=>'000000');
      $styleCell = array('valign'=>'center');
      $styleCellTwo = array('valign'=>'top');
      $styleCellBTLR = array('valign'=>'center');

      $cellColSpan = array('gridSpan' => 4);

         // Add table style
      $phpWord->addTableStyle('myOwnTableStyle', $styleTable);

         // Add table
      $table = $section->addTable('myOwnTableStyle');

         // Add row
      $table->addRow(90);

         // Add cells

      $table->addCell(10000, $styleCell)->addText('Scouts Member Archive List' , $fontStyle,array('align' => 'center'));


      $phpWord->addTableStyle('myOwnTableTwoStyle', $styleTableTwo);

      $tableTwo = $section->addTable('myOwnTableTwoStyle');

      $tableTwo->addRow(10);

         // Add cells
      $tableTwo->addCell(900, $styleCellTwo)->addText("SL", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
      $tableTwo->addCell(3300, $styleCell)->addText("Image", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
      $tableTwo->addCell(1800, $styleCellTwo)->addText("Full Name", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
      $tableTwo->addCell(2000, $styleCellTwo)->addText("Scout ID", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
      $tableTwo->addCell(2500, $styleCellTwo)->addText("Member Type", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
      $tableTwo->addCell(1500, $styleCellTwo)->addText("Group Name", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
      $tableTwo->addCell(1500, $styleCellTwo)->addText("Username", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));

      $sln=0;
      foreach ($results['rows'] as $row){
         $sln++;


         if($row->profile_img != NULL){
            $image =  __DIR__ . '/../../../../profile_img/'.$row->profile_img;
         }

         $tableTwo->addRow(10);

         $tableTwo->addCell(1000, $styleCellTwo)->addText($sln, $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));

         if($row->profile_img != NULL){
            $tableTwo->addCell(3300, $styleCellTwo)->addImage($image, array('width' => 35,
            'height' => 40, 'marginTop' => -1, 'marginLeft' => -1, 'wrappingStyle' => 'behind' ));
         }else{
            $tableTwo->addCell(3300, $styleCellTwo)->addText(' ', $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
         }

         $tableTwo->addCell(2000, $styleCellTwo)->addText($row->first_name, $fontStyleFour, array('align' => 'left', 'space' => array('before' => 50, 'after' => 0)));
         $tableTwo->addCell(2000, $styleCellTwo)->addText($row->scout_id, $fontStyleFour, array('align' => 'left', 'space' => array('before' => 50, 'after' => 0)));
         $tableTwo->addCell(2000, $styleCellTwo)->addText($row->member_type_name, $fontStyleFour, array('align' => 'left', 'space' => array('before' => 50, 'after' => 0)));
         $tableTwo->addCell(2500, $styleCellTwo)->addText($row->grp_name, $fontStyleFour, array('align' => 'left', 'space' => array('before' => 50, 'after' => 0), 'indentation' => array('right' => 100)));
         $tableTwo->addCell(1500, $styleCellTwo)->addText($row->username, $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0), 'indentation' => array('right' => 100)));
      }

      $section->addTextBreak(1);

      if($_SERVER['HTTP_HOST'] === 'localhost'){

         $file_name = './report_doc/delete_request_doc.docx';
         $phpWord->save($file_name, 'Word2007');
         header("Content-Disposition: attachment; filename='delete_request_doc.docx'");
         readfile($file_name);
         unlink($file_name);
      } else {
         $file_name = './report_doc/delete_request_doc.docx';
         header("Content-Disposition: attachment; filename='delete_request_doc.docx'");
         readfile($file_name);
      }

   }
   /****************Scout delete_request_doc doc FIle Function end******************/

   public function request(){
      if(!$this->ion_auth->is_group_admin()){
         redirect('dashboard');
      }

         //Scouts Group office
      $office = $this->Offices_model->get_scout_group_by_user_id($this->userSessID)->id;

         //Result
      $this->data['results'] = $this->Scouts_member_model->get_request_member($office);

         // Load page
      $this->data['meta_title'] = 'Scouts Member Request';
      $this->data['subview'] = 'request';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function verified_list(){
      if(!$this->ion_auth->is_group_admin()){
         redirect('dashboard');
      }

         //Scouts Group office
      $office = $this->Offices_model->get_scout_group_by_user_id($this->userSessID)->id;

         //Result
      $this->data['results'] = $this->Scouts_member_model->get_verified_member($office);

         // Load page
      $this->data['meta_title'] = 'Scouts Member Verified List';
      $this->data['subview'] = 'verified_list';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function verified_member_generate_scout_id($id){
      $scoutID = (int) decrypt_url($id);
         // Check Exists
      if(!$this->Common_model->exists('users', 'id', $scoutID)){
         show_404('scouts_member - verified_member_generate_scout_id - exists', TRUE);
      }

         // Cross check
      if($this->ion_auth->is_group_admin()){
            // Group Admin
         $groupInfo = $this->Offices_model->get_scout_group_by_user_id($this->userSessID);
         $group      = $groupInfo->id;
            //Cross check for group
         if(!$this->Offices_model->cross_check_scouts_member($scoutID, '', '', '', $group)){
            show_404('scouts_member - verified_member_generate_scout_id - GA', TRUE);
         }

            //Get information
         $info = $this->Scouts_member_model->get_info($scoutID);

            //Generate Scout ID and Save
         if($info->scout_id == NULL){
               $last_scout_id = $this->Scouts_member_model->get_last_scout_id(); //exit;
               $generate_scout_id = $this->generateScoutID($last_scout_id);
               if($this->Scouts_member_model->set_scout_id($info->id, $generate_scout_id)){
               func_activity_log(5, 'Genterate scout ID :'.$scoutID); //1=C, 2=U, 3=D, 4=V, 5=G
               $this->session->set_flashdata('success', 'Scout ID generate successfully.');
               redirect('scouts_member/all');
            }
         }else{
            show_404('scouts_member - scout id already generated - GA', TRUE);
         }

      }else{
         redirect('dashboard');
      }
   }

   public function cancel_request(){
      if(!$this->ion_auth->is_group_admin()){
         redirect('dashboard');
      }

         //Scouts Group office
      $office = $this->Offices_model->get_scout_group_by_user_id($this->userSessID)->id;

         //Result
      $this->data['results'] = $this->Scouts_member_model->get_request_member_cancel($office);

         // Load page
      $this->data['meta_title'] = 'Scouts Member Request Cancel';
      $this->data['subview'] = 'cancel_request';
      $this->load->view('backend/_layout_main', $this->data);
   }



   /************************* Details Scouts Member **************************
   ***************************************************************************/

   public function details($id){
      $scoutID = (int) decrypt_url($id); //exit;

      if(!$this->Common_model->exists('users', 'id', $scoutID)){
         show_404('scouts_member - details - exists', TRUE);
      }

      /***********Activity Logs Start**********/
      $activity_data['user_id'] = $this->userSessID;
      $activity_data['message'] = 'Scouts Member Details ID: '.$scoutID;
      $activity_data['activity_type_id'] = 3; //For Delete Activity log
      $activity_data['ip_address'] = $this->Common_model->get_client_ip();
      $activity_data['created'] = date('Y-m-d H:i:s');
      $this->Common_model->save('activity_logs',$activity_data);
      /***********Activity Logs End**********/

      //Check authentication
      if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group(array('award', 'event', 'training'))){
         //Superadmin
         //Goto next
      }elseif($this->ion_auth->is_region_admin()){
         // Region Admin
         $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
         //Cross check for region admin
         if(!$this->Offices_model->cross_check_scouts_member($scoutID, $region, '', '', '')){
            show_404('scouts_member - details - RA', TRUE);
         }

      }elseif($this->ion_auth->is_district_admin()){
         // District Admin
         $districtInfo = $this->Offices_model->get_district_office_by_user_id($this->userSessID);
         $region     = $districtInfo->dis_scout_region_id;
         $district   = $districtInfo->id;
         //Cross check for district admin
         if(!$this->Offices_model->cross_check_scouts_member($scoutID, '', $district, '', '')){
            show_404('scouts_member - details - DA', TRUE);
         }

      }elseif($this->ion_auth->is_upazila_admin()){
         // Upazila Admin
         $upazilaInfo = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
         $region     = $upazilaInfo->upa_region_id;
         $district   = $upazilaInfo->upa_scout_dis_id;
         $upazila    = $upazilaInfo->id;
         //Cross check for upazila admin
         if(!$this->Offices_model->cross_check_scouts_member($scoutID, '', '', $upazila, '')){
            show_404('scouts_member - details - UA', TRUE);
         }

      }elseif($this->ion_auth->is_group_admin()){
         // Group Admin
         $groupInfo = $this->Offices_model->get_scout_group_by_user_id($this->userSessID);
         $group      = $groupInfo->id;
         //Cross check for group admin
         if(!$this->Offices_model->cross_check_scouts_member($scoutID, '', '', '', $group)){
            show_404('scouts_member - details - GA', TRUE);
         }
      }else{
         redirect('dashboard');
      }

      //Rresults
      $this->data['info'] = $this->Scouts_member_model->get_info($scoutID);
      $this->data['cub_info'] = $this->Scouts_member_model->get_expreance_info($scoutID,1);
      $this->data['scout_info'] = $this->Scouts_member_model->get_expreance_info($scoutID,2);
      $this->data['rover_info'] = $this->Scouts_member_model->get_expreance_info($scoutID,3);
      $this->data['groups'] = $this->ion_auth->groups()->result_array();
      $this->data['currentGroups'] = $this->ion_auth->get_users_groups($scoutID)->result();

      $form_data = array(
         'scout_id'        => $scoutID,
         'section_id'      => $this->data['info']->sc_section_id
         );

      $this->data['badge_details']  = $this->Scouts_member_model->get_badge_details($form_data);
      $this->data['expertness']     = $this->Scouts_member_model->get_badge_details_expertness($form_data);
      $this->data['achievement']    = $this->Scouts_member_model->get_badge_details_achievement($form_data);
      $this->data['camping']        = $this->Scouts_member_model->get_badge_details_camping($form_data);
      $this->data['badge_training'] = $this->Scouts_member_model->get_badge_details_training($form_data);
      $this->data['health']         = $this->Scouts_member_model->get_badge_details_health($form_data);
      $this->data['institute']      = $this->Scouts_member_model->get_badge_details_institute($form_data);
      $this->data['promotion']      = $this->Scouts_member_model->get_badge_details_promotion($form_data);
      $this->data['resign']         = $this->Scouts_member_model->get_badge_details_resign($form_data);
      $this->data['id'] = $scoutID;

      //Load page
      $this->data['meta_title'] = 'Details Scouts Member';
      $this->data['subview'] = 'details';
      $this->load->view('backend/_layout_main', $this->data);
   }


   /*************************** Edit Scouts Member ****************************
   ***************************************************************************/


   /******scout_member_details_pdf function start***/
   public function scout_member_details_pdf($id){

      $scoutID = (int) decrypt_url($id); //exit;

      if(!$this->Common_model->exists('users', 'id', $scoutID)){
         show_404('scouts_member - details - exists', TRUE);
      }

      //Check authentication
      if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group(array('award', 'event', 'training'))){
         //Superadmin
         //Goto next
      }elseif($this->ion_auth->is_region_admin()){
         // Region Admin
         $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
         //Cross check for region admin
         if(!$this->Offices_model->cross_check_scouts_member($scoutID, $region, '', '', '')){
            show_404('scouts_member - details - RA', TRUE);
         }

      }elseif($this->ion_auth->is_district_admin()){
         // District Admin
         $districtInfo = $this->Offices_model->get_district_office_by_user_id($this->userSessID);
         $region     = $districtInfo->dis_scout_region_id;
         $district   = $districtInfo->id;
         //Cross check for district admin
         if(!$this->Offices_model->cross_check_scouts_member($scoutID, '', $district, '', '')){
            show_404('scouts_member - details - DA', TRUE);
         }

      }elseif($this->ion_auth->is_upazila_admin()){
         // Upazila Admin
         $upazilaInfo = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
         $region     = $upazilaInfo->upa_region_id;
         $district   = $upazilaInfo->upa_scout_dis_id;
         $upazila    = $upazilaInfo->id;
         //Cross check for upazila admin
         if(!$this->Offices_model->cross_check_scouts_member($scoutID, '', '', $upazila, '')){
            show_404('scouts_member - details - UA', TRUE);
         }

      }elseif($this->ion_auth->is_group_admin()){
         // Group Admin
         $groupInfo = $this->Offices_model->get_scout_group_by_user_id($this->userSessID);
         $group      = $groupInfo->id;
         //Cross check for group admin
         if(!$this->Offices_model->cross_check_scouts_member($scoutID, '', '', '', $group)){
            show_404('scouts_member - details - GA', TRUE);
         }
      }else{
         redirect('dashboard');
      }

      //Rresults
      $this->data['info'] = $this->Scouts_member_model->get_info($scoutID);
      $this->data['cub_info'] = $this->Scouts_member_model->get_expreance_info($scoutID,1);
      $this->data['scout_info'] = $this->Scouts_member_model->get_expreance_info($scoutID,2);
      $this->data['rover_info'] = $this->Scouts_member_model->get_expreance_info($scoutID,3);
      $this->data['groups'] = $this->ion_auth->groups()->result_array();
      $this->data['currentGroups'] = $this->ion_auth->get_users_groups($scoutID)->result();

      $form_data = array(
         'scout_id'        => $scoutID,
         'section_id'      => $this->data['info']->sc_section_id
         );

      $this->data['badge_details']  = $this->Scouts_member_model->get_badge_details($form_data);
      $this->data['expertness']     = $this->Scouts_member_model->get_badge_details_expertness($form_data);
      $this->data['achievement']    = $this->Scouts_member_model->get_badge_details_achievement($form_data);
      $this->data['camping']        = $this->Scouts_member_model->get_badge_details_camping($form_data);
      $this->data['badge_training'] = $this->Scouts_member_model->get_badge_details_training($form_data);
      $this->data['health']         = $this->Scouts_member_model->get_badge_details_health($form_data);
      $this->data['institute']      = $this->Scouts_member_model->get_badge_details_institute($form_data);
      $this->data['promotion']      = $this->Scouts_member_model->get_badge_details_promotion($form_data);
      $this->data['resign']         = $this->Scouts_member_model->get_badge_details_resign($form_data);

      //...............................................................................
      $this->data['meta_title'] = 'Details Scouts Member';
      $html = $this->load->view('scout_member_details_pdf', $this->data, true);
      $file_name ="scout_member_details_pdf.pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'.
      $mpdf->Output($file_name, "D");
   }

   /******scout_member_details_pdf function End***/

   public function edit($id){
      $scoutID = (int) decrypt_url($id);
      // Check Exists
      if(!$this->Common_model->exists('users', 'id', $scoutID)){
         show_404('scouts_member - edit - exists', TRUE);
      }

      //Get information
      $this->data['info'] = $this->Scouts_member_model->get_info($scoutID);
      /*echo '<pre>';
      print_r($this->data['info']->sc_group_id); exit;*/

      //Check authentication
      if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){
         // Member Info
         $scDistrictId = $this->data['info']->sc_district_id;
         $scGroupId = $this->data['info']->sc_group_id;

         //Dropdown
         $this->data['regions'] = $this->Common_model->get_regions();
         $this->data['scout_districts'] = $this->Common_model->get_scout_districts();
         $this->data['scout_upazila'] = $this->Common_model->get_scout_upazila_thana();
         $this->data['scout_group'] = $this->Common_model->get_scout_group_office($scDistrictId);
         $this->data['scout_unit'] = $this->Common_model->get_scout_unit_office($scGroupId);

      }elseif($this->ion_auth->is_region_admin()){
         // Region Admin
         $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
         //Cross check for region admin
         if(!$this->Offices_model->cross_check_scouts_member($scoutID, $region, '', '', '')){
            show_404('scouts_member - edit - RA', TRUE);
         }
         //Dropdown
         $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
         $this->data['scout_districts'] = $this->Common_model->get_dropdown_office('office_district', 'dis_name', 'dis_scout_region_id', $region);
         $this->data['scout_upazila'] = $this->Common_model->get_dropdown_office('office_upazila', 'upa_name', 'upa_region_id', $region);
         $this->data['scout_group'] = $this->Common_model->get_dropdown_office('office_groups', 'grp_name', 'grp_region_id', $region);

      }elseif($this->ion_auth->is_district_admin()){
         // District Admin
         $districtInfo = $this->Offices_model->get_district_office_by_user_id($this->userSessID);
         $region     = $districtInfo->dis_scout_region_id;
         $district   = $districtInfo->id;
         //Cross check for district admin
         if(!$this->Offices_model->cross_check_scouts_member($scoutID, '', $district, '', '')){
            show_404('scouts_member - edit - DA', TRUE);
         }
         //Dropdown
         $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
         $this->data['district_info'] = $this->Common_model->get_office_info('office_district', $district);
         $this->data['scout_upazila'] = $this->Common_model->get_dropdown_office('office_upazila', 'upa_name', 'upa_scout_dis_id', $district);
         $this->data['scout_group'] = $this->Common_model->get_dropdown_office('office_groups', 'grp_name', 'grp_scout_dis_id', $district);

      }elseif($this->ion_auth->is_upazila_admin()){
         // Upazila Admin
         $upazilaInfo = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
         $region     = $upazilaInfo->upa_region_id;
         $district   = $upazilaInfo->upa_scout_dis_id;
         $upazila    = $upazilaInfo->id;
         //Cross check for upazila admin
         if(!$this->Offices_model->cross_check_scouts_member($scoutID, '', '', $upazila, '')){
            show_404('scouts_member - edit - UA', TRUE);
         }
         //Dropdown
         $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
         $this->data['district_info'] = $this->Common_model->get_office_info('office_district', $district);
         $this->data['upazila_info'] = $this->Common_model->get_office_info('office_upazila', $upazila);
         $this->data['scout_group'] = $this->Common_model->get_dropdown_office('office_groups', 'grp_name', '  grp_scout_upa_id', $upazila);

      }elseif($this->ion_auth->is_group_admin()){
         // Group Admin
         $groupInfo = $this->Offices_model->get_scout_group_by_user_id($this->userSessID);
         $region     = $groupInfo->grp_region_id;
         $district   = $groupInfo->grp_scout_dis_id;
         $upazila    = $groupInfo->grp_scout_upa_id;
         $group      = $groupInfo->id;
         //Cross check for group
         if(!$this->Offices_model->cross_check_scouts_member($scoutID, '', '', '', $group)){
            show_404('scouts_member - edit - GA', TRUE);
         }
         //Dropdown
         $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
         $this->data['district_info'] = $this->Common_model->get_office_info('office_district', $district);
         $this->data['upazila_info'] = $this->Common_model->get_office_info('office_upazila', $upazila);
         $this->data['group_info'] = $this->Common_model->get_office_info('office_groups', $group);
         $this->data['unit_info'] = $this->Common_model->get_sc_unit_by_scout_group_id($group, $this->data['info']->sc_unit_id);

      }else{
         redirect('dashboard');
      }

      // validate form input
      $this->form_validation->set_rules('first_name', 'full name (English)', 'required|trim');
      $this->form_validation->set_rules('full_name_bn', 'full name (Bangla)', 'required|trim');
      $this->form_validation->set_rules('father_name', 'father name (English)', 'required|trim');
      $this->form_validation->set_rules('father_name_bn', 'father name (Bangla)', 'required|trim');
      $this->form_validation->set_rules('mother_name', 'mother name (English)', 'required|trim');
      $this->form_validation->set_rules('mother_name_bn', 'mother name (Bangla)', 'required|trim');
      $this->form_validation->set_rules('day', 'day', 'required|trim');
      $this->form_validation->set_rules('month', 'month', 'required|trim');
      $this->form_validation->set_rules('year', 'year', 'required|trim');
      $this->form_validation->set_rules('gender', 'gender', 'required|trim');
      $this->form_validation->set_rules('religion_id', 'religion', 'required|trim');
      $this->form_validation->set_rules('blood_group', 'blood group', 'trim');
      $this->form_validation->set_rules('phone', 'mobile number', 'required|trim');
      $this->form_validation->set_rules('email', 'email', 'valid_email|trim');

      $this->form_validation->set_rules('pre_village_house', 'present village/house (English)', 'required|trim');
      $this->form_validation->set_rules('pre_village_house_bn', 'present village/house (Bangla)', 'required|trim');
      $this->form_validation->set_rules('pre_road_block', 'present road/block (English)', 'required|trim');
      $this->form_validation->set_rules('pre_road_block_bn', 'present road/block (Bangla)', 'required|trim');
      $this->form_validation->set_rules('pre_division_id', 'present division', 'required|trim');
      $this->form_validation->set_rules('pre_district_id', 'present district', 'required|trim');
      $this->form_validation->set_rules('pre_upa_tha_id', 'present upazila / thana', 'required|trim');
      $this->form_validation->set_rules('pre_post_office', 'present post office', 'trim');

      $this->form_validation->set_rules('curr_institute_id', 'curr institute', 'trim');
      $this->form_validation->set_rules('curr_class', 'curr class', 'trim');
      $this->form_validation->set_rules('curr_role_no', 'curr role no', 'trim');

      $this->form_validation->set_rules('sc_cub', 'cub scouts', 'trim');
      $this->form_validation->set_rules('sc_scout', 'Scouts', 'trim');
      $this->form_validation->set_rules('sc_rover', 'rover scouts', 'trim');

      $this->form_validation->set_rules('join_date', 'join date', 'required|trim');
      $this->form_validation->set_rules('member_id', 'Member Type', 'required|trim');
      $this->form_validation->set_rules('sc_section_id', 'scouts sction', 'required|trim');
      $this->form_validation->set_rules('sc_badge_id', 'scouts badge', 'trim');
      $this->form_validation->set_rules('sc_role_id', 'scouts role', 'trim');
      $this->form_validation->set_rules('sc_region_id', 'scout region', 'trim');
      $this->form_validation->set_rules('sc_district_id', 'scout district', 'trim');
      $this->form_validation->set_rules('sc_upa_tha_id', 'scout upazila', 'trim');

      if($this->ion_auth->is_group_admin()){
         $this->form_validation->set_rules('sc_group_id', 'scout group', 'trim');
      }else{
         $this->form_validation->set_rules('sc_group_id', 'scout group', 'required|trim');
      }

      $this->form_validation->set_rules('sc_unit_id', 'scout unit', 'trim');
      $this->form_validation->set_rules('userfile', 'profile image required', '');
      $this->form_validation->set_rules('hide_img', 'profile image required', 'trim');

      // update the password if it was posted
      if ($this->input->post('password')){
         $this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']');
      }

      // if(@$_FILES['userfile']['size'] > 0){
      //    $this->form_validation->set_rules('userfile', '', 'callback_file_check');
      // }

      // Run after validation and input data
      if ($this->form_validation->run() == true){
         //check request
         if(decrypt_url($this->input->post('dataID')) != $scoutID){
            show_404('scouts_member - edit - submit check request post data', TRUE);
         }
         $dob = $this->input->post('year').'-'.$this->input->post('month').'-'.$this->input->post('day');
         $form_data = array(
            'first_name'        =>  $this->input->post('first_name'),
            'full_name_bn'      => $this->input->post('full_name_bn'),
            'father_name'       => $this->input->post('father_name'),
            'father_name_bn'    => $this->input->post('father_name_bn'),
            'mother_name'       => $this->input->post('mother_name'),
            'mother_name_bn'    => $this->input->post('mother_name_bn'),
            'dob'               =>  $dob,
            'gender'            =>  $this->input->post('gender'),
            'blood_group'       =>  $this->input->post('blood_group'),
            'phone'             =>  $this->input->post('phone'),
            'email'             =>  $this->input->post('email'),
            'is_interested'     =>  NULL,
            'religion_id'       =>  $this->input->post('religion_id'),
            'is_request'        =>  '0',
            'is_verify'         =>  '1',
            'pre_village_house' =>  $this->input->post('pre_village_house'),
            'pre_village_house_bn' => $this->input->post('pre_village_house_bn'),
            'pre_road_block'    => $this->input->post('pre_road_block'),
            'pre_road_block_bn' => $this->input->post('pre_road_block_bn'),
            'pre_division_id'   =>  $this->input->post('pre_division_id'),
            'pre_district_id'   =>  $this->input->post('pre_district_id'),
            'pre_upa_tha_id'    =>  $this->input->post('pre_upa_tha_id'),
            'pre_post_office'   =>  $this->input->post('pre_post_office'),
            'curr_institute_id' =>  $this->input->post('curr_institute_id'),
            'curr_class'        =>  $this->input->post('curr_class'),
            'curr_role_no'      =>  $this->input->post('curr_role_no'),
            'scout_designation' =>  $this->input->post('scout_designation'),
            'curr_org'          =>  $this->input->post('curr_org'),
            'curr_desig'        =>  $this->input->post('curr_desig'),
            'sc_cub'            =>  $this->input->post('sc_cub')=='Yes'?'Yes':'No',
            'sc_scout'          =>  $this->input->post('sc_scout')=='Yes'?'Yes':'No',
            'sc_rover'          =>  $this->input->post('sc_rover')=='Yes'?'Yes':'No',
            'join_date'         =>  date_db_format($this->input->post('join_date')),
            'member_id'         =>  $this->input->post('member_id'),
            'certificate_no'    =>  $this->input->post('certificate_no'),
            'certificate_date'  =>  date_db_format($this->input->post('certificate_date')),
            'expire_date'       =>  date_db_format($this->input->post('expire_date')),
            'sc_section_id'     =>  $this->input->post('sc_section_id'),
            'sc_badge_id'       =>  $this->input->post('sc_badge_id'),
            'sc_role_id'        =>  $this->input->post('sc_role_id')
            );

         // Scout office update by access level
         if($this->ion_auth->is_group_admin()){
            $form_data['sc_unit_id']      = $this->input->post('sc_unit_id');
         }elseif($this->ion_auth->is_upazila_admin()){
            $form_data['sc_group_id']     = $this->input->post('sc_group_id');
            $form_data['sc_unit_id']      = $this->input->post('sc_unit_id');
         }elseif($this->ion_auth->is_district_admin()){
            $form_data['sc_upa_tha_id']   = $this->input->post('sc_upa_tha_id');
            $form_data['sc_group_id']     = $this->input->post('sc_group_id');
            $form_data['sc_unit_id']      = $this->input->post('sc_unit_id');
         }elseif($this->ion_auth->is_region_admin()){
            $form_data['sc_district_id']  = $this->input->post('sc_district_id');
            $form_data['sc_upa_tha_id']   = $this->input->post('sc_upa_tha_id');
            $form_data['sc_group_id']     = $this->input->post('sc_group_id');
            $form_data['sc_unit_id']      = $this->input->post('sc_unit_id');
         }else{
            $form_data['sc_region_id']    = $this->input->post('sc_region_id');
            $form_data['sc_district_id']  = $this->input->post('sc_district_id');
            $form_data['sc_upa_tha_id']   = $this->input->post('sc_upa_tha_id');
            $form_data['sc_group_id']     = $this->input->post('sc_group_id');
            $form_data['sc_unit_id']      = $this->input->post('sc_unit_id');
         }

         // update the password if it was posted
         if ($this->input->post('password')){
            $form_data['password'] = $this->input->post('password');
         }

         // Find last scout ID like AA1003 and generate next ID AA1004
         // if($this->input->post('generateID')){
         //    $last_scout_id = $this->Scouts_member_model->get_last_scout_id(); // exit;
         //    $scout_id = $this->generateScoutID($last_scout_id);
         //    $form_data['scout_id'] = $this->input->post('generateID')?$scout_id:NULL;
         //    //$this->qrcode_generator($last_scout_id);
         // }

         // Image Upload
         // if($_FILES['userfile']['size'] > 0){
         //    $new_file_name = time().'-'.$_FILES["userfile"]['name'];
         //    $config['allowed_types']= 'jpg|png|jpeg';
         //    $config['upload_path']  = $this->img_path;
         //    $config['file_name']    = $new_file_name;
         //    $config['max_size']     = 600;

         //    $this->load->library('upload', $config);
         //    //upload file to directory
         //    if($this->upload->do_upload()){
         //       $uploadData = $this->upload->data();
         //       $config = array(
         //          'source_image' => $uploadData['full_path'],
         //          'new_image' => $this->img_path,
         //          'maintain_ratio' => TRUE,
         //          'width' => 300,
         //          'height' => 300
         //          );
         //       $this->load->library('image_lib',$config);
         //       $this->image_lib->initialize($config);
         //       $this->image_lib->resize();

         //       $uploadedFile = $uploadData['file_name'];
         //            // print_r($uploadedFile);
         //    }else{
         //       $this->data['message'] = $this->upload->display_errors();
         //    }
         // }

         // if($_FILES['userfile']['size'] > 0){
         //    $form_data['profile_img'] = $uploadedFile;
         // }

         // if($scoutID == '1910'){
         // echo '<pre>';
         // print_r($form_data); exit;
         // }

         if($this->ion_auth->update($scoutID, $form_data)){
            $id = $this->data['info']->id;

	         //Copy image, rename and remove from temp directory
            if($this->input->post('hide_img') != NULL){
               $file_name = $this->input->post('hide_img');
               $tmp = explode('.', $file_name);
               $file_extension = end($tmp);

	            //Copy file and rename
               $file = $this->img_thumb_path.'/'.$this->input->post('hide_img');
	            // $file = 'temp_dir/_thumb/'.$this->input->post('hide_img');
               $newfile = $id.'.'.$file_extension;

	            //Update table image field
               if($this->Common_model->set_profile_image($id, $newfile)){
                  $saveDir = $this->img_path.'/'.$newfile;
                  if (copy($file, $saveDir)) {
	                  // @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.'.$file_extension);
                     @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.png');
                     @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.jpg');
                     @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.jpeg');
                     @unlink($this->img_thumb_path.'\\'.$file_name);

	                  //$this->session->set_flashdata('success', 'Image update successfully.');
	                  //redirect('my_profile');
                  }
               }
            }

            func_activity_log(2, 'Scout Member Infomation Update ID :'.$scoutID); //1=C, 2=U, 3=D, 4=V, 5=G
            // redirect them back to the admin page if admin, or to the base url if non admin
            $this->session->set_flashdata('success', 'Information update successfully.');
            redirect('scouts_member/all');
          }


       }

      //Dropdown
       $this->data['religions'] = $this->Common_model->set_religion();
       $this->data['days'] = $this->Common_model->get_days();
       $this->data['months'] = $this->Common_model->get_months();
       $this->data['years'] = $this->Common_model->get_years();
       $this->data['blood_group'] = $this->Common_model->get_blood_group();
       $this->data['divisions'] = $this->Common_model->get_division();
       $this->data['districts'] = $this->Common_model->get_district();
       $this->data['upazilas'] = $this->Common_model->get_upazila_thana();
       $this->data['member_type'] = $this->Common_model->get_member_type();
       $this->data['scout_section'] = $this->Common_model->set_scout_section();
       $this->data['scout_badges'] = $this->Common_model->get_badges($this->data['info']->member_id, $this->data['info']->sc_section_id);
       $this->data['scout_roles'] = $this->Common_model->get_roles($this->data['info']->member_id, $this->data['info']->sc_section_id);

      //Load page
       $this->data['meta_title'] = 'Edit Scouts Member Infomation';
       $this->data['subview'] = 'edit';
       $this->load->view('backend/_layout_main', $this->data);
    }



   /*************************** Add Scouts Member ****************************
   ***************************************************************************/

   public function create(){
      // scout office
      // $region = NULL;
      // $district = NULL;
      // $upazila = NULL;
      // $group = NULL;

      //Check authentication
      if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){
         // Superadmin
         $this->data['regions'] = $this->Common_model->get_regions();
         $this->data['scout_districts'] = $this->Common_model->get_scout_districts();
         $this->data['scout_upazila'] = $this->Common_model->get_scout_upazila_thana();
         $this->data['scout_group'] = $this->Common_model->get_scout_group_office();
         $this->data['scout_unit'] = $this->Common_model->get_scout_unit_office();

      }elseif($this->ion_auth->is_region_admin()){
         redirect('scouts_member/all');

         // Region Admin
         $office = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
         $region = $office;
         //Dropdown
         $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $office);
         $this->data['scout_districts'] = $this->Common_model->get_dropdown_office('office_district', 'dis_name', 'dis_scout_region_id', $office);

      }elseif($this->ion_auth->is_district_admin()){
         redirect('scouts_member/all');
         // District Admin
         $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID);
         $region     = $office->dis_scout_region_id;
         $district   = $office->id;
         //Dropdown
         $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
         $this->data['district_info'] = $this->Common_model->get_office_info('office_district', $district);
         $this->data['scout_upazila'] = $this->Common_model->get_dropdown_office('office_upazila', 'upa_name', 'upa_scout_dis_id', $district);
         $this->data['scout_group'] = $this->Common_model->get_dropdown_office('office_groups', 'grp_name', 'grp_scout_dis_id', $district);

      }elseif($this->ion_auth->is_upazila_admin()){
         redirect('scouts_member/all');
         // Upazila Admin
         $office = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
         $region     = $office->upa_region_id;
         $district   = $office->upa_scout_dis_id;
         $upazila    = $office->id;
         //Dropdown
         $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
         $this->data['district_info'] = $this->Common_model->get_office_info('office_district', $district);
         $this->data['upazila_info'] = $this->Common_model->get_office_info('office_upazila', $upazila);
         $this->data['scout_group'] = $this->Common_model->get_dropdown_office('office_groups', 'grp_name', '  grp_scout_upa_id', $upazila);

      }elseif($this->ion_auth->is_group_admin()){
         // Group Admin
         $office = $this->Offices_model->get_scout_group_by_user_id($this->userSessID);
         $region     = $office->grp_region_id;
         $district   = $office->grp_scout_dis_id;
         $upazila    = $office->grp_scout_upa_id;
         $group      = $office->id; //exit;
         //Dropdown
         $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
         $this->data['district_info'] = $this->Common_model->get_office_info('office_district', $district);
         $this->data['upazila_info'] = $this->Common_model->get_office_info('office_upazila', $upazila);
         $this->data['group_info'] = $this->Common_model->get_office_info('office_groups', $group);
         $this->data['scout_unit'] = $this->Common_model->get_sc_unit_by_scout_group_id($group);

      }else{
         redirect('dashboard');
      }

      //user
      $tables = $this->config->item('tables','ion_auth');
      $identity_column = $this->config->item('identity','ion_auth');
      $this->data['identity_column'] = $identity_column;

      // validate form input field
      if($identity_column!=='email') {
         $this->form_validation->set_rules('identity','username','required|is_unique['.$tables['users'].'.'.$identity_column.']|callback_username_valid');
         $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'valid_email');
      } else {
         $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
      }
      $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']');

      $this->form_validation->set_rules('first_name', 'full name (English)', 'required|trim');
      $this->form_validation->set_rules('full_name_bn', 'full name (Bangla)', 'required|trim');
      $this->form_validation->set_rules('father_name', 'father name (English)', 'required|trim');
      // $this->form_validation->set_rules('father_name_bn', 'father name (Bangla)', 'required|trim');
      $this->form_validation->set_rules('mother_name', 'mother name (English)', 'required|trim');
      // $this->form_validation->set_rules('mother_name_bn', 'mother name (Bangla)', 'required|trim');
      $this->form_validation->set_rules('day', 'day', 'required|trim');
      $this->form_validation->set_rules('month', 'month', 'required|trim');
      $this->form_validation->set_rules('year', 'year', 'required|trim');
      $this->form_validation->set_rules('gender', 'gender', 'required|trim');
      $this->form_validation->set_rules('religion_id', 'religion', 'required|trim');
      $this->form_validation->set_rules('blood_group', 'blood group', 'trim');
      $this->form_validation->set_rules('phone', 'mobile number', 'required|trim');
      $this->form_validation->set_rules('email', 'email', 'valid_email|trim');

      $this->form_validation->set_rules('pre_village_house', 'present village/house (English)', 'required|trim');
      // $this->form_validation->set_rules('pre_village_house_bn', 'present village/house (Bangla)', 'required|trim');
      $this->form_validation->set_rules('pre_road_block', 'present road/block (English)', 'required|trim');
      // $this->form_validation->set_rules('pre_road_block_bn', 'present road/block (Bangla)', 'required|trim');
      $this->form_validation->set_rules('pre_division_id', 'present division', 'required|trim');
      $this->form_validation->set_rules('pre_district_id', 'present district', 'required|trim');
      $this->form_validation->set_rules('pre_upa_tha_id', 'present upazila / thana', 'required|trim');
      $this->form_validation->set_rules('pre_post_office', 'present post office', 'trim');

      $this->form_validation->set_rules('curr_institute_id', 'curr institute', 'trim');
      $this->form_validation->set_rules('curr_class', 'curr class', 'trim');
      $this->form_validation->set_rules('curr_role_no', 'curr role no', 'trim');

      $this->form_validation->set_rules('sc_cub', 'cub scouts', 'trim');
      $this->form_validation->set_rules('sc_scout', 'Scouts', 'trim');
      $this->form_validation->set_rules('sc_rover', 'rover scouts', 'trim');

      $this->form_validation->set_rules('join_date', 'join date', 'required|trim');
      $this->form_validation->set_rules('member_id', 'Member Type', 'required|trim');
      $this->form_validation->set_rules('sc_section_id', 'request sction', 'required|trim');
      $this->form_validation->set_rules('sc_badge_id', 'request badge', 'trim');
      $this->form_validation->set_rules('sc_role_id', 'request role', 'trim');
      $this->form_validation->set_rules('sc_region_id', 'scout region', 'trim');
      $this->form_validation->set_rules('sc_district_id', 'scout district', 'trim');
      $this->form_validation->set_rules('sc_upa_tha_id', 'scout upazila/thana', 'trim');
      // $this->form_validation->set_rules('sc_group_id', 'scout group', 'required|trim');
      // $this->form_validation->set_rules('sc_unit_id', 'scout unit', 'trim');

      if($this->ion_auth->is_group_admin()){
         $this->form_validation->set_rules('sc_group_id', 'scout group', 'trim');
      }else{
         $this->form_validation->set_rules('sc_group_id', 'scout group', 'required|trim');
      }
      $this->form_validation->set_rules('sc_unit_id', 'scout unit', 'trim');

      // $this->form_validation->set_rules('userfile', 'profile image required', '');

      // if(@$_FILES['userfile']['size'] > 0){
      //    $this->form_validation->set_rules('userfile', '', 'callback_file_check');
      // }

      //Validate and input data
      if ($this->form_validation->run() == true) {
         $dob = $this->input->post('year').'-'.$this->input->post('month').'-'.$this->input->post('day');
         $email    = strtolower($this->input->post('email'));
         $identity = ($identity_column==='email') ? $email : $this->input->post('identity');
         $password = $this->input->post('password');

         if($this->input->post('generateID') == 1){
            // Find last scout ID like AA1003 and generate next ID AA1004
            $last_scout_id = $this->Scouts_member_model->get_last_scout_id(); // exit;
            $scout_id = $this->generateScoutID($last_scout_id);
            // Generate QR Code
            // $row_id = $this->Scouts_member_model->get_scout_row_id($scout_id)->id;
            // $this->qrcode_generator($row_id);
         }

         // Array data
         $additional_data = array(
            'scout_id'          => $this->input->post('generateID')==1?$scout_id:NULL,
            'first_name'        => $this->input->post('first_name'),
            'full_name_bn'      => $this->input->post('full_name_bn'),
            'father_name'       => $this->input->post('father_name'),
            'father_name_bn'    => $this->input->post('father_name_bn'),
            'mother_name'       => $this->input->post('mother_name'),
            'mother_name_bn'    => $this->input->post('mother_name_bn'),
            'dob'               =>  $dob,
            'gender'            =>  $this->input->post('gender'),
            'blood_group'       =>  $this->input->post('blood_group'),
            'phone'             =>  $this->input->post('phone'),
            'email'             =>  $this->input->post('email'),
            'is_interested'     =>  NULL,
            'religion_id'       =>  $this->input->post('religion_id'),
            'is_request'        =>  '0',
            'is_verify'         =>  '1',
            'pre_village_house' => $this->input->post('pre_village_house'),
            'pre_village_house_bn' => $this->input->post('pre_village_house_bn'),
            'pre_road_block'    => $this->input->post('pre_road_block'),
            'pre_road_block_bn' => $this->input->post('pre_road_block_bn'),
            'pre_division_id'   =>  $this->input->post('pre_division_id'),
            'pre_district_id'   =>  $this->input->post('pre_district_id'),
            'pre_upa_tha_id'    =>  $this->input->post('pre_upa_tha_id'),
            'pre_post_office'   =>  $this->input->post('pre_post_office'),
            'scout_designation' =>  $this->input->post('scout_designation'),
            'curr_institute_id' =>  $this->input->post('curr_institute_id'),
            'curr_class'        =>  $this->input->post('curr_class'),
            'curr_role_no'      =>  $this->input->post('curr_role_no'),
            'curr_org'          =>  $this->input->post('curr_org'),
            'curr_desig'        =>  $this->input->post('curr_desig'),
            'sc_cub'            =>  $this->input->post('sc_cub')=='Yes'?'Yes':'No',
            'sc_scout'          =>  $this->input->post('sc_scout')=='Yes'?'Yes':'No',
            'sc_rover'          =>  $this->input->post('sc_rover')=='Yes'?'Yes':'No',
            'sc_adult'          =>  $this->input->post('sc_adult')=='Yes'?'Yes':'No',
            'join_date'         =>  date_db_format($this->input->post('join_date')),
            'member_id'         =>  $this->input->post('member_id'),
            'certificate_no'    =>  $this->input->post('certificate_no'),
            'certificate_date'  =>  date_db_format($this->input->post('certificate_date')),
            'sc_section_id'     =>  $this->input->post('sc_section_id'),
            'sc_badge_id'       =>  $this->input->post('sc_badge_id'),
            'sc_role_id'        =>  $this->input->post('sc_role_id'),
            'sc_region_id'      =>  $region != NULL ? $region:$this->input->post('sc_region_id'),
            'sc_district_id'    =>  $district != NULL ? $district:$this->input->post('sc_district_id'),
            'sc_upa_tha_id'     =>  $upazila != NULL ? $upazila:$this->input->post('sc_upa_tha_id'),
            'sc_group_id'       =>  $group != NULL ? $group:$this->input->post('sc_group_id'),
            'sc_unit_id'        =>  $this->input->post('sc_unit_id'),
            );

         // echo '<pre>';
         // print_r($additional_data); exit;


         $user_group = array('9');
         // if ($this->form_validation->run() == true && $this->ion_auth->register($identity, $password, $email, $additional_data, $user_group)) {
         // $insert_id = $this->db->insert_id();

         if($insert_id = $this->ion_auth->register($identity, $password, $email, $additional_data, $user_group)){
            //Copy image, rename and remove from temp directory
            if($this->input->post('hide_img') != NULL){
               $file_name = $this->input->post('hide_img');
               $tmp = explode('.', $file_name);
               $file_extension = end($tmp);

               //Copy file and rename
               $file = $this->img_thumb_path.'/'.$this->input->post('hide_img');
               // $file = 'temp_dir/_thumb/'.$this->input->post('hide_img');
               $newfile = $insert_id.'.'.$file_extension;

               //Update table image field
               if($this->Common_model->set_profile_image($insert_id, $newfile)){
                  $saveDir = $this->img_path.'/'.$newfile;
                  if (copy($file, $saveDir)) {
                     // @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.'.$file_extension);
                     @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.png');
                     @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.jpg');
                     @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.jpeg');
                     @unlink($this->img_thumb_path.'\\'.$file_name);

                     //$this->session->set_flashdata('success', 'Image update successfully.');
                     //redirect('my_profile');
                  }
               }
            }

            //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            func_activity_log(1, 'Scout Member create ID :'.$insert_id);
            // check to see if we are creating the user
            // redirect them back to the admin page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect('scouts_member');
         }
      }

      // display the create user form
      // set the flash data error message if there is one
      $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

      // dropdown list
      $this->data['religions'] = $this->Common_model->set_religion();
      $this->data['days'] = $this->Common_model->get_days();
      $this->data['months'] = $this->Common_model->get_months();
      $this->data['years'] = $this->Common_model->get_years();
      $this->data['blood_group'] = $this->Common_model->get_blood_group();
      $this->data['divisions'] = $this->Common_model->get_division();
      $this->data['districts'] = $this->Common_model->get_district();
      $this->data['upazilas'] = $this->Common_model->get_upazila_thana();
      // $this->data['regions'] = $this->Common_model->get_regions();
      $this->data['member_type'] = $this->Common_model->get_member_type();
      $this->data['scout_section'] = $this->Common_model->set_scout_section();
      // Load Page
      $this->data['meta_title'] = 'Add Scouts Member';
      $this->data['subview'] = 'create';
      $this->load->view('backend/_layout_main', $this->data);
   }



   /****************** Verify, Cancel, Restore and Archive *******************
   ***************************************************************************/

   public function verify($id){
      // Encryption
      $scoutID = (int) decrypt_url($id);

      if(!$this->Common_model->exists('users', 'id', $scoutID)){
         show_404('scouts_member - verify - exists', TRUE);
      }

      //Check authentication
      if($this->ion_auth->is_group_admin()){
         // Group Admin
         $groupInfo = $this->Offices_model->get_scout_group_by_user_id($this->userSessID);
         $group      = $groupInfo->id;
         //Cross check for group admin
         if(!$this->Offices_model->cross_check_scouts_member($scoutID, '', '', '', $group)){
            show_404('scouts_member - verify - GA', TRUE);
         }
      }else{
         redirect('dashboard');
      }

      // validation
      $this->form_validation->set_rules('scout_section', 'approved scout section', 'trim');
      $this->data['info'] = $this->Scouts_member_model->get_verify($scoutID);

      //Validate and input data
      if ($this->form_validation->run() == true){
         //check request
         if(decrypt_url($this->input->post('dataID')) != $scoutID){
            show_404('scouts_member - verify - post submit check request ', TRUE);
         }

         //Generate Scout ID
         if($this->input->post('generateID')==1){
            // $last_id='AA10000';
            $last_id = $this->Scouts_member_model->get_last_scout_id(); // exit;
            $scout_id = $this->generateScoutID($last_id);
            // $this->qrcode_generator($last_id);
         }
         // set form data
         $form_data = array(
            'scout_id' => $this->input->post('generateID')==1?$scout_id:NULL,
            'is_request' => '0',
            'is_verify' => '1'
         );
         // Count user nit number

         $this->db->select('COUNT(id) as cnt')->where('sc_unit_id',$this->data['info']->sc_unit_id);
         $check = $this->db->where('status', 1)->where('is_verify', 1)->group_by('sc_unit_id')->get('users')->row();

         // Check Max 40 member per unit
         if($check->cnt >= 40){
            $this->session->set_flashdata('error', 'Max 40 member per unit.');
            // redirect('scouts_member/verify/'.encrypt_url($scoutID));
         } else {
            // update user data
            if($this->Common_model->edit('users', $scoutID, 'id', $form_data)){
               $this->ion_auth->remove_from_group('', $scoutID);
               $this->ion_auth->add_to_group('9', $scoutID);
               $this->session->set_flashdata('success', 'New scout member verify successfully.');
               redirect('scouts_member/all');
            }
         }
      }

      //Results
      $this->data['scout_section'] = $this->Common_model->set_scout_section();
      // dd($this->data['info']->sc_unit_id);

      //Load view
      $this->data['meta_title'] = 'Verify Scouts Member Request';
      $this->data['subview'] = 'verify';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function cancel($id){
      if(!$this->ion_auth->is_group_admin()){
         redirect('dashboard');
      }

      // Encryption
      $scoutID = (int) decrypt_url($id);

      if(!$this->Common_model->exists('users', 'id', $scoutID)){
         show_404('scouts_member - cancel - exists', TRUE);
      }

      if ($scoutID){
         $data = array('is_request' => '2');
         $this->Common_model->edit('users', $scoutID, 'id', $data);
         $this->session->set_flashdata('success', 'Cancel online application request successfully.');
         redirect('scouts_member/cancel_request');
      }
   }


   public function restore($id){
      //Encryption
      $scoutID = (int) decrypt_url($id); //exit;

      if(!$this->Common_model->exists('users', 'id', $scoutID)){
         show_404('scouts_member - restore - exists', TRUE);
      }

      //Check authentication
      if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){
         //Superadmin
         //Goto next
      }elseif($this->ion_auth->is_region_admin()){
         // Region Admin
         $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
         //Cross check for region admin
         if(!$this->Offices_model->cross_check_scouts_member($scoutID, $region, '', '', '')){
            show_404('scouts_member - restore - RA', TRUE);
         }

      }elseif($this->ion_auth->is_district_admin()){
         // District Admin
         $districtInfo = $this->Offices_model->get_district_office_by_user_id($this->userSessID);
         $region     = $districtInfo->dis_scout_region_id;
         $district   = $districtInfo->id;
         //Cross check for district admin
         if(!$this->Offices_model->cross_check_scouts_member($scoutID, '', $district, '', '')){
            show_404('scouts_member - restore - DA', TRUE);
         }

      }elseif($this->ion_auth->is_upazila_admin()){
         // Upazila Admin
         $upazilaInfo = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
         $region     = $upazilaInfo->upa_region_id;
         $district   = $upazilaInfo->upa_scout_dis_id;
         $upazila    = $upazilaInfo->id;
         //Cross check for upazila admin
         if(!$this->Offices_model->cross_check_scouts_member($scoutID, '', '', $upazila, '')){
            show_404('scouts_member - restore - UA', TRUE);
         }

      }elseif($this->ion_auth->is_group_admin()){
         // Group Admin
         $groupInfo = $this->Offices_model->get_scout_group_by_user_id($this->userSessID);
         $group      = $groupInfo->id;
         //Cross check for group admin
         if(!$this->Offices_model->cross_check_scouts_member($scoutID, '', '', '', $group)){
            show_404('scouts_member - restore - GA', TRUE);
         }
      }else{
         redirect('dashboard');
      }


      // Change 'status' field to archive/delete request list
      if ($scoutID){
         $data = array('status' => '1');
         if($this->Common_model->edit('users', $scoutID, 'id', $data)){
            $this->session->set_flashdata('success', 'Scouts member restored successfully.');
         }
         redirect('scouts_member/all');
      }
   }

   public function restore_to_verify($id){
      if(!$this->ion_auth->is_group_admin()){
         redirect('dashboard');
      }

      // Encryption
      $scoutID = (int) decrypt_url($id);

      if(!$this->Common_model->exists('users', 'id', $scoutID)){
         show_404('scouts_member - restore_to_verify - exists', TRUE);
      }

      // Change 'status' field to delete request list
      if ($scoutID){
         $data = array(
            'is_request' => '1',
            'is_verify' => '0'
            );

         if($this->Common_model->edit('users', $scoutID, 'id', $data)){
            $this->session->set_flashdata('success', 'Restore to the user for verifying request list successfully.');
         }
         redirect('scouts_member/request');
      }
   }


   public function archive($id){
      $scoutID = (int) decrypt_url($id);

      if(!$this->Common_model->exists('users', 'id', $scoutID)){
         show_404('scouts_member - archive - exists', TRUE);
      }

      /***********Activity Logs Start**********/
      $activity_data['user_id'] = $this->userSessID;
      $activity_data['message'] = 'Scouts Member archive ID: '.$scoutID;
      $activity_data['activity_type_id'] = 2; //For Update Activity log
      $activity_data['ip_address'] = $this->Common_model->get_client_ip();
      $activity_data['created'] = date('Y-m-d H:i:s');
      $this->Common_model->save('activity_logs',$activity_data);
      /***********Activity Logs End**********/

      //Check authentication
      if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){
         //Superadmin
         //Goto next

      }elseif($this->ion_auth->is_region_admin()){
         // Region Admin
         $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
         //Cross check for region admin
         if(!$this->Offices_model->cross_check_scouts_member($scoutID, $region, '', '', '')){
            show_404('scouts_member - archive - RA', TRUE);
         }

      }elseif($this->ion_auth->is_district_admin()){
         // District Admin
         $districtInfo = $this->Offices_model->get_district_office_by_user_id($this->userSessID);
         $region     = $districtInfo->dis_scout_region_id;
         $district   = $districtInfo->id;
         //Cross check for district admin
         if(!$this->Offices_model->cross_check_scouts_member($scoutID, '', $district, '', '')){
            show_404('scouts_member - archive - DA', TRUE);
         }

      }elseif($this->ion_auth->is_upazila_admin()){
         // Upazila Admin
         $upazilaInfo = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
         $region     = $upazilaInfo->upa_region_id;
         $district   = $upazilaInfo->upa_scout_dis_id;
         $upazila    = $upazilaInfo->id;
         //Cross check for upazila admin
         if(!$this->Offices_model->cross_check_scouts_member($scoutID, '', '', $upazila, '')){
            show_404('scouts_member - archive - UA', TRUE);
         }

      }elseif($this->ion_auth->is_group_admin()){
         // Group Admin
         $groupInfo = $this->Offices_model->get_scout_group_by_user_id($this->userSessID);
         $group      = $groupInfo->id;
         //Cross check for group admin
         if(!$this->Offices_model->cross_check_scouts_member($scoutID, '', '', '', $group)){
            show_404('scouts_member - archive - GA', TRUE);
         }

      }else{
         redirect('dashboard');
      }

      // Change 'status' field to archive list
      if ($scoutID){
         $data = array('status' => '2');
         if($this->Common_model->edit('users', $scoutID, 'id', $data)){
          func_activity_log(6, 'Scout Member Archive ID :'.$scoutID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
          $this->session->set_flashdata('success', 'Scouts member archived successfully.');
         }
         redirect('scouts_member/archive_list');
      }
   }



   /****************************** User Delete *******************************
   ***************************************************************************/

   public function delete($id){
      $scoutID = (int) decrypt_url($id);

      if(!$this->Common_model->exists('users', 'id', $scoutID)){
         show_404('scouts_member - delete - exists', TRUE);
      }

      //Check authentication
      if($this->ion_auth->is_admin()){
         //Superadmin
         //Goto next
      }elseif($this->ion_auth->is_region_admin()){
         // Region Admin
         $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
         //Cross check for region admin
         if(!$this->Offices_model->cross_check_scouts_member($scoutID, $region, '', '', '')){
            show_404('scouts_member - delete - RA', TRUE);
         }

      }elseif($this->ion_auth->is_district_admin()){
         // District Admin
         $districtInfo = $this->Offices_model->get_district_office_by_user_id($this->userSessID);
         $region     = $districtInfo->dis_scout_region_id;
         $district   = $districtInfo->id;
         //Cross check for district admin
         if(!$this->Offices_model->cross_check_scouts_member($scoutID, '', $district, '', '')){
            show_404('scouts_member - delete - DA', TRUE);
         }

      }elseif($this->ion_auth->is_upazila_admin()){
         // Upazila Admin
         $upazilaInfo = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
         $region     = $upazilaInfo->upa_region_id;
         $district   = $upazilaInfo->upa_scout_dis_id;
         $upazila    = $upazilaInfo->id;
         //Cross check for upazila admin
         if(!$this->Offices_model->cross_check_scouts_member($scoutID, '', '', $upazila, '')){
            show_404('scouts_member - delete - UA', TRUE);
         }

      }elseif($this->ion_auth->is_group_admin()){
         // Group Admin
         $groupInfo = $this->Offices_model->get_scout_group_by_user_id($this->userSessID);
         $group      = $groupInfo->id;
         //Cross check for group admin
         if(!$this->Offices_model->cross_check_scouts_member($scoutID, '', '', '', $group)){
            show_404('scouts_member - delete - GA', TRUE);
         }
      }else{
         redirect('dashboard');
      }

      /***********Activity Logs Start**********/
      $activity_data['user_id'] = $this->userSessID;
      $activity_data['message'] = 'Scouts Member Delete ID: '.$scoutID;
      $activity_data['activity_type_id'] = 3; //For Delete Activity log
      $activity_data['ip_address'] = $this->Common_model->get_client_ip();
      $activity_data['created'] = date('Y-m-d H:i:s');
      $this->Common_model->save('activity_logs',$activity_data);
      /***********Activity Logs End**********/

      // Change 'status' field to delete request list
      if ($scoutID){
         $data = array('status' => '3');
         if($this->Common_model->edit('users', $scoutID, 'id', $data)){
            func_activity_log(3, 'Scout Member Delete ID :'.$scoutID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            $this->session->set_flashdata('success', 'User delete request successfully.');
         }
         redirect('scouts_member/delete_request');
      }
   }

   public function scout_member_delete($id){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin())){
         redirect('dashboard');
      }
      //Encrypt
      $scoutID = (int) decrypt_url($id); //exit;

      //Delete user and all related information
      if($this->Scouts_member_model->destroy_user_information($scoutID)){
         $this->session->set_flashdata('success', 'All relevant information is deleted from the database of this member.');
         redirect("scouts_member/delete_request");
      }else{
         $this->session->set_flashdata('warning', 'Someting is wrong.');
         redirect("scouts_member/delete_request");
      }
   }

   /************************* Scout ID Print By Vendor ****************************
   *******************************************************************************/

   //  public function id_card($id){
   //    $scoutID = (int) decrypt_url($id);
   //    if(!$this->Common_model->exists('users', 'id', $scoutID)){
   //       show_404('scouts_member - id_card - exists', TRUE);
   //    }

   //    $this->data['info'] = $this->My_profile_model->get_info($scoutID);
   //    // echo $this->data['info']->id; exit;
   //    // echo '<pre>';
   //    // print_r($this->data['info']); exit;
   //    // if($this->data['info']->qr_img == NULL){
   //       // echo 'hello';
   //      $this->qrcode_generator($this->data['info']->id);
   //       // redirect('my_profile/id_card');
   //    // }
   //    //Load page
   //    $this->data['meta_title'] = 'Scout Member ID Card';
   //    $this->data['subview'] = 'id_card';
   //    $this->load->view('backend/_layout_main', $this->data);
   // }

   public function pdf_id_card($id){
      if(!$this->ion_auth->in_group(array('admin', 'scout_admin', 'monitor_team', 'regional_head', 'district_office', 'upazila_office'))){
         redirect('dashboard');
      }

      $scoutID = (int) decrypt_url($id);
      if(!$this->Common_model->exists('users', 'id', $scoutID)){
         show_404('scouts_member - pdf_id_card - exists', TRUE);
      }

      // Generate QR Code
      $this->qrcode_generator($scoutID);

      // Scout Information
      $this->data['info'] = $this->My_profile_model->get_info($scoutID);
      // echo $this->data['info']->scout_id; exit;

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


   public function print_completed($id){
      if(!$this->ion_auth->is_vendor()){
         redirect('dashboard');
      }

      // Encryption
      $scoutID = (int) decrypt_url($id);

      if(!$this->Common_model->exists('users', 'id', $scoutID)){
         show_404('scouts_member - print_completed - exists', TRUE);
      }

      //
      $info = $this->Scouts_member_model->get_info($scoutID);

      // Flag for print scout id card
      if ($scoutID){
         $data = array( 'is_printed' => '1' );

         if($this->Common_model->edit('users', $scoutID, 'id', $data)){
            $this->session->set_flashdata('success', 'Print complete for scout ID: '.$info->scout_id);
         }
         redirect('scouts_member/all');
      }
   }

   public function print_not_completed($id){
      if(!$this->ion_auth->is_vendor()){
         redirect('dashboard');
      }

      // Encryption
      $scoutID = (int) decrypt_url($id);

      if(!$this->Common_model->exists('users', 'id', $scoutID)){
         show_404('scouts_member - print_not_completed - exists', TRUE);
      }

      //
      $info = $this->Scouts_member_model->get_info($scoutID);

      // Flag for print scout id card
      if ($scoutID){
         $data = array( 'is_printed' => '0' );

         if($this->Common_model->edit('users', $scoutID, 'id', $data)){
            $this->session->set_flashdata('success', 'Print not complete for scout ID: '.$info->scout_id);
         }
         redirect('scouts_member/all');
      }
   }


   /************************* Scouts Experience ******************************
   ***************************************************************************/

   public function cub_experience($id){
      redirect('dashboard');

      $this->data['info'] = $this->Scouts_member_model->get_expreance_info($id, 1);
      if(!empty($info)){
         $memberID = $this->data['info']->member_id;
         $sectionID = $this->data['info']->section_id;
      }else{
         $memberID = '';
         $sectionID = '';
      }

      $this->form_validation->set_rules('join_date', 'join date', 'required|trim');
      $this->form_validation->set_rules('sc_badge_id', 'request badge', 'trim');
      $this->form_validation->set_rules('sc_role_id', 'request role', 'trim');
      $this->form_validation->set_rules('sc_region_id', 'scout region', 'trim');
      $this->form_validation->set_rules('sc_district_id', 'scout district', 'trim');
      $this->form_validation->set_rules('sc_upa_tha_id', 'scout upazila', 'trim');
      $this->form_validation->set_rules('sc_group_id', 'scout group', 'trim');
      $this->form_validation->set_rules('sc_unit_id', 'scout unit', 'trim');

        // Run after validation
      if ($this->form_validation->run() == true){
         $form_data = array(
            'scout_id'          => $id,
            'join_date'         => date_db_format($this->input->post('join_date')),
            'member_id'         => $this->input->post('member_id'),
            'section_id'        => $this->input->post('sc_section_id'),
            'sc_badge_id'       => $this->input->post('sc_badge_id'),
            'sc_role_id'        => $this->input->post('sc_role_id'),
            'sc_region_id'      => $this->input->post('sc_region_id'),
            'sc_district_id'    => $this->input->post('sc_district_id'),
            'sc_upa_tha_id'     => $this->input->post('sc_upa_tha_id'),
            'sc_group_id'       => $this->input->post('sc_group_id'),
            'sc_unit_id'        => $this->input->post('sc_unit_id')
            );

         if(!empty($this->data['info'])){
            if($this->Common_model->edit('scout_experience', $this->data['info']->id, 'id', $form_data)){
               $this->session->set_flashdata('message', $this->ion_auth->messages() );
               redirect('scouts_member/details/'.$id);
            }
         }else{
            if($this->Common_model->save('scout_experience', $form_data)){
               $this->session->set_flashdata('message', $this->ion_auth->messages() );
               redirect('scouts_member/details/'.$id);
            }
         }
      }

      //dropdown
      $this->data['regions'] = $this->Common_model->get_regions();
      $this->data['scout_districts'] = $this->Common_model->get_scout_districts();
      $this->data['scout_upazila_thana'] = $this->Common_model->get_scout_upazila_thana();
      $this->data['scout_group'] = $this->Common_model->get_scout_group_office();
      $this->data['scout_unit'] = $this->Common_model->get_scout_unit_office();
      $this->data['member_type'] = $this->Common_model->get_member_type();
      $this->data['scout_section'] = $this->Common_model->set_scout_section();
      $this->data['scout_badges'] = $this->Common_model->get_badges($memberID, $sectionID);
      $this->data['scout_roles'] = $this->Common_model->get_roles($memberID, $sectionID);

      $this->data['meta_title'] = 'Update Cub Scout Experience Infomation';
      $this->data['subview'] = 'experience';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function scout_experience($id){
      redirect('dashboard');

      $this->data['info'] = $this->Scouts_member_model->get_expreance_info($id,2);
      if(!empty($info)){
         $memberID = $this->data['info']->member_id;
         $sectionID = $this->data['info']->section_id;
      }else{
         $memberID = '';
         $sectionID = '';
      }

      $this->form_validation->set_rules('join_date', 'join date', 'required|trim');
      $this->form_validation->set_rules('sc_badge_id', 'request badge', 'trim');
      $this->form_validation->set_rules('sc_role_id', 'request role', 'trim');
      $this->form_validation->set_rules('sc_region_id', 'scout region', 'trim');
      $this->form_validation->set_rules('sc_district_id', 'scout district', 'trim');
      $this->form_validation->set_rules('sc_upa_tha_id', 'scout upazila', 'trim');
      $this->form_validation->set_rules('sc_group_id', 'scout group', 'trim');
      $this->form_validation->set_rules('sc_unit_id', 'scout unit', 'trim');

        // Run after validation
      if ($this->form_validation->run() == true){
         $form_data = array(
            'scout_id'          => $id,
            'join_date'         => date_db_format($this->input->post('join_date')),
            'member_id'         => $this->input->post('member_id'),
            'section_id'        => $this->input->post('sc_section_id'),
            'sc_badge_id'       => $this->input->post('sc_badge_id'),
            'sc_role_id'        => $this->input->post('sc_role_id'),
            'sc_region_id'      => $this->input->post('sc_region_id'),
            'sc_district_id'    => $this->input->post('sc_district_id'),
            'sc_upa_tha_id'     => $this->input->post('sc_upa_tha_id'),
            'sc_group_id'       => $this->input->post('sc_group_id'),
            'sc_unit_id'        => $this->input->post('sc_unit_id')
            );

         if(!empty($this->data['info'])){
            if($this->Common_model->edit('scout_experience', $this->data['info']->id, 'id', $form_data)){
               $this->session->set_flashdata('message', $this->ion_auth->messages() );
               redirect('scouts_member/details/'.$id);
            }
         }else{
            if($this->Common_model->save('scout_experience', $form_data)){
               $this->session->set_flashdata('message', $this->ion_auth->messages() );
               redirect('scouts_member/details/'.$id);
            }
         }
      }

      //dropdown
      $this->data['regions'] = $this->Common_model->get_regions();
      $this->data['scout_districts'] = $this->Common_model->get_scout_districts();
      $this->data['scout_upazila_thana'] = $this->Common_model->get_scout_upazila_thana();
      $this->data['scout_group'] = $this->Common_model->get_scout_group_office();
      $this->data['scout_unit'] = $this->Common_model->get_scout_unit_office();
      $this->data['member_type'] = $this->Common_model->get_member_type();
      $this->data['scout_section'] = $this->Common_model->set_scout_section();
      $this->data['scout_badges'] = $this->Common_model->get_badges($memberID, $sectionID);
      $this->data['scout_roles'] = $this->Common_model->get_roles($memberID, $sectionID);

      //Load page
      $this->data['meta_title'] = 'Update Scout Experience Infomation';
      $this->data['subview'] = 'experience';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function rover_experience($id){
      redirect('dashboard');

      $this->data['info'] = $this->Scouts_member_model->get_expreance_info($id,3);
      if(!empty($info)){
         $memberID = $this->data['info']->member_id;
         $sectionID = $this->data['info']->section_id;
      }else{
         $memberID = '';
         $sectionID = '';
      }

      $this->form_validation->set_rules('join_date', 'join date', 'required|trim');
      $this->form_validation->set_rules('sc_badge_id', 'request badge', 'trim');
      $this->form_validation->set_rules('sc_role_id', 'request role', 'trim');
      $this->form_validation->set_rules('sc_region_id', 'scout region', 'trim');
      $this->form_validation->set_rules('sc_district_id', 'scout district', 'trim');
      $this->form_validation->set_rules('sc_upa_tha_id', 'scout upazila', 'trim');
      $this->form_validation->set_rules('sc_group_id', 'scout group', 'trim');
      $this->form_validation->set_rules('sc_unit_id', 'scout unit', 'trim');

      // Run after validation
      if ($this->form_validation->run() == true){
         $form_data = array(
            'scout_id'          => $id,
            'join_date'         => date_db_format($this->input->post('join_date')),
            'member_id'         => $this->input->post('member_id'),
            'section_id'        => $this->input->post('sc_section_id'),
            'sc_badge_id'       => $this->input->post('sc_badge_id'),
            'sc_role_id'        => $this->input->post('sc_role_id'),
            'sc_region_id'      => $this->input->post('sc_region_id'),
            'sc_district_id'    => $this->input->post('sc_district_id'),
            'sc_upa_tha_id'     => $this->input->post('sc_upa_tha_id'),
            'sc_group_id'       => $this->input->post('sc_group_id'),
            'sc_unit_id'        => $this->input->post('sc_unit_id')
            );

         if(!empty($this->data['info'])){
            if($this->Common_model->edit('scout_experience', $this->data['info']->id, 'id', $form_data)){
               $this->session->set_flashdata('message', $this->ion_auth->messages() );
               redirect('scouts_member/details/'.$id);
            }
         }else{
            if($this->Common_model->save('scout_experience', $form_data)){
               $this->session->set_flashdata('message', $this->ion_auth->messages() );
               redirect('scouts_member/details/'.$id);
            }
         }
      }

      //dropdown
      $this->data['regions'] = $this->Common_model->get_regions();
      $this->data['scout_districts'] = $this->Common_model->get_scout_districts();
      $this->data['scout_upazila_thana'] = $this->Common_model->get_scout_upazila_thana();
      $this->data['scout_group'] = $this->Common_model->get_scout_group_office();
      $this->data['scout_unit'] = $this->Common_model->get_scout_unit_office();
      $this->data['member_type'] = $this->Common_model->get_member_type();
      $this->data['scout_section'] = $this->Common_model->set_scout_section();
      $this->data['scout_badges'] = $this->Common_model->get_badges($memberID, $sectionID);
      $this->data['scout_roles'] = $this->Common_model->get_roles($memberID, $sectionID);

      //Load page
      $this->data['meta_title'] = 'Update Rover Scout Experience Infomation';
      $this->data['subview'] = 'experience';
      $this->load->view('backend/_layout_main', $this->data);
   }



   /************************** Other's funciton ******************************
   ***************************************************************************/

   public function username_valid($str){
      // alpha_dash_space
      // return (!preg_match("/^([-a-z0-9_ ])+$/i", $str)) ? FALSE : TRUE;
      if (! preg_match('/^\S*$/', $str)) {
         $this->form_validation->set_message('username_valid', 'The %s field may only contain alpha characters & no white spaces.');
         return FALSE;
      } else {
         return TRUE;
      }
   }

   public function file_check($str){
      $this->load->helper('file');
      $allowed_mime_type_arr = array('image/jpeg','image/png','image/x-png');
      $mime = get_mime_by_extension($_FILES['userfile']['name']);
      $file_size = 524288;
      $size_kb = '512 KB';

      if(isset($_FILES['userfile']['name']) && $_FILES['userfile']['name']!=""){
         if(!in_array($mime, $allowed_mime_type_arr)){
            $this->form_validation->set_message('file_check', 'Please select only jpg, jpeg, png file.');
            return false;
         }elseif($_FILES["userfile"]["size"] > $file_size){
            $this->form_validation->set_message('file_check', 'Maximum file size '.$size_kb);
            return false;
         }else{
            return true;
         }
      }else{
         $this->form_validation->set_message('file_check', 'Please choose a image file to upload.');
         return false;
      }
   }

   // Scout ID office type wise
   // public function scout_id_by_office_search($regionID=NULL, $districtID=NULL, $upazilaID=NULL, $groupID=NULL){
   //    $json = [];
   //    if(!empty($this->input->get("q"))){
   //       $this->db->select('id, CONCAT(scout_id, " (", first_name, ")") AS text');

   //       if(!empty($regionID)){
   //          $this->db->where('sc_region_id', $regionID);
   //       }
   //       if(!empty($districtID)){
   //          $this->db->where('sc_district_id', $districtID);
   //       }
   //       if(!empty($upazilaID)){
   //          $this->db->where('sc_upa_tha_id', $upazilaID);
   //       }
   //       if(!empty($groupID)){
   //          $this->db->where('sc_group_id', $groupID);
   //       }

   //       $this->db->where("(scout_id LIKE '%".$this->input->get("q")."%' OR first_name LIKE '%".$this->input->get("q")."%')", NULL, FALSE);

   //       $this->db->limit(10);
   //       $query = $this->db->get("users");

   //       $json = $query->result();
   //    }
   //    echo json_encode($json); exit;
   // }

   // Scout ID region wise
   public function scout_id_by_region_office_search($officeID){
      // Scout ID dropdown Office wise
      $json = [];
      if(!empty($this->input->get("q"))){
         // $this->db->like('scout_id', $this->input->get("q"));
         $this->db->select('id, CONCAT(scout_id, " (", first_name, ")") AS text');

         if(!empty($officeID)){
            $this->db->where('sc_region_id', $officeID);
         }

         $this->db->where("(scout_id LIKE '%".$this->input->get("q")."%' OR first_name LIKE '%".$this->input->get("q")."%')", NULL, FALSE);

         $this->db->limit(10);
         $query = $this->db->get("users");

         $json = $query->result();
         // echo $this->db->last_query(); exit;
      }
      echo json_encode($json); exit;
   }

   // Scout ID district wise
   public function scout_id_by_district_office_search($officeID){
      // Scout ID dropdown Office wise
      $json = [];
      if(!empty($this->input->get("q"))){
         // $this->db->like('scout_id', $this->input->get("q"));
         $this->db->select('id, CONCAT(scout_id, " (", first_name, ")") AS text');

         if(!empty($officeID)){
            $this->db->where('sc_district_id', $officeID);
         }

         $this->db->where("(scout_id LIKE '%".$this->input->get("q")."%' OR first_name LIKE '%".$this->input->get("q")."%')", NULL, FALSE);

         $this->db->limit(10);
         $query = $this->db->get("users");

         $json = $query->result();
         // echo $this->db->last_query(); exit;
      }
      echo json_encode($json); exit;
   }

   // Scout ID upazila office wise
   public function scout_id_by_upazila_office_search($officeID){
      // Scout ID dropdown Office wise
      $json = [];
      if(!empty($this->input->get("q"))){
         // $this->db->like('scout_id', $this->input->get("q"));
         $this->db->select('id, CONCAT(scout_id, " (", first_name, ")") AS text');

         if(!empty($officeID)){
            $this->db->where('sc_upa_tha_id', $officeID);
         }

         $this->db->where("(scout_id LIKE '%".$this->input->get("q")."%' OR first_name LIKE '%".$this->input->get("q")."%')", NULL, FALSE);

         $this->db->limit(10);
         $query = $this->db->get("users");

         $json = $query->result();
         // echo $this->db->last_query(); exit;
      }
      echo json_encode($json); exit;
   }

   // Scout ID Scout Group office wise
   public function scout_id_by_scout_group_office_search($officeID){
      // Scout ID dropdown Office wise
      $json = [];
      if(!empty($this->input->get("q"))){
         // $this->db->like('scout_id', $this->input->get("q"));
         $this->db->select('id, CONCAT(scout_id, " (", first_name, ")") AS text');

         if(!empty($officeID)){
            $this->db->where('sc_group_id', $officeID);
         }

         $this->db->where("(scout_id LIKE '%".$this->input->get("q")."%' OR first_name LIKE '%".$this->input->get("q")."%')", NULL, FALSE);

         $this->db->limit(10);
         $query = $this->db->get("users");

         $json = $query->result();
         // echo $this->db->last_query(); exit;
      }
      echo json_encode($json); exit;
   }


   public function scout_id_search(){
      // if($this->ion_auth->is_district_admin()){
      //       //District Admin
      //       $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID);
      //       $region     = $office->dis_scout_region_id;
      //       $this->db->where('sc_region_id', $region);
      //   }elseif($this->ion_auth->is_upazila_admin()){
      //       //Upazila Admin
      //       $office = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
      //       $district   = $office->upa_scout_dis_id;
      //   }elseif($this->ion_auth->is_group_admin()){
      //       // Group Admin
      //       $office = $this->Offices_model->get_scout_group_by_user_id($this->userSessID);
      //       $district   = $office->grp_scout_dis_id;
      //       $upazila    = $office->grp_scout_upa_id;
      // }
      // print_r($office); exit();

      $json = [];
      if(!empty($this->input->get("q"))){
         // $this->db->like('scout_id', $this->input->get("q"));
         $this->db->or_like('scout_id', $this->input->get("q"));
         $this->db->or_like('first_name', $this->input->get("q"));
         // if(!empty($region)){
         //    $this->db->where('sc_region_id', $region);
         // }
         // if(!empty($district)){
         //    $this->db->where('sc_district_id', $district);
         // }
         // if(!empty($upazila)){
         //    $this->db->where('sc_upa_tha_id', $upazila);
         // }
         $query = $this->db->select('id, CONCAT(scout_id, " (", first_name, ")") AS text')
         ->limit(1)
         ->get("users");
         $json = $query->result();
      }
      echo json_encode($json);
   }

   public function scout_id_search_training(){
      $json = [];
      if(!empty($this->input->get("q"))){
         $this->db->select('u.id, CONCAT(u.scout_id, " (", u.first_name, ")") AS text');
         $this->db->from('prog_training t');
         $this->db->join('users u', 'u.id = t.scout_id', 'LEFT');
         $this->db->or_like('u.scout_id', $this->input->get("q"));
         $this->db->or_like('u.first_name', $this->input->get("q"));
         $this->db->or_where('t.course_id', 34);
         $this->db->limit(1);
         $query = $this->db->get();
         // echo $this->db->last_query(); exit;
         $json = $query->result();
      }
      echo json_encode($json);
   }

   public function scout_id_search_by_group(){
      // if($this->ion_auth->is_district_admin()){
      //       //District Admin
      //       $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID);
      //       $region     = $office->dis_scout_region_id;
      //       $this->db->where('sc_region_id', $region);
      //   }elseif($this->ion_auth->is_upazila_admin()){
      //       //Upazila Admin
      //       $office = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
      //       $district   = $office->upa_scout_dis_id;
      //   }elseif($this->ion_auth->is_group_admin()){
      //       // Group Admin
      //       $office = $this->Offices_model->get_scout_group_by_user_id($this->userSessID);
      //       $district   = $office->grp_scout_dis_id;
      //       $upazila    = $office->grp_scout_upa_id;
      // }
      // print_r($office); exit();

      $json = [];
      if(!empty($this->input->get("q"))){
         // $this->db->like('scout_id', $this->input->get("q"));
         $this->db->or_like('scout_id', $this->input->get("q"));
         $this->db->or_like('first_name', $this->input->get("q"));
         // if(!empty($region)){
         //    $this->db->where('sc_region_id', $region);
         // }
         // if(!empty($district)){
         //    $this->db->where('sc_district_id', $district);
         // }
         // if(!empty($upazila)){
         //    $this->db->where('sc_upa_tha_id', $upazila);
         // }
         $query = $this->db->select('id, CONCAT(scout_id, " (", first_name, ")") AS text')
         ->where('sc_group_id', 90)
         ->limit(10)
         ->get("users");
         $json = $query->result();
      }
      echo json_encode($json);
   }





   /************************** Generate Scout ID ******************************
   ***************************************************************************/
   public function generateScoutID($last_id){
      $lastIdScoutChar = substr($last_id, 0, 2);
      $lastScoutIdNumber = substr($last_id, 2, 5);
      $nextScoutIdResult = "";

      if($lastScoutIdNumber == 9999)
      {
         //Next Scout char example: AZ to BA.
         $nextScoutCharacter = ++$lastIdScoutChar;

         $nextNumberStart = 1;
         $nextScoutNumber = str_pad($nextNumberStart,4,"0",STR_PAD_LEFT);
         //Next Scout ID  example:  BA0001
         $nextScoutIdResult = $nextScoutCharacter.$nextScoutNumber;
      }
      else
      {
         //Last Scout id + 1 example: 10 to 11.
         $nextNumber = $lastScoutIdNumber+1;
         //Add Str Prefix Scout id  example: 11 to 0011
         $nextScoutNumber = str_pad($nextNumber,4,"0",STR_PAD_LEFT);
         $nextScoutIdResult = $lastIdScoutChar.$nextScoutNumber;
      }

      return $nextScoutIdResult;
   }



   /************************** Generate QR Code ******************************
   ***************************************************************************/

   public function qrcode_generator($id){
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

   // public function qrcode_generator($id){
   //    $info = $this->Scouts_member_model->get_info($id);
   //    // print_r($info); exit;

   //    // here our data
   //    $name         = $info->first_name;
   //    $scout_id     = $info->scout_id;
   //    $phone        = '(+88)'.$info->phone;
   //    $orgName      = 'Bangladesh Scouts';
   //    $email        = $info->email;

   //    // if not used - leave blank!
   //    $addressLabel     = 'Present Address';
   //    $addressCo        = $info->pre_village_house;
   //    $addressStreet    = $info->pre_road_block;
   //    $addressTown      = $info->pre_district_name;
   //    $addressRegion    = $info->pre_div_name;
   //    $addressPostCode  = $info->per_post_office;
   //    $addressCountry   = 'Bangladesh';

   //    // we building raw data
   //    $codeContents  = 'BEGIN:VCARD'."\n";
   //    $codeContents .= 'NAME: '.$name."\n";
   //    $codeContents .= 'SCOUT ID: '.$scout_id."\n";
   //    $codeContents .= 'ORG: '.$orgName."\n";
   //    $codeContents .= 'CELL: '.$phone."\n";
   //    $codeContents .= 'EMAIL: '.$email."\n";

   //    $codeContents .= 'ADR;'.
   //    'LABEL="'.$addressLabel.'": '
   //    .$addressCo.';'
   //    .$addressStreet.';'
   //    .$addressTown.';'
   //    .$addressRegion.';'
   //    .$addressPostCode.';'
   //    .$addressCountry
   //    ."\n";
   //    $codeContents .= 'END:VCARD';

   //    $data['img_url']="";
   //    $this->load->library('ciqrcode');
   //    $qr_image=$id.'.png';
   //    $params['data'] = $codeContents;
   //    $params['level'] = 'H';
   //    $params['size'] = 8;
   //    $params['savename'] =FCPATH."qrcode_img/".$qr_image;
   //    if($this->ciqrcode->generate($params)){
   //       $this->Scouts_member_model->set_scout_qrcode($id, $qr_image);
   //       $data['img_url']=$qr_image;
   //    }
   //    //$this->load->view('qrcode', $data);
   // }

   public function access_denied(){
      // Load page
      $this->data['meta_title'] = 'Access Denied';
      $this->data['subview'] = 'access_denied';
      $this->load->view('backend/_layout_main', $this->data, NULL);
   }



   // public function backup_generateScoutID($last_id){
   //    // ,'D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'
   //    // $chars = array('A');
   //    $chars = range('A', 'Z');

   //    //print_r($last_id);

   //    // $comb = array('1','2','3','4','5','6','7','8','9');
   //    // $comb = range(1, 9999);

   //    $inputChar = substr($last_id, 0, 2);
   //    $inputNumber = substr($last_id, 2, 5);
   //    $nextInput = $inputNumber+1;
   //   // print_r($input);
   //   // $comb = array($nextInput);
   //    //$myoutput = $inputChar.$nextInput;

   //    //print_r($inputChar);
   //    //print_r($last_id);
   //   // print_r("output");
   //   // print_r($myoutput);
   //   // print_r($myoutput);

   //    $nextCharacter = "";
   //    if($inputNumber == 9999)
   //    {
   //       $nextCharacter = $inputChar+1;
   //       $start = 1;
   //       $nextInput = str_pad($start,4,"0",STR_PAD_LEFT);

   //    }
   //    else
   //    {
   //       $nextCharacter = $inputChar;
   //    }

   //    $nextOutputNumber = str_pad($nextInput,4,"0",STR_PAD_LEFT);

   //    $result = $nextCharacter.$nextOutputNumber;
   //    print_r($result);
   //    exit;

   //    $outputdata=$this->generate_id($last_id,$chars, 3, $comb);


   //       $this->data['output'] = $outputdata;
   //       // echo "<pre>";
   //       // print_r($outputdata);


   //    // $flag=1;
   //    foreach($outputdata as $k=>$val){
   //       // if(strlen($val) < 6)continue;
   //       if($flag==2){
   //          print_r($val);
   //          return $val;
   //       }
   //       // if($last_id==$val)$flag=2;
   //    }


   //    // if($flag==1)return 'AA1000';



   //    // $this->data['meta_title'] = 'Test Generate Scout ID';
   //    // $this->data['subview'] = 'scout_id';
   //    // $this->load->view('backend/_layout_main', $this->data);
   // }

   // public function generate_id($last_id,$chars, $size, $combinations = array()) {
   //    # recursive function
   //    # should be remove like this ID AA0000, BB0000
   //    # if it's the first iteration, the first set
   //    # of combinations is the same as the set of characters
   //    if (empty($combinations)) {
   //       $combinations = $chars;
   //    }
   //    # we're done if we're at size 1
   //    if ($size == 1) {
   //       return $combinations;
   //    }

   //    // print_r($chars);
   //    // print_r($combinations); exit;
   //    # initialise array to put new values in
   //    $new_combinations = array();

   //    # loop through existing combinations and character set to create strings
   //   // print_r($last_id);
   //   // print_r($chars);
   //    foreach ($chars as $char) {

   //      // print_r($combinations);
   //      // die();
   //       foreach ($combinations as $combination) {
   //          // echo $combination = sprintf("%04d", $combination);// exit;
   //          // $new_combinations[] = $combination . $char;


   //         $combination_data = str_pad($combination,4,"0",STR_PAD_LEFT);

   //          if($combination_data != "0000")
   //          {
   //             $new_combinations[] = $char . $combination_data;

   //             print_r($combination);
   //             print_r($new_combinations);
   //             die();
   //          }


   //       }

   //    }

   //    // echo "<pre>";
   //    // print_r($new_combinations);
   //    // echo "</pre>";
   //    // exit;


   //    # call same function again for the next iteration
   //    return $this->generate_id($last_id,$chars, $size - 1, $new_combinations);
   // }

   // public function selecttest(){
   //    // $this->load->view('scouts_member/selecttest');
   //    // Load page
   //    $this->data['meta_title'] = 'Select2 Test';
   //    $this->data['subview'] = 'selecttest';
   //    $this->load->view('backend/_layout_main', $this->data);
   // }

   // public function selectjson(){
   //    $json = [];
   //    $this->load->database();
   //    if(!empty($this->input->get("q"))){
   //       $this->db->like('scout_id', $this->input->get("q"));
   //       $query = $this->db->select('id, scout_id as text')->limit(10)->get("users");
   //       $json = $query->result();
   //    }
   //    echo json_encode($json);
   // }

}
