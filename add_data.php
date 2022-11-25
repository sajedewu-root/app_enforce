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
// Add new application in the list
function add_app(){
  echo '<table><tr><td><p class="label_2_r">Add Application</p></td></tr></table>';
  echo '<form action="insert_add_app.php" method="post">';
  echo '<table>';
  echo '<tr><td class="textbox_label_td_l_r"> Software<br>Component ID:</td><td><input type="text" name="swc_id" class="textbox"></td></tr>';
  echo '<tr><td class="textbox_label_td_l_r"> Software<br>Component Name:</td><td><input type="text" name="apps_name" class="textbox"></td></tr>';

  echo '<td class="textbox_label_td_l_r"> LOB:</td><td><select type="text" name="lob" class="textbox">';
  echo '<option value="">--- Choose a LoB ---</option>';
  echo '<option value="CDIO AM">CDIO AM</option>';
  echo '<option value="CDIO WM USA">CDIO WM USA</option>';
  echo '<option value="CDIO Investment">CDIO Investment</option>';
  echo '<option value="CDIO GWM S&I / P&C">CDIO GWM S&I / P&C</option>';
  echo '<option value="CDIO Group Function">CDIO Group Function</option>';
  echo '<option value="OTHER NON IT">Other Non IT</option>';
  echo ' <option value="OTHER NON IT">Technology Services</option>';
  echo '</select></td></tr>';
  echo '<tr><td class="textbox_label_td_l_r"> IRR:</td><td><input type="text" name="irr" class="textbox"></td></tr>';

  echo '<!-- USA Usage-->';
  echo '<tr><td class="textbox_label_td_l_r"> USA USAGE:</td><td><select type="text" name="usa_usage" class="textbox">';
  echo '<option value="">--- Yes / No ---</option>';
  echo '<option value="Yes">Yes</option>';
  echo '<option value="No">No</option>';
  echo '</select></td></tr>';

  echo '<!--Critical and Sensitive Data-->';
  echo '<tr><td class="textbox_label_td_l_r"> Critical and<br>Sensitive:</td><td><select type="text" name="cri_sen" class="textbox">';
  echo '<option value="">--- Yes / No ---</option>';
  echo '<option value="Yes">Yes</option>';
  echo '<option value="No">No</option>';
  echo '</select></td></tr>';

  echo '<!--In Scope-->';
  echo '<tr><td class="textbox_label_td_l_r"> In Scope:</td><td><select type="text" name="in_scope" class="textbox">';
  echo '<option value="">--- Yes / No ---</option>';
  echo '<option value="Yes">Yes</option>';
  echo '<option value="No">No</option>';
  echo '</select></td></tr>';

  echo '<tr><td class="textbox_label_td_l_r"> In Scope Date:</td><td><input type="date" id="start" name="in_date" class="textbox"></td></tr>';
  echo '<tr><td class="textbox_label_td_l_r"> MLSI:</td><td><input type="text" name="mlsi" class="textbox"></td></tr>';
  echo '<tr><td align="center" colspan="2"><input class="button" type="submit" id="getinfo" name="submit" value="ADD" /></td></tr>';
  echo '</table>';
  echo '</form>';

}
// Add Contact Information in the application
function add_contact(&$app_swc_id){
  echo '<form action="insert_add_contact.php" method="post">';
  echo '<table>';
  echo '<tr><td colspan="2"><p class="label_2_r">Contact Deatils</p></td></tr>';
  echo '<tr><td colspan="2"><hr></td></tr>';
  echo '<tr><td class="textbox_label"> Software<br>Component ID:</td>';
  echo '<td><input type="text" name="swc_id" class="textbox" value="'.$app_swc_id.'"></td>';
  echo '</tr>';
  echo '<tr><td class="textbox_label"> GPN:</td><td><input type="text" name="gpn" class="textbox"></td></tr>';
  echo '<tr><td class="textbox_label"> Name:</td><td><input type="text" name="name" class="textbox"></td></tr>';
  echo '<tr><td class="textbox_label"> Position:</td><td><select type="text" name="position" class="textbox">';
  echo '<option value="">--- Choose a Position ---</option>';
  echo '<option value="swc_mgr">SWC Mgr</option>';
  echo '<option value="solu_mgr">Solution Mgr</option>';
  echo '</select>';
  echo '</td>';
  echo '</tr>';
  echo '<tr>';
  echo '<td align="center" colspan="2"><input class="button" type="submit" id="getinfo" name="submit" value="ADD" /></td>';
  echo '</tr>';
  echo '</table>';
  echo '</form>';
}
// Add Jurisdiction information in the application
function add_juri(&$app_swc_id){
  echo '<table><tr><td><p class="label_2_r">Add Application In Jurisdiction</p></td></tr></table>';
  echo '<form action="" method="post">';
  echo '<table>';
  echo '<tr><td class="textbox_label_td_l_r"> Software<br>Component ID:</td><td><input type="text" name="swc_id" class="textbox" value="'.$app_swc_id.'"></td></tr>';

  echo '<!-- Jurisdiction Status -->';
  echo '<tr><td class="textbox_label_td_l_r"> Jurisdiction <br> Status:</td><td><select type="text" name="usa_usage" class="textbox">';
  echo '<option value="">--- Yes / No ---</option>';
  echo '<option value="Yes">Yes</option>';
  echo '<option value="No">No</option>';
  echo '</select></td></tr>';

  echo '<tr><td align="center" colspan="2"><input class="button" type="submit" id="getinfo" name="submit" value="ADD" /></td></tr>';
  echo '</table>';
  echo '</form>';
}
// Add Application Authentication Status
function add_auth(&$app_swc_id){
  echo '<table><tr><td><p class="label_2_r">Authentication Solution</p></td></tr></table>';
  echo '<form action="insert_add_auth.php" method="post">';
  echo '<table>';
  // ***************************
  // Software Component Id
  // ***************************
  echo '<tr><td class="textbox_label_td_l_r"> Software<br>Component ID:</td>';
  echo '<td><input type="text" name="swc_id" class="textbox" value="'.$app_swc_id.'"></td>';
  echo '</tr>';
  // ***************************
  // Present Status
  // ***************************
  echo '<tr><td colspan="10"><hr></td></tr>';
  echo '<tr><td colspan="10" class="textbox_label_td_l_r" >Present Satuts</td></tr>';
  echo '<tr><td colspan="10"><hr></td></tr>';
  echo '<tr><td class="textbox_label_td_l_r">Present<br>Status:</td>';
  echo '<td><select name="present_status" class="textbox" onchange="present_sub_status_func(this.options[this.selectedIndex].value)" required>';  // Select Box Present Status - present_status
  echo '<option value="not_available">Not Available</option>';
  echo '<option value="new_in_scope">New In Scope</option>';
  echo '<option value="enforcement">Enforcement</option>';
  echo '<option value="exception">Exception</option>';
  echo '<option value="out_of_scope">Out of Scope</option>';
  echo '</select></td></tr>';
  echo '<tr id="div6"></tr>'; // Select Box Present Sub Status - present_sub_status
  // ******************
  // Over All Status
  // ******************
  echo '<tr id="hr1"></tr>';
  echo '<tr id="auth_title"></tr>';
  echo '<tr id="hr2"></tr>';
  echo '<tr id="complete_details"></tr>';
  echo '<tr id="div1"></tr>'; // Type of Enforcement or Exception - auth_solution
  echo '<tr id="div2"></tr>'; // Enforcement or Exception Date Available or Not Available - date_available
  echo '<tr id="div3"></tr>';
  echo '<tr id="div4"></tr>';
  echo '<tr id="div5"></tr>'; // Enforcement date or Exception Expire Date - date
  echo '<tr><td colspan= "10"><hr></td></tr>';
  // ***************************
  // Select box Add Comments
  // ***************************
  echo '<tr>';
  echo '<td class="textbox_label_td_l_r">Comments:</td>';
  echo '<td><select name="status_comms" class="textbox" onchange="stat_comms(this.options[this.selectedIndex].value)" required>';
  echo '<option value="not_available">Not Available</option>';
  echo '<option value="available">Available</option>';
  echo '</select></td></tr>';
  echo '<tr id="div7"></tr>';


  echo '<tr><td align="center" colspan="10"><input class="button" type="submit" id="getinfo" name="submit" value="ADD"></td></tr>'; // Data add into the Database
  echo '</table>';
  echo '</form>';
}
// Add Comment on Application
function add_auth_comm(&$app_swc_id){
  echo '<table><tr><td><p class="label_2_r">Add Comments</p></td></tr></table>';
  echo '<form action="insert_add_auth_comm.php" method="post">';
  echo '<table>';

  // Software Component Id
  echo '<tr><td class="textbox_label_td_l_r"> Software<br>Component ID:</td>';
  echo '<td><input type="text" name="swc_id" class="textbox" value="'.$app_swc_id.'"></td>';
  echo '</tr>';

  // Select box Add Comments
  echo '<tr>';
  echo '<tr><td class="textbox_label_td_l_r">Comments:</td>';
  echo '<td><select class="textbox" onchange="stat_comms(this.options[this.selectedIndex].value)" required>';
  echo '<option value="choose_a_option">Choose a option</option>';
  echo '<option value="available">Available</option>';
  echo '<option value="not_available">Not Available</option>';
  echo '</select></td></tr>';
  echo '<tr id="div7"></tr>';


  echo '<tr><td align="center" colspan="10"><input class="button" type="submit" id="getinfo" name="submit" value="ADD" /></td></tr>'; // Data add into the Database
  echo '</table>';
  echo '</form>';
}
// Add Exception Details on Application
function add_exception_details(&$app_swc_id){
  echo '<table><tr><td><p class="label_2_r">Exception Details</p></td></tr></table>';
  echo '<form action="insert_add_exception_details.php" method="post">';
  echo '<table>';

  // Software Component Id
  echo '<tr><td class="textbox_label_td_l_r"> Software<br>Component ID:</td>';
  echo '<td><input type="text" name="swc_id" class="textbox" value="'.$app_swc_id.'"></td>';
  echo '</tr>';

  // Select an item and add justtification
  // Exeception Catagory
  echo '<tr>';
  echo '<td class="textbox_label_td_l_r">Exception<br>Category:</td>';
  echo '<td>';
  echo '<select name="exception_category" class="textbox">';
  echo '<option>Choose a option</option>';
  echo '<option value="vendor_dependency">Vendor Dependency</option>';
  echo '<option value="internl_dependency">Internal Dependency</option>';
  echo '<option value="business_dec_dep">Business Decision / Dependency</option>';
  echo '<option value="two_fa_progress_time_needed">2FA in progress (Time Needed)</option>';
  echo '<option value="two_fa_not_required">2FA not required</option>';
  echo '<option value="two_fa_not_available">2FA not available</option>';
  echo '<option value="decommed_planned">Decommed planned</option>';
  echo '<option value="public_data_requirements">Public Data Requirements</option>';
  echo '<option value="no_cid">No CID</option>';
  echo '<option value="user_challenges">User Challenges</option>';
  echo '<option value="wmap_decommed_rumra">WMAP / Decommed  / RUMRA</option>';
  echo '<option value="other">Other</option>';
  echo '</select>';
  echo '</td>';
  echo '</tr>';

  // Select an item and add justtification
  // 2FA Planned
  echo '<tr>';
  echo '<td class="textbox_label_td_l_r">2FA Planned:</td>';
  echo '<td>';
  echo '<select name="two_fa_planned" class="textbox">';
  echo '<option>Choose a option</option>';
  echo '<option value="yes">Yes</option>';
  echo '<option value="no">No</option>';
  echo '</select>';
  echo '</td>';
  echo '</tr>';

  // Select an item and add justtification
  // 2FA seems possible
  echo '<tr>';
  echo '<td class="textbox_label_td_l_r">2FA Seems<br>Possible:</td>';
  echo '<td>';
  echo '<select name="two_fa_seems_possible" class="textbox" >';
  echo '<option>Choose a option</option>';
  echo '<option value="yes">Yes</option>';
  echo '<option value="no">No</option>';
  echo '</select>';
  echo '</td>';
  echo '</tr>';


  // Select an item and add justtification
  // 2FA seems possible
  echo '<tr>';
  echo '<td class="textbox_label_td_l_r">Remediation<br>Feasible</td>';
  echo '<td>';
  echo '<select name="remediation_feasibility" class="textbox">';
  echo '<option>Choose a option</option>';
  echo '<option value="remediation_feasible">Remediation Feasible</option>';
  echo '<option value="two_fa_not_feasible">2FA Not Feasible</option>';
  echo '</select>';
  echo '</td>';
  echo '</tr>';

  // Exeception Status
  echo '<tr>';
  echo '<td class="textbox_label_td_l_r">Exeception Status</td>';
  echo '<td>';
  echo '<select name="exception_future_status" class="textbox">';
  echo '<option>Choose a option</option>';
  echo '<option value="two_fa_planned">2FA Planned</option>';
  echo '<option value="two_fa_to_be_planned">2FA To Be Planned</option>';
  echo '<option value="decommed_planned">Decommed Planned</option>';
  echo '<option value="vendor_dependency">Vendor Dependency</option>';
  echo '<option value="business_int_dep">Business / Internal Dependency</option>';
  echo '</select>';
  echo '</td>';
  echo '</tr>';

  echo '<tr><td class="textbox_label_td_l_r">2FA Proposed<br>Date:</td><td><input type="date" id="start" name="two_fa_proposed_date" class="textbox"></td></tr>';
  echo '<tr><td class="textbox_label_td_l_r">Proposal:</td><td><textarea name="proposal" class="textarea"></textarea></td></tr>';


  echo '<tr><td align="center" colspan="10"><input class="button" type="submit" id="getinfo" name="submit" value="ADD" /></td></tr>'; // Data add into the Database
  echo '</table>';
  echo '</form>';
}
?>
