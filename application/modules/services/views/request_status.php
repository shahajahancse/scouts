<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url('dashboard')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <div class="row-fluid">
      <div class="span12">
        <div class="grid simple ">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <?php if($this->ion_auth->is_admin()){ ?>
            <div class="pull-right">
              <a class="btn btn-success btn-xs btn-mini" href="<?=base_url('services/request_list')?>">All info Request List</a>
            </div> 
            <?php } ?>           
          </div>

          <div class="grid-body ">
            <div><?php //echo validation_errors(); ?></div>     
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');?>
              </div>
            <?php endif; ?>
            <?php if($this->session->flashdata('warning')):?>
              <div class="alert alert-warning">
                <?php echo $this->session->flashdata('warning');?>
              </div>
            <?php endif; ?>

            <div class="tiles white details">

              <style type="text/css">
                .tg  {border-collapse:collapse;border-spacing:0;font-family:Arial, sans-serif; border: 0px solid red;}
                .tg td{font-size:14px;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#00000;background-color:#E0FFEB; vertical-align: middle;}
                .tg th{font-size:14px;font-weight:bold;padding:3px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#bce2c5;text-align: center;}
                .tg .tg-ywa9{background-color:#ffffff;color:#ffffff;vertical-align:top; width: 300px;color: black;font-weight: bold;}
                .tg .tg-khup{background-color:#efefef;color:#ffffff;vertical-align:top; width: 130px; color: black; text-align: right;}
                .tg .tg-akf0{background-color:#ffffff;color:#ffffff;vertical-align:top;color: black;}
                .tg .tg-mtwr{background-color:#efefef;vertical-align:top; font-weight: bold; text-align: center; font-size: 16px;text-decoration: underline;}
              </style>

              <div class="row">
                <div class="col-md-7">
                  <?php 
                  $attributes = array('id' => 'validate_service');
                  echo form_open_multipart(uri_string(), $attributes);
                  ?>
                  <h5 style="font-weight: bold;">Change current status and note.</h5>
                  <div class="row form-row">
                    <div class="col-md-8">
                      <label class="form-label">Task Status <span class="required">*</span></label>
                      <?php echo form_error('status');
                      $more_attr = 'class="form-control input-sm"';
                      echo form_dropdown('status', $status, $info->status, $more_attr);
                      ?>
                    </div>
                    <div class="col-md-12">
                      <label class="form-label">Note <span class="required">*</span></label>
                      <?php echo form_error('note'); ?>
                      <textarea name="note" rows="3" style="width: 100%" placeholder="Write your note here...."><?=set_value('note', $info->note)?></textarea>
                    </div> 
                  </div>

                  <div class="pull-right">
                  <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Save Current Status</button>
                    <!-- <button type="button" class="btn btn-white btn-cons">Cancel</button> -->
                  </div>

                  <?php echo form_close();?>
                </div>

                <div class="col-md-5">
                  <table class="tg" width="100%">              
                    <tr>
                      <td class="tg-khup">Service Name:</td>
                      <td class="tg-ywa9"><?=$info->service_name?></td>
                    </tr>
                    <tr>
                      <td class="tg-khup">Request To:</td>
                      <td class="tg-ywa9"><?=$info->request_to == 1 ? 'NHQ' : 'Region';?></td>
                    </tr>
                    <tr>
                      <td class="tg-khup">Status:</td>
                      <td class="tg-ywa9"><?=service_request_status($info->status)?></td>
                    </tr>
                    <tr>
                      <td class="tg-khup">Name:</td>
                      <td class="tg-ywa9"><?=$info->name?></td>
                    </tr>
                    <tr>
                      <td class="tg-khup">Mobile:</td>
                      <td class="tg-ywa9"> <?=$info->phone?></td>                      
                    </tr>
                    <tr>
                      <td class="tg-khup">Email:</td>
                      <td class="tg-ywa9"> <?=$info->email?></td>
                    </tr>
                    <tr>
                      <td class="tg-khup">Address:</td>
                      <td class="tg-ywa9"><?=$info->address?></td>
                    </tr>
                    <tr>
                      <td class="tg-khup">Problem:</td>
                      <td class="tg-ywa9"><?=nl2br($info->serv_problem)?></td>
                    </tr>
                    <tr>
                    </table>
                  </div>
                </div>

              </div>
            </div>
          </div>

        </div> <!-- END ROW -->

      </div>
    </div>


    <script type="text/javascript">
      $(document).ready(function() {

      //Validation
      $('#validate_service').validate({
          // focusInvalid: false, 
          ignore: "",
          rules: {
            status: {
              required: true
            },
            note: {
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

   //  $('#assign_office_id').change(function(){
   //    $('#district').hide(); 
   //    $("#upazila").hide();
   //    $("#group").hide();

   //    var id = $('#assign_office_id').val();
   //    // alert(id);

   //    if(id == 2){
   //      $("#district").show();
   //    }else if(id == 3){
   //      $("#district").show();
   //      $("#upazila").show();        
   //    }else if(id == 4){
   //      $("#district").show();
   //      $("#upazila").show(); 
   //      $("#group").show();        
   //    }
   // });
 </script>