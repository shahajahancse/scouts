<style type="text/css">
	.ml{margin-left: -15px;}
</style>
<form method="get" action="">
	<?php if($this->ion_auth->is_admin() || $this->ion_auth->is_vendor()){ ?>
	<div class="row">
		<div class="col-md-2">
			<?php $more_attr = 'class="form-control input-sm" id="region"';
			echo form_dropdown('region', $regions, $_GET['region'], $more_attr);
			?>
		</div>     
		<?php if(isset($_GET['region'])){ ?>    
         <div class="col-md-3 ml">
           	<?php $more_attr = 'class="sc_district_val input-sm" id="sc_district"';
           	echo form_dropdown('district', $scout_district, $_GET['district'], $more_attr);
           ?>
        	</div>	           
     	<?php }else{ ?>
        	<div class="col-md-3 ml">
           	<select name="district" class="sc_district_val input-sm" id="sc_district">
              	<option value="">-- Select One --</option>
           	</select>
        	</div>  
     	<?php } ?>    

     	<div class="col-md-2 ml">
			<select name="upazila" class="sc_upazila_thana_val form-control input-sm">
				<option value="">-- Select One --</option>
			</select>
		</div> 
		   
		<div class="col-md-2 ml">
			<input type="text" name="grpName" value="<?=$_GET['grpName']?>" class="form-control input-sm" placeholder="Scout Group Name">
		</div>
		<div class="col-md-2 ml">
			<input type="text" name="uName" value="<?=$_GET['uName']?>" class="form-control input-sm" placeholder="Username">
		</div>
		<div class="col-md-2 ml">
			<input type="text" name="charter" value="<?=$_GET['charter']?>" class="form-control input-sm" placeholder="Charter No">
		</div>
		<div class="col-md-1 ml">
			<div class="pull-right">
				<button type="submit" class="btn btn-blueviolet btn-mini"><i class="icon-ok"></i> Search</button>
			</div>
		</div>   
	</div>   
	<?php } ?>

	<?php if($this->ion_auth->is_region_admin()){ ?>
	<div class="row">
		<div class="col-md-3 ml">
			<?php $more_attr = 'class="form-control input-sm" id="sc_district"';
			echo form_dropdown('district', $scout_district, $_GET['district'], $more_attr);
			?>
		</div>  
		<?php if(isset($_GET['district'])){ ?>    
               <div class="col-md-3 ml">
                  <?php $more_attr = 'class="input-sm" id="sc_district"';
                  echo form_dropdown('upazila', $scout_upazila, $_GET['upazila'], $more_attr);
                  ?>
               </div>
            <?php }else{ ?>
               <div class="col-md-3 ml">
					<select name="upazila" class="sc_upazila_thana_val form-control input-sm">
						<option value="">-- Select One --</option>
					</select>
				</div>  
        <?php } ?>
         
		<div class="col-md-3 ml">
			<input type="text" name="grpName" value="<?=$_GET['grpName']?>" class="form-control input-sm" placeholder="Scout Group Name">
		</div>
		<div class="col-md-2 ml">
			<input type="text" name="uName" value="<?=$_GET['uName']?>" class="form-control input-sm" placeholder="Username">
		</div>
		<div class="col-md-2 ml">
			<input type="text" name="charter" value="<?=$_GET['charter']?>" class="form-control input-sm" placeholder="Charter No">
		</div>
		<div class="col-md-1 ml">
			<div class="pull-right">
				<button type="submit" class="btn btn-blueviolet btn-mini"><i class="icon-ok"></i> Search</button>
			</div>
		</div>   
	</div>
	<?php } ?>

	<?php if($this->ion_auth->is_district_admin()){ ?>
	<div class="row">
		<div class="col-md-4">
			<?php $more_attr = 'class="form-control input-sm"';
			echo form_dropdown('upazila', $scout_upazila, $_GET['upazila'], $more_attr);
			?>
		</div>  
		<div class="col-md-4 ml">
			<input type="text" name="grpName" value="<?=$_GET['grpName']?>" class="form-control input-sm" placeholder="Scout Group Name">
		</div>
		<div class="col-md-3 ml">
			<input type="text" name="uName" value="<?=$_GET['uName']?>" class="form-control input-sm" placeholder="Username">
		</div>
		<div class="col-md-2 ml">
			<input type="text" name="charter" value="<?=$_GET['charter']?>" class="form-control input-sm" placeholder="Charter No">
		</div>
		<div class="col-md-1 ml">
			<div class="pull-right">
				<button type="submit" class="btn btn-blueviolet btn-mini"><i class="icon-ok"></i> Search</button>
			</div>
		</div>   
	</div>
	<?php } ?>

	<?php if($this->ion_auth->is_upazila_admin()){ ?>
	<div class="row">
		<div class="col-md-4 ml">
			<input type="text" name="grpName" value="<?=$_GET['grpName']?>" class="form-control input-sm" placeholder="Scout Group Name">
		</div>
		<div class="col-md-3 ml">
			<input type="text" name="uName" value="<?=$_GET['uName']?>" class="form-control input-sm" placeholder="Username">
		</div>
		<div class="col-md-2 ml">
			<input type="text" name="charter" value="<?=$_GET['charter']?>" class="form-control input-sm" placeholder="Charter No">
		</div>
		<div class="col-md-1 ml">
			<div class="pull-right">
				<button type="submit" class="btn btn-blueviolet btn-mini"><i class="icon-ok"></i> Search</button>
			</div>
		</div>   
	</div>
	<?php } ?>
</form>

<div class="clearfix"></div>
<hr >