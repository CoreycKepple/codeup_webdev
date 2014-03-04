<?php
//Include Class to use within file
require_once('classes/address_class.php');

//Set error to an empty string
$error = '';

//Set filename and create a new instance of the class
//Open file - create array
$filename = 'data/address_book.csv';
$ad = new AddressDataStore($filename);
$address_book = $ad->read_address_book();

//Check to confirm file was uploaded
//Add uploaded file to current array and then save array to file storage
if (count($_FILES)>0 && $_FILES['add_file']['error']==0) {
	if ($_FILES['add_file']['type'] == 'text/csv') {
		$upload_dir = '/vagrant/sites/codeup.dev/public/uploads/';
		$newfile = basename($_FILES['add_file']['name']);
		$saved_filename = $upload_dir . $newfile;
		move_uploaded_file($_FILES['add_file']['tmp_name'], $saved_filename);
		$upload = new AddressDataStore($saved_filename);
		$newarray = $upload->read_address_book();
		$address_book = array_merge($address_book, $newarray);
		$ad->write_address_book($address_book);
		header("Location: address_book.php");
		exit(0);
	}
}

//Validate if userinput filled in all required fields
//Add userinput to addressbook array -- save to data storage
if (!empty($_POST)) {
	if (empty($_POST['sendto'])  || (strlen($_POST['sendto']) > 124)) {
		$error = $ad->validate($_POST['sendto']);
	}elseif (empty($_POST['address']) || (strlen($_POST['address']) > 124)) {
		$error = $ad->validate($_POST['address']);
	}elseif (empty($_POST['city']) || (strlen($_POST['city']) > 124)) {
		$error = $ad->validate($_POST['city']);
	}elseif (empty($_POST['state']) || (strlen($_POST['state']) > 124)) {
		$error = $ad->validate($_POST['state']);
	}elseif (empty($_POST['zip'])  || (strlen($_POST['zip']) > 124)) {
		$error = $ad->validate($_POST['zip']);
	}else {
		array_push($address_book, $_POST);
		$ad->write_address_book($address_book);
	}	
}


//Remove item from address_book array 
//Save array to data storage
if (isset($_GET['remove'])) {
	$key = intval($_GET['remove']);
	unset($address_book[$key]);
	$ad->write_address_book($address_book);
	header("Location: address_book.php");
	exit(0);
}


?>
<html>
<head>
	<title>Address Book</title>
</head>
<body>
	<div style="text-align:center;margin:50px;">
		<img style="float:none;" src="data:image/png;base64,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"/>
	<h1>Welcome to Codeup.dev</h1>
	<hr>
	<p>
		<a href='index.html'>~ Home ~</a><a href='hello_world.html'>~ Hello ~</a><a href='todo_list.php'>~ Todo_List ~</a><a href='address_book.php'>~ Address Book ~</a>
	</p>
</div>
	<hr>
	<h2>Address Book:</h2>
		<table>
			<tr>
				<th>Name:</th><th>Address:</th><th>City:</th><th>State:</th><th>Zip:</th><th>Phone (optional):</th>
				<? if (!empty($address_book)) : ?>
						<? foreach ($address_book as $key => $fields) : ?>
						<tr>
							<? foreach ($fields as $field): ?>
								<? $field = htmlspecialchars(strip_tags($field)); ?>
								<td>||&mdash;<?=$field;?>&mdash;||</td>
							<? endforeach; ?>
						<td><?="<a href='?remove=$key'>Remove</a>"?></td></tr>
						<? endforeach; ?>
					<? else : ?>
						<tr><?= "Enter New Address" ?></tr>
					<? endif; ?>
				<? if (!empty($error)) : ?>
					<hr><tr><strong><?=$error?></strong></tr><hr>
				<? endif; ?>
		</table>
	<h2>Add New Address:</h2>
	<hr>
		<form method="POST" action="">
			<p>
				<label for="sendto">Recipients Name:</label>
				<input id="sendto" name="sendto" type="text" value="<?= (empty($error)) ? '' : htmlspecialchars(strip_tags($_POST['sendto']));?>">
			</p>
			<p>
				<label for="address">Recipients Address:</label>
				<input id="address" name="address" type="text" value="<?=  (empty($error)) ? '' : htmlspecialchars(strip_tags($_POST['address']));?>">
			</p>
			<p>
				<label for="city">Recipients City:</label>
				<input id="city" name="city" type="text" value="<?= (empty($error)) ? '' : htmlspecialchars(strip_tags($_POST['city']));?>">
			</p>
			<p>
				<label for="state">Recipients State:</label>
				<input id="state" name="state" type="text" value="<?= (empty($error)) ? '' : htmlspecialchars(strip_tags($_POST['state']));?>">
			</p>
			<p>
				<label for="zip">Recipients Zip-Code:</label>
				<input id="zip" name="zip" type="text" value="<?= (empty($error)) ? '' : htmlspecialchars(strip_tags($_POST['zip']));?>">
			</p>
			<p>
				<label for="phone">Recipients Phone Number:</label>
				<input id="phone" name="phone" type="text" value="<?= (empty($error)) ? '' : htmlspecialchars(strip_tags($_POST['phone']));?>">
			<p>
				<input type='submit' value='Add New Entry'>
			</p>
		</form>
		<hr>
		<form method="POST" enctype="multipart/form-data" action="">
			<p>
				<label for="add_file">Upload list:</label>
				<input id="add_file" name="add_file" type="file">
			</p>
			<p>
				<input type='submit' value='Upload'>
			</p>
		</form>
</body>
</html>