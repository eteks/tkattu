<?php
require_once ("includes/application_top.php");
//require_once ("sss.html");
session_start();

?>


<?php $_GET["vendor_name"] = (isset($_GET['vendor_name']) && !empty($_GET['vendor_name']) ? $_GET['vendor_name']:"" );
$_GET["id"] = (isset($_GET['id']) && !empty($_GET['id']) ? $_GET['id']:"" );
$Purchase_List_Details = "SELECT *  FROM " . TABLE_HMS_PURCHASE_ORDER_DETAIL. " where vendor_name = '". $_GET["vendor_name"] ."' AND item_type_id='". $_GET["id"] ."' AND status='1'";
$customerQuery = mysql_query($Purchase_List_Details);
$customerArray =mysql_fetch_array($customerQuery);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: ATOMICKA ~ Hotel Management System ::</title>
<script type="text/javascript" src="js/inventory.js"></script>

<style type="text/css">
<!--
.style1 {font-size: 12px; font-style: normal; line-height: normal; font-variant: normal; text-transform: none; color: #000000; text-decoration: none; font-family: Verdana, Arial, Helvetica, sans-serif;}
-->



.submit {
 font:Arial;
 font-size:11px;
 background:#330000;

 color: #CCCCCC;
/* border:1px solid #990000;*/
 padding:1px;
/* font-weight:bold;*/
cursor:pointer;
 
 
 }
 
</style>
<style type="text/css" media="print">    
				    .nonprintable
				
					{
					  display: none;
					}  
					</style>
</head>


<script>
function balanceQty()
{
	var available_qty = document.getElementById('available_qty').value;
	var processed_qty = document.getElementById('processed_qty').value;
	
	var balance_qty =available_qty - processed_qty;
	
	document.getElementById('balance_qty').value=balance_qty;
	
	
	}
	
	
function validate()
{
	 if(document.getElementById('item_name').value == '') {
    document.getElementById('error_service').style.display ="block";
    document.getElementById('error_service').innerHTML = "Please Enter Item Name";
    document.getElementById('item_name').focus();
    return false;
   }
   
   if(document.getElementById('item_type').value == '') {
    document.getElementById('error_service').style.display ="block";
    document.getElementById('error_service').innerHTML = "Please Enter Item Type";
    document.getElementById('item_type').focus();
    return false;
   }
   
   if(document.getElementById('available_qty').value == '') {
    document.getElementById('error_service').style.display ="block";
    document.getElementById('error_service').innerHTML = "Please Enter Available Quantity";
    document.getElementById('available_qty').focus();
    return false;
   }
   
   if(document.getElementById('processed_qty').value == '') {
    document.getElementById('error_service').style.display ="block";
    document.getElementById('error_service').innerHTML = "Please Enter Processed Quantity";
    document.getElementById('processed_qty').focus();
    return false;
   }
   
   if(document.getElementById('balance_qty').value == '') {
    document.getElementById('error_service').style.display ="block";
    document.getElementById('error_service').innerHTML = "Please Enter Balance Quantity";
    document.getElementById('balance_qty').focus();
    return false;
   }
	
	
	
	
	}	
</script>
<body>
<?php  

$item_name=$_GET['item_name'];
$item_type=$_GET['item_type'];
$avail_qty=$_GET['avail_qty'];

 ?>
<form id="balanceupdate" name="balanceupdate" action="" method="post" onsubmit="return validate()">
<TABLE cellpadding="0" cellspacing="0" border="0" width="100%">
    <TR><TD valign="top" align="center">


   
  
<table width="650"  border="0" align="center" cellpadding="2" cellspacing="2" style="border:1px solid #000000;" class="NormalTxt"  >
  
    <td  bgcolor="#D7DBB0" class="style1" colspan="4" align="center" ><strong><u>STOCK PROCESS</u></strong></td>
  </tr>
  
   <tr>
  <td colspan="4" align="center" ><span  id="error_service" style="display:none;background-color:#EC8F82;border:solid 1px #FF0000;" ></span></td>
   </tr>
 
  <tr>
    <td align="right"><strong> Item  Name</strong></td>
    <td align="left" class="NormalTxt">:&nbsp; <input type="hidden" id="item_name" name="item_name" readonly value="<?php echo $item_name; ?>" /><input type="text" id="item_name_tmp" name="item_name_tmp" readonly value="<?php echo itemname($item_name); ?>" /> </td>
     <td colspan="2" align="left" class="NormalTxt">&nbsp;</td>
   
    </tr>
  
  <tr>
    <td align="right" valign="top"><strong>Item Type</strong></td>
    <td colspan="2" align="left" class="NormalTxt">:&nbsp;
<input type="text" readonly  value="<?php echo itemtypename($item_type); ?>" /> 
<input type="hidden" id="item_type" name="item_type" value="<?php echo $item_type; ?>" /> 

</td>
    <td align="left" class="NormalTxt">&nbsp;</td>
    </tr>
    
    <tr>
    <td align="right"><strong>Available Quantity</strong></td>
    <td colspan="2" align="left" class="NormalTxt">:&nbsp; <input type="text" readonly id="available_qty" name="available_qty" value="<?php echo $avail_qty; ?>" /> </td>
    <td align="left" class="NormalTxt">&nbsp;</td>
    </tr>
    
    <tr>
    <td align="right"><strong>Processed Quantity</strong></td>
    <td colspan="2" align="left" class="NormalTxt">:&nbsp; <input type="text" id="processed_qty" name="processed_qty" onkeyup="return balanceQty()" value="" autocomplete="off" /> </td>
    <td align="left" class="NormalTxt">&nbsp;</td>
    </tr>
    
    <tr>
    <td align="right"><strong>Balance Quantity</strong></td>
    <td colspan="2" align="left" class="NormalTxt">:&nbsp; <input type="text" id="balance_qty" name="balance_qty" value="" /> </td>
    <td align="left" class="NormalTxt">&nbsp;</td>
    </tr>
    
    
    <tr>
    <td align="right"></td>
    <td colspan="2" align="left" class="NormalTxt"> <input  type="submit" id="submit" name="submit"  value="Submit" >  <input type="reset" id="reset" 
  value="Reset" > </td>
    <td align="left" class="NormalTxt">&nbsp;</td>
    </tr>
    
   
    
    </table> 
    
  

  
  
   
</table> 
  


</form>
</body>
</html>
<?php  
if (isset($_POST['submit']))
{
	$item_name1= $_POST['item_name'];
	$item_type1= $_POST['item_type'];
	$available_qty1= $_POST['available_qty'];
	$processed_qty1= $_POST['processed_qty'];
	$balance_qty1= $_POST['balance_qty'];
	
	$processed_stock= mysql_query("INSERT INTO ".TABLE_HMS_STOCK_BALANCE_DETAIL." (stock_id,item_name,item_type,processed_quantity,date) VALUES ('','$item_name1','$item_type1','$processed_qty1',CURDATE())")or die("could not insert data");
	
			//$processed_stock_records = db_query($processed_stock);

	if($processed_stock>0)
	{
	 echo "<script> 
	 
	 window.close();
	 
	 </script>";

		}
	
	

	
	}


 ?>