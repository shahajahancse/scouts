<style type="text/css">
  select.form-control:not([size]):not([multiple]) {
    border-color: #904097 !important;
    border-radius: 0px !important;
  }
  <?php 
  //$lan=$this->session->userdata('site_lang')=='bangla'?'unit_name_bn':'unit_name';
  $region_data=isset($_GET['region'])?$_GET['region']:'';
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

              <?php if(!empty($results)){ ?>

                <?php 
                foreach ($results as $row) { 
                  // Profile Image
                  if($row->scout_id != NULL){
                    $img_url = '<img src="'.base_url('profile_img/'.$row->profile_img).'" height="70" width="70">';
                  }elseif($row->image_file != NULL){
                    $img_url = '<img src="'.base_url('uploads/edirectory_img/'.$row->image_file).'" height="70" width="70">';
                  }else{
                    $img_url = '<img src="'.base_url('uploads/edirectory_img/no-image.jpg').'" height="70" width="70">';
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

