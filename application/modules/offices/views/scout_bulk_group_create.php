<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('offices/scout_group')?>" class="active"><?=$module_name?> </a> </li>
         <li><?=$meta_title; ?></li>
      </ul>
      <style type="text/css">
         #memberDiv td{padding: 5px;}
      </style>
      <?php
      $type = array('1' => 'নিয়ন্ত্রিত স্কাউট গ্রুপ', '2' => 'মুক্ত স্কাউট গ্রুপ');
      $gtype_data = '';
      foreach ($type as $key => $value) {      
         $gtype_data .= '<option value="'.$key.'">'.$value.'</option>';   
      }
      ?>
      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin()){ ?>
                  <div class="pull-right">                
                     <a href="<?=base_url('offices/scout_group')?>" class="btn btn-blueviolet btn-xs btn-mini"> Scout Group List</a>  
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
                  echo validation_errors();
                  $attributes = array('id' => 'scout_group_validate');
                  echo form_open_multipart("offices/scout_bulk_group_create", $attributes);?>
                  <input type="hidden" value="1" name="sl" id="sl">
                  <div class="row">
                     <!-- <h5 class="semi-bold margin_left_15">Scout Group Office Information</h5> -->
                     <p class="semi-bold margin_left_15" style="color: red;">Be Careful! Username must be unique. Other's group information can update later.</p>
                     <div class="col-md-4">
                        <div class="row form-row">
                           <div class="col-md-12">
                              <label class="form-label">Select Scout Region <span class="required">*</span></label>
                              <?php if($this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin()){ ?>

                              <h4><?=$region_info->region_name?></h4>
                              <input type="hidden" name="grp_region_id" value="<?=$region_info->id?>">
                              <?php }else{ ?>
                              <?php 
                              echo form_error('grp_region_id');
                              $more_attr = 'class="form-control input-sm" id="region"';
                              echo form_dropdown('grp_region_id', $regions, set_value('grp_region_id'), $more_attr);
                              ?>
                              <?php } ?>
                           </div>
                        </div>
                     </div>

                     <div class="col-md-4">
                        <div class="row form-row">
                           <div class="col-md-12">
                              <?php if($this->ion_auth->is_region_admin()){ ?>
                              <label class="form-label">Select Scout District <span class="required">*</span></label>
                              <?php echo form_error('grp_scout_dis_id'); ?>
                              <?php
                              $more_attr = 'class="form-control input-sm" id="sc_district"';
                              echo form_dropdown('grp_scout_dis_id', $district_dd, set_value('grp_scout_dis_id'), $more_attr);
                              ?>

                              <?php }elseif($this->ion_auth->is_district_admin()){ ?>
                              <label class="form-label">Scout District</label>
                              <h4><?=$district_info->dis_name?></h4>
                              <input type="hidden" name="grp_scout_dis_id" value="<?=$district_info->id?>">

                              <?php }elseif($this->ion_auth->is_upazila_admin()){ ?>
                              <label class="form-label">Scout District</label>
                              <h4><?=$district_info->dis_name?></h4>
                              <input type="hidden" name="grp_scout_dis_id" value="<?=$district_info->id?>">

                              <?php }else{ ?>
                              <label class="form-label">Select Scout District <span class="required">*</span></label>
                              <select name="grp_scout_dis_id" class="sc_district_val form-control input-sm" id="sc_district">
                                 <option value="">-- Select One --</option>
                              </select>
                              <?php } ?>
                           </div>
                        </div>
                     </div>

                     <div class="col-md-4" >
                        <div class="row form-row">
                           <div class="col-md-12">
                              <label class="form-label">Select Scout Upazila</label>
                              <?php echo form_error('grp_scout_upa_id'); ?>
                              <?php if($this->ion_auth->is_district_admin()){ ?>                           
                              <?php 
                              $more_attr = 'class="form-control input-sm" id="sc_upazila_thana"';
                              echo form_dropdown('grp_scout_upa_id', $upazila_dd, set_value('grp_scout_upa_id'), $more_attr);?>

                              <?php }elseif($this->ion_auth->is_upazila_admin()){ ?>
                              <h4><?=$upazila_info->upa_name?></h4>
                              <input type="hidden" name="grp_scout_upa_id" value="<?=$upazila_info->id?>">

                              <?php }else{ ?>
                              <select name="grp_scout_upa_id" class="sc_upazila_thana_val form-control input-sm"  id="distirict">
                                 <option value="">-- Select One --</option>
                              </select>
                              <?php } ?>
                           </div>
                        </div>
                     </div>
                  </div>

                  <br><br>

                  <div class="row" style="margin-bottom: 30px;">
                     <div class="col-md-12" >
                        <table width="100%" border="1" id="memberDiv" style="border:3px solid #ccc;">
                           <tr>
                              <!-- <td>Member Name</td> -->
                              <td width="300" style="font-weight: bold;">Group Type & Username<br>Group Name (English)</td>
                              <td width="300" style="font-weight: bold;">Password <br>Group Name (Bangla)</td>
                              <td width="100"> <a href="javascript:void();" id="addRow"  class="label label-success"> <i  class="fa fa-plus-circle"></i> Add More</a> </td>
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

         </div>
      </div> <!-- END ROW -->

   </div>
</div>
<script>
   $("#addRow").click(function(e) {    
      e.preventDefault();
      dynamicRow();
   });    

   // Dynamic Row
   function dynamicRow(){
      var sl=$('#sl').val();
      sl++;
      $('#sl').val(sl);

      var items = '';
      items+= '<tr>';
      items+= '<td><div style="float: left"><select class=" input-sm" name="grp_type[]"><?php echo $gtype_data;?></select></div><div style="float: right;"><input name="identity[]" type="text" value="" class="form-control input-sm" id="name_'+sl+'" onkeyup="singleValidation('+sl+')" placeholder="ex: ga_group_name" style="text-transform: lowercase; width: 200px;"><span id="vm_'+sl+'"></span></div><br><br><input name="grp_name[]" value="" type="text" class="form-control input-sm" placeholder="Ex: Mysoftheaven Open Scout Group (English)"></td>';
      items+= '<td><input name="password[]" id="password" type="text" class="form-control input-sm" placeholder="Mininum 8 character" value="12345678"><br><input name="grp_name_bn[]" value="" type="text" class="form-control input-sm" placeholder="উদাঃ মাইসফট হ্যাভেন ওপেন স্কাউটস গ্রুপ (বাংলা)" ></td>';
      items+= '<td> <a href="javascript:void();" class="label label-important" onclick="removeRow(this)"> <i class="fa fa-minus-circle"></i> Remove </a></td>';

      items+= '</tr>';
      // items+= '</div>';
      $('#memberDiv tr:last').after(items);
   }

   function removeRow(id){ 
      $(id).closest("tr").remove();
   }
</script>  

<script type="text/javascript">
   function singleValidation(sl){
      var nameData = $('#name_'+sl).val();
      $.ajax({
         type: "POST",
         url: hostname +"offices/ajax_exists_usernanemn/",
         data:{ inputData: nameData },
         success: function(response)
         {
            if(response==0){
               $('#vm_'+sl).html('Group name is valid.');
               $('#vm_'+sl).css('color','green');
            }else{
               $('#vm_'+sl).html('Group name exists.');
               $('#vm_'+sl).css('color','red');
            }
         }
      });
   }    

   $(document).ready(function() {
      // Daynamicllay append scout group
      dynamicRow();

      // JS Validation
      $.validator.addMethod("noSpace", function(value, element) { 
         return value.indexOf(" ") < 0 && value != ""; 
      }, "No space please and don't leave it empty");

      $('#scout_group_validate').validate({
         // focusInvalid: false, 
         ignore: "",
         rules: {
            grp_region_id: {required: true},
            grp_scout_dis_id: { required: true },
            'grp_type[]': { required: true},
            'identity[]': {
               required: true, 
               noSpace: true,            
               minlength: 3,
            }, 
            'password[]': {
               required: true
            },
            'grp_name[]': {
               required: true,
               minlength: 10
            },
            'grp_name_bn[]': {
               required: true
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


</script>



<!-- <tr>
<td>
   <div style="float: left">
      <input type="radio" class="controlled" name="grp_type" id="grpTypeCtrl" value="1" <?=set_value('grp_type')==1?'checked':'';?>> নিয়ন্ত্রিত গ্রুপ
      <input type="radio" class="open" name="grp_type" id="grpTypeClose" value="2" <?=set_value('grp_type')==2?'checked':'';?>> মুক্ত গ্রুপ   
   </div>
   <div style="float: right;">
      <input name="identity" id="identity" type="text" value="<?=set_value('identity', 'ga_'.$this->input->post('identity'))?>" class="form-control input-sm" placeholder="Example: ra_group_name" style="text-transform: lowercase; width: 300px;">
   </div>
   <br><br>
   <input name="grp_name" id="grp_name" value="<?=set_value('grp_name')?>" type="text" class="form-control input-sm" placeholder="Ex: Mysoftheaven Open Scout Group" >
</td>
<td>
   <input name="password" id="password" type="text" class="form-control input-sm" placeholder="Mininum 8 character" value="12345678"> <br>
   <input name="grp_charter" id="grp_charter" value="<?=set_value('grp_charter')?>" type="text" class="form-control input-sm" placeholder="Charter Number">
</td>              
<td> <a href="javascript:void();" id="addRow"  class="label label-success"> <i  class="fa fa-plus-circle"></i> Add More</a></td>                            
</tr> -->