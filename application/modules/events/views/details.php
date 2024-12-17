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
            <?php //if($this->ion_auth->is_admin()){ ?>
            <div class="pull-right">
              <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin()){ ?>
              <a href="<?=base_url('events/event_applicant_list/'.$this->uri->segment(3))?>" class="btn btn-blueviolet btn-xs btn-mini"> Event Applicant List </a>
              <!-- <a href="<?=base_url('events/event_participant_list')?>" class="btn btn-blueviolet btn-xs btn-mini"> Event Participant List</a>  -->
              <!-- <a href="<?=base_url('events/upcomming_event_list')?>" class="btn btn-success btn-xs btn-mini"> Upcomming Events List</a>  -->
              <?php } ?>
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
                      <td class="tg-jz97">
                        <?php
                        echo $info->event_organizer;
                        // if($info->event_level == 'nhq'){                        
                        //   echo 'National Headquarter';
                        // }elseif($info->event_level == 'region'){
                        //   echo $info->region_name;
                        // }elseif($info->event_level == 'district'){
                        //   echo $info->dis_name;
                        // }
                        ?>
                      </td>
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
                      <td class="tg-2v33" valign="top">Event Type:</td>
                      <td class="tg-jz97" valign="top">
                        <?=$info->et_national == 1 ? '<i class="fa fa-check-circle"></i> National ':'';?><br>
                        <?=$info->et_international == 1 ? '<i class="fa fa-check-circle"></i> International <br>':'';?>
                        <?=$info->et_region == 1 ? '<i class="fa fa-check-circle"></i> Region <br>':'';?>
                        <?=$info->et_district == 1 ? '<i class="fa fa-check-circle"></i> District <br>':'';?>
                        <?=$info->et_upazila == 1 ? '<i class="fa fa-check-circle"></i> Upazila <br>':'';?>                        
                      </td>
                      <td class="tg-wwkm">Scouts Office</td>
                      <td class="tg-6p4y" valign="top">
                        <?php
                          if($info->et_region){
                            echo '<b><u>Scouts Region</u></b><br>';
                            // echo $info->et_region_ids;
                            $regionIds = explode(',', $info->et_region_ids);
                            // print_r($regionIds);
                            foreach ($regionIds as $value) {
                              // echo $value;
                              echo $this->Event_model->get_region_office_single($value);
                              echo '<br>';
                            }
                          }

                          if($info->et_district){
                            echo '<b><u>Scouts District</u></b><br>';
                            $districtIds = explode(',', $info->et_district_ids);
                            foreach ($districtIds as $value) {
                              echo $this->Event_model->get_district_office_single($value);
                              echo '<br>';
                            }
                          }

                          if($info->et_upazila){
                            echo '<b><u>Scouts Upazila</u></b><br>';
                            $upazilaIds = explode(',', $info->et_upazila_ids);
                            foreach ($upazilaIds as $value) {
                              echo $this->Event_model->get_upazila_office_single($value);
                              echo '<br>';
                            }
                          }
                        ?>
                      </td>
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
                      <td class="tg-wwkm">Official/Rover Volunteer</td>
                      <td class="tg-6p4y" valign="top">
                        <?php
                          if($info->need_office=='Yes'){
                            echo '<b><u>Need Official</u></b><br>';
                            echo 'Quantities '.$info->need_office_qty.'<br>';
                            echo 'Adult Leader Stage ('.$this->Event_model->get_badges_single($info->need_office_stage).')';
                            echo '<br>';
                          }

                          if($info->need_rover=='Yes'){
                            echo '<b><u>Need Rover Volunteer</u></b><br>';
                            echo 'Quantities '.$info->need_rover_qty.'<br>';
                            echo 'Rover Stage ('.$this->Event_model->get_badges_single($info->need_rover_stage).')';
                          }
                        ?>
                      </td>
                    </tr>

                    <tr>
                      <td class="tg-2v33" valign="top">Approve Role:<br>Event Create From:</td>
                      <td class="tg-jz97" valign="top"><?php
                      echo $info->office_rules_name.'<br>'; 

                      if($info->created_office_by==1){
                        echo 'National Headquarter';
                      }elseif($info->created_office_by==2){
                        echo 'Region';
                      }elseif($info->created_office_by==3){
                        echo 'District';
                      }elseif($info->created_office_by==4){
                        echo 'Upazila';
                      }
                      ?></td>
                      <td class="tg-wwkm">Created<br>Updated</td>
                      <td class="tg-6p4y" valign="top"><?=$info->created?><br><?=$info->updated?></td>
                    </tr>

                    <tr>
                      <td class="tg-2v33" valign="top">Event Details:</td>
                      <td class="tg-jz97" colspan="3"><?=nl2br($info->event_details)?></td>
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
                      <td class="tg-wwkm">Published</td>
                      <td class="tg-6p4y" valign="top"><?=$info->published?></td>
                    </tr>

                  </table>
                  <!-- </div> -->
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

