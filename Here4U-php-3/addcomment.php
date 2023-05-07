<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Here4U-php";
//create connection
$mysqli = new mysqli($servername, $username, $password, $dbname);
//Check Connection
if ($mysqli->connect_error) {
  die("Connection Failed " . $mysqli->connect_error);
}

// Variables taken from form
$name = Trim(stripslashes($_POST['name']));
$comment = Trim(stripslashes($_POST['comment']));
$pageId = Trim(stripslashes($_POST['pageId']));
//Insert into database
$addComment = mysqli_query($mysqli, "INSERT INTO addComment (name, comment, pageId) VALUES ('$name', '$comment', '$pageId')");
?>