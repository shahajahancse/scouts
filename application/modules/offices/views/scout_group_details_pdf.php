<style type="text/css">

table, td, th {  
  border: 1px solid #ddd;
  text-align: left;
}

.dt_row, .dt_label,.dt_data {  
  border: 1px solid #ddd;
  text-align: left;
}


.dt_label, .dt_data {
  padding: 8px;
  color: black;

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
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?> <?php echo $info->grp_name?>
                  </span></h4>
      
               </div>
               <div class="grid-body">
      

                  <div class="row">
                     <div class="col-md-12">                        
   

                        <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
                        <div class="tab-content">

                           <div class="tab-pane active" id="tab_basic">
                              <div class="row column-seperation">
                                 <div class="col-md-12" style="margin-bottom: 20px;">
                                    <h3><span class="semi-bold pull-left">Basic Information</span> </h3>
                                 </div>

                                 <?php
                                 if($info->grp_type == 1) {
                                    $type = '<button class="btn btn-mini btn-info">নিয়ন্ত্রিত স্কাউট গ্রুপ</button> ';                                 
                                 }else{
                                    $type = '<button class="btn btn-mini btn-info">মুক্ত স্কাউট গ্রুপ</button>';
                                 }
                                 ?>

                                 <div class="col-md-7">
                                    <div class="dt_row"> 
                                       <span class="dt_label">Group Type:</span>
                                       <span class="dt_data"><?=$type?></span> </div>
                                    <div class="dt_row"> 
                                       <span class="dt_label">Institute Name:</span>
                                       <span class="dt_data"><?=$info->institute_name?></span> </div>
                                    <div class="dt_row"> 
                                       <span class="dt_label">Group Name (English):</span>
                                       <span class="dt_data"><?=$info->grp_name?></span> </div>
                                    <div class="dt_row"> 
                                       <span class="dt_label">Group Name (বাংলা):</span>
                                       <span class="dt_data"><?=$info->grp_name_bn?></span> </div>
                                    <div class="dt_row"> 
                                       <span class="dt_label"> Charter Number:</span>
                                       <span class="dt_data"><?=$info->grp_charter?></span> </div>
                                    
                                    <div class="dt_row">
                                       <span class="dt_label">Scouts Upazila:</span>
                                       <span class="dt_data"><?=$info->upa_name?></span> </div>
                                    <div class="dt_row"> 
                                       <span class="dt_label">Registration No:</span>
                                       <span class="dt_data"><?=$info->grp_reg_num_upa?></span> </div>
                                    <div class="dt_row">
                                       <span class="dt_label">Registration Date:</span>
                                       <span class="dt_data"><?=date_bangla_format($info->grp_reg_upa_date)?></span> </div>

                                    <div class="dt_row"> 
                                       <span class="dt_label">Scouts District:</span>
                                       <span class="dt_data"><?=$info->dis_name?></span> </div>
                                    <div class="dt_row"> 
                                       <span class="dt_label">Registration No:</span>
                                       <span class="dt_data"><?=$info->grp_reg_num_dis?></span> </div>
                                    <div class="dt_row"> 
                                       <span class="dt_label">Registration Date:</span>
                                       <span class="dt_data"><?=date_bangla_format($info->grp_reg_dis_date)?></span> </div>
                                    <div class="dt_row"> 
                                       <span class="dt_label">Scouts Region:</span>
                                       <span class="dt_data"><?=$info->region_name?></span> </div>

                                    <div class="dt_row"> 
                                       <span class="dt_label">Address:</span>
                                       <span class="dt_data"><?=$info->grp_address?></span> </div>
                                    <div class="dt_row">
                                       <span class="dt_label">Email:</span>
                                       <span class="dt_data"><?=$info->grp_email?></span> </div>
                                    <div class="dt_row">
                                       <span class="dt_label">Mobile No.:</span>
                                       <span class="dt_data"><?=$info->grp_mobile?></span> </div>
                                 </div>

                                 <div class="col-md-5">
                                    <h5> <span class="dt_label"><b>Group Leader</b></span><span class="dt_data"></span></h5> 

                                    <div class="dt_row"> 
                                       <span class="dt_label">Scout Leader ID:</span>
                                       <span class="dt_data"><?=$info->scout_id?></span></div>
                                    <div class="dt_row"> 
                                       <span class="dt_label">Scout Leader Name:</span>
                                       <span class="dt_data"><?=$info->first_name?></span></div>

                                    <br><br>
                                    <h5> <span class="dt_label"><b>Scouts Group Login</b></span><span class="dt_data"></span></h5> 

                                    <div class="dt_row">
                                       <span class="dt_label">Username:</span>
                                       <span class="dt_data"><?=$info->username?></span></div>
                              </div>

                           </div>
                        </div>                        

                        <div class="tab-pane" id="tab_scout_unit">
                           <div class="row column-seperation">
                              <div class="col-md-12" style="margin-bottom: 20px;">
                                 <h3><span class="semi-bold pull-left">Scouts Unit</span> </h3>
                                 
                              </div>

                              <table class="table table-hover table-condensed">
                                 <thead>
                                    <tr>
                                       <th style="width:5%; color: black;"> SL </th>
                                       <th style="width:30%; color: black;">Unit Name (English)</th>
                                       <th style="width:30%; color: black;">Unit Name (Bangla)</th>
                                       <th style="width:15%; color: black;">Type</th>
                                       <th style="width:10%; color: black;">Charter No</th>
                                       <!-- <th style="width:20%;">Action</th> -->
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
                                    $sl=0;
                                    foreach ($scout_units as $row):
                                       $sl++;
                                    if($row->unit_status == 1) {
                                       $status = '<button class="btn btn-mini btn-info">Enable</button>';
                                    }else{
                                       $status = '<button class="btn btn-mini btn-primary">Disable</button>';
                                    }
                                    ?>
                                    <tr>
                                       <td class="v-align-middle"><?=$sl.'.'?></td>
                                       <td> <strong><?=$row->unit_name?> </strong></td>
                                       <td><?=$row->unit_name_bn?></td>                           
                                       <td class="v-align-middle"><?=get_scout_unit_type($row->unit_type); ?></td>
                                       <td class="v-align-middle"><?=$row->grp_charter; ?></td>
                                       
                                       </tr>
                                    <?php endforeach;?>                      
                                 </tbody>
                              </table>

                           </div>
                        </div>

                     </div>
                  </div>
               </div>

               </div>  <!-- END GRID BODY -->              
            </div> <!-- END GRID -->
         </div>
      </div> <!-- END ROW -->

   </div>
</div>

