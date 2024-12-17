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
                           <th style="width:20%">Scout District Name</th>
                           <th style="width:20%">Scout Region</th>
                           <th style="width:15%">Username</th>
                           <th style="width:10%">District Type</th>
                           
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        $sl=0;
                        foreach ($results as $row):
                           $sl++;
                        if($row->dis_status == 1) {
                           $status = '<button class="btn btn-mini btn-info">Enable</button>';
                        }else{
                           $status = '<button class="btn btn-mini btn-primary">Disable</button>';
                        }

                        if($row->dis_type == '1') {
                           $district = '<button class="btn btn-mini btn-primary">Administrative District</button>';
                        }else if($row->dis_type == '2') {
                           $district = '<button class="btn btn-mini btn-primary">Metropolitan District</button>';
                        }else if($row->dis_type == '3') {
                           $district = '<button class="btn btn-mini btn-primary">Rover District</button>';
                        }else if($row->dis_type == '4') {
                           $district = '<button class="btn btn-mini btn-primary">Railway District</button>';
                        }else if($row->dis_type == '5') {
                           $district = '<button class="btn btn-mini btn-primary">Sea District</button>';
                        }else if($row->dis_type == '6') {
                           $district = '<button class="btn btn-mini btn-primary">Air District</button>';
                        }
                        ?>
                        <tr>
                           <td class="v-align-middle"><?=$sl.'.'?></td>
                           <td> <strong> <?=$row->dis_name?> </strong></td>
                           <td class="v-align-middle"><?=$row->region_name; ?></td>
                           <td class="v-align-left"><?=$row->username; ?></td>                           
                           <td> <?=$district?> </td>
                            
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