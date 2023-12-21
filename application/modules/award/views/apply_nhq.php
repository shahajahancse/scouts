<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('award/circular_list')?>" class="active"><?=$module_name?> </a> </li>
         <li><?=$meta_title; ?></li>
      </ul>
      <style type="text/css">
         #eventsDiv td{padding: 5px;}
         #scoutersDiv td{padding: 5px;}
         #nonExecutiveDiv td{padding: 5px;}
         #awardDiv td{padding: 5px;}
      </style>
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
      
      <?php
      // print_r($nhq_awards); exit;
      $event_category_data = '<option value="">--Select--</option>';
      for($i=0;$i<sizeof($event_category);$i++){
         $event_category_data .= '<option value="'.$event_category[$i]['id'].'">'.$event_category[$i]['event_cate_name'].'</option>';
      }
      
      $office_type_name_data = '<option value="">--Select--</option>';
      for($i=0;$i<sizeof($office_type);$i++){
         $office_type_name_data .= '<option value="'.$office_type[$i]['id'].'">'.$office_type[$i]['office_type_name'].'</option>';
      }
      
      /*$designation_type_data = '<option value="">--Select--</option>';
      foreach ($designation_type as $key => $value) {
         // print_r($value); exit;
         $designation_type_data .= '<option value="'.$key.'">'.$value.'</option>';
      }*/

      /*for($i=0;$i<sizeof($designation_type);$i++){
         $designation_type_data .= '<option value="'.$designation_type[$i]['id'].'">'.$designation_type[$i]['committee_designation_name'].'</option>';
      }*/

      $award_nhq_data = '<option value="">--Select--</option>';
      for($i=0;$i<sizeof($nhq_awards);$i++){
         $award_nhq_data .= '<option value="'.$nhq_awards[$i]['id'].'">'.$nhq_awards[$i]['award_name_bn'].'</option>';
      }

      // print_r($nhq_award_data); exit;
      // $nhq_award_data = '';
      // foreach ($scouts_award as $key => $value) {      
      //    $nhq_award_data .= '<option value="'.$key.'">'.$value.'</option>';
      // }
      ?>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">     
                     <!-- <a href="<?=base_url('committee/national')?>" class="btn btn-blueviolet btn-xs btn-mini"> Group Recommendation List</a>  &nbsp; -->
                  </div>
               </div>

               <div class="grid-body">
                  <?php echo validation_errors(); ?>
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>

                  <?php
                     // print_r($this->session->userdata('user_id'));
                  ?>

                  <?php
                  if($info->status == 1) {
                     $status = '<button class="btn btn-mini btn-info">Current</button>';
                  }else{
                     $status = '<button class="btn btn-mini btn-primary">Expired</button>';
                  }

                  if($this->ion_auth->is_region_admin()){
                     $office_name = 'Region Last Date';
                     $expire = date_detail_format($info->region_end_date);
                  }
                  if($this->ion_auth->is_district_admin()){
                     $office_name = 'District Last Date';
                     $expire = date_detail_format($info->district_end_date);
                  }
                  if($this->ion_auth->is_upazila_admin()){
                     $office_name = 'Upazila Last Date';
                     $expire = date_detail_format($info->upazila_end_date);
                  }
                  if($this->ion_auth->is_group_admin()){
                     $office_name = 'Group Last Date';
                     $expire = date_detail_format($info->group_end_date);
                  }
                  if($this->ion_auth->is_scout_member()){
                     $office_name = 'Last Date';
                     $expire = date_detail_format($info->group_end_date);
                  }

                  ?>
                  <table class="tg" width="100%">
                     <tr>
                        <th class="tg-khup" width="150"> Circular Title</th>
                        <td class="tg-ywa9"><?=$info->circular_title;?></td>
                        <th class="tg-khup"> Award Type</th>
                        <td class="tg-ywa9">National Headquaters Award</td>
                     </tr> 
                     <tr>
                        <th class="tg-khup"> <?=$office_name?> </th>
                        <td class="tg-ywa9"><?=$expire?></td>
                        <th class="tg-khup"> Status</th>
                        <td class="tg-ywa9"><?=$status?></td>                         
                     </tr> 
                     <tr>
                        <th class="tg-khup"> Attachment File</th>
                        <td class="tg-ywa9" colspan="3">
                           <?php 
                           if($info->attachment_file){
                             echo '<a href="'.base_url('uploads/award_file/'.$info->attachment_file).'" download="'.$info->attachment_file.'" class="btn btn-mini btn-xs btn-success" style="margin-bottom:2px;">Download</a>';
                          }
                          ?>
                       </td>
                    </tr>            
                 </table>

                 <br>
                 <div class="row">
                  <div class="col-md-12">
                     <?php 
                     $attributes = array('id' => 'validate');
                        // echo form_open_multipart(base_url('award/recommendation_form/'.$info->id), $attributes);
                     echo form_open_multipart(uri_string(), $attributes);
                     ?>
                     <div class="row form-row">
                     <?php /*
                        <div class="col-md-3">
                           <label class="form-label">Select Award Circular</label>
                           <?php echo form_error('circular_id');
                           $more_attr = 'class="form-control input-sm"';
                           echo form_dropdown('circular_id', $award_circular_dd, set_value('circular_id'), $more_attr);
                           ?>
                        </div>
                     */?>
                     <div class="col-md-3">
                        <label class="form-label">Select Apply Award <span class='required'>*</span></label>
                        <?php echo form_error('recom_award_id');
                        $more_attr = 'class="form-control input-sm" id="recom_award_id"';
                        echo form_dropdown('recom_award_id', $scouts_award, set_value('recom_award_id'), $more_attr);
                        ?>
                     </div>
                  </div>

                  <div class="row form-row">                           
                     <div class="col-md-6">
                        <label class="form-label">Name (Bangla) <span class='required'>*</span></label>   
                        <input name="name_bn" id="name_bn" value="<?=set_value('name_bn')?>" type="text" class="form-control input-sm" placeholder="">
                     </div>
                     <div class="col-md-6">
                        <label class="form-label">Name (English) <span class='required'>*</span></label>   
                        <input name="name_en" id="name_en" value="<?=set_value('name_en')?>" type="text" class="form-control input-sm" placeholder="">
                     </div>
                  </div>

                  <div class="row form-row">                           
                     <div class="col-md-6">
                        <label class="form-label">Father Name <span class='required'>*</span></label>   
                        <input name="father_name" id="father_name" value="<?=set_value('father_name')?>" type="text" class="form-control input-sm" placeholder="">
                     </div>
                     <div class="col-md-6">
                        <label class="form-label">Mother Name <span class='required'>*</span></label>   
                        <input name="mother_name" id="mother_name" value="<?=set_value('mother_name')?>" type="text" class="form-control input-sm" placeholder="">
                     </div>
                  </div>

                  <div class="row form-row">                           
                     <div class="col-md-3">
                        <label class="form-label">Date of Birth <span class='required'>*</span></label>   
                        <input name="dob" id="dob" value="<?=set_value('dob')?>" type="text" class="form-control input-sm datetime" placeholder="DD-MM-YYYY">
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Present Age <span class='required'>*</span></label>   
                        <input name="age" id="age" value="<?=set_value('age')?>" type="text" class="form-control input-sm" placeholder="">
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Scout Joining Date <span class='required'>*</span></label>   
                        <input name="leader_join" id="leader_join" value="<?=set_value('leader_join')?>" type="text" class="form-control input-sm datetime" placeholder="DD-MM-YYYY">
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Present Scouts Designation <span class='required'>*</span></label>   
                        <input name="present_desig" id="present_desig" value="<?=set_value('present_desig')?>" type="text" class="form-control input-sm" placeholder="">
                     </div>
                  </div>

                  <div class="row form-row">                           
                     <div class="col-md-3">
                        <label class="form-label">Mobile Number <span class='required'>*</span></label>   
                        <input name="phone" id="phone" value="<?=set_value('phone')?>" type="text" class="form-control input-sm" placeholder="">
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Email Address</label>   
                        <input name="email" id="email" value="<?=set_value('email')?>" type="text" class="form-control input-sm" placeholder="">
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Gender <span class='required'>*</span></label>
                        <?php echo form_error('gender'); ?>
                        <input type="radio" name="gender" class="genderSC" id="male" value="Male" <?=set_value('gender')=='Male'?'checked':'';?>> <span style="color: black; font-size: 14px;">Male</span> 
                        <input type="radio" name="gender" class="genderSC" id="female" value="Female" <?=set_value('gender')=='Female'?'checked':'';?>> <span style="color: black; font-size: 14px;">Female</span>
                        <input type="radio" name="gender" class="genderSC" id="others" value="Others" <?=set_value('gender')=='Others'?'checked':'';?>> <span style="color: black; font-size: 14px;">Others</span>
                        <div id="typeerror"></div>
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Working Designation <span class='required'>*</span></label>   
                        <input name="working_desig" id="working_desig" value="<?=set_value('working_desig')?>" type="text" class="form-control input-sm" placeholder="">
                     </div>
                  </div>

                  <div class="row form-row">                           
                     <div class="col-md-6">
                        <label class="form-label">Present Address <span class='required'>*</span></label>   
                        <input name="present_address" id="present_address" value="<?=set_value('present_address')?>" type="text" class="form-control input-sm" placeholder="">
                     </div>
                     <div class="col-md-6">
                        <label class="form-label">Permanent Address</label>   
                        <input name="permanent_address" id="permanent_address" value="<?=set_value('permanent_address')?>" type="text" class="form-control input-sm" placeholder="">
                     </div>
                  </div>

                  <div class="row form-row">                           
                     <div class="col-md-6">
                        <label class="form-label">Group/Unit Name <span class='required'>*</span></label>   
                        <input name="sc_group_name" id="sc_group_name" value="<?=set_value('sc_group_name')?>" type="text" class="form-control input-sm" placeholder="">
                     </div>
                     <div class="col-md-6">
                        <label class="form-label">Upazila Name</label>   
                        <input name="sc_upazila_name" id="sc_upazila_name" value="<?=set_value('sc_upazila_name')?>" type="text" class="form-control input-sm" placeholder="">
                     </div>
                     <div class="col-md-6">
                        <label class="form-label">District Name <span class='required'>*</span></label>   
                        <input name="sc_district_name" id="sc_district_name" value="<?=set_value('sc_district_name')?>" type="text" class="form-control input-sm" placeholder="">
                     </div>
                     <div class="col-md-6">
                        <label class="form-label">Region Name <span class='required'>*</span></label>   
                        <input name="sc_region_name" id="sc_region_name" value="<?=set_value('sc_region_name')?>" type="text" class="form-control input-sm" placeholder="">
                     </div>
                  </div>

                  <div class="row form-row">                           
                     <div class="col-md-12">
                        <label class="form-label">Citation (In 100 Words) <span class='required'>*</span></label>   
                        <textarea name="citation" class="form-control input-sm"><?=set_value('citation')?></textarea>
                     </div>
                  </div>

                  <div class="row" id="uploaderDiv" style="display: none;">
                     <p class="help-block" style="margin-left: 15px;">Event Image File type jpg, png, jpeg and maximun file size 300 KB.</p>
                     <div class="col-md-4">  
                        <div class="form-group">
                           <label>Evnet Image 1</label>
                           <div><?php echo form_error('userfile'); ?></div>
                           <input type="file" name="userfile">                  
                        </div>
                     </div>
                     <div class="col-md-4">  
                        <div class="form-group">
                           <label>Evnet Image 2</label>
                           <div><?php echo form_error('userfile2'); ?></div>
                           <input type="file" name="userfile2">                  
                        </div>
                     </div>
                     <div class="col-md-4">  
                        <div class="form-group">
                           <label>Evnet Image 3</label>
                           <div><?php echo form_error('userfile3'); ?></div>
                           <input type="file" name="userfile3">                  
                        </div>
                     </div>
                  </div>

                  <div class="row" style="margin-bottom: 20px;">
                     <div class="col-md-12" >
                        <label class="form-label semi-bold">Events</label>
                        <table width="100%" border="1" id="eventsDiv">
                           <tr>
                              <td width="150">Office Level</td>
                              <td width="150">Event Name</td>
                              <td width="120">Date From </td>
                              <td width="120">Date To</td>
                              <td width="300">Comments/Activity</td>
                              <td width="80"> <a href="javascript:void();" id="addRowEvents" class="label label-success"> <i  class="fa fa-plus-circle"></i> Add More</a> </td>
                           </tr>
                           <tr></tr>
                        </table>
                     </div>
                  </div>

                  <div class="row" style="margin-bottom: 20px;">
                     <div class="col-md-12" >
                        <label class="form-label semi-bold">As Scouters Responsibility Information (স্কাউটার হিসেবে দায়িত্ব পালন সংক্রান্ত তথ্য বিবরণী)</label>
                        <input type="hidden" value="1" id="count">
                        <table width="100%" border="1" id="scoutersDiv">
                           <tr>
                              <td width="150">On Duity Office Level</td>
                              <td width="300">Designation </td>
                              <td width="120">Date From </td>
                              <td width="120">Date To</td>
                              <td width="80"> <a href="javascript:void();" id="addRowResponsibility" class="label label-success"> <i  class="fa fa-plus-circle"></i> Add More</a> </td>
                           </tr>
                           <tr></tr>
                        </table>
                     </div>
                  </div>

                  <div class="row" style="margin-bottom: 20px;">
                     <div class="col-md-12" >
                        <input type="hidden" value="1" id="count">
                        <label class="form-label semi-bold">As Executive/Non-Executive Responsibility(ইউনিট/উপজেলা/জেলা/অঞ্চল/জাতীয় পর্যায়ে নির্বাহী/অনির্বাহী পদে দায়িত্ব পালন) </label>
                        <input type="hidden" value="1" id="count2">
                        <table width="100%" border="1" id="nonExecutiveDiv">
                           <tr>
                              <td width="150">On Duity Office Level</td>
                              <td width="300">Designation </td>
                              <td width="120">Date From </td>
                              <td width="120">Date To</td>
                              <td width="80"> <a href="javascript:void();" id="addRowNonExecutive" class="label label-success"> <i  class="fa fa-plus-circle"></i> Add More</a> </td>
                           </tr>
                           <tr></tr>
                        </table>
                     </div>
                  </div>

                  <div class="row" style="margin-bottom: 20px;">
                     <div class="col-md-12" >
                        <label class="form-label semi-bold">Previous Achived Award (পূর্বে প্রাপ্ত অ্যাওয়ার্ডের বিবরণ) </label>
                        <table width="100%" border="1" id="awardDiv">
                           <tr>
                              <td width="300"> Award Name </td>
                              <td width="120"> Year </td>
                              <td width="80"> <a href="javascript:void();" id="addRowAwards" class="label label-success"> <i  class="fa fa-plus-circle"></i> Add More</a> </td>
                           </tr>
                           <tr></tr>
                        </table>
                     </div>
                  </div>

                  <div class="form-actions">  
                     <div class="pull-right">
                        <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Submit </button>
                     </div>
                  </div>
                  <!-- <input type="hidden" name="hide_id" id="participant_hide_id"> -->
                  <?php echo form_close();?>
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
      // officeFunc();
      scout_member_data();
      // addNewResposibility();

      // Jquery Validation
      $('#validate').validate({
         // focusInvalid: false, 
         ignore: "",
         rules: {
            circular_id: { required: true },
            recom_award_id: { required: true },
            // memberType: { required: true },
            // scout_id: {required: "#selectedSM:checked"},
            name_en: { required: true },
            name_bn: { required: true },
            mother_name: { required: true },
            father_name: { required: true },
            dob: { required: true },
            age: { required: true },
            leader_join: { required: true },
            present_desig: { required: true },
            phone: { required: true },
            email: { required: false, email:true },
            gender: { required: true },
            working_desig: { required: true },
            present_address: { required: true },
            permanent_address: { required: true },
            sc_group_name: { required: true },
            sc_upazila_name: { required: false },
            sc_district_name: { required: true },
            sc_region_name: { required: true },
            citation: { required: true }
         },

         invalidHandler: function (event, validator) {
            //display error alert on form submit    
         },

         errorPlacement: function (label, element) { // render error placement for each input type   
            // if (element.attr("name") == "scout_id") {
            //    label.insertAfter("#typeerror");
            // } else {
               $('<span class="error"></span>').insertAfter(element).append(label)
               var parent = $(element).parent('.input-with-icon');
               parent.removeClass('success-control').addClass('error-control');  
            // }
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

      // Image Uploader Hide/Show
      $('#recom_award_id').change(function(){
         var id = $("#recom_award_id").val();
         // alert(id);
         if(id==1 || id==2 || id==3){
            $("#uploaderDiv").show();
         }else{
            $("#uploaderDiv").hide();
         }
      });

      //Radio button selected
      /*$(function() {
         var $radios = $('input:radio[name=memberType]');
         if($radios.is(':checked') === false) {
            $radios.filter('[value=1]').prop('checked', true);
         }
      });*/

      // Hide/Show
      /*$(".scoutMember").click(function(){
         $("#scoutMemberDiv").show();
         $("#nonScoutMemberDiv").hide();
      });

      $(".nonScoutMember").click(function(){
         $("#scoutMemberDiv").hide();
         $("#nonScoutMemberDiv").show();
      });*/

      /*function officeFunc(){
         $(".otherOffice").hide();
         var selectedValue = $("input[name=memberType]:checked").val();
         if(selectedValue == "1"){
            $(".otherOffice").hide();
         }else{
            $(".otherOffice").show();
         }
      }*/
   });   

   


   //Events
   $("#addRowEvents").click(function(e) {
      var items = '';

      items+= '<tr>';              
      items+= '<td><select name="evt_office_id[]" class="form-control input-sm"><?php echo $office_type_name_data;?></select></td>';
      items+= '<td><select name="evtent_id[]" class="form-control input-sm"><?php echo $event_category_data;?></select></td>';
      items+= '<td><input name="evt_date_from[]" type="text" class="form-control input-sm datetime"></td>';
      items+= '<td><input name="evt_date_to[]" type="text" class="form-control input-sm datetime"></td>';
      items+= '<td><input name="evt_comments[]" type="text" class="form-control input-sm"></td>';
      items+= '<td> <a href="javascript:void();" class="label label-important" onclick="removeRowEvent(this)"> <i class="fa fa-minus-circle"></i> Delete </a></td>';
      items+= '</tr>';

      $('#eventsDiv tr:last').after(items);      
      datetime();
   }); 

   function removeRowEvent(id){ 
      $(id).closest("tr").remove();
   }


   //Resposibility
   // Click to append
   $("#addRowResponsibility").click(function(e) {
      addNewResposibility();
   }); 

   function addNewResposibility() {
      var sl=$('#count').val();
      // alert(sl);
      var items = '';

      items+= '<tr>';              
      items+= '<td><select name="res_office_id[]" id="res_office_'+sl+'" class="form-control input-sm"><?php echo $office_type_name_data;?></select></td>';
      items+= '<td><select name="res_desig_id[]" class="res_desig_val_'+sl+' form-control input-sm"><option value="">-- Select One --</option></select></td>';
      items+= '<td><input name="res_date_from[]" type="text" class="form-control input-sm datetime"></td>';
      items+= '<td><input name="res_date_to[]" type="text" class="form-control input-sm datetime"></td>';
      items+= '<td> <a href="javascript:void();" class="label label-important" onclick="removeRowResponsibility(this)"> <i class="fa fa-minus-circle"></i> Delete </a></td>';
      items+= '</tr>';

      $('#count').val(sl+1);
      $('#scoutersDiv tr:last').after(items);   

      //Load
      responsibility_designation_dd(sl);   
      datetime();
   }

   function removeRowResponsibility(id){ 
      $(id).closest("tr").remove();
   }   

   // Responsibility Dynamic Dropdown
   function responsibility_designation_dd(sl){
      $('#res_office_'+sl).change(function(){
         $('.res_desig_val_'+sl).addClass('form-control input-sm');
         $('.res_desig_val_'+sl+' > option').remove();

         var id = $('#res_office_'+sl).val();
         // alert(id);

         $.ajax({
            type: "POST",
            url: hostname +"award/ajax_get_executive_designation_by_office/" + id,
            success: function(func_data)
            {
               // console.log(func_data);
               $.each(func_data,function(id,name)
               {
                  var opt = $('<option />');
                  opt.val(id);
                  opt.text(name);
                  $('.res_desig_val_'+sl).append(opt);
               });
            }
         });
      });
   }

   //Executive / Non Executive
   $("#addRowNonExecutive").click(function(e) {
      addNewExecutive();
   });

   function addNewExecutive() {
      var sl_no=$('#count2').val();
      var items = '';

      items+= '<tr>';              
      items+= '<td><select name="noe_office_id[]"  id="noe_office_'+sl_no+'" class="form-control input-sm"><?php echo $office_type_name_data;?></select></td>';
      items+= '<td><select name="noe_desig_id[]" class="noe_desig_val_'+sl_no+' form-control input-sm"><option value="">-- Select One --</option></select></td>';
      items+= '<td><input name="noe_date_from[]" type="text" class="form-control input-sm datetime"></td>';
      items+= '<td><input name="noe_date_to[]" type="text" class="form-control input-sm datetime"></td>';
      items+= '<td> <a href="javascript:void();" class="label label-important" onclick="removeRowNonExecutive(this)"> <i class="fa fa-minus-circle"></i> Delete </a></td>';
      items+= '</tr>';

      $('#count2').val(sl_no+1);
      $('#nonExecutiveDiv tr:last').after(items);     

      executive_designation_dd(sl_no) 
      datetime();
   } 

   function removeRowNonExecutive(id){ 
      $(id).closest("tr").remove();
   }

   // Responsibility Dynamic Dropdown
   function executive_designation_dd(sl_no){
      $('#noe_office_'+sl_no).change(function(){
         $('.noe_desig_val_'+sl_no).addClass('form-control input-sm');
         $('.noe_desig_val_'+sl_no+' > option').remove();

         var id = $('#noe_office_'+sl_no).val();
         // alert(id);

         $.ajax({
            type: "POST",
            url: hostname +"award/ajax_get_executive_designation_by_office/" + id,
            success: function(func_data)
            {
               // console.log(func_data);
               $.each(func_data,function(id,name)
               {
                  var opt = $('<option />');
                  opt.val(id);
                  opt.text(name);
                  $('.noe_desig_val_'+sl_no).append(opt);
               });
            }
         });
      });
   }

   // Award Archived
   $("#addRowAwards").click(function(e) {
      var items = '';

      items+= '<tr>';              
      items+= '<td><select name="award_nhq_id[]" class="form-control input-sm"><?php echo $award_nhq_data;?></select></td>';
      items+= '<td><input name="award_year[]" type="text" class="form-control input-sm"></td>';
      items+= '<td> <a href="javascript:void();" class="label label-important" onclick="removeRowAwards(this)"> <i class="fa fa-minus-circle"></i> Delete </a></td>';
      items+= '</tr>';

      $('#awardDiv tr:last').after(items);      
      datetime();
   }); 

   function removeRowAwards(id){ 
      $(id).closest("tr").remove();
   }

   // Scouts member data load by default logged in user   
   function scout_member_data(){
      var id = <?=$this->session->userdata('user_id')?>; //$('#scout_member_id').val();
      // alert(id);

      $.ajax({
         type: "GET",
         url: hostname +"award/ajax_get_scouts_member_info/" + id,
         success: function(response)
         {   
            var presentAddress = response.pre_village_house + ', ' + response.pre_road_block + ', ' + response.pre_up_th_name + ', ' + response.pre_district_name + ', ' + response.pre_div_name;
            var permanentAddress = response.per_village_house + ', ' + response.per_road_block + ', ' + response.per_up_th_name + ', ' + response.per_district_name + ', ' + response.per_div_name;
            var ageDetails = response.ageYear + ' Year, ' + response.ageMonth + ' Month, ' + response.ageDay + ' Day';

            // console.log(response.scout_id);
            $('#name_bn').val(response.full_name_bn);
            $('#name_en').val(response.first_name);
            $('#mother_name').val(response.mother_name);
            $('#father_name').val(response.father_name);
            $('#dob').val(response.dobDate);
            $('#age').val(ageDetails);
            $('#phone').val(response.phone);
            $('#email').val(response.email);
            $('#leader_join').val(response.joindate);
            $('#working_desig').val(response.scout_designation);
            $('#present_address').val(presentAddress);
            $('#permanent_address').val(permanentAddress);
            $('#sc_group_name').val(response.grp_name);
            $('#sc_upazila_name').val(response.upa_name);
            $('#sc_district_name').val(response.dis_name);
            $('#sc_region_name').val(response.region_name);
            // $("input[name='gender']:checked").val(response.gender);
            if(response.gender == 'Male'){
               document.getElementById("male").checked = true;
            }else if(response.gender == 'Female'){
               document.getElementById("female").checked = true;
            }else if(response.gender == 'Others'){
               document.getElementById("others").checked = true;  
            }
         }
      });
   }

</script>