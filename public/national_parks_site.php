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
					<th style='width:15%;'>Name<a href='?sort=name'><span class="glyphicon glyphicon-arrow-up"> </span></a><a href='?dessort=name'><span class="glyphicon glyphicon-arrow-down"> </span></th><th style='width:15%;'>Location <a href='?sort=location'><span class="glyphicon glyphicon-arrow-up"> </span></a><a href='?dessort=location'><span class="glyphicon glyphicon-arrow-down"> </span></th><th style='width:15%;'>Year Established<a href='?sort=date_established'><span class="glyphicon glyphicon-arrow-up"> </span></a><a href='?dessort=date_established'><span class="glyphicon glyphicon-arrow-down"> </span></a></th><th style='width:15%;'>Area in Acres<a href='?sort=area_in_acres'><span class="glyphicon glyphicon-arrow-up"> </span></a><a href='?dessort=area_in_acres'><span class="glyphicon glyphicon-arrow-down"> </span></a></th><th style='width:40%;'>Description</th>
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
					<form class="form-horizontal" role="form" method='POST'>
					  <div class="form-group">
					    <label for="addName" class="col-sm-2 control-label">Name</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="addName" name='addName' placeholder="input Name">
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="addLoc" class="col-sm-2 control-label">Location</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="addLoc" name='addLoc' placeholder="input Location">
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="addYear" class="col-sm-2 control-label">Year Established</label>
					    <div class="col-sm-8">
					      <input type="date" class="form-control" id="addYear" name='addYear' placeholder="input Year Established">
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="addArea" class="col-sm-2 control-label">Area in Acres</label>
					    <div class="col-sm-8">
					      <input type="number" min='1' max='9000000' step='0.01' class="form-control" id="addArea" name='addArea' placeholder="input Area in Acres">
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="addDes" class="col-sm-2 control-label">Description</label>
					    <div class="col-sm-8">
					      <textarea rows='3' class="form-control" id="addDes" name='addDes' required>
					      </textarea>
					    </div>
					  </div>
					  <div class="form-group">
					    <div class="col-sm-offset-2 col-sm-10">
					      <button type="submit" class="btn btn-default">Add Park</button>
					    </div>
					  </div>
					</form>
			</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</body>
</html>