<?php
        session_start();
	require_once ("includes/application_top.php");
	
        $category=(isset($_REQUEST['category']) && !empty($_REQUEST['category']) ? trim($_REQUEST['category']):"");
        if(isset($_SESSION["admin_role_mst_id"]) && !empty($_SESSION["admin_role_mst_id"]) && $_SESSION["admin_role_mst_id"]=='2')
            $wherecon = " AND depart_id=2";
	if(!empty($category) && $category!=undefined)
            $wherecon2 = " AND menu_category_id IN ($category)";
        
if( isset($_REQUEST['keyword']))
	{
				
		$keyword		=		$_REQUEST['keyword'];
		$query			=		"SELECT * FROM ".TABLE_HMS_MENUENTRY." a LEFT JOIN ".TABLE_HMS_MENUCATEGORY_CREATION." b ON hms_menu_category_id=menu_category_id WHERE menu_name LIKE '$keyword%' AND a.active='Y' AND Item_available_status='1' $wherecon2 $wherecon";
		$result			=		db_query($query);
		$html			=		"";
		$count = mysql_num_rows($result); 
		 if($count>0){ 
		while ( $row	=		db_fetch_array($result) ) 
		{
                     $select = db_query("SELECT in_stock FROM hms_stock_mt WHERE in_stock=0 AND mse_menu_id='".$row['menu_id']."'");
                        if(db_num_rows($select)==0)
                            $html .='<option class="notefy" id="'.$row['menu_id'].'">'.$row['menu_name'].'</option>';    
                       
			
        }
				
	echo $html;
	}
	else{
	$data="No Data Founded";
	$html	.='<li>'.$data.'</li>';
	echo $html;
	}
}

?>
