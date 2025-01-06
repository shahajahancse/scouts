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

      @media screen and (max-width: 767px) {
        .grid-title {
          flex-direction: column;
          align-items: stretch;
        }
        
        .grid-title .pull-right {
          margin-top: 10px;
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

        .col-md-8 {
          width: 100%;
          padding: 0 15px;
        }
      }
    </style>

    <div class="row">
      <div class="col-md-8">
        <div class="grid simple horizontal green">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <!-- <a href="<?=base_url('acl/create_group')?>" class="btn btn-blueviolet btn-xs btn-mini"> Create Group</a>   -->
            </div>            
          </div>

          <div class="grid-body">
            <div id="infoMessage"><?php //echo $message;?></div>
            <?php if($this->session->flashdata('message')):?>
                <div class="alert alert-success">
                    <?php echo $this->session->flashdata('message');?>
                </div>
            <?php endif; ?>

            <div class="table-responsive">
              <table class="table table-hover table-bordered">
                  <thead>
                    <tr>
                      <th>SL</th>
                      <th>Group Name</th>
                      <th>Description</th>
                      <th width="150">Action</th>
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
                        <td><?php echo $row->name;?></td>
                        <td><?php echo $row->description;?></td>
                        <td>
                          <div class="btn-group-responsive">
                            <?php echo anchor("acl/edit_group/".$row->id, 'Edit','class="btn btn-mini btn-primary"') ;?>
                            <a class="btn btn-mini btn-primary" href="#">Delete</a>
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