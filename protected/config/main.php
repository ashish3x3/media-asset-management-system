<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'CDEEP',

	// preloading 'log' component
	'preload'=>array('log'),

	//path alises
	'aliases'=>array(
	'bootstrap'=>realpath(__DIR__.'/../extensions/bootstrap'),
     'yiiwheels'=>realpath(__DIR__.'/../extensions/yiiwheels'),
	),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.vendors.*',
		//bootstrap widgets
		'bootstrap.helpers.TbHtml',
		'bootstrap.helpers.TbArray',
		'bootstrap.behaviors.TbWidget',
		'bootstrap.widgets.TbDataColumn',
		'bootstrap.widgets.TbActiveForm',
		'yiiwheels.widgets.datepicker.WhDatePicker',
		'bootstrap.widgets.TbGridView',
		'bootstrap.widgets.TbGridView1',
		//log4php widgets
		'application.extensions.log4php.*',
		'application.extensions.log4php.renderers.*',
		'application.extensions.log4php.appenders.*',
		'application.extensions.log4php.configurators.*',
		'application.extensions.log4php.filters.*',
		'application.extensions.log4php.helpers.*',
		'application.extensions.log4php.layouts.*',
		//image magic components
		'application.helpers.*',
		'application.extensions.ImageMagick.*',
		'application.extensions.imagemodifier.CImageModifier.*',
		'application.extensions.imagemodifier.*',
		'application.components.CTagCloud',
		'application.extensions.cumulus.Tagcloud'
		
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'media'=>array(
        // Base dir for media browser (app/files):
        'baseDir'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'file',
    ),
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'gii',  //password for gii
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
			
		'generatorPaths'=>array('bootstrap.gii'),
		),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),

		//image magic application components
		'image'=>array(
				'class'=>'application.extensions.image.CImageComponent',
				// GD or ImageMagick
				'driver'=>'GD2+',
				'driver'=>'ImageMagick',
				// ImageMagick setup path
				'params'=>array('directory'=>'C:/ImageMagick'),
		),
		//image magic extension directory	
		'imagemod' => array(
				//alias to dir, where you unpacked extension
				'class' => 'application.extensions.imagemodifier.CImageModifier',
		),
		//aes256 encryption extension
		'aes256'=>array(
            'class' => 'application.extensions.aes256.Aes256',
            'privatekey_32bits_hexadecimal'=> '0123456789012345678901234567890123456789012345678901234567890123', // be sure that this parameter uses EXACTLY 64 chars of hexa (a-f, 0-9)
        ),
        
        'aes256'=>array(
            'class' => 'application.extensions.PHPMailer.PHPMailerAutoload',
            
        ),
		
		'tagcloud'=>array(
		
							'class'=>'application.extensions.cumulus.Tagcloud.php'
		
		),
		
		/* Handling Session
		'session' => array (
		'sessionName' => 'Site Session',
		'class'=>'CDbHttpSession',
		'useTransparentSessionID'   =>($_POST['PHPSESSID']) ? true : false,
		'autoStart' => false,
		'cookieMode' => 'only',
		'timeout' => 300,
		'autoCreateSessionTable'=> false,
		'connectionID' => 'db', 
		'sessionTableName' => 'Session', 
		),*/
        
		 // yiistrap configuration
        'bootstrap' => array(
            'class' => 'bootstrap.components.TbApi',
        ),
        
        // yiiwheels configuration
        'yiiwheels' => array(
            'class' => 'yiiwheels.YiiWheels',   
        ),
		
		
		//for mail configuration
	/*	'Smtpmail'=>array(
		
		'class'=>'application.extensions.smtpmail.PHPMailer',
		'Host'=>"smtp-auth.iitb.ac.in",
		'Username'=>'selvarani',
		'Password'=>'selva!23',
		'Mailer'=>'smtp',
		'Port'=>25,
		'SMTPAuth'=>true, 
        'SMTPStarttlsEnable'=>true,
        'STMPSslTrust'=>"smtp-auth.iitb.ac.in",
		'SMTPSecure' => 'tls',
        ),
	*/	
		
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=final_28',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		
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
				
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
				
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);