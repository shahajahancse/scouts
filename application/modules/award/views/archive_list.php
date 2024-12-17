<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dahsboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('award/archive_list')?>" class="active"><?=$module_name?> </a></li>
         <li><?=$meta_title; ?> </li>
      </ul>

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

                  <table class="table table-hover table-condensed" border="0">
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
                              <div class="btn-group"> <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> Action <span class="caret"></span> </a>
                                 <ul class="dropdown-menu pull-right">
                                 <li><?=anchor("award/archive_certificate_pdf/".encrypt_url($row->id), 'Generate Certificate PDF', array('target' => '_blank'))?></li>
                                    <!-- <li><?=anchor("award/recommendation_list/".encrypt_url($row->id), 'NHQ Recommendation List')?></li>
                                    <li><?=anchor("award/recommendation_form/".encrypt_url($row->id), 'NHQ Recommendation Form')?></li> -->
                                    <!-- <li><?=anchor("award/shapla_cub_approve_list/".encrypt_url($row->id), 'NHQ Award Approve List')?></li> -->
                                 </ul>
                              </div>
                           </td>
                           <?php //} ?>
                        </tr>
                     <?php endforeach;?>                      
                  </tbody>
               </table>

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

</div> <!-- END Content -->

</div>