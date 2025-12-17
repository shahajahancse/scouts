
<?php
  // header("Content-Disposition: attachment; filename=$filename");
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=members.xls");
    echo '<table border="0" cellpadding="5" cellspacing="0">';
?>

<div class="table-responsive">
  <table border="1" class="table table-hover table-condensed" id="example">
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
            <div class="btn-group-responsive">
              <a href="<?=base_url('complain/details/'.encrypt_url($row->id));?>" class="btn btn-primary btn-xs btn-mini">Details</a>
              <?php if($this->ion_auth->is_admin()){ ?>
                <a href="<?=base_url('complain/delete/'.$row->id);?>" class="btn btn-info btn-xs btn-mini">Delete</a>
              <?php } ?>
            </div>
          </td>
        </tr>
          <?php
        }
      }?>
    </tbody>
  </table>
</div>
