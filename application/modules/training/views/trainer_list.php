<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url('dashboard')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <div class="row-fluid">
      <div class="span12">
        <div class="grid simple ">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
            <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin()){ ?>
              <a href="<?=base_url('training/create_trainer')?>" class="btn btn-blueviolet btn-xs btn-mini"> Create Trainer </a>
            <?php } ?>
            </div> 
          </div>

          <div class="grid-body ">
            <div id="infoMessage"><?php //echo $message;?></div>            
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');?>
              </div>
            <?php endif; ?>
            <!-- <a href="<?=base_url('Events/event_list_pdf')?>" class="btn btn-primary btn-xs btn-mini" style="float: right;">PDF Download</a> -->
            <?php if($results) {  //print_r($results);?>
              
            <table class="table table-hover table-condensed" id="example">
              <thead>
                <tr>
                  <th style="width:2%"> SL </th>
                  <th style="width:30%">Trainer Name</th>
                  <th style="width:20%">Phone Number</th>                  
                  <th style="width:20%">Email Address</th>
                  <th style="width:20%">Organization</th>
                  <th style="width:20%">Designation</th>
                  <th style="width:20%">Present Address</th>
                  <th style="width:10%" class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $sl = $pagination['current_page'];
                foreach ($results as $row):
                  $sl++;          
                  if($row->trainer_type == 1){
                    $trainer = $row->first_name.' (<a target="_blank" href="'.base_url('scouts_member/details/'.encrypt_url($row->user_id)).'">'.$row->scout_id.')</a>';
                    $phone = $row->phone;
                    $email = $row->email;
                    $organization = '';
                    $designation = '';
                    $address = '';
                  }else{
                    $trainer = $row->trainer_name;
                    $phone = $row->phone_no;
                    $email = $row->email_address;
                    $organization = $row->organization;
                    $designation = $row->designation;
                    $address = $row->pre_address;
                  }
                ?>
                <tr>
                  <td class="v-align-middle"><?=$sl.'.'?></td>
                  <td class="v-align-middle"><?=$trainer;?></td>
                  <td class="v-align-middle"><?=$phone?></td>
                  <td class="v-align-middle"><?=$email?></td>
                  <td class="v-align-middle"><?=$organization?></td>
                  <td class="v-align-middle"><?=$designation?></td>
                  <td class="v-align-middle"><?=$address?></td>                  
                  <td align="right">
                     <div class="btn-group"> <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> Action <span class="caret"></span> </a>
                       <ul class="dropdown-menu pull-right">
                        <li><a href="<?=base_url('training/edit_trainer/'.$row->id);?>">Update</a></li>
                        <!-- <li><a href="<?=base_url('training/delete/'.$row->id);?>" onclick="return confirm('Be careful! Are you sure you want to delete this data?');">Delete</a></li> -->
                      </ul>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?> 

            </tbody>
          </table>

          <div class="row">
            <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> Total <span style="color: green; font-weight: bold;"><?php echo $total_rows; ?> Total Trainer </span></div>
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
</div>