<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
      <li> General Setting </li>
      <li> <?=$meta_title?> </li>
    </ul>

    <style type="text/css">
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
          width: 100%;
        }

        .grid-title .pull-right .btn {
          width: 100%;
          margin-bottom: 5px;
        }

        .table th,
        .table td {
          white-space: nowrap;
          min-width: 120px;
        }

        .btn-mini {
          width: 100%;
          margin-bottom: 5px;
          display: block;
          text-align: center;
        }

        .btn-group {
          width: 100%;
        }

        .dropdown-menu {
          width: 100%;
          text-align: center;
        }

        .office-type-tags {
          display: flex;
          flex-wrap: wrap;
          gap: 5px;
        }

        .office-type-tags .btn {
          margin: 2px;
        }
      }
    </style>

    <div class="row-fluid">
      <div class="span12">
        <div class="grid simple ">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('general_setting/committee_designation_add')?>" class="btn btn-blueviolet btn-xs btn-mini"> Add Committee Designation </a>
            </div>            
          </div>

          <div class="grid-body ">
            <?php if($this->session->flashdata('success')):?>
                <div class="alert alert-success">
                    <?php echo $this->session->flashdata('success');?>
                </div>
            <?php endif; ?>
            
            <div class="table-responsive">
              <table class="table table-hover table-bordered" id="">
                <thead>
                  <tr>
                    <th style="width:2%"> SL </th>
                    <th style="width:20%">Comm. Designation Name</th>
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
                    <td class="v-align-middle"><?=$sl.'.'?></td>
                    <td class="v-align-middle"><?=$row->committee_designation_name?></td>
                    <td class="v-align-middle">
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
                    <td> <?php echo ($row->status) ?'<span class="btn btn-primary btn-xs btn-mini">Enable </span>': '<span class="btn btn-danger btn-xs btn-mini">Disable</span>';?> </td>
                    <td>
                      <div class="btn-group btn-group-responsive"> 
                        <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> Action <span class="caret"></span> </a>
                        <ul class="dropdown-menu pull-right">
                          <li><a href="<?=base_url("general_setting/committee_designation_edit/".$row->id)?>">Update</a></li>
                          <li><a href="<?=base_url("general_setting/committee_designation_delete/".$row->id)?>" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a></li>
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

    </div> <!-- END ROW -->

  </div>
</div>