<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url('offices/region')?>" class="active"><?=$module_name?> </a> </li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">                
              <a href="<?=base_url('offices/region')?>" class="btn btn-success btn-xs btn-mini"> Region List</a>  
              <a href="<?=base_url('offices/region_update/'.encrypt_url($info->id))?>" class="btn btn-success btn-xs btn-mini"> Region Update</a>  
            </div>
          </div>
          <div class="grid-body">
            <div><?php //echo validation_errors(); ?></div>
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?=$this->session->flashdata('success');;?>
              </div>
            <?php endif; ?>

            <style type="text/css">
              .tg  {border-collapse:collapse;border-spacing:0; }
              .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal; color: black;border-color: #ccc;}
              .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal; color: black; font-weight: bold; vertical-align: top; border-color: #a29e9e;}
              .tg .tg-d8ej{background-color:#b9c9fe}
            </style>
            <?php
            if($info->region_status == 1) {
              $status = '<button class="btn btn-mini btn-info">Enable</button>';
            }else{
              $status = '<button class="btn btn-mini btn-primary">Disable</button>';
            }

            if($info->region_type == 'divisional') {
              $region = '<button class="btn btn-mini btn-primary">Divitional Region</button>';
            }else{
              $region = '<button class="btn btn-mini btn-primary">Special Region</button>';
            }
            ?>
            <a href="<?=base_url('Offices/region_details_pdf'.'/'.encrypt_url($info->id))?>" class="btn btn-primary btn-xs btn-mini" style="float: right;">PDF Download</a>

            <table class="tg" width="100%">
              <tr>
                <th class="tg-d8ej" width="200"> Region Name (Bangla)</th>
                <td class="tg-031e"><?=$info->region_name?></td>
                <th class="tg-d8ej"> Username</th>
                <td class="tg-031e"><?=$info->username?></td>
              </tr>
              <tr>
                <th class="tg-d8ej"> Region Name (English)</th>
                <td class="tg-031e"><?=$info->region_name_en?></td>
                <th class="tg-d8ej"> Region Type</th>
                <td class="tg-031e"><?=$region?></td>
              </tr>
              <tr>
                <th class="tg-d8ej"> Region Email</th>
                <td class="tg-031e"><?=$info->region_email?></td>
                <th class="tg-d8ej"> Region Phone</th>
                <td class="tg-031e"><?=$info->region_phone?></td>
              </tr>
              <tr>
                <th class="tg-d8ej"> Region Address</th>
                <td class="tg-031e"><?=$info->region_address?></td>
                <th class="tg-d8ej"> Region Fax</th>
                <td class="tg-031e"><?=$info->region_fax?></td>
              </tr>
              <tr>
                <th class="tg-d8ej">Region Logo</th>
                <td class="tg-031e">
                  <?php 
                  $img_path = base_url().'offices_img/';
                  if($info->region_logo != NULL){
                    $src= $img_path.$info->region_logo;
                    echo "<img src='$src' height='150'>";
                  }
                  ?></td>
                  <th class="tg-d8ej"> Region Status</th>
                  <td class="tg-031e"><?=$status?></td>
                </tr>
                <tr>
                  <th class="tg-d8ej"> Region Information</th>
                  <td class="tg-031e" colspan="3"><?=nl2br($info->region_description)?></td>
                </tr>
              </table>

            </div>  <!-- END GRID BODY -->              
          </div> <!-- END GRID -->
        </div>

      </div> <!-- END ROW -->

    </div>
  </div>