<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="" class="active">ড্যাশবোর্ড </a></li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple ">
               <div class="grid-title">
                  <h4><span class="semi-bold"> পদক্ষেপ নিতে হবে এমন নথি সমূহ</span></h4>
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

                  <div class="clearfix"></div>
                  <hr >
                  <table class="table table-hover table-condensed" border="0">
                     <thead>
                        <tr>
                           <th style="width:5%"> # </th>
                           <th style="width:25%">নথির নাম</th>
                           <th style="width:15%">নথি নং</th>
                           <th style="width:15%">বিভাগ</th>
                           <!-- <th style="width:15%">অনুচ্ছেদ</th> -->
                           <th style="width:25%">ফাইল এর অবস্থান </th>
                           <th style="width:15%">তারিখ</th>                          
                           <th style="width:8%; text-align: right;">পদক্ষেপ</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        $sl=0;
                        foreach ($results1 as $row):
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
      	<div class="col-md-12">
            <div class="grid simple ">
               <div class="grid-title">
                  <h4><span class="semi-bold">চিঠি সমূহ</span></h4>
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

                  <div class="clearfix"></div>
                  <hr >
                  <table class="table table-hover table-condensed" border="0">
                     <thead>
                        <tr>
                           <th style="width:2%"> # </th>
                           <th style="width:50%">বিষয়</th>
                           <th style="width:20%">বিভাগ</th>
                           <th style="width:20%">তারিখ</th>                          
                           <th style="width:8%; text-align: right;">পদক্ষেপ</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        $sl=0;
                        foreach ($results2 as $row):
                           $sl++;
                        ?>
                        <tr>
                           <td class="v-align-left"><?=$this->Common_model->en2bn($sl).'.'?></td>
                           <td> <strong><?=$row->file_subject?></strong> </td>
                           <td class="v-align-middle"><?=$row->department_name; ?></td>
                           <td class="v-align-middle"><?=date_bangla_calender_format($row->date); ?></td>
                           <td align="right">
                              <a href="<?=base_url('e_filing/details/'.$row->id)?>" class="btn btn-success">বিস্তারিত</a>
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