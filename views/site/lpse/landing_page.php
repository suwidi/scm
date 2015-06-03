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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>LPSE</title>
    <?php $this->head() ?>
</head>

<body>
    <!-- Header -->
    <header>
      <div class="container">
        <div class="row">
            <div class="col-xs-12">
                
            </div>
        </div>
      </div>
    </header>
    
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-offset-3">
                <img class="logo-big img-responsive" src="<?php echo \Yii::$app->request->BaseUrl;  ?>/image/logo-big.png" alt="">
                <form method="" class="search-box">
                    <?php $form = ActiveForm::begin([
                        'action' => ['index'],
                        'method' => 'POST',
                    ]); 
                    ?>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="" name="LpseDetailSearch[name]" id=""> &nbsp;
                        </div> 
                         <div class="text-center">
                            <?= Html::submitButton('Search', ['class' => 'btn btn-info']) ?>
                            <?= Html::submitButton('Advanced Search', ['class' => 'btn btn-warning']) ?>
                        </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <footer>
      <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <p class="text-center">
                Copyright &copy; 2015 Lentice Solutions.
                </p>
            </div>
        </div>
      </div>
    </footer>
</body>
</html>