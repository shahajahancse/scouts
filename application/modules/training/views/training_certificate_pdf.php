<!DOCTYPE html>
<html>
<head>
  <title><?php echo $meta_title?></title>
  <style type="text/css">
    .content{
      font-size: 25px;
      font-weight: bold;
    }
    .nameBN{
       padding-top: 236px;
       padding-left: 400px;
       /*border: 1px solid blue;*/
    }
    .groupBN{
      padding-top: 32px;
      padding-left: 400px;
      /*border: 1px solid yellow; */
    }

    .nameEN{
       margin-top: 340px;
       /*border: 1px solid blue;*/
    }
    .groupEN{
      padding-top: 30px;
      /*border: 1px solid yellow; */
    }

  </style>
</head>
<body>
<div
  style="
    width: 297mm;
    height: 210mm;
    background-image: url('<?= FCPATH ?>awedget/assets/certificates/scout_jambori.jpg');
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center center;
  "
>
  <div class="content">
    <div class="nameBN"><?= $info->full_name_bn ?></div>
    <div class="groupBN"><?= $info->grp_name_bn ?></div>
  </div>
</div>


</body>
</html>
