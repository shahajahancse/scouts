<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url()?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <style>
      .table-responsive {
        width: 100%;
        margin-bottom: 15px;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
      }

      .table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 1rem;
      }

      .table th,
      .table td {
        padding: 12px;
        text-align: left;
        border: 1px solid #dee2e6;
        vertical-align: middle;
      }

      .table th {
        background: #f8f9fa;
        font-weight: 600;
        white-space: nowrap;
      }

      .table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
      }

      .table tbody tr:hover {
        background-color: #f5f5f5;
      }

      .grid-title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 15px;
      }

      .pagination-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 20px;
      }

      @media screen and (max-width: 767px) {
        .table th, 
        .table td {
          white-space: nowrap;
          min-width: 120px;
          font-size: 14px;
        }

        .grid-title {
          flex-direction: column;
          text-align: center;
        }

        .grid-title .pull-right {
          float: none !important;
        }

        .pagination-wrapper {
          flex-direction: column;
          text-align: center;
        }

        .pagination-wrapper .text-left,
        .pagination-wrapper .text-right {
          text-align: center !important;
        }
      }
    </style>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
            <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin()){ ?>
              <!-- <a href="<?=base_url('events/create_event')?>" class="btn btn-blueviolet btn-xs btn-mini"> Create Events </a> -->
            <?php } ?>
            </div> 
          </div>

          <div class="grid-body">
            <div id="infoMessage"><?php //echo $message;?></div>            
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');?>
              </div>
            <?php endif; ?>
            <!-- <a href="<?=base_url('Events/event_list_pdf')?>" class="btn btn-primary btn-xs btn-mini" style="float: right;">PDF Download</a> -->
            <?php if($results) {  //print_r($results);?>
              
            <div class="table-responsive">
              <table class="table table-hover" id="example">
                <thead>
                  <tr>
                    <th style="width:2%"> SL </th>
                    <th style="width:30%">Event Name</th>
                    <th style="width:20%">Venue</th>
                    <th style="width:10%">From Date</th>
                    <th style="width:10%">To Date</th>
                    <th style="width:10%">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $sl = $pagination['current_page'];
                  foreach ($results as $row):
                    $sl++;

                    if($row->event_start_date > date('Y-m-d')){
                      $status = 'Upcomming';
                    }elseif(($row->event_start_date > $row->event_end_date) && ($row->event_start_date < $row->event_end_date)){
                      $status = 'Ongoing';
                    }else{
                      $status = 'Complete';
                    }            
                  ?>
                  <tr>
                    <td class="v-align-middle"><?=$sl?></td>
                    <td class="v-align-middle"><a href="<?=base_url('events/details/'.$row->id);?>"><strong><?=$row->event_title?></strong></a></td>
                    <td class="v-align-middle"><?=$row->event_venue?></td>
                    <td class="v-align-middle"><?=date('d M, y', strtotime($row->event_start_date))?></td>
                    <td class="v-align-middle"><?=date('d M, y', strtotime($row->event_end_date))?></td>
                    <td class="v-align-middle"><span class="label label-green"><?=$status?> </span></td>
                  </tr>
                <?php endforeach; ?> 
                </tbody>
              </table>
            </div>

            <div class="pagination-wrapper">
              <div class="text-left">
                Total <span style="color: green; font-weight: bold;"><?php echo $total_rows; ?> Total Events </span>
              </div>
              <div class="text-right">
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

  </div>
</div>