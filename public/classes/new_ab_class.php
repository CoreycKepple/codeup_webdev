<?php



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
