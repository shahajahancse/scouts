<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url('scouts_member')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
     <div class="col-md-12">
      <div class="grid simple horizontal red">
       <div class="grid-title">
        <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>              
        <div class="pull-right">
          <a href="<?=base_url('scout_news/create_news')?>" class="btn btn-blueviolet btn-xs btn-mini"> Create News </a>
          <a href="<?=base_url('scout_news/news_list')?>" class="btn btn-blueviolet btn-xs btn-mini"> News List</a> 
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
        $attributes = array('id' => 'news_validate');
        echo form_open_multipart("scout_news/edit/".$info->id, $attributes);
        ?>

        <div class="row">
          <div class="col-md-8">
            <div class="row form-row">
              <div class="col-md-10">
                <label class="form-label">Event Title<span class="required">*</span></label>
                <?php echo form_error('news_title'); ?>
                <input name="news_title" id="news_title" type="text" class="form-control input-sm" value="<?=set_value('news_title',$info->news_title)?>">
              </div>
              
            </div>

            <div class="row form-row">
              <div class="col-md-10">
                <label class="form-label">News Details<span class="required">*</span></label>
                <?php echo form_error('news_details'); ?>
                <textarea name="news_details" rows="10" cols="70"><?=set_value('news_details', $info->news_details)?></textarea>
              </div>                    
            </div>

            
          </div>

          <div class="col-md-4">
            <div class="row form-row">
              <div class="col-md-12">  
                <label class="form-label">File Attachment </label>
                <input type="file" name="userfile" />
              </div>
              <div class="col-md-12">
                <label class="form-label">News Status</label>
                <?php echo form_error('status'); ?>
                <input type="radio" name="status" class="group_control" value="1" <?=set_value('status', $info->status)==1?'checked':'';?>> Enable &nbsp;&nbsp;
                <input type="radio" name="status" class="group_control" value="0" <?=set_value('status', $info->status)==0?'checked':'';?>> Disable
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
  $('#news_validate').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
       news_title: {
        required: true
      },         
      news_details: {
        required: true,
        minlength: 10
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