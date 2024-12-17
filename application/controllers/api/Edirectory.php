<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';

class Edirectory extends REST_Controller {

   function __construct(){
      // Construct the parent class
      parent::__construct();
      $this->lang->load('auth');

      $this->load->model('Common_model');
      $this->load->model('Api_model');
   }

   public function offline_edirectory_get(){        
      // $name = $this->get('name');
      // $results = $this->Api_model->get_search_listing($name, $mobile, $email);
      $results_arr['sc_districts'] = $this->Api_model->get_sc_district();
      $results_arr['sc_upazilas'] = $this->Api_model->get_sc_upazila();
      $results_arr['designation_nhq'] = $this->Api_model->get_designation(1);
      $i=0;
      foreach ($results_arr['designation_nhq'] as $item) {
         $data_arr = count($this->Api_model->get_listing($item->id, 1)); //exit;
         $results_arr['designation_nhq'][$i]->count = $data_arr;
         $i++;
      }

      $results_arr['designation_region'] = $this->Api_model->get_designation(2);      
      $results_arr['designation_district'] = $this->Api_model->get_designation(3);
      $results_arr['designation_upazila'] = $this->Api_model->get_designation(4);
      $results_arr['listing_contacts'] = $this->Api_model->get_listing();
      $results_arr['tc_list'] = $this->Api_model->get_training_center();
      $results_arr['tc_listing'] = $this->Api_model->get_listing('', 6, '', '', '', '', '');

      if($results_arr){
         $this->response(array('status'=> 'success', 'result'  => $results_arr), REST_Controller::HTTP_OK); 
      }else{
         $this->response(array('status' => 'false', 'result' => 'No data found'), REST_Controller::HTTP_OK);
      }
   }

   public function search_listing_get(){        
      $name = $this->get('name');
      $mobile = $this->get('mobile');
      $email = $this->get('email');
      $group = $this->get('group');
      $upazila = $this->get('upazila');
      $district = $this->get('district');
      $region = $this->get('region');


      $results = $this->Api_model->get_search_listing($name, $mobile, $email, $group, $upazila, $district, $region);
      // $results_arr[] = $results;

      if($results){
         $this->response(array('status'=> 'success', 'result'  => $results), REST_Controller::HTTP_OK); 
      }else{
         $this->response(array('status' => 'false', 'result' => 'No data found'), REST_Controller::HTTP_OK);
      }
   }

   public function contact_details_get($id){        
      $results = $this->Api_model->get_contact_details($id);

      // print_r($results); exit;
      // $results_arr[] = $results;

      if($results){
         if($results->office_level == 1){
            $results->working_area = 'National Headquarter';
         }elseif($results->office_level == 2){
            $results->working_area = $results->region_name_en;
         }elseif($results->office_level == 3){
            $results->working_area = $results->dis_name_en;
         }elseif($results->office_level == 4){
            $results->working_area = $results->upa_name_en;
         }elseif($results->office_level == 5){
            $results->working_area = $results->grp_name;
         }elseif($results->office_level == 6){
            $results->working_area = $results->tc_designation_name.', '.$results->tc_name;
         }

         $this->response(array('status'=> 'success', 'result'  => $results), REST_Controller::HTTP_OK); 
      }else{
         $this->response(array('status' => 'false', 'result' => 'No data found'), REST_Controller::HTTP_OK);
      }
   }

   public function listing_scout_group_get(){        
      $office_level = 5;
      $designation = $this->get('desigID');
      $region = $this->get('regionID');
      $district = $this->get('districtID');
      $sGroup = $this->get('sgroupID');

      $results = $this->Api_model->get_listing($designation, $office_level, $region, $district, '', $sGroup);
      // $results_arr[] = $results;

      if($results){
         $this->response(array('status'=> 'success', 'result'  => $results), REST_Controller::HTTP_OK); 
      }else{
         $this->response(array('status' => 'false', 'result' => 'No data found'), REST_Controller::HTTP_OK);
      }
   }

