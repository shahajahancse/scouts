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
        <?php if(!$this->ion_auth->is_vendor() && !$this->ion_auth->in_group(array('award', 'event', 'training')) && !$this->ion_auth->is_upazila_admin() && !$this->ion_auth->is_district_admin() && !$this->ion_auth->is_region_admin()){ ?>
        <a href="<?=base_url('scouts_member/create')?>" class="btn btn-blueviolet btn-xs btn-mini"> Create Scouts Member </a>
        <?php } ?>
        <a href="<?=base_url('scouts_member/all')?>" class="btn btn-blueviolet btn-xs btn-mini"> Scouts Member List</a>
      </div>
    </div>

    <div class="grid-body ">

     <?php if($this->session->flashdata('success')):?>
      <div class="alert alert-success">
       <?php echo $this->session->flashdata('success');?>
     </div>
   <?php endif; ?>
   <?php

   /*****************Filter check start*********************/
   if (!empty($_GET['region']) && isset($_GET['region']) || (!empty($_GET['memberType'])) || (!empty($_GET['scoutID'])) || (!empty($_GET['name'])) || (!empty($_GET['username'])) || (!empty($_GET['gender']))|| (!empty($_GET['section']))) { ?>
   <div class="row" style="font-size: 15px;">
    <b style="color: #FFFFFF;background-color: #4CAF50;padding: 5px;">Filter</b>

    <?php
    if (!empty($_GET['region']) && isset($_GET['region'])) {
      echo "<b>Region :- </b>".$regions[$_GET['region']].',';
    }

    if (!empty($_GET['district']) && isset($_GET['district'])) {
      echo "<b> District :- </b>".$scouts_district[$_GET['district']].',';
    }

    if (!empty($_GET['upazila']) && isset($_GET['upazila'])) {
      echo "<b>Upazila :- </b>".$scouts_upazila[$_GET['upazila']].',';
    }

    if (!empty($_GET['sgroup']) && isset($_GET['sgroup'])) {
      echo "<b> Group :- </b>".$scouts_group[$_GET['sgroup']].',';
    }

    if (!empty($_GET['memberType']) && isset($_GET['memberType'])) {
      echo "<b> Member Type :- </b>".$member_type[$_GET['memberType']].',';
    }

    if (!empty($_GET['scoutID']) && isset($_GET['scoutID'])) {
      echo "<b> Scout ID :- </b>".strtoupper($_GET['scoutID']).',';
    }

    if (!empty($_GET['name']) && isset($_GET['name'])) {
      echo "<b> Name :- </b>".$_GET['name'].',';
    }

    if (!empty($_GET['username']) && isset($_GET['username'])) {
      echo "<b> Username :- </b>".$_GET['username'].',';
    }

    if (!empty($_GET['gender']) && isset($_GET['gender'])) {
      echo "<b> Gender :- </b>".$_GET['gender'].',';
    }

    if (!empty($_GET['section']) && isset($_GET['section'])) {
      echo "<b> Section :- </b>".$scout_section[$_GET['section']].',';
    }
    ?>
  </div>
  <?php
}
/*****************Filter check End*********************/
?>

<?php $this->load->view('search_view')?>

<?php
if(!$this->ion_auth->is_vendor()){
 if ($region) { ?>
 <div class="row" style="float: right;">
  <a href="<?= $doc_url ?>" class="btn btn-blueviolet btn-xs btn-mini" >DOC Download</a>

  <a href="<?= $download_url ?>" class="btn btn-primary btn-xs btn-mini">PDF Download</a>

  <a href="<?= $excel_url ?>" class="btn btn-success btn-xs btn-mini" >Excel Download</a>
</div>
<?php } } ?>

<?php if($results) { ?>
<table class="table table-hover table-condensed">
 <thead>
   <tr>
     <th width="5%"> SL </th>
     <th width="5%">Image</th>
     <th width="25%">Full Name</th>
     <th width="10%">Scout ID</th>
     <th width="12%">Member Type</th>
     <th width="10%">Section</th>
     <th width="25%">Group Name</th>
     <th width="10%">Username</th>
     <?php /* <!-- <th> U.Group</th> --> */ ?>
     <th width="10%">Action</th>
   </tr>
 </thead>
 <tbody>
  <?php
  $sl=$pagination['current_page'];
  foreach ($results as $row):
    $sl++;
  $printed = '';
                  // Profile Image
  $path = base_url().'profile_img/';
  if($row->profile_img != NULL){
    $img_url = '<img src="'.$path.$row->profile_img.'" height="20">';
  }else{
    $img_url = '<img src="'.$path.'no-img.png" height="20">';
  }
  $cont = 'Some content <br> <strong>inside</strong> the popover';

  if($row->is_printed){
    $printed = '<span style="color: red">Printed</span>';
  }
  ?>
  <tr>
    <td class="v-align-middle"><?=$sl.'.'?></td>
    <td class="v-align-middle"><?=$img_url?></td>
    <td class="v-align-middle"><?php echo $row->first_name;?></td>
    <td class="v-align-middle"><strong><span class="trigger-scout-id"><?=$row->scout_id?> </span></strong> <?=$printed?>
      <td class="v-align-middle"><?=$row->member_type_name?></td>
      <td class="v-align-middle"><span class="label label-green"><?=get_scout_section($row->sc_section_id);?></span></td>
      <td class="v-align-middle"><?=$row->grp_name?></td>
      <td class="v-align-middle"><strong><?=$row->username?></strong></td>
                    <?php /* <!-- <td class="v-align-middle"> -->
                      <?php
                        // foreach ($row->groups as $group):
                        // echo '<span class="btn btn-primary btn-xs btn-mini" style="background-color:#6b64d0;margin-bottom:1px;">'.htmlspecialchars($group->description,ENT_QUOTES,'UTF-8').'</span>';
                        // echo '&nbsp;';
                        // endforeach;
                        ?>
                        <!-- </td> --> */?>
                        <td align="right">
                         <div class="btn-group"> <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> Action <span class="caret"></span> </a>
                          <ul class="dropdown-menu pull-right">

                           <li><a href="<?=base_url("scouts_member/details/".encrypt_url($row->id))?>" target="_blank">Details Scouts Member</a></li>
                           <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin()){ ?>
                           <li><a href="<?=base_url("scouts_member/edit/".encrypt_url($row->id))?>" target="_blank">Edit Scouts Member</a></li>

                           <?php if($this->ion_auth->in_group(array('admin', 'scout_admin', 'monitor_team', 'regional_head', 'district_office', 'upazila_office'))){ ?>
                           <li><a href="<?=base_url("scouts_member/pdf_id_card/".encrypt_url($row->id))?>" target="_blank">ID Card Download</a></li>
                           <li class="divider"></li>
                           <li><a href="<?=base_url("scouts_member/delete/".encrypt_url($row->id))?>" onclick="return confirm('Be careful! are you sure you want to delete this user?');">Member Delete Request</a></li>
                           <?php } ?>

                           <li><a href="<?=base_url("scouts_member/archive/".encrypt_url($row->id))?>" onclick="return confirm('Are you sure you want to archive this scouts member?');">Archive Scouts Member</a></li>
                           <?php } ?>

                           <?php if($this->ion_auth->is_vendor()){ ?>
                           <li><a target="_blank" href="<?=base_url("scouts_member/print_completed/".encrypt_url($row->id))?>" onclick="return confirm('ID Card printing is complete?');">Print Complete</a></li>
                           <li><a target="_blank" href="<?=base_url("scouts_member/print_not_completed/".encrypt_url($row->id))?>" onclick="return confirm('ID Card printing is not complete?');">Print Not Complete</a></li>
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
