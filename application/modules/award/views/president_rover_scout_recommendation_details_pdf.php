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

<?php
//generate a string for present addresss
$full_pre_add = '';
$pre_village  = $info->pre_village_house;
$pre_village_bn  = $info->pre_village_house_bn;
$pre_rode     = $info->pre_road_block;
$pre_rode_bn  = $info->pre_road_block_bn;
$pre_division = $info->pre_div_name;
$pre_district = $info->pre_district_name;
$pre_up_th    = $info->pre_up_th_name;
$pre_po       = $info->pre_post_office;

if($pre_village != '')
 $full_pre_add .= $pre_village . ', ';

if($pre_rode != '')
 $full_pre_add .= $pre_rode . ', ';

if($pre_up_th != '')
 $full_pre_add .= $pre_up_th . ', ';

if($pre_district != '' && $pre_division != '' && $pre_division != $pre_district)
 $full_pre_add .= $pre_district . ', ';
else if($pre_district != '')
 $full_pre_add .= $pre_district;


//generate a string for permanent addresss
$full_perm_addre = '';
$per_village  = $info->per_village_house;
$per_village_bn = $info->per_village_house_bn;
$per_rode     = $info->per_road_block;
$per_rode_bn  = $info->per_road_block_bn;
$per_division = $info->per_div_name;
$per_district = $info->per_district_name;
$per_up_th    = $info->per_up_th_name;
$per_po       = $info->per_post_office;

if($per_village != '')
  $full_perm_addre .= $per_village . ', ';

if($per_rode != '')
  $full_perm_addre .= $per_rode . ', ';

if($per_up_th != '')
  $full_perm_addre .= $per_up_th . ', ';

if($per_district != '' && $per_division != '' && $per_division != $per_district)
  $full_perm_addre .= $per_district . ', ';
else if($per_district != '')
  $full_perm_addre .= $per_district;

if($per_division != '' && $per_division != $per_district)
  $full_perm_addre .= $per_division;
//END- generate a string for permanent address

?> 

