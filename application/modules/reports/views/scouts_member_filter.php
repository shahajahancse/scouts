<div class="row" style="margin-bottom: 10px;">
	<div class="col-md-3 col-sm-6 m-t-10">
		<label for="dis_type" style="font-weight: 600; font-size: 13px;">District Type <span class="text-danger">*</span></label>
		<?php 
			$more_attr = 'class="form-control input-sm" id="dis_type" onchange="clearErrorBorder(this)"';
			echo form_dropdown('dis_type', $dis_type, $_POST['dis_type'] ?? ($_GET['dis_type'] ?? ''), $more_attr);
		?>
	</div>

	<div class="col-md-3 col-sm-6 m-t-10">
		<label for="date_from" style="font-weight: 600; font-size: 13px;">Date From <span class="text-danger">*</span></label>
		<div class="input-group">
			<input name="date_from" value="<?=set_value('date_from', $_POST['date_from'] ?? '')?>" type="text" id="date_from" class="form-control input-sm datetime" placeholder="DD-MM-YYYY" autocomplete="off" onchange="clearErrorBorder(this)">
			<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
		</div>
	</div>

	<div class="col-md-3 col-sm-6 m-t-10">
		<label for="date_to" style="font-weight: 600; font-size: 13px;">Date To <span class="text-danger">*</span></label>
		<div class="input-group">
			<input name="date_to" value="<?=set_value('date_to', $_POST['date_to'] ?? '')?>" type="text" id="date_to" class="form-control input-sm datetime" placeholder="DD-MM-YYYY" autocomplete="off" onchange="clearErrorBorder(this)">
			<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
		</div>
	</div>

	<div class="col-md-3 col-sm-6 m-t-10">
		<label for="member_type" style="font-weight: 600; font-size: 13px;">Member Type (For Member List)</label>
		<?php $sel_member = $_POST['member_type'] ?? ''; ?>
		<select name="member_type" id="member_type" class="form-control input-sm" onchange="clearErrorBorder(this)">
			<option value="">-- All Member Types --</option>
			<option value="1" <?=$sel_member == '1' ? 'selected' : ''?>>Verify Member</option>
			<option value="2" <?=$sel_member == '2' ? 'selected' : ''?>>Archive Member</option>
			<option value="3" <?=$sel_member == '3' ? 'selected' : ''?>>Request Member</option>
		</select>
	</div>
</div>

<div class="row" style="margin-top: 5px;">
	<div class="col-md-12 text-right">
		<button type="button" class="btn btn-default btn-xs btn-mini" onclick="resetFilters()"><i class="fa fa-refresh"></i> Reset Filters</button>
	</div>
</div>

<div class="clearfix"></div>
