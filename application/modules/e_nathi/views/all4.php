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
                              <a href="<?=base_url('e_nathi/details/'.$row->id)?>" class="btn btn-success btn-mini">বিস্তারিত</a>
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