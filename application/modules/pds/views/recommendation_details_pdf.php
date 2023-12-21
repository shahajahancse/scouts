<style type="text/css">

  table, td, th {  
    border: 1px solid #ddd;
    text-align: left;
  }

  table {
    border-collapse: collapse;
    width: 100%;
  }

  th, td {
    padding: 5px;
    color: black;
  }

</style>
<div class="page-content">     
 <div class="content">  
   <div style="text-align: center;">
     <div  style="font-size: 20px;">BANGLADESH SCOUTS</div>
     <span>www.scouts.gov.bd</span>
   </div>
   <div class="row-fluid">
     <div class="span12">
      <div class="grid simple ">
       <div class="grid-title">
        <h4 align="center"><span class="semi-bold"><?=$meta_title; ?></span></h4>
        <div style="text-align: right;margin-bottom: 5px;">Date: <?= date('d F, Y') ?></div>       
      </div>

      <div class="grid-body ">
        <table class="table table-hover table-condensed" border="0">
          <tr>
            <td style="width:200"> Recommended Award Name </td> <td><?=$info->award_name_bn?></td>
          </tr>
          <tr>
            <td>Name (Bangla)</td> <td><?=$info->name_bn?></td>                     
          </tr>
          <tr>
            <td>Name (English)</td> <td><?=$info->name_en?></td>                     
          </tr>
          <tr>
            <td>Father Name</td> <td><?=$info->father_name?></td>                     
          </tr>
          <tr>
            <td>Mother Name</td> <td><?=$info->mother_name?></td>                     
          </tr>
          <tr>
            <td>Date of Birth</td> <td><?=$info->dob?></td>                     
          </tr>
          <tr>
            <td>Present Age</td> <td><?=$info->age?></td>                     
          </tr>
          <tr>
            <td>Scout Joining Date (Leader)</td> <td><?=$info->leader_join?></td>                     
          </tr>
          <tr>
            <td>Present Scouts Designation</td> <td><?=$info->present_desig?></td>                     
          </tr>
          <tr>
            <td>Phone</td> <td><?=$info->phone?></td>                     
          </tr>
          <tr>
            <td>Email Address</td> <td><?=$info->email?></td>                     
          </tr>
          <tr>
            <td>Gender</td> <td><?=$info->gender?></td>                     
          </tr>
          <tr>
            <td>Working Designation</td> <td><?=$info->working_desig?></td>                     
          </tr>
          <tr>
            <td>Present Address</td> <td><?=$info->present_address?></td>                     
          </tr>
          <tr>
            <td>Permanent Address</td> <td><?=$info->permanent_address?></td>                     
          </tr>
          <tr>
            <td>Group/Unit Name</td> <td><?=$info->sc_group_name?></td>                     
          </tr>
          <tr>
            <td>Upazila Name</td> <td><?=$info->sc_upazila_name?></td>                     
          </tr>
          <tr>
            <td>District Name</td> <td><?=$info->sc_district_name?></td>                     
          </tr>
          <tr>
            <td>Region Name</td> <td><?=$info->sc_region_name?></td>                     
          </tr>                    
        </tr>
      </table>

      <h4>As Scouters Responsibility Information 
      <table>
        <caption style="text-align: left;">(ক) স্কাউটার হিসেবে দায়িত্ব পালন সংক্রান্ত তথ্য বিবরণী</caption>
        <tr>
          <th>SL</th>
          <th>On Duity Office Level</th>
          <th>Designation</th>
          <th>Date From</th>
          <th>Date To</th>
        </tr>
        <?php 
        $sl=0;
        foreach ($scouter_respon as $row) { 
          $sl++;
        ?>
          <tr> 
            <td><?php echo $sl;?></td>
            <td><?php echo $row->office_type_name;?></td>
            <td><?php echo $row->committee_designation_name;?></td> 
            <td><?php echo $row->res_date_from;?></td> 
            <td><?php echo $row->res_date_to;?></td> 
          </tr>
          <?php } ?>
      </table>
      <br><br>
      <table>
        <caption style="text-align: left;">(খ) ইউনিট/উপজেলা/জেলা/অঞ্চল/জাতীয় পর্যায়ে নির্বাহী/অনির্বাহী পদে দায়িত্ব পালন</caption>
        <tr>
          <th>SL</th>
          <th>On Duity Office Level</th>
          <th>Designation</th>
          <th>Date From</th>
          <th>Date To</th>
        </tr>
        <?php 
        $sl=0;
        foreach ($non_exe_respon as $row) { 
          $sl++;
        ?>
          <tr> 
            <td><?php echo $sl;?></td>
            <td><?php echo $row->office_type_name;?></td>
            <td><?php echo $row->committee_designation_name;?></td> 
            <td><?php echo $row->noe_date_from;?></td> 
            <td><?php echo $row->noe_date_to;?></td> 
          </tr>
          <?php } ?>
      </table>

      <br><br>
      <table>
        <caption style="text-align: left;">Previous Achived Award (পূর্বে প্রাপ্ত অ্যাওয়ার্ডের বিবরণ)</caption>
        <tr>
          <th>SL</th>
          <th>Award Name </th>
          <th>Year</th>
        </tr>
        <?php 
        $sl=0;
        foreach ($award_achived as $row) { 
          $sl++;
        ?>
          <tr> 
            <td><?php echo $sl;?></td>
            <td><?php echo $row->award_name_bn;?></td>
            <td><?php echo $row->award_year;?></td> 
          </tr>
          <?php } ?>
      </table>


    </div>

  </div>
</div>
</div>

</div> <!-- END Content -->

</div>