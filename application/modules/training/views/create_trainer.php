<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url('dashboard')?>" class="active"> <?=$module_title;?> </a> </li>
      <li> <?=$meta_title;?> </li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('training/trainer_list')?>" class="btn btn-blueviolet btn-xs btn-mini"> Trainer List</a>
            </div> 
          </div>

          <div class="grid-body"> 
            <?php echo validation_errors();?>
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">                      
                <?php echo $this->session->flashdata('success');;?>
              </div>
            <?php endif; ?>
            <?php 
            $attributes = array('id' => 'validate');
            echo form_open_multipart("training/create_trainer", $attributes);?>

            <div class="row">
              <div class="col-md-12">              
                <div class="row form-row">
                  <div class="col-md-4">
                    <div class="form-group">
                       <label class="form-label">Trainer Type<span class="required">*</span></label><br>
                       <input type="radio" class="scoutMember" name="trainer_type" value="1" id="scoutID" checked> Scout Member
                       <input type="radio" class="nonScoutMember" name="trainer_type" value="2" id="nonScout"> Non Scout Member
                       <div id="typeerror"></div>
                    </div>
                 </div>
                 <div class="col-md-4">
                    <div id="scoutMemberDiv">
                       <label class="form-label">Scout Member ID <span class="required">*</span></label>
                       <?php echo form_error('trainer_scout_id')?>
                       <select class="scoutIDSingleSelect2 form-control input-sm" name="trainer_scout_id" style="width: 100%;"></select>
                       <div id="typeerror"></div>
                    </div>
                    <div id="nonScoutMemberDiv" style="display: none;">
                       <label class="form-label">Trainer Name <span class="required">*</span></label>   
                       <input name="trainer_name" value="<?=set_value('trainer_name')?>" type="text" class="form-control input-sm" placeholder="">
                    </div>
                 </div>
                 <div class="col-md-4 hideElement">
                   <label class="form-label">Organization Name</label>   
                   <input name="organization" value="<?=set_value('organization')?>" type="text" class="form-control input-sm" placeholder="">
                 </div>
                </div>

                <div class="row form-row hideElement">
                  <div class="col-md-3">
                     <label class="form-label">Designation / Occupation</label>   
                     <input name="designation" value="<?=set_value('designation')?>" type="text" class="form-control input-sm" placeholder="">
                  </div>
                  <div class="col-md-2">
                     <label class="form-label">Mobile Number <span class="required">*</span></label>   
                     <input name="phone_no" value="<?=set_value('phone_no')?>" type="text" class="form-control input-sm" placeholder="">
                  </div>
                  <div class="col-md-3">
                     <label class="form-label">Email Address</label>   
                     <input name="email_address" value="<?=set_value('email_address')?>" type="text" class="form-control input-sm" placeholder="">
                  </div>
                  <div class="col-md-4">
                     <label class="form-label">Present Address</label>   
                     <input name="pre_address" value="<?=set_value('pre_address')?>" type="text" class="form-control input-sm" placeholder="">
                  </div>
                </div>
              </div>

            </div> <!-- /row -->

            <div class="form-actions">  
              <div class="pull-right">
                <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Save</button>
              </div>
            </div>

            <?php echo form_close();?>

          </div> <!-- END GRID BODY -->
        </div> <!-- END GRID -->
      </div> <!-- /col-md-12 -->
    </div> <!-- END ROW -->

  </div> <!-- /content -->
</div> <!-- /page-content -->

<script type="text/javascript">  

  $(document).ready(function() {
    // officeFunc();

    //Jquery validate
    $('#validate').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
        trainer_scout_id: {required: "#scoutID:checked"},
        trainer_name: {required: "#nonScout:checked"},
        phone_no: {required: "#nonScout:checked"},
        email_address: { email: true }
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

    //Default Input disable
      $(".hideElement").hide();
      // $("#member_email").hide();
      //$("#member_profession").prop('disabled', true);
      //$("#member_address").prop('disabled', true);

      // Hide/Show
      $(".scoutMember").click(function(){
         $("#scoutMemberDiv").show();
         $("#nonScoutMemberDiv").hide();
         //Disable Input
         $(".hideElement").hide();
         // $("#member_email").hide();
         // $("#member_profession").prop('disabled', true);
         // $("#member_address").prop('disabled', true);
      });

      $(".nonScoutMember").click(function(){
         $("#scoutMemberDiv").hide();
         $("#nonScoutMemberDiv").show();
         //Enable Input
         $(".hideElement").show();
         // $("#member_email").show();
         // $("#member_profession").prop('disabled', false);
         // $("#member_address").prop('disabled', false);
      });
  });   

  // function officeFunc(){
  //     $(".otherOffice").hide();
  //     var selectedValue = $("input[name=trainer_type]:checked").val();
  //     // alert(selectedValue);
  //     if(selectedValue == "1"){
  //        $(".otherOffice").hide();
  //     }else{
  //        $(".otherOffice").show();
  //     }
  //  }

</script>