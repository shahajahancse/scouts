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
    
    <div class="row-fluid">
      <div class="span12">
        <div class="grid simple ">
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

            <div class="tiles white details">
              <div class="row">
                <div class="col-md-12">
                  <!-- <div class="scout-verify-box"> -->
                  <table class="tg">
                    <tr>
                      <th class="tg-2v33">Event Title:</th>
                      <th class="tg-jz97"><?=$info->event_title?></th>
                      <th class="tg-wwkm">Event Date:</th>
                      <th class="tg-6p4y">From <strong><?=date_detail_format($info->event_start_date)?></strong> to <strong><?=date_detail_format($info->event_end_date)?></strong></th>
                    </tr>
                    <tr>
                      <td class="tg-2v33">Event Venue:</td>
                      <td class="tg-jz97"><?=$info->event_venue?></td>
                      <td class="tg-wwkm">Registration Period:</td>
                      <td class="tg-6p4y">From <strong><?=date_detail_format($info->event_reg_start)?></strong> to <strong><?=date_detail_format($info->event_reg_end)?></strong></td>
                    </tr>                    
                    <tr>
                      <td class="tg-2v33">Event Organizer:</td>
                      <td class="tg-jz97"> <?php echo $info->event_organizer; ?> </td>
                      <td class="tg-wwkm">Number of Participants:</td>
                      <td class="tg-6p4y"><?=$info->ep_qty?></td>
                    </tr>
                    <tr>
                      <td class="tg-2v33">Event Participant Category:</td>
                      <td class="tg-jz97"><?php 
                        if($info->ept_category==1){
                          echo 'Individual';
                        }else{
                          echo 'Group/Unit';
                        }
                        ?>  
                      </td>
                      <td class="tg-wwkm">Event Category:</td>
                      <td class="tg-6p4y"><?=$info->event_cate_name?></td>
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

              <?php 

              $attributes = array('id' => 'event_validate');
              echo form_open(base_url('events/join_event_as_group/'.$info->id), $attributes);?>

              <div class="row">
                <div class="col-md-4 col-md-offset-4">              
                  <div class="row form-row">
                  <?php echo validation_errors();?>
                    <div class="col-md-12">
                      <label class="form-label"> Scouts Unit </label>
                      <?php $more_attr = 'class="form-control input-sm" id=""';
                      echo form_dropdown('scouts_unit', $scouts_unit, set_value('scouts_unit'), $more_attr);
                      ?>
                    </div>
                  </div>

                  <div class="form-actions">  
                    <div class="pull-right">
                      <button type="submit" class="btn btn-primary btn-cons btn-mini"><i class="icon-ok"></i> Next</button>
                    </div>
                  </div> 
                </div>    

              </div>

              <?php echo form_close();?>

            </div>

          </div>
        </div>
      </div>
    </div>

  </div> <!-- END ROW -->

</div>
</div>

<script>
  // function group_generate_form_by_unit(){
  //     // $('.sc_unit_val').addClass('form-control input-sm');
  //     // $(".sc_unit_val > option").remove();
  //     var group_id = $('#sc_unit').val();
  //     var selected = $('#unit_id_name').val();
  //     $.ajax({
  //       type: "POST",
  //       url: hostname +"general_setting/ajax_get_scout_unit_by_scout_group/" + group_id + '/' + selected,
  //       success: function(data)
  //       {
  //         $(".unit_list").html(data);
  //         $('.unit_list').show();
  //       }
  //     });
  //   }
  //   // Scouts Unit
  //   $('#sc_unit').change(function(){
  //     group_generate_form_by_unit();
  //   });
</script>

