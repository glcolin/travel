<?php
// Version
define('VERSION', '1.0.1');

// Configuration
if (file_exists('config.php')) {
	require_once('config.php');
}  

// Startup
require_once(DIR_SYSTEM . 'startup.php');

// Application Classes
require_once(DIR_SYSTEM . 'app/admin/user.php');

// Registry
$registry = new Registry();

// Loader
$loader = new Loader($registry);
$registry->set('load', $loader);

// Request
$request = new Request();
$registry->set('request', $request);

// Response
$response = new Response();
$response->addHeader('Content-Type: text/html; charset=utf-8');
$registry->set('response', $response); 

// Session
$session = new Session();
$registry->set('session', $session);

//Language (Optional)
require_once(DIR_HOME . 'language/language.php');

// Url
$url = new Url();	
$registry->set('url', $url);

// Document
$registry->set('document', new Document()); 

//Tools
$registry->set('mail', new PHPMailer()); 

// Config
$registry->set('config', new Config()); 

// Database
$db = new DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
$registry->set('db', $db);

// User
$registry->set('user', new User($registry));

// Front Controller 
$controller = new Front($registry);

//login or no
$user=$registry->get('user');
if ($user->isLogged()){ 
	// Router
	if (isset($request->get['route'])) {
		$action = new Action($request->get['route']);
	} else {
		$action = new Action('common/home');
	}
}
else{
	if (isset($request->get['route'])) {
		if($request->get['route']=="common/login/login" || $request->get['route']=="common/forgotten"){
			$action = new Action($request->get['route']);
		}
		else{
			$action = new Action('common/login');
		}	
	}
	else{
		$action = new Action('common/login');
	}
}



// Dispatch
$controller->dispatch($action, new Action('error/not_found'));

//Test (Reserved)
//echo '<pre>';
//print_r($registry);
//die();

// Output
$response->output();





