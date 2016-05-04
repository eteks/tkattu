<?php
$defaultCountry   = 'Select a Country';
$action_pos = (isset($_POST["action"]) && !empty($_POST["action"]) ? $_POST["action"]:"");
$action_get = (isset($_GET["action"]) && !empty($_GET["action"]) ? $_GET["action"]:"");
$action = (isset($action_pos) && !empty($action_pos) ? $action_pos : $action_get);
$page = (isset($_POST["page"]) && !empty($_POST["page"]) ? $_POST["page"] : "");
if (isset($action) && ($action == "table_entry_add" || $action == "table_entry_edit")) {
    $table_entry_add = "table_entry_insert";
    $table_entry_edit = "table_entry_update";
if (isset($action) && $action == "table_entry_edit" ) {
    $table_entry_values = $hms_info_obj->tableEntrySingRec();
   // $table_entry_values = db_fetch_array ($table_entry_result);
}
    if ( !empty( $table_entry_values["active"] ) ) ${$table_entry_values["active"]}= "checked";
    else $Y = "checked";
    $table_type = $hms_info_obj->getTableTypeTree();

?>
<form name="frmStudentUser" method="POST" enctype="multipart/form-data" action="<?php echo href_link(FILENAME_TABLE_ENTRY); ?>">
    <input type="hidden" name="action" value="<?php echo ${$_GET["action"]}; ?>">
   <input type="hidden" name="page" value="<?php echo (isset($page) ? $page : 1); ?>">
    <?php 
    if ( isset($action) && $action =="table_entry_edit" ) {?>
        <input type="hidden" name="id" value="<?php echo (!empty($_GET["id"]) ? $_GET["id"]:""); ?>">
		  
    <?php } ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="2">
         <tr><td></td></tr>
    <tr><td></td></tr>
          <tr>
            <td colspan="6" align="left" style="background-image:url(images/back_header_bg.jpg); background-repeat:repeat-x;">
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                         <td align="left" style="padding-left:6px"><img src="images/arrow_heading.gif" /></td>
                         <td align="left" class="heading_light_blue" valign="top">&nbsp;<?php echo TITLE_MANAGE_TABLE_ENTRY;?></td>
                    </tr>
                </table>            </td>
        </tr>
        <tr>
            <td colspan="2"></td>
        </tr>

        <tr>
            <td width="15%" class="tahoma12blacknormal padding_left">Table Type Name:</td>
            <td width="85%" colspan = "2" class="tahoma12blacknormal padding_left">
                <?php $table_entry_valuess = (!empty($table_entry_values["table_type_id"]) ? $table_entry_values["table_type_id"]:""); 
                      $table_type_id    = (!empty($table_entry_values["table_type_id"]) ? $table_entry_values["table_type_id"]:"");
                      $table_no          = (!empty($table_entry_values["table_no"]) ? $table_entry_values["table_no"]:""); 
                      $numbers_of_chairs    = (!empty($table_entry_values["numbers_of_chairs"]) ? $table_entry_values["numbers_of_chairs"]:"");
            echo draw_pull_down_menu ('table_type', $table_type, $table_type_id, 'tabindex="1" class="normaltext" id="table_type" style="width:175px;" ONCHANGE = "validatePresent(this, \'error_table_type\');"', '',''); ?>&nbsp;<span id="error_table_type" class="tahoma10rednormal"><? if (!empty($table_entry_valuess)) {?>Required<? }?></span>			</td>
        </tr>
        <tr>
            <td width="15%" class="tahoma12blacknormal padding_left">Table No:</td>
            <td width="85%" colspan = "2" class="tahoma12blacknormal padding_left">
             <input name="table_no" type="text"  id="table_no" tabindex="2" dir="ltr" size="30%" value="<?php echo $table_no; ?>" ONCHANGE="validatePresent(this, 'error_table_no');">&nbsp;<span id="error_table_no" class="tahoma10rednormal"><?php if (!empty($table_no) ) { ?>Required<?php } ?>          </td>
        </tr>
        <tr>
            <td width="15%" class="tahoma12blacknormal padding_left">Number Of Chairs:</td>
            <td width="85%" colspan = "2" class="tahoma12blacknormal padding_left">
             <input name="no_of_chairs" type="text"  id="no_of_chairs" tabindex="3" dir="ltr" size="30%" value="<?php echo $numbers_of_chairs; ?>" ONCHANGE="validatePresent(this, 'error_no_of_chairs');">&nbsp;<span id="error_no_of_chairs" class="tahoma10rednormal"><?php if (! empty ($numbers_of_chairs) ) { ?>Required<?php } ?>          </td>
        </tr>
        <tr>
            <td class="tahoma12blacknormal padding_left">Active:</td>
          <td width="85%" colspan = "2"><input name="active" class="noneborder" type="radio" tabindex="4" value="Y" <? echo (!empty($Y) ? $Y:""); ?>>
            <span class="tahoma12blacknormal padding_left">Yes</span>
            <input name="active" class="noneborder" type="radio" tabindex="5" value="N" <? echo (!empty($N) ? $N:""); ?>>
          <span class="tahoma12blacknormal padding_left">No</span></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <input style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;" name="buttonSubmit" type="button" tabindex="6" title="Submit" onClick="submitfrmStudentUser(document.frmStudentUser);" value="Submit" >&nbsp;
                <input class="btn_style1" name="buttonCancel" type="button" tabindex="7" title="Cancel" value="Cancel" ONCLICK="document.location.href='<?php echo href_link(FILENAME_TABLE_ENTRY, 'page=' . $_GET["page"]); ?>'" style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;">			</td>
       </tr>
    </table>
</form>
<?php
} else {
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
 <tr>
  <td bgcolor="#FFFFFF" >
    <div id="hotel_info_records" ></div>
        <table width="100%" border="0" cellspacing="0" cellpadding="2" align="center">
            <tr>
                <td height="5"></td>
            </tr>
            <tr>
                <td class="tahoma11blacknormal" align="left" style="padding-left:8px; padding-bottom:5px"><img src="images/newfolder.gif" width="16" height="16" align="absbottom" alt="Add Event">&nbsp;&nbsp;<a title="Click to add new hms info add" href="<?php echo href_link(FILENAME_TABLE_ENTRY, 'action=table_entry_add'); ?>"><b>Add Table Entry</b></a></td>
            </tr>
        </table>
  </td>
 </tr>
</table>
        <script language="javascript" type="text/javascript">
        <!--//
            populateHotelInfoManageLists('', '', '', '<?=$page?>');
        //-->
    </script>
    <?php
}
?>