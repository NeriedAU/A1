<?php
	//Using Smarty Template Engine
	require('/home/ubuntu/composer/vendor/smarty/smarty/libs/Smarty.class.php');
	require_once('connect.php');
	
	$smarty = new Smarty();
	$smarty->setTemplateDir('/home/ubuntu/webroot/a1/views');
	$smarty->setCompileDir('/home/ubuntu/webroot/a1/temp');
	
	$wineName = $_GET['wineName'];	
	$wineryName = $_GET['wineryName'];
	$wineRegion = $_GET['wineRegion'];
	$grapeVariety = $_GET['grapeVariety'];
	$wineYearMin = $_GET['wineYearMin'];
	$wineYearMax = $_GET['wineYearMax'];
	$minInStock = $_GET['minInStock'];
	$minSold = $_GET['minSold'];
	$minCost = $_GET['minCost'];
	$maxCost = $_GET['maxCost'];
	
	if($wineRegion == 'All')
		unset($wineRegion);
	
	$sql = "
		SELECT  wine_id, wine_name, winery_name, region_name, variety, year, on_hand, cost
		FROM wine 
			NATURAL JOIN winery 
			NATURAL JOIN region 
			NATURAL JOIN grape_variety  
			NATURAL JOIN inventory 
			NATURAL JOIN items 
		WHERE wine_name LIKE '$wineName%' 
			AND winery_name LIKE '$wineryName%' 
			AND region_name LIKE '$wineRegion%' 
			AND variety = '$grapeVariety' 
			AND year BETWEEN '$wineYearMin' AND '$wineYearMax' 
			AND on_hand >= '$minInStock'";

		if(!empty($minCost)) {
			$sql .= "AND cost > '$minCost'";
		}
		
		if(!empty($maxCost))
			$sql .= "AND cost < '$maxCost'";
	
	$query_results = Array();
	
	$select_query = $db->prepare($sql);
	$select_query->execute();
	
	 foreach($select_query->fetchAll() as $row) {
		 $query_results[] = $row;
	 }
	
	$smarty->assign('num_rows', count($query_results));
	$smarty->assign('sql', $sql);
	$smarty->assign('result', $query_results);
	$smarty->display('results.tpl');
	
	$db = null;
	
?>