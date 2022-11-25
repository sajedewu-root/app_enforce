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
$apps_name = mysqli_real_escape_string($link, $_POST['apps_name']);
$lob = mysqli_real_escape_string($link, $_POST['lob']);
$irr = mysqli_real_escape_string($link, $_POST['irr']);
$usa_usage = mysqli_real_escape_string($link, $_POST['usa_usage']);
$cri_sen = mysqli_real_escape_string($link, $_POST['cri_sen']);
$in_scope = mysqli_real_escape_string($link, $_POST['in_scope']);
$in_date = mysqli_real_escape_string($link, $_POST['in_date']);
$mlsi = mysqli_real_escape_string($link, $_POST['mlsi']);




// Attempt insert query execution
// $sql = "INSERT INTO persons (first_name, last_name, email) VALUES ('$first_name', '$last_name', '$email')";

$sql = "INSERT INTO app_info (swc_id, apps_name, lob, irr, usa_usage, cri_sen, in_scope, in_date, mlsi)
VALUES ('$swc_id', '$apps_name', '$lob', '$irr' ,'$usa_usage','$cri_sen','$in_scope', '$in_date' ,'$mlsi')";


if(mysqli_query($link, $sql)){
    header("location: list.php");
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

// Close connection
mysqli_close($link);
?>
