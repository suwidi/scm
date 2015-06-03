<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LpseDetail */

$this->title = 'Create Lpse Detail';
$this->params['breadcrumbs'][] = ['label' => 'Lpse Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lpse-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
