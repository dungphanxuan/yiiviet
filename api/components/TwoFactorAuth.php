<?php
/**
 * Created by PhpStorm.
 * User: Co-Well
 * Date: 2/9/2017
 * Time: 4:33 PM
 */

namespace api\components;

use common\models\User;
use Yii;
use yii\base\ActionFilter;
use yii\web\ForbiddenHttpException;

/*
 * TwoFactorAuthentication
 * */

class TwoFactorAuth extends ActionFilter
{
    private $_otp = null;

    /**
     * @var string the parameter name for passing the otp
     */
    public $otpParam = 'otp';

    /**
     * Initializes the api by.
     */
    public function init()
    {
        parent::init();
        $this->_otp = getParam($this->otpParam, '');

        if (!$this->_otp) {
            $this->_otp = postParam($this->otpParam, '');
        }
    }

    public function beforeAction($action)
    {
        $user_id = Yii::$app->user->id;
        $user = User::find()->where(['id' => $user_id])->one();
        if (!$user || !$user->validateOtpSecret($this->_otp)) {
            $this->denyAccess();
        }

        return parent::beforeAction($action);
    }

    protected function denyAccess()
    {
        throw new ForbiddenHttpException(Yii::t('yii', 'Incorrect OTP code.'));
    }

}