<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url()?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?> </li>
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

      .search-form {
        margin-bottom: 20px;
      }

      .search-form .row {
        margin-bottom: 10px;
      }

      @media screen and (max-width: 767px) {
        .grid-title {
          flex-direction: column;
          align-items: stretch;
        }

        .grid-title .pull-right {
          margin-top: 10px;
        }

        .search-form .col-md-2,
        .search-form .col-md-3,
        .search-form .col-md-1 {
          width: 100%;
          margin-bottom: 10px;
        }

        .search-form .pull-right {
          float: none;
          text-align: center;
        }

        .btn-xs, .btn-mini {
          width: 100%;
          margin-bottom: 5px;
        }

        .table th,
        .table td {
          white-space: nowrap;
          min-width: 120px;
        }
      }
    </style>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal green">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <!-- <a href="<?=base_url('acl/create_user')?>" class="btn btn-blueviolet btn-xs btn-mini"> Create User </a> -->
            </div>
          </div>

          <div class="grid-body">
            <div id="infoMessage"><?php echo $message;?></div>
            <form method="get" action="" class="search-form">
              <div class="row">
                <div class="col-md-2">
                  <input type="text" name="scoutID" value="<?=$_GET['scoutID'] ?? '' ?>" class="form-control input-sm uppercaseText" placeholder="Scout ID">
                </div>

                <div class="col-md-2">
                  <input type="text" name="name" value="<?=$_GET['name'] ?? '' ?>" class="form-control input-sm" placeholder="Name">
                </div>

                <div class="col-md-2">
                  <input type="text" name="username" value="<?=$_GET['username'] ?? '' ?>" class="form-control input-sm" placeholder="Username">
                </div>
                <div class="col-md-3">
                    <?php echo form_error('group');
                    $more_attr = 'class="form-control input-sm" ';
                    echo form_dropdown('group', $group_list, set_value('group'), $more_attr);
                    ?>
                </div>
                <div class="col-md-1">
                  <div class="pull-right">
                    <button type="submit" class="btn btn-blueviolet btn-mini"><i class="icon-ok"></i> Search</button>
                  </div>
                </div>
              </div>
            </form>

            <div class="table-responsive">
              <table class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th>SL</th>
                    <th>Scout ID</th>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th width="80">Status</th>
                    <th width="150">Group</th>
                    <th width="150">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sl = $pagination['current_page'];
                  foreach ($users as $user):
                    $sl++;
                  ?>
                  <tr>
                    <td><?=$sl.'.'?></td>
                    <td><?php echo $user->scout_id;?></td>
                    <td><?php echo $user->username;?></td>
                    <td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
                    <td>
                      <?php
                      echo ($user->active) ? anchor("acl/deactivate/".$user->id, strtoupper(lang('index_active_link')), array('class' => 'label label-success')) : anchor("acl/activate/". $user->id, strtoupper(lang('index_inactive_link')), array('class' => 'label label-important'));
                      ?>
                    </td>
                    <td>
                      <div class="btn-group-responsive">
                        <?php
                        foreach ($user->groups as $group):
                          echo '<span class="btn btn-primary btn-xs btn-mini" style="background-color:#6b64d0;">'.htmlspecialchars($group->description,ENT_QUOTES,'UTF-8').'</span>';
                        endforeach;
                        ?>
                      </div>
                    </td>
                    <td>
                      <div class="btn-group-responsive">
                        <?php echo anchor("acl/edit_user/".$user->id, 'Edit','class="btn btn-mini btn-primary"') ;?>
                        <a class="btn btn-mini btn-primary" href="<?=base_url("acl/user_delete/".$user->id)?>" onclick="return confirm('Be careful! Are you sure you want to delete this user?');">Delete</a>
                      </div>
                    </td>
                  </tr>
                  <?php endforeach;?>
                </tbody>
              </table>
            </div>

            <div class="row">
              <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> Total <span style="color: green; font-weight: bold;"><?php echo $total_rows; ?> Users </span></div>
              <div class="col-sm-8 col-md-8 text-right">
                <?php echo $pagination['links']; ?>
              </div>
            </div>

          </div>

        </div>
      </div>
    </div> <!-- END ROW -->

  </div>
</div>
