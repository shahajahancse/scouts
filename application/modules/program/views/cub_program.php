<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('dashboard')?>" class="active"> <?=$module_title; ?> </a></li>
         <li><?=$meta_title; ?> </li>
      </ul>

      <style type="text/css">
         .tg  {border-collapse:collapse;border-spacing:0; width: 100%; color: black;}
         .tg td{font-family:Arial, sans-serif;font-size:14px;padding:4px 7px;border-style:solid;border-width:1px; border-color: #a5a2a2; overflow:hidden;word-break:normal;}
         .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:4px 7px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
         .tg .tg-71hr{background-color:#c5caca; font-weight: bold;}
      </style>
      <?php 
      $section_id = 2;
      if($this->ion_auth->is_admin()){
         $id = $info->id;
         $user_id = $this->session->userdata('user_id');
      }elseif($this->ion_auth->is_region_admin()){  
         $id = $info->id;
         $user_id = $this->session->userdata('user_id');
      }elseif($this->ion_auth->is_district_admin()){
         $id = $info->id;
         $user_id = $this->session->userdata('user_id');
      }elseif($this->ion_auth->is_upazila_admin()){
         $id = $info->id;
         $user_id = $this->session->userdata('user_id');
      }elseif($this->ion_auth->is_group_admin()){
         $id = $info->id;
         $user_id = $this->session->userdata('user_id');
      }else{
         $id = $this->session->userdata('user_id');
         $user_id = 0;
      }
      ?>
      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">                
                     <a href="<?=base_url('scouts_member/details/'.encrypt_url($id))?>" class="btn btn-success btn-xs btn-mini"> Scouts Member Details</a>  
                  </div>
               </div>

               <div class="grid-body">

                  <div class="row">
                     <div class="col-md-12">
                      <table class="tg">
                        <tr>
                           <th class="tg-71hr">Name</th>
                           <td class="tg-031e"><?=$info->first_name?></td>                           
                           <th class="tg-71hr">Scout ID</th>
                           <td class="tg-031e"><?=$info->scout_id?></td>
                           <th class="tg-71hr">Section</th>
                           <td class="tg-031e"><?=get_scout_section($info->sc_section_id)?></td>
                        </tr>
                      </table>
                    </div> <br><br><br>
                    
                     <div class="col-md-12">
                        <div class="tabbable tabs-left">
                           <ul class="nav nav-tabs" id="tab-2">
                              <li class="active"><a href="#tab_progress">Progress</a></li>
                              <li><a href="#tab_proficiency">Proficiency Badge</a></li>
                              <li><a href="#tab_training">Training Record</a></li>
                              <li><a href="#tab_activities">Activities</a></li>
                              <li><a href="#tab_promotions">Promotions</a></li>
                              <li><a href="#tab_group_change">Group Change</a></li>
                           </ul>
                           <div class="tab-content">
                              <?php if($this->session->flashdata('success')):?>
                                 <div class="alert alert-success">
                                    <?=$this->session->flashdata('success');;?>
                                 </div>
                              <?php endif; ?>                                 

                              <div class="tab-pane active" id="tab_progress">
                                 <div class="row ">
                                    <div class="col-md-12">
                                       <h4 class="pull-left"><span class="semi-bold">Progress (ক্রমোন্নতি) </span></h4>
                                       <div class="pull-right">                
                                          <a href="<?=base_url('program/achievement_add/'.encrypt_url($info->id))?>" class="btn btn-info btn-xs btn-mini"> Add Achivement</a>  
                                          <a href="<?=base_url('program/award_add/'.encrypt_url($info->id))?>" class="btn btn-info btn-xs btn-mini"> Add Award</a>  
                                       </div>
                                       <div class="clearfix"> </div>

                                       <div class="row">
                                          <div class="col-md-12">
                                             <h5><span class="semi-bold">Achievements</span></h5>
                                             <table class="tg">
                                                <tr>
                                                   <th class="tg-71hr" width="10">SL</th>
                                                   <th class="tg-71hr">Efficiency Stage</th>
                                                   <th class="tg-71hr" width="120">Achieved Date</th>
                                                   <th class="tg-71hr">Evaluated By</th>
                                                   <th class="tg-71hr" width="110">Action</th>
                                                </tr>
                                                <?php  
                                                $i=0;
                                                foreach ($achievements as $row) {
                                                 $i++;
                                                 ?>
                                                 <tr>
                                                    <td class="tg-031e" align="center"><?=$i?></td>
                                                    <td class="tg-031e"><?=$row->badge_type_name_en?></td>
                                                    <td class="tg-031e"><?=date_bangla_format($row->achive_date)?></td>
                                                    <td class="tg-031e"><?php                             
                                                    if($row->examiner_id != NULL){
                                                      echo $row->first_name.' ('.$row->examiner_id.')';
                                                    }
                                                    ?></td>
                                                    <td class="tg-031e">
                                                      <a href="<?=base_url('program/achievement_edit/'.encrypt_url($row->id).'/'.encrypt_url($row->scout_id))?>" class="btn btn-success btn-mini btn-xs">Edit</a>
                                                      <a href="<?=base_url('program/achievement_delete/'.encrypt_url($row->id).'/'.encrypt_url($row->scout_id))?>" class="btn btn-danger btn-mini btn-xs" onclick="return confirm('Are you sure to delete this data?')">Delete</a>
                                                    </td>
                                                  </tr>    
                                                  <?php } ?>
                                                </table>
                                               </div>   


                                               <div class="col-md-12">
                                                  <h5><span class="semi-bold">Awards</span></h5>
                                                  <table class="tg">
                                                    <tr>
                                                     <th class="tg-71hr" width="10">SL</th>
                                                     <th class="tg-71hr">Award name</th>
                                                     <th class="tg-71hr">Certificate No</th>
                                                     <th class="tg-71hr" width="120">Issue Date</th>
                                                     <th class="tg-71hr" width="110">Action</th>
                                                   </tr>
                                                   <?php  
                                                    $i=0;
                                                    foreach ($awards as $row) {
                                                     $i++;
                                                     ?>
                                                     <tr>
                                                      <td class="tg-031e" align="center"><?=$i?></td>
                                                      <td class="tg-031e"><?=$row->award_name?></td>
                                                      <td class="tg-031e"><?=$row->certificate_no?></td>
                                                      <td class="tg-031e"><?=date_bangla_format($row->issue_date)?></td>                                                    
                                                      <td class="tg-031e">
                                                        <a href="<?=base_url('program/award_edit/'.encrypt_url($row->id).'/'.encrypt_url($row->scout_id))?>" class="btn btn-success btn-mini btn-xs">Edit</a>
                                                        <a href="<?=base_url('program/award_delete/'.encrypt_url($row->id).'/'.encrypt_url($row->scout_id))?>" class="btn btn-danger btn-mini btn-xs" onclick="return confirm('Are you sure to delete this data?')">Delete</a>
                                                      </td>
                                                    </tr>    
                                                    <?php } ?>
                                                  </table>
                                                </div>   
                                            </div>
                                         </div>                                        
                                      </div>
                                   </div>

                                   <div class="tab-pane" id="tab_proficiency">
                                    <div class="row ">
                                       <div class="col-md-12">
                                          <h4 class="pull-left"><span class="semi-bold">Proficiency Badge (পারদর্শিতা ব্যাজ) </span></h4>
                                          <div class="pull-right">                
                                            <a href="<?=base_url('program/proficiency_add/'.encrypt_url($info->id))?>" class="btn btn-info btn-xs btn-mini"> Add Proficiency Badge</a>  
                                          </div>
                                          <div class="clearfix"> </div>

                                          <table class="tg">
                                            <tr>
                                               <th class="tg-71hr">SL</th>
                                               <th class="tg-71hr">Proficiency Badge Group</th>
                                               <th class="tg-71hr">Proficiency Badge Name</th>
                                               <th class="tg-71hr" width="120">Achieved Data</th>
                                               <th class="tg-71hr">Evaluated By </th>
                                               <th class="tg-71hr">Extra Badge</th>
                                               <th class="tg-71hr" width="110">Action</th>
                                            </tr>
                                            <?php
                                              $i=0;
                                              foreach ($proficiency_badges as $row) {
                                              $i++;
                                            ?>
                                              <tr>
                                                <td class="tg-031e" align="center"><?=$i?></td>
                                                <td class="tg-031e"><?=$row->prof_badge_group_name?></td>
                                                <td class="tg-031e"><?=$row->prof_badge_name?></td>
                                                <td class="tg-031e"><?=date_bangla_format($row->achieved_date)?></td>                                                    
                                                <td class="tg-031e"><?php                             
                                                    if($row->evaluated_by != NULL){
                                                      echo $row->first_name.' ('.$row->evaluat_scout_id.')';
                                                    }
                                                    ?></td>
                                                <td class="tg-031e"><?=$row->extra_badge?></td>
                                                <td class="tg-031e">
                                                  <a href="<?=base_url('program/proficiency_edit/'.encrypt_url($row->id).'/'.encrypt_url($row->scout_id))?>" class="btn btn-success btn-mini btn-xs">Edit</a>
                                                  <a href="<?=base_url('program/proficiency_delete/'.encrypt_url($row->id).'/'.encrypt_url($row->scout_id))?>" class="btn btn-danger btn-mini btn-xs" onclick="return confirm('Are you sure to delete this data?')">Delete</a>
                                                </td>
                                              </tr>    
                                            <?php } ?>
                                            </table>
                                        </div>
                                     </div>
                                  </div>

                              <div class="tab-pane" id="tab_training">
                                 <div class="row ">
                                    <div class="col-md-12">
                                      <h4 class="pull-left"><span class="semi-bold">Training Record (প্রশিক্ষণ রেকর্ড) </span></h4>
                                      <div class="pull-right">                
                                        <a href="<?=base_url('program/training_record_add/'.encrypt_url($info->id))?>" class="btn btn-info btn-xs btn-mini"> Add Training</a>  
                                      </div>
                                      <div class="clearfix"> </div>

                                      <table class="tg">
                                        <tr>
                                           <th class="tg-71hr" width="10">SL</th>
                                           <th class="tg-71hr">Training Name</th>
                                           <th class="tg-71hr">Course Name</th>
                                           <th class="tg-71hr" width="90">Start Date</th>
                                           <th class="tg-71hr" width="90">End Date</th>
                                           <th class="tg-71hr" width="110">Certificate No</th>
                                           <th class="tg-71hr" width="100">Issue Date</th>
                                           <th class="tg-71hr" width="60">Action</th>
                                        </tr>
                                        <?php  
                                        $i=0;
                                        foreach ($trainings as $row) {
                                          $i++;                                          
                                         ?>
                                         <tr>
                                            <td class="tg-031e" align="center"><?=$i?></td>
                                            <td class="tg-031e"><?=$row->training_name?></td>
                                            <td class="tg-031e"><?=$row->course_name ?></td>
                                            <td class="tg-031e"><?=date_bangla_format($row->start_date)?></td>
                                            <td class="tg-031e"><?=date_bangla_format($row->end_date)?></td>
                                            <td class="tg-031e"><?=$row->certificate_no?></td>
                                            <td class="tg-031e"><?=date_bangla_format($row->issue_date)?></td>
                                            <td class="tg-031e">
                                              <a href="<?=base_url('program/training_record_delete/'.encrypt_url($row->id).'/'.encrypt_url($row->scout_id))?>" class="btn btn-danger btn-mini btn-xs" onclick="return confirm('Are you sure to delete this data?')">Delete</a>
                                            </td>
                                          </tr>    
                                          <?php } ?>
                                        </table>
                                      </div>
                                   </div>
                                </div>

                                <div class="tab-pane" id="tab_activities">
                                 <div class="row ">
                                    <div class="col-md-12">                                    
                                      <h4 class="pull-left"><span class="semi-bold">Activities (কার্যক্রম) </span></h4>
                                      <div class="pull-right">                
                                        <a href="<?=base_url('program/activities_add/'.encrypt_url($info->id))?>" class="btn btn-info btn-xs btn-mini"> Add Activities</a>  
                                      </div>
                                      <div class="clearfix"> </div>

                                      <table class="tg">
                                        <tr>
                                           <th class="tg-71hr" width="10">SL</th>
                                           <th class="tg-71hr">Activity Type</th>
                                           <th class="tg-71hr">Activity Name</th>
                                           <th class="tg-71hr" width="90">Start Date</th>
                                           <th class="tg-71hr" width="90">End Date</th>
                                           <th class="tg-71hr" width="120">Certificate No</th>
                                           <th class="tg-71hr" width="100">Issue Date</th>
                                           <th class="tg-71hr" width="60">Action</th>
                                        </tr>
                                        <?php  
                                        $i=0;
                                        foreach ($activities as $row) {
                                          $i++;                                          
                                         ?>
                                         <tr>
                                            <td class="tg-031e" align="center"><?=$i?></td>
                                            <td class="tg-031e"><?=$row->event_cate_name?></td>
                                            <td class="tg-031e"><?=$row->activity_name ?></td>
                                            <td class="tg-031e"><?=date_bangla_format($row->start_date)?></td>
                                            <td class="tg-031e"><?=date_bangla_format($row->end_date)?></td>
                                            <td class="tg-031e"><?=$row->certificate_no?></td>
                                            <td class="tg-031e"><?=date_bangla_format($row->issue_date)?></td>
                                            <td class="tg-031e">
                                              <a href="<?=base_url('program/activities_delete/'.encrypt_url($row->id).'/'.encrypt_url($row->scout_id))?>" class="btn btn-danger btn-mini btn-xs" onclick="return confirm('Are you sure to delete this data?')">Delete</a>
                                            </td>
                                          </tr>    
                                          <?php } ?>
                                        </table>
                                      </div>
                                   </div>
                                </div>                                 

                                <div class="tab-pane" id="tab_promotions">
                                 <div class="row ">
                                    <div class="col-md-12">
                                       <h4 class="pull-left"><span class="semi-bold">Promotions (পদোন্নতি) </span></h4>
                                      <div class="pull-right">                
                                        <a href="<?=base_url('program/promotion_add/'.encrypt_url($info->id))?>" class="btn btn-info btn-xs btn-mini"> Add Promotions</a>  
                                      </div>
                                      <div class="clearfix"> </div>

                                      <table class="tg">
                                        <tr>
                                           <th class="tg-71hr" width="10">SL</th>
                                           <th class="tg-71hr">Office</th>
                                           <th class="tg-71hr">Section</th>
                                           <th class="tg-71hr">Role</th>
                                           <th class="tg-71hr">Department</th>
                                           <th class="tg-71hr" width="90">Start Date</th>
                                           <th class="tg-71hr" width="90">End Date</th>
                                           <th class="tg-71hr" width="110">Action</th>
                                        </tr>
                                        <?php  
                                        $i=0;
                                        foreach ($promotions as $row) {
                                          $i++;
                                          if($row->promo_office_type ==1){
                                            $officeName = 'National Headquarter';
                                          }else{
                                            $officeName = $row->grp_name;
                                          }
                                          $roleName = $row->role_type_name_en.' ('.$row->role_type_name_bn.')';
                                         ?>
                                         <tr>
                                            <td class="tg-031e" align="center"><?=$i?></td>
                                            <td class="tg-031e"><?=$officeName?></td>
                                            <td class="tg-031e"><?=get_scout_section($row->promo_section_id)?></td>
                                            <td class="tg-031e"><?=$roleName?></td>
                                            <td class="tg-031e"><?php
                                              if($row->promo_department_id != NULL){                            
                                                $deptIds = explode(',', $row->promo_department_id);
                                                foreach ($deptIds as $value) {
                                                  echo '-'.$this->Common_model->get_department_single($value);
                                                  echo '<br>';
                                                }
                                              }
                                            ?></td>
                                            <td class="tg-031e"><?=date_bangla_format($row->promo_start_date)?></td>
                                            <td class="tg-031e"><?=date_bangla_format($row->promo_end_date)?></td>
                                            <td class="tg-031e">
                                              <a href="<?=base_url('program/promotion_edit/'.encrypt_url($row->id).'/'.encrypt_url($row->scout_id))?>" class="btn btn-success btn-mini btn-xs">Edit</a>
                                              <a href="<?=base_url('program/promotion_delete/'.encrypt_url($row->id).'/'.encrypt_url($row->scout_id))?>" class="btn btn-danger btn-mini btn-xs" onclick="return confirm('Are you sure to delete this data?')">Delete</a>
                                            </td>
                                          </tr>    
                                          <?php } ?>
                                        </table>
                                      </div>
                                   </div>
                                </div>

                                <div class="tab-pane" id="tab_group_change">
                                 <div class="row ">
                                    <div class="col-md-12">
                                      <h4 class="pull-left"><span class="semi-bold">Group Change (গ্রুপ পরিবর্তন) </span></h4>
                                      <div class="pull-right">                
                                        <a href="<?=base_url('program/group_change_add/'.encrypt_url($info->id))?>" class="btn btn-info btn-xs btn-mini"> Add Group Change</a>  
                                      </div>
                                      <div class="clearfix"> </div>

                                      <table class="tg">
                                        <tr>
                                           <th class="tg-71hr" width="10">SL</th>
                                           <th class="tg-71hr">Group Leave Date</th>
                                           <th class="tg-71hr">Group Leave Date</th>
                                           <th class="tg-71hr">Group Leave Reason</th>
                                           <th class="tg-71hr">New Group</th>      
                                           <th class="tg-71hr" width="60">Action</th>
                                        </tr>
                                        <?php  
                                        $i=0;
                                        foreach ($group_change as $row) {
                                          $i++;                                          
                                         ?>
                                         <tr>
                                            <td class="tg-031e" align="center"><?=$i?></td>
                                            <td class="tg-031e"><?=$row->resign_gorup_name?></td>
                                            <td class="tg-031e"><?=date_bangla_format($row->resign_date)?></td>
                                            <td class="tg-031e"><?=$row->resign_reason?></td>
                                            <td class="tg-031e"><?=$row->new_group_name ?></td>
                                            <td class="tg-031e">
                                              <a href="<?=base_url('program/group_change_delete/'.encrypt_url($row->id).'/'.encrypt_url($row->scout_id))?>" class="btn btn-danger btn-mini btn-xs" onclick="return confirm('Are you sure to delete this data?')">Delete</a>
                                            </td>
                                          </tr>    
                                          <?php } ?>
                                        </table>
                                      </div>
                                   </div>
                                </div>

                              </div>
                           </div>
                        </div>
                     </div>

                  </div>  <!-- END GRID BODY -->              
               </div> <!-- END GRID -->
            </div>

         </div> <!-- END ROW -->
      </div>
   </div>
<?php /*
   <script type="text/javascript">
      $(document).ready(function() {

         get_scout_badge_det();
         get_scout_badge_expertness();
         get_scout_badge_achievemen();
         get_scout_badge_camping();
         get_scout_badge_training();
         get_scout_badge_resign();
         get_scout_badge_promotion();
         get_scout_badge_health();
         get_scout_badge_institute();

         $('#program_badge').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
         badge_id: {
            required: true
         },
         question_id: {
            required: true
         },
         achive_date: {
            required: true
         },
         examiner_id: {
            required: false
         },

      },

      invalidHandler: function (event, validator) {
         //display error alert on form submit    
      },

      errorPlacement: function (label, element) { // render error placement for each input type   
         $('<span class="error"></span>').insertAfter(element).append(label)
         var parent = $(element).parent('.input-with-icon');
         parent.removeClass('success-control').addClass('error-control');  
      },

      highlight: function (element) { // hightlight error inputs
         var parent = $(element).parent();
         parent.removeClass('success-control').addClass('error-control'); 
      },

      unhighlight: function (element) { // revert the change done by hightlight

      },

      success: function (label, element) {
         var parent = $(element).parent('.input-with-icon');
         parent.removeClass('error-control').addClass('success-control'); 
      },

      submitHandler: function (form) {
         //form.submit();
         get_scout_badge_det();
      }
   });

         $('#program_badge_expertness').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
         badge_id: {
            required: true
         },
         expert_group_id: {
            required: true
         },
         achive_date: {
            required: true
         },
         extra_badge:{
            required: true
         },
         examiner_id: {
            required: false
         },
      },

      invalidHandler: function (event, validator) {
         //display error alert on form submit    
      },

      errorPlacement: function (label, element) { // render error placement for each input type   
         $('<span class="error"></span>').insertAfter(element).append(label)
         var parent = $(element).parent('.input-with-icon');
         parent.removeClass('success-control').addClass('error-control');  
      },

      highlight: function (element) { // hightlight error inputs
         var parent = $(element).parent();
         parent.removeClass('success-control').addClass('error-control'); 
      },

      unhighlight: function (element) { // revert the change done by hightlight

      },

      success: function (label, element) {
         var parent = $(element).parent('.input-with-icon');
         parent.removeClass('error-control').addClass('success-control'); 
      },

      submitHandler: function (form) {
         //form.submit();
         get_scout_badge_expertness();
      }
   });

         $('#program_badge_achievemen').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
         badge_id: {
            required: true
         },
         achive_date: {
            required: true
         },
         examiner_id: {
            required: false
         },

      },

      invalidHandler: function (event, validator) {
         //display error alert on form submit    
      },

      errorPlacement: function (label, element) { // render error placement for each input type   
         $('<span class="error"></span>').insertAfter(element).append(label)
         var parent = $(element).parent('.input-with-icon');
         parent.removeClass('success-control').addClass('error-control');  
      },

      highlight: function (element) { // hightlight error inputs
         var parent = $(element).parent();
         parent.removeClass('success-control').addClass('error-control'); 
      },

      unhighlight: function (element) { // revert the change done by hightlight

      },

      success: function (label, element) {
         var parent = $(element).parent('.input-with-icon');
         parent.removeClass('error-control').addClass('success-control'); 
      },

      submitHandler: function (form) {
         //form.submit();
         get_scout_badge_achievemen();
      }
   });

         $('#program_badge_camping').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
         area: {
            required: true
         },
         camp_date: {
            required: true
         },
         camp_name: {
            required: true
         },
         camp_certificate_no: {
            required: true
         },
         examiner_id: {
            required: false
         },

      },

      invalidHandler: function (event, validator) {
         //display error alert on form submit    
      },

      errorPlacement: function (label, element) { // render error placement for each input type   
         $('<span class="error"></span>').insertAfter(element).append(label)
         var parent = $(element).parent('.input-with-icon');
         parent.removeClass('success-control').addClass('error-control');  
      },

      highlight: function (element) { // hightlight error inputs
         var parent = $(element).parent();
         parent.removeClass('success-control').addClass('error-control'); 
      },

      unhighlight: function (element) { // revert the change done by hightlight

      },

      success: function (label, element) {
         var parent = $(element).parent('.input-with-icon');
         parent.removeClass('error-control').addClass('success-control'); 
      },

      submitHandler: function (form) {
         //form.submit();
         get_scout_badge_camping();
      }
   });

         $('#program_badge_training').validate({
         // focusInvalid: false, 
         ignore: "",
         rules: {
            badge_id: {
               required: true
            },
            train_date: {
               required: true
            },
            train_name: {
               required: true
            },
            train_certificate_no: {
               required: true
            },
            examiner_id: {
               required: false
            },

         },

         invalidHandler: function (event, validator) {
            //display error alert on form submit    
         },

         errorPlacement: function (label, element) { // render error placement for each input type   
            $('<span class="error"></span>').insertAfter(element).append(label)
            var parent = $(element).parent('.input-with-icon');
            parent.removeClass('success-control').addClass('error-control');  
         },

         highlight: function (element) { // hightlight error inputs
            var parent = $(element).parent();
            parent.removeClass('success-control').addClass('error-control'); 
         },

         unhighlight: function (element) { // revert the change done by hightlight

         },

         success: function (label, element) {
            var parent = $(element).parent('.input-with-icon');
            parent.removeClass('error-control').addClass('success-control'); 
         },

         submitHandler: function (form) {
            //form.submit();
            get_scout_badge_training();
         }
      });

         $('#program_badge_health').validate({
         // focusInvalid: false, 
         ignore: "",
         rules: {
            health_years: {
               required: true
            },
            health_height: {
               required: true
            },
            health_weight: {
               required: true
            },
            health_span: {
               required: true
            },
            health_hand_size: {
               required: true
            },
            health_temperature: {
               required: true
            },
            health_heartbeat: {
               required: true
            },
            health_chest_size: {
               required: true
            },
            examiner_id: {
               required: false
            },

         },

         invalidHandler: function (event, validator) {
            //display error alert on form submit    
         },

         errorPlacement: function (label, element) { // render error placement for each input type   
            $('<span class="error"></span>').insertAfter(element).append(label)
            var parent = $(element).parent('.input-with-icon');
            parent.removeClass('success-control').addClass('error-control');  
         },

         highlight: function (element) { // hightlight error inputs
            var parent = $(element).parent();
            parent.removeClass('success-control').addClass('error-control'); 
         },

         unhighlight: function (element) { // revert the change done by hightlight

         },

         success: function (label, element) {
            var parent = $(element).parent('.input-with-icon');
            parent.removeClass('error-control').addClass('success-control'); 
         },

         submitHandler: function (form) {
            //form.submit();
            get_scout_badge_health();
         }
      });

         $('#program_badge_institute').validate({
         // focusInvalid: false, 
         ignore: "",
         rules: {
            institute_years: {
               required: true
            },
            institute_class_name: {
               required: true
            },
            institute_roll_no: {
               required: true
            },
            institute_total_unmber: {
               required: true
            },
            examiner_id: {
               required: false
            },
            
         },

         invalidHandler: function (event, validator) {
            //display error alert on form submit    
         },

         errorPlacement: function (label, element) { // render error placement for each input type   
            $('<span class="error"></span>').insertAfter(element).append(label)
            var parent = $(element).parent('.input-with-icon');
            parent.removeClass('success-control').addClass('error-control');  
         },

         highlight: function (element) { // hightlight error inputs
            var parent = $(element).parent();
            parent.removeClass('success-control').addClass('error-control'); 
         },

         unhighlight: function (element) { // revert the change done by hightlight

         },

         success: function (label, element) {
            var parent = $(element).parent('.input-with-icon');
            parent.removeClass('error-control').addClass('success-control'); 
         },

         submitHandler: function (form) {
            //form.submit();
            get_scout_badge_institute();
         }
      });

         $('#program_badge_promotion').validate({
         // focusInvalid: false, 
         ignore: "",
         rules: {
            badge_id: {
               required: true
            },
            role_id: {
               required: true
            },
            promotion_from_date: {
               required: true
            },
            promotion_to_date: {
               required: false
            },
            examiner_id: {
               required: false
            },

         },

         invalidHandler: function (event, validator) {
            //display error alert on form submit    
         },

         errorPlacement: function (label, element) { // render error placement for each input type   
            $('<span class="error"></span>').insertAfter(element).append(label)
            var parent = $(element).parent('.input-with-icon');
            parent.removeClass('success-control').addClass('error-control');  
         },

         highlight: function (element) { // hightlight error inputs
            var parent = $(element).parent();
            parent.removeClass('success-control').addClass('error-control'); 
         },

         unhighlight: function (element) { // revert the change done by hightlight

         },

         success: function (label, element) {
            var parent = $(element).parent('.input-with-icon');
            parent.removeClass('error-control').addClass('success-control'); 
         },

         submitHandler: function (form) {
            //form.submit();
            get_scout_badge_promotion();
         }
      });

         $('#program_badge_resign').validate({
         // focusInvalid: false, 
         ignore: "",
         rules: {

            resign_date: {
               required: true
            },
            resign_reason: {
               required: true
            },
            examiner_id: {
               required: false
            },
            
         },

         invalidHandler: function (event, validator) {
            //display error alert on form submit    
         },

         errorPlacement: function (label, element) { // render error placement for each input type   
            $('<span class="error"></span>').insertAfter(element).append(label)
            var parent = $(element).parent('.input-with-icon');
            parent.removeClass('success-control').addClass('error-control');  
         },

         highlight: function (element) { // hightlight error inputs
            var parent = $(element).parent();
            parent.removeClass('success-control').addClass('error-control'); 
         },

         unhighlight: function (element) { // revert the change done by hightlight

         },

         success: function (label, element) {
            var parent = $(element).parent('.input-with-icon');
            parent.removeClass('error-control').addClass('success-control'); 
         },

         submitHandler: function (form) {
            //form.submit();
            get_scout_badge_resign();
         }
      });


      });  

   // scout badge 
   function get_scout_badge_det(){
     $.ajax({         
       method: "GET",
       url: "<?=base_url('program/program_badge/'.$id)?>",
       data: { scout_badge: $("#scout_badge").val(), examiner_id: $("#examiner_id").val(), question_id: $("#question_id").val(), achive_date: $("#achive_date").val(), section_id: $("#hide_section_id").val(), hide_id: $("#hide_id").val(), hide_user_id: $("#hide_user_id").val() }

    })
     .done(function( msg ) {
        detailsarr=msg.split('23432sdfg324');
        if(detailsarr[0]=='duplicate')
        {
          alert('Duplicate')
       }
       if(detailsarr[1]!='')
       {
          $('#printbadgh').html(detailsarr[1]);
       }


       $("#scout_badge").prop("disabled", false);
       $("#question_id").prop("disabled", false);

       $("#achive_date").val('');
       $("#hide_id").val('');
       $("#scout_badge").val('');
       $("#question_id").val('');
       $("#examiner_id").val('');


    }); 
  }

  function delete_scoutprogram(delid){
     if(confirm('Are you sure you want to delete this data?'))
     {
      $.ajax({        
         method: "GET",
         url: "<?=base_url('program/program_badge/'.$id)?>",
         data: { delete_id: delid, scout_badge: $("#scout_badge").val(), examiner_id: $("#examiner_id").val(), question_id: $("#question_id").val(), achive_date: $("#achive_date").val(), section_id: $("#hide_section_id").val(), hide_id: $("#hide_id").val(), hide_user_id: $("#hide_user_id").val() }
      })
      .done(function( msg ) {
       detailsarr=msg.split('23432sdfg324');
       if(detailsarr[0]=='duplicate')
       {
         alert('Duplicate')
      }
      if(detailsarr[1]!='')
      {
         $('#printbadgh').html(detailsarr[1]);
      }

   }); 
   }
}

function edit_scoutprogram(delid, datefield,badgeid,qid,mid){
  $("#achive_date").val(datefield);
  $("#hide_id").val(delid);
  $("#scout_badge").val(badgeid);
  $("#examiner_id").val(mid);

  scout_badge_details_select(qid);

  $("#scout_badge").prop("disabled", false);
  $("#question_id").prop("disabled", false);
}

   // expertness 

   function get_scout_badge_expertness()
   {
      $.ajax({        
       method: "GET",
       url: "<?=base_url('program/program_badge_expertness/'.$id)?>",
       data: { scout_badge: $("#ex_scout_badge").val(), examiner_id: $("#ex_examiner_id").val(), expert_group_id: $("#expert_group_id").val(), achive_date: $("#ex_achive_date").val(), extra_badge: $("#extra_badge").val(), section_id: $("#ex_hide_section_id").val(), hide_id: $("#ex_hide_id").val(), hide_user_id: $("#ex_hide_user_id").val() }

    })
      .done(function( msg ) {
         detailsarr=msg.split('23432sdfg324');
         if(detailsarr[0]=='duplicate')
         {
            alert('Duplicate')
         }
         if(detailsarr[1]!='')
         {
            $('#printbadge_expertness').html(detailsarr[1]);
         }


         $("#ex_scout_badge").prop("disabled", false);
         $("#expert_group_id").prop("disabled", false);

         $("#ex_achive_date").val('');
         $("#ex_hide_id").val('');
         $("#ex_scout_badge").val('');
         $("#extra_badge").val('');
         $("#expert_group_id").val('');
         $("#ex_examiner_id").val('');


      }); 
   }
   function delete_scoutprogram_expertness(delid)
   {
      if(confirm('Are you sure you want to delete this data?'))
      {
         $.ajax({        
          method: "GET",
          url: "<?=base_url('program/program_badge_expertness/'.$id)?>",
          data: { delete_id: delid, scout_badge: $("#ex_scout_badge").val(), examiner_id: $("#ex_examiner_id").val(), expert_group_id: $("#expert_group_id").val(), achive_date: $("#ex_achive_date").val(), extra_badge: $("#extra_badge").val(), section_id: $("#ex_hide_section_id").val(), hide_id: $("#ex_hide_id").val(), hide_user_id: $("#ex_hide_user_id").val() }
       })
         .done(function( msg ) {
            detailsarr=msg.split('23432sdfg324');
            if(detailsarr[0]=='duplicate')
            {
               alert('Duplicate')
            }
            if(detailsarr[1]!='')
            {
               $('#printbadge_expertness').html(detailsarr[1]);
            }

         }); 
      }
   }
   function edit_scoutprogram__expertness(delid, datefield,badgeid,qid, ex_badge,mid)
   {
      $("#ex_achive_date").val(datefield);
      $("#ex_hide_id").val(delid);
      $("#ex_scout_badge").val(badgeid);
      $("#extra_badge").val(ex_badge);
     // $("#question_id").val(qid)
     $("#ex_examiner_id").val(mid);

     scout_badge_expert_group_select(qid);

     $("#ex_scout_badge").prop("disabled", false);
     $("#expert_group_id").prop("disabled", false);
  }

   // achievemen 

   function get_scout_badge_achievemen()
   {
      $.ajax({        
       method: "GET",
       url: "<?=base_url('program/program_badge_achievemen/'.$id)?>",
       data: { scout_badge: $("#achiev_scout_badge").val(), examiner_id: $("#achiev_examiner_id").val(),  achive_date: $("#achiev_achive_date").val(), section_id: $("#achiev_hide_section_id").val(), hide_id: $("#achiev_hide_id").val(), hide_user_id: $("#achiev_hide_user_id").val() }

    })
      .done(function( msg ) {
         detailsarr=msg.split('23432sdfg324');
         if(detailsarr[0]=='duplicate')
         {
            alert('Duplicate')
         }
         if(detailsarr[1]!='')
         {
            $('#printbadge_achievemen').html(detailsarr[1]);
         }


         $("#achiev_scout_badge").prop("disabled", false);

         $("#achiev_achive_date").val('');
         $("#achiev_hide_id").val('');
         $("#achiev_scout_badge").val('');
         $("#achiev_examiner_id").val('');


      }); 
   }
   function delete_scoutprogram_achievemen(delid)
   {
      if(confirm('Are you sure you want to delete this data?'))
      {
         $.ajax({        
          method: "GET",
          url: "<?=base_url('program/program_badge_achievemen/'.$id)?>",
          data: { delete_id: delid, scout_badge: $("#achiev_scout_badge").val(), examiner_id: $("#achiev_examiner_id").val(), achive_date: $("#achiev_achive_date").val(), section_id: $("#achiev_hide_section_id").val(), hide_id: $("#achiev_hide_id").val(), hide_user_id: $("#achiev_hide_user_id").val() }
       })
         .done(function( msg ) {
            detailsarr=msg.split('23432sdfg324');
            if(detailsarr[0]=='duplicate')
            {
               alert('Duplicate')
            }
            if(detailsarr[1]!='')
            {
               $('#printbadge_achievemen').html(detailsarr[1]);
            }

         }); 
      }
   }
   function edit_scoutprogram_achievemen(delid, datefield,badgeid,mid)
   {
      $("#achiev_achive_date").val(datefield);
      $("#achiev_hide_id").val(delid);
      $("#achiev_scout_badge").val(badgeid);
      $("#achiev_examiner_id").val(mid);
      
      $("#achiev_scout_badge").prop("disabled", false);
   }

   // Camping 

   function get_scout_badge_camping()
   {
      $.ajax({        
       method: "GET",
       url: "<?=base_url('program/program_badge_camping/'.$id)?>",
       data: { examiner_id: $("#camp_examiner_id").val(), area: $("#area").val(),  achive_date: $("#camp_achive_date").val(),camp_name: $("#camp_name").val(), camp_certificate_no: $("#camp_certificate_no").val(), section_id: $("#camp_hide_section_id").val(), hide_id: $("#camp_hide_id").val(), hide_user_id: $("#camp_hide_user_id").val() }

    })
      .done(function( msg ) {
         detailsarr=msg.split('23432sdfg324');
         if(detailsarr[0]=='duplicate')
         {
            alert('Duplicate')
         }
         if(detailsarr[1]!='')
         {
            $('#printbadge_camping').html(detailsarr[1]);
         }


         $("#camp_scout_badge").prop("disabled", false);

         $("#camp_achive_date").val('');
         $("#camp_hide_id").val('');
         $("#area").val('');
         $("#camp_name").val('');
         $("#camp_certificate_no").val('');
         $("#camp_examiner_id").val('');

      }); 
   }
   function delete_scoutprogram_camping(delid)
   {
      if(confirm('Are you sure you want to delete this data?'))
      {
         $.ajax({        
          method: "GET",
          url: "<?=base_url('program/program_badge_camping/'.$id)?>",
          data: { delete_id: delid, examiner_id: $("#camp_examiner_id").val(), area: $("#area").val(), achive_date: $("#camp_achive_date").val(), section_id: $("#camp_hide_section_id").val(), camp_name: $("#camp_name").val(), camp_certificate_no: $("#camp_certificate_no").val(), hide_id: $("#camp_hide_id").val(), hide_user_id: $("#camp_hide_user_id").val() }
       })
         .done(function( msg ) {
            detailsarr=msg.split('23432sdfg324');
            if(detailsarr[0]=='duplicate')
            {
               alert('Duplicate')
            }
            if(detailsarr[1]!='')
            {
               $('#printbadge_camping').html(detailsarr[1]);
            }

         }); 
      }
   }
   function edit_scoutprogram_camping(delid, datefield, area, camp_name, camp_certificate_no,mid)
   {
      $("#camp_achive_date").val(datefield);
      $("#camp_hide_id").val(delid);
      $("#area").val(area);
      $("#camp_name").val(camp_name);
      $("#camp_certificate_no").val(camp_certificate_no);
      $("#camp_examiner_id").val(mid);
      
      $("#camp_scout_badge").prop("disabled", false);
   }

   // Training 

   function get_scout_badge_training()
   {
      $.ajax({        
       method: "GET",
       url: "<?=base_url('program/program_badge_training/'.$id)?>",
       data: { scout_badge: $("#train_scout_badge").val(), examiner_id: $("#train_examiner_id").val(),  achive_date: $("#train_achive_date").val(),train_name: $("#train_name").val(), train_certificate_no: $("#train_certificate_no").val(), section_id: $("#train_hide_section_id").val(), hide_id: $("#train_hide_id").val(), hide_user_id: $("#train_hide_user_id").val() }

    })
      .done(function( msg ) {
         detailsarr=msg.split('23432sdfg324');
         if(detailsarr[0]=='duplicate')
         {
            alert('Duplicate')
         }
         if(detailsarr[1]!='')
         {
            $('#printbadge_training').html(detailsarr[1]);
         }


         $("#train_scout_badge").prop("disabled", false);

         $("#train_achive_date").val('');
         $("#train_hide_id").val('');
         $("#train_scout_badge").val('');
         $("#train_name").val('');
         $("#train_certificate_no").val('');
         $("#train_examiner_id").val('');

      }); 
   }
   function delete_scoutprogram_training(delid)
   {
      if(confirm('Are you sure you want to delete this data?'))
      {
         $.ajax({        
          method: "GET",
          url: "<?=base_url('program/program_badge_training/'.$id)?>",
          data: { delete_id: delid, scout_badge: $("#train_scout_badge").val(), examiner_id: $("#train_examiner_id").val(), achive_date: $("#train_achive_date").val(), section_id: $("#train_hide_section_id").val(), train_name: $("#train_name").val(), train_certificate_no: $("#train_certificate_no").val(), hide_id: $("#train_hide_id").val(), hide_user_id: $("#train_hide_user_id").val() }
       })
         .done(function( msg ) {
            detailsarr=msg.split('23432sdfg324');
            if(detailsarr[0]=='duplicate')
            {
               alert('Duplicate')
            }
            if(detailsarr[1]!='')
            {
               $('#printbadge_training').html(detailsarr[1]);
            }

         }); 
      }
   }
   function edit_scoutprogram_training(delid, datefield,badgeid, camp_name, camp_certificate_no, mid)
   {
      $("#train_achive_date").val(datefield);
      $("#train_hide_id").val(delid);
      $("#train_scout_badge").val(badgeid);
      $("#train_name").val(camp_name);
      $("#train_certificate_no").val(camp_certificate_no);
      $("#train_examiner_id").val(mid);
      
      $("#train_scout_badge").prop("disabled", false);
   }

   // health

   function get_scout_badge_health()
   {
      $.ajax({        
       method: "GET",
       url: "<?=base_url('program/program_badge_health/'.$id)?>",
       data: { examiner_id: $("#health_examiner_id").val(), health_years: $("#health_years").val(),  health_height: $("#health_height").val(),health_weight: $("#health_weight").val(), health_hand_size: $("#health_hand_size").val(), health_span: $("#health_span").val(),  health_heartbeat: $("#health_heartbeat").val(),health_temperature: $("#health_temperature").val(), health_chest_size: $("#health_chest_size").val(), section_id: $("#health_hide_section_id").val(), hide_id: $("#health_hide_id").val(), hide_user_id: $("#health_hide_user_id").val() }

    })
      .done(function( msg ) {
         detailsarr=msg.split('23432sdfg324');
         if(detailsarr[0]=='duplicate')
         {
            alert('Duplicate')
         }
         if(detailsarr[1]!='')
         {
            $('#printbadge_health').html(detailsarr[1]);
         }



         $("#health_years").val('');
         $("#health_height").val('');
         $("#health_weight").val('');
         $("#health_chest_size").val('');
         $("#health_span").val('');
         $("#health_hand_size").val('');
         $("#health_heartbeat").val('');
         $("#health_temperature").val('');
         $("#health_examiner_id").val('');

      }); 
   }
   function delete_scoutprogram_health(delid)
   {
      if(confirm('Are you sure you want to delete this data?'))
      {
         $.ajax({        
          method: "GET",
          url: "<?=base_url('program/program_badge_health/'.$id)?>",
          data: { delete_id: delid, examiner_id: $("#health_examiner_id").val(), health_years: $("#health_years").val(),  health_height: $("#health_height").val(),health_weight: $("#health_weight").val(), health_hand_size: $("#health_hand_size").val(), health_span: $("#health_span").val(),  health_heartbeat: $("#health_heartbeat").val(),health_temperature: $("#health_temperature").val(), health_chest_size: $("#health_chest_size").val(), section_id: $("#health_hide_section_id").val(), hide_id: $("#health_hide_id").val(), hide_user_id: $("#health_hide_user_id").val() }
       })
         .done(function( msg ) {
            detailsarr=msg.split('23432sdfg324');
            if(detailsarr[0]=='duplicate')
            {
               alert('Duplicate')
            }
            if(detailsarr[1]!='')
            {
               $('#printbadge_health').html(detailsarr[1]);
            }

         }); 
      }
   }
   function edit_scoutprogram_health(delid, health_years,health_height, health_weight, health_chest_size,health_span,health_hand_size,health_heartbeat,health_temperature, mid)
   {

      $("#health_hide_id").val(delid);
      $("#health_years").val(health_years);
      $("#health_height").val(health_height);
      $("#health_weight").val(health_weight);
      $("#health_chest_size").val(health_chest_size);
      $("#health_span").val(health_span);
      $("#health_hand_size").val(health_hand_size);
      $("#health_heartbeat").val(health_heartbeat);
      $("#health_temperature").val(health_temperature);
      $("#health_examiner_id").val(mid);
      
   }

   // institute

   function get_scout_badge_institute()
   {
      $.ajax({        
       method: "GET",
       url: "<?=base_url('program/program_badge_institute/'.$id)?>",
       data: { institute_years: $("#institute_years").val(),  examiner_id: $("#institute_examiner_id").val(), institute_class_name: $("#institute_class_name").val(),institute_roll_no: $("#institute_roll_no").val(), institute_total_unmber: $("#institute_total_unmber").val(), section_id: $("#institute_hide_section_id").val(), hide_id: $("#institute_hide_id").val(), hide_user_id: $("#institute_hide_user_id").val() }

    })
      .done(function( msg ) {
         detailsarr=msg.split('23432sdfg324');
         if(detailsarr[0]=='duplicate')
         {
            alert('Duplicate')
         }
         if(detailsarr[1]!='')
         {
            $('#printbadge_institute').html(detailsarr[1]);
         }



         $("#institute_years").val('');
         $("#institute_class_name").val('');
         $("#institute_roll_no").val('');
         $("#institute_total_unmber").val('');
         $("#institute_examiner_id").val('');

      }); 
   }
   function delete_scoutprogram_institute(delid)
   {
      if(confirm('Are you sure you want to delete this data?'))
      {
         $.ajax({        
          method: "GET",
          url: "<?=base_url('program/program_badge_institute/'.$id)?>",
          data: { delete_id: delid, institute_years: $("#institute_years").val(), examiner_id: $("#institute_examiner_id").val(),  institute_class_name: $("#institute_class_name").val(),institute_roll_no: $("#institute_roll_no").val(), institute_total_unmber: $("#institute_total_unmber").val(), section_id: $("#institute_hide_section_id").val(), hide_id: $("#institute_hide_id").val(), hide_user_id: $("#institute_hide_user_id").val() }
       })
         .done(function( msg ) {
            detailsarr=msg.split('23432sdfg324');
            if(detailsarr[0]=='duplicate')
            {
               alert('Duplicate')
            }
            if(detailsarr[1]!='')
            {
               $('#printbadge_institute').html(detailsarr[1]);
            }

         }); 
      }
   }
   function edit_scoutprogram_institute(delid, institute_years,institute_class_name, institute_roll_no, institute_total_unmber, mid)
   {

      $("#institute_hide_id").val(delid);
      $("#institute_years").val(institute_years);
      $("#institute_class_name").val(institute_class_name);
      $("#institute_roll_no").val(institute_roll_no);
      $("#institute_total_unmber").val(institute_total_unmber);
      $("#institute_examiner_id").val(mid);
      
   }institute



   // promotion 

   function get_scout_badge_promotion()
   {
      $.ajax({        
       method: "GET",
       url: "<?=base_url('program/program_badge_promotion/'.$id)?>",
       data: { scout_badge: $("#promotion_scout_badge").val(), examiner_id: $("#promotion_examiner_id").val(),  scout_role: $("#promotion_scout_role").val(), from_date: $("#promotion_from_date").val(),to_date: $("#promotion_to_date").val(), section_id: $("#promotion_hide_section_id").val(), hide_id: $("#promotion_hide_id").val(), hide_user_id: $("#promotion_hide_user_id").val() }

    })
      .done(function( msg ) {
         detailsarr=msg.split('23432sdfg324');
         if(detailsarr[0]=='duplicate')
         {
            alert('Duplicate')
         }
         if(detailsarr[1]!='')
         {
            $('#printbadge_promotion').html(detailsarr[1]);
         }


         $("#promotion_scout_badge").prop("disabled", false);
         $("#promotion_scout_role").prop("disabled", false);

         $("#promotion_from_date").val('');
         $("#promotion_to_date").val('');
         $("#promotion_scout_badge").val('');
         $("#promotion_scout_role").val('');
         $("#promotion_hide_id").val('');
         $("#promotion_examiner_id").val('');

      }); 
   }
   function delete_scoutprogram_promotion(delid)
   {
      if(confirm('Are you sure you want to delete this data?'))
      {
         $.ajax({        
          method: "GET",
          url: "<?=base_url('program/program_badge_promotion/'.$id)?>",
          data: { delete_id: delid, scout_badge: $("#promotion_scout_badge").val(), examiner_id: $("#promotion_examiner_id").val(), scout_role: $("#promotion_scout_role").val(), from_date: $("#promotion_from_date").val(),to_date: $("#promotion_to_date").val(), section_id: $("#promotion_hide_section_id").val(), hide_id: $("#promotion_hide_id").val(), hide_user_id: $("#promotion_hide_user_id").val() }
       })
         .done(function( msg ) {
            detailsarr=msg.split('23432sdfg324');
            if(detailsarr[0]=='duplicate')
            {
               alert('Duplicate')
            }
            if(detailsarr[1]!='')
            {
               $('#printbadge_promotion').html(detailsarr[1]);
            }

         }); 
      }
   }
   function edit_scoutprogram_promotion(delid, dateformfield,datetofield,badgeid, roleid,mid)
   {
      $("#promotion_from_date").val(dateformfield);
      $("#promotion_to_date").val(datetofield);
      $("#promotion_scout_badge").val(badgeid);
      $("#promotion_scout_role").val(roleid);
      $("#promotion_hide_id").val(delid);
      $("#promotion_examiner_id").val(mid);
      
      $("#promotion_scout_badge").prop("disabled", false);
      $("#promotion_scout_role").prop("disabled", false);
   }


    // resign 

    function get_scout_badge_resign()
    {
      $.ajax({        
       method: "GET",
       url: "<?=base_url('program/program_badge_resign/'.$id)?>",
       data: { resign_date: $("#resign_date").val(), examiner_id: $("#resign_examiner_id").val(), resign_reason: $("#resign_reason").val(), section_id: $("#resign_hide_section_id").val(), hide_id: $("#resign_hide_id").val(), hide_user_id: $("#resign_hide_user_id").val() }

    })
      .done(function( msg ) {
         detailsarr=msg.split('23432sdfg324');
         if(detailsarr[0]=='duplicate')
         {
            alert('Duplicate')
         }
         if(detailsarr[1]!='')
         {
            $('#printbadge_resign').html(detailsarr[1]);
         }


         $("#train_scout_badge").prop("disabled", false);

         $("#resign_date").val('');
         $("#resign_hide_id").val('');
         $("#resign_reason").val('');
         $("#resign_examiner_id").val('');


      }); 
   }
   function delete_scoutprogram_resign(delid)
   {
      if(confirm('Are you sure you want to delete this data?'))
      {
         $.ajax({        
          method: "GET",
          url: "<?=base_url('program/program_badge_resign/'.$id)?>",
          data: { delete_id: delid, resign_date: $("#resign_date").val(), examiner_id: $("#resign_examiner_id").val(), resign_reason: $("#resign_reason").val(), section_id: $("#resign_hide_section_id").val(), hide_id: $("#resign_hide_id").val(), hide_user_id: $("#resign_hide_user_id").val() }
       })
         .done(function( msg ) {
            detailsarr=msg.split('23432sdfg324');
            if(detailsarr[0]=='duplicate')
            {
               alert('Duplicate')
            }
            if(detailsarr[1]!='')
            {
               $('#printbadge_resign').html(detailsarr[1]);
            }

         }); 
      }
   }
   function edit_scoutprogram_resign(delid, datefield, reason,mid)
   {
      $("#resign_date").val(datefield);
      $("#resign_hide_id").val(delid);
      $("#resign_reason").val(reason);
      $("#resign_examiner_id").val(mid);
   }

   // All verify

   function verify_scoutprogram(verifyid,table,sl)
   {
      if(confirm('Are you sure you want to accept this data?'))
      {
         $.ajax({        
          method: "GET",
          url: "<?=base_url('program/verify_program/'.$id)?>",
          data: { verifyid: verifyid, verifytable:table, section_id: $("#resign_hide_section_id").val(), hide_id: $("#resign_hide_id").val(), hide_user_id: $("#resign_hide_user_id").val() }
       })
         .done(function( msg ) {
            if(sl==1){
               get_scout_badge_det();
            }
            if(sl==2){
               get_scout_badge_expertness();
            }
            if(sl==3){
               get_scout_badge_achievemen();
            }
            if(sl==4){
              get_scout_badge_camping();
           }
           if(sl==5){
            get_scout_badge_training();
         }
         if(sl==6){
            get_scout_badge_health();;
         }
         if(sl==7){
            get_scout_badge_institute();
         }
         if(sl==8){
            get_scout_badge_promotion();
         }
         if(sl==9){
            get_scout_badge_resign();
         }
      }); 
      }
   }
</script>

*/ ?>