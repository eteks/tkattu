function getRestaurantOrder() {

    if ($("#opsubmit").val() == 1) {
        alert("Please Submit the Purchase Order");
        return false;
    } else {
        $.ajax({
            type: 'POST',
            url: 'restaurantOrderEntry.php',
            data: '',
            success: function(result) {
                $("#divmiddlecontent").html(result);
                $("#bill_row").hide();
            }
        });
    }
}


function getNewRestaurantOrder() {

    $.ajax({
        type: 'POST',
        url: 'restaurantOrderEntry.php',
        data: '',
        success: function(result) {
            $("#divmiddlecontent").html(result);
            $("#bill_row").hide();
        }
    });

}

function getCustomerIdres(roomid, action) {

    var tableid = document.getElementById("tableid").value;
    var MenuCardid = document.getElementById("MenuCardid").value;
    var ddDateFrom = document.getElementById("ddDateFrom").value;

    var rid = trim(roomid);
    var pars = 'tableid=' + tableid + '&action=' + action + '&roomid=' + rid + '&ddDateFrom=' + ddDateFrom + '&MenuCardid=' + MenuCardid;
    var url = 'restaurantOrderEntry.php';
    var myAjax = new Ajax.Updater({
            success: 'divmiddlecontent'
        },
        url, {
            method: 'post',
            evalScripts: true,
            parameters: pars,
            oncomplete: function(req) {}
        });

}

function getMenuCardres(MenuCardid, action) {

    var tableid = document.getElementById("tableid").value;
    var customerId = document.getElementById("customerId").value;
    document.getElementById('div').style.display = 'block';
    var pars = 'tableid=' + tableid + '&action=' + action + '&customerId=' + customerId + '&MenuCardid=' + MenuCardid;
    var url = 'restaurantOrder.process.php';
    var myAjax = new Ajax.Updater({
            success: 'div'
        },
        url, {
            method: 'post',
            evalScripts: true,
            parameters: pars,
            oncomplete: function(req) {}
        });

}

function calculaterestp(id) {

    var i, j = 0,
        totvalshow = 0;
    var discountvalue = 0,
        orderTotal = 0,
        discount = 0,
        tax = 0;

    var qty_req = document.getElementById('items_qty_' + id).value;
    var tot_price_avg = document.getElementById('items_price_' + id).value;
    var tot_at_cal = document.getElementById('valueofi').value;

    var multidata;

    multidata = qty_req * tot_price_avg;

    document.getElementById('items_ttl_' + id).value = multidata;

    for (i = 1; i < tot_at_cal; i++) {
        totvalshow += document.getElementById('items_qty_' + i).value * document.getElementById('items_price_' + i).value;
    }


    document.getElementById('subtotal2').value = totvalshow;
    document.getElementById('order_total2').value = totvalshow;

}




/********************************* res calc total price ***************/
/*


function fnadd(discountvalue,tax) {
//alert(discountvalue);	
//alert(tax);	

  var total =discountvalue+tax;
  
	return total;
}

*/
/********************************* res calc total price ***************/


/*function getTaxScheme( id,id2,subtotal ) {

alert(subtotal);
        var pars = 'taxschemeid=' + id +'&subtotal=' + subtotal;
        var url  = 'taxscheme.php';
        var myAjax = new Ajax.Updater(
        { success: 'taxdiv' },
        url, {
            method: 'post',
            evalScripts: true,
            parameters: pars,
            oncomplete : function (req) {
            }
        });
}
*/




