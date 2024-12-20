<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url('events/upcomming_event')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <div class="row-fluid">
      <div class="span12">
        <div class="grid simple ">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <!-- <a href="<?=base_url('events/create_event')?>" class="btn btn-blueviolet btn-xs btn-mini"> My Application List </a> -->
            </div> 
          </div>

          <div class="grid-body ">
            <div id="infoMessage"><?php //echo $message;?></div>            
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');?>
              </div>
            <?php endif; ?>


            <style type="text/css">
              .tg  {border-collapse:collapse;border-spacing:0; width: 100%; color: black;}
              .tg td{font-family:Arial, sans-serif;font-size:14px;padding:4px 4px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
              .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:4px 4px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
              .tg .tg-8dgf{font-weight:bold;border-color:#656565;text-align:left}
              .tg .tg-8dgf2{font-weight:bold;border-color:#656565;text-align:left; padding: 2; font-size: 12px; font-weight: bold;border-color: #cabebe; font-style: italic;}
              .tg .tg-hkgo{font-weight:bold;border-color:#656565;text-align:left;vertical-align:top}
              .tg .tg-9qvm{border-color:#656565;text-align:left}
              .tg .tg-2bev{border-color:#656565;text-align:left;vertical-align:top}
              .tg .tg-2bev2{border-color:#656565;text-align:left;vertical-align:top; border-color: #cabebe;}
            </style>
            <?php if($results) {  //print_r($results);?>
            <?php 
            // echo '<pre>';
            // print_r($results); exit;
            ?>
            <table class="tg">
              <tr>
                <th class="tg-8dgf">SL</th>
                <th class="tg-8dgf">Event Name</th>
                <th class="tg-8dgf">Event Organizer</th>
                <th class="tg-hkgo">Event Date</th>
                <th class="tg-hkgo">Event Category</th>
                <th class="tg-hkgo">Action</th>
              </tr>

              <?php 
              $sl = 0;        
              foreach ($results as $row):
                $sl++;
                $group_verify = event_verify_status($row->verify_group);
                $upazila_verify = event_verify_status($row->verify_upazila);

              if($row->created_office_by == 1){ //NHQ
                $district_verify = event_verify_status($row->verify_district);
                $region_verify = event_verify_status($row->verify_region);
                $nhq_verify = event_verify_status($row->verify_nhq);

              }elseif($row->created_office_by == 2){ //Region
                $district_verify = event_verify_status($row->verify_district);
                $region_verify = event_verify_status($row->verify_region);
                $nhq_verify = 'Not Applicable';

              }elseif($row->created_office_by == 3){ //District
                $district_verify = event_verify_status($row->verify_district);
                $region_verify = 'Not Applicable';
                $nhq_verify = 'Not Applicable';

              }elseif($row->created_office_by == 4){ //Upazila                
                $district_verify = 'Not Applicable';
                $region_verify = 'Not Applicable';
                $nhq_verify = 'Not Applicable';
              }

              ?>
              <tr>
                <td class="tg-9qvm" rowspan="2" style="border-bottom: 3px solid black;"><?=$sl?></td>
                <td class="tg-9qvm"><a href="<?=base_url('events/details/'.encrypt_url($row->id));?>"><strong><?=$row->event_title?></strong></a></td>
                <td class="tg-9qvm"><?=$row->event_organizer?></td>
                <td class="tg-2bev"><?=date('d M, y', strtotime($row->event_start_date))?> to <?=date('d M, y', strtotime($row->event_end_date))?></td>
                <td class="tg-2bev"><?php echo $row->event_cate_name;?></td>
                <td class="tg-2bev"><a href="<?=base_url('events/my_app_cancle/'.$row->app_id);?>" onclick="return confirm('Are you sure you want to cancle this application?');" class="btn btn-blueviolet btn-mini">Cancle Application</a></td>
              </tr>
              <tr>
                <td class="tg-9qvm" colspan="5" style="border-bottom: 3px solid black;"> 
                  <table width="100%">
                    <tr>
                      <th class="tg-8dgf2">App. Date</th>
                      <th class="tg-8dgf2">Apply As</th>
                      <th class="tg-8dgf2">Group Verify</th>
                      <th class="tg-8dgf2">Upazila Verify</th>
                      <th class="tg-8dgf2">District Verify</th>
                      <th class="tg-8dgf2">Region Verify</th>
                      <th class="tg-8dgf2">NHQ Verify</th>
                    </tr>
                    <tr>
                      <td class="tg-2bev2"><?=date('d M, Y', strtotime($row->app_date))?></td>
                      <td class="tg-2bev2"><?=get_event_participant_type($row->participant_type_id)?></td> 
                      <td class="tg-2bev2"><?=$group_verify?></td> 
                      <td class="tg-2bev2"><?=$upazila_verify?></td>
                      <td class="tg-2bev2"><?=$district_verify?></td>
                      <td class="tg-2bev2"><?=$region_verify?></td>
                      <td class="tg-2bev2"><?=$nhq_verify?></td>
                    </tr>
                  </table>
                </td>
              </tr>
            <?php endforeach; ?> 

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