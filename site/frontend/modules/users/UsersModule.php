<?php

namespace site\frontend\modules\users;

/**
 * Модуль нужен исключительно для тестирования. Работает только при включеном YII_DEBUG
 */
class UsersModule extends \CWebModule
{

    public $controllerNamespace = 'site\frontend\modules\users\controllers';

    public function init()
    {
        \Yii::app()->setComponent('authManager', array(
            'class' => '\site\frontend\components\AuthManager',
            'showErrors' => YII_DEBUG,
        ));
    }
}
