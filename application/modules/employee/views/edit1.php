<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li><a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a></li>
         <li><a href="<?=base_url('award')?>" class="active"><?=$module_name?></a></li>
         <li><?=$meta_title; ?></li>
      </ul>
      <style type="text/css">
         #memberDiv td{padding: 5px;}
         #memberDiv th{padding: 5px; font-weight: bold; color: black;}
         #workStationDiv td{padding: 5px;}
      </style>

      <?php
      $exam_data = '';
      foreach ($exams as $key => $value) {
         $exam_data .= '<option value="'.$key.'">'.$value.'</option>';
      }
      ?>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">                
                     <a href="<?=base_url('pds/pds_list')?>" class="btn btn-blueviolet btn-xs btn-mini"> PDS List</a>  
                  </div>
               </div>
               <div class="grid-body">
                  <?php echo validation_errors(); ?>
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>
                  
                  <?php 
                  $attributes = array('id' => 'validate');
                  echo form_open_multipart(uri_string(), $attributes);
                  ?>
                  
                  <div class="row">
                     <h4 class="margin_left_15 semi-bold">Personal Information</h4>
                     <div class="col-md-12">
                        <div class="row form-row">
                           <div class="col-md-3">
                              <label class="form-label">Full Name (English) <span class='required'>*</span></label>
                              <?php echo form_error('name_en'); ?>
                              <input type="text" name="name_en" class="form-control input-sm" value="<?=set_value('name_en', $info->name_en)?>">
                           </div>
                           <div class="col-md-3">
                              <label class="form-label">Full Name (Bangla) <span class='required'>*</span></label>
                              <?php echo form_error('name_bn'); ?>
                              <input type="text" name="name_bn" class="bangla form-control input-sm" value="<?=set_value('name_bn', $info->name_bn)?>" contenteditable="TRUE">
                           </div>
                           <div class="col-md-2">
                              <label class="form-label">Date of Birth <span class='required'>*</span></label>
                              <?php echo form_error('dob');?>
                              <input type="text" name="dob" class="datetime form-control input-sm" value="<?=set_value('dob', date_browse_format($info->dob))?>">
                           </div>
                           <div class="col-md-2">
                              <label class="form-label">Gender <span class='required'>*</span></label>
                              <?php echo form_error('gender'); ?>
                              <input type="radio" name="gender" value="Male" <?=set_value('gender', $info->gender)=='Male'?'checked':'checked';?>> <span style="color: black; font-size: 14px;">Male</span> 
                              <input type="radio" name="gender" value="Female" <?=set_value('gender', $info->gender)=='Female'?'checked':'';?>> <span style="color: black; font-size: 14px;">Female</span>
                           </div>
                           <div class="col-md-2">
                              <label class="form-label">Blood Group</label>
                              <?php echo form_error('bg_id');
                              $more_attr = 'class="form-control input-sm" ';
                              echo form_dropdown('bg_id', $blood_group, set_value('bg_id', $info->bg_id), $more_attr);
                              ?>
                           </div>
                        </div>

                        <div class="row form-row">
                           <div class="col-md-3">
                              <label class="form-label">Father's Name <span class='required'>*</span></label>
                              <?php echo form_error('father_name'); ?>
                              <input type="text" name="father_name" class="form-control input-sm" value="<?=set_value('father_name', $info->father_name)?>">
                           </div>
                           <div class="col-md-3">
                              <label class="form-label">Mother's Name <span class='required'>*</span></label>
                              <?php echo form_error('mother_name'); ?>
                              <input type="text" name="mother_name"  class="form-control input-sm" value="<?=set_value('mother_name', $info->mother_name)?>">
                           </div>
                           <div class="col-md-2">
                              <label class="form-label">Mobile No. <span class='required'>*</span></label>
                              <?php echo form_error('phone'); ?>
                              <input name="phone" value="<?=set_value('phone', $info->phone)?>" type="text" class="form-control input-sm" placeholder="">
                           </div>
                           <div class="col-md-2">
                              <label class="form-label">Email Address</label>
                              <?php echo form_error('email'); ?>
                              <input name="email" value="<?=set_value('email', $info->email)?>" type="text" class="form-control input-sm" placeholder="">
                           </div>
                           <div class="col-md-2">
                              <label class="form-label">Religion <span class='required'>*</span></label>
                              <?php echo form_error('religion_id');
                              $more_attr = 'class="form-control input-sm"';
                              echo form_dropdown('religion_id', $religions, set_value('religion_id', $info->religion_id), $more_attr);
                              ?>
                           </div>
                        </div>

                        <div class="row form-row">
                           <div class="col-md-2">
                              <label class="form-label">Passport No </label>
                              <input type="text" name="passport_no"  class="form-control input-sm" value="<?=set_value('passport_no', $info->passport_no)?>">
                           </div>                           
                           <div class="col-md-2">
                              <label class="form-label">P. Issue Date </label>
                              <input type="text" name="passport_issue"  class="datetime form-control input-sm" value="<?=set_value('passport_issue', date_browse_format($info->passport_issue))?>">
                           </div>
                           <div class="col-md-2">
                              <label class="form-label">P. Expire Date </label>
                              <input type="text" name="passport_expire"  class="datetime form-control input-sm" value="<?=set_value('passport_expire', date_browse_format($info->passport_expire))?>">
                           </div>
                           
                           <div class="col-md-2">
                              <label class="form-label">Marital Status</label>
                              <?php echo form_error('ms_id');
                              $more_attr = 'class="form-control input-sm" ';
                              echo form_dropdown('ms_id', $marital_status, set_value('ms_id', $info->ms_id), $more_attr);
                              ?>
                           </div>
                           <div class="col-md-3">
                              <label class="form-label">Spous Name</label>
                              <?php echo form_error('spous_name'); ?>
                              <input type="text" name="spous_name"  class="form-control input-sm" value="<?=set_value('spous_name', $info->spous_name)?>">
                           </div>
                           <div class="col-md-1">
                              <label class="form-label">Child No</label>
                              <?php echo form_error('child_no'); ?>
                              <input type="number" name="child_no"  class="form-control input-sm" value="<?=set_value('child_no', $info->child_no)?>">
                           </div>

                        </div>

                        <div class="row form-row">
                           <div class="col-md-4">
                              <label class="form-label">Present Address <span class='required'>*</span></label>
                              <?php echo form_error('present_address'); ?>
                              <textarea name="present_address" class="form-control" rows="2"><?=set_value('present_address', $info->present_address)?></textarea>
                           </div>
                           <div class="col-md-4">
                              <label class="form-label">Permanent Address <span class='required'>*</span></label>
                              <?php echo form_error('permanent_address'); ?>
                              <textarea name="permanent_address" class="form-control" rows="2"><?=set_value('permanent_address', $info->permanent_address)?></textarea>
                           </div>
                           <div class="col-md-4">  
                              <?php
                              $path = base_url().'employee_img/';
                              if($info->image_file != NULL){
                                 $img_url = '<img src="'.$path.$info->image_file.'" width="90" style="border:1px solid #ccc; padding:3px;">';
                              }else{
                                 $img_url = '<img src="'.$path.'no-image.jpg" width="90" style="border:1px solid #ccc; padding:3px;">';
                              }
                              echo $img_url;
                              ?>
                              <div class="form-group">
                                 <label>Employee Image</label>
                                 <div><?php echo form_error('userfile'); ?></div>
                                 <input type="file" name="userfile">
                              </div>
                           </div>
                        </div>

                        <div class="row form-row">
                           <div class="col-md-2">
                              <label class="form-label">Joining Date </label>
                              <input type="text" name="join_date" class="datetime form-control input-sm" value="<?=set_value('join_date', date_browse_format($info->join_date))?>">
                           </div>
                           <div class="col-md-2">
                              <label class="form-label">Official ID Type <span class='required'>*</span></label>
                              <?php echo form_error('type'); ?>
                              <input type="radio" name="type" value="1" <?=set_value('type', $info->type)==1?'checked':'checked';?>> <span style="color: black; font-size: 14px;">Professional</span> <br>
                              <input type="radio" name="type" value="2" <?=set_value('type', $info->type)==2?'checked':'';?>> <span style="color: black; font-size: 14px;">Volunteer</span>
                           </div>
                           <div class="col-md-3">
                              <label class="form-label">Current Working Area <span class='required'>*</span></label>
                              <input type="text" name="current_working_area" class="form-control input-sm" value="<?=set_value('current_working_area', $info->current_working_area)?>">
                           </div>
                           <div class="col-md-3">
                              <label class="form-label">Current Designation <span class='required'>*</span></label>
                              <input type="text" name="current_desig" class="form-control input-sm" value="<?=set_value('current_desig', $info->current_desig)?>">
                           </div>
                           <div class="col-md-2">
                              <label class="form-label">Scout ID </label>
                              <input type="text" name="scout_id" class="form-control input-sm" value="<?=set_value('scout_id', $info->scout_id)?>" style="text-transform: uppercase;">
                           </div>
                        </div>
                        <div class="row form-row">
                           <div class="col-md-4">
                              <label class="form-label">Contribution to scouts </label>
                              <?php echo form_error('contirbutions'); ?>
                              <textarea name="contirbutions" class="form-control" rows="2"><?=set_value('child_no', $info->contirbutions)?></textarea>
                           </div>
                           <div class="col-md-4">
                              <label class="form-label">Hobby & Specialty Area </label>
                              <?php echo form_error('hobby'); ?>
                              <textarea name="hobby" class="form-control" rows="2"><?=set_value('child_no', $info->hobby)?></textarea>
                           </div>
                        </div>

                         <!-- <div class="row form-row">
                           <div class="col-md-12">
                              <label class="form-label">সাইটেশন </label>
                              <?php echo form_error('citesion'); ?>
                              <textarea name="citesion" class="form-control" rows="2"><?=set_value('child_no')?></textarea>
                           </div>
                        </div> -->

                     </div> <!-- col-md-12 -->



                     <div class="col-md-12" >
                        <h4 class="semi-bold">Educational Information</h4>
                        <div id="msgEducation"> </div>
                        <table width="100%" border="1" id="memberDiv">
                           <tr>
                              <td width="25%">Education / Exam</td>
                              <td width="50%">Institute / University / Board</td>
                              <td width="15%">Result</td>
                              <td width="15%">Passing Year</td>
                              <td width="10%"> <a href="javascript:void();" id="addRow" class="label label-success"> <i class="fa fa-plus-circle"></i> Add More</a> </td>
                           </tr>
                           <?php foreach ($education as $row) { ?>
                           <tr>
                              <td><?php 
                                 $more_attr = 'class="form-control input-sm"';
                                 echo form_dropdown('exam_id[]', $exams, set_value('exam_id', $row->exam_id), $more_attr); ?>                                
                              </td>
                              <td><input type="text" name="institute_board[]" value="<?=$row->institute_board?>" class="form-control input-sm"></td>
                              <td><input type="text" name="result[]" value="<?=$row->result?>" class="form-control input-sm"></td>
                              <td><input type="number" name="pass_year[]" value="<?=$row->pass_year?>" class="form-control input-sm"></td>
                              <td width="100"> <a href="javascript:void();" data-id="<?=$row->id?>" onclick="removeRowEducationFunc(this)" class="label label-important"> <i class="fa fa-minus-circle"></i> Remove</a> </td>
                              <input type="hidden" name="hide_exam_id[]" value="<?=$row->id?>">
                           </tr>
                           <?php } ?>
                           <tr></tr>
                        </table>
                     </div>

                     <div class="col-md-12" >
                        <h4 class="semi-bold">Working Station Information</h4>
                        <div id="msgWorkStation"> </div>
                        <table width="100%" border="1" id="workStationDiv">
                           <tr>
                              <td width="50%">Working Place</td>
                              <td width="20%">Served As</td>
                              <td width="15%">From Date</td>
                              <td width="15%">To Date</td>
                              <td width="10%"> <a href="javascript:void();" id="addWorkStation" class="label label-success"> <i class="fa fa-plus-circle"></i> Add More</a> </td>
                           </tr>
                           <?php foreach ($work_station as $row) { ?>
                           <tr>
                              <td><input type="text" name="working_place[]" value="<?=$row->working_place?>" class="form-control input-sm"></td>
                              <td><input type="text" name="designation[]" value="<?=$row->designation?>" class="form-control input-sm"></td>
                              <td><input type="text" name="date_from[]" value="<?=$row->date_from != NULL ? date_browse_format($row->date_from):'';?>" class="datetime form-control input-sm"></td>
                              <td><input type="text" name="date_to[]" value="<?=$row->date_to != NULL ? date_browse_format($row->date_to):'';?>" class="datetime form-control input-sm"></td>
                              <td width="100"> <a href="javascript:void();" data-id="<?=$row->id?>" onclick="removeRowWorkStationFunc(this)" class="label label-important"> <i class="fa fa-minus-circle"></i> Remove</a> </td>
                              <input type="hidden" name="hide_work_station_id[]" value="<?=$row->id?>">
                           </tr>
                           <?php } ?>
                           <tr></tr>
                        </table>
                     </div>

                  </div> <!-- /row -->


                  <div class="form-actions">  
                     <div class="pull-right">
                        <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Save</button>
                     </div>
                  </div>
                  <?php echo form_close();?>

               </div>  <!-- END GRID BODY -->              
            </div> <!-- END GRID -->
         </div>

      </div> <!-- END ROW -->

   </div>
