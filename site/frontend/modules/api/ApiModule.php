<?php

namespace site\frontend\modules\api;

class ApiModule extends \CWebModule
{
    /**current api version for take latest behavior in outer code*/
    const CURRENT = 'v1_1';
    const CACHE_DELETE = '\site\frontend\modules\api\modules\v1_1\behaviors\CacheDeleteBehavior';

    public function init()
    {
        \Yii::app()->setComponent('authManager', array(
            'class' => '\site\frontend\components\AuthManager',
        ));

        $this->setModules(array(
            'v1' => array (
                'class' => 'site\frontend\modules\api\modules\v1\ApiVersionModule',
                'controllerNamespace' => 'site\frontend\modules\api\modules\v1\controllers',
            ),
            'v1_1' => array (
                'class' => 'site\frontend\modules\api\modules\v1_1\ApiVersionModule',
                'controllerNamespace' => 'site\frontend\modules\api\modules\v1_1\controllers',
            ),
        ));
    }

    public function beforeControllerAction($controller, $action)
    {
        if (parent::beforeControllerAction($controller, $action)) {
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        } else {
            return false;
        }
    }
}