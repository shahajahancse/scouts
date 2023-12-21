<!-- <form method="get" action="">                     -->
	<div class="row">
   <?php /*
		<div class="col-md-3">
			<?php $more_attr = 'class="form-control input-sm" id="region"';
			echo form_dropdown('region', $regions, $_GET['region'], $more_attr);
			?>
		</div>     
		<div class="col-md-3">
			<select name="district" class="sc_district_val form-control input-sm" id="sc_district">
				<option value="">-- Scouts District --</option>
			</select>
		</div>     
		<div class="col-md-3">
			<select name="upazila" class="sc_upazila_thana_val form-control input-sm" id="sc_upazila_thana">
				<option value="">-- Scouts Upazila --</option>
			</select>
		</div>           
		<div class="col-md-3"> 
			<select name="sgroup" class="sc_group_val form-control input-sm">
				<option value="">-- Scouts Group --</option>
			</select>
		</div>
		<div class="col-md-3 m-t-10">
			<?php $more_attr = 'class="form-control input-sm"';
			echo form_dropdown('memberType', $member_type, $_GET['memberType'], $more_attr);
			?>
		</div>
      */ ?>
      <div class="col-md-3 m-t-10">
         <?php $more_attr = 'class="form-control input-sm"';
         echo form_dropdown('dis_type', $dis_type, $_GET['dis_type'], $more_attr);
         ?>
      </div>

       <?php /*
		<div class="col-md-2 m-t-10">
			<select name="gender" class="form-control input-sm">
				<option value="">-- Gender --</option>
				<option value="Male" <?= $_GET['gender']=='Male'?'selected':''; ?>>Male</option>
				<option value="Female" <?= $_GET['gender']=='Female'?'selected':''; ?>>Female</option>
			</select>
		</div>

		<div class="col-md-2 m-t-10">
			<?php $more_attr = 'class="form-control input-sm"';
			echo form_dropdown('section', $scout_section, $_GET['section'], $more_attr);
			?>
		</div>
      */ ?>
      <div class="col-md-2 m-t-10">
         <input name="date_from" value="<?=set_value('date_from')?>" type="text" id="date_from" class="form-control input-sm datetime" placeholder="Date From">
      </div>
      <div class="col-md-2 m-t-10">
         <input name="date_to" value="<?=set_value('date_to')?>" type="text" id="date_to" class="form-control input-sm datetime" placeholder="Date To">
      </div>

	</div>
	
<!-- </form> -->

<div class="clearfix"></div>
<!-- <hr > -->