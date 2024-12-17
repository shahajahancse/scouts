<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
     <!--  <li> <?=$module_name?> </li> -->
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
       <div class="col-md-8">
          <div class="grid simple horizontal red">
             <div class="grid-title">
              <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
              <div class="pull-right">                
                <a href="<?=base_url('general_setting/proficiency_badge')?>" class="btn btn-blueviolet btn-success btn-xs btn-mini"> Proficiency Badge List</a>  
              </div>
             </div>
             <div class="grid-body">
              <!-- <form id="form_traditional_validation" action="#"> -->
              <!-- <div id="infoMessage"><?php //echo $message;?></div> -->
              <div><?php //echo validation_errors(); ?></div>
              <?php if($this->session->flashdata('success')):?>
                  <div class="alert alert-success">
                      <a class="close" data-dismiss="alert">&times;</a>
                      <?php echo $this->session->flashdata('success');;?>
                  </div>
              <?php endif; ?>

              <?php 
              // $attributes = array('id' => 'scout_expertness_group_validation');
              echo form_open_multipart("general_setting/proficiency_badge_edit/".$info->id);?>

              <div class="row form-row">
                 <div class="col-md-6">
                  <label class="form-label">Select Section</label>
                  <?php echo form_error('section_id'); ?>
                  <?php echo form_dropdown('section_id',$section, set_value('section_id', $info->section_id), ' class="form-control input-sm" id="section_proficiency_badge"');?>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Select Proficiency Badge Group</label>
                  <?php echo form_error('prof_badge_id'); ?>
                  <?php echo form_dropdown('prof_badge_id', $prof_badge_group, set_value('prof_badge_id', $info->prof_badge_id), 'class="proficiency_badge_group_val form-control input-sm"');?>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Proficiency Badge Name</label>
                  <?php echo form_error('prof_badge_name'); ?>
                  <input name="prof_badge_name" id="prof_badge_name" type="text" value="<?=set_value('prof_badge_name', $info->prof_badge_name)?>" class="form-control input-sm" placeholder="">
                </div>
              </div>

              <div class="form-actions">  
                  <div class="pull-right">
                    <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Save</button>
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
      $('#scout_expertness_group_validation').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
      	badge_type_id: {
            required: true
         },
         expert_group_name: {
            required: true
         },

      },

    });
   });   
</script>

<script>
  $(function() {    
    // Call SuperBox - that's it!
    $('.superbox').SuperBox();    
  });


    //district dropdown
    $('#section_proficiency_badge').change(function(){
      $('.proficiency_badge_group_val').addClass('form-control input-sm');
      $(".proficiency_badge_group_val > option").remove();
      var id = $('#section_proficiency_badge').val();

      // var  full_url = hostname +"general_setting/ajax_get_district_by_div/" + id;
      //alert(full_url);

      $.ajax({
        type: "POST",
        url: hostname +"general_setting/ajax_get_proficiency_badge_group_by_section/" + id,
        success: function(func_data)
        {
          $.each(func_data,function(id,name)
          {
            var opt = $('<option />');
            opt.val(id);
            opt.text(name);
            $('.proficiency_badge_group_val').append(opt);
          });
        }
      });
    });


  </script>