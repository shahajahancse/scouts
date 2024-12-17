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
                    <a class="close" data-dismiss="alert">&times;</a>
                    <?php echo $this->session->flashdata('success');?>
                </div>
            <?php endif; ?>
            <a href="<?=base_url('Award_application/all_award_request_list_pdf')?>" class="btn btn-primary btn-xs btn-mini" style="float: right;">PDF Download</a>
            <table class="table table-hover table-condensed" id="example">
              <thead>
                <tr>
                  <th style="width:2%"> SL </th>
                  <th style="width:8%">Image</th>
                  <th style="width:20%">Name</th>
                  <th style="width:11">Phone</th>
                  <!-- <th style="width:10%">Address</th> -->
                  <th style="width:15%">Award Name</th>
                  <th style="width:8%">Group Verify</th>
                  <th style="width:8%">Upazila Verify</th>
                  <th style="width:8%">District Verify</th>
                  <th style="width:8%">Region Verify</th>
                  <th style="width:12%">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($results)){
                  $sl=0;
                  foreach ($results as $row) {
                    $sl++;

                    $profile_img = $row->profile_img;
                    $path = base_url().'profile_img/';
                    if($profile_img != NULL){
                      $img_url = $path.$profile_img;
                    }else{
                      $img_url = $path.'no-img.png';
                    }
                ?>

                <tr>
                  <td class="v-align-middle"><?=$sl?></td>
                  <td class="v-align-middle"><img src="<?=$img_url?>" width="50" ></td>
                  <td class="v-align-middle"><?php echo $row->first_name.' '.$row->last_name;?></td>
                  <td class="v-align-middle"><?php echo $row->phone;?></td>
<!--                   <td class="v-align-middle"><?php echo $row->email;?></td> -->
                  <td class="v-align-middle"><?php echo $row->award_name;?></td>
                  <td class="v-align-middle"><?php echo award_status($row->app_grp_approve);?></td>
                  <td class="v-align-middle"><?php echo award_status($row->app_upa_approve);?></td>
                  <td class="v-align-middle"><?php echo award_status($row->app_dis_approve);?></td>
                  <td class="v-align-middle"><?php echo award_status($row->app_rgn_approve);?></td>
                  <td class="v-align-middle">
                   <a href="<?=base_url('award_application/award_details/'.$row->id);?>" class="btn btn-primary btn-xs btn-mini">Details</a>     
                      <?php if($this->ion_auth->is_admin()){ ?> 
                        <a href="<?=base_url('award_application/delete/'.$row->id);?>" class="btn btn-info btn-xs btn-mini">Delete</a>
                      <?php } ?>
                  </td>
                </tr>

                  <?php 
                  } 
                }
                ?>                      
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    </div> <!-- END ROW -->

  </div>
</div>