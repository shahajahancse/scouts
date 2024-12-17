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
                  <h2 align="center"><span class="semi-bold">Bangladesh Scouts</span></h2>
                  <h4 align="center"><span class="semi-bold"><?=$meta_title; ?></span></h4>
            </div>

            <div class="grid-body ">

               <?php if($results) { ?>
               <table class="table table-hover table-condensed">
                  <thead>
                     <tr>
                        <th style="width:5%"> SL </th>
                        <th style="width:30%">Scouts Group Name</th>
                        <th style="width:10%">Username</th>
                        <th style="width:25%">Scouts Upazila <br> or District</th>
                        <th style="width:12%">Charter No</th>
                        <th style="width:10%">Group Type</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php 
                     $sl=$pagination['current_page'];
                     foreach ($results as $row):
                        $sl++;
                     if($row->grp_type == 1) {
                        $type = '<button class="btn btn-mini btn-info">নিয়ন্ত্রিত স্কাউট গ্রুপ</button>';
                     }else{
                        $type = '<button class="btn btn-mini btn-primary">মুক্ত স্কাউট গ্রুপ</button>';
                     }

                     $upazila = '';
                     if($row->upa_name){
                        $upazila = explode(',', $row->upa_name);
                        $upazila = $upazila[1];
                     }

                     $district = '';
                     if($row->dis_name){
                        $district = explode(',', $row->dis_name);
                        @$district = $district[1];
                     }
                     ?>
                     <tr>
                        <td class="v-align-middle"><?=$sl.'.'?></td>
                        <td> <?=$row->grp_name?> </td>
                        <td> <?=word_wrap($row->username, 25)?> </td>
                        <td><?=$upazila?> <br> <?=$district?></td>
                        <td class="v-align-middle"><?=$row->grp_charter; ?></td>
                        <td><?=$type?></td>
                                         
                     </tr>
                  <?php endforeach;?>                      
               </tbody>
            </table>

            <?php } ?>

      </div>
   </div>
</div>
</div> <!-- END Content -->
</div>