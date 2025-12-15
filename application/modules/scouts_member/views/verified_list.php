<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url('scouts_member')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <style type="text/css">
      .marTopSearch{margin-top: 10px;}

      @media (max-width: 767px) {
        .table-responsive {
          overflow-x: auto;
          -webkit-overflow-scrolling: touch;
        }

        .btn-group {
          display: flex;
          flex-direction: column;
        }

        .btn-mini {
          margin-bottom: 5px;
          width: 100%;
        }

        .pull-right {
          float: none !important;
          margin-top: 10px;
          text-align: center;
        }

        .grid-title h4 {
          text-align: center;
        }

        .download-buttons {
          float: none !important;
          text-align: center;
          margin: 10px 0;
        }

        .download-buttons .btn {
          display: inline-block;
          margin: 5px;
        }

        .pagination-row {
          text-align: center;
        }

        .pagination-row > div {
          margin-bottom: 10px;
        }
      }
    </style>

    <div class="row-fluid">
      <div class="span12">
        <div class="grid simple ">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <form action="<?= base_url('scouts_member/active_list') ?>" method="post" style="display:inline;">
                <input type="hidden" name="id" value="1">
                <button type="submit" class="btn btn-blueviolet btn-xs btn-mini">
                  Export to Excel
                </button>
              </form>

              <a href="<?=base_url('scouts_member/create')?>" class="btn btn-blueviolet btn-xs btn-mini"> Add Scouts Member </a>
              <a href="<?=base_url('scouts_member/all')?>" class="btn btn-blueviolet btn-xs btn-mini"> Scouts List</a>
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

            <div style="margin-bottom: 10px">
              <?php $this->load->view('search_view2')?>
            </div>

            <?php if($results) { ?>
            <div class="table-responsive">
              <table class="table table-hover table-condensed">
                <thead>
                  <tr>
                    <th style="width:2%"> SL </th>
                    <th style="width:5%">Image</th>
                    <th style="width:10%">Full Name</th>
                    <th style="width:8%">Scout ID</th>
                    <th style="width:8%">Username</th>
                    <th style="width:10%">Member Type</th>
                    <th style="width:10%">Section</th>
                    <th style="width: 10%">Details</th>
                    <!-- <th style="width:5%">Verify</th> -->
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
                    <td class="v-align-middle"><strong><?php echo $row->first_name;?></strong></td>
                    <td class="v-align-middle"><strong><?=$row->scout_id?></td>
                    <td class="v-align-middle"><?php echo $row->username;?></td>
                    <td class="v-align-middle"><?php echo $row->member_type_name;?></td>
                    <td class="v-align-middle"><?php echo get_scout_section($row->sc_section_id);?></td>
                    <td class="v-align-middle"><a href="<?=base_url("scouts_member/details/".encrypt_url($row->id))?>" target="_blank" class="label label-green">Details</a></td>
                    <!-- <td class="v-align-middle"> <a href="<?php echo base_url('scouts_member/verified_member_generate_scout_id/'.encrypt_url($row->id));?>" onclick="return confirm('Are you sure you want to generate Scout ID for this user?')" class="btn btn-mini btn-success">Generate ID</a> </td> -->
                  </tr>
                  <?php endforeach;?>
                </tbody>
              </table>
            </div>

            <div class="row pagination-row">
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
