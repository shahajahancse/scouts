<?php 
$is_first = !isset($is_first_chunk) || $is_first_chunk === true;
$is_last  = !isset($is_last_chunk)  || $is_last_chunk === true;
$start_no = isset($start_index) ? (int)$start_index : 0;
$total_cnt = isset($total_records) ? $total_records : count($results);
?>
<?php if ($is_first): ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?=$headding?></title>
	<style type="text/css">
      body{font-family: 'nikosh', 'sutonnyMJ', sans-serif;}
      .priview-body{font-size: 12px;color:#000;margin: 15px;}
      .priview-header{margin-bottom: 12px;text-align:center;}
      .table{width:100%;border-collapse: collapse; margin-top: 6px; margin-bottom: 6px;}
      .table td, .table th{border:1px solid #444; padding: 4px 6px; font-size: 11px;}
      .table th{background-color: #f2f2f2; font-weight: bold;}
      .text-center{text-align:center;}
      .text-left{text-align:left;}
      .text-right{text-align:right;}
      .report_date{text-align: right; font-size: 11px; margin-bottom: 5px;}
   </style>
</head>
<body>
	<div class="priview-body">
		<div class="priview-header">
			<p class="text-center">
            <span style="font-size:20px;font-weight: bold;">Bangladesh Scouts</span><br>
            <span style="font-size: 13px;">60, Anjuman Mufidul Islam Road, Kakrail, Dhaka – 1000 </span><br>
            <span style="font-size: 12px;">www.scouts.gov.bd</span>
         </p>
         <div style="font-size:16px; font-weight: bold; margin-top: 5px;"><u><?=$headding?></u></div>
         <?php if(!empty($dis_type_info)): ?>
            <span style="font-size: 12px;">District Type: <?=$dis_type_info->district_type_name?></span><br>
         <?php endif; ?>
         <?php if(!empty($date_from) && !empty($date_to)): ?>
            <span style="font-size: 12px;">Date From: <?=$date_from?> &nbsp;|&nbsp; Date To: <?=$date_to?></span><br>
         <?php endif; ?>
      </div>

      <div class="report_date">Report Date: <?=date('d-m-Y')?></div>
<?php endif; ?>

      <table class="table">
         <thead>
            <tr>
               <th class="text-center" width="5%">SL</th>
               <th class="text-left" width="18%">Name</th>
               <th class="text-center" width="10%">Scout ID</th>
               <th class="text-left" width="12%">Member Type</th>
               <th class="text-left" width="10%">Section</th>
               <th class="text-left" width="14%">Badge</th>
               <th class="text-left" width="12%">Petrol Name</th>
               <th class="text-center" width="5%">Age</th>
               <th class="text-left" width="14%">Username</th>
            </tr>
         </thead>
         <tbody>
            <?php
            $i = $start_no;
            if(!empty($results)){
               foreach ($results as $row) {
                  $i++;
                  ?>
                  <tr>
                     <td class="text-center"><?=$i?>.</td>
                     <td class="text-left"><?=$row->first_name?></td>
                     <td class="text-center"><?=$row->scout_id?></td>
                     <td class="text-left"><?=$row->member_type_name?></td>
                     <td class="text-left"><?=get_scout_section($row->sc_section_id)?></td>
                     <td class="text-left"><?=!empty($row->badge_name) ? $row->badge_name : ''?></td>
                     <td class="text-left"><?=$row->petrol_name?></td>
                     <td class="text-center"><?=$row->dob ? get_age($row->dob) : ''?></td>
                     <td class="text-left"><?=$row->username?></td>
                  </tr>
                  <?php
               }
            } else {
               ?>
               <tr>
                  <td colspan="9" class="text-center">No records found.</td>
               </tr>
               <?php
            }
            ?>
         </tbody>
      </table>

<?php if ($is_last): ?>
      <div style="margin-top: 10px; font-size: 11px;">
         <strong>Total Records:</strong> <?=number_format($total_cnt)?>
         <?php if ($total_cnt >= 1000): ?>
            &nbsp;<em>(Displaying top 1,000 records in PDF. For full data export, please use Download Excel)</em>
         <?php endif; ?>
      </div>
   </div>
</body>
</html>
<?php endif; ?>
