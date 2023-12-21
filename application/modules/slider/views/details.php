<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url('slider')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <style type="text/css">
      .tg  {border-collapse:collapse;border-spacing:0;}
      .tg td{font-family:Arial, sans-serif;font-size:14px;padding:3px 10px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border:0 solid #ccc;}
      .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:3px 10px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border:0 solid #ccc; font-weight: bold; vertical-align: top}
      .tg .tg-9vst{background-color:#efefef;text-align:right;}
    </style>

    <div class="row-fluid">
      <div class="span12">
        <div class="grid simple ">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
              <div class="pull-right">
                <a href="<?=base_url('slider/create')?>" class="btn btn-blueviolet btn-xs btn-mini"> Add Slider </a>
                <a href="<?=base_url('slider')?>" class="btn btn-blueviolet btn-xs btn-mini"> Slider List</a> 
              </div>          
          </div>

          <div class="grid-body ">
            <div id="infoMessage"><?php //echo $message;?></div>            
            <?php if($this->session->flashdata('success')):?>
                <div class="alert alert-success">                    
                    <?php echo $this->session->flashdata('success');?>
                </div>
            <?php endif; ?>            
            <?php
              if($info->status==1){
                $status = '<span class="btn btn-success btn-xs btn-mini"> Enable </span>';
              }else{
                $status = '<span class="btn btn-info btn-xs btn-mini"> Disable </span>';
              }
            ?>
            <div class="tiles white details">
                <div class="row">
                    <div class="col-md-12">
                      <div class="scout-verify-box">
                        <table class="tg" width="100%">
                          <tr>
                            <th class="tg-9vst" width="120">Slider Title:</th>
                            <td class="tg-031e"><?=$info->title?></td>                            
                          </tr>
                          <tr>
                            <th class="tg-9vst">Status:</th>
                            <td class="tg-031e"><?=$status?></td>                            
                          </tr>
                          <tr>
                            <th class="tg-9vst">Slider Image:</th>
                            <td class="tg-031e" valign="top">
                              <?php 
                              $img_path = base_url().'slider_img/';
                              if($info->image_file != NULL){
                                $src= $img_path.$info->image_file;
                                echo "<img src='$src'>";
                              }
                              ?>
                            </td>
                          </tr>                          
                        </table>
                      </div>
                    </div>
                </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>

    </div> <!-- END ROW -->

  </div>
</div>

