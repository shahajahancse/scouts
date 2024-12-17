<!-- Create by: Mafizur
  Create Date: 07-06-2018
  Modify by: mafizur
  last modify date: 12-08-2018 -->
<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb">
      <li> <?=$module_name?></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <div class="row">
       <div class="col-md-12">
            <div class="grid simple horizontal red">
              <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  
              </div>
          <div class="grid-body">
             
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
            <div id="error">
              <div class="alert alert-danger">
                    লাল চিহ্ন ফিল্ডগুলি আবশ্যক
                </div>
            </div>

            <?php 
              $attributes = array('id' => 'validate');
              echo form_open_multipart(uri_string(), $attributes);?>
                <div>

                <!-- Tab panes -->
                <div class="tab-content">
                  <div role="tabpanel" class="tab-pane active" id="home">

                    
                      <div class="col-md-4">
                          <label class="form-label"> নথি নং <span class='required'>*</span></label>
                            <?php echo form_error('date'); ?>
                              <?php echo form_error('nathi_no'); ?>
                              <input type="text" name="nathi_no" id="nathi_no" value="<?=set_value('nathi_no',$nathi_number)?>" class="form-control input-sm required" required= "required" readonly>
                      </div>

                      <div class="col-md-4">
                            <label class="form-label"> তারিখ <span class='required'>*</span></label>
                            <?php echo form_error('date'); ?>
                            <input name="date" value="<?=set_value('date',date('d-m-Y'))?>" type="text" class="form-control input-sm datetime required" placeholder="DD-MM-YYYY" required>
                      </div> 
                      <div class="col-md-4">
                          <label class="form-label"> ফোল্ডারের নাম  </label>
                            <?php echo form_dropdown('folder_id', $folder, set_value('folder_id'), 'style="width:100%"'); ?>
                      </div>
                      <div class="col-md-12"></div>

                      <div class="col-md-12">
                           <label class="form-label">নথির নাম<span class="star required">*</span></label>
                            <?php echo form_error('title'); ?>
                            <textarea name="title"  placeholder="নথির নাম" class="form-control input-sm required"  id="title" required="required" rows="1"></textarea>
                      </div>
                        
                      <div class="col-md-12">
                          <label class="form-label">বিবরণ <span class="star required">*</span></label>
                          <?php echo form_error('details'); ?>
                          <textarea name="details"  placeholder="বিবরণ" class="form-control input-sm required" required="required" rows="10"></textarea>
                      </div>

                      <div class="col-md-12" style="margin-top:15px; margin-bottom:15px" > 
                           
                           <button type="submit" name="btnsubmit" value="send" class="btn btn-success btnSubmit1"> সংরক্ষণ</button>
                      </div>

                  </div>
                </div>

              </div>

              <!-- Modal start here-->
              <div class="modal fade" id="priveiw_budget" tabindex="-1" role="dialog" aria-hidden="true" id="send_email_sms">
                    <div class="modal-dialog modal-large" style="width: 90%;">
                      <div class="modal-content">
                        
                        <div id="priview_budget_demand" style="padding: 5px; font-weight: bold;background-color: #ffffff;font-size: 18px;text-align: left">
                        </div>
                       <div class="modal-footer">
                          <button type="submit" name="btnsubmit" value="send" class="btn btn-info btnSubmit"> সংরক্ষণ এবং প্রেরণ</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal">বন্ধ করুন</button>
                        </div>
                      </div>
                    </div>
              </div>
              <!-- Modal End here-->

            <div class="modal fade bs-example-modal-sm" id="errorModel" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">বিজ্ঞপ্তি</h4>
                  </div>
                  <div class="modal-body">
                    <h4 class="text-center">লাল চিহ্ন ফিল্ডগুলি আবশ্যক</h4>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">বন্ধ করুন</button>
                  </div>
                </div>
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
        $('#error').hide();
        $('#error2').hide();

        $(".desk").click(function() {
            $('.desk').prop("checked", false);
            $(this).prop("checked", true);
        });
    });
    function preview(){

      url = hostname+"e_filing/getPreview/";
      var element = document.getElementById("validate");
      var formdata = new FormData(element);

      $.ajax({
        url: url,
        method: 'POST',
        data: formdata,
        processData: false,
        contentType: false,
        dataType: 'text',
        success: function(data) {
          console.log(data);
          $('#priview_budget_demand').html(data);
        },
        error: function(jqXHR, textStatus, errorThrown){
         console.log('error occured!!!, '+errorThrown);
        }
      });
    }
    
</script>

<script type="text/javascript">
   $(document).ready(function() {
      $('#validate').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
         memorandum_no: {
            required: true,
            minlength: 1,
            maxlength: 5
         },
      },
    });
   });   
</script>


<script type="text/javascript">
  $(document).ready(function() {
    /**
    * validate form 
    */
    $(".btnPreview").on('click',function(){
      var isValid = true;
      $(".form-control.input-sm.required").each(function() {           
        if ($(this).val() === "") { 
          isValid = false;
          $(this).css("border","1px solid red");
        }else{
          $(this).css("border","1px solid #0aa699");
        }
        

      });

      if (isValid == false) {
        $("#error").show();
        $('#errorModel').modal('toggle');
        return false;
      }else{
        $("#error").hide();
        $('#priveiw_budget').modal('toggle');
        preview();
      }
    });

    $(".btnSubmit").on('click',function(){
      var isValid = true;
      $(".form-control.input-sm.required").each(function() {           
        if ($(this).val() === "") { 
          isValid = false;
          $(this).css("border","1px solid red");
        }else{
          $(this).css("border","1px solid #0aa699");
        }

      });

      if (isValid == false) {
        $("#error").show();
        $('#errorModel').modal('toggle');
        $('#priveiw_budget').modal('toggle');
        return false;
      }else{
        if($('.btnSubmit').val()=='save'){
            var r = confirm("উক্ত নথি কী সংরক্ষণ  করতে চান ?");
            if (r == false) {
              return false;
            }
        }
        if($('.btnSubmit').val()=='send'){
            var r = confirm("উক্ত নথি কী সংরক্ষণ  করতে চান ?");
            if (r == false) {
             return false;
            }
        }
        $("#validate").submit();
      }
    });

    $(".btnSubmit1").on('click',function(){
      var isValid = true;
      $(".form-control.input-sm.required").each(function() {           
        if ($(this).val() === "") { 
          isValid = false;
          $(this).css("border","1px solid red");
        }else{
          $(this).css("border","1px solid #0aa699");
        }

      });

      if (isValid == false) {
        $("#error").show();
        $('#errorModel').modal('toggle');
        return false;
      }else{
        if($('.btnSubmit').val()=='save'){
            var r = confirm("উক্ত নথি কী সংরক্ষণ  করতে চান ?");
            if (r == false) {
              return false;
            }
        }
        if($('.btnSubmit').val()=='send'){
            var r = confirm("উক্ত নথি কী সংরক্ষণ করতে চান ?");
            if (r == false) {
             return false;
            }
        }
        $("#validate").submit();
      }
    });
    
  });
</script>
