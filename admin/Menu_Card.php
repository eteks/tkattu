<?php
require_once ("includes/application_top.php");
checklogin();
$module_title = TITLE_MANAGE_MENU_CARD_CREATION;
$hms_info_obj = new hmsInfo();
if (! is_allow_module($_COOKIE["admin_id"], 72) ) {
    redirect (href_link(FILENAME_DEFAULT));
    exit;
}
$page = $_POST["page"] ? $_POST["page"] : $_GET["page"];
switch ($_REQUEST['action']) {
    case "menu_card_insert":
        $hms_info_obj->menuCardInsert();
        redirect (href_link(FILENAME_MENU_CARD, 'page=' . $page));
    break;
    case "menu_card_update":
        $hms_info_obj->MenuCardUpdate();
        redirect (href_link(FILENAME_MENU_CARD, 'page=' . $page));
    break;
    case "menu_card_manage_delete":
        $hms_info_obj->MenuCardDelete($id);
        redirect (href_link(FILENAME_MENU_CARD, 'page=' . $page));
    break;
    case "delete_selected_hmsInfo_manage_records":
        $hms_info_obj->deleteMenuCardMultipleRecord();
        redirect (href_link(FILENAME_MENU_CARD, 'page=' . $page));
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
	<script language="javascript" type="text/javascript" src="js/Menu_Card.js"></script>
    <script language="javascript" type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="extension/Highslides/highslide-with-html.js"></script>
    <script type="text/javascript" src="extension/Highslides/highslide_manage.js"></script>
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
            <?php
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
             <?php require_once(DIR_WS_MENU_CARD . FILENAME_MENU_CARD);?>
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