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
                  <th style="width:5%"> SL </th>
                  <th style="width:8%">Image</th>
                  <th style="width:20%">Name</th>
                  <th style="width:9">Phone</th>
                  <!-- <th style="width:10%">Address</th> -->
                  <th style="width:15%">Award Name</th>
                  <th style="width:8%">Group Verify</th>
                  <th style="width:8%">Upazila Verify</th>
                  <th style="width:8%">District Verify</th>
                  <th style="width:8%">Region Verify</th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($results)){
                  $sl=0;
                  foreach ($results as $row) {
                    $sl++;

                    $profile_img = $row->profile_img;
                    $path = base_url().'profile_img/';
                    if($profile_img != NULL){
                      $img_url = $path.$profile_img;
                    }else{
                      $img_url = $path.'no-img.png';
                    }
                ?>

                <tr>
                  <td class="v-align-middle"><?=$sl?></td>
                  <td class="v-align-middle"><img src="<?=$img_url?>" width="50" ></td>
                  <td class="v-align-middle"><?php echo $row->first_name.' '.$row->last_name;?></td>
                  <td class="v-align-middle"><?php echo $row->phone;?></td>
<!--                   <td class="v-align-middle"><?php echo $row->email;?></td> -->
                  <td class="v-align-middle"><?php echo $row->award_name;?></td>
                  <td class="v-align-middle"><?php echo award_status($row->app_grp_approve);?></td>
                  <td class="v-align-middle"><?php echo award_status($row->app_upa_approve);?></td>
                  <td class="v-align-middle"><?php echo award_status($row->app_dis_approve);?></td>
                  <td class="v-align-middle"><?php echo award_status($row->app_rgn_approve);?></td>
                </tr>

                  <?php 
                  } 
                }
                ?>                      
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    </div> <!-- END ROW -->

  </div>
</div>