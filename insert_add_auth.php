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
$present_status = mysqli_real_escape_string($link, $_POST['present_status']);
$present_sub_status = mysqli_real_escape_string($link, $_POST['present_sub_status']);
$overall_status = mysqli_real_escape_string($link, $_POST['overall_status']);
$enforcement_solution = mysqli_real_escape_string($link, $_POST['enforcement_solution']);
$exception_criteria = mysqli_real_escape_string($link, $_POST['exception_criteria']);
$enforcement_date_av = mysqli_real_escape_string($link, $_POST['enforcement_date_av']);
$exception_expire_date_av = mysqli_real_escape_string($link, $_POST['exception_expire_date_av']);
$enforcement_date = mysqli_real_escape_string($link, $_POST['enforcement_date']);
$exception_expire_date = mysqli_real_escape_string($link, $_POST['exception_expire_date']);
$comms = mysqli_real_escape_string($link, $_POST['comms']);
$used_id = $_SESSION['username'];

if (empty($enforcement_date)){
  $enforcement_date = '1111-11-11';
}
if (empty($exception_expire_date)){
  $exception_expire_date = '1111-11-11';
}



// Attempt insert query execution
$sql = "INSERT INTO enforcement_info (swc_id, present_status, present_sub_status, overall_status, enforcement_solution, exception_criteria, enforcement_date_av, exception_expire_date_av, enforcement_date, exception_expire_date, used_id)
VALUES ('$swc_id', '$present_status', '$present_sub_status', '$overall_status', '$enforcement_solution', '$exception_criteria', '$enforcement_date_av', '$exception_expire_date_av', '$enforcement_date', '$exception_expire_date', '$used_id')";


if(mysqli_query($link, $sql)){
  $sql_id = "SELECT apps_sl_no FROM 2fa.enforcement_info WHERE swc_id = '$swc_id' ORDER BY apps_sl_no DESC LIMIT 1";
  $result = $link->query($sql_id);
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $enforcement_sl_no = intval($row['apps_sl_no']);
    }
  }


  $sql_comms = "INSERT INTO comment_info (swc_id, enforcement_sl_no, comms) VALUES ('$swc_id', '$enforcement_sl_no', '$comms')";
  if(mysqli_query($link, $sql_comms)){
      header('location: add_authentication.php?swc_id='.$swc_id);
  } else{
      echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
  }
}
else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}




// Close connection
mysqli_close($link);
?>
