<?php
/**
 * Created by PhpStorm.
 * User: maksimtrunov
 * Date: 31.08.14
 * Time: 22:25
 */

namespace app\controllers;

use yii\web\Controller;
use YandexMoney\Presets\MoneySource;
use YandexMoney\Presets\PaymentIdentifier;
use YandexMoney\Presets\Rights;
use YandexMoney\Request\ExternalP2pPaymentRequest;
use YandexMoney\Request\OperationHistoryRequest;
use YandexMoney\Request\P2pPaymentRequest;
use YandexMoney\Request\ProcessExternalPaymentRequest;
use YandexMoney\Request\ProcessPaymentByCardRequest;
use YandexMoney\Request\ProcessPaymentByWalletRequest;
use YandexMoney\YandexMoney;

define ('CLIENT_ID', 'YOUR_CLIENT_ID');
define ('REDIRECT_URI', 'YOUR_REDIRECT_URI');
define ('CLIENT_SECRET', 'YOUR_CLIENT_SECRET');
define ('NOTIFICATION_SECRET', 'YOUR_NOTIFICATION_SECRET');

define('TEST_MODE', 1);
define('APP_MODE', 2);

class YandexController extends Controller
{
	private $currentMode = TEST_MODE;

	public $enableCsrfValidation = false;

	public function actionIndex()
	{
		$rightsConfigurator = YandexMoney::getRightsConfigurator();
		$rightsConfigurator->addRight(Rights::ACCOUNT_INFO);
		$rightsConfigurator->addRight(Rights::OPERATION_HISTORY);
		$rightsConfigurator->addRight(Rights::OPERATION_DETAILS);
		$rightsConfigurator->paymentToAccount("410011161616877", PaymentIdentifier::ACCOUNT, 0, 30);
		$rightsConfigurator->setMoneySource(MoneySource::WALLET);

		$authRequestBuilder = YandexMoney::getAuthRequestBuilder();
		$authRequestBuilder->setClientId(CLIENT_ID);
		$authRequestBuilder->setRedirectUri(REDIRECT_URI);
		$authRequestBuilder->setRights($rightsConfigurator->toString());

		$apiFacade = YandexMoney::getApiFacade();
		$apiFacade->setLogFile(__DIR__ . '/ym.log');

		$originalServerResponse = null;

		try {
			$originalServerResponse = $apiFacade->authorizeApplication($authRequestBuilder);
		} catch (\Exception $e) {
			echo $e->getMessage();
		}


		$this->redirect($originalServerResponse->getHeader('Location'));
	}

	public function actionToken($request)
	{
		$code = $request->query->get('code');
		$error = $request->query->get('error');


		$apiFacade = YandexMoney::getApiFacade();
		$apiFacade->setClientId(CLIENT_ID);
		$apiFacade->setLogFile(__DIR__ . '/ym.log');

		$oAuthTokenResponse = null;
		try {
			$oAuthTokenResponse = $apiFacade->getOAuthToken($code, REDIRECT_URI, CLIENT_SECRET);
		} catch (\Exception $e) {
			echo $e->getMessage();
		}

		$result = "Empty result";
		if ($oAuthTokenResponse != null) {
			if ($oAuthTokenResponse->isSuccess()) {
				$app['session']->set('token', $oAuthTokenResponse->getAccessToken());
				$result = $oAuthTokenResponse->getAccessToken();
			} else {
				$result = $oAuthTokenResponse->getError();
			}


		}

		return $this->render('token', [
			'result' => $result,
		]);
	}
} 