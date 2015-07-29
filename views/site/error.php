<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = "Error";
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="alert alert-danger">
       <p>Terjadi Masalah</p>
    </div>    
    <p>
        Mohon maaf atas ketidak nyamanan Anda
    </p>

</div>
