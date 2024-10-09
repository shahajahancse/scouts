<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8" />
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <link rel="icon" type="image/ico" href="<?=base_url('awedget/assets/img/favicon.ico');?>"/>
   <title><?=$meta_title?> | <?=$domain_title?></title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
   <link href="<?=base_url();?>awedget/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
   <meta content="Mysoftheaven (BD) Ltd." name="author" />
   <link href="<?=base_url();?>awedget/assets/plugins/jquery-superbox/css/style.css" rel="stylesheet" type="text/css" media="screen"/>
   <link href="<?=base_url();?>awedget/assets/plugins/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" media="screen"/>
   <?php /*
   <!--  <link href="<?=base_url();?>awedget/assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen"/> -->
   <!-- <link href="<?=base_url();?>awedget/assets/plugins/select2/select2.css" rel="stylesheet" type="text/css" media="screen"/>  -->
   <!-- <link href="<?=base_url();?>awedget/assets/plugins/dropzone/css/dropzone.css" rel="stylesheet" type="text/css"/> -->
   <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet"> -->
   */ ?>
   <link href="<?=base_url();?>awedget/assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" type="text/css" />
   <link href="<?=base_url();?>awedget/assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.css" rel="stylesheet" type="text/css" />
   <link href="<?=base_url();?>awedget/assets/plugins/jquery-datatable/css/jquery.dataTables.css" rel="stylesheet" type="text/css"/>
   <link href="<?=base_url();?>awedget/assets/plugins/datatables-responsive/css/datatables.responsive.css" rel="stylesheet" type="text/css" media="screen"/>
   <link href="<?=base_url();?>awedget/assets/plugins/boostrap-checkbox/css/bootstrap-checkbox.css" rel="stylesheet" type="text/css" media="screen"/>
   <link rel="stylesheet" href="<?=base_url();?>awedget/assets/plugins/ios-switch/ios7-switch.css" type="text/css" media="screen">
   <link href="<?=base_url();?>awedget/assets/plugins/jquery-slider/css/jquery.sidr.light.css" rel="stylesheet" type="text/css" media="screen"/>
   <?php /*
   <!-- <link href="<?=base_url();?>awedget/assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
   <link href="<?=base_url();?>awedget/assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
   */ ?>
   <link href="<?=base_url();?>awedget/assets/plugins/boostrap-3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
   <link href="<?=base_url();?>awedget/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
   <link href="<?=base_url();?>awedget/assets/css/animate.min.css" rel="stylesheet" type="text/css"/>
   <?php /*
   <link rel="stylesheet" href="<?=base_url();?>awedget/assets/croper/css/cropper.min.css">
   <link rel="stylesheet" href="<?=base_url();?>awedget/assets/croper/css/main.css">
   */ ?>
   <link href="<?=base_url();?>awedget/assets/css/style.css" rel="stylesheet" type="text/css"/>
   <link href="<?=base_url();?>awedget/assets/css/responsive.css" rel="stylesheet" type="text/css"/>
   <link href="<?=base_url();?>awedget/assets/css/custom-icon-set.css" rel="stylesheet" type="text/css"/>
   <?php /*
   <!-- <script src="<?=base_url();?>awedget/assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>   -->
   <!-- <script src="<?=base_url();?>awedget/assets/plugins/jquery-3.2.1.min.js" type="text/javascript"></script> -->
   <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
   <!-- <script src="<?=base_url();?>awedget/assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script> -->
   <!-- <script src="<?=base_url();?>awedget/assets/plugins/jquery-1.9.1.min.js" type="text/javascript"></script> -->
   <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> -->
   */?>
   <script src="<?=base_url('awedget/assets/js/jquery.1.9.1.min.js');?>" type="text/javascript"></script>
   <script type="text/javascript">var hostname='<?php echo base_url();?>';</script>
   <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
</head> <!-- END HEAD -->

