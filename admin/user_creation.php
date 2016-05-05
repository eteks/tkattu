<?php
ob_start();
require_once ("includes/application_top.php");
checklogin();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <title><?=PROJECT_NAME?> : User Creation </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="Shortcut Icon" href="images/favicon.png" type="image/x-icon" />
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="extension/Highslides/css/highslides.css" rel="stylesheet" type="text/css">
    <script language="javascript" type="text/javascript" src="js/xmlHttpRequest.js"></script>
    <script language="javascript" type="text/javascript" src="js/common.js"></script>
	<script language="javascript" type="text/javascript" src="js/item_entry.js"></script>
    <script type="text/javascript" src="extension/Highslides/highslide-with-html.js"></script>
    <script type="text/javascript" src="extension/Highslides/highslide_manage.js"></script>
    <script type="text/javascript">
        hs.graphicsDir = 'extension/Highslides/graphics/';
        hs.outlineType = 'rounded-white';
        hs.outlineWhileAnimating = true;
    </script>
    
    
    <script>
	
	function deleteUser(id)
	{
		id1 = confirm("Do you want to delete this link informataion?");
		if(id1 == true)
		   window.location.href="user_creation.php?action=delete&id="+id;
	}		
	
	
	</script>
    
    
 <script>
	
function validate()
{
	 if(document.getElementById('name').value == '') {
    document.getElementById('error_service').style.display ="block";
    document.getElementById('error_service').innerHTML = "Please Enter Name";
    document.getElementById('name').focus();
    return false;
   }
   
   if(document.getElementById('age').value == '') {
    document.getElementById('error_service').style.display ="block";
    document.getElementById('error_service').innerHTML = "Please Enter the Age";
    document.getElementById('age').focus();
    return false;
   }
   
   if(document.getElementById('phone_no').value == '') {
    document.getElementById('error_service').style.display ="block";
    document.getElementById('error_service').innerHTML = "Please Enter the Phone Number";
    document.getElementById('phone_no').focus();
    return false;
   }
   
   if(document.getElementById('address1').value == '') {
   document.getElementById('error_service').style.display ="block";
   document.getElementById('error_service').innerHTML = "Please Enter the Address Field ";
   document.getElementById('address1').focus();
    return false;
   }
   
   if(document.getElementById('address2').value == '') {
    document.getElementById('error_service').style.display ="block";
    document.getElementById('error_service').innerHTML = "Please Enter the Address Field";
    document.getElementById('address2').focus();
    return false;
   }
   
   if(document.getElementById('state').value == '') {
    document.getElementById('error_service').style.display ="block";
    document.getElementById('error_service').innerHTML = "Please Enter the State";
    document.getElementById('state').focus();
    return false;
   }
   
   if(document.getElementById('pincode').value == '') {
    document.getElementById('error_service').style.display ="block";
    document.getElementById('error_service').innerHTML = "Please Enter the Pin Code";
    document.getElementById('pincode').focus();
    return false;
   }

	}	
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
         <td align="left" valign="top" width="15%" style="border-right:1px solid #CFCFCF; padding-right:2px; ">
		 <? require_once(DIR_WS_INCLUDES.'side_links.php'); ?>
         </td>
         <td height="350" bgcolor="<?=SECONDROWCOLOR?>" width="100%" align="center" valign="top">
             
