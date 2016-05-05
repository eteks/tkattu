<?php

$defaultCountry   = 'Select a Country';
$action = $_POST["action"] ? $_POST["action"] : $_GET["action"];
$page = $_POST["page"] ? $_POST["page"] : $_GET["page"];

if ($action == "menu_card_add" || $action == "menu_card_edit") {
    $menu_card_add = "menu_card_insert";
    $menu_card_edit = "menu_card_update";
if ($action == "menu_card_edit" ) {
  $menu_category_sql = $hms_info_obj->MenuCategoryAllRec();
  // print_r($menu_category_sql);
  // $menu_card_values = $hms_info_obj->menuEntrySingRec();
} else {
	$menu_category_sql = $hms_info_obj->MenuCategoryAllRec();
}

  //$get_menu_category = $hms_info_obj->getMenucategoryTree();
?>

<form name="frmStudentUser" method="POST" enctype="multipart/form-data" action="<?php echo href_link(FILENAME_MENU_CARD); ?>">
    <input type="hidden" name="action" value="<?php echo ${$_GET["action"]}; ?>">
   <input type="hidden" name="page" value="<?php echo (isset($page) ? $page : 1); ?>">
    <?php 
    if ( $action =="menu_card_edit" ) {?>
        <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
    <?php } ?>
<table width="100%" border="0" cellspacing="0" cellpadding="2" align="center" bgcolor="#FFFFFF">
 <tr><td></td></tr>
    <tr><td></td></tr>
      <tr>
        <td colspan="6" ><table border="0" cellspacing="0" cellpadding="0" width="95%">
			<tr>
				<td style="padding-left:6px" class="heading_light_blue"><img src="images/arrow_heading.gif" />&nbsp;<?php echo TITLE_MANAGE_MENU_CARD_CREATION;?></td>
				 <td class="tahoma11blacknormal" align="left" >
				&nbsp;&nbsp;
				 <b><div id="msgbox"style="font-family:'Adobe Caslon Pro'; font-size:16px; color:#FF0000;" > </div> </td></b></td>
				<td align="left"></td>
			</tr>
		</table></td>
      </tr>
      <tr>
        <td colspan="6" height="18"></td>
      </tr>
      <tr>
         <td colspan="4" >
			<table width="89%" border="0" cellspacing="0" cellpadding="5" class="ntab" align="center">
			
			<tr>
				
				<th width="5%" style="text-align:center" >S.No.</th>
                                <th style="text-align:center" class="tahoma12whitebold">Item Code</th>
				<th style="text-align:center" class="tahoma12whitebold">Menu Name</th>	
                                <th width="14%" style="text-align:center" >Price</th>
				<th width="14%" style="text-align:center" >Available Status</th>
			</tr>
	
	<?php
        $hms_info_counter = 1;
        $hms_info_sql           = $hms_info_obj->menuEntryAllRecords();
        while ($hms_info_values = db_fetch_array($hms_info_sql)) {

	$bgcolor = "#CCCCCC";
        ?>
                        
    <tr>
	
        <td style="text-align:center" width="5%" class="tahoma11blacknormal" tabindex="2" bgcolor="<? echo $bgcolor ?>" >
        <? echo $hms_info_counter; ?></td>
 <td width="10%" style="text-align:center" bgcolor="<? echo $bgcolor ?>">
	<? echo ucwords(stripslashes($hms_info_values["item_code"]));?>
        <td width = "29%" style="text-align:center" class="tahoma11blacknormal" tabindex="3" bgcolor="<?php echo $bgcolor; ?>"><? echo ucwords(stripslashes($hms_info_values["menu_name"]));?></td>

        <td width="14%" style="text-align:center" bgcolor="<? echo $bgcolor ?>">
	<? echo ucwords(stripslashes($hms_info_values["menu_price"]));?>
	</td>
                
	<td width="14%" style="text-align:center" bgcolor="<? echo $bgcolor ?>">
        <input type="checkbox" class="noneborder"   onclick="statusupdate(this.value)" 
        <?php if($hms_info_values["Item_available_status"]==1){ ?>checked="checked" <?php } ?> 
        value="<? print $hms_info_values["menu_id"]; ?>"   >
	</td>	
			
    </tr>
    <?php
          $hms_info_counter++;
        }
    ?>
    <tr style="display:none;">
      <td colspan="6" bgcolor="<? echo $bgcolor ?>" style="text-align:center">
<input style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;" name="buttonSubmit" type="button" tabindex="9" title="Submit" onClick="updatestatus();" value="Save" >&nbsp;

<input class="btn_style1" name="buttonCancel" type="button" tabindex="10" title="Cancel" value="Cancel" ONCLICK="document.location.href='<?php echo href_link(FILENAME_MENU_CARD, 'page=' . $_GET["page"]); ?>'" style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;">
	  </td>
    </tr>
    </table></td></tr>
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
                <td height="20"></td>
            </tr>
            <tr>
                <td class="tahoma11blacknormal" align="left" style="padding-left:8px; padding-bottom:5px"><img src="images/newfolder.gif" width="16" height="16" align="absbottom" alt="Add Event">&nbsp;&nbsp;<a title="Click to add new hms info add" href="<?php echo href_link(FILENAME_MENU_CARD, 'action=menu_card_add'); ?>"><b>Add Menu Card Menu Selection</b></a></td>
				 
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