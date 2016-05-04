<?php

require_once ("includes/application_top.php");
checklogin();

$privilegeUser_obj = new hmsprivilegeUserClass;

if (!not_null($_GET["page"]) || $_GET["page"]<1 ) {
    $startpage = 1;
} else {
    $startpage = $_GET["page"];
}


if (not_null ($_GET["parent_id"]) ) {
    $role_master_id = $_GET["parent_id"];
} else {
    $role_master_id = 0;
}
$user_sql_cond='';
if (not_null($role_master_id)) {
    $user_sql_cond = " admin_role_mst_id = '" . $role_master_id . "'";
}
switch($_GET["action"]) {

case "privilege_user_duplication":
    echo $privilege_user_duplication = $privilegeUser_obj->privilegeUserDuplication();
    exit;
break;

case "update_role_modules_tree":
    $users_modules = array();
    $users_events = array();
    if($_GET["addflag"]!='1' && not_null($_GET["id"])) {
        $users_modules_str = $privilegeUser_obj->get_all_users_modules();
        $users_events_str = $privilegeUser_obj->get_all_users_events();
        $users_modules = explode("','",$users_modules_str);
        $users_events = explode("','",$users_events_str);
    }
    echo $privilegeUser_obj->get_modules_events_tree($role_master_id, 0, $users_modules, $users_events, true);
    exit;
break;
case "update_user_modules_tree":

       $users_modules = array();
       $users_events = array();
       if($_GET["addflag"] != '1' && not_null($_GET["id"])) {
        $users_modules_str = $privilegeUser_obj->get_all_users_modules();
        $users_events_str = $privilegeUser_obj->get_all_users_events();
        $users_modules = explode("','",$users_modules_str);
        $users_events = explode("','",$users_events_str);
    }
    echo $privilegeUser_obj->get_modules_events_tree($role_master_id, $_GET["module_id"], $users_modules, $users_events, false);
    exit;
break;
case "privilege_user_update_active":
    $privilegeUser_obj->privilegeUpdateActive();
break;
}

$cond_str = "";

while (true && not_null($user_sql_cond)) {

    $starrecord = ( $startpage * PAGINATION_DISPLAYED_RECORDS ) - PAGINATION_DISPLAYED_RECORDS;
    $user_master_total_sql = $privilegeUser_obj->privilegeUserMastreTotalSql($user_sql_cond);
    $user_master_total = db_query ($user_master_total_sql);
    $total_user_master_no = db_num_rows($user_master_total);
    $user_master_sql = $user_master_total_sql . " LIMIT " . $starrecord  . ", " . (PAGINATION_DISPLAYED_RECORDS+1); 
    $user_master_result = db_query ($user_master_sql);
    $user_master_total_current_recs = db_num_rows($user_master_result);
    $prev_user_master_page = 0;
    $next_user_master_page = 0;
    if($user_master_total_current_recs > 0) {
        $prev_user_master_page = $startpage  - 1;
        $next_user_master_page = ( $user_master_total_current_recs == PAGINATION_DISPLAYED_RECORDS + 1 ? $startpage+1 : 0);
    }
    if($user_master_total_current_recs == 0 && $startpage > 1) {
        $startpage;
        continue;
    } else {
        break;
    }
}    
$total_records = ( $user_master_total_current_recs > PAGINATION_DISPLAYED_RECORDS ? ($user_master_total_current_recs - 1) : $user_master_total_current_recs);

$privilege_user_master_role_arr = true;
$privilege_user_master_role_arr = $privilegeUser_obj->get_privilege_role_tree();

