<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url('dashboard')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <div class="row-fluid">
      <div class="span12">
        <div class="grid simple ">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <?php if($this->ion_auth->is_admin()){ ?>
              <div class="pull-right">
                <a href="<?=base_url('training/create_trainers')?>" class="btn btn-primary btn-xs btn-mini"> Create Trainers/ Trainee </a>
              </div> 
            <?php } ?>          
          </div>

          <div class="grid-body ">
            <div id="infoMessage"><?php //echo $message;?></div>            
            <?php if($this->session->flashdata('success')):?>
                <div class="alert alert-success">
                    <a class="close" data-dismiss="alert">&times;</a>
                    <?php echo $this->session->flashdata('success');?>
                </div>
            <?php endif; ?>
            <a href="<?=base_url('Training/trainers_list_pdf')?>" class="btn btn-primary btn-xs btn-mini" style="float: right;">PDF Download</a>
            <table class="table table-hover table-condensed" id="example">
              <thead>
                <tr>
                  <th style="width:2%"> SL </th>
                  <th style="width:54%">Trainer Name</th>
                  <th style="width:20%">Specialist</th>
                  <th style="width:24%" class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($trainers)){
                  $i=0;
                  foreach ($trainers as $row) {
                    ?>
                  <tr>
                    <td class="v-align-middle"><?=++$i?></td>
                    <td class="v-align-middle"><?php echo $row->trainer_name;?></td>
                    <td class="v-align-middle"><?=$row->specialist?></td>
                    
                    <td class="text-center">
                     
                      <?php if($this->ion_auth->is_admin()){ ?> 
                        <a href="<?=base_url('training/edit_trainer/'.$row->id);?>" class="btn btn-success btn-xs btn-mini">Edit</a>
                        <a href="<?=base_url('training/trainer_delete/'.$row->id);?>" class="btn btn-info btn-xs btn-mini"  onclick="return confirm('Are you sure you want to delete this Trainer?');">Delete</a>
                      <?php } ?>
                    </td>
                  </tr>
                    <?php
                  }
                }?>
              
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    </div> <!-- END ROW -->

  </div>
</div>