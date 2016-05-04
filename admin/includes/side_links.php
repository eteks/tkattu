    <link rel="stylesheet" type="text/css" href="js/sdmenu/sdmenu.css" />
    <script type="text/javascript" src="js/sdmenu/sdmenu.js">
        /***********************************************
        * Slashdot Menu script- By DimX
        * Submitted to Dynamic Drive DHTML code library: http://www.dynamicdrive.com
        * Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
        ***********************************************/
    </script>
    <script type="text/javascript">
    // <![CDATA[
    //var myMenu;
   // window.onload = function() {
        ///myMenu = new SDMenu("my_menu");
        //myMenu.init();
		//var firstSubmenu = myMenu.submenus[0];
		//myMenu.expandMenu();
		//myMenu.toggleMenu(firstSubmenu);
		//myMenu.toggleMenu();
       // myMenu.expandAll()
       // myMenu.collapseAll();
    var myMenu;
    window.onload = function() {
        myMenu = new SDMenu("my_menu");
        myMenu.init();
		myMenu.collapseAll()
    };
   // };
    // ]]>
    </script>
 <div style="float:center" id="my_menu" class="sdmenu">
    <div>
        <span>Manage Privilege</span>
			<a href="<? echo href_link(FILENAME_PRIVILEGE_ROLES)?>" id="a1">Privilege Roles</a>
			<a href="<? echo href_link(FILENAME_PRIVILEGE_USERS)?>" id="a1">Privilege Users</a>
			<!-- <a href="<? echo href_link(FILENAME_PRIVILEGE_EVENTS)?>" id="a1">Privilege Events</a>  
			<a href="<? echo href_link(FILENAME_PRIVILEGE_MODULES)?>" id="a1">Privilege Modules</a>-->
    </div>
 <?php /*?> <div>
        <span>Manage Hotel Info</span>
       <a href="<? echo href_link(FILENAME_HOTEL_INFO)?>" id="a1">Hotel Info</a> 
    </div><?php */?>
