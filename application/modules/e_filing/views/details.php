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
  margin-bottom: 40px;
  text-align: center;
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

    

    <div class="row">
      <div class="col-md-12">      
        <div class="tiles white">
          <div class="row">
            
            <div class="col-md-12 user-description-box col-sm-12 ">
                <?php if($this->session->flashdata('success')):?>
                  <span  style="margin-top:8px" class="alert alert-success">
                     <?php echo $this->session->flashdata('success');;?>
                  </span>
                <?php endif; ?>
                <?php if(($user->emp_designation == $file->file_approval) && ($user->emp_designation == $file->file_file_desk) && ($file->status == 1)):?>
                    <a href="<?=base_url('e_filing/approved/'.$file->id) ?>" class="btn btn-info pull-right">অনুমোদন প্রদান</a>
                <?php endif; ?>

                <?php if($user->emp_designation == $file->file_desk):?>

                      <!-- Large modal -->
                      <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target=".bs-example-modal-lg">প্রেরণ</button>

                      <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                        <div class="modal-dialog modal-lg" role="document">
                          <div class="modal-content">
                            
                            <?php $attributes = array('id' => 'validate');
                            echo form_open_multipart(base_url('e_filing/forward/'.$file->id), $attributes);?>
                            
                            <div class="modal-body">
                              <table class="table table-bordered table-hover" style="background: #fff">
                                <thead>
                                  <tr>
                                      <td class="text-center">#</td>
                                      <td class="text-center">পদবি</td>
                                      <td class="text-center">প্রাপক</td>
                                      <td class="text-center">অনুলিপি </td>
                                  </tr>
                                </thead>
                                <tbody>
                                <?php $i=1; foreach ($designation as $key => $value) {
                                    if($key !=0){
                                    ?>
                                      <tr>
                                        <td><?=$i++?></td>
                                        <td><?=$value?></td>
                                        <td class="text-center">
                                          <label class="checkbox-inline"><input type="checkbox" name="file_desk" class="desk" value="<?=$key?>"></label>
                                        </td>
                                        <td class="text-center">
                                          <label class="checkbox-inline"><input type="checkbox" name="file_copy[]" value="<?=$key?>"></label>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                <?php } ?>
                                </tbody>
                            </table>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">বন্ধ করুন</button>
                              <button type="submit" class="btn btn-primary">প্রেরণ</button>
                            </div>

                            <?php echo form_close();?>
                            
                          </div>
                        </div>
                      </div>

                      <!-- Small modal -->
                      <button type="submit" class="btn btn-primary pull-right" data-toggle="modal" data-target=".bs-example-modal-sm">মন্তব্য</button>

                      <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                        <div class="modal-dialog modal-sm" role="document">
                          <div class="modal-content">
                            <?php $attributes = array('id' => 'validate');
                            echo form_open_multipart(base_url('e_filing/note/'.$file->id), $attributes);?>
                            
                            <div class="modal-body">
                              <textarea name="note" class="form-control input-sm required"></textarea>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">বন্ধ করুন</button>
                              <button type="submit" class="btn btn-primary">সংরক্ষণ</button>
                            </div>

                            <?php echo form_close();?>
                          </div>
                        </div>
                      </div>
                    
                <?php endif; ?>
            </div>           

          </div> <!--/row -->
          
          
          <div class="row">
            <div class="col-md-12">
              <ul class="nav nav-tabs" id="tab-01">
                <li class="active"><a href="#tab_letter">চিঠির বিবরণ</a></li>
                <!-- <li><a href="#tab_attachment">চিঠি এটাচমেন্ট</a></li> -->
<!--                 <li><a href="#tab_note">মন্তব্য লিস্ট</a></li>
                <li><a href="#tab_log">লগ ব্যবস্থাপনা</a></li> -->
              </ul>

              <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_letter">


                  
                <div class="priview-body">


                  <div class="priview-header">
                    <p class="text-center"><img src="data:image/png;base64,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" width="100px"></p>
                    <p class="text-center">বাংলাদেশ স্কাউটস</p>
                    <p class="text-center">জাতীয় সদর দফতর</p>
                    <p class="text-center"><u><b>60, আঞ্জুমান মুফিদুল ইসলাম রোড, কাকরাইল</b></u></p>
                  </div>
                  
                  <div class="priview-memorandum">
                    <div class="row">
                      <div class="col-sm-8 col-xs-6">
                        স্মারক নং - <?=$this->Common_model->en2bn($file->file_memorandum)?>
                      </div>
                      <div class="col-sm-4 col-xs-6">
                          <div class="date-name">
                            তারিখ
                          </div>
                          <div class="date-value">
                            <ul>
                              <li class="bongabdo"></li>
                              <li><?=date_bangla_calender_format($file->date)?></li>
                            </ul>
                            <script type="text/javascript">
                                $(document).ready(function(){
                                  $('.bongabdo').bongabdo({
                                      date: '<?=date_db_format($file->date)?>'
                                  });
                                });
                            </script>
                          </div>
                      </div>
                    </div>
                    
                  </div>

                  <div class="priview-subject">
                    <div class="row">
                      <div class="col-sm-2 col-xs-2">
                        নথি নং
                      </div>
                      <div class="col-sm-10 col-xs-10 subject-content">
                        <?=$file->nathi_title?>
                      </div>
                    </div>
                  </div>

                  <div class="priview-subject">
                    <div class="row">
                      <div class="col-sm-2 col-xs-2">
                        প্রাপক
                      </div>
                      <div class="col-sm-10 col-xs-10 subject-content">
                        <?=nl2br($file->file_from)?>
                      </div>
                    </div>
                  </div>
                  
                  <div class="priview-subject">
                    <div class="row">
                      <div class="col-sm-2 col-xs-2">
                        বিষয়
                      </div>
                      <div class="col-sm-10 col-xs-10 subject-content">
                        <?=$file->file_subject?>
                      </div>
                    </div>
                  </div>
                  
                  <div class="priview-message">
                    <div class="row">
                      <div class="col-sm-12 col-xs-12">
                        <span style="width:8.33%; float: left;">&nbsp;</span>
                        <?=$file->file_message?>
                        <?php if(!empty($file->file_name)){ ?>
                          <br>
                          <img src="<?=base_url('efile_img/'.$file->file_name)?>" class="img-responsive">
                        <?php } ?>
                      </div>
                    </div>
                  </div>



                  <div class="priview-signature">
                    <div class="row">
                      <div class="col-sm-8 col-xs-6">
                        </br>
                        </br>
                        <?=nl2br($file->file_to)?>
                      </div>
                      <div class="col-sm-4 col-xs-6">
                        <div class="text-center">
                          
                          <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAUAAAACeCAMAAAB0DSNzAAAAgVBMVEX///8AAAD6+vri4uLq6ur29va3t7f5+fnW1tbS0tLKysrv7+/g4OBSUlKtra3AwMCampqjo6MuLi5fX1+AgIA9PT2RkZG+vr6urq5vb291dXWenp5PT080NDRmZmZ4eHiGhoYeHh4SEhIkJCRGRkY5OTkNDQ0pKSkZGRlhYWFQUFA4s7RfAAALIUlEQVR4nO1diXaiShCVVUBkUUBkE7do5v8/8FHVDWhiEmRreKfve2fGjIk0RS23lu4sFhwcHBwcHBwcHBwcHBwcHBwcHBwcHBwcHBwcHBwcHENCZr2AWUM7+IK3ZL2K2WK1FhAr1guZKSwiPuHIeiHzxMpH6XlBwBWwDWwUXy6yXsdMoexBfFsuvpaQP0B+ButlzBYOiG/NXV9buCA/h/UqZgvRA/nprJcxW2D0PSuslzFbmCC/PXd/bYHmm7NexXzxCfKzWK9itlhdQH471suYLXQQ38ecy38ri2Xwk27AnmecvOk5U/qVzTx8SFumpTcFa1cqo6t3hxrR2qXJ5vrI/gSNzcU7Y+VR6QkBoxWEWLtidPHOUEvxsSJgpPPB6uF1hOimxeJvV4blN2Qvc2V/dPEGMFiJzRJiWEE6U/a3gsXHq6D488Ko+ZrPmL3IQL02snGC+gebJexOM66dGmTtAUMChuqXzpS9QN/hbMsQAdPn8ps+UkKnrGesftIG/B7p3nwhYIkghGMsAcnzkVHo6or4jrQvf0EgILBEw6+ANH6TeZbuRUg8TysZ2N/5mwqMUlIwPmYcfTF6RCQDeVE+Mt3hzQqTx8tMyZ9Bwi6OPrlMVmAe4doHJtfuDJl2XZG92I9vjNUJI33fzUzJi4YTY4sFuPDTgwkti2QuGWUFNtO6T1e4dPFwF5sHlXPRqEYIiSIG3+NM1Y/QPqPgECC/Knws8w9Szhp+AcYdn+BcGx8gvwvo3fpB3bSgLAcOXs6SsO17YVT1bgP50ShlqPxl8Eqss1/9syqnDm5W5EmNkuX0A32L8aLEuWKuIjVX093gPR3khTH4ILKBbaPtXFI3UbPOKJzSXtQHIwUBOrpD+3DxGJVAMRvHS3RD5ZvVTWWY8KXuR8GT9Vyqtz/HuSXSdwmmvGNmdxCKCHcMCm5nkaB62QikT2R/CxImkWCijpPLS//gah8TnpmU3CoWnCJkCkdXhmYDVKo0+s6TkzMtezRzQvIk5GNd7juW4u8b7nal9LKMvkhsumyx3K4iCKwydzJz8Dn6yKQWuk6e1c5KSNdJ7qjfg1hMI6mhLCQyX5ADIfFIBHFHIyk/AJ3vyf77G3uDFhqHTZQJP8HPH1NYYh4XYHXLbe3qkPMlItlsFgTRhVXP9wgLGG2/jGjbmf8srmOS7fdR8V+239YyLPVwh1Qlgi/VnL4JzI/0iyR8Cgd2Rd9RuYvuOrWEBH8f7Ax59eXeFVlTyRzLFt4h7i0rFFIMq5/Mizd29QflDIuWo9VdNDev9S6NLPX3m7bhm29LJYDCxrrQvpVxrH4cbLnye8KeYdq5PKBzGVr/RXdb3X26d7RG3qKSEOTlMtKWFL9O5LJZiOJjmTYR9Ru24i1KYWW168B441kRancuYpuNbiZQqgKzdqKfmLEseqwSdEQDXkHUw2spvCx8815NpCtFYkZs11Mw94jwCRzIZ26ZNmzCodXPoJl+YWYvmN1foAW8xQ6msgu5YZP8Sj8H562uTGseEjqRZCjqrIXJR2W2LQhSPQ9JYpwJYrzXTNV2mM7al893mGFNUfWo8G4Htd0TAq+5KU+zCBYG5iFxz+vsABkJxRA79cVVXMbHpHX1Ep2LQ8OwRcebGGvcE1D97v17EFFzqPBOmd766axAfgfFpNon4mfuJ9TfJ3u1+p81NEu/tba6PBtQt8S2SfFgp+Hf6ymVyIlh9EyfZLesC6ztTnEpBIKX6WWtGW3lMqUaJWHw3t/f+AaWKnV7d6djOUmpu2fbUoa3SXUYUP02fT5R0aXSO3eV3mJhnSr5KdaRvAin1J5Wet7rsQoPEdJc4WJ1d/JaJb2rQQKvcJrWtjLi5HuzCKPcOxXtegmRZVcoNcqqqTsl7aP547an1EMue4r7d8oDv4Jsh0lCMtQiTO1APRPz0l4yX0Xd0yQ3svtkt3JowefZB/A092GInxq2/Fw0X7+H2y1b/cImGIScqSQLTIf4bLLfudWy9/2on2jQkPsZDtP/smmDLh/k08mwwqF4SsF7wz9LKMqdOkcPm0pv4wyUlhp7Gke6PWrz0Ta8DQ6aqRfBD9HP3vRFNcDVEHEP3FkyvCt18kNlpVIpvlb7D2Q3pguThYcyE0wYweQMOIY7fG2UfKn5bew7kz/jQJoRRZY7WOs9rjpOreqk4qa6R2BX9R4anwgQbNenrAj50mfjT0a765L6qtjPEc6BMVxFxEgrFt3SVISyPuI+xyCHKJtU7/WST1QrGwHJVftjSiSDxtztkGMLGjZnkBqd2gYngW7JoH4aOKQNrhQECIXPWgT+OxqF1Yx3/OUjVvGNKsWgIyc2UizLBEXP2j5qhbopeApgwwbWxRwqgUetRo1oqg5YY2pZCTdJgSrNh62GmKgQew2v1n6yeEV+GsZkVButFsPHlriGBwXA6zRMsUlPoc392146hu4V/gjrV4mG80HrDrkbRFYJA8h+QZRGqbzq42ZdzN8bsiQZHcv7a9nRpuvZGboSp6N9+Zp0f0MtXsMjcaHQr11InFZcC7Der4beoiEjkd/43hp2dMRr3pzBW/4rJJZbjdxq1I0g+SQIFzFTV4V8UbWVhacggCG1YTMj/KK7TWAH5LK+O3wRXduehTuMvRjg948dlR1c4MV1vEIDDwVXVXBT1+b4xYSRQTfMst8/Y9dIyNXSeIRxExF938ZYyFgVi7pWrh71rdAx/PMoS7kT57UGvpOBoK2/oUY2pXuXYIwhWQljRmJQR9XDhMte+IYyJIFeYGZHBlmbCSVvLmoo7+WkvLd2R+lda2sSOhaKh696oOhFxD3l6/R8exE4MBZElktSxWZECWN1Q2HolLpfx5HewsSHe9XLEn4v0yUWDZcgSCRg/sNTMc61WJvZF8jv1oTSyxb1HRd3pPl8OtJUGK+OMdjr57pCWSZVfdyW+Rxo5VKCx2Y6AvI7/V3RUAxavEyCscYmHrbB45Prq0ETw+EwJVYviIoKMStrSDTVRqpq08Mcc2O0vSGaVxqvFIBDOvbGlbzn5OL1HTXNsr8ds/ACBp3D8OMR+4ZIIhIQGgmZPR6ld+nxWCyM1b+yUolutbhEI46cyAFcNYUrkk2CvZ4l5fc3aKv8sTi57GvEY26KIrxvDQQdz0K69xyz3P5GRdfCb0e9lHQ5G2kDKAUZR1SrBez7vrp4SHv6SAggHz9kYuUkRjJcX+MVRAt07gweTyPMZUKjkt9w/4mZmjToXuJxN2SKqH1XEN8OGe6kRiW/QYIlfv9nmUrv5o29KwWTjRQ4gY6liqkfxgC+ev3l37SYFpf/jb6XFneBpmgRKL50UqOSrwD7Fx+PiVesmG4U8t3RPY/qY7wtXslI/M4zOEoFJ7K3hN7pu6DcbzC24wPY+ORA+8gG87U+rWG1H0BKXql/rGdl/zkM/I4MtPmIfBR39foz0D4C4+H4geKxhyaLXxyF4hO8Ik2U41NJAWcD3cHK4fVgMdoISvakwgECpK2aTmpMvBEU/J8R3DLXMND3nWd6/D4rhBBwoeBHZtX8WRkve2hQ+v0AnSMnCczoCL1JADLxU1zkjTGk3ZPaoDUDLA/01yXsMOvYzIa4TAQy8KdIWshYsMrmevwqM6DYdjDKzY23BYA4n9SFjuIbdJb1f4kdjpYuZIy8e268b0KBIeRMJrT5wI33XeDEnYrnqJHz1TjewQ7zbrINIuPiexv1SXan0cZD/kcwq2Gy6dfqp4hqiHvLA28LaGW/wOPa1wrEfG9z/Y0j7AG0z+c5RwfYI2yF4ODg4ODg4ODg4ODg4ODg4ODg4ODoH/8BQ/d6QyjBeX4AAAAASUVORK5CYII=" width="100px"></br>
                          (<?=$file->first_name?>) </br>
                          <?=$file->designation_name?> </br>
                          <?=$file->department_name?> </br>
                          বাংলাদেশ স্কাউটস </br>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    
                    <?php foreach ($note as $key => $info) {?>
                              
                              <div class="text-center col-md-4">
          
                                <img src="data:image/png;base64,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" width="100px"></br>
                                (<?=$info->first_name?>) </br>
                                <?=$info->designation_name?> </br>
                                <?=$info->department_name?> </br>
                                বাংলাদেশ স্কাউটস </br>
                                
                              </div>
                        <?php } ?>
                  </div>
                </div>
                
                </div>
                 <div class="tab-pane" id="tab_attachment">
                  <img src="<?=base_url('efile_img/'.$file->file_name)?>" class="img-responsive">
                </div>
                <div class="tab-pane" id="tab_note">
                  <table class="table table-bordered table-hover">
                    <thead>
                        <?php foreach ($note as $key => $info) {?>
                          <tr>
                            <td>
                              <?=nl2br($info->note)?>
                              <div class="text-right">
          
                                <img src="data:image/png;base64,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" width="100px"></br>
                                (<?=$info->first_name?>) </br>
                                <?=$info->designation_name?> </br>
                                <?=$info->department_name?> </br>
                                বাংলাদেশ স্কাউটস </br>
                                
                              </div>
                            </td>
                          </tr>
                        <?php } ?>
                    </thead>
                  </table>
                </div>

                <div class="tab-pane" id="tab_log">
                  <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                          <td>প্রেরক </td>
                          <td>প্রাপক</td>
                          <td>তারিখ</td>
                        </tr>
                        <?php foreach ($log as $key => $info) {?>
                          <tr>
                            <td><?=$info->designation_name?></td>
                            <td><?=$info->designation_name2?></td>
                            <td><?=date_bangla_calender_format($info->created_at)?></td>
                          </tr>
                        <?php } ?>
                    </thead>
                  </table>
                </div>

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

<script type="text/javascript" src="<?= base_url('awedget/assets/js/qrcode.min.js') ?>"></script>

<script type="text/javascript">
  var qrcode = new QRCode(document.getElementById("qrcode"), {
    text: $('#qr_code_text').val(),
    width: 35,
    height: 35,
    colorDark : "#000000",
    colorLight : "#ffffff",
    correctLevel : QRCode.CorrectLevel.H
  });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".desk").click(function() {
            $('.desk').prop("checked", false);
            $(this).prop("checked", true);
        });
    });
</script>
