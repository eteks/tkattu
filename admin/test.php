<?php
var editstatus = $("#editstatus").val(); + '&editstatus=' + editstatus ;

classchk chksno chkparcel pchk
var cart_id =$("#order_cart_id").val(); 

+'&cart_id='+cart_id

SELECT sum(total_amount),status,bill_status,min(bill_id),max(bill_id),account_session FROM hms_restaurant_account_details a WHERE orde_close_date =CURDATE() group by a.status,bill_status,account_session

$action_pos = (isset($_POST["action"]) && !empty($_POST["action"]) ? $_POST["action"]:"");
$action_get = (isset($_GET["action"]) && !empty($_GET["action"]) ? $_GET["action"]:"");
$action = (isset($action_pos) && !empty($action_pos) ? $action_pos : $action_get);

$page = (isset($_POST["page"]) && !empty($_POST["page"]) ? $_POST["page"] : "");
$page_get = (isset($_GET["page"]) && !empty($_GET["page"]) ? $_GET["page"] : "");

$action = (isset($_REQUEST["action"]) && !empty($_REQUEST["action"]) ? $_REQUEST["action"]:"");

(isset() && empty() ? :"");
(!empty() ? :"");
itemcancel=0 AND
var tableid  = $('.gettableid:checked').map(function() {return this.value;}).get().join(',');
            var chairs   = $('.chairs:checked').map(function() {return this.value;}).get().join(',');
        
        print_bill('<?php echo $tabelid; ?>','<?php echo $cardid; ?>','<?php echo $bill; ?>');close_bill('close_cancel','<?php echo $save_bill['account_card_id']; ?>','<?php echo $tabelid; ?>')
        
64,65,66,67,68,73,74,75,76,84,85,89,95,96
hms_admin_mst
hms_admin_modules_mst_to_admin_role_mst
hms_admin_modules_mst_to_admin_mstr
    background:url('images/categoryimg/4.png') no-repeat;
                Do you want to take Print of this Receipt

truncate hms_payment_mode;

update `hms_menu_entry` set `menu_deduct`=0;

update hms_bill_id set bill_id=100001 ;
TRUNCATE hms_order_qty_flow;
truncate hms_restaurant_order_details;
truncate hms_restaurant_account_details;
truncate hms_payment_detail;
truncate hms_credit_payment_detail;
truncate hms_table_details;
truncate hms_restaurant_order_session;

truncate hms_menu_card_selection;
truncate hms_menu_card;
truncate hms_table_entry;
truncate hms_table_type_creation;
truncate hms_supplier_creation;
truncate hms_supplier_mapping;



truncate hms_menu_category;
truncate hms_menu_sub_category;
truncate hms_menu_entry;


