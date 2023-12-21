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
                     <?php if($info->member_id == 2){ ?>
                     <?php if($info->sc_section_id == '1'){ ?>
                     <a href="<?=base_url('program/cub_program/'.encrypt_url($info->id))?>" class="btn btn-blueviolet btn-xs btn-mini"> Cub Program</a>
                     <?php }elseif($info->sc_section_id == '2'){ ?>
                     <a href="<?=base_url('program/scout_program/'.encrypt_url($info->id))?>" class="btn btn-blueviolet btn-xs btn-mini"> Scouts Program</a>
                     <?php }elseif($info->sc_section_id == '3'){ ?>
                     <a href="<?=base_url('program/rover_program/'.encrypt_url($info->id))?>" class="btn btn-blueviolet btn-xs btn-mini"> Rover Scouts Program</a>
                     <?php } ?>
                     <?php }else{ ?>
                     <a href="<?=base_url('program/leader_progress')?>" class="btn btn-blueviolet btn-xs btn-mini"> Leader Progress</a>
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
                           <div class="col-md-7">
                              <label class="form-label">Award Name <span class="required">*</span></label>
                              <?php echo form_error('award_name');?>
                              <input type="text" name="award_name" class="form-control input-sm" value="<?=set_value('award_name', $infoAward->award_name)?>" placeholder="">
                           </div>
                           <div class="col-md-3">  
                              <label class="form-label">Certificate No <span class="required">*</span></label>
                              <?php echo form_error('certificate_no'); ?>
                              <input type="text" name="certificate_no" class="form-control input-sm" value="<?=set_value('certificate_no', $infoAward->certificate_no)?>" placeholder="">
                           </div>
                        </div>
                        <div class="row form-row">
                           <div class="col-md-3">  
                              <label class="form-label">Issue Date</label>
                              <?php echo form_error('issue_date');?>
                              <input type="text" name="issue_date" class="form-control input-sm datetime" value="<?=set_value('issue_date', date_browse_format($infoAward->issue_date))?>" placeholder="DD-MM-YYYY">
                           </div>
                           <div class="col-md-7">
                              <label class="form-label">Issue Authority</label>
                              <?php echo form_error('issue_authority');?>
                              <input type="text" name="issue_authority" class="form-control input-sm" value="<?=set_value('issue_authority', $infoAward->issue_authority)?>" placeholder="">
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
      $('#jqvalidation').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
         award_name: {
            required: true
         },
         certificate_no: {
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
</script>