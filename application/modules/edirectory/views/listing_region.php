<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dahsboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('edirectory/listing_region')?>" class="active"><?=$module_name?> </a></li>
         <li><?=$meta_title; ?> </li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple ">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                     <?php //if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ ?>
                     <a href="<?=base_url('edirectory/create_contact_region')?>" class="btn btn-blueviolet btn-xs btn-mini"> Add Contact</a>
                     <?php //} ?>
                  </div>            
               </div>

               <div class="grid-body ">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>
                  <?php $this->load->view('search_view')?>

                  <table class="table table-hover table-condensed" border="0">
                     <thead>
                        <tr>
                           <th style="width:2%"> SL </th>
                           <!-- <th style="width:15%">Office Level</th> -->
                           <th style="width:20%">Scouts Designation</th>
                           <th style="width:5%">Image</th>
                           <th style="width:18%">Name</th>
                           <th style="width:18%">Phone </th>
                           <th style="width:7%">Email</th>
                           <th style="width:7%">Status</th>
                           <th style="width:7%; text-align: right;">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        $sl=$pagination['current_page'];
                        foreach ($results as $row):
                           $sl++;

                        // Profile Image
                        if($row->scout_id != NULL){
                           $img_url = '<img src="'.base_url('profile_img/'.$row->profile_img).'" height="20">';
                        }elseif($row->image_file != NULL){
                           $img_url = '<img src="'.base_url('uploads/edirectory_img/'.$row->image_file).'" height="20">';
                        }else{
                           $img_url = '<img src="'.base_url('uploads/edirectory_img/no-image.jpg').'" height="20">';
                        }

                        if($row->status == 1) {
                           $status = '<button class="btn btn-mini btn-info">Enable</button>';
                        }else{
                           $status = '<button class="btn btn-mini btn-danger">Disable</button>';
                        }
                        ?>
                        <tr>
                           <td class="v-align-left"><?=$sl.'.'?></td>
                           <!-- <td> <?=$row->office_type_name?> </td> -->
                           <td> <strong><?=$row->scout_desig_id == 100 ? $row->other_desig_name : $row->committee_designation_name_en?></strong> </td>
                           <td> <?=$img_url?> </td>
                           <td> <?=$row->name?> </td>
                           <td> <?=$row->phone?> </td>
                           <td> <?=$row->email?> </td>
                           <td> <?=$status?></td>
                           <td align="right">
                              <div class="btn-group"> <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> Action <span class="caret"></span> </a>
                                 <ul class="dropdown-menu pull-right">
                                    <li><?=anchor("edirectory/details/".encrypt_url($row->id), 'Details')?></li>
                                    <li><?=anchor("edirectory/edit/".encrypt_url($row->id), 'Edit')?></li>
                                    <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin()){ ?> 
                                    <li><?=anchor("edirectory/delete_contact/".encrypt_url($row->id), 'Delete', 'onclick="return confirm(\'Be careful! Are you sure you want to delete this contact?\');"')?></li>
                                    <?php } ?>
                                 </ul>
                              </div>
                           </td>
                        </tr>
                     <?php endforeach;?>                      
                  </tbody>
               </table>

               <div class="row">
                  <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> Total <span style="color: green; font-weight: bold;"><?php echo $total_rows; ?> Directory Contact </span></div>
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