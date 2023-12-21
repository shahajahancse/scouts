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

          </div>

          <div class="grid-body ">
            <div id="infoMessage"><?php //echo $message;?></div>            
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');?>
              </div>
            <?php endif; ?>
            <?php if($this->session->flashdata('warning')):?>
                <div class="alert alert-warning">                      
                    <?php echo $this->session->flashdata('warning');;?>
                </div>
            <?php endif; ?>

            <?php if($results) {  //print_r($results);?>
            <!-- <a href="<?=base_url('Events/upcomming_event_pdf')?>" class="btn btn-primary btn-xs btn-mini" style="float: right;">PDF Download</a> -->
            <table class="table table-hover table-condensed" id="example">
              <thead>
                <tr>
                  <th style="width:2%"> SL </th>
                  <th style="width:30%">Training Name</th>
                  <th style="width:20%">Place</th>
                  <th style="width:10%">From Date</th>
                  <th style="width:10%">To Date</th>
                  <th style="width:10%">Reg. Start</th>
                  <th style="width:10%">Reg. End</th>
                  <th style="width:10%">Details</th>
                  <th style="width:10%" class="text-center">Join Training</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $sl = 0;
                foreach ($results as $row):
                  // echo '<pre>';
                  // print_r($row); exit;
                  
                  $sl++;
                ?>
                <tr>
                  <td class="v-align-middle"><?=$sl?></td>
                  <td class="v-align-middle"><a href="<?=base_url('training/details/'.encrypt_url($row->id));?>"><strong><?=$row->training_title?></strong></a></td>
                  <td class="v-align-middle"><?=$row->place?></td>
                  <td class="v-align-middle"><?=date('d M, y', strtotime($row->start_date))?></td>
                  <td class="v-align-middle"><?=date('d M, y', strtotime($row->end_date))?></td>
                  <td class="v-align-middle"><?=date('d M, y', strtotime($row->reg_start))?></td>
                  <td class="v-align-middle"><?=date('d M, y', strtotime($row->reg_end))?></td>
                  <td align="right"><a target="_blank" href="<?=base_url('training/details/'.encrypt_url($row->id));?>" class="btn btn-primary btn-mini">Details</a> </td>
                  <?php  if(count($this->Training_model->is_apply_training($row->id, $info->id))){?>
                  <td align="right"><a href="<?=base_url('training/join_training/'.encrypt_url($row->id));?>" class="btn btn-blueviolet btn-mini disabled">Already Applied</a> </td>
                  <?php }else{ ?>
                  <td align="right">
                    <a href="<?=base_url('training/join_training/'.encrypt_url($row->id));?>" class="btn btn-blueviolet btn-mini">Apply for Training</a> 
                  </td>
                  <?php } ?>
                </tr>
              <?php endforeach; ?> 

            </tbody>
          </table>

          <?php }else{ ?>
          <div class="alert alert-block alert-error fade in">
            <h4 class="alert-heading"><i class="icon-warning-sign"></i>No data found!</h4>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>

</div> <!-- END ROW -->

</div>
</div>