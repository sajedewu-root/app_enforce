<?php
//gobal $username;
// Initialize the session
include 'cache.php';
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
require_once "config.php";

function menu_display(){
	echo "<div><p class='label_2'>2FA Tracking System<br></p></div>";
	echo "<hr><br>";
	echo "<div>";
	echo "<p class='label_2'>General Links</p>";
	echo "<p>";
  echo "<a href='list.php'>List</a><br>";
  echo "<a href='add_app_comms.php'>Comments</a><br>";
  echo "<a href='data_display.php'>data display</a>";
  echo "</p>";
  echo "<hr><br>";
  echo "<div><p class='label_2'>Additional Links</p> <a href='register.php'>Create a new user accout</a></div>";
  echo "</div>";
  echo "<hr><br>";
  echo "<p class='username'>User: ". htmlspecialchars($_SESSION['username']);
  echo "</p>";
  echo "<a href='reset-password.php'>Reset Your Password</a><br>";
  echo "<a href='logout.php'>Sign Out</a>";
  echo "</div>";
}
// Display Application Title
function app_info_title(&$app_swc_id){
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $sql = "SELECT apps_sl_no, swc_id, apps_name, lob, irr, usa_usage, cri_sen, in_scope, in_date, mlsi FROM 2fa.app_info where swc_id = '$app_swc_id'";
  $result = $link->query($sql);
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo '<p class="textcolheader_title">'.$row['swc_id'].' - '.$row['apps_name'].'</p>';
    }
  }
}
// Display Solution Manager Contact Information
function app_info_contact_display_solu_mgr(&$app_swc_id){

  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $sql_solu_mgr = "SELECT sl_no, gpn, name, position FROM 2fa.contact_info where swc_id = '$app_swc_id' and position = 'solu_mgr'";
  $result = $link->query($sql_solu_mgr);

  if ($result->num_rows > 0) {
    echo '<table>';
    echo '<tr>';
    echo '<td colspan="10" class="textcolheader_data">';
    echo 'Application Information - Solution Manager (Contact Information)';
    echo '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td class="textcolheader_data">Sl No: </td>';
    echo '<td class="textcolheader_data">GPN: </td>';
    echo '<td class="textcolheader_data">Name: </td>';
    echo '<td class="textcolheader_data">Position:</td>';
    echo '</tr>';


    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo '<tr>';
      echo '<td class="textcolheader_data">'.$row['sl_no'].'</td>';
      echo '<td class="textcolheader_data">'.$row['gpn'].'</td>';
      echo '<td class="textcolheader_data">'.$row['name'].'</td>';
      echo '<td class="textcolheader_data">'.$row['position'].'</td>';
      echo '</tr>';
      //echo '</table>';

    }
    echo '</table>';
  }
  else
  {
    echo '<table>';
    echo '<tr>';
    echo '<td class="textcolheader_data">';
    echo '<b>Solution Manager</b><br>';
    echo 'No Contact Information available right now.<br>';
    echo 'Please add all the contact information.<br>';
    echo '</td>';
    echo '</tr>';
    echo '</table>';
  }
}
// Display Software Component Manager Contact Information
function app_info_contact_display_swc_mgr(&$app_swc_id){
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $sql_swc_mgr = "SELECT sl_no, gpn, name, position FROM 2fa.contact_info where swc_id = '$app_swc_id' and position = 'swc_mgr'";
  $result = $link->query($sql_swc_mgr);
  if ($result->num_rows > 0) {
    echo '<table class="">';
    echo '<tr>';
    echo '<td colspan="10" class="textcolheader_data">';
    echo 'Application Information - Software Component Manager (Contact Information)';
    echo '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td class="textcolheader_data">Sl No: </td>';
    echo '<td class="textcolheader_data">GPN: </td>';
    echo '<td class="textcolheader_data">Name: </td>';
    echo '<td class="textcolheader_data">Position:</td>';
    echo '</tr>';
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo '<tr>';
      echo '<td class="textcolheader_data">'.$row['sl_no'].'</td>';
      echo '<td class="textcolheader_data">'.$row['gpn'].'</td>';
      echo '<td class="textcolheader_data">'.$row['name'].'</td>';
      echo '<td class="textcolheader_data">'.$row['position'].'</td>';
      echo '</tr>';
    }
    echo '</table>';
  }
  else
  {
    echo '<table>';
    echo '<tr>';
    echo '<td class="textcolheader_data">';
    echo '<b>Software Component Manager</b><br>';
    echo 'No Contact Information available right now.<br>';
    echo 'Please add all the contact information.<br>';
    echo '</td>';
    echo '</tr>';
    echo '</table>';
  }
}
// Display Application Jurisdiction Information
function app_info_juri(&$app_swc_id){
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $sql = "SELECT apps_sl_no, swc_id, jurisdiction, created_at FROM 2fa.app_juri where swc_id = '$app_swc_id'";
  $result = $link->query($sql);
  echo '<table border="1px">';
  echo '<tr><td colspan="10" class="textcolheader_data"Application Information (Jurisdiction)</td></tr>';
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo '<tr>';
      echo '<td class="textcolheader_data">Jurisdiction:</td><td class="textcolheader_data">'.$row['jurisdiction'].'</td>';
      echo '<td class="textcolheader_data">Create AT:</td><td class="textcolheader_data">'.$row['create_at'].'</td>';
      echo '</tr>';
    }
  }
  else
  {
    echo '<tr>';
    echo '<td class="textcolheader_data">JURISDICTION:</td><td class="textcolheader_data">'.$row['jurisdiction'].'</td>';
    echo '<td class="textcolheader_data">Create AT:</td><td class="textcolheader_data">'.$row['create_at'].'</td>';
    echo '</tr>';
  }
  echo '';
  echo '</table>';
}
// Display List of Application
function app_info_list(){
  echo '<table><tr><td><p class="label_2_r">List of Applications</p></td></tr></table>';
  echo '<table>';
  echo '<tr>';
  echo '<td class="textcolheader">Sl No</td>';
  echo '<td class="textcolheader">SWC ID</td>';
  echo '<td class="textcolheader">SWC Name</td>';
  echo '<td class="textcolheader">LOB</td>';
  echo '<td class="textcolheader">USA USAGE</td>';
  echo '<td class="textcolheader" colspan="10">ACTION</td>';
  echo '</tr>';

  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $sql = "SELECT apps_sl_no, swc_id, apps_name, lob, irr, usa_usage, cri_sen, in_scope, in_date, mlsi FROM 2fa.app_info";
  $result = $link->query($sql);
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
  	echo '<tr>';
  	echo '<td class="textcolheader_data" align = "center">'.$row['apps_sl_no'].'</td>';
  	echo '<td class="textcolheader_data">'.$row['swc_id'].'</td>';
  	echo '<td class="textcolheader_data">'.$row['apps_name'].'</td>';
  	echo '<td class="textcolheader_data">'.$row['lob'].'</td>';
  	echo '<td class="textcolheader_data">'.$row['usa_usage'].'</td>';
  	echo "<td class='textcolheader_update'><a href='add_contact.php?swc_id=".$row['swc_id']." '>Contact<br>Details</a></td>";
  	echo "<td class='textcolheader_update'><a href='add_juri.php?swc_id=".$row['swc_id']." '>Juriisdiction</a></td>";
    echo "<td class='textcolheader_update'><a href='add_authentication.php?swc_id=".$row['swc_id']." '>Authentication</a></td>";
    echo "<td class='textcolheader_update'><a href='add_authentication_comm.php?swc_id=".$row['swc_id']." '>Add Comm</a></td>";
    echo "<td class='textcolheader_update'><a href='add_exception_details.php?swc_id=".$row['swc_id']." '>Add Exception <br> Details </a></td>";
  	echo '</tr>';
    }
  }
  else
  {
  	echo "0 results";
  }
  echo '</table>';
}
// Display Application General Information
function app_info_gen(&$app_swc_id){
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $sql = "SELECT apps_sl_no, swc_id, apps_name, lob, irr, usa_usage, cri_sen, in_scope, in_date, mlsi FROM 2fa.app_info where swc_id = '$app_swc_id'";
  $result = $link->query($sql);
  echo '<table border=1px class="td_info_c"><tr><td colspan="10" class="label_2">General Information</td></tr>';
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    //  echo '<tr>';
    //  echo '<td class="textcolheader">Sl No: </td><td class="textcolheader_data">'.$row['apps_sl_no'].'</td>';
    //  echo '<td class="textcolheader">SWC Id: </td><td class="textcolheader_data">'.$row['swc_id'].'</td></tr>';
      echo '<tr>';
      echo '<td class="textcolheader_label">Apps Name: </td><td class="textcolheader_data">'.$row['apps_name'].'</td>';
      echo '<td class="textcolheader_label">LOB:</td><td class="textcolheader_data">'.$row['lob'].'</td>';
      echo '</tr><tr>';
      echo '<td class="textcolheader_label">IRR:</td><td class="textcolheader_data">'.$row['irr'].'</td>';
      echo '<td class="textcolheader_label">USA Usage:</td><td class="textcolheader_data">'.$row['usa_usage'].'</td>';
      echo '</tr><tr>';
      echo '<td class="textcolheader_label">Cri & Sen Data:</td><td class="textcolheader_data">'.$row['cri_sen'].'</td>';
      echo '<td class="textcolheader_label">MLSI:</td><td class="textcolheader_data">'.$row['mlsi'].'</td>';
      echo '</tr><tr>';
      echo '<td class="textcolheader_label">In Scope:</td><td class="textcolheader_data">'.$row['in_scope'].'</td>';
      echo '<td class="textcolheader_label">In Date:</td><td class="textcolheader_data">'.$row['in_date'].'</td>';

      echo '</tr>';
    }
  }
  else {
    echo '<tr>';
    echo '<td class="textcolheader_label">SL NO: </td><td class="textcolheader_data">'.$row['apps_sl_no'].'</td>';
    echo '<td class="textcolheader_label">SWC ID: </td><td class="textcolheader_data">'.$row['swc_id'].'</td>';
    echo '</tr><tr>';
    echo '<td class="textcolheader_label">Application Name: </td><td class="textcolheader_data">'.$row['apps_name'].'</td>';
    echo '<td class="textcolheader_label">LOB:</td><td class="textcolheader_data">'.$row['lob'].'</td>';
    echo '</tr><tr>';
    echo '<td class="textcolheader_label">IRR:</td><td class="textcolheader_data">'.$row['irr'].'</td>';
    echo '<td class="textcolheader_label">USA USAGE:</td><td class="textcolheader_data">'.$row['usa_usage'].'</td>';
    echo '</tr><tr>';
    echo '<td class="textcolheader_label">CRITICAL &<br>SENSITIVE DATA:</td><td class="textcolheader_data">'.$row['cri_sen'].'</td>';
    echo '<td class="textcolheader_label">IN SCOPE:</td><td class="textcolheader_data">'.$row['in_scope'].'</td>';
    echo '</tr><tr>';
    echo '<td class="textcolheader_label">IN DATE:</td><td class="textcolheader_data">'.$row['in_date'].'</td>';
    echo '<td class="textcolheader_label">MLSI:</td><td class="textcolheader_data">'.$row['mlsi'].'</td>';
    echo '</tr>';
  }
  echo '</table>';
}
// Display Application Authentication Status Information
function app_info_auth(&$app_swc_id){
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $sql = "SELECT apps_sl_no, swc_id, present_status, present_sub_status, overall_status, enforcement_solution, exception_criteria, enforcement_date_av, exception_expire_date_av, enforcement_date, exception_expire_date, comms, used_id, created_at FROM 2fa.enforcement_info WHERE swc_id = '$app_swc_id' ORDER BY apps_sl_no DESC LIMIT 1";
  $result = $link->query($sql);
  echo '<table border="1px" class="td_info_c"><tr><td colspan="10" class="label_2">Authentication Information</td></tr>';
  if ($result->num_rows > 0) {
    // output data of each row
    while($row_info_auth = $result->fetch_assoc()) {

      echo '<tr>';

      // Present Status
      if (!empty($row_info_auth['present_status'])) {
        if ($row_info_auth['present_status'] == 'new_in_scope'){ echo '<td class="textcolheader_label">Present Status:</td><td class="textcolheader_data">New In Scope</td>'; }
        else if ($row_info_auth['present_status'] == 'enforcement'){ echo '<td class="textcolheader_label">Present Status:</td><td class="textcolheader_data">Enforcement</td>'; }
        else if ($row_info_auth['present_status'] == 'exception'){ echo '<td class="textcolheader_label">Present Status:</td><td class="textcolheader_data">Exception</td>'; }
        else if ($row_info_auth['present_status'] == 'out_of_scope'){ echo '<td class="textcolheader_label">Present Status:</td><td class="textcolheader_data">Out Of Scope</td>'; }
        else if ($row_info_auth['present_status'] == 'not_available'){ echo '<td class="textcolheader_label">Present Status:</td><td class="textcolheader_data">Not Available</td>'; }
      }

      // Present Sub Status
      if (!empty($row_info_auth['present_sub_status'])) {
        if ($row_info_auth['present_sub_status'] == 'not_available'){ echo '<td class="textcolheader_label">Present Sub Status:</td><td class="textcolheader_data">Not Available</td>'; }
        else if ($row_info_auth['present_sub_status'] == 'comm_sent'){ echo '<td class="textcolheader_label">Present Sub Status:</td><td class="textcolheader_data">Comms Sent</td>'; }
        else if ($row_info_auth['present_sub_status'] == 'rem_in_progress'){ echo '<td class="textcolheader_label">Present Sub Status:</td><td class="textcolheader_data">Remediation In Progress</td>'; }
        else if ($row_info_auth['present_sub_status'] == 'evidence_form_sent'){ echo '<td class="textcolheader_label">Present Sub Status:</td><td class="textcolheader_data">Evidence Form Sent</td>'; }
        else if ($row_info_auth['present_sub_status'] == 'evidence_form_under_review'){ echo '<td class="textcolheader_label">Present Sub Status:</td><td class="textcolheader_data">Evidence Form Under Review</td>'; }
        else if ($row_info_auth['present_sub_status'] == 'complete'){ echo '<td class="textcolheader_label">Present Sub Status:</td><td class="textcolheader_data">Complete</td>'; }
        else if ($row_info_auth['present_sub_status'] == 'under_sustainability_review'){ echo '<td class="textcolheader_label">Present Sub Status:</td><td class="textcolheader_data">Under Sustainability Review</td>'; }
        else if ($row_info_auth['present_sub_status'] == 're_evidencing_req'){ echo '<td class="textcolheader_label">Present Sub Status:</td><td class="textcolheader_data">Re-Evidencing Required After WMAP Go Live</td>'; }
        else if ($row_info_auth['present_sub_status'] == 'form_sent'){ echo '<td class="textcolheader_label">Present Sub Status:</td><td class="textcolheader_data">Form Sent</td>'; }
        else if ($row_info_auth['present_sub_status'] == 'form_awaiting_app'){ echo '<td class="textcolheader_label">Present Sub Status:</td><td class="textcolheader_data">Form Awaiting Approvals</td>'; }
        else if ($row_info_auth['present_sub_status'] == 'exception_until_enforcement'){ echo '<td class="textcolheader_label">Present Sub Status:</td><td class="textcolheader_data">Exception Until Enforcement</td>'; }
        else if ($row_info_auth['present_sub_status'] == 'sera_change_verified'){ echo '<td class="textcolheader_label">Present Sub Status:</td><td class="textcolheader_data">SERA Change Verified</td>'; }
        else if ($row_info_auth['present_sub_status'] == 'decommission_in_progress'){ echo '<td class="textcolheader_label">Present Sub Status:</td><td class="textcolheader_data">Decommission In Progress</td>'; }
      }

      echo '</tr>';
      echo '<tr>';


      // Overall Status
      if (!empty($row_info_auth['overall_status'])){
        if ($row_info_auth['overall_status'] == 'not_available'){ echo '<td class="textcolheader_label">Over All Status:</td><td class="textcolheader_data">Not Aavilable</td>'; }
        else if ($row_info_auth['overall_status'] == 'Enforcement'){ echo '<td class="textcolheader_label">Over All Status:</td><td class="textcolheader_data">Enforcement</td>'; }
        else if ($row_info_auth['overall_status'] == 'Exception'){ echo '<td class="textcolheader_label">Over All Status:</td><td class="textcolheader_data">Exception</td>'; }
      }


      // Enforcement Solution
      if (!empty($row_info_auth['enforcement_solution'])){
        if ($row_info_auth['enforcement_solution'] == 'not_available'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">Not Available</td>'; }
        else if ($row_info_auth['enforcement_solution'] == 'aad_ms_auth'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">AAD + MS Authentication</td>'; }
        else if ($row_info_auth['enforcement_solution'] == 'azure_ad'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">MS Azure AD</td>'; }
        else if ($row_info_auth['enforcement_solution'] == 'bespoke'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">Bespoke</td>'; }
        else if ($row_info_auth['enforcement_solution'] == 'bespoke_google_auth'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">Bespoke + Google Authentication</td>'; }
        else if ($row_info_auth['enforcement_solution'] == 'consultworks'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">Consultworks</td>'; }
        else if ($row_info_auth['enforcement_solution'] == 'consultworks_pw'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">Consultworks + PW Security</td>'; }
        else if ($row_info_auth['enforcement_solution'] == 'google_auth'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">Google Authentication</td>'; }
        else if ($row_info_auth['enforcement_solution'] == 'isga'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">ISGA</td>'; }
        else if ($row_info_auth['enforcement_solution'] == 'isga_tbc'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">ISGA + TBC</td>'; }
        else if ($row_info_auth['enforcement_solution'] == 'isso'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">ISSO</td>'; }
        else if ($row_info_auth['enforcement_solution'] == 'isso_bespoke'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">ISSO / Bespoke</td>'; }
        else if ($row_info_auth['enforcement_solution'] == 'isso_ch'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">ISSO CH</td>'; }
        else if ($row_info_auth['enforcement_solution'] == 'isso_fed'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">ISSO FED</td>'; }
        else if ($row_info_auth['enforcement_solution'] == 'isso_global'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">ISSO GLOBAL</td>'; }
        else if ($row_info_auth['enforcement_solution'] == 'ldap_fed'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">LDAP FED</td>'; }
        else if ($row_info_auth['enforcement_solution'] == 'msal'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">MSAL</td>'; }
        else if ($row_info_auth['enforcement_solution'] == 'neo'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">NEO</td>'; }
        else if ($row_info_auth['enforcement_solution'] == 'ols'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">OLS</td>'; }
        else if ($row_info_auth['enforcement_solution'] == 'speed'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">NEO</td>'; }
        else if ($row_info_auth['enforcement_solution'] == 'tbc'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">TBC</td>'; }
        else if ($row_info_auth['enforcement_solution'] == 'wamp'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">WAMP</td>'; }
        else if ($row_info_auth['enforcement_solution'] == 'wamp_pw_isso'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">WAMP / PW / ISSO</td>'; }
      }
      // Exception Criteria
      if (!empty($row_info_auth['exception_criteria'])){
        if ($row_info_auth['exception_criteria'] == 'bus_den'){ echo '<td class="textcolheader_label">Exception Criteria:</td><td class="textcolheader_data">Business Dependency</td>'; }
        else if ($row_info_auth['exception_criteria'] == 'ven_den'){ echo '<td class="textcolheader_label">Exception Criteria:</td><td class="textcolheader_data">Vendor Dependency</td>'; }
      }
      echo '</tr>';
      echo '<tr>';

      // Enforcement Date Available
      if (!empty($row_info_auth['enforcement_date_av'])){
        if ($row_info_auth['enforcement_date_av'] == 'available'){ echo '<td class="textcolheader_label">Enforcement Date Available:</td><td class="textcolheader_data">Available</td>'; }
        else if ($row_info_auth['enforcement_date_av'] == 'not_available'){ echo '<td class="textcolheader_label">Enforcement Date Available:</td><td class="textcolheader_data">Not Available</td>'; }
      }
      // Exception Expire Date Available
      if (!empty($row_info_auth['exception_expire_date_av'])){
        if ($row_info_auth['exception_expire_date_av'] == 'available'){ echo '<td class="textcolheader_label">Exception Expire Date Available:</td><td class="textcolheader_data">Available</td>'; }
        else if ($row_info_auth['exception_expire_date_av'] == 'not_available'){ echo '<td class="textcolheader_label">Exception Expire Date Available:</td><td class="textcolheader_data">Not Available</td>'; }
      }

      if ($row_info_auth['enforcement_date'] != '1111-11-11'){ echo '<tr><td class="textcolheader_label">Enforcement Date :</td><td class="textcolheader_data">'.$row_info_auth['enforcement_date'].'</td></tr>'; }
      if ($row_info_auth['exception_expire_date'] != '1111-11-11'){ echo '<tr><td class="textcolheader_label">Exception Expire Date:</td><td class="textcolheader_data">'.$row_info_auth['exception_expire_date'].'</td></tr>'; }

      echo '</tr>';


    }
  }
  else
  {
    echo '<tr>';
    echo '<td class="textcolheader_data"> No Information Available Right Now. Please Update the information if its available.</td>';
    echo '</tr>';
  }
  echo '</table>';
}
// Display All the comment as descending order
function app_info_auth_comms(&$app_swc_id){
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $sql = "SELECT comms_sl_no, swc_id, enforcement_sl_no, comms, username, created_at FROM 2fa.comment_info WHERE swc_id = '$app_swc_id' ORDER BY comms_sl_no DESC";
  $result = $link->query($sql);
  echo '<table class="td_info_c"><tr><td colspan="10" class="label_2">Comments</td></tr>';
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      if (!empty($row['enforcement_sl_no'])){
        $enfor_sl_no = $row['enforcement_sl_no'];
        $sql_enforce = "SELECT apps_sl_no, swc_id, present_status, present_sub_status, overall_status, enforcement_solution, exception_criteria, enforcement_date_av, exception_expire_date_av, enforcement_date, exception_expire_date, comms, used_id, created_at FROM 2fa.enforcement_info WHERE apps_sl_no = '$enfor_sl_no' ORDER BY apps_sl_no DESC";
        $result_enfoce = $link->query($sql_enforce);
        if ($result_enfoce->num_rows > 0)
        {
          while ($row_enforce = $result_enfoce->fetch_assoc()) {

            $datetime_enforcement_info = new DateTime($row_enforce['created_at']);
            $date_enforcement_info = $datetime_enforcement_info->format('F d, Y'); // Convert Datetime to Date
            $time_enforcement_info = $datetime_enforcement_info->format('H:i A'); // Convert Datetime to Time

            echo '<tr>';
            echo '<td class="textcolheader_user_id">'.$row_enforce['used_id'].'</td>';
            // Present Status
            if (!empty($row_enforce['present_status'])) {
              if ($row_enforce['present_status'] == 'new_in_scope'){ echo '<td class="textcolheader_label">Present Status:</td><td class="textcolheader_data">New In Scope</td>'; }
              else if ($row_enforce['present_status'] == 'enforcement'){ echo '<td class="textcolheader_label">Present Status:</td><td class="textcolheader_data">Enforcement</td>'; }
              else if ($row_enforce['present_status'] == 'exception'){ echo '<td class="textcolheader_label">Present Status:</td><td class="textcolheader_data">Exception</td>'; }
              else if ($row_enforce['present_status'] == 'out_of_scope'){ echo '<td class="textcolheader_label">Present Status:</td><td class="textcolheader_data">Out Of Scope</td>'; }
              else if ($row_enforce['present_status'] == 'not_available'){ echo '<td class="textcolheader_label">Present Status:</td><td class="textcolheader_data">Not Available</td>'; }
            }
            // Present Sub Status
            if (!empty($row_enforce['present_sub_status'])) {
              if ($row_enforce['present_sub_status'] == 'not_available'){ echo '<td class="textcolheader_label">Present Sub Status:</td><td class="textcolheader_data">Not Available</td>'; }
              else if ($row_enforce['present_sub_status'] == 'comm_sent'){ echo '<td class="textcolheader_label">Present Sub Status:</td><td class="textcolheader_data">Comms Sent</td>'; }
              else if ($row_enforce['present_sub_status'] == 'rem_in_progress'){ echo '<td class="textcolheader_label">Present Sub Status:</td><td class="textcolheader_data">Remediation In Progress</td>'; }
              else if ($row_enforce['present_sub_status'] == 'evidence_form_sent'){ echo '<td class="textcolheader_label">Present Sub Status:</td><td class="textcolheader_data">Evidence Form Sent</td>'; }
              else if ($row_enforce['present_sub_status'] == 'evidence_form_under_review'){ echo '<td class="textcolheader_label">Present Sub Status:</td><td class="textcolheader_data">Evidence Form Under Review</td>'; }
              else if ($row_enforce['present_sub_status'] == 'complete'){ echo '<td class="textcolheader_label">Present Sub Status:</td><td class="textcolheader_data">Complete</td>'; }
              else if ($row_enforce['present_sub_status'] == 'under_sustainability_review'){ echo '<td class="textcolheader_label">Present Sub Status:</td><td class="textcolheader_data">Under Sustainability Review</td>'; }
              else if ($row_enforce['present_sub_status'] == 're_evidencing_req'){ echo '<td class="textcolheader_label">Present Sub Status:</td><td class="textcolheader_data">Re-Evidencing Required After WMAP Go Live</td>'; }
              else if ($row_enforce['present_sub_status'] == 'form_sent'){ echo '<td class="textcolheader_label">Present Sub Status:</td><td class="textcolheader_data">Form Sent</td>'; }
              else if ($row_enforce['present_sub_status'] == 'form_awaiting_app'){ echo '<td class="textcolheader_label">Present Sub Status:</td><td class="textcolheader_data">Form Awaiting Approvals</td>'; }
              else if ($row_enforce['present_sub_status'] == 'exception_until_enforcement'){ echo '<td class="textcolheader_label">Present Sub Status:</td><td class="textcolheader_data">Exception Until Enforcement</td>'; }
              else if ($row_enforce['present_sub_status'] == 'sera_change_verified'){ echo '<td class="textcolheader_label">Present Sub Status:</td><td class="textcolheader_data">SERA Change Verified</td>'; }
              else if ($row_enforce['present_sub_status'] == 'decommission_in_progress'){ echo '<td class="textcolheader_label">Present Sub Status:</td><td class="textcolheader_data">Decommission In Progress</td>'; }
            }
            echo '</tr>';



            echo '<tr>';
            echo '<td class="textcolheader_time">'.$date_enforcement_info.'</td>';
            // Overall Status
            if (!empty($row_enforce['overall_status'])){
              if ($row_enforce['overall_status'] == 'not_available'){ echo '<td class="textcolheader_label">Over All Status:</td><td class="textcolheader_data">Not Aavilable</td>'; }
              else if ($row_enforce['overall_status'] == 'Enforcement'){ echo '<td class="textcolheader_label">Over All Status:</td><td class="textcolheader_data">Enforcement</td>'; }
              else if ($row_enforce['overall_status'] == 'Exception'){ echo '<td class="textcolheader_label">Over All Status:</td><td class="textcolheader_data">Exception</td>'; }
            }
            // Enforcement Solution
            if (!empty($row_enforce['enforcement_solution'])){
              if ($row_enforce['enforcement_solution'] == 'not_available'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">Not Available</td>'; }
              else if ($row_enforce['enforcement_solution'] == 'aad_ms_auth'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">AAD + MS Authentication</td>'; }
              else if ($row_enforce['enforcement_solution'] == 'azure_ad'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">MS Azure AD</td>'; }
              else if ($row_enforce['enforcement_solution'] == 'bespoke'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">Bespoke</td>'; }
              else if ($row_enforce['enforcement_solution'] == 'bespoke_google_auth'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">Bespoke + Google Authentication</td>'; }
              else if ($row_enforce['enforcement_solution'] == 'consultworks'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">Consultworks</td>'; }
              else if ($row_enforce['enforcement_solution'] == 'consultworks_pw'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">Consultworks + PW Security</td>'; }
              else if ($row_enforce['enforcement_solution'] == 'google_auth'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">Google Authentication</td>'; }
              else if ($row_enforce['enforcement_solution'] == 'isga'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">ISGA</td>'; }
              else if ($row_enforce['enforcement_solution'] == 'isga_tbc'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">ISGA + TBC</td>'; }
              else if ($row_enforce['enforcement_solution'] == 'isso'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">ISSO</td>'; }
              else if ($row_enforce['enforcement_solution'] == 'isso_bespoke'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">ISSO / Bespoke</td>'; }
              else if ($row_enforce['enforcement_solution'] == 'isso_ch'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">ISSO CH</td>'; }
              else if ($row_enforce['enforcement_solution'] == 'isso_fed'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">ISSO FED</td>'; }
              else if ($row_enforce['enforcement_solution'] == 'isso_global'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">ISSO GLOBAL</td>'; }
              else if ($row_enforce['enforcement_solution'] == 'ldap_fed'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">LDAP FED</td>'; }
              else if ($row_enforce['enforcement_solution'] == 'msal'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">MSAL</td>'; }
              else if ($row_enforce['enforcement_solution'] == 'neo'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">NEO</td>'; }
              else if ($row_enforce['enforcement_solution'] == 'ols'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">OLS</td>'; }
              else if ($row_enforce['enforcement_solution'] == 'speed'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">NEO</td>'; }
              else if ($row_enforce['enforcement_solution'] == 'tbc'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">TBC</td>'; }
              else if ($row_enforce['enforcement_solution'] == 'wamp'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">WAMP</td>'; }
              else if ($row_enforce['enforcement_solution'] == 'wamp_pw_isso'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">WAMP / PW / ISSO</td>'; }
            }
            if (!empty($row_enforce['exception_criteria'])){
              if ($row_enforce['exception_criteria'] == 'bus_den'){ echo '<td class="textcolheader_label">Exception Criteria:</td><td class="textcolheader_data">Business Dependency</td>'; }
              else if ($row_enforce['exception_criteria'] == 'ven_den'){ echo '<td class="textcolheader_label">Enforcement Solution:</td><td class="textcolheader_data">Vendor Dependency</td>'; }
            }
            echo '</tr>';


            echo '<tr>';
            echo '<td class="textcolheader_time">'.$time_enforcement_info.'</td>'; // Time
            // Enforcement Date Available
            if (!empty($row_enforce['enforcement_date_av'])){
              if ($row_enforce['enforcement_date_av'] == 'available'){ echo '<td class="textcolheader_label">Enforcement Date Available:</td><td class="textcolheader_data">Available</td>'; }
              else if ($row_enforce['enforcement_date_av'] == 'not_available'){ echo '<td class="textcolheader_label">Enforcement Date Available:</td><td class="textcolheader_data">Not Available</td>'; }
            } // Exception Date Available
            if (!empty($row_enforce['exception_expire_date_av'])){
              if ($row_enforce['exception_expire_date_av'] == 'available'){ echo '<td class="textcolheader_label">Exception Expire Date Available:</td><td class="textcolheader_data">Available</td>'; }
              else if ($row_enforce['exception_expire_date_av'] == 'not_available'){ echo '<td class="textcolheader_label">Exception Expire Date Available:</td><td class="textcolheader_data">Not Available</td>'; }
            }
            // Enforcement Date
            if ($row_enforce['enforcement_date'] != '1111-11-11'){
              echo '<td class="textcolheader_label">Enforcement Date :</td><td class="textcolheader_data">'.$row_enforce['enforcement_date'].'</td>';
            }
            // Exception Date
            if ($row_enforce['exception_expire_date'] != '1111-11-11'){
              echo '<td class="textcolheader_label">Exception Expire Date:</td><td class="textcolheader_data">'.$row_enforce['exception_expire_date'].'</td>';
            }
            echo'</tr>';
            if (!empty($row['comms'])){
              echo '<tr><td></td><td class="textcolheader_label">Comments:</td><td class="textcolheader_data" colspan="10">'.$row['comms'].'</td></tr>';
            }
          }
        }
        echo '<tr><td colspan="10"><hr></td></tr>';
      }
      else {


        $datetime_comment_info = new DateTime($row['created_at']);
        $date_comment_info = $datetime_comment_info->format('F d, Y'); // Convert Datetime to Date
        $time_comment_info = $datetime_comment_info->format('H:i A'); // Convert Datetime to Time


        echo '<tr><td class="textcolheader_user_id">'.$row['username'].'</td><td class="textcolheader_label" rowspan="3">Comments:</td><td class="textcolheader_data" colspan="10" rowspan="3">'.$row['comms'].'</td></tr>';
      //  echo '<tr><td>'.$row['created_at'].'</td></tr>';
        echo '<tr><td class="textcolheader_date">'.$date_comment_info.'</td></tr>';
        echo '<tr><td class="textcolheader_time">'.$time_comment_info.'</td></tr>';
        echo '<tr><td colspan="10"><hr></td></tr>';
      }
    }
  }
  else{
    echo '<tr><td></td><td class="textcolheader_data"> No Information Available Right Now. Please Update the Comment Section, if its available.</td></tr>';
  }
  echo '</table>';
}
// Display All the Exception Details information as descending order
function app_info_exception_details(&$app_swc_id){

  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $sql_exception_details = "SELECT exception_details_sl_no, swc_id, exception_category, two_fa_planned, two_fa_seems_possible, remediation_feasibility, exception_future_status, proposal, two_fa_proposed_date, user_id, created_at FROM 2fa.exception_details_info WHERE swc_id = '$app_swc_id' ORDER BY exception_details_sl_no DESC LIMIT 1";
  $result = $link->query($sql_exception_details);
  echo '<table border="1px" class="td_info_c"><tr><td colspan="10" class="label_2">Exception Details</td></tr>';
  if ($result->num_rows > 0) {
    // output data of each row
    while($row_info_exception_details = $result->fetch_assoc()) {



      $datetime_enforcement_info = new DateTime($row_enforce['created_at']);
      $date_enforcement_info = $datetime_enforcement_info->format('F d, Y'); // Convert Datetime to Date
      $time_enforcement_info = $datetime_enforcement_info->format('H:i A'); // Convert Datetime to Time

      echo '<tr>';
      echo '<td class="textcolheader_data">'.$row_info_exception_details['user_id'].'</td>';

      echo '<td class="textcolheader_label">2FA<br>Planned:</td><td class="textcolheader_data">'.$row_info_exception_details['two_fa_planned'].'</td>';
      echo '<td class="textcolheader_label">2FA Seems<br>Possible:</td><td class="textcolheader_data">'.$row_info_exception_details['two_fa_seems_possible'].'</td>';
      echo '</tr>';

      echo '<tr>';
      echo '<td class="textcolheader_data">'.$date_enforcement_info.'</td>';
      echo '<td class="textcolheader_label">Remediation<br>Feasibility:</td><td class="textcolheader_data">'.$row_info_exception_details['remediation_feasibility'].'</td>';
      echo '<td class="textcolheader_label">Exception<br>Status:</td><td class="textcolheader_data">'.$row_info_exception_details['exception_future_status'].'</td>';
      echo '</tr>';


      echo '<tr>';
      echo '<td class="textcolheader_data">'.$time_enforcement_info.'</td>';
      echo '<td class="textcolheader_label">Proposal:</td><td class="textcolheader_data">'.$row_info_exception_details['proposal'].'</td>';
      echo '<td class="textcolheader_label">2FA Proposed<br>Date:</td><td class="textcolheader_data">'.$row_info_exception_details['two_fa_proposed_date'].'</td>';
      echo '</tr>';


    }
  }
  else
  {
    echo '<tr>';
    echo '<td class="textcolheader_data"> No Information Available Right Now. Please Update the information if its available.</td>';
    echo '</tr>';
  }
  echo '</table>';

}

?>
