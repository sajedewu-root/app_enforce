<?php

session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}

/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
require_once "config.php";
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Escape user inputs for security
$swc_id = mysqli_real_escape_string($link, $_POST['swc_id']);
$gpn = mysqli_real_escape_string($link, $_POST['gpn']);
$name = mysqli_real_escape_string($link, $_POST['name']);
$position = mysqli_real_escape_string($link, $_POST['position']);



// Attempt insert query execution
// $sql = "INSERT INTO persons (first_name, last_name, email) VALUES ('$first_name', '$last_name', '$email')";

$sql = "INSERT INTO contact_info (swc_id, gpn, name, position)
VALUES ('$swc_id', '$gpn', '$name' ,'$position')";


if(mysqli_query($link, $sql)){
    header("location: list.php");
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

// Close connection
mysqli_close($link);
?>
