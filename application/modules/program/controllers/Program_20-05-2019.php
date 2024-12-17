<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Program extends Backend_Controller {

   var $userID;
   var $img_path;
   var $status;

   public function __construct(){
      parent::__construct();
      if (!$this->ion_auth->logged_in()):
         redirect('login');
      endif;

      // redirect('dashboard'); 

      $this->data['module_title'] = 'Program';
      $this->userID = $this->session->userdata('user_id');

      $this->load->model('Common_model');
      $this->load->model('Program_model');
      $this->load->model('committee/Committee_model');

      if($this->ion_auth->is_admin()){
         $this->status =1;
      }elseif($this->ion_auth->is_region_admin()){  
         $this->status =1;
      }elseif($this->ion_auth->is_district_admin()){
         $this->status =1;
      }elseif($this->ion_auth->is_upazila_admin()){
         $this->status =1;
      }elseif($this->ion_auth->is_group_admin()){
         $this->status =1;
      }else{
         $this->status =0;
      }
   }

   public function index(){
      redirect('dashboard');
   }  

   public function leader_progress($id=NULL){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin() || $this->ion_auth->is_scout_member())){
         redirect('dashboard');
      }
      // echo $scoutID
      $scoutID = $id != NULL ? (int) decrypt_url($id) : $this->userID; //exit;
      
      $this->data['info'] = $this->Program_model->get_info($scoutID);

      $memberType = $this->data['info']->member_id;
      $sectionType = $this->data['info']->sc_section_id;
      //print_r($this->data['info']);  exit;

      $this->data['badges'] = $this->Program_model->get_scout_badge_by_member_section_type($memberType, $sectionType);
      $this->data['roles'] = $this->Program_model->get_scout_role_by_member_section_type($memberType, $sectionType);
      $this->data['years'] = array(''=>'-- বর্ষ --', '১ম বর্ষ'=>'১ম বর্ষ', '২য় বর্ষ'=>'২য় বর্ষ', '৩য় বর্ষ'=>'৩য় বর্ষ', '৪র্থ বর্ষ'=>'৪র্থ বর্ষ');

      // Load page
      $this->data['meta_title'] = 'Leader Progress';
      $this->data['subview'] = 'leader_progress';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function cub_program($id=NULL){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin() || $this->ion_auth->is_scout_member())){
         redirect('dashboard');
      }
      // echo $scoutID
      $scoutID = $id != NULL ? (int) decrypt_url($id) : $this->userID; //exit;
      
      $this->data['info'] = $this->Program_model->get_info($scoutID);

      $memberType = $this->data['info']->member_id;
      $sectionType = $this->data['info']->sc_section_id;
      //print_r($this->data['info']);  exit;

      // $this->data['scout_members'] = $this->Common_model->get_scout_id_with_designation();
      // $this->data['badges'] = $this->Common_model->get_badge_type();
      $this->data['badges'] = $this->Program_model->get_scout_badge_by_member_section_type($memberType, $sectionType);
      // $this->data['roles'] = $this->Common_model->get_role_type();
      $this->data['roles'] = $this->Program_model->get_scout_role_by_member_section_type($memberType, $sectionType);
      
      $this->data['years'] = array(''=>'-- বর্ষ --', '১ম বর্ষ'=>'১ম বর্ষ', '২য় বর্ষ'=>'২য় বর্ষ', '৩য় বর্ষ'=>'৩য় বর্ষ', '৪র্থ বর্ষ'=>'৪র্থ বর্ষ');

        // Load page
      $this->data['meta_title'] = 'Cub Scout Program';
      $this->data['subview'] = 'cub_program';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function scout_program($id=NULL){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin() || $this->ion_auth->is_scout_member())){
         redirect('dashboard');
      }

      $scoutID = $id != NULL ? (int) decrypt_url($id) : $this->userID; //exit;
      
      $this->data['info'] = $this->Program_model->get_info($scoutID);

      $memberType = $this->data['info']->member_id;
      $sectionType = $this->data['info']->sc_section_id;

      $this->data['badges'] = $this->Program_model->get_scout_badge_by_member_section_type($memberType, $sectionType);
      $this->data['roles'] = $this->Program_model->get_scout_role_by_member_section_type($memberType, $sectionType);
      $this->data['years'] = array(''=>'-- বর্ষ --', '১ম বর্ষ'=>'১ম বর্ষ', '২য় বর্ষ'=>'২য় বর্ষ', '৩য় বর্ষ'=>'৩য় বর্ষ', '৪র্থ বর্ষ'=>'৪র্থ বর্ষ');

        // Load page
      $this->data['meta_title'] = 'Scout Program';
      $this->data['subview'] = 'scout_program';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function rover_program($id=NULL){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin() || $this->ion_auth->is_scout_member())){
         redirect('dashboard');
      }
      
      $scoutID = $id != NULL ? (int) decrypt_url($id) : $this->userID; //exit;
      
      $this->data['info'] = $this->Program_model->get_info($scoutID);

      $memberType = $this->data['info']->member_id;
      $sectionType = $this->data['info']->sc_section_id; //exit;

      $this->data['badges'] = $this->Program_model->get_scout_badge_by_member_section_type($memberType, $sectionType);
      $this->data['roles'] = $this->Program_model->get_scout_role_by_member_section_type($memberType, $sectionType);
      $this->data['years'] = array(''=>'-- বর্ষ --', '১ম বর্ষ'=>'১ম বর্ষ', '২য় বর্ষ'=>'২য় বর্ষ', '৩য় বর্ষ'=>'৩য় বর্ষ', '৪র্থ বর্ষ'=>'৪র্থ বর্ষ');

        // Load page
      $this->data['meta_title'] = 'Rover Scout Program';
      $this->data['subview'] = 'rover_program';
      $this->load->view('backend/_layout_main', $this->data);
   }

   

   public function program_badge($scout_id){

        /*$this->form_validation->set_rules('scout_badge', 'badge', 'trim|required');        
        $this->form_validation->set_rules('question_id', 'biboron', 'trim|required');        
        $this->form_validation->set_rules('achive_date', 'achive date', 'trim|required');  */      

        $updateid=$this->input->get('hide_id');
        $form_data = array(
         'scout_id'      => $scout_id,
         'section_id'    => $this->input->get('section_id'),
         'badge_id'      => $this->input->get('scout_badge'),
         'question_id'   => $this->input->get('question_id'),
         'achive_date'   => date_db_format($this->input->get('achive_date')),
         'user_id'       => $this->input->get('hide_user_id'),
         'examiner_id'   => $this->input->get('examiner_id'),
         'status'        => $this->status
         );
        $delete_id = $this->input->get('delete_id');

        if($delete_id > 0 ) 
        {
           if($this->Program_model->delete_prgram('prog_badge_question_value',$delete_id))
            echo 'Delete Success';
         else
            echo 'Delete Failed';
      }
      else if ($updateid=='' and $this->input->get('scout_badge') >0){

       $validate_insert=$this->Program_model->checkduplicate($form_data);
       if(empty($validate_insert))
       {
        if($this->Common_model->save('prog_badge_question_value', $form_data)){
         echo 'inserted';
      }else {
         echo 'insert fail';
      }
   }
   else
    echo 'duplicate';

}
else if($updateid>0 and $this->input->get('scout_badge') >0){
 if($this->Common_model->edit('prog_badge_question_value', $updateid, 'id', $form_data)) {
  echo 'updated';
}else {
  echo 'update fail';
}
}

$alldt=$this->Program_model->get_badge_details($form_data);
echo '23432sdfg324';
echo '<table class="tg">
<tr>
  <th class="tg-71hr">ক্রম</th>
  <th class="tg-71hr">ব্যাজ</th>
  <th class="tg-71hr">বিবরণ</th>
  <th class="tg-71hr">অর্জনের তারিখ</th>
  <th class="tg-71hr">মূল্যায়নকারী</th>
  <th class="tg-71hr">যাচাইকারী</th>
  <th class="tg-71hr" width="120">পদক্ষেপ</th>
</tr>';
for($i=0;$i<sizeof($alldt);$i++)
{
   echo '
   <tr>
    <td class="tg-031e">'.($i+1).'</td>
    <td class="tg-031e">'.$alldt[$i]->badge_type_name_bn.'</td>
    <td class="tg-031e">'.$alldt[$i]->questions.'</td>
    <td class="tg-031e">'.date_bangla_format($alldt[$i]->achive_date).'</td>
    <td class="tg-031e">'.$alldt[$i]->examiner_id.'</td>
    <td class="tg-031e">'.$alldt[$i]->scout_id.'</td>
    <td class="tg-031e">
     <button type="button" class="btn btn-danger btn-mini" onclick="return delete_scoutprogram('.$alldt[$i]->id.');">Delete</button>
     <button type="button" class="btn btn-success btn-mini" onclick="return edit_scoutprogram('.$alldt[$i]->id.',\''.$alldt[$i]->achive_date.'\','.$alldt[$i]->badge_id.','.$alldt[$i]->question_id.',\''.$alldt[$i]->ex_id.'\');">Edit</button>
     '; 
     if($this->ion_auth->is_admin() OR $this->ion_auth->is_region_admin() OR $this->ion_auth->is_district_admin() OR $this->ion_auth->is_upazila_admin() OR $this->ion_auth->is_group_admin()){
      $table='prog_badge_question_value';
      if($alldt[$i]->status==0){
       echo '<button type="button" class="btn btn-info btn-mini" onclick="return verify_scoutprogram('.$alldt[$i]->id.',\''.$table.'\',1);">Verify</button>';
    }
 }
 echo' 
</td>
</tr>
';
}
echo '</table>';
exit;
}

