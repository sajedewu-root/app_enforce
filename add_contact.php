<?php

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
require_once "config.php";
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
include 'menu_list.php';
include 'data_display.php';
include 'add_data.php';

$app_swc_id = $_GET['swc_id'];
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="expires" content="Sun, 01 Jan 2014 00:00:00 GMT"/>
<meta http-equiv="pragma" content="no-cache" />
<link rel="stylesheet" type="text/css" href="style.css?anything=goeshere" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;400&display=swap" rel="stylesheet">
<script type="text/javascript" src="data_display_js.js"></script>
<title>Untitled Document</title>
</head>
<body class="body">

<table class="table">
  <tr>
    <td class="td_s"><?php echo menu_display();?></td>
    <td class="td_l">
      <table class="td_table_title">
        <tr><td class="td_table_title_td"><?php echo app_info_title($_GET['swc_id']);?></td></tr>
      </table>

      <table class="td_table">
        <tr>
          <td class="td_l_l"><?php echo app_info_contact_display_solu_mgr($_GET['swc_id']);?><?php echo app_info_contact_display_swc_mgr($_GET['swc_id']);?></td>
          <td class= "td_l_r"> <?php echo add_contact($_GET['swc_id']);?></td>
        </tr>
      </table>
    </td>
  </tr>
</table>

</body>
</html>
