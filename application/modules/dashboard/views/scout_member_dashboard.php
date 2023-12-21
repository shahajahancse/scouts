<div class="page-content">
	<div class="content">
		<div class="page-title"> <i class="fa fa-dashboard"></i>
			<h3>Dashboard</h3>
		</div>

		<div class="row">  
			<div class="col-md-12">
				<style type="text/css">
					.tg  {border-collapse:collapse;border-spacing:0; width: 80%;}
					.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal; color: black;border-color: #c7bfbf;}
					.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal; color: black; font-weight: bold; vertical-align: top; width: 150px;border-color: #a29e9e;}
					.tg .tg-d8ej{background-color:#b9c9fe}
					#memberDiv td{padding: 5px; color: black;}
					#memberDiv th{padding: 5px; font-weight: bold; color: black;}
				</style>
				<h2>Welcome, <strong>Bangladesh Scouts</strong></h2> <br>

            <?php
            if($scout_info->region_type == 'divisional'){
               $upazila = $scout_info->upa_name;
            }else{
               $upazila = 'Not Applicable';
            }
            ?>

            <h3 style="font-weight: bold;"> My Scouts Infomartion </h3>
            <table class="tg">
               <tr>
                  <th class="tg-d8ej" style="font-weight: bold; font-size: 20px;"> BS ID</th>
                  <td class="tg-031e" style="font-weight: bold; font-size: 20px;"><?= $info->scout_id?></td>
               </tr>
               <tr>
                  <th class="tg-d8ej"> Name</th>
                  <td class="tg-031e" style="font-weight: bold; font-size: 15px;"><?=$info->first_name?></td>
               </tr> 
               <tr>
                  <th class="tg-d8ej"> Scout Section</th>
                  <td class="tg-031e"><?=get_scout_section($info->sc_section_id)?></td>
               </tr>
               <tr>
                  <th class="tg-d8ej"> Unit Name</th>
                  <td class="tg-031e"><?=$scout_info->unit_name?></td>
               </tr>
               <tr>
                  <th class="tg-d8ej"> Group Name</th>
                  <td class="tg-031e"><?=$scout_info->grp_name?></td>
               </tr>  
               <tr>
                  <th class="tg-d8ej"> Upazila Office</th>
                  <td class="tg-031e"><?=$upazila?></td>
               </tr>
               <tr>
                  <th class="tg-d8ej"> District Office</th>
                  <td class="tg-031e"><?=$scout_info->dis_name?></td>
               </tr>
               <tr>
                  <th class="tg-d8ej"> Region Office</th>
                  <td class="tg-031e"><?=$scout_info->region_name?></td> 
               </tr>
            </table>
         </div>
      </div>

   </div>
</div>