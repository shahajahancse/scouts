<div class="page-content">
  <div class="content">
    <ul class="breadcrumb">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
       <div class="col-md-8">
          <div class="grid simple horizontal red">
             <div class="grid-title">
              <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
              <div class="pull-right">
                <a href="<?=base_url('general_setting/division')?>" class="btn btn-success btn-xs btn-mini"> Division List</a>
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
              $attributes = array('id' => 'division_validate');
              echo form_open_multipart("general_setting/member_type_edit/".$info->id, $attributes);?>

              <div class="row form-row">
                <div class="col-md-6">
                  <label class="form-label">Division Name (English)</label>
                  <?php echo form_error('div_name'); ?>
                  <input name="member_type_name" value="<?=set_value('member_type_name', $info->member_type_name)?>" class="form-control input-sm" placeholder="e.g. Dhaka">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Status</label>
                    <input type="text" name="is_delete"  value="<?=set_value('is_delete', $info->is_delete)?>" class="form-control input-sm">
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

</script>
