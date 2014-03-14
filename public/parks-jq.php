<?
require_once('../../../exercises/php/national_parks.php');
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Nat'l Parks</title>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<link rel='stylesheet' href='/css/parks.css'>
</head>
<body>
		<h2>National Parks:</h2>
			<div class='container'>
			<table class='table table-striped tablesorter' id="myTable"> 
				<thead>
				<tr>
					<th style='width:15%;'>Name</th>
					<th style='width:15%;'>Location</th>
					<th style='width:40%;'>Description</th>
					<th style='width:15%;'>Year Established</th>
					<th style='width:15%;'>Area in Acres</th>
				</tr>
				</thead>
				<tbody>	
					<? if (!empty($result)) : ?>
						<?	while ($row = $result->fetch_assoc()) : ?>
							<tr>
								<? foreach ($row as $field): ?>
									<? $field = htmlspecialchars(strip_tags($field)); ?>
									<td><?=$field;?></td>
								<? endforeach; ?>
							</tr>
							<? endwhile; ?>
					<? endif; ?>
				</tbody>	
			</table>
			</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/js/jquery-latest.js"></script> 
	<script type="text/javascript" src="/js/jquery.tablesorter.js"></script> 
	<script>
	$(document).ready(function() 
    	{ 
    		$("#myTable").tablesorter(); 
    	} 
	); 
    
	</script>

</body>
</html>