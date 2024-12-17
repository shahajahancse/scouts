<?php 
// echo '<pre>';
// print_r($info); exit;
$pds_id = $info->pds_id;
// $blood_group = $info->bg_name_en;
$blood_group = $info->bg_name_en;
$name = $info->first_name;
$designation = $info->designation_name_en;

// $working_area = $info->current_working_area;

if($info->office_id_type == 1){
  $expire_date = date('d F, Y', strtotime($expiry->professional));  
}else{
  $expire_date = date('d F, Y', strtotime($expiry->volunteer));  
}


//Profile image
$profile_img_url = '';
$path = FCPATH.'profile_img/';
if($info->profile_img != NULL){
  $profile_img_url = $path.$info->profile_img;
}else{
  $profile_img_url = $path.'no-image.png';
}

//Scouts member section
// $member_type_section = '';
// if($info->member_id == 2){
//   if($info->sc_section_id <= 3){
//     $member_type_section = get_scout_section($info->sc_section_id);
//   }else{
//     $member_type_section = '';
//   }
// }elseif($info->member_id == 8){
//   $member_type_section = 'Adult Leader';
// }elseif($info->member_id == 9){
//   $member_type_section = 'Professional Executive';
// }elseif($info->member_id == 10){
//   $member_type_section = $info->role_type_name_en;
// }elseif($info->member_id == 12){
//   $member_type_section = $info->role_type_name_en;
// }elseif($info->member_id == 13){
//   $member_type_section = 'Support Staff';
// }

//echo $full_pre_add; exit;
//echo 'hello'; exit;
//echo FCPATH; exit;

$father = $info->father_name;
$mother = $info->mother_name;
$phone = $info->phone;
$issue_date = date('d F, Y', strtotime($info->created_on)); 
// $dob = $info->dob != '0000-00-00' ? date('d F, Y', strtotime($info->dob)): '';

$qr_img = $info->qr_img;
$path = FCPATH.'emp_qrcode_img/';

//QR Code image
if($qr_img != NULL){
  $qr_img_url = $path.$qr_img;
}

$full_pre_add = $info->present_address;
?> 


<!DOCTYPE html>
<html>
<head>
  <title>Download or Save PDS ID Card</title> 
</head>
<body>  
  <div height="100%" width="100%" style="background: #FFFFFF
  url('<?=FCPATH?>awedget/assets/img/id_card/pds-front.png'); background-repeat: no-repeat; background-image-resolution: 72dpi; border: 0px solid black;">

<div style="float: left; width: 800px; padding-top: 20px; border: 0px solid white;">
  <div style="border: 0.2mm solid purple; margin: 230px 0 0 290px; border-radius: 20mm; width: 80mm; height: 15mm; padding: 1mm; font-family: arial; font-size: 40pt; color: white; background-color: purple; font-kerning: auto;  font-weight: bold; text-align: center;">
      <?=$pds_id?>
    </div> 
</div>
  
  <div style="float: left;border: 0px solid red; width: 700px;">
  <img src="<?=$profile_img_url ?>" style="height: 350px; width: 350px;margin: 20px 0 0 265px;padding: 3px;border: 2px solid black;" >
  </div>

  <div style="clear: both;"></div>

  <div style=" width: 780px; padding-left: 50px; border: 0px solid red;">
      <div style="border:0px solid black; margin: 10px 0 0 0px; width: 230mm; font-size: 30pt;color: black; font-family: arial;font-weight: bold; text-align: center;"><?=$name?></div>
      <div style="border: 0px solid black; margin: 0px 0 0 0px; width: 230mm;; font-size: 27pt;color: black; font-family: arial; text-align: center;"><?=$designation?></div>
      <div style="border: 0px solid black; margin: 0px 0 0 0px; width: 230mm; font-size: 27pt;color: black; font-family: arial;text-align: center;">Blood Group: <span style="color: red;font-weight: bold;"><?=$blood_group?></span></div>
    </div>

    <div style="float: left;border: 0px solid yellow; width: 800px;">
    <div style="border: 0px solid red; margin:10px 0px 0 500px; padding-top: 0px; width: 300px; height: 300px;">
      <?php if($info->qr_img != NULL){?>
      <img src="<?=$qr_img_url; ?>" style="height: 380px; width: 380px" >
      <?php } ?>  
    </div>
  </div>

  <div style="border: 0px solid black; height: 50px; margin-top: 32px; margin-right: 55px; font-family: arial; font-weight: bold; color: black; float: right; text-align: right;">
      <span style="border: 0px solid black; font-size: 25pt;"> <?=$expire_date?> </span>
    </div>

<?php /*
  <div style="float: left;border: 0px solid yellow; position: absolute;border: 1px solid red;">
    <div style="border: 0px solid black; margin-left:760px; padding-top:110px; width: 30mm; height: 20mm; font-size: 30pt; color: white; font-weight: bold;"><?=$blood_group?></div>

    

    <div style="border: 0px solid black; height: 50px; margin-top: 10px; margin-right: 40px; font-size: 33pt; font-family: arial; font-weight: bold; color: red; float: right; text-align: right;">
      <span style="border: 0px solid black; font-size: 33pt;"> <?=$expire_date?> </span>
    </div>
  </div>
*/ ?>

</div>

</body>
</html>