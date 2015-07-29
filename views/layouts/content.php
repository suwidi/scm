<?php
use frontend\widgets\Alert;
?>
<div>
    <section class="content">
        <?= Alert::widget() ?>
        <?= $content ?>
    </section>
</div>