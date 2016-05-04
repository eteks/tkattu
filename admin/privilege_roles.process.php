<?php
require_once ("includes/application_top.php");
checklogin();

$privilegeRolseClass = new privilegeRolesClass;
$_GET['action']= (isset($_GET['action']) && !empty($_GET['action']) ? $_GET['action']:"" );
switch ($_GET["action"]) {
    case "privilege_roles_insert":
        echo $returnValue = $privilegeRolseClass->adminRoleCheckDuplicate($_GET["role_name"], $_GET["role_parent_id"]);
    break;
    case "privilege_roles_update":
        echo $returnValue = $privilegeRolseClass->privilegeRolesUpdate($_GET["role_name"], $_GET["role_parent_id"], $_GET["id"]);
    break;
    case "admin_role_child_names":
          print $privilegeRolseClass->get_parent_module_checkboxes($_GET["child_id"], '', $_GET["role_edit_id"]);
    break;
    case "adminrole_generate_sort_order_values":
        $adminrole_sort_order = $privilegeRolseClass->adminroleGenerateSortOrderValues($_GET["parent_id"]);
        if (db_num_rows ($adminrole_sort_order) > 0) {
            $adminrole_mst_max_sort_order_values = db_fetch_array($adminrole_sort_order);
            if (not_null($adminrole_mst_max_sort_order_values['sort_order'])) {
                print $adminrole_mst_max_sort_order_values['sort_order'];
            } else {
                print "0";
            }
        } else {
            echo "0";
        }
    break;
    default:
        $_GET['action']= (isset($_GET['action']) && !empty($_GET['action']) ? $_GET['action']:"" );
        switch ($_GET['action']) {
        case "admin_role_update_active":
              $privilegeRolseClass->adminRoleUpdateActive($_GET["value"], $_GET["id"], $_GET["parentid"]);
        break;
        case "admin_role_update_sort_order":
             $privilegeRolseClass->adminRoleUpdateSortOrder($_GET["id"], $_GET["parentid"], $_GET["value"]);
        break;
        }

        $parentid = not_null($_GET["parentid"])?$_GET["parentid"]:0;

        $adminrole_mst = $privilegeRolseClass->adminroleMstSql($parentid);

        if (db_num_rows($adminrole_mst) > 0)  {
        ?>
           <form name="frmAdminPrivilegeRole" method="get" >
            <input type="hidden" name="action">
            <input type="hidden" name="id"><input type="hidden" name="parentid">
            <table width="100%" border="0" cellspacing="0" cellpadding="2" align="center">
            <tr><td></td></tr>
			<tr>

					  <td style="padding-left:6px" height="30" class="heading_light_blue"><img src="images/arrow_heading.gif" />&nbsp;<?php echo TITLE_MANAGE_PRIVILEGE_ROLES;?></td>
					  <td align="left"></td>
			</tr>
			</table><p></p>
            <?php
            if ($parentid!=0) {
                ?>
            <table width="100%" border="0" cellspacing="0" cellpadding="2" align="center">

			  <tr>
                  <td colspan="2" class="tahoma11blacknormal" style="text-align:right;"><img src="images/arrow-l.gif" width="16" height="16" border="0" align="absmiddle">&nbsp;<a href="<? print FILENAME_PRIVILEGE_ROLES."?parentid=".$privilegeRolseClass->getPreviousParentId($parentid);?>">Back to Roles list</a></td>
              </tr>
            </table>
            <?php
            }
            ?>
            <table width="100%" border="0" cellspacing="0" cellpadding="2" align="center" class="ntab">
              <tr>
                <th style="padding-left:10px;text-align:center;" ><?php
                    if ($parentid!=0) {
                        ?>Sub Admin Role Name<?php
                    } else {
                        ?>Admin Role Name<?
                    }
                    ?>
                </th>
                <th style="text-align:center">Created Date</th>
                <th style="text-align:center">Last Modified Date</th>
                <th width="1%" style="text-align:center">Active</th>
                <th width="10%" style="text-align:center">Move</th>
                <th colspan="3" style="text-align:center">Action</th>
              </tr><?php
            $adminrole_mst_counter = 1;
            while ($adminrole_mst_values = db_fetch_array($adminrole_mst)) {
                $bgcolor = (($adminrole_mst_counter % 2 == 0) ? FIRSTROWCOLOR : SECONDROWCOLOR);
            ?>
            <tr>
               <td class="tahoma11blacknormal" bgcolor="<? echo $bgcolor ?>" style="padding-left:10px;text-align:center;"><? echo $adminrole_mst_values["name"]; ?></td>
                <td class="tahoma11blacknormal" bgcolor="<? echo $bgcolor ?>" style="padding-left:10px;text-align:center;"><?php echo date_long( $adminrole_mst_values["date_added"] ); ?></td>
               <td style="padding-left:10px;text-align:center;"><?php echo date_long( $adminrole_mst_values["date_modified"] ); ?></td>
               <td class="tahoma11blacknormal" bgcolor="<? echo $bgcolor ?>" style="padding-left:10px;text-align:center;"><a href="javascript:populate_admin_role_records('<? echo $adminrole_mst_values["id"] ?>', 'admin_role_update_active', '<? echo (($adminrole_mst_values["active"] == "Y") ? "N" : "Y"); ?>', <?php   print $adminrole_mst_values["parent_id"];?>);"><img src="images/<? echo $adminrole_mst_values["active"]; ?>.gif" width="16" height="16" border="0" <?php if(isset($$eventcat_mst_values) && !empty($$eventcat_mst_values)) if ($eventcat_mst_values["active"]=='Y'){print "title='Click to disable'";} else {print "title='Click to enable'";}?>></a></td>
               <td class="tahoma11blacknormal" bgcolor="<? echo $bgcolor ?>" style="text-align:center"><? echo ((db_num_rows($adminrole_mst) > 1) ? (($adminrole_mst_counter == 1) ? '<a href="javascript:populate_admin_role_records(\'' .  $adminrole_mst_values["id"] . '\', \'admin_role_update_sort_order\', \'d\','.$adminrole_mst_values["parent_id"].');"><img src="images/arrow-d.gif" width="16" height="16" border="0" title="Click to move down"></a>' : (($adminrole_mst_counter == db_num_rows($adminrole_mst)) ? '<a href="javascript:populate_admin_role_records(\'' .  $adminrole_mst_values["id"] . '\', \'admin_role_update_sort_order\', \'u\','.$adminrole_mst_values["parent_id"].');"><img src="images/arrow-u.gif" width="16" height="16" border="0" title="Click to move up"></a>' : '<a href="javascript:populate_admin_role_records( \'' .  $adminrole_mst_values["id"] . '\', \'admin_role_update_sort_order\', \'u\','.$adminrole_mst_values["parent_id"].');"><img src="images/arrow-u.gif" width="16" height="16" border="0" title="Click to move up"></a>&nbsp;<a href="javascript:populate_admin_role_records( \'' .  $adminrole_mst_values["id"] . '\', \'admin_role_update_sort_order\', \'d\','.$adminrole_mst_values["parent_id"].');"><img src="images/arrow-d.gif" width="16" height="16" border="0" title="Click to move down"></a>' )) : "&nbsp;"); ?></td>
               <td class="tahoma11blacknormal" bgcolor="<? echo $bgcolor ?>" style="text-align:center"><?php if ($privilegeRolseClass->getAdminRoleMasterParentValue($adminrole_mst_values["id"])==1) {?><a href="<?php echo href_link(FILENAME_PRIVILEGE_ROLES, 'parentid='.$adminrole_mst_values["id"]); ?>"><img src=<?print DIR_WS_IMAGES.'cam.gif';?> width="15" height="15" alt="View" border="0" title="Click to view details"></a><?php } else {?> <img src=<?print DIR_WS_IMAGES.'nocam.gif';?> width="15" height="15" alt="View" border="0"><?php }?></td>
               <td style="text-align:center"><a href="<? echo href_link(FILENAME_PRIVILEGE_ROLES, 'id=' . $adminrole_mst_values["id"] . '&action=privilege_roles_edit&parentid='.$adminrole_mst_values["parent_id"]) ?>"><img src="images/edit.gif" width="15" height="15" alt="Edit" border="0" title="Click to edit"></a></td>
               <td class="tahoma11blacknormal" bgcolor="<? echo $bgcolor ?>" style="text-align:center"><a href="javascript:deletefrmAdminPrivilegeRoleRecord(document.frmAdminPrivilegeRole, 'privilege_roles_delete', '<? echo $adminrole_mst_values["id"] ?>',<? echo $parentid;?>)"><img src="images/delete.gif" width="15" height="15" alt="Delete" border="0" title="Click to delete"></a></td>
           </tr>
           <?php
                $adminrole_mst_counter++;
            }
            ?>
            </table></form><?php
        } else {
            print "<br/><CENTER><span class=\"normaltext\"><b>NO ROLES FOUND</b></span><CENTER>";
        }
    }
require_once('mysql_close.php');
?>