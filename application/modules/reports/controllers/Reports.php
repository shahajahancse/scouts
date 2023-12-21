<?php defined('BASEPATH') OR exit('No direct script access allowed');
// include 'classes/BanglaConverter.php';
class Reports extends Backend_Controller {

	public function __construct(){
      parent::__construct();
      $this->data['module_name'] = $this->data['module_title'] = 'Reports';
      if (!$this->ion_auth->logged_in()):
         redirect('login');
      endif;

      if (!$this->ion_auth->is_admin()):
         redirect('dashboard');
      endif;

      $this->load->model('Offices/Offices_model');
      $this->load->model('Reports_model');
   }

   public function index(){
      redirect('reports/scouts_member');
   }   

   public function scouts_member(){   

      // Validation
      $this->form_validation->set_rules('division', 'division', 'trim');

      // Input Data
      $btn_submit = $this->input->post('btnsubmit');
      $region = $this->input->post('region');
      $dis_type = $this->input->post('dis_type');
      $date_from = date_db_format($this->input->post('date_from'));
      $date_to = date_db_format($this->input->post('date_to'));


      if($this->form_validation->run() == true){
         // Top Scouts Region Member Registration
         if( $btn_submit == 'smr_region') {
            // $this->data['region'] = $this->Common_model->get_data('office_region');
            $this->data['date_from'] = $this->input->post('date_from');
            $this->data['date_to'] = $this->input->post('date_to');

            // Results
            $this->data['results'] = $this->Reports_model->get_smr_region($date_from, $date_to);
            // echo '<pre>'; 
            // print_r($this->data['results']); exit;

            // Generate PDF
            $this->data['headding'] = 'Top Scouts Member Registration By Region';
            $html = $this->load->view('scouts_member/pdf_smr_region', $this->data, true);

            $mpdf = new mPDF('', 'A4', 10, '', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();
            // $mpdf->output('report.pdf', "D");

         }else if( $btn_submit == 'smr_district') {
            // $this->data['region'] = $this->Common_model->get_data('office_region');
            $this->data['date_from'] = $this->input->post('date_from');
            $this->data['date_to'] = $this->input->post('date_to');

            if($this->input->post('dis_type')){
               $this->data['dis_type_info'] = $this->Common_model->get_single_data('scout_district_type', $this->input->post('dis_type'));               
            }else{
               $this->data['dis_type_info'] = '';
            }
            
            // Results
            $this->data['results'] = $this->Reports_model->get_smr_district($date_from, $date_to, $dis_type);
            // echo '<pre>'; 
            // print_r($this->data['results']); exit;

            // Generate PDF
            $this->data['headding'] = 'Top Scouts Member Registration By District';
            $html = $this->load->view('scouts_member/pdf_smr_district', $this->data, true);

            $mpdf = new mPDF('', 'A4', 10, '', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();
            // $mpdf->output('report.pdf', "D");

         }else if( $btn_submit == 'smr_upazila') {
            // $this->data['region'] = $this->Common_model->get_data('office_region');
            $this->data['date_from'] = $this->input->post('date_from');
            $this->data['date_to'] = $this->input->post('date_to');

            // Results
            $this->data['results'] = $this->Reports_model->get_smr_upazila($date_from, $date_to);
            // echo '<pre>'; 
            // print_r($this->data['results']); exit;

            // Generate PDF
            $this->data['headding'] = 'Top Scouts Member Registration By Upazila';
            $html = $this->load->view('scouts_member/pdf_smr_upazila', $this->data, true);

            $mpdf = new mPDF('', 'A4', 10, '', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();
            // $mpdf->output('report.pdf', "D");
         }
      }

      //Dropdown
      $this->data['regions'] = $this->Common_model->get_regions();
      $this->data['member_type'] = $this->Common_model->get_member_type();
      $this->data['scout_section'] = $this->Common_model->set_scout_section();      
      $this->data['dis_type'] = $this->Common_model->get_scout_district_type();

      // Load View 
      $this->data['meta_title'] = 'Scouts Member Reports';
      $this->data['subview'] = 'scouts_member';
      $this->load->view('backend/_layout_main', $this->data);
   }

  //  public function scouts_member($offset=0){
  //     $limit = 10;          
  //     $results = $this->Reports_model->get_scout_member($limit, $offset);
  //     $this->data['rows'] = $results['rows'];
  //     $this->data['total_rows'] = $results['num_rows'];
  //     $this->data['scout_group'] = $this->Common_model->set_scout_section(); 
  //     $this->data['pagination'] = create_pagination('reports/scouts_member/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);


  //     $this->data['districts'] = array('-- জেলা নির্বাচন করুন --');
  //     $this->data['upazilas'] = array('-- উপজেলা নির্বাচন করুন --');
  //     $this->data['scout_groups'] = array('-- গ্রুপ নির্বাচন করুন --');
  //     $this->data['region_id'] = NULL;
  //     $this->data['district_id'] = NULL;
  //     $this->data['upazila_id'] = NULL;
  //     $this->data['group_id'] = NULL;
  //     if($this->input->get('region') != NULL){
  //       $this->data['region_id'] = $this->input->get('region');
  //       $districts = $this->Common_model->get_sc_dis_by_region_id($this->input->get('region'));
  //       $this->data['districts'] = $districts;
  //    }
  //    if($this->input->get('district') != NULL){
  //       $this->data['district_id'] = $this->input->get('district');

  //       $upazilas = $this->Common_model->get_sc_upazila_by_district_id($this->input->get('district'));
  //       $this->data['upazilas'] = $upazilas;

  //       $scout_groups = $this->Common_model->get_sc_group_by_district_id($this->input->get('district'));
  //       $this->data['scout_groups'] = $scout_groups;
  //    }
  //    if($this->input->get('upazila') != NULL){
  //       $this->data['upazila_id'] = $this->input->get('upazila');

  //       $scout_groups = $this->Common_model->get_sc_group_by_upazila_thana_id($this->input->get('upazila'));
  //       $this->data['scout_groups'] = $scout_groups;
  //    }
  //    if($this->input->get('group') != NULL){
  //       $this->data['group_id'] = $this->input->get('group');
  //    }

  //     // Dropdown
  //    $this->data['divisions'] = $this->Common_model->get_division(); 
  //     //$this->data['districts'] = $this->Common_model->get_district();

  //     //$this->data['upazilas'] = $this->Common_model->get_upazila_thana(); 
  //    $this->data['regions'] = $this->Common_model->get_regions(); 
  //     //$this->data['scout_section'] = $this->Common_model->set_scout_section();

  //    $this->data['download_url'] = base_url('reports/pdf_scouts_member')."?region=".$this->data['region_id']."&district=".$this->data['district_id']."&upazila=".$this->data['upazila_id']."&group=".$this->data['group_id'];
  //    $this->data['doc_url'] = base_url('reports/doc_scouts_member')."?region=".$this->data['region_id']."&district=".$this->data['district_id']."&upazila=".$this->data['upazila_id']."&group=".$this->data['group_id'];

  //    $this->data['meta_title'] = 'All Scouts Member Reports';
  //    $this->data['subview'] = 'scouts_member';
  //    $this->load->view('backend/_layout_main', $this->data);
  // }

   public function scouts_regional($offset=0){
      $results = $this->data['results'] = $this->Reports_model->get_region();

     // $this->data['regions'] = $this->Common_model->get_regions(); 

      $this->data['meta_title'] = 'All Region Scouts';
      $this->data['subview'] = 'region';
      $this->load->view('backend/_layout_main', $this->data);
   }



/*   function index()
 {
  $this->load->model("excel_export_model");
  $data["employee_data"] = $this->excel_export_model->fetch_data();
  $this->load->view("excel_export_view", $data);
 }
*/

 function scouts_regional_excel()
 {
  $this->load->library("excel");
  $this->load->library("PHPExcel");
  $object = new PHPExcel();

    // Set document properties

  $object->setActiveSheetIndex(0)->mergeCells('A1:F1');
  $object->getActiveSheet()->setCellValue('A1','BANGLADESH SCOUTS');
  $table_columns = array("SL","REGION LOGO", " REGION NAME", " DIVISION NAME", "REGION TYPE", "STATUS");

  $column = 0;

  foreach($table_columns as $field)
  {
    $object->getActiveSheet()->setCellValueByColumnAndRow($column, 2, $field);
    $column++;
 }

    //$employee_data = $this->excel_export_model->fetch_data();
 $results = $this->data['results'] = $this->Reports_model->get_region();

 $excel_row = 3;
 $sl=0;
 foreach($results as $row)
 {   
    $sl++;

    if($row->region_status == 1) {
       $status = 'Active';
    }else{
       $status = 'Inactive';
    }

    if($row->region_type == 'divisional') {
       $region = 'Divitional Region';
    }else{
       $region = 'Special Region';
    }

    $img_path = base_url().'offices_img/';
    if($row->region_logo != NULL){
     $src= $img_path.$row->region_logo;
     $src_img = "<img src='$src' height='80'>";
  } else {
   $src_img = 'No logo';
}

$object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $sl);
$object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $sl);
$object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->region_name);
$object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->div_name);
$object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $region);
$object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $status);
$excel_row++;
}

