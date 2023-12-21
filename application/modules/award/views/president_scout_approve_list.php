<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dahsboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('award/president_scout_list')?>" class="active"><?=$module_name?> </a></li>
         <li><?=$meta_title; ?> </li>
      </ul>

      <style type="text/css">
         .tg  {border-collapse:collapse;border-spacing:0; border: 0px solid red;}
         .tg td{font-size:14px;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#00000;background-color:#E0FFEB; vertical-align: middle;}
         .tg th{font-size:14px;font-weight:bold;padding:3px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#bce2c5;text-align: center;}
         .tg .tg-ywa9{background-color:#ffffff;vertical-align:top; color: black;}
         .tg .tg-khup{background-color:#efefef;vertical-align:top; color: black; text-align: right;}
         .tg .tg-akf0{background-color:#ffffff;vertical-align:top;color: black;}
         .tg .tg-mtwr{background-color:#efefef;vertical-align:top; font-weight: bold; text-align: center; font-size: 16px;text-decoration: underline;}
      </style>   

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple ">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                     <a href="<?=base_url('award/president_scout_list')?>" class="btn btn-blueviolet btn-xs btn-mini"> President Scout Award Circular List</a>
                     <a href="<?=base_url('award/president_scout_award_approval_list_pdf/'.encrypt_url($info->id))?>" target="_blank" class="btn btn-blueviolet btn-xs btn-mini"> Generate Award Approve List PDF </a>
                  </div>            
               </div>

               <div class="grid-body ">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>

                  <table class="tg" width="100%">
                  <tr>
                     <th class="tg-khup" width="150"> Circular Name</th>
                     <td class="tg-ywa9" colspan="3"><?=$info->circular_title;?></td>
                     <th class="tg-khup"> Status</th>
                     <td class="tg-ywa9">
                        <?php 
                           if($info->status == 1) {
                              echo $status = '<button class="btn btn-mini btn-info">Enable</button>';
                           }else{
                              echo $status = '<button class="btn btn-mini btn-danger">Disable</button>';
                           }
                        ?>
                     </td>
                  </tr> 
               </table>
               <br>

                  <table class="table table-hover table-condensed" border="0">
                     <thead>
                        <tr>
                           <th style="width:2%"> SL </th>
                           <th style="width:15%">Name </th> 
                           <th style="width:10%">Scout ID </th> 
                           <th style="width:10%">Date of Birth</th>
                           <th style="width:10%">Phone</th>
                           <th style="width:30%">Scout Group</th>
                           <th style="width:7%; text-align: right;">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        $sl=0;
                        foreach ($results as $row):
                           $sl++;
                        ?>
                        <tr>
                           <td class="v-align-left"><?=$sl.'.'?></td>
                           <td><strong><?=$row->first_name?></strong></td>
                           <td><?=$row->scout_id?></td>
                           <td><?=$row->dob?></td>
                           <td><?=$row->phone?></td>
                           <td><?=$row->grp_name?></td>
                           <td align="right">
                              <div class="btn-group"> <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> Action <span class="caret"></span> </a>
                                 <ul class="dropdown-menu pull-right">
                                    <li><?=anchor("award/president_scout_certificate_pdf/".encrypt_url($row->id), 'Generate Certificate PDF', array('target' => '_blank'))?></li>
                                 </ul>
                              </div>
                           </td>
                        </tr>
                     <?php endforeach;?>                      
                  </tbody>
               </table>

               <div class="row">
                  <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> Total <span style="color: green; font-weight: bold;"><?php echo count($results); ?> Person Recommended </span></div>
                  <div class="col-sm-8 col-md-8 text-right">
                     <?php echo $pagination['links']; ?>
                  </div>
               </div>
            </div>

         </div>
      </div>
   </div>

</div> <!-- END Content -->

</div>