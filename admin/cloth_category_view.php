<?php

//pagination

$query = "SELECT * FROM ".TABLE_HMS_ROOM_CLOT_CATEGORY."";
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
      echo '<a href="cloth_category.php?page=1">First</a> &nbsp;&nbsp;&nbsp;&nbsp;';
      echo '<a href="cloth_category.php?page='.$prev.'">Previous</a>';
  }

  echo '&nbsp;&nbsp;<span>Page <b>'.$page.'</b> / <b>'.$pages_count.'</b></span>&nbsp;&nbsp;';

  // If we are not at the last page
  if(!$is_last) {
      echo '<a href="cloth_category.php?page='.$next.'">Next</a>&nbsp;&nbsp;&nbsp;&nbsp;';
      echo '<a href="cloth_category.php?page='.$pages_count.'">Last</a>';
  }

$user_creation_show="SELECT * FROM ".TABLE_HMS_ROOM_CLOT_CATEGORY."  LIMIT  ".(int)($page - 1)." , ".(int)$perpage ." ";
$user_creation_show_records = db_query ($user_creation_show);		
		if ($user_creation_show_records > 0) {

       ?>
        <tr>
       <table width="100%" border="1" cellspacing="0" cellpadding="5" class="ntab" style="font-size:12px;">
       <tr>

         <th width="12%" style="text-align:center" >Name</th>
         <th width="11%" style="text-align:center" >Status</th>
         <th width="11%" style="text-align:center" >Date Added </th>
		  <th width="12%" style="text-align:center" >Date Modified </th>
			 <th width="12%" style="text-align:center" >Edit</th>
             <th width="10%" style="text-align:center" >Remove</th>
         
    </tr>
   <?php while ($hms_info_values = db_fetch_array($user_creation_show_records)) { ?>
    <tr>
            <input type="hidden" id="id" name="id" value="<?php echo stripslashes($hms_info_values["id"]); ?>">

	
        <td width="12%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
        <?php echo stripslashes($hms_info_values["cloth_name"]); ?>
        </td>
        
       <td width="11%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
       
        <?php  echo stripslashes($hms_info_values["active"]); ?></td>
        
		  <td width="12%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
		    <?php echo $hms_info_values["date_added"]; ?></td>

				  <td width="12%" bgcolor="<?php echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
        <?php echo $hms_info_values["date_modified"]; ?></td>
        
       		 <td width="5%" style="text-align:center" bgcolor="#FFFFFF">
		 <a href="cloth_category.php?view=<?php echo $hms_info_values["id"]; ?>"><img src="images/edit.gif" alt="Edit" border="0"
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
  <tr> <td class="tahoma11blacknormal" align="left" style="padding-left:8px; padding-bottom:5px"><img src="images/newfolder.gif" width="16" height="16" align="absbottom" alt="Add Event">&nbsp;&nbsp;<a title="Click to add new hms info add" href="cloth_category.php?action=add"><b>Add payment</b></a></td></tr>
  </table>
       </tr>
    
     </table>
   </td>
</tr>