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
<script src="<?php echo \Yii::$app->request->BaseUrl; ?>/js/jquery-1.11.2.min.js"></script>
<?php
 $auth_user = \Yii::$app->user;   
        $customer = null; 
       /* if ($auth_user->can('CloudApps')){               
            $customer = customers::findOne(['email'=>$auth_user->identity->email,]);
        }     */         
?> 
<div class="wrap">
	<div class="container">
      <div class="row">
        <div class="col-xs-8 col-sm-8">
      			<form method="" class="form-inline form-search">
            		<div class="form-group">
						<?php $form = ActiveForm::begin([
                            'action' => ['index'],
                            'method' => 'POST',
                        ]); ?>
                    	<input type="text" class="form-control" placeholder="Kata Kunci Pengadaan" name="q" id="src" value="<?php echo $dataPost; ?>" 
                        style="height: auto; z-index: 6;  outline: none;transparent;">
						<?= Html::submitButton('Search', ['class' => 'btn btn-info']) ?>
                    </div>
                </form>

      		</div>
          <div class="col-xs-4 col-sm-4">
    <div class='pull-right form-search'>
      <?php if(!Yii::$app->user->isGuest){ ?>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">0</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 0 notifications</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-aqua"></i> no message
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                    </ul>
                </li>
                <!-- Tasks: style can be found in dropdown.less -->
                <li class="dropdown tasks-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-flag-o"></i>
                        <span class="label label-danger">0</span>
                    </a>
                
                </li>
                <!-- User Account: style can be found in dropdown.less -->

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        &bull;
                        <span class="hidden-xs">Log Out</span>
                    </a>
                    <ul class="dropdown-menu" style='border:0px;padding:10px'>
                        <!-- User image -->
                        <li class="user-header">
                          <i class="fa fa-users text-aqua">
                            <p>
                                User Name
                                <small><?=Yii::$app->user->identity->email;?></small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                          <?php if(!($customer==null)) echo $customer->contactname; ?>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                        <?php if(!($customer==null)) { ?>
                        <div class="pull-left ">
                            <?= Html::a('Edit Profile', ['cloudapp/updatecust', 'id' =>$customer->id], ['class' => 'btn btn-default btn-flat']) ?> 
                        </div>
                        <?php } ?>    
                            <div class="pull-right">
                                <?= Html::a(
                                    'Ok',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>            
            </ul>
        </div>
           <?php } ?>



       </div>
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
                <li><a href="javascript:void(0)" val="inLpse">LPSE </a></li>
                <li><a href="javascript:void(0)" val="endDate">Date </a></li>
                <li><a href="javascript:void(0)" val="inBudget">Budget </a></li>
                <li><a href="javascript:void(0)" val="inCategory">Category </a></li>
                <li><a href="?r=site/about" val="">About </a></li>
            </ul>
        </div>
       </div>
      
    </nav>    
    <!-- Content Search -->
    <div class="container">
    	<div class="row">
            <div class="col-md-8 col-xs-12">	   
			<?= 
				ListView::widget([
					'dataProvider' => $dataProvider,
					'itemView' => '_index',
				]); 
			?>
          	</div>		  
			<div class="col-md-4 col-xs-12">
                <div class="ads">ads</div>
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
