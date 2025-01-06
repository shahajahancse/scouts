<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
      <li> General Setting </li>
      <li> <?=$meta_title?> </li>
    </ul>

    <style>
      .table-responsive {
        width: 100%;
        margin-bottom: 15px;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
      }

      .table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 1rem;
      }

      .table th,
      .table td {
        padding: 12px;
        text-align: left;
        border: 1px solid #dee2e6;
        vertical-align: middle;
      }

      .table th {
        background: #f8f9fa;
        font-weight: 600;
        white-space: nowrap;
      }

      .table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
      }

      .table tbody tr:hover {
        background-color: #f5f5f5;
      }

      .btn-group {
        display: inline-flex;
        gap: 4px;
      }

      .office-type-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 4px;
      }

      @media screen and (max-width: 767px) {
        .table th, 
        .table td {
          white-space: nowrap;
          min-width: 120px;
          font-size: 14px;
        }

        .btn-group {
          display: flex;
          flex-direction: column;
        }

        .btn {
          padding: 4px 8px;
          font-size: 12px;
          width: 100%;
          margin: 2px 0;
        }

        .grid-title {
          display: flex;
          flex-direction: column;
          gap: 10px;
        }

        .grid-title .pull-right {
          float: none !important;
        }

        .office-type-tags .btn {
          margin: 2px;
        }
      }
    </style>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('edirectory/designation_add')?>" class="btn btn-blueviolet btn-xs btn-mini"> Add E-Directory Designation </a>
            </div>            
          </div>

          <div class="grid-body">
            <?php if($this->session->flashdata('success')):?>
                <div class="alert alert-success">
                    <?php echo $this->session->flashdata('success');?>
                </div>
            <?php endif; ?>
            
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th style="width:2%"> SL </th>
                    <th style="width:20%">Designation Name</th>
                    <th style="width:15%">Department</th>
                    <th style="width:15%">Office Name</th>
                    <th style="width:10%">Status</th>
                    <th style="width:10%">Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                  $sl = 0;
                  foreach ($results as $row):
                    $sl++;
                ?>
                  <tr>
                    <td><?=$sl.'.'?></td>
                    <td><?=$row->committee_designation_name_en?></td>
                    <td><?=$row->department_name?></td>
                    <td>
                      <div class="office-type-tags">
                      <?php 
                        $currentData = explode(',', $row->office_level);
                        foreach($currentData as $valueCurr) {
                          $data = $this->Common_model->get_single_data('office_type', $valueCurr);
                          echo '<span class="btn btn-success btn-xs btn-mini">'.$data->office_type_name.'</span>';
                        }
                      ?>
                      </div>
                    </td>
                    <td><?php echo ($row->status) ?'<span class="btn btn-primary btn-xs btn-mini">Enable </span>': '<span class="btn btn-danger btn-xs btn-mini">Disable</span>';?></td>
                    <td>
                      <div class="btn-group">
                        <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> Action <span class="caret"></span></a>
                        <ul class="dropdown-menu pull-right">
                          <li><a href="<?=base_url("edirectory/designation_edit/".$row->id)?>">Update</a></li>
                          <li><a href="<?=base_url("edirectory/designation_delete/".$row->id)?>" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a></li>
                        </ul>
                      </div>
                    </td>
                  </tr>
                <?php endforeach;?>                      
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>
    </div>

  </div>
</div>