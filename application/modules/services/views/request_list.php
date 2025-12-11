<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url('dashboard')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <style type="text/css">
      .marTopSearch{margin-top: 10px;}

      .table-responsive {
        width: 100%;
        margin-bottom: 15px;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
      }

      .btn-group-responsive {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
      }

      @media screen and (max-width: 767px) {
        .grid-title {
          flex-direction: column;
          align-items: stretch;
        }

        .grid-title .pull-right {
          margin-top: 10px;
        }

        .btn-xs {
          width: 100%;
          margin-bottom: 5px;
        }

        .table th,
        .table td {
          white-space: nowrap;
          min-width: 120px;
        }

        .pagination-stats {
          text-align: center;
          margin-bottom: 10px;
        }
      }
    </style>

    <div class="row-fluid">
      <div class="span12">
        <div class="grid simple ">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right btn-group-responsive">
              <a href="<?=base_url('services/complete_list')?>" class="btn btn-blueviolet btn-xs btn-mini"> Complete List </a>
              <a href="<?=base_url('services/on_process_list')?>" class="btn btn-blueviolet btn-xs btn-mini"> On Process List </a>
              <a href="<?=base_url('services/cancel_list')?>" class="btn btn-blueviolet btn-xs btn-mini"> Cancel List</a>
            </div>
          </div>

          <div class="grid-body">
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');?>
              </div>
            <?php endif; ?>

            <div class="text-right" style="margin-bottom: 10px;">
              <a href="<?=base_url('Services/request_list_pdf')?>" class="btn btn-primary btn-xs btn-mini">Excel Download</a>
            </div>

            <?php if($results) { ?>

            <div class="table-responsive">
              <table class="table table-hover table-condensed" id="example">
                <thead>
                  <tr>
                    <th style="width:2%"> SL </th>
                    <th style="width:25%">Services Name</th>
                    <th style="width:10%">Name</th>
                    <th style="width:10%">Phone</th>
                    <th style="width:10%">Email</th>
                    <th style="width:15%">Req. Date</th>
                    <th style="width:10%">Status</th>
                    <th width="10%">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sl=$pagination['current_page'];
                  foreach ($results as $row):
                    $sl++;
                  $request_type = $row->request_to == 1 ? 'NHQ' : 'Region';
                  ?>
                  <tr>
                    <td class="v-align-middle"><?=$sl.'.'?></td>
                    <td class="v-align-middle"><?=$row->service_name?></td>
                    <td class="v-align-middle"><?=$row->name?></td>
                    <td class="v-align-middle"><?=$row->phone?></td>
                    <td class="v-align-middle"><?=$row->email?></td>
                    <td class="v-align-middle"><?=$row->created != NULL ? date_sort_form($row->created): NULL?></td>
                    <td class="v-align-middle"><?=service_request_status($row->status)?></td>
                    <td align="right">
                     <div class="btn-group">
                      <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> Action <span class="caret"></span> </a>
                      <ul class="dropdown-menu pull-right">
                        <li><a href="<?=base_url('services/details/'.encrypt_url($row->id))?>">Details</a></li>
                        <li><a href="<?=base_url("services/assign_to/".encrypt_url($row->id))?>">Assign To</a></li>
                        <li><a href="<?=base_url("services/request_status/".encrypt_url($row->id))?>">Service Status</a></li>
                      </ul>
                    </div>
                  </td>
                </tr>
              <?php endforeach;?>
              </tbody>
            </table>
            </div>

            <div class="row">
              <div class="col-sm-4 col-md-4 pagination-stats" style="margin-top: 20px;">
                Total <span style="color: green; font-weight: bold;"><?php echo $total_rows; ?> Request </span>
              </div>
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
