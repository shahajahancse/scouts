<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url('offices/district')?>" class="active"><?=$module_name?> </a> </li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">                
              <a href="<?=base_url('offices/district')?>" class="btn btn-blueviolet btn-xs btn-mini"> Scouts District List</a>  
              <a href="<?=base_url('offices/district_update/'.encrypt_url($info->id))?>" class="btn btn-blueviolet btn-xs btn-mini">Scouts District Update</a>  
            </div>
          </div>
          <div class="grid-body">
            <div><?php //echo validation_errors(); ?></div>
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <a class="close" data-dismiss="alert">&times;</a>
                <?=$this->session->flashdata('success');;?>
              </div>
            <?php endif; ?>

            <style type="text/css">
              .tg  {border-collapse:collapse;border-spacing:0;}
              .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal; color: black;border-color: #ccc;}
              .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal; color: black; font-weight: bold; vertical-align: top;border-color: #a29e9e;}
              .tg .tg-d8ej{background-color:#b9c9fe}
            </style>
            <?php
            if($info->dis_status == 1) {
              $status = '<button class="btn btn-mini btn-info">Enable</button>';
            }else{
              $status = '<button class="btn btn-mini btn-primary">Disable</button>';
            }

            if($info->dis_type == '1') {
              $district = '<button class="btn btn-mini btn-primary">Administrative District</button>';
            }else if($info->dis_type == '2') {
              $district = '<button class="btn btn-mini btn-primary">Metropolitan District</button>';
            }else if($info->dis_type == '3') {
              $district = '<button class="btn btn-mini btn-primary">Rover District</button>';
            }else if($info->dis_type == '4') {
              $district = '<button class="btn btn-mini btn-primary">Railway District</button>';
            }else if($info->dis_type == '5') {
              $district = '<button class="btn btn-mini btn-primary">Sea District</button>';
            }else if($info->dis_type == '6') {
              $district = '<button class="btn btn-mini btn-primary">Air District</button>';
            }
           ?>
           <a href="<?=base_url('Offices/district_details_pdf'.'/'.encrypt_url($info->id))?>" class="btn btn-primary btn-xs btn-mini" style="float: right;">PDF Download</a>
           <table class="tg" width="100%">
            <tr>
              <th class="tg-d8ej" width="200"> Region Name</th>
              <td class="tg-031e"><?=$info->region_name?></td>
              <th class="tg-d8ej"> District Type</th>
              <td class="tg-031e"><?=$district?></td>
            </tr>
            <tr>
              <th class="tg-d8ej"> Scouts District (Bangla)</th>
              <td class="tg-031e"><?=$info->dis_name?></td>
              <th class="tg-d8ej"> Username </th>
              <td class="tg-031e"><?=$info->username?></td>
            </tr>
            <tr>
              <th class="tg-d8ej"> Scouts District (English)</th>
              <td class="tg-031e"><?=$info->dis_name_en?></td>
              <th class="tg-d8ej"> Phone</th>
              <td class="tg-031e"><?=$info->dis_phone?></td>
            </tr>                                      
            <tr>
              <th class="tg-d8ej"> Fax</th>
              <td class="tg-031e"><?=$info->dis_fax?></td>                   
              <th class="tg-d8ej"> Email</th>
              <td class="tg-031e"><?=$info->dis_email?></td>
            </tr>
            <tr>
              <th class="tg-d8ej"> Address</th>
              <td class="tg-031e"><?=$info->dis_address?></td>                   
              <th class="tg-d8ej"> Status</th>
              <td class="tg-031e"><?=$status?></td>
            </tr>
            <tr>
              <th class="tg-d8ej"> Description</th>
              <td class="tg-031e" colspan="3"><?=$info->dis_description?></td>
            </tr>
          </table>

        </div>  <!-- END GRID BODY -->              
      </div> <!-- END GRID -->
    </div>

  </div> <!-- END ROW -->

</div>
</div>