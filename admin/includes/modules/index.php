<? $cp_cols = 5?>
<table width="100%" border="0" cellpadding="2" cellspacing="1" align="left" style="border:0px solid #CCCCCC; ">
    <tr><td width="12%" height="40"></td>
    </tr>
    <tr >
       <td >
        <?php
        $module_index_query = "SELECT `id`, `name`, `filename` FROM " . TABLE_MODULE_MASTER . "  WHERE `parent_id` = 0 and `active` = 'Y' order by `sort_order` ";
        $module_index_result = db_query ($module_index_query);
        if (db_num_rows( $module_index_result )) {
            $module_arr=array();
            $counter=1;
            $tr_flag=false;
            echo '<table align="center" cellpadding="2" cellspacing="0" border="0" width="20%">';  
            while ($module_index_row = mysql_fetch_array($module_index_result))    {
        if (!$tr_flag) {
            echo "<tr>";
            $tr_flag=true;
            $counter=1;
        }
        if (is_allow_module($_COOKIE["admin_id"], $module_index_row["id"])) {
            $curr_module_id  = $module_index_row["id"];
            $image_file_name = $module_index_row["id"] . ".gif";
            //$image_file_name = "13.jpg";
            ?><td width="41%" valign="middle" class="controlbox" style="text-align:center;">
            <a href="<?php echo $module_index_row["filename"]; ?>" target="_top" border="0"><img src="<?php echo DIR_WS_IMAGES . $image_file_name; ?>" border="0"><br/>
          <br><br><?php echo $module_index_row["name"]; ?></a></td><?php
            $counter++;
        }
        if ($counter%$cp_cols==0) {
            echo "</tr>";
            $tr_flag=false;
        } 
    }
    $curr_module_id  = 0;
    $image_file_name = $curr_module_id." . jpg";
    $image_file_name = "icon_pwd.gif";
    ?>
    
    <!-- <td width="44%" valign="middle" class="controlbox" style="text-align:center;"><a href="../admin/user_creation.php"  border="0"><img src="../admin/images/hr.png" border="0"><br/>
      <br><br>Manage House Keeping</a></td> --> 
    
    <td width="44%" valign="middle" class="controlbox" style="text-align:center;"><a href="<? echo href_link(FILENAME_CHANGE_PROFILE);?>" target="_top" border="0"><img src="<?php echo DIR_WS_IMAGES . $image_file_name; ?>" border="0">
      <br><br>Change Password</a></td>
    <?php
    if ($tr_flag) {
        $loop = ($cp_cols-$counter)-1;
        for($i=1;$i<=$loop;$i++) {
            echo "<td>&nbsp;</td>";
        }
    }
}
?><td ></td>
</tr>
<tr><td height="40"></td></tr>
</table>