<?php
require_once ("includes/application_top.php");
checklogin();
$module_title = TITLE_MANAGE_SERVICES_ENTRY;
$hms_info_obj = new hmsInfo();
if (! is_allow_module($_COOKIE["admin_id"], 63) ) {
    redirect (href_link(FILENAME_DEFAULT));
    exit;
}
$page = $_POST["page"] ? $_POST["page"] : $_GET["page"];
switch ($_REQUEST['action']) {
    case "services_entry_insert":
        $hms_info_obj->servicesEntryInsert();
        redirect (href_link(FILENAME_SERVICES_ENTRY, 'page=' . $page));
    break;
    case "services_entry_update":
        $hms_info_obj->servicesEntryUpdate();
        redirect (href_link(FILENAME_SERVICES_ENTRY, 'page=' . $page));
    break;
    case "services_entry_delete":
        $hms_info_obj->servicesEntryDelete($id);
        redirect (href_link(FILENAME_SERVICES_ENTRY, 'page=' . $page));
    break;
    case "facility_selected_hmsInfo_manage_records":
        $hms_info_obj->deleteServicesEntryMultipleRecord();
        redirect (href_link(FILENAME_SERVICES_ENTRY, 'page=' . $page));
    break;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <title><?=PROJECT_NAME?> : <?=$module_title?> </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="extension/Highslides/css/highslides.css" rel="stylesheet" type="text/css">
    <script language="javascript" type="text/javascript" src="js/xmlHttpRequest.js"></script>
    <script language="javascript" type="text/javascript" src="js/common.js"></script>
	<script language="javascript" type="text/javascript" src="js/Services_Entry.js"></script>
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
             <?php require_once(DIR_WS_BASIC_INFO . FILENAME_SERVICES_ENTRY);?>
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