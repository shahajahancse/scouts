<div class="page-content">
   <div class="content">
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url( 'dashboard' )?>" class="active"> Dashboard </a> </li>
         <li> <a href="javascript:void()" class="active"><?=$module_name?> </a></li>
         <li><?=$meta_title;?> </li>
      </ul>

      <style>
         @media (max-width: 767px) {
            .table-responsive {
               overflow-x: auto;
               -webkit-overflow-scrolling: touch;
            }

            .btn-group {
               display: flex;
               flex-direction: column;
            }

            .btn-mini {
               margin-bottom: 5px;
               width: 100%;
            }

            .grid-title h4 {
               text-align: center;
            }

            .pdf-download {
               float: none !important;
               text-align: center;
               margin: 10px 0;
            }

            .pdf-download .btn {
               display: inline-block;
            }
         }
      </style>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple ">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title;?></span></h4>
                  <?php if ( $this->ion_auth->is_admin() ) {?>
                  <div class="pull-right">
                     <a href="<?=base_url( 'offices/region_create' )?>" class="btn btn-blueviolet btn-xs btn-mini">Create Region</a>
                  </div>
                  <?php }?>
               </div>

               <div class="grid-body ">
                  <?php if ( $this->session->flashdata( 'success' ) ): ?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata( 'success' );?>
                     </div>
                  <?php endif;?>
<?php if ( $this->session->flashdata( 'warning' ) ): ?>
                     <div class="alert alert-warning">
                        <?=$this->session->flashdata( 'warning' );?>
                     </div>
                  <?php endif;?>

                  <div class="pdf-download">
                     <a href="<?=base_url( 'Offices/region_pdf' )?>" class="btn btn-primary btn-xs btn-mini">PDF Download</a>
                  </div>

                  <div class="table-responsive">
                     <table class="table table-hover table-condensed">
                        <thead>
                           <tr>
                              <th style="width:2%"> SL </th>
                              <th style="width:35%">Region Name</th>
                              <th style="width:15%">Username</th>
                              <th style="width:15%">Division Name</th>
                              <th style="width:10%">Region Type</th>
                              <th style="width:10%">Status</th>
                              <th style="text-align: right !important; width: 10%;">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                               $sl = 0;
                               foreach ( $results as $row ):
                                   $sl++;
                                   //$encryptID = $this->encrypt->encode($row->id, $this->encKey);
                                   if ( $row->region_status == 1 ) {
                                       $status = '<button class="btn btn-mini btn-info">Enable</button>';
                                   } else {
                                       $status = '<button class="btn btn-mini btn-primary">Disable</button>';
                                   }

                                   if ( $row->region_type == 'divisional' ) {
                                       $region = '<button class="btn btn-mini btn-primary">Divitional Region</button>';
                                   } else {
                                       $region = '<button class="btn btn-mini btn-primary">Special Region</button>';
                                   }
                               ?>
	                           <tr>
	                              <td class="v-align-middle"><?=$sl . '.'?></td>
	                              <td> <?=$row->region_name?> </td>
	                              <td> <strong><?=$row->username?></strong> </td>
	                              <td class="v-align-middle"><?=$row->div_name;?></td>
	                              <td> <?=$region?> </td>
	                              <td> <?=$status?></td>
	                              <td align="right">
	                                 <div class="btn-group"> <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> Action <span class="caret"></span> </a>
	                                    <ul class="dropdown-menu pull-right">
	                                       <li><a href="<?=base_url( "offices/region_details/" . encrypt_url( $row->id ) )?>">Details Region</a></li>
	                                       <li><a href="<?=base_url( "offices/region_user/" . encrypt_url( $row->id ) )?>">Region Admin User</a></li>
	                                       <li><a href="<?=base_url( "offices/region_update/" . encrypt_url( $row->id ) )?>">Update Region</a></li>
	                                       <li><a href="<?=base_url( "offices/region_change_password/" . encrypt_url( $row->id ) )?>">Change Password</a></li>
	                                       <li class="divider"></li>
	                                       <li><a href="<?=base_url( "offices/region_delete/" . encrypt_url( $row->id ) )?>" onclick="return confirm('Be careful! Are you sure you want to delete this scouts region?');">Delete Region</a></li>
	                                    </ul>
	                                 </div>
	                              </td>
	                           </tr>
	                        <?php endforeach;?>
                     </tbody>
                  </table>
               </div>

            </div>
         </div>
      </div>

   </div> <!-- END Content -->

</div>