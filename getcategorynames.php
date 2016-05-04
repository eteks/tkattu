<?php
        session_start();
	require_once ("includes/application_top.php");
	

      
if( isset( $_REQUEST['keyword'] ) )
	{
		
	
		$keyword		=		$_REQUEST['keyword'];
		$query			=		"SELECT * FROM hms_menu_category WHERE hms_menu_category_name LIKE '$keyword%' ";
		$result			=		db_query($query);
		$html			=		"";
		$count = mysql_num_rows($result); 
		 if($count>0){ 
		while ( $row = db_fetch_array($result) ) 
		{
                       $select = db_query("SELECT in_stock FROM hms_stock_mt WHERE in_stock=0 AND mse_menu_id='".$row['menu_id']."'");
                        if(db_num_rows($select)==0)
			$html	.='<option class="notefy" id="'.$row['hms_menu_category_id'].'" >'.$row['hms_menu_category_name'].'</option	>';
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


