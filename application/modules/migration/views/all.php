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
              <a href="<?=base_url('scouts_member/create')?>" class="btn btn-primary btn-xs btn-mini"> Create Scouts Member </a>
              <a href="<?=base_url('scouts_member/all')?>" class="btn btn-success btn-xs btn-mini"> Scouts List</a>  
            </div>            
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
                  <th style="width:5%">Image</th>
                  <th style="width:10%">Full Name</th>
                  <th style="width:10%">Phone</th>
                  <th style="width:10%">Email</th>
                  <th style="width:5%">Status</th>
                  <th style="width:6%">S. Group</th>
                  <th style="width:5%">Action</th>
                </tr>
              </thead>
              <tbody>
              <?php 
                $sl=0;
                foreach ($results as $row):
                  $sl++;
                  if($row->req_group == 1){
                    $req_group_name = 'Cub Scout';
                  }else if($row->req_group == 2){
                    $req_group_name = 'Scout';
                  }else if($row->req_group == 3){
                    $req_group_name = 'Rover Scout';
                  }else{
                    $req_group_name = '';
                  }

                  $path = base_url().'profile_img/';
                  if($row->profile_img != NULL){
                    $img_url = '<img src="'.$path.$row->profile_img.'" height="20">';
                  }else{
                    $img_url = '<img src="'.$path.'no-img.png" height="20">';
                  }

                  $active = $row->active == 0 ? '<span class="label label-important">Inactive</span>':'<span class="label label-primary">Active</span>';
              ?>

                <tr>
                  <td class="v-align-middle"><?=$sl.'.'?></td>
                  <td class="v-align-middle"><?=$img_url?></td>
                  <td class="v-align-middle"><?php echo $row->first_name.' '.$row->last_name;?></td>
                  <td class="v-align-middle"><?php echo $row->phone;?></td>
                  <td class="v-align-middle"><?php echo $row->email;?></td>
                  <td class="v-align-middle"><?php echo $active;?></td>
                  <td class="v-align-middle"><?php echo $req_group_name;?></td>
                  <td class="v-align-middle">
                    <div class="btn-group">
                      <button class="btn btn-mini btn-success">Action</button>
                      <button class="btn btn-mini btn-success dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> </button>
                      <ul class="dropdown-menu">                        
                        <li><?php echo anchor("#", 'Edit Member') ;?></li>
                        <li class="divider"></li>
                        <li><a href="#">Delete</a></li>
                      </ul>
                    </div> 
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