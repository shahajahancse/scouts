<form method="get" action="">
	
	<?php //if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->is_vendor()){ ?>                     
	<div class="row">
		<div class="col-md-3">
			<?php $more_attr = 'class="form-control input-sm"';
			echo form_dropdown('designation', $designations, $_GET['designation'], $more_attr);
			?>
		</div> 
		<div class="col-md-2 marTopSearch">     
			<input type="text" name="name" class="form-control input-sm" value="<?=$_GET['name']?>" placeholder="Name"> 
		</div>
		<div class="col-md-2 marTopSearch">     
			<input type="text" name="mobile" class="form-control input-sm" value="<?=$_GET['mobile']?>" placeholder="Mobile"> 
		</div>
		<div class="col-md-2 marTopSearch">     
			<input type="text" name="email" class="form-control input-sm" value="<?=$_GET['email']?>" placeholder="Email"> 
		</div>

		<div class="col-md-2 marTopSearch">
			<select name="gender" class="form-control input-sm">
				<option value="">-- Gender --</option>
				<option value="Male" <?= $_GET['gender']=='Male'?'selected':''; ?>>Male</option>
				<option value="Female" <?= $_GET['gender']=='Female'?'selected':''; ?>>Female</option>
				<option value="Others" <?= $_GET['gender']=='Others'?'selected':''; ?>>Others</option>
			</select>
		</div>
		<div class="col-md-1 marTopSearch">
			<div class="pull-right ">
				<button type="submit" class="btn btn-blueviolet btn-mini"><i class="icon-ok"></i> Search</button>
			</div>
		</div>
	</div>

	<?php //} ?>
	
</form>

<div class="clearfix"></div>
<hr >