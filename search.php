<!DOCTYPE html>

<?php include_once('connect.php');	?>

<html lang="en">

	<head>
	
		<title>Assignment 1</title>		
		
		<link rel="stylesheet" href="css/bootstrap.min.css" />		
		
	</head>
	
	<body>
	
		<div class="container">		
		
			<form class="form-horizontal">	
			
				<div class="form-group">		
				
					<label for "searchInputName">Wine Name</label>
					
					<input type="text" class="form-control" id="searchInputName" placeholder="Name or partial name of a wine...">				
					
				</div>
				
				<div class="form-group">

					<label for "searchInputWineryName">Winery Name</label>
					
					<input type="text" class="form-control" id="searchInputWineryName" placeholder="Name or partial name of a Winery...">	
					
				</div>
				
				<div class="form-group">					
					<label for "searchSelectRegion">Region</label>
					<select class="form-control" id="searchSelectRegion">
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
					<select class="form-control" id="searchSelectGrapeVariety">
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
					<select id="searchSelectFromYear" class="form-control">
						<?php
							for($i = $min_year; $i <= $max_year; $i++) {
								echo "<option>" . $i . "</option>";
							}
						?>
					</select>					
				</div>
				
				<div class="form-group">				
				
					<label for "searchSelectToYear">To year</label>
					<select id="searchSelectToYear" class="form-control">
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
					<label for "searchMinInStock">Minimum stock on hand</label>
					<input type="number" class="form-control" id="searchMinInStock" min="0">
					
				</div>
				
			</form>
		</div>
	</body>
</html>