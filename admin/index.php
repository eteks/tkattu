<?php
require_once ("includes/application_top.php");
checklogin();
$module_title = "Control Panel";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?=PROJECT_NAME?> :  Administration Console</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="Shortcut Icon" href="images/favicon.png" type="image/x-icon" />
<link href="css/main.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">

</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
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
       <td  style="padding-top:5px;">
         <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="table_outer_border">
            <tr>
            <td valign="top" >&nbsp;</td>
            <td width="100%" style="padding-top:5px;padding-bottom:5px;" >
                <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" bgcolor="<?=SECONDROWCOLOR?>">
                   <tr>
                      <td>
                         <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF">
                           <tr>
                             <td valign="top" align="center" bgcolor="#FFFFFF"  style="padding-top:25px; padding-bottom:25px">
                             <?php require_once (DIR_WS_MODULES . 'index.php'); ?>
                          </td>
                      </tr>
               </table>
            </td>
          </tr>
        </table>
		</td>
	    </tr>
        <tr>
            <td valign="top">
            <?php require_once (DIR_WS_INCLUDES . 'footer.php');?>
            </td>
        </tr>
</table>
</td>
</tr>
</table>

</body>
</html>
<? require_once('mysql_close.php');?>