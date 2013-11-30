<?php
//Session Load
session_start();

//Configuration Load
require_once("config.php");
require_once("lib/functions.php");

//Autoload
function __autoload($class_name) {
    require_once(WEBSITE_PATH.'inc/class/'.$class_name.'.class.php');
}


//Dispatcher
$get = explode('/', $_GET['arguments']);
$getApp = (isset($get[0]) && !empty($get[0])) ? $get[0] : '';
$getDo = (isset($get[1]) && !empty($get[1])) ? $get[1] : '';
$get = array_slice($get, '2');

if(isset($getApp) && !empty($getApp)){
	if(array_key_exists($getApp, $authorizedApps)){
		
		$appToCall = $authorizedApps[$getApp];
		
		$do = (isset($getDo) && !empty($getDo)) ? $getDo : $appToCall;
	}
	else{
		header('HTTP/1.0 404 Not Found');
		exit();
	}
}
else{
	$appToCall = $authorizedApps[DEFAULT_APP];
	$do = DEFAULT_APP;
}

//Master Controller
if(is_file('./apps/'.$appToCall.'/'.$appToCall.'.controller.class.php') ){

	require_once(WEBSITE_PATH.'apps/'.$appToCall.'/'.$appToCall.'.controller.class.php');
		
	$dispatcherToCall = $appToCall.'Controller';
	debug($get);
	$d = new $dispatcherToCall();
	$d->params = $get;
	$d->$do();
}
else{
	header('HTTP/1.0 404 Not Found');
    exit();
}
?>