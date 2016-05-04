<?php
require_once ("includes/application_top.php");
checklogin();
$module_title = "Privilege Roles";
if (! is_allow_module($_COOKIE["admin_id"], 1) ) {
    redirect (href_link(FILENAME_DEFAULT));
    exit;
}

$privilegeRolseClass = new privilegeRolesClass;
$_POST['action']= (isset($_POST['action']) && !empty($_POST['action']) ? $_POST['action']:"" );
switch ($_POST["action"]){

    case "privilege_roles_insert":
        $privilegeRolseClass->privilegeRolesInsert ();
        redirect (href_link(FILENAME_PRIVILEGE_ROLES, 'parentid='.$_POST["role_parent_id"]));
    break;
    case "privilege_roles_update":
            $privilegeRolseClass->privilege_roles_update($_POST["sort_order"], $_POST["role_parent_id"], $_POST["role_name"], $_POST["short_desc"], $_POST["active"], $_POST["parent"], $_POST["id"]);
            redirect (href_link(FILENAME_PRIVILEGE_ROLES, 'parentid='.$_POST["role_parent_id"]));
    break;
} 
$_GET['action']= (isset($_GET['action']) && !empty($_GET['action']) ? $_GET['action']:"" );
switch ($_GET["action"]){
    case "privilege_roles_delete":

          $privilegeRolseClass->privilegeRolesDelete($_GET["id"], $_GET["parentid"]);
        redirect (href_link(FILENAME_PRIVILEGE_ROLES, 'parentid='.$_GET["parentid"]));
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
              <?php require_once(DIR_WS_PRIVILEGE . 'privilege_roles.php');?> </td>
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