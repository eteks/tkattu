<?php
//$defaultCountry   = 'Select a Country';
$action = $_POST["action"] ? $_POST["action"] : $_GET["action"];
$page = $_POST["page"] ? $_POST["page"] : $_GET["page"];
if ($action == "room_add" || $action == "room_edit") {
	$room_add = "room_insert";
	$room_edit = "room_update";
if ($action == "room_edit" ) {
    $room_type_result = $hms_info_obj->roomEntrySingRec();
    $room_type_values = db_fetch_array ($room_type_result);
}
    if ( not_null ( $room_type_values["active"] ) ) ${$room_type_values["active"]}= "checked";
    else $Y = "checked";

    if ( not_null ( $room_type_values["smoking"] ) ) ${$room_type_values["smoking"]}= "checked";
    else $SY = "checked";

    //$FacilitiesFetch_result = $hms_info_obj->FacilitiesFetchAllRecords();

    $Floor    = $hms_info_obj->getFloorTree();
    $RoomType = $hms_info_obj->getRoomTypeTree();



?>
<form name="frmStudentUser" method="POST" enctype="multipart/form-data" action="<?php echo href_link(FILENAME_ROOM); ?>">
    <input type="hidden" name="action" value="<?php echo ${$_GET["action"]}; ?>">
   <input type="hidden" name="page" value="<?php echo (isset($page) ? $page : 1); ?>">
    <?php 
    if ( $action=="room_edit" ) {?>
        <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
    <?php } ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="2">
    
         <tr><td></td></tr>
    <tr><td></td></tr>
	      <tr>
            <td colspan="6" align="left" style="background-image:url(images/back_header_bg.jpg); background-repeat:repeat-x;"><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" style="padding-left:6px"><img src="images/arrow_heading.gif" /></td>
                <td align="left" class="heading_light_blue" valign="top">&nbsp;<?php echo TITLE_MANAGE_ROOM;?></td>
              </tr>
            </table></td>
        </tr>
        <tr>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td width="13%" class="tahoma12blacknormal padding_left">Room No:</td>
            <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
             <input name="room_no" type="text"  id="room_no" tabindex="1" dir="ltr" size="10%" value="<?php print stripslashes($room_type_values["room_no"]); ?>" ONCHANGE="validatePresent(this, 'error_room_no');">&nbsp;<span id="error_room_no" class="tahoma10rednormal"><?php if (! not_null ($room_type_values["room_no"]) ) { ?>Required<?php } ?>
          </td>
        </tr>
        <tr>
            <td width="13%" class="tahoma12blacknormal padding_left">Floor:</td>
            <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
             <?php echo draw_pull_down_menu ('floor', $Floor, $room_type_values["floor"], 'tabindex="2" class="normaltext" id="floor" style="width:175px;" ONCHANGE = "validatePresent(this, \'error_floor\');"', '',''); ?>&nbsp;<span id="error_floor" class="tahoma10rednormal"><? if (!not_null($table_entry_values["floor"])) {?>Required<? }?></span>
          </td>
        </tr>
        <tr>
            <td width="13%" class="tahoma12blacknormal padding_left">Room Type:</td>
            <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
             <?php echo draw_pull_down_menu ('room_type', $RoomType, $room_type_values["room_type"], 'tabindex="3" class="normaltext" id="room_type" style="width:175px;" ONCHANGE = "validatePresent(this, \'error_room_type\');"', '',''); ?>&nbsp;<span id="error_room_type" class="tahoma10rednormal"><? if (!not_null($table_entry_values["room_type"])) {?>Required<? }?></span>
          </td>
        </tr>
        <tr>
            <td width="13%" class="tahoma12blacknormal padding_left">Adults:</td>
            <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
             <input name="adults" type="text"  id="adults" tabindex="4" dir="ltr" size="10%" value="<?php print $room_type_values["adults"]; ?>" ONCHANGE="validatePresent(this, 'error_adults');">&nbsp;<span id="error_adults" class="tahoma10rednormal"><?php if (! not_null ($room_type_values["adults"]) ) { ?>Required<?php } ?>
          </td>
        </tr>
        <tr>
            <td width="13%" class="tahoma12blacknormal padding_left">Child:</td>
            <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
             <input name="child" type="text"  id="child" tabindex="5" dir="ltr" size="10%" value="<?php print stripslashes($room_type_values["child"]); ?>" ONCHANGE="validatePresent(this, 'error_child');">&nbsp;<span id="error_child" class="tahoma10rednormal"><?php if (! not_null ($room_type_values["child"]) ) { ?>Required<?php } ?>
          </td>
        </tr>
        <tr>
            <td class="tahoma12blacknormal padding_left">Smoking:</td>
          <td width="87%" colspan = "2"><input name="smoking" class="noneborder" type="radio" tabindex="6" value="SY" <? echo $SY ?>>
            <span class="tahoma12blacknormal padding_left">Yes</span>
            <input name="smoking" class="noneborder" type="radio" tabindex="6" value="SN" <? echo $SN ?>>
          <span class="tahoma12blacknormal padding_left">No</span></td>
        </tr>
        <tr>
            <td class="tahoma12blacknormal padding_left">Active:</td>
          <td width="87%" colspan = "2"><input name="active" class="noneborder" type="radio" tabindex="7" value="Y" <? echo $Y ?>>
            <span class="tahoma12blacknormal padding_left">Yes</span>
            <input name="active" class="noneborder" type="radio" tabindex="6" value="N" <? echo $N ?>>
          <span class="tahoma12blacknormal padding_left">No</span></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td >
                <input style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;" name="buttonSubmit" type="button" tabindex="8" title="Submit" onClick="submitfrmStudentUser(document.frmStudentUser);" value="Submit" >&nbsp;
                <input class="btn_style1" name="buttonCancel" type="button" tabindex="9" title="Cancel" value="Cancel" ONCLICK="document.location.href='<?php echo href_link(FILENAME_ROOM, 'page=' . $_GET["page"]); ?>'" style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;"></td>
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
                <td class="tahoma11blacknormal" align="left" style="padding-left:8px; padding-bottom:5px"><img src="images/newfolder.gif" width="16" height="16" align="absbottom" alt="Add Event">&nbsp;&nbsp;<a title="Click to add new hms info add" href="<?php echo href_link(FILENAME_ROOM, 'action=room_add'); ?>"><b>Add Room Entry </b></a></td>
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