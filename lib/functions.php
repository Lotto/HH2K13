<?php
function debug($var, $die = false)
{
	$backtrace = debug_backtrace();
	echo '<p><a href="#" onclick="$(this).parent().next(\'ol\').slideToggle(); return false;"><strong>'.$backtrace[0]['file'].'</strong> l.'.$backtrace[0]['line'].'</a></p>';
	echo '<ol style="display: none;">';
	foreach ($backtrace as $key => $value) 
	{
		if ($key > 0)
			echo '<li><strong>'.$value['file'].'</strong> l.'.$value['line'].'</li>';
	}
	echo '</ol>';
	echo '<pre>';
	print_r($var);
	echo '</pre>';

	if ($die)
		die();
}
?>