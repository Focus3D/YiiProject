<?php
$rightsConfigurator = YandexMoney::getRightsConfigurator();
        $rightsConfigurator->addRight(Rights::ACCOUNT_INFO);
        $rightsConfigurator->addRight(Rights::OPERATION_HISTORY);
        $rightsConfigurator->addRight(Rights::OPERATION_DETAILS);
        $rightsConfigurator->paymentToAccount("410011161616877", PaymentIdentifier::ACCOUNT, 0, 30);
        $rightsConfigurator->paymentToPattern("337", 0, 30);
        $rightsConfigurator->setMoneySource(MoneySource::CARD);


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


        return new Response('', $originalServerResponse->getCode(
        ), array('Location' => $originalServerResponse->getHeader('Location')));