<!DOCTYPE html>
<html>
<head>
  <title><?php echo $meta_title?></title> 
  <style type="text/css">
    .content{
      width: 1900px;
      margin-left: auto;
      margin-right: auto;
      padding-top: 1120px; 
      position: absolute; 
      top: 200px; 
      font-size: 65px;
      font-weight: bold;
      text-align: center;
      display: block;
      overflow: visible;
      /*border: 1px solid red;*/
    }
    .nameBN{
       padding-top: 0px;    
       /*border: 1px solid blue;*/
    }
    .groupBN{
      padding-top: 30px;       
      /*border: 1px solid yellow; */
    }

    .nameEN{
       padding-top: 340px;    
       /*border: 1px solid blue;*/
    }
    .groupEN{
      padding-top: 30px;       
      /*border: 1px solid yellow; */
    }

  </style>
</head>
<body>  
  <div height="100%" width="100%" style="background: #FFFFFF
  url('<?=FCPATH?>awedget/assets/certificates/3-community-development.jpg'); background-repeat: no-repeat; background-image-resolution: 25dpi; border: 0px solid black;">

    <div class="content">
      <div class="nameBN"><?php echo $info->name_bn?></div>
      <div class="groupBN"><?php 
        if($info->group_name_no_exists != NULL){
          echo $info->group_name_no_exists;
        }else{
          echo $info->grp_name_bn;
        }
      ?>
      <div style="padding-top: 1055px; padding-left: 850px; text-align: left; "><?php echo eng2bng($info->certificate_no)?></div>
      <div style="padding-top: 0px; padding-left: 860px; text-align: left; "><?php echo date_bangla_calender_format($info->issue_date)?></div>
    </div>
  </div>

</body>
</html>