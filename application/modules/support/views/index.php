<body class="error-body no-top" style="background: url(<?=base_url('awedget/assets/img/scouts_bg.png');?>) no-repeat center center fixed; -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;">

  <style>
    .require{
      color:red;
    }
  </style>

  <div class="container">
    <div class="row login-container login_register column-seperation">
      <?php
      $attributes = array('id' => 'complain_validate');
      echo form_open(current_url(), $attributes);
      ?>
      <div class="col-md-6 col-md-offset-3 box_reg">
        <img src="<?=base_url('fwedget/assets/images/scout_logo_small.png');?>" class="box_img img-responsive">
        <h4 class="box_title">Support Request ( সাহায্যের অনুরোধ )</h4>
        <div id="infoMessage"><?php echo $message;?></div>
        <br>

        <div class="row">
          <div class="col-md-6">
            <label>Scout ID <span class="require">*</span></label>
            <?php echo form_error('scout_id')?>
            <div class="input-group">
              <span class="input-group-addon addonExtra"> <i class="fa fa-mobile"></i> </span>
              <input type="text" class="form-control" name="scout_id" id="scout_id" placeholder="Scout ID">
            </div>
          </div>

          <div class="col-md-6">
            <label>Mobile Number <span class="require">*</span></label>
            <?php echo form_error('mobile')?>
            <div class="input-group">
              <span class="input-group-addon addonExtra"> <i class="fa fa-mobile"></i> </span>
              <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile Number">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <label>Email Address </label>
            <?php echo form_error('email')?>
            <div class="input-group">
              <span class="input-group-addon addonExtra"> <i class="fa fa-mobile"></i> </span>
              <input type="text" class="form-control" name="email" id="email" placeholder="Email Address">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <label>Description <span class="require">*</span></label>
            <?php echo form_error('complain')?>
            <div class="input-group">
              <span class="input-group-addon addonExtra"> <i class="fa fa-mobile"></i> </span>
              <textarea name="complain" class="form-control" id="complain" placeholder="Description"></textarea>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6"> </div>
          <div class="col-md-6">
            <div class="input-group">
              <?php echo form_submit('submit', 'Submit', "class='btn btn-primary btn-cons pull-right'"); ?>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <a href="<?=base_url('registration')?>" class="register">Register new account  </a>
          </div>
          <div class="col-md-6">
            <a href="<?=base_url('login')?>" class="forget">Login my account</a>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
  $(document).ready(function() {
    $.validator.addMethod("noSpace", function(value, element) {
      return value.indexOf(" ") < 0 && value != "";
    }, "No space please and don't leave it empty");

    $('#complain_validate').validate({
      // focusInvalid: false,
      ignore: "",
      rules: {
        scout_id: {
          required: true,
          noSpace: true,
          minlength: 4,
          remote: {
              url: hostname +"support/ajax_exists_scout_id/",
              type: "post",
              data: {
                inputData: function() {
                  return $( "#scout_id" ).val();
                }
              }
          }
        },
        mobile:{
          required: true,
          number: true,
          minlength: 11,
          maxlength: 11
        },
        complain:{
          required: true,
        },
      },

      messages: {
        scout_id: {
          required: "Enter Scout ID.",
          minlength: jQuery.format("Enter at least {4} characters"),
          remote: jQuery.format("Sorry, this ID is not Found! Please try again.")
        }
      },

      invalidHandler: function (event, validator) {
        //display error alert on form submit
      },

      errorPlacement: function (label, element) { // render error placement for each input type
        $('<span class="error" style="position: absolute; top:38px;"></span>').insertAfter(element).append(label)
        var parent = $(element).parent('.input-with-icon');
        parent.removeClass('success-control').addClass('error-control');
      },

      highlight: function (element) { // hightlight error inputs
        var parent = $(element).parent();
        parent.removeClass('success-control').addClass('error-control');
      },

      unhighlight: function (element) { // revert the change done by hightlight
      },

      success: function (label, element) {
        var parent = $(element).parent('.input-with-icon');
        parent.removeClass('error-control').addClass('success-control');
      },

      submitHandler: function (form) {
        form.submit();
      }
    });
  });
</script>
