<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dahsboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('pds/pds_list')?>" class="active"><?=$module_name?> </a></li>
         <li><?=$meta_title; ?> </li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple ">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                     <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ ?>
                     <a href="<?=base_url('pds/add')?>" class="btn btn-blueviolet btn-xs btn-mini"> Add PDS</a>
                     <a href="<?=base_url('pds/pds_report_pdf')?>" class="btn btn-blueviolet btn-xs btn-mini" target="_blank"> Generate PDS Report</a>
                     <?php } ?>
                  </div>            
               </div>

               <div class="grid-body ">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>
                  <!-- <a href="<?=base_url('Committee/national_pdf')?>" class="btn btn-primary btn-xs btn-mini" style="float: right;">PDF Download</a> -->
                  <table class="table table-hover table-condensed" border="0">
                     <thead>
                        <tr>
                           <th style="width:2%"> SL </th>
                           <th style="width:10%">Image</th>
                           <th style="width:15%">PDS ID</th>
                           <th style="width:30%">Name</th>
                           <th style="width:20%">Designation</th>
                           <th style="width:18%">Join Date</th>
                           <th style="width:25%">Phone</th>                           
                           <th style="width:7%; text-align: right;">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        $sl=$pagination['current_page'];
                        foreach ($results as $row):
                           $sl++;

                           // Employee Image
                           $path = base_url().'employee_img/';
                           if($row->image_file != NULL){
                             $img_url = '<img src="'.$path.$row->image_file.'" height="20">';
                           }else{
                             $img_url = '<img src="'.$path.'no-image.jpg" height="20">';
                           }
                           // if($row->status == 1) {
                           //    $status = '<button class="btn btn-mini btn-info">Enable</button>';
                           // }else{
                           //    $status = '<button class="btn btn-mini btn-danger">Disable</button>';
                           // }

                        ?>
                        <tr>
                           <td class="v-align-left"><?=$sl.'.'?></td>
                           <td class="v-align-middle"><?=$img_url?></td>
                           <td> <strong><?=$row->pds_id?></strong> </td>
                           <td> <strong><?=$row->name_en?></strong> </td>
                           <td class="v-align-middle"><?=$row->current_desig; ?></td>
                           <td class="v-align-middle"><?=date_sort_form($row->join_date); ?></td>
                           <td class="v-align-middle"><?=$row->phone; ?></td>
                           <td align="right">
                              <div class="btn-group"> <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> Action <span class="caret"></span> </a>
                                 <ul class="dropdown-menu pull-right">
                                    <li><?=anchor("pds/details/".encrypt_url($row->id), 'Details')?></li>
                                    <li><?=anchor("pds/edit/".encrypt_url($row->id), 'Edit')?></li>
                                    <li><a href="<?=base_url("pds/pdf_id_card/".encrypt_url($row->id))?>" target="_blank">ID Card Download</a></li>
                                    <?php if($this->ion_auth->is_admin()){ ?> 
                                    <li><?=anchor("award/national_delete/".encrypt_url($row->id), 'Delete', 'onclick="return confirm(\'Be careful! Are you sure you want to delete this data?\');"')?></li>
                                    <?php } ?>
                                 </ul>
                              </div>
                           </td>
                        </tr>
                     <?php endforeach;?>                      
                  </tbody>
               </table>

               <div class="row">
                  <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> Total <span style="color: green; font-weight: bold;"><?php echo $total_rows; ?> Employee </span></div>
                  <div class="col-sm-8 col-md-8 text-right">
                     <?php echo $pagination['links']; ?>
                  </div>
               </div>
            </div>

         </div>
      </div>
   </div>

</div> <!-- END Content -->

</div>