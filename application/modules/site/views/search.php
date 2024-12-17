
    <div class="container w-75">
      <div class="secondary_sc_content">
        <p class="lead font-weight-bold py-2 text-white" style="background-color: #1aa326; padding-left:10px"><?=$meta_title?></p>
        <?php $grp_name=$this->session->userdata('site_lang')=='bangla'?'grp_name_bn':'grp_name';?>
         
        <div class="container">
          <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">


                  <div class="container ">
                      <div class="row">
                        <h4>
                          <b>
                           <?=lang('site_common_region')?> :
                            <?=$this->session->userdata('site_lang')=='bangla'?$region_name->region_name:$region_name->region_name_en;?>
                          </b>
                        </h4>
                        <?php if(!empty($_GET['district'])){?>
                          <h4>
                            <b>
                              <?=lang('site_common_district')?> :
                              <?=$this->session->userdata('site_lang')=='bangla'?$district_name->dis_name:$district_name->dis_name_en;?>
                            </b>
                          </h4>
                        <?php } ?>
                        
                        <table class="table table-bordered">
                            
                            <tbody class="sc_upzila_val">
                              <?php if(!empty($info)){
                                $i=0;
                                foreach ($info as $row) { ?>
                                  <tr>
                                    <td width="5%"><?=$this->session->userdata('site_lang')=='bangla'?BanglaConverter::en2bn(++$i):BanglaConverter::bn2en(++$i);?></td>
                                    <td><a href="<?=base_url()?>group-details/<?=$row->id?>" style="color:#000;"><?=$row->$grp_name?></a></td>
                                  </tr>
                              <?php } } ?>
                              
                            </tbody>
                          </table>
                          <div class="pt-3"></div>
                        </div>
                  </div>


              </div> 
            </div>
        </div><!-- main row -->
      </div>
  </div>
        