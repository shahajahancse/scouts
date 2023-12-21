<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('offices/upazila')?>" class="active"><?=$module_name?> </a> </li>
         <li><?=$meta_title; ?></li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">                
                     <a href="<?=base_url('offices/upazila')?>" class="btn btn-success btn-xs btn-mini"> Upazila List</a>  
                     <a href="<?=base_url('offices/district_details/'.encrypt_url($info->sc_district_id))?>" class="btn btn-success btn-xs btn-mini"> Upazila Details</a>  
                     <a href="<?=base_url('offices/district_user/'.encrypt_url($info->sc_district_id))?>" class="btn btn-blueviolet btn-xs btn-mini"> Upazila User List</a> 
                  </div>
               </div>
               <div class="grid-body">
                <div><?php //echo validation_errors(); ?></div>
                <?php if($this->session->flashdata('success')):?>
                   <div class="alert alert-success">
                      <?=$this->session->flashdata('success');;?>
                   </div>
                <?php endif; ?>
                <?php 
                  $attributes = array('id' => 'office_user_validate');
                  echo form_open_multipart(uri_string(), $attributes);
                ?>

                <div class="row form-row">
                     <div class="col-md-4">
                        <label class="form-label">Scout Office Name</label>
                        <h4 class="semi-bold" style="margin-top: 0;"> <?php echo $info->upa_name_en?> </h4>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label class="form-label">Member Type <span class="required">*</span></label><br>
                           <input type="radio" class="m_type" name="member_type" value="1" id="sm" <?=set_value('member_type', $info->member_type)==1?'checked':'checked';?>> Scout Member
                           <input type="radio" class="m_type" name="member_type" value="2" id="nsm" <?=set_value('member_type', $info->member_type)==2?'checked':'';?>> Non Scout Member
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="scoutMemberDiv">
                           <label class="form-label">Select Scouts Member </label>
                           <?php echo form_error('scout_member_id'); ?>
                           <select class="scoutIDSingleSelect2 form-control input-sm" name="scout_member_id" id="scout_member_id" style="width: 100%;"></select>
                           <script>
                                var $newOption = $("<option></option>").val("<?php echo $info->scout_member_id;?>").text("<?php echo $info->scout_id .' ('.$info->first_name.')';?>");
                                $("#scout_member_id").append($newOption).trigger('change');
                             </script>
                           <!-- <input type="hidden" name="hide_group_id" id="hide_group_id" value="<?=$info->sc_group_id?>"> -->
                        </div>
                     </div>
                  </div>

                  <div class="row form-row nonScoutMemberDiv">
                     <div class="col-md-4">
                        <label class="form-label">Name <span class="required">*</span></label>
                        <?php echo form_error('user_name');?>
                        <input name="user_name" value="<?=set_value('user_name', $info->user_name)?>" type="text" class="form-control input-sm" placeholder="">
                     </div>
                     <div class="col-md-4">
                        <label class="form-label">Phone <span class="required">*</span></label>
                        <?php echo form_error('user_phone');?>
                        <input name="user_phone" value="<?=set_value('user_phone', $info->user_phone)?>" type="text" class="form-control input-sm" placeholder="">
                     </div>
                     <div class="col-md-4">
                        <label class="form-label">Email</label>
                        <?php echo form_error('user_email');?>
                        <input name="user_email" value="<?=set_value('user_email', $info->user_email)?>" type="text" class="form-control input-sm" placeholder="">
                     </div>
                     <div class="col-md-6">
                        <label class="form-label">Designation <span class="required">*</span></label>
                        <?php echo form_error('user_designation');?>
                        <input name="user_designation" value="<?=set_value('user_designation', $info->user_designation)?>" type="text" class="form-control input-sm" placeholder="">
                     </div>                     
                  </div>

                  <div class="row form-row">
                     <div class="col-md-6">
                        <label class="form-label">Remarks</label>
                        <?php echo form_error('user_remarks'); ?>
                        <textarea name="user_remarks" class="form-control" rows="2"><?=set_value('user_remarks', $info->user_remarks)?></textarea>
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
    $(document).ready(function() {
      // Onlode function
      typeRadioFunc();

      // Scout Member Type
      $(".m_type").on("click",function(){
         typeRadioFunc();
      });

      $('#office_user_validate').validate({
          // focusInvalid: false, 
          ignore: "",
          rules: {
             scout_member_id: {
               required: "#sm:checked"
            },
            user_name: {
               required: "#nsm:checked"
            },
            user_name: {
               required: "#nsm:checked"
            },
            user_designation: {
               required: "#nsm:checked"
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
         },

       });

    });   


    // Scout Member Type Function
    function typeRadioFunc(){
      // $(".scoutMemberDiv").show();
      var selectedValue = $("input[name=member_type]:checked").val();
      if(selectedValue == "1"){
         $(".scoutMemberDiv").show();
         $(".nonScoutMemberDiv").hide();
      }else{
         $(".scoutMemberDiv").hide();
         $(".nonScoutMemberDiv").show();
      }
   }
</script>