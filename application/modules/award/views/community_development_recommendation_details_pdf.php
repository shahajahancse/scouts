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
        <caption class="title">১. জীবন বৃত্তান্ত</caption>
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
        <caption class="title">২. দক্ষতা ব্যাজ ভিত্তিক যোগ্যতা অর্জনের বিবরণ (মাই গ্রোগেস এর তথ্য অনুযায়ী)</caption>
          <tr>
            <th style="width:200"> ব্যাজ/ অ্যাওয়ার্ড  </th> 
            <th>মূল্যায়ন মান অর্জনের তারিখ</th>
            <th>মূল্যায়নকারীর নাম ও পদবী</th>
          </tr>
          <tr style="height:200px;">
            <th> সদস্য ব্যাজ  </th> 
            <td></td>
            <td></td>
          </tr>
          <tr>
            <th> তারা ব্যাজ </th> 
            <td></td>
            <td></td>
          </tr>
          <tr>
            <th> চাঁদ ব্যাজ </th> 
            <td></td>
            <td></td>
          </tr>
          <tr>
            <th> চাঁদ তারা ব্যাজ </th> 
            <td></td>
            <td></td>
          </tr>
          <tr>
            <th> শাপলা কাব অ্যাওয়ার্ড </th> 
            <td></td>
            <td></td>
          </tr>        
      </table>  

      <br><br><br><br><br><br><br><br><br><br><br><br>

      <table class="table table-hover table-condensed" border="1">
        <caption class="title">৩. দক্ষতা ও পারদর্শিতা ব্যাজ অর্জনের বিবরণঃ</caption>
        <tr>
          <th colspan="2" align="center">দক্ষতা ব্যাজ</th>
          <th colspan="3" align="center">পারদর্শিতা ব্যাজ</th>
        </tr>
        <tr>
          <th align="center">ব্যাজ/ অ্যাওয়ার্ড</th>
          <th align="center">মান অর্জনের তারিখ</th>
          <th align="center">ব্যাজের নাম</th>
          <th align="center">ব্যাজের গ্রুপ</th>
          <th align="center">মান অর্জনের তারিখ</th>
        </tr>
        <tr>
          <th rowspan="2">তারা ব্যাজ</th>
          <td rowspan="2"></td>
          <td>১.</td>
          <td>সূর্য গ্রুপ</td>
          <td></td>
        </tr>
        <tr>
          <td>২.</td>
          <td>বেগুনী গ্রুপ</td>
          <td></td>
        </tr>
        <tr>
          <th rowspan="3">চাঁদ ব্যাজ</th>
          <td rowspan="3"></td>
          <td>১.</td>
          <td>সূর্য গ্রুপ</td>
          <td></td>
        </tr>
        <tr>
          <td>২.</td>
          <td>নীল গ্রুপ</td>
          <td></td>
        </tr>
        <tr>
          <td>৩.</td>
          <td>আকাশী গ্রুপ</td>
          <td></td>
        </tr>
        <tr>
          <th rowspan="3">চাঁদ তারা ব্যাজ</th>
          <td rowspan="3"></td>
          <td>১.</td>
          <td>সূর্য গ্রুপ</td>
          <td></td>
        </tr>
        <tr>
          <td>২.</td>
          <td>সবুজ গ্রুপ</td>
          <td></td>
        </tr>
        <tr>
          <td>৩.</td>
          <td>হলুদ গরুপ</td>
          <td></td>
        </tr>
        <tr>
          <th rowspan="3">শাপলা কাব অ্যাওয়ার্ড</th>
          <td rowspan="3"></td>
          <td>১.</td>
          <td>সূর্য গ্রুপ</td>
          <td></td>
        </tr>
        <tr>
          <td>২.</td>
          <td>কমলা গ্রুপ</td>
          <td></td>
        </tr>
        <tr>
          <td>৩.</td>
          <td>লাল গরুপ</td>
          <td></td>
        </tr>
      </table> 

      <br>

      <table class="noBorder" border="0">        
        <tr>
          <td colspan="2"><strong>৪.</strong> আমি <strong> <?=$info->full_name_bn?> </strong> শাপলা কাব অ্যাওয়ার্ড অর্জনের জন্য কাব স্কাউট প্রোগ্রাম অনুযায়ী সকল বিষয়ে দক্ষতা অর্জন করেছি এবং নিয়মমাফিক মূল্যায়নে অংশগ্রহণ করে সাফল্য অর্জন করেছি।</td>
        </tr>
        <tr>          
          <td></td>
          <td align="right" width="300">
            <hr>
            <strong>অ্যাওয়ার্ড প্রার্থী কাব স্কাউট</strong><br>
            তারিখ ...... ...................
          </td>          
        </tr>
      </table>

      <br>
      
      <table class="noBorder" border="0">        
        <tr>
          <td colspan="3">
            <strong>৫.</strong> কাব স্কাউট <strong> <?=$info->full_name_bn?> </strong> শাপলা কাব অ্যাওয়ার্ড অর্জনের জন্য মূল্যায়নে কৃতকার্য হয়েছে। তাকে শাপলা কাব অ্যাওয়ার্ড প্রদানের সুপারিশ করা হলো।
          </td>
        </tr>
        <tr>          
          <td align="center" height="130">
            <hr class="line">
            <strong>গ্রুপ কমিটির সভাপতি </strong><br>
            তারিখ ...... ...................
          </td>
          <td align="center">
            <hr class="line">
            <strong>গ্রুপ স্কাউট লিডার</strong><br>
            তারিখ ...... ...................
          </td>
          <td align="center">
            <hr class="line">
            <strong>কাব স্কাউট ইউনিট লিডার</strong><br>
            তারিখ ...... ...................
          </td>          
        </tr>
      </table>

      <br><br>

      <table class="table table-hover table-condensed" border="1">
        <caption class="title">৬. (ক) উপজেলা স্কাউটস কর্তৃক মূল্যায়ন ও পর্যালোচনাকারীগ্ণের তথ্যঃ</caption>
          <tr>
            <th style="width:60" align="center"> ক্রমিক নং </th> 
            <th align="center">নাম</th>
            <th align="center">এলটি /এএলটি/উডব্যজার</th>
            <th align="center">স্কাউট পদবী </th>
            <th align="center">স্বাক্ষর</th>
          </tr>
          <tr>
            <th> ০১ </th> 
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <th> ০২ </th> 
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <th> ০৩ </th> 
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
      </table> 
      <table class="table table-hover table-condensed" border="0">
        <caption class="title">(খ) ফলাফল (বিস্তারিত) </caption>
          <tr>
            <th style="width:60" align="center"> লিখিত </th> 
            <th align="center">সাঁতার</th>
            <th align="center">ব্যক্তিগত সাক্ষাৎকার</th>
            <th align="center">উত্তীর্ণ/অনুত্তীর্ণ </th>
            <th align="center">পর্যালোচক বৃন্দের মন্তব্য</th>
          </tr>
          <tr>
            <td height="80"></td> 
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        </table>

        <br>

      <table class="noBorder" border="0">        
        <tr>
          <td colspan="3">
          <strong>৭.</strong> এই মর্মে প্রত্যয়ন করা যাচ্ছে য কাব স্কাউট <strong> <?=$info->full_name_bn?> </strong> কাব স্কাউট প্রোগ্রাম অনুযায়ী শাপলা কাব অ্যাওয়ার্ড অর্জনের জন্য প্রয়োজনীয় যোগ্যতা অর্জন করেছে।
