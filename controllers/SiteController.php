<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use app\models\Log;

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
                'only' => ['logout','index'],
                'rules' => [
                    [
                        'actions' => ['logout','index'],
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
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->createLog('Melihat ke beranda');
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $session = Yii::$app->session;
        $session->open();

        if(!$session['session.user']['login']){
            $model = new LoginForm();
            $postData = Yii::$app->request->post();
            if ($model->load($postData) && $model->login()) {
                $userData = User::find()->where(["id_user"=>Yii::$app->user->getId()])->asArray()->all();

                /*print_r(Yii::$app->user->getId());die;*/
                $session['session.user'] = array(
                        "login"=>true,
                        "id_user"=>$userData[0]['id_user'],
                        "username"=>$userData[0]['username'],
                        "email"=>$userData[0]['email'],
                        "user_type"=>$userData[0]['user_type'],
                        "hak_akses"=>$userData[0]['hak_akses'],
                    );
                $this->createLog('Login');
                return $this->goBack();
            } else {
                $this->layout = 'login_layout';
                return $this->render('login', [
                    'model' => $model,
                ]);
            }
        }else{
            return $this->goBack();
        }
        $session->close();
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        $this->createLog('Logout');
        $session = Yii::$app->session;
        $session->open();
        $session->destroy();
        $session->close();
        Yii::$app->user->logout();
        //print_r($session['session.user']);
        return $this->goHome();
    }

    protected function createLog($activity)
    {
        $session = Yii::$app->session;

        if($session['session.user']['login']){
            $session = Yii::$app->session;
            $log = new Log();
            $log['user'] = $session['session.user']['id_user'];
            $log['activity'] = $activity;
            $log->save();
        }
    }
}
