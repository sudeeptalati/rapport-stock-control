<?php

	//echo "HELLO WELCOME TO MAIN<br>";
	//$filename = "mail_server.json";
	//echo dirname(__FILE__)."<br>";
	$smtp_host = '';
	$smtp_username = '';
	$smtp_password = '';
	$smtp_encryption = '';
	$smtp_port = '';
	
	
	$url = dirname(__FILE__);
	$filename = $url."/mail_server.json";
	if(file_exists($filename))
	{
		//echo "File is present<br>";
		$data = file_get_contents($filename);
		$decodedata = json_decode($data, true);
//			echo $decodedata['smtp_host'];
			//echo $result['smtp_host'];	
			$smtp_host = $decodedata['smtp_host'];	
			$smtp_username = $decodedata['smtp_username'];
			$smtp_password = $decodedata['smtp_password'];
			$smtp_encryption = $decodedata['smtp_encryption'];
			$smtp_port = $decodedata['smtp_port'];
			
		
	}//end of if file present.
	else 
	{
		echo "File not found";	
	}//end of else().
	//$smtp_host='smtp.gmail.com';
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

/******** CUSTIOM MODULES START***********/
	$addons=array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'chs',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
	);
	
	$xml=simplexml_load_file($url."/addons.xml");
	foreach($xml->children() as $child)
	{
		$a=(string)$child;
		array_push($addons,$a);
	}
	//print_r($addons);
/******** CUSTIOM MODULES END***********/
	




return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Stock System - Rapport',
	'defaultController'=>'items/freeSearch',
	
		

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
//		'application.modules.models*',
//		'application.modules.user.components.*',
		'application.extensions.yii-mail.*',
		'application.extensions.yii-zip.*',
		//'application.extensions.*',
		'application.vendors.*',

			
	),

	'modules'=>$addons,

	
	
	// application components
	'components'=>array(
			
			'ePdf' => array(
					'class'         => 'ext.yii-pdf.EYiiPdf',
					'params'        => array(
							'mPDF'     => array(
									'librarySourcePath' => 'application.vendors.mpdf.*',
									'constants'         => array(
											'_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
									),
									'class'=>'mpdf', // the literal class filename to be loaded from the vendors folder
									/*'defaultParams'     => array( // More info: http://mpdf1.com/manual/index.php?tid=184
											'mode'              => '', //  This parameter specifies the mode of the new document.
											'format'            => 'A4', // format A4, A5, ...
											'default_font_size' => 0, // Sets the default document font size in points (pt)
											'default_font'      => '', // Sets the default font-family for the new document.
											'mgl'               => 15, // margin_left. Sets the page margins for the new document.
											'mgr'               => 15, // margin_right
											'mgt'               => 16, // margin_top
											'mgb'               => 16, // margin_bottom
											'mgh'               => 9, // margin_header
											'mgf'               => 9, // margin_footer
									'orientation'       => 'P', // landscape or portrait orientation
							)*/
							),
									'HTML2PDF' => array(
									'librarySourcePath' => 'application.vendors.html2pdf.*',
											'classFile'         => 'html2pdf.class.php', // For adding to Yii::classMap
											/*'defaultParams'     => array( // More info: http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:accueil
													'orientation' => 'P', // landscape or portrait orientation
													'format'      => 'A4', // format A4, A5, ...
													'language'    => 'en', // language: fr, en, it ...
													'unicode'     => true, // TRUE means clustering the input text IS unicode (default = true)
									'encoding'    => 'UTF-8', // charset encoding; Default is UTF-8
			'marges'      => array(5, 5, 5, 8), // margins by default, in order (left, top, right, bottom)
			)*/
			)
			),
			),
			
			
			
			/*
			 *MAIL CONFIGURATION 
			 */
					
			'mail' => array(
		        'class' => 'application.extensions.yii-mail.YiiMail',
		        'transportType'=>'smtp', /// case sensitive!
		        'transportOptions'=>array(
		            //'host'=>'mail.laser.com',
		            'host'=>$smtp_host,
					//'username'=>'amspares',
					//'username'=>'mailtest.test10@gmail.com',
					'username'=>$smtp_username,
					// or email@googleappsdomain.com
		            //'password'=>'#general!',
		            //'password'=>'testtest10',
		            'password'=>$smtp_password,
		            //'encryption'=>'ssl',
		            //'encryption'=>'tls',
		            'encryption'=>$smtp_encryption,
					//'port'=>'587',
					//'port'=>'465',
					'port'=>$smtp_port,
		            
		            ),
		        'viewPath' => 'application.views.mail',
		        'logging' => true,
		        'dryRun' => false
		    ),	
			
			
			
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
//			'class'=>'userGroups.components.WebUserGroups',
			),
			
			
		'excel'=>array(
                  'class'=>'application.extensions.PHPExcel',
			),
		// uncomment the following to enable URLs in path-format
		
		/*'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				//accessing gii.
				'gii'=>'gii',
            	'gii/<controller:\w+>'=>'gii/<controller>',
            	'gii/<controller:\w+>/<action:\w+>'=>'gii/<controller>/<action>',
				// REST patterns
				array('api/ItemFreeSearch', 'pattern'=>'api/ItemFreeSearch/<model:\w+>/<keyword:\w+>', 'verb'=>'GET'),
				array('api/Outbound', 'pattern'=>'api/Outbound/<model:\w+>/<item_id:\d+>/<quantity_moved:\d+>', 'verb'=>'GET,POST'),
				array('api/Inbound', 'pattern'=>'api/Inbound/<model:\w+>/<item_id:\d+>/<quantity_moved:\d+>', 'verb'=>'GET,POST'),
				// Other controllers
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
			//	'<controller:\w+>/<action:\w+>/<id:\w+>'=>'<controller>/<action>',
				
				'<controller:\w+>/<action:\w+>/<keyword:\w+>'=>'<controller>/<action>',
				
				 
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				),
    		'showScriptName'=>false,
		),
		*/
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/ims.db',
		),
		// uncomment the following to use a MySQL database
		/*
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=testdrive',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		*/
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
		'adminEmail'=>'stalati@ukwhitegoods.co.uk',
		'company_name'=>'UK Whitegoods',
		'company_address'=>'Unit 5/6 Bonnyton Industrial Estate
Munro Place
Kilmarnock
Ayrshire
Scotland
UK',
		'company_contact_details'=>'Telephone:0845 172 8002 Fax:0845 172 8002 E-mail:stalati@ukwhitegoods.co.uk',
		'vat_in_percentage'=>'20',	
		'software_version'=>'14',	

	),
);

