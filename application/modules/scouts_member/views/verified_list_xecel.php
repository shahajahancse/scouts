<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">

<?php
    header('Content-Type: application/vnd.ms-excel'); //mime type
    header('Content-Disposition: attachment;filename="active_members.xls"');
    header('Cache-Control: max-age=0'); //no cache
?>

<?php if($results) { ?>
<!-- <div> -->
<table>
  <thead>
    <tr>
      <th style="width:2%"> SL </th>
      <!-- <th style="width:5%">Image</th> -->
      <th style="width:10%">Full Name</th>
      <th style="width:8%">Scout ID</th>
      <th style="width:8%">Username</th>
      <th style="width:10%">Member Type</th>
      <th style="width:10%">Section</th>
      <th style="width: 10%">Details</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $sl = 0;
      foreach ($results as $row):
        // dd($row);
      $sl = $sl+1;
      $cont = 'Some content <br> <strong>inside</strong> the popover';
    ?>
    <tr>
      <td class="v-align-middle"><?=$sl.'.'?></td>
      <td class="v-align-middle"><strong><?php echo isset($row->first_name) ? $row->first_name : ''; ?></strong></td>
      <td class="v-align-middle"><strong><?php echo isset($row->scout_id) ? $row->scout_id : ''; ?></strong></td>
      <td class="v-align-middle"><?php echo isset($row->username) ? $row->username : ''; ?></td>
      <td class="v-align-middle"><?php echo isset($row->member_type_name) ? $row->member_type_name : ''; ?></td>
      <td class="v-align-middle"><?php echo isset($row->sc_section_id) ? get_scout_section($row->sc_section_id) : ''; ?></td>
    </tr>
    <?php endforeach;?>
  </tbody>
</table>
<?php }else{ ?>
  <h4>No data found!</h4>
<?php } ?>
