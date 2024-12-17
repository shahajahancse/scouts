<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url('e_book')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>

    <style type="text/css">
         #memberDiv td{padding: 5px;}
      </style>

    <div class="row">
     <div class="col-md-12">
      <div class="grid simple horizontal red">
       <div class="grid-title">
        <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>              
        <div class="pull-right">
          <a href="<?=base_url('e_book')?>" class="btn btn-blueviolet btn-xs btn-mini"> E-Book List</a> 
        </div> 
      </div>
      <div class="grid-body">
        <!-- <form id="form_traditional_validation" action="#"> -->
        <!-- <div id="infoMessage"><?php //echo $message;?></div> -->
        <div><?php //echo validation_errors(); ?></div>
        <?php if($this->session->flashdata('success')):?>
          <div class="alert alert-success">                      
            <?php echo $this->session->flashdata('success');;?>
          </div>
        <?php endif; ?>

        <?php if($message != NULL):?>
          <div class="alert alert-danger">                      
            <?php echo $message;?>
          </div>
        <?php endif; ?>

        <?php 
        $attributes = array('id' => 'validate');
        echo form_open_multipart("e_book/create", $attributes);
        ?>

        <div class="row">
          <div class="col-md-5">
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label">Book Category <span class="required">*</span></label>
                <?php echo form_error('category_id'); ?>
                <?php echo form_dropdown('category_id', $ebook_category, set_value('category_id'), 'class="form-control input-sm"'); ?>
              </div>
              <div class="col-md-12">
                <label class="form-label">Book Title <span class="required">*</span></label>
                <?php echo form_error('book_title'); ?>
                <input name="book_title" type="text" value="<?=set_value('book_title')?>" class="form-control input-sm">
              </div>
              <div class="col-md-12">
                <label class="form-label">Description (Max. 200 character)</label>
                <?php echo form_error('description'); ?>
                <textarea name="description" class="form-control input-sm"><?=set_value('description')?></textarea>
              </div>
            </div>
            <div class="row form-row">      
              <div class="col-md-12">
                <label>Cover Photo Upload <span class="required">*</span></label>
                <div><?php echo form_error('userfile'); ?></div>
                <input type="file" name="userfile">
                <p class="help-block">
                  <ul>
                    <li>File type jpg, png, jpeg and maximun file size 100 KB</li>
                    <li>Image Width: 111 PX and Height: 144 PX</li>
                  </ul>
                </p>
              </div>

              <div class="col-md-12">
                <label>PDF Book Upload <span class="required">*</span></label>
                <div><?php echo form_error('userfile_pdf'); ?></div>
                <input type="file" name="userfile_pdf">
                <p class="help-block">
                  <ul>
                    <li>File type PDF only</li>
                    <li>Maximun upload file size 50 MB</li>
                  </ul>
                </p>
              </div>                    
            </div>
          </div>

          <div class="col-md-7">

            <div class="row form-row">    
              <div class="col-md-12">
                <label class="form-label">Total Page <span class="required">*</span></label>
                <?php echo form_error('total_page'); ?>
                <input name="total_page" type="number" value="<?=set_value('total_page')?>" class="form-control input-sm">
              </div>

              <div class="col-md-12" >
                <h4 class="semi-bold">E-Book Index List</h4>
                <table width="100%" border="1" id="memberDiv">
                 <tr>
                  <td>Index Title</td>
                  <td width="80">Page No</td>                      
                  <td width="50"> <a href="javascript:void();" id="addRow" class="label label-success"> <i class="fa fa-plus-circle"></i> Add More</a> </td>
                </tr>
                <tr></tr>
              </table>
            </div>
          </div>
        </div>

      </div>

      <div class="form-actions">  
        <div class="pull-right">
          <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Save</button>
          <!-- <button type="button" class="btn btn-white btn-cons">Cancel</button> -->
        </div>
      </div>
      <?php echo form_close();?>

    </div>  <!-- END GRID BODY -->              
  </div> <!-- END GRID -->
</div>

</div> <!-- END ROW -->

</div>
</div>
<script type="text/javascript">
 $(document).ready(function() {
  $('#validate').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
        category_id: { required: true }, 
        book_title: { required: true }, 
        description: { required: false, maxlength: 200 },         
        userfile: { required: true },
        userfile_pdf: { required: true }
      },

      invalidHandler: function (event, validator) {
         //display error alert on form submit    
       },

      errorPlacement: function (label, element) { // render error placement for each input type   
       $('<span class="error"></span>').insertAfter(element).append(label)
       var parent = $(element).parent('.input-with-icon');
       parent.removeClass('success-control').addClass('error-control');  
     },

      highlight: function (element) { // hightlight error inputs
       var parent = $(element).parent();
       parent.removeClass('success-control').addClass('error-control'); 
     },

      unhighlight: function (element) { // revert the change done by hightlight

      },

      success: function (label, element) {
       var parent = $(element).parent('.input-with-icon');
       parent.removeClass('error-control').addClass('success-control'); 
     },

     submitHandler: function (form) {
       form.submit(); 
     }
   });
});   



// Dynamic Index
$("#addRow").click(function(e) {
  var items = '';
  items+= '<tr>';        
  items+= '<td><input type="text" name="index_title[]" class="form-control input-sm"></td>';
  items+= '<td><input type="number" name="page_no[]" class="form-control input-sm"></td>';
  items+= '<td><a href="javascript:void();" class="label label-important" onclick="removeRow(this)"> <i class="fa fa-minus-circle"></i> Remove </a></td>';
  items+= '</tr>';
  
  $('#memberDiv tr:last').after(items);
});

function removeRow(id){ 
  $(id).closest("tr").remove();
}
</script>