<!DOCTYPE HTML!>
<?php
$filename = 'data/codeup_todo.txt';
$filesize = filesize($filename);
$arcfile = 'data/archive.txt';
$arcsize = filesize($arcfile);
$archive = [];
$archiveitem = 0;	
$error = '';


function save_file($string,$filename) {
	$handle=fopen($filename, 'w');
	fwrite($handle, $string);
	fclose($handle);
	header("Location: todo_list.php");
	exit(0);
}

if ($filesize != 0) {
	$handle = fopen($filename, 'r');
	$contents = fread($handle,$filesize );
	fclose($handle);
	$list = array();
	$array = explode("\n", $contents);
    foreach ($array as $value) {
        array_push($list, $value);
     }
}else {
	$list = array();
}

if (count($_FILES)>0 && $_FILES['add_file']['error']==0) {
	if ($_FILES['add_file']['type'] == 'text/plain') {
		$upload_dir = '/vagrant/sites/codeup.dev/public/uploads/';
		$newfile = basename($_FILES['add_file']['name']);
		$saved_filename = $upload_dir . $newfile;
		move_uploaded_file($_FILES['add_file']['tmp_name'], $saved_filename);
		$handle = fopen($saved_filename, 'r');
		$contents = fread($handle, filesize($saved_filename));
		$newlist = explode("\n", $contents);
		if ($_POST['overwrite'] == TRUE) {
			$strfile = implode("\n", $newlist);
			save_file($strfile,$filename);
			
		}else {
			$list = array_merge($list,$newlist);
			$strfile = implode("\n", $list);
			save_file($strfile,$filename);
		}
	}else {
		$error =  "<p> File is not plain/text ~~ please upload a different file.</p>";
	}

}
if (isset($_GET['remove'])) {
	$key = $_GET['remove'];
	$archiveitem = ($list[$key]);
	unset($list[$key]);
	$str = implode("\n", $list);
	$handle = fopen($filename, 'w');
	fwrite($handle, $str);
	fclose($handle);
	$archandle = fopen($arcfile, 'a');
	$addarc = PHP_EOL.$archiveitem;
	fwrite($archandle, $addarc);
	fclose($archandle);
	header("Location: todo_list.php");
	exit(0);
}
if (!empty($_POST['additem'])) {
	$new = implode($_POST);
	array_push($list, $new);
	$string=implode("\n", $list);
	save_file($string,$filename);
}
?>
<html>
<head>
	<title>TODO List</title>
</head>
<body>
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
				<?= $error; ?>
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