<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url()?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <div class="row-fluid">
      <div class="span12">
        <div class="grid simple ">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <?php if($this->ion_auth->is_admin()){ ?>
              <div class="pull-right">
                <a href="<?=base_url('training/create_training')?>" class="btn btn-primary btn-xs btn-mini"> Create Training </a>
                <a href="<?=base_url('training/training_list')?>" class="btn btn-success btn-xs btn-mini"> All Training List</a> 
                <a href="<?=base_url('training/upcomming_training_list')?>" class="btn btn-success btn-xs btn-mini"> Upcomming Training List</a> 
              </div> 
            <?php } ?>           
          </div>

           <style type="text/css">
      .tg  {border-collapse:collapse;border-spacing:0;}
      .tg td{font-family:Arial, sans-serif;font-size:14px;padding:3px 10px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border:0 solid #ccc;}
      .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:3px 10px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border:0 solid #ccc; font-weight: bold; vertical-align: top}
      .tg .tg-9vst{background-color:#efefef;text-align:right;}
    </style>

          <div class="grid-body ">
            <div id="infoMessage"><?php //echo $message;?></div>            
            <?php if($this->session->flashdata('success')):?>
                <div class="alert alert-success">
                    <a class="close" data-dismiss="alert">&times;</a>
                    <?php echo $this->session->flashdata('success');?>
                </div>
            <?php endif; ?>
            <?php if($this->session->flashdata('warning')):?>
                <div class="alert alert-warning">
                    <a class="close" data-dismiss="alert">&times;</a>
                    <?php echo $this->session->flashdata('warning');?>
                </div>
            <?php endif; ?>

            <div class="tiles white details">
                
                <div class="row">
                    <div class="col-md-12">
                      <div class="scout-verify-box">
                        <h4 style="font-weight: bold; border-bottom: 1px solid #ccc;"> Basic Information</h4>
                        <table class="tg">
                          <tr>
                            <th class="tg-9vst">Training Name:</th>
                            <td class="tg-031e" width="300"><?php echo $this->Common_model->explote_array($this->Common_model->get_dd_training_list(),$training->training_name);?></td>
                            <th rowspan="7" class="tg-9vst">Details:</th>
                            <td rowspan="7" class="tg-031e" valign="top"><?=$training->training_details?></td>
                          </tr>
                          <tr>
                            <th class="tg-9vst">Training Center:</th>
                            <td class="tg-031e"><?=$training->training_center?></td>
                          </tr>
                          <tr>
                            <th class="tg-9vst">Trainers/Trainee:</th>
                            <td class="tg-031e"><?=$training->trainer_name?></td>
                          </tr>
                          <tr>
                            <th class="tg-9vst">From Date:</th>
                            <td class="tg-031e"><?=date_bangla_format($training->training_start_date)?></td>
                          </tr>
                          <tr>
                            <th class="tg-9vst">To Date:</th>
                            <td class="tg-031e"><?=date_bangla_format($training->training_end_date)?></td>
                          </tr>
                          <tr>
                            <th class="tg-9vst">Training Duration:</th>
                            <td class="tg-031e"><?=$training->training_duration?></td>
                          </tr>
                          <tr>
                            <th class="tg-9vst">Minimum Attendance:</th>
                            <td class="tg-031e"><?=$training->min_attendance?></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 20px;">
                  <div class="col-md-12">
                    <div class="scout-verify-box">
                      <h4 style="font-weight: bold; border-bottom: 1px solid #ccc;"> Training Created by/ Organizetion</h4>
                      <table class="tg">
                        
                        <tr>
                          <th class="tg-9vst">Scout Group:</th>
                          <td class="tg-031e"><?=$training->grp_name?></td>
                        </tr>
                        <tr>
                          <th class="tg-9vst">S. Upazila/Thana:</th>
                          <td class="tg-031e"><?=$training->upa_name?></td>
                        </tr>
                        <tr>
                          <th class="tg-9vst">S. District:</th>
                          <td class="tg-031e"><?=$training->dis_name?></td>
                        </tr>
                        <tr>
                          <th class="tg-9vst">Scout Region:</th>
                          <td class="tg-031e"><?=$training->region_name?></td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
                <?php if($this->ion_auth->is_admin()){ ?>

                  <div class="row" style="margin-top: 20px;">
                    <div class="col-md-12">
                      <div class="scout-verify-box">
                        <h4 style="font-weight: bold; border-bottom: 1px solid #ccc;"> Status Report</h4>
                        <table class="tg">
                          
                          <thead>
                            <tr>
                              <th style="width:2%"> SL </th>
                              <th style="width:8%">Scout Id</th>
                              <th style="width:20%">Name</th>
                              <th style="width:30%">Comments</th>
                              <th style="width:20%">Status</th>
                              <th style="width:20%" class="text-center">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php if(!empty($scout_member_list)){
                              $i=0;
                              foreach ($scout_member_list as $row) {
                                ?>
                              <tr>
                                <td class="v-align-middle"><?=++$i?></td>
                                <td class="v-align-middle"><?=$row->scoutid?></td>
                                <td class="v-align-middle"><?=$row->first_name?></td>
                                <td class="v-align-middle"><?=$row->comments?></td>
                                <td class="v-align-middle"><?=$row->status?></td>
                                <td class="text-center">
                                  <a href="<?=base_url('training/status/'.$row->scout_id.'/'.$training->id.'/3');?>" class="btn-success btn-sm">Approved</a>
                                  <a href="<?=base_url('training/status/'.$row->scout_id.'/'.$training->id.'/4');?>" class="btn-info btn-sm">Not Approved</a>
                                </td>
                              </tr>
                                <?php
                              }
                            }?>
                          
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <?php }else{ ?>
                    <div class="row" style="margin-top: 20px;">
                      <div class="col-md-12">
                        <div class="scout-verify-box">
                          <h4 style="font-weight: bold; border-bottom: 1px solid #ccc;"> Status Report</h4>
                          <table class="tg" id="">
                            <tbody>
                                <tr>
                                  <td class="tg-9vst">Status :</td>
                                  <td class="tg-031e"><?php if(!empty($scout_member)){ echo $scout_member->status; }?></td>
                                  <td class="text-right">
                                    <?php if(!empty($scout_member)){ 
                                       if($scout_member->status =='Approved' OR $scout_member->status =='Not Approved'){ 
                                         
                                      }else{ ?>
                                          <a href="<?=base_url('training/status/'.$users->id.'/'.$training->id.'/1');?>" class="btn-success btn-sm">Interested</a>
                                          <a href="<?=base_url('training/status/'.$users->id.'/'.$training->id.'/2');?>" class="btn-info btn-sm">Not Interested</a>
                                        <?php }
                                    }else{ ?>
                                          <a href="<?=base_url('training/status/'.$users->id.'/'.$training->id.'/1');?>" class="btn-success btn-sm">Interested</a>
                                          <a href="<?=base_url('training/status/'.$users->id.'/'.$training->id.'/2');?>" class="btn-info btn-sm">Not Interested</a>
                                    <?php } ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="tg-9vst">Comment :</td>
                                  <td class="tg-031e" colspan="2"><?php  if(!empty($scout_member)){  echo  $scout_member->comments; } ?></td>
                                </tr>
                            </tbody>
                          </table>
                      </div>
                    </div>
                  </div>
                  <?php } ?>
            </div>
            
          </div>
        </div>
      </div>
    </div>

    </div> <!-- END ROW -->

  </div>
</div>