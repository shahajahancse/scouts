<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('committee/region')?>" class="active"><?=$module_name?> </a> </li>
         <li><?=$meta_title; ?></li>
      </ul>

      <style type="text/css">
         .tg  {border-collapse:collapse;border-spacing:0; border: 0px solid red;}
         .tg td{font-size:14px;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#00000;background-color:#E0FFEB; vertical-align: middle;}
         .tg th{font-size:14px;font-weight:bold;padding:3px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#bce2c5;text-align: center;}
         .tg .tg-ywa9{background-color:#ffffff;vertical-align:top; color: black;}
         .tg .tg-khup{background-color:#efefef;vertical-align:top; color: black; text-align: right;}
         .tg .tg-akf0{background-color:#ffffff;vertical-align:top;color: black;}
         .tg .tg-mtwr{background-color:#efefef;vertical-align:top; font-weight: bold; text-align: center; font-size: 16px;text-decoration: underline;}
      </style>          

      <style type="text/css">
         .tg2  {border-collapse:collapse;border-spacing:0; width: 100%; color: black;}
         .tg2 td{font-family:Arial, sans-serif;font-size:14px;padding:4px 7px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
         .tg2 th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:4px 7px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal; text-align: center;}
         .tg2 .tg-71hr{background-color:#a7afaf; font-weight: bold;}
      </style>        

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">                
                     <a href="<?=base_url('committee/district')?>" class="btn btn-blueviolet btn-xs btn-mini"> Committee List</a>  &nbsp;
                     <a href="<?=base_url('committee/district_update/'.encrypt_url($info->id))?>" class="btn btn-blueviolet btn-xs btn-mini"> Committee Update</a> &nbsp;
                     <a href="<?=base_url('committee/pdf_district_committee/'.encrypt_url($info->id))?>" class="btn btn-success btn-mini" target="_blank"> Download PDF</a>
                  </div>
               </div>

               <div class="grid-body"  id="printableArea">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>

                  <?php
                  if($info->is_current == 1) {
                     $status = '<button class="btn btn-mini btn-info">Current</button>';
                  }else{
                     $status = '<button class="btn btn-mini btn-primary">Expired</button>';
                  }
                  ?>

                  <table class="tg" width="100%">
                     <tr>
                        <th class="tg-khup" width="150"> Committee Name</th>
                        <td class="tg-ywa9" colspan="3"><?=$info->committee_name;?></td>
                        <th class="tg-khup"> Scouts Office</th>
                        <td class="tg-ywa9"><?=$info->dis_name;?></td>
                     </tr> 
                     <tr>
                        <th class="tg-khup"> Session </th>
                        <td class="tg-ywa9">From <strong><?=date_detail_format($info->session_start_date)?></strong> to <strong><?=date_detail_format($info->session_end_date)?></strong></td>
                        <th class="tg-khup"> Status</th>
                        <td class="tg-ywa9"><?=$status?></td> 
                        <th class="tg-khup"> Commt. Type</th>
                        <td class="tg-ywa9"><?=$info->committee_type_name?></td> 
                     </tr>            
                  </table>

                  <br>
                  <div class="row">
                     <div class="col-md-12">
                        <?php 
                        $attributes = array('id' => 'committee_validate');
                        echo form_open("", $attributes);?>
                        <div class="row form-row">
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label class="form-label">Committee Member Type<span class="required">*</span></label><br>                                 
                                 <input type="radio" class="scoutMember" name="memberType" value="1" <?=set_value('memberType')==1?'checked':'';?>> Scout Member
                                 <input type="radio" class="nonScoutMember" name="memberType" value="2" <?=set_value('memberType')==2?'checked':'';?>> Non Scout Member
                                 <div id="typeerror"></div>
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div id="scoutMemberDiv">
                                 <label class="form-label">Scout Member ID </label>
                                 <?php echo form_error('member_scout_id')?>
                                 <select class="scoutIDSingleSelect2 form-control input-sm" name="member_scout_id" id="member_scout_id" style="width: 100%;"></select>
                                 <div id="typeerror"></div>
                              </div>
                              <div id="nonScoutMemberDiv" style="display: none;">
                                 <label class="form-label">Non Scout Member Name</label>   
                                 <input name="member_name" id="member_name" value="<?=set_value('committee_name')?>" type="text" class="form-control input-sm" placeholder="">
                              </div>
                           </div>
                           <div class="col-md-3">
                              <label class="form-label">Comm. Designation</label>
                              <?php echo form_error('member_comm_desig_id');
                              $more_attr = 'class="form-control input-sm" id="member_comm_desig_id"';
                              echo form_dropdown('member_comm_desig_id', $designation_dd, set_value('member_comm_desig_id'), $more_attr);
                              ?>
                           </div>
                           <div class="col-md-2">
                              <label class="form-label">Serial No</label>   
                              <input name="sl_no" id="sl_no" value="<?=set_value('sl_no')?>" type="number" class="form-control input-sm" placeholder="">
                           </div>                           
                        </div>

                        <div class="row form-row">
                          <div class="col-md-2">
                           <label class="form-label">Mobile Number</label>   
                           <input name="member_mobile" id="member_mobile" value="<?=set_value('member_mobile')?>" type="text" class="form-control input-sm" placeholder="">
                        </div>
                        <div class="col-md-3">
                           <label class="form-label">Email Address</label>   
                           <input name="member_email" id="member_email" value="<?=set_value('committee_name')?>" type="text" class="form-control input-sm" placeholder="">
                        </div>
                        <div class="col-md-3">
                           <label class="form-label">Professional Designation</label>   
                           <input name="member_profession" id="member_profession" value="<?=set_value('committee_name')?>" type="text" class="form-control input-sm" placeholder="">
                        </div>
                        <div class="col-md-3">
                           <label class="form-label">Office Address</label>   
                           <input name="member_address" id="member_address" value="<?=set_value('committee_name')?>" type="text" class="form-control input-sm" placeholder="">
                        </div>
                        
                        <div class="col-md-1">  
                           <label class="form-label">&nbsp;</label>
                           <button type="submit" class="btn btn-primary btn-mini mini-btn-padding">Save</button>
                        </div>
                     </div>
                     <!-- <input type="hidden" name="hide_id" id="participant_hide_id"> -->
                     <input type="hidden" name="hide_committee_id" id="committee_hide_id" value="<?=encrypt_url($info->id)?>">              
                     <?php echo form_close();?>
                  </div>
               </div>

               <div class="row">
                  <div class="col-md-12">
                     <h4 style="text-align: center;"><span class="semi-bold">Committee Member List</span></h4>
                     <span id="print_ajax_result"></span>
                  </div>   
               </div>                  

            </div>  <!-- END GRID BODY -->              
         </div> <!-- END GRID -->
      </div>

   </div> <!-- END ROW -->

</div>
</div>



<script type="text/javascript">  
   $(document).ready(function() {
      func_committee_member_list();

      //Radio button selected
      $(function() {
         var $radios = $('input:radio[name=memberType]');
         if($radios.is(':checked') === false) {
            $radios.filter('[value=1]').prop('checked', true);
         }
      });

      //Default Input disable
      $("#member_mobile").prop('disabled', true);
      $("#member_email").prop('disabled', true);
      //$("#member_profession").prop('disabled', true);
      //$("#member_address").prop('disabled', true);

      // Hide/Show
      $(".scoutMember").click(function(){
         $("#scoutMemberDiv").show();
         $("#nonScoutMemberDiv").hide();
         //Disable Input
         $("#member_mobile").prop('disabled', true);
         $("#member_email").prop('disabled', true);
         // $("#member_profession").prop('disabled', true);
         // $("#member_address").prop('disabled', true);
      });

      $(".nonScoutMember").click(function(){
         $("#scoutMemberDiv").hide();
         $("#nonScoutMemberDiv").show();
         //Enable Input
         $("#member_mobile").prop('disabled', false);
         $("#member_email").prop('disabled', false);
         // $("#member_profession").prop('disabled', false);
         // $("#member_address").prop('disabled', false);
      });


      $('#committee_validate').validate({
         // focusInvalid: false, 
         ignore: "",
         rules: {
         // member_scout_id: {
         //    required: '#memberType[value="2"]:checked'
         // },
         // member_name: {
         //    required: function() {
         //                return $('[name="memberType"]:checked').length >0; 
         //            }
         // },

         member_comm_desig_id: {
            required: true
         },
         sl_no: {
            required: true
         }
      },

      invalidHandler: function (event, validator) {
         //display error alert on form submit    
      },

      errorPlacement: function (label, element) { // render error placement for each input type   
         if (element.attr("name") == "member_scout_id") {
            label.insertAfter("#typeerror");
         } else {
            $('<span class="error"></span>').insertAfter(element).append(label)
            var parent = $(element).parent('.input-with-icon');
            parent.removeClass('success-control').addClass('error-control');  
         }
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
         // form.submit();
         func_committee_member_list();
      }
   });

   });   


   function func_committee_member_list(){
      $.ajax({        
         method: "GET",
         url: "<?=base_url('committee/ajax_district_member_list/')?>",
         data: { 
            commID: $("#committee_hide_id").val(), 
            commDesigID: $("#member_comm_desig_id").val(),
            slNo: $("#sl_no").val(),
            scoutID: $("#member_scout_id").val(),
            memberName: $("#member_name").val(),
            memberProf: $("#member_profession").val(),
            memberMobile: $("#member_mobile").val(),
            memberEmail: $("#member_email").val(),
            memberAdd: $("#member_address").val()
         }
      })
      .done(function( msg ) {
         detailsarr=msg.split('23432sdfg324');
         if(detailsarr[0]=='duplicate'){
            alert('This informatin already added.');
            // alert('এই এনআইডি টি পূর্বে সংরক্ষণ করা হয়েছে');
         }
         if(detailsarr[1]!=''){
            $('#print_ajax_result').html(detailsarr[1]);

            // Null form field
            $("#member_comm_desig_id").val('');            
            // $("#member_scout_id").select2("val", "");
            $('#member_scout_id').html('');
            $("#sl_no").val('');
            $("#member_name").val('');
            $("#member_profession").val('');
            $("#member_mobile").val('');
            $("#member_email").val('');
            $("#member_address").val('');
         }
      }); 
   }

   function func_delete_committee_member(delid){

      // alert(delid);
      
      if(confirm('Are you sure you want to delete this data?')){
         $.ajax({        
            method: "GET",
            url: "<?=base_url('committee/ajax_district_member_list/')?>",
            data: { delete_id: delid, commID: $("#committee_hide_id").val()}
         })
         .done(function( msg ) {
            detailsarr=msg.split('23432sdfg324');
            if(detailsarr[0]=='duplicate'){
               alert('Duplicate')
            }
            if(detailsarr[1]!=''){
               $('#print_ajax_result').html(detailsarr[1]);
            }
         }); 
      }
   }
</script>