public function program_badge_expertness($scout_id){

        /*$this->form_validation->set_rules('scout_badge', 'badge', 'trim|required');        
        $this->form_validation->set_rules('question_id', 'biboron', 'trim|required');        
        $this->form_validation->set_rules('achive_date', 'achive date', 'trim|required');  */      
        
        $updateid=$this->input->get('hide_id');
        $form_data = array(
         'scout_id'        => $scout_id,
         'section_id'      => $this->input->get('section_id'),
         'badge_id'        => $this->input->get('scout_badge'),
         'expert_group_id' => $this->input->get('expert_group_id'),
         'extra_badge'     => $this->input->get('extra_badge'),
         'achive_date'     => date_db_format($this->input->get('achive_date')),
         'user_id'         => $this->input->get('hide_user_id'),
         'examiner_id'     => $this->input->get('examiner_id'),
         'status'          => $this->status
         );
        $delete_id = $this->input->get('delete_id');
        
        if($delete_id > 0 ) 
        {
         if($this->Program_model->delete_prgram('prog_badge_expertness',$delete_id))
          echo 'Delete Success';
       else
          echo 'Delete Failed';
    }
    else if ($updateid=='' and $this->input->get('scout_badge') >0){

      $validate_insert=$this->Program_model->expertness_checkduplicate($form_data);
      if(empty($validate_insert))
      {
       if($this->Common_model->save('prog_badge_expertness', $form_data)){
        echo 'inserted';
     }else {
        echo 'insert fail';
     }
  }
  else
    echo 'duplicate';

}
else if($updateid>0 and $this->input->get('scout_badge') >0){



   if($this->Common_model->edit('prog_badge_expertness', $updateid, 'id', $form_data)) {
    echo 'updated';
 }else {
    echo 'update fail';
 }
}

$alldt=$this->Program_model->get_badge_details_expertness($form_data);
echo '23432sdfg324';
echo '<table class="tg">
<tr>
 <th class="tg-71hr">ক্রম</th>
 <th class="tg-71hr">ব্যাজ</th>
 <th class="tg-71hr">গ্রউপ</th>
 <th class="tg-71hr">অর্জনের তারিখ</th>
 <th class="tg-71hr">অতিরিক্ত ব্যাজ </th>
 <th class="tg-71hr">মূল্যায়নকারী</th>
 <th class="tg-71hr">যাচাইকারী</th>
 <th class="tg-71hr" width="120">পদক্ষেপ</th>
</tr>';
for($i=0;$i<sizeof($alldt);$i++)
{
  echo '
  <tr>
   <td class="tg-031e">'.($i+1).'</td>
   <td class="tg-031e">'.$alldt[$i]->badge_type_name_bn.'</td>
   <td class="tg-031e">'.$alldt[$i]->expert_group_name.'</td>
   <td class="tg-031e">'.date_bangla_format($alldt[$i]->achive_date).'</td>
   <td class="tg-031e">'.$alldt[$i]->extra_badge.'</td>
   <td class="tg-031e">'.$alldt[$i]->examiner_id.'</td>
   <td class="tg-031e">'.$alldt[$i]->scout_id.'</td>
   <td class="tg-031e">
      <button type="button" class="btn btn-danger btn-mini" onclick="return delete_scoutprogram_expertness('.$alldt[$i]->id.');">Delete</button>
      <button type="button" class="btn btn-success btn-mini" onclick="return edit_scoutprogram__expertness('.$alldt[$i]->id.',\''.$alldt[$i]->achive_date.'\','.$alldt[$i]->badge_id.','.$alldt[$i]->expert_group_id.',\''.$alldt[$i]->extra_badge.'\',\''.$alldt[$i]->ex_id.'\');">Edit</button>
      '; 
      if($this->ion_auth->is_admin() OR $this->ion_auth->is_region_admin() OR $this->ion_auth->is_district_admin() OR $this->ion_auth->is_upazila_admin() OR $this->ion_auth->is_group_admin()){
         $table='prog_badge_expertness';
         if($alldt[$i]->status==0){
          echo '<button type="button" class="btn btn-info btn-mini" onclick="return verify_scoutprogram('.$alldt[$i]->id.',\''.$table.'\',2);">Verify</button>';
       }
    }
    echo' 
 </td>
</tr>
';
}
echo '</table>';
exit;
}

