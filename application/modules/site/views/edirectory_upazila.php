<style type="text/css">
  select.form-control:not([size]):not([multiple]) {
    border-color: #904097 !important;
    border-radius: 0px !important;
  }
</style>
<style type="text/css">
 .tg  {border-collapse:collapse;border-spacing:0; width: 100%}
 .tg td{font-family:Arial, sans-serif;font-size:14px;padding:5px 5px;border-style:solid;border-width:1px; border-color:#ddd;overflow:hidden;word-break:normal; color: black; }
 .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:5px 5px;border-style:solid;border-width:1px; border-color:#ddd;overflow:hidden;word-break:normal; color: black; font-weight: bold; vertical-align: top; width: 170px;text-align:right;}
 .tg .tg-d8ej{background-color:#ddf0da}
</style>

<?php 
if($this->session->userdata('site_lang')=='bangla'){
  $upa_name='upa_name';
  $region_name='region_name';
  $dis_name='dis_name';
  $upa_address='upa_address';
  $upa_description='upa_description';
}else{
  $upa_name='upa_name_en';
  $region_name='region_name_en';
  $dis_name='dis_name_en';
  $upa_address='upa_address_en';
  $upa_description='upa_description_en';
}
?>

<div class="container w-75">
 <div class="secondary_sc_content">
  <p class="lead font-weight-bold py-2 text-white" style="background-color: #1aa326; padding-left:10px; overflow: hidden;"><span style="float: left;"><?=$meta_title?></span>
      <span style="float: right; margin-right: 10px;">
        <a href="<?=base_url('edirectory')?>" class="btn btn-primary btn-xs">Home</a>
        <script>
         document.write('<a href="' + document.referrer + '" class="btn btn-primary btn-xs">Go Back</a>');
       </script>
     </span>
   </p>

 <div class="container">
 <?php $this->load->view('edirectory_filter'); ?>
   <div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">

     <div class="container">
      <!-- Nav tabs -->
      <ul class="nav nav-tabs">
       <li class="nav-item">
         <a class="nav-link active" data-toggle="tab" href="#basic">Upazila Designation</a>
       </li>
       <li class="nav-item">
         <a class="nav-link" data-toggle="tab" href="#office_list">Scouts Group Office</a>
       </li>
     </ul>

     <!-- Tab panes -->
     <div class="tab-content">
       <div class="tab-pane container active" id="basic">
        <h5 class="tab_heading"> Basic Information about the Upazila </h5>
        <table class="tg">
         <tr>
          <th class="tg-d8ej"> <?=lang('site_office_phone')?></th>
          <td class="tg-031e"><?=$this->session->userdata('site_lang')=='bangla'?BanglaConverter::en2bn($info->upa_phone):BanglaConverter::bn2en($info->upa_phone);?></td>
        </tr>
        <tr>
          <th class="tg-d8ej"> <?=lang('site_office_email')?></th>
          <td class="tg-031e"><?=$info->upa_email?></td>
        </tr>
        <tr>
          <th class="tg-d8ej"> <?=lang('site_office_address')?></th>
          <td class="tg-031e"><?=$info->upa_address?></td>
        </tr>
        <tr>
          <th class="tg-d8ej"> Website/Social Media</th>
          <td class="tg-031e"><?=$info->upa_url?></td>
        </tr>
      </table>
      <div class="pt-3"></div>

      <table class="table table-bordered">
       <tbody>
        <?php 
        $count_contact=0;
      foreach ($designations as $row) { 
        $count_contact = $result_data[$row->id]['contact_count'];
      ?>
        <tr>
        <td width="5%"><a href="<?=base_url('edirectory-upazila-listing/'.$info->id.'/'.$row->id)?>"><?=$row->committee_designation_name_en?>  (<?=$count_contact?>)</a></td>
       </tr>
       <?php } ?>      
     </tbody>
   </table>
   <div class="pt-3"></div>
 </div>

 <div class="tab-pane container fade" id="office_list">
  <h5 class="tab_heading"> Scouts Group List </h5>
  <table class="table table-bordered">
   <tbody>
    <tr>
      <th> SL </th>
      <th> Scouts Group Name </th>
    </tr>

    <?php
    $i=0;
    foreach ($office_list as $row) { 
      $i++;
      $lan=$this->session->userdata('site_lang')=='bangla'?'grp_name_bn':'grp_name';
      ?>
      <tr>
        <td width="5%"><?=$this->session->userdata('site_lang')=='bangla'?BanglaConverter::en2bn($i):BanglaConverter::bn2en($i);?></td>
        <td><a target="_blank" href="<?=base_url()?>edirectory-scouts-group/<?=$row->id?>" style="color:#000;"><?=$row->$lan?></a></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
</div>
<!-- Tab panes -->

</div>

</div>
</div>

</div>

      <?php /*
      <div class="container">

         <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <div class="container">
                  <div class="row">
                     <table class="table table-bordered">
                        <tbody>
                           <?php 
                           foreach ($designations as $row) { ?>
                           <tr>
                              <td width="5%"><a href="<?=base_url('edirectory-contact-listing/'.$region.'/'.$row->id)?>"><?=$row->committee_designation_name_en?></a></td>
                           </tr>
                           <?php } ?>      
                        </tbody>
                     </table>
                     <div class="pt-3"></div>
                  </div>
               </div>
            </div> 
         </div>
        
         </div><!-- /container -->
      */ ?>
    </div>
  </div>