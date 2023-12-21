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
                     <a href="<?=base_url('employee/create')?>" class="btn btn-blueviolet btn-xs btn-mini"> Create new employee</a>
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
                  <form method="get" action="">
   
                     <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ ?>                     
                     <div class="row">
                        <div class="col-md-5">
                           <?php $more_attr = 'class="form-control input-sm"';
                           echo form_dropdown('designation', $designation, $_GET['designation'], $more_attr);
                           ?>
                        </div>     
                        <div class="col-md-5">
                           <?php $more_attr = 'class="sc_district_val form-control input-sm" id="sc_district"';
                           echo form_dropdown('department', $department, $_GET['department'], $more_attr);
                           ?>
                        </div>     
                        <div class="col-md-2">
                           <div class="pull-right ">
                              <button type="submit" class="btn btn-blueviolet btn-mini"><i class="icon-ok"></i> Search</button>
                           </div>
                        </div>
                     </div>

                     <?php } ?>
                     
                  </form>

                  <div class="clearfix"></div>
                  <hr >
                  <table class="table table-hover table-condensed" border="0">
                     <thead>
                        <tr>
                           <th style="width:2%"> SL </th>
                           <th style="width:10%">Image</th>
                           <th style="width:10%">PDS Id</th>
                           <th style="width:30%">Name</th>
                           <th style="width:18%">Department</th>
                           <th style="width:20%">Designation</th>
                           <th style="width:25%">Phone</th>                           
                           <th style="width:25%">Email</th>                           
                           <th width="50">SL</th>
                           <th style="width:7%; text-align: right;">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        $sl=$pagination['current_page'];
                        foreach ($results as $row):
                           $sl++;

                           // Employee Image
                           $path = base_url().'profile_img/';
                           if($row->profile_img != NULL){
                             $img_url = '<img src="'.$path.$row->profile_img.'" height="20">';
                           }else{
                             $img_url = '<img src="'.$path.'no-image.png" height="20">';
                           }
                           $active=$row->active==1?0:1;
                        

                        ?>
                        <tr>
                           <td class="v-align-left"><?=$sl.'.'?></td>
                           <td class="v-align-middle"><?=$img_url?></td>
                           <td> <strong><?=$row->pds_id?></strong> </td>
                           <td> <strong><?=$row->first_name?></strong> </td>
                           <td class="v-align-middle"><?=$row->department_name; ?></td>
                           <td class="v-align-middle"><?=$row->designation_name; ?></td>
                           <td class="v-align-middle"><?=$row->phone; ?></td>
                           <td class="v-align-middle"><?=$row->email; ?></td>
                           <td class="v-align-middle"><?=$row->sl_no; ?></td>
                           <td align="right">
                              <div class="btn-group"> <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> Action <span class="caret"></span> </a>
                                 <ul class="dropdown-menu pull-right">
                                    <!-- <li><?=anchor("pds/details/".encrypt_url($row->id), 'Details')?></li> -->
                                    <li><?=anchor("employee/edit/".($row->id), 'Edit')?></li>
                                    <li><a href="<?=base_url("employee/pdf_id_card/".encrypt_url($row->id))?>" target="_blank">ID Card Download</a></li>
                                    <!-- <li><?=anchor("employee/delete/".($row->id), 'Delete')?></li> -->
                                    <li><?=anchor("employee/activation/".($row->id)."/".$active, $row->active==0?'Active':'Deactive')?></li>
                                    <li><a href="<?=base_url("employee/change_password/".encrypt_url($row->id))?>">Change Password</a></li>
                                    
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