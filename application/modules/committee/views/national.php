<div class="page-content">
   <div class="content">
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
         <li> <a href="javascript:void()" class="active"><?=$module_name?> </a></li>
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
               text-align: center;
            }

            .btn {
               width: 100%;
               margin-bottom: 5px;
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
                     <?php if($this->ion_auth->is_admin()){ ?>
                        <a href="<?=base_url('committee/national_create')?>" class="btn btn-blueviolet btn-xs btn-mini"> Create National Committee</a>
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
                     <div style="margin-bottom: 10px;">
                        <a href="<?=base_url('Committee/national_pdf')?>" class="btn btn-primary btn-xs btn-mini" style="float: right;">PDF Download</a>
                     </div>
                     <table class="table table-hover table-condensed">
                        <thead>
                           <tr>
                              <th style="width:2%"> SL </th>
                              <th style="width:40%">Committee Name</th>
                              <th style="width:10%">Start Date</th>
                              <th style="width:10%">End Date</th>
                              <th style="width:15%">Committee Type</th>
                              <th style="width:7%">Status</th>
                              <th style="width:7%; text-align: right;">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           $sl=$pagination['current_page'] ?? 0;
                           foreach ($results as $row):
                              $sl++;
                           if($row->is_current == 1) {
                              $status = '<button class="btn btn-mini btn-info">Current</button>';
                           }else{
                              $status = '<button class="btn btn-mini btn-danger">Expired</button>';
                           }
                           ?>
                           <tr>
                              <td class="v-align-middle"><?=$sl.'.'?></td>
                              <td> <strong><?=$row->committee_name?></strong> </td>
                              <td class="v-align-middle"><?=date_sort_form($row->session_start_date); ?></td>
                              <td class="v-align-middle"><?=date_sort_form($row->session_end_date); ?></td>
                              <td> <?=$row->committee_type_name?></td>
                              <td> <?=$status?></td>
                              <td align="right">
                                 <div class="btn-group"> <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> Action <span class="caret"></span> </a>
                                    <ul class="dropdown-menu pull-right">
                                       <li><?=anchor("committee/national_details/".encrypt_url($row->id), 'Details')?></li>
                                       <?php if($this->ion_auth->is_admin()){ ?>
                                       <li><?=anchor("committee/national_update/".encrypt_url($row->id), 'Update')?></li>
                                       <li><?=anchor("committee/national_manage_member/".encrypt_url($row->id), 'Manage Member')?></li>
                                       <li><?=anchor("committee/national_delete/".encrypt_url($row->id), 'Delete', 'onclick="return confirm(\'Be careful! Are you sure you want to delete this committee?\');"')?></li>
                                       <?php } ?>
                                    </ul>
                                 </div>
                              </td>
                           </tr>
                        <?php endforeach;?>
                     </tbody>
                  </table>
               </div>

               <div class="pagination-wrapper">
                  <div class="text-left">
                     Total <span style="color: green; font-weight: bold;"><?php echo $total_rows ?? count($results); ?> NHQ Committee </span>
                  </div>
                  <div class="text-right">
                     <?php echo $pagination['links'] ?? ''; ?>
                  </div>
               </div>
            </div>

         </div>
      </div>
   </div>

</div> <!-- END Content -->

</div>
