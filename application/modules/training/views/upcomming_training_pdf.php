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
            <table class="table table-hover table-condensed" id="example">
              <thead>
                <tr>
                  <th style="width:2%"> SL </th>
                  <th style="width:24%">Training Name</th>
                  <th style="width:10%">From Date</th>
                  <th style="width:10%">To Date</th>
                  <th style="width:10%">Duration</th>
                  <th style="width:10%">Type</th>
                  <th style="width:10%">Status</th>
                  <th style="width:24%" class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($training)){
                  $i=0;
                  foreach ($training as $row) {
                    ?>
                  <tr>
                    <td class="v-align-middle"><?=++$i?></td>
                    <td class="v-align-middle"><?php echo $this->Common_model->explote_array($this->Common_model->get_dd_training_list(),$row->training_name);?></td>
                    <td class="v-align-middle"><?=date_bangla_format($row->training_start_date)?></td>
                    <td class="v-align-middle"><?=date_bangla_format($row->training_end_date)?></td>
                    <td class="v-align-middle"><?=$row->training_duration?></td>
                    <td class="v-align-middle"><?=$row->training_type?></td>
                    <td class="v-align-middle">
                        <?php
                          if($row->training_start_date>date('Y-m-d')){
                            echo 'Upcomming';
                          }else if($row->training_end_date>date('Y-m-d')){
                            echo 'Running';
                          }else{
                            echo 'Past';
                          }
                        ?>
                    </td>
                    
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