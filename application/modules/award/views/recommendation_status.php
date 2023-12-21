<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dahsboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('award/circular_list')?>" class="active"><?=$module_name?> </a></li>
         <li><?=$meta_title; ?> </li>
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

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple ">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                     <?php //if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ ?>
                     <a href="<?=base_url('award/recommendation_list/'.encrypt_url($info->circular_id))?>" class="btn btn-blueviolet btn-xs btn-mini"> Back to Recommended List</a>
                     <?php //} ?>
                  </div>            
               </div>

               <div class="grid-body ">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>

                  <table class="tg" width="100%">
                     <tr>
                        <th class="tg-khup"> Circular Name</th>
                        <td class="tg-ywa9"><?=$info->circular_title;?></td>
                        <th class="tg-khup"> Recommended Award Name</th>
                        <td class="tg-ywa9"><?=$info->award_name_bn;?></td>
                     </tr>
                     <tr>
                        <th class="tg-khup"> Name</th>
                        <td class="tg-ywa9"><?=$info->name_bn;?></td>
                        <th class="tg-khup"> Phone</th>
                        <td class="tg-ywa9"><?=$info->phone;?></td>
                     </tr> 
                     <tr>
                        <th class="tg-khup"> Present Address</th>
                        <td class="tg-ywa9"><?=$info->present_address;?></td>
                        <th class="tg-khup"> Email Address</th>
                        <td class="tg-ywa9"><?=$info->email;?></td>
                     </tr> 
                     <tr>
                        <th class="tg-khup"> Scouts Group/Unit</th>
                        <td class="tg-ywa9"><?=$info->sc_group_name;?></td>
                        <th class="tg-khup"> Scouts Upazila</th>
                        <td class="tg-ywa9"><?=$info->sc_upazila_name;?></td>
                     </tr> 
                     <tr>
                        <th class="tg-khup"> Scouts District</th>
                        <td class="tg-ywa9"><?=$info->sc_district_name;?></td>
                        <th class="tg-khup"> Scouts Region</th>
                        <td class="tg-ywa9"><?=$info->sc_region_name;?></td>
                     </tr> 
                     <tr>
                        <th class="tg-khup"> Upazila Verify</th>
                        <td class="tg-ywa9">
                           <?=event_verify_status($info->verify_upazila)?>
                           <?php if($this->ion_auth->is_upazila_admin()){ ?>
                           <!-- <a href="<?=base_url('award/approve_status/'.encrypt_url($info->id))?>" class="btn btn-blueviolet btn-mini">Approve</a>  -->
                           <!-- <a href="<?=base_url('award/reject_status/'.encrypt_url($info->id))?>" class="btn btn-blueviolet btn-mini">Reject</a> -->
                           <?php } ?>
                        </td>
                        <th class="tg-khup"> District Verify</th>
                        <td class="tg-ywa9">
                           <?=event_verify_status($info->verify_district)?>
                           <?php if($this->ion_auth->is_district_admin()){ ?>
                           <!-- <a href="<?=base_url('award/approve_status/'.encrypt_url($info->id))?>" class="btn btn-blueviolet btn-mini">Approve</a>  -->
                           <!-- <a href="<?=base_url('award/reject_status/'.encrypt_url($info->id))?>" class="btn btn-blueviolet btn-mini">Reject</a> -->
                           <?php } ?>
                        </td>
                     </tr>
                     <tr>
                        <th class="tg-khup"> Region Verify</th>
                        <td class="tg-ywa9">
                           <?=event_verify_status($info->verify_region)?>
                           <?php if($this->ion_auth->is_region_admin()){ ?>
                           <!-- <a href="<?=base_url('award/approve_status/'.encrypt_url($info->id))?>" class="btn btn-blueviolet btn-mini">Approve</a>  -->
                           <!-- <a href="<?=base_url('award/reject_status/'.encrypt_url($info->id))?>" class="btn btn-blueviolet btn-mini">Reject</a> -->
                           <?php } ?>
                        </td>
                        <th class="tg-khup"> NHQ Verify</th>
                        <td class="tg-ywa9">
                           <?=event_verify_status($info->verify_nhq)?>
                           <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ ?>
                           <!-- <a href="<?=base_url('award/approve_status/'.encrypt_url($info->id))?>" class="btn btn-blueviolet btn-mini">Approve</a>  -->
                           <!-- <a href="<?=base_url('award/reject_status/'.encrypt_url($info->id))?>" class="btn btn-blueviolet btn-mini">Reject</a> -->
                           <?php } ?>
                        </td>
                     </tr> 
                  </table>
                  <br>

                  <?php
                  $attributes = array('id' => 'validate');
                  echo form_open_multipart(uri_string(), $attributes);
                  // echo validation_errors(); 

                  if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ 
                     echo '<h4 class="semi-bold">NHQ Evaluation</h4>';
                     $status = $info->verify_nhq;
                     /*$citation = $info->citation_nhq;
                     $event = $info->event_id_nhq;
                     $date_from = $info->date_from_nhq != NULL ? date_browse_format($info->date_from_nhq):'';
                     $date_to = $info->date_to_nhq != NULL ? date_browse_format($info->date_to_nhq):'';
                     $activity = $info->activity_nhq;*/

                  }elseif($this->ion_auth->is_region_admin()){
                     echo '<h4 class="semi-bold">Region Evaluation</h4>';
                     $status = $info->verify_region;
                     /*$citation = $info->citation_region;
                     $event = $info->event_id_region;
                     $date_from = $info->date_from_region != NULL ? date_browse_format($info->date_from_region):'';
                     $date_to = $info->date_to_region != NULL ? date_browse_format($info->date_to_region):'';
                     $activity = $info->activity_region;*/

                  }elseif($this->ion_auth->is_district_admin()){    
                     echo '<h4 class="semi-bold">District Evaluation</h4>';
                     $status = $info->verify_district;
                     /*$citation = $info->citation_district;
                     $event = $info->event_id_district;
                     $date_from = $info->date_from_district != NULL ? date_browse_format($info->date_from_district):'';
                     $date_to = $info->date_to_district != NULL ? date_browse_format($info->date_to_district):'';
                     $activity = $info->activity_district;*/

                  }elseif($this->ion_auth->is_upazila_admin()){
                     echo '<h4 class="semi-bold">Upazila Evaluation</h4>';
                     $status = $info->verify_upazila;
                     /*$citation = $info->citation_upazila;
                     $event = $info->event_id_upazila;
                     $date_from = $info->date_from_upazila != NULL ? date_browse_format($info->date_from_upazila):'';
                     $date_to = $info->date_to_upazila != NULL ? date_browse_format($info->date_to_upazila):'';
                     $activity = $info->activity_upazila;*/
                  }

                  
                  ?>
                  <div class="row form-row">
                     <div class="col-md-3">
                        <label class="form-label">Select Status Type <span class="required">*</span></label>
                        <?php echo form_error('status');
                        $more_attr = 'class="form-control input-sm"';
                        echo form_dropdown('status', $status_dd, set_value('status', $status), $more_attr);
                        ?>
                     </div>
                     <!-- <div class="col-md-9">
                        <label class="form-label">Citation (In 100 Words) </label>   
                        <input name="citation" value="<?=set_value('citation', $citation)?>" type="text" class="form-control input-sm" placeholder="">
                     </div> -->
                  </div>

                  <?php /*
                  <div class="row form-row">                           
                     <div class="col-md-3">
                        <label class="form-label">Event Type </label>
                        <?php echo form_error('event_id');
                        $more_attr = 'class="form-control input-sm"';
                        echo form_dropdown('event_id', $event_category, set_value('event_id', $event), $more_attr);
                        ?>
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Date From </label>
                        <?php echo form_error('date_from');?>
                        <input name="date_from" value="<?=set_value('date_from', $date_from)?>" type="text" class="form-control input-sm datetime" placeholder="DD-MM-YYYY">
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Date To </label>
                        <?php echo form_error('date_to');?>
                        <input name="date_to" value="<?=set_value('date_to', $date_to)?>" type="text" class="form-control input-sm datetime" placeholder="DD-MM-YYYY">
                     </div>
                     <div class="col-md-12">
                        <label class="form-label">Details of activity involvement </label>   
                        <input name="activity_details" value="<?=set_value('activity_details', $activity)?>" type="text" class="form-control input-sm" placeholder="">
                     </div>
                  </div>
                  */ ?>

                  <div class="form-actions">  
                     <div class="pull-right">
                        <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Save</button>
                     </div>
                  </div>
                  <?php echo form_close();?>

               </div>

            </div>
         </div>
      </div>

   </div> <!-- END Content -->

</div>

<script type="text/javascript">
   $(document).ready(function() {
   // Jquery Validation
   $('#validate').validate({
         // focusInvalid: false, 
         ignore: "",
         rules: {
            status: { required: true },
            citation: { required: false, maxlength: 100},
            event_id: { required: false },
            date_from: { required: false },
            date_to: { required: false },
            activity_details: { required: false }
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
         form.submit();
         //func_committee_member_list();
      }
   });

});   
</script>