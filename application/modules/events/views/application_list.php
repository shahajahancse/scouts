<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url()?>" class="active"> <?=$module_title; ?> </a></li>
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

      .table {
        width: 100%;
        max-width: 100%;
        margin-bottom: 1rem;
        background-color: transparent;
        border-collapse: collapse;
      }

      .table th,
      .table td {
        padding: 0.75rem;
        vertical-align: middle;
        border-top: 1px solid #dee2e6;
      }

      /* Desktop styles */
      @media screen and (min-width: 768px) {
        .table th {
          position: sticky;
          top: 0;
          background: #fff;
          z-index: 1;
        }

        .btn-group {
          display: inline-flex;
        }

        .dropdown-menu {
          min-width: 120px;
        }
      }

      /* Mobile styles */
      @media screen and (max-width: 767px) {
        .table-responsive {
          border: 0;
        }

        .table {
          border: 0;
        }

        .table thead {
          border: none;
          clip: rect(0 0 0 0);
          height: 1px;
          margin: -1px;
          overflow: hidden;
          padding: 0;
          position: absolute;
          width: 1px;
        }

        .table tr {
          border-bottom: 3px solid #ddd;
          display: block;
          margin-bottom: .625em;
          background: #fff;
          box-shadow: 0 1px 3px rgba(0,0,0,0.12);
          border-radius: 3px;
          padding: 8px;
        }

        .table td {
          border-bottom: 1px solid #ddd;
          display: block;
          font-size: .8em;
          text-align: right;
          padding: .625em;
          position: relative;
          padding-left: 50%;
        }

        .table td::before {
          content: attr(data-label);
          float: left;
          font-weight: bold;
          text-transform: uppercase;
          position: absolute;
          left: 8px;
          width: 45%;
          padding-right: 10px;
          white-space: nowrap;
          color: #666;
        }

        .table td:last-child {
          border-bottom: 0;
        }

        .btn-group {
          display: flex;
          flex-direction: column;
          width: 100%;
        }

        .btn {
          margin: 2px 0;
          width: 100%;
          text-align: center;
        }

        .dropdown-menu {
          width: 100%;
          position: static;
          float: none;
          box-shadow: none;
          border: 1px solid #ddd;
        }

        .dropdown-menu > li > a {
          padding: 10px;
        }

        .pagination {
          display: flex;
          flex-wrap: wrap;
          justify-content: center;
          gap: 5px;
        }
      }

      /* Additional enhancements */
      .table-hover tbody tr:hover {
        background-color: rgba(0,0,0,.075);
      }

      .v-align-middle {
        vertical-align: middle !important;
      }

      .alert {
        margin-bottom: 1rem;
        padding: 1rem;
        border-radius: 3px;
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
              <a href="<?=base_url('Events/application_list_pdf')?>" class="btn btn-primary btn-xs btn-mini" style="float: right; margin-bottom: 10px;">PDF Download</a>
            <div class="table-responsive">
              <table class="table table-hover table-condensed" id="example">
                <thead>
                  <tr>
                    <th> SL </th>
                    <th>Event Name / Event Date</th>
                    <th>Scout ID / Full Name</th>
                    <th>Apply As / App. Date</th>
                    <th>Verify Status</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $sl = $pagination['current_page'];
                  foreach ($results as $row):
                    $sl++;
                    
                  $status = '';
                  if($this->ion_auth->is_admin()){
                    $status = event_verify_status($row->verify_nhq);
                  }elseif($this->ion_auth->is_region_admin()){
                    $status = event_verify_status($row->verify_region);
                  }elseif($this->ion_auth->is_district_admin()){
                    $status = event_verify_status($row->verify_district);
                  }elseif($this->ion_auth->is_upazila_admin()){
                    $status = event_verify_status($row->verify_upazila);
                  }elseif($this->ion_auth->is_group_admin()){
                    $status = event_verify_status($row->verify_group);
                  }
                  ?>
                  <tr>
                    <td data-label="SL"><?=$sl?></td>
                    <td data-label="Event Details">
                      <a href="<?=base_url('events/details/'.$row->eventid);?>" target="_blank" >
                        <strong><?=$row->event_title?></strong>
                      </a> 
                      <br> 
                      <small><?=date('d M, Y', strtotime($row->event_start_date))?> to <?=date('d M, Y', strtotime($row->event_end_date))?></small>
                    </td>
                    <td data-label="Scout Details">
                      <a href="<?=base_url('scouts_member/details/'.encrypt_url($row->user_id));?>" target="_blank">
                        <strong><?=$row->scout_id?></strong>
                      </a> 
                      <br> 
                      <small><?=$row->first_name?></small>
                    </td>
                    <td data-label="Application Details">
                      <?=get_event_participant_type($row->participant_type_id)?>
                      <br>
                      <small><?=date('d M, Y', strtotime($row->app_date))?></small>
                    </td>          
                    <td data-label="Status"><?=$status?></td>
                    <td data-label="Action" class="text-right">
                      <div class="btn-group"> 
                        <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> 
                          Action <span class="caret"></span> 
                        </a>
                        <ul class="dropdown-menu pull-right">
                          <li><a href="<?=base_url('events/participant_verify/'.encrypt_url($row->id));?>">Verify</a></li>
                        </ul>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?> 
              </tbody>
            </table>
            </div>

            <div class="row">
              <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> 
                Total <span style="color: green; font-weight: bold;"><?php echo $total_rows; ?> Total Application </span>
              </div>
              <div class="col-sm-8 col-md-8 text-right">
                <?php echo $pagination['links']; ?>
              </div>
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