</div>


<script type="text/javascript">

   $(document).ready(function() {

      $('#validate').validate({
         // focusInvalid: false, 
         ignore: "",
         rules: {
            name_en: { required: true },
            name_bn: { required: true },
            dob: { required: true },
            father_name: { required: true },
            mother_name: { required: true },
            phone: { required: true },
            religion_id: { required: true },
            join_date: { required: true },
            current_desig: { required: true }
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
            form.submit();
         }
      });

   });   



   // Education
   $("#addRow").click(function(e) {
      var items = '';
      items+= '<tr>';        
      items+= '<td><select class="input-sm" name="exam_id[]"><?php echo $exam_data;?></select></td>';
      items+= '<td><input type="text" name="institute_board[]" class="form-control input-sm"></td>';
      items+= '<td><input type="text" name="result[]" class="form-control input-sm"></td>';
      items+= '<td><input type="number" name="pass_year[]" class="form-control input-sm"></td>';
      items+= '<td><a href="javascript:void();" class="label label-important" onclick="removeRow(this)"> <i class="fa fa-minus-circle"></i> Remove </a></td>';
      items+= '</tr>';
      
      $('#memberDiv tr:last').after(items);
   });

   function removeRow(id){ 
      $(id).closest("tr").remove();
   }

   function removeRowEducationFunc(id){ 
      var dataId = $(id).attr("data-id");

      if (confirm("Are you sure you want to delete this information from database?") == true) {
         $.ajax({
          type: "POST",
          url: hostname+"pds/ajax_pds_education_del/"+dataId,
          success: function (response) {
            $("#msgEducation").addClass('alert alert-success').html(response);
            $(id).closest("tr").remove();
         }
      });
      }
   }

   // Working Station
   $("#addWorkStation").click(function(e) {
      var items = '';
      items+= '<tr>';        
      items+= '<td><input type="text" name="working_place[]" class="form-control input-sm"></td>';
      items+= '<td><input type="text" name="designation[]" class="form-control input-sm"></td>';
      items+= '<td><input type="text" name="date_from[]" class="datetime form-control input-sm"></td>';
      items+= '<td><input type="text" name="date_to[]" class="datetime form-control input-sm"></td>';
      items+= '<td><a href="javascript:void();" class="label label-important" onclick="removeRowWorkStation(this)"> <i class="fa fa-minus-circle"></i> Remove </a></td>';
      items+= '</tr>';
      
      $('#workStationDiv tr:last').after(items);
      datetime();
   });

   function removeRowWorkStation(id){ 
      $(id).closest("tr").remove();
   }

   function removeRowWorkStationFunc(id){ 
      var dataId = $(id).attr("data-id");

      if (confirm("Are you sure you want to delete this information from database?") == true) {
         $.ajax({
          type: "POST",
          url: hostname+"pds/ajax_pds_work_station_del/"+dataId,
          success: function (response) {
            $("#msgWorkStation").addClass('alert alert-success').html(response);
            $(id).closest("tr").remove();
         }
      });
      }
   }



</script>  