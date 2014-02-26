<?php
$address_book = [];
$data_csv = 0;
$filename = 'data/address_book.csv';
$error = '';

function newEntry($address_book,$filename){
	$handle = fopen($filename, 'a');
		foreach ($address_book as $fields) {
			fputcsv($handle, $fields);
		}
	fclose($handle);
}

if (!empty($_POST)) {
	if (empty($_POST['sendto'])) {
		$error = 'You did not enter Recipients Name. Please enter missing information.';

	}elseif (empty($_POST['address'])) {
		$error = 'You did not enter Recipients Address. Please enter missing information.';
	}elseif (empty($_POST['city'])) {
		$error = 'You did not enter Recipients City. Please enter missing information.';
	}elseif (empty($_POST['state'])) {
		$error = 'You did not enter Recipients State. Please enter missing information.';
	}elseif (empty($_POST['zip'])) {
		$error = 'You did not enter Recipients Zip-Code. Please enter missing information.';
	}else {
	array_push($address_book, $_POST);
	$address_book = $address_book;
	newEntry($address_book,$filename);
	}
}
?>
<html>
<head>
	<title>Address Book</title>
</head>
<body>
	<h2>Address Book Entry:</h2>
		<ul>
			<? if (empty($error)) : ?>
				<? if (!empty($address_book)) : ?>
						<? foreach ($address_book as $fields) : ?>
							<? $fields = implode(' || ', $fields); ?>
							<li><?= "$fields";?></li>
						<? endforeach; ?>
					<? else : ?>
						<li><?= "Enter New Address" ?></li>
					<? endif; ?>
			<? else : ?>
				<li><?= $error; ?></li>
			<? endif; ?> 
		</ul>
	<h2>Add New Address:</h2>
	<hr>
		<form method="POST" action="">
			<p>
				<label for="sendto">Recipients Name:</label>
				<input id="sendto" name="sendto" type="text" value='<?= (empty($error)) ? "" : $_POST["sendto"];?>'>
			</p>
			<p>
				<label for="address">Recipients Address:</label>
				<input id="address" name="address" type="text" value='<?=  (empty($error)) ? "" : $_POST["address"];?>'>
			</p>
			<p>
				<label for="city">Recipients City:</label>
				<input id="city" name="city" type="text" value='<?= (empty($error)) ? "" : $_POST["city"];?>'>
			</p>
			<p>
				<label for="state">Recipients State:</label>
				<input id="state" name="state" type="text" value='<?= (empty($error)) ? "" : $_POST["state"];?>'>
			</p>
			<p>
				<label for="zip">Recipients Zip-Code:</label>
				<input id="zip" name="zip" type="text" value='<?= (empty($error)) ? "" : $_POST["zip"];?>'>
			</p>
			<p>
				<label for="phone">Recipients Phone Number:</label>
				<input id="phone" name="phone" type="text" value='<?= (empty($error)) ? "" : $_POST["phone"];?>'>
			<p>
				<input type='submit' value='Add New Entry'>
			</p>
	<hr>
	<h2>Download Database of Addresses</h2>
		<p>
			<a href="/data/address_book.csv">Database</a>
		</p>
</body>
</html>