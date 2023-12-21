<style type="text/css">
  select.form-control:not([size]):not([multiple]) {
    border-color: #904097 !important;
    border-radius: 0px !important;
  }
  <?php 
  $lan=$this->session->userdata('site_lang')=='bangla'?'unit_name_bn':'unit_name';
  $region_data=isset($_GET['unRegion'])?$_GET['unRegion']:'';
  $district_data=isset($_GET['unDistrict'])?$_GET['unDistrict']:'';  
  $upazila_data=isset($_GET['unUpazila'])?$_GET['unUpazila']:'';
  ?>
</style>
<div class="container w-75">
  <div class="secondary_sc_content">
    <p class="lead font-weight-bold py-2 text-white" style="background-color: #1aa326; padding-left:10px"><?=$meta_title?></p>

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
                      echo form_dropdown('unRegion', $regions, $region_data, $css) 
                      ?>
                    </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center">
                    <div class="form-group">
                      <?php 
                      $css=array( 'class' =>'sc_district_val form-control input-sm', 'id'=>'sc_district2');
                      echo form_dropdown('unDistrict', $districts, $district_data, $css) 
                      ?>
                    </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center">
                    <div class="form-group">
                      <?php 
                      $css=array( 'class' =>'sc_upazila_val2 form-control input-sm');
                      echo form_dropdown('unUpazila', $upazilas, $upazila_data, $css) 
                      ?>
                    </div>
                  </div>
                </div>

                <div class="row form-row">
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center">
                    <div class="form-group">
                      <select name="unGroup" class="sc_groups_val2 form-control input-sm">
                        <option value=""><?=lang('site_select_scout_group')?></option>
                      </select>
                    </div>
                  </div>
                  <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 text-center">
                    <div class="form-group">
                      <button type="submit" class="btn text-white btn-block" style="background-color: #1aa326;border-radius:0px;"><?=lang('site_common_go')?></button> 
                    </div>
                  </div>
                </div>
              </form>

              <table class="table table-bordered">

                <tbody>
                  <?php if(!empty($info)){
                    $i=$pagination['current_page'];
                    foreach ($info as $row) { ?>
                    <tr>
                      <td width="5%"><?=$this->session->userdata('site_lang')=='bangla'?BanglaConverter::en2bn(++$i):BanglaConverter::bn2en(++$i);?></td>
                      <td><a href="<?=base_url()?>unit-details/<?=$row->id?>" style="color:#000;"><?=$row->$lan?></a></td>
                    </tr>
                    <?php } } ?>
                    <tr>
                      <td colspan="2">
                        <div class="row">
                          <div class="col-sm-4 col-md-4 text-left" > <?=lang('total')?> <span style="color: green; font-weight: bold;">
                            <?=$this->session->userdata('site_lang')=='bangla'?BanglaConverter::en2bn($total_rows):BanglaConverter::bn2en($total_rows);?> <?=lang('site_common_unit')?> </span>
                          </div>
                          <div class="col-sm-8 col-md-8 text-right">
                            <?php echo $pagination['links']; ?>
                          </div>
                        </div>
                      </td>
                    </tr>
                    
                  </tbody>
                </table>
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
        unRegion: {
          required: true
        },
        unDistrict: {
          required: true
        },
        unGroup: {
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

