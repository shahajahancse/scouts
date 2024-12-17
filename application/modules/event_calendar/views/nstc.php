<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dahsboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('event_calendar/nstc')?>" class="active"><?=$module_name?> </a></li>
         <li><?=$meta_title; ?> </li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple ">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                     <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ ?>
                     <a href="<?=base_url('event_calendar/nstc_add')?>" class="btn btn-blueviolet btn-xs btn-mini"> Add To NSTC Event Calender</a>                     
                     <?php } ?>
                  </div>            
               </div>

               <div class="grid-body ">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>
                  <table class="table table-hover table-condensed" border="0">
                     <thead>
                        <tr>
                           <th style="width:2%"> SL </th>
                           <th style="width:30%">Event Title</th>
                           <th style="width:18%">Start Date</th>
                           <th style="width:18%">End Date</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        $sl=$pagination['current_page'];
                        foreach ($results as $row):
                           $sl++;
                        ?>
                        <tr>
                           <td class="v-align-left"><?=$sl.'.'?></td>
                           <td> <strong><?=$row->nstc_event_title?></strong> </td>
                           <td class="v-align-middle"><?=date_sort_form($row->nstc_event_start); ?></td>
                           <td class="v-align-middle"><?=date_sort_form($row->nstc_event_end); ?></td>
                        </tr>
                     <?php endforeach;?>                      
                  </tbody>
               </table>

               <div class="row">
                  <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> Total <span style="color: green; font-weight: bold;"><?php echo $total_rows; ?> NSTC Event </span></div>
                  <div class="col-sm-8 col-md-8 text-right">
                     <?php echo $pagination['links']; ?>
                  </div>
               </div>
            </div>

         </div>
      </div>
   </div>

</div> <!-- END Content -->

</div>