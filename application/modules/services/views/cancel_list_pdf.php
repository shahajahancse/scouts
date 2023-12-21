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
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');?>
              </div>
            <?php endif; ?>

            <?php if($results) { ?>
            <table class="table table-hover table-condensed" id="example">
              <thead>
                <tr>
                  <th style="width:5%"> SL </th>
                  <!-- <th style="width:10%">Request To</th> -->
                  <th style="width:25%">Services Name</th>
                  <th style="width:10%">Name</th>
                  <th style="width:10%">Phone</th>
                  <th style="width:10%">Email</th>
                  <th style="width:15%">Req. Date</th>
                  <th style="width:10%">Status</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $sl=$pagination['current_page'];
                foreach ($results as $row):
                  $sl++;
                $request_type = $row->request_to == 1 ? 'NHQ' : 'Region';
                ?>
                <tr>
                  <td class="v-align-middle"><?=$sl.'.'?></td>
                  <!-- <td class="v-align-middle"><strong><?=$request_type?></strong></td> -->
                  <td class="v-align-middle"><?=$row->service_name?></td>
                  <td class="v-align-middle"><?=$row->name?></td>
                  <td class="v-align-middle"><?=$row->phone?></td>
                  <td class="v-align-middle"><?=$row->email?></td>
                  <td class="v-align-middle"><?=date_sort_form($row->created)?></td>
                  <td class="v-align-middle"><?=service_request_status($row->status)?></td>
                 
  </tr>
<?php endforeach;?>                      
</tbody>
</table>


<?php } ?>

</div>
</div>
</div>
</div>

</div> <!-- END ROW -->

</div>