   public function listing_upazila_get(){        
      $office_level = 4;
      $designation = $this->get('desigID');
      $region = $this->get('regionID');
      $district = $this->get('districtID');
      $upazila = $this->get('upazilaID');

      $results = $this->Api_model->get_listing($designation, $office_level, $region, $district, $upazila);
      // $results_arr[] = $results;

      if($results){
         $this->response(array('status'=> 'success', 'result'  => $results), REST_Controller::HTTP_OK); 
      }else{
         $this->response(array('status' => 'false', 'result' => 'No data found'), REST_Controller::HTTP_OK);
      }
   }

   public function listing_district_get(){        
      $office_level = 3;
      $designation = $this->get('desigID');
      $region = $this->get('regionID');
      $district = $this->get('districtID');

      $results = $this->Api_model->get_listing($designation, $office_level, $region, $district);
      // $results_arr[] = $results;

      if($results){
         $this->response(array('status'=> 'success', 'result'  => $results), REST_Controller::HTTP_OK); 
      }else{
         $this->response(array('status' => 'false', 'result' => 'No data found'), REST_Controller::HTTP_OK);
      }
   }

   public function listing_region_get(){     
      $office_level = 2;
      $designation = $this->get('desigID');
      $region = $this->get('regionID');

      $results = $this->Api_model->get_listing($designation, $office_level, $region);
      // $results_arr[] = $results;

      if($results){
         $this->response(array('status'=> 'success', 'result'  => $results), REST_Controller::HTTP_OK); 
      }else{
         $this->response(array('status' => 'false', 'result' => 'No data found'), REST_Controller::HTTP_OK);
      }
   }

   public function listing_nhq_get($designation){        
      $results = $this->Api_model->get_listing($designation, 1);
      // $results_arr[] = $results;

      if($results){
         $this->response(array('status'=> 'success', 'result'  => $results), REST_Controller::HTTP_OK); 
      }else{
         $this->response(array('status' => 'false', 'result' => 'No data found'), REST_Controller::HTTP_OK);
      }
   }

   public function listing_training_center_get(){    
      $tc_id = $this->get('traningCenterID');    
      $results = $this->Api_model->get_listing('', 6, '', '', '', '', $tc_id);
      // $results_arr[] = $results;
      // echo $this->db->last_query(); exit;

      if($results){
         $this->response(array('status'=> 'success', 'result'  => $results), REST_Controller::HTTP_OK); 
      }else{
         $this->response(array('status' => 'false', 'result' => 'No data found'), REST_Controller::HTTP_OK);
      }
   }

   public function training_center_get(){ 
      $results = $this->Api_model->get_training_center();
      // $results_arr[] = $results;

      if($results){         
         $this->response(array('status'=> 'success', 'result'  => $results), REST_Controller::HTTP_OK); 
      }else{
         $this->response(array('status' => 'false', 'result' => 'No data found'), REST_Controller::HTTP_OK);
      }
   }

   public function designation_nhq_get(){
      $data_arr = [];  
      $results = $this->Api_model->get_designation(1);
      // $results_arr[] = $results;

      $i=0;
      foreach ($results as $item) {
         $data_arr = count($this->Api_model->get_listing($item->id, 1)); //exit;
         $results[$i]->count = $data_arr;
         $i++;
      }

      if($results){
         $this->response(array('status'=> 'success', 'result'  => $results), REST_Controller::HTTP_OK); 
      }else{
         $this->response(array('status' => 'false', 'result' => 'No data found'), REST_Controller::HTTP_OK);
      }
   }

   public function designation_region_get(){   
      $office_level=2; 
      $region = $this->get('region');
      $data_arr = [];  

      $results = $this->Api_model->get_designation(2);
      // $results_arr[] = $results;

      $i=0;
      foreach ($results as $item) {
         $data_arr = count($this->Api_model->get_listing($item->id, $office_level, $region)); //exit;
         $results[$i]->count = $data_arr;
         $i++;
      }

      if($results){
         $this->response(array('status'=> 'success', 'result'  => $results), REST_Controller::HTTP_OK); 
      }else{
         $this->response(array('status' => 'false', 'result' => 'No data found'), REST_Controller::HTTP_OK);
      }
   }

