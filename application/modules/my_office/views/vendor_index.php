<div class="page-content">
   <div class="content">
      <div class="page-title"> <i class="fa fa-briefcase"></i>
         <h3>অফিসের বিস্তারিত তথ্য</h3>
      </div>

      <div class="row">  
         <div class="col-md-12">
            <?php if($office_info->id){ ?>
            <?php if($this->session->flashdata('success')):?>
               <div class="alert alert-success">
                  <?php echo $this->session->flashdata('success');;?>
               </div>
            <?php endif; ?>
                  
            <div class="pull-left">  
               <h3 style="text-align: center; font-weight: bold; "> অফিসের বিস্তারিত তথ্য </h3> 
            </div>
            <!-- <div class="pull-right" style="margin-top: 15px;">  
            <a href="<?php //base_url('my_office/region_update/')?>" class="btn btn-blueviolet btn-mini"> Office Information Update</a> 
            <a href="<?php //base_url('my_office/change_password/')?>" class="btn btn-blueviolet btn-mini"> Change Password</a>  
            </div> -->
            <div class="clearfix"></div>
            <style type="text/css">
               .tgg  {border-collapse:collapse;border-spacing:0;}
               .tgg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal; color: black;}
               .tgg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal; color: black; font-weight: bold; vertical-align: top; width: 150px;}
               .tgg .tgg-d8ej{background-color:#b9c9fe}
            </style>
            <table class="tgg">
               <tr>
                  <th class="tgg-d8ej"> Office Name</th>
                  <td class="tgg-031e"><?=$office_info->nhq_office_name?></td>
               </tr> 
               <tr>
                  <th class="tgg-d8ej"> Username</th>
                  <td class="tgg-031e"><strong><?=$office_info->username?></strong></td>
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