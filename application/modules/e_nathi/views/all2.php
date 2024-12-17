<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">

         <li> <a href="" class="active"><?=$module_name?> </a></li>
         <li><?=$meta_title; ?> </li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple ">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                     <a class="btn btn-info btn-xs btn-mini" style="float: right;" href="<?=base_url('e_folder/all');?>"> ফোল্ডার তালিকা </a> 
                     <a class="btn btn-info btn-xs btn-mini" style="float: right;" href="<?=base_url('e_folder/create');?>"> নতুন ফোল্ডার তৈরি করুন </a>
                  </div>            
               </div>

               <div class="grid-body ">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>
                  
                  

                  <div class="clearfix"></div>
                  <?php if(!empty($folder)){?>
                     <div class="row">
                           <?php foreach ($folder as $key => $f_item) { ?>
                                 <div class="col-md-2 col-sm-6">
                                    <a href="<?=base_url('e_nathi/e_folder/'.$f_item->id)?>" style="border: 1px solid #ddd; width: 100%; float: left;">
                                       <img src="<?=base_url('efile_img/folder.jpg')?>" class="img-responsive">
                                       <h4 class="text-center" style="height: 50px"><?=$f_item->name?></h4>
                                    </a>
                                 </div>
                           <?php } ?>
                     </div>
                  <?php } ?>
                  <hr >
                  <!-- <?php if(!empty($results)){?>
                  <table class="table table-hover table-condensed" border="0">
                     <thead>
                        <tr>
                           <th style="width:5%"> # </th>
                           <th style="width:35%">নথির নাম</th>
                           <th style="width:20%">নথি নং</th>
                           <th style="width:25%">বিভাগ</th>
                           <th style="width:15%">তারিখ</th>                          
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
                           <td class="v-align-middle"><?=date_bangla_calender_format($row->date); ?></td>
                           <td align="right">
                              <a href="<?=base_url('e_nathi/details/'.$row->id)?>" class="btn btn-success btn-mini">বিস্তারিত</a>
                           </td>
                        </tr>
                     <?php endforeach;?>                      
                  </tbody>
               </table>
               <?php } ?> -->
            </div>

         </div>
      </div>
   </div>

</div> <!-- END Content -->

</div>