<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url()?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <style>
        @media (max-width: 767px) {
            .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            }

            .btn-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
            }

            .btn {
            width: 100%;
            margin-bottom: 5px;
            }

            .grid-title h4 {
            text-align: center;
            }

            .table th, .table td {
            min-width: 100px;
            }

            .table th:first-child,
            .table td:first-child {
            min-width: 50px;
            }
        }
    </style>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
                <a href="<?=base_url('my_profile/add_cbox')?>" class="btn btn-blueviolet btn-xs btn-mini"> Add Complain </a>
            </div>
          </div>

          <div class="grid-body">
            <div id="infoMessage"><?php //echo $message;?></div>
            <?php if($this->session->flashdata('success')):?>
                <div class="alert alert-success">
                    <?php echo $this->session->flashdata('success');?>
                </div>
            <?php endif; ?>

            <div class="table-responsive">
              <table class="table table-hover table-condensed">
                <thead>
                  <tr>
                    <th> SL </th>
                    <th>Name</th>
                    <th>Scout ID</th>
                    <th>Description</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(!empty($results)){
                    $sl=0;
                    foreach ($results as $row) { $sl++; ?>
                      <tr>
                        <td><?=$sl?></td>
                        <td><?=$row->first_name?></td>
                        <td><?=$row->scout_id?></td>
                        <td><?=$row->complain?></td>
                        <td><?=date_bangla_format($row->created_at)?></td>
                      </tr>
                    <?php } }?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
