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
			<table class='table table-striped'>
				<tr>
					<th style='width:15%;'>Name<a href='?sort=name'><span class="glyphicon glyphicon-arrow-up"> </span></a><a href='?dessort=name'><span class="glyphicon glyphicon-arrow-down"> </span></th><th style='width:15%;'>Location <a href='?sort=location'><span class="glyphicon glyphicon-arrow-up"> </span></a><a href='?dessort=location'><span class="glyphicon glyphicon-arrow-down"> </span></th><th style='width:40%;'>Description<a href='?sort=description'><span class="glyphicon glyphicon-arrow-up"> </span></a><a href='?dessort=description'><span class="glyphicon glyphicon-arrow-down"> </span></th><th style='width:15%;'>Year Established<a href='?sort=date_established'><span class="glyphicon glyphicon-arrow-up"> </span></a><a href='?dessort=date_established'><span class="glyphicon glyphicon-arrow-down"> </span></a></th><th style='width:15%;'>Area in Acres<a href='?sort=area_in_acres'><span class="glyphicon glyphicon-arrow-up"> </span></a><a href='?dessort=area_in_acres'><span class="glyphicon glyphicon-arrow-down"> </span></a></th>
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
			</table>
			</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</body>
</html>