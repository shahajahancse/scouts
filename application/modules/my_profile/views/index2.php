<?php
$username = $info->username;
$scout_id = $info->scout_id;
$name = $info->first_name;
$name_bn = $info->full_name_bn;
$father = $info->father_name;
$father_bn = $info->father_name_bn;
$mother = $info->mother_name;
$mother_bn = $info->mother_name_bn;
$gender = $info->gender;
$dob = $info->dob !='0000-00-00' ? date('d F, Y', strtotime($info->dob)): '';
$blood_group = $info->bg_name_en;
$phone = $info->phone;
$phone2 = $info->phone2;
$emergency_phone = $info->phone_emergency;
$email = $info->email !='' ? $info->email: '';
$nid = $info->nid;

$religion_id = $info->religion_id;
$birth_id = $info->birth_id;
$occupation = $info->occupation_name;

$passport_no = $info->passport_no;
$passport_date_issue = $info->pass_date_issue;
$passport_date_expiry = $info->pass_date_expiry;
$passport_place_issue = $info->pass_place_issue;
$passport_place_birth = $info->pass_place_birth;

$pre_village  = $info->pre_village_house;
$pre_village_bn  = $info->pre_village_house_bn;
$pre_rode     = $info->pre_road_block;
$pre_rode_bn  = $info->pre_road_block_bn;

$pre_division = $info->pre_div_name;
$pre_district = $info->pre_district_name;
$pre_up_th    = $info->pre_up_th_name;
$pre_po       = $info->pre_post_office;

//generate a string for present addresss
$full_pre_add = '';

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

if($pre_division != '' && $pre_division != $pre_district)
  $full_pre_add .= $pre_division;
//END- generate a string for present address

$per_village  = $info->per_village_house;
$per_village_bn = $info->per_village_house_bn;
$per_rode     = $info->per_road_block;
$per_rode_bn  = $info->per_road_block_bn;
$per_division = $info->per_div_name;
$per_district = $info->per_district_name;
$per_up_th    = $info->per_up_th_name;
$per_po       = $info->per_post_office;

//generate a string for permanent addresss
$full_perm_addre = '';

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

$curr_institute = $info->institute_name;
$curr_class     = $info->curr_class;
$curr_role_no   = $info->curr_role_no;
$scout_designation = $info->scout_designation;
$curr_org = $info->curr_org;
$curr_desig = $info->curr_desig;


$last_update = $info->last_login !='' ? date('d F, Y', $info->last_login): '';
$created_date = $info->created_on !='' ? date('d F, Y', $info->created_on): '';

$is_verify = $info->is_verify;
$sc_join_date = $info->join_date !='0000-00-00' ? date('d F, Y', strtotime($info->join_date)): '';
$sc_section_name = $info->sc_section_id;
$section_name = get_scout_section($info->sc_section_id);
$sc_region_name = $info->region_name;
$sc_district_name = $info->dis_name;

if($info->region_type == 'divisional'){
   $sc_upazila_name = $info->upa_name;
}else{
   $sc_upazila_name = 'Not Applicable';
}

$sc_group_name = $info->grp_name;
$sc_unit_name = $info->unit_name;
$sc_badge_id = $info->sc_badge_id;

$sc_cub   = $info->sc_cub =='Yes'? $info->sc_cub:'No';
$sc_scout = $info->sc_scout =='Yes'? $info->sc_scout:'No';
$sc_rover = $info->sc_rover =='Yes'? $info->sc_rover:'No';

$sc_badge_name = $info->badge_type_name_bn;
$sc_role_name = $info->role_type_name_bn;

$profile_img = $info->profile_img;
$path = base_url().'profile_img/';
if($profile_img != NULL){
  $img_url = $path.$profile_img;
}else{
  $img_url = $path.'no-img.png';
}

//qr code text
$qr_code_text = 'Name: ' . $info->first_name . ' ('. $info->scout_id .')';

