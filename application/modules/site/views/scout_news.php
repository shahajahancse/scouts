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
                              <th width="5%"><?=lang('site_news_no')?></th>
                              <th><?=lang('site_news_heading')?></th>
                              <!-- <th>News Heading</th> -->
                              <th width="15%"> <?=lang('site_news_date')?></th>                              
                              <th width="18%"><?=lang('site_news_details')?></th>
                           </tr>
                           <?php 
                           $sl=0;
                           foreach ($results as $row) { 
                              $sl++;
                           ?>
                           <tr>
                              <td><?=$sl?></td>                              
                              <td><a href="<?=base_url('scout-news-details/'.$row->id);?>"><?=$row->news_title?></a></td>
                              <td><?=date_bangla_format($row->created)?></td>                              
                              <td><a href="<?=base_url('scout-news-details/'.$row->id);?>" class="btn btn-primary btn-sm"><?=lang('site_news_detailss')?></a> </td>
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