function getTaxSchemeres1(id, id2, subtotal, dis) {
    //alert(price);

    getXMLHttpRequest();
    var ran_unrounded = Math.random() * 100000;
    var ran_number = Math.floor(ran_unrounded);
    var str = "module=category&op=GetPosition&r=" + ran_number + "&";
    str += "taxschemeid=" + id + "&subtotal=" + subtotal + "&dis=" + dis
        //	alert(str);
    var url = "taxscheme1.php";

    xmlhttp.open("POST", url, true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
    xmlhttp.send(str);
    xmlhttp.onreadystatechange = getTaxSchemesresult

}


function getTaxSchemeres(id, id2, subtotal, dis) {
    //alert(price);

    getXMLHttpRequest();
    var ran_unrounded = Math.random() * 100000;
    var ran_number = Math.floor(ran_unrounded);
    var str = "module=category&op=GetPosition&r=" + ran_number + "&";
    str += "taxschemeid=" + id + "&subtotal=" + subtotal + "&dis=" + dis
        //	alert(str);
    var url = "taxscheme.php";
    // calcultotalresamounttax();	  
    xmlhttp.open("POST", url, true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
    xmlhttp.send(str);
    xmlhttp.onreadystatechange = getTaxSchemesresult

}

function getTaxSchemesresult() {
    if (xmlhttp.readyState == 4) {
        var response = xmlhttp.responseText;
        //	alert(response);
        if (response != "") {
            var mySplitResult = response.split("#");
            //  alert(mySplitResult[1]);
            document.getElementById("taxdiv").innerHTML = mySplitResult[0];
            document.getElementById("order_total2").value = mySplitResult[1];

        }
    }
}

function getTotalAmout() {

    var subtotal = document.getElementById('subtotal2').value;
    var discount = document.getElementById('discount2').value;
    var tax = document.getElementById('tax2').value;
    var totalAmount;
    totalAmount = subtotal + discount + tax;
    document.getElementById('order_total2').value = totalAmount;
}


function calcultotalresamount() {

    //alert("hi");
    //alert(id);
    var subvalue = 0,
        discount = 0,
        tax = 0,
        totalAmount = 0,
        discount1 = 0;

    var subvalue = document.getElementById('subtotal2').value;
    var discount = document.getElementById('discount2').value;
    var discount1 = subvalue - (subvalue * (discount / 100));
    totalAmount = parseInt(discount1);

    document.getElementById('order_total2').value = totalAmount;

}

function calcultotalresamounttax() {

    var total = 0,
        discount = 0,
        tax = 0,
        totalAmount = 0,
        discount1 = 0;
    var discount_total = document.getElementById('order_total2').value;
    if (document.getElementById('tax2').value != "" || document.getElementById('tax2').value != "undefined") {
        var tax = document.getElementById('tax2').value;
        var tax1 = discount_total * tax / 100;
        total = parseInt(discount_total) + parseInt(tax1);

    }
    document.getElementById('order_total2').value = total;
}




function getSaveResOrder(id, action) {



    var items_qty = '';
    var items_price_ = '';
    var categoryid_ = '';
    var subcategoryid_ = '';
    var subname_ = '';


    if (document.getElementById('tableid').value == '') {
        document.getElementById('error_service').style.display = "block";
        document.getElementById('error_service').innerHTML = "Please Select Table Number";
        document.getElementById('tableid').focus();
        return false;
    }

    if (document.getElementById('ddDateFrom').value == '') {
        document.getElementById('error_service').style.display = "block";
        document.getElementById('error_service').innerHTML = "Please Select Current Date";
        document.getElementById('ddDateFrom').focus();
        return false;
    }

    if (document.getElementById('roomid').value == '') {
        document.getElementById('error_service').style.display = "block";
        document.getElementById('error_service').innerHTML = "Please Select Room Number";
        document.getElementById('roomid').focus();
        return false;
    }

    if (document.getElementById('customername').value == '') {
        document.getElementById('error_service').style.display = "block";
        document.getElementById('error_service').innerHTML = "Enter the customer name";
        document.getElementById('customername').focus();
        return false;
    }

    if (document.getElementById('MenuCardid').value == '') {
        document.getElementById('error_service').style.display = "block";
        document.getElementById('error_service').innerHTML = "Please Select the MenuCard Id";
        document.getElementById('MenuCardid').focus();
        return false;
    }

    for (i = 1; i < id; i++) {

        if (document.getElementById("items_qty_" + i).value != "") {
            items_qty += document.getElementById("items_qty_" + i).value + "-";
        }
        if (document.getElementById("items_qty_" + i).value != "") {
            items_price_ += document.getElementById("items_price_" + i).value + "-";
        }

        if (document.getElementById("items_qty_" + i).value != "") {
            categoryid_ += document.getElementById("categoryid_" + i).value + "-";
        }

        if (document.getElementById("items_qty_" + i).value != "") {
            subcategoryid_ += document.getElementById("subcategoryid_" + i).value + "-";
        }

        if (document.getElementById("items_qty_" + i).value != "") {
            subname_ += document.getElementById("subname_" + i).value + "-";
        }

    }

    var tableid = document.getElementById("tableid").value;
    var ddDateFrom = document.getElementById("ddDateFrom").value;
    var roomid = document.getElementById("roomid").value;
    var customerId = document.getElementById("customerId").value;
    var MenuCardid = document.getElementById("MenuCardid").value;
    var customername = document.getElementById("customername").value;
    var subtotal = document.getElementById("subtotal2").value;
    var order_total2 = document.getElementById("order_total2").value;
    var discount2 = document.getElementById("discount2").value;
    var vat_tax = document.getElementById("vat_tax").value;
    var ser_tax = document.getElementById("ser_tax").value;
    var sale_tax = document.getElementById("sale_tax").value;
    var msg = "Your Order Placed Successfully ";

    var pars = "action=" + action + '&tableid=' + tableid + '&ddDateFrom=' + ddDateFrom + '&roomid=' + roomid + '&customerId=' + customerId + '&MenuCardid=' + MenuCardid + '&items_qty=' + items_qty + '&items_ttl_=' + items_price_ + '&categoryid_=' + categoryid_ + '&subcategoryid_=' + subcategoryid_ + '&subname_=' + subname_ + '&customername=' + customername + '&subtotal=' + subtotal + '&order_total2=' + order_total2 + '&discount2=' + discount2 + '&vat_tax=' + vat_tax + '&ser_tax=' + ser_tax + '&sale_tax=' + sale_tax + '&msg=' + msg;

    var url = 'restaurantOrderEntry.php';
    var myAjax = new Ajax.Updater({
            success: 'divmiddlecontent'
        },
        url, {
            method: 'post',
            evalScripts: true,
            parameters: pars,
            oncomplete: function(req) {}
        });

}

/////////////////////////Calculate  tax amount//////////////////////////////

function tax_calc() {

    var total_amount = document.getElementById('subtotal2').value;
    var discount = document.getElementById('discount2').value;
    var vat_tax = document.getElementById('vat_tax').value;
    var ser_tax = document.getElementById('ser_tax').value;
    var sale_tax = document.getElementById('sale_tax').value;


    var tax, totamtcalc;


    tax = ((total_amount * (vat_tax / 100)) + (total_amount * (ser_tax / 100)) + (total_amount * (sale_tax / 100)) - (total_amount * (discount / 100)));
    //alert(vattax);
    totamtcalc = (parseInt(total_amount) + parseInt(tax));
    //alert(totamtcalc);
    //totbalamt = totamtcalc - advance_pay;
    //alert(totbalamt);
    document.getElementById('order_total2').value = totamtcalc;
}

/////////////////////////End Calculate Vat tax amount//////////////////////////////
function GetMenu(id, action) {
    //alert(id);
    //alert(action);

    if (document.getElementById('ordertype').value == '') {
        document.getElementById('error_service').style.display = "block";
        document.getElementById('error_service').innerHTML = "Please Select Order Type";
        document.getElementById('ordertype').focus();
        return false;
    }

    var ordertype = document.getElementById('ordertype').value;
    alert(ordertype);
    if (ordertype == 'dine') {

        if (document.getElementById('tableid').value == '') {
            document.getElementById('error_service').style.display = "block";
            document.getElementById('error_service').innerHTML = "Please Select Table Number";
            document.getElementById('tableid').focus();
            return false;
        }
    }

    var vat = document.getElementById("vat").value;
    alert(vat);

    var tableid = document.getElementById("tableid").value;
    //alert(tableid);
    $.ajax({
        type: 'POST',
        url: 'restaurantOrderEntry.php',
        data: 'action=' + action + '&ordertype=' + ordertype + '&tableid=' + tableid + '&vat=' + vat + '&menuid=' + id,
        success: function(result) {
            //alert(result);   
            $("#divmiddlecontent").html(result);
        }
    });
}

function removeitems() {

    var fields = $("input[name='checkbox[]']:checked").serializeArray();
    if (fields.length == 0) {
        alert('Please Select the Item for Remove');
        // cancel submit
        return false;
    }
    var editstatus = $("#editstatus").val();
    var ordertype = document.getElementById('ordertype').value;
    var tableid = $('.gettableid:checked').map(function() {
        return this.value;
    }).get().join(',');
    var chairs = $('.chairs:checked').map(function() {
        return this.value;
    }).get().join(',');
    var cart_id = $("#order_cart_id").val();
    var category = $('.getcategory:checked').map(function() {
        return this.value;
    }).get().join(',');
    var checkedValue = $("input[name='checkbox[]']:checked").map(function() {
        return Number(this.value);
    }).get();

    //alert(checkedValue);
    //alert(checkedValue);
    var data = 'action=' + "itemsremove" + '&ordertype=' + ordertype + '&tableid=' + tableid + '&chairs=' + chairs + '&checkedValue=' + checkedValue + '&editstatus=' + editstatus + '&cart_id=' + cart_id + '&category=' + category;
    $.ajax({
        type: "POST",
        url: "restaurantOrderEntry.php",
        data: data,
        success: function(result) {
            $("#divmiddlecontent").html(result);
        }
    });
}

function cancelquantity(orderid, click_id) {

    var ordertype = document.getElementById('ordertype').value;
    var quantity = $('#quantity_' + orderid).val();
    var order_id = orderid;
    var cquantity = click_id;
    var tableid = $('.gettableid:checked').map(function() {
        return this.value;
    }).get().join(',');
    var chairs = $('.chairs:checked').map(function() {
        return this.value;
    }).get().join(',');
    var editstatus = $("#editstatus").val();
    var cart_id = $("#order_cart_id").val();
    var category = $('.getcategory:checked').map(function() {
        return this.value;
    }).get().join(',');
    if (parseInt(cquantity) >= parseInt(quantity)) {
        alert("Cancel Quantity Exceeds the Limit");
        $('#cquantity_' + orderid).val(0);
        return false;
    }
    $.ajax({
        type: "POST",
        url: "restaurantOrderEntry.php",
        data: 'order=' + order_id + '&action=' + 'updatequantity' + '&ordertype=' + ordertype + '&tableid=' + tableid + '&cquantity=' + cquantity + '&quantity=' + quantity + '&editstatus=' + editstatus + '&chairs=' + chairs + '&cart_id=' + cart_id + '&category=' + category,
        success: function(result) {
            $("#divmiddlecontent").html(result);
            $("#cquantity_" + order_id).focus();

        }
    });
}


function orderquantity(orderid, click_id) {

    var ordertype = document.getElementById('ordertype').value;
    var order_id = orderid;
    var quantity = click_id;
    var tableid = $('.gettableid:checked').map(function() {
        return this.value;
    }).get().join(',');
    var chairs = $('.chairs:checked').map(function() {
        return this.value;
    }).get().join(',');
    var editstatus = $("#editstatus").val();
    var cart_id = $("#order_cart_id").val();
    var category = $('.getcategory:checked').map(function() {
        return this.value;
    }).get().join(',');
    $.ajax({
        type: "POST",
        url: "restaurantOrderEntry.php",
        data: 'order=' + order_id + '&action=' + 'updatequantity' + '&ordertype=' + ordertype + '&tableid=' + tableid + '&quantity=' + quantity + '&chairs=' + chairs + '&editstatus=' + editstatus + '&cart_id=' + cart_id + '&category=' + category,
        success: function(result) {
            $("#divmiddlecontent").html(result);
            //alert(result);  
            //alert(order_id);
            //$("#"+order_id).val(result); 
            $("#quantity_" + order_id).focus();
            update_quantity(order_id);
            //$("#divmiddlecontent").html(result);  
            //$("#quantity").focus(); 
        }
    });
}

function update_quantity(a) {

    //alert("enter");
    $("#quantity_" + a).focus();
    var t = $("#quantity_" + a);
    //var l=$("#quantity_").val().length;
    $(t).focus();

}

function cupdate_quantity(a) {
    //alert(a);
    //alert("enter");
    $("#cquantity_" + a).focus();
    var t = $("#cquantity_" + a);
    // var l=$("#cquantity_").val().length;
    $(t).focus();

}

function itemfocus() {
    // alert("enter");
    $("#search-box").focus();
    var t = $("#search-box");
    var l = $("#search-box").val().length;
    $(t).focus();
    //alert("enter");
    // $("#search-box").focus(); 

}

function itemfocus2() {
    // alert("enter");
    $("#search-box2").focus();
    var t2 = $("#search-box2");
    var l = $("#search-box2").val().length;
    $(t2).focus();
    //alert("enter");
    // $("#search-box").focus(); 

}


function print(table_id, card_id) {

    //var vat    = document.getElementById("vat").value;
    //var ser    = document.getElementById("service").value;
    //var sales    = document.getElementById("sales").value;
    var disc = document.getElementById("disc").value;
    //alert(disc);
    if (disc == 0 && disc == "") {
        var disc = document.getElementById("disc1").value;
        if (disc == "") {
            var disc = 0;
        }

    }
    var table = table_id;
    var card = card_id;

    var tax_box = document.getElementById("tax_box").checked;
    //alert(tax_box);

    window.open("barBillprint.php?table_id=" + table_id + "&card_id=" + card_id + "&tax_box=" + tax_box + "&disc=" + disc, '_blank');


    $.ajax({
        type: 'POST',
        url: 'restaurantOrderEntry.php',
        data: '',
        success: function(result) {
            $("#divmiddlecontent").html(result);
            $("#bill_row").hide();
        }
    });
}

function Save_bill(table_id,sup_name,cart_id, bill_id, ordertype, accountsession, chkpc) {
    var disc = document.getElementById('disc').value;

    if (disc == 0 && disc == "") {
        var disc = 0;
    }

    var bill_s = document.getElementById('return_amount').value;

    if (bill_s > 0) {
        var bill_status = "Pending";
        if (document.getElementById('partial').checked == false) {
            alert("Please Pay Full Net Amount");
            return false;
        }
    } else {
        var bill_status = "Paid";
    }

    if (document.getElementById('partial').checked == true) {
        var customer_name = document.getElementById('customer_name').value;
        if (customer_name == "") {
            alert("Please Enter The Customer Name");
            document.getElementById('customer_name').focus();
            return false;
        }

        var mobile = document.getElementById('mobile').value;
        if (mobile == "") {
            alert("Please Enter The Mobile Number");
            document.getElementById('mobile').focus();
            return false;
        }

        if (!mobile.match(/^\d+/)) {
            alert("Please only enter numeric characters only for Mobile Number");
            document.getElementById('mobile').values = "";
            document.getElementById('mobile').focus();
            return false;
        }

        var address = document.getElementById('address').value;
        if (address == "") {
            alert("Please Enter The Address");
            document.getElementById('address').focus();
            return false;
        }

        var pay_type = "partial";
        var p_type = '&pay_type=' + pay_type + '&name=' + customer_name + '&mobile=' + mobile + '&address=' + address;
        // alert(p_type);     
    }

    if (document.getElementById('full').checked == true) {
        var pay_type = "full";
        var p_type = '&pay_type=' + pay_type;
    }

    if (document.getElementById('cash').checked == false && document.getElementById('card').checked == false && document.getElementById('cheque').checked == false && document.getElementById('online').checked == false) {
        alert("Please Select The Mode Of Payment Method");
        return false;
    }

    if (document.getElementById('cash').checked == true && document.getElementById('card').checked == true && document.getElementById('cheque').checked == true) {
        alert("Your Select more than two mode");
        return false;
    }

    if (document.getElementById('cash').checked == true && document.getElementById('card').checked == true && document.getElementById('online').checked == true) {
        alert("Your Select more than two mode");
        return false;
    }


    if (document.getElementById('cash').checked == true && document.getElementById('cheque').checked == true && document.getElementById('online').checked == true) {
        alert("Your Select more than two mode");
        return false;
    }


    if (document.getElementById('card').checked == true && document.getElementById('cheque').checked == true && document.getElementById('online').checked == true) {
        alert("Your Select more than two mode");
        return false;
    }


    if (document.getElementById('cash').checked == true) {
        var cash_amount = document.getElementById('cash_pay_amount').value;
        if (cash_amount == "") {
            alert("Please Enter Cash Pay Amount Value");
            document.getElementById('cash_pay_amount').focus();
            return false;
        }
        if (!cash_amount.match(/^\d+/)) {
            alert("Please only enter numeric characters only for Cash Pay Amount");
            document.getElementById('cash_pay_amount').values = "";
            document.getElementById('cash_pay_amount').focus();
            return false;
        }
    }



    if (document.getElementById('card').checked == true) {
        var card_amount = document.getElementById('card_pay_amount').value;
        if (card_amount == "") {
            alert("Please Enter Card Pay Amount Value");
            document.getElementById('card_pay_amount').focus();
            return false;
        }
        if (!card_amount.match(/^\d+/)) {
            alert("Please only enter numeric characters only for Card Pay Amount");
            document.getElementById('card_pay_amount').values = "";
            document.getElementById('card_pay_amount').focus();
            return false;
        }


        var card_no = document.getElementById('card_no').value;
        if (card_no == "") {
            alert("Please Enter The Card Number");
            document.getElementById('card_no').focus();
            return false;
        }
        if (!card_no.match(/^\d+/)) {
            alert("Please only enter numeric characters only for Card Number");
            document.getElementById('card_no').values = "";
            document.getElementById('card_no').focus();
            return false;
        }



        var card_name = document.getElementById('card_name').value;
        if (card_name == "") {
            alert("Please Enter The Card Name");
            document.getElementById('card_name').focus();
            return false;
        }

        var exp_date = document.getElementById('exp_date').value;
        if (exp_date == "") {
            alert("Please Enter The Expire Date");
            document.getElementById('exp_date').focus();
            return false;
        }
        var pattern = /^([0-9]{2})-([0-9]{2})-([0-9]{4})$/;
        if (!pattern.test(exp_date)) {
            alert("Invalid Expire Date Format");
            document.getElementById('exp_date').value = "";
            document.getElementById('exp_date').focus();
            return false;
        }

    }


    if (document.getElementById('cheque').checked == true) {
        var cheque_amount = document.getElementById('cheque_pay_amount').value;
        if (cheque_amount == "") {
            alert("Please Enter Cheque Pay Amount Value");
            document.getElementById('cheque_pay_amount').focus();
            return false;
        }
        if (!cheque_amount.match(/^\d+/)) {
            alert("Please only enter numeric characters only for Cheque Amount");
            document.getElementById('cheque_pay_amount').values = "";
            document.getElementById('cheque_pay_amount').focus();
            return false;
        }


        var cheque_no = document.getElementById('cheque_no').value;
        if (cheque_no == "") {
            alert("Please Enter The Cheque Number");
            document.getElementById('cheque_no').focus();
            return false;
        }
        if (!cheque_no.match(/^\d+/)) {
            alert("Please only enter numeric characters only for Cheque Number");
            document.getElementById('cheque_no').values = "";
            document.getElementById('cheque_no').focus();
            return false;
        }


        var ceq_name = document.getElementById('ceq_name').value;
        if (ceq_name == "") {
            alert("Please Enter The Cheque Name");
            document.getElementById('ceq_name').focus();
            return false;
        }

        var ceq_date = document.getElementById('ceq_date').value;
        if (ceq_date == "") {
            alert("Please Enter The Ceque Date");
            document.getElementById('ceq_date').focus();
            return false;
        }

        var pattern = /^([0-9]{2})-([0-9]{2})-([0-9]{4})$/;
        if (!pattern.test(ceq_date)) {
            alert("Invalid Ceque Date Format");
            document.getElementById('ceq_date').value = "";
            document.getElementById('ceq_date').focus();
            return false;
        }


    }


    if (document.getElementById('online').checked == true) {

        var online_amount = document.getElementById('online_pay_amount').value;
        if (online_amount == "") {
            alert("Please Enter Online Pay Amount Pay Amount Value");
            document.getElementById('online_pay_amount').focus();
            return false;
        }
        if (!online_amount.match(/^\d+/)) {
            alert("Please only enter numeric characters only for Online Pay Amount");
            document.getElementById('online_pay_amount').values = "";
            document.getElementById('online_pay_amount').focus();
            return false;
        }


        var on_card_no = document.getElementById('on_card_no').value;
        if (on_card_no == "") {
            alert("Please Enter The Card Number");
            document.getElementById('on_card_no').focus();
            return false;
        }
        if (!on_card_no.match(/^\d+/)) {
            alert("Please only enter numeric characters only for Card Number");
            document.getElementById('on_card_no').values = "";
            document.getElementById('on_card_no').focus();
            return false;
        }


        var on_card_name = document.getElementById('on_card_name').value;
        if (on_card_name == "") {
            alert("Please Enter The Card Name");
            document.getElementById('on_card_name').focus();
            return false;
        }

        var on_exp_date = document.getElementById('on_exp_date').value;
        if (on_exp_date == "") {
            alert("Please Enter The Expire Date");
            document.getElementById('on_exp_date').focus();
            return false;
        }
        var pattern = /^([0-9]{2})-([0-9]{2})-([0-9]{4})$/;
        if (!pattern.test(on_exp_date)) {
            alert("Invalid Expire Date Format");
            document.getElementById('on_exp_date').value = "";
            document.getElementById('on_exp_date').focus();
            return false;
        }


        var transactions_id = document.getElementById('transactions_id').value;
        if (transactions_id == "") {
            alert("Please Enter The Transactions Id");
            document.getElementById('transactions_id').focus();
            return false;
        }

    }

    if (document.getElementById('cash').checked == true && document.getElementById('card').checked == false && document.getElementById('cheque').checked == false && document.getElementById('online').checked == false) {
        var pay_method = "cash";
        var data1 = 'action=' + 'savebill' + '&table_id=' + table_id +  '&sup_id=' + sup_name + '&bill_id=' + bill_id + '&cart_id=' + cart_id + '&pay_method=' + pay_method + '&cash_amount=' + cash_amount + '&bill_status=' + bill_status + '&disc=' + disc + p_type + '&accountsession=' + accountsession;
        //alert(data1);
    }

    if (document.getElementById('cash').checked == false && document.getElementById('card').checked == true && document.getElementById('cheque').checked == false && document.getElementById('online').checked == false) {
        var pay_method = "card";
        var data1 = 'action=' + 'savebill' + '&table_id=' + table_id + '&sup_id=' + sup_name +'&bill_id=' + bill_id + '&cart_id=' + cart_id + '&pay_method=' + pay_method + '&card_amount=' + card_amount + '&card_no=' + card_no + '&card_name=' + card_name + '&exp_date=' + exp_date + '&bill_status=' + bill_status + '&disc=' + disc + p_type + '&accountsession=' + accountsession;
        //alert(data1);
    }

    if (document.getElementById('cash').checked == false && document.getElementById('card').checked == false && document.getElementById('cheque').checked == true && document.getElementById('online').checked == false) {
        var pay_method = "cheque";
        var data1 = 'action=' + 'savebill' + '&table_id=' + table_id + '&sup_id=' + sup_name + '&bill_id=' + bill_id + '&cart_id=' + cart_id + '&pay_method=' + pay_method + '&cheque_amount=' + cheque_amount + '&cheque_no=' + cheque_no + '&ceq_name=' + ceq_name + '&ceq_date=' + ceq_date + '&bill_status=' + bill_status + '&disc=' + disc + p_type + '&accountsession=' + accountsession;
        //alert(data1);
    }

    if (document.getElementById('cash').checked == false && document.getElementById('card').checked == false && document.getElementById('cheque').checked == false && document.getElementById('online').checked == true) {
        var pay_method = "online";
        var data1 = 'action=' + 'savebill' + '&table_id=' + table_id + '&sup_id=' + sup_name + '&bill_id=' + bill_id + '&cart_id=' + cart_id + '&pay_method=' + pay_method + '&online_amount=' + online_amount + '&on_card_no=' + on_card_no + '&on_card_name=' + on_card_name + '&on_exp_date=' + on_exp_date + '&transactions_id=' + transactions_id + '&bill_status=' + bill_status + '&disc=' + disc + p_type + '&accountsession=' + accountsession;
        //alert(data1);
    }

    if (document.getElementById('cash').checked == true && document.getElementById('card').checked == true) {
        var pay_method = "cash-card";
        var data1 = 'action=' + 'savebill' + '&table_id=' + table_id + '&sup_id=' + sup_name + '&bill_id=' + bill_id + '&cart_id=' + cart_id + '&pay_method=' + pay_method + '&cash_amount=' + cash_amount + '&card_amount=' + card_amount + '&card_no=' + card_no + '&card_name=' + card_name + '&exp_date=' + exp_date + '&bill_status=' + bill_status + '&disc=' + disc + p_type + '&accountsession=' + accountsession;
        //alert(data1);

    }

    if (document.getElementById('cash').checked == true && document.getElementById('cheque').checked == true) {
        var pay_method = "cash-cheque";
        var data1 = 'action=' + 'savebill' + '&table_id=' + table_id + '&sup_id=' + sup_name + '&bill_id=' + bill_id + '&cart_id=' + cart_id + '&pay_method=' + pay_method + '&cash_amount=' + cash_amount + '&cheque_amount=' + cheque_amount + '&cheque_no=' + cheque_no + '&ceq_name=' + ceq_name + '&ceq_date=' + ceq_date + '&bill_status=' + bill_status + '&disc=' + disc + p_type + '&accountsession=' + accountsession;
        //alert(data1);

    }

    if (document.getElementById('cash').checked == true && document.getElementById('online').checked == true) {
        //alert("online enter");
        var pay_method = "cash-online";
        var data1 = 'action=' + 'savebill' + '&table_id=' + table_id + '&sup_id=' + sup_name + '&bill_id=' + bill_id + '&cart_id=' + cart_id + '&pay_method=' + pay_method + '&cash_amount=' + cash_amount + '&online_amount=' + online_amount + '&on_card_no=' + on_card_no + '&on_card_name=' + on_card_name + '&on_exp_date=' + on_exp_date + '&transactions_id=' + transactions_id + '&bill_status=' + bill_status + '&disc=' + disc + p_type + '&accountsession=' + accountsession;
        //alert(data1);

    }

    if (document.getElementById('card').checked == true && document.getElementById('cheque').checked == true) {
        var pay_method = "card-cheque";
        var data1 = 'action=' + 'savebill' + '&table_id=' + table_id + '&sup_id=' + sup_name + '&bill_id=' + bill_id + '&cart_id=' + cart_id + '&pay_method=' + pay_method + '&card_amount=' + card_amount + '&card_no=' + card_no + '&card_name=' + card_name + '&exp_date=' + exp_date + '&cheque_amount=' + cheque_amount + '&cheque_no=' + cheque_no + '&ceq_name=' + ceq_name + '&ceq_date=' + ceq_date + '&bill_status=' + bill_status + '&disc=' + disc + p_type + '&accountsession=' + accountsession;
        //alert(data1);
    }

    if (document.getElementById('card').checked == true && document.getElementById('online').checked == true) {
        var pay_method = "card-online";
        var data1 = 'action=' + 'savebill' + '&table_id=' + table_id + '&sup_id=' + sup_name + '&bill_id=' + bill_id + '&cart_id=' + cart_id + '&pay_method=' + pay_method + '&card_amount=' + card_amount + '&card_no=' + card_no + '&card_name=' + card_name + '&exp_date=' + exp_date + '&online_amount=' + online_amount + '&on_card_no=' + on_card_no + '&on_card_name=' + on_card_name + '&on_exp_date=' + on_exp_date + '&transactions_id=' + transactions_id + '&bill_status=' + bill_status + '&disc=' + disc + p_type + '&accountsession=' + accountsession;
        //alert(data1);
    }

    if (document.getElementById('cheque').checked == true && document.getElementById('online').checked == true) {

        var pay_method = "cheque-online";


        var data1 = 'action=' + 'savebill' + '&table_id=' + table_id + '&sup_id=' + sup_name + '&bill_id=' + bill_id + '&cart_id=' + cart_id + '&pay_method=' + pay_method + '&cheque_amount=' + cheque_amount + '&cheque_no=' + cheque_no + '&ceq_name=' + ceq_name + '&ceq_date=' + ceq_date + '&online_amount=' + online_amount + '&on_card_no=' + on_card_no + '&on_card_name=' + on_card_name + '&on_exp_date=' + on_exp_date + '&transactions_id=' + transactions_id + '&bill_status=' + bill_status + '&disc=' + disc + p_type + '&accountsession=' + accountsession;



    }
    
    //var data ='action=' + 'savebill' + '&table_id='+table_id+'&bill_id='+bill_id,
    $.ajax({
        type: "POST",
        url: "savebill.php",
        data: data1,

        success: function(data) {
            $("#save_bill_content").html(data);
            $("#bill_row").hide();
        }

    });

    $.ajax({
        type: "POST",
        url: 'restaurantOrderEntry.php',
        success: function(data) {
            $("#divmiddlecontent").html(data);
            $("#bill_row").hide();
            if (chkpc == 1) {
                print_bill(table_id, cart_id, bill_id, accountsession);
                close_bill('close_cancel', cart_id, table_id);
            }
        }
    });
}

function print_bill(table_id, card_id, bill_id, accountsession) {


    //document.getElementById('bill_row').style.display = 'none';
    //window.open("barBillprint.php?table_id=" + table_id + "&card_id=" + card_id + "&bill_id=" + bill_id + "&accountsession=" + accountsession, '_blank');
    $.ajax({
        type: 'GET',
        url: 'barBillprint.php',
        data: 'table_id='+table_id+'&card_id='+card_id+'&bill_id='+bill_id+'&accountsession='+accountsession,
        success: function(data) {


        }
    });

}


function print_nocashbill(chairs, card_id, accountsession) {
    document.getElementById('bill_row').style.display = 'none';
    window.open("nocashbillprint.php?chairs=" + chairs + "&card_id=" + card_id + "&accountsession=" + accountsession, '_blank');
}

function open_bill(cart_id, chairs, ordertype) {
    //alert("enter");
    //alert(ordertype);
    //alert(table_id);
    //alert(cart_id);
    $.ajax({
        type: "POST",
        url: "restaurantOrderEntry.php",
        data: 'editstatus=editcart&ordertype=' + ordertype + '&chairs=' + chairs + '&cart_id=' + cart_id,

        success: function(result) {

            //$("#bill_row").show();
            // $("#save_bill_content").hide();

            $("#divmiddlecontent").html(result);
            $("#bill_row").show();
            $('#itemcode').focus();
            window.scrollTo(0, 1090);

        }
    });

}


function bill_cancel(action, cart_id, chairs, cancelcomments) {
    //alert("enter");
    //alert(action);

    $.ajax({
        type: 'POST',
        url: 'restaurantOrderEntry.php',
        data: 'action=' + action + "&cart_id=" + cart_id + "&chairs=" + chairs + "&cancelcomments=" + cancelcomments,
        success: function(result) {
            $("#divmiddlecontent").html(result);
            $("#bill_row").hide();
            $("#save_bill_content").show();
        }
    });
}

function bill_nocash(action, cart_id, chairs, nocashcomments) {
    $.ajax({
        type: 'POST',
        url: 'restaurantOrderEntry.php',
        data: 'action=' + action + "&cart_id=" + cart_id + "&chairs=" + chairs + "&nocashcomments=" + nocashcomments,
        success: function(result) {
            $("#divmiddlecontent").html(result);
            $("#bill_row").hide();
            $("#save_bill_content").show();
        }
    });
}


function close_bill(action, cart_id, chairs) {

    //alert("enter");
    //alert(action);
    $.ajax({
        type: 'POST',
        url: 'restaurantOrderEntry.php',
        data: 'action=' + action + "&cart_id=" + cart_id + "&chairs=" + chairs,
        success: function(result) {
            // alert(result);
            $("#divmiddlecontent").html(result);
            $("#save_bill_content").show();


        }
    });
}


function cls() {
    alert("enter");
    $.ajax({
        type: 'POST',
        url: 'restaurantOrderEntry.php',
        data: '',
        success: function(result) {
            $("#divmiddlecontent").html(result);
        }
    });
}


function RoomBill(table_id, card_id) {

    if (document.getElementById('cus_name').value == '') {
        document.getElementById('error_service').style.display = "block";
        document.getElementById('error_service').innerHTML = "Please Select Room Number";
        document.getElementById('cus_name').focus();
        return false;
    }

    var roomsno = document.getElementById("rooms").value;
    var cus_name = document.getElementById("cus_name").value;
    var vat = document.getElementById("vat").value;
    var ser = document.getElementById("service").value;
    var sales = document.getElementById("sales").value;
    //var disc    = document.getElementById("disc").value;
    var totaltax = document.getElementById("totaltax").value;

    var table = table_id;
    var card = card_id;

    window.open("roomBillprint.php?table_id=" + table_id + "&card_id=" + card_id + "&vat=" + vat + "&ser=" + ser + "&sales=" + sales + "&totaltax=" + totaltax + "&roomsno=" + roomsno + "&cus_name=" + cus_name + "", '_blank');
    $.ajax({
        type: 'POST',
        url: 'restaurantOrderEntry.php',
        data: '',
        success: function(result) {
            $("#divmiddlecontent").html(result);
        }
    });
}

function cancel() {
    $.ajax({
        type: 'POST',
        url: 'restaurantOrderEntry.php',
        data: '',
        success: function(result) {
            $("#divmiddlecontent").html(result);
        }
    });

}




function Gettax() {

    var disc = document.getElementById("disc").value;
    if (disc == "") {
        var disc = 0;
    }

    var total = document.getElementById("total").value;

    var disc_smt = total * (disc / 100);

    // document.getElementById("discount").innerHTML ="  :"+disc_smt.toFixed(2);
    //var totaltax = parseInt(vat)+parseInt(ser)+parseInt(sales);
    // alert(totaltax);
    // $("#totaltax").val(totaltax);
    //var taxamount= total*(totaltax/100.0); 
    //alert(taxamount);
    var net = parseInt(total) - parseInt(disc_smt) + ".00";
    var rfnet = roundoff(net);

    document.getElementById("netamount").innerHTML = "NET-AMOUNT:" + rfnet;
    document.getElementById('netamount_v').value = rfnet;
    document.getElementById('cash_pay_amount').value = rfnet;
    //$("#netamount").val(netamount);
}


function Gettax1() {

    //  alert("false");	
    var vat = 0;
    var ser = 0;
    var sales = 0;

    var disc = document.getElementById("disc1").value;
    if (disc == "") {
        var disc = 0;
    }

    var total = document.getElementById("total").value;
    //alert(total);


    var disc_smt = total * (disc / 100.0);
    document.getElementById("discount").innerHTML = "  :" + disc_smt.toFixed(2);

    //var totaltax = parseInt(vat)+parseInt(ser)+parseInt(sales);
    // alert(totaltax);
    $("#totaltax").val(totaltax);
    //var taxamount= total*(totaltax/100.0); 
    //alert(taxamount);
    var net = parseInt(total) - parseInt(disc_smt);
    //alert(netamount);
    document.getElementById("netamount").innerHTML = "NET-AMOUNT:" + net + ".00";
    //$("#netamount").val(netamount);
}

function cancelitems() {

    var fields = $("input[name='checkbox[]']:checked").serializeArray();
    if (fields.length == 0) {
        alert('Please Select the Item for Cancel');
        return false;
    }

    var ordertype = document.getElementById('ordertype').value;

    var tableid = $('.gettableid:checked').map(function() {
        return this.value;
    }).get().join(',');
    var chairs = $('.chairs:checked').map(function() {
        return this.value;
    }).get().join(',');
    var checkedValue = $("input[name='checkbox[]']:checked").map(function() {
        return Number(this.value);
    }).get();
    var editstatus = $("#editstatus").val();
    var cart_id = $("#order_cart_id").val();
    var category = $('.getcategory:checked').map(function() {
        return this.value;
    }).get().join(',');
    var data = 'action=cancelitem&ordertype=' + ordertype + '&tableid=' + tableid + '&chairs=' + chairs + '&checkedValue=' + checkedValue + '&editstatus=' + editstatus + '&cart_id=' + cart_id + '&category=' + category;
    $.ajax({
        type: "POST",
        url: "restaurantOrderEntry.php",
        data: data,
        success: function(result) {
            $("#divmiddlecontent").html(result);
        }
    });
}

function checkNumber(o, w) {
    ///^\d{1,2}(\-|\/|\.)\d{1,2}\1\d{4}$/
    o.value = o.value.replace(/[^0-9]/g, ''); // replace empty value to the characters execpt (0-9-)
}

function checkNumberdot(o, w) {
    ///^\d{1,2}(\-|\/|\.)\d{1,2}\1\d{4}$/
    o.value = o.value.replace(/[^0-9.]/g, ''); // replace empty value to the characters execpt (0-9-)
}

function roundoff(str) {
    var afterpoint = str.toString().split(".");
    var decimal = '0.' + afterpoint[1];
    var result;
    if (decimal <= 0.50)
        result = afterpoint[0] + '.00';
    else
        result = parseInt(afterpoint[0]) + parseInt(1) + '.00';
    return result;
}

function session_name(str) {
    var result;
    if (str == 'B')
        result = 'Breakfast';
    if (str == 'L')
        result = 'Lunch';
    if (str == 'S')
        result = 'Snacks';
    if (str == 'D')
        result = 'Dinner';
    return result;
}