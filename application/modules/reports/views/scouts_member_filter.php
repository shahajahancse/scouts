<!-- <form method="get" action="">                     -->
	<div class="row">
		<div class="col-md-3 m-t-10">
			<?php $more_attr = 'class="form-control input-sm" id="dis_type"';
			echo form_dropdown('dis_type', $dis_type, $_GET['dis_type'] ?? '', $more_attr);
			?>
		</div>

		<div class="col-md-2 m-t-10">
			<input name="date_from" value="<?=set_value('date_from')?>" type="text" id="date_from" class="form-control input-sm datetime" placeholder="Date From">
		</div>
		<div class="col-md-2 m-t-10">
			<input name="date_to" value="<?=set_value('date_to')?>" type="text" id="date_to" class="form-control input-sm datetime" placeholder="Date To">
		</div>
		<div class="col-md-3 m-t-10">
			<select name="member_type" id="member_type" class="form-control input-sm">
				<option value="">-- Select Member Type --</option>
				<option value="1">Verify Member</option>
				<option value="2">Archive Member</option>
				<option value="3">Request Member</option>
			</select>
		</div>

	</div>

<!-- </form> -->

<div class="clearfix"></div>
<!-- <hr > -->
