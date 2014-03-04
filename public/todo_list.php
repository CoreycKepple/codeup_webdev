<?php
require_once('classes/todo_class.php');
$filename = 'data/codeup_todo.txt';
$tc = new TodoData($filename);
$arcfile = 'data/archive.txt';
$arcsize = filesize($arcfile);
$archive = [];
$archiveitem = 0;	
$error = '';


$list = $tc->read_todo();

if (count($_FILES)>0 && $_FILES['add_file']['error']==0) {
	if ($_FILES['add_file']['type'] == 'text/plain') {
		$upload_dir = '/vagrant/sites/codeup.dev/public/uploads/';
		$newfile = basename($_FILES['add_file']['name']);
		$saved_filename = $upload_dir . $newfile;
		move_uploaded_file($_FILES['add_file']['tmp_name'], $saved_filename);
		$upload = new TodoData($saved_filename);
		$newlist = $upload->read_todo();
		if ($_POST['overwrite'] == TRUE) {
			$tc->save_todo($newlist);
			header("Location: todo_list.php");
			exit(0);	
		}else {
			$list = array_merge($list,$newlist);
			$tc->save_todo($list);
			header("Location: todo_list.php");
			exit(0);
		}
	}else {
		$error =  "<p> File is not plain/text ~~ please upload a different file.</p>";
	}

}
if (isset($_GET['remove'])) {
	$key = $_GET['remove'];
	$archiveitem = ($list[$key]);
	unset($list[$key]);
	var_dump($list);
	$tc->save_todo($list);
	$archandle = fopen($arcfile, 'a');
	$addarc = PHP_EOL.$archiveitem;
	fwrite($archandle, $addarc);
	fclose($archandle);
	header("Location: todo_list.php");
	exit(0);
 }
if (!empty($_POST)) {
	if ((strlen($_POST['additem']) > 1 ) && (strlen($_POST['additem']) < 240)) {
		$new = implode($_POST);
		array_push($list, $new);
		$tc->save_todo($list);
		header("Location: todo_list.php");
		exit(0);
	}else{
		try{
		throw new InvalidInputException('Item entered was Empty or Greater than 240 characters.');
		} catch (InvalidInputException $e) {
			$error = "Error: " . $e->getMessage();
		}
	}
}

?>
<!DOCTYPE HTML!>
<html>
<head>
	<title>TODO List</title>
</head>
<body>
	<div style="text-align:center;margin:50px;">
		<img style="float:none;" src="data:image/png;base64,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"/>
		<h1>Welcome to Codeup.dev</h1>
		<hr>
		<p>
			<a href='index.html'>~ Home ~</a><a href='hello_world.html'>~ Hello ~</a><a href='todo_list.php'>~ Todo_List ~</a><a href='address_book.php'>~ Address Book ~</a>
		</p>
		<hr>
	</div>
		<h1>TODO list:</h1>
		<form method ="GET" action ="">
			<ul>	
				<?if(!empty($list)) : ?>
					<?foreach ($list as $key => $item) : ?>
					<? $item = htmlspecialchars(strip_tags($item)); ?>
					<li><?=	"{$item} | <a href='?remove={$key}' name='remove' id='remove'>Remove Item</a>"; ?></li>
					<? endforeach; ?>
				<? else : ?>
					<h3><?= "You have nothing to do? Find something :";?></h3>
					<p><?= "<a href='http://google.com'>GOOGLE</a>";?></p>
				<? endif; ?>
			</ul>
		</form>
	<h2>Add items to list</h2>
		<p>
			<? if (!empty($error)) : ?>
				<hr><strong><?= $error; ?></strong><hr>
			<? endif; ?>
		<form method="POST" enctype="multipart/form-data" action="">
			<p>
				<label for="additem">Item to add:</label>
				<input id="additem" name="additem" type="text" placeholder="Enter new TODO item">
			</p>
			<p>
				<label for="add_file">Upload list:</label>
				<input id="add_file" name="add_file" type="file">
			</p>
			<p>
				<label for="overwrite">Overwrite current list with uploaded list?:</label>
				<input id="overwrite" name="overwrite" type="checkbox">
			</p>
			<p>
				<input type="submit" value="Add">
			</p>
		</form>
	<h2>View archive of completed Items:</h2>
		<p>
			<a href="/data/archive.txt">Completed Items</a>
		</p>
</body>
</html>