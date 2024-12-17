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

                  <table class="table table-hover table-condensed"> 
                     <thead>
                        <tr>
                           <th style="width:5%"> SL </th>
                           <th style="width:30%">Region Name</th>
                           <th style="width:15%">Username</th>
                           <th style="width:15%">Division Name</th>
                           <th style="width:10%">Region Type</th>
                           <th style="width:10%">Status</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        $sl=0;
                        foreach ($results as $row):
                           $sl++;
                        //$encryptID = $this->encrypt->encode($row->id, $this->encKey);
                        if($row->region_status == 1) {
                           $status = '<button class="btn btn-mini btn-info">Enable</button>';
                        }else{
                           $status = '<button class="btn btn-mini btn-primary">Disable</button>';
                        }

                        if($row->region_type == 'divisional') {
                           $region = '<button class="btn btn-mini btn-primary">Divitional Region</button>';
                        }else{
                           $region = '<button class="btn btn-mini btn-primary">Special Region</button>';
                        }
                        ?>
                        <tr>
                           <td class="v-align-middle"><?=$sl.'.'?></td>
                           <td> <?=$row->region_name?> </td>
                           <td> <strong><?=$row->username?></strong> </td>
                           <td class="v-align-middle"><?=$row->div_name; ?></td>
                           <td> <?=$region?> </td>
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