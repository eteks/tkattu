<?php
$defaultCountry   = 'Select a Country';
$action = $_POST["action"] ? $_POST["action"] : $_GET["action"];
$page = $_POST["page"] ? $_POST["page"] : $_GET["page"];
if ($action == "room_type_add" || $action == "room_type_edit") {
	$room_type_add = "room_type_insert";
	$room_type_edit = "room_type_update";
if ($action == "room_type_edit" ) {
    $room_type_result = $hms_info_obj->roomTypeEntrySingRec();
    $room_type_values = db_fetch_array ($room_type_result);
}
    if ( not_null ( $room_type_values["active"] ) ) ${$room_type_values["active"]}= "checked";
    else $Y = "checked";

    $FacilitiesFetch_result = $hms_info_obj->FacilitiesFetchAllRecords();

?>
<form name="frmStudentUser" method="POST" enctype="multipart/form-data" action="<?php echo href_link(FILENAME_ROOM_TYPE); ?>">
    <input type="hidden" name="action" value="<?php echo ${$_GET["action"]}; ?>">
   <input type="hidden" name="page" value="<?php echo (isset($page) ? $page : 1); ?>">
    <?php 
    if ( $action=="room_type_edit" ) {?>
        <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
    <?php } ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr><td></td></tr>
    <tr><td></td></tr>
	      <tr>
            <td colspan="6" align="left" style="background-image:url(images/back_header_bg.jpg); background-repeat:repeat-x; padding-top:8px; padding-left:0px"><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" style="padding-left:6px"><img src="images/arrow_heading.gif" /></td>
                <td align="left" class="heading_light_blue" valign="top">&nbsp;<?php echo TITLE_MANAGE_ROOM_TYPE_CREATION;?></td>
              </tr>
            </table></td>
        </tr>
        <tr>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td width="13%" class="tahoma12blacknormal padding_left">Room Type:</td>
            <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
             <input name="room_type" type="text"  id="room_type" tabindex="1" dir="ltr" size="60%" value="<?php print stripslashes($room_type_values["room_type_name"]); ?>" ONCHANGE="validatePresent(this, 'error_room_type');">&nbsp;<span id="error_room_type" class="tahoma10rednormal"><?php if (! not_null ($room_type_values["room_type_name"]) ) { ?>Required<?php } ?>
          </td>
        </tr>
        <tr>
            <td width="13%" class="tahoma12blacknormal padding_left" valign="top">Facility:</td>
			<td width="87%" class="tahoma12blacknormal padding_left" colspan="2" >
			<table border="0" cellspacing="0" cellpadding="0">
              
			<?php
				$pieces = explode(",", $room_type_values["facility_id"]);
				$count = 0;
                while ($rowUser = db_fetch_array($FacilitiesFetch_result)) {
            ?> 
               <tr><td class="tahoma12blacknormal padding_left">
                 <input type="Checkbox" name="facilities[]" tabindex="2" id="facilities[]"  value="<?php echo $rowUser["hms_facility_entry_id"];?>" <?php if ($rowUser["hms_facility_entry_id"] = $pieces[$count]) { echo "checked"; } ?>/><?php echo stripslashes($rowUser["hms_facility_entry_name"]);?><br/>
               </td></tr>
			 <?php
				$count++;
             }
              ?> 
              
            </table>
			</td>
        </tr>
        <tr>
            <td width="13%" class="tahoma12blacknormal padding_left">Bed Size:</td>
            <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
             <input name="bed_size" type="text"  id="bed_size" tabindex="3" dir="ltr" size="60%" value="<?php print $room_type_values["bed_size"]; ?>" ONCHANGE="validatePresent(this, 'error_bed_size');">&nbsp;<span id="error_bed_size" class="tahoma10rednormal"><?php if (! not_null ($room_type_values["bed_size"]) ) { ?>Required<?php } ?>
          </td>
        </tr>
        <tr>
            <td width="13%" class="tahoma12blacknormal padding_left">Charge:</td>
            <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
             <input name="charge" type="text"  id="charge" tabindex="4" dir="ltr" size="60%" value="<?php print $room_type_values["charge"]; ?>" ONCHANGE="validatePresent(this, 'error_charge');">&nbsp;<span id="error_charge" class="tahoma10rednormal"><?php if (! not_null ($room_type_values["charge"]) ) { ?>Required<?php } ?>
          </td>
        </tr>
        <tr>
            <td width="13%" class="tahoma12blacknormal padding_left">Note:</td>
            <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
             <input name="room_type_note" type="textarea"  id="room_type_note" tabindex="5" dir="ltr" size="60%" value="<?php print $room_type_values["note"]; ?>" >
          </td>
        </tr>
        <tr>
            <td class="tahoma12blacknormal padding_left">Active:</td>
          <td width="87%" colspan = "2"><input name="active" class="noneborder" type="radio" tabindex="6" value="Y" <? echo $Y ?>>
            <span class="tahoma12blacknormal padding_left">Yes</span>
            <input name="active" class="noneborder" type="radio" tabindex="7" value="N" <? echo $N ?>>
          <span class="tahoma12blacknormal padding_left">No</span></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td >
                <input style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;" name="buttonSubmit" type="button" tabindex="8" title="Submit" onClick="submitfrmStudentUser(document.frmStudentUser);" value="Submit" >&nbsp;
                <input class="btn_style1" name="buttonCancel" type="button" tabindex="9" title="Cancel" value="Cancel" ONCLICK="document.location.href='<?php echo href_link(FILENAME_ROOM_TYPE, 'page=' . $_GET["page"]); ?>'" style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;"></td>
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
                <td class="tahoma11blacknormal" align="left" style="padding-left:8px; padding-bottom:5px"><img src="images/newfolder.gif" width="16" height="16" align="absbottom" alt="Add Event">&nbsp;&nbsp;<a title="Click to add new hms info add" href="<?php echo href_link(FILENAME_ROOM_TYPE, 'action=room_type_add'); ?>"><b>Room Type Creation</b></a></td>
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