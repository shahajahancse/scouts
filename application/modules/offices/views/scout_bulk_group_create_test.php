<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('offices/scout_group')?>" class="active"><?=$module_name?> </a> </li>
         <li><?=$meta_title; ?></li>
      </ul>
      <style type="text/css">
         #memberDiv td{padding: 5px;}
      </style>
      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin()){ ?>
                  <div class="pull-right">                
                     <a href="<?=base_url('offices/scout_group')?>" class="btn btn-blueviolet btn-xs btn-mini"> Scout Group List</a>  
                  </div>
                  <?php } ?>
               </div>
               <div class="grid-body">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>
                  <?php 
                  // echo validation_errors();
                  // $attributes = array('id' => 'scout_group_validate');
                  // echo form_open_multipart("offices/scout_bulk_group_create", $attributes);
                  ?>


                  <form class="commentForm" method="get" action="">
                     <div>

                        <p id="inputs">    
                           <input class="comment" name="name0" />
                        </p>

                        <input class="submit" type="submit" value="Submit" />
                        <input type="button" value="add" id="addInput" />

                     </div>
                  </form>



                 <!--  <div class="form-actions">  
                     <div class="pull-right">
                        <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Save</button>
                     </div>
                  </div> -->
                  <?php //echo form_close();?>

               </div>  <!-- END GRID BODY -->              
            </div> <!-- END GRID -->

         </div>
      </div> <!-- END ROW -->

   </div>
</div>
<script>
   $(document).ready(function() {
        var numberIncr = 1; // used to increment the name for the inputs

        function addInput() {
         $('#inputs').append($('<input class="comment" name="name'+numberIncr+'" />'));
         numberIncr++;
      }

      $('form.commentForm').on('submit', function(event) {

            // adding rules for inputs with class 'comment'
            $('input.comment').each(function() {
               $(this).rules("add", 
               {
                  required: true, 
                  number: false,
                  remote: {
                     url: hostname +"offices/ajax_exists_identity/",
                     type: "post",
                     data: {
                        inputData: function() {
                           return $( ".comment" ).val();
                        }
                     }  
                  } 
               })
            });            

            // prevent default submit action         
            event.preventDefault();

            // test if form is valid 
            if($('form.commentForm').validate().form()) {
               console.log("validates");
            } else {
               console.log("does not validate");
            }
         });

        // set handler for addInput button click
        $("#addInput").on('click', addInput);

        // initialize the validator
        $('form.commentForm').validate();

     });


  </script>
