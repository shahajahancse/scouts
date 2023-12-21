<div class="page-content">
  <div class="content">
    <div class="page-title"> </div>    
    <div class="row">  
      <div class="col-md-12" style="color: black;">
        <h2>Welcome, <strong><?php echo $this->session->userdata('first_name')?></strong></h2>
        
        <div class="alert alert-block alert-success fade in">        
          <h4 class="alert-heading"><i class="icon-warning-sign"></i> Thank You! Your request sent successfully.</h4>
          <p> Please, wait for your approval.</p>
          <div class="button-set">
            <a class="btn btn-white btn-cons" href="<?=base_url('my-submitted-information');?>">My submitted information</a>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>