<?php

echo "<p>GET:</p>";
var_dump($_GET);

echo "<p>POST:</p>";
var_dump($_POST);

?>

<html>
<head>
	<title>TODO List</title>
</head>
<body>
	<h1>TODO list:</h1>
	<ul>
		<li>Wake Up</li>
		<li>Eat Breakfast</li>
		<li>Go to CodeUp</li>
		<li>Profit</li>
	</ul>
	<h2>Add items to list</h2>
	<form method="GET" action="">
		<p>
		<label for="additem">Item to add:</label>
			<input id="additem" name="additem" type="text" placeholder="Enter new TODO item">
		</p>
		<p>
			<input type="submit">
		</p>
	</form>
</body>
</html>