public function program_badge_achievemen($scout_id){


 $updateid=$this->input->get('hide_id');
 $form_data = array(
  'scout_id'        => $scout_id,
  'section_id'      => $this->input->get('section_id'),
  'badge_id'        => $this->input->get('scout_badge'),
  'achive_date'     => date_db_format($this->input->get('achive_date')),
  'user_id'         => $this->input->get('hide_user_id'),
  'examiner_id'     => $this->input->get('examiner_id'),
  'status'          => $this->status
  );
 $delete_id = $this->input->get('delete_id');

 if($delete_id > 0 ) 
 {
  if($this->Program_model->delete_prgram('prog_badge_achievement',$delete_id))
   echo 'Delete Success';
else
   echo 'Delete Failed';
}
else if ($updateid=='' and $this->input->get('scout_badge') >0){

  $validate_insert=$this->Program_model->achievement_checkduplicate($form_data);
  if(empty($validate_insert))
  {
   if($this->Common_model->save('prog_badge_achievement', $form_data)){
    echo 'inserted';
 }else {
    echo 'insert fail';
 }
}
else
   echo 'duplicate';

}
else if($updateid>0 and $this->input->get('scout_badge') >0){



  if($this->Common_model->edit('prog_badge_achievement', $updateid, 'id', $form_data)) {
   echo 'updated';
}else {
   echo 'update fail';
}
}

$alldt=$this->Program_model->get_badge_details_achievement($form_data);
echo '23432sdfg324';
echo '<table class="tg">
<tr>
   <th class="tg-71hr">ক্রম</th>
   <th class="tg-71hr">ব্যাজ</th>
   <th class="tg-71hr">গ্রহণের তারিখ</th>
   <th class="tg-71hr">মূল্যায়নকারী</th>
   <th class="tg-71hr">যাচাইকারী</th>
   <th class="tg-71hr" width="120">পদক্ষেপ</th>
</tr>';
for($i=0;$i<sizeof($alldt);$i++)
{
 echo '
 <tr>
  <td class="tg-031e">'.($i+1).'</td>
  <td class="tg-031e">'.$alldt[$i]->badge_type_name_bn.'</td>
  <td class="tg-031e">'.date_bangla_format($alldt[$i]->achive_date).'</td>
  <td class="tg-031e">'.$alldt[$i]->examiner_id.'</td>
  <td class="tg-031e">'.$alldt[$i]->scout_id.'</td>
  <td class="tg-031e">
     <button type="button" class="btn btn-danger btn-mini" onclick="return delete_scoutprogram_achievemen('.$alldt[$i]->id.');">Delete</button>
     <button type="button" class="btn btn-success btn-mini" onclick="return edit_scoutprogram_achievemen('.$alldt[$i]->id.',\''.$alldt[$i]->achive_date.'\','.$alldt[$i]->badge_id.',\''.$alldt[$i]->ex_id.'\');">Edit</button>
     '; 
     if($this->ion_auth->is_admin() OR $this->ion_auth->is_region_admin() OR $this->ion_auth->is_district_admin() OR $this->ion_auth->is_upazila_admin() OR $this->ion_auth->is_group_admin()){
        $table='prog_badge_achievement';
        if($alldt[$i]->status==0){
         echo '<button type="button" class="btn btn-info btn-mini" onclick="return verify_scoutprogram('.$alldt[$i]->id.',\''.$table.'\',3);">Verify</button>';
      }
   }
   echo' 
</td>
</tr>
';
}
echo '</table>';
exit;
}

