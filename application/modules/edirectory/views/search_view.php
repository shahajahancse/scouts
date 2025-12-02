<style type="text/css">
   .marTopSearch {
      margin-top: 10px;
   }

   @media screen and (max-width: 767px) {
      .search-form .row > div {
         margin-bottom: 10px;
      }

      .search-form .btn {
         width: 100%;
      }
   }
</style>

<form method="get" action="" class="search-form">

	<?php //if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->is_vendor()){ ?>
	<div class="row">
		<div class="col-md-3 col-sm-6">
			<?php $more_attr = 'class="form-control input-sm"';
			echo form_dropdown('designation', $designations, $_GET['designation'] ?? '', $more_attr);
			?>
		</div>
		<div class="col-md-2 col-sm-6 marTopSearch">
			<input type="text" name="name" class="form-control input-sm" value="<?=$_GET['name'] ?? '' ?>" placeholder="Name">
		</div>
		<div class="col-md-2 col-sm-6 marTopSearch">
			<input type="text" name="mobile" class="form-control input-sm" value="<?=$_GET['mobile'] ?? ''?>" placeholder="Mobile">
		</div>
		<div class="col-md-2 col-sm-6 marTopSearch">
			<input type="text" name="email" class="form-control input-sm" value="<?=$_GET['email'] ?? ''?>" placeholder="Email">
		</div>

		<div class="col-md-2 col-sm-6 marTopSearch">
			<select name="gender" class="form-control input-sm">
				<option value="">-- Gender --</option>
				<option value="Male" <?php echo isset($_GET['gender']) && $_GET['gender']=='Male'?'selected':''; ?>>Male</option>
				<option value="Female" <?php echo isset($_GET['gender']) && $_GET['gender']=='Female'?'selected':''; ?>>Female</option>
				<option value="others" <?php echo isset($_GET['gender']) && $_GET['gender']=='others'?'selected':''; ?>>Others</option>
			</select>
		</div>
		<div class="col-md-1 col-sm-12 marTopSearch">
			<button type="submit" class="btn btn-blueviolet btn-mini"><i class="icon-ok"></i> Search</button>
		</div>
	</div>

	<?php //} ?>

</form>

<div class="clearfix"></div>
<hr >
