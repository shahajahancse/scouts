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


    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal red">
          <div class="grid-title">
            <h4 align="center"><span class="semi-bold"><?=$meta_title; ?></span></h4>

          </div>
          <div class="grid-body">
            <div><?php //echo validation_errors(); ?></div>

            <?php
            if($info->dis_status == 1) {
              $status = '<button class="btn btn-mini btn-info">Enable</button>';
            }else{
              $status = '<button class="btn btn-mini btn-primary">Disable</button>';
            }

            if($info->dis_type == '1') {
              $district = '<button class="btn btn-mini btn-primary">Administrative District</button>';
            }else if($info->dis_type == '2') {
              $district = '<button class="btn btn-mini btn-primary">Metropolitan District</button>';
            }else if($info->dis_type == '3') {
              $district = '<button class="btn btn-mini btn-primary">Rover District</button>';
            }else if($info->dis_type == '4') {
              $district = '<button class="btn btn-mini btn-primary">Railway District</button>';
            }else if($info->dis_type == '5') {
              $district = '<button class="btn btn-mini btn-primary">Sea District</button>';
            }else if($info->dis_type == '6') {
              $district = '<button class="btn btn-mini btn-primary">Air District</button>';
            }
           ?>
           <table class="tg" width="100%">
            <tr>
              <th class="tg-d8ej" width="200"> Region Name</th>
              <td class="tg-031e"><?=$info->region_name?></td>
              <th class="tg-d8ej"> District Type</th>
              <td class="tg-031e"><?=$district?></td>
            </tr>
            <tr>
              <th class="tg-d8ej"> Scouts District (Bangla)</th>
              <td class="tg-031e"><?=$info->dis_name?></td>
              <th class="tg-d8ej"> Username </th>
              <td class="tg-031e"><?=$info->username?></td>
            </tr>
            <tr>
              <th class="tg-d8ej"> Scouts District (English)</th>
              <td class="tg-031e"><?=$info->dis_name_en?></td>
              <th class="tg-d8ej"> Phone</th>
              <td class="tg-031e"><?=$info->dis_phone?></td>
            </tr>                                      
            <tr>
              <th class="tg-d8ej"> Fax</th>
              <td class="tg-031e"><?=$info->dis_fax?></td>                   
              <th class="tg-d8ej"> Email</th>
              <td class="tg-031e"><?=$info->dis_email?></td>
            </tr>
            <tr>
              <th class="tg-d8ej"> Address</th>
              <td class="tg-031e"><?=$info->dis_address?></td>                   
              <th class="tg-d8ej"> Status</th>
              <td class="tg-031e"><?=$status?></td>
            </tr>
            <tr>
              <th class="tg-d8ej"> Description</th>
              <td class="tg-031e" colspan="3"><?=$info->dis_description?></td>
            </tr>
          </table>

        </div>  <!-- END GRID BODY -->              
      </div> <!-- END GRID -->
    </div>

  </div> <!-- END ROW -->

</div>
</div>