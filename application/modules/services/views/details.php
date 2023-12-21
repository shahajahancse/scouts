<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url()?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <div class="row-fluid">
      <div class="span12">
        <div class="grid simple ">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <?php if($this->ion_auth->is_admin()){ ?>
            <div class="pull-right">
              <a href="<?=base_url('services/request_list')?>" class="btn btn-success btn-xs btn-mini"> All info Request List</a> 
            </div> 
            <?php } ?>           
          </div>

          <div class="grid-body ">
            <div id="infoMessage"><?php //echo $message;?></div>            
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');?>
              </div>
            <?php endif; ?>
            <?php if($this->session->flashdata('warning')):?>
              <div class="alert alert-warning">
                <?php echo $this->session->flashdata('warning');?>
              </div>
            <?php endif; ?>

            <div class="tiles white details">

              <style type="text/css">
                .tg  {border-collapse:collapse;border-spacing:0;font-family:Arial, sans-serif; border: 0px solid red;}
                .tg td{font-size:14px;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#00000;background-color:#E0FFEB; vertical-align: middle;}
                .tg th{font-size:14px;font-weight:bold;padding:3px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#bce2c5;text-align: center;}
                .tg .tg-ywa9{background-color:#ffffff;color:#ffffff;vertical-align:top; width: 300px;color: black;font-weight: bold;}
                .tg .tg-khup{background-color:#efefef;color:#ffffff;vertical-align:top; width: 130px; color: black; text-align: right;}
                .tg .tg-akf0{background-color:#ffffff;color:#ffffff;vertical-align:top;color: black;}
                .tg .tg-mtwr{background-color:#efefef;vertical-align:top; font-weight: bold; text-align: center; font-size: 16px;text-decoration: underline;}
              </style>
              <a href="<?=base_url('Services/details_pdf'.'/'.encrypt_url($info->id))?>" class="btn btn-primary btn-xs btn-mini" style="float: right;">PDF Download</a>

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
                  <td class="tg-ywa9"><?=$info->created != NULL ? date_sort_form($info->created): NULL?></td>
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