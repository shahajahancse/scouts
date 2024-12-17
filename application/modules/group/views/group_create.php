<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('group/create')?>" class="active"><?=$module_name?> </a> </li>
         <li><?=$meta_title; ?></li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">                
                     <a href="<?=base_url('group/find')?>" class="btn btn-success btn-xs btn-mini"> Find Group</a>  
                  </div>
               </div>
               <div class="grid-body">
                  <!-- <div id="infoMessage"><?php //echo $message;?></div> -->
                  <div><?php //echo validation_errors(); ?></div>
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>
                  <?php echo form_open_multipart("group/create");?>
                  
                  <div class="row">
                     <div class="col-md-7">
                        <div class="row form-row">
                           <div class="col-md-6">
                              <label class="form-label">Division</label>
                              <?php echo form_error('group_div_id');
                              $more_attr = 'class="form-control input-sm" id="division"';
                              echo form_dropdown('group_div_id', $divisions, set_value('group_div_id'), $more_attr);
                              ?>
                           </div>
                           <div class="col-md-6">
                              <label class="form-label">District</label>
                              <?php echo form_error('group_dis_id');
                              $more_attr = 'class="form-control input-sm" id="district"';
                              echo form_dropdown('group_dis_id', $districts, set_value('group_dis_id'), $more_attr);
                              ?>
                           </div>
                        </div>

                        <div class="row form-row">
                           <div class="col-md-12">
                              <label class="form-label">Request Group Name</label>
                              <?php echo form_error('group_name');?>
                              <input name="group_name" id="group_name" value="<?=set_value('group_name')?>" type="text" class="form-control input-sm" placeholder="">
                           </div>
                        </div>

                     </div>

                     <div class="col-md-5">
                        <div class="row form-row">
                           <div class="col-md-6">
                              <label class="form-label">Upazila/Thana</label>
                              <?php echo form_error('group_upazila_id');
                              $more_attr = 'class="form-control input-sm" id="upazila"';
                              echo form_dropdown('group_upazila_id', $upazilas, set_value('group_upazila_id'), $more_attr);
                              ?>
                           </div>
                           <div class="col-md-6">
                              <label class="form-label">Group Type</label>
                              <?php echo form_error('group_type');
                              $more_attr = 'class="form-control input-sm" ';
                              echo form_dropdown('group_type', $group_types, set_value('group_type'), $more_attr);
                              ?>
                           </div>
                        </div>

                        <div class="row form-row">
                           <div class="col-md-6">
                              <label class="form-label">Date of Organization</label>
                              <?php echo form_error('group_date'); ?>
                              <input name="group_date" id="group_date" value="<?=set_value('group_date')?>" type="text" class="form-control input-sm datetime" placeholder="">
                           </div>
                           <div class="col-md-6">
                              <label class="form-label">Control Organization</label>
                              <?php echo form_error('group_control'); ?>
                              <input name="group_control" id="" value="1" type="radio" class="" placeholder="" checked> District &nbsp;&nbsp;
                              <input name="group_control" id="" value="2" type="radio" class="" placeholder=""> Upazila/ Thana
                           </div>
                        </div>
                     </div>
                  </div>
                  <br>

                  <!-- Group Scouters Council Start -->
                  <div class="row">
                  	<div class="col-md-12">
                  		<h4><span class="semi-bold">Group Scouters Council</span></h4>
                  		<table class="table table-hover table-bordered  table-flip-scroll cf">
			                	<thead class="cf">
			                  	<tr>
				                    	<th>SL</th>
				                    	<th>Leader Name</th>
				                    	<th>Training Taken Date</th>
				                    	<th>Certificate No.</th>
				                    	<th>Training Location</th>
				                    	<th>Responsibility</th>
				                  </tr>
			                	</thead>
				               <tbody>
				               <?php 
				               for ($sl = 1; $sl <= 5; $sl++):
				               ?>
				                  <tr>
				                   	<td><?=$sl.'.'?></td>
				                    	<td><input type="text" name="group_leader[]" class="form-control input-sm"></td>
				                     <td><input type="text" name="group_training_date[]" class="form-control input-sm datetime"></td>
				                     <td><input type="text" name="group_certificate_no[]" class="form-control input-sm"></td>        
				                     <td><input type="text" name="group_training_loc[]" class="form-control input-sm"></td>        
				                     <td><input type="text" name="group_responsibility[]" class="form-control input-sm"></td>        
				                  </tr>
				               <?php endfor;?>
				               </tbody>
			            	</table>
                  	</div>
                  </div>	<!-- End Group Scouters Council -->

                  <br>

                  <!-- Group Committee Start-->
                  <div class="row">
                  	<div class="col-md-12">
	                  	<h4><span class="semi-bold">Group Committee</span></h4>
   						</div>
                  </div>
                  <div class="row">
                  	<div class="col-md-6">
                        <div class="row form-row">
                           <div class="col-md-12">
                              <label class="form-label">President Name</label>
                              <?php echo form_error('group_president');?>
                              <input name="group_president" id="group_president" value="<?=set_value('group_president')?>" type="text" class="form-control input-sm" placeholder="">
                           </div>
                        </div>
                        <div class="row form-row">
                           <div class="col-md-12">
                              <label class="form-label">President Address</label>
                              <?php echo form_error('group_president_address');?>
                              <input name="group_president_address" id="group_president_address" value="<?=set_value('group_president_address')?>" type="text" class="form-control input-sm" placeholder="">
                           </div>
                        </div>

                     </div>
                  	<div class="col-md-6">
                        <div class="row form-row">
                           <div class="col-md-12">
                              <label class="form-label">Secretary Name</label>
                              <?php echo form_error('group_secretary');?>
                              <input name="group_secretary" id="group_secretary" value="<?=set_value('group_secretary')?>" type="text" class="form-control input-sm" placeholder="">
                           </div>
                        </div>
                        <div class="row form-row">
                           <div class="col-md-12">
                              <label class="form-label">Secretary Address</label>
                              <?php echo form_error('group_secretary_address');?>
                              <input name="group_secretary_address" id="group_secretary_address" value="<?=set_value('group_secretary_address')?>" type="text" class="form-control input-sm" placeholder="">
                           </div>
                        </div>

                     </div>
                  </div>	<!-- End Group Committee -->

                  <br>
                  <!-- Statistics Start -->
                  <div class="row">
                  	<div class="col-md-12">
                  		<h4><span class="semi-bold">Statistics</span></h4>
                  		<table class="table table-hover table-bordered  table-flip-scroll cf">
			                	<thead class="cf">
			                  	<tr>
				                    	<th>Division/ Class</th>
				                    	<th>Membership Badge</th>
				                    	<th>Standard Badge</th>
				                    	<th>Progress Badge</th>
				                    	<th>Service Badge</th>
				                    	<th>President Scout</th>
				                    	<th>Total</th>
				                  </tr>
			                	</thead>
				               <tbody>
				                  <tr>
				                   	<td>Club Scout</td>
				                    	<td><input type="text" name="group_member_badge" class="form-control input-sm"></td>
				                     <td><input type="text" name="group_standard_badge" class="form-control input-sm"></td>
				                     <td><input type="text" name="group_progress_badge" class="form-control input-sm"></td>        
				                     <td><input type="text" name="group_service_badge" class="form-control input-sm"></td>        
				                     <td><input type="text" name="group_president_scout" class="form-control input-sm"></td>        
				                     <td><input type="text" name="group_total" class="form-control input-sm"></td>
				                  </tr>
				                  <tr>
				                   	<td>Club Rover</td>
				                    	<td><input type="text" name="group_member_badge" class="form-control input-sm"></td>
				                     <td><input type="text" name="group_standard_badge" class="form-control input-sm"></td>
				                     <td><input type="text" name="group_progress_badge" class="form-control input-sm"></td>        
				                     <td><input type="text" name="group_service_badge" class="form-control input-sm"></td>        
				                     <td><input type="text" name="group_president_scout" class="form-control input-sm"></td>        
				                     <td><input type="text" name="group_total" class="form-control input-sm"></td>
				                  </tr>
				                  <tr>
				                   	<td>Total</td>
				                    	<td><input type="text" name="group_member_badge" class="form-control input-sm"></td>
				                     <td><input type="text" name="group_standard_badge" class="form-control input-sm"></td>
				                     <td><input type="text" name="group_progress_badge" class="form-control input-sm"></td>        
				                     <td><input type="text" name="group_service_badge" class="form-control input-sm"></td>        
				                     <td><input type="text" name="group_president_scout" class="form-control input-sm"></td>        
				                     <td><input type="text" name="group_total" class="form-control input-sm"></td>
				                  </tr>
				               </tbody>
			            	</table>
                  	</div>
                  </div>	<!-- End Statistics -->

                  <div class="form-actions">  
                     <div class="pull-right">
                        <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Save</button>
                     </div>
                  </div>
                  <?php echo form_close();?>

               </div>  <!-- END GRID BODY -->              
            </div> <!-- END GRID -->
         </div>

      </div> <!-- END ROW -->

   </div>
</div>