<div class="page-content">     
 <div class="content">  
   <div style="text-align: center;">
     <div  style="font-size: 30px;">বাংলাদেশ স্কাউটস</div>
     <span>www.scouts.gov.bd</span>
   </div>
   <div class="row-fluid">
     <div class="span12">
      <div class="grid simple ">
       <div class="grid-title">
        <h2 align="center"><span class="semi-bold"><?=$meta_title; ?></span></h2>
        <div style="text-align: right;margin-bottom: 5px;">Date: <?= date('d F, Y') ?></div>       
      </div>

      <div class="grid-body ">
        <table class="table table-hover table-condensed" border="0">
        <caption class="title">১। জীবন বৃত্তান্ত</caption>
          <tr>
            <td style="width:200"> স্কাউটস আইডি </td> <td colspan="3"><?=$info->scout_id?></td>
          </tr>
          <tr>
            <td>প্রার্থী নাম (বাংলা)</td> <td colspan="3"><?=$info->full_name_bn?></td>                     
          </tr>
          <tr>
            <td>প্রার্থী নাম (ইংরেজী)</td> <td colspan="3"><?=$info->first_name?></td>
          </tr>
          <tr>
            <td>পিতার নাম</td> <td colspan="3"><?=$info->father_name_bn?></td>                     
          </tr>
          <tr>
            <td>মাতার নাম</td> <td colspan="3"><?=$info->mother_name_bn?></td>                     
          </tr>
          <tr>
            <td>জন্ম তারিখ</td> <td><?=date_bangla_calender_format($info->dob)?></td>                     
            <td>জন্ম নিবন্ধন </td> <td><?=eng2bng($info->birth_id)?></td>                     
          </tr>
          <tr>
            <td>বর্তমান ঠিকানা </td> <td colspan="3"><?=$full_pre_add?></td>                     
          </tr>
          <tr>
            <td>স্থায়ী  ঠিকানা </td> <td colspan="3"><?=$full_perm_addre?></td>                     
          </tr>
          <tr>
            <td>অভিভাবকের টেলিফোন নম্বর</td> <td><?=eng2bng($info->phone_emergency)?></td>                     
            <td>মোবাইল নম্বর</td> <td><?=eng2bng($info->phone)?></td>                     
          </tr>
          <tr>
            <td>শিক্ষা প্রতিষ্ঠানের নাম</td> <td><?=$info->institute_name?></td>                     
            <td>যে শেণীতে অধ্যয়নরত</td> <td><?=$info->curr_class?></td>                     
          </tr>
          <tr>
            <td>গ্রুপ / ইউনিটের নাম (বাংলা)</td> <td colspan="3"><?=$info->grp_name_bn?></td>
          </tr>
          <tr>
            <td>গ্রুপ / ইউনিটের নাম (ইংরেজি)</td> <td colspan="3"><?=$info->grp_name?></td>                     
          </tr>
          <tr>
            <td>ইউনিটে ভর্তির তারিখ</td> <td><?=date_bangla_calender_format($info->join_date)?></td>                     
            <td>দীক্ষা গ্রহণের তারিখ</td> <td><?=date_bangla_calender_format($info->join_date)?></td>                     
          </tr>
          <tr>
            <td>উপজেলা স্কাউটস</td> <td colspan="3"><?=$info->upa_name?></td>                     
          </tr>
          <tr>
            <td>জেলা স্কাউটস</td> <td colspan="3"><?=$info->dis_name?></td>                     
          </tr>
          <tr>
            <td>আঞ্চলিক স্কাউটস</td> <td colspan="3"><?=$info->region_name?></td>                     
          </tr>
      </table>  

      <br><br><br>

      <table class="table table-hover table-condensed" border="1">
        <caption class="title">২। স্তর ভিত্তিক যোগ্যতা অর্জনের বিবরণ (আমার স্কাউট রেকর্ড বইয়ের তথ্যানুসার)</caption>
          <tr>
            <th style="width:200"> স্তরের নাম </th> 
            <th>পরীক্ষার নাম ও পদবী </th>
            <th>পরীক্ষা পাশের তারিখ</th>
            <th>পর্যালোচকের (REVIEWER) নাম ও পদবী</th>
          </tr>
          <tr style="height:200px;">
            <th height="70"> সদস্য স্তর </th> 
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <th height="70"> প্রশিক্ষণ স্তর </th> 
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <th height="70"> সেবা স্তর </th> 
            <td></td>
            <td></td>
            <td></td>
          </tr>
      </table>  

      <br><br><br><br><br><br><br><br><br><br><br><br>

      <table class="table table-hover table-condensed" border="1">
        <caption class="title">৩। পারদর্শিতা ব্যাজ অর্জনঃ</caption>
        <tr>
          <th height="70" rowspan="2">স্তরের নাম</th>
          <th rowspan="2">কাজের বিবরণ</th>
          <th colspan="6" align="center">ব্যাজ অর্জন সম্পর্কীয় তথ্য</th>
        </tr>
        <tr>
          <td>কাজ আরম্ভের তারিখ</td>
          <td>কাজ সমাপ্তির তারিখ</td>
          <td>পরীক্ষা পাশের তারিখ</td>
          <td>ব্যাজ অর্জনের তারিখ</td>
          <td>পরীক্ষকের নাম ও পদ মর্যাদা</td>
          <td>পর্যালোচকের নাম ও পদবী</td>
        </tr>
        <tr>
          <td height="80">সেবা প্রশিক্ষণ ব্যাজ</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td height="80">পরিভ্রমণ কারী ব্যাজ</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td height="80">স্কাউট কুশলী ব্যাজ</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td height="80">প্রকল্প ব্যাজ</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td height="80">রোভার ইনস্ট্রাক্টর ব্যাজ</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      </table>

      <br>
      <strong>৪।</strong>
      <table class="table table-hover table-condensed" border="1">
        <tr>
          <th rowspan="2">স্তরের নাম</th>
          <th rowspan="2">কাজের বিবরণ</th>
          <th rowspan="2">স্থান</th>
          <th colspan="2">তারিখ</th>
          <th rowspan="2">কাজের মোট সময় (ঘণ্টায়)</th>
        </tr>
        <tr>
          <td>হতে</td>
          <td>পর্যন্ত</td>
        </tr>
        <tr>
          <td height="80">সদস্য স্তর</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td height="80">প্রশিক্ষণ স্তর</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td height="80">সেবা স্তর</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      </table>

      <br><br>
      <table class="noBorder" border="0">        
        <tr>
          <td colspan="2"><strong>৫।</strong> আমি একজন স্কাউট হিসেবে এই মর্মে ঘোষণা করছি যে উল্লিক্ষিত তথ্যসমূহ নির্ভুল। আমি প্রেসিডন্ট'স রোভার স্কাউট অ্যাওয়ার্ড পাওয়ার জন্য গঠন ও নিয়ম মোতাবেক সকল বিষয়ে দক্ষতা ও পারদর্শিতা অর্জন করেছি এবং যথানিয়মে পরীক্ষায় অংশগ্রহণ করে সাফল্য অর্জন করেছি। </td>
        </tr>
        <tr>          
          <td></td>
          <td align="right" width="300">
            <hr>
            <strong>প্রার্থীর স্বাক্ষর</strong><br>
            তারিখ ...... ...................
          </td>          
        </tr>
      </table>

      <br>

      <table class="noBorder" border="0">        
        <tr>
          <td><strong>৬।</strong> ইউনিট কাউন্সিল কর্তৃক অনুমোদনের তারিখ .............................................................................................</td>
        </tr>        
      </table>

      <br><br>
      
      <table class="noBorder" border="0">        
        <tr>
          <td colspan="3">
            <strong>৭।</strong> রোভার স্কাউট <strong> <?=$info->full_name_bn?> </strong> প্রসিডেন্ট'স রোভার স্কাউট অ্যাওয়ার্ড পাওয়ার সকল প্রয়োজনীয় পরীক্ষায় কৃতকার্য হয়েছে। ইউনিট কাউন্সিলের সভায় তাকে প্রেসিডন্ট'স রোভার স্কাউট অ্যাওয়ার্ড প্রদানের সুপারিশ করা হয়েছে।
          </td>
        </tr>
        <tr>          
          <td align="center" height="130">
            <hr class="line">
            <strong>গ্রুপ কমিটির সভাপতির স্বাক্ষর </strong><br>
            তারিখ ...... ...................
          </td>
          <td align="center">
            
          </td>
          <td align="center">
            <hr class="line">
            <strong>রোভার স্কাউট লীডারের স্বাক্ষর</strong><br>
            তারিখ ...... ...................
          </td>          
        </tr>
      </table>

      <br>

      <table class="table table-hover table-condensed" border="1">
        <caption class="title">৮। জেলা রোভার স্কাউটস কর্তৃক নিয়োজিত পর্যালোচকের মন্তব্যঃ</caption>
          <tr>
            <th align="center"> পর্যালোচকবৃন্দের নাম ও পদমর্যাদা </th> 
            <th align="center">পর্যালোচক কর্তৃক অনুমোদনের তারিখ</th>
            <th align="center">লগবই সম্পর্কে মন্তব্য </th>
            <th align="center">স্কাউট দক্ষতা ও পারদর্শিতা সম্পর্কে মন্তব্য </th>
          </tr>
          <tr>
            <td height="100"></td> 
            <td></td>
            <td></td>
            <td></td>
          </tr>
      </table> 

      <br><br>

      <table class="noBorder" border="0">        
        <tr>
          <td colspan="3">
          <strong>৮.১</strong> এই মর্মে সার্টিফিকেট প্রদান করা যাচ্ছে যে, উল্লিখিত রোভার স্কাউট "গঠন ও নিয়মের" বিধান অনুযায়ী প্রেসিডেন্ট'স রোভার স্কাউট অ্যাওয়ার্ডেরর জন্য প্রয়োজনীয় যোগ্যতা অর্জন করেছে। তাকে প্রেসিডেন্ট'স রোভার স্কাউট অ্যাওয়ার্ড প্রদানের সুপারিশ করা হলো।
          </td>
        </tr>
        <tr>          
          <td align="left" width="35%" height="150">            
            তারিখ .........................
          </td>
          <td width="23%"></td>
          <td align="right" width="35%">
            <hr>
            <strong>কমিশনার </strong><br>
            জেলা রোভার স্কাউটস <br>
          </td>          
        </tr>
      </table>

       <br>

      <table class="noBorder" border="0">        
        <tr>
          <td><strong>৮.২।</strong> স্নারক নং  <strong> </td>
          <td>তারিখ ......................... </td>
        </tr>
        <tr>
          <td colspan="2"> <br> প্রয়োজনীয় ব্যবস্থা গ্রহণ করার জন্য আঞ্চলিক স্কাউটসে প্রেরণ করা হল। </td>
        </tr>
        <tr>       
          <td></td>   
          <td align="right" width="35%">
            <hr width="200px;">
            <strong>সম্পাদক </strong><br>
            জেলা রোভার স্কাউটস <br>
          </td>          
        </tr>
      </table>


      <br><br><br><br><br><br><br><br><br>

      <table class="table table-hover table-condensed" border="1">
        <caption class="title">৯। রোভার আঞ্চলিক স্কাউটস কর্তৃক নিয়োজিত পর্যালোচকের মন্তব্যঃ</caption>
          <tr>
            <th align="center"> পর্যালোচকবৃন্দের নাম ও পদমর্যাদা</th> 
            <th align="center">পর্যালোচক কর্তৃক অনুমোদনের তারিখ</th>
            <th align="center">লগবই সম্পর্কে মন্তব্য </th>
            <th align="center">স্কাউট দক্ষতা ও পারদর্শিতা সম্পর্কে মন্তব্য </th>
          </tr>
          <tr>
            <td height="130"></td> 
            <td></td>
            <td></td>
            <td></td>
          </tr>
      </table> 

      <br><br><br><br><br><br>
      <span style="font-size:20px;">আঞ্চলিক কমিশনারের স্বাক্ষর</span><br>
      তারিখ .........................

      <br><br> <br><br>

      <table class="noBorder" border="0">        
        <tr>
          <td><strong>৯.১।</strong> স্নারক নং  <strong> </td>
          <td>তারিখ ......................... </td>
        </tr>
        <tr>
          <td colspan="2"> <br> প্রয়োজনীয় ব্যবস্থা গ্রহণ করার জন্য জাতীয় কার্যালয়ে প্রেরণ করা হল। </td>
        </tr>
        <tr>       
          <td></td>   
          <td align="right" width="35%">
            <hr width="200px;">            
            আঞ্চলিক সম্পাদকের স্বাক্ষর <br>
          </td>          
        </tr>
      </table>


      <br><br><br><br><br><br><br>
      <br><br><br><br><br><br><br>
      <br><br><br><br><br><br><br>
      <br><br><br><br><br><br><br> <br><br>

      <table class="table table-hover table-condensed" border="1">
        <caption class="title">১০। জাতীয় সাক্ষাতকার কমিটির মন্তব্যঃ</caption>
          <tr>
            <td height="800"></td> 
          </tr>
        </table>

        <br><br><br>

      <table class="noBorder" border="0" style="border:0; ">        
        <tr>          
          <td align="left" width="35%" height="150">
          <hr>
            তারিখ
          </td>
          <td width="23%"></td>
          <td align="right" width="35%">
            <hr>
            চেয়ারম্যান<br>
            জাতীয় সাক্ষাৎকার কমিটি<br>
            বাংলাদেশ স্কাউটস
          </td>          
        </tr>
      </table>

    </div>

  </div>
</div>
</div>

</div> <!-- END Content -->

</div>