<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url('dashboard')?>" class="active"> <?=$module_title; ?> </a></li>
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
              <a href="<?=base_url('training/training_list')?>" class="btn btn-blueviolet btn-xs btn-mini"> Training List</a> 
              <!-- <a href="<?=base_url('events/event_applicant_list/'.$this->uri->segment(3))?>" class="btn btn-blueviolet btn-xs btn-mini"> Event Applicant List </a> -->
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
                      <th class="tg-2v33">Training Title:</th>
                      <th class="tg-jz97"><?=$info->  training_title?></th>
                      <th class="tg-wwkm">Training Date:</th>
                      <th class="tg-6p4y">From <strong><?=date_detail_format($info->start_date)?></strong> to <strong><?=date_detail_format($info->end_date)?></strong></th>
                    </tr>
                    <tr>
                      <td class="tg-2v33">Place:</td>
                      <td class="tg-jz97"><?=$info->place?></td>
                      <td class="tg-wwkm">Registration Period:</td>
                      <td class="tg-6p4y">From <strong><?=date_detail_format($info->reg_start)?></strong> to <strong><?=date_detail_format($info->reg_end)?></strong></td>
                    </tr>                    
                    <tr>
                      <td class="tg-2v33">Number of Participants:</td>
                      <td class="tg-jz97"><?=$info->participant_no?></td>
                      <td class="tg-wwkm">Number of Participants:</td>
                      <td class="tg-6p4y"><?=$info->participant_no?></td>
                    </tr>
                    <tr>
                      <td class="tg-2v33" valign="top">Training Type:</td>
                      <td class="tg-jz97" valign="top">
                        <?=$info->tt_national == 1 ? '<i class="fa fa-check-circle"></i> National ':'';?><br>
                        <?=$info->tt_international == 1 ? '<i class="fa fa-check-circle"></i> International <br>':'';?>
                        <?=$info->tt_region == 1 ? '<i class="fa fa-check-circle"></i> Region <br>':'';?>
                        <?=$info->tt_district == 1 ? '<i class="fa fa-check-circle"></i> District <br>':'';?>
                        <?=$info->tt_upazila == 1 ? '<i class="fa fa-check-circle"></i> Upazila <br>':'';?>                        
                      </td>
                      <td class="tg-wwkm">Scouts Office</td>
                      <td class="tg-6p4y" valign="top">
                        <?php
                          if($info->tt_region){
                            echo '<b><u>Scouts Region</u></b><br>';
                            // echo $info->et_region_ids;
                            $regionIds = explode(',', $info->tt_region_ids);
                            // print_r($regionIds);
                            foreach ($regionIds as $value) {
                              // echo $value;
                              echo $this->Common_model->get_region_office_single($value);
                              echo '<br>';
                            }
                          }

                          if($info->tt_district){
                            echo '<b><u>Scouts District</u></b><br>';
                            $districtIds = explode(',', $info->tt_district_ids);
                            foreach ($districtIds as $value) {
                              echo $this->Common_model->get_district_office_single($value);
                              echo '<br>';
                            }
                          }

                          if($info->tt_upazila){
                            echo '<b><u>Scouts Upazila</u></b><br>';
                            $upazilaIds = explode(',', $info->tt_upazila_ids);
                            foreach ($upazilaIds as $value) {
                              echo $this->Common_model->get_upazila_office_single($value);
                              echo '<br>';
                            }
                          }
                        ?>
                      </td>
                    </tr>

                    <tr>
                      <td class="tg-2v33" valign="top">Approve Role:<br>Training Create From:</td>
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
                      <td class="tg-jz97" colspan="3"><?=nl2br($info->details)?></td>
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

                              echo '<a href="'.base_url('training_docs/'.$value->file_name).'" download="'.$value->file_name.'" class="btn btn-mini btn-xs btn-success" style="margin-bottom:2px;">Download - '.$value->file_name.'</a><br>';                              
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

