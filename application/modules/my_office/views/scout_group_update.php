<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('my_office')?>" class="active"><?=$module_name?> </a> </li>
         <li><?=$meta_title; ?></li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">                
                     <a href="<?=base_url('my_office')?>" class="btn btn-blueviolet btn-xs btn-mini"> My Office</a>                       
                  </div>
               </div>
               <div class="grid-body">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>
                  <?php 
                  $attributes = array('id' => 'scout_group_update_validate');
                  echo form_open_multipart(uri_string(), $attributes);?>
                  
                  <div class="row">
                     <h4 class="semi-bold margin_left_15">Scouts Group Office Information</h4>
                     <hr>
                     <div class="col-md-7">

                        <div class="row form-row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="form-label">স্কাউট গ্রুপের ধরণ</label><br>
                                 <?php echo form_error('grp_type'); ?>
                                 <input type="radio" class="controlled" name="grp_type" id="grpTypeCtrl" value="1" <?=set_value('grp_type', $info->grp_type)==1?'checked':'';?>> নিয়ন্ত্রিত স্কাউট গ্রুপ
                                 <input type="radio" class="open" name="grp_type" id="grpTypeClose" value="2" <?=set_value('grp_type', $info->grp_type)==2?'checked':'';?>> মুক্ত স্কাউট গ্রুপ
                                 <div id="typeerror"></div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <label class="form-label"> Search and Select Group Leader </label>
                              <?php echo form_error('grp_leader');?>
                              <select class="scoutIDselect2 form-control" name="grp_leader" id="grp_leader"></select>
                              <?php
                              if($info->grp_leader){
                                 $groupLeader = $info->scout_id .' ('.$info->first_name.')';
                              }else{
                                 $groupLeader = '-- Select Scout ID --';
                              }
                              ?>
                              <script>
                                 var $newOption = $("<option></option>").val("<?php echo $info->grp_leader;?>").text("<?php echo $groupLeader;?>");
                                 $("#grp_leader").append($newOption).trigger('change');
                              </script>
                           </div>
                        </div>

                        <div class="row form-row" id="groupWrap">
                           <div class="col-md-12">
                              <label class="form-label"> Search and Select Institute <span class="required">*</span></label>
                              <?php echo form_error('grp_institute_id'); ?>
                              <select class="instituteSelect2 form-control" name="grp_institute_id" id="grp_institute_id" style="width: 100%"></select>                              
                              <script>
                                var $newOption = $("<option></option>").val("<?php echo $info->grp_institute_id;?>").text("<?php echo $info->institute_name;?>");
                                $("#grp_institute_id").append($newOption).trigger('change');
                             </script>
                          </div>
                       </div>

                       <div class="row form-row">
                        <div class="col-md-12">
                           <label class="form-label"> Scout Group Name (English) <span class="required">*</span></label>
                           <?php echo form_error('grp_name');?>
                           <input name="grp_name" id="grp_name" value="<?=set_value('grp_name', $info->grp_name)?>" type="text" class="form-control input-sm" placeholder="">
                        </div>
                     </div>

                     <div class="row form-row">
                           <div class="col-md-12">
                              <label class="form-label"> Scout Group Name (বাংলা) <span class="required">*</span></label>
                              <?php echo form_error('grp_name_bn');?>
                              <input name="grp_name_bn" id="grp_name_bn" value="<?=set_value('grp_name_bn', $info->grp_name_bn)?>" type="text" class="bangla form-control input-sm" placeholder="" contenteditable="TRUE">
                           </div>
                        </div>

                     <div class="row form-row">
                        <div class="col-md-4">
                           <label class="form-label">Mobile No.</label>
                           <?php echo form_error('grp_mobile'); ?>
                           <input name="grp_mobile" id="grp_mobile" value="<?=set_value('grp_mobile', $info->grp_mobile)?>" type="text" class="form-control input-sm" placeholder="">
                        </div>
                        <div class="col-md-4">
                           <label class="form-label">Email</label>
                           <?php echo form_error('grp_email'); ?>
                           <input name="grp_email" id="grp_email" value="<?=set_value('grp_email', $info->grp_email)?>" type="text" class="form-control input-sm" placeholder="">
                        </div> 
                        <div class="col-md-4">
                           <label class="form-label">Office Address  (Bangla)</label>
                           <?php echo form_error('grp_address'); ?>
                           <input name="grp_address" value="<?=set_value('grp_address', $info->grp_address)?>" type="text" class="form-control input-sm" placeholder="">
                        </div>

                        <div class="col-md-4">
                           <label class="form-label">Office Address (English)</label>
                           <?php echo form_error('grp_address_en'); ?>
                           <input name="grp_address_en" value="<?=set_value('grp_address_en', $info->grp_address_en)?>" type="text" class="form-control input-sm" placeholder="">
                        </div>
                     </div>

                     <div class="row form-row">                
                        <div class="col-md-12">
                           <label class="form-label">Remarks / Note</label>
                           <?php echo form_error('grp_remarks'); ?>
                           <textarea name="grp_remarks" class="form-control"><?=set_value('grp_remarks', $info->grp_remarks)?></textarea>
                        </div> 
                     </div>

                  </div>

                  <div class="col-md-5">
                     <div class="row form-row">
                        <div class="col-md-12">                                                         
                           <label class="form-label">Scouts Region </label>
                           <h4><?=$region_info->region_name?></h4>                           
                        </div>
                     </div>

                     <div class="row form-row">
                        <div class="col-md-7">
                           <label class="form-label"> Charter Number </label>
                           <?php echo form_error('grp_charter');?>
                           <input name="grp_charter" id="grp_charter" value="<?=set_value('grp_charter', $info->grp_charter)?>" type="text" class="form-control input-sm" placeholder="">
                        </div>                           
                        <div class="col-md-5">
                           <label class="form-label"> Created Date </label>
                           <?php echo form_error('grp_created');?>
                           <input name="grp_created" id="grp_created" value="<?=set_value('grp_created', date_bangla_format($info->grp_created))?>" type="text" class="form-control input-sm datetime" placeholder="DD-MM-YYYY">
                        </div>                           
                     </div>

                     <div class="row form-row">
                        <div class="col-md-12">                          
                           <label class="form-label">Scouts District</label>
                           <h4><?=$district_info->dis_name?></h4>                           
                        </div>
                     </div>

                        <div class="row form-row">
                           <div class="col-md-7">
                              <?php echo form_error('grp_reg_num_dis');?>
                              <input name="grp_reg_num_dis" value="<?=set_value('grp_reg_num_dis', $info->grp_reg_num_dis)?>" type="text" class="form-control input-sm" placeholder="District Registration Number">
                           </div>
                           <div class="col-md-5">
                              <input name="grp_reg_dis_date" value="<?=set_value('grp_reg_dis_date', date_bangla_format($info->grp_reg_dis_date))?>" type="text" class="form-control input-sm datetime" placeholder="DD-MM-YYYY">
                           </div> 
                        </div>

                        <div class="row form-row">
                           <div class="col-md-12">                              
                              <label class="form-label">Scout Upazila</label>
                              <h4><?=$upazila_info->upa_name?></h4>
                           </div>
                        </div>

                        <div class="row form-row">
                           <div class="col-md-7">
                              <input name="grp_reg_num_upa" value="<?=set_value('grp_reg_num_upa', $info->grp_reg_num_upa)?>" type="text" class="form-control input-sm" placeholder="Upazila Registration Number">
                           </div>
                           <div class="col-md-5">
                              <input name="grp_reg_upa_date" value="<?=set_value('grp_reg_upa_date', date_bangla_format($info->grp_reg_upa_date))?>" type="text" class="form-control input-sm datetime" placeholder="DD-MM-YYYY">
                           </div>                         
                        </div> 
                     </div>
                  </div>

                  <div class="row" style="margin-bottom: 30px;">
                     <div id="scoutsUnit"></div>
                     <h4 class="semi-bold margin_left_15">Scouts Unit Modify <em style="color: #f73838; font-size: 15px;">Minimum 1 unit must be created. Click Add More or Remove button for modifying multiple units. </em></h4>
                     <hr>
                     <style type="text/css">
                        #unitRowDiv td{padding: 5px; border-color: #ccc;}
                        #unitRowDiv th{padding: 5px;text-align:center;border-color: #ccc; color: black;}                        
                     </style>
                     <?php
                        $unit_type = '';
                        foreach ($sc_unit_types as $key => $value) {      
                           $unit_type .= '<option value="'.$key.'">'.$value.'</option>';   
                        }
                     ?>
                     <div class="col-md-12" >
                        <div id="msgMember"> </div>
                        <table width="100%" border="1" id="unitRowDiv" style="border:1px solid #a09e9e;">
                           <tr>
                              <!-- <td>Member Name</td> -->
                              <th width="40%">Unit Name (English) <span class="required">*</span></th>
                              <th width="40%">Unit Name (Bangla) <span class="required">*</span></th>
                              <th width="12%">Unit Type <span class="required">*</span></th>
                              <th width="8%"> <a href="javascript:void();" id="addRow"  class="label label-success"> <i  class="fa fa-plus-circle"></i> Add More</a> </th>
                           </tr>
                           <?php foreach ($scout_units as $row) { ?>
                              <tr>
                                 <td><input name="unit_name[]" value="<?=set_value('unit_name', $row->unit_name)?>" type="text" class="form-control input-sm" placeholder="Ex: Mohammadpur Govt. Primary School Cub Scout Unit - 1"></td>
                                 <td><input name="unit_name_bn[]" value="<?=set_value('unit_name_bn', $row->unit_name_bn)?>" type="text" class="form-control input-sm bangla" placeholder="উদাঃ- মোহাম্মদপুর উচ্চ বিদ্যালয় কাব স্কাউটস ইউনিট - ১" contenteditable="TRUE"></td>
                                 <td>
                                    <?php 
                                      $more_attr = 'style="width:35mm; min-height: 25px;"';
                                      echo form_dropdown('unit_type[]', $sc_unit_types, set_value('unit_type', $row->unit_type), $more_attr); ?>
                                 </td>
                                 <td>
                                    <input type="hidden" name="hide_unit_id[]" value="<?=encrypt_url($row->id)?>">
                                    <a href="javascript:void();" data-id="<?=encrypt_url($row->id)?>" onclick="removeRowUnit(this)" class="label label-important"> <i class="fa fa-minus-circle"></i> Remove</a>
                                 </td>
                              </tr>
                           <?php } ?>
                           <tr></tr>
                        </table>
                     </div>
                  </div>

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

   //Radio button selected
   // $(function() {
   //    var $radios = $('input:radio[name=grp_type]');
   //    if($radios.is(':checked') === false) {
   //       $radios.filter('[value=1]').prop('checked', true);
   //    }
   // });
   
   // Group Type Hide/Show
   $(".controlled").click(function(){      
      group_controlled();
   });   

   function group_controlled(){
      $("#groupWrap").show();
   }
   
   $(".open").click(function(){
      group_open();
   });

   function group_open(){
      $("#groupWrap").hide();
   }

   $("#region").change(function(){
      sc_registration_no();
   });

   function sc_registration_no(){
      var selected_option = $('#region').val();
      if((selected_option == '10') || (selected_option == '11') || (selected_option == '12') || (selected_option == '13')){
         // alert(selected_option);
         // $("#district_reg_no").after("<input id='fnivel2' pk='1'/>")
         $("#district_reg_no").show();
         $("#upazila_reg_no").hide();
      }else{
         $("#district_reg_no").hide();
         $("#upazila_reg_no").show();
      }
   }   




   $(document).ready(function() {
      //Load First row
      <?php if(!$scout_units){ ?> 
      addNewRow();
      <?php } ?>

      // Body load 
      group_controlled();
      group_open();
      if(document.getElementById("grpTypeCtrl").checked == true){
         // alert(document.getElementById("grpTypeCtrl").value);
         $("#groupWrap").show();
      }else{
         $("#groupWrap").hide();
      }
      // if(document.getElementById("grpTypeClose").value == 2){
      //    $("#groupWrap").hide();
      // }
      sc_registration_no();

      //Validation
      $('#scout_group_update_validate').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
         grp_type: {
            required: true
         },         
         grp_name: {
            required: true,
            minlength: 10
         },
         grp_name_bn: {
            required: true,
            minlength: 10
         },
         grp_div_id: {
            required: true
         },
         grp_dis_id: {
            required: true
         },         
         grp_created: {
            required: false
         },
         grp_email: {
            email: true
         },
         grp_region_id: {
            required: true
         },
         grp_scout_dis_id: {
            required: true
         },
         'unit_name[]': {
            required: true
         },
         'unit_name_bn[]': {
            required: true
         },
         'unit_type[]': {
            required: true
         } 
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


   // Add multiple unit
   $("#addRow").click(function(e) {
      addNewRow();
   }); 
   //remove row
   function removeRow(id){ 
      $(id).closest("tr").remove();
   }
   //add row function
   function addNewRow(){
      var items = '';
         items+= '<tr>';
         items+= '<td><input name="unit_name[]" value="<?=set_value('unit_name')?>" type="text" class="form-control input-sm" placeholder="Ex: Mohammadpur Govt. Primary School Cub Scout Unit - 1"></td>';
         items+= '<td><input name="unit_name_bn[]" value="<?=set_value('unit_name_bn')?>" type="text" class="form-control input-sm bangla" placeholder="উদাঃ- মোহাম্মদপুর উচ্চ বিদ্যালয় কাব স্কাউটস ইউনিট - ১" contenteditable="TRUE"></td>';
         items+= '<td><select style="width:35mm; min-height: 25px;" name="unit_type[]"><?php echo $unit_type;?></select></td>';
         items+= '<td> <a href="javascript:void();" class="label label-important" onclick="removeRow(this)"> <i class="fa fa-minus-circle"></i> Remove </a></td>';
         items+= '</tr>';

      $('#unitRowDiv tr:last').after(items);
      //scout_id_select2_dd();
    }

   function removeRowUnit(id){ 
      var dataId = $(id).attr("data-id");
      // alert(dataId);

      var txt;
      if (confirm("Are you want to delete unit from the database?") == true) {
         $.ajax({
            type: "POST",
            url: hostname+"offices/ajax_office_unit_del/"+dataId,
            success: function (response) {
              $("#msgMember").addClass('alert alert-success').html(response);
              $(id).closest("tr").remove();
            }
         });
      }
   }
</script>