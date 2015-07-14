<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-4 col-sm-4 col-xs-12 col-md-offset-4 company-form">
        <div class="h-10"></div>
        <h1>Login</h1>
        <div class="h-10"></div>
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>                
            <div class="form-group">
                <?= $form->field($model, 'username')->textInput(array('placeholder' => 'Email'));  ?>
                <?= $form->field($model, 'password')->passwordInput(array('placeholder' => 'Password')) ?>
                <?= $form->field($model, 'captcha')->widget(Captcha::className())->label(false) ?>
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
            </div>
            <div style="text-align:right">                      
                &nbsp;&nbsp;&nbsp;&nbsp;     
                <?= Html::submitButton("<i class='fa fa-check-circle'></i>&nbsp; Login", ['class' => 'btn btn-danger', 'name' => 'login-button']) ?>
            </div>
        <div class="h-10"></div>
        <?php ActiveForm::end(); ?>                  
    </div>
</div>
