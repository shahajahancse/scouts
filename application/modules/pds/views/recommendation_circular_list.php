<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dahsboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('award/circular_list')?>" class="active"><?=$module_name?> </a></li>
         <li><?=$meta_title; ?> </li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple ">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                     <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ ?>
                     <a href="<?=base_url('award/circular_create')?>" class="btn btn-blueviolet btn-xs btn-mini"> Create Award Circular</a>                     
                     <?php } ?>                     
                  </div>            
               </div>

               <div class="grid-body ">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>
                  <!-- <a href="<?=base_url('Committee/national_pdf')?>" class="btn btn-primary btn-xs btn-mini" style="float: right;">PDF Download</a> -->
                  <table class="table table-hover table-condensed" border="0">
                     <thead>
                        <tr>
                           <th style="width:2%"> SL </th>
                           <th style="width:50%">Award Circular Name</th>
                           <th style="width:10%">Recommended List</th>
                           <!-- <th style="width:7%; text-align: right;">Action</th> -->
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        $sl=$pagination['current_page'];
                        foreach ($results as $row):
                           $sl++;
                           // if($row->status == 1) {
                           //    $status = '<button class="btn btn-mini btn-info">Enable</button>';
                           // }else{
                           //    $status = '<button class="btn btn-mini btn-danger">Disable</button>';
                           // }

                           // if($row->is_current == 1) {
                           //    $expire_status = '<button class="btn btn-mini btn-info">Current</button>';
                           // }else{
                           //    $expire_status = '<button class="btn btn-mini btn-danger">Expired</button>';
                           // }
                        ?>
                        <tr>
                           <td class="v-align-left"><?=$sl.'.'?></td>
                           <td> <strong><?=$row->circular_title?></strong> </td>
                           <td class="v-align-middle"><a class="btn btn-primary btn-mini" href="<?=base_url('award/recommendation_list/'.encrypt_url($row->circular_id));?>"> Details List </a></td>
                           <?php /*
                           <td align="right">
                              <div class="btn-group"> <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> Action <span class="caret"></span> </a>
                                 <ul class="dropdown-menu pull-right">
                                    <li><?=anchor("award/national_manage_member/".encrypt_url($row->id), 'Manage Member')?></li>
                                    <?php //if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ ?>
                                    <li><?=anchor("award/circular_update/".encrypt_url($row->id), 'Update')?></li>
                                    <li><?=anchor("award/national_delete/".encrypt_url($row->id), 'Delete', 'onclick="return confirm(\'Be careful! Are you sure you want to delete this data?\');"')?></li>
                                    <?php //} ?>
                                 </ul>
                              </div>
                           </td>
                           */ ?>
                        </tr>
                     <?php endforeach;?>                      
                  </tbody>
               </table>

               <div class="row">
                  <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> Total <span style="color: green; font-weight: bold;"><?php echo $total_rows; ?> Award Circular </span></div>
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