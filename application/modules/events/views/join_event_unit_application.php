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
      .tg .tg-wwkm{font-weight:bold;background-color:#d8e8d8;border-color:#efefef;text-align:right;vertical-align:top}
      .tg .tg-6p4y{border-color:#efefef;text-align:left;vertical-align:top; color: black;}
      .tg .tg-2v33{font-weight:bold;background-color:#d8e8d8;border-color:#efefef;text-align:right;}
      .tg .tg-jz97{border-color:#efefef;text-align:left;color: black;}
    </style>

    <?php 
      $input=0;
      if($unit_info->unit_type == 1 || $unit_info->unit_type == 4){
        $input = 6;
      }else{
        $input = 8;
      }

    ?>
    
    <div class="row-fluid">
      <div class="span12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
          </div>

          <div class="grid-body ">
            <div id="infoMessage"><?php //echo $message;?></div>            
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');?>
              </div>
            <?php endif; ?>

            <?php 
            $attributes = array('id' => 'validateForm');
            echo form_open(uri_string(), $attributes);?>

            <div class="tiles white details">
              <div class="row">
                <div class="col-md-6">                  
                    <div class="row">
                      <div class="col-md-10 col-md-offset-1">              
                        <div class="row form-row">
                          <div class="col-md-12">
                            <label class="form-label">Adult Leader ID <span class="required">*</span></label>
                            <!-- <input type="text" name="leader_id" class="form-control input-sm"  style="text-transform: uppercase;"> -->
                            <?php $more_attr = 'class="form-control input-sm" id=""';
                            echo form_dropdown('leader_id', $scouts_member, set_value('leader_id'), $more_attr);
                            ?>
                          </div>
                          <?php for($i=1; $i <= $input; $i++) { ?>
                          <div class="col-md-8">
                            <label class="form-label">P<?=$i?> <span class="required">*</span></label>
                            <?php $more_attr = 'class="form-control input-sm" id=""';
                            echo form_dropdown('p'.$i, $scouts_member, set_value('p'.$i), $more_attr);
                            ?>
                            <!-- <input type="text" name="p<?=$i?>" class="form-control input-sm" style="text-transform: uppercase;"> -->
                          </div>
                          <?php } ?>
                        </div>

                      </div>    
                    </div>                        
                </div>

                <div class="col-md-6">
                  <table class="tg">
                    <tr>
                      <th class="tg-2v33">Unit Name:</th>
                      <th class="tg-jz97"><?=$unit_info->unit_name?></th>
                    </tr>
                    <tr>
                      <th class="tg-wwkm">Unit Type:</th>
                      <th class="tg-6p4y"><?=get_scout_unit_type($unit_info->unit_type)?></th>
                    </tr>
                    <tr>
                      <th class="tg-2v33">Event Title:</th>
                      <th class="tg-jz97"><?=$info->event_title?></th>
                    </tr>
                    <tr>
                      <td class="tg-2v33">Event Venue:</td>
                      <td class="tg-jz97"><?=$info->event_venue?></td>
                    </tr>
                    <tr>
                      <th class="tg-wwkm">Event Date:</th>
                      <th class="tg-6p4y">From <strong><?=date_detail_format($info->event_start_date)?></strong> to <strong><?=date_detail_format($info->event_end_date)?></strong></th>
                    </tr>
                    <tr>
                      <td class="tg-wwkm">Registration Period:</td>
                      <td class="tg-6p4y">From <strong><?=date_detail_format($info->event_reg_start)?></strong> to <strong><?=date_detail_format($info->event_reg_end)?></strong></td>
                    </tr>                   
                    <tr>
                      <td class="tg-2v33" valign="top">Event Participants Type:</td>
                      <td class="tg-jz97" valign="top">
                        <?php
                        if($info->ept_cub){
                          echo 'Cub ('.$this->Event_model->get_badges_single($info->cub_stage_id).')';
                          echo '<br>';
                        }
                        if($info->ept_scout){
                          echo 'Scout ('.$this->Event_model->get_badges_single($info->scout_stage_id).')';
                          echo '<br>';
                        }
                        if($info->ept_rover){
                          echo 'Rover ('.$this->Event_model->get_badges_single($info->rover_stage_id).')';
                          echo '<br>';
                        }
                        if($info->ept_leader){
                          echo 'Adult Leader ('.$this->Event_model->get_badges_single($info->leader_stage_id).')';
                        }
                        ?>
                      </td>
                    </tr>
                    <tr>
                      <td class="tg-2v33" valign="top">Attachment:</td>
                      <td class="tg-jz97">
                        <?php
                        if($attachments){
                          $sl=0;
                          foreach ($attachments as $value) {
                            $sl++;
                              //echo $value->file_name .'<button class="btn"><i class="fa fa-download"></i> Download</button>';

                            echo '<a href="'.base_url('event_docs/'.$value->file_name).'" download="'.$value->file_name.'" class="btn btn-mini btn-xs btn-success" style="margin-bottom:2px;">Download - '.$value->file_name.'</a><br>';                              
                          }
                        }
                        ?>
                      </td>                    
                    </tr>
                  </table>
                  <!-- </div> -->
                </div>
              </div>              

            </div>

            <div class="form-actions">  
                <div class="pull-right">
                  <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Apply</button>
                </div>
              </div>               
            <?php echo form_close();?>
            <input type="hidden" name="hidden_group_id" value="<?=$unit_info->unit_scout_upa_id?>">
          </div>
        </div>
      </div>
    </div>

  </div> <!-- END ROW -->

</div>
</div>

<script>
  $(document).ready(function() {
      //Select2 Ajax Dropdown for Scout ID by Scout Group
      // scout_id_by_group_select2_dd();


      $('#validateForm').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
        leader_id: { required: true},
        p1: { required: true },
        p2: { required: true },
        p3: { required: true },
        p4: { required: true },
        p5: { required: true },
        p6: { required: true },
        p7: { required: true },
        p8: { required: true }  
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


  // Select2 AJAX autocomplete for Scout ID Scout Group Wise
    // function scout_id_by_group_select2_dd(){
    //   var group_id = $('#hidden_group_id').val();
    //   $('.scoutIDGroupSelect2').select2({        
    //     placeholder: '-- Put Scout ID --',
    //     minimumInputLength: 2,
    //     ajax: {
    //       url: '<?php echo base_url()?>scouts_member/scout_id_search_by_group/'+group_id,
    //       dataType: 'json',
    //       delay: 250,
    //       processResults: function (data) {
    //         return {
    //           results: data
    //         };
    //       },
    //       cache: true
    //     }
    //   });
    // }
</script>

