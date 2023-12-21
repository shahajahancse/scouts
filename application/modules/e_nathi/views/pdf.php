<!DOCTYPE html>
  <html>
    <head>
      <title>Demand Download</title>
       
      <style type="text/css">
        .priview-body{
          font-size: 12px;
          color:#000;
          margin: 25px;
          float: left;
          text-align: left;
        }
        .priview-header{
          margin-bottom: 40px;
          text-align:center;
        }
        .priview-header div{
          font-size: 18px;
        }
        p{
          margin: 0px;
        }
        .col-1{
          width:8.33%;
          float:left;
        }  
        .col-2{
          width:16.66%;
          float:left;
        }
        .col-3{
          width:25%;
          float:left;
        }
        .col-4{
          width:33.33%;
          float:left;
        }
        .col-5{
          width:41.66%;
          float:left;
        }
        .col-6{
          width:50%;
          float:left;
        }
        .col-7{
          width:58.33%;
          float:left;
        }
        .col-8{
          width:66.66%;
          float:left;
        }
        .col-9{
          width:75%;
          float:left;
        }
        .col-10{
          width:83.33%;
          float:left;
        }
        .col-11{
          width:91.66%;
          float:left;
        }
        .col-12{
          width:100%;
          float:left;
        }
        .table{
          width:100%;
          border-collapse: collapse;
        }
        .table td, .table th{
          
          border:1px solid #000;
        }
        .table td{
        }
        .text-center{
          text-align:center;
        }
        .text-right{
          text-align:right;
        }

      </style>
      
    </head>
    <body> 
      <div class="priview-header">
          <div class="row" style="border-bottom: 1px solid #050505; margin-bottom: 40px">
              <div class="col-3">
                  <p class="text-right"><img src="data:image/png;base64,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" width="130px"></p>
              </div>
              <div class="col-6">
                  <div style="font-size: 30px">বাংলাদেশ স্কাউটস</div>
                  <div>জাতীয় সদর দফতর</div>
                  <div>বিভাগ  : <?=$nathi->department_name?></div>
                  <div>নথি নং : <u><?=$this->Common_model->en2bn($nathi->nathi_no)?></u> তারিখ : <u><?=date_bangla_calender_format($nathi->date)?></u></div>
                  <div>নথির নাম  : <?=$nathi->title?></div>
              </div>
          </div>
          <?php foreach ($paragraph as $key => $para) { ?>
          <div class="priview-body">
            <div class="row">
              <div class="col-1">
                <?=$this->Common_model->en2bn($para->paragraph_no)?>
              </div>
              <div class="col-11">
                <?=$para->details?>
                <?php if(!empty($para->attachment)){ ?>
                  <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th class="text-center">সংযুক্ত ফাইলের নাম</th>
                          <th class="text-center">ডাউনলোড </th>
                          <th class="text-center">ভিউ</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($para->attachment as $file) { ?>
                          <tr>
                            <td><?=$file->name?></td>
                            <td class="text-center"><a  href="<?=base_url('efile_img/'.$file->userfile)?>" download=""><i class="fa fa-download"></i></a> </td>
                            <td class="text-center"><a  href="<?=base_url('efile_img/'.$file->userfile)?>" target="_blank">বিস্তারিত</a> </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                  </table>
                <?php } ?>
              </div>
            </div>

            <div class="row" style="margin-bottom: 15px; margin-top: 15px">
              <?php foreach ($para->note as $key => $info) { ?>
                  <div class="col-4 text-center">
                        <div><?php if(!empty($info->note)){ echo $info->note; } ?></div>
                        <?php if(!empty($info->signature)){ ?>
                            <div><img src="<?=base_url('employee_img/'.$info->signature)?>" width="100px"></div>
                        <?php } ?>
                        
                        <div>(<?=$info->first_name?>)</div> 
                        <div><?=$info->designation_name?></div> 
                        <?php if($info->department_id !=1){ ?>
                            <div><?=$info->department_name?> </div>
                        <?php } ?>
                        <div>বাংলাদেশ স্কাউটস</div>
                  </div>
              <?php } ?>
            </div>
          </div>
        <?php } ?>        
      </div>
  </body>
</html>
