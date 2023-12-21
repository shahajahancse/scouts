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
                  <table class="table table-hover table-condensed" border="0">
                     <thead>
                        <tr>
                           <th style="width:5%"> SL </th>
                           <th style="width:40%">Committee Name</th>
                           <th style="width:20%">Scouts Upazila</th>
                           <th style="width:10%">Start Date</th>
                           <th style="width:10%">End Date</th>
                           <th style="width:15%">Committee Type</th>
                           <th style="width:7%">Status</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        $sl=$pagination['current_page'];
                        foreach ($results as $row):
                           $sl++;
                        if($row->is_current == 1) {
                           $status = '<button class="btn btn-mini btn-info">Current</button>';
                        }else{
                           $status = '<button class="btn btn-mini btn-danger">Expired</button>';
                        }
                        ?>
                        <tr>
                           <td class="v-align-middle"><?=$sl.'.'?></td>
                           <td> <strong><?=$row->committee_name?></strong> </td>
                           <td> <?=$row->upa_name?></td>
                           <td class="v-align-middle"><?=date_sort_form($row->session_start_date); ?></td>
                           <td class="v-align-middle"><?=date_sort_form($row->session_end_date); ?></td>
                           <td> <?=$row->committee_type_name?></td>
                           <td> <?=$status?></td>
                          
                        </tr>
                     <?php endforeach;?>                      
                  </tbody>
               </table>
            </div>

         </div>
      </div>
   </div>

</div> <!-- END Content -->

</div>