<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url('slider')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
       <div class="col-md-12">
          <div class="grid simple horizontal red">
             <div class="grid-title">
              <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>              
              <div class="pull-right">
                <a href="<?=base_url('slider/create')?>" class="btn btn-blueviolet btn-xs btn-mini"> Add Slider</a>
                <a href="<?=base_url('slider')?>" class="btn btn-blueviolet btn-xs btn-mini"> Slider List</a> 
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
                  $attributes = array('id' => 'validate');
                  echo form_open_multipart("slider/edit/".$info->id, $attributes);
              ?>

              <div class="row">
                <div class="col-md-12">

                  <div class="row form-row">
                    <div class="col-md-6">
                      <label class="form-label">Slider Title <span class="required">*</span></label>
                      <?php echo form_error('title'); ?>
                      <input name="title" type="text" class="form-control input-sm" value="<?=set_value('title',$info->title)?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Status</label>
                        <?php echo form_error('status'); ?>
                        <input type="radio" name="status" class="group_control" value="1" <?=set_value('status', $info->status)==1?'checked':'';?>> Enable &nbsp;&nbsp;
                        <input type="radio" name="status" class="group_control" value="0" <?=set_value('status', $info->status)==0?'checked':'';?>> Disable
                     </div>
                  </div>

                  <div class="row form-row">
                    <div class="col-md-6">
                      <label>Image Upload</label>
                      <div><?php echo form_error('userfile'); ?></div>
                      <input type="file" name="userfile">                  
                      <p class="help-block">File type jpg, png, jpeg and maximun file size 1 MB. <br> Image Width: 968px and Height: 244px</p>
                      <?php 
                      $img_path = base_url().'slider_img/';
                      if($info->image_file != NULL){
                        $src= $img_path.$info->image_file;
                        echo "<img src='$src' height='150'>";
                      }
                      ?>
                    </div>
                  </div>

                </div>

              </div>

            <div class="form-actions">  
              <div class="pull-right">
                <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Save</button>
                <!-- <button type="button" class="btn btn-white btn-cons">Cancel</button> -->
              </div>
            </div>
          <?php echo form_close();?>

          </div>  <!-- END GRID BODY -->              
        </div> <!-- END GRID -->
      </div>

    </div> <!-- END ROW -->

  </div>
</div>
<script type="text/javascript">
   $(document).ready(function() {
      $('#validate').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
         title: {
            required: true
         },         
         userfile: {
            required: false
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