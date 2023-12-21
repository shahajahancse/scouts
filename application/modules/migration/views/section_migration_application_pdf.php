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
  padding: 8px;
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
      <div class="grid-body">              
      <div>
        <div class="row">
          <div class="col-md-5">
            <!-- <h4 style="font-weight: bold;">Current Scout Information</h4> -->
            <div class="scout-verify-box">
              <h4 style="font-weight: bold; border-bottom: 1px solid #ccc;"> Current Scout Information</h4>
              <table class="tg">
                <tr>
                  <th class="tg-9vst" width="180" style="font-size: 20px;">BS ID</th>
                  <td class="tg-031e" style="font-size: 20px;"><strong><?=$info->scout_id?></strong></td>
                </tr>
                <tr>
                  <th class="tg-9vst">Scout Join Date:</th>
                  <td class="tg-031e"><?=date_detail_format($info->join_date)?></td>
                </tr>
                <tr>
                  <th class="tg-9vst">Section:</th>
                  <td class="tg-031e"><span class="label label-inverse"><?php echo get_scout_section($info->sc_section_id);?></span></td>
                </tr>
                <tr>
                  <th class="tg-9vst">Scout Badge:</th>
                  <td class="tg-031e"><?=$info->badge_type_name_bn?></td>
                </tr>
                <tr>
                  <th class="tg-9vst">Scout Role:</th>
                  <td class="tg-031e"><?=$info->role_type_name_bn?></td>
                </tr>
                <tr>
                  <th class="tg-9vst">Scout Unit:</th>
                  <td class="tg-031e"><?=$info->unit_name?></td>
                </tr>
                <tr>
                  <th class="tg-9vst">Scout Group:</th>
                  <td class="tg-031e"><?=$info->grp_name?></td>
                </tr>
                <tr>
                  <th class="tg-9vst">S. Upazila/Thana:</th>
                  <td class="tg-031e"><?=$info->upa_name?></td>
                </tr>
                <tr>
                  <th class="tg-9vst">S. District:</th>
                  <td class="tg-031e"><?=$info->dis_name?></td>
                </tr>
                <tr>
                  <th class="tg-9vst">Scout Region:</th>
                  <td class="tg-031e"><?=$info->region_name?></td>
                </tr>
              </table>
            </div>
          </div>
    </div>  <!-- END GRID BODY -->              
  </div> <!-- END GRID -->
</div>

</div> <!-- END ROW -->

</div>
</div>
