<style type="text/css">

  table, td, th {  
    border: 1px solid #ddd;
    text-align: left;
  }

  table {
    border-collapse: collapse;
    width: 100%;
  }

  th, td {
    padding: 5px;
    color: black;
  }

</style>
<div class="page-content">     
  <div class="content">  
    <div style="text-align: center;">
      <div  style="font-size: 20px;">BANGLADESH SCOUTS</div>
      <span>www.scouts.gov.bd</span>
    </div>
    <div class="row-fluid">
      <div class="span12">
        <div class="grid simple ">
          <div class="grid-title">
            <h4 align="center"><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <h3 align="center"><span class="semi-bold"><?=$info->dis_name_en; ?></span></h3>
            <div style="text-align: right;margin-bottom: 5px;">Date: <?= date('d F, Y') ?></div>       
          </div>

          <div class="grid-body ">
            <table class="table table-hover table-condensed" border="0">
              <tr>
                <th>SL</th>
                <th>Name </th> 
                <th>Scout ID</th>
                <th>Designation </th> 
                <th>Phone </th> 
                <th>Phone </th> 
                <th>Remark </th> 
              </tr>
              <?php
              $sl=0;
              foreach ($user_list as $row) {
                $sl++;
                if($row->member_type == 1){
                  $name         = $row->first_name;
                  $phone        = $row->phone;
                  $email        = $row->email;
                  //Scouts member section / designation
                  if($row->member_id == 2){
                    if($row->sc_section_id <= 3){
                     $designation = get_scout_section($row->sc_section_id);
                   }else{
                     $designation = '';
                   }
                 }elseif($row->member_id == 8){
                  $designation = 'Adult Leader';
                }elseif($row->member_id == 9){
                  $designation = 'Professional Executive';
                }elseif($row->member_id == 10){
                  $designation = $row->role_type_name_en;
                }elseif($row->member_id == 12){
                  $designation = $row->role_type_name_en;
                }elseif($row->member_id == 13){
                  $designation = 'Support Staff';
                }
              }else{
                $name = $row->user_name;
                $designation  = $row->user_designation;
                $phone        = $row->user_phone;
                $email        = $row->user_email;
              }
              ?>
              <tr>
                <td><?=$sl?></td>
                <td><?=$name?></td>  
                <td> 
                  <?php 
                  if($row->scout_id){
                    echo $row->scout_id;
                  } 
                  ?> 
                </td>
                <td><?=$designation?></td>  
                <td><?=$phone?></td>  
                <td><?=$email?></td>  
                <td><?=$row->user_remarks?></td>                    
              </tr>
              <?php } ?>
            </table>

          </div>

        </div>
      </div>
    </div>

  </div> <!-- END Content -->

</div>