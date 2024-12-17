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
            <div class="pull-right">
              <a href="<?=base_url('scouts_member/create')?>" class="btn btn-blueviolet btn-xs btn-mini"> Add Scouts Member </a>
              <a href="<?=base_url('scouts_member/all')?>" class="btn btn-blueviolet btn-xs btn-mini"> Scouts List</a>  
            </div>            
          </div>

          <div class="grid-body ">
            <div id="infoMessage"><?php //echo $message;?></div>            
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');?>
              </div>
            <?php endif; ?>
            <table class="table table-hover table-condensed" id="example">
              <thead>
                <tr>
                  <th style="width:2%"> SL </th>
                  <th style="width:5%">Image</th>                  
                  <th style="width:10%">Full Name</th>
                  <th style="width:8%">Username</th>
                  <th style="width:10%">Member Type</th>                  
                  <th style="width:10%">Section</th>                
                  <th style="width: 10%">Details</th>
                  <th style="width:5%">Verify</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $sl=0;
                foreach ($results as $row):
                  $sl++;
                  $path = base_url().'profile_img/';
                  if($row->profile_img != NULL){
                    $img_url = '<img src="'.$path.$row->profile_img.'" height="20">';
                  }else{
                    $img_url = '<img src="'.$path.'no-img.png" height="20">';
                  }
                ?>

                <tr>
                  <td class="v-align-middle"><?=$sl.'.'?></td>
                  <td class="v-align-middle"><?=$img_url?></td>
                  <td class="v-align-middle"><strong><?php echo $row->first_name;?></strong></td>
                  <td class="v-align-middle"><?php echo $row->username;?></td>
                  <td class="v-align-middle"><?php echo $row->member_type_name;?></td>
                  <td class="v-align-middle"><?php echo get_scout_section($row->sc_section_id);?></td>
                  <td class="v-align-middle"><a href="<?=base_url("scouts_member/details/".encrypt_url($row->id))?>" target="_blank" class="label label-green">Details</a></td>  
                  <td class="v-align-middle"> <a href="<?php echo base_url('scouts_member/verified_member_generate_scout_id/'.encrypt_url($row->id));?>" onclick="return confirm('Are you sure you want to generate Scout ID for this user?')" class="btn btn-mini btn-success">Generate ID</a> </td>
                </td>
              </tr>
            <?php endforeach;?>                      
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

</div> <!-- END ROW -->

</div>
</div>