<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url('application_list')?>" class="active"> <?=$module_title; ?> </a></li>
      <li> <?=$meta_title;?> </li>
    </ul>

    <style type="text/css">
      .tg  {border-collapse:collapse;border-spacing:0; width: 100%; color: #443f3f;}
      .tg td{font-family:Arial, sans-serif;font-size:14px;padding:7px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
      .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:7px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
      .tg .tg-1ydw{border-color:#efefef;text-align:left}
      .tg .tg-wwkm{font-weight:bold;background-color:#d8e8d8;border-color:#efefef;text-align:left;vertical-align:top}
      .tg .tg-6p4y{border-color:#efefef;text-align:left;vertical-align:top; color: black;}
      .tg .tg-2v33{font-weight:bold;background-color:#d8e8d8;border-color:#efefef;text-align:left}
      .tg .tg-jz97{border-color:#efefef;text-align:left;color: black;}
    </style>
    
    <div class="row-fluid">
      <div class="span12">
        <div class="grid simple ">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <?php //if($this->ion_auth->is_admin()){ ?>
            <div class="pull-right">
              <a href="<?=base_url('events/application_list')?>" class="btn btn-blueviolet btn-xs btn-mini">Application List </a>
              <!-- <a href="<?=base_url('events/event_list')?>" class="btn btn-success btn-xs btn-mini"> Event Request List</a>  -->
              <!-- <a href="<?=base_url('events/upcomming_event_list')?>" class="btn btn-success btn-xs btn-mini"> Upcomming Events List</a>  -->
            </div> 
            <?php //} ?>           
          </div>

          <div class="grid-body ">
            <div id="infoMessage"><?php //echo $message;?></div>            
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

            <?php //print_r($info); ?>

            <div class="tiles white details">
              <div class="row">
                <div class="col-md-12">
                  <?php 
                  $attributes = array('id' => 'validate');
                  echo form_open_multipart("training/participant_verify/".$info->participant_id, $attributes);
                  ?>
                  <table class="tg">
                    <tr>
                      <th class="tg-2v33">Training Title:</th>
                      <th class="tg-jz97"><?=$info->training_title?></th>
                      <th class="tg-wwkm">Applicant Name (ID):</th>
                      <th class="tg-6p4y"><?=$info->first_name.' ('.$info->scoutID.')'?></th>
                    </tr>
                    <tr>
                      <td class="tg-2v33">Course Name:</td>
                      <td class="tg-jz97"><?=$info->course_id == 100 ? $info->other_course_name : $info->course_name?></td>
                      <td class="tg-wwkm">Applicant Image:</td>
                      <td class="tg-6p4y">
                        <?php
                          $path = base_url().'profile_img/';
                          if($info->profile_img != NULL){
                            $img_url = '<img src="'.$path.$info->profile_img.'" width="50" style="border:1px solid #ccc; padding:3px;">';
                          }else{
                            $img_url = '<img src="'.$path.'no-img.png" width="90" style="border:1px solid #ccc; padding:3px;">';
                          }
                          echo $img_url;
                        ?>
                      </td>
                    </tr>
                    <tr>
                      <td class="tg-2v33">Place:</td>
                      <td class="tg-jz97"> <?=$info->place?></td>
                      <td class="tg-wwkm">Participant Verify Status:</td>
                      <td class="tg-6p4y"> 
                          <div class="row form-row">
                            <div class="col-md-8">
                              <?php 
                              echo form_error('status');
                              $more_attr = 'class="form-control input-sm"';
                              echo form_dropdown('status', $status, set_value('status'), $more_attr);
                              ?>
                            </div>
                            <div class="col-md-4">
                              <button type="submit" class="btn btn-mini btn-xs btn-blueviolet"><i class="icon-ok"></i> Save</button>
                            </div>
                          </div>
                      </td>                      
                    </tr>
                    <tr>
                      <td class="tg-2v33">Training Date:</td>
                      <td class="tg-jz97">From <strong><?=date_detail_format($info->start_date)?></strong> to <strong><?=date_detail_format($info->end_date)?></strong></td>
                      <td class="tg-wwkm">Registration Period:</td>
                      <td class="tg-6p4y"> From <strong><?=date_detail_format($info->reg_start)?></strong> to <strong><?=date_detail_format($info->reg_end)?></strong> </td>
                    </tr>
                </table>
                </form>
              </div>
            </div>

          </div>

        </div>
      </div>
    </div>
  </div>

</div> <!-- END ROW -->

</div>
</div>

<script type="text/javascript">
  // 'event_notify[]': { required: true }  
  
  $(document).ready(function() {
    $('#validate').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {        
        status: {
          required: true
        }
      },

      invalidHandler: function (event, validator) {
         //display error alert on form submit    
       },

      errorPlacement: function (label, element) { // render error placement for each input type   
        if (element.attr("name") == "event_notify[]") {
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
  });   
</script>

