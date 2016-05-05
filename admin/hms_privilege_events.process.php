<?php
require_once ("includes/application_top.php");
checklogin();

$privilegeEventClass = new privilegeModuleEventsClass;


$modules_event_master = $privilegeEventClass->modulesEventMasterSql($_GET["event_module_parent_id"]);
if (db_num_rows($modules_event_master)) {
    ?>
    <form name="frmPrivilegeEventModules" method="POST" action="<?php echo href_link(FILENAME_HMS_PRIVILEGE_EVENTS,'event_module_parent_id='.$_GET["event_module_parent_id"]);?>">
    <input type="hidden" name="action">
    <input type="hidden" name="id">
    <input type="hidden" name="parent_moduleid">

    <table width="100%" border="0" cellspacing="0" cellpadding="2" align="center" class="ntab">

       <tr>
        <td  colspan="11" ><table border="0" cellspacing="0" cellpadding="0">
			<tr>
			  <td style="padding-left:6px"><img src="images/arrow_heading.gif" /></td>
			  <td align="left" class="heading_light_blue">&nbsp;<?php echo TITLE_MANAGE_HMS_PRIVILEGE_EVENTS;?></td>
			</tr>
		  </table>
          <p>&nbsp;</p></td>
      </tr>
       <tr>
          <th width="25%" align="leftr" style="padding-left:50px;" >Event Name</th>
          <th width="15%" align="center">Filename</th>
          <th width="25%" align="center">Parameters</th>
          <th width="10%" style="text-align:center" colspan="2" align="center" >Action</th>
          <th width="5%" style="text-align:center">&nbsp;</th>
      </tr>
        <?php
               $modules_event_master_counter = 1;

               while ($modules_event_master_values = db_fetch_array($modules_event_master)) {
                     $bgcolor = (($modules_event_master_counter % 2 == 0) ? FIRSTROWCOLOR : SECONDROWCOLOR);
        ?>
      <tr>
          <td align="left" style="padding-left:50px;" class="tahoma11blacknormal" bgcolor="<? echo $bgcolor ?>"><?php echo $modules_event_master_values["name"]; ?></td>
          <td align="center" class="tahoma11blacknormal" bgcolor="<? echo $bgcolor ?>"><?php echo $modules_event_master_values["filename"]; ?></td>
          <td align="center" class="tahoma11blacknormal" bgcolor="<? echo $bgcolor ?>"><?php echo $modules_event_master_values["parameters"]; ?></td>
          <td width="3%" align="center" class="tahoma11blacknormal" bgcolor="<? echo $bgcolor ?>"><a title="To edit current record" href="<?php echo href_link(FILENAME_HMS_PRIVILEGE_EVENTS, 'id=' . $modules_event_master_values["id"] .'&event_module_parent_id='.$event_module_parent_id.'&action=privilege_module_event_edit'); ?>"><img src="images/edit.gif" width="15" height="15" alt="Edit" border="0"></a></td>
          <td width="3%" align="center" class="tahoma11blacknormal" bgcolor="<? echo $bgcolor ?>"><a title="To delete current record" href="javascript:deleteAdminModuleEventsMasterRecords(document.frmPrivilegeEventModules, 'privilege_module_event_delete', '<?php echo $modules_event_master_values["id"];?>', '<?php echo $modules_event_master_values["admin_modules_mst_id"];?>')"><img src="images/delete.gif" width="15" height="15" alt="Delete" border="0"></a></td>
          <td align="center" class="tahoma11blacknormal" bgcolor="<? echo $bgcolor ?>">&nbsp;</td>
      </tr>
        <?php
            $modules_event_master_counter++;
        }
        ?>
      <tr><td class="titlerow" colspan="6">&nbsp;</td></tr>
    </table>
  </form>
<?php
} else {
    print "<center><span  style='color:#000000;'><b>NO EVENTS FOUND</b></span></center>";
}
?>
<? require_once('mysql_close.php');?>