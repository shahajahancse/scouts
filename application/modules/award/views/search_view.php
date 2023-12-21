<style type="text/css">
	.marTopSearch{margin-top: 10px;}
</style>
<form method="get" action="">
	
	<?php if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ ?>                     
	<div class="row">
		<div class="col-md-3">
			<?php $more_attr = 'class="form-control input-sm" id="region"';
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
		<div class="col-md-3">
			<?php 
			//$more_attr = 'class="sc_upazila_thana_val form-control input-sm" id="sc_upazila_thana"';
			//echo form_dropdown('upazila', $scouts_upazila, $_GET['upazila'], $more_attr);
			?>
			<select name="upazila" class="sc_upazila_thana_val form-control input-sm" id="sc_upazila_thana">
				<option value="">-- Scouts Upazila --</option>
			</select>
		</div>           
		<div class="col-md-3"> 
			<?php 
			// $more_attr = 'class="sc_group_val form-control input-sm basic-select2"';
			// echo form_dropdown('sgroup', $scouts_group, $_GET['sgroup'], $more_attr);
			?>    
			<select name="group" class="sc_group_val form-control basic-select2 input-sm">
				<option value="">-- Scouts Group --</option>
			</select>
		</div>
		<!-- <div class="col-md-2"> -->
			<?php //$more_attr = 'class="form-control input-sm"';
			//echo form_dropdown('memberType', $member_type, $_GET['memberType'], $more_attr);
			?>
			<!-- </div> -->
		</div>

		<div class="row">
			<div class="col-md-3 marTopSearch">
				<select name="gender" class="form-control input-sm">
					<option value="">-- Gender --</option>
					<option value="Male" <?= $_GET['gender']=='Male'?'selected':''; ?>>Male</option>
					<option value="Female" <?= $_GET['gender']=='Female'?'selected':''; ?>>Female</option>
					<option value="Others" <?= $_GET['gender']=='Others'?'selected':''; ?>>Others</option>
				</select>
			</div>
			<div class="col-md-3 marTopSearch">
				<?php $more_attr = 'class="form-control input-sm"';
				echo form_dropdown('year', $years, $_GET['year'], $more_attr);
				?>
			</div>
			<div class="col-md-1 marTopSearch">
				<div class="pull-right ">
					<button type="submit" class="btn btn-blueviolet btn-mini"><i class="icon-ok"></i> Search</button>
				</div>
			</div>


			<div class="col-md-3 marTopSearch">
				<?php if (!empty($_GET['region']) || !empty($_GET['gender']) || !empty($_GET['year'])) { ?>
				<div class="row" style="float: right;">
					<!-- <a href="<?= $doc_url ?>" class="btn btn-blueviolet btn-xs btn-mini" >DOC Download</a> -->

					<a href="<?= $download_url ?>" class="btn btn-primary btn-xs btn-mini">PDF Download</a>

					<!-- <a href="<?= $excel_url ?>" class="btn btn-success btn-xs btn-mini" >Excel Download</a> -->
				</div>
				<?php } ?>				
			</div>
		</div>

		<?php } ?>

	</form>

	<div class="clearfix"></div>
	<hr >