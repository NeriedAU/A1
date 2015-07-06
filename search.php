<!DOCTYPE html>

<?php require_once('connect.php');	?>

<html lang="en">

	<head>
	
		<title>Assignment 1</title>		
		
		<link rel="stylesheet" href="css/bootstrap.min.css" />		
		
	</head>
	
	<body>

		<div class="container">		
		
			<form class="form-horizontal" action="answer.php" method="get">	
			
				<div class="form-group">		
				
					<label for "searchInputName">Wine Name</label>
					
					<input type="text" name="wineName" class="form-control" id="searchInputName" placeholder="Name or partial name of a wine...">				
					
				</div>
				
				<div class="form-group">

					<label for "searchInputWineryName">Winery Name</label>
					
					<input type="text" name="wineryName" class="form-control" id="searchInputWineryName" placeholder="Name or partial name of a Winery...">	
					
				</div>
				
				<div class="form-group">					
					<label for "searchSelectRegion">Region</label>
					<select class="form-control" name="wineRegion" id="searchSelectRegion">
						<?php
							$region_query = "SELECT region_name FROM region";
							foreach($db->query($region_query) as $row) {
								echo "<option>" . $row['region_name'] . "</option>";
							}
						?>
					</select>
				</div>
				
				<div class="form-group">					
					<label for "searchSelectGrapeVariety">Grape Variety</label>
					<select class="form-control" name="grapeVariety" id="searchSelectGrapeVariety">
						<?php
							$variety_query = "SELECT variety FROM grape_variety";
							foreach($db->query($variety_query) as $row) {
								echo "<option>" . $row['variety'] . "</option>";
							}
						?>
					</select>
				</div>
				
				<?php
						$year_query = "SELECT MIN(year) as min_year, MAX(year) as max_year FROM wine";
						foreach($db->query($year_query) as $row) {
							$min_year = $row['min_year'];
							$max_year = $row['max_year'];
						}						
					?>
				
				<div class="form-group">				
				
					<label for "searchSelectFromYear">From year</label>
					<select id="searchSelectFromYear" name="wineYearMin" class="form-control">
						<?php
							for($i = $min_year; $i <= $max_year; $i++) {
								echo "<option>" . $i . "</option>";
							}
						?>
					</select>					
				</div>
				
				<div class="form-group">				
				
					<label for "searchSelectToYear">To year</label>
					<select id="searchSelectToYear" name="wineYearMax" class="form-control">
						<?php
							for($i = $min_year; $i <= $max_year; $i++) {
								if($i == $max_year) {
									echo "<option selected>" . $i . "</option>";
								}
								else {
									echo "<option>" . $i . "</option>";
								}
							}
						?>
					</select>					
				</div>
				
				<div class="form-group">	
					<!-- Displays results with on_hand value >= specified in this field -->
					<label for "searchInputMinInStock">Minimum bottles in stock</label>
					<input type="number" name="minInStock" class="form-control" id="searchInputMinInStock" min="0">					
				</div>
				
				<div class="form-group">	
					<!-- Minimum number of bottles sold for any wine -->
					<label for "searchInputMinWineSold">Minimum total bottles sold in an order</label>
					<input type="number" name="minSold" class="form-control" id="searchInputMinWineSold" min="0">					
				</div>
				
				<div class="form-group">	
					<label for "searchInputMinCost">Minimum cost per bottle</label>
					<input type="number" name="minCost" class="form-control" id="searchInputMinCost">					
				</div>
				
				<div class="form-group">	
					<label for "searchInputMaxCost">Maximum cost per bottle</label>
					<input type="number" name="maxCost" class="form-control" id="searchInputMaxCost">					
				</div>
				
				<button type="submit" class="btn btn-primary form-control">Search</button>
				
			</form>
		</div>
	</body>
</html>