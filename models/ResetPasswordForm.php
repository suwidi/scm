<?php
namespace frontend\models;

use common\models\User;
// use yii\base\InvalidParamException;
use yii\web\NotFoundHttpException;
use yii\base\Model;
use Yii;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    public $password;
    public $captcha;
    public $repeatpassword;
    /**
     * @var \common\models\User
     */
    public $_user;


    /**
     * Creates a form model given a token.
     *
     * @param  string                          $token
     * @param  array                           $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidParamException if token is empty or not valid
     */
    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new NotFoundHttpException();
        }
        $this->_user = User::findByPasswordResetToken($token);
        if (!$this->_user) {            
            throw new NotFoundHttpException();
        }
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => 6],            //ctype_alnum
            ['captcha', 'required'],
            ['captcha', 'captcha'],
            ['repeatpassword', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match"],       
        ];
    }

    public function attributeLabels()
    {
        return [
            'password' => 'Password',
            'captcha' => 'Security Code',
        ];
    }

    /**
     * Resets password.
     *
     * @return boolean if password was reset.
     */
    public function resetPassword()
    {
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removePasswordResetToken();

        return $user->save(false);
    }
}
