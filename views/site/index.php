<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\widgets\ListView;


/* @var $this yii\web\View */
/* @var $searchModel app\models\LpseDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lpse Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lpse-detail-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

  <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_index',
    ]); ?>
</div>
