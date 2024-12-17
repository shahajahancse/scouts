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
                  echo form_open("program/group_change_add/".encrypt_url($info->id), $attributes);?>

                  <div class="row">
                     <div class="col-md-6" style="border-right: 1px solid #ccc;">
                        <div class="row form-row">
                           <div class="col-md-8">
                              <label class="form-label">Name Of Previous Group <span class="required">*</span></label>
                              <?php echo form_error('resign_gorup_name'); ?>
                              <input name="resign_gorup_name" value="<?=set_value('resign_gorup_name')?>"  type="text"  class="form-control input-sm">
                           </div>                            
                           <div class="col-md-4">
                              <label class="form-label">Date of leving <span class="required">*</span></label>
                              <?php echo form_error('resign_date'); ?>
                              <input type="text" name="resign_date" class="form-control input-sm datetime" value="<?=set_value('resign_date')?>" placeholder="DD-MM-YYYY">
                           </div>
                        </div>
                        <div class="row form-row">
                           <div class="col-md-5">
                              <label class="form-label">Previous Scout Section <span class="required">*</span></label> 
                              <?php $more_attr = 'class="form-control input-sm"';
                              echo form_dropdown('resign_section_id', $section, set_value('resign_section_id'), $more_attr);
                              ?> 
                           </div>
                           <div class="col-md-7">
                              <label class="form-label">Authority approved leving old Group</label>
                              <?php echo form_error('resign_evaluated_by');?>
                              <select class="scoutIDSingleSelect2 form-control" name="resign_evaluated_by" id="resign_evaluated_by" style="width:100%"></select>
                           </div>
                        </div>
                        <div class="row form-row">
                           <div class="col-md-12">
                             <label class="form-label">Reason for leving old Group <span class="required">*</span></label>
                             <textarea name="resign_reason" rows="7" style="width: 100%" id=""></textarea>
                          </div>
                       </div>
                    </div>

                    <div class="col-md-6">
                     <div class="row form-row">
                        <div class="col-md-8">
                           <label class="form-label">Name of New Group <span class="required">*</span></label>
                           <?php echo form_error('new_group_name'); ?>
                           <input name="new_group_name" value="<?=set_value('new_group_name')?>"  type="text"  class="form-control input-sm">
                        </div>
                        <div class="col-md-4">  
                           <label class="form-label">Date of Joining <span class="required">*</span></label>
                           <?php echo form_error('new_join_date'); ?>
                           <input type="text" name="new_join_date" class="form-control input-sm datetime" value="<?=set_value('new_join_date')?>" placeholder="DD-MM-YYYY">
                        </div>
                     </div>
                     <div class="row form-row">
                        <div class="col-md-5">  
                           <label class="form-label">New Scout Section <span class="required">*</span></label> 
                           <?php $more_attr = 'class="form-control input-sm"';
                           echo form_dropdown('new_section_id', $section, set_value('new_section_id'), $more_attr);
                           ?>              
                        </div>
                        <div class="col-md-7">
                           <label class="form-label">Authority approved to Join New Group</label>
                           <?php echo form_error('new_evaluated_by');?>
                           <select class="scoutIDSingleSelect2 form-control" name="new_evaluated_by" id="new_evaluated_by" style="width:100%"></select>
                        </div>
                     </div>
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
      $('#jqvalidation').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
         resign_gorup_name: {required: true},
         resign_date: {required: true},
         resign_reason: {required: true},
         resign_section_id: {required: true},
         resign_evaluated_by: {required: true},
         new_group_name: {required: true},
         new_join_date: {required: true},
         new_section_id: {required: true},
         new_evaluated_by: {required: true}
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

</script>