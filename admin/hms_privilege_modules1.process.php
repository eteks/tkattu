<?php

require_once ("includes/application_top.php");
checklogin();


$privilegeModulesClass = new privilegeModulesClass;

if (not_null($_GET["parent_id"])) {
    $module_parent_id = $_GET["parent_id"];
} else {
    $module_parent_id = 0;
}

$module_sql_cond = " parent_id = '" . $module_parent_id . "'";

switch($_GET["action"]) {
    case "update_module_sortorder_combo":
        $tmp_max_sort_order = (($_GET["addflag"]=='1')?$privilegeModulesClass->getPrivilegeMaxSortOrder(TABLE_HMS_MODULE_MASTER, $module_sql_cond):((not_null($_GET["previous_parent_id"]) && $_GET["previous_parent_id"] != $module_parent_id )?$privilegeModulesClass->getPrivilegeMaxSortOrder(TABLE_HMS_MODULE_MASTER, $module_sql_cond) :$privilegeModulesClass->getPrivilegeMaxSortOrder(TABLE_HMS_MODULE_MASTER, $module_sql_cond)));
        $privilege_module_sort_order_arr["0"] = array ("id"=> NULL, "text" => "-");
        for ($i=1; $i<=$tmp_max_sort_order+1; $i++) {
            $privilege_module_sort_order_arr[$i] = array("id"=> $i, "text" => $i);
        }
        $id = (($_GET["addflag"]=='1')?'':((not_null($_GET["previous_parent_id"]) && $_GET["previous_parent_id"] != $module_parent_id)?'':$_GET["id"]));
        echo draw_pull_down_menu ('sort_order', $privilege_module_sort_order_arr, $id, 'tabindex="6" id="sort_order" class="normaltext"  title="Select sort order"');
        exit;
        break;
    case "privilege_module_update_active":
        $privilegeModulesClass->privilegeModuleUpdateActive($_GET["value"], $_GET["id"]);
        break;
    case "privilege_module_update_sort_order":
        $privilegeModulesClass->privilegeModuleUpdateSortOrder($_GET["id"], $_GET["value"]);
        break;
}

    $modules_master = $privilegeModulesClass->modulesMasterSql($module_sql_cond);

