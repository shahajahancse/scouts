         <!-- </div> -->
      </div> <!-- main row -->
   </div>
   <div class="pt-3"></div>

   <style>
      @media only screen and (max-width: 768px) {
         .design-class {
            text-align-last: center;
         }
         .img-dg {
            height: auto;
         }
      }

   </style>

   <!-- footer -->
   <div class="footer">

      <div class="container w-75">
         <div class="row design-class">
            <div class="col-md-2">
               <ul class="fa-ul text-left">
                  <h6 class="font-weight-bold"><?=lang('site_footer_home')?></h6>
                  <li><a href="http://scouts.portal.gov.bd/site/page/26244d7a-166d-4dd8-86f0-6895af07cb9b/জাতীয়-সদর-দফতর" target="_blank" class="card-link" ><?=lang('site_footer_home_about_us')?></a></li>
                  <li><a href="<?=base_url('contact')?>" class="card-link" target="_blank"><?=lang('site_footer_home_contact')?></a></li>
               </ul>
            </div>

            <div class="col-md-2">
               <ul class="fa-ul text-left">
                  <h6 class="font-weight-bold"><?=lang('site_footer_user_manual')?></h6>
                  <li><a href="<?=base_url('user-manual')?>" class="card-link" ><?=lang('site_footer_user_manual_manual')?></a></li>
                  <li><a href="<?=base_url('faqs')?>" class="card-link" ><?=lang('site_footer_user_manual_ask')?></a></li>
               </ul>
            </div>

            <div class="col-md-3">
               <ul class="fa-ul text-left">
                  <h6 class="font-weight-bold"><?=lang('site_footer_other_link')?></h6>
                  <li><a href="<?=base_url('organogram')?>" class="card-link" ><?=lang('site_footer_organogram')?></a></li>
                  <li><a href="<?=base_url('scout-group-application')?>" class="card-link"><?=lang('site_footer_group_application')?> </a></li>
               </ul>
            </div>

            <div class="col-md-5">
               <h6 class="font-weight-bold" style="text-align: right;"><?=lang('site_footer_planning_and_implementing')?></h6>
               <div class="row">
                  <div class="clearfix"></div>
                  <div class="col-md-4 text-left" style="padding: 0;">
                     <ul class="list-inline" style="margin-bottom: 0; padding-bottom:5px; ">
                        <li class="list-inline-item"><a href="https://a2i.gov.bd/" target="_blank" style="padding: 0px 0px;"><img src="<?=base_url();?>fwedget/assets/images/a2i_logo.png" height="20"></a></li>
                        <li class="list-inline-item"><a href="https://ictd.gov.bd/" target="_blank" style="padding-left: 0px;"><img src="<?=base_url();?>fwedget/assets/images/logo_ict.png" width="55"></a></li>
                     </ul>
                     <?=lang('site_footer_a2i_Program')?>
                  </div>
                  <div class="col-md-4 text-left" style="border-left:1px solid #ccc; padding: 0 0 0 5px;">
                     <ul class="list-inline" style="margin-bottom: 0; padding-bottom:5px; ">
                        <li class="list-inline-item"><a href="http://www.scouts.gov.bd/" target="_blank" style="padding-left: 0px;"><img src="<?=base_url();?>fwedget/assets/images/bd_scout_logo.png" height="20"></a></li>
                     </ul>
                     <?=lang('site_footer_scouts_logo')?>
                  </div>

                  <div class="col-md-4 text-right" style="padding: auto 0;">
                   <!--   <ul class="list-inline" style="margin-bottom: 0; padding-bottom:5px; ">
                        <li class="list-inline-item"><a href="http://mysoftheaven.com/" target="_blank" style="padding-left: 0px;"><img src="<?=base_url();?>fwedget/assets/images/mysoftheaven_bd_ltd_logo.png" height="20"></a></li>
                     </ul> -->
                     <span style="display: flex;flex-direction: column;align-items: center;margin-top: 17px;gap: 6px;">
                        Developed By
                      <a href="http://mysoftheaven.com/" target="_blank" style="padding-left: 0px;"><img class="img-dg" src="<?=base_url();?>fwedget/assets/images/mysoftheaven_bd_ltd_logo.png" height="20"></a>

                     </span>
                  </div>
               </div>

               <!-- <div style="border-left: 1px solid #7030a0; margin-left: 20px; float: left;height: 55px;"></div> -->
            </div>
            <br><br>
         </div>
      </div>
      <!-- end of row -->
   </div>
   <!-- end of container -->
</div>
<!-- end of footer -->

<!-- end of footer -->
<div class="footer-bottom">
   <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span class="fa fa-chevron-circle-up"></span></a>
</div>

</div> <!-- end of sc_main_container -->

