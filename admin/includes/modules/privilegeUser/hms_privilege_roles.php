<?php

$privilegeRolseClass = new privilegeRolesClass;

if ($_GET["action"] == "privilege_roles_add" || $_GET["action"] == "privilege_roles_edit") {
    $privilege_roles_add = "privilege_roles_insert";
    $privilege_roles_edit = "privilege_roles_update";

    $sort_order_arr = array (
        "0" => array ("id"=> NULL, "text" => "-")
    );
    $adminrole_max_sort_number = $privilegeRolseClass->get_admin_role_master_max_sort_number(0); 
    if ($adminrole_max_sort_number > 0) {
        for ($i = 0; $i < $adminrole_max_sort_number+1; $i++) {
            $j = $i + 1;
            $sort_order_arr [$j] = array("id" => $j, "text" => $j);
        }
    }

    $selected_admin_module_array="";
    $exclude = '';
    if ($_GET["action"] == "privilege_roles_edit" ) {

        if (not_null ($_GET["id"])) {
            $admin_role_master_result = $privilegeRolseClass->adminRoleMasterSql($_GET["id"]);
            $admin_role_master_values = db_fetch_array ($admin_role_master_result);
            $exclude                  = $admin_role_master_values["id"];
            $admin_modules_to_admin_role_mst = $privilegeRolseClass->adminModulesToAdminRoleMstSql($admin_role_master_values['id']);
            if (db_num_rows ($admin_modules_to_admin_role_mst) >0 ) {
                while ($admin_modules_to_admin_role_mst_values = db_fetch_array ($admin_modules_to_admin_role_mst)) {
                    $selected_admin_module_array [$admin_modules_to_admin_role_mst_values["admin_modules_mst_id"]] = $admin_modules_to_admin_role_mst_values["admin_modules_mst_id"];
                }
            }
        } else {
            redirect (href_link(FILENAME_HMS_PRIVILEGE_ROLES, 'parentid='.$_GET["parentid"]));
        }
    }

    if (!not_null ($admin_role_master_values["parent_id"])) {
        $admin_role_master_values["parent_id"] = not_null($parentid)?$parentid:0;
    }
    if (!not_null ($admin_role_master_values["sort_order"])) {
        $admin_role_master_values["sort_order"] = '';
    }
    if (not_null($admin_role_master_values["active"])) {
        ${$admin_role_master_values["active"]} = "Checked";
    } else {
        $Y = "Checked";
    }
    $admin_role_add_edit_user_allow = true;
?>

  <form name="frmPrivilegeAdminRoles" method="POST" enctype="multipart/form-data" action="<?php echo href_link(FILENAME_HMS_PRIVILEGE_ROLES); ?>"> 
   
  
    <input type="hidden" name="action" id="action" value="<?php echo ${$_GET["action"]}; ?>">
    <input type="hidden" name="id" id="edit_id" value="<?php echo $_GET["id"]; ?>">

    <table width="100%" border="0" cellspacing="0" cellpadding="2">
	
	<tr><td></td></tr>
        <tr><td></td></tr>
        
        <tr>
        <td  colspan="11" ><table border="0" cellspacing="0" cellpadding="0">
			<tr>
			  <td style="padding-left:6px"><img src="images/arrow_heading.gif" /></td>
			  <td align="left" class="heading_light_blue">&nbsp;<?php echo TITLE_MANAGE_HMS_PRIVILEGE_ROLES;?></td>
			</tr>
		  </table>
          <p>&nbsp;</p></td>
      </tr>
    <tr>
        <td width="20%" class="tahoma12blacknormal padding_left">Parent Role </td>
        <td colspan="4">
            <?php echo draw_pull_down_menu ('role_parent_id', $privilegeRolseClass->getPrivilegeRoleTree('0', '', $exclude), $admin_role_master_values["parent_id"], 'tabindex="1" class="tahoma12blacknormal padding_left" id="role_parent_id" onChange="populateAdminRoleSortOrderValues(this.value,\'\');"') ?>
            <?php if ($admin_role_master_values["parent_id"]>0 ) { ?>
            <script language="javascript">
                populateAdminRoleSortOrderValues(<? print $admin_role_master_values["parent_id"] .", '".$admin_role_master_values["sort_order"]."'";?>);
            </script>
            <?php }?>
        </td>
    </tr>
    <tr>
        <td width="20%" class="tahoma12blacknormal padding_left">Role Name:</td>
        <td colspan="4"><input name="role_name" type="text" id="role_name" tabindex="2" class="tahoma12blacknormal padding_left" dir="ltr" size="60" value="<? echo stripslashes($admin_role_master_values["name"]); ?>" ONCHANGE="validatePresent(this, 'error_rolename');">&nbsp;<span id="error_rolename" class="tahoma10rednormal"><?php if(!not_null($admin_role_master_values["name"])) { ?>Required<?php } ?></span></td>
    </tr>
    <tr>
        <td width="20%" class="tahoma12blacknormal padding_left">Short Description:</td>
        <td colspan="4"><textarea name="short_desc" id="short_desc" rows="03" class="textbox" class="tahoma12blacknormal padding_left" cols="72" tabindex="3"><?php print stripslashes($admin_role_master_values["short_descr"])?></textarea></td>
    </tr>
    <tr>
        <td class="tahoma12blacknormal padding_left">Sort order:</td>
        <td colspan="4"><?php echo draw_pull_down_menu('sort_order', $sort_order_arr, $admin_role_master_values["sort_order"], 'tabindex="4" class="tahoma12blacknormal padding_left" id="role_sort_order"') ?></td>
    </tr>
    <tr>
        <td width="10%" class="tahoma12blacknormal padding_left">Active:</td>
        <td width="3%"><input name="active" class="noneborder" type="radio" tabindex="5" value="Y" <? echo $Y ; ?>></td>
        <td width="4%" class="tahoma12blacknormal padding_left">Yes</td>
        <td width="3%"><input name="active" class="noneborder" type="radio" tabindex="6" value="N" <? echo $N;?>></td>
        <td class="tahoma12blacknormal padding_left">No</td>
    </tr>
    <tr>
        <td class="tahoma12blacknormal padding_left" valign="top">Module Name</td>
        <td colspan="4" class="tahoma12blacknormal padding_left"><?php $privilegeRolseClass->get_parent_module_checkboxes('0', $selected_admin_module_array);?></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td colspan="4"><?php if ($admin_role_add_edit_user_allow) { ?><input name="buttonSubmit" style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;" type="button" tabindex="6" title="Submit" onClick="submitfrmPrivilegeAdminRoles(document.frmPrivilegeAdminRoles);" value="Submit">&nbsp;<?php } ?>
            <input name="buttonCancel" type="button" tabindex="7" title="Cancel" value="Cancel" style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;" ONCLICK="document.location.href='<?php echo href_link(FILENAME_HMS_PRIVILEGE_ROLES, 'parentid='.$_GET["parentid"]); ?>'"></td>
    </tr>
 </table>
 </form>
<?php
} else {
    $privilege_role_add_user_allow = true;
    $parentid = not_null($_GET["parentid"])?$_GET["parentid"]:0;
?>    
      <form name="frmeventRecords" method="GET">
		</form>  
    <div id="privilege_roles_records"><?php print $role_parent_id;?></div>
    <table width="100%" border="0" cellspacing="0" cellpadding="2" align="center">
        <tr>
            <td height="5"></td>
        </tr>
        <?php
            if ($privilege_role_add_user_allow) {
        ?>
        <tr>
            <td><img src="images/newfolder.gif" width="16" height="16"  align="absbottom" alt="Add Role">&nbsp;&nbsp;<a class="tahoma12blacknormal" title="add new module" href="<?php echo href_link(FILENAME_HMS_PRIVILEGE_ROLES, 'action=privilege_roles_add&parentid='.$parentid.''); ?>"><b>Add Roles</b></a></td>
        </tr>
        <?php
            }
        ?>
    </table>
    <script language="javascript" type="text/javascript">
        populate_privilege_roles_records(<?php print $parentid;?>);
    </script>
    <?php
}

?>