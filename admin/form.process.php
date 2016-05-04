<?php
require_once ("includes/application_top.php");

$tableno = (isset($_REQUEST['tableno']) && !empty($_REQUEST['tableno']) ? $_REQUEST['tableno']:"");
$cate = (isset($_REQUEST['cate']) && !empty($_REQUEST['cate']) ? $_REQUEST['cate']:"");
$action = (isset($_REQUEST['action']) && !empty($_REQUEST['action']) ? $_REQUEST['action']:"");
if($action=='tableno' && !empty($tableno))
{
  $select = db_query("SELECT `table_entry_id`,`table_no`  FROM " . TABLE_HMS_TABLE_ENTRY . " WHERE active=1 AND table_type_id='".$tableno."' ORDER BY `date_added`");
    if(db_num_rows($select)>0)
           echo '<option value="">--Select Table--</option>';
        while($fetch = db_fetch_array($select))
            echo "<option value='".$fetch['table_entry_id']."'>".$fetch['table_no']."</option>";  
}
if($action=='menu' && !empty($cate))
{
  $select = db_query("SELECT `menu_id`,`menu_name`,`active` FROM " .TABLE_HMS_MENUENTRY . " WHERE menu_category_id='".$cate."' ORDER BY menu_id DESC");
    if(db_num_rows($select)>0)
    {
           echo '<option value="">--Select Menu--</option>';
        while($fetch = db_fetch_array($select))
            echo "<option value='".$fetch['menu_id']."'>".$fetch['menu_name']."</option>";
    }
        
}


?>