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

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple ">
               <div class="grid-title">
                  <h4 align="center"><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  
               </div>

               <div class="grid-body ">
                  <div class="clearfix"></div>
                  <hr >


                  <table class="table table-hover table-condensed">
                     <thead>
                        <tr>
                           <th style="width:5%"> SL </th>
                           <th style="width:35%">Scout Upazila Name</th>
                           <th style="width:10%">Username</th>
                           <th style="width:25%">Scout District</th>
                           <th style="width:5%">Status</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        $sl=0;
                        foreach ($results as $row):
                           $sl++;
                        if($row->upa_status == 1) {
                           $status = '<button class="btn btn-mini btn-info">Enable</button>';
                        }else{
                           $status = '<button class="btn btn-mini btn-primary">Disable</button>';
                        }

                        ?>
                        <tr>
                           <td class="v-align-middle"><?=$sl.'.'?></td>
                           <td> <strong><?=$row->upa_name?> </strong></td>
                           <td> <strong><?=$row->username?> </strong></td>
                           <td class="v-align-middle"><?=$row->dis_name; ?></td>
                           <!-- <td class="v-align-middle"><?=$row->region_name; ?></td> -->
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