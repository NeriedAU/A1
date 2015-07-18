<?php
	
	session_id($_GET['session']);
	session_start();
	
	//Using Smarty Template Engine
	require('/home/ubuntu/composer/vendor/smarty/smarty/libs/Smarty.class.php');
	$smarty = new Smarty();
	$smarty->setTemplateDir('/home/ubuntu/webroot/a1/views');
	$smarty->setCompileDir('/home/ubuntu/webroot/a1/temp');
	
	$smarty->assign('result', $_SESSION["results"]);
	$smarty->display('results.tpl');
	
?>