public function program_badge_camping($scout_id){


 $updateid=$this->input->get('hide_id');
 $form_data = array(
  'scout_id'        => $scout_id,
  'section_id'      => $this->input->get('section_id'),
  'area'            => $this->input->get('area'),
  'camp_name'       => $this->input->get('camp_name'),
  'certificate_no'  => $this->input->get('camp_certificate_no'),
  'camp_date'       => date_db_format($this->input->get('achive_date')),
  'user_id'         => $this->input->get('hide_user_id'),
  'examiner_id'     => $this->input->get('examiner_id'),
  'status'          => $this->status
  );
 $delete_id = $this->input->get('delete_id');

 if($delete_id > 0 ) 
 {
  if($this->Program_model->delete_prgram('prog_camping',$delete_id))
   echo 'Delete Success';
else
   echo 'Delete Failed';
}
else if ($updateid=='' and !empty($this->input->get('area'))){

  $validate_insert=$this->Program_model->camping_checkduplicate($form_data);
  if(empty($validate_insert))
  {
   if($this->Common_model->save('prog_camping', $form_data)){
    echo 'inserted';
 }else {
    echo 'insert fail';
 }
}
else
   echo 'duplicate';

}
else if($updateid>0 and !empty($this->input->get('area'))){



  if($this->Common_model->edit('prog_camping', $updateid, 'id', $form_data)) {
   echo 'updated';
}else {
   echo 'update fail';
}
}

$alldt=$this->Program_model->get_badge_details_camping($form_data);
echo '23432sdfg324';
echo '<table class="tg">
<tr>
   <th class="tg-71hr">ক্রম</th>
   <th class="tg-71hr">ক্যাম্পের নাম</th>
   <th class="tg-71hr">স্থান</th>
   <th class="tg-71hr">সনদ নং</th>
   <th class="tg-71hr">ক্যাম্প তারিখ</th>
   <th class="tg-71hr">মূল্যায়নকারী</th>
   <th class="tg-71hr">যাচাইকারী</th>
   <th class="tg-71hr" width="120">পদক্ষেপ</th>
</tr>';
for($i=0;$i<sizeof($alldt);$i++)
{
 echo '
 <tr>
  <td class="tg-031e">'.($i+1).'</td>
  <td class="tg-031e">'.$alldt[$i]->camp_name.'</td>
  <td class="tg-031e">'.$alldt[$i]->area.'</td>
  <td class="tg-031e">'.$alldt[$i]->certificate_no.'</td>
  <td class="tg-031e">'.date_bangla_format($alldt[$i]->camp_date).'</td>
  <td class="tg-031e">'.$alldt[$i]->examiner_id.'</td>
  <td class="tg-031e">'.$alldt[$i]->scout_id.'</td>
  <td class="tg-031e">
     <button type="button" class="btn btn-danger btn-mini" onclick="return delete_scoutprogram_camping('.$alldt[$i]->id.');">Delete</button>
     <button type="button" class="btn btn-success btn-mini" onclick="return edit_scoutprogram_camping('.$alldt[$i]->id.',\''.$alldt[$i]->camp_date.'\',\''.$alldt[$i]->area.'\',\''.$alldt[$i]->camp_name.'\',\''.$alldt[$i]->certificate_no.'\',\''.$alldt[$i]->ex_id.'\');">Edit</button>
     '; 
     if($this->ion_auth->is_admin() OR $this->ion_auth->is_region_admin() OR $this->ion_auth->is_district_admin() OR $this->ion_auth->is_upazila_admin() OR $this->ion_auth->is_group_admin()){
        $table='prog_camping';
        if($alldt[$i]->status==0){
         echo '<button type="button" class="btn btn-info btn-mini" onclick="return verify_scoutprogram('.$alldt[$i]->id.',\''.$table.'\',4);">Verify</button>';
      }
   }
   echo' 
</td>
</tr>
';
}
echo '</table>';
exit;
}

