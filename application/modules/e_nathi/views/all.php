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
                     
                  </div>            
               </div>

               <div class="grid-body ">
                  <div><?php echo validation_errors(); ?></div>
                  <?php if($this->session->flashdata('success')):?>
                    <div class="modal fade bs-example-modal-sm" id="successModel" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                      <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                          <div class="modal-body">
                            <h4 class="text-center"><?php echo $this->session->flashdata('success');?></h4>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">বন্ধ করুন</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <script type="text/javascript">
                        $(document).ready(function() {
                          $('#successModel').modal('toggle'); 
                        });
                    </script>
                  <?php endif; ?>

                  <?php if($this->session->flashdata('warning')):?>
                  <div class="modal fade bs-example-modal-sm" id="warningModel" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                      <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                          <div class="modal-body">
                            <h4 class="text-center"><?php echo $this->session->flashdata('warning');?></h4>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">বন্ধ করুন</button>
                          </div>
                        </div>
                      </div>
                    </div>
                     <script type="text/javascript">
                        $(document).ready(function() {
                          $('#warningModel').modal('toggle'); 
                        });
                    </script>
                  <?php endif; ?>
                  

                  <div class="clearfix"></div>
                  <hr >
                  <table class="table table-hover table-condensed" border="0">
                     <thead>
                        <tr>
                           <th style="width:5%"> ক্রম</th>
                           <th style="width:35%">নথির নাম</th>
                           <th style="width:20%">নথি নং</th>
                           <th style="width:25%">বিভাগ</th>
                           <th style="width:15%">নথি প্রস্তুতের তারিখ </th>                          
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
                              <div class="btn-group"> <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> Action <span class="caret"></span> </a>
                                 <ul class="dropdown-menu pull-right">
                                    <li>
                                       <a href="<?=base_url('e_nathi/details/'.$row->id)?>" class="btn btn-success btn-mini">নথিতে লিখুন </a>
                                    </li>
                                    <li>
                                       <a href="<?=base_url('e_nathi/details/'.$row->id)?>" class="btn btn-success btn-mini">নথির বিস্তারিত দেখুন </a>
                                    </li>
                                    <li>
                                       <a class="" data-toggle="modal" data-target=".edit<?=$row->id?>" style="margin-right: 15px">সম্পাদন করুন</a>
                                    </li>
                                    <li><?=anchor("e_nathi/status/0/".$row->id, 'আর্কাইভ করুন')?></li>
                                    
                                 </ul>
                              </div>


                               <div class="modal fade edit<?=$row->id?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                                 <div class="modal-dialog modal-md" role="document">
                                   <div class="modal-content">
                                     <?php $attributes = array('id' => 'validate');
                                     echo form_open_multipart(base_url('e_nathi/nathi_edit/'.$row->id), $attributes);?>
                                     
                                     <div class="modal-body text-left">
                                       <div class="row">
                                          <div class="col-md-12">
                                                 <label class="form-label"> নথি প্রস্তুতের তারিখ <span class='required'>*</span></label>
                                                 <?php echo form_error('date'); ?>
                                                 <input name="date" value="<?=set_value('date',$row->date)?>" type="text" class="form-control input-sm datetime required" placeholder="DD-MM-YYYY" required>
                                           </div> 
                                           <div class="col-md-12">
                                               <label class="form-label"> ফোল্ডারের নাম  </label>
                                                 <?php echo form_dropdown('folder_id', $folder, set_value('folder_id',$row->folder_id), 'style="width:100%"'); ?>
                                           </div>
                                           

                                           <div class="col-md-12">
                                                <label class="form-label">নথির নাম<span class="star required">*</span></label>
                                                 <?php echo form_error('title'); ?>
                                                 <input name="title" value="<?=set_value('title',$row->title)?>" type="text" class="form-control input-sm  required"  required>
                                           </div>
                                             
                                           <div class="col-md-12">
                                               <label class="form-label">বিবরণ <span class="star required">*</span></label>
                                               <?php echo form_error('details'); ?>
                                               <input name="details" value="<?=set_value('details',$row->details)?>" type="text" class="form-control input-sm  required"  required>
                                           </div>
                                        </div>
                                     </div>
                                     <div class="modal-footer">
                                       <br>
                                       <button type="button" class="btn btn-default" data-dismiss="modal">বন্ধ করুন</button>
                                       <button type="submit" class="btn btn-primary">সম্পাদন করুন</button>
                                     </div>

                                     <?php echo form_close();?>
                                   </div>
                                 </div>
                               </div>
                           </td>
                        </tr>
                     <?php endforeach;?>                      
                  </tbody>
               </table>     
            </div>

            <?php 
            $attributes = array('id' => 'validate');
            echo form_open_multipart(uri_string(), $attributes);?>
            <div class="grid-body ">
               <h4 class="semi-bold">নতুন নথি তৈরি করুন</h4>
               <table width="100%" border="1" id="memberDiv">
                  <tr>
                     <td class="text-center" width="25%" style="padding: 5px">নথির নাম</td>
                     <td class="text-center" width="50%" style="padding: 5px">বিবরণ</td>
                     <td class="text-center" width="15%" style="padding: 5px">নথি প্রস্তুতের তারিখ</td>
                     <td class="text-center" width="15%" style="padding: 5px">ফোল্ডারের নাম</td>
                     <td class="text-center" width="10%" style="padding: 5px"> <a href="javascript:void();" id="addRow" class="label label-success"> <i class="fa fa-plus-circle"></i> Add More</a> </td>
                  </tr>
                  <tr></tr>
               </table>        
            </div>
            <div class="modal-footer text-center">
               <button type="submit" name="btnsubmit" value="send" class="btn btn-primary btnSubmit"> সংরক্ষণ</button>
            </div>
            <?php echo form_close();?> 
         </div>
      </div>
   </div>

</div> <!-- END Content -->

</div>

<?php
$folder_data = '';
foreach ($folder as $key => $value) {
   $folder_data .= '<option value="'.$key.'">'.$value.'</option>';
}
?>

<script type="text/javascript">
   
   // Education
   $("#addRow").click(function(e) {
      var items = '';
      items+= '<tr>';        
      items+= '<td><input type="text" name="title[]" class="form-control input-sm" required></td>';
      items+= '<td><input type="text" name="details[]" class="form-control input-sm" required></td>';
      items+= '<td><input name="date[]"  type="date" class="form-control input-sm datetime required" placeholder="DD-MM-YYYY" required></td>';
      items+= '<td><select class="input-sm" name="folder_id[]"><?php echo $folder_data;?></select></td>';
      items+= '<td class="text-center"><a href="javascript:void();" class="label label-important" onclick="removeRow(this)"> <i class="fa fa-minus-circle"></i> Remove </a></td>';
      items+= '</tr>';
      
      $('#memberDiv tr:last').after(items);
   });

   function removeRow(id){ 
      $(id).closest("tr").remove();
   }
</script>