<form id="CreateUser"  name="CreateUser" method="POST"  action="" onSubmit="return validate()">
  
  <table width="100%" border="0" cellspacing="0" cellpadding="2">
  
  <tr>
  <td colspan="6" align="center" ><span  id="error_service" style="display:none;background-color:#EC8F82;border:solid 1px #FF0000;" ></span></td>
  </tr>
   
    <tr>
      <td></td>
    </tr>
    <tr>
      <td colspan="6" align="left" style="background-image:url(images/back_header_bg.jpg); background-repeat:repeat-x;"><table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="left" style="padding-left:6px"><img src="images/arrow_heading.gif" /></td>
            <td align="left" class="heading_light_blue" valign="top">&nbsp;User Creation</td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td colspan="2"></td>
    </tr>
     <?php 
	 if($_REQUEST['view'])
	 {
	  $Edit=$_REQUEST['view']; 
	   $update="SELECT * FROM ".TABLE_HMS_HOUSE_KEEPING_USER_CREATION." where id='$Edit'";
	   $update_query=mysql_query( $update);
	   while($update_data=mysql_fetch_array($update_query))
	   {
	  ?>
    <tr>
      <td width="13%" class="tahoma12blacknormal padding_left"> Name:</td>
      <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
<input type="hidden" id="update_id" tabindex="2" size="60%" name="update_id" autocomplete="off"  value="<?php echo $update_data['id']; ?>">
      <input type="text" id="name" tabindex="2" size="60%" name="name" autocomplete="off"  value="<?php echo $update_data['name']; ?>">
      </td>
    </tr>
    
    <tr>
      <td width="13%" class="tahoma12blacknormal padding_left"> Age:</td>
      <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
      <input type="text" id="age" tabindex="2" size="60%" name="age" autocomplete="off" value="<?php echo $update_data['age']; ?>" >
      </td>
    </tr>
    
    <tr>
      <td width="13%" class="tahoma12blacknormal padding_left"> Phone Number:</td>
      <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
      <input type="text" id="phone_no" tabindex="2" size="60%" name="phone_no" autocomplete="off" value="<?php echo $update_data['phone_no']; ?>">
      </td>
    </tr>
    
    <tr>
      <td width="13%" class="tahoma12blacknormal padding_left"> Address Line 1:</td>
      <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
       <input type="text" id="address1" tabindex="2" size="60%" name="address1" autocomplete="off" value="<?php echo $update_data['address1']; ?>">
      </td>
    </tr>
    
      <tr>
      <td width="13%" class="tahoma12blacknormal padding_left"> Address Line 2:</td>
      <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
       <input type="text" id="address2" tabindex="2" size="60%" name="address2" autocomplete="off" value="<?php echo $update_data['address2']; ?>">
      </td>
    </tr>
    <tr>
      <td width="13%" class="tahoma12blacknormal padding_left"> State:</td>
      <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
       <input type="text" id="state" tabindex="2" size="60%" name="state" autocomplete="off" value="<?php echo $update_data['state']; ?>">
      </td>
    </tr>
    
    <tr>
      <td width="13%" class="tahoma12blacknormal padding_left"> Pin Code:</td>
      <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
       <input type="text" id="pincode" tabindex="2" size="60%" name="pincode" autocomplete="off" value="<?php echo $update_data['pincode']; ?>">
      </td>
    </tr>
      
    <tr>
      <td>&nbsp;</td>  
      <td ><input style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;" name="update" type="submit" tabindex="11"  id="update" value="update" >
        &nbsp;
        <input class="btn_style1" name="buttonCancel" type="reset" id="reset" tabindex="12"  value="Cancel"  style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;" onclick="javascript:window.location.href='user_creation.php?m=k'"></td>
    </tr>
    
    <tr><td>&nbsp;</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>&nbsp;</td></tr>
    
   <?php  } }
   
