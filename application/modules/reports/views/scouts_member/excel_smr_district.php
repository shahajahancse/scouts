<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body style="width:800px;">
    <?php
        $filename = "Top_Scouts_Member_Registration_By_District_" . date('d-m-Y') . ".xls";
        header('Content-Type: application/vnd.ms-excel; charset=utf-8');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
    ?>

    <style type="text/css">
        .priview-body{font-size: 14px;color:#000;margin: 20px;}
        .priview-header{margin-bottom: 12px;text-align:center;}
        .table{width:100%;border-collapse: collapse;}
        .table td, .table th{border:1px solid #999; padding: 5px 8px;}
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
                <u style="font-size:15px; font-weight: bold;"><?=$headding?></u><br>
                <?php if (!empty($dis_type_info)): ?>
                    <span style="font-size: 13px;">District Type: <?=$dis_type_info->district_type_name?></span><br>
                <?php else: ?>
                    <span style="font-size: 13px;">District Type: All</span><br>
                <?php endif; ?>
                <?php if (!empty($date_from) && !empty($date_to)): ?>
                    <span style="font-size: 13px;">Date From: <?=$date_from?> &nbsp;|&nbsp; Date To: <?=$date_to?></span><br>
                <?php endif; ?>
                <span style="font-size: 12px;">Report Date: <?=date('d-m-Y')?></span>
            </p>
        </div>

        <table align="center" border="1" cellspacing="0" cellpadding="4" style="font-size:12px; width:100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #e9edf0; font-weight: bold;">
                    <th style="width: 60px; text-align: center;">SL</th>
                    <th style="text-align: left;">District Name</th>
                    <th style="width: 180px; text-align: right;">Total Scout Member</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i = 0;
                $grandTotalMember = 0;
                if (!empty($results)):
                    foreach ($results as $row): 
                        $i++; 
                        $grandTotalMember += (int)$row->total_member;
                ?>
                    <tr>
                        <td style="text-align: center;"><?=$i?>.</td>
                        <td style="text-align: left;"><?=$row->dis_name?></td>
                        <td style="text-align: right;"><?=number_format($row->total_member)?></td>
                    </tr>
                <?php 
                    endforeach; 
                else: 
                ?>
                    <tr>
                        <td colspan="3" style="text-align: center;">No records found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr style="background-color: #dbe2e8; font-weight: bold;">
                    <td colspan="2" style="text-align: right;">Grand Total:</td>
                    <td style="text-align: right;"><?=number_format($grandTotalMember)?></td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>
<?php exit; ?>
