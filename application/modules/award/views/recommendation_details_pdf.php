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
        <table class="table table-hover table-condensed" border="0">
          <tr>
            <td style="width:200"> Recommended Award Name </td> <td><?=$info->award_name_bn?></td>
          </tr>
          <tr>
            <td>Scout ID</td> <td><?=$info->scout_id?></td>                     
          </tr>
          <tr>
            <td>Name (Bangla)</td> <td><?=$info->name_bn?></td>                     
          </tr>
          <tr>
            <td>Name (English)</td> <td><?=$info->name_en?></td>                     
          </tr>
          <tr>
            <td>Father Name</td> <td><?=$info->father_name?></td>                     
          </tr>
          <tr>
            <td>Mother Name</td> <td><?=$info->mother_name?></td>                     
          </tr>
          <tr>
            <td>Date of Birth</td> <td><?=$info->dob?></td>                     
          </tr>
          <tr>
            <td>Present Age</td> <td><?=$info->age?></td>                     
          </tr>
          <tr>
            <td>Scout Joining Date (Leader)</td> <td><?=$info->leader_join?></td>                     
          </tr>
          <tr>
            <td>Present Scouts Designation</td> <td><?=$info->present_desig?></td>                     
          </tr>
          <tr>
            <td>Phone</td> <td><?=$info->phone?></td>                     
          </tr>
          <tr>
            <td>Email Address</td> <td><?=$info->email?></td>                     
          </tr>
          <tr>
            <td>Gender</td> <td><?=$info->gender?></td>                     
          </tr>
          <tr>
            <td>Working Designation</td> <td><?=$info->working_desig?></td>                     
          </tr>
          <tr>
            <td>Present Address</td> <td><?=$info->present_address?></td>                     
          </tr>
          <tr>
            <td>Permanent Address</td> <td><?=$info->permanent_address?></td>                     
          </tr>
          <tr>
            <td>Group/Unit Name</td> <td><?=$info->sc_group_name?></td>                     
          </tr>
          <tr>
            <td>Upazila Name</td> <td><?=$info->sc_upazila_name?></td>                     
          </tr>
          <tr>
            <td>District Name</td> <td><?=$info->sc_district_name?></td>                     
          </tr>
          <tr>
            <td>Region Name</td> <td><?=$info->sc_region_name?></td>                     
          </tr>
          <tr>
            <td>Citation</td> <td><?=$info->citation?></td>                     
          </tr>                    
        </tr>
      </table>

      <?php 
      $image_1=$image_2=$image_3=NULL;
      // $path = FCPATH.'uploads/award_event/';
      $path = base_url('uploads/award_event/');
      if($info->image1 != NULL){
        $image_1 = '<img src="'.$path.$info->image1.'" style="height: 300px;">';
      }
      if($info->image2 != NULL){
        $image_2 = '<img src="'.$path.$info->image2.'" style="height: 300px;">';
      }
      if($info->image3 != NULL){
        $image_3 = '<img src="'.$path.$info->image3.'" style="height: 300px;">';
      }
      ?>
      <table class="table table-hover table-condensed" border="0">
        <caption style="text-align: left;">ইভেন্টের ইমেজ</caption>
        <tr>
          <td> <?=$image_1?> </td>
          <td> <?=$image_2?> </td>
          <td> <?=$image_3?> </td>
        </tr>
      </table>

      <h4>As Scouters Responsibility Information 
        <table>
          <caption style="text-align: left;">(ক) স্কাউটার হিসেবে দায়িত্ব পালন সংক্রান্ত তথ্য বিবরণী</caption>
          <tr>
            <th>SL</th>
            <th>On Duity Office Level</th>
            <th>Designation</th>
            <th>Date From</th>
            <th>Date To</th>
          </tr>
          <?php 
          $sl=0;
          foreach ($scouter_respon as $row) { 
            $sl++;
            ?>
            <tr> 
              <td><?php echo $sl;?></td>
              <td><?php echo $row->office_type_name;?></td>
              <td><?php echo $row->committee_designation_name;?></td> 
              <td><?php echo $row->res_date_from;?></td> 
              <td><?php echo $row->res_date_to;?></td> 
            </tr>
            <?php } ?>
          </table>
          <br><br>
          <table>
            <caption style="text-align: left;">(খ) ইউনিট/উপজেলা/জেলা/অঞ্চল/জাতীয় পর্যায়ে নির্বাহী/অনির্বাহী পদে দায়িত্ব পালন</caption>
            <tr>
              <th>SL</th>
              <th>On Duity Office Level</th>
              <th>Designation</th>
              <th>Date From</th>
              <th>Date To</th>
            </tr>
            <?php 
            $sl=0;
            foreach ($non_exe_respon as $row) { 
              $sl++;
              ?>
              <tr> 
                <td><?php echo $sl;?></td>
                <td><?php echo $row->office_type_name;?></td>
                <td><?php echo $row->committee_designation_name;?></td> 
                <td><?php echo $row->noe_date_from;?></td> 
                <td><?php echo $row->noe_date_to;?></td> 
              </tr>
              <?php } ?>
            </table>

            <br><br>
            <table>
              <caption style="text-align: left;">Previous Achived Award (পূর্বে প্রাপ্ত অ্যাওয়ার্ডের বিবরণ)</caption>
              <tr>
                <th>SL</th>
                <th>Award Name </th>
                <th>Year</th>
              </tr>
              <?php 
              $sl=0;
              foreach ($award_achived as $row) { 
                $sl++;
                ?>
                <tr> 
                  <td><?php echo $sl;?></td>
                  <td><?php echo $row->award_name_bn;?></td>
                  <td><?php echo $row->award_year;?></td> 
                </tr>
                <?php } ?>
              </table>

              <div class="row" style="margin-top: 20px;">
               <div class="col-md-12">
                <p>স্কাউট আন্দোলনের সার্বিক উন্নয়ন , সম্প্রসারণ, প্রশিরক হিসেবে দায়িত্ব পালন, গ্রুপ/ইউনিক পরিচালনার সাইটেশন(সংক্ষিপ্ত বিবরণ) ।<br>
                  সাইটেশন লিখবেন কেবলমাত্র সুপারিশকারী কর্মকর্তা । কোন প্রার্থী নিজের সাইটেশন নিজে লিখতে পারবেন না(প্রয়োজনে পৃথক কাগজে সংযুক্ত করা যাবে) । </p>

                  <table>
                    <caption style="text-align: left;">ইভেন্টের তালিকা</caption>
                    <tr>
                      <th>ক্রম</th>
                      <th>অফিস পর্যায়</th>
                      <th>ইভেন্টের ধরণ</th>
                      <th>তারিখ হতে</th>
                      <th>তারিখ পর্যন্ত</th>
                      <th>সম্পৃক্ততার ধরণ</th>
                    </tr>
                    <?php 
                    $sl=0;
                    foreach ($event_list as $row) { 
                      $sl++;
                    ?>
                    <tr> 
                      <td><?php echo $sl;?></td>
                      <td><?php echo $row->office_type_name;?></td>
                      <td><?php echo $row->event_cate_name;?></td> 
                      <td><?php echo date_browse_format($row->evt_date_from);?></td> 
                      <td><?php echo date_browse_format($row->evt_date_to);?></td> 
                      <td><?php echo $row->evt_comments;?></td> 
                    </tr>
                    <?php } ?>
                  </table>
                  <br><br>

                  <p>রেকর্ড দুষ্টে প্রার্থী তাঁর সকল পদে দায়িত্বকালীন সময়ে অত্যন্ত নিষ্ঠা, বিশ্বস্থতা ও দক্ষতার সাথে তাঁর উপর অর্পিত দায়িত্ব ও কর্তব্য সম্পাদন করেছেন। তাঁর কাজের স্বীকৃতিস্বরূপ তাঁকে .................................অ্যাওয়ার্ড প্রদানের সুপারিশ করছি। </p>
                </div>
              </div>

              <div class="row" style="margin-top: 20px;">
               <div class="col-md-12">
                <style type="text/css">
                 .tg2  {border-collapse:collapse;border-spacing:0;color: black; margin-bottom: 20px;}
                 .tg2 caption{font-weight: bold; font-size: 18px; color: black;}
                 .tg2 td{font-size:14px;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;color: black;}
                 .tg2 th{font-size:14px;font-weight:normal;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;color: black;}
                 .tg2 .tg-bm2g{font-weight:bold;background-color:#c0c0c0;border-color:#9b9b9b;text-align:center;vertical-align:top}
                 .tg2 .tg-2fdn{border-color:#9b9b9b;text-align:left;vertical-align:top}
                 .tg2 .tg-xyy0{font-weight:bold;background-color:#c0c0c0;border-color:#9b9b9b;text-align:center;vertical-align:middle}
                 .tg2 .tg-m6jf{border-color:#9b9b9b;text-align:left;vertical-align:middle}
               </style>

               <?php 
               // Status
               $nhq_verify = event_verify_status($info->verify_nhq);
               $region_verify = event_verify_status($info->verify_region);
               $district_verify = event_verify_status($info->verify_district);
               $upazila_verify = event_verify_status($info->verify_upazila);

               ?>

               <table class="tg2" width="98%" style="margin: 10px;">

                 <tr>
                  <th class="tg-xyy0">সম্পাদক <br> বাংলাদেশ স্কাউটস <br>...............<br>উপজেলা</th>
                  <th class="tg-xyy0">কমিশনার <br> বাংলাদেশ স্কাউটস <br>...............<br>উপজেলা</th>
                  <th class="tg-xyy0">সম্পাদক <br> বাংলাদেশ স্কাউটস <br>...............<br>জেলা</th>
                  <th class="tg-bm2g">কমিশনার <br> বাংলাদেশ স্কাউটস <br>...............<br>জেলা</th>
                  <th class="tg-bm2g">সম্পাদক <br> বাংলাদেশ স্কাউটস <br>...............<br>অঞ্চল </th>
                  <th class="tg-bm2g">কমিশনার <br> বাংলাদেশ স্কাউটস <br>...............<br>অঞ্চল </th>
                </tr>

                <tr>
                  <td class="tg-m6jf" style="text-align: center;"><?=$upazila_verify?></td>
                  <td class="tg-m6jf">&nbsp;&nbsp;</td>
                  <td class="tg-m6jf"><?=$district_verify?></td>
                  <td class="tg-2fdn">&nbsp;&nbsp;</td>
                  <td class="tg-2fdn"><?=$region_verify?></td>
                  <td class="tg-2fdn">&nbsp;&nbsp;</td>
                </tr>

              </table>

            </div>
          </div>   


          <div class="row" style="margin-top: 20px;">
           <div class="col-md-12">
            <style type="text/css">
             .tg3  {border-collapse:collapse;border-spacing:0;color: black; margin-bottom: 20px;}
             .tg3 caption{font-weight: bold; font-size: 18px; color: black;}
             .tg3 td{font-size:14px;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;color: black;}
             .tg3 th{font-size:14px;font-weight:normal;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;color: black;}
             .tg3 .tg-bm2g{font-weight:bold;background-color:#ffffff;border-color:#9b9b9b;text-align:center;vertical-align:top}
             .tg3 .tg-2fdn{border-color:#9b9b9b;text-align:left;vertical-align:top}
             .tg3 .tg-xyy0{font-weight:bold;background-color:#ffffff;border-color:#9b9b9b;text-align:center;vertical-align:middle}
             .tg3 .tg-m6jf{border-color:#9b9b9b;text-align:left;vertical-align:middle}
           </style>

           <table class="tg3" width="98%" style="margin: 10px;">

             <tr>
              <th width="100%" class="tg-m6jf"><b>অ্যাওয়ার্ড প্রাপ্তির আবেদন/ সুপারিশের শর্তাবলীঃ</b> <br>একটি ধাপ থেকে অন্য ধাপকে অতিক্রম করে অ্যাওয়ার্ডের জন্য আবেদন করা যাবে না। একটি অ্যাওয়ার্ড প্রাপ্তির পর নির্দিষ্ট সময় সমাপ্ত না হলে অন্য অ্যাওয়ার্ডের জন্য আবেদন করা যাবে না। অন্যথায় ফরমটি বাতিল বলে গন্য হবে।  </th>

            </tr>

          </table>
        </div>
      </div>


    </div>

  </div>
</div>
</div>

</div> <!-- END Content -->

</div>