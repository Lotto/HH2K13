<?php
define("WEBSITE_ENV", "dev");
define("WEBSITE_VERSION", "0.1");
define("WEBSITE_NAME", "HH2K13");
define("WEBSITE_SNAME", "Les découpeurs");
define("WEBSITE_LONG_NAME", WEBSITE_NAME." | ".WEBSITE_SNAME);
define("WEBSITE_SMALL_NAME", " | ".WEBSITE_SNAME);

define("WEBSITE_LINK", "http://ogre-rouen.fr/HH2K13/");
if ( !defined("WEBSITE_PATH") )
	define("WEBSITE_PATH", dirname(__FILE__) . "/");

define("DATABASE_HOST", "localhost");
define("DATABASE_NAME", "HH2K13"); 
define("DATABASE_LOGIN", "HH2K13");
define("DATABASE_PASSWORD", "HH2K13");

//Authorized Apps
define("DEFAULT_APP", "home");
$authorizedApps = array(
	"home" 			=> "home",
	"new"			=> "new",
	"errors"		=> "errors");

//Error Manage
if(WEBSITE_ENV == "prod"){
	ini_set("display_errors", 0);
	ini_set("log_errors", 1);
	error_reporting(E_ALL);
}
else{
	error_reporting(E_ALL);
}
?>
