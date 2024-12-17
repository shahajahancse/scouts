<div class="page-content">
	<div class="content">
		<div class="page-title"> <i class="fa fa-dashboard"></i>
			<h3>Dashboard</h3>
		</div>

		<div class="row">  
			<div class="col-md-12">
				<?php if($info->id){ ?>

				<style type="text/css">
					.tg  {border-collapse:collapse;border-spacing:0;}
					.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal; color: black;}
					.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal; color: black; font-weight: bold; vertical-align: top; width: 150px;}
					.tg .tg-d8ej{background-color:#b9c9fe}
					#memberDiv td{padding: 5px; color: black;}
					#memberDiv th{padding: 5px; font-weight: bold; color: black;}
				</style>
				<?php
				if($info->is_current == 1) {
					$status = '<button class="btn btn-mini btn-info">Current</button>';
				}else{
					$status = '<button class="btn btn-mini btn-primary">Expired</button>';
				}
				?>

				<h2>Welcome, <strong><?=$info->grp_name?></strong></h2> <br><br>

				<table class="tg">
                  <tr>
                     <th class="tg-d8ej"> Committee Name</th>
                     <td class="tg-031e"><?=$info->committee_name?></td>
                     <th class="tg-d8ej"> Strat Date</th>
                     <td class="tg-031e"><?=$info->session_start_date?></td>
                  </tr>        
                  <tr>
                     <th class="tg-d8ej"> Unit Name</th>
                     <td class="tg-031e"><?=$info->unit_name?></td>
                     <th class="tg-d8ej"> End Date</th>
                     <td class="tg-031e"><?=$info->session_end_date?></td>                     
                  </tr>  
                  <tr>
                     <th class="tg-d8ej"> Group Name</th>
                     <td class="tg-031e"><?=$info->grp_name?></td>
                     <th class="tg-d8ej"> Status</th>
                     <td class="tg-031e"><?=$status?></td>
                  </tr>  
                  <tr>
                     <th class="tg-d8ej"> Upazila Office</th>
                     <td class="tg-031e" colspan="3"><?=$info->upa_name?></td>
                     
                  </tr>
                  <tr>
                     <th class="tg-d8ej"> District Office Name</th>
                     <td class="tg-031e" colspan="3"><?=$info->dis_name?></td>
                  </tr>
                  <tr>
                     <th class="tg-d8ej"> Region Office Name</th>
                     <td class="tg-031e" colspan="3"><?=$info->region_name?></td>     

                  </tr>
               </table>

				<h4 style="font-weight: bold;"> Committee Member List </h4>
				<table width="100%" border="1" id="memberDiv">
					<tr>
						<th width="150">Scout ID</th>
						<th width="150">Name</th>
						<th>Groups</th>
						<th width="200">Committee Designation</th>
						<th width="300">Profession</th>
						<th width="300">Address</th>
					</tr>
					<?php 
					$sl=0;
					foreach ($members as $row):
						$sl++;
					?>
					<tr>
						<td> <?=$row->scout_id?> </td>
						<td> <?=$row->first_name?> </td>
						<td>
							<?php 
                        foreach ($row->groups as $group):
                        echo '<span class="btn btn-primary btn-xs btn-mini" style="background-color:#6b64d0;margin-bottom:1px;">'.htmlspecialchars($group->description,ENT_QUOTES,'UTF-8').'</span>';
                        echo '&nbsp;';
                        endforeach;
                        ?>
						</td>
						<td> <?=$row->committee_designation_name?> </td>
						<td> <?=$row->member_profession?> </td>            
						<td> <?=$row->member_address?> </td>            
					</tr>
				<?php endforeach;?> 
			</table>

			<?php }else{ ?>
			<div class="alert alert-block alert-error fade in">
				<h4 class="alert-heading"><i class="icon-warning-sign"></i> No Access!</h4>
				<p> <h4>Currently you have no group access.</h4> </p>
				<!-- <div class="button-set">
					<button class="btn btn-danger btn-cons" type="button">Do this</button>
					<button class="btn btn-white btn-cons" type="button">Or this</button>
				</div> -->
			</div>
			<?php } ?>			
		</div>
	</div>

</div>
</div>