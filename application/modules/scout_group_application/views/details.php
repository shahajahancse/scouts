<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('pds/pds_list')?>" class="active"> <?=$module_title; ?> </a></li>
         <li><?=$meta_title; ?> </li>
      </ul>
      <style type="text/css">
         .tg  {border-collapse:collapse;border-spacing:0; width: 98%; margin: 10px;}
         .tg td{font-family:Arial, sans-serif;font-size:14px;padding:7px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;color:black;}
         .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:7px 3px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;color:black;}
         .tg .tg-68ib{font-weight:bold;background-color:#efefef;border-color:#9b9b9b;text-align:right;vertical-align:top; width: 190px;}
         .tg .tg-2fdn{border-color:#9b9b9b;text-align:left;vertical-align:top;padding:7px 5px;}
         .tg .tg-yuct{font-weight:bold;background-color:#efefef;border-color:#9b9b9b;text-align:right;vertical-align:middle; width: 180px;}
         .tg .tg-m6jf{border-color:#9b9b9b;text-align:left;vertical-align:middle}
      </style>

      <style type="text/css">
         .tg2  {border-collapse:collapse;border-spacing:0;color: black; margin-bottom: 20px;}
         .tg2 caption{font-weight: bold; font-size: 18px; color: black;}
         .tg2 td{font-family:Arial, sans-serif;font-size:14px;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;color: black;}
         .tg2 th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;color: black;}
         .tg2 .tg-bm2g{font-weight:bold;background-color:#c0c0c0;border-color:#9b9b9b;text-align:center;vertical-align:top}
         .tg2 .tg-2fdn{border-color:#9b9b9b;text-align:left;vertical-align:top}
         .tg2 .tg-xyy0{font-weight:bold;background-color:#c0c0c0;border-color:#9b9b9b;text-align:center;vertical-align:middle}
         .tg2 .tg-m6jf{border-color:#9b9b9b;text-align:left;vertical-align:middle}
      </style>
      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">           
                     <a href="<?=base_url('scout_group_application/application_list')?>" class="btn btn-success btn-xs btn-mini"> Application List</a> 
                     <a href="<?=base_url('scout_group_application/scout_application_pdf/'.encrypt_url($info->id))?>" class="btn btn-blueviolet btn-xs btn-mini" target="_blank"> Generate PDF</a>
                  </div>
               </div>

               <div class="grid-body">
                  <div class="row">                  
                     <table class="tg">  
                        <caption style="font-size: 20px; font-weight: bold; text-align: center; color: black;">স্কাউটস গ্রুপের আবেদন</caption> 
                        <tr>
                           <td class="tg-68ib">বাংলাদেশ স্কাউটস</td>
                           <td class="tg-2fdn"><strong><?=$info->upa_name?></strong></td>
                        </tr> 
                        <tr>
                           <td class="tg-68ib">দল / গ্রুপের নাম</td>
                           <td class="tg-2fdn"><strong><?=$info->grp_name_bn?></strong></td>
                        </tr>   
                        <tr>
                           <td class="tg-68ib">ঠিকানা</td>
                           <td class="tg-2fdn"><?=$info->grp_address?></td>
                        </tr> 
                        <?php if($info->grp_type == 1){ ?>
                        <tr>
                           <td class="tg-68ib">নিয়ন্ত্রক প্রতিষ্ঠানের নাম</td>
                           <td class="tg-2fdn"><?=$info->institute_name?></td>
                        </tr> 
                        <?php } ?>
                        <tr>
                           <td class="tg-68ib">দল/গ্রুপ সংগঠনের তারিখ</td>
                           <td class="tg-2fdn"><?=date_bangla_calender_format($info->grp_open_date)?></td>
                        </tr> 
                     </table>

                     <div class="col-md-12" style="margin-top: 20px;">
                        <table class="tg2" border="0" width="100%">
                           <caption style="font-size: 15px; font-weight: bold;">গ্রুপ স্কাউটারস কাউন্সিল</caption>
                           <tr>
                              <th class="tg-xyy0" width="30%"> কাব/স্কাউট লিডার / সহকারী কাব স্কাউট লিডারদের নাম </th>
                              <th class="tg-xyy0" width="20%"> প্রশিক্ষণ গ্রহণের তারিখ </th>
                              <th class="tg-xyy0"> সার্টফিকেট নম্বর </th>
                              <th class="tg-xyy0"> প্রশিক্ষণ স্থান </th>
                              <th class="tg-xyy0"> দলের দায়িত্ব </th>            
                           </tr>
                           <tr>
                              <td class="tg-m6jf"> <?=$info->leader_name1?> </td>
                              <td class="tg-m6jf"> <?=date_bangla_calender_format($info->training_date1)?> </td>
                              <td class="tg-m6jf"> <?=$info->certificate_no1?> </td>
                              <td class="tg-m6jf"> <?=$info->training_place1?> </td>
                              <td class="tg-m6jf"> <?=$info->group_res1?> </td>            
                           </tr>
                           <tr>
                              <td class="tg-m6jf"> <?=$info->leader_name2?> </td>
                              <td class="tg-m6jf"> <?=date_bangla_calender_format($info->training_date2)?> </td>
                              <td class="tg-m6jf"> <?=$info->certificate_no2?> </td>
                              <td class="tg-m6jf"> <?=$info->training_place2?> </td>
                              <td class="tg-m6jf"> <?=$info->group_res2?> </td>            
                           </tr>
                           <tr>
                              <td class="tg-m6jf"> <?=$info->leader_name3?> </td>
                              <td class="tg-m6jf"> <?=date_bangla_calender_format($info->training_date3)?> </td>
                              <td class="tg-m6jf"> <?=$info->certificate_no3?> </td>
                              <td class="tg-m6jf"> <?=$info->training_place3?> </td>
                              <td class="tg-m6jf"> <?=$info->group_res3?> </td>            
                           </tr>
                           <tr>
                              <td class="tg-m6jf"> <?=$info->leader_name4?> </td>
                              <td class="tg-m6jf"> <?=date_bangla_calender_format($info->training_date4)?> </td>
                              <td class="tg-m6jf"> <?=$info->certificate_no4?> </td>
                              <td class="tg-m6jf"> <?=$info->training_place4?> </td>
                              <td class="tg-m6jf"> <?=$info->group_res4?> </td>            
                           </tr>
                        </table>  
                     </div>

                     <table class="tg">  
                        <caption style="font-size: 15px; font-weight: bold; color: black;">গ্রুপ কমিটি</caption> 
                        <tr>
                           <td class="tg-68ib">সভাপতির নাম</td>
                           <td class="tg-2fdn"><strong><?=$info->grp_president?></strong></td>
                        </tr> 
                        <tr>
                           <td class="tg-68ib">ঠিকানা</td>
                           <td class="tg-2fdn"><?=$info->grp_president_add?></td>
                        </tr>   
                        <tr>
                           <td class="tg-68ib">সম্পাদের নাম</td>
                           <td class="tg-2fdn"><strong><?=$info->grp_secretary?></strong></td>
                        </tr> 
                        <tr>
                           <td class="tg-68ib">ঠিকানা</td>
                           <td class="tg-2fdn"><?=$info->grp_secretary_add?></td>
                        </tr> 
                     </table>

                     <div class="col-md-12" style="margin-top: 20px;">
                        <table class="tg2" border="0">
                         <caption style="font-size: 15px; font-weight: bold;">পরিসংখ্যান</caption>
                         <tr>
                           <th  class="tg-xyy0" width="100">বিভাগ/শ্রেনী </th>
                           <th class="tg-xyy0"> মেম্বারশীপ ব্যাজ </th>
                           <th class="tg-xyy0"> তাঁরা ব্যাজ/স্ট্যান্ডার্ড ব্যাজ </th>
                           <th class="tg-xyy0"> চাঁদ ব্যাজ </th>            
                           <th class="tg-xyy0"> চাঁদ তাঁরা ব্যাজ / সার্ভিজ ব্যাজ </th>
                           <th class="tg-xyy0"> প্রেসিডেন্ট স্কাউট/ শাপলা কাব </th>
                           <th class="tg-xyy0"> মোট </th>
                        </tr>
                        <tr>
                           <td class="tg-m6jf"> কাব স্কাউট </td>
                           <td class="tg-m6jf"> <?=$info->member_badge_cub?> </td>
                           <td class="tg-m6jf"> <?=$info->moon_standard_cub?> </td>
                           <td class="tg-m6jf"> <?=$info->moon_progress_cub?> </td>
                           <td class="tg-m6jf"> <?=$info->moon_service_cub?> </td>
                           <td class="tg-m6jf"> <?=$info->president_shapla_cub?> </td>
                           <td class="tg-m6jf"> <?php $total_cub = $info->member_badge_cub+$info->moon_standard_cub+$info->moon_progress_cub+$info->moon_service_cub+$info->president_shapla_cub;
                            echo $total_cub;
                            ?> </td>
                         </tr>
                         <tr>
                           <td class="tg-m6jf"> কাব স্কাউট </td>
                           <td class="tg-m6jf"> <?=$info->member_badge_boy?> </td>
                           <td class="tg-m6jf"> <?=$info->moon_standard_boy?> </td>
                           <td class="tg-m6jf"> <?=$info->moon_progress_boy?> </td>
                           <td class="tg-m6jf"> <?=$info->moon_service_boy?> </td>
                           <td class="tg-m6jf"> <?=$info->president_shapla_boy?> </td>
                           <td class="tg-m6jf"> <?php $total_boy = $info->member_badge_boy+$info->moon_standard_boy+$info->moon_progress_boy+$info->moon_service_boy+$info->president_shapla_boy;
                              echo $total_boy;
                              ?> </td>
                           </tr>
                           <tr>
                              <td class="tg-m6jf"> মোট </td>
                              <td class="tg-m6jf"> <?=$info->member_badge_cub+$info->member_badge_boy?> </td>
                              <td class="tg-m6jf"> <?=$info->moon_standard_cub+$info->moon_standard_boy?> </td>
                              <td class="tg-m6jf"> <?=$info->moon_progress_cub+$info->moon_progress_boy?> </td>
                              <td class="tg-m6jf"> <?=$info->moon_service_cub+$info->moon_service_boy?> </td>
                              <td class="tg-m6jf"> <?=$info->president_shapla_cub+$info->president_shapla_boy?> </td>
                              <td class="tg-m6jf"> <?=$total_cub+$total_boy?> </td>
                           </tr>
                        </table>
                     </div>


                  </div>
               </div> <!-- grid-body -->
            </div> <!-- /grid -->
         </div>
      </div> <!-- row -->
   </div> <!-- /content -->
</div> <!-- /page-content -->