<?php

return array(
	'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
	'name' => 'Админка',

	'import'=>array(
        'site.frontend.components.*',
        'site.frontend.extensions.LinkPager',
        'site.frontend.extensions.ufile.UFiles',
		'site.common.models.*',
		'application.models.*',
		'application.components.*',
        'site.frontend.modules.attribute.models.*',
	),
	
	'components' => array(
        'widgetFactory' => array(
            'widgets' => array(
                'LinkPager' => array(
                    'cssFile' => FALSE,
                    'header' => '',
                    'nextPageLabel' => '',
                    'prevPageLabel' => '',
                    'maxButtonCount' => 5,
                ),
            ),
        ),
		'urlManager' => array(
			'urlFormat'=>'path',
		),
        'db' => array(
            'schemaCachingDuration' => 3600,
            'enableProfiling' => true,
            'enableParamLogging' => true,
            'tablePrefix'=> '',
        ),
	),
);