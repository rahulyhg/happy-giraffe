<?php

namespace site\frontend\modules\iframe\modules\userProfile;

/**
 * Description of PostsModule
 *
 * @author Кирилл
 */
class UserProfileModule extends \CWebModule
{
    public $controllerNamespace = 'site\frontend\modules\iframe\modules\userProfile\controllers';

    public function init()
    {
        \Yii::app()->setComponent('authManager', array(
            'class' => '\site\frontend\components\AuthManager',
        ));
        \Yii::app()->clientScript->registerPackage('pediatrician-iframe');
    }
}