<?php
/*
File Name: privelege_modules.php
Puposer: supporting  file for modules mgnt module of privilege management
Created Date: 30/07/2008 (dd/mm/yyyy)
Last Updated Date: 8/7/2008
*/
$privilegeModulesClass = new privilegeModulesClass;
if (not_null($_GET["parent_id"])) {
    if ($_GET["parent_id"] <= 0) {
        $module_parent_id = '0';
    } else {
        $module_parent_id = $_GET["parent_id"];
    }
} else {
    $module_parent_id = '0';
}

$module_sql_cond='';
if (not_null ($module_parent_id) ) {
    $module_sql_cond = " parent_id = '" . $module_parent_id . "'";
}

if ($_GET["action"] == "privilege_module_add" || $_GET["action"] == "privilege_module_edit") {
    $privilege_module_add = "privilege_module_insert";
    $privilege_module_edit = "privilege_module_update";

    $privilege_module_sort_order_arr["0"] = array ("id"=> NULL, "text" => "-");
    if ($_GET["action"] == "privilege_module_add") {
        $privilege_module_master_values["sort_order"] = $privilegeModulesClass->getPrivilegeMaxSortOrder(TABLE_MODULE_MASTER, $module_sql_cond) + 1;
        $privilege_module_master_values["parent_id"] = $module_parent_id;
    } elseif ($_GET["action"] == "privilege_module_edit" ) {
        if (not_null ($_GET["id"])) {
            $privilege_module_master_result = $privilegeModulesClass->privilegeModuleMasterSql($_GET["id"]);
            $privilege_module_master_values = db_fetch_array ( $privilege_module_master_result );
            $previous_sort_order = $privilege_module_master_values["sort_order"];
            $previous_parent_id = $privilege_module_master_values["parent_id"];
        } else {
            redirect (href_link(FILENAME_PRIVILEGE_MODULES, 'parent_id='.$module_parent_id));
        }
    }
    $privilege_module_parent_module_arr = $privilegeModulesClass->getPrivilegeModuleTree (0,'',(($_GET["action"] == "privilege_module_edit")?$_GET["id"]:''));
    if ( not_null ( $privilege_module_master_values["active"] ) ) {
        ${$privilege_module_master_values["active"]} = "checked";
    } else {
        $Y = "checked";

    }

    ?><form name="frmPrivilegeModules" method="POST" enctype="multipart/form-data" action="<?php echo href_link(FILENAME_PRIVILEGE_MODULES); ?>"><input type="hidden" name="action" value="<?php echo ${$_GET["action"]}; ?>"><?php
        if ( $_GET["action"] == "privilege_module_edit" ) {
            ?><input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>"><input type="hidden" name="previous_parent_id" value="<?php echo $_GET["previous_parent_id"]; ?>"><input type="hidden" name="previous_sort_order" value="<?php echo $_GET["previous_sort_order"]; ?>"><?php
        }?><table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr><td></td></tr>
    <tr><td></td></tr>
	<tr>
	  <td style="padding-left:6px"  class="heading_light_blue"><img src="images/arrow_heading.gif" />&nbsp;<?php echo TITLE_MANAGE_PRIVILEGE_MODULES;?></td>
	  <td align="left"></td>
	</tr>
        <tr>
            <td class="tahoma12blacknormal padding_left">Main Module:</td>
            <td colspan="4"><?php echo draw_pull_down_menu ('parent_id', $privilege_module_parent_module_arr, $privilege_module_master_values["parent_id"], 'tabindex="1" class="tahoma12blacknormal padding_left" id="parent_id" title="Select main module" ONCHANGE="update_modules_sortorder_records(this.options[this.selectedIndex].value, ' . $privilege_module_master_values["sort_order"] . ', \''. (($_GET["action"] == "privilege_module_add")?1:0) .'\', \'' . (($_GET["action"] == "privilege_module_edit")?$_GET["previous_parent_id"]:'') . '\');"'); ?></td>
        </tr>
        <tr>
            <td width="20%" class="tahoma12blacknormal padding_left">Module's Name:</td>
            <td colspan="4"><input title="enter name of the module" name="name" type="text" class="tahoma12blacknormal padding_left" id="name" tabindex="2" dir="ltr" size="75" value="<?php print stripslashes($privilege_module_master_values["name"]); ?>" ONCHANGE="validatePresent(this, 'error_name');">&nbsp;<span id="error_name" class="tahoma10rednormal"><?php if (! not_null ($privilege_module_master_values["name"]) ) { ?>Required<?php } ?></span></td>
        </tr>
        <tr>
            <td valign="top" class="tahoma12blacknormal padding_left">Short Description:</td>
            <td colspan="4"><textarea title="enter the description" name="short_descr" rows="3" cols="72" id="short_descr" class="textbox" tabindex="3"><?php echo stripslashes($privilege_module_master_values["short_descr"]);  ?></textarea></td>
        </tr>
        <tr>
            <td width="20%" class="tahoma12blacknormal padding_left">File Name:</td>
            <td colspan="4"><input title="enter filename for that module" name="filename" type="text" id="filename" tabindex="4" class="tahoma12blacknormal padding_left" dir="ltr" size="75" value="<?php print stripslashes($privilege_module_master_values["filename"]); ?>" ONCHANGE="validatePresent(this, 'error_filename');">&nbsp;<span id="error_filename" class="tahoma10rednormal"><?php if (! not_null ($privilege_module_master_values["filename"]) ) { ?>Required<?php } ?></span></td>
        </tr>
        <tr>
            <td valign="top" class="tahoma12blacknormal padding_left">Parameters:</td>
            <td colspan="4"><textarea title="enter the parameters for filename" name="parameters" rows="3" cols="72" class="textbox" id="parameters" tabindex="5"><?php echo stripslashes($privilege_module_master_values["parameters"]);  ?></textarea></td>
        </tr>
        <tr>
            <td class="tahoma12blacknormal padding_left">Sort order:</td>
            <td colspan="4" id="module_sort_order" class="tahoma12blacknormal padding_left"></td>
        </tr>

        <script language="javascript" type="text/javascript">
        <!--//
            update_modules_sortorder_records(<?php echo $module_parent_id;  ?>, <?php echo $privilege_module_master_values["sort_order"]; ?>, '<?php echo (($_GET["action"] == "privilege_module_add")?1:0); ?>','<?php echo (($_GET["action"] == "privilege_module_edit")?$_GET["previous_parent_id"]:''); ?>')
        //-->
        </script>
        <tr> 
          <td width="10%" class="tahoma12blacknormal padding_left">Active: </td>
          <td class="tahoma12blacknormal padding_left" colspan="4"><input name="active" type="radio" tabindex="5" value="Y" <? echo $Y ?>>Yes<input name="active" type="radio" tabindex="6" value="N" <? echo $N ?>>No</td>
        </tr>
        <tr>
            <td width="20%">&nbsp;</td>
            <td colspan="4"><input name="buttonSubmit" type="button" tabindex="9" title="Submit" style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;" onClick="submitfrmPrivilegeModules(document.frmPrivilegeModules);" value="Submit">&nbsp;<input name="buttonSubmit" type="button" tabindex="10" title="Cancel" value="Cancel" style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;" ONCLICK="document.location.href='<?php echo href_link(FILENAME_PRIVILEGE_MODULES, 'parent_id='.$module_parent_id); ?>'"></td>
        </tr>
        </table></form><?php
} else {
    ?><div id="privilege_modules_records"></div><table width="99%" border="0" cellspacing="0" cellpadding="2" align="center">
    <tr>
        <td height="5"></td>
    </tr>
    <tr>
        <td><img src="images/newfolder.gif" width="16" height="16" align="absbottom" alt="Add Module">&nbsp;&nbsp;<a title="add new module" class="tahoma11blacknormal" href="<?php echo href_link(FILENAME_PRIVILEGE_MODULES, 'parent_id=' . $module_parent_id . '&action=privilege_module_add'); ?>"><b>Add Module</b></a></td>
    </tr>
    </table>
    <script language="javascript" type="text/javascript">
    <!--//
        populate_privilege_modules_records(<?php echo $module_parent_id; ?>);
    //-->
    </script><?php
}
?>