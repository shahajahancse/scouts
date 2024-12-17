<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url('scouts_member')?>" class="active"> <?=$module_title; ?> </a></li>
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
              <a href="<?=base_url('scouts_member/all')?>" class="btn btn-blueviolet btn-xs btn-mini"> Scouts Member List</a>
            </div>            
          </div>

          <div class="grid-body ">
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

            <?php $this->load->view('search_view')?>

            <?php if($results) { ?>

            <!-- Pdf or Doc file donwload link -->
           <!--  <a href="<?=base_url('scouts_member/delete_request_doc')?>" class="btn btn-blueviolet btn-xs btn-mini" style="float: right;margin-left: 10px;">DOC Download</a> -->

            <a href="<?=base_url('scouts_member/delete_request_pdf')?>" class="btn btn-primary btn-xs btn-mini" style="float: right;">PDF Download</a>
            
            <table class="table table-hover table-condensed">
              <thead>
                <tr>
                  <th width="5%"> SL </th>
                  <th width="5%">Image</th>
                  <th width="25%">Full Name</th>
                  <th width="10%">Scout ID</th>
                  <th width="12%">Member Type</th>
                  <th width="10%">Section</th>
                  <th width="30%">Group Name</th>
                  <th width="10%">Username</th>
                  <th width="10%">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $sl=$pagination['current_page'];
                foreach ($results as $row):
                  $sl++;
                  // Profile Image
                $path = base_url().'profile_img/';
                if($row->profile_img != NULL){
                  $img_url = '<img src="'.$path.$row->profile_img.'" height="20">';
                }else{
                  $img_url = '<img src="'.$path.'no-img.png" height="20">';
                }
                $cont = 'Some content <br> <strong>inside</strong> the popover';
                ?>
                <tr>
                  <td class="v-align-middle"><?=$sl.'.'?></td>
                  <td class="v-align-middle"><?=$img_url?></td>
                  <td class="v-align-middle"><?php echo $row->first_name;?></td>
                  <td class="v-align-middle"><strong><span class="trigger-scout-id"><?=$row->scout_id?> </span></strong>
                    <td class="v-align-middle"><?=$row->member_type_name?></td>
                    <td class="v-align-middle"><span class="label label-green"><?=get_scout_section($row->sc_section_id);?></span></td>
                    <td class="v-align-middle"><?=$row->grp_name?></td>
                    <td class="v-align-middle"><strong><?=$row->username?></strong></td>
                    <td align="right">
                      <div class="btn-group"> <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> Action <span class="caret"></span> </a>
                       <ul class="dropdown-menu pull-right">
                        <li><a href="<?=base_url("scouts_member/details/".encrypt_url($row->id))?>" target="_blank">Details Scout Member</a></li>
                        <li><a href="<?=base_url("scouts_member/restore/".encrypt_url($row->id))?>" onclick="return confirm('Are you sure you want to restore to scout member list?');">Restore to Scout Member</a></li>
                        <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin()){?>
                        <li><a href="<?=base_url("scouts_member/scout_member_delete/".encrypt_url($row->id))?>" onclick="return confirm('Be careful! Are you sure you want to delete permanently all kind of relevant information of the member from the database?');">Delete Member Permanently</a></li>
                        <?php } ?> 
                      </ul>
                    </div>
                  </td> 
                </tr>
              <?php endforeach;?>                      
            </tbody>
          </table>
          <div class="row">
            <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> Total <span style="color: green; font-weight: bold;"><?php echo $total_rows; ?> Total Members </span></div>
            <div class="col-sm-8 col-md-8 text-right">
              <?php echo $pagination['links']; ?>
            </div>
          </div>

          <?php }else{ ?>

          <div class="clearfix"></div>
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