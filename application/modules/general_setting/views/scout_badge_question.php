<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <li> General Setting</li>
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
      }
    </style>

    <div class="row-fluid">
      <div class="span12">
        <div class="grid simple ">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('general_setting/scout_badge_question_add')?>" class="btn btn-blueviolet btn-primary btn-xs btn-mini"> Add Scout Badge Question</a>  
            </div>            
          </div>

          <div class="grid-body ">
            <div id="infoMessage"><?php //echo $message;?></div>            
            <?php if($this->session->flashdata('success')):?>
                <div class="alert alert-success">
                    <a class="close" data-dismiss="alert">&times;</a>
                    <?php echo $this->session->flashdata('success');?>
                </div>
            <?php endif; ?>
            <div class="table-responsive">
              <table class="table table-hover table-condensed" id="">
                <thead>
                  <tr>
                    <th style="width:2%">SL</th>
                    <th style="width:15%">Section Name</th>
                    <th style="width:15%">Badge Name</th>
                    <th style="width:50%">Description</th>
                    <th style="width:18%">Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                  $sl=0;
                  foreach ($results as $row):
                    $sl++;
                ?>
                  <tr>
                    <td class="v-align-middle"><?=$sl.'.'?></td>
                    <td class="v-align-middle"><?=get_scout_section($row->section_id);?></td>
                    <td class="v-align-middle"><?=$row->badge_type_name_bn; ?></td>
                    <td class="v-align-middle"><?=$row->questions; ?></td>
                    <td class="btn-group-responsive">
                      <?php echo anchor(base_url()."general_setting/scout_badge_question_edit/".$row->id, 'Edit', 'class="btn btn-mini btn-primary"') ;?>
                      <a class="btn btn-mini btn-primary" href="<?=base_url()?>general_setting/scout_badge_question_delete/<?=$row->id?>" onclick="return confirm('Are you sure you want to delete this Scout Badge Question?');">Delete</a>
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