public function program_badge_training($scout_id){


 $updateid=$this->input->get('hide_id');
 $form_data = array(
  'scout_id'        => $scout_id,
  'section_id'      => $this->input->get('section_id'),
  'badge_id'        => $this->input->get('scout_badge'),
  'training_name'   => $this->input->get('train_name'),
  'certificate_no'  => $this->input->get('train_certificate_no'),
  'training_date'   => date_db_format($this->input->get('achive_date')),
  'user_id'         => $this->input->get('hide_user_id'),
  'examiner_id'     => $this->input->get('examiner_id'),
  'status'          => $this->status
  );
 $delete_id = $this->input->get('delete_id');

 if($delete_id > 0 ) 
 {
  if($this->Program_model->delete_prgram('prog_training',$delete_id))
   echo 'Delete Success';
else
   echo 'Delete Failed';
}
else if ($updateid=='' and $this->input->get('scout_badge') >0){

  $validate_insert=$this->Program_model->training_checkduplicate($form_data);
  if(empty($validate_insert))
  {
   if($this->Common_model->save('prog_training', $form_data)){
    echo 'inserted';
 }else {
    echo 'insert fail';
 }
}
else
   echo 'duplicate';

}
else if($updateid>0 and $this->input->get('scout_badge') >0){



  if($this->Common_model->edit('prog_training', $updateid, 'id', $form_data)) {
   echo 'updated';
}else {
   echo 'update fail';
}
}

$alldt=$this->Program_model->get_badge_details_training($form_data);
echo '23432sdfg324';
echo '<table class="tg">
<tr>
   <th class="tg-71hr">ক্রম</th>
   <th class="tg-71hr">ব্যাজ</th>
   <th class="tg-71hr">প্রশিক্ষণের নাম</th>
   <th class="tg-71hr">সনদ নং</th>
   <th class="tg-71hr">প্রশিক্ষণের তারিখ</th>
   <th class="tg-71hr">মূল্যায়নকারী</th>
   <th class="tg-71hr">যাচাইকারী</th>
   <th class="tg-71hr" width="120">পদক্ষেপ</th>
</tr>';
for($i=0;$i<sizeof($alldt);$i++)
{
 echo '
 <tr>
  <td class="tg-031e">'.($i+1).'</td>
  <td class="tg-031e">'.$alldt[$i]->badge_type_name_bn.'</td>
  <td class="tg-031e">'.$alldt[$i]->training_name.'</td>
  <td class="tg-031e">'.$alldt[$i]->certificate_no.'</td>
  <td class="tg-031e">'.date_bangla_format($alldt[$i]->training_date).'</td>
  <td class="tg-031e">'.$alldt[$i]->examiner_id.'</td>
  <td class="tg-031e">'.$alldt[$i]->scout_id.'</td>
  <td class="tg-031e">
     <button type="button" class="btn btn-danger btn-mini" onclick="return delete_scoutprogram_training('.$alldt[$i]->id.');">Delete</button>
     <button type="button" class="btn btn-success btn-mini" onclick="return edit_scoutprogram_training('.$alldt[$i]->id.',\''.$alldt[$i]->training_date.'\','.$alldt[$i]->badge_id.',\''.$alldt[$i]->training_name.'\',\''.$alldt[$i]->certificate_no.'\',\''.$alldt[$i]->ex_id.'\');">Edit</button>
     '; 
     if($this->ion_auth->is_admin() OR $this->ion_auth->is_region_admin() OR $this->ion_auth->is_district_admin() OR $this->ion_auth->is_upazila_admin() OR $this->ion_auth->is_group_admin()){
        $table='prog_training';
        if($alldt[$i]->status==0){
         echo '<button type="button" class="btn btn-info btn-mini" onclick="return verify_scoutprogram('.$alldt[$i]->id.',\''.$table.'\',5);">Verify</button>';
      }
   }
   echo' 
</td>
</tr>
';
}
echo '</table>';
exit;
}

