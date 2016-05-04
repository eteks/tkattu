<?php

$privilegeEventClass = new privilegeModuleEventsClass;

if ($_GET["action"] == "privilege_module_event_add" || $_GET["action"] == "privilege_module_event_edit") {
    $privilege_module_event_add = "privilege_module_event_insert";
    $privilege_module_event_edit = "privilege_module_event_update";
  
    if ($_GET["action"] == "privilege_module_event_edit" ) {
        if (not_null ($_GET["id"])) {
            /*$admin_event_module_master_sql = "SELECT * FROM " . TABLE_MODULE_EVENT_MASTER . " WHERE id = " . $id ;
            $admin_event_module_master_result = db_query($admin_event_module_master_sql);*/
            $admin_event_module_master_result = $privilegeEventClass->adminEventModuleMasterSql($_GET["id"]);
            $admin_event_module_master_values = db_fetch_array($admin_event_module_master_result);
        } else {
            redirect (href_link(FILENAME_PRIVILEGE_EVENTS, 'event_module_parent_id='.$_GET["event_module_parent_id"]));
        }
    } 

    $selected_event_module_parent_id = isset($admin_event_module_master_values["admin_modules_mst_id"])?$admin_event_module_master_values["admin_modules_mst_id"]:$_GET["event_module_parent_id"];
?>

<form name="frmPrivilegeEventModules" method="POST" enctype="multipart/form-data" action="<?php echo href_link(FILENAME_PRIVILEGE_EVENTS); ?>">
    <input type="hidden" name="action" value="<?php echo ${$_GET["action"]}; ?>">
    <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
		
    <table width="100%" border="0" cellspacing="0" cellpadding="2">
    <tr><td></td></tr>
    <tr><td></td></tr>
		<tr>
                <td align="left" style="padding-left:6px" class="heading_light_blue"><img src="images/arrow_heading.gif" />&nbsp;<?php echo TITLE_MANAGE_PRIVILEGE_EVENTS;?></td>
                <td align="left"></td>
              </tr>
        <tr>
        <tr>
            <td width="20%" class="tahoma12blacknormal padding_left">Module Event's Name:</td>
            <td><?php echo draw_pull_down_menu ('module_event_parent_id', $privilegeEventClass->get_privilege_event_tree(), $selected_event_module_parent_id, 'tabindex="1" class="tahoma12blacknormal padding_left" id="module_event_parent_id" onChange="if(this.value!=0){msg(\'error_eventparent\',\'tahoma10rednormal\',\'\');}else {msg(\'error_eventparent\',\'tahoma10rednormal\',\'Error: Required\');}"') ?>&nbsp;<span id="error_eventparent" class="tahoma10rednormal"><? if (!not_null($selected_event_module_parent_id)) {?>Required <? }?></span></td>
        </tr>
        <tr>
            <td width="20%" class="tahoma12blacknormal padding_left">Event's Name:</td>
            <td><input name="event_name" type="text" id="event_name" class="textbox" tabindex="2" dir="ltr" size="75" value="<?php print stripslashes($admin_event_module_master_values["name"]); ?>" ONCHANGE="validatePresent(this, 'error_eventname');">&nbsp;<span id="error_eventname" class="tahoma10rednormal"><?php if (! not_null ($admin_event_module_master_values["name"]) ) { ?>Required<?php } ?></span></td>
        </tr>
        <tr>
            <td width="20%" class="tahoma12blacknormal padding_left">Short Description:</td>
            <td><textarea name="short_desc" id="short_desc" rows="03" cols="72" tabindex="3" class="textbox"><?php print stripslashes($admin_event_module_master_values["short_descr"])?></textarea></td>
        </tr>
        <tr>
            <td class="tahoma12blacknormal padding_left">File Name:</td>
            <td><input name="event_filename" type="text" class="textbox" id="event_filename" tabindex="4" dir="ltr" size="75" value="<?php print stripslashes($admin_event_module_master_values["filename"]); ?>" ONCHANGE="validatePresent(this, 'error_filename');">&nbsp;<span id="error_filename" class="tahoma10rednormal"><?php if (! not_null ($admin_event_module_master_values["filename"]) ) { ?>Required<?php } ?></span></td>
        </tr>
        <tr>
            <td valign="top" class="tahoma12blacknormal padding_left">Parameters:</td>
            <td><textarea name="event_parameters" id="event_parameters" rows="3" cols="72" tabindex="5" class="textbox"><?php echo stripslashes($admin_event_module_master_values["parameters"]);  ?></textarea></td>
        </tr>	         
        <tr>
            <td>&nbsp;</td>
            <td><input name="buttonSubmit" type="button" tabindex="6" style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;" title="Submit" onClick="submitfrmPrivilegeEventModules(document.frmPrivilegeEventModules);" value="Submit">&nbsp;
            <input name="buttonCancel" type="button" tabindex="7" title="Cancel" style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;" value="Cancel" ONCLICK="document.location.href='<?php echo href_link(FILENAME_PRIVILEGE_EVENTS, 'event_module_parent_id='.$_GET["event_module_parent_id"]); ?>'"></td>
        </tr>
        </table>
</form>
<?php
} else {
?>

    <form name="frmeventRecords" method="GET">
     <table width="100%" border="0" cellspacing="0" cellpadding="2" align="center">
  <tr><td></td></tr>
 <tr><td></td></tr>
 </table>
		<div class="heading_light_blue" style="padding-bottom:4px;padding-left:6px;text-align:left;"><img src="images/arrow_heading.gif" />&nbsp;<?php echo TITLE_MANAGE_PRIVILEGE_EVENTS;?></div>
     <div style="padding-bottom:4px;padding-left:6px;text-align:left;">
        <?php $module_event_parent_id = (isset($_GET["module_event_parent_id"])?$_GET["module_event_parent_id"]:(isset($_GET["event_module_parent_id"])?$_GET["event_module_parent_id"]:0));echo draw_pull_down_menu ('module_event_parent_id', $privilegeEventClass->get_privilege_event_tree(), $_GET["event_module_parent_id"], 'tabindex="1" class="tahoma12blacknormal padding_left"  id="module_event_parent_id"');?>
        <input type="submit" name="modsubmit" value="Submit" style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;">
    </div>
    </form>
    <div id="privilege_events_records"></div>
        <table width="100%" border="0" cellspacing="0" cellpadding="2" align="center">
            <tr>
                <td height="5"></td>
            </tr>
            <tr>
                <td style="padding-bottom:4px;padding-left:6px;text-align:left;"><img src="images/newfolder.gif" width="16" height="16" align="absbottom" alt="Add Event">&nbsp;&nbsp;<a title="add new event" class="tahoma11blacknormal" href="<?php echo href_link(FILENAME_PRIVILEGE_EVENTS, 'action=privilege_module_event_add&event_module_parent_id='.$module_event_parent_id); ?>"><b>Add Events</b></a></td>
            </tr>
        </table>
        <script language="javascript" type="text/javascript">
        <!--//
            populate_privilege_events_records(<? echo $module_event_parent_id;?>);
        //-->
        </script>	
	<?php
}
?>