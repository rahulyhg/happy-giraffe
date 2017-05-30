<?php

namespace site\frontend\modules\signup\components;

/**
 * Действие контроллера, обрабатывающая аутентификацию через социальные сети
 */

class SignupSocialAction extends \SocialAction
{
    public $fromLogin;
    public $baseHostInfo;

    public function run()
    {
        $action = $this;
        $controller  = $this->getController();
        $request     = \Yii::app()->request;
        $sessionUser = \Yii::app()->user;

        /*
        Проверяем хост с которого пришел запрос,
        перенаправляем запрос на родительский хост
        с указанием обратного адреса
         */
        if ($request->hostInfo != $this->baseHostInfo) {
            $url = $this->baseHostInfo .
            '/' . $request->pathInfo .
            '/?' . http_build_query([
                'return_host' => $request->hostInfo,
            ]);
            $request->redirect($url);
        }

        /*
        Если в параметре запроса указан обратный адрес,
        сохраняем в сессионную переменную
         */
        $returnHost = $request->getQuery('return_host');
        if (!empty($returnHost)) {
            $sessionUser->setState('returnHost', $returnHost);
        }

        $this->successCallback = function ($eauth) use ($action, $sessionUser) {
            \Yii::log(print_r($eauth, true), 'info', 'eauth');

            $sessionUser->setState('socialService', array(
                'name' => $eauth->getServiceName(),
                'id'   => $eauth->getAttribute('uid'),
            ));

            $socialManager = new SocialManager($eauth);
            $eauth->component->setRedirectView('signup.views.redirect');
            $params = $socialManager->getData();
            $params['returnHost'] = $sessionUser->getState('returnHost') ?: '';
            $eauth->redirect(null, $params);
        };

        parent::run();
    }
}
