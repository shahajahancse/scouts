<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url()?>" class="active"> <?=$module_title; ?> </a></li>
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
                <a href="<?=base_url('scout_news/create_news')?>" class="btn btn-blueviolet btn-xs btn-mini"> Create News </a>
                <a href="<?=base_url('scout_news/news_list')?>" class="btn btn-blueviolet btn-xs btn-mini"> News List</a> 
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
                        <table class="tg">
                          <tr>
                            <th class="tg-9vst">News Title:</th>
                            <td class="tg-031e"><?=$info->news_title?></td>                            
                          </tr>
                          <tr>
                            <th class="tg-9vst">Date:</th>
                            <td class="tg-031e"><?=date_bangla_format($info->created)?></td>
                          </tr>
                          <tr>
                            <th class="tg-9vst">News Status:</th>
                            <td class="tg-031e"><?=$status?></td>                            
                          </tr>
                          <tr>
                            <th class="tg-9vst">News Details:</th>
                            <td class="tg-031e" valign="top"><?=$info->news_details?></td>
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

