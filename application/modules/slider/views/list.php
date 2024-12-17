<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url('slider')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <div class="row-fluid">
      <div class="span12">
        <div class="grid simple ">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
              <div class="pull-right">
                <a href="<?=base_url('slider/create')?>" class="btn btn-blueviolet btn-xs btn-mini"> Add Slider </a>
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
                  <th style="width:40%">Title</th>
                  <th style="width:30%">Image</th>
                  <th style="width:10%">Status</th>
                  <th style="width:24%" class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($results)){
                  $i=0;
                  foreach ($results as $row) {

                    $path = base_url('slider_img/');
                    if($row->image_file != NULL){
                      $img_url = '<img src="'.$path.$row->image_file.'" height="30">';
                    }else{
                      $img_url = '<img src="'.$path.'cover_pic.png" height="30">';
                    }


                    if($row->status==1){
                      $status = '<span class="btn btn-success btn-xs btn-mini"> Enable </span>';
                    }else{
                      $status = '<span class="btn btn-info btn-xs btn-mini"> Disable </span>';
                    }
                ?>
                  <tr>
                    <td class="v-align-middle"><?=++$i?></td>
                    <td class="v-align-middle"><strong><a href="<?=base_url('slider/details/'.$row->id);?>"><?=$row->title?></a></strong></td>
                    <td class="v-align-middle"><?=$img_url?></td>
                    <td class="v-align-middle"><?=$status?></td>
                    <td class="text-center">
                      <a href="<?=base_url('slider/details/'.$row->id);?>" class="btn btn-primary btn-xs btn-mini">Details</a>     
                        <a href="<?=base_url('slider/edit/'.$row->id);?>" class="btn btn-success btn-xs btn-mini">Edit</a>
                      <?php if($this->ion_auth->is_admin()){ ?> 
                        <a href="<?=base_url('slider/delete/'.$row->id);?>" class="btn btn-info btn-xs btn-mini"  onclick="return confirm('Are you sure you want to delete this Slider?');">Delete</a>
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