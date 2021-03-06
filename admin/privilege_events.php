<?php
require_once ("includes/application_top.php");
checklogin();
$module_title = "Privilege Events";
if (! is_allow_module($_COOKIE["admin_id"], 1)) {
    redirect (href_link(FILENAME_DEFAULT));
    exit;
}

$privilegeEventClass = new privilegeModuleEventsClass;

switch($_POST["action"]){
    case "privilege_module_event_insert":   
        $privilegeEventClass->privilegeModuleEventInsert($_POST["module_event_parent_id"], $_POST["event_name"], $_POST["short_desc"], $_POST["event_filename"], $_POST["event_parameters"]);
        redirect(href_link(FILENAME_PRIVILEGE_EVENTS, 'module_event_parent_id='.$_POST["module_event_parent_id"]));
    break;
    case "privilege_module_event_update":
          $privilegeEventClass->privilegeModuleEventUpdate($_POST["module_event_parent_id"], $_POST["event_name"], $_POST["short_desc"], $_POST["event_filename"], $_POST["event_parameters"], $_POST["id"]);
        redirect(href_link(FILENAME_PRIVILEGE_EVENTS, 'module_event_parent_id='.$_POST["module_event_parent_id"]));
    break;
    case "privilege_module_event_delete":
        $privilegeEventClass->privilegeModuleEventDelete($_POST["id"]);
        redirect(href_link(FILENAME_PRIVILEGE_EVENTS, 'module_event_parent_id='.$_POST["parent_moduleid"]));
    break;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <title><?=PROJECT_NAME?> : Privilege Events </title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="Shortcut Icon" href="images/favicon.png" type="image/x-icon" />
  <link href="css/style.css" rel="stylesheet" type="text/css">
  <script language="javascript" type="text/javascript" src="js/xmlHttpRequest.js"></script>
  <script language="javascript" type="text/javascript" src="js/common.js"></script>
  <script language="javascript" type="text/javascript" src="js/privilege.js"></script>
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
                        <?php require_once(DIR_WS_PRIVILEGE . 'privilege_events.php');?> </td>
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