<?php
return [

	'DataBase' => [							// All Databases availables
		'localVarName' => [					// to get a local name : $localVarName = $PDO
			'PDO'		=> null,
			'type' 		=> 'mysql',
			'host' 		=> '127.0.0.1',
			'name' 		=> 'dev',			// ---------------------
			'login'		=> 'dev',			// NEVER do this, it's just an exemple !
			'password' 	=> 'dev', 			// ---------------------
			'collation'	=> '',
			'charset' 	=> '',
		]
	],

	'Autoloader' => [
		'App' => 'App/src/',
		'Frame' => 'Framework/',
		'' => 'Vendor/',
	],

	'Router' => [
		# default behavior
		'homepage' => "/Page/home.html",
		'controllers' => "App\\controllers\\",
		'API' => [
			'status' => 'open',
			'slug' => 'api',
			'JSRouting' => 'App/src/assets/html/JSRouting.html'
		],
	],
];
