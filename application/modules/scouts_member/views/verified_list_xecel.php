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
        dd($row);
      $sl = $sl+1;
      // $path = base_url().'profile_img/';
      // if($row->profile_img != NULL){
      //   $img_url = '<img src="'.$path.$row->profile_img.'" height="20">';
      // }else{
      //   $img_url = '<img src="'.$path.'no-img.png" height="20">';
      // }
      $cont = 'Some content <br> <strong>inside</strong> the popover';
    ?>
    <tr>
      <td class="v-align-middle"><?=$sl.'.'?></td>
      <!-- <td class="v-align-middle">< ?=$img_url?></td> -->
      <td class="v-align-middle"><strong><?php echo $row->first_name;?></strong></td>
      <td class="v-align-middle"><strong><?=$row->scout_id?></td>
      <td class="v-align-middle"><?php echo $row->username;?></td>
      <td class="v-align-middle"><?php echo $row->member_type_name;?></td>
      <td class="v-align-middle"><?php echo get_scout_section($row->sc_section_id);?></td>
    </tr>
    <?php endforeach;?>
  </tbody>
</table>
<?php }else{ ?>
  <h4>No data found!</h4>
<?php } ?>
