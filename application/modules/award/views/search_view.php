<style type="text/css">
   .marTopSearch {
      margin-top: 10px;
   }

   @media screen and (max-width: 767px) {
      .search-form .row > div {
         margin-bottom: 10px;
      }

      .search-form .btn {
         width: 100%;
      }

      .download-buttons {
         display: flex;
         flex-direction: column;
         gap: 5px;
         margin-top: 10px;
      }

      .download-buttons .btn {
         width: 100%;
      }
   }
</style>

<form method="get" action="" class="search-form">
   
   <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ ?>                     
   <div class="row">
      <div class="col-md-3 col-sm-6">
         <?php $more_attr = 'class="form-control input-sm" id="region"';
         echo form_dropdown('region', $regions, $_GET['region'], $more_attr);
         ?>
      </div>     
      <div class="col-md-3 col-sm-6">
         <select name="district" class="sc_district_val form-control input-sm" id="sc_district">
            <option value="">-- Scouts District --</option>
         </select>
      </div>     
      <div class="col-md-3 col-sm-6">
         <select name="upazila" class="sc_upazila_thana_val form-control input-sm" id="sc_upazila_thana">
            <option value="">-- Scouts Upazila --</option>
         </select>
      </div>           
      <div class="col-md-3 col-sm-6"> 
         <select name="group" class="sc_group_val form-control basic-select2 input-sm">
            <option value="">-- Scouts Group --</option>
         </select>
      </div>
   </div>

   <div class="row">
      <div class="col-md-3 col-sm-6 marTopSearch">
         <select name="gender" class="form-control input-sm">
            <option value="">-- Gender --</option>
            <option value="Male" <?= $_GET['gender']=='Male'?'selected':''; ?>>Male</option>
            <option value="Female" <?= $_GET['gender']=='Female'?'selected':''; ?>>Female</option>
            <option value="Others" <?= $_GET['gender']=='Others'?'selected':''; ?>>Others</option>
         </select>
      </div>
      <div class="col-md-3 col-sm-6 marTopSearch">
         <?php $more_attr = 'class="form-control input-sm"';
         echo form_dropdown('year', $years, $_GET['year'], $more_attr);
         ?>
      </div>
      <div class="col-md-1 col-sm-12 marTopSearch">
         <button type="submit" class="btn btn-blueviolet btn-mini"><i class="icon-ok"></i> Search</button>
      </div>

      <div class="col-md-3 col-sm-12 marTopSearch">
         <?php if (!empty($_GET['region']) || !empty($_GET['gender']) || !empty($_GET['year'])) { ?>
         <div class="download-buttons">
            <a href="<?= $download_url ?>" class="btn btn-primary btn-xs btn-mini">PDF Download</a>
         </div>
         <?php } ?>            
      </div>
   </div>

   <?php } ?>

</form>

<div class="clearfix"></div>
<hr>