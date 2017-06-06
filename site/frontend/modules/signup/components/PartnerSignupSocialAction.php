<?php

namespace site\frontend\modules\signup\components;

/**
*
*/
class PartnerSignupSocialAction extends \CAction
{

    public $fromLogin = false;

    public function run()
    {
        $request     = \Yii::app()->request;
        $sessionUser = \Yii::app()->user;

        if(isset($_SERVER['HTTP_REFERER']) and rtrim($_SERVER['HTTP_REFERER'], '/') == rtrim($request->hostInfo, '/')){
            $this->controller->params = $_GET;
            $user = $request->getQuery('user');
            $attributes = $request->getQuery('attributes');
            $service = $request->getQuery('service');

            if(!empty($user) and isset($user['id'])
                and !empty($attributes) and isset($attributes['uid'])
                and !empty($service)){
                $sessionUser->setState('possibleUserId', $user['id']);
                $sessionUser->setState('socialService', array(
                    'name' => $service,
                    'id'   => $attributes['uid'],
                ));
                $this->controller->renderPartial('signup.views.redirect');

                return;
            }

            throw new \CHttpException(400);
        }

        throw new \CHttpException(403);
    }
}
