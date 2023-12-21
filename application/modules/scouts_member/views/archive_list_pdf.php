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
     <div style="text-align: center;">
         <div  style="font-size: 20px;">BANGLADESH SCOUTS</div>
         <span>www.scouts.gov.bd</span>
      </div>
      <div class="row-fluid">
         <div class="span12">
            <div class="grid simple ">
             <div class="grid-title">
              <h4 align="center"><span class="semi-bold"><?=$meta_title; ?></span></h4>
              <div style="text-align: right;margin-bottom: 5px;">Date: <?= date('d F, Y') ?></div>       
            </div>
          <div class="grid-body ">
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');?>
              </div>
            <?php endif; ?>

            <?php if($this->session->flashdata('warning')):?>
              <div class="alert alert-warning">
                <?php echo $this->session->flashdata('warning');?>
              </div>
            <?php endif; ?>

            <?php if($results) { ?>

            <table class="table table-hover table-condensed" id="example">
              <thead>
                <tr>
                  <th width="5%"> SL </th>
                  <th width="5%">Image</th>
                  <th width="25%">Full Name</th>
                  <th width="10%">Scout ID</th>
                  <th width="12%">Member Type</th>
                  <th width="10%">Section</th>
                  <th width="30%">Group Name</th>
                  <th width="10%">Username</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $sl=$pagination['current_page'];
                foreach ($results as $row):
                  $sl++;
                  // Profile Image
                $path = base_url().'profile_img/';
                if($row->profile_img != NULL){
                  $img_url = '<img src="'.$path.$row->profile_img.'" height="20">';
                }else{
                  $img_url = '<img src="'.$path.'no-img.png" height="20">';
                }
                $cont = 'Some content <br> <strong>inside</strong> the popover';
                ?>
                <tr>
                  <td class="v-align-middle"><?=$sl.'.'?></td>
                  <td class="v-align-middle"><?=$img_url?></td>
                  <td class="v-align-middle"><?php echo $row->first_name;?></td>
                  <td class="v-align-middle"><span class="trigger-scout-id"><?=$row->scout_id?> </span>

                    <td class="v-align-middle"><?=$row->member_type_name?></td>
                    <td class="v-align-middle"><span class="label label-green"><?=get_scout_section($row->sc_section_id);?></span></td>
                    <td class="v-align-middle"><?=$row->grp_name?></td>
                    <td class="v-align-middle"><?=$row->username?>
                    </td>
                </tr>
              <?php endforeach;?>                      
            </tbody>
          </table>

          <?php }else{ ?>

          <div class="clearfix"></div>
          <div class="alert alert-block alert-error fade in">
            <h4 class="alert-heading"><i class="icon-warning-sign"></i>No data found!</h4>
          </div>

          <?php } ?>

        </div>
      </div>
    </div>
  </div>

</div> <!-- END ROW -->

</div>