<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('dashboard')?>" class="active"> <?=$module_title; ?> </a></li>
         <li><?=$meta_title; ?></li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>   
                  <div class="pull-right"> 
                    <?php if($info->sc_section_id == '1'){ ?>
                    <a href="<?=base_url('program/cub_program/'.encrypt_url($info->id))?>" class="btn btn-blueviolet btn-xs btn-mini"> Cub Program</a>
                    <?php }elseif($info->sc_section_id == '2'){ ?>
                    <a href="<?=base_url('program/scout_program/'.encrypt_url($info->id))?>" class="btn btn-blueviolet btn-xs btn-mini"> Scouts Program</a>
                    <?php }elseif($info->sc_section_id == '3'){ ?>
                    <a href="<?=base_url('program/rover_program/'.encrypt_url($info->id))?>" class="btn btn-blueviolet btn-xs btn-mini"> Rover Scouts Program</a>
                    <?php } ?>
                 </div>           
              </div>
              <div class="grid-body">              
               <div><?php //echo validation_errors(); ?></div>
               <?php if($this->session->flashdata('success')):?>
                  <div class="alert alert-success">                      
                     <?php echo $this->session->flashdata('success');?>
                  </div>
               <?php endif; ?>              
               <?php 
               $attributes = array('id' => 'jqvalidation');
               echo form_open(uri_string(), $attributes);?>

               <div class="row">
                  <div class="col-md-12">
                     <div class="row form-row">
                     <?php if($info->sc_section_id == 3 || $info->member_id == 8 || $info->member_id == 9 || $info->member_id == 10 || $info->member_id == 12){ ?>
                        <div class="col-md-3">
                           <label class="form-label">Scouts Office <span class="required">*</span></label>
                           <?php echo form_error('promo_office_type');?>
                           <input type="radio" name="promo_office_type" class="sc_office" value="1" <?=set_value('promo_office_type', $infoPromotion->promo_office_type)=='1'?'checked':'';?> checked> NHQ Office
                           <input type="radio" name="promo_office_type" class="sc_office" value="2" id="officeOther" <?=set_value('promo_office_type', $infoPromo->promo_office_type)=='2'?'checked':'';?>> Other Office
                        </div>      

                        <div class="col-md-3 otherOffice" >
                           <label class="form-label">Scouts Region <span class="required">*</span></label>
                           <?php echo form_error('promo_region_id');
                           $more_attr = 'class="form-control input-sm" id="region"';
                           echo form_dropdown('promo_region_id', $regions, set_value('promo_region_id', $infoPromo->promo_region_id), $more_attr);
                           ?>
                        </div>

                        <div class="col-md-3 otherOffice">
                           <label class="form-label">Scouts District </label>
                           <?php echo form_error('promo_district_id');?>
                           <?php if($scout_districts){ 
                           $more_attr = 'class="sc_district_val form-control input-sm" id="sc_district"';
                           echo form_dropdown('promo_district_id', $scout_districts, set_value('promo_district_id', $infoPromo->promo_district_id), $more_attr);
                           }else{ ?>
                           <select name="promo_district_id" class="sc_district_val form-control input-sm" id="sc_district">
                              <option value="">-- Select One --</option>
                           </select>
                           <?php } ?>
                        </div>
                        <div class="col-md-3 otherOffice">
                           <label class="form-label">Scouts Upazila </label>
                           <?php echo form_error('promo_upazila_id');?>
                           <?php if($scout_upazila){ 
                           $more_attr = 'class="sc_upazila_thana_val form-control input-sm" id="sc_upazila_thana"';
                           echo form_dropdown('promo_upazila_id', $scout_upazila, set_value('promo_upazila_id', $infoPromo->promo_upazila_id), $more_attr);
                           }else{ ?>
                           <select name="promo_upazila_id" class="sc_upazila_thana_val form-control input-sm"  id="sc_upazila_thana">
                              <option value="">-- Select One --</option>
                           </select>
                           <?php } ?>
                        </div>
                        <div class="col-md-6 otherOffice">
                           <label class="form-label">Scouts Group </label>
                           <?php echo form_error('promo_gorup_id');?>
                           <?php if($scout_group){ 
                           $more_attr = 'class="sc_group_val form-control input-sm" id="sc_unit_list"';
                           echo form_dropdown('promo_gorup_id', $scout_group, set_value('promo_gorup_id', $infoPromo->promo_gorup_id), $more_attr);
                           }else{ ?>
                           <select name="promo_gorup_id" class="sc_group_val form-control input-sm" id="sc_unit_list">
                              <option value="">-- Select One --</option>
                           </select>
                           <?php } ?>
                        </div>
                        <div class="col-md-6 otherOffice">
                           <label class="form-label">Scouts Unit </label>
                           <?php echo form_error('promo_unit_id');?>
                           <select name="promo_unit_id" class="sc_unit_list_val form-control input-sm">
                              <option value="">-- Select One --</option>
                           </select>
                        </div>
                     
                     <?php }else{ ?>

                        <div class="col-md-6 otherOffice">
                           <label class="form-label">Scouts Group <span class="required">*</span></label>
                           <?php echo form_error('promo_gorup_id');?>
                           <select class="scoutsGroupSelect2 ffff form-control" name="promo_gorup_id" id="sc_unit_list" style="width:100%;"></select>
                           <script>
                           var $newOption = $("<option></option>").val("<?php echo $infoPromo->promo_gorup_id;?>").text("<?php echo $infoPromo->grp_name.' ('.$infoPromo->grp_name_bn.')'?>");
                              $(".ffff").append($newOption).trigger('change');
                           </script>
                        </div>
                        <div class="col-md-6 otherOffice">
                           <label class="form-label">Scouts Unit </label>
                           <?php echo form_error('promo_unit_id');
                           $more_attr = 'class="sc_unit_list_val form-control input-sm"';
                           echo form_dropdown('promo_unit_id', $scout_units, set_value('promo_unit_id', $infoPromo->promo_unit_id), $more_attr);
                           ?>
                        </div>
                     <?php } ?>

                     </div>

                     <div class="row form-row">
                        <div class="col-md-3">
                           <label class="form-label">Member Type  <span class='required'>*</span></label>
                           <?php echo form_error('promo_member_id'); 
                           $more_attr = 'id="member_id" class="form-control input-sm"';
                           echo form_dropdown('promo_member_id',$member_type, set_value('promo_member_id', $infoPromo->promo_member_id), $more_attr);?>
                        </div>
                        <div class="col-md-3">
                           <label class="form-label">Scouts Section Type <span class='required'>*</span></label>
                           <?php echo form_error('promo_section_id');
                           $more_attr = 'class="form-control input-sm" id="sc_section"';
                           echo form_dropdown('promo_section_id', $scout_section, set_value('promo_section_id', $infoPromo->promo_section_id), $more_attr);
                           ?>
                        </div>
                        <div class="col-md-3" id="sc_role_hidden">
                           <label class="form-label">Scouts Role <span class='required'>*</span></label>
                           <?php echo form_error('promo_role_id');
                           $more_attr = 'class="sc_role_val form-control input-sm" id="sc_role"';
                              echo form_dropdown('promo_role_id', $scout_roles, set_value('promo_role_id', $infoPromo->promo_role_id), $more_attr);
                           ?>
                        </div>
                        <div class="col-md-3">
                           <label class="form-label">Departments </label>
                           <?php echo form_error('promo_department_id');
                           $more_attr = 'class="form-control input-sm"';
                           echo form_dropdown('promo_department_id', $departments, set_value('promo_department_id', $infoPromo->promo_department_id), $more_attr);
                           ?>
                        </div>
                     </div>

                     <div class="row form-row">
                        <div class="col-md-3">  
                           <label class="form-label">Start Date <span class="required">*</span></label>
                           <?php echo form_error('promo_start_date'); ?>
                           <input type="text" name="promo_start_date" class="form-control input-sm datetime" value="<?=set_value('promo_start_date', date_browse_format($infoPromo->promo_start_date))?>" placeholder="DD-MM-YYYY">
                        </div>
                        <div class="col-md-2">
                          <label class="form-label">End Date </label>
                          <?php echo form_error('promo_end_date'); ?>
                          <input type="text" name="promo_end_date" class="form-control input-sm datetime" value="<?=set_value('promo_end_date', date_browse_format($infoPromo->promo_end_date))?>" placeholder="DD-MM-YYYY">
                       </div>
                    </div>

                 </div>
              </div>

              <?php //if($flag_can_apply) { ?>
              <div class="form-actions">  
               <div class="pull-right">
                  <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Save</button>
               </div>
            </div>
            <?php //} ?>
            <?php echo form_close();?>
         </div>  <!-- END GRID BODY -->              
      </div> <!-- END GRID -->
   </div>

</div> <!-- END ROW -->

</div>
</div>

<script type="text/javascript">

   $(document).ready(function() {
      officeFunc();
      //Scout Office
      $(".sc_office").on("click",function(){
         officeFunc();
      });


      $('#jqvalidation').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
         promo_gorup_id: {required: "#officeOther:checked"},
         promo_member_id: {required: true},
         promo_section_id: {required: true},
         promo_role_id: {required: true},
         promo_start_date: {required: true},
         promo_end_date: {required: false}
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

   function officeFunc(){
      $(".otherOffice").hide();
      var selectedValue = $("input[name=promo_office_type]:checked").val();
      if(selectedValue == "1"){
         $(".otherOffice").hide();
      }else{
         $(".otherOffice").show();
      }
   }
</script>