public function program_badge_health($scout_id){


 $updateid=$this->input->get('hide_id');
 $form_data = array(
  'scout_id'        => $scout_id,
  'section_id'      => $this->input->get('section_id'),
  'years'           => $this->input->get('health_years'),
  'height'          => $this->input->get('health_height'),
  'weight'          => $this->input->get('health_weight'),
  'chest_size'      => $this->input->get('health_chest_size'),
  'span'            => $this->input->get('health_span'),
  'hand_size'       => $this->input->get('health_hand_size'),
  'heartbeat'       => $this->input->get('health_heartbeat'),
  'temperature'     => $this->input->get('health_temperature'),
  'user_id'         => $this->input->get('hide_user_id'),
  'examiner_id'     => $this->input->get('examiner_id'),
  'status'          => $this->status
  );

 $delete_id = $this->input->get('delete_id');

 if($delete_id > 0 ) 
 {
  if($this->Program_model->delete_prgram('prog_physical_health',$delete_id))
   echo 'Delete Success';
else
   echo 'Delete Failed';
}
else if ($updateid=='' and !empty($this->input->get('health_years'))){

  $validate_insert=$this->Program_model->health_checkduplicate($form_data);
  if(empty($validate_insert))
  {
   if($this->Common_model->save('prog_physical_health', $form_data)){
    echo 'inserted';
 }else {
    echo 'insert fail';
 }
}
else
   echo 'duplicate';

}
else if($updateid>0 and !empty($this->input->get('health_years'))){



  if($this->Common_model->edit('prog_physical_health', $updateid, 'id', $form_data)) {
   echo 'updated';
}else {
   echo 'update fail';
}
}

$alldt=$this->Program_model->get_badge_details_health($form_data);
echo '23432sdfg324';
echo '<table class="tg">
<tr>
   <th class="tg-71hr">ক্রম</th>
   <th class="tg-71hr">বর্ষ</th>
   <th class="tg-71hr">উচ্চতা</th>
   <th class="tg-71hr">ওজন</th>
   <th class="tg-71hr">বুকের মাপ</th>
   <th class="tg-71hr">বিঘত</th>
   <th class="tg-71hr">হাতের মাপ</th>
   <th class="tg-71hr">হৃদ স্পন্দন</th>
   <th class="tg-71hr">তাপমাত্রা</th>
   <th class="tg-71hr">মূল্যায়নকারী</th>
   <th class="tg-71hr">যাচাইকারী</th>
   <th class="tg-71hr" width="120">পদক্ষেপ</th>
</tr>';
for($i=0;$i<sizeof($alldt);$i++)
{
 echo '
 <tr>
  <td class="tg-031e">'.($i+1).'</td>
  <td class="tg-031e">'.$alldt[$i]->years.'</td>
  <td class="tg-031e">'.$alldt[$i]->height.'</td>
  <td class="tg-031e">'.$alldt[$i]->weight.'</td>
  <td class="tg-031e">'.$alldt[$i]->chest_size.'</td>
  <td class="tg-031e">'.$alldt[$i]->span.'</td>
  <td class="tg-031e">'.$alldt[$i]->hand_size.'</td>
  <td class="tg-031e">'.$alldt[$i]->heartbeat.'</td>
  <td class="tg-031e">'.$alldt[$i]->temperature.'</td>
  <td class="tg-031e">'.$alldt[$i]->examiner_id.'</td>
  <td class="tg-031e">'.$alldt[$i]->scout_id2.'</td>
  <td class="tg-031e">
     <button type="button" class="btn btn-danger btn-mini" onclick="return delete_scoutprogram_health('.$alldt[$i]->id.');">Delete</button>
     <button type="button" class="btn btn-success btn-mini" onclick="return edit_scoutprogram_health('.$alldt[$i]->id.',\''.$alldt[$i]->years.'\',\''.$alldt[$i]->height.'\',\''.$alldt[$i]->weight.'\',\''.$alldt[$i]->chest_size.'\',\''.$alldt[$i]->span.'\',\''.$alldt[$i]->hand_size.'\',\''.$alldt[$i]->heartbeat.'\',\''.$alldt[$i]->temperature.'\',\''.$alldt[$i]->ex_id.'\');">Edit</button>
     '; 
     if($this->ion_auth->is_admin() OR $this->ion_auth->is_region_admin() OR $this->ion_auth->is_district_admin() OR $this->ion_auth->is_upazila_admin() OR $this->ion_auth->is_group_admin()){
        $table='prog_physical_health';
        if($alldt[$i]->status==0){
         echo '<button type="button" class="btn btn-info btn-mini" onclick="return verify_scoutprogram('.$alldt[$i]->id.',\''.$table.'\',6);">Verify</button>';
      }
   }
   echo' 
</td>
</tr>
';
}
echo '</table>';
exit;
}

