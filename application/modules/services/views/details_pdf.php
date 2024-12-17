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

          <div class="grid-body ">

            <div class="tiles white details">
              <table class="tg" width="100%">              
                <tr>
                  <td class="tg-khup">Service Name:</td>
                  <td class="tg-ywa9"><?=$info->service_name?></td>
                  <td class="tg-khup">Request To:</td>
                  <td class="tg-ywa9"><?php 
                    if($info->request_to == '1'){
                      echo 'NHQ';
                    }elseif($info->request_to == '2'){
                      echo 'Region ('.$info->region_name.')';
                    }
                   ?></td>
                  <td class="tg-khup">Status:</td>
                  <td class="tg-ywa9"><?=service_request_status($info->status)?></td>
                </tr>
                <tr>
                  <td class="tg-khup">Name:</td>
                  <td class="tg-ywa9"><?=$info->name?></td>
                  <td class="tg-khup">Mobile:</td>
                  <td class="tg-ywa9"> <?=$info->phone?></td>
                  <td class="tg-khup">Req. Date:</td>
                  <td class="tg-ywa9"><?=date_sort_form($info->created)?></td>                  
                </tr>
                <tr>
                  <td class="tg-khup">Address:</td>
                  <td class="tg-ywa9"><?=$info->address?></td>
                  <td class="tg-khup">Email:</td>
                  <td class="tg-ywa9"> <?=$info->email?></td>
                  <td class="tg-khup">Action By</td>
                  <td class="tg-ywa9">
                    <?php
                    if($info->action_by == 'NHQ'){
                      echo 'NHQ';
                    }elseif($info->action_by == 'Region'){
                      echo $info->action_by.' ('.$info->action_region_name.')';
                    }elseif($info->action_by == 'District'){
                      echo $info->action_by.' ('.$info->action_dis_name.')';
                      //echo $info->dis_name;
                    }elseif($info->action_by == 'Upazila'){
                      echo $info->action_by.' ('.$info->action_upa_name.')';
                      // echo $info->upa_name;
                    }elseif($info->action_by == 'Group'){
                      echo $info->action_by.' ('.$info->action_grp_name.')';
                      // echo $info->grp_name;
                    }
                    ?>
                  </td>
                </tr>
                <tr>
                  <td class="tg-khup">Action Date:</td>
                  <td class="tg-ywa9"><?=$info->act_datetime != NULL ? date_sort_form($info->act_datetime):'';?></td>
                  <td class="tg-khup">Action Note:</td>
                  <td class="tg-ywa9" colspan="3"><?=nl2br($info->act_note)?></td>
                </tr>
                <tr>
                  <td class="tg-khup">Problem:</td>
                  <td class="tg-ywa9" colspan="6"><?=nl2br($info->serv_problem)?></td>
                </tr>
                <tr>
                </table>


                <?php if($results) { ?>
                <h4 class="semi-bold" style="text-align: center;">Assign List</h4>
                <table class="table table-hover table-condensed tg" id="example">
                  <thead>
                    <tr>
                      <th style="width:2%"> SL </th>
                      <th style="width:15%">Assign To </th>
                      <th style="width:30%">Scouts Office</th>
                      <th style="width:15%">Datatime</th>  
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    foreach ($results as $row):
                      $sl++;
                    ?>
                    <tr>
                      <td class="v-align-middle"><?=$sl.'.'?></td>
                      <td class="v-align-middle"><strong><?=func_service_assign_office_type($row->ass_to_office_id)?></strong></td>
                      <td class="v-align-middle"><strong>
                        <?php 
                        if($row->ass_to_office_id == 1){
                          echo $row->region_name;
                        }elseif($row->ass_to_office_id == 2){
                          echo $row->dis_name;
                        }elseif($row->ass_to_office_id == 3){
                          echo $row->upa_name;
                        }elseif($row->ass_to_office_id == 4){
                          echo $row->grp_name;
                        }
                        ?></strong>
                      </td>
                      <td class="v-align-middle"><?=date_sort_form($row->ass_datetime)?></td>
                    </tr>
                  <?php endforeach;?>                      
                </tbody>
              </table>
              <?php } ?>


            </div>
          </div>
        </div>

      </div> <!-- END ROW -->

    </div>
  </div>