<!DOCTYPE html>
<html>
<head>
  <title><?= $meta_title ?></title>
  <meta charset="utf-8">
  <style>
    /* @page {
      size: A4 landscape;
      margin: 0;
    } */

    body {
      margin: 0;
      padding: 0;
    }

    .page {
      width: 100%;
      height: 100%;
      background: url('<?= FCPATH ?>awedget/assets/certificates/scout_jambori.jpg') no-repeat center center;
      background-size: cover;
      position: relative;
    }

    .content {
      width: 100%;
      position: absolute;
      /* top: 700px;        adjust as needed */
      /* text-align: left; */
      font-size: 25px;
      font-weight: bold;
    }

    .groupsBN {
      font-size: 20px;
      padding-top: 238px;
      padding-left:400px !important;
    }
    .groupBN {
      padding-top: 38px;
      padding-left:400px !important;

    }
  </style>
</head>

<body>

  <div class="page">
    <div class="content">
      <div class="groupsBN"><?= $info->full_name_bn ?></div>
      <div class="groupBN"><?= $info->grp_name_bn ?></div>
    </div>
  </div>

</body>
</html>
