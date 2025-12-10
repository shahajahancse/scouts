<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
<head>

</head>


<body style="width:800px;">
    <?php
        $filename = $type.".xls";
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
    ?>

	<style type="text/css">
		.priview-body{font-size: 16px;color:#000;margin: 25px;}
		.priview-header{margin-bottom: 10px;text-align:center;}
		.priview-header div{font-size: 18px;}
		.priview-memorandum{padding-bottom: 20px;}
		.headding{border-top:1px solid #000;border-bottom:1px solid #000;text-align:center;}

		.table{width:100%;border-collapse: collapse;}
		.table td, .table th{border:0px solid #ddd;}
	</style>

	<div class="priview-body">
		<div class="priview-header">
			<p class="text-center">
				<u style="font-size:16px;"><?=$type?></u><br>
			</p>
		</div>

		<table align="center" height="auto"  class="sal" border="1" cellspacing="0" cellpadding="2" style="font-size:12px; width:750px;">
			<tr>
				<th class="text-left">#</th>
				<th class="text-left">Name</th>
				<th class="text-left">Scout ID</th>
				<th class="text-left">Member Type</th>
				<th class="text-left">Section</th>
				<th class="text-left">Badge</th>
				<th class="text-left">Petrol Name</th>
				<th class="text-left">Age Number</th>
				<th class="text-left">Username</th>
				<th class="text-left">Last Login</th>
			</tr>
			<?php $i=0;
			foreach ($results as $row) {  $i++; ?>
				<tr>
					<td class="text-left"><?= eng2bng($i) ?>.</td>
					<td class="text-left"><?= $row->first_name ?></td>
					<td class="text-left"><?= $row->scout_id ?></td>
					<td class="text-left"><?= $row->member_type_name ?></td>
					<td class="text-left"><?= get_scout_section($row->sc_section_id) ?></td>
					<td class="text-left"><?= get_scout_badge($row->sc_badge_id) ?></td>
					<td class="text-left"><?= $row->petrol_name ?></td>
					<td class="text-left"><?= $row->dob ? get_age($row->dob) : '' ?></td>
					<td class="text-left"><?= $row->last_login ? date('d-m-Y', $row->last_login) : '' ?></td>
					<td class="text-left"><?= $row->username ?></td>
				</tr>
			<?php } ?>
		</table>
	</div>
</body>
</html>
<?php exit; ?>
