<?php

namespace app\controllers;

use app\models\RegisterForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
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

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

		$model = new LoginForm();

		if($model->setAttributes(Yii::$app->request->post('LoginForm')) && $model->validate()) {
			/*if($model->login()){
				$this->goBack();
			}*/
		}

		return $this->render('login', [
			'model' => $model,
			'identity' => User::findByUsername(['username' => $model->username]),
		]);

    }

	public function actionRegister()
	{
		if (!\Yii::$app->user->isGuest) {
			return $this->goHome();
		}

		$model = new RegisterForm();

		if(Yii::$app->request->isPost) {
			$model->setAttributes(Yii::$app->request->post('RegisterForm'));
			if($model->register()) {
				$this->redirect(Yii::$app->urlManager->createUrl('site/login'));
			}
		}

		return $this->render('register', [
			'model' => $model,
			'post' => Yii::$app->request->post('RegisterForm'),
		]);
	}

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}
