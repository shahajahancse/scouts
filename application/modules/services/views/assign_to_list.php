<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url('dashboard')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>
    <style type="text/css">
      .marTopSearch{margin-top: 10px;}
    </style>
    <div class="row-fluid">
      <div class="span12">
        <div class="grid simple ">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('services/request_list')?>" class="btn btn-blueviolet btn-xs btn-mini"> Service Complete List </a>
              <a href="<?=base_url('services/complete_list')?>" class="btn btn-blueviolet btn-xs btn-mini"> Cancel Service List</a>
            </div>            
          </div>

          <div class="grid-body ">
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');?>
              </div>
            <?php endif; ?>
            <a href="<?=base_url('Services/assign_to_list_pdf')?>" class="btn btn-primary btn-xs btn-mini" style="float: right;">PDF Download</a>
            <?php if($results) { ?>
            <table class="table table-hover table-condensed" id="example">
              <thead>
                <tr>
                  <th style="width:5%"> SL </th>
                  <th style="width:15%">Assign To </th>
                  <th style="width:30%">Scouts Office</th>
                  <th style="width:15%">Datatime</th>  
                  <th style="width:15%">Service Name</th>
                  <th style="width:10%">Name</th>
                  <th style="width:10%">Phone</th>                  
                  <th style="width:10%">Status</th>
                  <th width="10%">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $sl=$pagination['current_page'];
                foreach ($results as $row):
                  $sl++;
                //$request_type = $row->request_to == 1 ? 'NHQ' : 'Region';
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
                  <td class="v-align-middle"><?=$row->service_name?></td>
                  <td class="v-align-middle"><?=$row->name?></td>
                  <td class="v-align-middle"><?=$row->phone?></td>
                  <td class="v-align-middle"><?=service_request_status($row->status)?></td>
                  <td align="right">
                   <div class="btn-group"> <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> Action <span class="caret"></span> </a>
                    <ul class="dropdown-menu pull-right">
                      <li><a href="<?=base_url('services/details/'.encrypt_url($row->req_service_id))?>">Details</a></li>
                      <li><a href="<?=base_url("services/assign_cancel/".encrypt_url($row->req_service_id))?>" onclick="return confirm('Are you sure you want to cancel this data?');">Cancel</a></li>
                      <li class="divider"></li>
                      <!--<li><a href="<?=base_url("scouts_member/delete/".encrypt_url($row->id))?>" onclick="return confirm('Be careful! are you sure you want to delete this user?');">Member Delete Request</a></li> -->
                    </ul>
                  </div>
                </td> 
              </tr>
            <?php endforeach;?>                      
          </tbody>
        </table>
        <div class="row">
          <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> Total <span style="color: green; font-weight: bold;"><?php echo $total_rows; ?> Record </span></div>
          <div class="col-sm-8 col-md-8 text-right">
           <?php echo $pagination['links']; ?>
         </div>
       </div>

       <?php }else{ ?>

       <div class="alert alert-block alert-error fade in">
        <h4 class="alert-heading"><i class="icon-warning-sign"></i>No data found!</h4>
      </div>

      <?php } ?>

    </div>
  </div>
</div>
</div>

</div> <!-- END ROW -->

</div>