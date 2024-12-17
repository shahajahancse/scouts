<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('offices/scout_group')?>" class="active"><?=$module_name?> </a> </li>
         <li><?=$meta_title; ?></li>
      </ul>

      <style type="text/css">
         .tg  {border-collapse:collapse;border-spacing:0;}
         .tg td{font-family:Arial, sans-serif;font-size:14px;padding:3px 10px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border:0 solid #ccc;}
         .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:3px 10px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border:0 solid #ccc; font-weight: bold; vertical-align: top}
         .tg .tg-9vst{background-color:#efefef;text-align:right;}
      </style>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin()){ ?>
                  <div class="pull-right">                
                     <!-- <a href="<?=base_url('offices/scout_group')?>" class="btn btn-blueviolet btn-xs btn-mini"> Scouts Group List</a>   -->
                  </div>
                  <?php } ?>
               </div>
               <div class="grid-body">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>
                  <?php 
                  $attributes = array('id' => 'scout_group_validate');
                  echo form_open_multipart("scout_group_application/scout_group_create/".encrypt_url($info->id), $attributes);?>

                  <div class="row">
                     <div class="col-md-6">
                        <div class="row form-row">
                           <h4 class="semi-bold margin_left_15">Create scouts group username and password <br><em style="color: #f73838; font-size: 12px;">(Username should be short, Ex- ga_shortname)</em></h4>
                           <hr>
                           <div class="col-md-6">
                              <label class="form-label">Username <span class="required">*</span> <span style="margin-left: 20px; color: black; font-weight: bold;"><span id="mask_username"></span></span></label> 
                              <?php echo form_error('identity'); ?>                      
                              <?php echo form_input($identity)?> 
                           </div>
                           <div class="col-md-6">
                              <label class="form-label">Password <span class="required">*</span></label>
                              <?php echo form_error('password'); ?>
                              <?php echo form_input($password)?> 
                           </div>
                           <div class="col-md-12">
                              <label class="form-label">Remarks / Note</label>
                              <?php echo form_error('grp_remarks'); ?>
                              <textarea name="grp_remarks" class="form-control"><?=set_value('grp_remarks')?></textarea>
                           </div> 

                           <?php /*
                           <div class="row form-row">
                              <div class="col-md-12">
                                 <label class="form-label">Select Institute (Search Name or EIIN Number)  </label>
                                 <?php echo form_error('grp_institute_id');?>
                                 <select class="instituteSelect2 form-control" name="grp_institute_id"></select>
                              </div>
                           </div>
                           */ ?>
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="scout-verify-box">
                           <h4 style="font-weight: bold; border-bottom: 1px solid #ccc;"> Application Information</h4>
                           <table class="tg">
                              <tr>
                                 <th class="tg-9vst" width="180">স্কাউট গ্রুপের ধরণ:</th>
                                 <td class="tg-031e">
                                    <?php
                                    if($info->grp_type == 1){
                                       echo 'নিয়ন্ত্রিত স্কাউট গ্রুপ';
                                    }else{
                                       echo 'মুক্ত স্কাউট গ্রুপ ';
                                    }
                                    ?>
                                 </td>
                              </tr>
                              <?php if($info->grp_type == 1){ ?>
                              <tr>
                                 <th class="tg-9vst">প্রতিষ্ঠানের নাম:</th>
                                 <td class="tg-031e"><?=$info->institute_name?></td>
                              </tr> 
                              <?php } ?>
                              <tr>
                                 <th class="tg-9vst">দল / গ্রুপের নাম (Bn):</th>
                                 <td class="tg-031e"><?=$info->grp_name_bn?></td>
                              </tr>
                              <tr>
                                 <th class="tg-9vst">দল / গ্রুপের নাম (En):</th>
                                 <td class="tg-031e"><?=$info->grp_name_en?></td>
                              </tr>
                              <tr>
                                 <th class="tg-9vst">গ্রুপ অফিসের ঠিকানা:</th>
                                 <td class="tg-031e"><?=$info->grp_address?></td>
                              </tr>
                              <tr>
                                 <th class="tg-9vst">মোবাইল নম্বর:</th>
                                 <td class="tg-031e"><?=$info->contact_mobile?></td>
                              </tr>
                              <tr>
                                 <th class="tg-9vst">ইমেইল এড্রেস:</th>
                                 <td class="tg-031e"><?=$info->contact_email?></td>
                              </tr>                    
                              <tr>
                                 <th class="tg-9vst">সভাপতির নাম:</th>
                                 <td class="tg-031e"><?=$info->grp_president?></td>
                              </tr>
                              <tr>
                                 <th class="tg-9vst">সভাপতির ঠিকানা:</th>
                                 <td class="tg-031e"><?=$info->grp_president_add?></td>
                              </tr>
                              <tr>
                                 <th class="tg-9vst">সম্পাদকের নাম:</th>
                                 <td class="tg-031e"><?=$info->grp_secretary?></td>
                              </tr>
                              <tr>
                                 <th class="tg-9vst">সম্পাদকের ঠিকানা:</th>
                                 <td class="tg-031e"><?=$info->grp_secretary_add?></td>
                              </tr>
                              <tr>
                                 <th class="tg-9vst">স্কাউটস উপজেলা:</th>
                                 <td class="tg-031e"><?=$info->upa_name?></td>
                              </tr>
                              <tr>
                                 <th class="tg-9vst">স্কাউটস জেলা:</th>
                                 <td class="tg-031e"><?=$info->dis_name?></td>
                              </tr>
                              <tr>
                                 <th class="tg-9vst">স্কাউটস অঞ্চল:</th>
                                 <td class="tg-031e"><?=$info->region_name?></td>
                              </tr>
                           </table>
                        </div>
                     </div>
                  </div>


                  <div class="row" style="margin-bottom: 30px;">
                     <h4 class="semi-bold margin_left_15">Scouts Unit Create <em style="color: #f73838; font-size: 15px;">Minimum 1 unit must be created. Click Add More button for creating multiple units. </em></h4>
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
                        <table width="100%" border="1" id="unitRowDiv" style="border:1px solid #a09e9e;">
                           <tr>
                              <!-- <td>Member Name</td> -->
                              <th width="40%">Unit Name (English) <span class="required">*</span></th>
                              <th width="40%">Unit Name (Bangla) <span class="required">*</span></th>
                              <th width="12%">Unit Type <span class="required">*</span></th>
                              <th width="8%"> <a href="javascript:void();" id="addRow"  class="label label-success"> <i  class="fa fa-plus-circle"></i> Add More</a> </th>
                           </tr>
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


            <!-- <div class="col-md-12">
              <div class="grid simple">
                <div class="grid-title no-border">
                  <h4>Drag n Drop <span class="semi-bold">Uploader</span></h4>
                  <div class="tools">  </div>
                </div>
                <div class="grid-body no-border">
                  <div class="row-fluid">
                    <form action="<?php //echo base_url('offices/imageUploadPost');?>" enctype="multipart/form-data" class="dropzone no-margin">
                      <div class="fallback"> -->
                        <!-- <input name="file" type="file" multiple /> -->
                        <!-- <div>
                           <h3>Upload Multiple Image By Click On Box</h3>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
           </div> -->

            <!-- <script type="text/javascript">
               Dropzone.options.imageUpload = {
                    maxFilesize:1,
                    acceptedFiles: ".jpeg,.jpg,.png,.gif"
                };
             </script> -->

          </div>
       </div> <!-- END ROW -->
       <br><br><br>
    </div>
 </div>


 <script type="text/javascript">

   $(document).ready(function() {

      //Load First row
      addNewRow();

      // Jquery custome validate
      $.validator.addMethod("noSpace", function(value, element) { 
         return value.indexOf(" ") < 0 && value != ""; 
      }, "No space allowed use underscore symbol like ' _ '");
      
      // Jquery validation
      $('#scout_group_validate').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
         identity: {
            required: true, 
            noSpace: true,
            minlength: 3,
            remote: {
               url: hostname +"offices/ajax_exists_identity/",
               type: "post",
               data: {
                  inputData: function() {
                     return $( "#identity" ).val();
                  }
               }
            }         
         }, 
         password: {
            required: true,
            minlength: 8,
         },
         phone:{
            required: false,
            number: true,
            minlength: 11,
            maxlength: 11
         },
         grp_type: {
            required: true
         },
         grp_institute_id: {
            required: function(element) { 
               // var selValue = $('input[name=grp_type]:checked').val();
               // if(selValue == 1){
               //    return true;   
               // }else{
                  return false;
               // }
            } 
         },
         grp_name: {
            required: true,
            minlength: 10
         },
         grp_name_bn: {
            required: true,
            minlength: 10
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

      messages: {
         identity: {
            required: "Username required.",
            minlength: jQuery.format("Enter at least {0} characters"),
            remote: jQuery.format("Already in use! Please try another.")
         }
      },

      invalidHandler: function (event, validator) {
         //display error alert on form submit    
      },

      errorPlacement: function (label, element) { // render error placement for each input type            
         if (element.attr("name") == "grp_type") {
            label.insertAfter("#typeerror");
         } else {
            $('<span class="error"></span>').insertAfter(element).append(label)
            var parent = $(element).parent('.input-with-icon');
            parent.removeClass('success-control').addClass('error-control');  
         }
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

   // onChange Method
   $('#identity').keyup(function(){
      // $('#mask_username').html($('#identity').val());
      $('#mask_username').html($(this).val().toLowerCase());
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


</script>