তাকে শাপলা কাব অ্যাওয়ার্ড প্রদানের সুপারিশ করা হলো।
          </td>
        </tr>
        <tr>          
          <td align="left" width="35%" height="150">
            <hr>
            <strong>উপজেলা কাব স্কাউটস লিডার </strong><br>
            <?=$info->upa_name?><br>
            তারিখ .........................
          </td>
          <td width="23%"></td>
          <td align="right" width="35%">
            <hr>
            <strong>কমিশনার </strong><br>
            <?=$info->upa_name?> <br>
            তারিখ .........................
          </td>          
        </tr>
      </table>

       <br>

      <table class="noBorder" border="0">        
        <tr>
          <td><strong>৮.</strong> স্নারক নং  <strong> </td>
          <td>তারিখ ......................... </td>
        </tr>
        <tr>
          <td colspan="2"> <br> প্রয়োজনীয় ব্যবস্থা গ্রহণের জন্য জেলা স্কাউটসে প্রেরণ করা হলো। </td>
        </tr>
        <tr>       
          <td></td>   
          <td align="right" width="35%">
            <hr width="200px;">
            <strong>কমিশনার </strong><br>
            <?=$info->upa_name?> <br>
            তারিখ .........................
          </td>          
        </tr>
      </table>

      <br><br>

      <table class="table table-hover table-condensed" border="1">
        <caption class="title">৯. (ক) জেলা স্কাউটস কর্তৃক মূল্যায়ন ও পর্যালোচনাকারীগ্ণের তথ্যঃ</caption>
          <tr>
            <th style="width:60" align="center"> ক্রমিক নং </th> 
            <th align="center">নাম</th>
            <th align="center">এলটি /এএলটি/উডব্যজার</th>
            <th align="center">স্কাউট পদবী </th>
            <th align="center">স্বাক্ষর</th>
          </tr>
          <tr>
            <th> ০১ </th> 
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <th> ০২ </th> 
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <th> ০৩ </th> 
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
      </table> 
      <table class="table table-hover table-condensed" border="0">
        <caption class="title">(খ) ফলাফল (বিস্তারিত) </caption>
          <tr>
            <th style="width:60" align="center"> লিখিত </th> 
            <th align="center">সাঁতার</th>
            <th align="center">ব্যক্তিগত সাক্ষাৎকার</th>
            <th align="center">উত্তীর্ণ/অনুত্তীর্ণ </th>
            <th align="center">পর্যালোচক বৃন্দের মন্তব্য</th>
          </tr>
          <tr>
            <td height="80"></td> 
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        </table>

        <br>

      <table class="noBorder" border="0">        
        <tr>
          <td colspan="3">
          <strong>১০.</strong> এই মর্মে প্রত্যয়ন করা যাচ্ছে যে কাব স্কাউট <strong> <?=$info->full_name_bn?> </strong> শাপলা কাব অ্যাওয়ার্ড অর্জনের প্রয়োজনীয় যোগ্যতা অর্জন করেছে। তাকে শাপলা কাব অ্যাওয়ার্ড প্রদানের জন্য সুপারিশ করা হলো।
          </td>
        </tr>
        <tr>          
          <td align="left" width="35%" height="150">
            <hr>
            <strong>জেলা কাব স্কাউটস লিডার  </strong><br>
            <?=$info->dis_name?><br>
            তারিখ .........................
          </td>
          <td width="23%"></td>
          <td align="right" width="35%">
            <hr>
            <strong>কমিশনার </strong><br>
            <?=$info->dis_name?> <br>
            তারিখ .........................
          </td>          
        </tr>
      </table>

       <br><br><br><br><br><br>

      <table class="noBorder" border="0">        
        <tr>
          <td><strong>১১.</strong> স্নারক নং  <strong> </td>
          <td>তারিখ ......................... </td>
        </tr>
        <tr>
          <td colspan="2"> <br> প্রয়োজনীয় ব্যবস্থা গ্রহণের জন্য আঞ্চলিক স্কাউটসে প্রেরণ করা হলো। </td>
        </tr>
        <tr>       
          <td></td>   
          <td align="right" width="35%">
            <hr width="200px;">
            <strong>কমিশনার </strong><br>
            <?=$info->dis_name?> <br>
            তারিখ .........................
          </td>          
        </tr>
      </table>

      <br><br>

      <table class="table table-hover table-condensed" border="1">
        <caption class="title">১২. (ক) আঞ্চলিক স্কাউটস কর্তৃক মূল্যায়ন ও পর্যালোচনাকারীগ্ণের তথ্যঃ</caption>
          <tr>
            <th style="width:60" align="center"> ক্রমিক নং </th> 
            <th align="center">নাম</th>
            <th align="center">এলটি /এএলটি/উডব্যজার</th>
            <th align="center">স্কাউট পদবী </th>
            <th align="center">স্বাক্ষর</th>
          </tr>
          <tr>
            <th> ০১ </th> 
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <th> ০২ </th> 
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <th> ০৩ </th> 
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
      </table> 
      <table class="table table-hover table-condensed" border="0">
        <caption class="title">(খ) ফলাফল (বিস্তারিত) </caption>
          <tr>
            <th style="width:60" align="center"> লিখিত </th> 
            <th align="center">সাঁতার</th>
            <th align="center">ব্যক্তিগত সাক্ষাৎকার</th>
            <th align="center">উত্তীর্ণ/অনুত্তীর্ণ </th>
            <th align="center">পর্যালোচক বৃন্দের মন্তব্য</th>
          </tr>
          <tr>
            <td height="80"></td> 
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        </table>

        <br>

      <table class="noBorder" border="0">        
        <tr>
          <td colspan="2">
          <strong>১৩.</strong> উল্লেখিত শাপলা কাব অ্যাওয়ার্ড প্রার্থীর উপজেলা, জেলা এবং অঞ্চল পর্যায়ের মূল্যায়ন প্রক্রিয়ায় অংশ গ্রহণ করেছে। যথাযথভাবে মূল্যায়নে সে উত্তীর্ণ হয়েছে। তাকে শাপলা কাব অ্যাওয়ার্ড প্রদান করার জন্য সুপারিশ করেছি।
          </td>
        </tr>
        <tr>          
          <td align="left">
            তারিখ .........................
          </td>
          <td align="right" width="35%">
            <hr>
            <strong>আঞ্চলিক উপ কমিশনার (প্রোগ্রাম) </strong><br>
            <?=$info->region_name?>            
          </td>          
        </tr>
      </table>

       <br><br>

      <table class="noBorder" border="0">        
        <tr>
          <td><strong>১৪.</strong> স্নারক নং  <strong> </td>
          <td>তারিখ ......................... </td>
        </tr>
        <tr>
          <td colspan="2"> <br> প্রয়োজনীয় ব্যবস্থা গ্রহণের জন্য জাতীয় সদয় দফতরে প্রেরণ করা হলো। </td>
        </tr>
        <tr>       
          <td></td>   
          <td align="right" width="35%">
            <hr width="200px;">
            <strong>আঞ্চলিক সম্পাদক  </strong><br>
            <?=$info->region_name?> <br>
            তারিখ .........................
          </td>          
        </tr>
      </table>

      <br><br><br><br><br><br><br><br><br><br>

      <table class="table table-hover table-condensed" border="1">
        <caption class="title">১৫. জাতীয় সদর দফতর কর্তৃক মূল্যায়নঃ</caption>
          <tr>
            <th style="width:120" align="center"> লিখিত মূল্যায়ন </th> 
            <th align="center">সাঁতার</th>
            <th align="center">ব্যক্তিগত সাক্ষাতকার</th>
            <th align="center">মোট নম্বর </th>
            <th align="center">ফলাফল</th>
          </tr>
          <tr>
            <td height="150"></td> 
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        </table>

        <br>

      <table class="noBorder" border="0">        
        <tr>          
          <td align="left" width="35%" height="150">
            <hr>
            <strong>জাতীয় উপ কমিশনার (প্রোগ্রাম) </strong><br>
            সমন্বয়কারী, জাতীয় মূল্যায়ন কমিটি<br>
            কাব স্কাউট শাখা
          </td>
          <td width="23%"></td>
          <td align="right" width="35%">
            <hr>
            <strong>জাতীয় কমিশনার (প্রোগ্রাম) </strong><br>
            সভাপতি, জাতীয় মূল্যায়ন কমিটি
          </td>          
        </tr>
      </table>

    </div>

  </div>
</div>
</div>

</div> <!-- END Content -->

</div>