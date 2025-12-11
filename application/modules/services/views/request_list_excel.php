<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
<head>

</head>


<body style="width:800px;">
    <?php
        $filename = "request list.xls";
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
				<u style="font-size:16px;">Request List</u><br>
			</p>
		</div>

		<table align="center" height="auto"  class="sal" border="1" cellspacing="0" cellpadding="2" style="font-size:12px; width:750px;">
			<tr>
                <th > SL </th>
                <th >Services Name</th>
                <th >Name</th>
                <th >Phone</th>
                <th >Email</th>
                <th >Req. Date</th>
                <th >Status</th>
            </tr>
			<?php $i=0;
			foreach ($results as $row) {  $i++; ?>
				<tr>
                    <td class="v-align-middle"><?=$i.'.'?></td>
                    <td class="v-align-middle"><?=$row->service_name?></td>
                    <td class="v-align-middle"><?=$row->name?></td>
                    <td class="v-align-middle"><?=$row->phone?></td>
                    <td class="v-align-middle"><?=$row->email?></td>
                    <td class="v-align-middle"><?=date_sort_form($row->created)?></td>
                    <td class="v-align-middle"><?=service_request_status($row->status)?></td>
				</tr>
			<?php } ?>
		</table>
	</div>
</body>
</html>
<?php exit; ?>
