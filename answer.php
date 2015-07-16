<?php
	//Using Smarty Template Engine
	require('/home/ubuntu/composer/vendor/smarty/smarty/libs/Smarty.class.php');
	require_once('connect.php');
	
	$smarty = new Smarty();
	$smarty->setTemplateDir('/home/ubuntu/webroot/a1/views');
	$smarty->setCompileDir('/home/ubuntu/webroot/a1/temp');
	
	$wineName = 		validateStrInput($_GET['wineName'], 50);	
	$wineryName = 		validateStrInput($_GET['wineryName'], 100);
	$wineRegion = 		validateStrInput($_GET['wineRegion'], 100);
	$grapeVariety = 	validateStrInput($_GET['grapeVariety'], 50);
	$wineYearMin = 	validateNumInput($_GET['wineYearMin'], 4);
	$wineYearMax = 	validateNumInput($_GET['wineYearMax'], 4);
	$minInStock = 		validateNumInput($_GET['minInStock'], 5);
	$minSold = 			validateNumInput($_GET['minSold'], 10);
	$minCost = 			validateNumInput($_GET['minCost'], 7);
	$maxCost = 			validateNumInput($_GET['maxCost'], 7);
	
	if($wineRegion == 'All')
		unset($wineRegion);
		
	$sql = "
			SELECT 
				wine.wine_id,
				wine.wine_name, 
				winery.winery_name, 
				region.region_name, 
				GROUP_CONCAT(variety) AS grapes, 
				wine.year, 
				inventory.on_hand, 
				inventory.cost, 
				(SELECT SUM(qty) * price FROM items WHERE items.wine_id = wine.wine_id) AS revenue,
				(SELECT SUM(qty) FROM items WHERE items.wine_id = wine.wine_id) AS total_sold
			FROM wine
			INNER JOIN winery ON wine.winery_id = winery.winery_id
			INNER JOIN region ON winery.region_id = region.region_id
			INNER JOIN wine_variety ON wine_variety.wine_id = wine.wine_id 
			INNER JOIN grape_variety ON grape_variety.variety_id = wine_variety.variety_id
			INNER JOIN inventory ON inventory.wine_id = wine.wine_id
			WHERE wine.wine_name LIKE '$wineName%'
			AND winery.winery_name LIKE '$wineryName%'
			AND region.region_name LIKE '$wineRegion%'
			AND wine.year BETWEEN '$wineYearMin' AND '$wineYearMax'
			AND inventory.on_hand >= '$minInStock'";
			
		if(!empty($minCost))
			$sql .= "AND inventory.cost > '$minCost'";
			
		if(!empty($maxCost))
			$sql .= "AND inventory.cost < '$maxCost'";
			
		$sql .= "GROUP BY wine.wine_id
			HAVING FIND_IN_SET(  '$grapeVariety', grapes )";
		
		if(!empty($minSold))
			$sql .= "AND total_sold >= '$minSold'";
	
	$query_results = Array();
	
	try {	
		$select_query = $db->prepare($sql);
		$select_query->execute();	
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}
		
	 foreach($select_query->fetchAll() as $row) {
		//Append $row to end of array
		 $query_results[] = $row;
	 }
	
	$smarty->assign('sql', $sql);
	
	session_start();
	$_SESSION["results"] = $query_results;
	header("Location: results.php?session=" . session_id());
		
	$db = null;
	
	function validateStrInput($input, $maxLength) {
	
		$input = validateLength($input, $maxLength);		
		$input = trim($input);
		$input = stripslashes($input);
		return $input;
	}
	
	function validateNumInput($input, $maxLength) {
		$input = validateLength($input, $maxLength);	
		
		if(!is_numeric($input))
			return 0;
		
		return $input;
	}
	
	function validateLength($input, $maxLength) {
		if(strlen($input) > $maxLength)
			$input = substr($input, 0, $maxLength);
		
		return $input;
	}


	
?>