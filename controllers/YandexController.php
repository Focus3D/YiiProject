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

class PaymentController extends Controller
{
	public $enableCsrfValidation = false;

	public function actionIndex()
	{
		$rightsConfigurator = YandexMoney::getRightsConfigurator();
		$rightsConfigurator->addRight(Rights::ACCOUNT_INFO);
		$rightsConfigurator->addRight(Rights::OPERATION_HISTORY);
		$rightsConfigurator->addRight(Rights::OPERATION_DETAILS);
		$rightsConfigurator->paymentToAccount("410011161616877", PaymentIdentifier::ACCOUNT, 0, 30);
		$rightsConfigurator->paymentToPattern("337", 0, 30);
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


		return $this->render('index', [
			'code' => $originalServerResponse->getCode(),
			'location' => $originalServerResponse->getHeader('Location'),
		]);
	}
} 