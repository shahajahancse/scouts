<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url('dashboard')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <div class="row-fluid">
      <div class="span12">
        <div class="grid simple ">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                    
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
                  <th style="width:10%">Request To</th>
                  <th style="width:20%">Services Name</th>
                  <th style="width:14%">Name</th>
                  <th style="width:10%">Phone</th>
                  <th style="width:10%">Email</th>
                  <th style="width:10%">Address</th>
                  <th style="width:10%">Status</th>
                  <th style="width:24%" class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($services)){
                  $i=0;
                  foreach ($services as $row) {
                    if($row->request_to == 1){
                      $request_type = 'NHQ';
                    }else{
                      $request_type = 'Region';
                    }
                    ?>
                  <tr>
                    <td class="v-align-middle"><?=++$i?></td>
                    <td class="v-align-middle"><strong><?=$request_type?></strong></td>
                    <td class="v-align-middle"><?=$row->service_name?></td>
                    <td class="v-align-middle"><?=$row->name?></td>
                    <td class="v-align-middle"><?=$row->phone?></td>
                    <td class="v-align-middle"><?=$row->email?></td>
                    <td class="v-align-middle"><?=$row->address?></td>
                    <td class="v-align-middle"><?=$row->status?></td>
                    <td class="text-center">
                      <a href="<?=base_url('services/details/'.$row->id);?>" class="btn btn-primary btn-xs btn-mini">Details</a>     
                      <?php if($this->ion_auth->is_admin()){ ?> 
                        <a href="<?=base_url('services/delete/'.$row->id);?>" class="btn btn-info btn-xs btn-mini">Delete</a>
                      <?php } ?>
                    </td>
                  </tr>
                    <?php
                  }
                }?>
              
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    </div> <!-- END ROW -->

  </div>
</div>