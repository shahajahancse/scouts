<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <!-- <li> <a href="<?=base_url('dahsboard')?>" class="active"> Dashboard </a> </li> -->
         <li> <a href="" class="active"><?=$module_name?> </a></li>
         <li><?=$meta_title; ?> </li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple ">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                     <a href="<?=base_url('e_folder/create')?>" class="btn btn-primary btn-blueviolet btn-xs btn-mini" style="float: right;">নতুন ফোল্ডার তৈরি করুন</a>
                  </div>            
               </div>

               <div class="grid-body ">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>

                  <div class="clearfix"></div>
                  <hr >
                  <table class="table table-hover table-condensed" border="0">
                     <thead>
                        <tr>
                           <th style="width:2%"> # </th>
                           <th style="width:50%">ফোল্ডারের নাম</th>
                           <th style="width:20%">তৈরীর তারিখ</th>                       
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
                           <td> <strong><?=$row->name?></strong> </td>
                           <td class="v-align-middle"><?=date_bangla_calender_format($row->created_at); ?></td>
                           <td align="right">
                              <a href="<?=base_url('e_folder/edit/'.$row->id)?>" class="btn btn-success btn-mini">সম্পাদন করুন</a>
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