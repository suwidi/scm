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
    <?php $this->beginBody() ?>
		<?= $content ?>
    <?php $this->endBody() ?>
    <br /><br/>
    <!-- Footer -->
    <div class="footer navbar-fixed-bottom">
      <p class="text-center">
    	Copyright &copy; 2015 Lentice Solutions & Cubiconia | info@cubiconia.com
      </p>
    </div>
</body>
</html>
<?php $this->endPage() ?>
