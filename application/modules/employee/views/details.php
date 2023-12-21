<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('pds/pds_list')?>" class="active"> <?=$module_title; ?> </a></li>
         <li><?=$meta_title; ?> </li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">           
                     <a href="<?=base_url('pds/pds_list')?>" class="btn btn-blueviolet btn-xs btn-mini"> PDS List</a>
                     <a href="<?=base_url('pds/details_pdf/'.encrypt_url($info->id))?>" class="btn btn-blueviolet btn-xs btn-mini" target="_blank"> Generate PDF</a>
                  </div>
               </div>

               <div class="grid-body">
                  <div class="row">

                     <style type="text/css">
                        .tg  {border-collapse:collapse;border-spacing:0; width: 98%; margin: 10px;}
                        .tg td{font-family:Arial, sans-serif;font-size:14px;padding:7px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;color:black;}
                        .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:7px 3px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;color:black;}
                        .tg .tg-68ib{font-weight:bold;background-color:#efefef;border-color:#9b9b9b;text-align:right;vertical-align:top; width: 180px;}
                        .tg .tg-2fdn{border-color:#9b9b9b;text-align:left;vertical-align:top;padding:7px 5px;}
                        .tg .tg-yuct{font-weight:bold;background-color:#efefef;border-color:#9b9b9b;text-align:right;vertical-align:middle; width: 180px;}
                        .tg .tg-m6jf{border-color:#9b9b9b;text-align:left;vertical-align:middle}
                     </style>
                     <table class="tg">
                        <tr>
                           <th class="tg-yuct">Name (English)</th>
                           <th class="tg-2fdn" colspan="3"> <?=$info->name_en?></th>
                           <th class="tg-yuct" rowspan="3">Image</th>
                           <th class="tg-m6jf" rowspan="3">
                              <?php
                              $path = base_url().'employee_img/';
                              if($info->image_file != NULL){
                                 $img_url = '<img src="'.$path.$info->image_file.'" width="90" style="border:1px solid #ccc; padding:3px;">';
                              }else{
                                 $img_url = '<img src="'.$path.'no-image.jpg" width="90" style="border:1px solid #ccc; padding:3px;">';
                              }
                              echo $img_url;
                              ?>
                           </th>
                        </tr>
                        <tr>
                           <td class="tg-yuct">Name (Bangla)</td>
                           <td class="tg-2fdn" colspan="3"><?=$info->name_bn?></td>
                        </tr>
                        <tr>
                           <td class="tg-yuct">Father Name</td>
                           <td class="tg-2fdn" colspan="3"><?=$info->father_name?></td>
                           
                        </tr>
                        <tr>
                           <td class="tg-yuct">Mother Name</td>
                           <td class="tg-2fdn" colspan="3"><?=$info->mother_name?></td>
                           <td class="tg-yuct">PDS ID</td>
                           <td class="tg-m6jf"><?=$info->pds_id?></td>
                        </tr>
                        <tr>
                           <td class="tg-yuct">Date of Birth</td>
                           <td class="tg-2fdn"><?=date_detail_format($info->dob)?></td>
                           <td class="tg-68ib">Gender</td>
                           <td class="tg-m6jf"><?=$info->gender?></td>  
                           <td class="tg-yuct"><span style="font-weight:700">Join Date</span></td>
                           <td class="tg-m6jf"><?=date_detail_format($info->join_date)?></td>                         
                        </tr>
                        <tr>
                           <td class="tg-yuct">Regligion</td>
                           <td class="tg-2fdn"><?=get_religion($info->religion_id)?></td>
                           <td class="tg-68ib">Blood Group</td>
                           <td class="tg-m6jf"><?=$info->bg_name_en?></td>
                           <td class="tg-yuct">Current Working Area</td>
                           <td class="tg-m6jf"><?=$info->current_working_area?></td>
                        </tr>
                        <tr>
                           <td class="tg-yuct">Phone Number</td>
                           <td class="tg-2fdn"><?=$info->phone?></td>
                           <td class="tg-68ib">Email</td>
                           <td class="tg-m6jf"><?=$info->email?></td>
                           <td class="tg-yuct">Current Designation</td>
                           <td class="tg-m6jf"><?=$info->current_desig?></td>
                        </tr>
                        <tr>
                           <td class="tg-yuct">Present Adddress</td>
                           <td class="tg-2fdn"><?=$info->present_address?></td>
                           <td class="tg-68ib">Marital Status</td>
                           <td class="tg-m6jf"><?=$info->ms_name_en?></td>
                           <td class="tg-yuct">Scout ID</td>
                           <td class="tg-m6jf"><?=$info->scout_id?></td>
                        </tr>
                        <tr>
                           <td class="tg-yuct">Permanent Address</td>
                           <td class="tg-2fdn"><?=$info->permanent_address?></td>
                           <td class="tg-68ib">Child No.</td>
                           <td class="tg-m6jf"><?=$info->child_no?></td>
                           <td class="tg-yuct">Spouse Name</td>
                           <td class="tg-m6jf"><?=$info->spous_name?></td>
                        </tr>
                        <tr>
                           <td class="tg-yuct">Passport No.</td>
                           <td class="tg-2fdn"><?=$info->passport_no?></td>
                           <td class="tg-68ib">Passport Issue</td>
                           <td class="tg-m6jf"><?=date_detail_format($info->passport_issue)?></td>
                           <td class="tg-yuct">Passport Expire</td>
                           <td class="tg-m6jf"><?=date_detail_format($info->passport_expire)?></td>
                        </tr>
                        <tr>
                           <td class="tg-68ib">Contribution to scouts</td>
                           <td class="tg-2fdn" colspan="5"><?=$info->contirbutions?></td>
                        </tr>
                        <tr>
                           <td class="tg-68ib">Hobby &amp; Specialty Area</td>
                           <td class="tg-2fdn" colspan="5"><?=$info->hobby?></td>
                        </tr>
                     </table>


                     <div class="row" style="margin-top: 20px;">
                        <div class="col-md-12">
                           <style type="text/css">
                              .tg2  {border-collapse:collapse;border-spacing:0;color: black; margin-bottom: 20px;}
                              .tg2 caption{font-weight: bold; font-size: 18px; color: black;}
                              .tg2 td{font-family:Arial, sans-serif;font-size:14px;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;color: black;}
                              .tg2 th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;color: black;}
                              .tg2 .tg-bm2g{font-weight:bold;background-color:#c0c0c0;border-color:#9b9b9b;text-align:center;vertical-align:top}
                              .tg2 .tg-2fdn{border-color:#9b9b9b;text-align:left;vertical-align:top}
                              .tg2 .tg-xyy0{font-weight:bold;background-color:#c0c0c0;border-color:#9b9b9b;text-align:center;vertical-align:middle}
                              .tg2 .tg-m6jf{border-color:#9b9b9b;text-align:left;vertical-align:middle}
                           </style>
                           <table class="tg2" width="98%" style="margin: 10px;">
                              <caption>Education</caption>
                              <tr>
                                <th class="tg-xyy0" width="5%">SL</th>
                                <th class="tg-xyy0">Education / Exam</th>
                                <th class="tg-xyy0">Institute / University / Board</th>
                                <th class="tg-bm2g" width="12%">Result</th>
                                <th class="tg-bm2g" width="12%">Passing Year</th>
                             </tr>
                             <?php for($i=0;$i<sizeof($education);$i++){ ?>
                             <tr>
                                <td class="tg-m6jf" style="text-align: center;"><?=$i+1?></td>
                                <td class="tg-m6jf"><?=$education[$i]->edu_level_name; ?></td>
                                <td class="tg-m6jf"><?=$education[$i]->institute_board; ?></td>
                                <td class="tg-2fdn"><?=$education[$i]->result; ?></td>
                                <td class="tg-2fdn"><?=$education[$i]->pass_year; ?></td>
                             </tr>
                             <?php } ?>  
                          </table>

                          <table class="tg2" width="98%" style="margin: 10px;">
                              <caption>Working Station</caption>
                              <tr>
                                <th class="tg-xyy0" width="5%">SL</th>
                                <th class="tg-xyy0">Working Place</th>
                                <th class="tg-xyy0">Served As</th>
                                <th class="tg-bm2g" width="15%">From Date</th>
                                <th class="tg-bm2g" width="15%">To Date</th>
                                <th class="tg-bm2g" width="20%">Duration</th>
                             </tr>
                             <?php for($i=0;$i<sizeof($work_station);$i++){ ?>
                             <tr>
                                <td class="tg-m6jf" style="text-align: center;"><?=$i+1?></td>
                                <td class="tg-m6jf"><?=$work_station[$i]->working_place; ?></td>
                                <td class="tg-m6jf"><?=$work_station[$i]->designation; ?></td>
                                <td class="tg-2fdn"><?=date_detail_format($work_station[$i]->date_from); ?></td>
                                <td class="tg-2fdn"><?=date_detail_format($work_station[$i]->date_to); ?></td>
                                <td class="tg-2fdn">
                                <?php
                                $duration='';
                                if($work_station[$i]->_year > 0){
                                    $duration = $work_station[$i]->_year.' Year, ';
                                }
                                if($work_station[$i]->_month > 0){
                                    $duration .= $work_station[$i]->_month.' Month, ';
                                }
                                if($work_station[$i]->_day > 0){
                                    $duration .= $work_station[$i]->_day.' Days';
                                }
                                echo $duration;
                                ?>
                                </td>
                             </tr>
                             <?php } ?>  
                          </table>

                       </div>
                    </div>


                 </div>
              </div> <!-- grid-body -->
           </div> <!-- /grid -->
        </div>
     </div> <!-- row -->
  </div> <!-- /content -->
</div> <!-- /page-content -->