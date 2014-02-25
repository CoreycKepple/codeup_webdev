<!DOCTYPE HTML!>
<?php
$filename = 'data/codeup_todo.txt';
$filesize = filesize($filename);
	

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
	echo "<p> You have Nothing TODO </p>";
	$list = array();
}

if (count($_FILES)>0 && $_FILES['add_file']['error']==0) {
	if ($_FILES['add_file']['type'] == 'text/plain') {
		$upload_dir = '/vagrant/sites/codeup.dev/public/uploads/';
		$newfile = basename($_FILES['add_file']['name']);
		$saved_filename = $upload_dir . $newfile;
		move_uploaded_file($_FILES['add_file']['tmp_name'], $saved_filename);
		$handle = fopen("uploads/{$newfile}", 'r');
		$contents = fread($handle, filesize("uploads/{$newfile}"));
		$newlist = explode("\n", $contents);
		$list = array_merge($list,$newlist);
		$strfile = implode("\n", $list);
		$handle = fopen($filename, 'w');
		fwrite($handle, $strfile);
		fclose($handle);
		header("Location: todo_list.php");
		exit(0);
	}else {
		echo "<p> File is not plain/text ~~ please upload a different file.</p>";
	}

}
if (isset($_GET['remove'])) {
	$key = $_GET['remove'];
	unset($list[$key]);
	$str = implode("\n", $list);
	$handle = fopen($filename, 'w');
	fwrite($handle, $str);
	fclose($handle);
	header("Location: todo_list.php");
	exit(0);
}
if (!empty($_POST['additem'])) {
	$new = implode($_POST, '');
	array_push($list, $new);
	$string=implode("\n", $list);
	$handle=fopen($filename, 'w');
	fwrite($handle, $string);
	fclose($handle);
	header("Location: todo_list.php");
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
				<?php			
				if(!empty($list)){
					foreach ($list as $key => $item) {
						echo "<li>{$item} | <a href='?remove={$key}' name='remove' id='remove'>Remove Item</a></li>";
					}
				}else {
					echo "<h3>You have nothing to do? Find something :</h3>";
					echo "<p><a href='http://google.com'> :-)</a></p>";
				}
				?>
			</ul>
		</form>
	<h2>Add items to list</h2>
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
				<input type="submit" value="Add">
			</p>
		</form>
</body>
</html>