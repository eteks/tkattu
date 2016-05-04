<?php
$action_pos = (isset($_POST["action"]) && !empty($_POST["action"]) ? $_POST["action"]:"");
$action_get = (isset($_GET["action"]) && !empty($_GET["action"]) ? $_GET["action"]:"");
$action     = (isset($action_pos) && !empty($action_pos) ? $action_pos : $action_get);
$page       = (isset($_POST["page"]) && !empty($_POST["page"]) ? $_POST["page"]:"");
$page_get   = (isset($_GET["page"]) && !empty($_GET["page"]) ? $_GET["page"]:"");
if (isset($action) && ($action == "menustockentry_add")) {
    $menustockentry_add = "menustockentry_insert";
    $menustockentry_cate       = $hms_info_obj->getMenuEntryTree();

?>
<form name="frmStudentUser" method="POST" enctype="multipart/form-data" action="<?php echo href_link(FILENAME_MENU_STOCK_ENTRY); ?>">
    <input type="hidden" name="action" value="<?php echo ${$_GET["action"]}; ?>">
   <input type="hidden" name="page" value="<?php echo (isset($page) ? $page : 1); ?>">
   
    <table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr><td></td></tr>
    <tr><td></td></tr>
	      <tr>
            <td colspan="6" align="left" style="background-image:url(images/back_header_bg.jpg); background-repeat:repeat-x; padding-top:8px; padding-left:0px"><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" style="padding-left:6px"><img src="images/arrow_heading.gif" /></td>
                <td align="left" class="heading_light_blue" valign="top">&nbsp;<?php echo TITLE_MANAGE_MENU_STOCK_ENTRY;?></td>
              </tr>
            </table></td>
        </tr>
        <tr>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td width="17%" class="tahoma12blacknormal padding_left">Menu Category:</td>
         <td width="83%" colspan = "2" class="tahoma12blacknormal padding_left">
             <?php 
    echo draw_pull_down_menu ('mse_cate', $menustockentry_cate, '', 'tabindex="1" class="normaltext"  id="mse_cate" style="width:175px;" ONCHANGE = "validatePresent(this, \'error_mse_cate\');"', '','' ); ?>&nbsp;<span id="error_mse_cate" class="tahoma10rednormal"></span> 
         </td>
       </tr>
        <tr>
            <td width="17%" class="tahoma12blacknormal padding_left">Menu:</td>
            <td width="83%" colspan = "2" class="tahoma12blacknormal padding_left">
                <select id="mse_menu" name="mse_menu" onchange="validatePresent(this, 'error_mse_menu');" style="width:175px;" >
                </select>&nbsp;<span id="error_mse_menu" class="tahoma10rednormal"></span>
         </td>
       </tr>
        <tr>
            <td width="15%" class="tahoma12blacknormal padding_left">Menu Quantity:</td>
            <td width="85%" colspan = "2" class="tahoma12blacknormal padding_left">
             <input name="mse_qty" type="text"  id="mse_qty" ><span id="error_mse_qty" class="tahoma10rednormal"></span>
          </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td >
                <input style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;" name="buttonSubmit" type="button" tabindex="4" title="Submit" onClick="submitfrmStudentUser(document.frmStudentUser);" value="Submit" >&nbsp;
                <input class="btn_style1" name="buttonCancel" type="button" tabindex="5" title="Cancel" value="Cancel" ONCLICK="document.location.href='<?php echo href_link(FILENAME_MENU_STOCK_ENTRY, 'page=' . $page_get); ?>'" style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;"></td>
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
                <td height="20"></td>
            </tr>
            <tr>
                <td class="tahoma11blacknormal" align="left" style="padding-left:8px; padding-bottom:5px"><img src="images/newfolder.gif" width="16" height="16" align="absbottom" alt="Add Event">&nbsp;&nbsp;<a title="Click to add new hms info add" href="<?php echo href_link(FILENAME_MENU_STOCK_ENTRY, 'action=menustockentry_add'); ?>"><b>Add Menu Stock Entry</b></a></td>
            </tr>
        </table>
  </td>
 </tr>
</table>
        <script language="javascript" type="text/javascript">
        <!--//
            populateHotelInfoManageLists('', '', '', '<?php echo $page ;?>');
        //-->
    </script>
    <?php
}
?>