$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="scouts_regional_excel.xls"');
$object_writer->save('php://output');
}













public function scouts_district_offices($offset=0){

   $this->data['results'] = $this->Reports_model->get_scout_district(); 
    /* print_r( $this->data['results']);
    exit;*/
      //dropdown  

    $this->data['regions'] = $this->Common_model->get_regions();  

    $this->data['region_id'] = NULL;
    if($this->input->get('region') != NULL){
       $this->data['region_id'] = $this->input->get('region');
    }

      // Load page
    $this->data['meta_title'] = 'All District Scouts Office';
    $this->data['subview'] = 'district';
    $this->load->view('backend/_layout_main', $this->data);
 }

 public function scouts_upozila(){

   $this->data['results'] = $this->Reports_model->get_scout_upazila();
       //dropdown  
   $this->data['divisions'] = $this->Common_model->get_division(); 
   $this->data['districts'] = $this->Common_model->get_district(); 
   $this->data['upazilas'] = $this->Common_model->get_upazila_thana(); 
   $this->data['regions'] = $this->Common_model->get_regions(); 

   $this->data['districts'] = array('-- জেলা নির্বাচন করুন --');
   $this->data['region_id'] = NULL;
   $this->data['district_id'] = NULL;
   if($this->input->get('region') != NULL){
    $this->data['region_id'] = $this->input->get('region');
    $districts = $this->Common_model->get_sc_dis_by_region_id($this->input->get('region'));
    $this->data['districts'] = $districts;
 }
 if($this->input->get('district') != NULL){
    $this->data['district_id'] = $this->input->get('district');
 }

       // Load page
 $this->data['meta_title'] = 'All Upazila/Thana Scouts Office';
 $this->data['subview'] = 'upazila';
 $this->load->view('backend/_layout_main', $this->data);
}

public function scouts_groups(){

 $this->data['results'] = $this->Reports_model->get_scout_group();
          //dropdown  
 $this->data['divisions'] = $this->Common_model->get_division(); 
 $this->data['districts'] = $this->Common_model->get_district(); 
 $this->data['upazilas'] = $this->Common_model->get_upazila_thana(); 
 $this->data['regions'] = $this->Common_model->get_regions(); 
 $this->data['scout_section'] = $this->Common_model->set_scout_section();

 $this->data['region_id'] = NULL;
 if($this->input->get('region') != NULL){
   $this->data['region_id'] = $this->input->get('region');
}

$this->data['districts'] = array('-- জেলা নির্বাচন করুন --');
$this->data['upazilas'] = array('-- উপজেলা নির্বাচন করুন --');
$this->data['region_id'] = NULL;
$this->data['district_id'] = NULL;
$this->data['upazila_id'] = NULL;
if($this->input->get('region') != NULL){
   $this->data['region_id'] = $this->input->get('region');
   $districts = $this->Common_model->get_sc_dis_by_region_id($this->input->get('region'));
   $this->data['districts'] = $districts;
}
if($this->input->get('district') != NULL){
   $this->data['district_id'] = $this->input->get('district');

   $upazilas = $this->Common_model->get_sc_upazila_by_district_id($this->input->get('district'));
   $this->data['upazilas'] = $upazilas;
}
if($this->input->get('upazila') != NULL){
   $this->data['upazila_id'] = $this->input->get('upazila');
}

$this->data['download_url'] = base_url('reports/pdf_scouts_groups')."?region=".$this->data['region_id']."&district=".$this->data['district_id']."&upazila=".$this->data['upazila_id']."&group=".$this->data['group_id'];

$this->data['doc_url'] = base_url('reports/doc_scouts_groups')."?region=".$this->data['region_id']."&district=".$this->data['district_id']."&upazila=".$this->data['upazila_id'];

        // Load page
$this->data['meta_title'] = 'All Scout Group Office';
$this->data['subview'] = 'scout_group';
$this->load->view('backend/_layout_main', $this->data);
}

