<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <li> Manage User </li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <div class="row-fluid">
      <div class="span12">
        <div class="grid simple ">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('scouts_setting/unit_office_add')?>" class="btn btn-primary btn-xs btn-mini"> Add Unit Office </a>
              <a href="<?=base_url('scouts_setting/unit_office')?>" class="btn btn-success btn-xs btn-mini"> Unit Office List</a>  
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
            <table class="table table-hover table-condensed" id="example">
              <thead>
                <tr>
                  <th style="width:2%"> SL </th>
                  <th style="width:10%">Full Name</th>
                  <th style="width:10%">Email</th>
                  <th style="width:5%">Status</th>
                  <th style="width:10%">Group</th>
                  <th style="width:5%">Action</th>
                </tr>
              </thead>
              <tbody>
              <?php 
                $sl=0;
                //foreach ($users as $user):
                  //$sl++;
              ?>
                <tr>
                  <td class="v-align-middle"><?=$sl.'.'?></td>
                  <td class="v-align-middle"><?php //echo htmlspecialchars($user->first_name.' '.$user->last_name,ENT_QUOTES,'UTF-8');?></td>
                  <td class="v-align-middle"><?php //echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
                  <td>
                  <?php //echo ($user->active) ? anchor("manage_user/deactivate/".$user->id, lang('index_active_link'), array('class' => 'btn btn-warning btn-xs btn-mini')) : anchor("manage_user/activate/". $user->id, lang('index_inactive_link'), array('class' => 'btn btn-danger btn-xs btn-mini'));?>
                  </td>
                  <td> hello
                  </td>
                  <td class="v-align-middle">
                    <div class="btn-group">
                      <button class="btn btn-mini btn-success">Action</button>
                      <button class="btn btn-mini btn-success dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> </button>
                      <ul class="dropdown-menu">                        
                        <li><?php //echo anchor("manage_user/edit_user/".$user->id, 'Edit User') ;?></li>
                        <li class="divider"></li>
                        <li><a href="#">Delete</a></li>
                      </ul>
                    </div> 
                  </td>
                </tr>
                <?php //endforeach;?>                      
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    </div> <!-- END ROW -->

  </div>
</div>