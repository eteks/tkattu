<?php
require_once ("includes/application_top.php");
checklogin();
$module_title = TITLE_MANAGE_TAX_SCHEME;
$hms_info_obj = new hmsInfo();
if (! is_allow_module($_COOKIE["admin_id"], 87) ) {
    redirect (href_link(FILENAME_DEFAULT));
    exit;
}
$page = $_POST["page"] ? $_POST["page"] : $_GET["page"];
switch ($_REQUEST['action']) {
    case "tax_scheme_insert":

        $form_date = explode("-", $_POST["DateFrom"]);
		$formDate = $form_date[2]."-".$form_date[1]."-".$form_date[0];

        $hms_info_obj->taxSchemeInsert($formDate);
        redirect (href_link(FILENAME_TAX_SCHEME, 'page=' . $page));
    break;
    case "tax_scheme_update":

        $form_date = explode("-", $_POST["DateFrom"]);
		$formDate = $form_date[2]."-".$form_date[1]."-".$form_date[0];
        $hms_info_obj->taxSchemeUpdate($formDate);
        redirect (href_link(FILENAME_TAX_SCHEME, 'page=' . $page));
    break;
    case "tax_scheme_manage_delete":
        $hms_info_obj->taxSchemeDelete($id);
        redirect (href_link(FILENAME_TAX_SCHEME, 'page=' . $page));
    break;
    case "delete_selected_hmsInfo_manage_records":
        $hms_info_obj->deleteTaxSchemeMultipleRecord();
        redirect (href_link(FILENAME_TAX_SCHEME, 'page=' . $page));
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
	<link href="js/CalendarControl.css"  rel="stylesheet" type="text/css">
	<script src="js/CalendarControl.js" language="javascript"></script>
    <link href="extension/Highslides/css/highslides.css" rel="stylesheet" type="text/css">
    <script language="javascript" type="text/javascript" src="js/xmlHttpRequest.js"></script>
    <script language="javascript" type="text/javascript" src="js/common.js"></script>
	<script language="javascript" type="text/javascript" src="js/tax_scheme.js"></script>
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
             <?php require_once(DIR_WS_FINANCE . FILENAME_TAX_SCHEME);?>
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