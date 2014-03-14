<?php
require_once('classes/todo_class.php');
$arcfile = 'data/archive.txt';
$filename = 'data/codeup_todo.txt';
$arcsize = filesize($arcfile);
$tc = new TodoData($filename);

//Establishing global variables
$archive = [];
$archiveitem = 0; 
$error = '';

//Create new list from saved file
$list = $tc->read_todo();

//Check user upload determine if file is correct type and holds data
//Allow user to overwrite current list or add new file to current list

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
      header("Location: newtodo.php");
      exit(0);  
    }else {
      $list = array_merge($list,$newlist);
      $tc->save_todo($list);
      header("Location: newtodo.php");
      exit(0);
    }
  }else {
    $error =  "<p> File is not plain/text ~~ please upload a different file.</p>";
  }

}

//Allow user to remove individual tasks from list

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
  header("Location: newtodo.php");
  exit(0);
 }

//Allow user to post new items to list
//Check to ensure post is small than 240 characters

if (!empty($_POST)) {
  if ((strlen($_POST['additem']) > 1 ) && (strlen($_POST['additem']) < 240)) {
    $new = implode($_POST);
    array_push($list, $new);
    $tc->save_todo($list);
    header("Location: newtodo.php");
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

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <title>CCK | Todo List</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css" rel="stylesheet">
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:200,300,400,600,700');" rel='font'>
        <link href='/css/basis.css' rel='stylesheet'>  
    </head>
      <body>
        
        <div class="wrapper" >
    <div class="box">
        <div class="row">
          
            <!-- sidebar -->
            <div class="column col-sm-3" id="sidebar">
                <a class="logo" href="cck.html">CK</a>
                <ul class="nav" id="links">
                    <li class="active"><a href="cck.html#resume">Resume</a>
                    </li>
                    <li><a href="cck.html#portfolio">Portfolio</a>
                    </li>
                </ul>
            </div>
            <!-- /sidebar -->
          
            <!-- main -->
            <div class="column col-sm-9" id="main">
                <div class="padding">
                    <div class="full col-sm-9">
                        <!-- content -->
                      <div class="mid">    
                        <h1>TODO list:</h1>
                        <form method ="GET" action ="">
                          <ul class='padbot'>  
                            <?if(!empty($list)) : ?>
                              <?foreach ($list as $key => $item) : ?>
                              <? $item = htmlspecialchars(strip_tags($item)); ?>
                              <li><?= "{$item} | <a href='?remove={$key}' name='remove' class='linker'>Remove Item</a>"; ?></li>
                              <? endforeach; ?>
                            <? else : ?>
                              <h3><?= "You have nothing to do? Find something :";?></h3>
                              <p><?= "<a href='http://google.com'>GOOGLE</a>";?></p>
                            <? endif; ?>
                          </ul>
                        </form>
                      
                        <h2>Add items to list</h2>
                          <? if (!empty($error)) : ?>
                            <hr><strong><?= $error; ?></strong><hr>
                          <? endif; ?>
                        <form method="POST" action="">
                            <p class='margleft padbot'>
                              <label for="additem">Item to add:</label>
                              <input id="additem" name="additem" type="text" placeholder="Enter new TODO item">
                              <input type="submit" value="Add">
                            </p>
                        </form>
                        <form method="POST" enctype="multipart/form-data" action="">
                            <div id='upload'>
                              <p class='padtop'>
                                <label for="add_file">Upload list:</label>
                                <input id="add_file" name="add_file" type="file">
                              </p>
                              <p>
                                <label for="overwrite">Overwrite current list with uploaded list?:</label>
                                <input id="overwrite" name="overwrite" type="checkbox">
                              </p>
                              <p class='mid1'>
                                <input type="submit" value="Add">
                              </p>
                            </div>
                        </form>
                        <h2>View archive of completed Items:</h2>
                        <p class='mid1'>
                          <a href="/data/archive.txt" class='linker'>Completed Items</a>
                        </p>
                      </div>   
                       
                    </div><!-- /col-9 -->
                </div><!-- /padding -->
            </div>
            <!-- /main -->
          
        </div>
    </div>
</div>        
      
        <script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script type='text/javascript' src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
        
    </body>
</html>