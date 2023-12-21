<?php 
$lan=$this->session->userdata('site_lang')=='bangla'?'region_name':'region_name_en';
?>
<div class="container w-75">
   <div class="secondary_sc_content">
      <p class="lead font-weight-bold py-2 text-white" style="background-color: #1aa326; padding-left:10px"><?=$meta_title?></p>

      <div class="container">
         <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">

               <div class="container ">
                  <div class="row">
                     <table class="table table-bordered">
                        <tbody>
                           <?php if(!empty($info)){

                              $i=1;
                              foreach ($info as $row) { ?>
                              <tr>
                                 <td width="5%"><?=$this->session->userdata('site_lang')=='bangla'?BanglaConverter::en2bn($i++):BanglaConverter::bn2en($i++);?></td>
                                 <td><img src="<?=base_url().'offices_img/'.$row->region_logo?>" width="30" style="margin-right:10px"><a href="<?=base_url()?>region-details/<?=$row->id?>" style="color:#000;"><?= $row->$lan ?></a></td>
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
