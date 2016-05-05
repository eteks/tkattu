<?php
$defaultCountry   = 'Select a Country';
$action = $_POST["action"] ? $_POST["action"] : $_GET["action"];
$page = $_POST["page"] ? $_POST["page"] : $_GET["page"];
if ($action == "tax_scheme_add" || $action == "tax_scheme_edit") {
    $tax_scheme_add  = "tax_scheme_insert";
    $tax_scheme_edit = "tax_scheme_update";
if ($action == "tax_scheme_edit" ) {
    $taxScheme_result = $hms_info_obj->taxSchemeSingRec();
    $taxScheme_values = db_fetch_array ($taxScheme_result);
        $form_date  = explode("-", $taxScheme_values["from_date"]);
		$form_date1 = explode(" ", $form_date[2]);
		$formDate   = $form_date1[0]."-".$form_date[1]."-".$form_date[0];
}
    if ( not_null ( $taxScheme_values["active"] ) ) ${$taxScheme_values["active"]}= "checked";
    else $Y = "checked";
    $taxInfoFetch_result = $hms_info_obj->getTaxInfoFetchAllRecords();
?>
<form name="frmStudentUser" method="POST" enctype="multipart/form-data" action="<?php echo href_link(FILENAME_TAX_SCHEME); ?>">
    <input type="hidden" name="action" value="<?php echo ${$_GET["action"]}; ?>">
   <input type="hidden" name="page" value="<?php echo (isset($page) ? $page : 1); ?>">
    <?php 
    if ( $action =="tax_scheme_edit" ) {?>
        <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
    <?php } ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="2">
    
     <tr><td></td></tr>
    <tr><td></td></tr>
          <tr>
            <td colspan="6" align="left" style="background-image:url(images/back_header_bg.jpg); background-repeat:repeat-x;"><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" style="padding-left:6px"><img src="images/arrow_heading.gif" /></td>
                <td align="left" class="heading_light_blue" valign="top">&nbsp;<?php echo TITLE_MANAGE_TAX_SCHEME;?></td>
              </tr>
            </table></td>
        </tr>
        <tr>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td width="26%" class="tahoma12blacknormal padding_left">Scheme Name:</td>
            <td width="74%" colspan = "2" class="tahoma12blacknormal padding_left">
             <input name="scheme_name" type="text"  id="scheme_name" tabindex="1" dir="ltr" size="60%" value="<?php print stripslashes($taxScheme_values["tax_scheme_name"]); ?>" ONCHANGE="validatePresent(this, 'error_scheme_name');">&nbsp;<span id="error_scheme_name" class="tahoma10rednormal"><?php if (! not_null ($taxScheme_values["tax_scheme_name"]) ) { ?>Required<?php } ?>
          </td>
        </tr>
        <tr>
			<td class="tahoma12blacknormal padding_left">From Date:</td>
			<td colspan="5" class="tahoma12blacknormal padding_left">
				<input name="DateFrom"  type="text" class="normal11" id="DateFrom" size="15" tabindex="2" value="<?=$formDate;?>">
				<img src="js/images/Calendar New.jpg" width="16" height="16" onClick="showCalendarControl(DateFrom)" style="cursor:pointer" />
			</td>
        </tr>
        <?php /*?><tr>
            <td width="26%" class="tahoma12blacknormal padding_left" valign="top">Select taxes under this scheme:</td>
            <td width="74%" class="tahoma12blacknormal padding_left" colspan="2" >
            <table border="0" cellspacing="0" cellpadding="0">
              
            <?php
                $pieces = explode(",", $taxScheme_values["tax_info_id"]);
                $count = 0;
                while ($rowTaxInfo = db_fetch_array($taxInfoFetch_result)) {
            ?>
               <tr><td class="tahoma12blacknormal padding_left">
                 <input type="Checkbox" name="tax_info[]" id="tax_info[]"  tabindex="3" value="<?php echo $rowTaxInfo["tax_info_id"];?>" <?php if ($rowTaxInfo["tax_info_id"] = $pieces[$count]) { echo "checked"; } ?>/>&nbsp;<?php echo stripslashes(ucwords($rowTaxInfo["tax_info_name"]));?><br/>
               </td></tr>
            <?php
                $count++;
             }
            ?> 
              
            </table>
          </td>
        </tr><?php */?>
        <tr>
            <td class="tahoma12blacknormal padding_left">Active:</td>
            <td width="74%" colspan = "2"><input name="active" class="noneborder" type="radio" tabindex="4" value="Y" <? echo $Y ?>>
            <span class="tahoma12blacknormal padding_left">Yes</span>
            <input name="active" class="noneborder" type="radio" tabindex="5" value="N" <? echo $N ?>>
          <span class="tahoma12blacknormal padding_left">No</span></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td >
                <input style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;" name="buttonSubmit" type="button" tabindex="6" title="Submit" onClick="submitfrmStudentUser(document.frmStudentUser);" value="Submit" >&nbsp;
                <input class="btn_style1" name="buttonCancel" type="button" tabindex="7" title="Cancel" value="Cancel" ONCLICK="document.location.href='<?php echo href_link(FILENAME_TAX_SCHEME, 'page=' . $_GET["page"]); ?>'" style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;"></td>
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
                <td class="tahoma11blacknormal" align="left" style="padding-left:8px; padding-bottom:5px"><img src="images/newfolder.gif" width="16" height="16" align="absbottom" alt="Add Event">&nbsp;&nbsp;<a title="Click to add new hms info add" href="<?php echo href_link(FILENAME_TAX_SCHEME, 'action=tax_scheme_add'); ?>"><b>Add Tax Scheme</b></a></td>
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