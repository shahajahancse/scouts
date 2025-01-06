<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url('e_book')?>" class="active"> <?=$module_title; ?> </a></li>
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

      .search-form {
        display: flex;
        gap: 10px;
        margin-bottom: 15px;
        flex-wrap: wrap;
      }

      .pagination-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 20px;
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
        }

        .grid-title .pull-right .btn {
          width: 100%;
        }

        .search-form {
          flex-direction: column;
        }

        .search-form .col-md-2,
        .search-form .col-md-1 {
          width: 100%;
        }

        .search-form .btn {
          width: 100%;
        }

        .pagination-wrapper {
          flex-direction: column;
          text-align: center;
        }
      }
    </style>

    <div class="row-fluid">
      <div class="span12">
        <div class="grid simple ">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('e_book/create')?>" class="btn btn-blueviolet btn-xs btn-mini"> Add E-Book </a>
            </div> 
          </div>

          <div class="grid-body ">
            <div id="infoMessage"><?php //echo $message;?></div>            
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');?>
              </div>
            <?php endif; ?>

            <?php if($message != NULL):?>
              <div class="alert alert-danger">                      
                <?php echo $message;?>
              </div>
            <?php endif; ?>

            <form method="get" action="" class="search-form">
              <div class="col-md-2">
                <?php $more_attr = 'class="form-control input-sm"';
                echo form_dropdown('category', $ebook_category, $_GET['category'], $more_attr);
                ?>
              </div>
              <div class="col-md-1">
                <button type="submit" class="btn btn-blueviolet btn-mini"><i class="icon-ok"></i> Search</button>
              </div>
            </form>

            <div class="table-responsive">
              <table class="table table-hover table-condensed">
                <thead>
                  <tr>
                    <th width="20"> SL </th>
                    <th>E-Book Title</th>
                    <th>Category</th>
                    <th width="130">Cover Image</th>
                    <th width="100">PDF File</th>
                    <th width="60">Status</th>
                    <th width="110" class="text-right">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(!empty($results)){
                    $i=$pagination['current_page'];
                    foreach ($results as $row) {
                      // Book Cover
                      $path = base_url('uploads/ebook/thumbs/');
                      if($row->image_file != NULL){
                        $img_url = '<img src="'.$path.$row->image_file.'" height="30">';
                      }else{
                        $img_url = '<img src="'.$path.'default.jpg" height="30">';
                      }

                      // PDF File
                      if($row->pdf_file!=NULL){
                        $pdf_path = base_url('uploads/ebook/pdf/'.$row->pdf_file);
                        $pdfFile = '<a href="'.$pdf_path.'" target="_blank" class="btn btn-danger btn-xs btn-mini">Browse PDF</a>';
                      }else{
                        $pdfFile = '<a href="'.base_url('e_book/upload_pdf/'.$row->id).'" class="btn btn-primary btn-xs btn-mini">Add PDF</a>   ';
                      }

                      // Status
                      if($row->status==1){
                        $status = '<span class="btn btn-success btn-xs btn-mini"> Enable </span>';
                      }else{
                        $status = '<span class="btn btn-info btn-xs btn-mini"> Disable </span>';
                      }
                      ?>

                      <tr>
                        <td class="v-align-middle"><?=++$i?>.</td>
                        <td class="v-align-middle"><strong><?=$row->book_title?></strong></td>
                        <td class="v-align-middle"><?=$row->category_name_en?></td>
                        <td class="v-align-middle"><?=$img_url?></td>
                        <td class="v-align-middle"><?=$pdfFile?></td>
                        <td class="v-align-middle"><?=$status?></td>
                        <td align="right">
                         <div class="btn-group"> <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> Action <span class="caret"></span> </a>
                          <ul class="dropdown-menu pull-right">
                            <li><a href="<?=base_url('e_book/edit/'.$row->id);?>">Edit E-Book</a></li>
                            <li><a href="<?=base_url('e_book/delete/'.$row->id);?>" onclick="return confirm('Are you sure you want to delete this ebook?');">Delete E-Book</a></li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                    <?php
                  }
                }?>              
              </tbody>
            </table>
          </div>

          <div class="pagination-wrapper">
            <div class="text-left">
              Total <span style="color: green; font-weight: bold;"><?php echo $total_rows; ?> Total Book </span>
            </div>
            <div class="text-right">
              <?php echo $pagination['links']; ?>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

</div> <!-- END ROW -->

</div>
</div>