<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li><a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a></li>
         <li><a href="<?=base_url('award/president_scout_list')?>" class="active"><?=$module_name?></a></li>
         <li><?=$meta_title; ?></li>
      </ul>
      <style type="text/css">
         #memberDiv td{padding: 5px;}
         #memberDiv th{padding: 5px; font-weight: bold; color: black;}
      </style>
      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">                
                     <a href="<?=base_url('award/president_scout_list')?>" class="btn btn-blueviolet btn-xs btn-mini"> President Scout Award Circular List</a>
                  </div>
               </div>
               <div class="grid-body">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>
                  
                  <?php 
                  $attributes = array('id' => 'validate');
                  echo form_open_multipart(uri_string(), $attributes);
                  ?>
                  <div class="row form-row">
                     <div class="col-md-4">
                        <label class="form-label">Select Scouts Member </label>
                        <?php 
                        echo form_error('scout_member_id');
                        if($scouts_member != ''){
                           $more_attr = 'class="form-control input-sm" id="scout_member_id"';
                           echo form_dropdown('scout_member_id', $scouts_member, set_value('scout_member_id'), $more_attr);   
                        }else{ ?>
                        <select class="scoutIDSingleSelect2 form-control input-sm" name="scout_member_id" id="scout_member_id" style="width: 100%;"></select>
                        <?php } ?>
                     </div>
                  </div>

                  <div class="row form-row showDiv">                           
                     <div class="col-md-3">
                        <label class="form-label">Name (Bangla)</label>   
                        <h5 id="name_bn" class="semi-bold"></h5>
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Name (English)</label> 
                        <h5 id="name_en" class="semi-bold"></h5>
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Father Name</label>   
                        <h5 id="father_name" class="semi-bold"></h5>
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Mother Name</label> 
                        <h5 id="mother_name" class="semi-bold"></h5>
                     </div>
                  </div>

                  <div class="row form-row showDiv">                           
                     <div class="col-md-3">
                        <label class="form-label">Date of Birth</label>   
                        <h5 id="dob" class="semi-bold"></h5>
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Blood Group</label> 
                        <h5 id="" class="semi-bold"></h5>
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Birth Registration ID</label>   
                        <h5 id="" class="semi-bold"></h5>
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Passport No</label> 
                        <h5 id="" class="semi-bold"></h5>
                     </div>
                  </div>

                  <div class="row form-row showDiv">                           
                     <div class="col-md-3">
                        <label class="form-label">Present Address</label>   
                        <h5 id="present_address" class="semi-bold"></h5>
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Permanent Address</label> 
                        <h5 id="permanent_address" class="semi-bold"></h5>
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Telephone No</label>   
                        <h5 id="phone_emergency" class="semi-bold"></h5>
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Mobile No</label> 
                        <h5 id="phone" class="semi-bold"></h5>
                     </div>
                  </div>

                  <div class="row form-row showDiv">                           
                     <div class="col-md-3">
                        <label class="form-label">Class</label>   
                        <h5 id="curr_class" class="semi-bold"></h5>
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Institute Name</label> 
                        <h5 id="institute_name" class="semi-bold"></h5>
                     </div>
                  </div>

                  <div class="row form-row showDiv">                           
                     <div class="col-md-6">
                        <label class="form-label">Group/Unit Name</label> 
                        <h5 id="sc_group_name" class="semi-bold"></h5>
                     </div>
                     <div class="col-md-6">
                        <label class="form-label">Upazila Name</label>
                        <h5 id="sc_upazila_name" class="semi-bold"></h5>
                     </div>
                     <div class="col-md-6">
                        <label class="form-label">District Name</label>  
                        <h5 id="sc_district_name" class="semi-bold"></h5>
                     </div>
                     <div class="col-md-6">
                        <label class="form-label">Region Name</label>
                        <h5 id="sc_region_name" class="semi-bold"></h5>
                     </div>
                  </div>

                  <div class="form-actions">  
                     <div class="pull-right">
                        <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Save</button>
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
      $(".showDiv").hide();

      $('#validate').validate({
         // focusInvalid: false, 
         ignore: "",
         rules: {
            scout_member_id: { required: true }
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


      // Upazila / Thana dropdown
      $('#scout_member_id').change(function(){
         var id = $('#scout_member_id').val();
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
               $('#name_bn').html(response.full_name_bn);
               $('#name_en').html(response.first_name);
               $('#mother_name').html(response.mother_name);
               $('#father_name').html(response.father_name);
               $('#dob').html(response.dobDate);
               $('#age').html(ageDetails);
               $('#phone').html(response.phone);
               $('#phone_emergency').html(response.phone_emergency);
               $('#institute_name').html(response.institute_name);
               $('#curr_class').html(response.curr_class);
               $('#present_address').html(presentAddress);
               $('#permanent_address').html(permanentAddress);
               $('#sc_group_name').html(response.grp_name);
               $('#sc_upazila_name').html(response.upa_name);
               $('#sc_district_name').html(response.dis_name);
               $('#sc_region_name').html(response.region_name);
               $("#gender").html(response.gender);

               $(".showDiv").show();
            }
         });
      });
   });  

   
</script>  