public function program_badge_institute($scout_id){


 $updateid=$this->input->get('hide_id');
 $form_data = array(
  'scout_id'        => $scout_id,
  'section_id'      => $this->input->get('section_id'),
  'years'           => $this->input->get('institute_years'),
  'class_name'      => $this->input->get('institute_class_name'),
  'roll_no'         => $this->input->get('institute_roll_no'),
  'total_unmber'    => $this->input->get('institute_total_unmber'),
  'user_id'         => $this->input->get('hide_user_id'),
  'examiner_id'     => $this->input->get('examiner_id'),
  'status'          => $this->status
  );

 $delete_id = $this->input->get('delete_id');

 if($delete_id > 0 ) 
 {
  if($this->Program_model->delete_prgram('prog_institute_promotion',$delete_id))
   echo 'Delete Success';
else
   echo 'Delete Failed';
}
else if ($updateid=='' and !empty($this->input->get('institute_years'))){

  $validate_insert=$this->Program_model->institute_checkduplicate($form_data);
  if(empty($validate_insert))
  {
   if($this->Common_model->save('prog_institute_promotion', $form_data)){
    echo 'inserted';
 }else {
    echo 'insert fail';
 }
}
else
   echo 'duplicate';

}
else if($updateid>0 and !empty($this->input->get('institute_years'))){



  if($this->Common_model->edit('prog_institute_promotion', $updateid, 'id', $form_data)) {
   echo 'updated';
}else {
   echo 'update fail';
}
}

$alldt=$this->Program_model->get_badge_details_institute($form_data);
echo '23432sdfg324';
echo '<table class="tg">
<tr>
   <th class="tg-71hr">ক্রম</th>
   <th class="tg-71hr">বর্ষ</th>
   <th class="tg-71hr">শ্রেণী</th>
   <th class="tg-71hr">রোল নং</th>
   <th class="tg-71hr">প্রাপ্ত নম্বর</th>
   <th class="tg-71hr">মূল্যায়নকারী</th>
   <th class="tg-71hr">যাচাইকারী</th>
   <th class="tg-71hr" width="120">পদক্ষেপ</th>
</tr>';
for($i=0;$i<sizeof($alldt);$i++)
{
 echo '
 <tr>
  <td class="tg-031e">'.($i+1).'</td>
  <td class="tg-031e">'.$alldt[$i]->years.'</td>
  <td class="tg-031e">'.$alldt[$i]->class_name.'</td>
  <td class="tg-031e">'.$alldt[$i]->roll_no.'</td>
  <td class="tg-031e">'.$alldt[$i]->total_unmber.'</td>
  <td class="tg-031e">'.$alldt[$i]->examiner_id.'</td>
  <td class="tg-031e">'.$alldt[$i]->scout_id2.'</td>
  <td class="tg-031e">
     <button type="button" class="btn btn-danger btn-mini" onclick="return delete_scoutprogram_institute('.$alldt[$i]->id.');">Delete</button>
     <button type="button" class="btn btn-success btn-mini" onclick="return edit_scoutprogram_institute('.$alldt[$i]->id.',\''.$alldt[$i]->years.'\',\''.$alldt[$i]->class_name.'\',\''.$alldt[$i]->roll_no.'\',\''.$alldt[$i]->total_unmber.'\',\''.$alldt[$i]->ex_id.'\');">Edit</button>
     '; 
     if($this->ion_auth->is_admin() OR $this->ion_auth->is_region_admin() OR $this->ion_auth->is_district_admin() OR $this->ion_auth->is_upazila_admin() OR $this->ion_auth->is_group_admin()){
        $table='prog_institute_promotion';
        if($alldt[$i]->status==0){
         echo '<button type="button" class="btn btn-info btn-mini" onclick="return verify_scoutprogram('.$alldt[$i]->id.',\''.$table.'\',7);">Verify</button>';
      }
   }
   echo' 
</td>
</tr>
';
}
echo '</table>';
exit;
}

public function program_badge_promotion($scout_id){


 $updateid=$this->input->get('hide_id');
 $form_data = array(
  'scout_id'        => $scout_id,
  'section_id'      => $this->input->get('section_id'),
  'badge_id'        => $this->input->get('scout_badge'),
  'role_id'         => $this->input->get('scout_role'),
  'from_date'       => date_db_format($this->input->get('from_date')),
  'to_date'         => date_db_format($this->input->get('to_date')),
  'user_id'         => $this->input->get('hide_user_id'),
  'examiner_id'     => $this->input->get('examiner_id'),
  'status'          => $this->status
  );
 $delete_id = $this->input->get('delete_id');

 if($delete_id > 0 ) 
 {
  if($this->Program_model->delete_prgram('prog_section_promotion',$delete_id))
   echo 'Delete Success';
else
   echo 'Delete Failed';
}
else if ($updateid=='' and $this->input->get('scout_badge') >0){

  $validate_insert=$this->Program_model->promotion_checkduplicate($form_data);
  if(empty($validate_insert))
  {
   if($this->Common_model->save('prog_section_promotion', $form_data)){
    echo 'inserted';
 }else {
    echo 'insert fail';
 }
}
else
   echo 'duplicate';

}
else if($updateid>0 and $this->input->get('scout_badge') >0){



  if($this->Common_model->edit('prog_section_promotion', $updateid, 'id', $form_data)) {
   echo 'updated';
}else {
   echo 'update fail';
}
}

$alldt=$this->Program_model->get_badge_details_promotion($form_data);
echo '23432sdfg324';
echo '<table class="tg">
<tr>
   <th class="tg-71hr">ক্রম</th>
   <th class="tg-71hr">রোল</th>
   <th class="tg-71hr">পদোন্নতির শুরুর তারিখ</th>
   <th class="tg-71hr">পদোন্নতির শেষ তারিখ</th>
   <th class="tg-71hr">ব্যাজ</th>
   <th class="tg-71hr">মূল্যায়নকারী</th>
   <th class="tg-71hr">যাচাইকারী</th>
   <th class="tg-71hr" width="120">পদক্ষেপ</th>
</tr>';
for($i=0;$i<sizeof($alldt);$i++)
{
 echo '
 <tr>
  <td class="tg-031e">'.($i+1).'</td>
  <td class="tg-031e">'.$alldt[$i]->role_type_name_bn.'</td>
  <td class="tg-031e">'.date_bangla_format($alldt[$i]->from_date).'</td>
  <td class="tg-031e">'.date_bangla_format($alldt[$i]->to_date).'</td>
  <td class="tg-031e">'.$alldt[$i]->badge_type_name_bn.'</td>
  <td class="tg-031e">'.$alldt[$i]->examiner_id.'</td>
  <td class="tg-031e">'.$alldt[$i]->scout_id.'</td>
  <td class="tg-031e">
     <button type="button" class="btn btn-danger btn-mini" onclick="return delete_scoutprogram_promotion('.$alldt[$i]->id.');">Delete</button>
     <button type="button" class="btn btn-success btn-mini" onclick="return edit_scoutprogram_promotion('.$alldt[$i]->id.',\''.$alldt[$i]->from_date.'\',\''.$alldt[$i]->to_date.'\','.$alldt[$i]->badge_id.',\''.$alldt[$i]->role_id.'\',\''.$alldt[$i]->ex_id.'\');">Edit</button>
     '; 
     if($this->ion_auth->is_admin() OR $this->ion_auth->is_region_admin() OR $this->ion_auth->is_district_admin() OR $this->ion_auth->is_upazila_admin() OR $this->ion_auth->is_group_admin()){
        $table='prog_section_promotion';
        if($alldt[$i]->status==0){
         echo '<button type="button" class="btn btn-info btn-mini" onclick="return verify_scoutprogram('.$alldt[$i]->id.',\''.$table.'\',8);">Verify</button>';
      }
   }
   echo' 
</td>
</tr>
';
}
echo '</table>';
exit;
}

