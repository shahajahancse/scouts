<style type="text/css">
   .report-panel-card {
      background: #ffffff;
      border: 1px solid #e5e9ec;
      border-radius: 6px;
      margin-bottom: 20px;
      box-shadow: 0 1px 3px rgba(0,0,0,0.05);
   }
   .report-table th {
      background-color: #f4f6f8;
      color: #333;
      font-weight: 600;
      padding: 10px 12px !important;
      border-bottom: 2px solid #dde2e6 !important;
      vertical-align: middle !important;
   }
   .report-table td {
      padding: 12px 12px !important;
      vertical-align: middle !important;
   }
   .report-table tr:hover {
      background-color: #fcfdfe;
   }
   .btn-pdf {
      background-color: #d9534f !important;
      border-color: #d43f3a !important;
      color: #fff !important;
      font-weight: 600;
      transition: all 0.2s ease;
   }
   .btn-pdf:hover, .btn-pdf:focus {
      background-color: #c9302c !important;
      border-color: #ac2925 !important;
      color: #fff !important;
      transform: translateY(-1px);
      box-shadow: 0 2px 5px rgba(217, 83, 79, 0.4);
   }
   .btn-excel {
      background-color: #1e7e34 !important;
      border-color: #1c7430 !important;
      color: #fff !important;
      font-weight: 600;
      transition: all 0.2s ease;
   }
   .btn-excel:hover, .btn-excel:focus {
      background-color: #155724 !important;
      border-color: #10441a !important;
      color: #fff !important;
      transform: translateY(-1px);
      box-shadow: 0 2px 5px rgba(30, 126, 52, 0.4);
   }
   .report-title-text {
      font-size: 14px;
      font-weight: 700;
      color: #2b333e;
      margin-bottom: 2px;
   }
   .report-desc-text {
      font-size: 12px;
      color: #707780;
   }
   .badge-filter {
      display: inline-block;
      padding: 3px 7px;
      font-size: 11px;
      font-weight: 600;
      color: #495057;
      background-color: #e9ecef;
      border-radius: 4px;
      margin-right: 4px;
      margin-bottom: 3px;
   }
   .badge-filter.req {
      background-color: #ffebe9;
      color: #cf222e;
      border: 1px solid #ffc1c0;
   }
   .badge-filter.opt {
      background-color: #e7f5ff;
      color: #0c8599;
      border: 1px solid #c5ebf7;
   }
   .filter-box {
      background: #fafbfc;
      border: 1px solid #e1e4e8;
      border-radius: 6px;
      padding: 15px 20px;
      margin-bottom: 20px;
   }
</style>

