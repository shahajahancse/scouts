<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
         <li> <a href="javascript:void()" class="active"><?=$module_name?> </a></li>
         <li><?=$meta_title; ?> </li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple ">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                  <?php if($this->ion_auth->is_admin()){ ?>
                     <a href="<?=base_url('committee/national_create')?>" class="btn btn-blueviolet btn-xs btn-mini"> Create National Committee</a>
                  <?php } ?>
                  </div>            
               </div>

               <div class="grid-body ">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>
                  <a href="<?=base_url('Committee/national_pdf')?>" class="btn btn-primary btn-xs btn-mini" style="float: right;">PDF Download</a>
                  <table class="table table-hover table-condensed" border="0">
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
                        $sl=$pagination['current_page'];
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

               <div class="row">
                  <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> Total <span style="color: green; font-weight: bold;"><?php echo $total_rows; ?> NHQ Committee </span></div>
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