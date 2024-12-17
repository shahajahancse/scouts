<div class="page-content">
  <div class="clearfix"></div>
  <div class="content">
    <div class="page-title"> </div>
    <div class="row">
      <div class="col-md-6 col-vlg-3 col-sm-6">
        <div class="tiles green added-margin  m-b-20">
          <div class="tiles-body">
            <div class="controller"> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a>  </div>
            <div class="tiles-title text_white_14">Region Registration Overview</div>
            <div class="widget-stats">
              <div class="wrapper transparent">
                <span class="item-title">Total Verified</span> <span class="item-count animate-number" style="font-size: 25px;" data-value="<?=$total_online->verify ?>" data-animation-duration="700">0</span>
              </div>
            </div>
            <div class="widget-stats ">
              <div class="wrapper transparent">
                <span class="item-title">Total Active</span> <span class="item-count animate-number" style="font-size: 25px;" data-value="<?=$total_online->verify - $total_online->archive ?>" data-animation-duration="700">0</span>
              </div>
            </div>
            <div class="widget-stats ">
              <div class="wrapper last">
                <span class="item-title">Total Archived</span> <span class="item-count animate-number" style="font-size: 25px;" data-value="<?=$total_online->archive?>" data-animation-duration="700">0</span>
              </div>
            </div>
            <div class="widget-stats ">
              <div class="wrapper last">
                <span class="item-title">Request Pending</span> <span class="item-count animate-number" style="font-size: 25px;" data-value="<?=$total_online->request?>" data-animation-duration="700">0</span>
              </div>
            </div>
            <!-- <div class="widget-stats ">
              <div class="wrapper last">
                <span class="item-title">Total Archive</span> <span class="item-count animate-number" style="font-size: 25px;" data-value="<?=$total_online->archive?>" data-animation-duration="700">0</span>
              </div>
            </div> -->
          </div>
        </div>
      </div>

      <div class="col-md-6 col-vlg-3 col-sm-6">
        <div class="tiles red added-margin  m-b-20">
          <div class="tiles-body">
            <div class="controller"> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
            <div class="tiles-title text_white_14"><?=$info->region_name_en?></div>
            <div class="widget-stats">
              <div class="wrapper transparent">
                <span class="item-title">Total Scout District</span> <span class="item-count animate-number" style="font-size: 25px;" data-value="<?=$total_district?>" data-animation-duration="700">0</span>
              </div>
            </div>
            <div class="widget-stats">
              <div class="wrapper transparent">
                <span class="item-title">Total Scout Upazila</span> <span class="item-count animate-number" style="font-size: 25px;" data-value="<?=$total_upazila?>" data-animation-duration="700">0</span>
              </div>
            </div>
            <div class="widget-stats">
              <div class="wrapper last">
                <span class="item-title">Total Scout Group</span> <span class="item-count animate-number" style="font-size: 25px;" data-value="<?=$total_group?>" data-animation-duration="700">0</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- /row -->


    <div class="row">
      <div class="col-md-4">
        <style type="text/css">
          .tg2  {border-collapse:collapse;border-spacing:0; width: 100%}
          .tg2 td{font-family:Arial, sans-serif;font-size:14px;padding:4px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
          .tg2 th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:4px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;font-weight: bold;}
          .tg2 .tg-wxkd{background-color:#9698ed;color:#000000;border-color:#6665cd;text-align:center}
          .tg2 .tg-idlo{font-weight:bold;font-size:14px;background-color:#cbcefb;color:#000000;border-color:#9698ed;text-align:right}
          .tg2 .tg-m7qj{font-weight:bold;font-size:14px;background-color:#cbcefb;color:#000000;border-color:#9698ed;text-align:left}
        </style>
        <h3 style="text-align: center; font-weight: bold; "> District Statistics</h3>
        <table class="tg2">
          <tr>
            <th class="tg-wxkd">District Name</th>
            <th class="tg-wxkd" style="text-align: right;">Scout Group</th>
            <th class="tg-wxkd" style="text-align: right;">Member</th>
          </tr>
          <?php foreach ($officelist as $row) {
            $totalSCgroup = $this->Dashboard_model->get_count_scouts_group_office_id('', $row->id);
			      $totalmember = $this->Dashboard_model->get_count_scouts_member_by_office_id('', $row->id);

            if($row->dis_name_en != NULL){
              $exp = explode(',', $row->dis_name_en);
              $office_name = $exp[1];
            }else{
              $office_name = '';
            }
            $tSCgroup = $totalSCgroup['count'];
            $tMember = $totalmember['count'];
            ?>
            <tr>
              <td class="tg-idlo"><?=$office_name?></td>
              <td class="tg-m7qj" style="text-align: right;"><?=$tSCgroup?></td>
              <td class="tg-m7qj" style="text-align: right;"><?=$tMember?></td>
            </tr>
          <?php } ?>
        </table>
      </div>

      <div class="col-md-8">
        <?php $exp_office = explode(',', $info->region_name_en);?>
        <h3 style="text-align: center; font-weight: bold; "> <?=$exp_office[1]?> (Online Member Statistics)</h3>
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
              <?php echo $A=$count_cub_scout_m+$count_scout_m+$count_rober_scout_m;?>
            </th>
            <th class="tg-rmb8" style="font-weight: bold;">
              <?php echo $A_f=$count_cub_scout_f+$count_scout_f+$count_rober_scout_f;?>
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
              <?php echo $B=$non_warrant_m+$scouter_s_m+$professional_scouts_m+$support_staff_m+$warrant_m;?>
            </th>
            <th class="tg-rmb8" style="font-weight: bold;">
              <?php echo $B_f=$non_warrant_f+$scouter_s_f+$professional_scouts_f+$support_staff_f+$warrant_f;?>
            </th>
            <th class="tg-rmb8" style="font-weight: bold;">
            <?php echo $B+$B_f;?>
            </th>
          </tr>
          <tr>
            <?php
              $na_male_total = $count_na_cub_scout_m+$count_na_scout_m+$count_na_rober_scout_m;
              $na_female_total = $count_na_cub_scout_f+$count_na_scout_f+$count_na_rober_scout_f;
              $na_grand_total = $na_male_total + $na_female_total;
            ?>
            <th class="tg-yw4l">New Applicant</th>
            <th class="tg-rmb8"><?php echo $na_male_total?></th>
            <th class="tg-rmb8"><?php echo $na_female_total?></th>
            <th class="tg-rmb8"><?php echo $na_grand_total;?></th>
          </tr>
          <tr>
            <th class="tg-yw4l" style="text-align: center;font-weight: bold; font-style: italic;">Grand Total(A+B)</th>
            <th class="tg-rmb8" style="text-align: center;font-weight: bold; font-style: italic;">
              <?php echo $c = $A + $B + $na_male_total;?>
            </th>
            <th class="tg-rmb8" style="text-align: center;font-weight: bold; font-style: italic;">
              <?php echo $c_f = $A_f + $B_f + $na_female_total;?>
            </th>
            <th class="tg-rmb8" style="text-align: center;font-weight: bold; font-style: italic;">
              <?php echo $c + $c_f;?></th>
          </tr>
        </table>
      </div> <!-- /col-md-12 -->
    </div>
  </div>
</div>
