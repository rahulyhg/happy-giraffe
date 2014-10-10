<?php

namespace site\frontend\modules\seo;

class SeoModule extends \CWebModule
{
    public $controllerNamespace = '\site\frontend\modules\seo\controllers';

	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'seo.models.*',
			'seo.components.*',
            'site.common.extensions.restcurl.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}