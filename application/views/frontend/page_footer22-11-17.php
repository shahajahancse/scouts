<div class="py-2"></div>
    <div class="bg-primary clearfix pt-2 text-white" style="background-color: #904097!important;">
      <div class="container w-75">
        <div class="row justify-content-around">
          <div class="col-6">
            <ul>
              <li class="list-inline-item"><a href="<?=base_url();?>" style="color: white;">Home</a></li>
              <li class="list-inline-item"><a href="<?=base_url()?>region" style="color: white;"> Region</a></li>
              <li class="list-inline-item"><a href="<?=base_url()?>district" style="color: white;"> District</a></li>
              <li class="list-inline-item"><a href="<?=base_url()?>upazila" style="color: white;"> Upazila</a></li>
              <li class="list-inline-item"><a href="<?=base_url()?>" style="color: white;"> Services</a></li>
              <li class="list-inline-item"><a href="<?=base_url()?>complain" style="color: white;"> Complain</a></li>
              <li class="list-inline-item"><a href="#" style="color: white;"> User Guide</a></li>
            </ul>
          </div>
          <div class="col-6">
            <ul class="list-unstyled">
              <li class="title_text" style="font-size: 11px; color: #b0fa2e; text-align: right;" ><b>পরিকল্পনা ও বাস্তবায়নে:</b> এটুআই প্রধানমন্ত্রীর কার্যালয়। <img src="<?=base_url();?>fwedget/assets/images/a2i-logo.png" height="15"></li>
            </ul>
          </div>
        </div>
      </div>
    </div>  
  </div>

</body>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="<?=base_url();?>fwedget/assets/bootstrap-4.0.0-alpha.6/js/bootstrap.min.js"></script>

<script>
    // for up arrow
    $(document).ready(function(){
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

    $('#back-to-top').tooltip('show');

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
  $('#sc_region').change(function(){
      $(".sc_district_val > tr").remove();
      var id = $('#sc_region').val();
      $.ajax({
         type: "GET",
         url: "<?=base_url()?>site/ajax_get_scout_dis_data_by_region/"+id,
         dataType: "json",
         success: function(func_data)
         {
            $.each(func_data,function(id,name)
            {
               var opt ='<tr><td><a href="<?=base_url()?>district-details/'+id+'" class="text-primary">'+name+'</a></td></tr>' 
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
            $.each(func_data,function(id,name)
            {
               var opt ='<tr><td><a href="<?=base_url()?>district-details/'+id+'" class="text-primary">'+name+'</a></td></tr>' 
               $('.sc_upzila_val').append(opt);
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
          url: hostname +"site/ajax_get_district_by_div/" + id,
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
          url: hostname +"site/ajax_get_upa_tha_by_dis/" + dis_id,
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
</script> 

</html>