if ( db_num_rows ( $modules_master) ) {
    ?>
    <form name="frmPrivilegeModules" method="POST" action="<?php echo href_link(FILENAME_HMS_PRIVILEGE_USERS,'parent_id='.$module_parent_id); ?>"> <div class="heading_light_blue" style="padding-bottom:4px;padding-left:6px;text-align:left;"><img src="images/arrow_heading.gif" />&nbsp;<?php echo TITLE_MANAGE_HMS_PRIVILEGE_USER;?></div>
	<input type="hidden" name="action"><input type="hidden" name="id">
    <table width="99%" border="0" cellspacing="0" cellpadding="2" align="center">
	
	
    </table><?php
    if ($module_parent_id > 0) {
    ?>
    <table width="99%" border="0" cellspacing="0" cellpadding="2" align="center">

    <tr>
        <td class="normaltext" style="text-align:right;">
        <?php
         $module_navigator_str= $privilegeModulesClass->privilegeModuleNavigator($module_parent_id);
         if (not_null($module_navigator_str)) echo  $module_navigator_str;
       ?>
       </td>
    </tr>
    </table>
    <?php
    }
    ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="2" align="center" class="ntab">

    <tr>
        <th style="padding-left:10px;" >Module Name</th>
        <th align="left">Filename</th>
        <th align="center">Parameters</th>
        <th align="center">Created Date</th>
        <th align="center">Last Modified Date</th>
        <th style="text-align:center">Active</th>
        <th style="text-align:center">Move</th>
        <th style="text-align:center" colspan="3">Action</th>
    </tr>
    <?php

    $modules_master_counter = 1;
    while ( $modules_master_values = db_fetch_array( $modules_master) ) {
        $bgcolor = (($modules_master_counter % 2 == 0) ? FIRSTROWCOLOR : SECONDROWCOLOR);
    ?>
    <tr class="<?php echo $bgcolor;?>">
       <td style="padding-left:10px;" class="tahoma11blacknormal" bgcolor="<? echo $bgcolor ?>"><?php echo stripslashes($modules_master_values["name"]); ?></td>
       <td align="left" class="tahoma11blacknormal" bgcolor="<? echo $bgcolor ?>"><?php echo stripslashes($modules_master_values["filename"]); ?></td>
       <td align="left" class="tahoma11blacknormal" bgcolor="<? echo $bgcolor ?>"><?php echo stripslashes($modules_master_values["parameters"]); ?></td>
       <td align="left" class="tahoma11blacknormal" bgcolor="<? echo $bgcolor ?>"><?php echo date_long( $modules_master_values["date_added"] ); ?></td>
       <td align="left" class="tahoma11blacknormal" bgcolor="<? echo $bgcolor ?>"><?php echo date_long( $modules_master_values["date_modified"] ); ?></td>
       <td style="text-align:center" class="tahoma11blacknormal" bgcolor="<? echo $bgcolor ?>"><a title="<?php echo ( ($modules_master_values["active"] == "Y") ? "deactivate" : "activate" ); ?> the module" href="javascript:populate_privilege_modules_records('<?php echo $module_parent_id; ?>', '<?php echo $modules_master_values["id"]; ?>','privilege_module_update_active', '<?php echo (($modules_master_values["active"] == "Y") ? "N" : "Y"); ?>');"><img src="images/<?php echo $modules_master_values["active"]; ?>.gif" width="16" height="16" border="0"></a></td>
       <td style="text-align:center" class="tahoma11blacknormal" bgcolor="<? echo $bgcolor ?>"><?php echo ((db_num_rows ( $modules_master ) > 1) ? (($modules_master_counter == 1) ?'<a title = "move down" href="javascript:populate_privilege_modules_records (\'' . $module_parent_id . '\', \'' .  $modules_master_values["id"] . '\', \'privilege_module_update_sort_order\', \'d\');"><img src="images/arrow-d.gif" width="16" height="16" border="0"></a>':(($modules_master_counter == db_num_rows ( $modules_master )) ?'<a title = "move up" href="javascript:populate_privilege_modules_records (\'' . $module_parent_id . '\', \'' .  $modules_master_values["id"] . '\', \'privilege_module_update_sort_order\', \'u\');"><img src="images/arrow-u.gif" width="16" height="16" border="0"></a>':'<a title = "move up" href="javascript:populate_privilege_modules_records (\'' . $module_parent_id . '\', \'' .  $modules_master_values["id"] . '\', \'privilege_module_update_sort_order\', \'u\');"><img src="images/arrow-u.gif" width="16" height="16" border="0"></a>&nbsp;<a title = "move down" href="javascript:populate_privilege_modules_records (\'' . $module_parent_id . '\', \'' .  $modules_master_values["id"] . '\', \'privilege_module_update_sort_order\', \'d\');"><img src="images/arrow-d.gif" width="16" height="16" border="0"></a>')):"&nbsp;"); ?></td>
       <td style="text-align:center" class="tahoma11blacknormal" bgcolor="<? echo $bgcolor ?>">
       <?php
            $modules_childs = $privilegeModulesClass->noOfChildOf($modules_master_values["id"], TABLE_HMS_MODULE_MASTER);
            if ($modules_childs>0) {
                ?><a title="view submodules" href="<?php echo href_link(FILENAME_HMS_PRIVILEGE_MODULES,'parent_id='.$modules_master_values["id"]); ?>"><?php
            }?><img src="images/<?php echo (($modules_childs>0)?'cam.gif':'nocam.gif') ?>" width="15" height="15" alt="View" border="0"><?php

            if($modules_childs>0) {
                ?></a><?php
            }?>
        </td>
        <td style="text-align:center" class="tahoma11blacknormal" bgcolor="<? echo $bgcolor ?>"> <a title="edit module" href="<?php echo href_link(FILENAME_HMS_PRIVILEGE_USERS, 'parent_id=' . $module_parent_id . '&id=' . $modules_master_values["id"] . '&action=privilege_module_edit'); ?>"><img src="images/edit.gif" width="15" height="15" alt="Edit" border="0"></a></td>
        <td style="text-align:center" class="tahoma11blacknormal" bgcolor="<? echo $bgcolor ?>"><a title="delete module" href="javascript:deletePrivilegeModuleRecords(document.frmPrivilegeModules, 'privilege_module_delete', '<?php echo $modules_master_values["id"]; ?>');"><img src="images/delete.gif" width="15" height="15" alt="Delete" border="0"></a></td>
    </tr>
    <?php
        $modules_master_counter++;
    }
    ?>
    </table></form><?php
} else {
    print "<center><span style='color:#000000;'><b>NO MODULES FOUND</b></span></center>";
}
?>
<? require_once('mysql_close.php');?>