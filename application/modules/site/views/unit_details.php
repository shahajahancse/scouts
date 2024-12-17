<div class="container w-75">
  <div class="secondary_sc_content">
    <p class="lead font-weight-bold py-2 text-white" style="background-color: #1aa326; padding-left:10px"><?=$meta_title?></p>
    <style type="text/css">
      .tg  {border-collapse:collapse;border-spacing:0;width: 100%}
      .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px; border-color:#ddd;overflow:hidden;word-break:normal; color: black; }
      .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px; border-color:#ddd;overflow:hidden;word-break:normal; color: black; font-weight: bold; vertical-align: top; width: 160px; text-align: right;}
      .tg .tg-d8ej{background-color:#ddf0da}
    </style>
    <?php 
    if($this->session->userdata('site_lang')=='bangla'){
      $region_name='region_name';
      $dis_name='dis_name';
      $upa_name='upa_name';
      $grp_name='grp_name_bn';
      $unit_name='unit_name_bn';
      $unit_address='unit_address';
    }else{
      $region_name='region_name_en';
      $dis_name='dis_name_en';
      $upa_name='upa_name_en';
      $grp_name='grp_name';
      $unit_name='unit_name';
      $unit_address='unit_address_en';
    }
    ?>
    <div class="container">
     <?php
     if($info->unit_status == 1) {
       $status = '<button class="btn btn-mini btn-info">Enable</button>';
     }else{
       $status = '<button class="btn btn-mini btn-primary">Disable</button>';
     }
     ?>

     <table class="tg">
       <tr>
        <th class="tg-d8ej"> <?=lang('site_unit_name')?></th>
        <td class="tg-031e"><strong><?=$info->$unit_name?></strong></td>
        <th class="tg-d8ej"> <?=lang('site_unit_type')?></th>
        <td class="tg-031e"><?=$this->session->userdata('site_lang')=='bangla'?get_scout_unit_type($info->unit_type):get_scout_unit_type_en($info->unit_type);?></td>
      </tr>
      <tr>
        <th class="tg-d8ej"> <?=lang('site_groups_scout_name')?></th>
        <td class="tg-031e" colspan="3"><?=$info->$grp_name?></td>
      </tr>
      <tr>
        <th class="tg-d8ej"> <?=lang('site_upazila_name')?></th>
        <td class="tg-031e" colspan="3"><?=$info->$upa_name?></td>
      </tr>
      <tr>
        <th class="tg-d8ej"> <?=lang('site_district_name')?></th>
        <td class="tg-031e" colspan="3"><?=$info->$dis_name?></td>
      </tr>
      <tr>
        <th class="tg-d8ej"> <?=lang('site_region_name')?></th>
        <td class="tg-031e" colspan="3"><?=$info->$region_name?></td>        
      </tr>                     
    </table>
    <div class="pt-3"></div>
  </div>
</div>
</div>
