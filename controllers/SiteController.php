<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\RegisterForm;
use app\models\RecoveryForm;

class SiteController extends Controller
{

	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'only' => ['logout', 'index'],
				'rules' => [
					[
						'allow' => true,
						'roles' => ['@'],
					],
					[
						'allow' => true,
						'roles' => ['@']
					],
				],
			],
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'logout' => ['get'],
				],
			],
		];
	}

	public function actions()
	{
		return [
			'captcha' => [
				'class' => 'yii\captcha\CaptchaAction',
				'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
			],
		];
	}

	public function actionPhpinfo()
	{
		return $this->render('phpinfo');
	}

	public function actionIndex()
	{
		return $this->render('index');
	}

	public function actionRtc()
	{
		return $this->render('rtc');
	}

	public function actionLogin()
	{
		$this->layout = 'login';

		if (!\Yii::$app->user->isGuest) {
			return $this->goHome();
		}

		$model = new LoginForm();

		if (Yii::$app->request->isPost) {
			$model->setAttributes(Yii::$app->request->post('LoginForm'));
			if ($model->login()) {
				$this->goBack();
			}
		}

		return $this->render('login', [
			'model' => $model,
		]);

	}

	public function actionRegister()
	{
		$this->layout = 'login';

		$model = new RegisterForm();

		if (Yii::$app->request->isPost) {
			if ($model->load(Yii::$app->request->post()) && $model->validate()) {
				if ($model->register()) {
					$this->goHome();
				}
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

	public function actionRecovery()
	{
		$this->layout = 'login';

		$model = new RecoveryForm();

		if (Yii::$app->request->isPost) {
			if ($model->load(Yii::$app->request->post()) && $model->validate()) {
				if ($model->sendToken()) {
					Yii::$app->session->setFlash('recoveryMessage', 'Сообщение с для восстановления пароля отправлено');
					$this->redirect(Url::toRoute('login'));
				} else {
					Yii::$app->session->setFlash('recoveryMessage', 'Не удалось отправить сообщение');
					return $this->render('recovery', [
						'model' => $model,
					]);
				}
			}
		}

		return $this->render('recovery', [
			'model' => $model,
		]);
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
}
