<!DOCTYPE html>
<html>
<head>
  <title><?php echo $meta_title?></title> 
  <style type="text/css">
    .content{
      width: 1000px;
      margin-left: auto;
      margin-right: auto;
      padding-top: 1600px; 
      position: absolute; 
      top: 100px; 
      font-size: 65px;
      font-weight: bold;
      text-align: center;
      display: block;
      overflow: visible;
      /*border: 1px solid red;*/
    }
    .nameBN{
       padding-top: 0px;    
       font-size: 120px;
       /*border: 1px solid blue;*/
    }
    .groupBN{
      padding-top: 70px;       
      /*border: 1px solid yellow; */
    }

    .nameEN{
       padding-top: 430px;    
       /*border: 1px solid blue;*/
    }
    .groupEN{
      padding-top: 110px;       
      /*border: 1px solid yellow; */
    }

  </style>
</head>
<body>  
  <div height="100%" width="100%" style="background: #FFFFFF
  url('<?=FCPATH?>awedget/assets/certificates/11-long-service-decoration.jpg'); background-repeat: no-repeat; background-image-resolution: 25dpi; border: 0px solid black;">

    <div class="content">
      <div class="nameBN"><?php echo $info->name_bn?></div>
      <div style="padding-top: 1530px; padding-left: 210px; text-align: left; "><?php echo eng2bng($info->certificate_no)?></div>
      <div style="padding-top: 60px; padding-left: 210px; text-align: left; "><?php echo date_bangla_calender_format($info->issue_date)?></div>
    </div>
  </div>

</body>
</html>