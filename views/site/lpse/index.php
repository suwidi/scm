<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

use yii\widgets\ListView;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;

use yii\widgets\ActiveForm;

	AppAsset::register($this);
?>
<script src="<?php echo \Yii::$app->request->BaseUrl; ?>/temp/js/jquery-1.11.2.min.js"></script>

<div class="wrap">
	<div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12">
      			<form method="" class="form-inline form-search">
            		<div class="form-group">
						<?php $form = ActiveForm::begin([
                            'action' => ['index'],
                            'method' => 'POST',
                        ]); ?>
                    	<input type="text" class="form-control" placeholder="Kata Kunci Pengadaan" name="q" id="src" value="<?php echo $dataPost; ?>" 
                        style="height: auto; width: 320px;  z-index: 6;  outline: none;transparent;"> &nbsp;
						<?= Html::submitButton('Search', ['class' => 'btn btn-info']) ?>
                    </div>
                </form>
		</div>
      </div>
    </div>
</div>
    
    <!-- Sub Menu -->
    <nav class="navbar navbar-default">
      <div class="container">
    	<div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

          <a class="navbar-brand brand-mobile" href="#">
             <img src="img/logo-small.png" alt="" class="">
          </a>        
        </div>
    	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
           	<ul class="nav navbar-nav sub-menu insert_form">
            	<li><a href="javascript:void(0)" val="inStatus">Status </a></li>
                <li><a href="javascript:void(0)" val="inLpse">Lpse </a></li>
                <li><a href="javascript:void(0)" val="endDate">Date </a></li>
                <li><a href="javascript:void(0)" val="inBudget">Budget </a></li>
                <li><a href="javascript:void(0)" val="inCategory">Category </a></li>
                <li><a href="javascript:void(0)" val="">FAQ </a></li>
            </ul>
        </div>
       </div>
      
    </nav>
    
    <!-- Content Search -->
    <div class="container">
    	<div class="row">
            <div class="col-md-5 col-xs-12">	   
			<?= 
				ListView::widget([
					'dataProvider' => $dataProvider,
					'itemView' => '_index',
				]); 
			?>
          	</div>		  
			<div class="col-md-7 col-xs-12">
                <div class="ads"></div>
            </div>
        </div>
    </div>
    
	<script>
		$(document).ready(function (){
			$('.insert_form > li > a').click(function (){
				var list_cat = [];
				$('.insert_form > li').each(function (index, val){
					var ld = $(this).find('a').attr('val')+":";
					list_cat.push(ld);
				});
				var data_ = $(this).attr('val');	
				$.ajax
					({
						type	: 'POST',
						url		: '<?php echo \Yii::$app->urlManager->createAbsoluteUrl("site/processdata"); ?>',
						data	: { list_cat : list_cat, value : $('#src').val(), click : data_},
						dataType: 'json',
						beforeSend: function() {			
						},	
						complete: function() {
						}, 
						success	: function(retval) 
						{
							var SearchInput = $('#src').val(retval.ret);
							var strLength= data_.length + Number(1);
							SearchInput.focus();
							SearchInput[0].setSelectionRange(strLength, strLength);
						}
					});		
				
				
			});
		});
	</script>
