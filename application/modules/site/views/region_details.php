<style type="text/css">
   .tg  {border-collapse:collapse;border-spacing:0; width: 100%}
   .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px; border-color:#ddd;overflow:hidden;word-break:normal; color: black; }
   .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px; border-color:#ddd;overflow:hidden;word-break:normal; color: black; font-weight: bold; vertical-align: top; width: 170px;text-align:right;}
   .tg .tg-d8ej{background-color:#ddf0da}
</style>
<?php 
if($this->session->userdata('site_lang')=='bangla'){
   $region_name='region_name';
   $region_address='region_address_bn';
   $region_description='region_description_bn';
}else{
   $region_name='region_name_en';
   $region_address='region_address';
   $region_description='region_description';
}
?>
<div class="container w-75">
   <div class="secondary_sc_content">
      <p class="lead font-weight-bold py-2 text-white" style="background-color: #1aa326; padding-left:10px"><?=$meta_title?></p>

      <div class="container">
         <!-- Nav tabs -->
         <ul class="nav nav-tabs">
            <li class="nav-item">
               <a class="nav-link active" data-toggle="tab" href="#basic">Basic Information</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" data-toggle="tab" href="#admin_user">Admin User List</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" data-toggle="tab" href="#office_list">Scout District Office</a>
            </li>
         </ul>

         <!-- Tab panes -->
         <div class="tab-content">
            <div class="tab-pane container active" id="basic">
               <h5 class="tab_heading"> Basic Information about the Region </h5>
               <?php
               if($info->region_status == 1) {
                  $status = '<button class="btn btn-mini btn-info" style="padding:5px; font-size:13px;">Enable</button>';
               }else{
                  $status = '<button class="btn btn-mini btn-primary" style="padding:5px; font-size:13px;">Disable</button>';
               }

               if($info->region_type == 'divisional') {
                  $region = $this->session->userdata('site_lang')=='bangla'?'বিভাগীয় অঞ্চল':'Divitional Region';
               }else{
                  $region = $this->session->userdata("site_lang")=="bangla"?"বিশেষ অঞ্চল":"Special Region";
               }
               ?>
               <table class="tg">
                  <tr>
                     <th class="tg-d8ej"> <?=lang('site_region_name')?></th>
                     <td class="tg-031e"><strong><?=$info->$region_name?></strong></td>
                  </tr>
                  <tr>
                     <th class="tg-d8ej"><?=lang('site_region_logo')?></th>
                     <td class="tg-031e">
                        <?php 
                        $img_path = base_url().'offices_img/';
                        if($info->region_logo != NULL){
                           $src= $img_path.$info->region_logo;
                           echo "<img src='$src' height='150'>";
                        }
                        ?></td>
                     </tr>
                     <tr>
                        <th class="tg-d8ej"> <?=lang('site_region_type')?></th>
                        <td class="tg-031e"><button class="btn btn-mini btn-primary" style="padding:5px; font-size:13px;"><?=$region?></button></td>
                     </tr>                   
                     <tr>
                        <th class="tg-d8ej"> <?=lang('site_office_phone')?></th>
                        <td class="tg-031e"><?=$this->session->userdata('site_lang')=='bangla'?BanglaConverter::en2bn($info->region_phone):BanglaConverter::bn2en($info->region_phone);?></td>
                     </tr>
                     <tr>
                        <th class="tg-d8ej"><?=lang('site_office_fax')?></th>
                        <td class="tg-031e"><?=$this->session->userdata('site_lang')=='bangla'?BanglaConverter::en2bn($info->region_fax):BanglaConverter::bn2en($info->region_fax);?></td>
                     </tr>
                     <tr>
                        <th class="tg-d8ej"> <?=lang('site_office_email')?></th>
                        <td class="tg-031e"><?=$info->region_email?></td>
                     </tr>
                     <tr>
                        <th class="tg-d8ej"> <?=lang('site_office_address')?></th>
                        <td class="tg-031e"><?=$info->$region_address?></td>
                     </tr>
                     <tr>
                        <th class="tg-d8ej"> <?=lang('site_office_details')?></th>
                        <td class="tg-031e" style="text-align:justify;"><?=nl2br($info->$region_description)?></td>
                     </tr>
                  </table>
                  <div class="pt-3"></div>
               </div>

               <div class="tab-pane container fade" id="admin_user">
                  <h5 class="tab_heading"> Scout Office Admin User List </h5>
                  <table class="table table-bordered table-hover table-condensed"> 
                     <thead>
                        <tr>
                           <th style="width:2%"> SL </th>
                           <th style="width:20%">Name</th>
                           <th style="width:15%">Scout ID</th>
                           <th style="width:15%">Designation</th>
                           <th style="width:10%">Phone</th>
                           <th style="width:10%">Email</th>
                           <!-- <th style="width:20%">Remark</th> -->
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        $sl=0;
                        foreach ($user_list as $row):
                           $sl++;
                        if($row->member_type == 1){
                           $name         = $row->first_name;
                           $phone        = $row->phone;
                           $email        = $row->email;

                           //Scouts member section / designation
                           if($row->member_id == 2){
                              if($row->sc_section_id <= 3){
                                 $designation = get_scout_section($row->sc_section_id);
                              }else{
                                 $designation = '';
                              }
                           }elseif($row->member_id == 8){
                              $designation = 'Adult Leader';
                           }elseif($row->member_id == 9){
                              $designation = 'Professional Executive';
                           }elseif($row->member_id == 10){
                              $designation = $row->role_type_name_en;
                           }elseif($row->member_id == 12){
                              $designation = $row->role_type_name_en;
                           }elseif($row->member_id == 13){
                              $designation = 'Support Staff';
                           }

                        }else{
                           $name          = $row->user_name;
                           $designation  = $row->user_designation;
                           $phone        = $row->user_phone;
                           $email        = $row->user_email;
                        }
                        ?>
                        <tr>
                           <td class="v-align-middle"><?=$sl.'.'?></td>
                           <td><b> <?=$name?> </b></td>
                           <td> <?php if($row->scout_id){ ?>
                              <a href="<?=base_url('user-verify?scoutID='.$row->scout_id)?>" target="_blank"> <?=$row->scout_id?></a>
                              <?php } ?> 
                           </td>
                           <td class="v-align-middle"> <?=$designation?> </td>
                           <td> <?=$phone?> </td>
                           <td> <?=$email?> </td>
                           <!-- <td> <?=$row->user_remarks?> </td> -->
                        </tr>
                     <?php endforeach;?>                      
                  </tbody>
               </table>
            </div>

            <div class="tab-pane container fade" id="office_list">
               <h5 class="tab_heading"> Scout District List </h5>
               <table class="table table-bordered">
                  <tbody>
                     <tr>
                        <th> SL </th>
                        <th> Scout District Name </th>
                     </tr>

                     <?php
                     $i=0;
                     foreach ($office_list as $row) { 
                        $i++;
                        $lan=$this->session->userdata('site_lang')=='bangla'?'dis_name':'dis_name_en';
                        ?>
                        <tr>
                           <td width="5%"><?=$this->session->userdata('site_lang')=='bangla'?BanglaConverter::en2bn($i):BanglaConverter::bn2en($i);?></td>
                           <td><a target="_blank" href="<?=base_url()?>district-details/<?=$row->id?>" style="color:#000;"><?=$row->$lan?></a></td>
                        </tr>
                        <?php } ?>
                     </tbody>
                  </table>
               </div>
            </div>
            <!-- Tab panes -->

         </div>
      </div>
   </div>

   <script type="text/javascript">
      // https://stackoverflow.com/questions/26380094/bootstrap-3-nav-tabs-bookmark-url-not-working
      $(document).ready(function() {        
        var url = document.location.toString();
        if (url.match('#')) {
          $('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
       }
    });
 </script>
