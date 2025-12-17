<?php
  header("Content-Type: application/vnd.ms-excel");
  header("Content-Disposition: attachment; filename=trainig_applicant_list.xls");
  echo '<table border="0" cellpadding="5" cellspacing="0">';
?>

  <div class="row-fluid">
    <div class="span12">
      <div class="grid simple ">
        <div class="grid-title">
          <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
        </div>

          <div class="row">
            <div class="col-md-12">
              <!-- <div class="scout-verify-box"> -->
                <table class="tg" border="1">
                  <tr>
                    <th class="tg-2v33">Training Title:</th>
                    <th class="tg-jz97"><?=$results['info']->training_title?></th>
                    <th class="tg-wwkm">Training Date:</th>
                    <th class="tg-6p4y">From <strong><?=date_detail_format($results['info']->start_date)?></strong> to <strong><?=date_detail_format($results['info']->end_date)?></strong></th>
                  </tr>
                  <tr>
                    <td class="tg-2v33">Training Course:</td>
                    <td class="tg-jz97"><?=$results['info']->course_id == 100 ? $results['info']->other_course_name : $results['info']->course_name?></td>
                    <td class="tg-wwkm">Registration Period:</td>
                    <td class="tg-6p4y">From <strong><?=date_detail_format($results['info']->reg_start)?></strong> to <strong><?=date_detail_format($results['info']->reg_end)?></strong></td>
                  </tr>
                  <tr>
                    <td class="tg-2v33">Place:</td>
                    <td class="tg-jz97">
                    <?=$results['info']->place?>
                    <?php
                      //echo $results['info']->event_organizer;
                      // if($results['info']->event_level == 'nhq'){
                      //   echo 'National Headquarter';
                      // }elseif($results['info']->event_level == 'region'){
                      //   echo $results['info']->region_name;
                      // }elseif($results['info']->event_level == 'district'){
                      //   echo $results['info']->dis_name;
                      // }
                      ?>
                    </td>
                    <td class="tg-wwkm">Created:</td>
                    <td class="tg-6p4y"><?=date('d F, Y h:i A', strtotime($results['info']->created))?></td>
                  </tr>
                </table>
              <!-- </div> -->
            </div>
          </div>

          <br><br>

          <?php if($results['member_list']) {  //print_r($results);?>
            <table class="table table-hover table-condensed" border="1">
              <thead>
                <tr>
                  <th style="width:2%"> SL </th>
                  <!-- <th style="width:5%">Image</th> -->
                  <th style="width:10%">Scout ID</th>
                  <th style="width:20%">Full Name</th>
                  <th style="width:15%">Member Type</th>
                  <!-- <th style="width:10%" class="text-center">Details</th> -->
                </tr>
              </thead>
              <tbody>
                <?php
                  $sl = 0;
                  foreach ($results['member_list'] as $row):
                    $sl++;
                    $path = base_url().'profile_img/';
                    if($row->profile_img != NULL){
                      $img_url = '<img src="'.$path.$row->profile_img.'" height="20">';
                    }else{
                      $img_url = '<img src="'.$path.'no-img.png" height="20">';
                  }
                ?>
                <tr>
                  <td class="v-align-middle"><?=$sl?></td>
                  <!-- <td class="v-align-middle"><?=$img_url?></td> -->
                  <td class="v-align-middle"><?=$row->scout_id?></td>
                  <td class="v-align-middle"><?=$row->first_name;?></td>
                  <td class="v-align-middle"><?=$row->member_type_name?></td>
                  <!-- <td><a target="_blank" href="<?=base_url("scouts_member/details/".encrypt_url($row->user_id))?>"  class="btn btn-primary btn-mini">Details</a></td> -->
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          <?php }else{ ?>
        <div class="alert alert-block alert-error fade in">
          <h4 class="alert-heading"><i class="icon-warning-sign"></i>No data found!</h4>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
