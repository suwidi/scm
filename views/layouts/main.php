<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Website Pengadaan Indonesia dan LPSE">
    <meta name="keywords" content="Lelang, LPSE, Pengadaan, procurement">
    <?= Html::csrfMetaTags() ?>
    <title>LPSE</title>  
    <?php $this->head() ?>
</head>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-63386481-1', 'auto');
  ga('send', 'pageview');

</script>
<body>
  <div id="wrapper">
    <?php $this->beginBody() ?>
    <?= $this->render('header.php') ?>
    <?= $this->render('content.php',['content'=>$content]) ?>
    <?php $this->endBody() ?>
    <br /><br/>
    <!-- Footer -->
    <?php
      $command = Yii::$app->db->createCommand("SELECT
            SUM(IF (t1.`last_status` NOT LIKE '%Selesai',1,0)) AS 'activetotal',
            SUM(IF (t1.`last_status` NOT LIKE '%Selesai',budget,0)) AS 'activebudget',
            count(*) AS total, sum(`budget`) AS budget
            FROM  lpse_detail t1 ");
        $dataStatistic = $command->queryAll();    
    ?>
    <div class="footer">
      <p class="text-center">
      <small>Tersedia Rp.<?= number_format($dataStatistic[0]['activebudget']) ?> dari <?=number_format($dataStatistic[0]['activetotal'])?> item pengadaan aktif&nbsp;|&nbsp;
      <i>(keseluruhan Rp.<?= number_format($dataStatistic[0]['budget']) ?> dari <?= number_format($dataStatistic[0]['total']) ?> data terkumpul)</i></small><br>
    	Copyright &copy; 2015 Lentice Solutions & Cubiconia | info@cubiconia.com
      </p>
    </div>
  </div>
</body>
</html>
<?php $this->endPage() ?>
