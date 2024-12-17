<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <li> General Setting</li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <div class="row-fluid">
      <div class="span12">
        <div class="grid simple ">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('general_setting/division_add')?>" class="btn btn-primary btn-xs btn-mini"> Add Division</a>  
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
            <table class="table table-hover table-condensed" id="">
              <thead>
                <tr>
                  <th style="width:2%">SL</th>
                  <th style="width:25%">Division Name</th>
                  <th style="width:25%">Name Bangla</th>
                  <th style="width:15%">GEO Code</th>
                  <th style="width:15%">Status</th>
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
                  <td class="v-align-middle"><?=$row->div_name?></td>
                  <td class="v-align-middle"><?=$row->div_name_bn; ?></td>
                  <td class="v-align-middle"><?=$row->div_geo; ?></td>
                  <td> <?php echo ($row->status) ?'<span class="btn btn-primary btn-xs btn-mini">Enable </span>': '<span class="btn btn-danger btn-xs btn-mini">Disable</span>';?> </td>
				          <td><?php echo anchor(base_url()."general_setting/division_edit/".$row->id, 'Edit', 'class="btn btn-mini btn-primary"') ;?>&nbsp;<a class="btn btn-mini btn-primary" href="<?=base_url()?>general_setting/division_delete/<?=$row->id?>" onclick="return confirm('Are you sure you want to delete this Division?');">Delete</a></td>
                </tr>
                <?php endforeach;?>                      
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    </div> <!-- END ROW -->

  </div>
</div>