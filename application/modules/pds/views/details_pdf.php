<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?=$headding?></title>
	<style type="text/css">
		.priview-body{font-size: 16px;color:#000;margin: 25px;}
		.priview-header{margin-bottom: 0px;text-align:center;border}
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
			<p class="text-center"><span style="font-size:20px;">BANGLADESH SCOUTS</span><br>
				<span style="font-size:12px;">www.scouts.gov.bd</span></p> <br>			 
			</div>

			<div class="priview-demand">
				<h4 style="text-align: center; text-decoration: underline;"> <?=$meta_title?> </h4>
				<style type="text/css">
					.tg  {border-collapse:collapse;border-spacing:0; width: 98%; margin: 10px;}
					.tg td{font-size:14px;padding:7px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;color:black;}
					.tg th{font-size:14px;font-weight:normal;padding:7px 3px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;color:black;}
					.tg .tg-68ib{font-weight:bold;background-color:#efefef;border-color:#9b9b9b;text-align:right;vertical-align:top; width: 180px;}
					.tg .tg-2fdn{border-color:#9b9b9b;text-align:left;vertical-align:top;padding:7px 5px;}
					.tg .tg-yuct{font-weight:bold;background-color:#efefef;border-color:#9b9b9b;text-align:right;vertical-align:middle; width: 180px;}
					.tg .tg-m6jf{border-color:#9b9b9b;text-align:left;vertical-align:middle}
				</style>
				<table class="tg">
					<tr>
						<th class="tg-yuct">Name (English)</th>
						<th class="tg-2fdn" colspan="3"> <?=$info->name_en?></th>
						<th class="tg-yuct" rowspan="3">Image</th>
						<th class="tg-m6jf" rowspan="3">
							<?php
							$path = base_url().'employee_img/';
							if($info->image_file != NULL){
								$img_url = '<img src="'.$path.$info->image_file.'" width="90" style="border:1px solid #ccc; padding:3px;">';
							}else{
								$img_url = '<img src="'.$path.'no-image.jpg" width="90" style="border:1px solid #ccc; padding:3px;">';
							}
							echo $img_url;
							?>
						</th>
					</tr>
					<tr>
						<td class="tg-yuct">Name (Bangla)</td>
						<td class="tg-2fdn" colspan="3"><?=$info->name_bn?></td>
					</tr>
					<tr>
						<td class="tg-yuct">Father Name</td>
						<td class="tg-2fdn" colspan="3"><?=$info->father_name?></td>

					</tr>
					<tr>
						<td class="tg-yuct">Mother Name</td>
						<td class="tg-2fdn" colspan="3"><?=$info->mother_name?></td>
						<td class="tg-yuct">PDS ID</td>
						<td class="tg-m6jf"><?=$info->pds_id?></td>
					</tr>
					<tr>
						<td class="tg-yuct">Date of Birth</td>
						<td class="tg-2fdn"><?=date_detail_format($info->dob)?></td>
						<td class="tg-68ib">Gender</td>
						<td class="tg-m6jf"><?=$info->gender?></td>  
						<td class="tg-yuct"><span style="font-weight:700">Join Date</span></td>
						<td class="tg-m6jf"><?=date_detail_format($info->join_date)?></td>                         
					</tr>
					<tr>
						<td class="tg-yuct">Regligion</td>
						<td class="tg-2fdn"><?=get_religion($info->religion_id)?></td>
						<td class="tg-68ib">Blood Group</td>
						<td class="tg-m6jf"><?=$info->bg_name_en?></td>
						<td class="tg-yuct">Current Working Area</td>
						<td class="tg-m6jf"><?=$info->current_working_area?></td>
					</tr>
					<tr>
						<td class="tg-yuct">Phone Number</td>
						<td class="tg-2fdn"><?=$info->phone?></td>
						<td class="tg-68ib">Email</td>
						<td class="tg-m6jf"><?=$info->email?></td>
						<td class="tg-yuct">Current Designation</td>
						<td class="tg-m6jf"><?=$info->current_desig?></td>
					</tr>
					<tr>
						<td class="tg-yuct">Present Adddress</td>
						<td class="tg-2fdn"><?=$info->present_address?></td>
						<td class="tg-68ib">Marital Status</td>
						<td class="tg-m6jf"><?=$info->ms_name_en?></td>
						<td class="tg-yuct">Scout ID</td>
						<td class="tg-m6jf"><?=$info->scout_id?></td>
					</tr>
					<tr>
						<td class="tg-yuct">Permanent Address</td>
						<td class="tg-2fdn"><?=$info->permanent_address?></td>
						<td class="tg-68ib">Child No.</td>
						<td class="tg-m6jf"><?=$info->child_no?></td>
						<td class="tg-yuct">Spouse Name</td>
						<td class="tg-m6jf"><?=$info->spous_name?></td>
					</tr>
					<tr>
						<td class="tg-yuct">Passport No.</td>
						<td class="tg-2fdn"><?=$info->passport_no?></td>
						<td class="tg-68ib">Passport Issue</td>
						<td class="tg-m6jf"><?=date_detail_format($info->passport_issue)?></td>
						<td class="tg-yuct">Passport Expire</td>
						<td class="tg-m6jf"><?=date_detail_format($info->passport_expire)?></td>
					</tr>
					<tr>
						<td class="tg-68ib">Contribution to scouts</td>
						<td class="tg-2fdn" colspan="5"><?=$info->contirbutions?></td>
					</tr>
					<tr>
						<td class="tg-68ib">Hobby &amp; Specialty Area</td>
						<td class="tg-2fdn" colspan="5"><?=$info->hobby?></td>
					</tr>
				</table>


				<div class="row" style="margin-top: 20px;">
					<div class="col-md-12">
						<style type="text/css">
							.tg2  {border-collapse:collapse;border-spacing:0;color: black; margin-bottom: 20px;}
							.tg2 caption{font-weight: bold; font-size: 18px; color: black;}
							.tg2 td{font-size:14px;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;color: black;}
							.tg2 th{font-size:14px;font-weight:normal;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;color: black;}
							.tg2 .tg-bm2g{font-weight:bold;background-color:#c0c0c0;border-color:#9b9b9b;text-align:center;vertical-align:top}
							.tg2 .tg-2fdn{border-color:#9b9b9b;text-align:left;vertical-align:top}
							.tg2 .tg-xyy0{font-weight:bold;background-color:#c0c0c0;border-color:#9b9b9b;text-align:center;vertical-align:middle}
							.tg2 .tg-m6jf{border-color:#9b9b9b;text-align:left;vertical-align:middle}
						</style>
						<table class="tg2" width="98%" style="margin: 10px;">
							<caption>Education</caption>
							<tr>
								<th class="tg-xyy0" width="5%">SL</th>
								<th class="tg-xyy0">Education / Exam</th>
								<th class="tg-xyy0">Institute / University / Board</th>
								<th class="tg-bm2g" width="12%">Result</th>
								<th class="tg-bm2g" width="12%">Passing Year</th>
							</tr>
							<?php for($i=0;$i<sizeof($education);$i++){ ?>
							<tr>
								<td class="tg-m6jf" style="text-align: center;"><?=$i+1?></td>
								<td class="tg-m6jf"><?=$education[$i]->edu_level_name; ?></td>
								<td class="tg-m6jf"><?=$education[$i]->institute_board; ?></td>
								<td class="tg-2fdn"><?=$education[$i]->result; ?></td>
								<td class="tg-2fdn"><?=$education[$i]->pass_year; ?></td>
							</tr>
							<?php } ?>  
						</table>

						<table class="tg2" width="98%" style="margin: 10px;">
							<caption>Working Station</caption>
							<tr>
								<th class="tg-xyy0" width="5%">SL</th>
								<th class="tg-xyy0">Working Place</th>
								<th class="tg-xyy0">Served As</th>
								<th class="tg-bm2g" width="15%">From Date</th>
								<th class="tg-bm2g" width="15%">To Date</th>
								<th class="tg-bm2g" width="20%">Duration</th>
							</tr>
							<?php for($i=0;$i<sizeof($work_station);$i++){ ?>
							<tr>
								<td class="tg-m6jf" style="text-align: center;"><?=$i+1?></td>
								<td class="tg-m6jf"><?=$work_station[$i]->working_place; ?></td>
								<td class="tg-m6jf"><?=$work_station[$i]->designation; ?></td>
								<td class="tg-2fdn"><?=date_detail_format($work_station[$i]->date_from); ?></td>
								<td class="tg-2fdn"><?=date_detail_format($work_station[$i]->date_to); ?></td>
								<td class="tg-2fdn">
									<?php
									$duration='';
									if($work_station[$i]->_year > 0){
										$duration = $work_station[$i]->_year.' Year, ';
									}
									if($work_station[$i]->_month > 0){
										$duration .= $work_station[$i]->_month.' Month, ';
									}
									if($work_station[$i]->_day > 0){
										$duration .= $work_station[$i]->_day.' Days';
									}
									echo $duration;
									?>
								</td>
							</tr>
							<?php } ?>  
						</table>

					</div>
				</div>




				<div class="row" style="margin-top: 20px;">
					<div class="col-md-12">
						<p>স্কাউট আন্দোলনের সার্বিক উন্নয়ন , সম্প্রসারণ, প্রশিরক হিসেবে দায়িত্ব পালন, গ্রুপ/ইউনিক পরিচালনার সাইটেশন(সংক্ষিপ্ত বিবরণ) ।<br>
						সাইটেশন লিখবেন কেবলমাত্র সুপারিশকারী কর্মকর্তা । কোন প্রার্থী নিজের সাইটেশন নিজে লিখতে পারবেন না(প্রয়োজনে পৃথক কাগজে সংযুক্ত করা যাবে) । <br>
						<b><u>সাইটেশনঃ </u></b></p><br><br><br><br><br><br><br>


						<p>রেকর্ড দুষ্টে প্রার্থী তাঁর সকল পদে দায়িত্বকালীন সময়ে অত্যন্ত নিষ্ঠা, বিশ্বস্থতা ও দক্ষতার সাথে তাঁর উপর অর্পিত দায়িত্ব ও কর্তব্য সম্পাদন করেছেন। তাঁর কাজের স্বীকৃতিস্বরূপ তাঁকে .................................অ্যাওয়ার্ড প্রদানের সুপারিশ করছি। </p>
					</div>
				</div>

				<div class="row" style="margin-top: 20px;">
					<div class="col-md-12">
						<style type="text/css">
							.tg2  {border-collapse:collapse;border-spacing:0;color: black; margin-bottom: 20px;}
							.tg2 caption{font-weight: bold; font-size: 18px; color: black;}
							.tg2 td{font-size:14px;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;color: black;}
							.tg2 th{font-size:14px;font-weight:normal;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;color: black;}
							.tg2 .tg-bm2g{font-weight:bold;background-color:#c0c0c0;border-color:#9b9b9b;text-align:center;vertical-align:top}
							.tg2 .tg-2fdn{border-color:#9b9b9b;text-align:left;vertical-align:top}
							.tg2 .tg-xyy0{font-weight:bold;background-color:#c0c0c0;border-color:#9b9b9b;text-align:center;vertical-align:middle}
							.tg2 .tg-m6jf{border-color:#9b9b9b;text-align:left;vertical-align:middle}
						</style>

						<table class="tg2" width="98%" style="margin: 10px;">
							
							<tr>
								<th class="tg-xyy0">সম্পাদক <br> বাংলাদেশ স্কাউটস <br>...............<br>উপজেলা</th>
								<th class="tg-xyy0">কমিশনার <br> বাংলাদেশ স্কাউটস <br>...............<br>উপজেলা</th>
								<th class="tg-xyy0">সম্পাদক <br> বাংলাদেশ স্কাউটস <br>...............<br>জেলা</th>
								<th class="tg-bm2g">কমিশনার <br> বাংলাদেশ স্কাউটস <br>...............<br>জেলা</th>
								<th class="tg-bm2g">সম্পাদক <br> বাংলাদেশ স্কাউটস <br>...............<br>অঞ্চল </th>
								<th class="tg-bm2g">কমিশনার <br> বাংলাদেশ স্কাউটস <br>...............<br>অঞ্চল </th>
							</tr>
							
							<tr>
								<td class="tg-m6jf" style="text-align: center;">&nbsp;&nbsp;</td>
								<td class="tg-m6jf">&nbsp;&nbsp;</td>
								<td class="tg-m6jf">&nbsp;&nbsp;</td>
								<td class="tg-2fdn">&nbsp;&nbsp;</td>
								<td class="tg-2fdn">&nbsp;&nbsp;</td>
								<td class="tg-2fdn">&nbsp;&nbsp;</td>
							</tr>
							
						</table>

					</div>
				</div>	


				<div class="row" style="margin-top: 20px;">
					<div class="col-md-12">
						<style type="text/css">
							.tg3  {border-collapse:collapse;border-spacing:0;color: black; margin-bottom: 20px;}
							.tg3 caption{font-weight: bold; font-size: 18px; color: black;}
							.tg3 td{font-size:14px;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;color: black;}
							.tg3 th{font-size:14px;font-weight:normal;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;color: black;}
							.tg3 .tg-bm2g{font-weight:bold;background-color:#ffffff;border-color:#9b9b9b;text-align:center;vertical-align:top}
							.tg3 .tg-2fdn{border-color:#9b9b9b;text-align:left;vertical-align:top}
							.tg3 .tg-xyy0{font-weight:bold;background-color:#ffffff;border-color:#9b9b9b;text-align:center;vertical-align:middle}
							.tg3 .tg-m6jf{border-color:#9b9b9b;text-align:left;vertical-align:middle}
						</style>

						<table class="tg3" width="98%" style="margin: 10px;">
							
							<tr>
								<th width="100%" class="tg-m6jf"><b>অ্যাওয়ার্ড প্রাপ্তির আবেদন/ সুপারিশের শর্তাবলীঃ</b> <br>একটি ধাপ থেকে অন্য ধাপকে অতিক্রম করে অ্যাওয়ার্ডের জন্য আবেদন করা যাবে না। একটি অ্যাওয়ার্ড প্রাপ্তির পর নির্দিষ্ট সময় সমাপ্ত না হলে অন্য অ্যাওয়ার্ডের জন্য আবেদন করা যাবে না। অন্যথায় ফরমটি বাতিল বলে গন্য হবে।  </th>
								
							</tr>

						</table>
					</div>
				</div>



			</div>
		</div>
	</body>
	</html>


