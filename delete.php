<?php


//include 'connect.php';

$id = $_GET['id'];


$servername = "localhost";
$username = "uni";
$password = "uni";
$dbname = "khan";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$sql = "DELETE FROM myaddressbook WHERE id= '$id'";
$result = $conn->query($sql);

if (mysqli_query($conn, $sql)) {
	 exec ('index.php');
} else {
	echo "Error deleting record: " . mysqli_error($conn);
}

//mysqli_close($conn);

//print( '<a href="index.php">Return to the main page</a>' );

header('location: index.php');
 
?>