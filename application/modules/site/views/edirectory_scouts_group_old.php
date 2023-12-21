<style type="text/css">
  select.form-control:not([size]):not([multiple]) {
    border-color: #904097 !important;
    border-radius: 0px !important;
  }
  <?php 
  //$lan=$this->session->userdata('site_lang')=='bangla'?'unit_name_bn':'unit_name';
  $region_data=isset($_GET['region'])?$_GET['region']:'';
  $district_data=isset($_GET['district'])?$_GET['district']:'';  
  $upazila_data=isset($_GET['upazila'])?$_GET['upazila']:'';
  $designations_data=isset($_GET['designation'])?$_GET['designation']:'';
  ?>
</style>
<div class="container w-75">
  <div class="secondary_sc_content">
    <p class="lead font-weight-bold py-2 text-white" style="background-color: #1aa326; padding-left:10px; overflow: hidden;"><span style="float: left;"><?=$meta_title?></span>
    <span style="float: right; margin-right: 10px;"><a href="<?=base_url('edirectory')?>" class="btn btn-warning btn-xs"> Back </a></span>
    </p>

    <div class="container">

      <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">

          <div class="container">
            <div class="row">
              <form action="" method="get" id="validation">

                <div class="row form-row">
                  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center">
                    <div class="form-group">
                      <?php 
                      $css=array( 'class' =>'form-control input-sm', 'id' =>'region' );
                      echo form_dropdown('region', $regions, $region_data, $css) 
                      ?>
                    </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center">
                    <div class="form-group">
                      <?php 
                      $css=array( 'class' =>'sc_district_val form-control input-sm', 'id'=>'sc_district2');
                      echo form_dropdown('district', $districts, $district_data, $css) 
                      ?>
                    </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center">
                    <div class="form-group">
                      <?php 
                      $css=array( 'class' =>'sc_upazila_val2 form-control input-sm');
                      echo form_dropdown('upazila', $upazilas, $upazila_data, $css) 
                      ?>
                    </div>
                  </div>
                </div>

                <div class="row form-row">
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center">
                    <div class="form-group">
                      <select name="group" class="sc_groups_val2 form-control input-sm">
                        <option value=""><?=lang('site_select_scout_group')?></option>
                      </select>
                    </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center">
                    <div class="form-group">
                      <?php 
                      $css=array( 'class' =>'form-control input-sm');
                      echo form_dropdown('designation', $designations, $designations_data, $css) 
                      ?>
                    </div>
                  </div>

                  <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 text-center">
                    <div class="form-group">
                      <button type="submit" class="btn text-white btn-block" style="background-color: #1aa326;border-radius:0px;"><?=lang('site_common_go')?></button> 
                    </div>
                  </div>
                  
                </div>
              </form>


              <?php if(!empty($results)){ ?>

                <?php 
                foreach ($results as $row) { 
                  // Profile Image
                  if($row->scout_id != NULL){
                    $img_url = '<img src="'.base_url('profile_img/'.$row->profile_img).'" height="80" width="80">';
                  }elseif($row->image_file != NULL){
                    $img_url = '<img src="'.base_url('uploads/edirectory_img/'.$row->image_file).'" height="80" width="80">';
                  }else{
                    $img_url = '<img src="'.base_url('uploads/edirectory_img/no-image.jpg').'" height="80" width="80">';
                  }
                  ?>
                  <div class="col-md-6">
                    <div class="row single_search" >
                      <div class="col-md-4">
                        <?=$img_url?>
                        <a href="<?=base_url('edirectory-details/'.$row->id)?>" style="margin-left: 20px;">Details</a>
                      </div>
                      <div class="col-md-8">
                        <h6><b><?=$row->name?></b></h6>
                        <?=$row->phone;?><br>
                        <?=$row->committee_designation_name_en?></br> 
                      </div>
                    </div>
                  </div>
                  <?php } ?>

                <?php } ?>
                <div class="pt-3"></div>
              </div>
            </div>

          </div> 
        </div>
      </div><!-- main row -->


    </div>
  </div>

  <script type="text/javascript">
    $(document).ready(function() {
      $('#validation').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
        region: {
          required: true
        },
        district: {
          required: true
        },
        group: {
          required: true
        },
        designation: {
          required: true
        }
      },

      invalidHandler: function (event, validator) {
      //display error alert on form submit    
    },

      errorPlacement: function (label, element) { // render error placement for each input type   
       $('<span class="error"></span>').insertAfter(element).append(label)
       var parent = $(element).parent('.input-with-icon');
       parent.removeClass('success-control').addClass('error-control');
     },

      highlight: function (element) { // hightlight error inputs
       var parent = $(element).parent();
       parent.removeClass('success-control').addClass('error-control'); 
     },

      unhighlight: function (element) { // revert the change done by hightlight

      },

      success: function (label, element) {
       var parent = $(element).parent('.input-with-icon');
       parent.removeClass('error-control').addClass('success-control'); 
     },

     submitHandler: function (form) {
       form.submit(); 
     }
   });
    });   
  </script>

