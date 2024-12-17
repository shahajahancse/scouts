<div class="row">
  <div class="col-md-12">
    <form action="<?=base_url('edirectory-search')?>" method="get" id="validation">
      <div class="row form-row">
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center">
          <div class="form-group">
            <input type="text" name="name" class="form-control input-sm" placeholder="Name">
          </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center">
          <div class="form-group">
            <input type="text" name="mobile" class="form-control input-sm"  placeholder="Mobile No">
          </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center">
          <div class="form-group">
            <input type="text" name="email" class="form-control input-sm"  placeholder="Email">
          </div>
        </div>
      </div>

      <div class="row form-row">
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center">
          <div class="form-group">
            <?php 
            $css=array( 'class' =>'form-control input-sm', 'id' =>'region' );
            echo form_dropdown('region', $regions, $region_data, $css) 
            ?>
          </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center">
          <div class="form-group">
            <?php 
            $css=array( 'class' =>'sc_district_val form-control input-sm', 'id'=>'sc_district2');
            echo form_dropdown('district', $districts, $district_data, $css) 
            ?>
          </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center">
          <div class="form-group">
            <?php 
            $css=array( 'class' =>'sc_upazila_val2 form-control input-sm');
            echo form_dropdown('upazila', $upazilas, $upazila_data, $css) 
            ?>
          </div>
        </div>
      </div>

      <div class="row form-row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center">
          <div class="form-group">
            <select name="group" class="sc_groups_val2 form-control input-sm">
              <option value=""><?=lang('site_select_scout_group')?></option>
            </select>
          </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 text-center">
          <div class="form-group">
            <button type="submit" class="btn text-white btn-block" style="background-color: #1aa326;border-radius:0px;"><?=lang('site_common_go')?></button> 
          </div>
        </div>
      </div>
    </form>
  </div>
</div>