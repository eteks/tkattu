<?php
require_once ("includes/application_top.php");
checklogin();

$module_title = "Privilege Users";

/*if (! is_allow_module($_COOKIE["admin_id"], 1)) {
    redirect (href_link(FILENAME_DEFAULT));
    exit;
}*/

$privilegeUser_obj = new hmsprivilegeUserClass;

$action = $_POST["action"] ? $_POST["action"] : $_GET["action"];

switch ($action) {
    case "privilege_user_insert":
        $insert_id = $privilegeUser_obj->privilegeUserInsert();
        redirect (href_link(FILENAME_HMS_PRIVILEGE_USERS,'parent_id='.$_GET["parent_id"]));
    break;
    case "privilege_user_update":
        $privilegeUser_obj->privilegeUserUpdate();
        redirect (href_link(FILENAME_HMS_PRIVILEGE_USERS,'parent_id='.$_GET["parent_id"].'&page=' . $_GET["page"]));
    break;
    case "privilege_user_delete":
        $privilegeUser_obj->privilegeUserDelete();
        redirect (href_link(FILENAME_HMS_PRIVILEGE_USERS, 'parent_id='.$_GET["parent_id"].'&page=' . $_GET["page"]));
    break;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <title><?=PROJECT_NAME?> : Privilege Users </title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="Shortcut Icon" href="images/favicon.png" type="image/x-icon" />
  <link href="css/style.css" rel="stylesheet" type="text/css">
  <script language="javascript" type="text/javascript" src="js/xmlHttpRequest.js"></script>
  <script language="javascript" type="text/javascript" src="js/common.js"></script>
  <script language="javascript" type="text/javascript" src="js/userprivilege.js"></script>
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
                        <?php require_once(DIR_WS_PRIVILEGE_USER .FILENAME_HMS_PRIVILEGE_USERS);?> </td>
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