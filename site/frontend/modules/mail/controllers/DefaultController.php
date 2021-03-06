<?php

class DefaultController extends HController
{
//    public function filters()
//    {
//        return array(
//            'accessControl',
//        );
//    }

    public function accessRules()
    {
        return array(
            array('allow',
                'roles' => array('tester'),
            ),
            array('deny',
                'users' => array('*'),
                'actions' => array('dialogues', 'daily'),
            ),
        );
    }

    /**
     * Редирект из почтовой рассылки
     *
     * Аутентифицирует гостя в случае наличия активного токена. Помечает запись о доставке как "кликнутую", в случае
     * если это еще не было сделано ранее.
     *
     * @param $redirectUrl
     * @param $tokenHash
     * @param $deliveryHash
     */
    public function actionRedirect($redirectUrl, $tokenHash, $deliveryHash)
	{
        if (Yii::app()->user->isGuest) {
            $identity = new MailTokenUserIdentity($tokenHash);
            if ($identity->authenticate()) {
                Yii::app()->user->login($identity);
            }
        }

        $delivery = MailDelivery::model()->findByAttributes(array(
            'hash' => $deliveryHash,
            'clicked' => null,
        ));

        if ($delivery !== null) {
            $delivery->clicked();
        }

        $this->redirect(urldecode($redirectUrl));
	}

    public function actionNotifications()
    {
        $sender = new MailSenderNotification(MailSenderNotification::TYPE_COMMENT);
        $sender->sendAll();

        $sender = new MailSenderNotification(MailSenderNotification::TYPE_DISCUSS);
        $sender->sendAll();

        $sender = new MailSenderNotification(MailSenderNotification::TYPE_REPLY);
        $sender->sendAll();
    }

    public function actionDialogues($sendAll = false)
    {
        $sender = new MailSenderDialogues();
        if ($sendAll !== false) {
            $sender->sendAll();
        } else {
            $sender->preview(Yii::app()->user->model);
        }
    }

    public function actionNotification()
    {
        $sender = new MailSenderNotification(MailSenderNotification::TYPE_COMMENT);

            $sender->sendAll();

    }

    public function actionDaily($date = null, $sendAll = false)
    {
        $sender = new MailSenderDaily($date);
        if ($sendAll !== false) {
            $sender->sendAll();
        } else {
            $sender->preview(Yii::app()->user->model);
        }
    }
}