<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li><a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a></li>
         <li><a href="<?=base_url('award')?>" class="active"><?=$module_name?></a></li>
         <li><?=$meta_title; ?></li>
      </ul>
      <style type="text/css">
         #memberDiv td{padding: 5px;}
         #memberDiv th{padding: 5px; font-weight: bold; color: black;}
         #workStationDiv td{padding: 5px;}
         .input-sm{margin-bottom: 5px;}
      </style>

      <?php
      $gender_data = '';
      foreach ($gender as $key => $value) {
         $gender_data .= '<option value="'.$key.'">'.$value.'</option>';
      }
      ?>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">                
                     <a href="<?=base_url('award/archive_list')?>" class="btn btn-blueviolet btn-xs btn-mini"> Award Archive List</a>  
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
                  $attributes = array('id' => 'validate');
                  echo form_open_multipart("award/archive_add", $attributes);
                  ?>
                  
                  <div class="row">
                     <div class="col-md-12">
                        <div class="row form-row">
                           <div class="col-md-3">
                              <label class="form-label">Scouts Member Type <span class="required">*</span></label>
                              <?php echo form_error('member_type_id');
                              $more_attr = 'class="form-control input-sm" id="award_member_type"';
                              echo form_dropdown('member_type_id', $member_type, set_value('member_type_id'), $more_attr);
                              ?>
                           </div>
                           <div class="col-md-3">
                              <label class="form-label">Award Name <span class="required">*</span></label>
                              <?php echo form_error('award_id');?>
                              <select name="award_id" class="award_val form-control input-sm">
                                 <option value="">-- Select One --</option>
                              </select>
                           </div>

                           <div class="col-md-3">
                              <label class="form-label">Award Year <span class="required">*</span></label>
                              <?php echo form_dropdown('archive_year', $years, set_value('archive_year'), 'class="form-control input-sm"'); ?>
                           </div>
                           <div class="col-md-3">
                              <div class="form-group">
                              <label class="form-label">Exists Scout Group <span class="required">*</span></label><br>
                                 <input type="radio" class="scoutGroup" name="exists_group" id="selectedGroup" value="1"> In DB List
                                 <input type="radio" class="nonscoutGroup" name="exists_group" id="selectedNotGroup" value="2" > Not In DB List
                              </div>
                           </div>
                        </div>

                        <div class="row form-row">
                           <div class="col-md-3">
                              <label class="form-label">Scouts Region <span class='required'>*</span></label>
                              <?php echo form_error('region_id');
                              $more_attr = 'class="form-control input-sm" id="region"';
                              echo form_dropdown('region_id', $regions, set_value('region_id'), $more_attr);
                              ?>
                           </div>
                           <div class="col-md-3">
                              <label class="form-label">Scouts District <span class='required'>*</span></label>
                              <select name="district_id" class="sc_district_val form-control input-sm" id="sc_district">
                                 <option value="">-- Select One --</option>
                              </select>
                           </div>
                           <div class="col-md-3">
                              <label class="form-label">Scouts Upazila </label>
                              <select name="upazila_id" class="sc_upazila_thana_val form-control input-sm"  id="sc_upazila_thana">
                                 <option value="">-- Select One --</option>
                              </select>
                           </div>
                           <div class="col-md-3">
                              <label class="form-label">Scouts Group <span class='required'>*</span></label> 
                              <div class="scoutGroupDiv">
                                 <select name="group_id" class="sc_group_val form-control input-sm basic-select2">
                                    <option value="">-- Select One --</option>
                                 </select>
                              </div>
                              <div class="nonScoutGroupDiv" style="display: none;">
                                 <input type="text" name="group_name_no_exists" value="<?=set_value('group_name_no_exists')?>"  class="form-control input-sm" placeholder="">
                              </div>

                           </div>
                           
                        </div>

                     </div> <!-- col-md-12 -->

                     <div class="col-md-12" >
                        <h4 class="semi-bold">Awardee Information</h4>
                        <table width="100%" border="1" id="memberDiv">
                           <tr>
                              <td width="20%">Awardee Name (EN)*<br> Scout ID</td>
                              <td width="20%">Awardee Name (BN)<br>Issue Date</td>
                              <td width="20%">Father Name*<br>Certificate No*</td>
                              <td width="20%">Mother Name<br>Gender*</td>                              
                              <td width="10%"> <a href="javascript:void();" id="addRow" class="label label-success"> <i class="fa fa-plus-circle"></i> Add More</a> </td>
                           </tr>
                           <tr></tr>
                        </table>
                     </div>

                  </div> <!-- /row -->


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

   $("#addRow").click(function(e) {    
      // e.preventDefault();
      // dynamicRow();
   }); 

   $(document).ready(function() {
      // Daynamicllay append scout group
      // dynamicRow();


      $('#validate').validate({
         // focusInvalid: false, 
         ignore: "",
         rules: {
            member_type_id: { required: true },
            award_id: { required: true },
            archive_year: { required: true },
            region_id: { required: true },
            district_id: { required: true },
            upazila_id: { required: false },
            // exists_group: { required: true },
            group_id: {required: "#selectedGroup:checked"},
            group_name_no_exists: {required: "#selectedNotGroup:checked"},
            'name_en[]': { required: true },
            'name_bn[]': { required: false },
            'father_name[]': { required: true },
            'mother_name[]': { required: false },
            'scout_id[]': { required: false },
            'issue_date[]': { required: true },
            'certificate_no[]': { required: true }
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

      //Radio button selected
      $(function() {
         var $radios = $('input:radio[name=exists_group]');
         if($radios.is(':checked') === false) {
            $radios.filter('[value=1]').prop('checked', true);
         }
      });

      // $(".scoutGroup").prop("checked", true);
      // $(".nonscoutGroup").prop("checked", true);

      // Hide/Show
      $(".nonScoutGroupDiv").hide();
      $(".scoutGroup").click(function(){
         $(".scoutGroupDiv").show();
         $(".nonScoutGroupDiv").hide();
      });

      $(".nonscoutGroup").click(function(){
         $(".scoutGroupDiv").hide();
         $(".nonScoutGroupDiv").show();
      });

   });   


   // function dynamicRow(){
      // Education
      $("#addRow").click(function(e) {
         var items = '';
         items += '<tr>';        
         items += '<td><input type="text" name="name_en[]" class="form-control input-sm" placeholder="Name (English)"><input type="text" name="scout_id[]" class="form-control input-sm" placeholder="Scout ID" style="transform: uppercase;"></td>';
         items += '<td><input type="text" name="name_bn[]" class="form-control input-sm" placeholder="Name (Bangla)"><input type="text" name="issue_date[]" class="datetime form-control input-sm" placeholder="DD-MM-YYYY"></td>';
         items += '<td><input type="text" name="father_name[]" class="form-control input-sm" placeholder="Father Name"><input type="text" name="certificate_no[]" class="form-control input-sm" placeholder="Certificate No"></td>';
         items += '<td><input type="text" name="mother_name[]" class="form-control input-sm" placeholder="Mother Name"><select class="input-sm" name="gender[]"><?php echo $gender_data;?></select></td>';
         items += '<td><a href="javascript:void();" class="label label-important" onclick="removeRow(this)"> <i class="fa fa-minus-circle"></i> Remove </a></td>';
         items += '</tr>';

         $('#memberDiv tr:last').after(items);
         datetime();
      });
   // }
   

   function removeRow(id){ 
      $(id).closest("tr").remove();
   }

</script>  