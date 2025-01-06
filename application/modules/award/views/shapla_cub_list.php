<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dahsboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('award/shapla_cub_list')?>" class="active"><?=$module_name?> </a></li>
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

         .btn-group {
            display: inline-flex;
            gap: 4px;
         }

         .pagination {
            display: flex;
            justify-content: center;
            gap: 5px;
            flex-wrap: wrap;
         }

         @media screen and (max-width: 767px) {
            .table th, 
            .table td {
               white-space: nowrap;
               min-width: 120px;
               font-size: 14px;
            }

            .btn-group {
               display: flex;
               flex-direction: column;
            }

            .btn {
               padding: 4px 8px;
               font-size: 12px;
               width: 100%;
               margin: 2px 0;
            }

            .grid-title {
               text-align: center;
            }

            .pull-right {
               float: none;
               text-align: center;
               margin: 10px 0;
            }

            .dropdown-menu {
               position: fixed;
               top: 50%;
               left: 50%;
               transform: translate(-50%, -50%);
               width: 80%;
               max-width: 300px;
            }
         }
      </style>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple ">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                     <?php //if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ ?>
                     <!-- <a href="<?=base_url('award/circular_create')?>" class="btn btn-blueviolet btn-xs btn-mini"> Create Award Circular</a> -->
                     <?php //} ?>
                  </div>            
               </div>

               <div class="grid-body ">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>

                  <div class="table-responsive">
                     <table class="table table-hover table-condensed">
                        <thead>
                           <tr>
                              <th> SL </th>
                              <th>Award Circular Title</th>
                              <th>Group End Date</th>
                              <th>Upazila End Date</th>
                              <th>District End Date</th>
                              <th>Region End Date</th>                           
                              <th>Status</th>
                              <?php //if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ ?>
                              <th style="text-align: right;">Action</th>
                              <?php //} ?>
                           </tr>
                        </thead>
                        <tbody>
                           <?php 
                           $sl=$pagination['current_page'];
                           foreach ($results as $row):
                              $sl++;
                              if($row->status == 1) {
                                 $status = '<button class="btn btn-mini btn-info">Enable</button>';
                              }else{
                                 $status = '<button class="btn btn-mini btn-danger">Disable</button>';
                              }
                           ?>
                           <tr>
                              <td><?=$sl.'.'?></td>
                              <td><strong><?=$row->circular_title?></strong></td>
                              <td><?=date_sort_form($row->group_end_date); ?></td>
                              <td><?=date_sort_form($row->upazila_end_date); ?></td>
                              <td><?=date_sort_form($row->district_end_date); ?></td>
                              <td><?=date_sort_form($row->region_end_date); ?></td>
                              <td><?=$status?></td>
                              <?php //if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ ?>
                              <td align="right">
                                 <div class="btn-group">
                                    <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> Action <span class="caret"></span> </a>
                                    <ul class="dropdown-menu pull-right">
                                       <li><?=anchor("award/shapla_cub_recommendation_list/".encrypt_url($row->id), 'Cub Recommendation List')?></li>
                                       <li><?=anchor("award/shapla_cub_recommendation_form/".encrypt_url($row->id), 'Cub Recommendation Form')?></li>
                                       <li><?=anchor("award/shapla_cub_approve_list/".encrypt_url($row->id), 'Cub Award Approve List')?></li>
                                    </ul>
                                 </div>
                              </td>
                              <?php //} ?>
                           </tr>
                           <?php endforeach;?>                      
                        </tbody>
                     </table>
                  </div>

                  <div class="row">
                     <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> 
                        Total <span style="color: green; font-weight: bold;"><?php echo $total_rows; ?> Award Circular </span>
                     </div>
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