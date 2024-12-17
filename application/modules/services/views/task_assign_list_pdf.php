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

            <?php if($results) { ?>
            <table class="table table-hover table-condensed" id="example">
              <thead>
                <tr>
                  <th style="width:5%"> SL </th>
                  <th style="width:15%">Assign To </th>
                  <th style="width:30%">Scouts Office</th>
                  <th style="width:15%">Datatime</th>  
                  <th style="width:15%">Service Name</th>
                  <th style="width:10%">Name</th>
                  <th style="width:10%">Phone</th>                  
                  <th style="width:10%">Status</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $sl=$pagination['current_page'];
                foreach ($results as $row):
                  $sl++;
                //$request_type = $row->request_to == 1 ? 'NHQ' : 'Region';
                ?>
                <tr>
                  <td class="v-align-middle"><?=$sl.'.'?></td>
                  <td class="v-align-middle"><strong><?=func_service_assign_office_type($row->ass_to_office_id)?></strong></td>
                  <td class="v-align-middle"><strong>
                    <?php 
                    if($row->ass_to_office_id == 1){
                      echo $row->region_name;
                    }elseif($row->ass_to_office_id == 2){
                      echo $row->dis_name;
                    }elseif($row->ass_to_office_id == 3){
                      echo $row->upa_name;
                    }elseif($row->ass_to_office_id == 4){
                      echo $row->grp_name;
                    }
                    ?></strong>
                  </td>
                  <td class="v-align-middle"><?=date_sort_form($row->ass_datetime)?></td>
                  <td class="v-align-middle"><?=$row->service_name?></td>
                  <td class="v-align-middle"><?=$row->name?></td>
                  <td class="v-align-middle"><?=$row->phone?></td>
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