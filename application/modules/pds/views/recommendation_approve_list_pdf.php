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
            <h3 align="center"><span class="semi-bold"><?=$info->circular_title; ?></span></h3>
            <div style="text-align: right;margin-bottom: 5px;">Date: <?= date('d F, Y') ?></div>       
          </div>

          <div class="grid-body ">
            <table class="table table-hover table-condensed" border="0">
              <tr>
                <th>SL</th>
                <th>Name </th> 
                <th>Recommend Award </th> 
                <th>Phone </th> 
                <th>Scout Group </th> 
              </tr>
              <?php
              $sl=0;
              foreach ($results as $row) {
                $sl++;
                ?>
                <tr>
                  <td><?=$sl?></td>
                  <td><?=$row->name_bn?></td>  
                  <td><?=$row->award_name_bn?></td>  
                  <td><?=$row->phone?></td>  
                  <td><?=$row->sc_group_name?></td>                    
                </tr>
              <?php } ?>
              </table>

            </div>

          </div>
        </div>
      </div>

    </div> <!-- END Content -->

  </div>