</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="<?=base_url();?>fwedget/assets/bootstrap-4.0.0-alpha.6/js/bootstrap.min.js"></script>
<script src="<?=base_url();?>awedget/assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>

<!-- END PAGE LEVEL PLUGINS -->
<!-- <script src="<?=base_url();?>fwedget/assets/js/cuntom.js"></script> -->

<script src="<?=base_url('fwedget/assets/js/vTracker1.21.js');?>"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
<script>
   baguetteBox.run('.tz-gallery');
</script>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-KJS3N7B2XV"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-KJS3N7B2XV');
</script>

<script>


   // for up arrow
   $(document).ready(function(){
      $(function() {
        $('#example').vTicker();
      });

      $(window).scroll(function () {
         if ($(this).scrollTop() > 50) {
            $('#back-to-top').fadeIn();
         } else {
            $('#back-to-top').fadeOut();
         }
      });

      // scroll body to 0px on click
      $('#back-to-top').click(function () {
         $('#back-to-top').tooltip('hide');
         $('body,html').animate({
            scrollTop: 0
         }, 800);
         return false;
      });

      // $('#back-to-top').tooltip('show');

   });
</script>

<script type="text/javascript">
   $('#region').change(function(){
      $('.sc_district_val').addClass('form-control input-sm');
      $(".sc_district_val > option").remove();
      var id = $('#region').val();

      $.ajax({
         type: "GET",
         url: "<?=base_url()?>site/ajax_get_scout_dis_by_region/"+id,
         dataType: "json",
         success: function(func_data)
         {
            $.each(func_data,function(id,name)
            {
               var opt = $('<option />');
               opt.val(id);
               opt.text(name);
               $('.sc_district_val').append(opt);
            });
         }
      });
   });
</script>

<script type="text/javascript">
   $('#region2').change(function(){
      $(".sc_district_val2 > option").remove();
      var id = $('#region2').val();

      $.ajax({
         type: "GET",
         url: "<?=base_url()?>site/ajax_get_scout_dis_by_region/"+id,
         dataType: "json",
         success: function(func_data)
         {
            $.each(func_data,function(id,name)
            {
               var opt = $('<option />');
               opt.val(id);
               opt.text(name);
               $('.sc_district_val2').append(opt);
            });
         }
      });
   });
</script>

<script type="text/javascript">
   $('#sc_district2').change(function(){
      $(".sc_upazila_val2 > option").remove();
      var id = $('#sc_district2').val();

      $.ajax({
         type: "GET",
         url: "<?=base_url()?>site/ajax_get_scout_upazila_thana_by_district/"+id,
         dataType: "json",
         success: function(func_data)
         {
            $.each(func_data,function(id,name)
            {
               var opt = $('<option />');
               opt.val(id);
               opt.text(name);
               $('.sc_upazila_val2').append(opt);
            });
         }
      });

      // group
      $('.sc_groups_val2').addClass('form-control input-sm');
      $(".sc_groups_val2 > option").remove();
      // var id = $('#sc_district2').val();
      // alert(id);
      $.ajax({
         type: "POST",
         url: "<?=base_url()?>site/ajax_get_scout_group_data_by_district/"+id,
         dataType: "json",
         success: function(func_data)
         {
            $.each(func_data,function(id,name)
            {
               var opt = $('<option />');
               opt.val(id);
               opt.text(name);
               $('.sc_groups_val2').append(opt);
            });
         }
      });

   });

  // $('#sc_district2').change(function(){
  //     $(".sc_group_val > tr").remove();
  //     var id = $('#sc_district2').val();
  //     $.ajax({
  //        type: "GET",
  //        url: "<?=base_url()?>site/ajax_get_scout_group_data_by_district/"+id,
  //        dataType: "json",
  //        success: function(func_data)
  //        {
  //         var i=0;
  //           $.each(func_data,function(id,name)
  //           {
  //             i=i+1;
  //              var opt ='<tr><td width="5%">'+convertlan(i)+'</td><td><a href="<?=base_url()?>groups-details/'+id+'" style="color:#000;">'+name+'</a></td></tr>'
  //              $('.sc_group_val').append(opt);
  //           });
  //        }
  //     });
  //  });
</script>

<script type="text/javascript">
   $('#sc_upazila2').change(function(){
      $(".sc_groups_val2 > option").remove();
      var id = $('#sc_upazila2').val();

      $.ajax({
         type: "GET",
         url: "<?=base_url()?>site/ajax_get_scout_group_by_upazila/"+id,
         dataType: "json",
         success: function(func_data)
         {
            $.each(func_data,function(id,name)
            {
               var opt = $('<option />');
               opt.val(id);
               opt.text(name);
               $('.sc_groups_val2').append(opt);
            });
         }
      });
   });
</script>

