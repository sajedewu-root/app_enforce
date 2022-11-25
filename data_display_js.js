
function enforcement_date_ava(enforce_date_ava){
   if(enforce_date_ava == 'available'){
     document.getElementById('div3').innerHTML = '<td class="textbox_label_td_l_r">Date:</td><td><input type="date" id="start" name="enforcement_date" class="textbox"></td>';
   }
   else
   {
     document.getElementById('div3').innerHTML='';
   }
 }
function expire_date_ava(exp_date_ava){
   if(exp_date_ava == 'available'){
     document.getElementById('div3').innerHTML = '<td class="textbox_label_td_l_r">Date:</td><td><input type="date" id="start" name="exception_expire_date" class="textbox"></td>';
   }
   else
   {
     document.getElementById('div3').innerHTML='';
   }
 }
function present_sub_status_func(name){
   if(name == 'new_in_scope'){
     document.getElementById('div6').innerHTML = '<td class="textbox_label_td_l_r">Present<br>Sub Status:</td><td><select class="textbox" name="present_sub_status"><option value="not_available">Not Available</option><option value="comm_sent">Comms Sent</option></select></td>';
     document.getElementById('hr1').innerHTML = '';
     document.getElementById('auth_title').innerHTML = '';
     document.getElementById('hr2').innerHTML = '';
     document.getElementById('complete_details').innerHTML = '';
     document.getElementById('div1').innerHTML = '';
     document.getElementById('div2').innerHTML = '';
     document.getElementById('div3').innerHTML = '';
     document.getElementById('div4').innerHTML = '';
     document.getElementById('div5').innerHTML = '';
   }
   else if (name == 'enforcement') {
     document.getElementById('div6').innerHTML = '<td class="textbox_label_td_l_r">Present<br>Sub Status:</td><td><select class="textbox" name="present_sub_status" onchange="complete_enforcement(this.options[this.selectedIndex].value)" required><option value="not_available">Not Available</option><option value="comm_sent">Comms Sent</option><option value="rem_in_progress">Remediation In Progress</option><option value="evidence_form_sent">Evidence Form Sent</option><option value="evidence_form_under_review">Evidence Form Under Review</option><option value="under_sustainability_review">Under Sustainability Review</option><option value="re_evidencing_req">Re-Evidencing Required After WMAP Go Live</option><option value="complete">Complete</option></select></td>';
     document.getElementById('hr1').innerHTML = '';
     document.getElementById('auth_title').innerHTML = '';
     document.getElementById('hr2').innerHTML = '';
     document.getElementById('complete_details').innerHTML = '';
     document.getElementById('div1').innerHTML = '';
     document.getElementById('div2').innerHTML = '';
     document.getElementById('div3').innerHTML = '';
     document.getElementById('div4').innerHTML = '';
     document.getElementById('div5').innerHTML = '';

   }
   else if (name == 'exception') {
     document.getElementById('div6').innerHTML = '<td class="textbox_label_td_l_r">Present<br>Sub Status:</td><td><select class="textbox" name="present_sub_status" onchange="complete_exception(this.options[this.selectedIndex].value)" required><option value="not_available">Not Available</option><option value="comm_sent">Comms Sent</option><option value="form_sent">Form Sent</option><option value="form_awaiting_app">Form Awaiting Approvals</option><option value="exception_until_enforcement">Exception Until Enforcement</option><option value="complete">Complete</option></select></td>';
     document.getElementById('hr1').innerHTML = '';
     document.getElementById('auth_title').innerHTML = '';
     document.getElementById('hr2').innerHTML = '';
     document.getElementById('complete_details').innerHTML = '';
     document.getElementById('div1').innerHTML = '';
     document.getElementById('div2').innerHTML = '';
     document.getElementById('div3').innerHTML = '';
     document.getElementById('div4').innerHTML = '';
     document.getElementById('div5').innerHTML = '';
   }
   else if (name == 'out_of_scope') {
     document.getElementById('div6').innerHTML = '<td class="textbox_label_td_l_r">Present<br>Sub Status:</td><td><select class="textbox" name="present_sub_status"><option value="not_available">Not Available</option><option value="comm_sent">Comms Sent</option><option value="sera_change_verified">SERA Change Verified</option><option value="form_sent">Form Sent</option><option value="form_awaiting_app">Form Awaiting Approvals</option><option value="decommission_in_progress">Decommission In Progress</option><option value="complete">Complete</option></select></td>';
     document.getElementById('hr1').innerHTML = '';
     document.getElementById('auth_title').innerHTML = '';
     document.getElementById('hr2').innerHTML = '';
     document.getElementById('complete_details').innerHTML = '';
     document.getElementById('div1').innerHTML = '';
     document.getElementById('div2').innerHTML = '';
     document.getElementById('div3').innerHTML = '';
     document.getElementById('div4').innerHTML = '';
     document.getElementById('div5').innerHTML = '';
   }
   else if (name == 'not_available') {
     document.getElementById('hr1').innerHTML = '';
     document.getElementById('auth_title').innerHTML = '';
     document.getElementById('hr2').innerHTML = '';
     document.getElementById('complete_details').innerHTML = '';
     document.getElementById('div1').innerHTML = '';
     document.getElementById('div2').innerHTML = '';
     document.getElementById('div3').innerHTML = '';
     document.getElementById('div4').innerHTML = '';
     document.getElementById('div5').innerHTML = '';
     document.getElementById('div6').innerHTML = '';

   }
   else {
     document.getElementById('hr1').innerHTML = '';
     document.getElementById('auth_title').innerHTML = '';
     document.getElementById('hr2').innerHTML = '';
     document.getElementById('complete_details').innerHTML = '';
     document.getElementById('div1').innerHTML = '';
     document.getElementById('div2').innerHTML = '';
     document.getElementById('div3').innerHTML = '';
     document.getElementById('div4').innerHTML = '';
     document.getElementById('div5').innerHTML = '';
     document.getElementById('div6').innerHTML = '';
   }

}
// Enforcement Details
function complete_enforcement(enfor_excep_complete){
  if(enfor_excep_complete == 'complete'){
    document.getElementById('hr1').innerHTML = '<td colspan="10"><hr></td>';
    document.getElementById('auth_title').innerHTML = '<td colspan= "10" class="textbox_label_td_l_r">Authentication Status</td>';
    document.getElementById('hr2').innerHTML = '<td colspan="10"><hr></td>';
    document.getElementById('complete_details').innerHTML = '<td class="textbox_label_td_l_r">Overall<br>Status:</td><td><input type="text" name="overall_status" class="textbox" value="Enforcement"></td>';
    document.getElementById('div1').innerHTML = '<td class="textbox_label_td_l_r" >Authentication<br>Solution:</td><td><select type="text" name="enforcement_solution" class="textbox"><option value="not_available">Not Available</option><option value="auth_solution">AAD + MS Authentication</option><option value="azure_ad">Azure AD</option><option value="bespoke">Bespoke</option><option value="bespoke_google_auth">Bespoke + Google Authentication</option><option value="consultworks">Consultworks</option><option value="consultworks_pw">Consultworks + PW Security</option><option value="google_auth">Google Authentication</option><option value="isga">ISGA</option><option value="isga_tbc">ISGA + TBC</option><option value="isso">ISSO</option><option value="isso_bespoke">ISSO / Bespoke</option><option value="isso_ch">ISSO CH</option><option value="isso_fed">ISSO FED</option><option value="isso_global">ISSO GLOBAL</option><option value="ldap_fed">LDAP FED</option><option value="msal">MSAL</option><option value="neo">NEO</option><option value="ols">OLS</option><option value="speed">Speed</option><option value="tbc">TBC</option><option value="wamp">WAMP</option><option value="wamp_pw_isso">WAMP / PW / ISSO</option></select>';
    document.getElementById('div2').innerHTML = '<td class="textbox_label_td_l_r" >Enforcement<br>Date:</td><td><select name="enforcement_date_av" class="textbox" onchange="enforcement_date_ava(this.options[this.selectedIndex].value)" required><option value="not_available">Not Available</option><option value="available">Available</option></select></td>';
  }
  else if(enfor_excep_complete == 'not_available'){
    document.getElementById('hr1').innerHTML = '';
    document.getElementById('auth_title').innerHTML = '';
    document.getElementById('hr2').innerHTML = '';
    document.getElementById('complete_details').innerHTML = '';
    document.getElementById('div1').innerHTML = '';
    document.getElementById('div2').innerHTML = '';
    document.getElementById('div3').innerHTML = '';
  }
  else if(enfor_excep_complete == 'comm_sent'){
    document.getElementById('hr1').innerHTML = '';
    document.getElementById('auth_title').innerHTML = '';
    document.getElementById('hr2').innerHTML = '';
    document.getElementById('complete_details').innerHTML = '';
    document.getElementById('div1').innerHTML = '';
    document.getElementById('div2').innerHTML = '';
    document.getElementById('div3').innerHTML = '';
  }
  else if(enfor_excep_complete == 'rem_in_progress'){
    document.getElementById('hr1').innerHTML = '';
    document.getElementById('auth_title').innerHTML = '';
    document.getElementById('hr2').innerHTML = '';
    document.getElementById('complete_details').innerHTML = '';
    document.getElementById('div1').innerHTML = '';
    document.getElementById('div2').innerHTML = '';
    document.getElementById('div3').innerHTML = '';
  }
  else if(enfor_excep_complete == 'evidence_form_sent'){
    document.getElementById('hr1').innerHTML = '';
    document.getElementById('auth_title').innerHTML = '';
    document.getElementById('hr2').innerHTML = '';
    document.getElementById('complete_details').innerHTML = '';
    document.getElementById('div1').innerHTML = '';
    document.getElementById('div2').innerHTML = '';
    document.getElementById('div3').innerHTML = '';
  }
  else if(enfor_excep_complete == 'evidence_form_under_review'){
    document.getElementById('hr1').innerHTML = '';
    document.getElementById('auth_title').innerHTML = '';
    document.getElementById('hr2').innerHTML = '';
    document.getElementById('complete_details').innerHTML = '';
    document.getElementById('div1').innerHTML = '';
    document.getElementById('div2').innerHTML = '';
    document.getElementById('div3').innerHTML = '';
  }
  else if(enfor_excep_complete == 'under_sustainability_review'){
    document.getElementById('hr1').innerHTML = '';
    document.getElementById('auth_title').innerHTML = '';
    document.getElementById('hr2').innerHTML = '';
    document.getElementById('complete_details').innerHTML = '';
    document.getElementById('div1').innerHTML = '';
    document.getElementById('div2').innerHTML = '';
    document.getElementById('div3').innerHTML = '';
  }
  else if(enfor_excep_complete == 're_evidencing_req'){
    document.getElementById('hr1').innerHTML = '';
    document.getElementById('auth_title').innerHTML = '';
    document.getElementById('hr2').innerHTML = '';
    document.getElementById('complete_details').innerHTML = '';
    document.getElementById('div1').innerHTML = '';
    document.getElementById('div2').innerHTML = '';
    document.getElementById('div3').innerHTML = '';
  }
}
// Exception Details
function complete_exception(enfor_excep_complete){
  if(enfor_excep_complete == 'complete'){
    document.getElementById('hr1').innerHTML = '<td colspan="10"><hr></td>';
    document.getElementById('auth_title').innerHTML = '<td colspan= "10" class="textbox_label_td_l_r">Authentication Status</td>';
    document.getElementById('hr2').innerHTML = '<td colspan="10"><hr></td>';
    document.getElementById('complete_details').innerHTML = '<td class="textbox_label_td_l_r">Overall<br>Status:</td><td><input type="text" name="overall_status" class="textbox" value="Exception"></td>';
    document.getElementById('div1').innerHTML = '<td class="textbox_label_td_l_r" >Exception<br>Catagory:</td><td><select type="text" name="exception_criteria" class="textbox"><option value="not_available">Not Available</option><option value="bus_den">Business Depe</option><option value="ven_den">Vendor Depe</option></select></td>';
    document.getElementById('div2').innerHTML = '<td class="textbox_label_td_l_r" >Exception<br>Expire Date:</td><td><select name="exception_expire_date_av" class="textbox" onchange="expire_date_ava(this.options[this.selectedIndex].value)" required><option value="not_available">Not Available</option><option value="available">Available</option></select></td>';
    document.getElementById('div4').innerHTML = '<td class="textbox_label_td_l_r" >Justtification:</td><td><textarea name="Justtification" class="textarea"></textarea></td>';
    document.getElementById('div5').innerHTML = '<td class="textbox_label_td_l_r" >Risk<br>Statement:</td><td><textarea name="risk_statement" class="textarea"></textarea></td>';
  }
  else if(enfor_excep_complete == 'not_available'){
    document.getElementById('hr1').innerHTML = '';
    document.getElementById('auth_title').innerHTML = '';
    document.getElementById('hr2').innerHTML = '';
    document.getElementById('complete_details').innerHTML = '';
    document.getElementById('div1').innerHTML = '';
    document.getElementById('div2').innerHTML = '';
    document.getElementById('div3').innerHTML = '';
    document.getElementById('div4').innerHTML = '';
    document.getElementById('div5').innerHTML = '';
  }
  else if(enfor_excep_complete == 'comm_sent'){
    document.getElementById('hr1').innerHTML = '';
    document.getElementById('auth_title').innerHTML = '';
    document.getElementById('hr2').innerHTML = '';
    document.getElementById('complete_details').innerHTML = '';
    document.getElementById('div1').innerHTML = '';
    document.getElementById('div2').innerHTML = '';
    document.getElementById('div3').innerHTML = '';
    document.getElementById('div4').innerHTML = '';
    document.getElementById('div5').innerHTML = '';
  }
  else if(enfor_excep_complete == 'form_sent'){
    document.getElementById('hr1').innerHTML = '';
    document.getElementById('auth_title').innerHTML = '';
    document.getElementById('hr2').innerHTML = '';
    document.getElementById('complete_details').innerHTML = '';
    document.getElementById('div1').innerHTML = '';
    document.getElementById('div2').innerHTML = '';
    document.getElementById('div3').innerHTML = '';
    document.getElementById('div4').innerHTML = '';
    document.getElementById('div5').innerHTML = '';
  }
  else if(enfor_excep_complete == 'form_awaiting_app'){
    document.getElementById('hr1').innerHTML = '';
    document.getElementById('auth_title').innerHTML = '';
    document.getElementById('hr2').innerHTML = '';
    document.getElementById('complete_details').innerHTML = '';
    document.getElementById('div1').innerHTML = '';
    document.getElementById('div2').innerHTML = '';
    document.getElementById('div3').innerHTML = '';
    document.getElementById('div4').innerHTML = '';
    document.getElementById('div5').innerHTML = '';
  }
  else if(enfor_excep_complete == 'exception_until_enforcement'){
    document.getElementById('hr1').innerHTML = '';
    document.getElementById('auth_title').innerHTML = '';
    document.getElementById('hr2').innerHTML = '';
    document.getElementById('complete_details').innerHTML = '';
    document.getElementById('div1').innerHTML = '';
    document.getElementById('div2').innerHTML = '';
    document.getElementById('div3').innerHTML = '';
    document.getElementById('div4').innerHTML = '';
    document.getElementById('div5').innerHTML = '';
  }
}
// Brief Comments
function stat_comms(comms){
   if(comms == 'available'){
     document.getElementById('div7').innerHTML = '<td class="textbox_label_td_l_r">Brief:</td><td><textarea name="comms" class="textarea"></textarea></td>';
   }
   else if (comms == 'not_available'){
     document.getElementById('div7').innerHTML = '';
   }
   else{
     document.getElementById('div7').innerHTML= '';
   }
 }
