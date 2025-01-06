<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url('news_list')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <style>
      .table-responsive {
        width: 100%;
        margin-bottom: 15px;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
      }

      .table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 1rem;
      }

      .table th,
      .table td {
        padding: 12px;
        text-align: left;
        border: 1px solid #dee2e6;
        vertical-align: middle;
      }

      .table th {
        background: #f8f9fa;
        font-weight: 600;
        white-space: nowrap;
      }

      .table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
      }

      .table tbody tr:hover {
        background-color: #f5f5f5;
      }

      .grid-title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 15px;
      }

      @media screen and (max-width: 767px) {
        .table th, 
        .table td {
          white-space: nowrap;
          min-width: 120px;
          font-size: 14px;
        }

        .grid-title {
          flex-direction: column;
          gap: 10px;
        }

        .grid-title .pull-right {
          width: 100%;
          text-align: center;
        }

        .btn {
          width: 100%;
          margin-bottom: 5px;
        }
      }
    </style>

    <div class="row-fluid">
      <div class="span12">
        <div class="grid simple">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('scout_news/create_news')?>" class="btn btn-blueviolet btn-xs btn-mini"> Create News </a>
            </div>
          </div>

          <div class="grid-body">
            <div id="infoMessage"><?php //echo $message;?></div>            
            <?php if($this->session->flashdata('success')):?>
                <div class="alert alert-success">
                    <?php echo $this->session->flashdata('success');?>
                </div>
            <?php endif; ?>
            <div class="table-responsive">
              <table class="table table-hover table-condensed" id="example">
                <thead>
                  <tr>
                    <th style="width:2%"> SL </th>
                    <th style="width:40%">News Title</th>
                    <th style="width:15%">Attachment</th>
                    <th style="width:10%">Date</th>
                    <th style="width:10%">Status</th>
                    <th style="width:25%" class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(!empty($results)){
                    $i=0;
                    foreach ($results as $row) {
                      if($row->status==1){
                        $status = '<span class="btn btn-success btn-xs btn-mini"> Enable </span>';
                      }else{
                        $status = '<span class="btn btn-info btn-xs btn-mini"> Disable </span>';
                      }

                      $file='';
                      if($row->attachment_file){
                        $file = '<a href="'.base_url('uploads/news_file/'.$row->attachment_file).'" download="'.$row->attachment_file.'" class="btn btn-mini btn-xs btn-success" style="margin-bottom:2px;">'.$row->attachment_file.'</a>';
                      }
                  ?>
                    <tr>
                      <td class="v-align-middle"><?=++$i?></td>
                      <td class="v-align-middle"><strong><a href="<?=base_url('scout_news/details/'.$row->id);?>"><?=$row->news_title?></a></strong></td>
                      <td class="v-align-middle"><?php echo $file; ?></td>
                      <td class="v-align-middle"><?=date_bangla_format($row->created)?></td>
                      <td class="v-align-middle"><?=$status?></td>
                      <td class="text-center">
                        <a href="<?=base_url('scout_news/details/'.$row->id);?>" class="btn btn-primary btn-xs btn-mini">Details</a>     
                        <?php if($this->ion_auth->is_admin()){ ?> 
                          <a href="<?=base_url('scout_news/edit/'.$row->id);?>" class="btn btn-success btn-xs btn-mini">Edit</a>
                          <a href="<?=base_url('scout_news/delete/'.$row->id);?>" class="btn btn-info btn-xs btn-mini" onclick="return confirm('Are you sure you want to delete this News?');">Delete</a>
                        <?php } ?>
                      </td>
                    </tr>
                      <?php
                    }
                  }?>              
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>