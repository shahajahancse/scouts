<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title><?=lang('site_meta_title')?></title>
   <link rel="icon" type="image/ico" href="<?=base_url();?>awedget/assets/img/favicon.ico"/>
   <link rel="stylesheet" type="text/css" href="<?=base_url();?>fwedget/assets/bootstrap-4.0.0-alpha.6/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css">
   <link href="<?=base_url();?>fwedget/assets/bootstrap-gallery/grid/gallery-grid.css" rel="stylesheet" type="text/css"/>
   <link rel="stylesheet" type="text/css" href="<?=base_url();?>fwedget/assets/css/style.css">

   <!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script> -->
   <!-- <script src="<?=base_url();?>fwedget/assets/plugins/jquery-3.3.1.min.js" type="text/javascript"></script> -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>

   <div id="fb-root"></div>
   <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v4.0"></script>

   <div class="sc_main_container" style="font-family: 'Kalpurush';">

      <div class="sc_header">
         <div class="container w-75">
            <div class="d-flex justify-content-end">
               <div class="mr-auto p-2 text-white font-weight-bold d-none d-sm-block"><?=$this->lang->line('site_title');?></div>
               <?php if($this->session->userdata('site_lang') == 'english' ){ ?>
               <div class="p-2 text-white"><a href="<?=base_url()?>switchlang/bangla" class="badge badge-warning text-white card-link py-2 px-2" style="border-radius: 0;">Bangla</a></div>
               <?php }else{ ?> 
               <div class="p-2 text-white"><a href="<?=base_url()?>switchlang/english" class="badge badge-warning text-white card-link py-2 px-2" style="border-radius: 0;">English</a></div>
               <?php } ?>

               <?php if (!$this->ion_auth->logged_in()): ?>
                  <div class="p-2"><span class="badge badge-success py-2 px-2" style="border-radius: 0;"><a href="<?=base_url('login')?>" class="text-white card-link" target="_blank"><?=lang('site_common_login')?></a></span></div>
                  <div class="p-2"><span class="badge badge-success  py-2 px-2" style="border-radius: 0;"><a href="<?=base_url('registration')?>" class="text-white card-link" target="_blank"><?=lang('site_common_register')?></a></span></div>

               <?php else: ?>
                  <span style="margin-top: 10px;color: #fff">
                     <?php if($this->session->userdata('site_lang') == 'english' ){ ?>
                     <a style="color: #fff;text-decoration: none;" href="<?=base_url('dashboard')?>">Login as <?php echo $this->session->userdata("first_name"); ?></a>
                     <?php } else { ?>
                     <a style="color: #fff;text-decoration: none;" href="<?=base_url('dashboard')?>"> লগইন আছেন <?php echo $this->session->userdata("full_name_bn"); ?></a>
                     <?php } ?>
                  </span>
               <?php endif; ?>
               <!-- <div class="p-2"><span class="badge badge-success badge-pill py-2 px-2">English</span></div> -->
            </div>
         </div>
      </div>

      <div class="container bg-faded w-75">
         <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12 pt-3"><a href="<?=base_url();?>"><img src="<?=base_url();?>fwedget/assets/images/scout_logo.png" class="img-fluid"></a>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-xs-12">
               <div class="d-flex justify-content-end text-white">
                  <div class="p  shape"></div>
                  <div class="p-2 px-3 badge-success" style="border-right: 1px solid #ffffff; "> <a href="<?=base_url()?>region" class="text-white card-link"><?=lang('site_common_region')?> <span class="h3">
                     <?php
                     if($this->session->userdata('site_lang') == 'english' ){
                        echo BanglaConverter::bn2en($region);
                     }else{
                        echo BanglaConverter::en2bn($region);
                     }
                     ?>
                  </span></a></div>
                  <div class="p-2 px-3 badge-success" style="border-right: 1px solid #ffffff"><a href="<?=base_url()?>district" class="text-white card-link"><?=lang('site_common_district')?> <span class="h3">
                     <?php
                     if($this->session->userdata('site_lang') == 'english' ){
                        echo BanglaConverter::bn2en($district1);
                     }else{
                        echo BanglaConverter::en2bn($district1);
                     }
                     ?>
                  </span></a></div>
                  <div class="p-2 px-3 badge-success" style="border-right: 1px solid #ffffff"><a href="<?=base_url()?>upazila" class="text-white card-link"><?=lang('site_common_upazila')?> <span class="h3">
                     <?php
                     if($this->session->userdata('site_lang') == 'english' ){
                        echo BanglaConverter::bn2en($upazila);
                     }else{
                        echo BanglaConverter::en2bn($upazila);
                     }
                     ?>
                  </span></a></div>
                  <div class="p-2 px-3 badge-success" style="border-right: 1px solid #ffffff"><a href="<?=base_url()?>groups" class="text-white card-link"><?=lang('site_common_group')?> <span class="h3">
                     <?php
                     if($this->session->userdata('site_lang') == 'english' ){
                        echo BanglaConverter::bn2en($groups);
                     }else{
                        echo BanglaConverter::en2bn($groups);
                     }
                     ?></span></a></div>
                     <div class="p-2 px-3 badge-success" ><a href="<?=base_url()?>unit" class="text-white card-link"><?=lang('site_common_unit')?> <span class="h3">
                        <?php
                        if($this->session->userdata('site_lang') == 'english' ){
                           echo BanglaConverter::bn2en($unit);
                        }else{
                           echo BanglaConverter::en2bn($unit);
                        }
                        ?>
                     </span></a> </div>
                  </div>




                  <!-- <form action="<?=base_url()?>search" method="get" style="border:1px solid red; overflow: hidden;" >
                     <div class="d-flex justify-content-around text-white pull-right py-2">
                        <div class="form-group" style="margin-right: 10px;">
                           <a href="<?=base_url()?>" class="btn text-white btn-block" style="background-color: #4cb865;border-radius:0px;"><?=lang('site_common_home')?></a>   
                        </div> 
                        <div class="form-group">
                           <?php 
                           $css=array(
                              'class' =>'form-control',
                              'id'  =>'region2',
                              'style'=>'width:100%; border-radius:0px; margin-right:10px;',
                              'required'=>'required'
                              );
                           $region_data=isset($_GET['region'])?$_GET['region']:'';
                           echo form_dropdown('region', $regions, $region_data ,$css) 
                           ?>
                        </div>

                        <?php if(isset($_GET['district'])){
                           $css=array(
                              'class' =>'form-control sc_district_val2',
                              'style'=>'width:244px; border-radius:0px; margin-right:10px',
                              'required'=>''
                              );
                           $district_data=isset($_GET['district'])?$_GET['district']:'';
                           echo form_dropdown('district', $district, $district_data ,$css);
                        }else{ ?> 
                        <div class="form-group">
                           <select name="district" class="sc_district_val2 form-control input-sm" style="width:100%; border-radius:0px; margin-right:10px;">
                              <option value=""> <?=lang('site_select_scout_district')?></option>
                           </select>
                        </div>
                        <?php } ?>
                        <div class="form-group">
                           <button type="submit" class="btn text-white btn-block" style="background-color: #1aa326;border-radius:0px;"><?=lang('site_common_go')?></button>   
                        </div>
                     </div>
                  </form> -->

               </div>
            </div>

            <div class="row news_notice">
               <div class="col-xl-2 col-lg-1 col-md-1 col-sm-3 col-xs-1">
                  <a href="<?=base_url()?>" class="btn text-white btn-sm btn-block" style="background-color: #4cb865;border-radius:0px;"><?=lang('site_common_home')?></a>
               </div>
               <div class="col-xl-7 col-lg-8 col-md-6 col-sm-6 col-xs-1" style="border:1px solid #ccc;">
                  <span style="float: left; margin-right: 10px;"><?=lang('site_common_news')?>: </span>
                  <div id="example">
                     <ul style="border:0px solid red">
                        <?php foreach ($latest_news as $row) { ?>                           
                        <li><a href="<?=base_url('scout-news-details/'.$row->id)?>"><?=$row->news_title?></a></li>
                        <?php } ?>
                     </ul>
                  </div>
               </div>
               <div class="col-xl-3 col-lg-1 col-md-3 col-sm-3 col-xs-1">
                  <a href="<?=base_url('scout-events')?>" class="btn text-white btn-sm float-right ml-3" style="background-color: #4cb865;border-radius:0px;"><?=lang('site_common_events')?></a>
                  <a href="<?=base_url('scout-news')?>" class="btn text-white btn-sm float-right" style="background-color: #4cb865;border-radius:0px;"><?=lang('site_common_all_news')?></a>
               </div>
            </div>
         </div>

         <div class="container w-75">
               <div class="row secondary_sc_content px-2 py-4">  
            <!-- <div class=" px-4 py-4"> -->

