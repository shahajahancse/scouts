<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="page-content">
  <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
  <!-- <div id="portlet-config" class="modal hide">
    <div class="modal-header">
      <button data-dismiss="modal" class="close" type="button"></button>
      <h3>Widget Settings</h3>
    </div>
    <div class="modal-body"> Widget settings form goes here </div>
  </div>   -->
  <div class="clearfix"></div>

  <style>
    .page-content .content {
      padding-left: 15px !important;
      padding-right: 26px;
      padding-top: 75px;
    }
  </style>

  <div class="content">
    <div class="page-title"> </div>
    <div class="row">
      <div class="col-md-6 col-vlg-3 col-sm-6">
        <div class="tiles green added-margin  m-b-20">
          <div class="tiles-body">
            <div class="tiles-title text_white_14">Registration Overview</div>
            <?php /*
            <div class="widget-stats">
              <div class="wrapper transparent">
                <span class="item-title">Total Registration</span> <span class="item-count animate-number" style="font-size: 25px;" data-value="<?=$total_online_register?>" data-animation-duration="700">0</span>
              </div>
            </div>
            <!-- <div class="widget-stats">
              <div class="wrapper transparent">
                <span class="item-title">Today's</span> <span class="item-count animate-number semi-bold" data-value="751" data-animation-duration="700">0</span>
              </div>
            </div>-->
            */ ?>

            <div class="widget-stats">
              <div class="wrapper transparent">
                <span class="item-title">Total Verified</span> <span class="item-count animate-number" style="font-size: 25px;" data-value="<?=$total_online_member?>" data-animation-duration="700">0</span>
              </div>
            </div>
            <div class="widget-stats ">
              <div class="wrapper transparent">
                <span class="item-title">Total Active</span> <span class="item-count animate-number" style="font-size: 25px;" data-value="<?=$total_online_member - $total_archive_member ?>" data-animation-duration="700">0</span>
              </div>
            </div>
            <div class="widget-stats ">
              <div class="wrapper last">
                <span class="item-title">Total Archived</span> <span class="item-count animate-number" style="font-size: 25px;" data-value="<?=$total_archive_member?>" data-animation-duration="700">0</span>
              </div>
            </div>
            <div class="widget-stats ">
              <div class="wrapper last">
                <span class="item-title">Request Pending</span> <span class="item-count animate-number" style="font-size: 25px;" data-value="<?=$total_request_member?>" data-animation-duration="700">0</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-vlg-3 col-sm-6">
        <div class="tiles blue added-margin  m-b-20">
          <div class="tiles-body">
            <div class="tiles-title text_white_14">Total Online Member</div>
            <div class="widget-stats">
              <div class="wrapper transparent">
                <span class="item-title">Total Member</span> <span class="item-count animate-number" style="font-size: 25px;" data-value="<?=$total_online_member?>" data-animation-duration="700">0</span>
              </div>
            </div>
            <div class="widget-stats">
              <div class="wrapper transparent">
                <span class="item-title">Male</span> <span class="item-count animate-number" style="font-size: 25px;" data-value="<?=$total_online_member_male?>" data-animation-duration="700">0</span>
              </div>
            </div>
            <div class="widget-stats ">
              <div class="wrapper transparent">
                <span class="item-title">Female</span> <span class="item-count animate-number" style="font-size: 25px;" data-value="<?=$total_online_member_female?>" data-animation-duration="700">0</span>
              </div>
            </div>

            <div class="widget-stats ">
              <div class="wrapper last">
                <span class="item-title">Others</span> <span class="item-count animate-number" style="font-size: 25px;" data-value="<?=$total_online_member - $total_online_member_male - $total_online_member_female?>" data-animation-duration="700">0</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php /* ?>
      <!-- <div class="col-md-4 col-vlg-3 col-sm-6">
        <div class="tiles red added-margin  m-b-20">
          <div class="tiles-body">
            <div class="controller"> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
            <div class="tiles-title text_white_14">Event Overview </div>
            <div class="widget-stats">
              <div class="wrapper transparent">
                <span class="item-title">Total Event</span> <span class="item-count animate-number" style="font-size: 25px;" data-value="<?=$total_event?>" data-animation-duration="700">0</span>
              </div>
            </div>
            <div class="widget-stats">
              <div class="wrapper transparent">
                <span class="item-title">NHQ</span> <span class="item-count animate-number" style="font-size: 25px;" data-value="<?=$total_event_nhq?>" data-animation-duration="700">0</span>
              </div>
            </div>
            <div class="widget-stats">
              <div class="wrapper transparent">
                <span class="item-title">Region</span> <span class="item-count animate-number" style="font-size: 25px;" data-value="<?=$total_event_region?>" data-animation-duration="700">0</span>
              </div>
            </div>
            <div class="widget-stats">
              <div class="wrapper last">
                <span class="item-title">District</span> <span class="item-count animate-number" style="font-size: 25px;" data-value="<?=$total_event_district?>" data-animation-duration="700">0</span>
              </div>
            </div>
          </div>
        </div>
      </div>  -->
      <?php */ ?>
    </div> <!-- /row -->

    <div class="row">
      <div class="col-md-3">
        <div class="row">
          <div class="col-md-12 col-sm-12 spacing-bottom-sm spacing-bottom">
            <div class="tiles green added-margin">
              <div class="tiles-body">
                <div class="tiles-title" style="font-size: 14px;"> DHAKA REGION </div>
                <span class="item-title">Online Registered Member</span>
                <div class="heading"> <span class="animate-number" data-value="<?=$total_member_region_dhk?>" data-animation-duration="1000">0</span> </div>
                <a class="admin_overview" href="<?=base_url('dashboard/region_overview/1')?>">Details Overview</a>
              </div>
            </div>
          </div>

          <div class="col-md-12 col-sm-12 spacing-bottom-sm spacing-bottom">
            <div class="tiles green added-margin">
              <div class="tiles-body">
                <div class="tiles-title" style="font-size: 14px;"> CHATTOGRAM REGION </div>
                <span class="item-title">Online Registered Member</span>
                <div class="heading"> <span class="animate-number" data-value="<?=$total_member_region_ctg?>" data-animation-duration="1000">0</span> </div>
                <a class="admin_overview" href="<?=base_url('dashboard/region_overview/2')?>">Details Overview</a>
              </div>
            </div>
          </div>

          <div class="col-md-12 col-sm-12 spacing-bottom-sm spacing-bottom">
            <div class="tiles green added-margin">
              <div class="tiles-body">
                <div class="tiles-title" style="font-size: 14px;"> RAJSHAHI REGION</div>
                <span class="item-title">Online Registered Member</span>
                <div class="heading"> <span class="animate-number" data-value="<?=$total_member_region_raj?>" data-animation-duration="1000">0</span> </div>
                <a class="admin_overview" href="<?=base_url('dashboard/region_overview/3')?>">Details Overview</a>
              </div>
            </div>
          </div>

          <div class="col-md-12 col-sm-12 spacing-bottom-sm spacing-bottom">
            <div class="tiles green added-margin">
              <div class="tiles-body">
                <div class="tiles-title" style="font-size: 14px;"> KHULNA REGION </div>
                <span class="item-title">Online Registered Member</span>
                <div class="heading"> <span class="animate-number" data-value="<?=$total_member_region_khl?>" data-animation-duration="1000">0</span> </div>
                <a class="admin_overview" href="<?=base_url('dashboard/region_overview/4')?>">Details Overview</a>
              </div>
            </div>
          </div>

          <div class="col-md-12 col-sm-12 spacing-bottom-sm spacing-bottom">
            <div class="tiles green added-margin">
              <div class="tiles-body">
                <div class="tiles-title" style="font-size: 14px;"> BARISHAL REGION </div>
                <span class="item-title">Online Registered Member</span>
                <div class="heading"> <span class="animate-number" data-value="<?=$total_member_region_bar?>" data-animation-duration="1000">0</span> </div>
                <a class="admin_overview" href="<?=base_url('dashboard/region_overview/5')?>">Details Overview</a>
              </div>
            </div>
          </div>

          <div class="col-md-12 col-sm-12 spacing-bottom-sm spacing-bottom">
            <div class="tiles green added-margin">
              <div class="tiles-body">
                <div class="tiles-title" style="font-size: 14px;"> SYLHET REGION </div>
                <span class="item-title">Online Registered Member</span>
                <div class="heading"> <span class="animate-number" data-value="<?=$total_member_region_syl?>" data-animation-duration="1000">0</span> </div>
                <a class="admin_overview" href="<?=base_url('dashboard/region_overview/6')?>">Details Overview</a>
              </div>
            </div>
          </div>

          <div class="col-md-12 col-sm-12 spacing-bottom-sm spacing-bottom">
            <div class="tiles green added-margin">
              <div class="tiles-body">
                <div class="tiles-title" style="font-size: 14px;"> CUMILLA REGION </div>
                <span class="item-title">Online Registered Member</span>
                <div class="heading"> <span class="animate-number" data-value="<?=$total_member_region_cum?>" data-animation-duration="1000">0</span> </div>
                <a class="admin_overview" href="<?=base_url('dashboard/region_overview/7')?>">Details Overview</a>
              </div>
            </div>
          </div>

          <div class="col-md-12 col-sm-12 spacing-bottom-sm spacing-bottom">
            <div class="tiles green added-margin">
              <div class="tiles-body">
                <div class="tiles-title" style="font-size: 14px;"> DINAJPUR REGION </div>
                <span class="item-title">Online Registered Member</span>
                <div class="heading"> <span class="animate-number" data-value="<?=$total_member_region_din?>" data-animation-duration="1000">0</span> </div>
                <a class="admin_overview" href="<?=base_url('dashboard/region_overview/8')?>">Details Overview</a>
              </div>
            </div>
          </div>

          <div class="col-md-12 col-sm-12 spacing-bottom-sm spacing-bottom">
            <div class="tiles green added-margin">
              <div class="tiles-body">
                <div class="tiles-title" style="font-size: 14px;"> MAYMENSINGH REGION </div>
                <span class="item-title">Online Registered Member</span>
                <div class="heading"> <span class="animate-number" data-value="<?=$total_member_region_may?>" data-animation-duration="1000">0</span> </div>
                <a class="admin_overview" href="<?=base_url('dashboard/region_overview/9')?>">Details Overview</a>
              </div>
            </div>
          </div>

        </div>
      </div> <!-- /col-md-3 -->

      <div class="col-md-9">
        <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
        <script>
          zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
          ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
        </script>
        <style>
          .zc-ref {
            display: none;
          }
          #myChart-wrapper {
            margin: auto;
          }
        </style>
        <div id='myChart'><a class="zc-ref" href="https://www.zingchart.com/">Charts by ZingChart</a></div>
        <script>
          var mySeries = [{
            values: [<?=$new_applicant_percent?>],
            text: 'New Applicant'
          }, {
            values: [<?=$scout_percent?>],
            text: 'Scout'
          }, {
            values: [<?=$adult_leader_percent?>],
            text: 'Adult Leader (Scouter)'
          }, {
            values: [<?=$professional_percent?>],
            text: 'Professional Executive'
          }, {
            values: [<?=$warrent_percent?>],
            text: 'Warrent Member'
          }, {
            values: [<?=$non_warren_percent?>],
            text: 'Non-Warrant Member'
          }, {
            values: [<?=$support_staff_percent?>],
            text: 'Support Staff'
          }

          ];

          var myConfig = {
            type: "pie",
            globals: {
              fontFamily: 'sans-serif'
            },
            legend: {
              verticalAlign: 'middle',
              toggleAction: 'remove',
              marginRight: 60,
              width: 100,
              alpha: 0.1,
              borderWidth: 0,
              highlightPlot: true,
              item: {
                fontColor: "#373a3c",
                fontSize: 12
              }
            },
            backgroundColor: "#fff",
            palette: ["#0099CC", "#007E33", "#FF8800", "#CC0000", "#33b5e5", "#00C851", "#ffbb33"],
            plot: {
              refAngle: 270,
              detach: false,
              valueBox: {
                fontColor: "#fff"
              },
              highlightState: {
                borderWidth: 2,
                borderColor: "#000"
              }
            },
            tooltip: {
              placement: 'node:out',
              borderColor: "#373a3c",
              borderWidth: 2
            },
            labels: [{
              text: "Online Scout Member Statistics",
              fontSize: 16,
              textAlign: "center",
              fontColor: "#373a3c"

            }],
            series: mySeries

          };

          zingchart.render({
            id: 'myChart',
            data: myConfig,
            height: 500,
            width: 725
          });


          zingchart.node_click = function(p) {

            var SHIFT_ACTIVE = p.ev.shiftKey;
            var sliceData = mySeries[p.plotindex];
            isOpen = (sliceData.hasOwnProperty('offset-r')) ? (sliceData['offset-r'] !== 0) : false;
            if (isOpen) {
              sliceData['offset-r'] = 0;
            } else {
              if (!SHIFT_ACTIVE) {
                for (var i = 0; i < mySeries.length; i++) {
                  mySeries[i]['offset-r'] = 0;
                }
              }
              sliceData['offset-r'] = 20;
            }

            zingchart.exec('myChart', 'setdata', {
              data: myConfig
            });
          }
        </script>

        <div class="col-md-12">
          <h2 style="text-align: center; font-weight: bold; ">Online Member Statistics</h2>
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
                <?php echo $A = $count_cub_scout_m + $count_scout_m + $count_rober_scout_m;?>
              </th>
              <th class="tg-rmb8" style="font-weight: bold;">
                <?php echo $A_f = $count_cub_scout_f + $count_scout_f + $count_rober_scout_f;?>
              </th>
              <th class="tg-rmb8" style="font-weight: bold;">
                <?php echo $A + $A_f;?>
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
                <?php echo $B = $scouter_s_m + $non_warrant_m + $warrant_m + $professional_scouts_m + $support_staff_m;?>
              </th>
              <th class="tg-rmb8" style="font-weight: bold;">
               <?php echo $B_f = $scouter_s_f + $non_warrant_f + $warrant_f + $professional_scouts_f + $support_staff_f;?>
              </th>
              <th class="tg-rmb8" style="font-weight: bold;">
                <?php echo $B + $B_f;?>
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
                <?php echo $c + $c_f; ?></th>
            </tr>
          </table>


          <div class="row" style="margin-top: 10px;">
            <div class="col-md-6 col-sm-6 spacing-bottom-sm spacing-bottom">
              <div class="tiles blue added-margin">
                <div class="tiles-body">
                  <div class="tiles-title" style="font-size: 14px;"> ROVER REGION </div>
                  <span class="item-title">Online Registered Member</span>
                  <div class="heading"> <span class="animate-number" data-value="<?=$total_member_region_rov?>" data-animation-duration="1200">0</span></div>
                  <a class="admin_overview" href="<?=base_url('dashboard/region_overview/10')?>">Details Overview</a>
                </div>
              </div>
            </div>

            <div class="col-md-6 col-sm-6 spacing-bottom-sm spacing-bottom">
              <div class="tiles blue added-margin">
                <div class="tiles-body">
                  <div class="tiles-title" style="font-size: 14px;"> AIR REGION </div>
                  <span class="item-title">Online Registered Member</span>
                  <div class="heading"> <span class="animate-number" data-value="<?=$total_member_region_air?>" data-animation-duration="1200">0</span> </div>
                  <a class="admin_overview" href="<?=base_url('dashboard/region_overview/13')?>">Details Overview</a>
                </div>
              </div>
            </div>

            <div class="col-md-6 col-sm-6 spacing-bottom-sm spacing-bottom">
              <div class="tiles blue added-margin">
                <div class="tiles-body">
                  <div class="tiles-title" style="font-size: 14px;"> NAVY REGION </div>
                  <span class="item-title">Online Registered Member</span>
                  <div class="heading"> <span class="animate-number" data-value="<?=$total_member_region_nav?>" data-animation-duration="1200">0</span> </div>
                  <a class="admin_overview" href="<?=base_url('dashboard/region_overview/12')?>">Details Overview</a>
                </div>
              </div>
            </div>

            <div class="col-md-6 col-sm-6 spacing-bottom-sm spacing-bottom">
              <div class="tiles blue added-margin">
                <div class="tiles-body">
                  <div class="tiles-title" style="font-size: 14px;"> RAILWAY REGION </div>
                  <span class="item-title">Online Registered Member</span>
                  <div class="heading"> <span class="animate-number" data-value="<?=$total_member_region_ral?>" data-animation-duration="1200">0</span> </div>
                  <a class="admin_overview" href="<?=base_url('dashboard/region_overview/11')?>">Details Overview</a>
                </div>
              </div>
            </div>

          </div>
        </div> <!-- /col-md-3 -->

      </div>
    </div>

  </div>
</div>
