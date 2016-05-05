<?php
$defaultCountry   = 'Select a Country';
$action = $_POST["action"] ? $_POST["action"] : $_GET["action"];
$page = $_POST["page"] ? $_POST["page"] : $_GET["page"];
if ($action == "tax_add" || $action == "tax_edit") {
	$tax_add = "tax_insert";
	$tax_edit = "tax_update";
if ($action == "tax_edit" ) {
    $student_user_result = $hms_info_obj->taxSingRec();
    $student_user_values = db_fetch_array ($student_user_result);
}
    if ( not_null ( $student_user_values["active"] ) ) ${$student_user_values["active"]}= "checked";
    else $Y = "checked";

?>
<form name="frmStudentUser" method="POST" enctype="multipart/form-data" action="<?php echo href_link(FILENAME_TAX_INFO); ?>">
    <input type="hidden" name="action" value="<?php echo ${$_GET["action"]}; ?>">
   <input type="hidden" name="page" value="<?php echo (isset($page) ? $page : 1); ?>">
    <?php 
    if ( $action =="tax_edit" ) {?>
        <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
    <?php } ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr><td></td></tr>
    <tr><td></td></tr>
	      <tr>
            <td colspan="6" align="left" style="background-image:url(images/back_header_bg.jpg); background-repeat:repeat-x;"><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" style="padding-left:6px"><img src="images/arrow_heading.gif" /></td>
                <td align="left" class="heading_light_blue" valign="top">&nbsp;<?php echo TITLE_MANAGE_TAX_INFO;?></td>
              </tr>
            </table></td>
        </tr>
        <tr>
            <td colspan="2"></td>
        </tr>
		<?php /*?> <tr>
            <td width="13%" class="tahoma12blacknormal padding_left">Select Tax Category:</td>
           <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
     
	 <select name="tax_category" style="width:250px;"  >
	<option value="">--Select--</option>
		<?php  
		$sql="SELECT * FROM  ".TABLE_HMS_TAX_SCHEME."";
		$hms_tax= db_query($sql);
		while($row_result=db_fetch_array($hms_tax))
	{
		?>		
		<option <?php if($row_sel_cat['tax_scheme_name']==$row_registerd_by['tax_info_id']){?> selected="selected" <?php } ?> value="<?php  echo $row_result['tax_scheme_id']; ?>"> <?php echo $row_result['tax_scheme_name'];  ?></option>
				<?php } ?>
			</select>	
				
            </td>
        </tr><?php */?>
        <tr>
            <td width="13%" class="tahoma12blacknormal padding_left"> Tax Name:</td>
            <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
				<input name="tax_info_name" type="text"  id="tax_info_name" tabindex="1" readonly="readonly" dir="ltr" size="60%" value="<?php print $student_user_values["tax_info_name"]; ?>" ONCHANGE="validatePresent(this, 'error_tax_info_name');">&nbsp;<span id="error_tax_info_name" class="tahoma10rednormal"><?php if (! not_null ($student_user_values["tax_info_mode"]) ) { ?>Required<?php } ?>
            </td>
        </tr>
		<tr>
            <td width="13%" class="tahoma12blacknormal padding_left"> Charge:</td>
            <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
				<input name="charge" type="text" class="tahoma12blacknormal padding_left" id="charge" tabindex="2" dir="ltr" size="60%" value="<?php print $student_user_values["charge"]; ?>" ONCHANGE="validatePresent(this, 'error_charge');">&nbsp;%<span id="error_charge" class="tahoma10rednormal"> <?php if (! not_null ($student_user_values["charge"]) ) { ?>Required<?php } ?>
			</td>
        </tr>
        <tr>
            <td class="tahoma12blacknormal padding_left">Live:</td>
            <td width="87%" colspan = "2">
		        <input name="live" class="noneborder" type="checkbox" value="Y" tabindex="3" <? if ($student_user_values["live"] == 'Y') { echo "checked"; }  ?>>
			</td>
        </tr>
        <tr>
            <td class="tahoma12blacknormal padding_left">Active:</td>
            <td width="87%" colspan = "2"><input name="active" class="noneborder" type="radio" tabindex="4" value="Y" <? echo $Y ?>>
				<span class="tahoma12blacknormal padding_left">Yes</span>
				<input name="active" class="noneborder" type="radio" tabindex="5" value="N" <? echo $N ?>>
				<span class="tahoma12blacknormal padding_left">No</span>
			</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td >
                <input style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;" name="buttonSubmit" type="button" tabindex="6" title="Submit" onClick="submitfrmStudentUser(document.frmStudentUser);" value="Submit" >&nbsp;
                <input class="btn_style1" name="buttonCancel" type="button" tabindex="7" title="Cancel" value="Cancel" ONCLICK="document.location.href='<?php echo href_link(FILENAME_TAX_INFO, 'page=' . $_GET["page"]); ?>'" style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;"></td>
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
              <?php /* ?>  <td class="tahoma11blacknormal" align="left" style="padding-left:8px; padding-bottom:5px"><img src="images/newfolder.gif" width="16" height="16" align="absbottom" alt="Add Event">&nbsp;&nbsp;<!--<a title="Click to add new hms info add" href="<?php echo href_link(FILENAME_TAX_INFO, 'action=tax_add'); ?>"><b>Add tax</b></a>--></td>    <?php */ ?>
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