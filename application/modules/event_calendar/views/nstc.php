<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dahsboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('event_calendar/nstc')?>" class="active"><?=$module_name?> </a></li>
         <li><?=$meta_title; ?> </li>
      </ul>

      <style>
         .table-responsive {
            width: 100%;
            margin-bottom: 15px;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
         }

         .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem;
         }

         .table th,
         .table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #dee2e6;
            vertical-align: middle;
         }

         .table th {
            background: #f8f9fa;
            font-weight: 600;
            white-space: nowrap;
         }

         .table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
         }

         .table tbody tr:hover {
            background-color: #f5f5f5;
         }

         .grid-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 15px;
         }

         .pagination-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 20px;
         }

         @media screen and (max-width: 767px) {
            .table th, 
            .table td {
               white-space: nowrap;
               min-width: 120px;
               font-size: 14px;
            }

            .grid-title {
               flex-direction: column;
               gap: 10px;
            }

            .grid-title .pull-right {
               width: 100%;
            }

            .grid-title .pull-right .btn {
               width: 100%;
               margin: 5px 0;
            }

            .pagination-wrapper {
               flex-direction: column;
               text-align: center;
            }
         }
      </style>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                     <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ ?>
                     <a href="<?=base_url('event_calendar/nstc_add')?>" class="btn btn-blueviolet btn-xs btn-mini"> Add To NSTC Event Calender</a>                     
                     <?php } ?>
                  </div>            
               </div>

               <div class="grid-body">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>
                  
                  <div class="table-responsive">
                     <table class="table table-hover table-condensed">
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
                              <td><strong><?=$row->nstc_event_title?></strong></td>
                              <td class="v-align-middle"><?=date_sort_form($row->nstc_event_start); ?></td>
                              <td class="v-align-middle"><?=date_sort_form($row->nstc_event_end); ?></td>
                           </tr>
                           <?php endforeach;?>                      
                        </tbody>
                     </table>
                  </div>

                  <div class="pagination-wrapper">
                     <div class="event-count">
                        Total <span style="color: green; font-weight: bold;"><?php echo $total_rows; ?> NSTC Event</span>
                     </div>
                     <div class="pagination">
                        <?php echo $pagination['links']; ?>
                     </div>
                  </div>
               </div>

            </div>
         </div>
      </div>
   </div>

</div> <!-- END Content -->

</div>