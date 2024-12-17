<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="" class="active"><?=$module_name?> </a></li>
         <li> <?=$folder_name?> </li>
         <li><?=$meta_title; ?> </li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple ">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                     
                  </div>            
               </div>

               <div class="grid-body ">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>
                  <!-- <a href="<?=base_url('Committee/national_pdf')?>" class="btn btn-primary btn-xs btn-mini" style="float: right;">PDF Download</a> -->

                  <form method="get" action="">
   
                     <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ ?>                     
                     <div class="row">
                        <div class="col-md-5">
                           <?php $more_attr = 'class="form-control input-sm"';
                           echo form_dropdown('designation', $designation, $_GET['designation'], $more_attr);
                           ?>
                        </div>     
                        <div class="col-md-5">
                           <?php $more_attr = 'class="sc_district_val form-control input-sm" id="sc_district"';
                           echo form_dropdown('department', $department, $_GET['department'], $more_attr);
                           ?>
                        </div>     
                        <div class="col-md-2">
                           <div class="pull-right ">
                              <button type="submit" class="btn btn-blueviolet btn-mini"><i class="icon-ok"></i> Search</button>
                           </div>
                        </div>
                     </div>

                     <?php } ?>
                     
                  </form>

                  <div class="clearfix"></div>
                  <hr >
                  <table class="table table-hover table-condensed" border="0">
                     <thead>
                        <tr>
                           <th style="width:5%">ক্রম </th>
                           <th style="width:25%">নথির নাম</th>
                           <th style="width:10%">নথি নং</th>
                           <th style="width:10%">বিভাগ</th>
                           <!-- <th style="width:15%">অনুচ্ছেদ</th> -->
                           <th style="width:20%">নথির অবস্থান </th>
                           <th style="width:20%">নথি আগমনের তারিখ ও সময়</th>                          
                           <th style="width:8%; text-align: right;">পদক্ষেপ</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        $sl=0;
                        foreach ($results as $row):
                           $sl++;
                        ?>
                        <tr>
                           <td class="v-align-left"><?=$this->Common_model->en2bn($sl).'.'?></td>
                           <td> <strong><?=$row->title?></strong> </td>
                           <td> <strong><?=$row->nathi_no?></strong> </td>
                           <td class="v-align-middle"><?=$row->department_name; ?></td>
                           <!-- <td class="v-align-middle"><?=$row->nathi_message; ?></td> -->
                           <td class="v-align-middle">
                              <?= $row->status==2?'<span class="btn btn-success btn-mini  text-center">সম্পন্ন</span>':$row->designation_name ?>  
                           </td>
                           <td class="v-align-middle"><?=date_bangla_calender_format($row->date); ?></td>
                           <td align="right">
                              <a href="<?=base_url('e_nathi/details/'.$row->nathi_id.'/'.$row->id)?>" class="btn btn-success btn-mini">বিস্তারিত</a>
                           </td>
                        </tr>
                     <?php endforeach;?>                      
                  </tbody>
               </table>
            </div>

         </div>
      </div>
   </div>

</div> <!-- END Content -->

</div>