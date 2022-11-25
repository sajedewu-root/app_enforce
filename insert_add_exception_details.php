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

$swc_id = mysqli_real_escape_string($link, $_POST['swc_id']);
$exception_category = mysqli_real_escape_string($link, $_POST['exception_category']);
$two_fa_planned = mysqli_real_escape_string($link, $_POST['two_fa_planned']);
$two_fa_seems_possible = mysqli_real_escape_string($link, $_POST['two_fa_seems_possible']);
$remediation_feasibility = mysqli_real_escape_string($link, $_POST['remediation_feasibility']);
$exception_future_status = mysqli_real_escape_string($link, $_POST['exception_future_status']);
$proposal = mysqli_real_escape_string($link, $_POST['proposal']);
$two_fa_proposed_date = mysqli_real_escape_string($link, $_POST['two_fa_proposed_date']);
$user_id = $_SESSION['username'];




// Attempt insert query execution
$sql = "INSERT INTO exception_details_info (swc_id, exception_category, two_fa_planned, two_fa_seems_possible, remediation_feasibility, exception_future_status, proposal, two_fa_proposed_date, user_id)
VALUES ('$swc_id', '$exception_category', '$two_fa_planned', '$two_fa_seems_possible', '$remediation_feasibility', '$exception_future_status', '$proposal', '$two_fa_proposed_date', '$user_id')";


if(mysqli_query($link, $sql)){
    header('location: add_exception_details.php?swc_id='.$swc_id);
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}






// Close connection
mysqli_close($link);
?>
