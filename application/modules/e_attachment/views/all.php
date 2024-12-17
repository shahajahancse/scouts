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
                         <th class="text-center">সংযুক্ত ফাইলের নাম</th>
                         <th class="text-center">ডাউনলোড </th>
                       </tr>
                     </thead>
                     <tbody>
                       <?php foreach ($results as $file) { ?>
                         <tr>
                           <td><?=$file->name?></td>
                           <td class="text-center"><a  href="<?=base_url('efile_img/'.$file->userfile)?>" download=""><i class="fa fa-download"></i></a> </td>
                       </tr>
                       <?php } ?>
                     </tbody>
               </table>

               <?php 
              $attributes = array('id' => 'validate');
              echo form_open_multipart(base_url('e_attachment/all'), $attributes);?>
                

                  
                      <div class="">
                        <h4 class="semi-bold">সংযুক্ত  করুন</h4>
                       <table width="100%" border="1" id="memberDiv">
                          <tr>
                            <td class="text-center" width="45%" style="padding: 5px">সংযুক্ত ফাইলের নাম </td>
                             <td class="text-center" width="45%" style="padding: 5px">নির্বাচন করুন</td>
                             <td class="text-center" width="10%" style="padding: 5px"> <a href="javascript:void();" id="addRow" class="label label-success"> <i class="fa fa-plus-circle"></i> Add More</a> </td>
                          </tr>
                          <tr></tr>
                       </table>
                       <span style="color: red">বিঃ দ্রঃ - ফাইল সাইজ সর্বোচ্চ ২ MB, ফাইল ফরমেট : JPG, PNG, PDF, DOC</span>
                        
                      </div>

                      <div style="margin-top:15px; margin-bottom:15px" > 
                           
                           <button type="submit" name="btnsubmit" value="send" class="btn btn-success btnSubmit1"> সংরক্ষণ</button>
                      </div>

                <?php echo form_close();?>
            </div>

         </div>
      </div>
   </div>

</div> <!-- END Content -->

</div>
<script type="text/javascript">
   
   // Education
   $("#addRow").click(function(e) {
      var items = '';
      items+= '<tr>';

      items+= '<td><input type="text" name="file_name[]" class="form-control input-sm" required></td>';

      items+= '<td><input type="file" name="userfile[]" class="form-control input-sm" required></td>';

      items+= '<td class="text-center"><a href="javascript:void();" class="label label-important" onclick="removeRow(this)"> <i class="fa fa-minus-circle"></i> Remove </a></td>';
      items+= '</tr>';
      
      $('#memberDiv tr:last').after(items);
   });

   function removeRow(id){ 
      $(id).closest("tr").remove();
   }
</script>