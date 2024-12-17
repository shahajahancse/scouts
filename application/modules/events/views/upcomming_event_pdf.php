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

            <?php if($results) {  //print_r($results);?>
            <table class="table table-hover table-condensed" id="example">
              <thead>
                <tr>
                  <th style="width:5%"> SL </th>
                  <th style="width:28%">Event Name</th>
                  <th style="width:20%">Venue</th>
                  <th style="width:10%">From Date</th>
                  <th style="width:10%">To Date</th>
                  <th style="width:10%">Reg. Start</th>
                  <th style="width:10%">Reg. End</th>
                  <th style="width:10%" class="text-center">Join Event</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $sl = 0;
                foreach ($results as $row):
                  $sl++;
                ?>
                <tr>
                  <td class="v-align-middle"><?=$sl?></td>
                  <td class="v-align-middle"><a href="<?=base_url('events/details/'.$row->id);?>"><strong><?=$row->event_title?></strong></a></td>
                  <td class="v-align-middle"><?=$row->event_venu?></td>
                  <td class="v-align-middle"><?=date('d M, y', strtotime($row->event_start_date))?></td>
                  <td class="v-align-middle"><?=date('d M, y', strtotime($row->event_end_date))?></td>
                  <td class="v-align-middle"><?=date('d M, y', strtotime($row->event_reg_start))?></td>
                  <td class="v-align-middle"><?=date('d M, y', strtotime($row->event_reg_end))?></td>
                  <?php if($row->id == $row->parti_event_id){?>
                  <td align="right"><a href="<?=base_url('events/join_event/'.$row->id);?>" class="btn btn-blueviolet btn-mini disabled">Already Applied</a> </td>
                  <?php }else{ ?>
                  <td align="right"><a href="<?=base_url('events/join_event/'.$row->id);?>" class="btn btn-blueviolet btn-mini">Apply for Join</a> </td>
                  <?php } ?>
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