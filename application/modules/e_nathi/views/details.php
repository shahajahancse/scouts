 <!-- Create by: Mafizur
Create Date: 07-06-2018
Modify by: mafizur
last modify date: 12-08-2018 -->
<style type="text/css">
.priview-body{
  font-size: 14px;
  color:#000;
  margin: 25px 75px;
}
.priview-header{
  /*margin-bottom: 40px;*/
  text-align: left;
}
.priview-header p{
  font-size: 15px;
  line-height: 12px;
}
.priview-memorandum, 
.priview-from, 
.priview-to, 
.priview-subject,
.priview-message,
.priview-office,
.priview-demand,
.priview-signature{
  padding-bottom: 20px;
}
.priview-office{
  text-align: center;
}
.priview-imitation ul{
  list-style: none;
}
.priview-imitation ul li{
  display: block;
}
.date-name{
  width: 20%;
  float: left;
  padding-top: 10px;
  text-align: right;
}
.date-value{
  width: 70%;
  float:left;
}
.date-value ul{
  list-style: none;
}
.date-value ul li{
  text-align: center;
}
.date-value ul li:first-child{
  border-bottom: 1px solid #000;
}
.subject-content{
  text-decoration: underline;
}
table {
    width: 100%;
}
table td {
    padding: 5px 8px;
}
</style>   
<style type="text/css">
  .info{margin-left: 25px; color: black;}
  .dt_label{margin-left: 10px; width: 150px; display: block; float: left; color: #796b6b;}
  .dt_data{margin-left: 20px; color: black;}
</style>
<style type="text/css">
  .card7{background-color: #7030a0;border-top: 4px solid #1aa326;box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);border:none;
  }
  .card27{background-color: #ffffff;border: px solid #7030a0;box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
  }
  .header7{width: 100%;padding: 13px 0;background-color: #7030a0;}
  .divider27{width: 80%;padding: 7px;background-color: #ffffff;margin: -10px auto;display: block;}
  /*.logo7 img{margin: 0 auto;display: block;padding: 20px;}*/
  .divider7{width: 100%;border: 2px solid #1aa326;margin-top: ;}
  .divider8{width: 100%;border: 2px solid #7030a0;margin-top: ;}
  .card-info7{background-image: url('awedget/assets/img/transprent_logo.png');background-repeat: no-repeat;background-position: center;  background-size: 105px;}
  .footer7{width: 100%;color: #ffffff;padding-bottom: 3px;text-align: center;font-size: 15px;background-color: #7030a0;}
  .id_card{margin: 0px 5px 0px 5px; color: black; font-size: 11px;}
  .table-bordered tr.bg-success th{ background-color: #a7afaf !important; color:#ffffff;}
  .semi-bold{ color:#0aa699;margin-top: 15px}
  /*.id_card tr{margin: 0px 5px 0px 5px;}*/
  /*.id_card th{width: 93px; text-align: right; padding-bottom: 6px; vertical-align: top}
  .id_card td{padding-left: 10px;padding-bottom: 6px; }*/
</style>

<div class="page-content"> 
  <div class="content">  
   <?php $e_nathi_department = $this->Common_model->e_nathi_department($user->id); ?>
    

    <div class="row">
      <div class="col-md-12">      
        <div class="tiles white"> 
          <div><?php echo validation_errors(); ?></div>
          <?php if($this->session->flashdata('success')):?>
            <div class="modal fade bs-example-modal-sm" id="successModel" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                  <div class="modal-body">
                    <h4 class="text-center"><?php echo $this->session->flashdata('success');?></h4>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">বন্ধ করুন</button>
                  </div>
                </div>
              </div>
            </div>
            <script type="text/javascript">
                $(document).ready(function() {
                  $('#successModel').modal('toggle'); 
                });
            </script>
          <?php endif; ?>

          <?php if($this->session->flashdata('warning')):?>
          <div class="modal fade bs-example-modal-sm" id="warningModel" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                  <div class="modal-body">
                    <h4 class="text-center"><?php echo $this->session->flashdata('warning');?></h4>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">বন্ধ করুন</button>
                  </div>
                </div>
              </div>
            </div>
             <script type="text/javascript">
                $(document).ready(function() {
                  $('#warningModel').modal('toggle'); 
                });
            </script>
          <?php endif; ?>
          <div class="row">
            <div class="col-md-12">
              <ul class="nav nav-tabs" id="tab-01">
                <li class="active"><a href="#tab_letter">নথির বিবরণ</a></li>
                <!-- <li class=""><a href="#tab_page">নথির প্রস্তাবনা  তৈরি করুন</a></li> -->
                <li class=""><a href="#tab_page_list">নথির প্রস্তাবনা তালিকা</a></li>
                <li><a href="#tab_log">লগ ব্যবস্থাপনা</a></li>
              </ul>

              <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_letter">


                  
                <div class="priview-body">

                  <div class="row" style="border-bottom: 1px solid #050505; margin-bottom: 40px">
                      <div class="col-md-4">
                          <p class="text-right"><img src="data:image/png;base64,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" width="130px"></p>
                      </div>
                      <div class="priview-header col-md-6">
                        <h1 class="text-center">বাংলাদেশ স্কাউটস</h1>
                        <h4 class="text-center">জাতীয় সদর দফতর</h4>
                        <h4 class="text-center"><b>বিভাগ  :</b> <?=$nathi->department_name?></h4>
                        <h4 class="text-center"><b>নথি নং :</b> <u><?=$this->Common_model->en2bn($nathi->nathi_no)?></u> <b>তারিখ :</b> <u><?=date_bangla_calender_format($nathi->date)?></u></h4>
                        <h4 class="text-center"><b>নথির নাম  :</b> <?=$nathi->title?></h4>
                      </div>
                  </div>

                  <?php foreach ($paragraph as $key => $para) { ?>
                  <div class="priview-message">
                    <div class="row">
                      <div class="col-sm-1 col-xs-1 text-right">
                        <?=$this->Common_model->en2bn($para->paragraph_no)?>
                      </div>
                      <div class="col-sm-11 col-xs-11">
                        <?=$para->details?>
                        <?php if(!empty($para->attachment)){ ?>
                          <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th class="text-center">সংযুক্ত ফাইলের নাম</th>
                                  <th class="text-center">ডাউনলোড </th>
                                  <th class="text-center">ভিউ</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php foreach ($para->attachment as $file) { ?>
                                  <tr>
                                    <td><?=$file->name?></td>
                                    <td class="text-center"><a  href="<?=base_url('efile_img/'.$file->userfile)?>" download=""><i class="fa fa-download"></i></a> </td>
                                    <td class="text-center"><a  href="<?=base_url('efile_img/'.$file->userfile)?>" target="_blank">বিস্তারিত</a> </td>
                                </tr>
                                <?php } ?>
                              </tbody>
                          </table>
                        <?php } ?>
                        <?php if($e_nathi_department->emp_designation == $suggestion->nathi_desk && $e_nathi_department->emp_department == $suggestion->nathi_desk_department && ($suggestion->status == 1)):?>
                        <a class="btn btn-success pull-right btn-small" data-toggle="modal" data-target=".edit<?=$para->id?>" style="margin-right: 15px"><i class="fa fa-edit"></i></a>
                        <?php endif ?>
                      </div>
                    </div>

                    <div class="row" style="margin-bottom: 15px">
                      <?php foreach ($para->note as $key => $info) {?>
                              <div class="text-center col-md-4" style="height: 180px">
                          <?php if(!empty($info->note)){ ?>
                          
                            <?=$info->note?>
                          
                              <?php } ?>
                                <?php if(!empty($info->signature)){ ?>
                                  <img src="<?=base_url('employee_img/'.$info->signature)?>" width="100px">
                                <?php } ?>
                                </br>
                                (<?=$info->first_name?>) </br>
                                <?=$info->designation_name?> </br>
                                <?php if($info->department_id !=1){ ?>
                                  <?=$info->department_name?> </br>
                                <?php } ?>
                                বাংলাদেশ স্কাউটস </br>
                                
                              </div>
                        <?php } ?>
                    </div>
                  </div>
                 
                  
                <?php } ?>
                <?php 
                $department_info=$e_nathi_department->emp_department==1?$suggestion->nathi_desk_department:$e_nathi_department->emp_department;
                if($e_nathi_department->emp_designation == $suggestion->nathi_desk && $department_info == $suggestion->nathi_desk_department && ($suggestion->status == 1)){?>
                <?php 
              $attributes = array('id' => 'validate');
              echo form_open_multipart(base_url('e_nathi/paragraph'), $attributes);?>
                <div class="tab-content text-left">

                  <div role="" class="tab-pane active" id="">
                      <div class="">
                        <h4 class="semi-bold">নথির অনুচ্ছেদ লিখুন </h4>

                        <input name="nathi_id" value="<?=set_value('nathi_id',$nathi->id)?>" type="hidden" class="form-control input-sm datetime required" required>

                        <input name="sug_id" value="<?=set_value('sug_id',$suggestion->id)?>" type="hidden" class="form-control input-sm datetime required" required>

                  
                        <input name="date" value="<?=set_value('date',date('d-m-Y'))?>" type="hidden" class="form-control input-sm datetime required" placeholder="DD-MM-YYYY" required>
                      </div>
                      
                        
                      <div class="">
                          <label class="form-label">অনুচ্ছেদ <span class="star required">*</span></label>
                          <?php echo form_error('details'); ?>
                          <textarea id="editor1" name="details"  placeholder="বিবরণ" class="form-control input-sm required" required="required" rows="10"></textarea>
                      </div>

                      <div class="">
                        <h4 class="semi-bold">নতুন  ফাইল সংযুক্ত  করুন</h4>
                       <table width="100%" border="1" id="memberDiv">
                          <tr>
                            <td class="text-center" width="45%" style="padding: 5px">সংযুক্ত ফাইলের নাম </td>
                             <td class="text-center" width="45%" style="padding: 5px">নির্বাচন করুন</td>
                             <td class="text-center" width="10%" style="padding: 5px"> <a href="javascript:void();" id="addRow" class="label label-success"> <i class="fa fa-plus-circle"></i> Add More</a> </td>
                          </tr>
                          <tr></tr>
                       </table>
                       <span style="color: red">বিঃ দ্রঃ - ফাইল সাইজ সর্বোচ্চ ২ MB, ফাইল ফরমেট : JPG, PNG, PDF, DOC</span>
                        
                      </div>


                        <h4 class="semi-bold">সাধারণ সংযুক্তি</h4>
                        <select name="general_attach[]" multiple="" class="form-control">
                          <option value=""> -- একটি নির্বাচন করুন --</option>
                          <?php foreach ($general_attachment as $key => $value) { ?>
                            <option value="<?=$value->name.'-'.$value->userfile?>"><?=$value->name?></option>
                          <?php } ?>
                        </select>

                        <?php
                          if($suggestion->nathi_approval==1){
                            $next_step=12;
                          }elseif($e_nathi_department->emp_designation==12){
                            $next_step=8;
                          }elseif($e_nathi_department->emp_designation==7){
                            $next_step=5;
                          }elseif($e_nathi_department->emp_designation==5){
                            $next_step=3;
                          }else{
                            $next_step=$e_nathi_department->emp_designation-1;
                          }
                        ?>
                        <?php if($e_nathi_department->emp_designation==7){?>
                          <h4 class="semi-bold">ডিপার্টমেন্ট</h4>          
                          <?php echo form_dropdown('nathi_desk_department', $department, set_value('nathi_desk_department',$suggestion->department), 'style="width:100%"'); ?>
                      <?php }else{ ?>
                        <input name="nathi_desk_department" value="<?=set_value('nathi_desk_department',$suggestion->nathi_desk_department)?>" type="hidden" class="form-control input-sm datetime required" required>
                      <?php } ?>
                        <h4 class="semi-bold">পদবি</h4>          
                        <?php echo form_dropdown('file_desk', $designation, set_value('file_desk',$next_step), 'style="width:100%"'); ?>
                      

                      <div style="margin-top:15px; margin-bottom:15px" > 
                           
                           <button type="submit" name="btnsubmit" value="send" class="btn btn-success btnSubmit1"> সংরক্ষণ করুন</button>

                           <button type="submit" name="btnsubmit" value="send2" class="btn btn-primary btnSubmit1"> সংরক্ষণ এবং প্রেরণ করুন</button>

                           <a href="<?=base_url('e_nathi/pdf/'.$nathi->id.'/'.$suggestion->id) ?>" class="btn btn-warning pull-right" target="_blank" style="margin-left: 15px">ডাউনলোড করুন</a>

                           <?php if(($e_nathi_department->emp_designation < 8) && ($e_nathi_department->emp_designation == $suggestion->nathi_desk) && ($suggestion->nathi_approval !=1)):?>
                                <a href="<?=base_url('e_nathi/approved/'.$suggestion->id) ?>" class="btn btn-info pull-right" style="margin-left: 15px">অনুমোদন প্রদান করুন</a>
                            <?php endif; ?>

                            <?php if(($user->desk_officer ==1) && ($e_nathi_department->emp_designation == $suggestion->nathi_desk) && ($e_nathi_department->emp_department == $suggestion->department) && ($suggestion->status == 1)):?>
                                <a href="<?=base_url('e_nathi/closing/'.$suggestion->id) ?>" class="btn btn-info pull-right" style="margin-left: 15px">সম্পন্ন করুন</a>
                            <?php endif; ?>
                      </div>

                  </div>
                  
                </div>
                <?php echo form_close();?> 
                <?php }else{ ?>
                  <a href="<?=base_url('e_nathi/pdf/'.$nathi->id.'/'.$suggestion->id) ?>" class="btn btn-warning pull-right" target="_blank" style="margin-left: 15px">ডাউনলোড করুন</a>
                <?php } ?>
                </div>



              </div>

              <div class="tab-pane" id="tab_page">
                <?php 
              $attributes = array('id' => 'validate');
              echo form_open_multipart(base_url('e_nathi/suggestion'), $attributes);?>


                         
                      <input name="nathi_id" value="<?=set_value('nathi_id',$nathi->id)?>" type="hidden" class="form-control input-sm datetime required" placeholder="DD-MM-YYYY" required>

                      <div class="col-md-4">
                            <label class="form-label"> তারিখ <span class='required'>*</span></label>
                            <?php echo form_error('date'); ?>
                            <input name="date" value="<?=set_value('date',date('d-m-Y'))?>" type="text" class="form-control input-sm datetime required" placeholder="DD-MM-YYYY" required>
                      </div>

                      <div class="col-md-8">
                          <label class="form-label">সংযুক্ত  <span class='required'></span></label>
                            <input name="userfile" value="" type="file" class="form-control input-sm" placeholder="" >
                      </div>

                      <div class="col-md-12">
                          <label class="form-label"> অনুচ্ছেদ সমূহ   </label>
                            <?php echo form_multiselect('paragraph_list[]', $paragraph_list, set_value('paragraph_list[]'), 'style="width:100%"'); ?>
                      </div>
                      
                      <div class="col-md-12" style="margin-top:15px; margin-bottom:15px" > 
                           <button type="submit" name="btnsubmit" value="save" class="btn btn-info btnSubmit1"> সংরক্ষণ </button>
                           <button type="submit" name="btnsubmit" value="send" class="btn btn-success btnSubmit1"> সংরক্ষণ এবং প্রেরণ</button>
                      </div>

              <?php echo form_close();?>

              </div>

              <div class="tab-pane" id="tab_page_list">
                  <table class="table table-hover table-condensed" border="0">
                     <thead>
                        <tr>
                           <th style="width:5%">ক্রম </th>
                           <th style="width:25%">নথির নাম</th>
                           <th style="width:10%">নথি নং</th>
                           <th style="width:10%">বিভাগ</th>
                           <!-- <th style="width:15%">অনুচ্ছেদ</th> -->
                           <th style="width:20%">নথির অবস্থান </th>
                           <th style="width:20%">নথি আগমনের তারিখ ও সময়</th>                          
                           <th style="width:8%; text-align: right;">পদক্ষেপ</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        $sl=0;
                        foreach ($results as $row):
                           $sl++;
                        ?>
                        <tr>
                           <td class="v-align-left"><?=$this->Common_model->en2bn($sl).'.'?></td>
                           <td> <strong><?=$row->title?></strong> </td>
                           <td> <strong><?=$row->nathi_no?></strong> </td>
                           <td class="v-align-middle"><?=$row->department_name; ?></td>
                           <!-- <td class="v-align-middle"><?=$row->nathi_message; ?></td> -->
                           <td class="v-align-middle">
                              <?= $row->status==2?'<span class="btn btn-success btn-mini  text-center">সম্পন্ন</span>':$row->designation_name ?>  
                           </td>
                           <td class="v-align-middle"><?=date_bangla_calender_format($row->date); ?></td>
                           <td align="right">
                              <a href="<?=base_url('e_nathi/details/'.$row->nathi_id.'/'.$row->id)?>" class="btn btn-success btn-mini">বিস্তারিত</a>
                           </td>
                        </tr>
                     <?php endforeach;?>                      
                  </tbody>
               </table>
                
              </div>
              <div class="tab-pane" id="tab_log">
                  <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                          <th>প্রেরক </th>
                          <th>প্রেরিত বিভাগ</th>
                          <th>প্রাপক </th>
                          <th>আগত বিভাগ</th>
                          <th>তারিখ</th>
                        </tr>
                        
                    </thead>
                    <tbody>
                      <?php foreach ($log as $key => $info) {?>
                          <tr>
                            <td><?=$info->designation_name?></td>
                            <td><?=$info->department_name?></td>
                            <td><?=$info->designation_name2?></td>
                            <td><?=$info->department_name2?></td>
                            <td><?=date_bangla_calender_format($info->created_at)?></td>
                          </tr>
                        <?php } ?>
                    </tbody>
                  </table>
                </div>

                </div> 
                              

              </div> <!-- /tab-content -->
            </div> <!-- /end tab col -->
          </div>

        </div> <!-- /tiles -->
      </div>
    </div> <!--/row -->

  </div>  <!--/content -->
</div>

<?php foreach ($paragraph as $key => $para) { ?>
    
    <div class="modal fade edit<?=$para->id?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
       <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
           <?php $attributes = array('id' => 'validate');
           echo form_open_multipart(base_url('e_nathi/paragraph_edit/'.$para->id), $attributes);?>
           
           <div class="modal-body text-left">
             <div class="row">  
                 <div class="col-md-12">
                     <label class="form-label">অনুচ্ছেদ <span class="star required">*</span></label>
                     <input name="nathi_id" value="<?=set_value('nathi_id',$nathi->id)?>" type="hidden" class="form-control input-sm datetime required" placeholder="DD-MM-YYYY" required>
                     <textarea id="editor1<?=$para->id?>"  name="details"  placeholder="বিবরণ" class="form-control input-sm required" required="required" rows="10"><?=$para->details?></textarea>
                 </div>

                 <div class="col-md-12">
                    <h4 class="semi-bold">নতুন  ফাইল সংযুক্ত  করুন</h4>
                   <table width="100%" border="1" id="memberDiv<?=$para->id?>">
                      <tr>
                         <td class="text-center" width="45%" style="padding: 5px">সংযুক্ত ফাইলের নাম </td>
                             <td class="text-center" width="45%" style="padding: 5px">নির্বাচন করুন</td>
                         <td class="text-center" width="10%" style="padding: 5px"> <a href="javascript:void();" id="addRow<?=$para->id?>" class="label label-success"> <i class="fa fa-plus-circle"></i> Add More</a> </td>
                      </tr>
                      <?php foreach ($para->attachment as $file) { ?>
                          <tr>
                              <td><?=$file->name?></td>
                              <td class="text-center"><a  href="<?=base_url('efile_img/'.$file->userfile)?>" download=""><?=$file->userfile?></i></a> </td>
                              <td class="text-center"><a href="javascript:void();" class="label label-important" data-id="<?=$file->id?>"  onclick="removeRow2(this)"> <i class="fa fa-minus-circle"></i> Remove </a></td>
                          </tr>
                      <?php } ?>
                      <tr></tr>
                   </table>
                   <span style="color: red">বিঃ দ্রঃ - ফাইল সাইজ সর্বোচ্চ ২ MB, ফাইল ফরমেট : JPG, PNG, PDF, DOC</span>
                    
                  </div>
                  <div class="col-md-12">
                    <h4 class="semi-bold">সাধারণ সংযুক্তি</h4>
                    <select name="general_attach[]" multiple="" class="form-control">
                      <option value=""> -- একটি নির্বাচন করুন --</option>
                      <?php foreach ($general_attachment as $key => $value) { ?>
                        <option value="<?=$value->name.'-'.$value->userfile?>"><?=$value->name?></option>
                      <?php } ?>
                    </select>
                  </div>
              </div>
           </div>
           <div class="modal-footer">
             <br>
             <button type="button" class="btn btn-default" data-dismiss="modal">বন্ধ করুন</button>
             <button type="submit" class="btn btn-primary">সম্পাদন করুন</button>
           </div>

           <?php echo form_close();?>
         </div>
       </div>
     </div>

     <script>
      $(function () {
      CKEDITOR.replace("editor1<?=$para->id?>");
    });
   // Education
   $("#addRow<?=$para->id?>").click(function(e) {
          var items = '';
          items+= '<tr>';

          items+= '<td><input type="text" name="file_name[]" class="form-control input-sm" required></td>';

          items+= '<td><input type="file" name="userfile[]" class="form-control input-sm" required></td>';

          items+= '<td class="text-center"><a href="javascript:void();" class="label label-important" onclick="removeRow(this)"> <i class="fa fa-minus-circle"></i> Remove </a></td>';
          items+= '</tr>';
          
          $("#memberDiv<?=$para->id?> tr:last").after(items);
       });

       function removeRow(id){ 
          $(id).closest("tr").remove();
       }

    </script>
  <?php } ?>


<script type="text/javascript">
    $(document).ready(function() {
        $(".desk").click(function() {
            $('.desk').prop("checked", false);
            $(this).prop("checked", true);
        });
    });
</script>

<script type="text/javascript">
   
   // Education
   $("#addRow").click(function(e) {
      var items = '';
      items+= '<tr>';

      items+= '<td><input type="text" name="file_name[]" class="form-control input-sm" required></td>';

      items+= '<td><input type="file" name="userfile[]" class="form-control input-sm" required></td>';

      items+= '<td class="text-center"><a href="javascript:void();" class="label label-important" onclick="removeRow(this)"> <i class="fa fa-minus-circle"></i> Remove </a></td>';
      items+= '</tr>';
      
      $('#memberDiv tr:last').after(items);
   });

   function removeRow(id){ 
      $(id).closest("tr").remove();
   }
  function removeRow2(id){ 

      var dataId = $(id).attr("data-id");
      if (confirm("Are you sure you want to delete this information from database?") == true) {
          $.ajax({
            type: "POST",
            url: hostname+"e_nathi/ajax_attachment_file_del/"+dataId,
            success: function (response) {
              // $("#msgEducation").addClass('alert alert-success').html(response);
              $(id).closest("tr").remove();
            }
        });
      }
  }
</script>

<script type="text/javascript">
      function printData(){
       var divToPrint=document.getElementById("tab_letter");
       var style = "<style>";
        style = style + "table {width: 100%; font: 17px Calibri;}";
        style = style + "table, th, td {border: solid 1px #DDD; border-collapse: collapse;";
        style = style + "padding: 2px 3px; text-align: center;}";
        style = style + "</style>";
       newWin= window.open("");
       newWin.document.write(style);
       newWin.document.write(divToPrint.outerHTML);
       newWin.print(style);
       newWin.close();
    }
    </script>
