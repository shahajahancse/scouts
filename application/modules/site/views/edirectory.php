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

    <style type="text/css">
      .btn-danger{background-color: #734bec;border-color: #6942dc;}
      .btn-danger:hover{background-color: #5749c7;border-color: #6942dc;}
    </style>
    <div class="container">
      <?php $this->load->view('edirectory_filter'); ?>
      
      <div class="row">      
        <div class="col-md-12">
          <style type="text/css">
            .tg  {border-collapse:collapse;border-spacing:0; width: 100%}
            .tg td{font-family:Arial, sans-serif;font-size:18px;padding:4px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black; width: 48%; text-align: center; font-weight: bold; color:white; height:60px;}
            .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:4px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
            .tg .tg-t4bo{font-size:20px;background-color:#cbcefb;border-color:#9698ed;}
            .tg .tg-ronw{font-weight:bold;background-color:#9698ed;color:#000000;border-color:#6665cd;text-align:center}
            .tg .tg-t4bo a{text-align: center; font-weight: bold; color:white; display: block;}
            .tg .tg-t4bo a:hover{color:#faeee7;}
          </style>


          <table class="tg">
            <tr>
              <td class="tg-t4bo" colspan="2" style="background-color: #0e9aa7;"><a href="<?=base_url('edirectory-nhq')?>">National Headquater</a></td>
            </tr>
            <tr>
              <td class="tg-t4bo" style="background-color: #1b6ca8;"><a href="<?=base_url('edirectory-training-center')?>">Training Center & Service</a></td>
              <td class="tg-t4bo" style="background-color: #303960;"><a href="<?=base_url('edirectory-region/1')?>">Dhaka Region</a></td>          
            </tr>
            <tr>
              <td class="tg-t4bo" style="background-color: #303960;"><a href="<?=base_url('edirectory-region/2')?>">Chattogram Region</a></td>
              <td class="tg-t4bo" style="background-color: #1b6ca8;"><a href="<?=base_url('edirectory-region/3')?>">Rajshahi Region</a></td>
            </tr>
            <tr>
              <td class="tg-t4bo" style="background-color: #1b6ca8;"><a href="<?=base_url('edirectory-region/4')?>">Khulna Region</a></td>
              <td class="tg-t4bo" style="background-color: #303960;"><a href="<?=base_url('edirectory-region/5')?>">Barishal Region</a></td>
            </tr>
            <tr>
              <td class="tg-t4bo" style="background-color: #303960;"><a href="<?=base_url('edirectory-region/6')?>">Sylhet Region</a></td>
              <td class="tg-t4bo" style="background-color: #1b6ca8;"><a href="<?=base_url('edirectory-region/7')?>">Cumilla Region</a></td>
            </tr>
            <tr>
              <td class="tg-t4bo" style="background-color: #1b6ca8;"><a href="<?=base_url('edirectory-region/8')?>">Dinajpur Region</a></td>
              <td class="tg-t4bo" style="background-color: #303960;"><a href="<?=base_url('edirectory-region/9')?>">Mymensingh Region</a></td>
            </tr>
            <tr>
              <td class="tg-t4bo" style="background-color: #6a097d;"><a href="<?=base_url('edirectory-region/10')?>">Rover Region</a></td>
              <td class="tg-t4bo" style="background-color: #6a097d;"><a href="<?=base_url('edirectory-region/11')?>">Railway Region</a></td>
            </tr>
            <tr>
              <td class="tg-t4bo" style="background-color: #6a097d;"><a href="<?=base_url('edirectory-region/12')?>">Sea Region</a></td>
              <td class="tg-t4bo" style="background-color: #6a097d;"><a href="<?=base_url('edirectory-region/13')?>">Air Region</a></td>
            </tr>
          </table>

          <?php /*
          <table class="tg">
            <tr>
              <td class="tg-t4bo"><a href="<?=base_url('edirectory-nhq')?>" class="btn btn-danger btn-xs btn-block">NHQ Listing</a></td>
              <td class="tg-t4bo"><a href="<?=base_url('edirectory-training-center')?>" class="btn btn-danger btn-xs btn-block">Training Center Listing</a></td>              
            </tr>
            <tr>
              <td class="tg-t4bo"><a href="<?=base_url('edirectory-region')?>" class="btn btn-danger btn-xs btn-block">Region Listing</a></td>
              <td class="tg-t4bo"><a href="<?=base_url('edirectory-district')?>" class="btn btn-danger btn-xs btn-block">District Listing</a></td>            
            </tr>
            <tr>
              <td class="tg-t4bo"><a href="<?=base_url('edirectory-upazila')?>" class="btn btn-danger btn-xs btn-block">Upazila Listing</a></td>
              <td class="tg-t4bo"><a href="<?=base_url('edirectory-scouts-group')?>" class="btn btn-danger btn-xs btn-block">Scouts Group Listing</a></td>              
            </tr>
          </table>
          */ ?>

        </div>
      </div>      

    </div>
    <div class="py-3"></div>
  </div>
</div>