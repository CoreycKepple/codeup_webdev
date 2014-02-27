<?php
$error = '';
class AddressStore {
	public $filename = '';
	    function __construct($filename = ''){
        $this->filename = $filename;
    }
	function openFile(){
		$handle = fopen($this->filename, 'r');
		if (!empty($this->filename) && filesize($this->filename) > 10) {
			while(($data = fgetcsv($handle)) !== FALSE) {
				$address_book[] = $data;
			}
		}else {
			$address_book=[];
		}
		fclose($handle);
		return $address_book;
	}

	function saveFile($address_book){
		$handle = fopen($this->filename, 'w');
		foreach ($address_book as $fields) {
			if($fields != '');
	    	fputcsv($handle, $fields);
		}
		fclose($handle);
	}
}
$filename = 'data/address_book.csv';
$ad = new AddressStore($filename);
$address_book = $ad->openFile();


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
		$ad->saveFile($address_book);
	}	
}

if (isset($_GET['remove'])) {
	$key = intval($_GET['remove']);
	unset($address_book[$key]);
	$ad->saveFile($address_book);
	header("Location: address_book.php");
	exit(0);
}


?>
<html>
<head>
	<title>Address Book</title>
</head>
<body>
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
					<tr><?=$error?></tr>
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
		</form>
</body>
</html>