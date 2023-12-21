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
   .title{font-size: 18px; text-align: left; font-weight: bold;}
   .line{width: 80%}

   .noBorder table {  
      border: none;
   }
   .noBorder td {  
      border: none;
      font-size: 18px;
   }
   .noBorder th {  
      border: none;
   }
</style>

<div class="page-content" style="background-color: #6067e8; padding: 100px 50px 50px 50px;">     
   <div class="content" style="width: 700px; "> 

      <div style="border-bottom: 1px solid #ccc; padding-top: 50px; background-color: white;">
         <div style="margin-left: 70px; width: 80px; height: 70px; float: left; border: 0px solid red;">
            <img src="<?=FCPATH?>fwedget/assets/images/bd-scouts-logo.png" height="70">
         </div>
         <div style="font-size: 22px; font-weight: bold; ">
            <span style="font-size: 30px; font-weight: bold;"><?php echo $info->region_name; ?></span><br>
            <?php echo $info->region_name_en; ?>
         </div>
         <div style="clear: both;"></div>

         <div style="margin-top: 80px; text-align: center; border: 0px solid red; font-size: 25px; font-weight: bold;"><u>গ্রুপ রেজিস্ট্রেশন চার্টার</u></div>

         <div style="margin: 40px 20px 20px 20px; border-bottom:1px solid #ccc; text-align: center;  font-size: 18px;"><?php echo $info->grp_name_bn; ?></div>

         <div style="margin: 0px 20px 20px 20px; border-bottom:1px solid #ccc; text-align: center;  font-size: 18px;"><?php echo $info->grp_address; ?></div>

         <br><br>

         <div style="text-align: center; font-size: 18px;"> <?php echo $info->grp_name_bn; ?> এর সাথে তালিকাভুক্ত করা হলো।</div>
         <br><br><br><br>

         <div style="width: 200px; float: left; margin-left: 50px; font-size: 16px;">
            গ্রুপ নম্বরঃ <?php echo eng2bng($info->grp_reg_num_dis); ?><br>
            চার্টার নম্বরঃ <?php echo $info->grp_charter; ?><br>
            তারিখঃ <?php echo date_bangla_calender_format($info->grp_created); ?>
         </div>
         <div style="width: 200px; float: right; margin-top: 50px; margin-right: 50px; text-align: center;">
            সম্পাদক<br>
            <?php echo $info->region_name; ?>
         </div>
         <br><br>
      </div>

   </div>
</div>