<div>
        <span>Manage Hotel Info</span>
        <?php /*><a href="<? echo href_link(FILENAME_OCCASION_INFO)?>" id="a1">Occasion Entry</a>
        <a href="<? echo href_link(FILENAME_FACILITY_ENTRY)?>" id="a1">Facilities Entry</a>
       <!-- <a href="<? echo href_link(FILENAME_SERVICES_ENTRY)?>" id="a1">Services Entry</a>--><?php */?>
        <a href="<? echo href_link(FILENAME_PARAMETER_INFO)?>" id="a1">Paramater Setting</a>
    </div><div>
        <span>Infrastructure Info </span>
        <?php /*?><a href="<? echo href_link(FILENAME_FLOOR_CREATION)?>" id="a1">Floor Creation</a>
        <a href="<? echo href_link(FILENAME_DEPARTMENT_CREATION)?>" id="a1">Department Creation</a>
        <a href="<? echo href_link(FILENAME_DESIGNATION)?>" id="a1"> Designation</a>	
        <a href="<? echo href_link(FILENAME_ROOM_TYPE)?>" id="a1">Room Type Creation</a>
        <a href="<? echo href_link(FILENAME_ROOM)?>" id="a1">Room Creation</a><?php */?>
        <a href="<? echo href_link(FILENAME_TABLE_TYPE)?>" id="a1">Table Type Creation</a>
        <a href="<? echo href_link(FILENAME_TABLE_ENTRY)?>" id="a1">Table Entry</a>
        <a href="<? echo href_link(FILENAME_SUPPLIER)?>" >Supplier Creation</a>
        <a href="<? echo href_link(FILENAME_SUPPLIER_MAP)?>" >Supplier Mapping</a>
      <?php /*?>  <a href="<? echo href_link(FILENAME_BEDDETAILS)?>" id="a1">Extra Bed Detail</a><?php */?>
    </div>
    <div>
        <span>Manage Menu Card</span>
       <a href="<? echo href_link(FILENAME_MENU_CATEGORY)?>" id="a1">Menu Category</a> 
		 <!-- <a href="Menu_sub_category.php?m=k" id="a1">Menu Sub Category</a>-->
        <a href="<? echo href_link(FILENAME_MENU_ENTRY)?>" id="a1">Menu Entry</a>
        <a href="<? echo href_link(FILENAME_MENU_STOCK_ENTRY)?>" id="a1">Menu Stock Entry</a>
        <a href="Menu_Card.php?action=menu_card_add" id="a1">Menu Card Creation</a>
        <!-- <a href="<? echo href_link(FILENAME_DEPT_MAP)?>" id="a1">Department Mapping</a>-->
    </div>
    <div>
        <span>Manage Inventory</span>
        <a href="<? echo href_link(FILENAME_UNIT_ENTRY)?>" id="a1">Unit Entry</a>
        <a href="<? echo href_link(FILENAME_ITEM_TYPE)?>" id="a1">Item Type Info</a>
        <a href="<? echo href_link(FILENAME_ITEM_ENTRY)?>" id="a1">Item Entry</a>
        <a href="<? echo href_link(FILENAME_VENDOR_CREATION)?>" id="a1">Vendor Creation</a>
    </div>
     <?php /*?><div>
        <span>Manage Finance</span>
  <a href="<? echo href_link(FILENAME_PAYMENT)?>" id="a1">Payment Mode</a>
		<a href="<? echo href_link(FILENAME_TAX_SCHEME)?>" id="a1">Tax Scheme Entry</a>
        <a href="<? echo href_link(FILENAME_TAX_INFO)?>" id="a1">Tax Info</a>
    </div><?php */?>
   <?php /*?> <div>
        <span>Manage CheckOut</span>
        <a href="<? echo href_link(FILENAME_CHECKOUT)?>" id="a1">CheckOutTime</a>
    </div><?php */?>
    <div>
        <span>Privilege User</span>
		<a href="<? echo href_link(FILENAME_HMS_PRIVILEGE_ROLES)?>" id="a1">Privilege User Roles</a>
			<a href="<? echo href_link(FILENAME_HMS_PRIVILEGE_USERS)?>" id="a1">Privilege Users Side</a>
			<!-- <a href="<? echo href_link(FILENAME_HMS_PRIVILEGE_EVENTS)?>" id="a1">Privilege User Events</a>
	<a href="<? echo href_link(FILENAME_HMS_PRIVILEGE_MODULES)?>" id="a1">Privilege User Modules</a>-->
    </div>
   <?php /*?> <div>
        <span>Manage Reports</span>
			<a href="<? echo href_link(FILENAME_REPORT_ROOMS)?>" id="a1">Room Report</a>
			<a href="<? echo href_link(FILENAME_REPORT_RESTAURANT)?>" id="a1">Restaurant Report</a>
			<a href="<? echo href_link(FILENAME_REPORT_BAR)?>" id="a1">Bar Report</a>
            <a href="<? echo href_link(FILENAME_REPORT_SERVICE)?>" id="a1">Services Report</a>
			<!--<a href="" id="a1">Inventory Report</a>-->
			<!--<a href="" id="a1">Financial Report</a>-->
    </div><?php */?>
    
   <?php /*?> <div>
        <span>Manage House Keeping</span>
			<a href="user_creation.php" id="a1">User Creation</a>
			<a href="cloth_category.php?m=k" id="a1">Cloth Category</a> 
			<a href="colth_create.php?m=k" id="a1">Cloth Create</a>
			<a href="cloth_company_create.php" id="a1">Cloth Companys</a>
    </div><?php */?>
    
    <div>
        <span>Change Password</span>
        <a href="<? echo href_link(FILENAME_CHANGE_PROFILE)?>">Change Password</a>
    </div> 
</div>