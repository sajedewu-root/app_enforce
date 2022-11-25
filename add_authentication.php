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
include 'app_info_gen.php';
include 'add_data.php';
include 'data_display.php';

?>

<html>
<head>

<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="style.css?anything=goeshere" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;400&display=swap" rel="stylesheet">
<script type="text/javascript" src="data_display_js.js"></script>

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
          <tr><td class="td_l_l">
            <table ><tr><td class="td_info_l"><?php echo app_info_gen($_GET['swc_id']); ?></td><td class="td_info_r"><?php echo app_info_auth($_GET['swc_id']); ?></td></tr>
            <tr><td colspan="10"><?php echo app_info_auth_comms($_GET['swc_id']); ?></td></tr></table>
          </td><td class="td_l_r"><?php echo add_auth($_GET['swc_id']);?></td>
          </tr>
        </table>
			</td>
		</tr>
	</table>
</body>
</html>
