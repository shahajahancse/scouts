<style type="text/css">
	.marTopSearch{margin-top: 10px;}
</style>
<form method="get" action="">
	<div class="row">		
		<div class="col-md-2">
			<?php
			$more_attr = 'class="form-control input-sm"';
			echo form_dropdown('award', $scouts_award, set_value('award'), $more_attr);
			?>
		</div>

		<?php if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ ?>                     
		<div class="col-md-3">
			<?php 
			$more_attr = 'class="form-control input-sm" id="region"';
			echo form_dropdown('region', $regions, $_GET['region'], $more_attr);
			?>
		</div>   
		<div class="col-md-3">
			<?php 
			//$more_attr = 'class="sc_district_val form-control input-sm" id="sc_district"';
			//echo form_dropdown('district', $scouts_district, $_GET['district'], $more_attr);
			?>
			<select name="district" class="sc_district_val form-control input-sm" id="sc_district">
				<option value="">-- Scouts District --</option>
			</select>
		</div>	

		<?php }elseif($this->ion_auth->is_region_admin()){ ?> 

		<div class="col-md-3">
			<?php 
			$more_attr = 'class="form-control input-sm""';
			echo form_dropdown('district', $scouts_district, $_GET['district'], $more_attr);
			?>
		</div> 

		<?php } ?>

		<div class="col-md-1" style="border: 0px solid red; width: 70px;">
			<div class="pull-right ">
				<button type="submit" class="btn btn-blueviolet btn-mini"><i class="icon-ok"></i> Search</button>
			</div>
		</div>		

	<!-- </div>

	<div class="row marTopSearch"> -->
	<?php if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ ?>
		<?php if (!empty($_GET['award']) || !empty($_GET['region']) || !empty($_GET['district'])) { ?>
		<div class="col-md-2" style="border: 0px solid red; width: 120px;">
			<div class="row" style="float: right;">
				<a href="<?= $download_url ?>" target="_blank" class="btn btn-primary btn-xs btn-mini">Application Download</a>
			</div>
		</div>
		<div class="col-md-2"  style="border: 0px solid red; width: 120px;">
			<div class="row" style="float: right;">
				<a href="<?=$download_approve_url?>" target="_blank" class="btn btn-primary btn-xs btn-mini"> Approve Application</a>
			</div>
		</div>
		<?php } ?>	
	<?php } ?>
	</div>

</form>

<div class="clearfix"></div>
<hr >