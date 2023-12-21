<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url('e_book')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
     <div class="col-md-12">
      <div class="grid simple horizontal red">
       <div class="grid-title">
        <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>              
        <div class="pull-right">
          <a href="<?=base_url('e_book')?>" class="btn btn-blueviolet btn-xs btn-mini"> E-Book List</a> 
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

        <?php if($message != NULL):?>
          <div class="alert alert-danger">                      
            <?php echo $message;?>
          </div>
        <?php endif; ?>

        <?php 
        $attributes = array('id' => 'validate');
        echo form_open_multipart(uri_string(), $attributes);
        ?>

        <div class="row">
          <div class="col-md-8">
            <div class="row form-row">              
              <div class="col-md-12">
                <label>PDF Book Upload <span class="required">*</span></label>
                <div><?php echo form_error('userfile'); ?></div>
                <input type="file" name="userfile">
                <p class="help-block">
                  <ul>
                    <li>File type only PDF allowed</li>
                    <li>File size maximum 20 MB</li>
                  </ul>
                </p>
              </div>                    

            </div>
          </div>

        </div>

        <div class="form-actions">  
          <div class="pull-right">
            <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Upload</button>
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
        userfile: { required: true, extension: "pdf" }
      },
      messages: {
        userfile:{
          required:"This field is required.",                  
          extension:"Select only PDF file format"
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