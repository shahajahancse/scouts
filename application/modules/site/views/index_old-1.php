<div class="container w-75">
 <div class="secondary_sc_content">
  <p class="lead font-weight-bold py-2 text-white" style="background-color: #1aa326; padding-left:10px"><?=lang('site_index_text')?></p>

  <div class="container">
    <div class="row">
      <style type="text/css">
        .tg  {border-collapse:collapse;border-spacing:0;border-color:#bbb; width: 100%}
        .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#E0FFEB; text-align: center;}
        .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#9DE0AD;}
        .tg .tg-rmb8{background-color:#C2FFD6;vertical-align:top; text-align: center;}
        .tg .tg-yw4l{vertical-align:middle; text-align: center; font-weight: bold;}
      </style>
      <table class="tg">
        <tr>
          <th class="tg-yw4l" rowspan="2" width="300"><?=lang('site_index_text1')?></th>
          <th class="tg-yw4l"><?=lang('site_index_male')?></th>
          <th class="tg-yw4l"><?=lang('site_index_female')?></th>
          <th class="tg-yw4l"><?=lang('site_index_total')?></th>
        </tr>
        <tr>
        </tr>


        <tr>
          <th class="tg-yw4l"><?=lang('site_index_cub_scout')?></th>
          <th class="tg-rmb8">
            <?php
              if($this->session->userdata('site_lang') == 'english' ){
                echo BanglaConverter::bn2en($count_cub_scout_m);
              }else{
                echo BanglaConverter::en2bn($count_cub_scout_m);
              }
            ?>
          </th>

          <th class="tg-rmb8">
            <?php
              if($this->session->userdata('site_lang') == 'english' ){
                echo BanglaConverter::bn2en($count_cub_scout_f);
              }else{
                echo BanglaConverter::en2bn($count_cub_scout_f);
              }
            ?>  
        </th>
          <th class="tg-rmb8">

            <?php
              if($this->session->userdata('site_lang') == 'english' ){
                echo BanglaConverter::bn2en($count_cub_scout_m+$count_cub_scout_f);
              }else{
                echo BanglaConverter::en2bn($count_cub_scout_m+$count_cub_scout_f);
              }
            ?>
      </th>
        </tr>


        <tr>
          <th class="tg-yw4l"><?=lang('site_index_scout')?></th>
          <th class="tg-rmb8">
              <?php
              if($this->session->userdata('site_lang') == 'english' ){
                echo BanglaConverter::bn2en($count_scout_m);
              }else{
                echo BanglaConverter::en2bn($count_scout_m);
              }
              ?>
        </th>
          <th class="tg-rmb8">
            <?php
              if($this->session->userdata('site_lang') == 'english' ){
                echo BanglaConverter::bn2en($count_scout_f);
              }else{
                echo BanglaConverter::en2bn($count_scout_f);
              }
              ?>
       </th>
          <th class="tg-rmb8">
           <?php
              if($this->session->userdata('site_lang') == 'english' ){
                echo BanglaConverter::bn2en($count_scout_m+$count_scout_f);
              }else{
                echo BanglaConverter::en2bn($count_scout_m+$count_scout_f);
              }
              ?>
         </th>
        </tr>


        <tr>
          <th class="tg-yw4l"><?=lang('site_index_rover_scout')?></th>
          <th class="tg-rmb8">
               <?php
              if($this->session->userdata('site_lang') == 'english' ){
                echo BanglaConverter::bn2en($count_rober_scout_m);
              }else{
                echo BanglaConverter::en2bn($count_rober_scout_m);
              }
              ?>

           </th>
          <th class="tg-rmb8">

            <?php
              if($this->session->userdata('site_lang') == 'english' ){
                echo BanglaConverter::bn2en($count_rober_scout_f);
              }else{
                echo BanglaConverter::en2bn($count_rober_scout_f);
              }
              ?>
</th>
          <th class="tg-rmb8">

            <?php
              if($this->session->userdata('site_lang') == 'english' ){
                echo BanglaConverter::bn2en($count_rober_scout_m+$count_rober_scout_f);
              }else{
                echo BanglaConverter::en2bn($count_rober_scout_m+$count_rober_scout_f);
              }
              ?>

        </tr>


        <tr>
          <th class="tg-yw4l"> <?=lang('site_index_a.total')?> </th>
          <th class="tg-rmb8" style="font-weight: bold;">

          <?php
              if($this->session->userdata('site_lang') == 'english' ){
                echo BanglaConverter::bn2en($count_cub_scout_m+$count_scout_m+$count_rober_scout_m);
              }else{
                echo BanglaConverter::en2bn($count_cub_scout_m+$count_scout_m+$count_rober_scout_m);
              }
              ?>
          </th>
          <th class="tg-rmb8" style="font-weight: bold;">

           <?php
              if($this->session->userdata('site_lang') == 'english' ){
                echo BanglaConverter::bn2en($count_cub_scout_f+$count_scout_f+$count_rober_scout_f);
              }else{
                echo BanglaConverter::en2bn($count_cub_scout_f+$count_scout_f+$count_rober_scout_f);
              }
            ?>
          </th>
          <th class="tg-rmb8" style="font-weight: bold;">

            <?php
              if($this->session->userdata('site_lang') == 'english' ){
                echo BanglaConverter::bn2en($count_cub_scout_m+$count_scout_m+$count_rober_scout_m+$count_cub_scout_f+$count_scout_f+$count_rober_scout_f);
              }else{
                echo BanglaConverter::en2bn($count_cub_scout_m+$count_scout_m+$count_rober_scout_m+$count_cub_scout_f+$count_scout_f+$count_rober_scout_f);
              }
            ?>
          </th>
        </tr>


        <tr>
          <th class="tg-yw4l"><?=lang('site_index_volunteer_leader_&_commissioner')?></th>
          <th class="tg-rmb8">
           <?php
              if($this->session->userdata('site_lang') == 'english' ){
                echo BanglaConverter::bn2en($scouter_s_m);
              }else{
                echo BanglaConverter::en2bn($scouter_s_m);
              }
            ?>
        </th>
          <th class="tg-rmb8">

            <?php
              if($this->session->userdata('site_lang') == 'english' ){
                echo BanglaConverter::bn2en($scouter_s_f);
              }else{
                echo BanglaConverter::en2bn($scouter_s_f);
              }
            ?>
     </th>
          <th class="tg-rmb8">
            <?php
              if($this->session->userdata('site_lang') == 'english' ){
                echo BanglaConverter::bn2en($scouter_s_m+$scouter_s_f);
              }else{
                echo BanglaConverter::en2bn($scouter_s_m+$scouter_s_f);
              }
            ?>
          </th>
        </tr>



        <tr>
          <th class="tg-yw4l"><?=lang('site_index_non_warranted_members')?></th>
          <th class="tg-rmb8">

            <?php
              if($this->session->userdata('site_lang') == 'english' ){
                echo BanglaConverter::bn2en($non_warrant_m);
              }else{
                echo BanglaConverter::en2bn($non_warrant_m);
              }
            ?>
        </th>
          <th class="tg-rmb8">
            <?php
              if($this->session->userdata('site_lang') == 'english' ){
                echo BanglaConverter::bn2en($non_warrant_f);
              }else{
                echo BanglaConverter::en2bn($non_warrant_f);
              }
            ?>
      </th>


          <th class="tg-rmb8">

            <?php
              if($this->session->userdata('site_lang') == 'english' ){
                echo BanglaConverter::bn2en($non_warrant_m+$non_warrant_f);
              }else{
                echo BanglaConverter::en2bn($non_warrant_m+$non_warrant_f);
              }
            ?>
         </th>
        </tr>


        <tr>
          <th class="tg-yw4l"><?=lang('site_index_warranted_members')?></th>
          <th class="tg-rmb8">
            <?php
              if($this->session->userdata('site_lang') == 'english' ){
                echo BanglaConverter::bn2en($warrant_m);
              }else{
                echo BanglaConverter::en2bn($warrant_m);
              }
            ?>
           </th>
          <th class="tg-rmb8">


            <?php
              if($this->session->userdata('site_lang') == 'english' ){
                echo BanglaConverter::bn2en($warrant_f);
              }else{
                echo BanglaConverter::en2bn($warrant_f);
              }
            ?>
              
            </th>
          <th class="tg-rmb8">

              <?php
              if($this->session->userdata('site_lang') == 'english' ){
                echo BanglaConverter::bn2en($warrant_m+$warrant_f);
              }else{
                echo BanglaConverter::en2bn($warrant_m+$warrant_f);
              }
            ?>
              
            </th>
        </tr>
        <tr>
          <th class="tg-yw4l"><?=lang('site_index_professional_executive')?></th>
          <th class="tg-rmb8">
             <?php
              if($this->session->userdata('site_lang') == 'english' ){
                echo BanglaConverter::bn2en($professional_scouts_m);
              }else{
                echo BanglaConverter::en2bn($professional_scouts_m);
              }
            ?>

           </th>
          <th class="tg-rmb8">
            <?php
              if($this->session->userdata('site_lang') == 'english' ){
                echo BanglaConverter::bn2en($professional_scouts_f);
              }else{
                echo BanglaConverter::en2bn($professional_scouts_f);
              }
            ?>
        </th>
          <th class="tg-rmb8">
           <?php
                        if($this->session->userdata('site_lang') == 'english' ){
                          echo BanglaConverter::bn2en($professional_scouts_m+$professional_scouts_f);
                        }else{
                          echo BanglaConverter::en2bn($professional_scouts_m+$professional_scouts_f);
                        }
                      ?>  
      </th>
        </tr>
        <tr>
          <th class="tg-yw4l"><?=lang('site_index_support_staff')?></th>
          <th class="tg-rmb8">
            <?php
              if($this->session->userdata('site_lang') == 'english' ){
                echo BanglaConverter::bn2en($support_staff_m);
              }else{
                echo BanglaConverter::en2bn($support_staff_m);
              }
            ?>
        </th>
          <th class="tg-rmb8">
            <?php
              if($this->session->userdata('site_lang') == 'english' ){
                echo BanglaConverter::bn2en($support_staff_f);
              }else{
                echo BanglaConverter::en2bn($support_staff_f);
              }
            ?>
     </th>
          <th class="tg-rmb8">
             <?php
              if($this->session->userdata('site_lang') == 'english' ){
                echo BanglaConverter::bn2en($support_staff_m+$support_staff_f);
              }else{
                echo BanglaConverter::en2bn($support_staff_m+$support_staff_f);
              }
            ?>
        </th>
        </tr>


        <tr>
          <th class="tg-yw4l"><?=lang('site_index_b.total')?></th>
          <th class="tg-rmb8" style="font-weight: bold;">

            <?php
              if($this->session->userdata('site_lang') == 'english' ){
                echo BanglaConverter::bn2en($non_warrant_m+$scouter_s_m+$professional_scouts_m+$support_staff_m+$warrant_m);
              }else{
                echo BanglaConverter::en2bn($non_warrant_m+$scouter_s_m+$professional_scouts_m+$support_staff_m+$warrant_m);
              }
            ?>

          </th>
          <th class="tg-rmb8" style="font-weight: bold;">
           <?php
              if($this->session->userdata('site_lang') == 'english' ){
                echo BanglaConverter::bn2en($non_warrant_f+$scouter_s_f+$professional_scouts_f+$support_staff_f+$warrant_f);
              }else{
                echo BanglaConverter::en2bn($non_warrant_f+$scouter_s_f+$professional_scouts_f+$support_staff_f+$warrant_f);
              }
            ?>
         </th>
         <th class="tg-rmb8" style="font-weight: bold;">

         <?php
                      if($this->session->userdata('site_lang') == 'english' ){
                        echo BanglaConverter::bn2en($non_warrant_m+$scouter_s_m+$professional_scouts_m+$support_staff_m+$warrant_m+$non_warrant_f+$scouter_s_f+$professional_scouts_f+$support_staff_f+$warrant_f);
                      }else{
                        echo BanglaConverter::en2bn($non_warrant_m+$scouter_s_m+$professional_scouts_m+$support_staff_m+$warrant_m+$non_warrant_f+$scouter_s_f+$professional_scouts_f+$support_staff_f+$warrant_f);
                      }
        ?>
        </th>
      </tr>


      <tr>
        <th class="tg-yw4l"  style="text-align: center;font-weight: bold; font-style: italic;"><?=lang('site_index_grand_total(A+B)')?></th>
        <th class="tg-rmb8"  style="text-align: center;font-weight: bold; font-style: italic;">

          <?php
              if($this->session->userdata('site_lang') == 'english' ){
                echo BanglaConverter::bn2en($count_cub_scout_m+$count_scout_m+$count_rober_scout_m+$non_warrant_m+$scouter_s_m+$professional_scouts_m+$support_staff_m+$warrant_m);
              }else{
                echo BanglaConverter::en2bn($count_cub_scout_m+$count_scout_m+$count_rober_scout_m+$non_warrant_m+$scouter_s_m+$professional_scouts_m+$support_staff_m+$warrant_m);
              }
            ?>
        </th>
        <th class="tg-rmb8"  style="text-align: center;font-weight: bold; font-style: italic;">
         <?php
              if($this->session->userdata('site_lang') == 'english' ){
                echo BanglaConverter::bn2en($count_cub_scout_f+$count_scout_f+$count_rober_scout_f+$non_warrant_f+$scouter_s_f+$professional_scouts_f+$support_staff_f+$warrant_f);
              }else{
                echo BanglaConverter::en2bn($count_cub_scout_f+$count_scout_f+$count_rober_scout_f+$non_warrant_f+$scouter_s_f+$professional_scouts_f+$support_staff_f+$warrant_f);
              }
            ?>

        </th>
        <th class="tg-rmb8"  style="text-align: center;font-weight: bold; font-style: italic;">


          <?php
              if($this->session->userdata('site_lang') == 'english' ){
                echo BanglaConverter::bn2en($count_cub_scout_m+$count_scout_m+$count_rober_scout_m+$count_cub_scout_f+$count_scout_f+$count_rober_scout_f+$non_warrant_m+$scouter_s_m+$professional_scouts_m+$support_staff_m+$warrant_m+$non_warrant_f+$scouter_s_f+$professional_scouts_f+$support_staff_f+$warrant_f);
              }else{
                echo BanglaConverter::en2bn($count_cub_scout_m+$count_scout_m+$count_rober_scout_m+$count_cub_scout_f+$count_scout_f+$count_rober_scout_f+$non_warrant_m+$scouter_s_m+$professional_scouts_m+$support_staff_m+$warrant_m+$non_warrant_f+$scouter_s_f+$professional_scouts_f+$support_staff_f+$warrant_f);
              }
            ?>

      </tr>
    </table>  

  </div><!-- main row -->

</div>
</div>
</div>
