<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
require_once "config.php";
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

include 'menu_list.php';
include 'app_info_gen.php';
include 'app_info_juri.php';
?>

<html>
<head>

<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="style.css?anything=goeshere" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;400&display=swap" rel="stylesheet">

</head>

<body class="body">

	<table class="table">
		<tr>
			<td class="td_s">
				<?php echo display();?>
			</td>
			<td class="td_l">
				<!--form action="update.php" method="post" style="padding:50px;"-->
					<?php echo app_info_gen($_GET['swc_id']);?>
					<?php echo app_info_juri($_GET['swc_id']);?>
					<!--input class="button" type="submit" id="getinfo" name="submit" value="Submit" /-->
				</form>
			</td>
		</tr>
	</table>
</html>
