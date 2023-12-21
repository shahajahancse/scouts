<style type="text/css">

table, td, th {  
  border: 1px solid #ddd;
  text-align: left;
}

table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 8px;
  color: black;

}

</style>
<div class="page-content">     
   <div class="content">  
     <div style="text-align: center;">
         <div  style="font-size: 20px;">BANGLADESH SCOUTS</div>
         <span>www.scouts.gov.bd</span>
      </div>
      <div class="row-fluid">
         <div class="span12">
            <div class="grid simple ">
             <div class="grid-title">
              <h4 align="center"><span class="semi-bold"><?=$meta_title; ?></span></h4>
              <div style="text-align: right;margin-bottom: 5px;">Date: <?= date('d F, Y') ?></div>       
            </div>

          <div class="grid-body ">
            <div id="infoMessage"><?php //echo $message;?></div>            
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');?>
              </div>
            <?php endif; ?>

            <?php if($results) {  //print_r($results);?>
            <table class="table table-hover table-condensed" id="example">
              <thead>
                <tr>
                  <th style="width:5%"> SL </th>
                  <th style="width:30%">Event Name<br>Event Date</th>
                  <th style="width:20%">Scout ID <br>Full Name</th>
                  <th style="width:10%">Join As Req. <br>App. Date</th>
                  <th style="width:13%">Join As</th>                  
                  <th style="width:10%">V. Status</th>
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
                  <td class="v-align-middle"><a href="<?=base_url('events/details/'.$row->eventid);?>"><strong><?=$row->event_title?></strong></a> <br> <?=date('d M, Y', strtotime($row->event_start_date))?> to <?=date('d M, Y', strtotime($row->event_end_date))?></td>
                  <td class="v-align-middle"><a href="<?=base_url('scouts_member/details/'.$row->user_id);?>" target="_blank"><strong><?=$row->scout_id?></strong></a> <br> <?=$row->first_name?></td>
                  <td class="v-align-middle"><?=get_event_participant_type($row->participant_type_req)?><br>
                  <?=date('d M, Y', strtotime($row->app_date))?></td>
                  <td class="v-align-middle"><?=get_event_participant_type($row->participant_type_app)?></td>
                  <td class="v-align-middle"><?=$status?> </td>
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