<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Here4U-php";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM addcomment";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo "<h3>". $row["name"]. "</h3> "."<p>".$row["comment"]."</p><p>Commented on:".$row["date-created"]."</p><hr>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>