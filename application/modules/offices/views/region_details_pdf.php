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

            <?php
            if($info->region_status == 1) {
              $status = '<button class="btn btn-mini btn-info">Enable</button>';
            }else{
              $status = '<button class="btn btn-mini btn-primary">Disable</button>';
            }

            if($info->region_type == 'divisional') {
              $region = '<button class="btn btn-mini btn-primary">Divitional Region</button>';
            }else{
              $region = '<button class="btn btn-mini btn-primary">Special Region</button>';
            }
            ?>
            <table class="tg" width="100%">
              <tr>
                <th class="tg-d8ej" width="200"> Region Name (Bangla)</th>
                <td class="tg-031e"><?=$info->region_name?></td>
                <th class="tg-d8ej"> Username</th>
                <td class="tg-031e"><?=$info->username?></td>
              </tr>
              <tr>
                <th class="tg-d8ej"> Region Name (English)</th>
                <td class="tg-031e"><?=$info->region_name_en?></td>
                <th class="tg-d8ej"> Region Type</th>
                <td class="tg-031e"><?=$region?></td>
              </tr>
              <tr>
                <th class="tg-d8ej"> Region Email</th>
                <td class="tg-031e"><?=$info->region_email?></td>
                <th class="tg-d8ej"> Region Phone</th>
                <td class="tg-031e"><?=$info->region_phone?></td>
              </tr>
              <tr>
                <th class="tg-d8ej"> Region Address</th>
                <td class="tg-031e"><?=$info->region_address?></td>
                <th class="tg-d8ej"> Region Fax</th>
                <td class="tg-031e"><?=$info->region_fax?></td>
              </tr>
              <tr>
                <th class="tg-d8ej">Region Logo</th>
                <td class="tg-031e">
                  <?php 
                  $img_path = base_url().'offices_img/';
                  if($info->region_logo != NULL){
                    $src= $img_path.$info->region_logo;
                    echo "<img src='$src' height='150'>";
                  }
                  ?></td>
                  <th class="tg-d8ej"> Region Status</th>
                  <td class="tg-031e"><?=$status?></td>
                </tr>
                <tr>
                  <th class="tg-d8ej"> Region Information</th>
                  <td class="tg-031e" colspan="3"><?=nl2br($info->region_description)?></td>
                </tr>
              </table>

            </div>  <!-- END GRID BODY -->              
          </div> <!-- END GRID -->
        </div>

      </div> <!-- END ROW -->

    </div>
  </div>