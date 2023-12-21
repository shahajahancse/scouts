<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url('scouts_member')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>
   <style type="text/css">
      .tg  {border-collapse:collapse;border-spacing:0;}
      .tg td{font-family:Arial, sans-serif;font-size:14px;padding:3px 10px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border:0 solid #ccc;}
      .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:3px 10px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border:0 solid #ccc; font-weight: bold; vertical-align: top}
      .tg .tg-9vst{background-color:#efefef;text-align:right;}
    </style>
    <div class="row">
       <div class="col-md-12">
          <div class="grid simple horizontal red">
             <div class="grid-title">
              <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
              <div class="pull-right">
                <a href="javascript:void();" class="btn btn-default btn-xs btn-mini" data-toggle="modal" data-target="#myModal"> প্রসিডেন্ট'স রোভার স্কাউট অ্যাওয়ার্ড সুপারিশ ফরম প্রদানের নিয়মাবলী</a>  
              </div>
             </div>
             <div class="grid-body">
              <!-- <form id="form_traditional_validation" action="#"> -->
              <!-- <div id="infoMessage"><?php //echo $message;?></div> -->
              <div><?php //echo validation_errors(); ?></div>
              <?php if($this->session->flashdata('success')):?>
                  <div class="alert alert-success">                      
                      <?php echo $this->session->flashdata('success');;?>
                  </div>
              <?php endif; ?>
              
          <?php 
          $attributes = array('id' => '');
          echo form_open("award_application/president_rover_form", $attributes);?>

              <div class="row">
                <div class="col-md-5">
                  <!-- <h4 style="font-weight: bold;">Current Scout Information</h4> -->
                  <div class="scout-verify-box">
                    <h4 style="font-weight: bold; border-bottom: 1px solid #ccc;"> Scout Information</h4>
                    <table class="tg">
                      <tr>
                        <th class="tg-9vst" width="180" style="font-size: 20px;">BS ID</th>
                        <td class="tg-031e" style="font-size: 20px;"><strong><?=$info->scout_id?></strong></td>
                      </tr>
                      <tr>
                        <th class="tg-9vst">Scout Join Date:</th>
                        <td class="tg-031e"><?=date_detail_format($info->join_date)?></td>
                      </tr>
                      <tr>
                        <th class="tg-9vst">Section:</th>
                        <td class="tg-031e"><span class="label label-inverse"><?php echo get_scout_section($info->sc_section_id);?></span></td>
                      </tr>
                      <tr>
                        <th class="tg-9vst">Scout Badge:</th>
                        <td class="tg-031e"><?=$info->badge_type_name_bn?></td>
                      </tr>
                      <tr>
                        <th class="tg-9vst">Scout Role:</th>
                        <td class="tg-031e"><?=$info->role_type_name_bn?></td>
                      </tr>
                      <tr>
                        <th class="tg-9vst">Scout Unit:</th>
                        <td class="tg-031e"><?=$info->unit_name?></td>
                      </tr>
                      <tr>
                        <th class="tg-9vst">Scout Group:</th>
                        <td class="tg-031e"><?=$info->grp_name?></td>
                      </tr>
                      <tr>
                        <th class="tg-9vst">S. Upazila/Thana:</th>
                        <td class="tg-031e"><?=$info->upa_name?></td>
                      </tr>
                      <tr>
                        <th class="tg-9vst">S. District:</th>
                        <td class="tg-031e"><?=$info->dis_name?></td>
                      </tr>
                      <tr>
                        <th class="tg-9vst">Scout Region:</th>
                        <td class="tg-031e"><?=$info->region_name?></td>
                      </tr>
                    </table>
                  </div>
                </div>

                <div class="col-md-7">
                  <?php
                    $flag_can_apply = true;
                    if($info->grp_name == '' || $info->upa_name == '' || $info->dis_name == '' || $info->region_name == '')
                    {
                      $flag_can_apply = false;
                  ?>
                      <div class="alert alert-block alert-error fade in">
                        <h4 class="alert-heading"><i class="icon-warning-sign"></i> Warning!</h4>
                        <p>Scout Group, Upazila, District and Region are required to apply for migration.</p>
                      </div>
                  <?php
                    }
                  ?>
                  <h4 style="font-weight: bold;">দক্ষতা ব্যাজ ভিত্তিক যোগ্যতা অর্জনের বিবরণ</h4>
                  <table class="table table-bordered">
                       <tr class="bg-success">
                          <th>ক্রম</th>
                          <th>ব্যাজ</th>
                          <th>বিবরণ</th>
                          <th>অর্জনের তারিখ</th>
                          <th>মূল্যায়নকারী</th>
                          <th>যাচাইকারী</th>
                       </tr>
                       <?php for($i=0;$i<sizeof($badge_details);$i++){ ?>
                    
                        <tr>
                          <td><?=$i+1?></td>
                          <td><?=$badge_details[$i]->badge_type_name_bn; ?></td>
                          <td><?=$badge_details[$i]->questions; ?></td>
                          <td><?=date_bangla_format($badge_details[$i]->achive_date); ?></td>
                          <td><?=$badge_details[$i]->examiner_id; ?></td>
                          <td><?=$badge_details[$i]->scout_id; ?></td>
                          
                        </tr>
                        <?php } ?>  
                  </table>

                  <h5><span class="semi-bold">দক্ষতা ও পারদশির্তা ব্যাজ অর্জনের বিবরণ</span></h5>
                  <table class="table table-bordered">
                       <tr class="bg-success">
                          <th>ক্রম</th>
                          <th>ব্যাজ</th>
                          <th>গ্রউপ</th>
                          <th>অর্জনের তারিখ</th>
                          <th>অতিরিক্ত ব্যাজ </th>
                          <th>মূল্যায়নকারী</th>
                          <th>যাচাইকারী</th>
                       </tr>
                       <?php for($i=0;$i<sizeof($expertness);$i++){ ?>
                    
                        <tr>
                          <td><?=$i+1?></td>
                          <td><?=$expertness[$i]->badge_type_name_bn; ?></td>
                          <td><?=$expertness[$i]->expert_group_name; ?></td>
                          <td><?=date_bangla_format($expertness[$i]->achive_date); ?></td>
                          <td><?=$expertness[$i]->extra_badge; ?></td>
                          <td><?=$expertness[$i]->examiner_id; ?></td>
                          <td><?=$expertness[$i]->scout_id; ?></td>
                          
                        </tr>
                        <?php } ?>  
                  </table>

                  <h5><span class="semi-bold">দক্ষতা ও পারদশির্তা ব্যাজ অর্জনের বিবরণ</span></h5>
                  <table class="table table-bordered">
                       <tr class="bg-success">
                          <th>ক্রম</th>
                          <th>ব্যাজ</th>
                          <th>গ্রহণের তারিখ</th>
                          <th>মূল্যায়নকারী</th>
                          <th>যাচাইকারী</th>
                       </tr>
                       <?php for($i=0;$i<sizeof($achievement);$i++){ ?>
                    
                        <tr>
                          <td><?=$i+1?></td>
                          <td><?=$achievement[$i]->badge_type_name_bn; ?></td>
                          <td><?=date_bangla_format($achievement[$i]->achive_date); ?></td>
                          <td><?=$achievement[$i]->examiner_id; ?></td>
                          <td><?=$achievement[$i]->scout_id; ?></td>
                          
                        </tr>
                        <?php } ?>  
                  </table>
              </div>
            </div>
            <?php if($info->sc_section_id == 1 && ($info->sc_cub == 'Yes')){ ?>
                <input type="hidden" name="award_id" value="1">
            <?php } ?>
            <?php if($info->sc_section_id == 2 && ($info->sc_scout == 'Yes')){ ?>
                <input type="hidden" name="award_id" value="2">
            <?php } ?>
            <?php if($info->sc_section_id == 3 && ($info->sc_rover == 'Yes')){ ?>
                <input type="hidden" name="award_id" value="3">
            <?php } ?>

            <?php if($flag_can_apply) { ?>
            <div class="form-actions">  
              <div class="pull-right">
                <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i>
                  <?php if($info->sc_section_id == 1 && ($info->sc_cub == 'Yes')){ ?>
                    শাপলা কাব অ্যাওয়ার্ড সুপারিশ
                  <?php } ?>
                  <?php if($info->sc_section_id == 2 && ($info->sc_scout == 'Yes')){ ?>
                    প্রসিডেন্ট'স স্কাউট অ্যাওয়ার্ড সুপারিশ
                  <?php } ?>
                  <?php if($info->sc_section_id == 3 && ($info->sc_rover == 'Yes')){ ?>
                    প্রসিডেন্ট'স রোভার স্কাউট অ্যাওয়ার্ড সুপারিশ
                  <?php } ?>

                </button>
                <!-- <button type="button" class="btn btn-white btn-cons">Cancel</button> -->
              </div>
            </div>
            <?php } ?>
            <?php echo form_close();?>

          </div>  <!-- END GRID BODY -->              
        </div> <!-- END GRID -->
      </div>

    </div> <!-- END ROW -->

  </div>
</div>




<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <br>
        <i class="icon-credit-card icon-7x"></i>
        <h4 id="myModalLabel" class="semi-bold">প্রসিডেন্ট'স রোভার স্কাউট অ্যাওয়ার্ড সুপারিশ ফরম পূরণ, মূল্যায়ন ও ফলাফল প্রদানের নিয়মাবলী</h4>
        <p class="no-margin">
          প্রসিডেন্ট'স রোভার স্কাউট অ্যাওয়ার্ড সুপারিশ ফরম পূরণ, মূল্যায়ন ও ফলাফল প্রদানের নিয়মাবলী      
        </p>
        <br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->