if (count($privilege_user_master_role_arr) > 1 || $total_user_master_no) { ?>
  <form name="frmPrivilegeUserMenu" method="get" action="<? echo href_link(FILENAME_HMS_PRIVILEGE_USERS); ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="2">
        
        
        <tr>
        <td  colspan="11" ><table border="0" cellspacing="0" cellpadding="0">
			<tr>
			  <td style="padding-left:6px"><img src="images/arrow_heading.gif" /></td>
			  <td align="left" class="heading_light_blue">&nbsp;<?php echo TITLE_MANAGE_HMS_PRIVILEGE_USER;?></td>
			</tr>
		  </table>
          <p>&nbsp;</p></td>
      </tr>
  <tr>
     <td>
     <?php 
      echo draw_pull_down_menu('role_master_id', $privilege_user_master_role_arr,  $role_master_id, 'tabindex="1" class="normaltext" onchange="if(this.selectedIndex==0)frmPrivilegeUserMenu.buttonSubmit.disabled=true;else frmPrivilegeUserMenu.buttonSubmit.disabled=false;"'); 
      ?>&nbsp;<input name="buttonSubmit" type="button"  class="btn_style1" tabindex="2" title="Submit" style="cursor:pointer;" onClick="submitfrmPrivilegeUserMenu(document.frmPrivilegeUserMenu);" value="Go" <?php if($role_master_id <= 0) { echo "disabled"; } ?>>
    </td>
    <?php if ($total_user_master_no  && $role_master_id) { 
          $total_db_user_master_no = $privilegeUser_obj->totalDbUserMasterNo();
    ?>
    <td align="right" class="normaltext" title="total users of selected category">Showing <b><?php echo ($starrecord+1); ?></b> - <b><?php echo ($starrecord + $total_records); ?></b> out of <b><?php echo $total_user_master_no; ?></b> Records (<b title="total users in database"><?php echo $total_db_user_master_no; ?></b>)</td><?php } ?>
    </tr>
    </table>
    </form>
    <?php       
    if ($role_master_id) {
        if ($total_records) {

            ?><form name="frmPrivilegeUsers" method="POST" action="<?php echo href_link(FILENAME_HMS_PRIVILEGE_USERS,'parent_id=' . $role_master_id . '&page=' . $startpage); ?>"><input type="hidden" name="action"><input type="hidden" name="id">
            <table width="100%" border="0" cellspacing="0" cellpadding="2" align="center" class="ntab">
            <?php

            if ($prev_user_master_page > 0 || $next_user_master_page > 0) { 

                ?><tr>
                    <td colspan="7" class="normaltext" align="right">
                    <span class="normaltext">
                    <?php 
                    if($prev_user_master_page>0) { 
                        ?><a class="normaltext" href="javascript:populate_privilege_users_records('<?php echo $prev_user_master_page; ?>', <?php echo $role_master_id; ?>);"><b>Previous</b></a><?php
                    } else {
                        ?>Previous<?php
                    } 
                    if($next_user_master_page>0) { 
                        ?>&nbsp;|&nbsp;<a class="normaltext" href="javascript:populate_privilege_users_records('<?php echo $next_user_master_page; ?>', <?php echo $role_master_id; ?>);"><b>Next</b></a><?php
                    } else {
                        ?>&nbsp;|&nbsp;Next<?php
                    }
                    ?>
                    </span>
                    </td>
                </tr><?php
            }
            ?>
            <tr>
                <th style="padding-left:10px; text-align:center;">User Name</th>
                <th style="text-align:center">First Name</th>
                <th style="text-align:center">Last Name</th>
                <th style="text-align:center">Email Id</th>
                <th width="8%" style="text-align:center">Active</th>
                <th width="8%" style="text-align:center" colspan="2">Action</th>
            </tr><?php
            $user_master_counter = 1;
            while ($users_master_values = db_fetch_array($user_master_result)) {
                if($user_master_counter < PAGINATION_DISPLAYED_RECORDS + 1) {
                    $bgcolor = (($user_master_counter % 2 == 0) ? FIRSTROWCOLOR : SECONDROWCOLOR);
                    ?><tr>
                        <td class="tahoma11blacknormal" bgcolor="<? echo $bgcolor ?>" align="center" style="padding-left:10px;"><?php echo stripslashes($users_master_values["username"]); ?></td>
                        <td bgcolor="<? echo $bgcolor ?>" class="tahoma11blacknormal" align="center"><?php echo stripslashes($users_master_values["first_name"]); ?></td>
                        <td bgcolor="<? echo $bgcolor ?>" class="tahoma11blacknormal" align="center"><?php echo stripslashes($users_master_values["last_name"]); ?></td>
                        <td bgcolor="<? echo $bgcolor ?>" class="tahoma11blacknormal" align="center"><?php echo stripslashes($users_master_values["email"]); ?></td>
                        <td bgcolor="<? echo $bgcolor ?>" style="text-align:center"><a title="<?php echo (($users_master_values["active"] == "Y") ? "deactivate" : "activate"); ?> the user" href="javascript:populate_privilege_users_records('<?php echo $startpage; ?>', '<?php echo $role_master_id; ?>', '<?php echo $users_master_values["id"]; ?>','privilege_user_update_active', '<?php echo (($users_master_values["active"] == "Y") ? "N" : "Y"); ?>');"><img src="images/<?php echo $users_master_values["active"]; ?>.gif" width="16" height="16" border="0"></a></td>
                        <td bgcolor="<? echo $bgcolor ?>" width="3%" style="text-align:center"><a title="edit module" href="<?php echo href_link(FILENAME_HMS_PRIVILEGE_USERS, 'page='.$startpage.'&parent_id=' . $role_master_id . '&id=' . $users_master_values["id"] . '&action=privilege_user_edit'); ?>"><img src="images/edit.gif" width="15" height="15" alt="Edit" border="0"></a></td>
                        <td bgcolor="<? echo $bgcolor ?>" width="3%" style="text-align:center"><a title="delete module" href="javascript:deletePrivilegeUserRecords(document.frmPrivilegeUsers, 'privilege_user_delete', '<?php echo $users_master_values["id"]; ?>');"><img src="images/delete.gif" width="15" height="15" alt="Delete" border="0"></a></td>
                    </tr><?php                
                    $user_master_counter++;
                }
            }
            ?>

            </table></form>
            
			<?php
        } else {
		
            print "<center><span style='color:#000000;'><b>NO USERS FOUND IN THIS SELECTED ROLEM</b></span></center>";
        }
    } else {
        print "<center><span style='color:#000000;'><b>SELECT ROLE TO VIEW USER LIST</b></span></center>";
    }
} else {
       
     
    print "<center><span style='color:#000000;'><b>NO ROLES FOUND! PLEASE ADD ROLE</b></span></center>";
}

require_once('mysql_close.php');
?>