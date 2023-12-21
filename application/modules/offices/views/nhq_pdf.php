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
  padding: 8px;
  color: black;

}

</style>
<div class="page-content">     
   <div class="content"> 

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple ">
               <div class="grid-title">
                  <h4 align="center"><span class="semi-bold"><?=$meta_title; ?></span></h4>
                   
               </div>

               <div class="grid-body ">
                  
                  <table class="table table-hover table-condensed"> 
                     <thead>
                        <tr>
                           <th style="width:2%"> SL </th>
                           <th style="width:30%">Office Name</th>
                           <th style="width:15%">Email/Username</th>
                           <th style="width:15%">Groups</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        $sl=0;
                        foreach ($results as $row):
                           $sl++;
                        //$encryptID = $this->encrypt->encode($row->id, $this->encKey);
                        if($row->nhq_status == 1) {
                           $status = '<button class="btn btn-mini btn-info">Enable</button>';
                        }else{
                           $status = '<button class="btn btn-mini btn-primary">Disable</button>';
                        }
                        ?>
                        <tr>
                           <td class="v-align-middle"><?=$sl.'.'?></td>
                           <td> <?=$row->nhq_office_name?> </td>
                           <td> <strong><?=$row->username?></strong> </td>
                           <td>
                              <?php 
                              foreach ($row->groups as $group):
                                //echo anchor("#", htmlspecialchars($group->description,ENT_QUOTES,'UTF-8'), array('class' => 'btn btn-primary btn-xs btn-mini'));
                              echo '<span class="btn btn-primary btn-xs btn-mini" style="background-color:#6b64d0;margin-bottom:1px;">'.htmlspecialchars($group->description,ENT_QUOTES,'UTF-8').'</span>';
                              echo '&nbsp;';
                              endforeach;
                              ?>
                            </td>
                                              
                        </tr>
                     <?php endforeach;?>                      
                  </tbody>
               </table>
            </div>

         </div>
      </div>
   </div>

</div> <!-- END Content -->

</div>