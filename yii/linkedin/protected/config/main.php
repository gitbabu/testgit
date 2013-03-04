<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.modules.yiiauth.components.*',
		'application.modules.yiiauth.controllers.*',
	),
	
	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'yiiauth'=>array(
        'userClass'=>'User', //the name of your Userclasshttp://http://biziindia.com/pv-dev/v01/hybridauth/
        'config'=>array(
        "base_url" =>"http://spreadthewordapp.com/byio/yii/linkedin/hybridauth", 
        "providers" => array ( 
                // openid providers
               /* "OpenID" => array (
                        "enabled" => true
                ),
                "Yahoo" => array ( 
                        "enabled" => true 
                ),
                "AOL"  => array ( 
                        "enabled" => true 
                ),
        "Google" => array ( 
        "enabled" => true,
        "keys"    => array ("id" => "", "secret" => "" ),
        "scope"   => ""
                        ),*/
       
                        /*"Twitter" => array ( 
                                "enabled" => true,
                                "keys"    => array ( "key" => "rPmGEE1Wvsf56BSyQaWXw", "secret" => "V4SK09O0cPOgkabsxR5AruBSNrc0b1tzoBeWkL7ew0" ) 
                        ),*/
                        // windows live
                       /* "Live" => array ( 
                                "enabled" => true,
                                "keys"    => array ( "id" => "", "secret" => "" ) 
                        ),
                        "MySpace" => array ( 
                                "enabled" => false,
                                "keys"    => array ( "key" => "", "secret" => "" ) 
                        ),*/
                        "Facebook" => array ( 
        "enabled" => true,
        "keys"    => array ( "id" => "242828585838365", "secret" => "b561622c4d204f08b84e73c68e284eed" ),
// A comma-separated list of permissions you want to request from the user. See the Facebook docs for a full list of available permissions: http://developers.facebook.com/docs/reference/api/permissions.
         "scope"   => "email,read_friendlists", 
// The display context to show the authentication page. Options are: page, popup, iframe, touch and wap. Read the Facebook docs for more details: http://developers.facebook.com/docs/reference/dialogs#display. Default: page
                                "display" => "popup" 
                        ),
                        "LinkedIn" => array ( 
                                "enabled" => true,
                                "keys"    => array ("key" => "9hvj1btmfvhk", "secret" => "w1ONNdmLEcsZk1mF") 
                        ),
                       /* "Foursquare" => array (
                                "enabled" => false,
                                "keys"    => array ( "id" => "", "secret" => "" ) 
                        ),*/
                ),

                // if you want to enable logging, set 'debug_mode' to true  then provide a writable file by the web server on "debug_file"
                "debug_mode" => false,

                "debug_file" => "",
        ),
                ),
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123456',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=spw_byio',
			'class'=>'application.extensions.PHPPDO.CPdoDbConnection',
      'pdoClass' => 'PHPPDO',
			'emulatePrepare' => true,
			'username' => 'spw_bu',
			'password' => '$2-BNyvXzRw^',
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