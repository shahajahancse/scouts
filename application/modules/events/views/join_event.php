<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url()?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?> </li>
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
              <a href="<?=base_url('events/my_application')?>" class="btn btn-blueviolet btn-xs btn-mini"> My Application List </a>
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

            <div class="tiles white details">
              <div class="row">
                <div class="col-md-12">
                  <table class="tg">
                    <tr>
                      <th class="tg-2v33">Event Title:</th>
                      <th class="tg-jz97"><?=$info->event_title?></th>
                      <th class="tg-wwkm">Event Date:</th>
                      <th class="tg-6p4y">From <strong><?=date_detail_format($info->event_start_date)?></strong> to <strong><?=date_detail_format($info->event_end_date)?></strong></th>
                    </tr>
                    <tr>
                      <td class="tg-2v33">Event Vanu:</td>
                      <td class="tg-jz97"><?=$info->event_venu?></td>
                      <td class="tg-wwkm">Registration Period:</td>
                      <td class="tg-6p4y">From <strong><?=date_detail_format($info->event_reg_start)?></strong> to <strong><?=date_detail_format($info->event_reg_end)?></strong></td>
                    </tr>
                    <tr>
                      <td class="tg-2v33">Event Organizer:</td>
                      <td class="tg-jz97">
                        <?php
                        if($info->event_level == 'nhq'){                        
                          echo 'National Headquarter';
                        }elseif($info->event_level == 'region'){
                          echo $info->region_name;
                        }elseif($info->event_level == 'district'){
                          echo $info->dis_name;
                        }
                        ?>
                      </td>
                      <td class="tg-wwkm">Join As Request:</td>
                      <td class="tg-6p4y">

                      <?php 
                      $attributes = array('id' => 'validate');
                      echo form_open_multipart("events/join_event/".$info->id, $attributes);
                      ?>
                      <div class="row form-row">
                        <div class="col-md-8">
                          <!-- <label class="form-label">Select Scout Region</label> -->
                          <?php 
                          echo form_error('participant_type_req');
                          $more_attr = 'class="form-control input-sm"';
                          echo form_dropdown('participant_type_req', $participant_type, set_value('participant_type_req'), $more_attr);
                          ?>
                        </div>
                        <div class="col-md-4">
                          <input type="hidden" name="event_id" value="<?=$info->id?>">
                          <button type="submit" class="btn btn-blueviolet"><i class="icon-ok"></i> Apply Event</button>
                        </div>
                      </div>
                      </form>
                      </td>
                    </tr>
                    <tr>
                      <td class="tg-2v33" valign="top">Event Details:</td>
                      <td class="tg-jz97" colspan="3"><?=nl2br($info->event_details)?></td>
                    </tr>
                  </table>
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
        participant_type_req: {
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

