<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dahsboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('award/circular_list')?>" class="active"><?=$module_name?> </a></li>
         <li><?=$meta_title; ?> </li>
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

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple ">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                     <?php //if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ ?>
                     <a href="<?=base_url('award/recommendation_list/'.encrypt_url($info->circular_id))?>" class="btn btn-blueviolet btn-xs btn-mini"> Back to Recommended List</a>
                     <?php //} ?>
                  </div>            
               </div>

               <div class="grid-body ">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>

                  <table class="tg" width="100%">
                     <tr>
                        <th class="tg-khup"> Circular Name</th>
                        <td class="tg-ywa9"><?=$info->circular_title;?></td>
                        <th class="tg-khup"> Recommended Award Name</th>
                        <td class="tg-ywa9"><?=$info->award_name_bn;?></td>
                     </tr>
                     <tr>
                        <th class="tg-khup"> Name</th>
                        <td class="tg-ywa9"><?=$info->name_bn;?></td>
                        <th class="tg-khup"> Phone</th>
                        <td class="tg-ywa9"><?=$info->phone;?></td>
                     </tr> 
                     <tr>
                        <th class="tg-khup"> Present Address</th>
                        <td class="tg-ywa9"><?=$info->present_address;?></td>
                        <th class="tg-khup"> Email Address</th>
                        <td class="tg-ywa9"><?=$info->email;?></td>
                     </tr> 
                     <tr>
                        <th class="tg-khup"> Scouts Group/Unit</th>
                        <td class="tg-ywa9"><?=$info->sc_group_name;?></td>
                        <th class="tg-khup"> Scouts Upazila</th>
                        <td class="tg-ywa9"><?=$info->sc_upazila_name;?></td>
                     </tr> 
                     <tr>
                        <th class="tg-khup"> Scouts District</th>
                        <td class="tg-ywa9"><?=$info->sc_district_name;?></td>
                        <th class="tg-khup"> Scouts Region</th>
                        <td class="tg-ywa9"><?=$info->sc_region_name;?></td>
                     </tr> 
                     <tr>
                        <th class="tg-khup"> Upazila Verify</th>
                        <td class="tg-ywa9">
                           <?=event_verify_status($info->verify_upazila)?>
                           <?php if($this->ion_auth->is_upazila_admin()){ ?>
                           <a href="<?=base_url('award/approve_status/'.encrypt_url($info->id))?>" class="btn btn-blueviolet btn-mini">Approve</a> 
                           <a href="<?=base_url('award/reject_status/'.encrypt_url($info->id))?>" class="btn btn-blueviolet btn-mini">Reject</a>
                           <?php } ?>
                        </td>
                        <th class="tg-khup"> District Verify</th>
                        <td class="tg-ywa9">
                           <?=event_verify_status($info->verify_district)?>
                           <?php if($this->ion_auth->is_district_admin()){ ?>
                           <a href="<?=base_url('award/approve_status/'.encrypt_url($info->id))?>" class="btn btn-blueviolet btn-mini">Approve</a> 
                           <a href="<?=base_url('award/reject_status/'.encrypt_url($info->id))?>" class="btn btn-blueviolet btn-mini">Reject</a>
                           <?php } ?>
                        </td>
                     </tr>
                     <tr>
                        <th class="tg-khup"> Region Verify</th>
                        <td class="tg-ywa9">
                           <?=event_verify_status($info->verify_region)?>
                           <?php if($this->ion_auth->is_region_admin()){ ?>
                           <a href="<?=base_url('award/approve_status/'.encrypt_url($info->id))?>" class="btn btn-blueviolet btn-mini">Approve</a> 
                           <a href="<?=base_url('award/reject_status/'.encrypt_url($info->id))?>" class="btn btn-blueviolet btn-mini">Reject</a>
                           <?php } ?>
                        </td>
                        <th class="tg-khup"> NHQ Verify</th>
                        <td class="tg-ywa9">
                           <?=event_verify_status($info->verify_nhq)?>
                           <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ ?>
                           <a href="<?=base_url('award/approve_status/'.encrypt_url($info->id))?>" class="btn btn-blueviolet btn-mini">Approve</a> 
                           <a href="<?=base_url('award/reject_status/'.encrypt_url($info->id))?>" class="btn btn-blueviolet btn-mini">Reject</a>
                           <?php } ?>
                        </td>
                     </tr> 
                  </table>
                  <br>
               </div>

            </div>
         </div>
      </div>

   </div> <!-- END Content -->

</div>