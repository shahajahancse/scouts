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
       <?php if($results) { ?>
       <table class="table table-hover table-condensed" id="example">
         <thead>
           <tr>
           <th style="width:5%"> SL </th>
             <th style="width:20%">Awardee Name</th>
             <th style="width:20%">Awared Name</th>
             <th style="width:18%">Certificate No.</th>
             <th style="width:18%">Year</th>    
           </tr>
         </thead>
         <tbody>
          <?php 
          $sl=$pagination['current_page'];
          foreach ($results as $row):
            $sl++;

          ?>
          <tr>
            <tr>
             <td class="v-align-left"><?=$sl.'.'?></td>
             <td> <strong><?=$row->name_en?></strong> </td>
             <td> <?=$row->archive_award_name?> </td>
             <td> <?=$row->certificate_no?> </td>                           
             <td> <?=$row->archive_year?> </td>
           </tr>
         <?php endforeach;?>                      
       </tbody>
     </table>
     <?php }else{ ?>

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