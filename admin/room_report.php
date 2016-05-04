<?php
require_once ("includes/application_top.php");
checklogin();
$module_title = TITLE_MANAGE_HMS_ROOM;
if (! is_allow_module($_COOKIE["admin_id"], 72) ) {
    redirect (href_link(FILENAME_DEFAULT));
    exit;
}


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?=PROJECT_NAME?> : <?=$module_title?> </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="Shortcut Icon" href="images/favicon.png" type="image/x-icon" />
    <link href="css/style.css" rel="stylesheet" type="text/css">
   <!-- <link href="extension/Highslides/css/highslides.css" rel="stylesheet" type="text/css">-->
    <link rel="stylesheet" type="text/css" media="all" href="css/skins/aqua/theme.css" title="Aqua" />
     <script language="javascript" type="text/javascript" src="js/common.js"></script>
       <script src="js/jquery.js" type="text/javascript"></script>
       
    <script language="javascript" type="text/javascript" src="js/xmlHttpRequest.js"></script>
	<script language="javascript" type="text/javascript" src="js/Menu_Card.js"></script>
    <script type="text/javascript" src="extension/Highslides/highslide-with-html.js"></script>
    <script type="text/javascript" src="extension/Highslides/highslide_manage.js"></script>
    <script type="text/javascript">
        hs.graphicsDir = 'extension/Highslides/graphics/';
        hs.outlineType = 'rounded-white';
        hs.outlineWhileAnimating = true;
    </script>
    <style type="text/css">
<!--
.style2 {color: #EB5300}
-->
    </style>
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
         <td height="350" bgcolor="<?=SECONDROWCOLOR?>" width="100%" align="center" valign="middle"><table width="100%" border="0" align="center" cellpadding="2" cellspacing="3">
           <tr>
             <td width="37%" align="right"><span class="style2">1)</span></td>
             <td width="63%" align="left"><span class="style2"><a href="<? echo href_link(FILENAME_REPORT_ROOMS)?>">Room&nbsp;&nbsp;Report</a></span></td>
           </tr>
           <tr>
             <td align="right"><span class="style2">2)</span></td>
             <td align="left"><span class="style2"><a href="<? echo href_link(FILENAME_ROOMS_OCCUPANCY)?>">Room Occupancy Report </a></span></td>
           </tr>
          <!-- <tr>
             <td align="right"><span class="style2">3)</span></td>
             <td align="left"><span class="style2"><a href="<? echo href_link(FILENAME_DEPARTURE_REPORT)?>">Arrival / Departure Report Arrival</a> </span></td>
           </tr>-->
           <tr>
             <td align="right"><span class="style2">3)</span></td>
             <td align="left"><span class="style2"><a href="<? echo href_link(FILENAME_GROUP_RESERVATION)?>"> Reservation Report</a></span></td>
           </tr>
           <!--<tr>
             <td align="right"><span class="style2">5)</span></td>
             <td align="left"><span class="style2"><a href="<? echo href_link(FILENAME_GUEST_REPORT)?>">Guest&nbsp;In&nbsp;House</a></span></td>
           </tr>-->
           <tr>
             <td align="right"><span class="style2">4)</span></td>
             <td align="left"><span class="style2"><a href="<? echo href_link(FILENAME_KEEPING_REPORT)?>">House&nbsp;Keeping&nbsp;Report&nbsp;</a></span></td>
           </tr>
          <!-- <tr>
             <td align="right"><span class="style2">7)</span></td>
             <td align="left"><span class="style2"><a href="<? echo href_link(FILENAME_REGISTRATION_CARD)?>">Customer Registration Card</a></span></td>
           </tr>-->
           <tr>
             <td align="right"><span class="style2">5)</span></td>
             <td align="left"><span class="style2"><a href="<? echo href_link(FILENAME_RESERVATION_CANCEL)?>">Reservation&nbsp;Cancellation</a></span></td>
           </tr>
         </table></td>
		 
		 
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