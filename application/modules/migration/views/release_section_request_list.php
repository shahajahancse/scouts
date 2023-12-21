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
          </div>

          <div class="grid-body ">
            <div id="infoMessage"><?php //echo $message;?></div>            
            <?php if($this->session->flashdata('success')):?>
                <div class="alert alert-success">
                    <?php echo $this->session->flashdata('success');?>
                </div>
            <?php endif; ?>
            <table class="table table-hover table-condensed">
              <thead>
                <tr>
                  <th style="width:2%"> SL </th>
                  <th style="width:14%">Scout ID</th>
                  <th style="width:20%">Name</th>
                  <th style="width:15%">App. Date</th>
                  <th style="width:15%">Release Group Verify</th>
                  <th style="width:15%">Migration Group Verify</th>                  
                  <th style="width:24%" class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($results)){
                  $sl=0;
                  foreach ($results as $row) {
                    $sl++;
                ?>
                  <tr>
                    <td class="v-align-middle"><?=$sl?></td>
                    <td class="v-align-middle"><?=$row->scout_id?></td>
                    <td class="v-align-middle"><?=$row->first_name?></td>
                    <td class="v-align-middle"><?=$row->created?></td>
                    <td class="v-align-middle"><?=migrate_verify_status($row->curr_group_verify)?></td>
                    <td class="v-align-middle"><?=migrate_verify_status($row->mig_group_verify)?></td>
                    <td class="text-center">
                      <a href="<?=base_url('migration/release_section_verify/'.$row->id);?>" class="btn btn-primary btn-xs btn-mini">Details</a>     
                      <?php if($this->ion_auth->is_admin()){ ?> 
                        <!-- <a href="<?=base_url('migration/edit/'.$row->id);?>" class="btn btn-success btn-xs btn-mini">Edit</a> -->
                        <a href="<?=base_url('migration/delete/'.$row->id);?>" class="btn btn-info btn-xs btn-mini">Delete</a>
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