<!DOCTYPE html>
<html>
<head>
  <title><?php echo $meta_title?></title> 
  <style type="text/css">
    .content{
      width: 1900px;
      margin-left: auto;
      margin-right: auto;
      padding-top: 820px; 
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
  url('<?=FCPATH?>awedget/assets/certificates/1-shapla-cub.jpg'); background-repeat: no-repeat; background-image-resolution: 25dpi; border: 0px solid black;">

    <div class="content">
      <div class="nameBN"><?php echo $info->name_bn?></div>
      <div class="groupBN"><?php 
        if($info->group_name_no_exists != NULL){
          echo $info->group_name_no_exists;
        }else{
          echo $info->grp_name_bn;
        }
      ?>
      <div class="nameEN"><?php echo $info->name_en?></div>
      <div class="groupEN"><?php echo $info->grp_name?></div>
    </div>
  </div>

</body>
</html>