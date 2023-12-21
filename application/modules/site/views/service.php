<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-xs-12">
  <div class="row">
    <?php 
    if(!empty($service_list)){

      $i=0;
      foreach ($service_list as $item) {
        $i=$i+1;
        ?>
        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12 text-center pb-4">
          <a href="<?=base_url()?><?php if($item->service_name=='Blood Donation'){ echo 'blood-donation';}else{echo 'services-request';} ?>/<?=$item->id?>" class="card-link">
            <div class="sc_animate">
              <div class="sc_box" style="background-color: #5bba5b;">
                <div class="title-icon pt-<?php if($i==2 OR $i==5 OR $i==8){echo 3;}else{ echo 3;}?>">
                  <!-- <i class="fa <?=$item->icon?> fa-4x"></i> -->
                  <img src="<?=base_url('/fwedget/assets/images/service_image/'.$item->image_icon)?>" width="100" style="">
                </div>
                <?php
                if($this->session->userdata('site_lang') == 'english' ){
                  $service_name = $item->service_name;
                }else{
                  $service_name = $item->service_name_bn;
                }
                ?>
                <h5 class="pb-4 font-weight-bold" style="color: white;margin-top: 10px;"><?=$service_name?></h5>
              </div>
            </div>
          </a>
        </div>

        <?php
      }
    }
    ?>

    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12 text-center pb-4">
    <a href="<?=base_url('edirectory')?>" class="card-link">
        <div class="sc_animate">
          <div class="sc_box" style="background-color: #5bba5b;">
            <div class="title-icon pt-3">
              <img src="<?=base_url('/fwedget/assets/images/edirectory.png')?>" width="100" style="">
            </div>
            <?php
            if($this->session->userdata('site_lang') == 'english' ){
              $EDirectroy = 'E-Directroy';
            }else{
              $EDirectroy = 'ই-ডিরেক্টরি';
            }
            ?>
            <h5 class="pb-4 font-weight-bold" style="color: white;margin-top: 10px;"><?=$EDirectroy?></h5>
          </div>
        </div>
      </a>
    </div>
  </div><!-- sub row -->
  
</div>