   public function designation_district_get(){   

      $office_level=3; 
      $region = $this->get('region');
      $district = $this->get('district');
      $data_arr = [];

      $results = $this->Api_model->get_designation(3);
      // $results_arr[] = $results;

      $i=0;
      foreach ($results as $item) {
         $data_arr = count($this->Api_model->get_listing($item->id, $office_level, $region, $district)); //exit;
         $results[$i]->count = $data_arr;
         $i++;
      }

      if($results){
         $this->response(array('status'=> 'success', 'result'  => $results), REST_Controller::HTTP_OK); 
      }else{
         $this->response(array('status' => 'false', 'result' => 'No data found'), REST_Controller::HTTP_OK);
      }
   }

   public function designation_upazila_get(){  
      $office_level=4; 
      $region = $this->get('region');
      $district = $this->get('district');
      $upazila = $this->get('upazila');
      $data_arr = [];

      $results = $this->Api_model->get_designation(4);
      // $results_arr[] = $results;

      $i=0;
      foreach ($results as $item) {
         $data_arr = count($this->Api_model->get_listing($item->id, $office_level, $region, $district, $upazila)); //exit;
         $results[$i]->count = $data_arr;
         $i++;
      }

      if($results){
         $this->response(array('status'=> 'success', 'result'  => $results), REST_Controller::HTTP_OK); 
      }else{
         $this->response(array('status' => 'false', 'result' => 'No data found'), REST_Controller::HTTP_OK);
      }
   }

   public function designation_group_get(){ 
      $office_level=5; 
      $region = $this->get('region');
      $district = $this->get('district');
      $upazila = $this->get('upazila');
      $group = $this->get('group');
      $data_arr = [];

      $results = $this->Api_model->get_designation(5);
      // $results_arr[] = $results;

      $i=0;
      foreach ($results as $item) {
         $data_arr = count($this->Api_model->get_listing($item->id, $office_level, $region, $district, $upazila, $group)); //exit;
         $results[$i]->count = $data_arr;
         $i++;
      }

      if($results){
         $this->response(array('status'=> 'success', 'result'  => $results), REST_Controller::HTTP_OK); 
      }else{
         $this->response(array('status' => 'false', 'result' => 'No data found'), REST_Controller::HTTP_OK);
      }
   }

   public function region_info_get(){        
      $id = $this->get('id');
      // $region = $this->get('regionID');
      // $district = $this->get('districtID');

      $results = $this->Api_model->get_region_info($id);
      // $results_arr[] = $results;

      if($results){
         $this->response(array('status'=> 'success', 'result'  => $results), REST_Controller::HTTP_OK); 
      }else{
         $this->response(array('status' => 'false', 'result' => 'No data found'), REST_Controller::HTTP_OK);
      }
   }

   public function district_info_get(){        
      $id = $this->get('id');
      // $region = $this->get('regionID');
      // $district = $this->get('districtID');

      $results = $this->Api_model->get_district_info($id);
      // $results_arr[] = $results;

      if($results){
         $this->response(array('status'=> 'success', 'result'  => $results), REST_Controller::HTTP_OK); 
      }else{
         $this->response(array('status' => 'false', 'result' => 'No data found'), REST_Controller::HTTP_OK);
      }
   }

   public function upazila_info_get(){        
      $id = $this->get('id');
      // $region = $this->get('regionID');
      // $district = $this->get('districtID');

      $results = $this->Api_model->get_upazila_info($id);
      // $results_arr[] = $results;

      if($results){
         $this->response(array('status'=> 'success', 'result'  => $results), REST_Controller::HTTP_OK); 
      }else{
         $this->response(array('status' => 'false', 'result' => 'No data found'), REST_Controller::HTTP_OK);
      }
   }

   public function sgroup_info_get(){        
      $id = $this->get('id');
      // $region = $this->get('regionID');
      // $district = $this->get('districtID');

      $results = $this->Api_model->get_sgroup_info($id);
      // $results_arr[] = $results;

      if($results){
         $this->response(array('status'=> 'success', 'result'  => $results), REST_Controller::HTTP_OK); 
      }else{
         $this->response(array('status' => 'false', 'result' => 'No data found'), REST_Controller::HTTP_OK);
      }
   }

   

}
