<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb">
      <li> <a href="" class="active"><?=$module_name?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <div class="row">
       <div class="col-md-12">
          <div class="grid simple horizontal red">
              <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                    <a href="<?=base_url('e_folder/all')?>" class="btn btn-primary btn-blueviolet  btn-xs btn-mini"> ফোল্ডার তালিকা</a>  
                  </div>
              </div>
              <div class="grid-body">
                 
              <?php 
              $attributes = array('id' => 'validate');
              echo form_open_multipart(uri_string(), $attributes);?>

                <div class="row form-row">
                    <div class="col-md-6">
                      <div class="box box-primary">    
                        <?php echo form_open_multipart("faq/add");?>
                          <div class="box-body">
                            <div id="infoMessage"><?php //echo $message;?></div>
                            <div><?php echo validation_errors(); ?></div>
                            <?php if($this->session->flashdata('success')):?>
                                <div class="alert alert-success">
                                    <a class="close" data-dismiss="alert">&times;</a>
                                    <?php echo $this->session->flashdata('success');;?>
                                </div>
                            <?php endif; ?>

                            <div class="row">
                              <div class="col-md-12">
                                  <div class="form-group">
                                    <label>ফোল্ডারের নাম</label>
                                    <div><?php echo form_error('name'); ?></div>
                                    <input type="text" class="form-control" name="name" value="<?=set_value('name', $info->name)?>">
                                  </div>
                            </div>
                          </div>
                          <!-- /.box-body -->

                          <div class="box-footer">          
                            <?php echo form_submit('submit', 'সম্পাদন', "class='btn btn-primary btn-xs btn-small pull-right'"); ?>
                          </div>
                        <?php echo form_close();?>
                      </div>
                      <!-- /.box -->
                    </div>

                </div>
                    
                <?php echo form_close();?>

              </div>  <!-- END GRID BODY -->              
            </div> <!-- END GRID -->
          </div>

        </div> <!-- END ROW -->

      </div>
</div>

