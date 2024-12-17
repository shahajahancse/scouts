<link rel="stylesheet" type="text/css" href="<?=base_url('fwedget/assets/plugins/flipbook/')?>css/flipbook.style.css">
<link rel="stylesheet" type="text/css" href="<?=base_url('fwedget/assets/plugins/flipbook/')?>css/font-awesome.css">
<style type="text/css">
	img.center {
		display: block;
		margin: 0 auto;
		border: 1px solid #ccc;
	}
	.title{text-align: center;}
</style>

<div class="container w-75">
	<div class="secondary_sc_content">
		<p class="lead font-weight-bold py-2 text-white" style="background-color: #1aa326; padding-left:10px">E-Book</p>
		<div class="container">     

			<!-- Nav tabs -->
			<ul class="nav nav-tabs">
				<li class="nav-item">
					<a class="nav-link active" data-toggle="tab" href="#cub_scout">Cub Scout</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#scouts">Scout</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#rover_scout">Rover Scout</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#adult_leader">Adult Leader</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#others">Other's</a>
				</li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
				<div class="tab-pane container active" id="cub_scout">
					<h6 class="tab_heading"> Cub Scout E-Book</h6>
					<div class="row">       <!-- onclick="bookDetails(id)"  -->
						<?php foreach ($ebook_cub_list as $row) { ?>      
						<div class="col-md-3 book<?=$row->id?>">
							<img class="center" src="<?=base_url('uploads/ebook/thumbs/'.$row->image_file)?>">
							<div class="title"><?=$row->book_title?></div>
							<div style="border: 0px solid red;">
								<b>Description</b><br>
								<?=$row->description?>
							</div>
						</div>
						<?php } ?>
					</div>
					<div class="pt-3"></div>  
				</div>

				<div class="tab-pane container fade" id="scouts">
					<h5 class="tab_heading"> Scout E-Book </h5>
					<div class="row">       
						<?php foreach ($ebook_scout_list as $row) { ?>      
						<div class="col-md-3 book<?=$row->id?>">
							<img class="center" src="<?=base_url('uploads/ebook/thumbs/'.$row->image_file)?>">
							<div class="title"><?=$row->book_title?></div>
						</div>
						<?php } ?>
					</div>
					<div class="pt-3"></div>  
				</div>

				<div class="tab-pane container fade" id="rover_scout">
					<h5 class="tab_heading"> Rover Scout E-Book</h5>
					<div class="row">       
						<?php foreach ($ebook_rover_list as $row) { ?>      
						<div class="col-md-3 book<?=$row->id?>">
							<img class="center" src="<?=base_url('uploads/ebook/thumbs/'.$row->image_file)?>">
							<div class="title"><?=$row->book_title?></div>
						</div>
						<?php } ?>
					</div>
					<div class="pt-3"></div>  
				</div>

				<div class="tab-pane container fade" id="adult_leader">
					<h5 class="tab_heading"> Adult Leader E-Book</h5>
					<div class="row">       
						<?php foreach ($ebook_adult_list as $row) { ?>      
						<div class="col-md-3 book<?=$row->id?>">
							<img class="center" src="<?=base_url('uploads/ebook/thumbs/'.$row->image_file)?>">
							<div class="title"><?=$row->book_title?></div>
						</div>
						<?php } ?>
					</div>
					<div class="pt-3"></div>  
				</div>

				<div class="tab-pane container fade" id="others">
					<h5 class="tab_heading"> Other's E-Book</h5>
					<div class="row">       
						<?php foreach ($ebook_other_list as $row) { ?>      
						<div class="col-md-3 book<?=$row->id?>">
							<img class="center" src="<?=base_url('uploads/ebook/thumbs/'.$row->image_file)?>">
							<div class="title"><?=$row->book_title?></div>
						</div>
						<?php } ?>
					</div>
					<div class="pt-3"></div>  
				</div>
			</div>     

         <?php /*
         <div class="row">            
            <div class="col-md-3 book2">
               <img class="center" src="<?=base_url('uploads/ebook/thumbs/CUB_Membership_Badge.jpg')?>">
               <div class="title">CUB Membership Badge</div>
            </div>

            <div class="col-md-3 book3">
               <img class="center" src="<?=base_url('uploads/ebook/thumbs/cub_scout_program.jpg')?>">
               <div class="title">Cub Scout Program</div>
            </div>

            <div class="col-md-3 book4">
               <img class="center" src="<?=base_url('uploads/ebook/thumbs/scout_membership_bagde.jpg')?>">
               <div class="title">Scout Membership Badge</div>
            </div>

            <div class="col-md-3 book1">
               <img class="center" src="<?=base_url('uploads/ebook/thumbs/chand_badge.jpg')?>">
               <div class="title">Chand Badge</div>
            </div>
         </div>
         */ ?>

      </div>
      <div class="py-3"></div>
   </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
<script src="<?=base_url('fwedget/assets/plugins/flipbook/')?>js/flipbook.min.js"></script>

<script type="text/javascript">

