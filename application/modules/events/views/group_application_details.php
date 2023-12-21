<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url('dashboard')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <style type="text/css">
      .tg  {border-collapse:collapse;border-spacing:0; width: 100%; color: #443f3f;}
      .tg td{font-family:Arial, sans-serif;font-size:14px;padding:7px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
      .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:7px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
      .tg .tg-1ydw{border-color:#efefef;text-align:left}
      .tg .tg-wwkm{font-weight:bold;background-color:#d8e8d8;border-color:#efefef;text-align:right;vertical-align:top}
      .tg .tg-6p4y{border-color:#efefef;text-align:left;vertical-align:top; color: black;}
      .tg .tg-2v33{font-weight:bold;background-color:#d8e8d8;border-color:#efefef;text-align:right;}
      .tg .tg-jz97{border-color:#efefef;text-align:left;color: black;}
    </style>
    
    <div class="row-fluid">
      <div class="span12">
        <div class="grid simple ">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
          </div>

          <div class="grid-body ">
            <div id="infoMessage"><?php //echo $message;?></div>            
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');?>
              </div>
            <?php endif; ?>

            <div class="tiles white details">
              <div class="row">
                <div class="col-md-12">
                  <table width="100%">
                    <tr>
                      <td width="50%" valign="top">
                        <style type="text/css">
                          .tg  {border-collapse:collapse;border-spacing:0;}
                          .tg td{font-family:Arial, sans-serif;font-size:14px;padding:4px 3px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
                          .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:4px 3px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
                          .tg .tg-107g{border-color:#9b9b9b;text-align:left}
                          .tg .tg-2fdn{border-color:#9b9b9b;text-align:left;vertical-align:top}
                          .tg .tg-ufl7{font-weight:bold;border-color:#9b9b9b;text-align:right;vertical-align:top}
                          .tg .tg-u8ck{font-weight:bold;border-color:#9b9b9b;text-align:right; width: 100px; background-color: #ccc;}
                          </style>
                          <?php 
                          $path = base_url().'profile_img/';
                          $img_url = '<img src="'.$path.'no-img.png" height="20">';                          
                          ?>

                          <table class="tg">
                            <tr>
                              <th class="tg-u8ck">Unit</th>
                              <th class="tg-107g" colspan="2"><?=$info->unit_name?></th>
                            </tr>
                            <tr>
                            <?php 
                            $leaderInfo = $this->Event_model->get_scout_sort_info($info->leader_id); 
                            $leader_img = $leaderInfo->profile_img != NULL ? '<img src="'.$path.$leaderInfo->profile_img.'" height="20">': $img_url;
                            $leader_scout = $leaderInfo->scout_id;
                            $leader_name = $leaderInfo->first_name;
                            ?>
                              <td class="tg-u8ck">Adult Leader</td>
                              <td class="tg-107g"><?=$leader_img?></td>
                              <td class="tg-107g"><?=$leader_scout?><br><?=$leader_name?></td>
                            </tr>
                            
                            <?php 
                            $P1 = $this->Event_model->get_scout_sort_info($info->p1); 
                            $P1_img = $P1->profile_img != NULL ? '<img src="'.$path.$P1->profile_img.'" height="20">': $img_url;
                            $P1_scout = $P1->scout_id;
                            $P1_name = $P1->first_name;
                            ?>
                            <tr>
                              <td class="tg-u8ck">P1</td>
                              <td class="tg-2fdn"><?=$P1_img?></td>
                              <td class="tg-2fdn"><?=$P1_scout?><br><?=$P1_name?></td>
                            </tr>

                            <?php
                            $P2 = $this->Event_model->get_scout_sort_info($info->p2); 
                            $P2_img = $P2->profile_img != NULL ? '<img src="'.$path.$P2->profile_img.'" height="20">': $img_url;
                            $P2_scout = $P2->scout_id;
                            $P2_name = $P2->first_name;
                            ?>
                            <tr>
                              <td class="tg-u8ck">P2</td>
                              <td class="tg-2fdn"><?=$P2_img?></td>
                              <td class="tg-2fdn"><?=$P2_scout?><br><?=$P2_name?></td>
                            </tr>


                            <?php
                            $P3 = $this->Event_model->get_scout_sort_info($info->p3); 
                            $P3_img = $P3->profile_img != NULL ? '<img src="'.$path.$P3->profile_img.'" height="20">': $img_url;
                            $P2_scout = $P3->scout_id;
                            $P2_name = $P3->first_name;
                            ?>
                            <tr>
                              <td class="tg-u8ck">P3</td>
                              <td class="tg-2fdn"><?=$P3_img?></td>
                              <td class="tg-2fdn"><?=$P3_scout?><br><?=$P3_name?></td>
                            </tr>


                            <?php
                            $P4 = $this->Event_model->get_scout_sort_info($info->p4); 
                            $P4_img = $P4->profile_img != NULL ? '<img src="'.$path.$P4->profile_img.'" height="20">': $img_url;
                            $P4_scout = $P4->scout_id;
                            $P4_name = $P4->first_name;
                            ?>
                            <tr>
                              <td class="tg-u8ck">P4</td>
                              <td class="tg-2fdn"><?=$P4_img?></td>
                              <td class="tg-2fdn"><?=$P4_scout?><br><?=$P4_name?></td>
                            </tr>


                            <?php
                            $P5 = $this->Event_model->get_scout_sort_info($info->p5); 
                            $P5_img = $P5->profile_img != NULL ? '<img src="'.$path.$P5->profile_img.'" height="20">': $img_url;
                            $P5_scout = $P5->scout_id;
                            $P5_name = $P5->first_name;
                            ?>
                            <tr>
                              <td class="tg-u8ck">P5</td>
                              <td class="tg-2fdn"><?=$P5_img?></td>
                              <td class="tg-2fdn"><?=$P5_scout?><br><?=$P5_name?></td>
                            </tr>


                            <?php
                            $P6 = $this->Event_model->get_scout_sort_info($info->p6); 
                            $P6_img = $P6->profile_img != NULL ? '<img src="'.$path.$P6->profile_img.'" height="20">': $img_url;
                            $P1_scout = $P6->scout_id;
                            $P1_name = $P6->first_name;
                            ?>
                            <tr>
                              <td class="tg-u8ck">P6</td>
                              <td class="tg-2fdn"><?=$P6_img?></td>
                              <td class="tg-2fdn"><?=$P6_scout?><br><?=$P1_name?></td>
                            </tr>


                          </table>
                      </td>
                      <td valign="top">
                        <table class="tg">
                          <tr>
                            <th class="tg-2v33">Event Title:</th>
                            <th class="tg-jz97"><?=$info->event_title?></th>
                          </tr>
                          <tr>
                            <th class="tg-2v33">Event Date:</th>
                            <th class="tg-jz97">From <strong><?=date_detail_format($info->event_start_date)?></strong> to <strong><?=date_detail_format($info->event_end_date)?></strong></th>
                          </tr>
                          <tr>
                            <td class="tg-2v33">Event Venue:</td>
                            <td class="tg-jz97"><?=$info->event_venue?></td>
                          </tr>
                          <tr>
                            <td class="tg-2v33">Registration Period:</td>
                            <td class="tg-jz97">From <strong><?=date_detail_format($info->event_reg_start)?></strong> to <strong><?=date_detail_format($info->event_reg_end)?></strong></td>
                          </tr>                    
                          <tr>
                            <td class="tg-2v33">Event Organizer:</td>
                            <td class="tg-jz97"> <?php echo $info->event_organizer; ?> </td>
                          </tr>
                          <tr>
                            <td class="tg-2v33">Number of Participants:</td>
                            <td class="tg-jz97"><?=$info->ep_qty?></td>
                          </tr>
                          <tr>
                            <td class="tg-2v33">Event Category:</td>
                            <td class="tg-jz97"><?=$info->event_cate_name?></td>
                          </tr>
                          <tr>
                            <td class="tg-2v33" valign="top">Event Participants Type:</td>
                            <td class="tg-jz97" valign="top">
                              <?php
                                if($info->ept_cub){
                                  echo 'Cub ('.$this->Event_model->get_badges_single($info->cub_stage_id).')';
                                  echo '<br>';
                                }
                                if($info->ept_scout){
                                  echo 'Scout ('.$this->Event_model->get_badges_single($info->scout_stage_id).')';
                                  echo '<br>';
                                }
                                if($info->ept_rover){
                                  echo 'Rover ('.$this->Event_model->get_badges_single($info->rover_stage_id).')';
                                  echo '<br>';
                                }
                                if($info->ept_leader){
                                  echo 'Adult Leader ('.$this->Event_model->get_badges_single($info->leader_stage_id).')';
                                }
                              ?>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>

                  </table>

                  
                </div>
              </div>

            </div>

          </div>
        </div>
      </div>
    </div>

  </div> <!-- END ROW -->

</div>
</div>

