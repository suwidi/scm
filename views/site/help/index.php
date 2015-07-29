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
            <h4>inStatus</h4>
          </a>        
          <p>Digunakan untuk melakukan pembatasan/filter berdasar status</p>   
          <small>Contoh</small>
            <p><ul> 
              <li>inStatus:-kontrak</li>
              <li>inStatus:selesai</li></ul>
            </p>
            <small>Aturan Penggunaaan</small>
            <p>
            <ul>
              <li>Gunakakan tanda <b>"-"</b> (minus) untuk tidak menampilkan data tersebut</li>
              <li>Jika inStatus di seting maka data periode terdahulu tetap akan ditampilkan</li>
              <li>Isian dalam format text satu kata atau potongan kata</li>
              <li>Bisa dikombinasikan dengan tools yang lain</li>
              <li>Secara default (bawaan) pengadaan yang sudah <b>selesai</b> tidak ditampilkan</li>
              
            </ul>  
            </p>   
                
          <hr>
          </div>
           <div class="content-search">
          <a href="#">
            <h4>inLpse</h4>
          </a>        
          <p>Digunakan untuk melakukan pembatasan/filter berdasar nama Lembaga Penyedia/LPSE</p>   
          <small>Contoh</small>
            <p><ul> 
              <li>inLpse:-kabupaten</li>
              <li>inLpse:Bogor</li>
              <li>inLpse:Kementerian</li></ul>
            </p>
            <small>Aturan Penggunaaan</small>
            <p>
            <ul> 
              <li>Gunakakan tanda <b>"-"</b> (minus) untuk tidak menampilkan data tersebut</li>
              <li>Isian dalam format text satu kata atau potongan kata</li>
              <li>Bisa dikombinasikan dengan tools yang lain</li>              
            </ul>  
            </p>   
                
          <hr>
          </div>
           
           <div class="content-search">
          <a href="#">
            <h4>endDate</h4>
          </a>        
          <p>Digunakan untuk menampilkan data expired pada periode diatas waktu yang ditentukan</p>   
          <small>Contoh</small>
           <p><ul> 
              <li>endDate:-2015</li>
              <li>endDate:2016-07</li>
              <li>endDate:2015-07-28</li></ul>
            </p>
            <small>Aturan Penggunaaan</small>
            <p>
            <ul> 
              <li>Gunakakan tanda <b>"-"</b> (minus) untuk menampilkan data dibawah periode ditersebut</li>
              <li>Jika endDate di seting maka data expired tetap akan ditampilkan</li>
              <li>Isian dalam format tanggal (YYYY-MM-DD) dengan format lengkap atau sebagian, ie. 2015 artinya 2015-01-01</li>
              <li>Bisa dikombinasikan dengan tools yang lain</li>              
            </ul>  
            </p>   
                
          <hr>
          </div>
     <div class="content-search">
            <a href="#">
              <h4>inBudget</h4>
            </a>        
            <p>Digunakan untuk menampilkan data dengan anggaran yang ditentukan</p>   
            <small>Contoh</small>
             <p><ul> 
                <li>inBudget:-5M</li>
                <li>inBudget:-500Jt</li>
                <li>inBudget:50.000.000</li></ul>
              </p>
              <small>Aturan Penggunaaan</small>
              <p>
              <ul> 
                <li>Gunakakan tanda <b>"-"</b> (minus) untuk menampilkan data dibawah nilai ditersebut</li>
                <li>Format nilai dapat menggunakan akhiran <b>"M"</b> untuk Milyar atau <b>"Jt"</b> untuk Juta</li>              
              </ul>  
              </p>   
                  
            <hr>
            </div>
              <div class="content-search">
            <a href="#">
              <h4>inCategory</h4>
            </a>        
            <p>Digunakan untuk menampilkan data pada kategory tertentu</p>   
            <small>Contoh</small>
             <p><ul> 
                <li>inCategory:Pengadaan</li>
                <li>inCategory:-Konstruksi</li>
                </ul>
              </p>
              <small>Aturan Penggunaaan</small>
              <p>
              <ul> 
                <li>Gunakakan tanda <b>"-"</b> (minus) untuk menampilkan data dibawah nilai ditersebut</li>
                <li>Isian dalam format text satu kata atau potongan kata</li>
                <li>Bisa dikombinasikan dengan tools yang lain</li>                    
              </ul>  
              </p>   
                  
            <hr>
            </div> 
      </div>

            <div class="col-md-4 col-xs-12">
                <div class="ads"></div>
            </div>
        </div>
    </div>
 