/*	function bookDetails(bookID){
		// alert(bookID);

		$.ajax({
			type: "GET",
			url: hostname +"site/ajax_get_book_details/" + bookID,
			// data: {userid: 'dfd'},
			success: function(datas)
			{
				console.log(datas);*/
				/*$.each(func_data,function(id,name)
				{
					var opt = $('<option />');
					opt.val(id);
					opt.text(name);
					$('.expert_group_val').append(opt);
				});

				$("#expert_group_id").val(qid);*/

			/*	
			}
		});
*/
		/*$(".book"+"bookID").flipBook({
         pdfUrl:"<?=base_url('uploads/ebook/pdf/'.$row->pdf_file)?>",            
         lightBox:true,
         pages:[
         <?php
         	/*if(!empty($row->pages)){
         		for ($i=1; $i<=$row->total_page; $i++) {
         			$index = array_search($i, array_column($row->pages, "page_no")); //exit;
         			$value = $index === FALSE?'':$row->pages[$index]['index_title'];
         			echo '{title:"'.$value.'"},';
         		}
         	}*/
         ?>
         ]
      });*/
   // }

   $(document).ready(function () {

      <?php foreach ($ebook_cub_list as $row) { ?>
         $(".book<?=$row->id?>").flipBook({
            pdfUrl:"<?=base_url('uploads/ebook/pdf/'.$row->pdf_file)?>",            
            lightBox:true,
            pages:[
            <?php
            	if(!empty($row->pages)){
            		for ($i=1; $i<=$row->total_page; $i++) {
            			$index = array_search($i, array_column($row->pages, "page_no")); //exit;
            			$value = $index === FALSE?'':$row->pages[$index]['index_title'];
            			echo '{title:"'.$value.'"},';
            		}
            	}
            ?>
            ]
         });
         <?php } ?>

         <?php foreach ($ebook_scout_list as $row) { ?>      
         	$(".book<?=$row->id?>").flipBook({
         		pdfUrl:"<?=base_url('uploads/ebook/pdf/'.$row->pdf_file)?>",
         		lightBox:true,
	            pages:[
	            <?php
	            	if(!empty($row->pages)){
	            		for ($i=1; $i<=$row->total_page; $i++) {
	            			$index = array_search($i, array_column($row->pages, "page_no")); //exit;
	            			$value = $index === FALSE?'':$row->pages[$index]['index_title'];
	            			echo '{title:"'.$value.'"},';
	            		}
	            	}
	            ?>
	            ]
         	});
         	<?php } ?>

         	<?php foreach ($ebook_rover_list as $row) { ?>      
         		$(".book<?=$row->id?>").flipBook({
         			pdfUrl:"<?=base_url('uploads/ebook/pdf/'.$row->pdf_file)?>",
         			lightBox:true,
		            pages:[
		            <?php
		            	if(!empty($row->pages)){
		            		for ($i=1; $i<=$row->total_page; $i++) {
		            			$index = array_search($i, array_column($row->pages, "page_no")); //exit;
		            			$value = $index === FALSE?'':$row->pages[$index]['index_title'];
		            			echo '{title:"'.$value.'"},';
		            		}
		            	}
		            ?>
		            ]
         		});
         		<?php } ?>

         		<?php foreach ($ebook_adult_list as $row) { ?>      
         			$(".book<?=$row->id?>").flipBook({
         				pdfUrl:"<?=base_url('uploads/ebook/pdf/'.$row->pdf_file)?>",
         				lightBox:true,
			            pages:[
			            <?php
			            	if(!empty($row->pages)){
			            		for ($i=1; $i<=$row->total_page; $i++) {
			            			$index = array_search($i, array_column($row->pages, "page_no")); //exit;
			            			$value = $index === FALSE?'':$row->pages[$index]['index_title'];
			            			echo '{title:"'.$value.'"},';
			            		}
			            	}
			            ?>
			            ]
         			});
         			<?php } ?>

         			<?php foreach ($ebook_other_list as $row) { ?>      
         				$(".book<?=$row->id?>").flipBook({
         					pdfUrl:"<?=base_url('uploads/ebook/pdf/'.$row->pdf_file)?>",
         					lightBox:true,
				            pages:[
				            <?php
				            	if(!empty($row->pages)){
				            		for ($i=1; $i<=$row->total_page; $i++) {
				            			$index = array_search($i, array_column($row->pages, "page_no")); //exit;
				            			$value = $index === FALSE?'':$row->pages[$index]['index_title'];
				            			echo '{title:"'.$value.'"},';
				            		}
				            	}
				            ?>
				            ]
         				});
         				<?php } ?>

      <?php /*
      $(".book2").flipBook({
         pdfUrl:"<?=base_url('uploads/ebook/pdf/')?>Cub_Scout_Program.pdf",
         lightBox:true
      });

      $(".book3").flipBook({
         pdfUrl:"<?=base_url('uploads/ebook/pdf/')?>Cub_Scout_Program.pdf",
         lightBox:true
      });

      $(".book4").flipBook({
         pdfUrl:"<?=base_url('uploads/ebook/pdf/')?>Scout_Membership_Badge.pdf",
         lightBox:true
      });
      */ ?>

   })
</script>