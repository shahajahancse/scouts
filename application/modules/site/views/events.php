<div class="container w-75">
   <div class="secondary_sc_content">
      <p class="lead font-weight-bold py-2 text-white" style="background-color: #1aa326; padding-left:10px"><?=$meta_title?></p>

      <div class="container">
         <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <div class="container ">
                  <div class="row">
                     <table class="table table-bordered">
                        <tbody>
                           <tr>
                              <th><?=lang('site_events_no')?></th>
                              <th><?=lang('site_events_title')?></th>
                              <th width="100"><?=lang('site_events_start')?></th>
                              <th width="100"><?=lang('site_events_end')?></th>
                              <th><?=lang('site_events_type')?></th>
                              <th><?=lang('site_events_status')?></th>
                              <th><?=lang('site_events_details')?></th>
                           </tr>
                           <?php 
                              $sl=0;
                              foreach ($results as $row) {
                                 $sl++;
                                 if($row->et_national){
                                    $eventType = 'National';                                 
                                 }elseif($row->et_international){
                                    $eventType = 'International';
                                 }else{
                                    $eventType = '';
                                 }
                           ?>
                           <tr>
                              <td><?=$sl?></td>
                              <td><?=$row->event_title?></td>
                              <td><?=$row->event_start_date?></td>
                              <td><?=$row->event_end_date?></td>
                              <td><?=$eventType?></td>
                              <td>
                                 <?php
                                 if($row->event_start_date>date('Y-m-d')){
                                    echo 'Upcomming';
                                 }else if($row->event_end_date>date('Y-m-d')){
                                    echo 'On Going';
                                 }else{
                                    echo 'Completed';
                                 }
                                 ?>
                              </td>
                              <td><a href="<?=base_url('scout-event-details/'.$row->id);?>" class="btn btn-primary btn-sm"><?=lang('site_events_details')?></a></td>
                           </tr>
                           <?php } ?>
                        </tbody>
                     </table>
                     <div class="pt-3"></div>
                  </div>
               </div>
               
            </div> 
         </div>
      </div><!-- main row -->

   </div>
</div>