CREATE TABLE IF NOT EXISTS `hms_supplier_creation` (
`supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(250) NOT NULL,
  `active` enum('Y','N') NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
    
    CREATE TABLE IF NOT EXISTS `hms_supplier_mapping` (
`suppliermap_id` int(11) NOT NULL,
  `table_type_id` int(11) NOT NULL,
  `table_no_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
    
    
    CREATE TABLE IF NOT EXISTS `hms_department_mapping` (
  `depart_map_id` int(11) NOT NULL,          
  `depart_id` int(11) NOT NULL,
  `depart_cate_id` int(11) NOT NULL,
  `depart_item_id` int(11) NOT NULL,
  `active` enum('Y','N') NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
    
    //deduct
  if($menudetail_data['menu_qty_status']==1) 
  {
    $qty_org = $menudetail_data['menu_quantity']; 
    $qty_ded = $menudetail_data['menu_deduct'];
    db_query()  
  }
    
   	http://dnd.blackholesolution.com/api/sendmsg.php?user=VALLIK&pass=abcd1234&sender=VALLIK&phone=8940400932&text=Test SMS&priority=dnd&stype=normal
  
            
            http://192.168.1.141/hoteldevi_testing/

Cashier
UN: atomicka-c
PW:atomicka

Parcel
UN: atomicka-p
PW:atomicka

Juice
UN:atomicka-j
PW:atomicka

http://192.168.1.141/hoteldevi_testing/admin/login.php

UN: admin
PW: admin

INSERT INTO `admin_modules_mst_to_admin_mst` (`admin_modules_mst_id`, `admin_mst_id`) VALUES
(63, 22),
(1, 22),
(2, 22),
(3, 22),
(91, 22),
(64, 22),
(68, 22),
(66, 22),
(67, 22),
(65, 22),
(73, 22),
(74, 22),
(75, 22),
(76, 22),
(77, 22),
(78, 22),
(69, 22),
(70, 22),
(71, 22),
(72, 22),
(79, 22),
(80, 22),
(81, 22),
(82, 22),
(83, 22),
(85, 22),
(86, 22),
(87, 22),
(88, 22),
(89, 22),
(90, 22),
(92, 22),
(93, 22),
(94, 22),
(95, 22);    
        
        
         CREATE VIEW hms_menu_stock AS SELECT mse_menu_id, sum(`mse_qty`) as mse_qty FROM `hms_menu_stock_entry` group by `mse_menu_id` ;
 //deduct   
CREATE VIEW hms_stock_mt AS SELECT mse_menu_id,mse_qty,sum(order_quantity),mse_qty-sum(order_quantity) as in_stock FROM  hms_menu_stock b  LEFT JOIN hms_restaurant_order_details a  ON b.mse_menu_id=a.menuid WHERE itemcancel=0 group by menuid;

hms_menu_category
hms_menu_entry
hms_menu_stock_entry

used tables

admin_modules_mst
admin_modules_mst_to_admin_mst
admin_modules_mst_to_admin_role_mst
admin_mst
admin_role_mst
hms_admin_modules_mst
admin_modules_mst_to_admin_mst
hms_admin_modules_mst_to_admin_role_mst
hms_admin_mst
hms_admin_role_mst
hms_credit_payment_detail
hms_entry_type
hms_item_type
hms_menu_card
hms_menu_card_selection
hms_menu_category
hms_menu_entry
hms_menu_stock_entry
hms_menu_sub_category
hms_order_qty_flow
hms_parameter_entry
hms_payment_detail  
hms_purchase_order_detail
hms_purchase_order_id
hms_restaurant_account_details
hms_restaurant_order_details
hms_stock_balance_detail
hms_supplier_creation
hms_supplier_mapping
hms_table_entry
hms_table_type_creation
hms_unit_entry
hms_vendor_creation


truncate table

Truncate hms_credit_payment_detail;
Truncate hms_entry_type;
Truncate hms_item_type;
Truncate hms_menu_card;
Truncate hms_menu_card_selection;
Truncate hms_menu_category;
Truncate hms_menu_entry;
Truncate hms_menu_stock_entry;
Truncate hms_menu_sub_category;
Truncate hms_order_qty_flow;
Truncate hms_parameter_entry;
Truncate hms_payment_detail; 

Truncate hms_purchase_order_id;
Truncate hms_restaurant_account_details;
Truncate hms_restaurant_order_details;

Truncate hms_supplier_creation;
Truncate hms_supplier_mapping;
Truncate hms_table_entry;
Truncate hms_table_type_creation;
Truncate hms_unit_entry;
Truncate hms_vendor_creation;

    Truncate hms_purchase_order_detail;
    Truncate hms_stock_balance_detail;

Truncate hms_entry_type;
Truncate hms_purchase_order_detail;
Truncate hms_purchase_order_id;
Truncate hms_stock_balance_detail;

1)Manage Inventory  >>	Item entry	  >>	In modify process, the data not fetched in the field of 'Item Type' and 'unit'
2)Restaurant  >>	Restaurant order entry  >>	While in Cancel bill, the items count not updating in the re- order
3)Restaurant  >>	Restaurant order entry  >>	The label 'Quantity' should not be updated according to the last entered quantity count
4)Manage Menu Card  >>		Menu Stock Entry  >>		In that 'edit' option feature was not available
5)Inventory  >>	Stock Information  >>	It should not allow the label ' Available Quantity' as editable.
6)Inventory   >>	Purchase Entry  >>	"Once the item added from one vendor, it shouldnt allow the another vendor to save in a single date, (i.e)
Each vendor item must save as a seperate data in the grid table"
7)Report  >>	Stock/Purchase Report  >>	Show the details of 'Unit Quantity' column

        
        http://192.168.1.141/hoteldevi_testing/

cashier
UN:atomicka-c
PW:atomicka

parcel
UN:atomicka-p
PW:atomicka

juicer
UN:atomicka-j
PW:atomicka

http://192.168.1.141/hoteldevi_testing/admin

savemenulistres
    
     var accountsession = $('input[name="accountsession"]:checked').val();
