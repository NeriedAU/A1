<html>
	<head>
		<title>Search Results</title>
		<link rel="stylesheet" href="css/bootstrap.min.css" />
	</head>
	<body>
		<table class='table table-striped table-bordered'>
				<tr>
					<th>Wine ID</th>
					<th>Wine Name</th>
					<th>Grape Variety(s)</th>
					<th>Year</th>
					<th>Winery Name</th>
					<th>Region Name</th>
					<th>Cost</th>
					<th>Stock On Hand</th>
					<th>Total Sold</th>
					<th>Total Revenue</th>
				</tr>
			{foreach key=cid item=wine_result from=$result}
				<tr>
					<td>{$wine_result.wine_id}</td>
					<td>{$wine_result.wine_name}</td>
					<td>{$wine_result.grapes}</td>
					<td>{$wine_result.year}</td>
					<td>{$wine_result.winery_name}</td>
					<td>{$wine_result.region_name}</td>		
					<td>${$wine_result.cost}</td>
					<td>{$wine_result.on_hand}</td>
					<td>{$wine_result.total_sold}</td>
					<td>${$wine_result.revenue}</td>
				</tr>
			{/foreach}
		</table>
	</body>
</html>