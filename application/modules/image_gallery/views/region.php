<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
         <li> <a href="javascript:void()" class="active"><?=$module_name?> </a></li>
         <li><?=$meta_title; ?> </li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple ">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                     <a href="<?=base_url('offices/region_create')?>" class="btn btn-primary btn-xs btn-mini"> Region Create </a>
                  </div>            
               </div>

               <div class="grid-body ">
                  <div id="infoMessage"><?php //echo $message;?></div>            
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>
                  <table class="table table-hover table-condensed">
                     <thead>
                        <tr>
                           <th style="width:2%"> SL </th>
                           <th style="width:35%">Region Name</th>
                           <th style="width:15%">Division Name</th>
                           <th style="width:10%">Region Type</th>
                           <th style="width:10%">Status</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        $sl=0;
                        foreach ($results as $row):
                           $sl++;
                        if($row->region_status == 1) {
                           $status = '<button class="btn btn-mini btn-info">Enable</button>';
                        }else{
                           $status = '<button class="btn btn-mini btn-primary">Disable</button>';
                        }

                        if($row->region_type == 'divisional') {
                           $region = '<button class="btn btn-mini btn-primary">Divitional Region</button>';
                        }else{
                           $region = '<button class="btn btn-mini btn-primary">Special Region</button>';
                        }
                        ?>
                        <tr>
                           <td class="v-align-middle"><?=$sl.'.'?></td>
                           <td> <?=$row->region_name?> </td>
                           <td class="v-align-middle"><?=$row->div_name; ?></td>
                           <td> <?=$region?> </td>
						         <td> <?=$status?><td>
                           <td><?php echo anchor("offices/region_update/".$row->id, 'Update','class="btn btn-mini btn-primary"') ;?>&nbsp;<a class="btn btn-mini btn-primary" href="<?=base_url('offices/region_details/'.$row->id)?>">Details</a></td>
                              <?php /*?><td class="v-align-middle">
                                 <div class="btn-group"> <a class="btn btn-mini btn-info dropdown-toggle btn-demo-space" data-toggle="dropdown" href="#"> Info <span class="caret"></span> </a>
                                    <ul class="dropdown-menu">
                                       <li><?php echo anchor("offices/region_update/".$row->id, 'Update') ;?></li>
                                       <li class="divider"></li>
                                       <li><a href="<?=base_url('offices/region_details/'.$row->id)?>">Details</a></li>
                                    </ul>
                                 </div>
                              </td><?php */?>
                           </tr>
                        <?php endforeach;?>                      
                     </tbody>
                  </table>
               </div>

            </div>
         </div>
      </div>

   </div> <!-- END Content -->

</div>