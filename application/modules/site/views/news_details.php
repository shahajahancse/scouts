<div class="container w-75">
   <div class="secondary_sc_content">
      <p class="lead font-weight-bold py-2 text-white" style="background-color: #1aa326; padding-left:10px"><?=$meta_title?></p>

      <style type="text/css">
         .tg  {border-collapse:collapse;border-spacing:0; width: 100%; margin-bottom: 20px;}
         .tg td{font-family:Arial, sans-serif;font-size:14px;padding:3px 10px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border:0 solid #ccc;}
         .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:3px 10px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border:0 solid #ccc; font-weight: bold; vertical-align: top}
         .tg .tg-9vst{background-color:#efefef;text-align:right;}
      </style>

      <div class="container">
         <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">

               <div class="container ">
                  <div class="row">
                     <table class="tg">
                        <tr>
                           <th class="tg-9vst"><?=lang('site_news_details_date')?>:</th>
                           <td class="tg-031e"><?=date_bangla_format($info->created)?></td>
                        </tr>
                        <tr>
                           <th class="tg-9vst" width="120"><?=lang('site_news_details_title')?>:</th>
                           <td class="tg-031e" width="300"><b><?=$info->news_title?></b></td>
                        </tr>
                        <tr>
                           <th class="tg-9vst"><?=lang('site_news_details')?>:</th>
                           <td class="tg-031e"><?=nl2br($info->news_details)?></td>
                        </tr>
                        <tr>
                           <th class="tg-9vst">Attachment File:</th>
                           <td class="tg-031e">
                              <?php 
                              if($info->attachment_file){
                                 echo $file = '<a href="'.base_url('uploads/news_file/'.$info->attachment_file).'" download="'.$info->attachment_file.'" class="btn btn-mini btn-xs btn-success" style="margin-bottom:2px;">Download - '.$info->attachment_file.'</a>';
                              }
                              ?>
                           </td>
                        </tr>
                     </table>

                     <br><br>

                     <div class="pt-3"></div>
                  </div>
               </div>

            </div> 
         </div>
      </div><!-- main row -->

   </div>
</div>