<div class="page-content">
   <div class="content">
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('reports/scouts_member')?>" class="active"> <?=$module_title; ?> </a></li>
         <li><?=$meta_title; ?> </li>
      </ul>

      <div class="row-fluid">
         <div class="span12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
               </div>

               <div class="grid-body">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <i class="fa fa-check-circle"></i> <?php echo $this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>

                  <?php $attributes = array('id' => 'validate', 'target' => '_blank');
                  echo form_open("reports/scouts_member", $attributes);?>

                     <!-- Filter Section -->
                     <fieldset class="col-md-12 filter-box">
                        <legend style="font-size: 16px; font-weight: bold; border-bottom: 1px solid #ddd; padding-bottom: 5px; margin-bottom: 15px;">
                           <i class="fa fa-filter text-success"></i> Report Filtering
                        </legend>

                        <div id="error" style="display: none; margin-bottom: 15px;">
                           <div class="alert alert-danger" id="error_msg">
                              <i class="fa fa-exclamation-triangle"></i> Please fill up the required filter fields marked in red.
                           </div>
                        </div>

                        <?php $this->load->view('scouts_member_filter')?>
                     </fieldset>

                     <!-- Reports Table Section -->
                     <fieldset class="col-md-12" style="padding: 0; margin-top: 10px;">
                        <legend style="font-size: 16px; font-weight: bold; border-bottom: 1px solid #ddd; padding-bottom: 5px; margin-bottom: 15px;">
                           <i class="fa fa-download text-primary"></i> Report Download Center (PDF & Excel)
                        </legend>

                        <div class="table-responsive">
                           <table class="table table-bordered report-table">
                              <thead>
                                 <tr>
                                    <th class="text-center" style="width: 50px;">SL</th>
                                    <th>Report Title</th>
                                    <th style="width: 320px;">Applicable Filters</th>
                                    <th class="text-center" style="width: 250px;">Download Format</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <!-- Report 1: Region -->
                                 <tr>
                                    <td class="text-center font-bold">1</td>
                                    <td>
                                       <div class="report-title-text"><i class="fa fa-globe text-primary"></i> Top Scouts Member Registration By Region</div>
                                       <div class="report-desc-text">Summarized member registrations aggregated across all Scout Regions.</div>
                                    </td>
                                    <td>
                                       <span class="badge-filter req"><i class="fa fa-asterisk"></i> District Type (Required)</span>
                                       <span class="badge-filter req"><i class="fa fa-calendar"></i> Date Range (Required)</span>
                                    </td>
                                    <td class="text-center">
                                       <button type="submit" name="btnsubmit" value="smr_region" onclick="return validateReport('region')" class="btn btn-pdf btn-mini btn-cons" title="Download PDF Report">
                                          <i class="fa fa-file-pdf-o"></i> PDF
                                       </button>
                                       <button type="submit" name="btnsubmit" value="smr_region_excel" onclick="return validateReport('region')" class="btn btn-excel btn-mini btn-cons" title="Download Excel Report">
                                          <i class="fa fa-file-excel-o"></i> Excel
                                       </button>
                                    </td>
                                 </tr>

                                 <!-- Report 2: District -->
                                 <tr>
                                    <td class="text-center font-bold">2</td>
                                    <td>
                                       <div class="report-title-text"><i class="fa fa-map-marker text-success"></i> Top Scouts Member Registration By District</div>
                                       <div class="report-desc-text">Summarized member registrations broken down by Scout District.</div>
                                    </td>
                                    <td>
                                       <span class="badge-filter req"><i class="fa fa-asterisk"></i> District Type (Required)</span>
                                       <span class="badge-filter req"><i class="fa fa-calendar"></i> Date Range (Required)</span>
                                    </td>
                                    <td class="text-center">
                                       <button type="submit" name="btnsubmit" value="smr_district" onclick="return validateReport('district')" class="btn btn-pdf btn-mini btn-cons" title="Download PDF Report">
                                          <i class="fa fa-file-pdf-o"></i> PDF
                                       </button>
                                       <button type="submit" name="btnsubmit" value="smr_district_excel" onclick="return validateReport('district')" class="btn btn-excel btn-mini btn-cons" title="Download Excel Report">
                                          <i class="fa fa-file-excel-o"></i> Excel
                                       </button>
                                    </td>
                                 </tr>

                                 <!-- Report 3: Upazila -->
                                 <tr>
                                    <td class="text-center font-bold">3</td>
                                    <td>
                                       <div class="report-title-text"><i class="fa fa-building-o text-warning"></i> Top Scouts Member Registration By Upazila</div>
                                       <div class="report-desc-text">Summarized member registrations broken down by Upazila / Thana.</div>
                                    </td>
                                    <td>
                                       <span class="badge-filter req"><i class="fa fa-asterisk"></i> District Type (Required)</span>
                                       <span class="badge-filter req"><i class="fa fa-calendar"></i> Date Range (Required)</span>
                                    </td>
                                    <td class="text-center">
                                       <button type="submit" name="btnsubmit" value="smr_upazila" onclick="return validateReport('upazila')" class="btn btn-pdf btn-mini btn-cons" title="Download PDF Report">
                                          <i class="fa fa-file-pdf-o"></i> PDF
                                       </button>
                                       <button type="submit" name="btnsubmit" value="smr_upazila_excel" onclick="return validateReport('upazila')" class="btn btn-excel btn-mini btn-cons" title="Download Excel Report">
                                          <i class="fa fa-file-excel-o"></i> Excel
                                       </button>
                                    </td>
                                 </tr>

                                 <!-- Report 4: Member List -->
                                 <tr>
                                    <td class="text-center font-bold">4</td>
                                    <td>
                                       <div class="report-title-text"><i class="fa fa-users text-info"></i> Scouts Member Details List</div>
                                       <div class="report-desc-text">Detailed row-level member information including Scout ID, section, badge, patrol, etc.</div>
                                    </td>
                                    <td>
                                       <span class="badge-filter opt"><i class="fa fa-filter"></i> Member Type (Optional)</span>
                                       <span class="badge-filter opt"><i class="fa fa-calendar"></i> Date Range (Optional)</span>
                                       <span class="badge-filter opt"><i class="fa fa-map-pin"></i> District Type (Optional)</span>
                                    </td>
                                    <td class="text-center">
                                       <button type="submit" name="btnsubmit" value="pdf_member" onclick="return validateReport('member')" class="btn btn-pdf btn-mini btn-cons" title="Download PDF Report (Top 3,000)">
                                          <i class="fa fa-file-pdf-o"></i> PDF
                                       </button>
                                       <button type="submit" name="btnsubmit" value="excel_member" onclick="return validateReport('member')" class="btn btn-excel btn-mini btn-cons" title="Download Full Excel Report">
                                          <i class="fa fa-file-excel-o"></i> Excel
                                       </button>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </fieldset>

                     <div class="clearfix"></div>
                  <?php form_close(); ?>
               </div> <!-- /grid-body -->
            </div> <!-- /grid -->
         </div>
      </div> <!-- /row-fluid -->

   </div> <!-- /content -->
