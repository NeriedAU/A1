<?php
	//Using Smarty Template Engine
	session_id($_GET['session']);
	session_start();
	//print_r($_SESSION);
	require('/home/ubuntu/composer/vendor/smarty/smarty/libs/Smarty.class.php');
	$smarty = new Smarty();
	$smarty->setTemplateDir('/home/ubuntu/webroot/a1/views');
	$smarty->setCompileDir('/home/ubuntu/webroot/a1/temp');
	
	$smarty->assign('result', $_SESSION["results"]);
	$smarty->display('results.tpl');
	
?>