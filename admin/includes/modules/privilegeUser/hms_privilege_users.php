<?php

$privilegeUserClass = new hmsprivilegeUserClass;

if (not_null ($_GET["parent_id"]) ) {
    if ($_GET["parent_id"] <= 0) {
        $role_master_id='0';
    } else {
        $role_master_id = $_GET["parent_id"];
    }
} else {
    $role_master_id = '0';
}
$user_sql_cond='';
if (not_null ($role_master_id) ) {
    $user_sql_cond = " admin_role_mst_id = '" . $role_master_id . "'";
}

if ($_GET["action"] == "privilege_user_add" || $_GET["action"] == "privilege_user_edit") {
    $privilege_user_add = "privilege_user_insert";
    $privilege_user_edit = "privilege_user_update";
    if ($_GET["action"] == "privilege_user_add") {
        $privilege_user_master_values["admin_role_mst_id"] = $role_master_id;
    } elseif ($_GET["action"] == "privilege_user_edit" ) {
        if (not_null ($_GET["id"])) {
            $privilege_user_master_values = $privilegeUserClass->privilegeUserMasterSql($_GET["id"]);
            $previous_role_id = $privilege_user_master_values["admin_role_mst_id"];
        } else {
            redirect (href_link(FILENAME_HMS_PRIVILEGE_USERS, 'parent_id='.$role_master_id));
        }
    }
    $privilege_user_master_role_arr = $privilegeUserClass->get_privilege_role_tree();
    if ( not_null ( $privilege_user_master_values["active"] ) ) {
        ${$privilege_user_master_values["active"]} = "checked";
    } else {
        $Y = "checked";
    }
    ?><form name="frmPrivilegeUsers" method="POST" enctype="multipart/form-data" >
   
    <input type="hidden" name="action" value="<?php echo ${$_GET["action"]}; ?>"><input type="hidden" name="page" value="<?php echo $_GET["page"]; ?>"><?php

        if ( $_GET["action"] == "privilege_user_edit" ) {
            ?><input type="hidden" name="id" value="<?php echo $privilege_user_master_values["id"]; ?>"><input type="hidden" name="previous_role_id" value="<?php echo $previous_role_id; ?>"><?php
        }?><table border="0" cellspacing="0" cellpadding="2" align="left">
        <tr><td></td></tr>
        <tr><td></td></tr>
        
        <tr>
        <td  colspan="11" ><table border="0" cellspacing="0" cellpadding="0">
			<tr>
			  <td style="padding-left:6px"><img src="images/arrow_heading.gif" /></td>
			  <td align="left" class="heading_light_blue">&nbsp;<?php echo TITLE_MANAGE_HMS_PRIVILEGE_USER;?></td>
			</tr>
		  </table>
          <p>&nbsp;</p></td>
      </tr>
       
		<tr>
         
        
            <td class="tahoma12blacknormal padding_left" width="15%">User's Role:</td>
            <td colspan="4" width="85%" align="left"><?php echo draw_pull_down_menu ('parent_id', $privilege_user_master_role_arr, $privilege_user_master_values["admin_role_mst_id"], 'tabindex="1" class="tahoma12blacknormal padding_left" id="parent_id" title="Select user\'s role" ONCHANGE="update_roles_modules_records(\'ModulesEventsPlace\', this.options[this.selectedIndex].value, \''. (($_GET["action"] == "privilege_user_add")?1:0) .'\', \''.(($_GET["action"] == "privilege_user_edit")?$_GET["id"]:'').'\');"'); ?>&nbsp;<span id="error_parent_id" class="tahoma10rednormal"><?php if (! not_null ($privilege_user_master_values["admin_role_mst_id"]) ) { ?>Required<?php } ?></span></td>
        </tr>
        <tr>
            <td class="tahoma12blacknormal padding_left">User's Name:</td>
            <td colspan="4"><input title="enter username" name="uname" type="text" id="uname" tabindex="2" class="tahoma12blacknormal padding_left" dir="ltr" maxlength="99" size="75" value="<?php print stripslashes($privilege_user_master_values["username"]); ?>" ONCHANGE="validatePresent(this, 'error_uname');">&nbsp;<span id="error_uname" class="tahoma10rednormal"><?php if (! not_null ($privilege_user_master_values["username"]) ) { ?>Required<?php } ?></span></td>
        </tr>
        <tr>
            <td class="tahoma12blacknormal padding_left">Password:</td>
            <td colspan="4"><input title="enter password" name="pword" type="password" id="pword"  class="tahoma12blacknormal padding_left" tabindex="3" dir="ltr" maxlength="99" size="75" value="<?php print stripslashes($privilege_user_master_values["password"]); ?>" ONCHANGE="validatePresent(this, 'error_pword');">&nbsp;<span id="error_pword" class="tahoma10rednormal"><?php if (! not_null ($privilege_user_master_values["password"]) ) { ?>Required<?php } ?></span></td>
        </tr>
        <tr>
            <td class="tahoma12blacknormal padding_left">First Name:</td>
            <td colspan="4"><input title="enter first name" name="fname" type="text" id="fname" tabindex="4" class="tahoma12blacknormal padding_left" dir="ltr" maxlength="99" size="75" value="<?php print stripslashes($privilege_user_master_values["first_name"]); ?>" ONCHANGE="validatePresent(this, 'error_fname');">&nbsp;<span id="error_fname" class="tahoma10rednormal"><?php if (! not_null ($privilege_user_master_values["first_name"]) ) { ?>Required<?php } ?></span></td>
        </tr>
        <tr>
            <td class="tahoma12blacknormal padding_left">Last Name:</td>
            <td colspan="4"><input title="enter last name" name="lname" type="text" id="lname" tabindex="5" class="tahoma12blacknormal padding_left" dir="ltr" maxlength="99" size="75" value="<?php print stripslashes($privilege_user_master_values["last_name"]); ?>" ONCHANGE="validatePresent(this, 'error_lname');">&nbsp;<span id="error_lname" class="tahoma10rednormal"><?php if (! not_null ($privilege_user_master_values["last_name"]) ) { ?>Required<?php } ?></span></td>
        </tr>
        <tr>
            <td class="tahoma12blacknormal padding_left">Email ID:</td>
            <td colspan="4" ><input title="enter email" name="email" type="text" id="email" tabindex="6"  class="tahoma12blacknormal padding_left" dir="ltr" maxlength="99" size="75" value="<?php print stripslashes($privilege_user_master_values["email"]); ?>" ONCHANGE="validatePresent(this, 'error_email');">&nbsp;<span id="error_email" class="tahoma10rednormal"><?php if (! not_null ($privilege_user_master_values["email"]) ) { ?>Required<?php } ?></span></td>
        </tr>
        <tr>
            <td class="tahoma12blacknormal padding_left">Active:</td>
            <td width="3%"><input class="noneborder" name="active" type="radio" title="make active" tabindex="7" value="Y" <?php echo $Y; ?>></td>
            <td width="3%" class="tahoma12blacknormal padding_left">Yes</td>
            <td width="3%"><input class="noneborder" name="active" type="radio" title="make deactive" tabindex="8" value="N" <?php echo $N; ?>></td>
            <td  class="tahoma12blacknormal padding_left">No</td>
        </tr>
        <tr id="Mainlistofrow" class="tahoma12blacknormal padding_left">
            <td class="tahoma12blacknormal padding_left" valign="top">Modules & Events:</td>
            <td colspan="4" id="ModulesEventsPlace" align="left" class="tahoma12blacknormal padding_left"></td>
        </tr>
        <script language="javascript" type="text/javascript">
        <!--//
            update_roles_modules_records('ModulesEventsPlace', document.frmPrivilegeUsers.parent_id.options[document.frmPrivilegeUsers.parent_id.selectedIndex].value, '<?php echo (($_GET["action"] == "privilege_user_add")?1:0); ?>','<?php echo (($_GET["action"] == "privilege_user_edit")?$_GET["id"]:'');  ?>');
        //-->
        </script>
        <tr>
            <td >&nbsp;</td>
            <td colspan="4"><input name="buttonSubmit" type="button" title="Submit" value="Submit" style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;" ONCLICK="return submitfrmPrivilegeUsers(document.frmPrivilegeUsers);">&nbsp;<input name="buttonCancel" style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;" type="button" title="Cancel" value="Cancel" ONCLICK="document.location.href='<?php echo href_link(FILENAME_HMS_PRIVILEGE_USERS, 'parent_id='.$role_master_id. '&page=' . $_GET["page"]); ?>'"></td>
        </tr>
        </table></form><?php
} else {
    ?>
       <form name="frmeventRecords" method="GET">
		 </form>  
    <div id="privilege_users_records"></div>
	<table width="100%" border="0" cellspacing="0" cellpadding="2" align="center">
    <tr>
        <td height="5"></td>
    </tr>
    <tr>
        <td class="tahoma11blacknormal"><img src="images/newfolder.gif" width="16" height="16" align="absbottom" alt="Add User">&nbsp;&nbsp;<a title="add new user" href="<?php echo href_link(FILENAME_HMS_PRIVILEGE_USERS, 'parent_id=' . $role_master_id . '&action=privilege_user_add'); ?>"><b>Add User</b></a></td>
    </tr> 
    </table>
    <script language="javascript" type="text/javascript">
    <!--//
        populate_privilege_users_records('<?php echo $_GET["page"]; ?>', <?php echo $role_master_id; ?>);
    //-->
    </script>
	<?php
}
?>