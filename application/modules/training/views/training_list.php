<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url( 'dashboard' )?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url( 'dashboard' )?>" class="active"> <?=$module_title;?> </a></li>
      <li><?=$meta_title;?> </li>
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

      @media screen and (max-width: 767px) {
        .table th, .table td {
          white-space: nowrap;
        }

        .btn-group {
          display: flex;
          gap: 4px;
        }

        .btn {
          padding: 4px 8px;
          font-size: 12px;
        }
      }
    </style>

    <div class="row-fluid">
      <div class="span12">
        <div class="grid simple">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title;?></span></h4>
            <div class="pull-right">
            <?php if ( $this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() ) {?>
              <a href="<?=base_url( 'training/create_training' )?>" class="btn btn-blueviolet btn-xs btn-mini"> Create Training </a>
            <?php }?>
            </div>
          </div>

          <div class="grid-body">
            <div id="infoMessage"><?php //echo $message;?></div>
            <?php if ( $this->session->flashdata( 'success' ) ): ?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata( 'success' ); ?>
              </div>
            <?php endif;?>

            <?php if ( $results ) { //print_r($results);?>
            <div class="table-responsive">
              <table class="table table-hover table-condensed" id="example">
                <thead>
                  <tr>
                    <th> SL </th>
                    <th>Training Name</th>
                    <th>Course Name</th>
                    <th>Place</th>
                    <th>From Date</th>
                    <th>To Date</th>
                    <th>Reg. Start</th>
                    <th>Reg. End</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                      $sl = $pagination['current_page'];
                          foreach ( $results as $row ):
                              $sl++;

                              if ( $row->start_date > date( 'Y-m-d' ) ) {
                                  $status = 'Upcomming';
                              } elseif ( ( $row->start_date > $row->end_date ) && ( $row->start_date < $row->end_date ) ) {
                              $status = 'Ongoing';
                          } else {
                              $status = 'Complete';
                          }
                      ?>
                  <tr>
                    <td><?=$sl?></td>
                    <td><a href="<?=base_url( 'training/details/' . $row->id );?>"><strong><?=$row->training_title?></strong></a></td>
                    <td><?=$row->course_id == 100 ? $row->other_course_name : $row->course_name?></td>
                    <td><?=$row->place?></td>
                    <td><?=date( 'd M, y', strtotime( $row->start_date ) )?></td>
                    <td><?=date( 'd M, y', strtotime( $row->end_date ) )?></td>
                    <td><?=date( 'd M, y', strtotime( $row->reg_start ) )?></td>
                    <td><?=date( 'd M, y', strtotime( $row->reg_end ) )?></td>
                    <td><span class="label label-green"><?=$status?></span></td>
                    <td>
                      <div class="btn-group">
                        <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> Action <span class="caret"></span> </a>
                        <ul class="dropdown-menu pull-right">
                          <li><a href="<?=base_url( 'training/details/' . encrypt_url( $row->id ) );?>">Details</a></li>
                          <li><a href="<?=base_url( 'training/applicant_list/' . encrypt_url( $row->id ) );?>">Applicant List</a></li>
                          <li><a href="<?=base_url( 'training/participant_list/' . encrypt_url( $row->id ) );?>">Participant List</a></li>
                          <li><a href="<?=base_url( 'training/edit/' . encrypt_url( $row->id ) );?>">Update</a></li>
                          <li><a href="<?=base_url( 'training/delete/' . encrypt_url( $row->id ) );?>" onclick="return confirm('Be careful! Are you sure you want to delete this scout member?');">Delete</a></li>
                        </ul>
                      </div>
                    </td>
                  </tr>
                <?php endforeach;?>
                </tbody>
              </table>
            </div>

            <div class="row">
              <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> Total <span style="color: green; font-weight: bold;"><?php echo $total_rows; ?> Total Training </span></div>
              <div class="col-sm-8 col-md-8 text-right">
                <?php echo $pagination['links']; ?>
              </div>
            </div>

          <?php } else {?>
            <div class="alert alert-block alert-error fade in">
              <h4 class="alert-heading"><i class="icon-warning-sign"></i>No data found!</h4>
            </div>
          <?php }?>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>