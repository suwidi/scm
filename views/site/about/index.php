<?php
use yii\helpers\Html;
use frontend\assets\AppAsset;
AppAsset::register($this);
?>

<script src="<?=\Yii::$app->request->BaseUrl; ?>/js/jquery-1.11.2.min.js"></script>
<link rel="stylesheet" href="<?= \Yii::$app->request->BaseUrl; ?>/fonts/css/font-awesome.min.css">
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
          <a class="navbar-brand brand-mobile" href="http://scm.cubiconia.com">
             <img src="img/logo-small.png" alt="" class="">
          </a> 
        </div>
           <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav sub-menu insert_form"> 
                <li><a href="<?=\Yii::$app->request->BaseUrl; ?>" val=""><h3>Back &bull; Home </h3></a></li>
            </ul>
               <ul class="nav navbar-nav navbar-right side-menu">
                <?php if(!Yii::$app->user->isGuest){ ?>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-bell fa-lg"></i>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-gear fa-lg"></i>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="#">Preference</a></li>
                  <li><a href="#">Settings</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-user fa-lg"></i>&nbsp;|&nbsp;<?=Yii::$app->user->identity->username;?>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="#"><i class="fa fa-user"></i>&nbsp; User Profile</a></li>
                  <li>
                  <?= Html::a(
                                    '&nbsp; Sign out',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'fa fa-sign-out']
                                ) ?>
                 </li>
                </ul>
              </li>
              <?php }else{?>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-user fa-lg"></i>&nbsp; User
                </a>
                <ul class="dropdown-menu">
                  <li>
                   <?= Html::a(
                                    '&nbsp; Login',
                                    ['/site/login'],
                                    ['data-method' => 'post', 'class' => 'fa fa-user']
                                ) ?></li>
                  <li><a href="#"><i class="fa fa-sign-out"></i>&nbsp; Sign Up</a></li>
                </ul>
              </li>
              <?php } ?>
          </ul>
       </div>
    </div>   

  </nav>
    <!-- Content Search -->
    <div class="container">
        <div class="row">
         <div class="col-md-8 col-xs-12">                   
            <div class="content-search">
          <a href="#">
            <h4>Tentang Kami</h4>  </a>       
         
              <p>Ini adalah aplikasi beta yang menampilkan rangkuman pengadaan negara (LPSE) dari seluruh Indonesia</p>
              <p>Jika ada pertanyaan atau hal-hal lain berkaitan dengan aplikasi bisa melayangkan email ke info@cubiconia.com <br> atau
                telp ke sdr Suwidi (0811-611-5500)</p>
              <code>Dibuat oleh Cubiconia.com</code> 
                
          <hr>
          </div>        
      </div>
            <div class="col-md-4 col-xs-12">
                <div class="ads"></div>
            </div>
        </div>
 