// Other's Information
$display_edu='';
$display_org='';
if($info->member_id == 1 || $info->member_id == 2){ 
   $display_edu = "display: block;";
   $display_org = "display: none;";
}else if($info->member_id == 8 || $info->member_id == 12 || $info->member_id == 10 || $info->member_id == 9 || $info->member_id == 13){
   $display_edu = "display: none;";
   $display_org = "display: block;";
}
?>     
<style type="text/css">
  .info{margin-left: 25px; color: black;}
  .dt_label{margin-left: 10px; width: 150px; display: block; float: left; color: #796b6b;}
  .dt_data{margin-left: 20px; color: black;}
</style>
<style type="text/css">
  .card7{background-color: #7030a0;border-top: 4px solid #1aa326;box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);border:none;
  }
  .card27{background-color: #ffffff;border: px solid #7030a0;box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
  }
  .header7{width: 100%;padding: 13px 0;background-color: #7030a0;}
  .divider27{width: 80%;padding: 7px;background-color: #ffffff;margin: -10px auto;display: block;}
  /*.logo7 img{margin: 0 auto;display: block;padding: 20px;}*/
  .divider7{width: 100%;border: 2px solid #1aa326;margin-top: ;}
  .divider8{width: 100%;border: 2px solid #7030a0;margin-top: ;}
  .card-info7{background-image: url('awedget/assets/img/transprent_logo.png');background-repeat: no-repeat;background-position: center;  background-size: 105px;}
  .footer7{width: 100%;color: #ffffff;padding-bottom: 3px;text-align: center;font-size: 15px;background-color: #7030a0;}
  .id_card{margin: 0px 5px 0px 5px; color: black; font-size: 11px;}
  .table-bordered tr.bg-success th{ background-color: #a7afaf !important; color:#ffffff;}
  .semi-bold{ color:#0aa699;margin-top: 15px}
  /*.id_card tr{margin: 0px 5px 0px 5px;}*/
  /*.id_card th{width: 93px; text-align: right; padding-bottom: 6px; vertical-align: top}
  .id_card td{padding-left: 10px;padding-bottom: 6px; }*/
</style>

<div class="page-content"> 
  <div class="content">  

    <!-- <div class="row">
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="item active">
            <img src="https://www.w3schools.com/bootstrap/chicago.jpg" alt="Los Angeles" style="width:100%;">
          </div>
          <div class="item">
            <img src="https://www.w3schools.com/bootstrap/ny.jpg" alt="Chicago" style="width:100%;">
          </div>
          <div class="item">
            <img src="https://www.w3schools.com/bootstrap/la.jpg" alt="New York" style="width:100%;">
          </div>
        </div>
      </div>
    </div> -->


    <div class="row">
      <div class="col-md-12">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
          <?php 
            $slid = 0; 
            foreach ($slider as $slide) { 
              $slid++;
              $img_path = base_url().'slider_img/';
              if($slide->image_file != NULL){
                $src= $img_path.$slide->image_file;
                // echo "<img src='$src'>";
              }
            ?>          
            <div class="item <?=$slid == 1?'active':''?>">
              <img src="<?=$src?>" alt="Slider" style="width:100%;">
              <!-- <div class="carousel-caption">
                <h3>Los Angeles</h3>
                <p>LA is always so much fun!</p>
              </div> -->
            </div>
          <?php } ?>            
          </div>

          <!-- Left and right controls -->
          <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
          </a>
        </div> <!-- /carousel -->
        <!-- <div class=" tiles white col-md-12 no-padding">
          <div class="tiles green cover-pic-wrapper">           
            <div class="overlayer bottom-right"> </div>
            <img src="<?=base_url('awedget/assets/img/cover_pic.png')?>" alt="">
          </div>
        </div> -->
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">      
        <div class="tiles white">
          <div class="row">
            <div class="col-md-2 col-sm-2" style="margin:0 20px;">
              <div class="user-profile-pic"> <img style="max-height:150px; max-width: 150px; height: auto; " data-src-retina="<?=$img_url?>" data-src="<?=$img_url?>" src="<?=$img_url?>" alt=""></div>
              <?php if($scout_id != NULL){ ?>
              <div class="user-mini-description"  style="font-size: 150%;"><h2 class="text-success semi-bold"> BS ID</h2></div>
              <div class="user-mini-description" style="font-size: 150%;"><h2 class="text-success semi-bold" ><?=$scout_id;?> </h2></div>
              <?php } ?>
            </div>
            <div class="col-md-9 user-description-box col-sm-9">
              <div class="row">
                <?php if($this->session->flashdata('success')):?>
                  <div class="alert alert-success">
                     <?php echo $this->session->flashdata('success');;?>
                  </div>
                <?php endif; ?>
              </div>
              <div class="row">
                <div class="pull-left" style="width: 60%; border:0px solid red;">
                  <h4 class="semi-bold no-margin" ><?=$name;?></h4>
                  <h6 class="no-margin" style="font-weight: bold;"><?=$info->member_type_name;?></h6>  
                </div>              

                <div class="pull-right">    
                    <a href="<?=base_url('my_profile/id_card2/'.$info->id)?>" class="btn btn-blueviolet btn-xs btn-mini" target="_blank"><i class="fa fa-download"></i> আইডি কার্ড ডাউনলোড করুন </a>   
                    <a href="<?=base_url('my_profile/change_image')?>" class="btn btn-blueviolet btn-xs btn-mini"><i class="fa fa-user"></i> ছবি পরিবর্তন করুন</a>
                    <!-- <a href="<?=base_url('my_profile/change_username')?>" class="btn btn-blueviolet btn-xs btn-mini"><i class="fa fa-refresh"></i> Change Username</a> -->
                    <a href="<?=base_url('my_profile/change_password')?>" class="btn btn-blueviolet btn-xs btn-mini"><i class="fa fa-key"></i> পাসওয়ার্ড পরিবর্তন করুন</a>

                    <a href="<?=base_url('my_profile/change_department')?>" class="btn btn-blueviolet btn-xs btn-mini"><i class="fa fa-home"></i> বিভাগ পরিবর্তন করুন</a>
                </div>
              </div>
                            
              <div class="row" style="margin-top: 20px;">
                <div class="col-md-6">
                  <p><i class="fa fa-circle"></i>ব্যবহারকারী নাম বা ইমেল লগইন করুন <br>
                    <span class="info"><?=$username?></span> </p>                  
                  <p><i class="fa fa-circle"></i> জন্ম তারিখ <br>
                    <span class="info"><?=date_bangla_calender_format($dob)?></span> </p>
                  <p><i class="fa fa-circle"></i>শেষ লগইন <br> 
                    <span class="info"><?=date_bangla_calender_format($last_update)?></span> </p>
                </div>
                <div class="col-md-6">
                  <p><i class="fa fa-globe"></i>অনলাইন যোগদানের তারিখ <br> 
                    <span class="info"><?=date_bangla_calender_format($created_date)?></span> </p>
                  <p><i class="fa fa-globe"></i>পদবি <br>
                    <span class="info"><?=$designation->designation_name?></span> </p>
                  <p><i class="fa fa-globe"></i>বিভাগ<br>
                    <span class="info"><?=$department->department_name?></span> </p>                  
                </div>
              </div>
            </div>            

          </div> <!--/row -->
          
          <?php if(!$this->ion_auth->is_guest()){ ?>
          <div class="row">
            <div class="col-md-12">
              <ul class="nav nav-tabs" id="tab-01">
                <li class="active"><a href="#tab_basic">বেসিক তথ্য</a></li>
                <!-- <li ><a href="#tab_edu">শিক্ষাগত তথ্য</a></li> -->
                <!-- <li ><a href="#tab_work">ওয়ার্কিং স্টেশন সম্পর্কিত তথ্য</a></li> -->
              </ul>

              <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_basic">
                  <div class="row column-seperation">
                    <div class="col-md-12" style="margin-bottom: 20px;"> 
                      <div class="pull-right">
                         <a href="<?=('my_profile/emp_update/'.$info->id)?>" class="btn btn-primary btn-xs btn-mini"><i class="fa fa-edit"></i>বেসিক তথ্য আপডেট করুন</a> 
                      </div>
                    </div>
                    
                    <div class="col-md-8">
                      <p> <span class="dt_label">নাম (ইংরেজি)</span>
                        <span class="dt_data"><?=$name?></span> </p>
                      <p> <span class="dt_label">name (Bangla)</span>
                        <span class="dt_data"><?=$name_bn?></span> </p>
                     
                      <p> <span class="dt_label">লিঙ্গ </span>
                        <span class="dt_data"><?=$info->gender?></span> </p>

                      <p> <span class="dt_label">ধর্ম </span>
                        <span class="dt_data"><?=get_religion($info->religion_id)?></span> </p>
                      
                      <p> <span class="dt_label">জন্ম তারিখ </span>
                        <span class="dt_data"><?=date_bangla_calender_format($dob)?></span> </p>
                      
                      <p> <span class="dt_label">রক্তের গ্রুপ </span>
                        <span class="dt_data"><?=$blood_group?></span> </p>
                      <p> <span class="dt_label">জাতীয় পরিচয়পত্র</span> 
                        <span class="dt_data"><?=$this->Common_model->en2bn($nid)?></span> </p>
                      
                      <p> <span class="dt_label">মোবাইল নম্বর</span> 
                        <span class="dt_data"><?=$this->Common_model->en2bn($phone)?></span> </p>

                      <p> <span class="dt_label">ইমেইল</span>
                        <span class="dt_data"><?=$email?></span> </p>


                      <p> <span class="dt_label">পদবি </span>
                        <span class="dt_data"><?=$designation->designation_name?></span> </p>
                      
                      <h5> <span class="dt_label"><b>বিভাগ</b></span> 
                        <span class="dt_data"><?=$department->department_name?></span></h5>
                    </div>
                    <div class="col-md-4">

                      <h5> <span class="dt_label"><b>স্বাক্ষর</b></span>
                        <span class="dt_data">
                          <?php if(!empty($info->emp_singature)){ ?>
                            <img src="<?=base_url('employee_img/'.$info->emp_singature)?>" width="100px">
                          <?php } ?>
                        </span></h5> 
                     
                    </div>
                  </div>
                </div>

                <!-- <div class="tab-pane active" id="tab_edu">
                  <div class="row column-seperation">
                      <div class="col-md-12" style="margin-bottom: 20px;"> 
                        <div class="pull-right">
                           <a href="#" class="btn btn-primary btn-xs btn-mini"><i class="fa fa-edit"></i>আপডেট করুন</a> 
                        </div>
                      </div>
                    
                      <div class="col-md-12">
                        <h4 class="semi-bold">শিক্ষাগত তথ্য</h4>
                        <table width="100%" border="1" id="memberDiv">
                           <tr>
                              <td width="20%">শিক্ষা / পরীক্ষা</td>
                              <td width="50%">ইনস্টিটিউট / বিশ্ববিদ্যালয় / বোর্ড</td>
                              <td width="15%">ফলাফল</td>
                              <td width="15%">পাসের সন</td> 
                           </tr>
                           <tr></tr>
                        </table>
                       
                      </div>
                  </div>

                  </div>

                  <div class="tab-pane active" id="tab_work">
                  <div class="row column-seperation">
                      <div class="col-md-12" style="margin-bottom: 20px;"> 
                        <div class="pull-right">
                           <a href="#" class="btn btn-primary btn-xs btn-mini"><i class="fa fa-edit"></i>আপডেট করুন</a> 
                        </div>
                      </div>
                    
                      <div class="col-md-12">
                         <h4 class="semi-bold">ওয়ার্কিং স্টেশন সম্পর্কিত তথ্য</h4>
                        <table width="100%" border="1" id="workStationDiv">
                           <tr>
                              <td width="50%">ওয়ার্কিং প্লেস</td>
                              <td width="20%">হিসেবে দায়িত্ব পালন</td>
                              <td width="15%">তারিখ হইতে</td>
                              <td width="15%">এখন পর্যন্ত</td> 
                           </tr>
                           <tr></tr>
                        </table>
                       
                      </div>
                  </div>

                  </div> -->
              </div>                



              </div> <!-- /tab-content -->
            </div> <!-- /end tab col -->
          </div>

          <?php } ?>

        </div> <!-- /tiles -->
      </div>
    </div> <!--/row -->

  </div>  <!--/content -->
</div>

<script type="text/javascript" src="<?= base_url('awedget/assets/js/qrcode.min.js') ?>"></script>

<script type="text/javascript">
  var qrcode = new QRCode(document.getElementById("qrcode"), {
    text: $('#qr_code_text').val(),
    width: 35,
    height: 35,
    colorDark : "#000000",
    colorLight : "#ffffff",
    correctLevel : QRCode.CorrectLevel.H
  });
</script>