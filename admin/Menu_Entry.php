<?php
require_once ("includes/application_top.php");
checklogin();
$module_title = TITLE_MANAGE_MENU_ENTRY;
$hms_info_obj = new hmsInfo();
if (! is_allow_module($_COOKIE["admin_id"], 71) ) {
    redirect (href_link(FILENAME_DEFAULT));
    exit;
}
$sub_id=$_REQUEST['sub_categ'];
$page = $_POST["page"] ? $_POST["page"] : $_GET["page"];
switch ($_REQUEST['action']) {
    case "menu_entry_insert":
        $hms_info_obj->menuEntryInsert();
        redirect (href_link(FILENAME_MENU_ENTRY, 'page=' . $page));
    break;
    case "menu_entry_update":
        $hms_info_obj->menuEntryUpdate();
        redirect (href_link(FILENAME_MENU_ENTRY, 'page=' . $page));
    break;
    case "menu_entry_manage_delete":
        $hms_info_obj->MenuEntryDelete($id);
        redirect (href_link(FILENAME_MENU_ENTRY, 'page=' . $page));
    break;
    case "delete_selected_hmsInfo_manage_records":
        $hms_info_obj->deletemenuTypeMultipleRecord();
        redirect (href_link(FILENAME_MENU_ENTRY, 'page=' . $page));
    break;
	
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <title><?=PROJECT_NAME?> : <?=$module_title?> </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="Shortcut Icon" href="images/favicon.png" type="image/x-icon" />
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="extension/Highslides/css/highslides.css" rel="stylesheet" type="text/css">
    <script language="javascript" type="text/javascript" src="js/xmlHttpRequest.js"></script>
    <script language="javascript" type="text/javascript" src="js/common.js"></script>
	<script language="javascript" type="text/javascript" src="js/Menu_Entry.js"></script>
    <script type="text/javascript" src="extension/Highslides/highslide-with-html.js"></script>
    <script type="text/javascript" src="extension/Highslides/highslide_manage.js"></script>
    <script src="js/jquery.js" type="text/javascript"></script>
    <script type="text/javascript">
        hs.graphicsDir = 'extension/Highslides/graphics/';
        hs.outlineType = 'rounded-white';
        hs.outlineWhileAnimating = true;
    </script>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td colspan="3">
          <table cellpadding="0" cellspacing="0" width="100%">
            <?
            require_once (DIR_WS_INCLUDES . 'header.php');  
            require_once (DIR_WS_INCLUDES . 'header_bottom.php'); 
            ?>
         </table>
        </td>
      </tr>
     <!-- content -->
      <tr>
     <!-- leftnav -->
     <td style="padding-top:5px;">
<table width="100%" class="table_outer_border" cellpadding="0" cellspacing="0" bgcolor="<?=SECONDROWCOLOR?>">
<tr>
   <td>
     <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
       <tr>
         <td align="left" valign="top" width="15%" style="border-right:1px solid #CFCFCF; padding-right:2px; "><? require_once(DIR_WS_INCLUDES.'side_links.php'); ?></td>
         <td height="350" bgcolor="<?=SECONDROWCOLOR?>" width="100%" align="center" valign="top">
             <?php require_once(DIR_WS_MENU_CARD . FILENAME_MENU_ENTRY);?>
         </td>
       </tr>
     </table>
   </td>
</tr>
</table>
</td></tr>
        <tr>
            <td valign="top">
            <?php require_once (DIR_WS_INCLUDES . 'footer.php');?>
            </td>
        </tr></table>		
</body>
</html>
<? require_once('mysql_close.php');?>