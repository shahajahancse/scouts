<!DOCTYPE html>
<html>
<head>
  <title><?php echo $meta_title?></title> 
  <style type="text/css">
    .content{
      width: 1900px;
      margin-left: auto;
      margin-right: auto;
      padding-top: 920px; 
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
      padding-top: 100px;       
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
  url('<?=FCPATH?>awedget/assets/certificates/scout_jambori.jpg'); background-repeat: no-repeat; background-image-resolution: 25dpi; border: 0px solid black;">

    <div class="content">
      <div class="nameBN"><?php echo $info->full_name_bn?></div>
      <div class="groupBN"><?php echo $info->grp_name_bn?></div>
      <?php /*<div class="nameEN"><?php echo $info->first_name?></div>
      <div class="groupEN"><?php echo $info->grp_name?></div> */ ?>
    </div>
  </div>

</body>
</html>