<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url('application_list')?>" class="active"> <?=$module_title; ?> </a></li>
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
            <a class="btn btn-mini btn-success" style="float:right !important;" href="<?=base_url("events/export_event_applicant_list/".encrypt_url($results['info']->id))?>" target="_blank"> Export to Excel <i class="icon-download-alt"></i></a>
          </div>

          <div class="grid-body ">
            <div id="infoMessage"><?php //echo $message;?></div>
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');?>
              </div>
            <?php endif; ?>

            <div class="row">
              <div class="col-md-12">
                <!-- <div class="scout-verify-box"> -->
                  <table class="tg">
                    <tr>
                      <th class="tg-2v33">Event Title:</th>
                      <th class="tg-jz97"><?=$results['info']->event_title?></th>
                      <th class="tg-wwkm">Event Date:</th>
                      <th class="tg-6p4y">From <strong><?=date_detail_format($results['info']->event_start_date)?></strong> to <strong><?=date_detail_format($results['info']->event_end_date)?></strong></th>
                    </tr>
                    <tr>
                      <td class="tg-2v33">Event Venue:</td>
                      <td class="tg-jz97"><?=$results['info']->event_venue?></td>
                      <td class="tg-wwkm">Registration Period:</td>
                      <td class="tg-6p4y">From <strong><?=date_detail_format($results['info']->event_reg_start)?></strong> to <strong><?=date_detail_format($results['info']->event_reg_end)?></strong></td>
                    </tr>
                    <tr>
                      <td class="tg-2v33">Event Organizer:</td>
                      <td class="tg-jz97">
                      <?php
                        echo $results['info']->event_organizer;
                        // if($results['info']->event_level == 'nhq'){
                        //   echo 'National Headquarter';
                        // }elseif($results['info']->event_level == 'region'){
                        //   echo $results['info']->region_name;
                        // }elseif($results['info']->event_level == 'district'){
                        //   echo $results['info']->dis_name;
                        // }
                        ?>
                      </td>
                      <td class="tg-wwkm">Created:</td>
                      <td class="tg-6p4y"><?=date('d F, Y h:i A', strtotime($results['info']->created))?></td>
                    </tr>
                  </table>
                <!-- </div> -->
              </div>
            </div>

            <br><br>

            <?php if($results['member_list']) {  //print_r($results);?>
            <table class="table table-hover table-condensed" id="example">
              <thead>
                <tr>
                  <th style="width:2%"> SL </th>
                  <th style="width:10%">Scout ID</th>
                  <th style="width:20%">Full Name</th>
                  <th style="width:15%">Member Type</th>
                  <th style="width:10%">Apply As</th>
                  <th style="width:10%">Group Verify</th>
                  <th style="width:10%">District Verify</th>
                  <th style="width:10%">Region Verify</th>
                  <th style="width:10%">NHQ Verify</th>
                  <th style="width:10%" class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sl = 0;
                foreach ($results['member_list'] as $row):
                  $sl++;
                  $status = '';
                  $group_verify = event_verify_status($row->verify_group);
                  $district_verify = event_verify_status($row->verify_district);
                  $region_verify = event_verify_status($row->verify_region);
                  $nhq_verify = event_verify_status($row->verify_nhq);
                  // if($results['info']->created_office_by == 4){ //Upazila
                  //   $district_verify = 'Not Applicable';
                  //   $region_verify = 'Not Applicable';
                  //   $nhq_verify = 'Not Applicable';
                  // }
                ?>
                <tr>
                  <td class="v-align-middle"><?=$sl?></td>
                  <td class="v-align-middle"><?=$row->scout_id?></td>
                  <td class="v-align-middle"><?=$row->first_name;?></td>
                  <td class="v-align-middle"><?=$row->member_type_name?></td>
                  <td class="v-align-middle"><?=get_event_participant_type($row->participant_type_id)?></td>

                  <td class="tg-2bev2"><?=$group_verify?></td>
                  <td class="tg-2bev2"><?=$district_verify?></td>
                  <td class="tg-2bev2"><?=$region_verify?></td>
                  <td class="tg-2bev2"><?=$nhq_verify?></td>

                  <td data-label="Action" class="text-right">
                      <div class="btn-group">
                        <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#">
                          Action <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu pull-right">
                          <li><a target="_blank" href="<?=base_url("scouts_member/details/".encrypt_url($row->user_id))?>"  class="btn btn-primary btn-mini">Details</a></li>
                          <li><a href="<?=base_url('events/participant_verify/'.encrypt_url($row->id));?>">Verify</a></li>
                        </ul>
                      </div>
                    </td>
                </tr>
              <?php endforeach; ?>

            </tbody>
          </table>

          <?php }else{ ?>
          <div class="alert alert-block alert-error fade in">
            <h4 class="alert-heading"><i class="icon-warning-sign"></i>No data found!</h4>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>

</div> <!-- END ROW -->

</div>
</div>