public function doc_scouts_groups(){
 $results = $this->data['results'] = $this->Reports_model->get_scout_group();
 $this->data['divisions'] = $this->Common_model->get_division(); 
 $this->data['districts'] = $this->Common_model->get_district(); 
 $this->data['upazilas'] = $this->Common_model->get_upazila_thana(); 
 $this->data['regions'] = $this->Common_model->get_regions(); 
 $this->data['scout_section'] = $this->Common_model->set_scout_section();

 $this->data['region_id'] = NULL;
 if($this->input->get('region') != NULL){
   $this->data['region_id'] = $this->input->get('region');
}

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

$table->addCell(10000, $styleCell)->addText('Scout Group Office' , $fontStyle,array('align' => 'center'));




$phpWord->addTableStyle('myOwnTableTwoStyle', $styleTableTwo);

$tableTwo = $section->addTable('myOwnTableTwoStyle');

$tableTwo->addRow(10);

        // Add cells
$tableTwo->addCell(900, $styleCellTwo)->addText("SL", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
$tableTwo->addCell(3300, $styleCell)->addText("Scout Group Name", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
$tableTwo->addCell(1800, $styleCellTwo)->addText("Scout Upazila Name", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
$tableTwo->addCell(2000, $styleCellTwo)->addText("Scout District", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
$tableTwo->addCell(2500, $styleCellTwo)->addText("Scout Region", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
$tableTwo->addCell(1000, $styleCellTwo)->addText("Status", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));


$sl=0;
foreach ($results as $row){
   $sl++;
   if($row->grp_status == 1) {
      $status = 'Enable';
   }else{
      $status = 'Disable';
   }

   $tableTwo->addRow(10);
   $nameGroup = explode(' ', $row->grp_name);


   $tableTwo->addCell(1000, $styleCellTwo)->addText($sl, $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));

   $tableTwo->addCell(3300, $styleCellTwo)->addText($nameGroup[0].' '.$nameGroup[1].' '.$nameGroup[2].' '.$nameGroup[3], $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));

   $tableTwo->addCell(2000, $styleCellTwo)->addText($row->upa_name, $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
   $tableTwo->addCell(2000, $styleCellTwo)->addText($row->dis_name, $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
   $tableTwo->addCell(2000, $styleCellTwo)->addText($row->region_name, $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
   $tableTwo->addCell(1000, $styleCellTwo)->addText($status, $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0), 'indentation' => array('right' => 100)));


}


$section->addTextBreak(1);

if($_SERVER['HTTP_HOST'] === 'localhost'){

  $file_name = './report_doc/doc_scouts_groups.docx';
  $phpWord->save($file_name, 'Word2007');
  header("Content-Disposition: attachment; filename='doc_scouts_groups.docx'");
  readfile($file_name);
  unlink($file_name);
} else {
   $file_name = './report_doc/doc_scouts_groups.docx';
   header("Content-Disposition: attachment; filename='doc_scouts_groups.docx'");
   readfile($file_name);
}

}

public function pdf_scouts_groups(){
 $this->data['results'] = $this->Reports_model->get_scout_group();
          //dropdown  
 $this->data['divisions'] = $this->Common_model->get_division(); 
 $this->data['districts'] = $this->Common_model->get_district(); 
 $this->data['upazilas'] = $this->Common_model->get_upazila_thana(); 
 $this->data['regions'] = $this->Common_model->get_regions(); 
 $this->data['scout_section'] = $this->Common_model->set_scout_section();

 $this->data['region_id'] = NULL;
 if($this->input->get('region') != NULL){
   $this->data['region_id'] = $this->input->get('region');
}

        //...............................................................................
$this->data['meta_title'] = 'All Upazila/Thana Scouts Office';
$html = $this->load->view('pdf_scouts_groups', $this->data, true);   
$file_name ="pdf_scouts_groups.pdf";

        //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
$mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

        //generate the PDF from the given html
$mpdf->WriteHTML($html);

        //download it for 'D'. 
$mpdf->Output($file_name, "D");
}


public function scouts_units(){
 $this->data['results'] = $this->Reports_model->get_scout_unit();

 $this->data['divisions'] = $this->Common_model->get_division(); 
 $this->data['districts'] = $this->Common_model->get_district(); 
 $this->data['upazilas'] = $this->Common_model->get_upazila_thana(); 
 $this->data['regions'] = $this->Common_model->get_regions(); 
 $this->data['scout_section'] = $this->Common_model->set_scout_section();


 $this->data['districts'] = array('-- জেলা নির্বাচন করুন --');
 $this->data['upazilas'] = array('-- উপজেলা নির্বাচন করুন --');
 $this->data['scout_groups'] = array('-- গ্রুপ নির্বাচন করুন --');
 $this->data['region_id'] = NULL;
 $this->data['district_id'] = NULL;
 $this->data['upazila_id'] = NULL;
 $this->data['group_id'] = NULL;
 if($this->input->get('region') != NULL){
   $this->data['region_id'] = $this->input->get('region');
   $districts = $this->Common_model->get_sc_dis_by_region_id($this->input->get('region'));
   $this->data['districts'] = $districts;
}
if($this->input->get('district') != NULL){
   $this->data['district_id'] = $this->input->get('district');

   $upazilas = $this->Common_model->get_sc_upazila_by_district_id($this->input->get('district'));
   $this->data['upazilas'] = $upazilas;

   $scout_groups = $this->Common_model->get_sc_group_by_district_id($this->input->get('district'));
   $this->data['scout_groups'] = $scout_groups;
}
if($this->input->get('upazila') != NULL){
   $this->data['upazila_id'] = $this->input->get('upazila');

   $scout_groups = $this->Common_model->get_sc_group_by_upazila_thana_id($this->input->get('upazila'));
   $this->data['scout_groups'] = $scout_groups;
}
if($this->input->get('group') != NULL){
   $this->data['group_id'] = $this->input->get('group');
}

$this->data['download_url'] = base_url('reports/pdf_scouts_units')."?region=".$this->data['region_id']."&district=".$this->data['district_id']."&upazila=".$this->data['upazila_id']."&group=".$this->data['group_id'];

$this->data['doc_url'] = base_url('reports/doc_scouts_units')."?region=".$this->data['region_id']."&district=".$this->data['district_id']."&upazila=".$this->data['upazila_id']."&group=".$this->data['group_id'];

        // Load page
$this->data['meta_title'] = 'All Scout Unit Office';
$this->data['subview'] = 'scout_unit';
$this->load->view('backend/_layout_main', $this->data);
}

public function pdf_scouts_units(){
 $this->data['results'] = $this->Reports_model->get_scout_unit();
        //...............................................................................
 $this->data['meta_title'] = 'Scout Unit Office';
 $html = $this->load->view('pdf_scouts_units', $this->data, true);   
 $file_name ="pdf_scouts_units.pdf";

        //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
 $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

        //generate the PDF from the given html
 $mpdf->WriteHTML($html);

        //download it for 'D'. 
 $mpdf->Output($file_name, "D");
}


public function doc_scouts_units(){
 $results = $this->data['results'] = $this->Reports_model->get_scout_unit();

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

 $table->addCell(10000, $styleCell)->addText('Scout Unit Office' , $fontStyle,array('align' => 'center'));




 $phpWord->addTableStyle('myOwnTableTwoStyle', $styleTableTwo);

 $tableTwo = $section->addTable('myOwnTableTwoStyle');

 $tableTwo->addRow(10);

        // Add cells
 $tableTwo->addCell(900, $styleCellTwo)->addText("SL", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
 $tableTwo->addCell(3300, $styleCell)->addText("Scout Unit Name", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
 $tableTwo->addCell(1800, $styleCellTwo)->addText("Scout Group Name", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
 $tableTwo->addCell(2000, $styleCellTwo)->addText("Scout Upazila Name", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
 $tableTwo->addCell(2500, $styleCellTwo)->addText("Scout District", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
 $tableTwo->addCell(2500, $styleCellTwo)->addText("Scout Region", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
 $tableTwo->addCell(1000, $styleCellTwo)->addText("Status", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));


 $sl=0;
 foreach ($results as $row){
   $sl++;
   if($row->unit_status == 1) {
      $status = 'Enable';
   }else{
      $status = 'Disable';
   }


   $tableTwo->addRow(10);


   $tableTwo->addCell(1000, $styleCellTwo)->addText($sl, $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));

   $tableTwo->addCell(3300, $styleCellTwo)->addText($row->unit_name, $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));

   $tableTwo->addCell(2000, $styleCellTwo)->addText($row->grp_name, $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
   $tableTwo->addCell(2000, $styleCellTwo)->addText($row->upa_name, $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
   $tableTwo->addCell(2500, $styleCellTwo)->addText($row->dis_name, $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0), 'indentation' => array('right' => 100)));
   $tableTwo->addCell(1500, $styleCellTwo)->addText($row->region_name, $fontStyleFour, array('align' => 'right', 'space' => array('before' => 50, 'after' => 0), 'indentation' => array('right' => 100)));
   $tableTwo->addCell(1000, $styleCellTwo)->addText($status, $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0), 'indentation' => array('right' => 100)));
}


$section->addTextBreak(1);

if($_SERVER['HTTP_HOST'] === 'localhost'){

  $file_name = './report_doc/doc_scouts_units.docx';
  $phpWord->save($file_name, 'Word2007');
  header("Content-Disposition: attachment; filename='doc_scouts_units.docx'");
  readfile($file_name);
  unlink($file_name);
} else {
   $file_name = './report_doc/doc_scouts_units.docx';
   header("Content-Disposition: attachment; filename='doc_scouts_units.docx'");
   readfile($file_name);
}

}


public function national(){
 $this->data['results'] = $this->Reports_model->get_national_committee(); 
        // print_r( $this->data['results']);
        //exit;
        // Load page
 $this->data['meta_title'] = 'All National Scouts Executive Committee';
 $this->data['subview'] = 'national_committee';
 $this->load->view('backend/_layout_main', $this->data);
}
public function region(){
   if(!$this->ion_auth->is_admin()){
      redirect('dashboard');
   }

   $this->data['results'] = $this->Reports_model->get_region_committee(); 

      // Load page
   $this->data['meta_title'] = 'All Region Scouts Executive Committee';
   $this->data['subview'] = 'region_committee';
   $this->load->view('backend/_layout_main', $this->data);
}

public function district(){
   if($this->ion_auth->is_admin()){
      $this->data['results'] = $this->Reports_model->get_district_committee();
         // $this->data['results'] = $this->Offices_model->get_scout_district(); 
   }elseif($this->ion_auth->is_region_admin()){
      $region_id = $this->Reports_model->get_current_region_from_committee($this->session->userdata('user_id'))->office_region_id;
      $this->data['results'] = $this->Reports_model->get_district_committee($region_id); 
   }

      // Load page
   $this->data['meta_title'] = 'All District Scouts Executive Committee';
   $this->data['subview'] = 'district_committee';
   $this->load->view('backend/_layout_main', $this->data);
}

public function upazila(){
   if($this->ion_auth->is_admin()){
    $this->data['results'] = $this->Reports_model->get_upazila_thana_committee();  

 }elseif($this->ion_auth->is_region_admin()){
   $region_id = $this->Reports_model->get_current_region_from_committee($this->session->userdata('user_id'))->office_region_id;
   $this->data['results'] = $this->Reports_model->get_upazila_thana_committee($region_id); 

}elseif($this->ion_auth->is_district_admin()){
   $sc_district_id = $this->Reports_model->get_current_district_from_committee($this->session->userdata('user_id'))->office_district_id;
   $this->data['results'] = $this->Reports_model->get_upazila_thana_committee('',$sc_district_id);
}

      // $this->data['results'] = $this->Reports_model->get_upazila_committee();
      // Load page
$this->data['meta_title'] = 'All Upazila Scouts Executive Committee';
$this->data['subview'] = 'upazila_committee';
$this->load->view('backend/_layout_main', $this->data);
}

public function pdf_upazila(){

 $this->data['results'] = $this->Reports_model->get_scout_upazila();
       //dropdown  
 $this->data['divisions'] = $this->Common_model->get_division(); 
 $this->data['districts'] = $this->Common_model->get_district(); 
 $this->data['upazilas'] = $this->Common_model->get_upazila_thana(); 
 $this->data['regions'] = $this->Common_model->get_regions(); 

 $this->data['districts'] = array('-- জেলা নির্বাচন করুন --');
 $this->data['region_id'] = NULL;
 $this->data['district_id'] = NULL;
 if($this->input->get('region') != NULL){
    $this->data['region_id'] = $this->input->get('region');
    $districts = $this->Common_model->get_sc_dis_by_region_id($this->input->get('region'));
    $this->data['districts'] = $districts;
 }
 if($this->input->get('district') != NULL){
    $this->data['district_id'] = $this->input->get('district');
 }

        //...............................................................................
 $this->data['meta_title'] = 'All Upazila/Thana Scouts Office';
 $html = $this->load->view('pdf_upazila', $this->data, true);   
 $file_name ="pdf_upazila.pdf";

        //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
 $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

        //generate the PDF from the given html
 $mpdf->WriteHTML($html);

        //download it for 'D'. 
 $mpdf->Output($file_name, "D");
}
public function doc_upazila(){

 $results = $this->data['results'] = $this->Reports_model->get_scout_upazila();
       //dropdown  
 $this->data['divisions'] = $this->Common_model->get_division(); 
 $this->data['districts'] = $this->Common_model->get_district(); 
 $this->data['upazilas'] = $this->Common_model->get_upazila_thana(); 
 $this->data['regions'] = $this->Common_model->get_regions(); 

 $this->data['districts'] = array('-- জেলা নির্বাচন করুন --');
 $this->data['region_id'] = NULL;
 $this->data['district_id'] = NULL;
 if($this->input->get('region') != NULL){
    $this->data['region_id'] = $this->input->get('region');
    $districts = $this->Common_model->get_sc_dis_by_region_id($this->input->get('region'));
    $this->data['districts'] = $districts;
 }
 if($this->input->get('district') != NULL){
    $this->data['district_id'] = $this->input->get('district');
 }

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

 $table->addCell(10000, $styleCell)->addText('All Upazila/Thana Scouts Office' , $fontStyle,array('align' => 'center'));




 $phpWord->addTableStyle('myOwnTableTwoStyle', $styleTableTwo);

 $tableTwo = $section->addTable('myOwnTableTwoStyle');

 $tableTwo->addRow(10);

        // Add cells
 $tableTwo->addCell(900, $styleCellTwo)->addText("SL", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
 $tableTwo->addCell(3300, $styleCell)->addText("Scout Upazila Name", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
 $tableTwo->addCell(1800, $styleCellTwo)->addText("Scout District", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
 $tableTwo->addCell(2000, $styleCellTwo)->addText("Scout Region", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
 $tableTwo->addCell(2500, $styleCellTwo)->addText("Status", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));


 $sl=0;
 foreach ($results as $row){
  $sl++;
  if($row->upa_status == 1) {
     $status = 'Enable';
  }else{
     $status = 'Disable';
  }


  $tableTwo->addRow(10);


  $tableTwo->addCell(1000, $styleCellTwo)->addText($sl, $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));

  $tableTwo->addCell(3300, $styleCellTwo)->addText($row->upa_name, $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));

  $tableTwo->addCell(2000, $styleCellTwo)->addText($row->dis_name, $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
  $tableTwo->addCell(2000, $styleCellTwo)->addText($row->region_name, $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
  $tableTwo->addCell(2500, $styleCellTwo)->addText($status, $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0), 'indentation' => array('right' => 100)));
          //$tableTwo->addCell(1500, $styleCellTwo)->addText($status, $fontStyleFour, array('align' => 'right', 'space' => array('before' => 50, 'after' => 0), 'indentation' => array('right' => 100)));
}


$section->addTextBreak(1);

if($_SERVER['HTTP_HOST'] === 'localhost'){

  $file_name = './report_doc/doc_upazila.docx';
  $phpWord->save($file_name, 'Word2007');
  header("Content-Disposition: attachment; filename='doc_upazila.docx'");
  readfile($file_name);
  unlink($file_name);
} else {
   $file_name = './report_doc/doc_upazila.docx';
   header("Content-Disposition: attachment; filename='doc_upazila.docx'");
   readfile($file_name);
}


}


public function scout_group(){
   if($this->ion_auth->is_admin()){
      $this->data['results'] = $this->Reports_model->get_scout_group_committee();  

   }elseif($this->ion_auth->is_region_admin()){
      $region_id = $this->Reports_model->get_current_region_from_committee($this->session->userdata('user_id'))->office_region_id;
      $this->data['results'] = $this->Reports_model->get_scout_group_committee($region_id); 

   }elseif($this->ion_auth->is_district_admin()){
      $sc_district_id = $this->Reports_model->get_current_district_from_committee($this->session->userdata('user_id'))->office_district_id;
      $this->data['results'] = $this->Reports_model->get_scout_group_committee('',$sc_district_id);

   }elseif($this->ion_auth->is_upazila_admin()){
      echo $sc_upa_tha_id = $this->Reports_model->get_current_upazila_thana_from_committee($this->session->userdata('user_id'))->office_upa_tha_id;
      $this->data['results'] = $this->Reports_model->get_scout_group_committee('','',$sc_upa_tha_id);
         // print_r($this->data['results']); exit;
   }

      // $this->data['results'] = $this->Reports_model->get_upazila_committee();
      // Load page
   $this->data['meta_title'] = 'All Scout Group Executive Committee';
   $this->data['subview'] = 'scout_group_committee';
   $this->load->view('backend/_layout_main', $this->data);
}
public function training_list(){
 $this->data['training'] = $this->Reports_model->get_data_for_traing();

        // Load page
 $this->data['meta_title'] = 'Training List';
 $this->data['subview'] = 'training_list';
 $this->load->view('backend/_layout_main', $this->data);
}

public function event_list(){
 $this->data['event'] = $this->Reports_model->get_data_for_event();

        // Load page
 $this->data['meta_title'] = 'Event List';
 $this->data['subview'] = 'event_list';
 $this->load->view('backend/_layout_main', $this->data);
}
public function member_statics(){
      //
   $result = $this->Reports_model->get_members_count_by_sc_section_id(1,'Male');
   $this->data['count_cub_scout_m'] = $result['count'];
   $result = $this->Reports_model->get_members_count_by_sc_section_id(2,'Male');
   $this->data['count_scout_m'] = $result['count'];
   $result = $this->Reports_model->get_members_count_by_sc_section_id(3,'Male');
   $this->data['count_rober_scout_m'] = $result['count'];

   $result = $this->Reports_model->get_members_count_by_sc_section_id(1,'Female');
   $this->data['count_cub_scout_f'] = $result['count'];
   $result = $this->Reports_model->get_members_count_by_sc_section_id(2,'Female');
   $this->data['count_scout_f'] = $result['count'];
   $result = $this->Reports_model->get_members_count_by_sc_section_id(3,'Female');
   $this->data['count_rober_scout_f'] = $result['count'];

   $result = $this->Reports_model->get_members_count_by_sc_section_id(1,'Others');
   $this->data['count_cub_scout_o'] = $result['count'];
   $result = $this->Reports_model->get_members_count_by_sc_section_id(2,'Others');
   $this->data['count_scout_o'] = $result['count'];
   $result = $this->Reports_model->get_members_count_by_sc_section_id(3,'Others');
   $this->data['count_rober_scout_o'] = $result['count'];

   $result = $this->Reports_model->get_members_count_by_sc_section_id_and_sc_role_id(1,'Male',6);
   $this->data['count_cub_scout_leader_m'] = $result['count'];
   $result = $this->Reports_model->get_members_count_by_sc_section_id_and_sc_role_id(2,'Male',13);
   $this->data['count_scout_leader_m'] = $result['count'];
   $result = $this->Reports_model->get_members_count_by_sc_section_id_and_sc_role_id(3,'Male',23);
   $this->data['count_rober_scout_leader_m'] = $result['count'];

   $result = $this->Reports_model->get_members_count_by_sc_section_id_and_sc_role_id(1,'Female',6);
   $this->data['count_cub_scout_leader_f'] = $result['count'];
   $result = $this->Reports_model->get_members_count_by_sc_section_id_and_sc_role_id(2,'Female',13);
   $this->data['count_scout_leader_f'] = $result['count'];
   $result = $this->Reports_model->get_members_count_by_sc_section_id_and_sc_role_id(3,'Female',23);
   $this->data['count_rober_leader_scout_f'] = $result['count'];


   $result = $this->Reports_model->get_members_count_by_sc_section_id_and_sc_role_id(1,'Others',6);
   $this->data['count_cub_scout_leader_o'] = $result['count'];
   $result = $this->Reports_model->get_members_count_by_sc_section_id_and_sc_role_id(2,'Others',13);
   $this->data['count_scout_leader_o'] = $result['count'];
   $result = $this->Reports_model->get_members_count_by_sc_section_id_and_sc_role_id(3,'Others',23);
   $this->data['count_rober_scout_leader_o'] = $result['count'];


      //...............................................................................

      //$this->data['meta_title'] = 'Dashboard';
   $this->data['subview'] = 'member_statics';           
   $this->load->view('backend/_layout_main', $this->data); 
}
public function section_wise_report(){


   $result = $this->Reports_model->get_members_count_groupby_sc_badge_id(1);
   $this->data['count_cub_scout_section_wise'] = $result;
   $result = $this->Reports_model->get_members_count_groupby_sc_badge_id(2);
   $this->data['count_scout_section_wise'] = $result;
   $result = $this->Reports_model->get_members_count_groupby_sc_badge_id(3);
   $this->data['count_rover_scout_section_wise'] = $result;
   $result = $this->Reports_model->get_members_count_groupby_sc_badge_id(4);
   $this->data['count_adult_leader_section_wise'] = $result;
      //....................................................................
   $result = $this->Reports_model->get_member_count_year_wise_groupby_sc_section_id(1);
   $this->data['count_member_cub_scout_year_wise_groupby_section_wise'] = $result;
   $result = $this->Reports_model->get_member_count_year_wise_groupby_sc_section_id(2);
   $this->data['count_member_scout_year_wise_groupby_section_wise'] = $result;

   $result = $this->Reports_model->get_member_count_year_wise_groupby_sc_section_id(3);
   $this->data['count_member_rover_scout_year_wise_groupby_section_wise'] = $result;


   $result = $this->Common_model->set_scout_unit_type();
   $this->data['unit_type'] = $result;

        /*echo '<pre>';
         print_r($this->data);
        exit;
     */
      //...............................................................................

      //$this->data['meta_title'] = 'Dashboard';
        $this->data['subview'] = 'section_wise_report';           
        $this->load->view('backend/_layout_main', $this->data); 
     }
     public function unit_report(){


      $result = $this->Reports_model->get_unit_count_groupby_unit_type();
      $this->data['count_unit_type_wise'] = $result;
      $result = $this->Common_model->set_scout_unit_type();
      $this->data['unit_type'] = $result;

      $result = $this->Reports_model->get_unit_count_year_wise_groupby_unit_type();
      $this->data['count_unit_year_wise_type_wise'] = $result;

        /* echo '<pre>';
         print_r($this->data);
         exit;
     */
      //...............................................................................

      //$this->data['meta_title'] = 'Dashboard';
         $this->data['subview'] = 'unit_report';           
         $this->load->view('backend/_layout_main', $this->data); 
      }

      public function doc_unit_report(){

       $count_unit_type_wise = $this->Reports_model->get_unit_count_groupby_unit_type();
       $unit_type = $this->Common_model->set_scout_unit_type();
       $count_unit_year_wise_type_wise = $this->Reports_model->get_unit_count_year_wise_groupby_unit_type();

       /*.............................generate doc...........................*/

       require_once 'vendor/autoload.php';
       $phpWord = new \PhpOffice\PhpWord\PhpWord();
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

       $table->addCell(10000, $styleCell)->addText('স্কাউট ইউনিট রিপোর্ট' , $fontStyle,array('align' => 'center'));




       $phpWord->addTableStyle('myOwnTableTwoStyle', $styleTableTwo);

       $tableTwo = $section->addTable('myOwnTableTwoStyle');

       $tableTwo->addRow(10);

        // Add cells
       $tableTwo->addCell(5000, $styleCellTwo)->addText("শাখা", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
       $tableTwo->addCell(2000, $styleCell)->addText("মোট", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
       $tableTwo->addCell(2000, $styleCellTwo)->addText("Growth", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));

       foreach ($unit_type as $key => $value) { 
         foreach ($count_unit_type_wise as $ke => $val) { 
           if($val->unit_type==$key){

             $tableTwo->addRow(10);
             $tableTwo->addCell(5000, $styleCellTwo)->addText($value, $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));

             $tableTwo->addCell(2000, $styleCellTwo)->addText($val->count_total, $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
             foreach ($count_unit_year_wise_type_wise as $key => $v) { 
               if($v->unit_type== $val->unit_type){
                 $sub=$v->count_now- $v->count_prev;
                 if($v->count_prev!=0){
                    $growth=($sub/$v->count_prev)*100; 
                    $tableTwo->addCell(2000, $styleCellTwo)->addText($growth.'%', $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
                 } else {
                   $in=$v->count_now*100;
                   echo  $in.'%'; 
                }

             }
          }
       }
    }
 }

 $section->addTextBreak(1);


 if($_SERVER['HTTP_HOST'] === 'localhost'){

  $file_name = './report_doc/unit_report.docx';
  $phpWord->save($file_name, 'Word2007');
  header("Content-Disposition: attachment; filename='unit_report.docx'");
  readfile($file_name);
  unlink($file_name);
} else {
   $file_name = './report_doc/unit_report.docx';
   header("Content-Disposition: attachment; filename='unit_report.docx'");
   readfile($file_name);
}


}


public function pdf_scouts_member(){

   $results = $this->Reports_model->get_scout_member_pdf();
   $this->data['rows'] = $results['rows'];
   $this->data['total_rows'] = $results['num_rows'];
   $this->data['scout_group'] = $this->Common_model->set_scout_section(); 


      //...............................................................................
   $this->data['meta_title'] = 'All Scouts Member Reports';
   $html = $this->load->view('pdf_scouts_member', $this->data, true);   
   $file_name ="scouts_member.pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
   $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      //generate the PDF from the given html
   $mpdf->WriteHTML($html);

      //download it for 'D'. 
   $mpdf->Output($file_name, "D");
}



public function doc_scouts_member(){

   $results = $this->Reports_model->get_scout_member_pdf();
      //$this->data['rows'] = $results['rows'];
      //$this->data['total_rows'] = $results['num_rows'];
   $this->data['scout_group'] = $this->Common_model->set_scout_section(); 


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

   $table->addCell(10000, $styleCell)->addText('Scout Member List' , $fontStyle,array('align' => 'center'));




   $phpWord->addTableStyle('myOwnTableTwoStyle', $styleTableTwo);

   $tableTwo = $section->addTable('myOwnTableTwoStyle');

   $tableTwo->addRow(10);

        // Add cells
   $tableTwo->addCell(900, $styleCellTwo)->addText("SL", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
   $tableTwo->addCell(3300, $styleCell)->addText("Image", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
   /*$tableTwo->addCell(3300, $styleCell)->addText("Image", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));*/
   $tableTwo->addCell(1800, $styleCellTwo)->addText("Scout ID", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
   $tableTwo->addCell(2000, $styleCellTwo)->addText("Full Name", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
   $tableTwo->addCell(2500, $styleCellTwo)->addText("Phone", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
   $tableTwo->addCell(1500, $styleCellTwo)->addText("Email", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));

   $sln = 0;
   foreach($results['rows'] as $row)
   {
     $sln++;

          // Profile Image
     if($row->profile_img != NULL){
      $image =  __DIR__ . '/../../../../profile_img/'.$row->profile_img;
   }else{
      $image =  __DIR__ . '/../../../../profile_img/no-img.png';
   }

   $tableTwo->addRow(10);

   $tableTwo->addCell(1000, $styleCellTwo)->addText($sln, $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));

   $tableTwo->addCell(3300, $styleCellTwo)->addImage($image, array('width' => 50,
    'height' => 50, 'marginTop' => -1, 'marginLeft' => -1, 'wrappingStyle' => 'behind'
    ));

   $tableTwo->addCell(2000, $styleCellTwo)->addText($row->scout_id, $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
   $tableTwo->addCell(2000, $styleCellTwo)->addText($row->first_name, $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
   $tableTwo->addCell(2500, $styleCellTwo)->addText($row->phone, $fontStyleFour, array('align' => 'right', 'space' => array('before' => 50, 'after' => 0), 'indentation' => array('right' => 100)));
   $tableTwo->addCell(1500, $styleCellTwo)->addText($row->email, $fontStyleFour, array('align' => 'right', 'space' => array('before' => 50, 'after' => 0), 'indentation' => array('right' => 100)));
}

$section->addTextBreak(1);

if($_SERVER['HTTP_HOST'] === 'localhost'){

  $file_name = './report_doc/scouts_member.docx';
  $phpWord->save($file_name, 'Word2007');
  header("Content-Disposition: attachment; filename='scouts_member.docx'");
  readfile($file_name);
  unlink($file_name);
} else {
   $file_name = './report_doc/scouts_member.docx';
   header("Content-Disposition: attachment; filename='scouts_member.docx'");
   readfile($file_name);
}


}

public function pdf_member_statics(){
      //
   $result = $this->Reports_model->get_members_count_by_sc_section_id(1,'Male');
   $this->data['count_cub_scout_m'] = $result['count'];
   $result = $this->Reports_model->get_members_count_by_sc_section_id(2,'Male');
   $this->data['count_scout_m'] = $result['count'];
   $result = $this->Reports_model->get_members_count_by_sc_section_id(3,'Male');
   $this->data['count_rober_scout_m'] = $result['count'];

   $result = $this->Reports_model->get_members_count_by_sc_section_id(1,'Female');
   $this->data['count_cub_scout_f'] = $result['count'];
   $result = $this->Reports_model->get_members_count_by_sc_section_id(2,'Female');
   $this->data['count_scout_f'] = $result['count'];
   $result = $this->Reports_model->get_members_count_by_sc_section_id(3,'Female');
   $this->data['count_rober_scout_f'] = $result['count'];

   $result = $this->Reports_model->get_members_count_by_sc_section_id(1,'Others');
   $this->data['count_cub_scout_o'] = $result['count'];
   $result = $this->Reports_model->get_members_count_by_sc_section_id(2,'Others');
   $this->data['count_scout_o'] = $result['count'];
   $result = $this->Reports_model->get_members_count_by_sc_section_id(3,'Others');
   $this->data['count_rober_scout_o'] = $result['count'];

   $result = $this->Reports_model->get_members_count_by_sc_section_id_and_sc_role_id(1,'Male',6);
   $this->data['count_cub_scout_leader_m'] = $result['count'];
   $result = $this->Reports_model->get_members_count_by_sc_section_id_and_sc_role_id(2,'Male',13);
   $this->data['count_scout_leader_m'] = $result['count'];
   $result = $this->Reports_model->get_members_count_by_sc_section_id_and_sc_role_id(3,'Male',23);
   $this->data['count_rober_scout_leader_m'] = $result['count'];

   $result = $this->Reports_model->get_members_count_by_sc_section_id_and_sc_role_id(1,'Female',6);
   $this->data['count_cub_scout_leader_f'] = $result['count'];
   $result = $this->Reports_model->get_members_count_by_sc_section_id_and_sc_role_id(2,'Female',13);
   $this->data['count_scout_leader_f'] = $result['count'];
   $result = $this->Reports_model->get_members_count_by_sc_section_id_and_sc_role_id(3,'Female',23);
   $this->data['count_rober_leader_scout_f'] = $result['count'];


   $result = $this->Reports_model->get_members_count_by_sc_section_id_and_sc_role_id(1,'Others',6);
   $this->data['count_cub_scout_leader_o'] = $result['count'];
   $result = $this->Reports_model->get_members_count_by_sc_section_id_and_sc_role_id(2,'Others',13);
   $this->data['count_scout_leader_o'] = $result['count'];
   $result = $this->Reports_model->get_members_count_by_sc_section_id_and_sc_role_id(3,'Others',23);
   $this->data['count_rober_scout_leader_o'] = $result['count'];


      //...............................................................................

   $html = $this->load->view('pdf_member_statics', $this->data, true);   
   $file_name ="member_statics.pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
   $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      //generate the PDF from the given html
   $mpdf->WriteHTML($html);

      //download it for 'D'. 
   $mpdf->Output($file_name, "D"); 
}

public function doc_member_statics(){
 $result = $this->Reports_model->get_members_count_by_sc_section_id(1,'Male');
 $count_cub_scout_m = $result['count'];
 $result = $this->Reports_model->get_members_count_by_sc_section_id(2,'Male');
 $count_scout_m = $result['count'];
 $result = $this->Reports_model->get_members_count_by_sc_section_id(3,'Male');
 $count_rober_scout_m = $result['count'];

 $result = $this->Reports_model->get_members_count_by_sc_section_id(1,'Female');
 $count_cub_scout_f = $result['count'];
 $result = $this->Reports_model->get_members_count_by_sc_section_id(2,'Female');
 $count_scout_f = $result['count'];
 $result = $this->Reports_model->get_members_count_by_sc_section_id(3,'Female');
 $count_rober_scout_f = $result['count'];

 $result = $this->Reports_model->get_members_count_by_sc_section_id(1,'Others');
 $count_cub_scout_o = $result['count'];
 $result = $this->Reports_model->get_members_count_by_sc_section_id(2,'Others');
 $count_scout_o = $result['count'];
 $result = $this->Reports_model->get_members_count_by_sc_section_id(3,'Others');
 $count_rober_scout_o = $result['count'];

 $result = $this->Reports_model->get_members_count_by_sc_section_id_and_sc_role_id(1,'Male',6);
 $count_cub_scout_leader_m = $result['count'];
 $result = $this->Reports_model->get_members_count_by_sc_section_id_and_sc_role_id(2,'Male',13);
 $count_scout_leader_m = $result['count'];
 $result = $this->Reports_model->get_members_count_by_sc_section_id_and_sc_role_id(3,'Male',23);
 $count_rober_scout_leader_m = $result['count'];

 $result = $this->Reports_model->get_members_count_by_sc_section_id_and_sc_role_id(1,'Female',6);
 $count_cub_scout_leader_f = $result['count'];
 $result = $this->Reports_model->get_members_count_by_sc_section_id_and_sc_role_id(2,'Female',13);
 $count_scout_leader_f = $result['count'];
 $result = $this->Reports_model->get_members_count_by_sc_section_id_and_sc_role_id(3,'Female',23);
 $count_rober_leader_scout_f = $result['count'];


 $result = $this->Reports_model->get_members_count_by_sc_section_id_and_sc_role_id(1,'Others',6);
 $count_cub_scout_leader_o = $result['count'];
 $result = $this->Reports_model->get_members_count_by_sc_section_id_and_sc_role_id(2,'Others',13);
 $count_scout_leader_o = $result['count'];
 $result = $this->Reports_model->get_members_count_by_sc_section_id_and_sc_role_id(3,'Others',23);
 $count_rober_scout_leader_o = $result['count'];

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

 $table->addCell(10000, $styleCell)->addText('স্কাউট সদস্য পরিসংখ্যান' , $fontStyle,array('align' => 'center'));




 $phpWord->addTableStyle('myOwnTableTwoStyle', $styleTableTwo);

 $tableTwo = $section->addTable('myOwnTableTwoStyle');

 $tableTwo->addRow(10);

        // Add cells
 $tableTwo->addCell(900, $styleCellTwo)->addText("শাখা", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
 $tableTwo->addCell(3300, $styleCell)->addText("পুরুষ", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
 $tableTwo->addCell(1800, $styleCellTwo)->addText("মহিলা", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
 $tableTwo->addCell(2000, $styleCellTwo)->addText("অন্যান্য", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
 $tableTwo->addCell(2500, $styleCellTwo)->addText("মোট", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));



 $tableTwo->addRow(10);

 $tableTwo->addCell(2000, $styleCellTwo)->addText('কাব স্কাউট', $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));

 $tableTwo->addCell(1000, $styleCellTwo)->addText(BanglaConverter::en2bn($count_cub_scout_m), $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));

 $tableTwo->addCell(3300, $styleCellTwo)->addText(BanglaConverter::en2bn($count_cub_scout_f), $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));


 $tableTwo->addCell(2000, $styleCellTwo)->addText(BanglaConverter::en2bn($count_cub_scout_o), $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
 $tableTwo->addCell(2000, $styleCellTwo)->addText(BanglaConverter::en2bn($count_cub_scout_m+$count_cub_scout_f+$count_cub_scout_o), $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));

        //স্কাউট
 $tableTwo->addRow(10);
 $tableTwo->addCell(2000, $styleCellTwo)->addText('স্কাউট', $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));

 $tableTwo->addCell(1000, $styleCellTwo)->addText(BanglaConverter::en2bn($count_scout_m), $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));

 $tableTwo->addCell(1000, $styleCellTwo)->addText(BanglaConverter::en2bn($count_scout_f), $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));


 $tableTwo->addCell(1000, $styleCellTwo)->addText(BanglaConverter::en2bn($count_scout_o), $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
 $tableTwo->addCell(1000, $styleCellTwo)->addText(BanglaConverter::en2bn($count_scout_m+$count_scout_f+$count_scout_o), $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));

        //রোভার স্কাউট
 $tableTwo->addRow(10);
 $tableTwo->addCell(2000, $styleCellTwo)->addText('রোভার স্কাউট', $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));

 $tableTwo->addCell(1000, $styleCellTwo)->addText(BanglaConverter::en2bn($count_rober_scout_m), $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));

 $tableTwo->addCell(1000, $styleCellTwo)->addText(BanglaConverter::en2bn($count_rober_scout_f), $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));


 $tableTwo->addCell(1000, $styleCellTwo)->addText(BanglaConverter::en2bn($count_rober_scout_o), $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
 $tableTwo->addCell(1000, $styleCellTwo)->addText(BanglaConverter::en2bn($count_rober_scout_m+$count_rober_scout_f+$count_rober_scout_o), $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));


        //কাব স্কাউট লিডার সদস্য সংখ্যা
 $tableTwo->addRow(10);
 $tableTwo->addCell(2000, $styleCellTwo)->addText('কাব স্কাউট লিডার সদস্য সংখ্যা', $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));

 $tableTwo->addCell(1000, $styleCellTwo)->addText(BanglaConverter::en2bn($count_cub_scout_leader_m), $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));

 $tableTwo->addCell(1000, $styleCellTwo)->addText(BanglaConverter::en2bn($count_cub_scout_leader_f), $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));


 $tableTwo->addCell(1000, $styleCellTwo)->addText(BanglaConverter::en2bn($count_cub_scout_leader_o), $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
 $tableTwo->addCell(1000, $styleCellTwo)->addText(BanglaConverter::en2bn($count_cub_scout_leader_m+$count_cub_scout_leader_f+$count_cub_scout_leader_o), $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));


        //স্কাউট লিডার সদস্য সংখ্যা
 $tableTwo->addRow(10);
 $tableTwo->addCell(2000, $styleCellTwo)->addText('কাব স্কাউট লিডার সদস্য সংখ্যা', $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));

 $tableTwo->addCell(1000, $styleCellTwo)->addText(BanglaConverter::en2bn($count_scout_leader_m), $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));

 $tableTwo->addCell(1000, $styleCellTwo)->addText(BanglaConverter::en2bn($count_scout_leader_f), $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));


 $tableTwo->addCell(1000, $styleCellTwo)->addText(BanglaConverter::en2bn($count_scout_leader_o), $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
 $tableTwo->addCell(1000, $styleCellTwo)->addText(BanglaConverter::en2bn($count_scout_leader_m+$count_scout_leader_f+$count_scout_leader_o), $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));

        //রোভার স্কাউট লিডার সদস্য সংখ্যা
 $tableTwo->addRow(10);
 $tableTwo->addCell(2000, $styleCellTwo)->addText('রোভার স্কাউট লিডার সদস্য সংখ্যা', $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));

 $tableTwo->addCell(1000, $styleCellTwo)->addText(BanglaConverter::en2bn($count_scout_leader_m), $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));

 $tableTwo->addCell(1000, $styleCellTwo)->addText(BanglaConverter::en2bn($count_scout_leader_f), $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));


 $tableTwo->addCell(1000, $styleCellTwo)->addText(BanglaConverter::en2bn($count_rober_scout_leader_o), $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
 $tableTwo->addCell(1000, $styleCellTwo)->addText(BanglaConverter::en2bn($count_scout_leader_m+$count_scout_leader_f+$count_rober_scout_leader_o), $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));


 $section->addTextBreak(1);

 if($_SERVER['HTTP_HOST'] === 'localhost'){

  $file_name = './report_doc/doc_member_statics.docx';
  $phpWord->save($file_name, 'Word2007');
  header("Content-Disposition: attachment; filename='doc_member_statics.docx'");
  readfile($file_name);
  unlink($file_name);
} else {
   $file_name = './report_doc/doc_member_statics.docx';
   header("Content-Disposition: attachment; filename='doc_member_statics.docx'");
   readfile($file_name);
}

}


