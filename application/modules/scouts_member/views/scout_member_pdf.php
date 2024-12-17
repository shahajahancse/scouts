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
              <?php 

                /*****************Filter check start*********************/
                if (!empty($_GET['region']) && isset($_GET['region']) || (!empty($_GET['memberType'])) || (!empty($_GET['scoutID'])) || (!empty($_GET['name'])) || (!empty($_GET['username'])) || (!empty($_GET['gender']))|| (!empty($_GET['section']))) { ?>
                   <div class="row" style="font-size: 15px;">
                        <?php
                            if (!empty($_GET['region']) && isset($_GET['region'])) {
                                echo "<b>Region :- </b>".$regions[$_GET['region']].',';
                            }

                            if (!empty($_GET['district']) && isset($_GET['district'])) {
                                echo "<b> District :- </b>".$scouts_district[$_GET['district']].',';
                            }

                            if (!empty($_GET['upazila']) && isset($_GET['upazila'])) {
                                echo "<b>Upazila :- </b>".$scouts_upazila[$_GET['upazila']].',';
                            }

                            if (!empty($_GET['sgroup']) && isset($_GET['sgroup'])) {
                                echo "<b> Group :- </b>".$scouts_group[$_GET['sgroup']].',';
                            }

                            if (!empty($_GET['memberType']) && isset($_GET['memberType'])) {
                                echo "<b> Member Type :- </b>".$member_type[$_GET['memberType']].',';
                            }

                            if (!empty($_GET['scoutID']) && isset($_GET['scoutID'])) {
                                echo "<b> Scout ID :- </b>".$_GET['scoutID'].',';
                            }

                            if (!empty($_GET['name']) && isset($_GET['name'])) {
                                echo "<b> Name :- </b>".$_GET['name'].',';
                            }

                            if (!empty($_GET['username']) && isset($_GET['username'])) {
                                echo "<b> Username :- </b>".$_GET['username'].',';
                            }

                            if (!empty($_GET['gender']) && isset($_GET['gender'])) {
                                echo "<b> Gender :- </b>".$_GET['gender'].',';
                            }

                            if (!empty($_GET['section']) && isset($_GET['section'])) {
                                echo "<b> Section :- </b>".$scout_section[$_GET['section']].',';
                            }
                        ?>
                  </div>
                    <?php 
                }
                /*****************Filter check End*********************/
                ?>
                <br>
               <?php if($results) { ?>
               <table class="table table-hover table-condensed" id="example">
                 <thead>
                   <tr>
                     <th width="5%"> SL </th>
                     <th width="5%">Image</th>
                     <th width="25%">Full Name</th>
                     <th width="10%">Scout ID</th>
                     <th width="12%">Member Type</th>
                     <th width="10%">Section</th>
                     <th width="25%">Group Name</th>
                     <th width="10%">Username</th>
                  </tr>
               </thead>
               <tbody>
                <?php 
                $sl=$pagination['current_page'];
                foreach ($results as $row):
                  $sl++;
                  // Profile Image
               $path = base_url().'profile_img/';
               if($row->profile_img != NULL){
                  $img_url = '<img src="'.$path.$row->profile_img.'" height="20">';
               }else{
                  $img_url = '<img src="'.$path.'no-img.png" height="20">';
               }
               $cont = 'Some content <br> <strong>inside</strong> the popover';
               ?>
               <tr>
                  <td class="v-align-middle"><?=$sl.'.'?></td>
                  <td class="v-align-middle"><?=$img_url?></td>
                  <td class="v-align-middle"><?php echo $row->first_name;?></td>
                  <td class="v-align-middle"><span class="trigger-scout-id"><?=$row->scout_id?> </span>
                    <td class="v-align-middle"><?=$row->member_type_name?></td>
                    <td class="v-align-middle"><span class="label label-green"><?=get_scout_section($row->sc_section_id);?></span></td>
                    <td class="v-align-middle"><?=$row->grp_name?></td>
                    <td class="v-align-middle"><?=$row->username?></td>
               </tr>
            <?php endforeach;?>                      
         </tbody>
      </table>
     <?php }else{ ?>

     <div class="alert alert-block alert-error fade in">
      <h4 class="alert-heading"><i class="icon-warning-sign"></i>No data found!</h4>
   </div>

   <?php } ?>

</div>
</div>
</div>
</div>

</div> <!-- END ROW -->

</div>