<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url()?>" class="active"> <?=$module_title; ?> </a></li>
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
            <a href="<?=base_url('Complain/complain_list_pdf')?>" class="btn btn-primary btn-xs btn-mini" style="float: right;">PDF Download</a>
            <table class="table table-hover table-condensed" id="example">
              <thead>
                <tr>
                  <th style="width:2%"> SL </th>
                  <th style="width:14%">Name</th>
                  <th style="width:10%">Phone</th>
                  <th style="width:10%">Email</th>
                  <th style="width:10%">Address</th>
                  <th style="width:24%" class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($complain)){
                  $i=0;
                  foreach ($complain as $row) {
                    ?>
                  <tr>
                    <td class="v-align-middle"><?=++$i?></td>
                    <td class="v-align-middle"><?=$row->name?></td>
                    <td class="v-align-middle"><?=$row->phone?></td>
                    <td class="v-align-middle"><?=$row->email?></td>
                    <td class="v-align-middle"><?=$row->address?></td>
                    <td class="text-center">
                      <a href="<?=base_url('complain/details/'.encrypt_url($row->id));?>" class="btn btn-primary btn-xs btn-mini">Details</a>     
                      <?php if($this->ion_auth->is_admin()){ ?> 
                        <a href="<?=base_url('complain/delete/'.$row->id);?>" class="btn btn-info btn-xs btn-mini">Delete</a>
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