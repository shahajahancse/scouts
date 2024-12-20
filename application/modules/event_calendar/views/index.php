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
            <div class="pull-right">
            <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin()){ ?>
              <!-- <a href="<?=base_url('events/create_event')?>" class="btn btn-blueviolet btn-xs btn-mini"> Create Events </a> -->
            <?php } ?>
            </div> 
          </div>

          <div class="grid-body ">
            <div id="infoMessage"><?php //echo $message;?></div>            
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');?>
              </div>
            <?php endif; ?>
            <!-- <a href="<?=base_url('Events/event_list_pdf')?>" class="btn btn-primary btn-xs btn-mini" style="float: right;">PDF Download</a> -->
            <?php if($results) {  //print_r($results);?>
              
            <table class="table table-hover table-condensed" id="example">
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

          <div class="row">
            <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> Total <span style="color: green; font-weight: bold;"><?php echo $total_rows; ?> Total Events </span></div>
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