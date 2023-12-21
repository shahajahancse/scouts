<div class="container w-75">
   <div class="secondary_sc_content">
      <p class="lead font-weight-bold py-2 text-white" style="background-color: #1aa326; padding-left:10px"><?=$meta_title?></p>
      <style type="text/css">
         .tg  {border-collapse:collapse;border-spacing:0; width: 100%; margin-bottom: 20px;}
         .tg td{font-family:Arial, sans-serif;font-size:14px;padding:3px 10px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border:0 solid #ccc;}
         .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:3px 10px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border:0 solid #ccc; font-weight: bold; vertical-align: top}
         .tg .tg-9vst{background-color:#efefef;text-align:right;width: 180px;}
         .tg .tg-031e{vertical-align: top}
      </style>

      <div class="container">
         <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">

               <div class="container ">
                  <div class="row">
                     <table class="tg">
                        <tr>
                           <th class="tg-9vst"><?=lang('site_event_details_title')?>:</th>
                           <td class="tg-031e"><?=$info->event_title?></td>
                           <th class="tg-9vst"><?=lang('site_event_details_venue')?>:</th>
                           <td class="tg-031e" valign="top"><?=$info->event_venue?></td>
                        </tr>
                        <tr>
                           <th class="tg-9vst"><?=lang('site_event_details_date')?>:</th>
                           <td class="tg-031e"><?=date_bangla_format($info->event_start_date)?></td>
                           <th class="tg-9vst"><?=lang('site_event_details_to_date')?>:</th>
                           <td class="tg-031e"><?=date_bangla_format($info->event_end_date)?></td>
                        </tr>
                        <tr>
                           <th class="tg-9vst"><?=lang('site_event_details_reg_start')?>:</th>
                           <td class="tg-031e"><?=date_bangla_format($info->event_reg_start)?></td>
                           <th class="tg-9vst"><?=lang('site_event_details_reg_end')?>:</th>
                           <td class="tg-031e"><?=date_bangla_format($info->event_reg_end)?></td>
                        </tr>
                        <tr>
                           <th class="tg-9vst"><?=lang('site_event_details_participant_cate')?>:</th>
                           <td class="tg-031e">
                              <?php 
                              if($info->ept_category==1){
                                 echo 'Individual';
                              }else{
                                 echo 'Group/Unit';
                              }
                              ?>            
                           </td>
                           <th class="tg-9vst"><?=lang('site_event_details_category')?>:</th>
                           <td class="tg-031e"> <?=$info->event_cate_name?> </td>
                        </tr>

                        <tr>
                           <th class="tg-9vst"><?=lang('site_event_details_type')?>:</th>
                           <td class="tg-031e"><?php 
                              if($info->et_national){
                                 $eventType = 'National';                                 
                              }elseif($info->et_international){
                                 $eventType = 'International';
                              }else{
                                 $eventType = '';
                              }
                              echo $eventType;
                              ?></td>
                              <th class="tg-9vst"><?=lang('site_event_details_participant_no')?>:</th>
                              <td class="tg-031e"> <?=$info->ep_qty?> </td>
                           </tr>
                           
                           <tr>
                              <th class="tg-9vst"><?=lang('site_event_details_details')?>:</th>
                              <td class="tg-031e" valign="top" colspan="3"><?=nl2br($info->event_details)?></td>
                           </tr>
                           <tr>
                              <th class="tg-9vst"><?=lang('site_event_details_attachment')?>:</th>
                              <td class="tg-031e" valign="top" colspan="3">
                                 <?php
                                 if($attachments){
                                   $sl=0;
                                   foreach ($attachments as $value) {
                                    $sl++;
                              //echo $value->file_name .'<button class="btn"><i class="fa fa-download"></i> Download</button>';

                                    echo '<a href="'.base_url('event_docs/'.$value->file_name).'" download="'.$value->file_name.'" class="btn btn-mini btn-xs btn-success btn-mini" style="margin-bottom:2px;">Download - '.$value->file_name.'</a><br>';                              
                                 }
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
