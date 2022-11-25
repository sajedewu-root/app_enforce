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
$comms = mysqli_real_escape_string($link, $_POST['comms']);



// Attempt insert query execution
$sql = "INSERT INTO comment_info (swc_id, comms)
VALUES ('$swc_id', '$comms')";

if(mysqli_query($link, $sql)){
    header('location: add_authentication_comm.php?swc_id='.$swc_id);
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}


// Close connection
mysqli_close($link);
?>
