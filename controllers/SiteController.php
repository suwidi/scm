<?php
namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
//use frontend\models\PasswordResetRequestForm;
//use frontend\models\ResetPasswordForm;
//use common\models\SignupForm;
//use frontend\models\ContactForm;
// use yii\base\InvalidParamException;
// use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


use app\models\AuditUser;
use app\models\LpseDetail;
use app\models\LpseDetailSearch;
use yii\web\NotFoundHttpException;


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'cubiconia' : null,
            ],
        ];
    }

     public function actionIndex()
    {
		
        $searchModel = new LpseDetailSearch();   
        $session = \Yii::$app->session;
		if (!isset($session['user'])){   
           $session = \Yii::$app->session;        
           $user_id = (Yii::$app->user->isGuest)?0:\Yii::$app->user->id;
           $data_user = $this->getClient();
           $model = new AuditUser();
           $model->user_id = $user_id;
           $model->ip = ($data_user['ip'])?$data_user['ip']:0;
           $model->mobile = $data_user['mobile'];
           $model->os = $data_user['os'];
           $model->browser = $data_user['browser'];
           $model->mac = $data_user['mac'];
           $model->created = date('Y-m-d H:i:s');
           $model->save();
           $data_user['audit_user_id'] = $model->id;           
           $user_ses = array($user_id =>$data_user);               
           $session->set('user',$user_ses );           
         
    	   return $this->render('lpse/landing_page', 
    			[
                    'dataPost'      => isset($_GET['q']) ? $_GET['q']:'' ,
    			]
    		);			
		}else{
            $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
			return $this->render('lpse/index', 
				[
					'dataProvider' 	=> $dataProvider,
					'dataPost' 		=> isset($_GET['q']) ? $_GET['q']:'' ,
				]
			);
			
		}
        
    }

    public function actionHelp()
    {
        return $this->render('help/index', [
            
        ]);
    }
    
    public function actionLogin()
    {
       // $this->layout = 'main-login';		
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('user/login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
   
   public function actionAbout()
    {
        return $this->render('about/index');
    }

    /*public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }
        return $this->render('user/signup', [
            'model' => $model,
        ]);
    }*/
/*
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
	*/
	
	public function actionProcessdata(){	
		// proses input
		$ex = $this->multiexplode();
		$xx = array_filter(explode(' ', $_POST['value']));
		$list = '';
		foreach ($xx as $key => $val){
			if(preg_match("/".$_POST['click']."/", $val)) {
			  $list[] = $key;
			} 
		}
	
		foreach ($xx as $key => $val){
			if (!empty($list)){
				foreach ($list as $c){	
					unset($xx[$c]);	
				}
			}
		}
		$gabung = $_POST['click'].": ";
		foreach ($xx as $d){
			$gabung .=$d." ";
		}
		$result['ret'] = $gabung;  
		echo json_encode($result);
		
	}
     /**
     * Finds the LpseDetail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LpseDetail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LpseDetail::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	protected function multiexplode () {
		$delimiters = $_POST['list_cat'];
		$string		= $_POST['value'];
		$ready 		= str_replace($delimiters, $delimiters[0], $string);
		$launch 	= explode($delimiters[0], $ready);
		
		return  $launch;
	}
    protected function getClient(){
            $ua=$this->getBrowser();
            //$parameter['ID_REGION'] = $ [1];
            $parameter['ip']     = $_SERVER['REMOTE_ADDR'];
            $parameter['mobile'] = $this->isMobileDevice();
            $parameter['os']     = $ua['platform'];
            $parameter['browser']= $ua['name']." ".$ua['version'];
            $parameter['mac']    = '';
           // $parameter['NAMECOUNTRY']   = $ipInfo[0];
            return $parameter;

    }
   protected function isMobileDevice(){
            $aMobileUA = array(
                '/iphone/i' => 'iPhone', 
                '/ipod/i' => 'iPod', 
                '/ipad/i' => 'iPad', 
                '/android/i' => 'Android', 
                '/blackberry/i' => 'BlackBerry', 
                '/webos/i' => 'Mobile'
            );
            //Return true if Mobile User Agent is detected
            foreach($aMobileUA as $sMobileKey => $sMobileOS){
                if(preg_match($sMobileKey, $_SERVER['HTTP_USER_AGENT'])){
                   return  $sMobileOS;   

                }
            }
            //Otherwise return false..  
            return "Non";
    }
   protected function getBrowser()
    {
        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version= "";

        //First get the platform?
        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'linux';
        }
        elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'Mac';
        }
        elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'Windows';
        }
       
        // Next get the name of the useragent yes seperately and for good reason
        if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
        {
            $bname = 'Internet Explorer';
            $ub = "MSIE";
        }
        elseif(preg_match('/Firefox/i',$u_agent))
        {
            $bname = 'Mozilla Firefox';
            $ub = "Firefox";
        }
        elseif(preg_match('/Chrome/i',$u_agent))
        {
            $bname = 'Google Chrome';
            $ub = "Chrome";
        }
        elseif(preg_match('/Safari/i',$u_agent))
        {
            $bname = 'Apple Safari';
            $ub = "Safari";
        }
        elseif(preg_match('/Opera/i',$u_agent))
        {
            $bname = 'Opera';
            $ub = "Opera";
        }
        elseif(preg_match('/Netscape/i',$u_agent))
        {
            $bname = 'Netscape';
            $ub = "Netscape";
        }
       
        // finally get the correct version number
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
        ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
            // we have no matching number just continue
        }
       
        // see how many we have
        $i = count($matches['browser']);
        if ($i != 1) {
            //we will have two since we are not using 'other' argument yet
            //see if version is before or after the name
            if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
                $version= $matches['version'][0];
            }
            else {
                $version= $matches['version'][1];
            }
        }
        else {
            $version= $matches['version'][0];
        }
       
        // check if we have a number
        if ($version==null || $version=="") {$version="?";}
       
        return array(
            'userAgent' => $u_agent,
            'name'      => $bname,
            'version'   => $version,
            'platform'  => $platform,
            'pattern'    => $pattern
        );
    }

}
