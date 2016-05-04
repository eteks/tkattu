<?php
ob_start();
require_once ("includes/application_top.php");
checklogin();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<style>

#content
{
width: 900px;
margin: 0 auto;
font-family:Arial, Helvetica, sans-serif;
}
.page
{
float: right;
margin: 0;
padding: 0;
}
.page li
{
list-style: none;
display:inline-block;
}
.page li a, .current
{
display: block;
padding: 5px;
text-decoration: none;
color: #8A8A8A;
}
.current
{
font-weight:bold;
color: #000;
}
.button
{
   float: right;
 font-size: 13PX;
margin: 0 10px 2px;

/* padding: 5px 15px;
text-decoration: none;
background: #333;
color: #F3F3F3;
font-size: 13PX;
border-radius: 2PX;
margin: 0 4PX;
display: block;
float: left; */
}

</style>
<head>
    <title><?=PROJECT_NAME?> : User Creation </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
		   window.location.href="Menu_sub_category.php?action=delete&id="+id;
	}		
	
	
	</script>
    
    
<script>
	
function validate()
{
	 if(document.getElementById('category').value == '') {
    document.getElementById('error_service').style.display ="block";
    document.getElementById('error_service').innerHTML = "Please Select Category Name";
    document.getElementById('category').focus();
    return false;
   }
   
   if(document.getElementById('sub_category').value == '') {
    document.getElementById('error_service').style.display ="block";
    document.getElementById('error_service').innerHTML = "Please Enter the Sub Category";
    document.getElementById('sub_category').focus();
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
            <td align="left" class="heading_light_blue" valign="top">&nbsp;Sub Menu Category</td>
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
	   $update="SELECT * FROM ".TABLE_HMS_MENUSUBCATEGORY_CREATION." where hms_menu_sub_category_id	='$Edit'";
	   $update_query=mysql_query( $update);
	   while($update_data=mysql_fetch_array($update_query))
	   {
	  ?>
    <tr>
      <td width="15%" class="tahoma12blacknormal padding_left"> Menu Category:</td>
      <td width="85%" colspan = "2" class="tahoma12blacknormal padding_left">
<input type="hidden" id="update_id" tabindex="2" size="60%" name="update_id" autocomplete="off"  value="<?php echo $update_data['hms_menu_sub_category_id']; ?>">
       <select name="category" id="category" style="width:250px;"  >
	<option value="">--Select--</option>
		<?php  
		$menu_category="SELECT * FROM  ".TABLE_HMS_MENUCATEGORY_CREATION." WHERE active='Y'";
		$menu_category_query= db_query($menu_category);
		while($menu_category_result=db_fetch_array($menu_category_query))
	{
		?>		
		<option <?php if($menu_category_result['hms_menu_category_id']==$update_data['hms_menu_category_id']){?> selected="selected" <?php } ?> value="<?php  echo $menu_category_result['hms_menu_category_id']; ?>"> <?php echo $menu_category_result['hms_menu_category_name'];  ?></option>
				<?php } ?>
			</select>		
      </td>
    </tr>
	
	 <tr>
      <td width="15%" class="tahoma12blacknormal padding_left">Menu Sub Category:</td>
      <td width="85%" colspan = "2" class="tahoma12blacknormal padding_left">
      <input type="text" id="sub_category" tabindex="2" size="60%" name="sub_category" autocomplete="off" value="<?php  echo $update_data['hms_menu_sub_category_name']; ?>"> >
      </td>
    </tr>
     <tr>
            <td class="tahoma12blacknormal padding_left">Active:</td>
            <td width="85%" colspan = "2"><input name="active" class="noneborder" type="radio" tabindex="4" value="Y"  <?php if($update_data['active']=='Y'){?> checked="checked" <?php } ?>>
				<span class="tahoma12blacknormal padding_left">Yes</span>
				<input name="active" class="noneborder" type="radio" tabindex="5" value="N" <?php if($update_data['active']=='N'){?> checked="checked" <?php } ?>>
				<span class="tahoma12blacknormal padding_left">No</span>
			</td>
        </tr>
  
      
    <tr>
      <td>&nbsp;</td>  
      <td ><input style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;" name="update" type="submit" tabindex="11"  id="update" value="update" >
        &nbsp;
        <input class="btn_style1" name="buttonCancel" type="reset" id="reset" tabindex="12"  value="Cancel"  style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;" onclick="javascript:window.location.href='Menu_sub_category.php?m=k'"> </td>
    </tr>
    
    <tr><td>&nbsp;</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>&nbsp;</td></tr>
    
   <?php  } }
   
if($_REQUEST['action']==add)
   {  
   ?>
   
   <tr>
      <td width="15%" class="tahoma12blacknormal padding_left"> Menu Category:</td>
      <td width="85%" colspan = "2" class="tahoma12blacknormal padding_left">
    
	 <select name="category" id="category" style="width:250px;"  >
	<option value="">--Select--</option>
		<?php  
		$menu_category="SELECT * FROM  ".TABLE_HMS_MENUCATEGORY_CREATION." WHERE active='Y'";
		$menu_category_query= db_query($menu_category);
		while($menu_category_result=db_fetch_array($menu_category_query))
	{
		?>		
		<option  value="<?php  echo $menu_category_result['hms_menu_category_id']; ?>"> <?php echo $menu_category_result['hms_menu_category_name'];  ?></option>
				<?php } ?>
			</select>
      </td>
    </tr>
    
    <tr>
      <td width="15%" class="tahoma12blacknormal padding_left">Menu Sub Category:</td>
      <td width="85%" colspan = "2" class="tahoma12blacknormal padding_left">
      <input type="text" id="sub_category" tabindex="2" size="60%" name="sub_category" autocomplete="off"  >
      </td>
    </tr>
     <tr>
            <td class="tahoma12blacknormal padding_left">Active:</td>
            <td width="85%" colspan = "2"><input name="active" class="noneborder" type="radio" tabindex="4" value="Y" checked="checked" >
				<span class="tahoma12blacknormal padding_left">Yes</span>
				<input name="active" class="noneborder" type="radio" tabindex="5" value="N" >
				<span class="tahoma12blacknormal padding_left">No</span>
			</td>
        </tr>
    <tr>
      <td>&nbsp;</td>  
      <td ><input style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;" name="submit" type="submit" tabindex="11"  id="submit" value="submit" >
        &nbsp;
        <input class="btn_style1" name="buttonCancel" type="reset" id="reset" tabindex="12"  value="Cancel"  style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;" onclick="javascript:window.location.href='Menu_sub_category.php?m=k'"> </td>
    </tr>
    
    <tr><td>&nbsp;</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>&nbsp;</td></tr>  
   
      <?php
}

if($_REQUEST['m']==k){
$start=0;
$limit=5;

if(isset($_GET['id']))
{
$id=$_GET['id'];
$start=($id-1)*$limit;
}
$user_creation_show = "SELECT * FROM ".TABLE_HMS_MENUSUBCATEGORY_CREATION." ORDER BY hms_menu_sub_category_id DESC LIMIT $start, $limit";
$user_creation_show_records = db_query ($user_creation_show);				
if ($user_creation_show_records > 0) {

       ?>
        <tr>
       <table width="100%" border="1" cellspacing="0" cellpadding="5" class="ntab" style="font-size:12px;">
       <tr>

         <th width="12%" style="text-align:center" >Menu Category</th>
         <th width="11%" style="text-align:center" >Menu Sub-Category</th>
         <th width="11%" style="text-align:center" >Satus</th>
		  <th width="11%" style="text-align:center" >Created Date</th>
		   <th width="11%" style="text-align:center" >Last Modified Date</th>
			 <th width="12%" style="text-align:center" >Edit</th>
             <th width="10%" style="text-align:center" >Remove</th>
         
    </tr>
   <?php while ($hms_info_values = db_fetch_array($user_creation_show_records)) { ?>
    <tr>
            <input type="hidden" id="id" name="id" value="<?php echo stripslashes($hms_info_values["hms_menu_sub_category_id"]); ?>">

	
        <td width="12%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
	    <?php 
		 $cat_id=$hms_info_values["hms_menu_category_id"];
		$sql="SELECT * FROM  ".TABLE_HMS_MENUCATEGORY_CREATION."  WHERE hms_menu_category_id='$cat_id' ";
		$hms_tax= db_query($sql);
		while($row_result=db_fetch_array($hms_tax))
	     {
		echo $row_result["hms_menu_category_name"];
            }  ?>
	    </td>
        
       <td width="11%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
       
        <?php  echo stripslashes($hms_info_values["hms_menu_sub_category_name"]); ?></td>
        
		  <td width="12%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
		    <?php echo $hms_info_values["active"]; ?></td>

		 		  <td width="12%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
        <?php echo $hms_info_values["date_added"]; ?></td>
        
        <td width="11%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
        <?php  echo $hms_info_values["date_modified"]; ?></td>
        
		 <td width="5%" style="text-align:center" bgcolor="#FFFFFF">
		 <a href="Menu_sub_category.php?view=<?php echo $hms_info_values["hms_menu_sub_category_id"]; ?>"><img src="images/edit.gif" alt="Edit" border="0"
		 title="Click to edit"  style="cursor:pointer;" />
						</a></td>
        
    <td width="5%" style="text-align:center" bgcolor="#FFFFFF"><img src="images/delete.gif" alt="Delete" border="0" title="Click to delete" onClick="deleteUser(<?php echo $hms_info_values["hms_menu_sub_category_id"]; ?>)" style="cursor:pointer;"></td>
      
	  
	  
  </tr>
  <?php }
  
  $rows=mysql_num_rows(mysql_query("SELECT * FROM ".TABLE_HMS_MENUSUBCATEGORY_CREATION." ORDER BY hms_menu_sub_category_id DESC"));
$total=ceil($rows/$limit);
if($id>1)
{
echo "<a href='Menu_sub_category.php?m=k&id=".($id-1)."' class='button'>PREVIOUS</a>";
}
if($id!=$total)
{
echo "<a href='Menu_sub_category.php?m=k&id=".($id+1)."' class='button'>NEXT</a>";
}

echo "<ul class='page'>";
for($i=1;$i<=$total;$i++)
{
if($i==$id) {  }

else {  }
}
echo "</ul>";
  
  
  ?>
  
  <?php
   }
else {

  echo "No result found";
}
 
  ?>
  <tr> <td class="tahoma11blacknormal" align="left" style="padding-left:8px; padding-bottom:5px"><img src="images/newfolder.gif" width="16" height="16" align="absbottom" alt="Add Event">&nbsp;&nbsp;<a title="Click to add new hms info add" href="Menu_sub_category.php?action=add"><b>Add Sub Category Menu</b></a></td></tr>
  </table>
       </tr>
    
  </table>
</form>   

  <?php   } ?>
             
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
	$category= $_POST['category'];
	$sub_category= $_POST['sub_category'];
	$active= $_POST['active'];
	
	
	$user_creation_add= mysql_query("INSERT INTO ".TABLE_HMS_MENUSUBCATEGORY_CREATION." (hms_menu_sub_category_id,hms_menu_category_id,hms_menu_sub_category_name,active,date_added,date_modified) VALUES('','$category','$sub_category','$active',NOW(),'')")or die("could not insert data");
	}
	
	if($user_creation_add)
	{
      header("location:Menu_sub_category.php?m=k");	
				}
if (isset($_POST['category']))
{
    
	$update_id=$_POST['update_id'];
	$category= $_POST['category'];
	$sub_category= $_POST['sub_category'];
	$active= $_POST['active'];
		
$user_update= mysql_query("UPDATE ".TABLE_HMS_MENUSUBCATEGORY_CREATION." SET `hms_menu_category_id` = '".$category."',`hms_menu_sub_category_name` = '".$sub_category."',`active` = '".$active."',`date_modified` = NOW() WHERE `hms_menu_sub_category_id` = '".$update_id."'") or die("could not insert data");
	}
	
	if($user_update)
	{ 
		 header("location:Menu_sub_category.php?m=k");	

		}		
 ?>
 
 <?php
$id = $_REQUEST['id'];
$action = $_REQUEST['action'];
if($action=="delete")
{
echo $sqldelete;
	$sqldelete = "DELETE FROM ".TABLE_HMS_MENUSUBCATEGORY_CREATION." WHERE hms_menu_sub_category_id='".$id."' " ; 
	
	$querydelete = mysql_query($sqldelete);
	header("location:{$_SERVER['HTTP_REFERER']}");
	
} 
    ?>

<? require_once('mysql_close.php');  ?>