UN:admin
PW:admin

    
    
    
    <td colspan="6" align="left" height="30">
        <table cellpaddin="0" cellspacing="0" border="0" width="850">
            <tr>
                <td><?php if(!empty($tabel) && $tabel!=0) echo 'Supplier : '.getsuppliername($dbsuppliers) ;?></td>
                <td><?php echo date("dS  M  Y h:i A"); ?></td>
                <td>Bill No.:<?php echo $bill; ?></td>
                <td><?php if(!empty($tabel) && $tabel!=0){ ?>
                Table NO:<?php echo gettablenamemul($tabel);  ?>			
                <?php } ?></td>
            </tr>
        </table>
    </td>    
    
    
    //session code
 
 $('#breakfast').on('click',function(){
     $.ajax({
          type:'POST',  
          url:'checking.php', 
          data:'action=sessionchk&session=B',
          success: function(data){    
                   if(data=='1')
                   {
                   alert("Breakfast Session Closed");
                   $('#breakfast').prop('checked',false);
                   }
                   
           }
           });
     
 });
            
$('#lunch').on('click',function(){
     $.ajax({
          type:'POST',  
          url:'checking.php', 
          data:'action=sessionchk&session=L',
          success: function(data){    
                   if(data=='1')
                   {
                   alert("Lunch Session Closed");
                   $('#lunch').prop('checked',false);
                   }
                   
           }
           });
     
 });            
            
 $('#snacks').on('click',function(){
     $.ajax({
          type:'POST',  
          url:'checking.php', 
          data:'action=sessionchk&session=S',
          success: function(data){    
                   if(data=='1')
                   {
                   alert("Snacks Session Closed");
                   $('#snacks').prop('checked',false);
                   }
                   
           }
           });
     
 }); 
 
  $('#dinner').on('click',function(){
     $.ajax({
          type:'POST',  
          url:'checking.php', 
          data:'action=sessionchk&session=D',
          success: function(data){    
                   if(data=='1')
                   {
                   alert("dinner Session Closed");
                   $('#dinner').prop('checked',false);
                   }
                   
           }
           });
     
 }); 
    
 if($(".accsession:checkbox:checked").length == 0)
{
    $("#error_service").show();
    $("#error_service").html("Please Select Session");
    $("#breakfast").focus();
    return false;  
}

 if($("#ordertype").val()=='dine')
 {
 if($("#tableid").val()=="")
   {
    $("#error_service").show();
    $("#error_service").html("Please Select the Table");
    $("#tableid").focus();
    return false;
   }
 else if($("#suppliers").val()=="")
   {
    $("#error_service").show();
    $("#error_service").html("Please Select the Supplier");
    $("#suppliers").focus();
    return false;
   }
   else if($("#noofpersons").val()=="")
   {
    $("#error_service").show();
    $("#error_service").html("Please Enter the No. of Persons");
    $("#noofpersons").focus(); 
    return false;
   }
 }
 
 
 
 
 <tr><td height="15"></td></tr>               
<tr id="showtabel" >
<td width="1%" height="22">&nbsp;</td>
<td width="14%" class="verdanablack">Table Number:</td>
<td colspan="3" align="left">
    <select name='tableid[]' id='tableid' class="selectinput" style="height:100px;" multiple="multiple">
<!-- <?php if($tableid!=""){ ?> disabled="disabled"<?php }?>--> 

<?php  while ($roomTreeresultSet = db_fetch_array($tabletree)) {?>
<option value='<?php echo $roomTreeresultSet['table_entry_id']; ?>' <?php if(in_array($roomTreeresultSet['table_entry_id'],$chktableid)) { ?> selected="selected" <?php } ?> > 
<?php echo $roomTreeresultSet['table_no']; ?></option> 
<?php } ?>
</select>			
</td> 
</tr>	
 <tr><td height="15"></td></tr>
 
 
 
    
    	Restaurant	Restaurant Order	"Process 1 :
Generate the ""Bill No"" only when the process undergone 'save and print' options, And do not display bill no, while saving the record. Show 'Bill no' only on the printed bill."		Completed	24/02/16	24/02/16	2 Hrs	1 Hr 30 mins
2	Restaurant	Restaurant Order	While in 'Cancel Bill' option, get the comments/reason for cancelling the bill, and Display the comments at the bottom of the cancelled Bill.		Completed	24/02/16	24/02/16	