</div> <!-- /page-content -->

<script>
   function validateReport(reportType) {
      var field = document.getElementById("dis_type").value.trim();
      var startDate = document.getElementById("date_from").value.trim();
      var endDate = document.getElementById("date_to").value.trim();
      var memberType = document.getElementById("member_type") ? document.getElementById("member_type").value.trim() : '';
      var isValid = true;
      var errorMsg = "";

      // Reset previous error styling
      $("#dis_type").css("border", "");
      $("#date_from").css("border", "");
      $("#date_to").css("border", "");
      $("#member_type").css("border", "");
      $("#error").hide();

      if (reportType === 'region' || reportType === 'district' || reportType === 'upazila') {
         if (field === '') {
            $("#dis_type").css("border", "1px solid red");
            isValid = false;
         }
         if (startDate === '') {
            $("#date_from").css("border", "1px solid red");
            isValid = false;
         }
         if (endDate === '') {
            $("#date_to").css("border", "1px solid red");
            isValid = false;
         }

         if (!isValid) {
            showError("Please fill up required filtering fields: District Type, Date From, and Date To.");
            return false;
         }
      }

      // Date order validation if both dates entered
      if (startDate !== '' && endDate !== '') {
         var dateFrom = parseDDMMYYYY(startDate);
         var dateTo   = parseDDMMYYYY(endDate);

         if (isNaN(dateFrom.getTime()) || isNaN(dateTo.getTime())) {
            showError("Please enter valid dates in DD-MM-YYYY format.");
            return false;
         }

         if (dateTo < dateFrom) {
            $("#date_to").css("border", "1px solid red");
            showError("Date To cannot be earlier than Date From.");
            return false;
         }
      }

      // For member details list without any filter, confirm or prompt
      if (reportType === 'member') {
         if (field === '' && startDate === '' && endDate === '' && memberType === '') {
            var confirmAll = confirm("You have not selected any filters. Fetching all members from 80 lakh+ records may take longer. Do you want to continue?");
            if (!confirmAll) {
               return false;
            }
         }
      }

      $("#error").hide();
      return true;
   }

   function showError(msg) {
      $("#error_msg").html('<i class="fa fa-exclamation-triangle"></i> ' + msg);
      $("#error").slideDown(200);
      $('html, body').animate({
         scrollTop: $("#error").offset().top - 100
      }, 300);
   }

   function clearErrorBorder(el) {
      $(el).css("border", "");
      if ($("#dis_type").val() !== '' && $("#date_from").val() !== '' && $("#date_to").val() !== '') {
         $("#error").slideUp(200);
      }
   }

   function resetFilters() {
      $("#dis_type").val('').css("border", "");
      $("#date_from").val('').css("border", "");
      $("#date_to").val('').css("border", "");
      $("#member_type").val('').css("border", "");
      $("#error").hide();
   }

   function parseDDMMYYYY(dateStr) {
      var parts = dateStr.split("-");
      if (parts.length === 3) {
         return new Date(parts[2], parts[1] - 1, parts[0]);
      }
      return new Date(dateStr);
   }
</script>
