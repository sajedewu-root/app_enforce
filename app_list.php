<?php
include 'cache.php';

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
require_once "config.php";
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
include 'data_display.php';
include 'add_data.php';

?>
<html>
<head>

<link rel="stylesheet" type="text/css" href="style2.css?anything=goeshere" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;400&display=swap" rel="stylesheet">
<title>2FA Tracking System</title>
</head>

<body class="body">
	<table class="table">
    <tr>
      <td class="td_s"></td>
      <td class="td_l">
        <table class="td_table">
          <tr>
            <td class="td_l_l"><!-- List of Application and other details--><?php echo app_info_list(); ?></td>
            <td class="td_l_r"><!-- list of menu and it's item--><?php echo menu_display(); ?><!-- Add new application in the list--><?php echo add_app(); ?></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
