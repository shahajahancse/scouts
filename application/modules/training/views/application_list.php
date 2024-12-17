<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url('dashboard')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

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
              <!-- <a href="<?=base_url('Events/application_list_pdf')?>" class="btn btn-primary btn-xs btn-mini" style="float: right;">PDF Download</a> -->
            <table class="table table-hover table-condensed" id="example">
              <thead>
                <tr>
                  <th style="width:2%"> SL </th>
                  <th style="width:30%">Training Title<br>Training Date</th>
                  <th style="width:20%">Scout ID <br>Full Name</th>
                  <th style="width:10%">App. Date</th>
                  <th style="width:10%">Verify Status</th>
                  <th style="width:10%" class="text-center">Action</th>
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
                  <td class="v-align-middle"><?=$sl?></td>
                  <td class="v-align-middle"><a href="<?=base_url('training/details/'.encrypt_url($row->triningid));?>" target="_blank" ><strong><?=$row->training_title?></strong></a> <br> <?=date('d M, Y', strtotime($row->start_date))?> to <?=date('d M, Y', strtotime($row->end_date))?></td>
                  <td class="v-align-middle"><a href="<?=base_url('scouts_member/details/'.encrypt_url($row->user_id));?>" target="_blank"><strong> <?=$row->scout_id?></strong></a> <br> <?=$row->first_name?></td>
                  <td class="v-align-middle"><?=date('d M, Y', strtotime($row->app_date))?></td>          
                  <td class="v-align-middle"><?=$status?> </td>
                  <td align="right">
                     <div class="btn-group"> <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> Action <span class="caret"></span> </a>
                       <ul class="dropdown-menu pull-right">
                        <li><a href="<?=base_url('training/participant_verify/'.encrypt_url($row->id));?>">Verify</a></li>
                        <?php /*<li><a href="<?=base_url('events/edit/'.$row->id);?>">Cancel</a></li>*/ ?>
                      </ul>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?> 

            </tbody>
          </table>

          <div class="row">
            <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> Total <span style="color: green; font-weight: bold;"><?php echo $total_rows; ?> Total Application </span></div>
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