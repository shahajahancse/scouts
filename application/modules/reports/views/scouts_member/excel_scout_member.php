<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body style="width:800px;">
    <?php
        $filename = str_replace(' ', '_', $type) . "_" . date('d-m-Y') . ".xls";
        header('Content-Type: application/vnd.ms-excel; charset=utf-8');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
    ?>

	<style type="text/css">
		.priview-body{font-size: 14px;color:#000;margin: 20px;}
		.priview-header{margin-bottom: 12px;text-align:center;}
		.table{width:100%;border-collapse: collapse;}
		.table td, .table th{border:1px solid #999; padding: 4px 6px;}
		.text-center{text-align: center;}
		.text-left{text-align: left;}
		.text-right{text-align: right;}
	</style>

	<div class="priview-body">
		<div class="priview-header">
			<p class="text-center">
				<span style="font-size:18px;font-weight: bold;">Bangladesh Scouts</span><br>
				<span style="font-size: 13px;">60, Anjuman Mufidul Islam Road, Kakrail, Dhaka – 1000</span><br>
				<span style="font-size: 12px;">www.scouts.gov.bd</span><br><br>
				<u style="font-size:15px; font-weight: bold;"><?=$type?></u><br>
				<?php if(!empty($dis_type_info)): ?>
					<span style="font-size: 13px;">District Type: <?=$dis_type_info->district_type_name?></span><br>
				<?php endif; ?>
				<?php if(!empty($date_from) && !empty($date_to)): ?>
					<span style="font-size: 13px;">Date From: <?=$date_from?> &nbsp;|&nbsp; Date To: <?=$date_to?></span><br>
				<?php endif; ?>
				<span style="font-size: 12px;">Report Date: <?=date('d-m-Y')?></span>
			</p>
		</div>

		<table align="center" border="1" cellspacing="0" cellpadding="4" style="font-size:12px; width:100%; border-collapse: collapse;">
			<thead>
				<tr style="background-color: #e9edf0; font-weight: bold;">
					<th class="text-center" style="width: 50px;">#</th>
					<th class="text-left">Name</th>
					<th class="text-center" style="width: 110px;">Scout ID</th>
					<th class="text-left">Member Type</th>
					<th class="text-left">Section</th>
					<th class="text-left">Badge</th>
					<th class="text-left">Petrol Name</th>
					<th class="text-center" style="width: 60px;">Age</th>
					<th class="text-left">Username</th>
					<th class="text-center" style="width: 100px;">Last Login</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$i = 0;
				if (!empty($results)):
					foreach ($results as $row):  
						$i++; 
				?>
					<tr>
						<td class="text-center"><?= $i ?>.</td>
						<td class="text-left"><?= $row->first_name ?></td>
						<td class="text-center"><?= $row->scout_id ?></td>
						<td class="text-left"><?= $row->member_type_name ?></td>
						<td class="text-left"><?= get_scout_section($row->sc_section_id) ?></td>
						<td class="text-left"><?= !empty($row->badge_name) ? $row->badge_name : '' ?></td>
						<td class="text-left"><?= $row->petrol_name ?></td>
						<td class="text-center"><?= $row->dob ? get_age($row->dob) : '' ?></td>
						<td class="text-left"><?= $row->username ?></td>
						<td class="text-center"><?= $row->last_login ? date('d-m-Y', $row->last_login) : '' ?></td>
					</tr>
				<?php 
					endforeach; 
				else:
				?>
					<tr>
						<td colspan="10" class="text-center">No records found.</td>
					</tr>
				<?php endif; ?>
			</tbody>
			<tfoot>
				<tr style="background-color: #dbe2e8; font-weight: bold;">
					<td colspan="9" class="text-right">Total Records:</td>
					<td class="text-center"><?= number_format($i) ?></td>
				</tr>
			</tfoot>
		</table>
	</div>
</body>
</html>
<?php exit; ?>
