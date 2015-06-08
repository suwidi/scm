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
                            <input type="text" class="form-control" placeholder="Kata Kunci Pengadaan" name="q" id="" value="<?php echo $dataPost; ?>">&nbsp;
                        </div> 
                         <div class="text-center">
                            <?php //echo Html::submitButton('Search', ['class' => 'btn btn-info']) ?>
                            <?= Html::submitButton('Advanced Search', ['class' => 'btn btn-warning']) ?>
                        </div>
                </form>
            </div>
        </div>
    </div>

