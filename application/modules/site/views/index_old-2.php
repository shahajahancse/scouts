<style>
   ul li {list-style-image: url('<?=base_url();?>fwedget/assets/images/bullet_arrow.png');}
   .sc_box a {color: #1aa326;}
</style>   
<div class="col-xl-9 col-lg-9 col-md-7 col-sm-12 col-xs-12">
   <div  class="row">

      <h2 style="text-align: center !important; font-weight: bold;">Online Member Statistics</h2>
          <style type="text/css">
            .tg  {border-collapse:collapse;border-spacing:0;border-color:#bbb; width: 100%}
            .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#E0FFEB; text-align: center;}
            .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#9DE0AD;}
            .tg .tg-rmb8{background-color:#C2FFD6;vertical-align:top; text-align: center;}
            .tg .tg-yw4l{vertical-align:middle; text-align: center; font-weight: bold;}
          </style>
          <table class="tg">
            <tr>
              <th class="tg-yw4l" rowspan="2" width="300">Section</th>
              <th class="tg-yw4l">Male</th>
              <th class="tg-yw4l">Female</th>
              <th class="tg-yw4l">Total</th>
            </tr>
            <tr>
            </tr>
            <tr>
              <th class="tg-yw4l">Cub Scout (6 to 10+)</th>
              <th class="tg-rmb8"><?php echo $count_cub_scout_m;?></th>
              <th class="tg-rmb8"><?php echo $count_cub_scout_f?></th>
              <th class="tg-rmb8"><?php echo $count_cub_scout_m+$count_cub_scout_f;?></th>
            </tr>
            <tr>
              <th class="tg-yw4l">Scout (11 to 16)</th>
              <th class="tg-rmb8"><?php echo $count_scout_m;?></th>
              <th class="tg-rmb8"><?php echo $count_scout_f;?></th>
              <th class="tg-rmb8"><?php echo $count_scout_m+$count_scout_f;?></th>
            </tr>
            <tr>
              <th class="tg-yw4l">Rover Scout (17 to 25)</th>
              <th class="tg-rmb8"><?php echo $count_rober_scout_m;?></th>
              <th class="tg-rmb8"><?php echo $count_rober_scout_f;?></th>
              <th class="tg-rmb8"><?php echo $count_rober_scout_m+$count_rober_scout_f;?></th>
            </tr>
            <tr>
              <th class="tg-yw4l"> A. Total </th>
              <th class="tg-rmb8" style="font-weight: bold;">
                <?php 
                $A=$count_cub_scout_m+$count_scout_m+$count_rober_scout_m;
                echo $A;
                ?>
              </th>
              <th class="tg-rmb8" style="font-weight: bold;">
                <?php 
                $A_f=$count_cub_scout_f+$count_scout_f+$count_rober_scout_f;
                echo $A_f;
                ?>
              </th>
              <th class="tg-rmb8" style="font-weight: bold;">
                <?php echo $A+$A_f;?>
              </th>
            </tr>
            <tr>
              <th class="tg-yw4l">Volunteer Leader & Commissioner</th>
              <th class="tg-rmb8"><?php echo $scouter_s_m;?></th>
              <th class="tg-rmb8"><?php echo $scouter_s_f;?></th>
              <th class="tg-rmb8"><?php echo $scouter_s_m+$scouter_s_f;?></th>
            </tr>
            <tr>
              <th class="tg-yw4l">Non Warranted Members</th>
              <th class="tg-rmb8"><?php echo $non_warrant_m;?></th>
              <th class="tg-rmb8"><?php echo $non_warrant_f;?></th>
              <th class="tg-rmb8"><?php echo $non_warrant_m+$non_warrant_f;?></th>
            </tr>
            <tr>
              <th class="tg-yw4l">Warranted Members</th>
              <th class="tg-rmb8"><?php echo $warrant_m;?></th>
              <th class="tg-rmb8"><?php echo $warrant_f;?></th>
              <th class="tg-rmb8"><?php echo $warrant_m+$warrant_f;?></th>
            </tr>
            <tr>
              <th class="tg-yw4l">Professional Executive</th>
              <th class="tg-rmb8"><?php echo $professional_scouts_m;?></th>
              <th class="tg-rmb8"><?php echo $professional_scouts_f;?></th>
              <th class="tg-rmb8"><?php echo $professional_scouts_m+$professional_scouts_f;?></th>
            </tr>
            <tr>
              <th class="tg-yw4l">Support Staff</th>
              <th class="tg-rmb8"><?php echo $support_staff_m;?></th>
              <th class="tg-rmb8"><?php echo $support_staff_f;?></th>
              <th class="tg-rmb8"><?php echo $support_staff_m+$support_staff_f;?></th>
            </tr>
            <tr>
              <th class="tg-yw4l">B. Total</th>
              <th class="tg-rmb8" style="font-weight: bold;">
                <?php 
                $B=$non_warrant_m+$scouter_s_m+$professional_scouts_m+$support_staff_m+$warrant_m;
                echo $B;
                ?>
              </th>
              <th class="tg-rmb8" style="font-weight: bold;">
               <?php 
               $B_f=$non_warrant_f+$scouter_s_f+$professional_scouts_f+$support_staff_f+$warrant_f;
               echo $B_f;
               ?>
             </th>
             <th class="tg-rmb8" style="font-weight: bold;">
              <?php 
              echo $B+$B_f;
              ?>
            </th>
          </tr>
          <tr>
            <th class="tg-yw4l"  style="text-align: center;font-weight: bold; font-style: italic;">Grand Total(A+B)</th>
            <th class="tg-rmb8"  style="text-align: center;font-weight: bold; font-style: italic;">
              <?php $c=$A+$B; 
              echo $c;?>
            </th>
            <th class="tg-rmb8"  style="text-align: center;font-weight: bold; font-style: italic;">
              <?php 
              $c_f=$A_f+$B_f;
              echo $c_f;
              ?>

            </th>
            <th class="tg-rmb8"  style="text-align: center;font-weight: bold; font-style: italic;"><?php echo $c+$c_f;?></th>

          </tr>
        </table>  
      <!-- <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 mb-4">
         <div class="sc_box">
            <h6 class="sc_title pt-3 pl-4 font-weight-bold">আমাদের সম্পর্কীয়</h6>
            <div class="row">
               <div class="col-md-4">
                  <div class="title-icon pt-1 px-2 pl-5"><i class="fa fa-home fa-5x">  </i></div>
               </div>

               <div class="col-md-8">
                  <div class="title-icon py-1 pl-2">
                     <ul class="li-img" style=" list-style-image: url('assets/images/bullet_arrow.png');">
                        <li><a href="http://scouts.gov.bd/site/page/6d702831-08b0-4bc7-8b36-45fe72aa88ac" target="_blank" class="card-link">সাধারণ তথ্য</a></li>
                        <li><a href="http://scouts.gov.bd/site/organogram/82e99b95-e7f5-465b-b807-dfe8b612e525" target="_blank" class="card-link">সাংগঠনিক তথ্য</a></li>
                        <li><a href="http://scouts.gov.bd/site/page/3d19bd27-44bd-4945-a06a-980c1933dca2" target="_blank" class="card-link">আইন, প্রতিজ্ঞা ও মটো</a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 mb-4">
         <div class="sc_box">
            <h6 class="sc_title pt-3 pl-4 font-weight-bold">সদর দফতর ও অঞ্চল</h6>
            <div class="row">
               <div class="col-md-4">
                  <div class="title-icon pt-1 px-2 pl-5"><i class="fa fa-globe fa-5x">  </i></div>
               </div>

               <div class="col-md-8">
                  <div class="title-icon py-1 pl-2">
                     <ul class="li-img" style=" list-style-image: url('assets/images/bullet_arrow.png');">
                        <li><a href="<?=base_url('scout-department')?>" class="card-link">বিভাগসমূহ</a></li>
                        <li><a href="<?=base_url('region')?>" class="card-link">অঞ্চলসমূহ</a></li>
                        <li><a href="<?=base_url('national-committee')?>" class="card-link">জাতীয় কমিটি</a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 mb-4">
         <div class="sc_box">
            <h6 class="sc_title pt-3 pl-4 font-weight-bold">স্কাউটিং </h6>
            <div class="row">
               <div class="col-md-4">
                  <div class="title-icon pt-1 px-2 pl-5"><i class="fa fa-universal-access fa-5x">  </i></div>
               </div>

               <div class="col-md-8">
                  <div class="title-icon py-1 pl-2">
                     <ul class="li-img" style=" list-style-image: url('assets/images/bullet_arrow.png');">
                        <li><a href="http://scouts.gov.bd/site/page/82eb9d30-e241-4353-81e0-e8d971263f77/কাব-প্রোগ্রাম" target="_blank" class="card-link">কাব স্কাউট</a></li>
                        <li><a href="http://scouts.gov.bd/site/files/e87ab044-5442-4085-8ba6-3f291bbbf9b1/স্কাউট-প্রোগ্রাম" target="_blank" class="card-link">স্কাউট</a></li>
                        <li><a href="http://scouts.gov.bd/site/files/e87ab044-5442-4085-8ba6-3f291bbbf9b1/nolink/রোভার-প্রোগ্রাম" target="_blank" class="card-link">রোভার স্কাউট</a></li>
                        <li><a href="http://scouts.gov.bd/site/files/e87ab044-5442-4085-8ba6-3f291bbbf9b1/nolink/nolink/বেসিক-কোর্স" target="_blank" class="card-link">বয়ষ্ক নেতা</a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 mb-4">
         <div class="sc_box">
            <h6 class="sc_title pt-3 pl-4 font-weight-bold">সংবাদ ও মিডিয়া</h6>
            <div class="row">
               <div class="col-md-4">
                  <div class="title-icon pt-3  pl-4"><i class="fa fa-newspaper-o fa-5x">  </i></div>
               </div>
               <div class="col-md-8">
                  <div class="title-icon py-1 pl-2">
                     <ul class="li-img" style=" list-style-image: url('assets/images/bullet_arrow.png');">
                     <li><a href="<?=base_url('scout-news')?>" class="card-link">সংবাদ</a></li>
                        <li><a href="<?=base_url('scout-events')?>" class="card-link">ইভেন্ট</a></li>
                        <li><a href="http://scouts.gov.bd/site/page/40835f32-a249-465e-986d-11cebc75d877/অফিস-স্মারক" target="_blank" class="card-link">অফিস-স্মারক</a></li>
                        <li><a href="http://scouts.gov.bd/site/page/2c5195e2-06fc-44ca-91e4-1f4bd9921544/অফিস-আদেশ" target="_blank" class="card-link">অফিস-আদেশ</a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 mb-4">
         <div class="sc_box">
            <h6 class="sc_title pt-3 pl-4 font-weight-bold">ফরম ও সেবাসমূহ</h6>
            <div class="row">
               <div class="col-md-4">
                  <div class="title-icon pt-3 px-2 pl-5"><i class="fa fa-file-text fa-5x">  </i></div>
               </div>

               <div class="col-md-8">
                  <div class="title-icon py-1 pl-2">
                     <ul class="li-img" style=" list-style-image: url('assets/images/bullet_arrow.png');">
                        <li><a href="<?=base_url()?>registration" target="_blank" class="card-link">অনলাইন রেজিস্ট্রেশন</a></li>
                        <li><a href="http://www.forms.gov.bd/site/view/form-office/6652" target="_blank" class="card-link">সকল ফরমসমূহ</a></li>
                        <li><a href="http://scouts.gov.bd/site/news/0686b933-53b9-497f-8211-40931be797f4/জনগনের-দোরগোড়ায়-স্কাউটিং" class="card-link">অফিশিয়াল ইমেইল এড্রেস তালিকা</a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 mb-4">
         <div class="sc_box">
            <h6 class="sc_title pt-3 pl-4 font-weight-bold">প্রকল্পসমূহ</h6>
            <div class="row">
               <div class="col-md-4">
                  <div class="title-icon pt-3 px-2 pl-5"><i class="fa fa-qrcode fa-5x">  </i></div>
               </div>

               <div class="col-md-8">
                  <div class="title-icon py-1 pl-2">
                     <ul class="li-img" style=" list-style-image: url('assets/images/bullet_arrow.png');">
                        <li><a href="http://scouts.gov.bd/site/page/7ea2e218-756b-4d5e-a29c-4b3d98101979/টিটিএল" class="card-link">টিটিএল</a></li>
                        <li><a href="http://scouts.gov.bd/site/page/7ea2e218-756b-4d5e-a29c-4b3d98101979/nolink/ইফসাফ" class="card-link">ইফসাফ</a></li>
                        <li><a href="http://scouts.gov.bd/site/news/0686b933-53b9-497f-8211-40931be797f4/জনগনের-দোরগোড়ায়-স্কাউটিং" class="card-link">জনগনের-দোরগোড়ায়-স্কাউটিং</a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 mb-4">
         <div class="sc_box">
            <h6 class="sc_title pt-3 pl-4 font-weight-bold">গ্যালারি</h6>
            <div class="row">
               <div class="col-md-4">
                  <div class="title-icon pt-3 pb-4  pl-4"><i class="fa fa fa-film fa-5x">  </i></div>
               </div>

               <div class="col-md-8">
                  <div class="title-icon pt-3 pl-2">
                     <ul class="li-img" style=" list-style-image: url('assets/images/bullet_arrow.png');">
                        <li><a href="http://scouts.gov.bd/site/view/photogallery/সকল-আলোকচিত্র" target="_blank" class="card-link">ফটোগ্যালারি</a></li>
                        <li><a href="https://www.youtube.com/channel/UCB5zFbXBQ3AhKhtxSKwi2ow" target="_blank" class="card-link">ভিডিও</a></li>
                        <li><a href="http://scouts.portal.gov.bd/site/view/publications/অগ্রদূত" class="card-link">প্রকাশনা</a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div> 

      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 mb-4">
         <div class="sc_box">
            <h6 class="sc_title pt-3 pl-4 font-weight-bold">অ্যাওয়ার্ড ও ফলাফল</h6>
            <div class="row">
               <div class="col-md-4">
                  <div class="title-icon pt-1 px-2 pl-5"><i class="fa fa-plus-square fa-5x">  </i></div>
               </div>

               <div class="col-md-8">
                  <div class="title-icon py-1 pl-2">
                     <ul class="li-img" style=" list-style-image: url('assets/images/bullet_arrow.png');">
                        <li><a href="http://scouts.portal.gov.bd/site/page/933f4b06-03ce-4d6c-aee0-8d4e318df647/জাতীয়-সদর-দফতর" target="_blank" class="card-link">জাতীয়-সদর-দফতর</a></li>
                        <li><a href="http://scouts.portal.gov.bd/site/page/727195cc-0346-4562-aaff-51e3dc2c52c1/শাপলা-কাব" target="_blank" class="card-link">শাপলা-কাব</a></li>
                        <li><a href="http://scouts.portal.gov.bd/site/page/af2dff2a-56b1-4f62-aabd-9a38307fcef7/প্রেসিডেন্ট’স-স্কাউট" target="_blank" class="card-link">প্রেসিডেন্ট’স-স্কাউট</a></li>
                        <li><a href="http://scouts.portal.gov.bd/site/page/1b49b3db-1743-4fe2-a96c-0c337f743297/প্রেসিডেন্টস-রোভার-স্কাউট" target="_blank" class="card-link">প্রেসিডেন্টস-রোভার-স্কাউট</a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div> -->

   </div>
</div>