<?php if($this->router->fetch_class('my_message') == 'my_message'){ ?>
<body class="inner-menu-always-open">
   <?php }else{ ?>
   <body class="">
      <?php } ?>
      <div class="header navbar navbar-inverse ">
         <div class="navbar-inner">
            <div class="header-seperation">
               <ul class="nav pull-left notifcation-center" id="main-menu-toggle-wrapper" style="display:none">
                  <li class="dropdown"> <a id="main-menu-toggle" href="#main-menu"  class="" >
                     <div class="iconset top-menu-toggle-white"></div> </a>
                  </li>
               </ul>
               <a href="<?=base_url('dashboard')?>"><img src="<?=base_url('awedget/assets/img/logo-200.png');?>" class="logo" alt=""  data-src="<?=base_url('awedget/assets/img/logo-200.png');?>" data-src-retina="<?=base_url('awedget/assets/img/logo-200.png');?>" height="35"/></a>
               <ul class="nav pull-right notifcation-center">
                  <li class="dropdown" id="header_task_bar"> <a href="<?=base_url()?>" class="dropdown-toggle active" data-toggle="">
                     <div class="iconset top-home"></div> </a>
                  </li>
               </ul>
            </div>
            <div class="header-quick-nav" >
               <div class="pull-left">
                  <ul class="nav quick-section">
                     <li class="quicklinks">
                        <a href="javascript:;" class="" id="layout-condensed-toggle" style="color: #8dc641;"><i class="fa fa-bars" style="font-size: 22px; color: #8dc641 !important;"></i>
                        </a>
                     </li>
                  </ul>

                  <?php if(!$this->officeSess){ ?>
                  <div class="pull-left" style="margin: 20px 0 0 5px; height: 30px;">
                     <span style="font-size: 15px; float: left; font-weight: bold; color: #8dc641; margin: 0px 15px 0 0;"> <?=$this->ion_auth->is_employee()?'প্রোফাইল':'Profile'?> </span>
                     <div class="progress progress-striped active progress-large no-radius no-margin" style="width: 200px;border: 1px solid #cbc2c2;">
                        <div data-percentage="<?=$userDetails['profile_score']?>%" class="progress-bar progress-bar-green animate-progress-bar" ></div>
                     </div>
                     <div class="pull-right">
                        <div class="details-status"> <span data-animation-duration="560" data-value="<?=$userDetails['profile_score']?>" class="animate-number"></span>% </div>
                     </div>
                  </div>
                  <?php } ?>
               </div>

               <!-- BEGIN CHAT TOGGLER -->
               <div class="pull-right">
                  <div class="chat-toggler"> <a href="javascript:;" class="dropdown-toggle" id="my-task-list" data-placement="bottom"  data-content='' data-toggle="dropdown" data-original-title="Notifications">
                     <?php if($this->ion_auth->is_employee()){ ?>
                     <div class="user-details">
                        <div class="username">
                           <div class="bold" style=" line-height: 20px"><?=$userDetails['user_info']->first_name?></div>
                           <div style="font-size: 12px; font-weight: bold; line-height: 20px"><?=$designationDetails->designation_name;?></div>
                        </div>
                     </div>
                     <?php }elseif(!$this->officeSess){ ?>
                     <div class="user-details">
                        <div class="username">
                           <?php //if($userDetails['user_info']->scout_id != NULL){ ?>
                           <strong>BS ID</strong>: <span class="label label-success"><?=$userDetails['user_info']->scout_id?></span>
                           <?php //} ?>
                           <span class="bold" style="margin-left: 20px;"><?=$userDetails['user_info']->first_name?></span>
                           <span style="font-size: 12px; font-weight: bold;">(<?=$userDetails['user_info']->username;?>)</span>
                        </div>
                     </div>
                     <?php }else{ ?>
                     <div class="user-details">
                        <div class="username">
                           <span class="bold" style="margin-left: 20px;"><?=$officeName?></span> <span style="font-size: 12px; font-weight: bold;">(<?=$officeDetails->username;?>)</span>
                        </div>
                     </div>
                     <?php } ?>

                     <div class="iconset top-down-arrow"></div> </a>

                     <?php if(!$this->officeSess){
                        $path = base_url().'profile_img/';
                        if($userDetails['user_info']->profile_img != NULL){
                           $img_url = $path.$userDetails['user_info']->profile_img;
                        }else{
                           $img_url = $path.'no-img.png';
                        }
                        ?>
                        <div class="profile-pic"> <img src="<?=$img_url?>"  alt="Profile Image" data-src="<?=$img_url?>" data-src-retina="<?=$img_url?>" width="35" height="35" /> </div>
                        <?php } ?>
                     </div>

                     <ul class="nav quick-section ">
                        <li class="quicklinks"> <a data-toggle="dropdown" class="dropdown-toggle  pull-right " href="javascript:;" id="user-options">
                           <i class="fa fa-cog" style="font-size: 22px; color: #8dc641 !important;"></i>
                        </a>
                        <ul class="dropdown-menu  pull-right" role="menu" aria-labelledby="user-options">
                           <?php if(!$this->officeSess){ ?>
                           <?php if($userDetails['user_info']->is_request != 2){ ?>
                           <li><a href="<?=base_url('my_profile')?>"> <i class="fa fa-user"></i>  <?=$this->ion_auth->is_employee()?'প্রোফাইল':'My Profile'?></a> </li>
                           <?php } ?>
                           <?php }else{ ?>
                           <li><a href="<?=base_url('my_office')?>"> <i class="fa fa-user"></i>  My Office</a> </li>
                           <?php } ?>

                           <li class="divider"></li>
                           <li><a href="<?=base_url('logout')?>"><i class="fa fa-power-off"></i> <?=$this->ion_auth->is_employee()?'লগ আউট':'Log Out'?></a></li>
                        </ul>
                     </li>
                  </ul>
               </div> <!-- END CHAT TOGGLER -->

            </div> <!-- END TOP NAVIGATION MENU -->
         </div> <!-- END TOP NAVIGATION BAR -->
      </div> <!-- END HEADER -->


      <!-- BEGIN CONTAINER -->
      <div class="page-container row-fluid">
         <?php if($this->router->fetch_class('my_message') == 'my_message'){ ?>
         <div class="page-sidebar mini mini-mobile" id="main-menu" data-inner-menu="1">
            <div class="page-sidebar-wrapper">
               <?php }else{ ?>
               <div class="page-sidebar" id="main-menu">
                  <div class="page-sidebar-wrapper" id="main-menu-wrapper">
                     <?php } ?>
                     <div class="user-info-wrapper" style=" padding-bottom: 10px; border-bottom: 1px solid #db0424;">
                        <div class="user-info" style="background-color: white; ">
                           <?php if($this->ion_auth->is_employee()){ ?>
                           <div class="label label-info">জাতীয় সদর দপ্তর</div>
                           <?php if($departmentDetails->id !=0){ ?>
                           <div class="label label-success" style="margin-top:8px; display: block; padding: 5px;"><?=$departmentDetails->department_name;?></div>
                           <?php } ?>
                           <?php }else{ ?>
                           <span style="color: #683091">Login as:</span>
                           <span class="label label-success"> <strong><?= $this->session->userdata('current_group_name') ?></strong></span>
                           <?php } ?>
                        </div>
                     </div>

                     <!-- BEGIN SIDEBAR MENU -->
                     <ul class="pull-left">
                        <li class="start <?=backend_activate_menu_class('dashboard')?>">
                           <a href="<?=base_url('dashboard');?>"> <i class="icon-custom-home"></i>  <span class="title"><?=$this->ion_auth->is_employee()?'ড্যাশবোর্ড':'Dashboard'?></span></a>
                        </li>

                        <?php
                        // Vendor role (Third Party)
                        if($this->ion_auth->is_vendor()){ ?>
                        <li class="start"><a href="<?=base_url('scouts_member/all')?>"> <i class="fa fa-circle"></i> <span class="title">Scout Member List</span> </a></li>
                        <li class="start"><a href="<?=base_url('offices/scout_group')?>"> <i class="fa fa-circle"></i> <span class="title">Scout Group List</span> </a></li>
                        <?php }else{ // Other user role ?>

                        <?php if(!$this->officeSess){ ?>
                        <?php if($userDetails['user_info']->is_request != 2){ ?>
                        <li class="start <?=backend_activate_menu_class('my_profile')?>">
                           <a href="<?=base_url('my_profile');?>"> <i class="fa fa-user"></i> <span class="title"><?=$this->ion_auth->is_employee()?'প্রোফাইল':'My Profile'?></span></a>
                        </li>
                        <?php } ?>
                        <?php }else{ ?>
                        <li class="start <?=backend_activate_menu_class('my_office')?>">
                           <a href="<?=base_url('my_office');?>"> <i class="fa fa-user"></i> <span class="title">My Office</span></a>
                        </li>
                        <?php } ?>

                        <?php if(!$this->ion_auth->is_guest()){ ?>
                        <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin()){ ?>
                        <li class="start <?=backend_activate_menu_class('scouts_member')?>">
                           <a href="javascript:;" > <i class="fa fa-user"></i> <span class="title">Scouts Member</span> <span class="selected"></span>
                              <?php
                              if($this->ion_auth->is_group_admin()){
                                 if($count_member_req > 0){
                                    echo '<span class="badge badge-danger pull-right">'.$count_member_req.'</span>';
                                 }
                              }
                              ?>
                              <span class="arrow"></span>
                           </a>
                           <ul class="sub-menu">
                              <li> <a href="<?=base_url('scouts_member/all');?>"> Scout Member List</a></li>

                              <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->is_group_admin()){ ?>
                              <li> <a href="<?=base_url('scouts_member/create');?>"> Add Scout Member </a> </li>
                              <?php } ?>

                              <?php if($this->ion_auth->is_group_admin()){ ?>
                              <li> <a href="<?=base_url('scouts_member/request');?>"> Member Request List
                                 <?php
                                 if($count_member_req > 0){
                                    echo '<span class="badge badge-danger pull-right">'.$count_member_req.'</span>';
                                 }
                                 ?>
                              </a> </li>
                              <li> <a href="<?=base_url('scouts_member/verified_list');?>"> Verified Member List</a></li>
                              <li> <a href="<?=base_url('scouts_member/cancel_request');?>"> Cancel Request List</a></li>
                              <?php } ?>

                              <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin()){ ?>
                              <li> <a href="<?=base_url('scouts_member/archive_list');?>"> Archive Member List</a></li>
                              <?php if($this->ion_auth->is_admin()) { ?>
                              <li> <a href="<?=base_url('scouts_member/delete_request');?>"> Delete Request List</a></li>
                              <?php } ?>
                              <?php } ?>
                           </ul>
                        </li>
                        <?php } ?>

                        <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin()){ ?>
                        <li class="start <?=backend_activate_menu_class('offices')?>">
                           <a href="javascript:;" > <i class="fa fa-user"></i> <span class="title">Office Setup</span> <span class="selected"></span> <span class="arrow"></span> </a>
                           <ul class="sub-menu">
                              <?php if($this->ion_auth->is_admin()){ ?>
                              <li> <a href="<?=base_url('offices/nhq');?>"> NHQ Office </a> </li>
                              <li> <a href="<?=base_url('offices/region');?>"> Region Office </a> </li>
                              <?php } ?>
                              <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin()){ ?>
                              <li> <a href="<?= base_url('offices/district'); ?>"> District Office</a></li>
                              <?php } ?>
                              <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin()){ ?>
                              <li> <a href="<?= base_url('offices/upazila');?>"> Upazila Office</a></li>
                              <?php } ?>
                              <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin()){ ?>
                              <li> <a href="<?=base_url('offices/scout_group');?>"> Scout Groups</a></li>
                              <?php } ?>
                              <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin()){ ?>
                              <!-- <li> <a href="<?=base_url('offices/scout_unit');?>"> Scout Unit</a></li> -->
                              <?php } ?>
                           </ul>
                        </li>
                        <?php } ?>

                        <?php if(!$this->officeSess){ ?>
                        <?php if($userDetails['user_info']->member_id == '2'){ ?>
                        <li class="start <?=backend_activate_menu_class('program')?>">
                           <a href="javascript:;" > <i class="fa fa-user"></i> <span class="title">My Progress</span> <span class="selected"></span>
                              <span class="arrow"></span>
                           </a>
                           <ul class="sub-menu">
                              <?php if($userDetails['user_info']->sc_section_id == '1'){ ?>
                              <li> <a href="<?=base_url('program/cub_program')?>"> Cub Program</a> </li>
                              <?php } ?>
                              <?php if($userDetails['user_info']->sc_section_id == '2'){ ?>
                              <li> <a href="<?=base_url('program/scout_program')?>"> Scout Program</a> </li>
                              <?php } ?>
                              <?php if($userDetails['user_info']->sc_section_id == '3'){ ?>
                              <li> <a href="<?=base_url('program/rover_program')?>"> Rover Scout Program</a> </li>
                              <?php } ?>
                           </ul>
                        </li>

                        <?php }elseif($userDetails['user_info']->member_id == 8 || $userDetails['user_info']->member_id == 9 || $userDetails['user_info']->member_id == 10 || $userDetails['user_info']->member_id == 12){
                           // || $userDetails['user_info']->member_id == '9' || $userDetails['user_info']->member_id == '10' || $userDetails['user_info']->member_id == '12'
                           ?>
                           <li class="start <?=backend_activate_menu_class('program')?>">
                              <a href="<?=base_url('program/leader_progress');?>"> <i class="fa fa-user"></i> <span class="title">Leader Progress </span>
                              </a>
                           </li>
                           <?php } ?>
                           <?php } ?>

                           <?php if($this->ion_auth->is_scout_member()){ ?>
                           <li class="start <?=backend_activate_menu_class('migration')?>">
                              <a href="javascript:;" > <i class="fa fa-user"></i> <span class="title">Group Migration</span> <span class="selected"></span>
                                 <span class="arrow"></span>
                              </a>
                              <ul class="sub-menu">
                                 <li> <a href="<?=base_url('migration/group_migration_application');?>"> Group Migration Application</a></li>
                                 <li> <a href="<?=base_url('migration/my_group_migration_list');?>"> My Group Migration List </a> </li>
                              </ul>
                           </li>
                           <li class="start <?=backend_activate_menu_class('migration')?>">
                              <a href="javascript:;" > <i class="fa fa-user"></i> <span class="title">Section Migration</span> <span class="selected"></span>
                                 <span class="arrow"></span>
                              </a>
                              <ul class="sub-menu">
                                 <li> <a href="<?=base_url('migration/section_migration_application');?>"> Section Migration Application</a></li>
                                 <li> <a href="<?=base_url('migration/my_section_migration_list');?>"> My Section Migration List </a> </li>
                              </ul>
                           </li>
                           <?php } ?>

                           <?php if($this->ion_auth->is_group_admin()){ ?>
                           <li class="start <?=backend_activate_menu_class('migration')?>">
                              <a href="javascript:;" > <i class="fa fa-user"></i> <span class="title">Migration</span> <span class="selected"></span>
                                 <?php
                                 if($this->ion_auth->is_group_admin() && $count_req_total_grp_mig > 0){
                                    echo '<span class="badge badge-danger pull-right">'.$count_req_total_grp_mig.'</span>';
                                 }
                                 ?>
                                 <span class="arrow"></span>
                              </a>
                              <ul class="sub-menu">
                                 <?php if($this->ion_auth->is_group_admin()) { ?>
                                 <li>
                                    <a href="<?=base_url('migration/release_group_request_list');?>"> Release Member Request
                                       <?php
                                       if($this->ion_auth->is_group_admin() && $count_req_release_grp_mig > 0){
                                          echo '<span class="badge badge-danger pull-right">'.$count_req_release_grp_mig.'</span>';
                                       }
                                       ?>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="<?=base_url('migration/migrate_group_request_list');?>"> Migrate Member Request
                                       <?php
                                       if($count_req_migrate_grp_mig > 0){
                                          echo '<span class="badge badge-danger pull-right">'.$count_req_migrate_grp_mig.'</span>';
                                       }
                                       ?>
                                    </a>
                                 </li>
                                 <?php } ?>

                                 <?php if($this->ion_auth->is_group_admin()) { ?>
                                 <?php /*
                                 <li>
                                    <a href="<?=base_url('migration/release_section_request_list');?>"> Release Section Request
                                       <?php
                                       if($count_req_release_section_mig > 0){
                                          echo '<span class="badge badge-danger pull-right">'.$count_req_release_section_mig.'</span>';
                                       }
                                       ?>
                                    </a>
                                 </li>
                                 */ ?>
                                 <li> <a href="<?=base_url('migration/migrate_section_request_list');?>"> Migrate Section Request
                                    <?php
                                    if($count_req_migrate_section_mig > 0){
                                       echo '<span class="badge badge-danger pull-right">'.$count_req_migrate_section_mig.'</span>';
                                    }
                                    ?>
                                 </a>
                              </li>
                              <?php } ?>
                           </ul>
                        </li>
                        <?php } ?>

                        <?php if($this->ion_auth->is_admin() || $this->ion_auth->in_group('event') || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin() || $this->ion_auth->is_scout_member()){ ?>

                        <li class="start <?=backend_activate_menu_class('events')?>">
                           <a href="javascript:;" > <i class="fa fa-user"></i> <span class="title">Events</span> <span class="selected"></span> <span class="arrow"></span>
                           </a>
                           <ul class="sub-menu">
                              <?php if($this->ion_auth->is_scout_member()){ ?>
                              <li> <a href="<?=base_url('events/upcomming_event');?>"> Upcomming Events </a> </li>
                              <li> <a href="<?=base_url('events/my_application');?>"> My Application List </a> </li>
                              <?php } ?>

                              <?php if($this->ion_auth->is_admin() || $this->ion_auth->in_group('event') || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin()){ ?>
                              <li> <a href="<?=base_url('events/create_event');?>"> Create Event</a></li>
                              <li> <a href="<?=base_url('events/event_list');?>"> All Event List </a> </li>
                              <?php } ?>

                              <?php if($this->ion_auth->is_group_admin()){ ?>
                              <li> <a href="<?=base_url('events/upcomming_group_event');?>"> Upcomming Group Events </a> </li>
                              <li> <a href="<?=base_url('events/my_group_application');?>"> My Group Application </a> </li>
                              <?php } ?>

                              <?php if($this->ion_auth->is_admin() || $this->ion_auth->in_group('event') || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin()){ ?>
                              <li> <a href="<?=base_url('events/application_list');?>"> Applicant List</a></li>
                              <!-- <li> <a href="<?=base_url('events/upcomming_event_list');?>"> Upcomming Events </a> </li> -->
                              <?php } ?>
                           </ul>
                        </li>
                        <?php } ?>

                        <?php if($this->ion_auth->is_admin() || $this->ion_auth->in_group('training') || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin() || $this->ion_auth->is_scout_member()){ ?>
                        <li class="start <?=backend_activate_menu_class('training')?>">
                           <a href="javascript:;" > <i class="fa fa-user"></i> <span class="title">Training</span> <span class="selected"></span> <span class="arrow"></span> </a>
                           <ul class="sub-menu">
                              <?php if($this->ion_auth->is_scout_member()){ ?>
                              <li> <a href="<?=base_url('training/upcomming_training');?>"> Upcomming Training </a> </li>
                              <li> <a href="<?=base_url('training/my_application');?>"> My Application List </a> </li>
                              <?php } ?>

                              <?php if($this->ion_auth->is_admin() || $this->ion_auth->in_group('training') || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin()){ ?>
                              <li> <a href="<?=base_url('training/create_training');?>"> Create Training</a></li>
                              <li> <a href="<?=base_url('training/training_list');?>"> All Training List </a> </li>
                              <?php } ?>

                              <?php if($this->ion_auth->is_admin() || $this->ion_auth->in_group('training') || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin()){ ?>
                              <li> <a href="<?=base_url('training/application_list');?>"> Applicant List</a></li>
                              <?php } ?>

                              <?php if($this->ion_auth->is_admin() || $this->ion_auth->in_group('training') || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin()){ ?>
                              <li> <a href="<?=base_url('training/trainer_list');?>"> Trainer List</a></li>
                              <?php } ?>
                           </ul>
                        </li>
                        <?php } ?>

                        <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()|| $this->ion_auth->in_group('award') || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin() || $this->ion_auth->is_scout_member()){ ?>
                        <li class="start <?=backend_activate_menu_class('award')?>">
                           <a href="javascript:;" > <i class="fa fa-user"></i> <span class="title">Award</span> <span class="selected"></span> <span class="arrow"></span> </a>
                           <ul class="sub-menu">
                              <?php if($this->ion_auth->is_admin() || $this->ion_auth->in_group('award') || $this->ion_auth->is_scout_admin()){ ?>
                              <li> <a href="<?=base_url('award/circular_create');?>">Create Award Circular </a> </li>
                              <li> <a href="<?=base_url('award/circular_list');?>">Award Circular </a> </li>
                              <?php } ?>

                              <li> <a href="<?=base_url('award/shapla_cub_list');?>">Shapla Cub Award </a> </li>
                              <li> <a href="<?=base_url('award/president_scout_list');?>">PS Award </a> </li>
                              <li> <a href="<?=base_url('award/president_rover_scout_list');?>">PRS Award </a> </li>
                              <li> <a href="<?=base_url('award/community_development_list');?>">CD Award </a> </li>
                              <li> <a href="<?=base_url('award/nhq_list');?>">NHQ Award </a> </li>

                              <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award')){ ?>
                              <li> <a href="<?=base_url('award/archive_list');?>">Award Archive </a> </li>
                              <?php } ?>

                              <?php //if($this->ion_auth->is_group_admin() || $this->ion_auth->is_upazila_admin()){ ?>
                              <!-- <li> <a href="<?=base_url('award/recommendation_form');?>">Recommendation Form</a> </li> -->
                              <!-- <li> <a href="<?=base_url('award/recommendation_circular_list');?>">Recommended Circular List</a> </li> -->
                              <?php //} ?>
                           </ul>
                        </li>
                        <?php } ?>

                        <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ ?>
                        <li class="start <?=backend_activate_menu_class('employee')?>"> <a href="javascript:;" > <i class="fa fa-user"></i> <span class="title">Employee / PDS</span> <span class="selected"></span> <span class="arrow"></span> </a>
                           <ul class="sub-menu">

                             <li> <a href="<?=base_url('employee/create');?>"> Create New Employee / PDS </a> </li>
                             <li> <a href="<?=base_url('employee/all');?>"> Employee / PDS List </a> </li>


                             <li> <a href="<?=base_url('employee/all2');?>">Professional Employee/PDS List </a> </li>
                             <li> <a href="<?=base_url('employee/deactive');?>"> Deactive Employee List</a> </li>
                             <li> <a href="<?=base_url('employee/emp_id_card_expiry');?>"> Employee ID Card Expiry Date</a> </li>

                          </ul>
                       </li>
                       <?php } ?>

                       <?php //if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ ?>
                        <!-- <li class="start <?=backend_activate_menu_class('pds')?>">
                           <a href="javascript:;" > <i class="fa fa-user"></i> <span class="title">PDS</span> <span class="selected"></span> <span class="arrow"></span> </a>
                           <ul class="sub-menu">
                              <li> <a href="<?=base_url('pds/add');?>">Add PDS </a> </li>
                              <li> <a href="<?=base_url('pds/pds_list');?>">PDS List </a> </li>
                           </ul>
                        </li> -->
                        <?php //} ?>

                        <?php
                        /*
                        if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ ?>

                        <li class="start <?=backend_activate_menu_class('e_nathi')?>"> <a href="javascript:;" > <i class="fa fa-folder"></i> <span class="title">Nothi List</span> <span class="selected"></span> <span class="arrow"></span> </a>
                           <ul class="sub-menu">

                              <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ ?>
                              <li> <a href="<?=base_url('e_nathi/nathi_process');?>"> Processing Nothi List</a> </li>
                              <?php } ?>

                           </ul>
                        </li>
                        <?php } */ ?>

                        <?php if($this->ion_auth->is_employee()){ ?>

                        <li class="start <?=backend_activate_menu_class('e_nathi')?>"> <a href="javascript:;" > <i class="fa fa-folder"></i> <span class="title">নথি তালিকা</span> <span class="selected"></span> <span class="arrow"></span> </a>
                           <ul class="sub-menu">

                              <?php if($this->ion_auth->is_employee()){ ?>
                              <?php if($userDetails['user_info']->desk_officer==1){?>
                              <li> <a href="<?=base_url('e_nathi/nathi_list');?>"> ফোল্ডার আকারে </a> </li>
                              <li> <a href="<?=base_url('e_nathi/nathi_list2');?>"> সকল নথি</a> </li>
                              <!-- <li> <a href="<?=base_url('e_nathi/nathi');?>">নথি তৈরি করুন </a> </li> -->
                              <!-- <li> <a href="<?=base_url('e_nathi/paragraph');?>">নথির অনুচ্ছেদ তৈরি করুন </a> </li> -->
                                      <!-- <li> <a href="<?=base_url('e_nathi/suggestion');?>">নথির প্রস্তাবনা  তৈরি করুন </a> </li>
                                      <li> <a href="<?=base_url('e_nathi/suggestion_list');?>">  নথির প্রস্তাবনা তালিকা </a> </li> -->
                                      <?php } ?>

                                      <li> <a href="<?=base_url('e_nathi/nathi_process');?>"> প্রক্রিয়াধীন  নথি </a> </li>
                                      <?php if($userDetails['user_info']->desk_officer==1){?>
                                      <li> <a href="<?=base_url('e_nathi/nathi_archive');?>"> আর্কাইভ নথি </a> </li>
                                      <?php } ?>
                                      <?php } ?>

                                   </ul>
                                </li>

                             <!-- <li class="start <?=backend_activate_menu_class('e_filing')?>"> <a href="javascript:;" > <i class="fa fa-folder"></i> <span class="title">ই-চিঠি</span> <span class="selected"></span> <span class="arrow"></span> </a>
                                 <ul class="sub-menu">

                                 <?php if($this->ion_auth->is_employee()){ ?>

                                   <li> <a href="<?=base_url('e_filing/file_process');?>"> প্রক্রিয়াকরণ চিঠি তালিকা </a> </li>
                                   <li> <a href="<?=base_url('e_filing/file_copy');?>"> অনুলিপি চিঠি তালিকা </a> </li>
                                   <?php if($userDetails['user_info']->desk_officer==1){?>
                                      <li> <a href="<?=base_url('e_filing/create');?>"> নতুন চিঠি তৈরি করুন </a> </li>
                                      <li> <a href="<?=base_url('e_filing/file_list');?>"> চিঠি তালিকা </a> </li>
                                   <?php } ?>
                                   <li> <a href="<?=base_url('e_filing/file_done');?>"> অনুমোদিত চিঠি তালিকা </a> </li>
                                 <?php } ?>

                                </ul>
                             </li> -->

                              <!-- <li class="start <?=backend_activate_menu_class('demand')?>">
                                 <a href="#"> <i class="fa fa-folder"></i>  <span class="title">ই-চাহিদা</span></a>
                              </li> -->


                            <!--  <?php if($userDetails['user_info']->desk_officer==1){?>
                                 <li class="start <?=backend_activate_menu_class('e_folder')?>"> <a href="javascript:;" > <i class="fa fa-folder"></i> <span class="title">ই-ফোল্ডার</span> <span class="selected"></span> <span class="arrow"></span> </a>
                                    <ul class="sub-menu">

                                      <li> <a href="<?=base_url('e_folder/all');?>"> ফোল্ডার তালিকা </a> </li>
                                      <li> <a href="<?=base_url('e_folder/create');?>"> নতুন ফোল্ডার তৈরি করুন </a> </li>
                                   </ul>
                                </li>
                                <?php } ?> -->
                              <!-- <li class="start <?=backend_activate_menu_class('purchase')?>">
                                 <a href="#"> <i class="fa fa-folder"></i>  <span class="title">ক্রয়ের প্রকিয়া </span></a>
                              </li> -->

                              <?php if($userDetails['user_info']->desk_officer==1){?>
                              <li class="start <?=backend_activate_menu_class('attachment')?>"> <a href="javascript:;" > <i class="fa fa-folder"></i> <span class="title">সাধারণ সংযুক্তি</span> <span class="selected"></span> <span class="arrow"></span> </a>
                                 <ul class="sub-menu">

                                   <li> <a href="<?=base_url('e_attachment/all')?>"> সংযুক্তি তালিকা </a> </li>
                                   <!-- <li> <a href="#"> নতুন সংযুক্তি তৈরি করুন </a> </li> -->
                                </ul>
                             </li>
                             <?php } ?>

                             <li class="start <?=backend_activate_menu_method('change_department')?>">
                              <a href="<?=base_url('my_profile/change_department')?>"><i class="fa fa-home"></i> বিভাগ পরিবর্তন</a>
                           </li>

                           <?php } ?>



                        <?php /* // if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ ?>
                        <li class="start <?=backend_activate_menu_class('award_application')?>">
                           <a href="javascript:;" > <i class="fa fa-user"></i> <span class="title">Award Application</span> <span class="selected"></span> <span class="arrow"></span> </a>
                           <ul class="sub-menu">
                           <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin()){ ?>
                              <li> <a href="<?=base_url('award_application/all_award_request_list');?>">Award Request List </a> </li>

                           <?php }elseif($this->ion_auth->is_scout_member()){ ?>
                              <li> <a href="<?=base_url('award_application/award_request_list');?>"> Award Request List </a> </li>
                           <?php if($userDetails['user_info']->sc_section_id == '1'){ ?>
                              <li> <a href="<?=base_url('award_application/shapla_cub_form');?>"> Shapla Cub Award Form </a> </li>
                           <?php } ?>
                           <?php if($userDetails['user_info']->sc_section_id == '2'){ ?>
                              <li> <a href="<?=base_url('award_application/president_scout_form');?>"> President Scout Award Form</a></li>
                           <?php } ?>
                           <?php if($userDetails['user_info']->sc_section_id == '3'){ ?>
                              <li> <a href="<?=base_url('award_application/president_rover_form');?>"> President Rover Scout Form</a></li>
                           <?php } ?>
                           <!-- <li> <a href="<?=base_url('#');?>"> Social Development Award Form</a></li> -->
                           <?php } ?>
                           </ul>
                        </li>
                        <?php //} */ ?>

                        <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin()){ ?>
                        <li class="start <?=backend_activate_menu_class('edirectory')?>"> <a href="javascript:;" > <i class="fa fa-user"></i> <span class="title">E-Directory Contact</span> <span class="selected"></span> <span class="arrow"></span> </a>
                           <ul class="sub-menu">
                              <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award')){ ?>
                              <li> <a href="<?=base_url('edirectory/listing');?>"> NHQ Directory List </a> </li>
                              <?php } ?>

                              <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award') || $this->ion_auth->is_region_admin()){ ?>
                              <li> <a href="<?=base_url('edirectory/listing_region');?>"> Region Directory List </a> </li>
                              <?php } ?>

                              <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award') || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin()){ ?>
                              <li> <a href="<?= base_url('edirectory/listing_district'); ?>"> District Directory List</a></li>
                              <?php } ?>

                              <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award') || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin()){ ?>
                              <li> <a href="<?= base_url('edirectory/listing_upazila');?>"> Upazila Directory List</a></li>
                              <?php } ?>

                              <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award') || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin()){ ?>
                              <li> <a href="<?=base_url('edirectory/listing_scout_group');?>"> S. Groups Directory List</a></li>
                              <?php } ?>
                              <?php if($this->ion_auth->is_admin() || $this->ion_auth->in_group('award') || $this->ion_auth->is_scout_admin()){ ?>
                              <li> <a href="<?=base_url('edirectory/listing_training_center');?>"> Training Center Directory List </a> </li>
                              <?php } ?>
                              <?php if($this->ion_auth->is_admin() || $this->ion_auth->in_group('award') || $this->ion_auth->is_scout_admin()){ ?>
                              <li> <a href="<?=base_url('edirectory/designation');?>"> Designations </a> </li>
                              <?php } ?>
                           </ul>
                        </li>
                        <?php } ?>


                        <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('event') || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin()){ ?>

                        <li class="start <?=backend_activate_menu_class('event_calendar')?>"> <a href="javascript:;" > <i class="fa fa-user"></i> <span class="title">Event Calendar</span> <span class="selected"></span> <span class="arrow"></span> </a>
                           <ul class="sub-menu">
                              <li> <a href="<?=base_url('event_calendar/index');?>"> Scouts Event </a> </li>
                              <?php if($this->ion_auth->is_admin()){ ?>
                              <li> <a href="<?=base_url('event_calendar/nhq');?>"> NHQ Event </a> </li>
                              <li> <a href="<?=base_url('event_calendar/nstc');?>"> NSTC Event </a> </li>
                              <?php } ?>
                           </ul>
                        </li>
                        <?php } ?>

                        <?php if($this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin()){ ?>
                     <?php /*
                        <!--  <li class="start <?=backend_activate_menu_class('image_gallery')?>">
                     <a href="<?=base_url('image_gallery/index');?>"> <i class="fa fa-user"></i>
                     <span class="title">Image Gallery</span> </a></li> -->
                     */ ?>
                     <?php } ?>

                     <?php if($this->ion_auth->is_admin()){ ?>
                     <li class="start <?=backend_activate_menu_class('e_book')?>">
                        <a href="<?=base_url('e_book');?>"> <i class="fa fa-book"></i>
                           <span class="title">E-book</span>
                        </a>
                     </li>

                     <li class="start <?=backend_activate_menu_class('scout_news')?>">
                        <a href="<?=base_url('scout_news/index');?>"> <i class="fa fa-user"></i>
                           <span class="title">Scout News</span>
                        </a>
                     </li>
                     <li class="start <?=backend_activate_menu_class('slider')?>">
                        <a href="<?=base_url('slider');?>"> <i class="fa fa-user"></i>
                           <span class="title">Slider</span>
                        </a>
                     </li>
                     <?php } ?>


                     <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin()){  ?>
                     <li class="start <?=backend_activate_menu_class('committee')?>"> <a href="javascript:;" > <i class="fa fa-user"></i> <span class="title">Committee Setup</span> <span class="selected"></span> <span class="arrow"></span> </a>
                        <ul class="sub-menu">
                           <?php //if($this->ion_auth->is_admin()){ ?>
                           <li> <a href="<?=base_url('committee/national');?>"> National Committee </a> </li>
                           <?php //} ?>
                           <?php //if($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin()){ ?>
                           <li> <a href="<?=base_url('committee/region');?>"> Region Committee </a> </li>
                           <?php //} ?>
                           <?php //if($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin()){ ?>
                           <li> <a href="<?=base_url('committee/district'); ?>"> District Committee</a></li>
                           <?php //} ?>
                           <?php //if($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin()){ ?>
                           <li> <a href="<?=base_url('committee/upazila');?>"> Upazila Committee</a></li>
                           <?php //} ?>
                           <?php //if($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin()){ ?>
                           <li> <a href="<?=base_url('committee/scout_group');?>"> Group Committee</a></li>
                           <?php //} ?>
                        </ul>
                     </li>
                     <?php } ?>


                     <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() ||
                     $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin()){ ?>
                     <li class="start <?=backend_activate_menu_class('services')?>">
                        <a href="javascript:;" > <i class="fa fa-user"></i> <span class="title">Service Request</span> <span class="selected"></span> <span class="arrow"></span> </a>
                        <ul class="sub-menu">
                           <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin()){ ?>
                           <li> <a href="<?=base_url('services/request_list');?>">Request List </a> </li>
                           <li> <a href="<?=base_url('services/assign_to_list');?>">Assign To List </a> </li>
                           <li> <a href="<?=base_url('services/task_assign_list');?>">Task Assign List </a> </li>
                           <li> <a href="<?=base_url('services/on_process_list');?>">On Process List </a> </li>
                           <li> <a href="<?=base_url('services/complete_list');?>">Complete List </a> </li>
                           <li> <a href="<?=base_url('services/cancel_list');?>">Cancel List </a> </li>
                           <?php }elseif($this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin()){ ?>

                           <li> <a href="<?=base_url('services/task_assign_list');?>">Task Assign List </a> </li>
                           <?php } ?>
                        </ul>
                     </li>
                     <?php } ?>


                     <?php if($this->ion_auth->is_admin()){ ?>
                     <li class="start <?=backend_activate_menu_class('complain')?>">
                        <a href="<?=base_url('complain/complain_list');?>"> <i class="fa fa-user"></i>
                           <span class="title">Feedback or Complain</span>
                        </a>
                     </li>
                     <?php } ?>


                     <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() ||
                     $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin()){ ?>
                     <li class="start <?=backend_activate_menu_class('scout_group_application')?>">
                        <a href="<?=base_url('scout_group_application/application_list');?>"> <i class="fa fa-user"></i> <span class="title">Scout Group Application</span></a>
                     </li>
                     <?php } ?>

                     <?php if($this->ion_auth->is_admin()){ ?>
                     <li class="start <?=backend_activate_menu_class('reports')?>"> <a href="javascript:;" > <i class="fa fa-user"></i> <span class="title">Reports</span> <span class="selected"></span> <span class="arrow"></span> </a>
                        <ul class="sub-menu">
                           <li> <a href="<?=base_url('reports/scouts_member');?>"> Scout Member List</a></li>
                              <?php /*
                              <li> <a href="<?=base_url('reports/scouts_regional');?>"> Regional Offices</a></li>
                              <li> <a href="<?=base_url('reports/scouts_district_offices');?>"> District Offices</a></li>
                              <li> <a href="<?=base_url('reports/scouts_upozila');?>"> Upozila Offices</a></li>
                              <li> <a href="<?=base_url('reports/scouts_groups');?>"> Scout Groups</a></li>
                              <li> <a href="<?=base_url('reports/scouts_units');?>"> Scout Units</a></li>
                              <!-- <li> <a href="<?=base_url('reports/national');?>"> National Committee </a> </li>
                              <li> <a href="<?=base_url('reports/region');?>"> Region Committee </a> </li>
                              <li> <a href="<?=base_url('reports/district'); ?>"> District Committee</a></li>
                              <li> <a href="<?=base_url('reports/upazila');?>"> Upazila Committee</a></li>
                              <li> <a href="<?=base_url('reports/scout_group');?>"> Group Committee</a></li> -->
                              <li> <a href="<?=base_url('reports/member_statics');?>"> Scout Member Statistics</a></li>
                              <li> <a href="<?=base_url('reports/section_wise_report');?>"> Section Wise Report</a></li>
                              <li> <a href="<?=base_url('reports/unit_report');?>"> Unit Report</a></li>
                              <!-- <li> <a href="<?=base_url('reports/training_list');?>"> Training Report</a></li> -->
                              <!-- <li> <a href="<?=base_url('reports/event_list');?>"> Event Report</a></li> -->
                              */ ?>
                           </ul>
                        </li>
                        <?php } ?>

                        <?php if($this->ion_auth->is_admin()){ ?>
                        <li class="start <?=backend_activate_menu_class('general_setting')?>"> <a href="javascript:;" > <i class="fa fa-user"></i> <span class="title">General Setting</span> <span class="selected"></span> <span class="arrow"></span> </a>
                           <ul class="sub-menu">
                              <li> <a href="<?=base_url('general_setting/division');?>"> Division</a></li>
                              <li> <a href="<?=base_url('general_setting/district');?>"> District</a></li>
                              <li> <a href="<?=base_url('general_setting/upazila_thana');?>"> Upazila/Thana </a></li>
                              <!-- <li> <a href="<?=base_url('general_setting/post_office');?>"> Post Office Code</a> </li> -->
                              <li> <a href="<?=base_url('general_setting/institute');?>"> Institute </a> </li>
                              <li> <a href="<?=base_url('general_setting/occupation');?>"> Occupation </a></li>
                              <li> <a href="<?=base_url('general_setting/department');?>"> Department </a></li>
                              <li> <a href="<?=base_url('general_setting/committee_type');?>"> Committee Type </a></li>
                              <li> <a href="<?=base_url('general_setting/designation');?>"> Designation </a></li>
                              <li> <a href="<?=base_url('general_setting/committee_designation');?>"> Committee Designation </a></li>
                              <!-- <li> <a href="<?=base_url('general_setting/committee_designation');?>"> Committee Designation </a></li> -->
                              <li> <a href="<?=base_url('general_setting/badge_type');?>"> Badge Type </a></li>
                              <li> <a href="<?=base_url('general_setting/role_type');?>"> Role Type </a></li>
                              <li> <a href="<?=base_url('general_setting/scout_badge');?>"> Scout Badge </a></li>
                              <li> <a href="<?=base_url('general_setting/scout_role');?>"> Scout Role </a></li>
                              <li> <a href="<?=base_url('general_setting/scout_badge_question');?>"> Scout Badge Question </a></li>
                              <li> <a href="<?=base_url('general_setting/scout_expertness_group');?>"> Scout Expertness Group </a></li>
                              <li> <a href="<?=base_url('general_setting/proficiency_badge');?>"> Proficiency Badge </a></li>
                              <li> <a href="<?=base_url('general_setting/proficiency_badge_group');?>"> Proficiency Badge Group </a></li>
                              <li> <a href="<?=base_url('general_setting/progress_course');?>"> Progress Course </a></li>
                           </ul>
                        </li>

                        <li class="start <?=backend_activate_menu_class('acl')?>"> <a href="javascript:;" > <i class="fa fa-user"></i> <span class="title">Access Control</span> <span class="selected"></span> <span class="arrow"></span> </a>
                           <ul class="sub-menu">
                              <li> <a href="<?=base_url('acl');?>"> User List </a> </li>
                              <!-- <li> <a href="<?=base_url('acl/task_register');?>"> Task Register </a> </li> -->
                              <li> <a href="<?=base_url('acl/group_name');?>"> Group Name</a></li>
                              <?php /*
                              <!-- <li> <a href="<?=base_url('acl/access_level');?>"> Access Level</a> </li> -->
                              <!-- <li> <a href="<?=base_url('acl/role_group');?>"> Role Group</a></li> -->
                              <!-- <li> <a href="<?=base_url('acl/group_type');?>"> Group Type</a></li> -->
                              */?>
                           </ul>
                        </li>

                        <li class="start <?=backend_activate_menu_class('activity_logs')?>">
                           <a href="<?=base_url('activity_logs');?>"> <i class="icon-custom-home"></i>  <span class="title">Activity Logs</span></a>
                        </li>

                        <?php if($this->officeSess){ ?>
                        <li class="start"><a target="_blank" href="<?=base_url('user_manual/user-manual-scout-office-management-version-1.pdf')?>">  <i class="fa fa-list-alt"></i> <span class="title">User Manual</span> </a></li>
                        <?php } //end of outher user role?>

                        <?php } ?>
                        <?php } ?>
                        <?php } ?>

                        <li class="start"><a href="<?=base_url('logout')?>"> <i class="fa fa-power-off"></i> <span class="title">Log Out</span> </a></li>
                     </ul>
                     <div class="clearfix"></div>
                     <!-- END SIDEBAR MENU -->
                  </div>

                  <!-- </div> -->

                  <?php if($this->router->fetch_class('my_message') == 'my_message'){ ?>
                  <div class="inner-menu nav-collapse" style="float: right;">
                     <div class="inner-wrapper" style="margin-bottom: 10px;">
                        <a href="javascript:void();" class="btn btn-block btn-primary" ><span class="bold">COMPOSE</span></a>
                     </div>
                     <ul class="big-items">
                        <li class="active"><span class="badge badge-important">2</span><a href="javascript:void();" > Inbox</a></li>
                        <li><a href="javascript:void();">Sent</a></li>
                        <li><a href="javascript:void();">Draft</a></li>
                        <li><a href="javascript:void();">Trash</a></li>
                     </ul>
                     <ul class="small-items" style="margin-bottom: 0px;">
                        <li class=""><a href="#" > Home</a></li>
                        <li><span class="badge badge-important">2</span><a href="#"> Work</a></li>
                     </ul>
                     <div class="inner-wrapper" style="margin-top: 5px;">
                        <p class="menu-title">QUICK VIEW</p>
                     </div>
                     <ul class="small-items" style="margin-bottom: 0px;">
                        <li class=""><a href="#"> Documents</a></li>
                        <li class=""><span class=" badge badge-disable ">203</span><a href="#"> Images</a></li>
                     </ul>
                  </div>
                  <?php } ?>

               </div>

               <a href="#" class="scrollup">Scroll</a>

               <div class="footer-widget">
                  <div class="copyrights pull-left" style="width: 50%" >
                     <span> <span style="vertical-align: bottom; font-size: 10px;">কারিগরি সহায়তায় |</span>  <a href="http://a2i.pmo.gov.bd/" target="_blank">
                     <img src="<?php echo base_url('fwedget/assets/images/logo_ict.png')?>" height="10"> </a> </span>
                  </div>
                  <div class="copyrights pull-right" style="width: 50%">
                     <span style=" float: right;"> <span style="vertical-align: bottom; font-size: 11px;">Developed By |</span> <a href="http://www.mysoftheaven.com/" target="_blank">
                     <img src="<?php echo base_url('awedget/assets/img/mysoft-logo.png')?>" height="18"></a> </span>
                  </div>

                  <?php /*
                  <!-- <div class="lock">
                  <a href="<?=base_url('login/logout')?>"><i class="fa fa-power-off"></i></a>
                  </div> -->
                  */ ?>
               </div>
               <!-- END SIDEBAR -->

               <script type="text/javascript">
               <?php /*
               // function switch_user(gid)
               // {
               //   $.ajax({
               //     type: "POST",
               //     url: "<?php echo base_url('dashboard/switch_user'); ?>",
               //     data: { gid : gid },
               //     success: function(data)
               //     {
               //       if(data == 1)
               //         window.location = "<?php echo base_url('dashboard'); ?>"
               //     }
               //   });
               // }
               */ ?>
            </script>