if($_REQUEST['action']==add)
   {  
   ?>
   
   <tr>
      <td width="13%" class="tahoma12blacknormal padding_left"> Name:</td>
      <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
<input type="hidden" id="update_id" tabindex="2" size="60%" name="update_id" autocomplete="off"  value="<?php echo $update_data['id']; ?>">
      <input type="text" id="name" tabindex="2" size="60%" name="name" autocomplete="off"  value="<?php echo $update_data['name']; ?>">
      </td>
    </tr>
    
    <tr>
      <td width="13%" class="tahoma12blacknormal padding_left"> Age:</td>
      <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
      <input type="text" id="age" tabindex="2" size="60%" name="age" autocomplete="off" value="<?php echo $update_data['age']; ?>" >
      </td>
    </tr>
    
    <tr>
      <td width="13%" class="tahoma12blacknormal padding_left"> Phone Number:</td>
      <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
      <input type="text" id="phone_no" tabindex="2" size="60%" name="phone_no" autocomplete="off" value="<?php echo $update_data['phone_no']; ?>">
      </td>
    </tr>
    
    <tr>
      <td width="13%" class="tahoma12blacknormal padding_left"> Address Line 1:</td>
      <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
       <input type="text" id="address1" tabindex="2" size="60%" name="address1" autocomplete="off" value="<?php echo $update_data['address1']; ?>">
      </td>
    </tr>
    
      <tr>
      <td width="13%" class="tahoma12blacknormal padding_left"> Address Line 2:</td>
      <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
       <input type="text" id="address2" tabindex="2" size="60%" name="address2" autocomplete="off" value="<?php echo $update_data['address2']; ?>">
      </td>
    </tr>
    <tr>
      <td width="13%" class="tahoma12blacknormal padding_left"> State:</td>
      <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
       <input type="text" id="state" tabindex="2" size="60%" name="state" autocomplete="off" value="<?php echo $update_data['state']; ?>">
      </td>
    </tr>
    
    <tr>
      <td width="13%" class="tahoma12blacknormal padding_left"> Pin Code:</td>
      <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
       <input type="text" id="pincode" tabindex="2" size="60%" name="pincode" autocomplete="off" value="<?php echo $update_data['pincode']; ?>">
      </td>
    </tr>
      
    <tr>
      <td>&nbsp;</td>  
      <td ><input style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;" name="submit" type="submit" tabindex="11"  id="submit" value="submit" >
        &nbsp;
        <input class="btn_style1" name="buttonCancel" type="reset" id="reset" tabindex="12"  value="Cancel"  style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;" onclick="javascript:window.location.href='user_creation.php?m=k'"></td>
    </tr>
    
    <tr><td>&nbsp;</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>&nbsp;</td></tr>  
   
      <?php
}


//pagination

$query = "SELECT * FROM ".TABLE_HMS_HOUSE_KEEPING_USER_CREATION."";
$query = db_query($query);
$count = db_num_rows($query);

$perpage = 5; // items per page

$pages_count  = ceil($count / $perpage);


// Get the current page or set default if not given
$page = isset($_GET['page']) ? $_GET['page'] : 1;

$pages_count = ceil($count / $perpage);

$is_first = $page == 1;
$is_last  = $page == $pages_count;

// Prev cannot be less than one
$prev = max(1, $page - 1);

// Next cannot be larger than $pages_count
$next = min($pages_count , $page + 1);

if($pages_count > 0) {
  
  // If we are on page 2 or higher
  if(!$is_first) {
      echo '<a href="user_creation.php?page=1">First</a> &nbsp;&nbsp;&nbsp;&nbsp;';
      echo '<a href="user_creation.php?page='.$prev.'">Previous</a>';
  }

  echo '&nbsp;&nbsp;<span>Page <b>'.$page.'</b> / <b>'.$pages_count.'</b></span>&nbsp;&nbsp;';

  // If we are not at the last page
  if(!$is_last) {
      echo '<a href="user_creation.php?page='.$next.'">Next</a>&nbsp;&nbsp;&nbsp;&nbsp;';
      echo '<a href="user_creation.php?page='.$pages_count.'">Last</a>';
  }

$user_creation_show="SELECT * FROM ".TABLE_HMS_HOUSE_KEEPING_USER_CREATION."  LIMIT  ".(int)($page - 1)." , ".(int)$perpage ." ";
$user_creation_show_records = db_query ($user_creation_show);		
		if ($user_creation_show_records > 0) {

       ?>
        <tr>
       <table width="100%" border="1" cellspacing="0" cellpadding="5" class="ntab" style="font-size:12px;">
       <tr>

         <th width="12%" style="text-align:center" >Name</th>
         <th width="11%" style="text-align:center" >Age</th>
         <th width="11%" style="text-align:center" >Phone No </th>
		  <th width="12%" style="text-align:center" >Address </th>
            <th width="9%" style="text-align:center" >State</th>
		    <th width="12%" style="text-align:center" >PinCode</th>
			 <th width="12%" style="text-align:center" >Edit</th>
             <th width="10%" style="text-align:center" >Remove</th>
         
    </tr>
   <?php while ($hms_info_values = db_fetch_array($user_creation_show_records)) { ?>
    <tr>
            <input type="hidden" id="id" name="id" value="<?php echo stripslashes($hms_info_values["id"]); ?>">

	
        <td width="12%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
        <?php echo stripslashes($hms_info_values["name"]); ?>
        </td>
        
       <td width="11%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
       
        <?php  echo stripslashes($hms_info_values["age"]); ?></td>
        
		  <td width="12%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
		    <?php echo $hms_info_values["phone_no"]; ?></td>

		  <td width="9%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
        <?php  echo $hms_info_values["address1"]; echo",<br/>";
		echo $hms_info_values["address2"]; ?></td>


		  <td width="12%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
        <?php echo $hms_info_values["state"]; ?></td>
        
        <td width="11%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
        <?php  echo $hms_info_values["pincode"]; ?></td>
        
		 <td width="5%" style="text-align:center" bgcolor="#FFFFFF">
		 <a href="user_creation.php?view=<?php echo $hms_info_values["id"]; ?>"><img src="images/edit.gif" alt="Edit" border="0"
		 title="Click to edit"  style="cursor:pointer;" />
						</a></td>
        
    <td width="5%" style="text-align:center" bgcolor="#FFFFFF"><img src="images/delete.gif" alt="Delete" border="0" title="Click to delete" onClick="deleteUser(<?php echo $hms_info_values["id"]; ?>)" style="cursor:pointer;"></td>
      
	  
	  
  </tr>
  <?php }}
   }