public function pdf_unit_report(){
   $result = $this->Reports_model->get_unit_count_groupby_unit_type();
   $this->data['count_unit_type_wise'] = $result;
   $result = $this->Common_model->set_scout_unit_type();
   $this->data['unit_type'] = $result;

   $result = $this->Reports_model->get_unit_count_year_wise_groupby_unit_type();
   $this->data['count_unit_year_wise_type_wise'] = $result;

   $html = $this->load->view('pdf_unit_report', $this->data, true);   
   $file_name ="unit_report.pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
   $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      //generate the PDF from the given html
   $mpdf->WriteHTML($html);

      //download it for 'D'. 
   $mpdf->Output($file_name, "D");
}

public function doc_scouts_regional(){
  $results = $this->data['results'] = $this->Reports_model->get_region();
      //$this->data['rows'] = $results['rows'];
      //$this->data['total_rows'] = $results['num_rows'];
      //$this->data['scout_group'] = $this->Common_model->set_scout_section(); 


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

  $table->addCell(10000, $styleCell)->addText('Region Offices' , $fontStyle,array('align' => 'center'));




  $phpWord->addTableStyle('myOwnTableTwoStyle', $styleTableTwo);

  $tableTwo = $section->addTable('myOwnTableTwoStyle');

  $tableTwo->addRow(10);

        // Add cells
  $tableTwo->addCell(900, $styleCellTwo)->addText("SL", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
  $tableTwo->addCell(3300, $styleCell)->addText("REGION LOGO", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
  $tableTwo->addCell(1800, $styleCellTwo)->addText("REGION NAME", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
  $tableTwo->addCell(2000, $styleCellTwo)->addText("DIVISION NAME", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
  $tableTwo->addCell(2500, $styleCellTwo)->addText("REGION TYPE", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
  $tableTwo->addCell(1500, $styleCellTwo)->addText("Status", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));

  $sln = 0;

  foreach ($results as $row)
  {
    $sln++;
    if($row->region_status == 1) {
      $status = 'Active';
   }else{
      $status = 'Inactive';
   }

   if($row->region_type == 'divisional') {
      $region = 'Divitional Region';
   }else{
      $region = 'Special Region';
   }

   if($row->region_logo != NULL){
      $image =  __DIR__ . '/../../../../offices_img/'.$row->region_logo;
   }

   $tableTwo->addRow(10);


   $tableTwo->addCell(1000, $styleCellTwo)->addText($sln, $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));

   if($row->region_logo != NULL){
      $tableTwo->addCell(3300, $styleCellTwo)->addImage($image, array('width' => 100,
       'height' => 50, 'marginTop' => -1, 'marginLeft' => -1, 'wrappingStyle' => 'behind' ));
   }else{
     $tableTwo->addCell(3300, $styleCellTwo)->addText(' ', $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
  }

  $tableTwo->addCell(2000, $styleCellTwo)->addText($row->region_name, $fontStyleFour, array('align' => 'left', 'space' => array('before' => 50, 'after' => 0)));
  $tableTwo->addCell(2000, $styleCellTwo)->addText($row->div_name, $fontStyleFour, array('align' => 'left', 'space' => array('before' => 50, 'after' => 0)));
  $tableTwo->addCell(2500, $styleCellTwo)->addText($region, $fontStyleFour, array('align' => 'left', 'space' => array('before' => 50, 'after' => 0), 'indentation' => array('right' => 100)));
  $tableTwo->addCell(1500, $styleCellTwo)->addText($status, $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0), 'indentation' => array('right' => 100)));
}

        //$tableTwo->addRow(10);



        /*$tableTwo->addRow(10);

        $tableTwo->addCell(4000, $cellColSpan)->addText(htmlspecialchars("Grand Total"), $fontStyleFour, array('align' => 'right', 'indentation' => array('right' => 100), 'space' => array('before' => 50, 'after' => 0)));
        $tableTwo->addCell(3000)->addText(number_format(($final_total), 2), $fontStyleFour, array('align' => 'right', 'indentation' => array('right' => 100), 'space' => array('before' => 50, 'after' => 0)));*/

        $section->addTextBreak(1);


        //$phpWord->save('./report_doc/doc_scouts_regional.docx', 'Word2007');
        if($_SERVER['HTTP_HOST'] === 'localhost'){

           $file_name = './report_doc/doc_scouts_regional.docx';
           $phpWord->save($file_name, 'Word2007');
           header("Content-Disposition: attachment; filename='doc_scouts_regional.docx'");
           readfile($file_name);
           unlink($file_name);
        } else {
         $file_name = './report_doc/doc_scouts_regional.docx';
         header("Content-Disposition: attachment; filename='doc_scouts_regional.docx'");
         readfile($file_name);
      }

   }

   public function pdf_scouts_regional($offset=0){

      $results = $this->data['results'] = $this->Reports_model->get_region();

      $html = $this->load->view('pdf_region', $this->data, true);   
      $file_name ="pdf_scouts_regional.pdf";
      
      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);
      
      //download it for 'D'. 
      $mpdf->Output($file_name, "D");
   }

   public function pdf_scouts_district_offices($offset=0){
    $this->data['results'] = $this->Reports_model->get_scout_district(); 
    $this->data['regions'] = $this->Common_model->get_regions();  

    $this->data['region_id'] = NULL;
    if($this->input->get('region') != NULL){
      $this->data['region_id'] = $this->input->get('region');
   }

      /*$results = $this->Reports_model->get_scout_member_pdf();
      $this->data['rows'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];
      $this->data['scout_group'] = $this->Common_model->set_scout_section(); */


      //...............................................................................
      $this->data['meta_title'] = 'District Scouts Office';
      $html = $this->load->view('pdf_scouts_district_offices', $this->data, true);   
      $file_name ="pdf_scouts_district_offices.pdf";
      /*echo "<pre>";
      print_r($this->data);
      die();*/
      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);
      
      //download it for 'D'. 
      $mpdf->Output($file_name, "D");

   }

   public function doc_scouts_district_offices($offset=0){
      $results = $this->data['results'] = $this->Reports_model->get_scout_district(); 
      $this->data['regions'] = $this->Common_model->get_regions();  

      $this->data['region_id'] = NULL;
      if($this->input->get('region') != NULL){
         $this->data['region_id'] = $this->input->get('region');
      }

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

      $table->addCell(10000, $styleCell)->addText('District Scouts Office' , $fontStyle,array('align' => 'center'));




      $phpWord->addTableStyle('myOwnTableTwoStyle', $styleTableTwo);

      $tableTwo = $section->addTable('myOwnTableTwoStyle');

      $tableTwo->addRow(10);

        // Add cells
      $tableTwo->addCell(900, $styleCellTwo)->addText("SL", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
      $tableTwo->addCell(3300, $styleCell)->addText("SCOUT DISTRICT NAME", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
      $tableTwo->addCell(1800, $styleCellTwo)->addText("SCOUT REGION", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
      $tableTwo->addCell(2000, $styleCellTwo)->addText("DIVISION", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
      $tableTwo->addCell(2500, $styleCellTwo)->addText("DISTRICT", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
      $tableTwo->addCell(1500, $styleCellTwo)->addText("DISTRICT TYPE", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));
      $tableTwo->addCell(1500, $styleCellTwo)->addText("  STATUS", $fontStyleThree, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));

      $sln=0;

      foreach ($results as $row){
         $sln++;

         if($row->dis_status == 1) {
            $status = 'Enable';
         }else{
            $status = 'Disable';
         }

         if($row->dis_type == '1') {
            $district = 'Administrative District';
         }else if($row->dis_type == '2') {
            $district = 'Metropolitan District';
         }else if($row->dis_type == '3') {
            $district = 'Rover District';
         }else if($row->dis_type == '4') {
            $district = 'Railway District';
         }else if($row->dis_type == '5') {
            $district = 'Sea District';
         }else if($row->dis_type == '6') {
            $district = 'Air District';
         }

         $tableTwo->addRow(10);


         $tableTwo->addCell(1000, $styleCellTwo)->addText($sln, $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0)));

         $tableTwo->addCell(3300, $styleCellTwo)->addText($row->dis_name, $fontStyleFour, array('align' => 'left', 'space' => array('before' => 50, 'after' => 0)));

          /*$tableTwo->addCell(3300, $styleCellTwo)->addImage(__DIR__ . '/../../../../', array('width'  => 50,
                                       'height' => 50,
                                       'align'  => 'right'));*/

                                       $tableTwo->addCell(2000, $styleCellTwo)->addText($row->region_name, $fontStyleFour, array('align' => 'left', 'space' => array('before' => 50, 'after' => 0)));
                                       $tableTwo->addCell(2000, $styleCellTwo)->addText($row->div_name, $fontStyleFour, array('align' => 'left', 'space' => array('before' => 50, 'after' => 0)));
                                       $tableTwo->addCell(2500, $styleCellTwo)->addText($row->district_name, $fontStyleFour, array('align' => 'left', 'space' => array('before' => 50, 'after' => 0), 'indentation' => array('right' => 100)));
                                       $tableTwo->addCell(1500, $styleCellTwo)->addText($district, $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0), 'indentation' => array('right' => 100)));
                                       $tableTwo->addCell(1500, $styleCellTwo)->addText($status, $fontStyleFour, array('align' => 'center', 'space' => array('before' => 50, 'after' => 0), 'indentation' => array('right' => 100)));
                                    }

        //$tableTwo->addRow(10);



        /*$tableTwo->addRow(10);

        $tableTwo->addCell(4000, $cellColSpan)->addText(htmlspecialchars("Grand Total"), $fontStyleFour, array('align' => 'right', 'indentation' => array('right' => 100), 'space' => array('before' => 50, 'after' => 0)));
        $tableTwo->addCell(3000)->addText(number_format(($final_total), 2), $fontStyleFour, array('align' => 'right', 'indentation' => array('right' => 100), 'space' => array('before' => 50, 'after' => 0)));*/

        $section->addTextBreak(1);


        //$phpWord->save('./report_doc/doc_scouts_regional.docx', 'Word2007');

        if($_SERVER['HTTP_HOST'] === 'localhost'){

           $file_name = './report_doc/scouts_district_offices.docx';
           $phpWord->save($file_name, 'Word2007');
           header("Content-Disposition: attachment; filename='scouts_district_offices.docx'");
           readfile($file_name);
           unlink($file_name);
        } else {
         $file_name = './report_doc/scouts_district_offices.docx';
         header("Content-Disposition: attachment; filename='scouts_district_offices.docx'");
         readfile($file_name);
      }


   }



}