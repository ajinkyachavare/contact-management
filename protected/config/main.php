<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
$local = array();

if(file_exists($file=dirname(__FILE__).'/main-local.php'))
	$local = require($file);

return CMap::mergeArray(
	array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Contact Management',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		'admin'=>array(
			'components' => array(
				'user' => array(
					'class'          => 'CWebUser',
					'allowAutoLogin' => true,
					'stateKeyPrefix' => '_admin',
					'returnUrl' => array('default/index'), # page after login
					'loginUrl' => array('admin/default/login'), # login form path
				),
			),
		),
	),

	// application components
	'components'=>array(
        'swiftMailer' => array(
            'class' => 'ext.swiftMailer.SwiftMailer',
        ),
        'ePdf' => array(
            'class'         => 'ext.yii-pdf.EYiiPdf',
            'params'        => array(
                'mpdf'     => array(
                    'librarySourcePath' => 'application.vendors.mpdf.*',
                    'constants'         => array(
                        '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
                    ),
                    'class'=>'mpdf', // the literal class filename to be loaded from the vendors folder
                ),
                'HTML2PDF' => array(
                    'librarySourcePath' => 'application.vendors.html2pdf.*',
                    'classFile'         => 'html2pdf.class.php', // For adding to Yii::$classMap
                )
            ),
        ),

		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),

		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName' => false,
			'rules'=>array(

				//RULES GII
				'gii'=>'gii',
         		'gii/<controller:\w+>'=>'gii/<controller>',
         		'gii/<controller:\w+>/<action:\w+>'=>'gii/<controller>/<action>',

         		//RULES MODULE ADM
				'admin'=>'admin',
			//	'<module>/<action>' => '<module>/default/<action>',

				//RULES OF SITE
				''=>'site/index',
				'<view:(about)>'=>'site/page',
				'<action:(index|contact|login|logout)>'=>'site/<action>',

				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),

		// database settings are configured in database.php
		'db'=>require(dirname(__FILE__).'/database.php'),


		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'ajinkya.chavare@outlook.com',
	),
),
$local
);
