<!-- Create by: Mafizur
  Create Date: 07-06-2018
  Modify by: mafizur
  last modify date: 12-08-2018 -->
<style type="text/css">
	.priview-body{
		font-size: 14px;
		color:#000;
		margin: 25px 75px;
	}
	.priview-header{
		margin-bottom: 40px;
		text-align: center;
	}
	.priview-header p{
		font-size: 15px;
		line-height: 12px;
	}
	.priview-memorandum, 
	.priview-from, 
	.priview-to, 
	.priview-subject,
	.priview-message,
	.priview-office,
	.priview-demand,
	.priview-signature{
		padding-bottom: 20px;
	}
	.priview-office{
		text-align: center;
	}
	.priview-imitation ul{
		list-style: none;
	}
	.priview-imitation ul li{
		display: block;
	}
	.date-name{
		width: 20%;
		float: left;
		padding-top: 10px;
		text-align: right;
	}
	.date-value{
		width: 70%;
		float:left;
	}
	.date-value ul{
		list-style: none;
	}
	.date-value ul li{
		text-align: center;
	}
	.date-value ul li:first-child{
		border-bottom: 1px solid #000;
	}
	.subject-content{
		text-decoration: underline;
	}
</style>
	
<div class="priview-body">


	<div class="priview-header">
		<p class="text-center"><?=$this->lang->line('bangladesh-goverment')?></p>
		<p class="text-center">বাংলাদেশ স্কাউটস</p>
		<p class="text-center">জাতীয় সদর দফতর</p>
		<p class="text-center"><u><b>60, আঞ্জুমান মুফিদুল ইসলাম রোড, কাকরাইল</b></u></p>
	</div>
	
	<div class="priview-memorandum">
		<div class="row">
			<div class="col-sm-8 col-xs-6">
				স্মারক নং - <?=$this->Common_model->en2bn($info['file_memorandum'])?>
			</div>
			<div class="col-sm-4 col-xs-6">
					<div class="date-name">
						তারিখ
					</div>
					<div class="date-value">
						<ul>
							<li class="bongabdo"></li>
							<li><?=date_bangla_calender_format($info["date"])?></li>
						</ul>
						<script type="text/javascript">
						    $(document).ready(function(){
						      $('.bongabdo').bongabdo({
						          date: '<?=date_db_format($info["date"])?>'
						      });
						    });
						</script>
					</div>
			</div>
		</div>
		
	</div>

	<div class="priview-subject">
		<div class="row">
			<div class="col-sm-1 col-xs-2">
				প্রাপক
			</div>
			<div class="col-sm-11 col-xs-10 subject-content">
				<?=nl2br($info['file_from'])?>
			</div>
		</div>
	</div>
	
	<div class="priview-subject">
		<div class="row">
			<div class="col-sm-1 col-xs-2">
				বিষয়
			</div>
			<div class="col-sm-11 col-xs-10 subject-content">
				<?=$info['file_subject']?>
			</div>
		</div>
	</div>
	
	<div class="priview-message">
		<div class="row">
			<div class="col-sm-12 col-xs-12">
				<span style="width:8.33%; float: left;">&nbsp;</span>
				<?=$info['file_message']?>
			</div>
		</div>
	</div>



	<div class="priview-signature">
		<div class="row">
			<div class="col-sm-8 col-xs-6">
				</br>
				</br>
				<?=nl2br($info['file_to'])?>
			</div>
			<div class="col-sm-4 col-xs-6">
				<div class="text-center">
					
					<img src="data:image/png;base64,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" width="100px"></br>
					(<?=$user->first_name?>) </br>
					<?=$designation->designation_name?> </br>
					<?=$department->department_name?> </br>
					বাংলাদেশ স্কাউটস </br>
					
				</div>
			</div>
		</div>
	</div>
</div>


