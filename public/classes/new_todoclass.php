<?php


class InvalidInputException extends Exception {}

// Get new instance of MySQLi object
$mysqli = @new mysqli('127.0.0.1', 'corey', 'password', 'codeup_mysqli_test_db');

// Check for errors
if ($mysqli->connect_errno) {
    throw new Exception('Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Retrieve a result set using SELECT
$list = $mysqli->query("SELECT id, item FROM todo_list");

//Allow user to remove individual tasks from list

//$test = $mysqli->query("SELECT id FROM todo_list");

//Allow user to input new items into database
//Check to ensure post is small than 240 characters

if (!empty($_POST)) {
  if ((strlen($_POST['additem']) > 0 ) && (strlen($_POST['additem']) < 241)) {
    $stmt = $mysqli->prepare ("INSERT INTO todo_list (item) VALUES (?)");
  
    $stmt->bind_param("s", $_POST['additem']);

    $stmt->execute();
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


if (!empty($_POST)) {

    $id = $_POST['remove'];

    $mysqli->query("DELETE FROM todo_list WHERE id = $id;");

    header('Location: newtodo.php');
    exit(0);

}

