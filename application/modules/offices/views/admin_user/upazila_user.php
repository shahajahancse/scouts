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
                     <a href="<?=base_url('offices/upazila')?>" class="btn btn-success btn-xs btn-mini"> Upazila List</a>  
                     <a href="<?=base_url('offices/upazila_details/'.encrypt_url($info->id))?>" class="btn btn-success btn-xs btn-mini"> Upazila Details</a>  
                     <a href="<?=base_url('offices/upazila_user_add/'.encrypt_url($info->id))?>" class="btn btn-blueviolet btn-xs btn-mini"> Upazila Admin User Add</a>  
                     <a href="<?=base_url('offices/upazila_user_pdf/'.encrypt_url($info->id))?>" class="btn btn-blueviolet btn-xs btn-mini" target="_blank"> Upazila Admin User PDF</a>  
                  </div>
               </div>
               <div class="grid-body">
                 <div><?php //echo validation_errors(); ?></div>
                 <?php if($this->session->flashdata('success')):?>
                    <div class="alert alert-success">
                       <?=$this->session->flashdata('success');;?>
                    </div>
                 <?php endif; ?>

                 <table class="table table-hover table-condensed"> 
                  <thead>
                     <tr>
                        <th style="width:2%"> SL </th>
                        <th style="width:20%">Name</th>
                        <th style="width:15%">Scout ID</th>
                        <th style="width:15%">Designation</th>
                        <th style="width:10%">Phone</th>
                        <th style="width:10%">Email</th>
                        <th style="width:20%">Remark</th>
                        <th style="text-align: right !important; width: 10%;">Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php 
                     $sl=0;
                     foreach ($user_list as $row):
                        $sl++;
                        if($row->member_type == 1){
                          $name         = $row->first_name;
                          $phone        = $row->phone;
                          $email        = $row->email;
                          //Scouts member section / designation
                           if($row->member_id == 2){
                              if($row->sc_section_id <= 3){
                                 $designation = get_scout_section($row->sc_section_id);
                              }else{
                                 $designation = '';
                              }
                           }elseif($row->member_id == 8){
                              $designation = 'Adult Leader';
                           }elseif($row->member_id == 9){
                              $designation = 'Professional Executive';
                           }elseif($row->member_id == 10){
                              $designation = $row->role_type_name_en;
                           }elseif($row->member_id == 12){
                              $designation = $row->role_type_name_en;
                           }elseif($row->member_id == 13){
                              $designation = 'Support Staff';
                           }
                        }else{
                          $name = $row->user_name;
                          $designation  = $row->user_designation;
                          $phone        = $row->user_phone;
                          $email        = $row->user_email;
                        }

                     ?>
                     <tr>
                        <td class="v-align-middle"><?=$sl.'.'?></td>
                        <td> <?=$name?> </td>
                        <td> <?php if($row->scout_id){ ?>
                            <a href="<?=base_url('user-verify?scoutID='.$row->scout_id)?>" target="_blank"> <?=$row->scout_id?></a>
                            <?php } ?> 
                         </td>
                        <td class="v-align-middle"> <?=$designation?> </td>
                        <td> <?=$phone?> </td>
                        <td> <?=$email?> </td>
                        <td> <?=$row->user_remarks?> </td>
                        <td align="right">
                           <div class="btn-group"> <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> Action <span class="caret"></span> </a>
                              <ul class="dropdown-menu pull-right">
                                 <li><a href="<?=base_url("offices/upazila_user_edit/".encrypt_url($row->id))?>">Update</a></li>                             
                                 <li class="divider"></li>
                                 <li><a href="<?=base_url("offices/upazila_user_delete/".encrypt_url($row->id).'/'.encrypt_url($info->id))?>" onclick="return confirm('Be careful! Are you sure you want to delete this scouts region?');">Delete</a></li>
                              </ul>
                           </div>
                        </td>                         
                     </tr>
                  <?php endforeach;?>                      
               </tbody>
            </table>


         </div>  <!-- END GRID BODY -->              
      </div> <!-- END GRID -->
   </div>

</div> <!-- END ROW -->

</div>
</div>
