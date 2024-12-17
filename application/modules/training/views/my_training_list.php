<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url()?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <div class="row-fluid">
      <div class="span12">
        <div class="grid simple ">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <?php if($this->ion_auth->is_admin()){ ?>
              <div class="pull-right">
                <a href="<?=base_url('training/create_training')?>" class="btn btn-primary btn-xs btn-mini"> Create Training </a>
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
            <table class="table table-hover table-condensed" id="example">
              <thead>
                <tr>
                  <th style="width:2%"> SL </th>
                  <th style="width:24%">Training Name</th>
                  <th style="width:10%">From Date</th>
                  <th style="width:10%">To Date</th>
                  <th style="width:10%">Duration</th>
                  <th style="width:10%">Type</th>
                  <th style="width:10%">Status</th>
                  <th style="width:24%" class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($training)){
                  $i=0;
                  foreach ($training as $row) {
                    ?>
                  <tr>
                    <td class="v-align-middle"><?=++$i?></td>
                    <td class="v-align-middle"><?php echo $this->Common_model->explote_array($this->Common_model->get_dd_training_list(),$row->training_name);?></td>
                    <td class="v-align-middle"><?=date_bangla_format($row->training_start_date)?></td>
                    <td class="v-align-middle"><?=date_bangla_format($row->training_end_date)?></td>
                    <td class="v-align-middle"><?=$row->training_duration?></td>
                    <td class="v-align-middle"><?=$row->training_type?></td>
                    <td class="v-align-middle">
                        <?php
                          if($row->training_start_date>date('Y-m-d')){
                            echo 'Upcomming';
                          }else if($row->training_end_date>date('Y-m-d')){
                            echo 'Running';
                          }else{
                            echo 'Past';
                          }
                        ?>
                    </td>
                    <td class="text-center">
                      <a href="<?=base_url('training/details/'.encrypt_url($row->id));?>" class="btn btn-primary btn-xs btn-mini">Details</a>     
                      <?php if($row->comments==NULL){?>
                        <a href="<?=base_url('training/comments/'.$row->id);?>" class="btn btn-info btn-xs btn-mini">Feedback</a>
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