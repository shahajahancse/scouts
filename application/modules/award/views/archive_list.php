<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dahsboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('award/archive_list')?>" class="active"><?=$module_name?> </a></li>
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
               display: flex;
               flex-direction: column;
               gap: 10px;
            }

            .grid-title .pull-right {
               float: none !important;
            }

            .pagination {
               margin: 10px 0;
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
                     <a href="<?=base_url('award/archive_add')?>" class="btn btn-blueviolet btn-xs btn-mini"> Add Award Archive</a>
                     <?php //} ?>
                  </div>            
               </div>

               <div class="grid-body ">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>

                  <?php $this->load->view('search_view')?>

                  <div class="table-responsive">
                     <table class="table table-hover table-condensed">
                        <thead>
                           <tr>
                              <th style="width:2%"> SL </th>
                              <th style="width:20%">Awardee Name</th>
                              <th style="width:50%">Awared Name</th>
                              <th style="width:18%">Certificate No.</th>
                              <th style="width:18%">Year</th>                           
                              <?php //if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ ?>
                              <th style="width:7%; text-align: right;">Action</th>
                              <?php //} ?>
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
                              <td> <strong><?=$row->name_en?></strong> </td>
                              <td> <?=$row->archive_award_name?> </td>
                              <td> <?=$row->certificate_no?> </td>                           
                              <td> <?=$row->archive_year?> </td>
                              <?php //if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ ?>
                              <td align="right">
                                 <div class="btn-group"> 
                                    <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> Action <span class="caret"></span> </a>
                                    <ul class="dropdown-menu pull-right">
                                       <li><?=anchor("award/archive_certificate_pdf/".encrypt_url($row->id), 'Generate Certificate PDF', array('target' => '_blank'))?></li>
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
                     <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> Total <span style="color: green; font-weight: bold;"><?php echo $total_rows; ?> Awardee </span></div>
                     <div class="col-sm-8 col-md-8 text-right">
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