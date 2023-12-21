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
              <?php if($this->session->flashdata('warning')):?>
                  <div class="alert alert-warning">                      
                      <?php echo $this->session->flashdata('warning');;?>
                  </div>
              <?php endif; ?>
              <?php echo form_open_multipart("training/comments/".$training_id);?>

          	<div class="row">
                <div class="col-md-8">

                  	<!-- <div class="row form-row">
	                    <div class="col-md-10">
	                      	<label class="form-label">Event</label>
	                      	<?php echo form_error('event'); ?>
	                      	<select  class="form-control" name="event"  required>
		                        <option value=""> -- Select Event -- </option>
		                        <?php foreach($event as $list) {
		                          echo '<option value='.$list->id.'>'.$list->event_title.'</option>';
		                        } ?>
		                    </select>

	                    </div>
                  	</div> -->

                  	<div class="row form-row">
	                    <div class="col-md-10">
                          <h3>Training Name : <?php echo $this->Common_model->explote_array($this->Common_model->get_dd_training_list(),$training->training_name);?></h3>
	                      	<label class="form-label">Comments</label>
	                      	<?php echo form_error('comments'); ?>
	                      	<textarea name="comments" rows="10" cols="70"><?=set_value('comments')?></textarea>
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