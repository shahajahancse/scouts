<div class="page-content">
   <div class="content">
      <div class="page-title">
         <h3 class="headingicon" style="text-align: left; font-weight: bold; width: 450px;"> <i class="fa fa-briefcase" ></i> Scouts District Office Details  </h3>    
      </div>

      <div class="row">  
         <div class="col-md-12">            
            <?php if($this->session->flashdata('success')):?>
               <div class="alert alert-success">
                  <?php echo $this->session->flashdata('success');;?>
               </div>
            <?php endif; ?>

            <div class="pull-right" style="margin-bottom: 5px;">  
               <a href="<?=base_url('my_office/district_update/')?>" class="btn btn-blueviolet btn-mini"> Office Information Update</a> 
               <a href="<?=base_url('my_office/change_password/')?>" class="btn btn-blueviolet btn-mini"> Change Password</a>  
            </div>

            <div class="clearfix"></div>

            <?php if($office_info->id){ ?>

            <style type="text/css">
               .tgg  {border-collapse:collapse;border-spacing:0; width: 100%;}
               .tgg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal; color: black;border-color:#898c85;}
               .tgg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal; color: black; font-weight: bold; vertical-align: top;border-color:#898c85;}
               .tgg .tgg-d8ej{background-color:#b9c9fe}
            </style>
            <?php
            if($office_info->dis_status == 1) {
               $status = '<button class="btn btn-mini btn-info">Enable</button>';
            }else{
               $status = '<button class="btn btn-mini btn-primary">Disable</button>';
            }

            if($office_info->dis_type == '1') {
               $district = '<button class="btn btn-mini btn-primary">Administrative District</button>';
            }else if($office_info->dis_type == '2') {
               $district = '<button class="btn btn-mini btn-primary">Metropolitan District</button>';
            }else if($office_info->dis_type == '3') {
               $district = '<button class="btn btn-mini btn-primary">Rover District</button>';
            }else if($office_info->dis_type == '4') {
               $district = '<button class="btn btn-mini btn-primary">Railway District</button>';
            }else if($office_info->dis_type == '5') {
               $district = '<button class="btn btn-mini btn-primary">Sea District</button>';
            }else if($office_info->dis_type == '6') {
               $district = '<button class="btn btn-mini btn-primary">Air District</button>';
            }
            ?>
            <table class="tgg" width="100%">
               <tr>
                  <th class="tgg-d8ej" width="200"> District Name (Bangla)</th>
                  <td class="tgg-031e"><strong><?=$office_info->dis_name?></strong></td>
                  <th class="tgg-d8ej" width="200"> District Name (English)</th>
                  <td class="tgg-031e"><strong><?=$office_info->dis_name_en?></strong></td>
               </tr>
               <tr>
                  <th class="tgg-d8ej"> Region Name</th>
                  <td class="tgg-031e"><?=$office_info->region_name?></td>                     
                  <th class="tgg-d8ej"> Username</th>
                  <td class="tgg-031e"><strong><?=$office_info->username?></strong></td>
               </tr>
               <tr>
                  <th class="tgg-d8ej"> Phone</th>
                  <td class="tgg-031e"><?=$office_info->dis_phone?></td>
                  <th class="tgg-d8ej"> District Type</th>
                  <td class="tgg-031e"><?=$district?></td>
               </tr>
               <tr>
                  <th class="tgg-d8ej"> Email</th>
                  <td class="tgg-031e"><?=$office_info->dis_email?></td>
                  <th class="tgg-d8ej"> Fax</th>
                  <td class="tgg-031e"><?=$office_info->dis_fax?></td>
               </tr>
               <tr>
                  <th class="tgg-d8ej"> Address</th>
                  <td class="tgg-031e"><?=$office_info->dis_address?></td>
                  <th class="tgg-d8ej"> Status</th>
                  <td class="tgg-031e"><?=$status?></td>
               </tr>
               <tr>
                  <th class="tgg-d8ej"> Description</th>
                  <td class="tgg-031e" colspan="3"><?=$office_info->dis_description?></td>
               </tr>
            </table>

            <?php }else{ ?>
            <div class="alert alert-block alert-error fade in">
               <h4 class="alert-heading"><i class="icon-warning-sign"></i> No Access!</h4>
               <p> <h4>Currently you have no district access.</h4> </p>
               <div class="button-set">
                  <button class="btn btn-danger btn-cons" type="button">Do this</button>
                  <button class="btn btn-white btn-cons" type="button">Or this</button>
               </div>
            </div>
            <?php } ?>      
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