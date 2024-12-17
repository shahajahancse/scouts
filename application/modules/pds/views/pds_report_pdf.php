<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?=$headding?></title>
	<style type="text/css">
		.priview-body{font-size: 16px;color:#000;margin: 25px;}
		.priview-header{margin-bottom: 10px;text-align:center;}
		.priview-header div{font-size: 18px;}
		.priview-memorandum, .priview-from, .priview-to, .priview-subject, .priview-message, .priview-office, .priview-demand, .priview-signature{padding-bottom: 20px;}
		.priview-office{text-align: center;}
		.priview-imitation ul{list-style: none;}
		.priview-imitation ul li{display: block;}
		.date-name{width: 20%;float: left;padding-top: 23px;text-align: right;}
		.date-value{width: 70%;float:left;}
		.date-value ul{list-style: none;}
		.date-value ul li{text-align: center;}
		.date-value ul li.underline{border-bottom: 1px solid black;}
		.subject-content{text-decoration: underline;}
		.headding{border-top:1px solid #000;border-bottom:1px solid #000;}

		.col-1{width:8.33%;float:left;}
		.col-2{width:16.66%;float:left;}
		.col-3{width:25%;float:left;}
		.col-4{width:33.33%;float:left;}
		.col-5{width:41.66%;float:left;}
		.col-6{width:50%;float:left;}
		.col-7{width:58.33%;float:left;}
		.col-8{width:66.66%;float:left;}
		.col-9{width:75%;float:left;}
		.col-10{width:83.33%;float:left;}
		.col-11{width:91.66%;float:left;}
		.col-12{width:100%;float:left;}

		.table{width:100%;border-collapse: collapse;}
		.table td, .table th{border:1px solid #ddd;}
		.table tr.bottom-separate td,
		.table tr.bottom-separate td .table td{border-bottom:1px solid #ddd;}
		/*.table tr {line-height: 30px;}*/
		.borner-none td{border:0px solid #ddd;}
		.headding td, .total td{border-top:1px solid #ddd;border-bottom:1px solid #ddd;}
		.table td{padding:5px;}
		.text-center{text-align:center;}
		.text-right{text-align:right;}
		b{font-weight:500;}
	</style>
</head>
<body>
	<div class="priview-body">
		<div class="priview-header">
			<h3> BANGLADESH SCOUTS </h3>
			<span style="font-size:12px;">www.scouts.gov.bd</span>
		</div>
		<br>

		<div class="priview-memorandum">
			<div class="row">
				<div class="col-md-12" style="text-align: center;">
					<span style="color: black; font-size: 16px; font-weight: bold;"><?=$meta_title;?></span>
				</div>
			</div>
		</div>

		<div class="priview-demand">
			<style type="text/css">
				.tg  {border-collapse:collapse;border-spacing:0;}
				.tg td{font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
				.tg th{font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
				.tg .tg-uzvj{font-weight:bold;border-color:inherit;text-align:center;vertical-align:middle}
				.tg .tg-amwm{font-weight:bold;text-align:center;vertical-align:top}
				.tg .tg-7btt{font-weight:bold;border-color:inherit;text-align:center;vertical-align:top}
				.tg .tg-0pky{border-color:inherit;text-align:left;vertical-align:top}
				.tg .tg-0lax{text-align:left;vertical-align:top}
			</style>
			<table class="tg">
				<tr>
					<th class="tg-uzvj" rowspan="2">SL</th>
					<th class="tg-uzvj" rowspan="2">PDS ID</th>
					<th class="tg-uzvj" rowspan="2">Name</th>
					<th class="tg-uzvj" rowspan="2">Present Designation</th>
					<th class="tg-uzvj" rowspan="2">Present Address</th>
					<th class="tg-uzvj" rowspan="2">Permanent Address</th>
					<th class="tg-uzvj" rowspan="2">DOB</th>
					<th class="tg-7btt" rowspan="2">Joining Date</th>
					<th class="tg-7btt" rowspan="2">Working Station</th>
					<th class="tg-7btt" colspan="2">Duration</th>
					<th class="tg-7btt" rowspan="2">Served As</th>
					<th class="tg-7btt" rowspan="2">Total Duration</th>
					<th class="tg-7btt" rowspan="2">Total Service Duration</th>
				</tr>
				<tr>
					<td class="tg-7btt">From</td>
					<td class="tg-7btt">To</td>
				</tr>
				<?php 				
				$i=0;	
				$work_station = array();	
				foreach ($results as $row) { 
					$i++;		
					
					$work_station = $this->Pds_model->get_work_station_by_id($row->id); 	
					// echo '<pre>';
					// echo $work_station[0]->working_place;
					// print_r($work_station); exit;
					?>
					<tr>
						<td class="tg-0pky" rowspan="<?=count($work_station)?>"><?=$i?></td>
						<td class="tg-0pky" rowspan="<?=count($work_station)?>"><?=$row->pds_id?></td>
						<td class="tg-0pky" rowspan="<?=count($work_station)?>"><?=$row->name_en?></td>
						<td class="tg-0pky" rowspan="<?=count($work_station)?>"><?=$row->current_desig?> </td>
						<td class="tg-0pky" rowspan="<?=count($work_station)?>"><?=$row->present_address?></td>
						<td class="tg-0pky" rowspan="<?=count($work_station)?>"><?=$row->permanent_address?></td>
						<td class="tg-0pky" rowspan="<?=count($work_station)?>"><?=date_sort_form($row->dob)?></td>
						<td class="tg-0pky" rowspan="<?=count($work_station)?>"><?=date_sort_form($row->join_date)?></td>
						<?php //for ($j=0; $j < 1; $j++) { ?>
						<td class="tg-0pky"><?=$work_station[0]->working_place?></td>
						<td class="tg-0pky"><?=$work_station[0]->date_from != NULL ? date_browse_format($work_station[0]->date_from):'';?></td>
						<td class="tg-0pky"><?=$work_station[0]->date_to != NULL ? date_browse_format($work_station[0]->date_to):'';?></td>
						<td class="tg-0pky"><?=$work_station[0]->designation?></td>
						<td class="tg-0pky">
							<?php
							$duration='';
							if($work_station[0]->_year > 0){
								$duration = $work_station[0]->_year.' Year, ';
							}
							if($work_station[0]->_month > 0){
								$duration .= $work_station[0]->_month.' Month, ';
							}
							if($work_station[0]->_day > 0){
								$duration .= $work_station[0]->_day.' Days';
							}
							echo $duration;
							?>
						</td>
						<td class="tg-0pky" rowspan="<?=count($work_station)?>">
							<?php 
							$tDuration[$row->id]='';
							for ($k=0; $k < count($work_station); $k++) { 
								$t_year += $work_station[$k]->_year;
								$t_month += $work_station[$k]->_month;
								$t_day += $work_station[$k]->_day;		

								// if($work_station[$k]->date_from == '0000-00-00'){
								// 	$tDuration[$row->id]='';
								// }						
								// if($work_station[$k]->date_to == '0000-00-00'){
								// 	$tDuration[$row->id]='';
								// }

							} 

							if($t_year > 0){
								$tDuration[$row->id] = $t_year.' Year<br>';
							}
							if(floor($t_month/12) > 0){
								$tDuration[$row->id] .= $t_year + floor($t_month/12).' Month';
							}

							echo $tDuration[$row->id];	
							?>
						</td>
					</tr>
					<?php for ($j=1; $j < count($work_station); $j++) { ?>
					<tr>
						<td class="tg-0pky"><?=$work_station[$j]->working_place?></td>
						<td class="tg-0pky"><?=date_browse_format($work_station[$j]->date_from)?></td>
						<td class="tg-0pky"><?=date_browse_format($work_station[$j]->date_to)?></td>
						<td class="tg-0pky"><?=$work_station[$j]->designation?></td>
						<td class="tg-0pky">
							<?php
							$duration='';
							if($work_station[$j]->_year > 0){
								$duration = $work_station[$j]->_year.' Year<br>';
							}
							if($work_station[$j]->_month > 0){
								$duration .= $work_station[$j]->_month.' Month<br>';
							}
							if($work_station[$j]->_day > 0){
								$duration .= $work_station[$j]->_day.' Days';
							}
							echo $duration;
							?>
						</td>
					</tr>	
					<?php } ?>				
					<?php } ?>
				</table>


			</div>

		</div>

	</body>
	</html>