<?php
//Session Load
session_start();

//Configuration Load
require_once("config.php");

//Autoload
function __autoload($class_name) {
    require_once(WEBSITE_PATH.'inc/class/'.$class_name.'.class.php');
}


//Dispatcher
if(isset($_GET['app']) && !empty($_GET['app'])){
	if(array_key_exists($_GET['app'], $authorizedApps)){
		
		$appToCall = $authorizedApps[$_GET['app']];
		
		$do = (isset($_GET['do']) && !empty($_GET['do'])) ? $_GET['do'] : $appToCall;
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
	$d = new $dispatcherToCall();
	$d->$do();
}
else{
	header('HTTP/1.0 404 Not Found');
    exit();
}
?>