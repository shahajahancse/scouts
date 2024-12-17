<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="javascript:void()" class="active"><?=$module_name?> </a></li>
         <li><?=$meta_title; ?> </li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple ">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                     <a href="<?=base_url('offices/scout_unit_create')?>" class="btn btn-blueviolet btn-xs btn-mini"> Scout Unit Create </a>
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
                           <th style="width:5%"> SL </th>
                           <th style="width:20%">Scout Unit Name</th>
                           <th style="width:20%">Scout Group Name</th>
                           <th style="width:8%;">Type</th>
                           <th style="width:10%;">Charter No</th>
                           <th style="width:10%;">Unit Number</th>
                           <th style="width:20%;">Action</th>
                           <!-- <th style="width:5%">Status</th> -->
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        $sl=0;
                        foreach ($results as $row):
                           $sl++;
                        if($row->unit_status == 1) {
                           $status = '<button class="btn btn-mini btn-info">Enable</button>';
                        }else{
                           $status = '<button class="btn btn-mini btn-primary">Disable</button>';
                        }

                        ?>
                        <tr>
                           <td class="v-align-middle"><?=$sl.'.'?></td>
                           <td> <strong><?=$row->unit_name?> </strong></td>
                           <td><?=$row->grp_name?></td>                           
                           <td class="v-align-middle"><?=get_scout_unit_type($row->unit_type); ?></td>
                           <td class="v-align-middle"><?=$row->grp_charter; ?></td>
                           <td class="v-align-middle"><?=$row->unit_number; ?></td>
                           <td><a href="<?=base_url('offices/scout_unit_update/'.$row->id)?>" class="btn btn-mini btn-primary"> <i class="fa fa-pencil-square-o"> </i> Edit</a>
                           <?php /* ?><a href="<?=base_url('offices/scout_unit_details/'.$row->id)?>" class="btn btn-mini btn-primary"> <i class="fa fa-info-circle"> </i> Details</a> <?php */ ?></td>
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