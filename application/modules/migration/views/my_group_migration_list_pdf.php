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
            <table class="table table-hover table-condensed">
              <thead>
                <tr>
                  <th style="width:2%"> SL </th>
                  <th style="width:14%">Scout ID</th>
                  <th style="width:20%">Name</th>
                  <th style="width:15%">App. Date</th>
                  <th style="width:15%">Release Group Verify</th>
                  <th style="width:15%">Migration Group Verify</th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($results)){
                  $sl=0;
                  foreach ($results as $row) {
                    $sl++;
                ?>
                  <tr>
                    <td class="v-align-middle"><?=$sl?></td>
                    <td class="v-align-middle"><?=$row->scout_id?></td>
                    <td class="v-align-middle"><?=$row->first_name?></td>
                    <td class="v-align-middle"><?=date_bangla_format($row->created)?></td>
                    <td class="v-align-middle"><?=migrate_verify_status($row->curr_group_verify)?></td>
                    <td class="v-align-middle"><?=migrate_verify_status($row->mig_group_verify)?></td>
                  </tr>
              <?php
                  }
                }?>
              
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    </div> <!-- END ROW -->

  </div>
</div>