public function program_badge_resign($scout_id){


 $updateid=$this->input->get('hide_id');
 $form_data = array(
  'scout_id'        => $scout_id,
  'section_id'      => $this->input->get('section_id'),
  'resign_reason'   => $this->input->get('resign_reason'),
  'resign_date'     => date_db_format($this->input->get('resign_date')),
  'user_id'         => $this->input->get('hide_user_id'),
  'examiner_id'     => $this->input->get('examiner_id'),
  'status'          => $this->status
  );
 $delete_id = $this->input->get('delete_id');

 if($delete_id > 0) 
 {
  if($this->Program_model->delete_prgram('prog_group_resign',$delete_id))
   echo 'Delete Success';
else
   echo 'Delete Failed';
}
else if ($updateid=='' and !empty($this->input->get('resign_reason'))){

  $validate_insert=$this->Program_model->resign_checkduplicate($form_data);
  if(empty($validate_insert))
  {
   if($this->Common_model->save('prog_group_resign', $form_data)){
    echo 'inserted';
 }else {
    echo 'insert fail';
 }
}
else
   echo 'duplicate';

}
else if($updateid>0 and !empty($this->input->get('resign_reason'))){



  if($this->Common_model->edit('prog_group_resign', $updateid, 'id', $form_data)) {
   echo 'updated';
}else {
   echo 'update fail';
}
}

$alldt=$this->Program_model->get_badge_details_resign($form_data);
echo '23432sdfg324';
echo '<table class="tg">
<tr>
   <th class="tg-71hr">ক্রম</th>
   <th class="tg-71hr">গ্রুপ ত্যাগের তারিখ</th>
   <th class="tg-71hr">গ্রুপ ত্যাগের কারণ</th>
   <th class="tg-71hr">মূল্যায়নকারী</th>
   <th class="tg-71hr">যাচাইকারী</th>
   <th class="tg-71hr" width="120">পদক্ষেপ</th>
</tr>';
for($i=0;$i<sizeof($alldt);$i++)
{
 echo '
 <tr>
  <td class="tg-031e">'.($i+1).'</td>
  <td class="tg-031e">'.date_bangla_format($alldt[$i]->resign_date).'</td>
  <td class="tg-031e">'.$alldt[$i]->resign_reason.'</td>
  <td class="tg-031e">'.$alldt[$i]->examiner_id.'</td>
  <td class="tg-031e">'.$alldt[$i]->scout_id.'</td>
  <td class="tg-031e">
     <button type="button" class="btn btn-danger btn-mini" onclick="return delete_scoutprogram_resign('.$alldt[$i]->id.');">Delete</button>
     <button type="button" class="btn btn-success btn-mini" onclick="return edit_scoutprogram_resign('.$alldt[$i]->id.',\''.$alldt[$i]->resign_date.'\',\''.$alldt[$i]->resign_reason.'\',\''.$alldt[$i]->ex_id.'\');">Edit</button>
     '; 
     if($this->ion_auth->is_admin() OR $this->ion_auth->is_region_admin() OR $this->ion_auth->is_district_admin() OR $this->ion_auth->is_upazila_admin() OR $this->ion_auth->is_group_admin()){
        $table='prog_group_resign';
        if($alldt[$i]->status==0){
         echo '<button type="button" class="btn btn-info btn-mini" onclick="return verify_scoutprogram('.$alldt[$i]->id.',\''.$table.'\',9);">Verify</button>';
      }
   }
   echo' 
</td>
</tr>
';
}
echo '</table>';
exit;
}

public function verify_program($scout_id){

 $form_data = array(
   'user_id'         => $this->input->get('hide_user_id'),
   'status'          => $this->status
   );
 $updateid = $this->input->get('verifyid');
 $table    = $this->input->get('verifytable');

 if($this->Common_model->edit($table, $updateid, 'id', $form_data)) {
  echo 'updated';
}else {
  echo 'update fail';
}
exit;
}

}