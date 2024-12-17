<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('offices/upazila')?>" class="active"><?=$module_name?> </a> </li>
         <li><?=$meta_title; ?></li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">                
                     <a href="<?=base_url('offices/upazila')?>" class="btn btn-blueviolet btn-xs btn-mini"> Scouts Upazila List</a>  
                     <a href="<?=base_url('offices/upazila_update/'.encrypt_url($info->id))?>" class="btn btn-blueviolet btn-xs btn-mini">Scouts Upazila Update</a>  
                  </div>
               </div>
               <div class="grid-body">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>

                  <style type="text/css">
                     .tg  {border-collapse:collapse;border-spacing:0;}
                     .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal; color: black;border-color: #ccc;}
                     .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal; color: black; font-weight: bold; vertical-align: top; border-color: #a29e9e;}
                     .tg .tg-d8ej{background-color:#b9c9fe}
                  </style>
                  <?php
                  if($info->upa_status == 1) {
                     $status = '<button class="btn btn-mini btn-info">Enable</button>';
                  }else{
                     $status = '<button class="btn btn-mini btn-primary">Disable</button>';
                  }
                  ?>
                  <table class="tg" width="100%">
                     <tr>
                        <th class="tg-d8ej" width="200"> Region Name</th>
                        <td class="tg-031e"><?=$info->region_name?></td>
                        <th class="tg-d8ej"> Scout District Name</th>
                        <td class="tg-031e"><?=$info->dis_name?></td>
                     </tr>
                     <tr>
                        <th class="tg-d8ej"> Upazila Name (Bangla)</th>
                        <td class="tg-031e"><?=$info->upa_name?></td>
                        <th class="tg-d8ej"> Username</th>
                        <td class="tg-031e"><?=$info->username?></td>
                     </tr>
                     <tr>
                        <th class="tg-d8ej"> Upazila Name (English)</th>
                        <td class="tg-031e"><?=$info->upa_name_en?></td>
                        <th class="tg-d8ej"> Upazila Phone</th>
                        <td class="tg-031e"><?=$info->upa_phone?></td>
                     </tr>                
                     <tr>
                        <th class="tg-d8ej"> Upazila Fax</th>
                        <td class="tg-031e"><?=$info->upa_fax?></td>
                        <th class="tg-d8ej"> Upazila Email</th>
                        <td class="tg-031e"><?=$info->upa_email?></td>
                     </tr>
                     <tr>
                        <th class="tg-d8ej"> Upazila Address</th>
                        <td class="tg-031e"><?=$info->upa_address?></td>
                        <th class="tg-d8ej"> Upazila Status</th>
                        <td class="tg-031e"><?=$status?></td>
                     </tr>
                     <tr>
                        <th class="tg-d8ej"> Upazila Description</th>
                        <td class="tg-031e" colspan="3"><?=$info->upa_description?></td>
                     </tr>
                  </table>

               </div>  <!-- END GRID BODY -->              
            </div> <!-- END GRID -->
         </div>

      </div> <!-- END ROW -->

   </div>
</div>