<script type="text/javascript">
   $('#sc_region').change(function(){
      $(".sc_district_val > tr").remove();
      var id = $('#sc_region').val();
      $.ajax({
         type: "GET",
         url: "<?=base_url()?>site/ajax_get_scout_dis_data_by_region/"+id,
         dataType: "json",
         success: function(func_data)
         {
            var i=0;
            $.each(func_data,function(id,name)
            {
               i=i+1;
               var opt ='<tr><td width="5%">'+convertlan(i)+'</td><td><a href="<?=base_url()?>district-details/'+id+'" style="color:#000;">'+name+'</a></td></tr>'
               $('.sc_district_val').append(opt);
            });
         }
      });
   });
</script>

<script type="text/javascript">
   $('#sc_district').change(function(){
      $(".sc_upzila_val > tr").remove();
      var id = $('#sc_district').val();
      $.ajax({
         type: "GET",
         url: "<?=base_url()?>site/ajax_get_scout_upazila_thana_data_by_district/"+id,
         dataType: "json",
         success: function(func_data)
         {
            var i=0;
            $.each(func_data,function(id,name)
            {
               i=i+1;
               var opt ='<tr><td width="5%">'+ convertlan(i) +'</td><td><a href="<?=base_url()?>upazila-details/'+id+'" style="color:#000;">'+name+'</a></td></tr>'
               $('.sc_upzila_val').append(opt);
            });
         }
      });
   });

   $('#sc_upazila').change(function(){
      $(".sc_group_val > tr").remove();
      var id = $('#sc_upazila').val();
      $.ajax({
         type: "GET",
         url: "<?=base_url()?>site/ajax_get_scout_group_data_by_upazila/"+id,
         dataType: "json",
         success: function(func_data)
         {
            var i=0;
            $.each(func_data,function(id,name)
            {
               i=i+1;
               var opt ='<tr><td width="5%">'+convertlan(i)+'</td><td><a href="<?=base_url()?>groups-details/'+id+'" style="color:#000;">'+name+'</a></td></tr>'
               $('.sc_group_val').append(opt);
            });
         }
      });
   });

   $('#sc_groups').change(function(){
      $(".sc_unit_val > tr").remove();
      var id = $('#sc_groups').val();
      $.ajax({
         type: "GET",
         url: "<?=base_url()?>site/get_sc_unit_data_by_scout_group_id/"+id,
         dataType: "json",
         success: function(func_data)
         {
            var i=0;
            $.each(func_data,function(id,name)
            {
               i=i+1;
               var opt ='<tr><td width="5%">'+ convertlan(i) +'</td><td><a href="<?=base_url()?>unit-details/'+id+'" style="color:#000;">'+name+'</a></td></tr>'
               $('.sc_unit_val').append(opt);
            });
         }
      });
   });

   //district dropdown
   $('#division').change(function(){
      $('.distirict_val').addClass('form-control input-sm');
      $(".distirict_val > option").remove();
      var id = $('#division').val();
      $.ajax({
         type: "GET",
         url: "<?=base_url()?>site/ajax_get_district_by_div/" + id,
         dataType: "json",
         success: function(func_data)
         {
            $.each(func_data,function(id,name)
            {
               var opt = $('<option />');
               opt.val(id);
               opt.text(name);
               $('.distirict_val').append(opt);
            });
         }
      });
   });

   // Upazila / Thana dropdown
   $('#district').change(function(){
      $('.upazila_thana_val').addClass('form-control input-sm');
      $(".upazila_thana_val > option").remove();
      var dis_id = $('#district').val();
      $.ajax({
         type: "GET",
         url: "<?=base_url()?>site/ajax_get_upa_tha_by_dis/" + dis_id,
         dataType: "json",
         success: function(upazilaThanas)
         {
            $.each(upazilaThanas,function(id,ut_name)
            {
               var opt = $('<option />');
               opt.val(id);
               opt.text(ut_name);
               $('.upazila_thana_val').append(opt);
            });
         }
      });
   });

   function convertlan(i){
      <?php if($this->session->userdata('site_lang')=='bangla'){ ?>
         var bangla_converted_number=String(i).getDigitBanglaFromEnglish();
         <?php }else{ ?>
            var bangla_converted_number=i;
            <?php  } ?>
            return bangla_converted_number;
         }

         var finalEnlishToBanglaNumber={'0':'০','1':'১','2':'২','3':'৩','4':'৪','5':'৫','6':'৬','7':'৭','8':'৮','9':'৯'};

         String.prototype.getDigitBanglaFromEnglish = function() {
            var retStr = this;
            for (var x in finalEnlishToBanglaNumber) {
               retStr = retStr.replace(new RegExp(x, 'g'), finalEnlishToBanglaNumber[x]);
            }
            return retStr;
         };
      </script>

      <script>
         $(".pagination li.page-item a").addClass("page-link");
      </script>

      </html>
