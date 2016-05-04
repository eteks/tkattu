<?php 
include("includes/applicationTop.php");
checkLogin();

//print_R($_POST);
if (($_POST['cancel'] == "Cancel")) {
  
   header("location:".FILENAME_REPORTS."?action=list");
}





if ($_GET["action"]=="delete") {


  $Shift_delete= dbQuery("DELETE FROM " .  TABLE_SHIFT_DETAILS.  "  WHERE shift_id='" . $_GET["shift_id"] . "'");
   redirect(FILENAME_SHIFTDETAILS . "?a=sucess&ms=3&action=list" );
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: Billing Software ::</title>
<script type="text/javascript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<script src="facebox/jquery.js" type="text/javascript"></script>
<link href="facebox/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="facebox/facebox.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox() 
    })
</script>
<script src="js/script.js" type="text/javascript"></script>
<link href="css/stylesheet.css" rel="stylesheet" type="text/css" />
<link href="CalendarControl.css"  rel="stylesheet" type="text/css">
<script src="CalendarControl.js" language="javascript"></script>
</head>

<body onload="MM_preloadImages('images/neworder_02.jpg','images/orders_02.jpg','images/clients_02.jpg','images/kitchen_02.jpg','images/shifts_02.jpg','images/endofday_02.jpg','images/reports_02.jpg','images/email_02.jpg','images/ordersmenu_02.jpg','images/details_02.jpg')">
<form name="shiftdetails" action="" method="post">
<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <th scope="col" >
	<table width="100%" height="528" border="0" align="left" cellpadding="0" cellspacing="0">
      <tr>
        <th scope="col" valign="top">
		<?php include_once("includes/header.php"); ?>
		</th>
      </tr>
      <tr>
        <td  align="left" class="arialbluebold1">
        <?php  
		  echo "End Of Day";
		?>  
       </td>
      </tr>
      
	 <?php
     if (!empty($_GET['ms'])) {
       if ($_GET['ms']=="1") {
     ?>         
      <tr>
        <td align="center" valign="top"><font color="Green"><?php echo "Successfully Added"; ?></font>
       </td>
      </tr>

  <?php
          }  elseif ($_GET['ms']=="3") {
     ?>         
      <tr>
        <td align="center" valign="top"><font color="Green"><?php echo "Successfully Deleted"; ?></font>
       </td>
      </tr>

	  <?php
          } else {
	  ?>	  
      <tr>
        <td align="center" valign="top"><font color="Green"><?php echo "Updated Successfully"; ?></font>
       </td>
      </tr>
     <?php				  
          }
        }
      ?>
      <tr>
        <td align="left" valign="top"> 
		  <?php 
             if ($_GET["action"]=="list") {
    		   include_once(FILENAME_REPORTSBODY);
			}   
             if (($_GET["a"]=="date") && empty($_POST['date'])) {
    		   include_once(FILENAME_REPORTSDATEBODY);
			}   
		  	
			if ($_POST['date'] == "Submit") { 
    		   include_once(FILENAME_REPORTSDATELIST);
            } 
			
             if (($_GET["a"]=="shift") && empty($_POST['shift'])) {
    		   include_once(FILENAME_REPORTSSHIFTBODY);
			}   

			if ($_POST['shift'] == "Submit") { 
    		   include_once(FILENAME_REPORTSSHIFTLIST);
            } 


             if (($_GET["a"]=="purchase") && empty($_POST['purchase'])) {
    		   include_once(FILENAME_REPORTSPURCHASEBODY);
			}   
			if ($_POST['purchase'] == "Submit") { 
    		   include_once(FILENAME_REPORTSPURCHASELIST);
            } 


		   ?>
       </td>
      </tr>
      <tr>
        <td height="15"><?php include_once("includes/footer.php"); ?></td>
      </tr>
    </table> </th>
  </tr>
</table>
</form>
</body>
</html>
