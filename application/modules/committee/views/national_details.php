<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('committee/national')?>" class="active"><?=$module_name?> </a> </li>
         <li><?=$meta_title; ?></li>
      </ul>
      <style type="text/css">
         .tg  {border-collapse:collapse;border-spacing:0; border: 0px solid red;}
         .tg td{font-size:14px;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#00000;background-color:#E0FFEB; vertical-align: middle;}
         .tg th{font-size:14px;font-weight:bold;padding:3px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#bce2c5;text-align: center;}
         .tg .tg-ywa9{background-color:#ffffff;vertical-align:top; color: black;}
         .tg .tg-khup{background-color:#efefef;vertical-align:top; color: black; text-align: right;}
         .tg .tg-akf0{background-color:#ffffff;vertical-align:top;color: black;}
         .tg .tg-mtwr{background-color:#efefef;vertical-align:top; font-weight: bold; text-align: center; font-size: 16px;text-decoration: underline;}
      </style>          

      <style type="text/css">
         .tg2  {border-collapse:collapse;border-spacing:0; width: 100%; color: black;}
         .tg2 td{font-family:Arial, sans-serif;font-size:14px;padding:4px 7px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
         .tg2 th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:4px 7px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal; text-align: center;}
         .tg2 .tg-71hr{background-color:#a7afaf; font-weight: bold;}
      </style>       

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">                
                    <a href="<?=base_url('committee/national')?>" class="btn btn-blueviolet btn-xs btn-mini"> Committee List</a>  &nbsp;
                    <?php if($this->ion_auth->is_admin()){ ?>
                    <a href="<?=base_url('committee/national_update/'.encrypt_url($info->id))?>" class="btn btn-blueviolet btn-xs btn-mini"> Committee Update</a> &nbsp;
                    <a href="<?=base_url('committee/national_manage_member/'.encrypt_url($info->id))?>" class="btn btn-blueviolet btn-xs btn-mini"> Manage Member</a> &nbsp;
                    <?php } ?>
                    <a href="<?=base_url('committee/pdf_national_committee/'.encrypt_url($info->id))?>" class="btn btn-success btn-mini" target="_blank"> Download PDF</a>
                    <!-- <a> <input class="btn btn-blueviolet btn-xs btn-mini" type="button" onclick="printDiv('printableArea')" value="Print" /></a>  -->
                 </div>
              </div>

              <div class="grid-body"  id="printableArea">
               <?php if($this->session->flashdata('success')):?>
                  <div class="alert alert-success">
                     <?=$this->session->flashdata('success');;?>
                  </div>
               <?php endif; ?>

               <?php
               if($info->is_current == 1) {
                  $status = '<button class="btn btn-mini btn-info">Current</button>';
               }else{
                  $status = '<button class="btn btn-mini btn-primary">Expired</button>';
               }
               ?>
               <table class="tg" width="100%">
                  <tr>
                     <th class="tg-khup" width="150"> Committee Name</th>
                     <td class="tg-ywa9" colspan="3"><?=$info->committee_name;?></td>
                     <th class="tg-khup"> Office Name</th>
                     <td class="tg-ywa9">NHQ</td>
                  </tr> 
                  <tr>
                     <th class="tg-khup"> Session </th>
                     <td class="tg-ywa9">From <strong><?=date_detail_format($info->session_start_date)?></strong> to <strong><?=date_detail_format($info->session_end_date)?></strong></td>
                     <th class="tg-khup"> Status</th>
                     <td class="tg-ywa9"><?=$status?></td> 
                     <th class="tg-khup"> Commt. Type</th>
                     <td class="tg-ywa9"><?=$info->committee_type_name?></td> 
                  </tr>            
               </table>

               <h4 style="font-weight: bold;"> Committee Member List </h4>
               <table class="tg2">
                  <tr>
                     <th class="tg-71hr">SL</th>
                     <th class="tg-71hr">Scout ID</th>
                     <th class="tg-71hr">Name</th>
                     <th class="tg-71hr">Commt. Designation</th>
                     <th class="tg-71hr">Profe. Designation</th>
                     <th class="tg-71hr">Office Address </th>
                     <th class="tg-71hr">Mobile No </th>
                     <th class="tg-71hr">Email </th>
                  </tr>
                  <?php 
                  $sl=0;
                  foreach ($members as $row):
                     $sl++;
                  $name = $row->scout_id != NULL ? $row->first_name:$row->member_name;
                  $mobile = $row->scout_id != NULL ? $row->phone:$row->member_mobile;
                  $email = $row->scout_id != NULL ? $row->email:$row->member_email;
                  ?>
                  <tr>
                     <td class="tg-031e" align="center"><?=$sl?></td>
                     <td class="tg-031e"><?=$row->scout_id?></td>
                     <td class="tg-031e"><?=$name?></td>
                     <td class="tg-031e"><?=$row->committee_designation_name?></td>
                     <td class="tg-031e"><?=$row->member_profession?></td>
                     <td class="tg-031e"><?=$row->member_address?></td>
                     <td class="tg-031e"><?=$mobile?></td>
                     <td class="tg-031e"><?=$email?></td>
                  </tr>
               <?php endforeach;?> 
            </table>



         </div>  <!-- END GRID BODY -->              
      </div> <!-- END GRID -->
   </div>

</div> <!-- END ROW -->

</div>
</div>