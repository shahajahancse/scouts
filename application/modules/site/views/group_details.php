<style type="text/css">
 .tg  {border-collapse:collapse;border-spacing:0; width: 100%}
 .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px; border-color:#ddd;overflow:hidden;word-break:normal; color: black; }
 .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px; border-color:#ddd;overflow:hidden;word-break:normal; color: black; font-weight: bold; vertical-align: top; width: 160px; text-align: right;}
 .tg .tg-d8ej{background-color:#ddf0da}
</style>

<div class="container w-75">
  <div class="secondary_sc_content">
    <p class="lead font-weight-bold py-2 text-white" style="background-color: #1aa326; padding-left:10px"><?=$meta_title?></p>

    <?php 
    if($this->session->userdata('site_lang')=='bangla'){
      $name='name_bn';
      $region_name='region_name';
      $dis_name='dis_name';
      $upa_name='upa_name';
      $grp_name='grp_name_bn';
      $grp_address='grp_address';
    }else{
      $name='name';
      $region_name='region_name_en';
      $dis_name='dis_name_en';
      $upa_name='upa_name_en';
      $grp_name='grp_name';
      $grp_address='grp_address_en';
    }
    ?>
    <?php
    if($info->grp_type == 1) {
     $type = '<button class="btn btn-mini btn-success" style="padding:5px; font-size:13px;">'.lang('controlled-scout-group').'</button>';
   }else{
     $type = '<button class="btn btn-mini btn-success" style="padding:5px; font-size:13px;">'.lang('open-scout-group').'</button>';
   }
   ?>
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
          <a class="nav-link" data-toggle="tab" href="#office_list">Scout Unit</a>
        </li>
      </ul>

      <div class="tab-content">
        <div class="tab-pane container active" id="basic">
            <h5 class="tab_heading"> Basic Information about the Group </h5>
              <table class="tg">
                <tr>
                  <th class="tg-d8ej"><?=lang('site_groups_scout_name')?></th>
                  <td class="tg-031e" colspan="3"><strong><?=$info->$grp_name?></strong></td>                    
                </tr>
                <?php if($info->grp_type == 1) {?>
                <tr>
                  <th class="tg-d8ej"><?=lang('site_groups_scout_institute_name')?> </th>
                  <td class="tg-031e" colspan="3"><?=$info->$name=NULL?$info->$name:lang('site_common_not_available')?> </td>                    
                </tr>   
                <?php if($info->$upa_name != NULL){ ?>
                <tr>
                  <th class="tg-d8ej"> <?=lang('site_upazila_name')?></th>
                  <td class="tg-031e" colspan="3"><?=$info->$upa_name?></td>
                </tr>
                <?php } ?>
                <?php } ?>
                <tr>
                  <th class="tg-d8ej"> <?=lang('site_district_name')?></th>
                  <td class="tg-031e" colspan="3"><?=$info->$dis_name?></td>
                </tr>
                <tr>
                  <th class="tg-d8ej"> <?=lang('site_region_name')?></th>
                  <td class="tg-031e" colspan="3"><?=$info->$region_name?></td>
                </tr>
                <tr>
                  <th class="tg-d8ej"> <?=lang('site_office_phone')?></th>                    
                  <td class="tg-031e"><?=$this->session->userdata('site_lang')=='bangla'?BanglaConverter::en2bn($info->grp_mobile):BanglaConverter::bn2en($info->grp_mobile);?></td>
                  <th class="tg-d8ej"> <?=lang('site_office_email')?> </th>
                  <td class="tg-031e"><?=$info->grp_email?></td>
                </tr>                     
                <tr>
                  <th class="tg-d8ej"> <?=lang('site_office_address')?></th>
                  <td class="tg-031e"><?=$info->$grp_address?></td>
                  <th class="tg-d8ej"> <?=lang('site_groups_type')?></th>
                  <td class="tg-031e"><?=$type?></td>
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
                    $name = $row->user_name;
                    $designation  = $row->user_designation;
                    $phone        = $row->user_phone;
                    $email        = $row->user_email;
                  }

               ?>
               <tr>
                  <td class="v-align-middle"><?=$sl.'.'?></td>
                  <td> <?=$name?> </td>
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
        <h5 class="tab_heading"> Scout Unit List </h5>

          <table class="table table-bordered">                  
            <tbody>

              <tr>
                <th> SL </th>
                <th> Scout Unit Name </th>
              </tr>

              <?php
                $i=0;
                foreach ($office_list as $row) { 
                  $i++;
                  $lan=$this->session->userdata('site_lang')=='bangla'?'unit_name_bn':'unit_name';
              ?>
                <tr>
                  <td width="5%"><?=$this->session->userdata('site_lang')=='bangla'?BanglaConverter::en2bn($i):BanglaConverter::bn2en($i);?></td>
                  <td><a target="_blank" href="<?=base_url()?>unit-details/<?=$row->id?>" style="color:#000;"><?=$row->$lan?></a></td>
                </tr>
                <?php } ?>
              </tbody>
          </table>
      </div> 
    </div>

    
  </div>
</div>
</div>
