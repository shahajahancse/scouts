<div class="page-content">
   <div class="content">
      <div class="page-title">
         <h3 class="headingicon" style="text-align: left; font-weight: bold; width: 400px;"> <i class="fa fa-briefcase" ></i> Scouts Region Office Details  </h3>    
      </div>

      <div class="row">  
         <div class="col-md-12">
            <?php if($this->session->flashdata('success')):?>
               <div class="alert alert-success">
                  <?php echo $this->session->flashdata('success');;?>
               </div>
            <?php endif; ?>
            
            <div class="pull-right" style="margin-bottom: 5px;">  
               <a href="<?=base_url('my_office/region_update/')?>" class="btn btn-blueviolet btn-mini"> Office Information Update</a> 
               <a href="<?=base_url('my_office/change_password/')?>" class="btn btn-blueviolet btn-mini"> Change Password</a>  
            </div>
            <div class="clearfix"></div>

            <?php 
            if($office_info->id){ 
               $img_path = base_url().'offices_img/';
               if($office_info->region_logo != NULL){
                  $src= $img_path.$office_info->region_logo;
                  $img = "<img src='$src' height='40'>";
               }
               ?>

               <style type="text/css">
                  .tgg  {border-collapse:collapse;border-spacing:0;}
                  .tgg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal; color: black;border-color:#898c85;}
                  .tgg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal; color: black; font-weight: bold; vertical-align: top;border-color:#898c85;}
                  .tgg .tgg-d8ej{background-color:#b9c9fe}
               </style>
               <?php
               if($office_info->region_status == 1) {
                  $status = '<button class="btn btn-mini btn-info">Enable</button>';
               }else{
                  $status = '<button class="btn btn-mini btn-primary">Disable</button>';
               }

               if($office_info->region_type == 'divisional') {
                  $region = '<button class="btn btn-mini btn-primary">Divitional Region</button>';
               }else{
                  $region = '<button class="btn btn-mini btn-primary">Special Region</button>';
               }
               ?>
               <table class="tgg">
                  <tr>
                     
                  </tr>
                  <tr>
                     <th class="tgg-d8ej" width="200"> Region Name (Bangla)</th>
                     <td class="tgg-031e"><strong><?=$office_info->region_name?></strong></td>
                     <th class="tgg-d8ej" width="200"> Region Name (English)</th>
                     <td class="tgg-031e"><strong><?=$office_info->region_name_en?></strong></td>
                  </tr>               
                  <tr>
                     <th class="tgg-d8ej"> Username</th>
                     <td class="tgg-031e" valign="top"><strong><?=$office_info->username?></strong></td>
                     <th class="tgg-d8ej">Region Logo</th>
                     <td class="tgg-031e">
                        <?php 
                        $img_path = base_url().'offices_img/';
                        if($office_info->region_logo != NULL){
                           $src= $img_path.$office_info->region_logo;
                           echo "<img src='$src' height='50'>";
                        }
                        ?>
                     </td>
                  </tr>
                  <tr>
                     <th class="tgg-d8ej"> Region Type</th>
                     <td class="tgg-031e"><?=$region?></td>     
                     <th class="tgg-d8ej"> Region Fax</th>
                     <td class="tgg-031e"><?=$office_info->region_fax?></td>                     
                  </tr>
                  <tr>
                     <th class="tgg-d8ej"> Region Phone</th>
                     <td class="tgg-031e"><?=$office_info->region_phone?></td>
                     <th class="tgg-d8ej"> Region Email</th>
                     <td class="tgg-031e"><?=$office_info->region_email?></td>
                  </tr>
                  <tr>
                     <th class="tgg-d8ej"> Region Address</th>
                     <td class="tgg-031e"><?=$office_info->region_address?></td>                  
                     <th class="tgg-d8ej"> Region Status</th>
                     <td class="tgg-031e"><?=$status?></td>
                  </tr>
                  <tr>
                     <th class="tgg-d8ej"> Region Description</th>
                     <td class="tgg-031e" colspan="3"><?=nl2br($office_info->region_description)?></td>
                  </tr>
               </table>

               <?php }else{ ?>
               <div class="alert alert-block alert-error fade in">
                  <h4 class="alert-heading"><i class="icon-warning-sign"></i> No Access!</h4>
                  <p> <h4>Currently you have no region access.</h4> </p>
                  <div class="button-set">
                     <button class="btn btn-danger btn-cons" type="button">Do this</button>
                     <button class="btn btn-white btn-cons" type="button">Or this</button>
                  </div>
               </div>
               <?php } ?>      
            </div>
         </div>

         <style type="text/css">
            .tg  {border-collapse:collapse;border-spacing:0;border-color:#bbb; width: 100%}
            .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#E0FFEB; text-align: center;}
            .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#9DE0AD;}
            .tg .tg-rmb8{background-color:#C2FFD6;vertical-align:top}
            .tg .tg-yw4l{vertical-align:middle; text-align: right; font-weight: bold;}
         </style>
         <div class="row">
            <div class="col-md-12" style="padding-bottom: 10px;"></div>
         </div>

      </div>
   </div>