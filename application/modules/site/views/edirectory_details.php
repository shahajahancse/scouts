<style type="text/css">
  .tg-ronw{ text-align: right !important; width: 200px; vertical-align: top }
  .tg  {border-collapse:collapse;border-spacing:0; width: 100%}
  .tg td{font-family:Arial, sans-serif;font-size:14px;padding:4px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:white;}
  .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:4px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:white;}
  .tg .tg-t4bo{font-size:14px;background-color:#cbcefb;color:#000000;border-color:#9698ed;text-align:left; width: 350px;}
  .tg .tg-ronw{font-weight:bold;background-color:#9698ed;color:#000000;border-color:#6665cd;text-align:center}
</style>
<div class="container w-75">
  <div class="secondary_sc_content">
    <p class="lead font-weight-bold py-2 text-white" style="background-color: #1aa326; padding-left:10px; overflow: hidden;"><span style="float: left;"><?=$meta_title?></span>
      <span style="float: right; margin-right: 10px;">
        <a href="<?=base_url('edirectory')?>" class="btn btn-primary btn-xs">Home</a>
        <script>
         document.write('<a href="' + document.referrer + '" class="btn btn-primary btn-xs">Go Back</a>');
       </script>
     </span>
   </p>

   <div class="container">
    <?php $this->load->view('edirectory_filter'); ?>

    <div class="row">      
      <div class="col-md-12"">
        <?php 
        if(count($result) != 0){
          // Profile Image
          if($result->scout_id != NULL){
            $img_url = '<img src="'.base_url('profile_img/'.$result->profile_img).'" height="150">';
          }elseif($result->image_file != NULL){
            $img_url = '<img src="'.base_url('uploads/edirectory_img/'.$result->image_file).'" height="150">';
          }else{
            $img_url = '<img src="'.base_url('uploads/edirectory_img/no-image.jpg').'" height="150">';
          }  
          ?>
          <table class="tg" style="width: 100%;">
            <tr>
              <th class="tg-ronw">Name (English): </th>
              <td class="tg-t4bo"><?=$result->name?></td>
              <td rowspan="5" valign="top"> <?=$img_url?> </td>
            </tr>
            <tr>
              <th class="tg-ronw">Name (Bangla):</th>
              <td class="tg-t4bo"><?=$result->name_bn?></td>
            </tr>
            <tr>
              <th class="tg-ronw">Scouts Designation:</th>
              <td class="tg-t4bo"><?=$result->committee_designation_name_en?></td>
            </tr>
            <tr>
              <th class="tg-ronw">Responsibility:</th>
              <td class="tg-t4bo"><?=$result->responsibility?></td>
            </tr>
            <tr>
              <th class="tg-ronw">Phone/Mobile (Personal):</th>
              <td class="tg-t4bo"><?=$result->phone?></td>
            </tr>
            <tr>
              <th class="tg-ronw">Email Address (Personal):</th>
              <td class="tg-t4bo" ><?=$result->email?></td>
            </tr>
            <tr>
              <th class="tg-ronw">Phone/Mobile (Official):</th>
              <td class="tg-t4bo" ><?=$result->phone_official?></td>
            </tr>
            <tr>
              <th class="tg-ronw">Email Address (Official):</th>
              <td class="tg-t4bo" ><?=$result->email_official?></td>
            </tr>
            <tr>
              <th class="tg-ronw">Gender:</th>
              <td class="tg-t4bo"><?=$result->gender?></td>
            </tr>
            <tr>
              <th class="tg-ronw">Blood Group:</th>
              <td class="tg-t4bo"><?=$result->bg_name_en?></td>
            </tr>
            <tr>
              <th class="tg-ronw">Present Address:</th>
              <td class="tg-t4bo" ><?=$result->address?></td>
            </tr>
            <tr>
              <th class="tg-ronw">Professional Designation:</th>
              <td class="tg-t4bo" ><?=$result->profe_desig?></td>
            </tr>
            <tr>
              <th class="tg-ronw">Other's Info:</th>
              <td class="tg-t4bo" ><?=$result->others_info?></td>
            </tr>
          </table>

          <?php }else{ ?>
          <p><?=lang('site_user_not_found')?></p>
          <?php } ?>
        </div>
      </div>      

    </div>
    <div class="py-3"></div>
  </div>
</div>