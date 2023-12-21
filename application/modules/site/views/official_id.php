<style type="text/css">
   .tg-ronw{ text-align: left !important;}
</style>
<style type="text/css">
   .tg  {border-collapse:collapse;border-spacing:0; width: 100%}
   .tg td{font-family:Arial, sans-serif;font-size:14px;padding:4px 0px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
   .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:4px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
   .tg .tg-t4bo{font-size:14px;background-color:#cbcefb;color:#000000;border-color:#9698ed;text-align:left; padding: 5px;}
   .tg .tg-ronw{font-weight:bold;background-color:#9698ed;color:#000000;border-color:#6665cd;text-align:center;padding: 5px;}
</style>
<div class="container w-75">
   <div class="secondary_sc_content">
      <p class="lead font-weight-bold py-2 text-white" style="background-color: #1aa326; padding-left:10px">PDS ID Verify</p>

      <div class="row">      
         <div class="col-md-12">
            <?php 
            if($this->session->userdata('site_lang')=='bangla'){
               $name='full_name_bn';
               $father_name='father_name_bn';
               $mother_name='mother_name_bn';
               $bg_name='bg_name_bn';
               $designation='designation_name';
               // $designation = 'current_desig';
               // $working_area = 'current_working_area';
            }else{
               $name='first_name';
               $father_name='father_name';
               $mother_name='mother_name';
               $bg_name='bg_name_en';
               $designation='designation_name_en';
               // $designation = 'current_desig';
               // $working_area = 'current_working_area';
            }
            ?>

            <?php if(count($result) != 0){ 

               // $present_add = $result->present_address;
               // $permanent_add = $result->permanent_address;
               // $pds_type = $result->type == 1 ? 'Professional':'Volunteer';

               $image_file = $result->profile_img;
               $path = base_url().'profile_img/';
               if($image_file != NULL){
                  $img_url = $path.$image_file;
               }else{
                  $img_url = $path.'no-image.jpg';
               }
               ?>

               <table class="tg">
                <tr>
                  <th class="tg-ronw" width="150">Name</th>
                  <td class="tg-t4bo"><?=$result->$name?></td>
                  <td rowspan="6" style="" valign="top" width="150">
                     <img class="img-responsive" width="130" style="margin: 0 auto; display: block;" src="<?=$img_url ?>"> 
                     <br>
                     <span style="margin-top:5px; padding: 2px;font-weight: bold;text-align: center; display: block;">PDS ID : <?=$result->pds_id?></span>
                  </td>
               </tr>
               <tr>
                  <th class="tg-ronw">Department</th>
                  <td class="tg-t4bo" ><?=$result->department_name?></td>
               </tr>
               <tr>
                  <th class="tg-ronw">Designation</th>
                  <td class="tg-t4bo" ><?=$result->$designation?></td>
               </tr>               
               <tr>
                  <th class="tg-ronw">Phone Number</th>
                  <td class="tg-t4bo"><?=$result->phone;?></td>
               </tr>
               <tr>
                  <th class="tg-ronw">Email Address</th>
                  <td class="tg-t4bo"><?=$result->email?></td>
               </tr>
               <tr>
                  <th class="tg-ronw">Blood Group</th>
                  <td class="tg-t4bo"><?=$result->$bg_name?></td>
               </tr>
            </table>

            <?php }else{ ?>
            <p>Official ID not found</p>
            <?php } ?>
         </div>      
      </div>

      <div class="py-3"></div>
   </div>
</div>
