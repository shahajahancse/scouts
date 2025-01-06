<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url('training/upcomming_training')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <style>
      /* Common styles */
      .table-responsive {
        width: 100%;
        margin-bottom: 15px;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
      }

      .tg {
        border-collapse: collapse;
        width: 100%;
        color: black;
      }

      .tg th, .tg td {
        padding: 8px;
        border: 1px solid #ddd;
        text-align: left;
      }

      .tg th {
        background: #f5f5f5;
        font-weight: bold;
      }

      .tg-8dgf2 {
        font-size: 12px;
        font-weight: bold;
        font-style: italic;
      }

      .tg-2bev2 {
        border-color: #cabebe;
      }

      .btn {
        margin: 2px 0;
      }

      /* Mobile styles */
      @media screen and (max-width: 767px) {
        .table-responsive {
          overflow-x: scroll;
        }

        .tg th, .tg td {
          white-space: nowrap;
          min-width: 120px;
        }

        .tg th:first-child,
        .tg td:first-child {
          position: sticky;
          left: 0;
          background: #fff;
          z-index: 1;
        }

        .btn {
          white-space: nowrap;
        }

        .nested-table td, 
        .nested-table th {
          padding: 4px;
          font-size: 12px;
        }
      }
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

            <?php if($results) {  //print_r($results);?>
            <div class="table-responsive">
              <table class="tg">
                <thead>
                  <tr>
                    <th>SL</th>
                    <th>Training Name</th>
                    <th>Course Name</th>
                    <th>Training Place</th>
                    <th>Training Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
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
                    <td><?=$sl?></td>
                    <td><a href="<?=base_url('training/details/'.encrypt_url($row->id));?>"><strong><?=$row->training_title?></strong></a></td>
                    <td><?=$row->course_id == 100 ? $row->other_course_name : $row->course_name?></td>
                    <td><?=$row->place?></td>
                    <td><?=date('d M, y', strtotime($row->start_date))?> to <?=date('d M, y', strtotime($row->end_date))?></td>
                    <td><a href="<?=base_url('training/my_app_cancle/'.encrypt_url($row->app_id));?>" onclick="return confirm('Are you sure you want to cancle this application?');" class="btn btn-blueviolet btn-mini">Cancel Application</a></td>
                  </tr>
                  <tr>
                    <td colspan="6">
                      <table class="nested-table" width="100%">
                        <tr>
                          <th class="tg-8dgf2">App. Date</th>                      
                          <th class="tg-8dgf2">Group Verify</th>
                          <th class="tg-8dgf2">Upazila Verify</th>
                          <th class="tg-8dgf2">District Verify</th>
                          <th class="tg-8dgf2">Region Verify</th>
                          <th class="tg-8dgf2">NHQ Verify</th>
                        </tr>
                        <tr>
                          <td class="tg-2bev2"><?=date('d M, Y', strtotime($row->app_date))?></td>
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
                </tbody>
              </table>
            </div>

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