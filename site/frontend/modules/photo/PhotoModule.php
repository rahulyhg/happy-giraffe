<?php

namespace site\frontend\modules\photo;

class PhotoModule extends \CWebModule
{
    public $quality;
    public $types;

    public $controllerNamespace = '\site\frontend\modules\photo\controllers';

	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'photo.models.*',
			'photo.components.*',
		));

        \Yii::app()->setComponent('authManager', array(
            'class' => '\site\frontend\components\AuthManager',
            'showErrors' => YII_DEBUG,
        ));
	}
}
