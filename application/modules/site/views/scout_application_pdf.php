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
      padding: 5px;
      color: black;
   }
   .title{font-size: 18px; text-align: left; font-weight: bold;}
   .line{width: 80%}

   .noBorder table {  
      border: none;
   }
   .noBorder td {  
      border: none;
      font-size: 18px;
   }
   .noBorder th {  
      border: none;
   }
</style>

<div class="page-content">     
   <div class="content"> 

      <div style="border-bottom: 1px solid #ccc;">         
         <div style="text-align: center; width: 300px; margin: 0 auto;">
            <img src="<?=base_url('fwedget/assets/images/scout_logo.png')?>" height="40">
            <h2 style="margin-bottom: 0px; padding-bottom: 0px;"><?php echo $info->region_name; ?></h2>
            <?php //if($info->region_id > 9){ ?>
            <h3 align="center" style="margin-top: 0px; padding-top: 0px;"><span class="semi-bold"><?=$info->upa_name?></span></h3>
            <?php //} ?>

            <h3 align="center" style="margin-top: 0px; padding-top: 0px;"><span class="semi-bold"><?=$meta_title; ?></span></h3>
         </div>
      </div>

      <div class="row-fluid">
         <div class="span12">
            <div class="grid simple">
               <div class="grid-body">
                  <div style="text-align: right; ">দল/গ্রুপ সংগঠনের তারিখ <strong><?=date_bangla_calender_format($info->grp_open_date)?></strong> </div>
                  <table>
                     <tr>
                        <td> দলের / গ্রুপের নাম </td>
                        <td> <?=$info->grp_name_bn?> </td>
                        <td> ঠিকানা </td>
                        <td> <?=$info->grp_address?> </td>
                     </tr>
                     <?php if($info->grp_type == 1){ ?>
                     <tr>
                        <td> নিয়ন্ত্রক প্রতিষ্ঠানের নাম </td>
                        <td><?=$info->institute_name?> </td> 
                        <td> প্রতিষ্ঠানের কোড </td>
                        <td> <?=$info->instituete_code?> </td>                       
                     </tr>
                     <?php } ?>
                  </table>

                  <table class="table table-hover table-condensed" border="0">
                     <caption style="font-size: 16px; font-weight: bold;">গ্রুপ স্কাউটারস কাউন্সিল</caption>
                     <tr>
                        <th width="250"> কাব/স্কাউট লিডার / সহকারী কাব স্কাউট লিডারদের নাম </th>
                        <th width="110"> প্রশিক্ষণ গ্রহণের তারিখ </th>
                        <th> সার্টফিকেট নম্বর </th>
                        <th> প্রশিক্ষণ স্থান </th>
                        <th> দলের দায়িত্ব </th>            
                     </tr>
                     <tr>
                        <td> <?=$info->leader_name1?> </td>
                        <td> <?=date_bangla_calender_format($info->training_date1)?> </td>
                        <td> <?=$info->certificate_no1?> </td>
                        <td> <?=$info->training_place1?> </td>
                        <td> <?=$info->group_res1?> </td>            
                     </tr>
                     <tr>
                        <td> <?=$info->leader_name2?> </td>
                        <td> <?=date_bangla_calender_format($info->training_date2)?> </td>
                        <td> <?=$info->certificate_no2?> </td>
                        <td> <?=$info->training_place2?> </td>
                        <td> <?=$info->group_res2?> </td>            
                     </tr>
                     <tr>
                        <td> <?=$info->leader_name3?> </td>
                        <td> <?=date_bangla_calender_format($info->training_date3)?> </td>
                        <td> <?=$info->certificate_no3?> </td>
                        <td> <?=$info->training_place3?> </td>
                        <td> <?=$info->group_res3?> </td>            
                     </tr>
                     <tr>
                        <td> <?=$info->leader_name4?> </td>
                        <td> <?=date_bangla_calender_format($info->training_date4)?> </td>
                        <td> <?=$info->certificate_no4?> </td>
                        <td> <?=$info->training_place4?> </td>
                        <td> <?=$info->group_res4?> </td>            
                     </tr>
                  </table> 

                  <div style="font-size: 16px; font-weight: bold; text-align: center;margin-top: 10px;">গ্রুপ কমিটি</div>
                  <table>
                     <tr>
                        <td width="150"> সভাপতির নাম </td>
                        <td> <?=$info->grp_president?> </td>
                        <td width="150"> সম্পাদের নাম </td>
                        <td> <?=$info->grp_secretary?> </td>
                     </tr>
                     <tr>
                        <td> সভাপতির ঠিকানা </td>
                        <td> <?=$info->grp_president_add?> </td> 
                        <td> সম্পাদের ঠিকানা </td>
                        <td> <?=$info->grp_secretary_add?> </td>                       
                     </tr>
                  </table>

                  <table class="table table-hover table-condensed" border="0">
                     <caption style="font-size: 16px; font-weight: bold;">পরিসংখ্যান</caption>
                     <tr>
                        <th width="100">বিভাগ/শ্রেনী </th>
                        <th> মেম্বারশীপ ব্যাজ </th>
                        <th> তাঁরা ব্যাজ/স্ট্যান্ডার্ড ব্যাজ </th>
                        <th> চাঁদ ব্যাজ </th>            
                        <th> চাঁদ তাঁরা ব্যাজ / সার্ভিজ ব্যাজ </th>
                        <th> প্রেসিডেন্ট স্কাউট/ শাপলা কাব </th>
                        <th> মোট </th>
                     </tr>
                     <tr>
                        <td> কাব স্কাউট </td>
                        <td align="center"> <?=eng2bng($info->member_badge_cub)?> </td>
                        <td align="center"> <?=eng2bng($info->moon_standard_cub)?> </td>
                        <td align="center"> <?=eng2bng($info->moon_progress_cub)?> </td>
                        <td align="center"> <?=eng2bng($info->moon_service_cub)?> </td>
                        <td align="center"> <?=eng2bng($info->president_shapla_cub)?> </td>
                        <td align="center"> <?php $total_cub = $info->member_badge_cub+$info->moon_standard_cub+$info->moon_progress_cub+$info->moon_service_cub+$info->president_shapla_cub; echo eng2bng($total_cub);?> </td>
                     </tr>
                     <tr>
                        <td> বয় স্কাউট </td>
                        <td align="center"> <?=eng2bng($info->member_badge_boy)?> </td>
                        <td align="center"> <?=eng2bng($info->moon_standard_boy)?> </td>
                        <td align="center"> <?=eng2bng($info->moon_progress_boy)?> </td>
                        <td align="center"> <?=eng2bng($info->moon_service_boy)?> </td>
                        <td align="center"> <?=eng2bng($info->president_shapla_boy)?> </td>
                        <td align="center"> <?php $total_boy = $info->member_badge_boy+$info->moon_standard_boy+$info->moon_progress_boy+$info->moon_service_boy+$info->president_shapla_boy; echo eng2bng($total_boy); ?> </td>
                     </tr>
                     <tr>
                        <td> মোট </td>
                        <td align="center"> <?=eng2bng($info->member_badge_cub+$info->member_badge_boy)?> </td>
                        <td align="center"> <?=eng2bng($info->moon_standard_cub+$info->moon_standard_boy)?> </td>
                        <td align="center"> <?=eng2bng($info->moon_progress_cub+$info->moon_progress_boy)?> </td>
                        <td align="center"> <?=eng2bng($info->moon_service_cub+$info->moon_service_boy)?> </td>
                        <td align="center"> <?=eng2bng($info->president_shapla_cub+$info->president_shapla_boy)?> </td>
                        <td align="center"> <?=eng2bng($total_cub+$total_boy)?> </td>
                     </tr>
                  </table>

                  <br><br>
                  <div style="float: left; width: 200px;">
                     গ্রুপ কমিটির সভাপতির স্বাক্ষর
                  </div>
                  <div style="float: right; width: 200px; text-align: right;">
                     গ্রুপ কমিটির সম্পাদের স্বাক্ষর
                  </div>
                  <div style="border-top:1px dashed black; clear: both;"> </div>

                  <?php if($info->region_id < 9){ ?>
                  <p style="font-size: 16px;"> <strong><?=$info->grp_name_bn?></strong> টি <?php echo $info->upa_name; ?> এর ........... নম্বর গ্রুপ হিসেবে তালিকাভুক্ত হইতে পারে। </p>
                  <div style="float: left; width: 200px;">
                     কমিশনার <br>
                     <?php echo $info->upa_name; ?>
                  </div>
                  <div style="float: right; width: 200px; text-align: right;">
                     সম্পাদক <br>
                     <?php echo $info->upa_name; ?>
                  </div>
                  <div style="border-top:1px dashed black; clear: both;"> </div>
                  <p style="font-size: 16px;"><strong><?=$info->grp_name_bn?></strong> টি <?php echo $info->upa_name?> এর তালিকাভুক্তি করা হইল।<br>
                  <?php } ?>

                   তালিকা ভুক্তি নম্বর ..................... তারিখ .....................  উক্ত দলের সনদ প্রদানের জন্য অনুরোধ জানানো যাইতেছে।</p>
                   <div style="float: left; width: 200px;">
                    কমিশনার<br>
                    <?php echo $info->dis_name?>
                 </div>
                 <div style="float: right; width: 200px; text-align: right;">
                    সম্পাদক <br>
                    <?php echo $info->dis_name?>
                 </div>
                 <div style="border-top:1px dashed black; clear: both;"> </div>

                 <p style="font-size: 16px;"><?php echo $info->grp_name_bn?> কে <?php echo $info->region_name?> তালিকাভুক্তি করা হইল। দলের সনদ নম্বরঃ .............................. তারিখ..............................</p>        
                 <div style="float: right; width: 200px; text-align: right;">
                    সম্পাদক <br>
                    <?php echo $info->region_name?>
                 </div>


              </div>

           </div>
        </div>
     </div>

  </div> <!-- END Content -->

</div>