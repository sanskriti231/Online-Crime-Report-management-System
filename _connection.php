<?php
$serverName = "localhost";
$username = "root";
$password = "";
$db = "ssbreport";

// Create connection
$conn = new mysqli($serverName, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>

<?php
// $serverName = "sql206.infinityfree.com";
// $username = "if0_37720462";
// $password = "vF1RxyfKsNnrI6";
// $db = "if0_37720462_ssbreport";

// // Create connection
// $conn = new mysqli($serverName, $username, $password, $db);

// // Check connection
// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }
?>