else {

  echo "No result found";
}
 
  ?>
  <tr> <td class="tahoma11blacknormal" align="left" style="padding-left:8px; padding-bottom:5px"><img src="images/newfolder.gif" width="16" height="16" align="absbottom" alt="Add Event">&nbsp;&nbsp;<a title="Click to add new hms info add" href="user_creation.php?action=add"><b>Add User Details</b></a></td></tr>
  </table>
       </tr>
    
  </table>
</form>   

 
             
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
<?php  
if (isset($_POST['submit']))
{
	$name= $_POST['name'];
	$age= $_POST['age'];
	$phone_no= $_POST['phone_no'];
	$address1= $_POST['address1'];
	$address2= $_POST['address2'];
	$state= $_POST['state'];
	$pincode= $_POST['pincode'];
	
		
$user_creation_add= mysql_query("INSERT INTO ".TABLE_HMS_HOUSE_KEEPING_USER_CREATION." (id,name,age,phone_no,address1,address2,state,pincode) VALUES('','$name','$age','$phone_no','$address1','$address2','$state','$pincode')")or die("could not insert data");
	}
	
	if($user_creation_add)
	{
		header("location:user_creation.php");

		}
		
		
		
if (isset($_POST['update']))
{
    
	$update_id=$_POST['update_id'];
	$name= $_POST['name'];
	$age= $_POST['age'];
	$phone_no= $_POST['phone_no'];
	$address1= $_POST['address1'];
	$address2= $_POST['address2'];
	$state= $_POST['state'];
	$pincode= $_POST['pincode'];
	
		
$user_update= mysql_query("UPDATE ".TABLE_HMS_HOUSE_KEEPING_USER_CREATION." SET `name` = '".$name."',`age` = '".$age."',`phone_no` = '".$phone_no."',`address1` = '".$address1."',`address2` = '".$address2."',`state` = '".$state."',`pincode` = '".$pincode."' WHERE `id` = '".$update_id."'") or die("could not insert data");
	}
	
	if($user_update)
	{
		header("location:user_creation.php");

		}	
		
 ?>
 
 <?php
$id = $_REQUEST['id'];
$action = $_REQUEST['action'];
if($action=="delete")
{
echo $sqldelete;
	$sqldelete = "DELETE FROM ".TABLE_HMS_HOUSE_KEEPING_USER_CREATION." WHERE id='".$id."' " ; 
	
	$querydelete = mysql_query($sqldelete);
	header("location:{$_SERVER['HTTP_REFERER']}");
	
} 
    ?>

<? require_once('mysql_close.php');  ?>