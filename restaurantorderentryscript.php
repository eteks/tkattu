<link href="js/dist/tinyNotice-theme.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.8.0.min.js"></script>
<script type="text/javascript">
    function changetable(value) {
        var j = 1;
        for (i = 1; i < tables.length; i++) {
            if (tables[i].selected) {
                j = i;
                var tblid = "tableid" + j;
                var chk = document.getElementById(tblid);
                chk.checked = true;
            } else {
                j = i;
                var tblid = "tableid" + j;
                var chk = document.getElementById(tblid);
                chk.checked = false;
            }
        }
        document.getElementById('noofpersons').value = "";
    }


    function clear_chair() {
        for (i = 1; i < tables.length; i++) {

            var chrid1 = "chair" + i + "a";
            if (document.getElementById(chrid1))
                if (document.getElementById(chrid1).disabled != true) {
                    document.getElementById(chrid1).checked = false;
                }
            var chrid2 = "chair" + i + "b";
            if (document.getElementById(chrid2))
                if (document.getElementById(chrid2).disabled != true) {
                    document.getElementById(chrid2).checked = false;
                }
            var chrid3 = "chair" + i + "c";
            if (document.getElementById(chrid3))
                if (document.getElementById(chrid3).disabled != true) {
                    document.getElementById(chrid3).checked = false;
                }
            var chrid4 = "chair" + i + "d";
            if (document.getElementById(chrid4))
                if (document.getElementById(chrid4).disabled != true) {
                    document.getElementById(chrid4).checked = false;
                }
            var chrid5 = "chair" + i + "e";
            if (document.getElementById(chrid5))
                if (document.getElementById(chrid5).disabled != true) {
                    document.getElementById(chrid5).checked = false;
                }
            var chrid6 = "chair" + i + "f";
            if (document.getElementById(chrid6))
                if (document.getElementById(chrid6).disabled != true) {
                    document.getElementById(chrid6).checked = false;
                }

        }

    }

    function assign_chair(value) {
        var j = 0;
        for (i = 1; i < tables.length; i++) {
            var table_id = "tableid" + i;
            var gettable = document.getElementById(table_id);
            if (gettable.checked == true) {
                if (value >= 1) {
                    var chrid1 = "chair" + i + "a";
                    if (document.getElementById(chrid1).disabled == true) {
                        value++;
                    } else {
                        if (value >= 1) {
                            document.getElementById(chrid1).checked = true;
                        } else {
                            document.getElementById(chrid1).checked = false;
                        }

                    }
                }
                if (value >= 2) {
                    var chrid1 = "chair" + i + "b";
                    if (document.getElementById(chrid1).disabled == true) {
                        value++;
                    } else {
                        if (value >= 2) {
                            document.getElementById(chrid1).checked = true;

                        } else {
                            document.getElementById(chrid1).checked = false;
                        }

                    }
                }


                if (value >= 3) {
                    var chrid1 = "chair" + i + "c";
                    if (document.getElementById(chrid1).disabled == true) {
                        value++;
                    } else {
                        if (value >= 3) {
                            document.getElementById(chrid1).checked = true;

                        } else {
                            document.getElementById(chrid1).checked = false;
                        }

                    }
                }

                if (value >= 4) {
                    var chrid1 = "chair" + i + "d";
                    if (document.getElementById(chrid1).disabled == true) {
                        value++;
                    } else {
                        if (value >= 4) {
                            document.getElementById(chrid1).checked = true;

                        } else {
                            document.getElementById(chrid1).checked = false;
                        }

                    }
                }

                if (value >= 5) {
                    var chrid1 = "chair" + i + "e";
                    if (document.getElementById(chrid1))
                        if (document.getElementById(chrid1).disabled == true) {
                            value++;
                        } else {
                            if (value >= 5) {
                                document.getElementById(chrid1).checked = true;

                            } else {
                                document.getElementById(chrid1).checked = false;
                            }

                        }
                }

                if (value >= 6) {
                    var chrid1 = "chair" + i + "f";
                    if (document.getElementById(chrid1))
                        if (document.getElementById(chrid1).disabled == true) {
                            value++;
                        } else {
                            if (value >= 6) {
                                document.getElementById(chrid1).checked = true;

                            } else {
                                document.getElementById(chrid1).checked = false;
                            }

                        }
                }

            } else {
                var chrid1 = "chair" + i + "a";
                if (document.getElementById(chrid1))
                    if (document.getElementById(chrid1).disabled != true) {
                        document.getElementById(chrid1).checked = false;
                    }
                var chrid2 = "chair" + i + "b";
                if (document.getElementById(chrid2))
                    if (document.getElementById(chrid2).disabled != true) {
                        document.getElementById(chrid2).checked = false;
                    }
                var chrid3 = "chair" + i + "c";
                if (document.getElementById(chrid3))
                    if (document.getElementById(chrid3).disabled != true) {
                        document.getElementById(chrid3).checked = false;
                    }
                var chrid4 = "chair" + i + "d";
                if (document.getElementById(chrid4))
                    if (document.getElementById(chrid4).disabled != true) {
                        document.getElementById(chrid4).checked = false;
                    }
                var chrid5 = "chair" + i + "d";
                if (document.getElementById(chrid5))
                    if (document.getElementById(chrid5).disabled != true) {
                        document.getElementById(chrid5).checked = false;
                    }
                var chrid6 = "chair" + i + "d";
                if (document.getElementById(chrid6))
                    if (document.getElementById(chrid6).disabled != true) {
                        document.getElementById(chrid6).checked = false;
                    }
            }



        }
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {

        $('#itemcode').focusin(function() {
            $('#search_suggestion_holder').hide();
        });
        
        


        <?php if($_POST['editstatus']=='editcart'){?>
        	$(".highlighteditorder<?php echo $_POST['cart_id'];?>").css("background-color", '#A3A3A3');
        <?php }?>

        $('.getcategory').on('click', function() {
            $("#search_suggestion_holder").hide();
        });


        var timer = null;
        $('#search-box').keyup(function(e) {

            if (e.which == 27) {
                $("#search_suggestion_holder").hide();
            }
            
            if (e.keyCode == 38) {
                if ($('#search_suggestion_holder').is(':visible')) {
                    if (!$('.selected').is(':visible')) {
                        $('#search_suggestion_holder li').last().addClass('selected');
                        var value = $('.selected').text();
                        //$('#search-box').val(value);
                    } else {
                        var i = $('#search_suggestion_holder li').index($('#search_suggestion_holder li.selected'));
                        $('#search_suggestion_holder li.selected').removeClass('selected');
                        var value = $('.selected').text();
                        //  $('#search-box').val(value);
                        i--;
                        $('#search_suggestion_holder li:eq(' + i + ')').addClass('selected');
                        var value = $('.selected').text();
                        // $('#search-box').val(value);
                    }
                }
            } else if (e.keyCode == 40) {
                if ($('#search_suggestion_holder').is(':visible')) {
                    if (!$('.selected').is(':visible')) {
                        $('#search_suggestion_holder li').first().addClass('selected');
                        var value = $('.selected').text();
                        // $('#search-box').val(value);
                    } else {
                        var i = $('#search_suggestion_holder li').index($('#search_suggestion_holder li.selected'));
                        $('#search_suggestion_holder li.selected').removeClass('selected');
                        var value = $('.selected').text();
                        // $('#search-box').val(value);			
                        i++;
                        $('#search_suggestion_holder li:eq(' + i + ')').addClass('selected');
                        var value = $('.selected').text();
                        //$('#search-box').val(value);
                    }
                }
            } else if (e.keyCode == 13) {
                if ($('.selected').is(':visible')) {
                    var value = $('.selected').text();
                    id = $('.selected').attr('id');
                    if ($(".accsession:checkbox:checked").length == 0) {
                        $("#error_service").show();
                        $("#error_service").html("Please Select Session");
                        $(window).scrollTop('#error_service');
                        $("#breakfast").focus();
                        return false;
                    } //alert(id);
                    else if (document.getElementById('ordertype').value == '') {
                        document.getElementById('error_service').style.display = "block";
                        document.getElementById('error_service').innerHTML = "Please Select Order Type";
                        document.getElementById('ordertype').focus();
                        return false;
                    }


                    var ordertype = document.getElementById('ordertype').value;
                    if (ordertype == 'dine') {

                        if ($(".gettableid:checkbox:checked").length == 0) {
                            $("#error_service").show();
                            $("#error_service").html("Please Select Table");
                            $(window).scrollTop('#error_service');
                            $(".gettableid").focus();
                            $('#tables').focus();                            return false;
                        } else if ($(".chairs:checkbox:checked").length == 0) {
                            $("#error_service").show();
                            $("#error_service").html("Please Select Chair");
                            $(window).scrollTop('#error_service');
                            $(".chairs").focus();
                            return false;
                        } else if ($("#suppliers").val() == "") {
                            $("#error_service").show();
                            $("#error_service").html("Please Select the Supplier");
                            $(window).scrollTop('#error_service');
                            $("#suppliers").focus();
                            return false;
                        } else if ($("#noofpersons").val() == "") {
                            $("#error_service").show();
                            $("#error_service").html("Please Enter the No. of Persons");
                            $(window).scrollTop('#error_service');
                            $("#noofpersons").focus();
                            return false;
                        }

                    }

                    $("#error_service").hide();
                    var suppliers = $("#suppliers").val();
                    var editstatus = $("#editstatus").val();
                    var noofpersons = $("#noofpersons").val();
                    var accountsession = $('input[name="accountsession"]:checked').val();
                    var tableid = $('.gettableid:checked').map(function() {
                        return this.value;
                    }).get().join(',');
                    var chairs = $('.chairs:checked').map(function() {
                        return this.value;
                    }).get().join(',');
                    var category = $('.getcategory:checked').map(function() {
                        return this.value;
                    }).get().join(',');
                    var cart_id = $("#order_cart_id").val();

                    $.ajax({
                        type: 'POST',
                        url: 'restaurantOrderEntry.php',
                        data: 'action=' + 'savemenulistres' + '&cart_id=' + cart_id + '&ordertype=' + ordertype + '&editstatus=' + editstatus + '&tableid=' + tableid + '&chairs=' + chairs + '&suppliers=' + suppliers + '&accountsession=' + accountsession + '&noofpersons=' + noofpersons + '&category=' + category + '&menuid=' + id + "&t=1",
                        success: function(result) {
                            //alert(result.html());    
                            $("#divmiddlecontent").html(result);
                            $("#tax_hidden").hide();
                            itemfocus();
                            
                        }
                    });

					
                    $('#search-box').val(value);
                    $('#search_suggestion_holder').hide();
                    //$('#search-box').focus();
                    $('.quanty:last').focus().select();
                }
            } else {
                var keyword = $(this).val();
                //var menu = $('#MenuCardid').val();
                //var sub_menu = $('#sub_category').val();
                var accountsession = $('input[name="accountsession"]:checked').val();
                var category = $('.getcategory:checked').map(function() {
                    return this.value;
                }).get().join(',');
                var categ_id = $('input:hidden[name=categ_id]').val();
                var search2_text = ($('#categ_id').val());
                if (search2_text == null || search2_text == '') {
                    var categ_id = '';
                }
                if (category != null && category != '') {
                    if (categ_id != null && categ_id != '') {
                        var categ = categ_id + "," + category;
                    } else {
                        var categ = category;
                    }
                } else {
                    var categ = categ_id;
                }

                if (keyword != "") {

                    $('#loader').show();
                    setTimeout(function() {
                        $.ajax({
                            url: 'get_suggestions.php',
                            data: 'keyword=' + keyword + "&category=" + categ + "&accountsession=" + accountsession,
                            success: function(data) {
                                $('#search_suggestion_holder').html(data);
                                $('#search_suggestion_holder').show();
                                $('#loader').hide();
                                itemfocus();
                            }
                        });
                    }, 400);
                }
            }
        });
    });



    // category starts 

    $(document).ready(function() {
        var timer = null;
        
        function callcategorynameslist(e){
            e.preventDefault();
            var keyword = $(this).val();                                
	        if (keyword == "" || e.keyCode == 9)
	        {
	            
	            //var menu = $('#MenuCardid').val();
	            //var sub_menu = $('#sub_category').val();
	            //alert(menu);
	            //alert(sub_menu);
	            //var accountsession = $('input[name="accountsession"]:checked').val(); 
	            //var category = $('.getcategory:checked').map(function() {return this.value;}).get().join(',');
	            //$('#loader2').show();
	            setTimeout(function () {
	                $.ajax({
	                    url: 'getcategorynames.php',
	                    data: 'keyword=' + keyword,
	                    success: function (data) {                                
	                        $('#search-box2').html(data);
	                        //$('#search_suggestion_holder2').show();
	                        $('#loader2').hide();
	                        
	                    }
	                });
	            }, 400);
	        }
            else
            {
                $('#search_suggestion_holder2').hide();
            }
         }
            
    
        
        $('.form2 .custom-combobox-input').on("focusin", callcategorynameslist);
        $('.form2 .custom-combobox-input').on("keyup", callcategorynameslist);

        
        
        $('#ui-id-1').on('click', 'li', function() {
            $('#categ_id').val($('#search-box2 option:selected').attr('id'));
        });
// 
// 
        // $('#search-box2').focusout(function() {
            // if ($('#search-box2').val() == "") {
                // $('#search_suggestion_holder2').hide();
                // $('#categ_id').val("");
            // }
        // });

        $("input:text").focus(function() {
            $(this).select();
        });
        var timer = null;
        
        function callitemnameslist(e){
        	e.preventDefault();
            var keyword = $(this).val();                                
	        if (keyword == "" || e.keyCode == 9)
	        {
	        	var category = $('.getcategory:checked').map(function() {
                    return this.value;
                }).get().join(',');
                var categ_id = $('input:hidden[name=categ_id]').val();
                var search2_text = ($('#categ_id').val());
                if (search2_text == null || search2_text == '') {
                    var categ_id = '';
                }
                if (category != null && category != '') {
                    if (categ_id != null && categ_id != '') {
                        var categ = categ_id + "," + category;
                    } else {
                        var categ = category;
                    }
                } else {
                    var categ = categ_id;
                }

                //$('#loader').show();
                //var menu = $('#MenuCardid').val();
                //var sub_menu = $('#sub_category').val();

                var accountsession = $('input[name="accountsession"]:checked').val();
                var category = $('.getcategory:checked').map(function() {
                    return this.value;
                }).get().join(',');
                setTimeout(function() {

                    $.ajax({
                        url: 'get_data.php',
                        data: 'keyword=' + keyword + "&category=" + categ + "&accountsession=" + accountsession,
                        success: function(data) {
                            $('#search-box').html(data);
                            //$('#search_suggestion_holder').show();
                            //$('#loader').hide();
                            //$('#search-box').focus();
                           // itemfocus();
                            //alert('sadfas');

                        }
                    });

                }, 400);
	        }
        }
        $('.form .custom-combobox-input').on("focusin", callitemnameslist);
        $('.form .custom-combobox-input').on("keyup", callitemnameslist);
        
        $('#printclose').on('click', function() {
            var ordertype = $("#ordertype").val();
            var cartid = $("#order_cart_id").val();
            var billid = $("#order_bill_id").val();
            var sup_name = $("#suppliers").val();
            var accountsession = $('input[name="accountsession"]:checked').val();
            var tableno = $('.gettableid:checked').map(function() {
                return this.value;
            }).get().join(',');
            var chairs = $('.chairs:checked').map(function() {
                return this.value;
            }).get().join(',');
            $.ajax({
                type: 'POST',
                url: 'checking.php',
                data: 'action=checkgen&cartid=' + cartid,
                success: function(data) {
                    if (data == '1')
                        Save_bill(chairs, sup_name, cartid, billid, ordertype, accountsession, 1);
                    else
                        alert("Please Generate the Order Entry");
                }
            });

        });

        $('#chksno').on('click', function() {
            if ($('#chksno').prop("checked") == false)
                $('.classchk').prop("checked", false);
            else
                $('.classchk').prop("checked", true);
        });
        $('#chkparcel').on('click', function() {
            var orderids;
            if ($('#chkparcel').prop("checked") == false) {
                $('.pchk').prop("checked", false);
                orderids = '0##';
            } else {
                $('.pchk').prop("checked", true);
                orderids = '1##';
            }

            var ordertype = document.getElementById('ordertype').value;
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
            var data = 'action=parcelitem&ordertype=' + ordertype + '&tableid=' + tableid + '&orderids=' + orderids + '&chairs=' + chairs + '&editstatus=' + editstatus + '&cart_id=' + cart_id + '&category=' + category;
            $.ajax({
                type: "POST",
                url: "restaurantOrderEntry.php",
                data: data,
                success: function(result) {
                    $("#divmiddlecontent").html(result);
                }
            });

        });

        $('#separatebill').on('click', function() {
            var ordertype = $("#ordertype").val();
            var cartid = $("#order_cart_id").val();
            var cart_id = cartid;
            var tableno = $('.gettableid:checked').map(function() {
                return this.value;
            }).get().join(',');
            var chairs = $('.chairs:checked').map(function() {
                return this.value;
            }).get().join(',');
            $.ajax({
                type: 'POST',
                url: 'checking.php',
                data: 'action=checkgen&cartid=' + cartid,
                success: function(data) {
                    if (data == '0') {
                        // var x,y;
                        // x = 900;
                        // y = 700;
                        //var url_is = "separatebill.php?action=deptbill&tableno="+tableno+"&chairs="+chairs+"&ordertype="+ordertype+"&cartid="+cartid+'&cart_id='+cart_id;
                        //window.open(url_is,this.target,'width='+x+',height='+y+',left=5,top=5,scrollbars=1,resizable=yes');
                        $.ajax({
                            type: 'POST',
                            url: 'separatebill.php',
                            data: 'action=deptbill&tableno=' + tableno + '&chairs=' + chairs + '&ordertype=' + ordertype + '&cartid=' + cartid + '&cart_id=' + cart_id,
                            success: function(data) {


                            }
                        });
                        $.ajax({
                            type: 'POST',
                            url: 'checking.php',
                            data: 'action=update&depart=1&cartid=' + cartid,
                            success: function(data) {


                            }
                        });

                    } else
                        alert("Order Entry Generated");
                }
            });
        });

        $('.quanty').on('keyup', function() {
            var menuid = $(this).attr("data");
            var orderid = $(this).attr("data2");
            var qty = $(this).val();
            $.ajax({
                type: 'POST',
                url: 'checking.php',
                data: 'action=stockchk&orderid=' + orderid + '&menuid=' + menuid + '&qty=' + qty,
                success: function(data) {
                    var res = data.split("###");
                    if (res[0] == '1') {
                        alert("Available Stock Qantity " + res[1]);
                        $("#quantity_" + orderid).val(res[2]);
                        $("#quantity_" + orderid).focus();
                        $("#quantity_" + orderid).select();
                    } else if (res[0] == '2') {
                        alert("Available Stock Qantity " + res[1]);
                        orderquantity(orderid, qty);
                    } else
                        orderquantity(orderid, qty);


                }
            });
        });


        $('#Save').on('click', function() {
            var ordertype = $("#ordertype").val();
            var cartid = $("#order_cart_id").val();
            var billid = $("#order_bill_id").val();
            var accountsession = $('input[name="accountsession"]:checked').val();
            var tableno = $('.gettableid:checked').map(function() {
                return this.value;
            }).get().join(',');
            var chairs = $('.chairs:checked').map(function() {
                return this.value;
            }).get().join(',');
            var sup_name = $('#suppliers').val();

            $.ajax({
                type: 'POST',
                url: 'checking.php',
                data: 'action=checkgen&cartid=' + cartid,
                success: function(data) {
                    if (data == '1') {
                        Save_bill(chairs, sup_name, cartid, billid, ordertype, accountsession, '');
                        $('#tableid').val('');
                        $('#suppliers').val('');
                        $('#noofpersons').val('');
                        alert($('#noofpersons').val());
                        $('.getcategory').prop("checked", false);
                    } else
                        alert("Please Generate the Order Entry");
                }
            });

        });

        //Move to item code when tab key pressing in quantity


        $('.quanty').on('keypress', function(e) {
            if (e.keyCode === 9) {
                e.preventDefault();
                $('#itemcode').focus();
            }
        });
        $('.cquantity').on('keypress', function(e) {
            if (e.keyCode === 9) {
                e.preventDefault();
                $(this).parents('tr').next().find('.cquantity').focus();
            }
            else if(e.keyCode === 9 && e.keyCode === 16){
            	alert('test');
            	e.preventDefault();
                $(this).parents('tr').next().find('.cquantity').focus();
            }
        });
        $('.classchk').on('keypress', function(e) {
            if (e.keyCode === 9) {
                e.preventDefault();
                $(this).parents('tr').next().find('.classchk').focus();
            }
            else if(e.keyCode === 9 && e.keyCode === 16){
            	e.preventDefault();
                $(this).parents('tr').prev().find('.classchk').focus();
            }
        });



        $('#itemcode').keyup(function(e) {

            // item name by item code ----- Start

            var item_code_value = $('input:text[name=itemcode]').val();
            if (item_code_value != "") {

                //$('#itemname').val(item_code_value);
                var data = item_code_value;

                $.ajax({
                    type: 'POST',
                    url: 'getitemnames.php',
                    data: {
                        data: data
                    },
                    success: function(resp) {
                        $('#item_name').html(resp);
                    }

                });

            } else {
                $('#item_name').html("");
            }

            // item name by item code ----- End

            if (e.keyCode === 13) {

                if (document.getElementById('item_code_result')) {
                    if ($(".accsession:checkbox:checked").length == 0) {
                        $("#error_service").show();
                        $("#error_service").html("Please Select Session");
                        $("#breakfast").focus();
                        return false;
                    }

                    if ($("#ordertype").val() == 'dine') {
                        if ($(".gettableid:checkbox:checked").length == 0) {
                            $("#error_service").show();
                            $("#error_service").html("Please Select Table");
                            $(window).scrollTop('#error_service');
                            $(".gettableid").focus();
                            return false;
                        } else if ($(".chairs:checkbox:checked").length == 0) {
                            $("#error_service").show();
                            $("#error_service").html("Please Select Chair");
                            $(window).scrollTop('#error_service');
                            $(".chairs").focus();
                            return false;
                        } else if ($("#suppliers").val() == "") {
                            $("#error_service").show();
                            $("#error_service").html("Please Select the Supplier");
                            $(window).scrollTop('#error_service');
                            $("#suppliers").focus();
                            return false;
                        } else if ($("#noofpersons").val() == "") {
                            $("#error_service").show();
                            $("#error_service").html("Please Enter the No. of Persons");
                            $(window).scrollTop('#error_service');
                            $("#noofpersons").focus();
                            return false;
                        }
                    }

                    var suppliers = $("#suppliers").val();
                    var noofpersons = $("#noofpersons").val();
                    var editstatus = $("#editstatus").val();
                    var itemcode = $('#itemcode').val();
                    var ordertype = $("#ordertype").val();
                    var accountsession = $('input[name="accountsession"]:checked').val();
                    var tableid = $('.gettableid:checked').map(function() {
                        return this.value;
                    }).get().join(',');
                    var chairs = $('.chairs:checked').map(function() {
                        return this.value;
                    }).get().join(',');
                    var category = $('.getcategory:checked').map(function() {
                        return this.value;
                    }).get().join(',');
                    var cart_id = $("#order_cart_id").val();
                    $.ajax({
                        type: 'POST',
                        url: 'checking.php',
                        data: 'action=itemavilchk1&itemcode=' + itemcode,
                        success: function(data) {
                            if (data == 1) {
                                $.ajax({
                                    type: 'POST',
                                    url: 'restaurantOrderEntry.php',
                                    data: 'action=' + 'savemenulistres' + '&cart_id=' + cart_id + '&ordertype=' + ordertype + '&editstatus=' + editstatus + '&tableid=' + tableid + '&chairs=' + chairs + '&suppliers=' + suppliers + '&accountsession=' + accountsession + '&noofpersons=' + noofpersons + '&category=' + category + '&itemcode=' + itemcode,
                                    success: function(result) {
                                        //alert(result);
                                        $("#divmiddlecontent").html(result);
                                        $("#tax_hidden").hide();
                                        $('.quanty').last().focus().select();
                                        //$('#itemcode').focus();
                                    }
                                });
                            } else if (data == 2)
                                alert("Item Code does not Exist");
                            else
                                alert("Available Quantity : 0");

                        }
                    });
					$('.quanty').last().focus().select();
                    $.ajax({
                        type: 'POST',
                        url: 'checking.php',
                        data: 'action=itemavil&itemcode=' + itemcode,
                        success: function(data) {
                            var res = data.split("###");
                            if (res != '') {
                                $.tinyNotice({
                                    status: "warning",
                                    statusTitle: res[0],
                                    statusText: "Available Quantity :" + res[1],
                                    lifeTime: 10000
                                });
                            }

                        }
                    });

                } else {
                    alert("Item does no exist!!");
                }

            }



        });


        $('.accsession').on('click', function() {
            var session = $(this).val();
            $('.accsession').prop("checked", false);
            $(this).prop("checked", true);
            if (session == 'E') {
                if (confirm("Are you sure you want to end today's Order Entry !") == true) {
                    if (confirm("Conform again  !") == true) {

                        $.ajax({
                            type: 'POST',
                            url: 'checking.php',
                            data: "action=updatesession&session=" + session,
                            success: function(data) {
                                var res = data.split("##");
                                if (res[0] == 1) {
                                    var sessionbrief = session_name(session);
                                    var sessionid = sessionbrief.toLowerCase();
                                    alert(sessionbrief + " Session has been Closed");
                                    $('#' + sessionid).prop("checked", false);
                                    if (res[1] != '') {
                                        var sessionnext = session_name(res[1]);
                                        var sessionnextid = sessionnext.toLowerCase();
                                        $('#' + sessionnextid).prop("checked", true);
                                    }

                                }
                                $.ajax({
                                    type: 'POST',
                                    url: 'restaurantOrderEntry.php',
                                    data: "action=cagetoryfilter&session=" + session,
                                    success: function(data) {
                                        $("#divmiddlecontent").html(data);

                                    }
                                });
                            }
                        });
                        document.getElementById('endofday').disabled = false;
                    } else {
                        document.getElementById('endofday').checked = false;
                    }
                } else {
                    document.getElementById('endofday').checked = false;
                }


            } else {


                $.ajax({
                    type: 'POST',
                    url: 'checking.php',
                    data: "action=updatesession&session=" + session,
                    success: function(data) {
                        var res = data.split("##");
                        if (res[0] == 1) {
                            var sessionbrief = session_name(session);
                            var sessionid = sessionbrief.toLowerCase();
                            alert(sessionbrief + " Session has been Closed");
                            $('#' + sessionid).prop("checked", false);
                            if (res[1] != '') {
                                var sessionnext = session_name(res[1]);
                                var sessionnextid = sessionnext.toLowerCase();
                                $('#' + sessionnextid).prop("checked", true);
                            }

                        }
                        $.ajax({
                            type: 'POST',
                            url: 'restaurantOrderEntry.php',
                            data: "action=cagetoryfilter&session=" + session,
                            success: function(data) {
                                $("#divmiddlecontent").html(data);

                            }
                        });
                    }
                });


            }

        });


        $('#bill_cancel_cmt').on('click', function() {
            var cartid = $("#order_cart_id").val();

            $.ajax({
                type: 'POST',
                url: 'checking.php',
                data: "action=deptordchk&cartid=" + cartid,
                success: function(data) {
                    if (data == '1') {
                        var n = confirm("Do You Want to Cancel Bill? If yes, Please Fill the Comments Box");
                        if (n == true)
                            $("#cancelcmt").show();
                    }


                }
            });


        });


        $('#nocashamt').on('click', function() {
            var cartid = $("#order_cart_id").val();
            $.ajax({
                type: 'POST',
                url: 'checking.php',
                data: 'action=checkgen&cartid=' + cartid,
                success: function(data) {
                    if (data == '1') {
                        var n = confirm("Please Fill the Comments Box");
                        if (n == true)
                            $("#nocashcmt").show();
                    } else
                        alert("Please Generate the Order Entry");
                }
            });

        });

        $('#omitcancel').on('click', function() {
            $("#cancelcmt").hide();
            $("#cancelcomments").val('');
        });

        $('#omitnocash').on('click', function() {
            $("#nocashcmt").hide();
            $("#nocashcomments").val('');
        });


        $('#bill_nocash').on('click', function() {
            var accountsession = $('input[name="accountsession"]:checked').val();
            if ($("#nocashcomments").val() == '') {
                alert("Please Enter the Comments");
                $("#nocashcomments").focus();
                return false;
            }

            var ordertype = $("#ordertype").val();
            var cartid = $("#order_cart_id").val();
            var tableid = $('.gettableid:checked').map(function() {
                return this.value;
            }).get().join(',');
            var chairs = $('.chairs:checked').map(function() {
                return this.value;
            }).get().join(',');
            var nocashcomments = $("#nocashcomments").val();
            bill_nocash('bill_nocash', cartid, chairs, nocashcomments);
            print_nocashbill(chairs, cartid, accountsession);
            close_bill('close_cancel', cartid, chairs);
        });



        $('#bill_cancel').on('click', function() {
            if ($("#cancelcomments").val() == '') {
                alert("Please Enter the Comments");
                $("#cancelcomments").focus();
                return false;
            }

            var ordertype = $("#ordertype").val();
            var cartid = $("#order_cart_id").val();
            var cancelcomments = $("#cancelcomments").val();
            var tableno = $('.gettableid:checked').map(function() {
                return this.value;
            }).get().join(',');
            var chairs = $('.chairs:checked').map(function() {
                return this.value;
            }).get().join(',');
            $.ajax({
                type: 'POST',
                url: 'checking.php',
                data: "action=deptordchk&cartid=" + cartid,
                success: function(data) {
                    if (data == '1') {
                        var x, y;
                        x = 900;
                        y = 700;
                        // var url_is = "separatebill.php?action=cancelbill&tableno=" + tableno + "&ordertype=" + ordertype + "&chairs=" + chairs + "&cartid=" + cartid;
                        // window.open(url_is, this.target, 'width=' + x + ',height=' + y + ',left=5,top=5,scrollbars=1,resizable=yes');
                        $.ajax({
                            type: 'POST',
                            url: 'separatebill.php',
                            data: "action=cancelbill&tableno=" + tableno + "&ordertype=" + ordertype + "&chairs=" + chairs + "&cartid=" + cartid,
                            success: function(data) {


                            }
                        });
                    }

                }
            });
            bill_cancel('bill_cancel', cartid, chairs, cancelcomments)
        });



        $('#item_cancel').on('click', function() {
            var fields = $("input[name='checkbox[]']:checked").serializeArray();
            alert(JSON.stringify(fields));
            if (fields.length == 0) {
                alert('Please Select the Item for Cancel');
                return false;
            }

            var ordertype = $("#ordertype").val();
            var cartid = $("#order_cart_id").val();
            var tableno = $('.gettableid:checked').map(function() {
                return this.value;
            }).get().join(',');
            var chairs = $('.chairs:checked').map(function() {
                return this.value;
            }).get().join(',');
            cancelitems();
            var chkitems = $("input[name='checkbox[]']:checked").map(function() {
                return Number(this.value);
            }).get();
            var editstatus = $("#editstatus").val();
            var x, y;
            x = 900;
            y = 700;
            // var url_is = "separatebill.php?action=cancelitem&tableno=" + tableno + "&ordertype=" + ordertype + "&chairs=" + chairs + "&cartid=" + cartid + "&chkitems=" + chkitems + '&editstatus=' + editstatus;
            // window.open(url_is, this.target, 'width=' + x + ',height=' + y + ',left=5,top=5,scrollbars=1,resizable=yes');
            $.ajax({
                type: 'POST',
                url: 'separatebill.php',
                data: "action=cancelitem&tableno=" + tableno + "&ordertype=" + ordertype + "&chairs=" + chairs + "&cartid=" + cartid + "&chkitems=" + chkitems + '&editstatus=' + editstatus,
                success: function(data) {

                }
            });
        });

        $('.pchk').on('click', function() {
            var orderids;
            if ($(this).prop("checked") == true)
                orderids = '1##' + $(this).attr('data');
            else
                orderids = '0##' + $(this).attr('data');
            var ordertype = document.getElementById('ordertype').value;
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
            var data = 'action=parcelitem&ordertype=' + ordertype + '&tableid=' + tableid + '&orderids=' + orderids + '&chairs=' + chairs + '&editstatus=' + editstatus + '&cart_id=' + cart_id + '&category=' + category;
            $.ajax({
                type: "POST",
                url: "restaurantOrderEntry.php",
                data: data,
                success: function(result) {
                    $("#divmiddlecontent").html(result);
                }
            });
        });

    });

    function showState(sel) {
        var country_id = sel.options[sel.selectedIndex].value;
        $("#output1").html("");
        if (country_id.length > 0) {

            $.ajax({
                type: "POST",
                url: "subcategory.php",
                data: "country_id=" + country_id,
                cache: false,
                beforeSend: function() {
                    $('#output1').html('<img src="images/loading.gif" alt="" width="24" height="24">');
                },
                success: function(html) {
                    $("#output1").html(html);
                }
            });
        }
    }


    function getmenubill(id) {
        //alert(id);
        $.ajax({
            type: "POST",
            url: "bill_menu.php",
            data: 'action=' + "billmenu" + '&tableid=' + id,
            cache: false,
            beforeSend: function() {
                $('#itemreplace').html('<img src="images/loading.gif" alt="" width="24" height="24">');
            },
            success: function(html) {
                $("#items").hide();
                $("#itemreplace").html(html).show();
            }
        });
    }


    function calculateSum() {

        // alert("enter");
        var sum = 0;
        //iterate through each textboxes and add the values
        $(".txt").each(function() {

            //add only if the value is number
            if (!isNaN(this.value) && this.value.length != 0) {
                sum += parseFloat(this.value);
            }

        });
        $("#total_tax").val(sum);
        // alert(sum); //.toFixed() method will roundoff the final sum to 2 decimal places
        //$("#sum").html(sum.toFixed(2));
    }



    function get_amount_value(amt) {
        //alert(amt);

        if (document.getElementById('cash_pay_amount').value) {
            //alert(document.getElementById('cash_pay_amount').value); 
            var cash_amount = document.getElementById('cash_pay_amount').value;
        } else if (document.getElementById('cash_pay_amount').value == "") {

            var cash_amount = "0";
        }


        if (document.getElementById('card_pay_amount').value) {
            //alert("enter");
            var card_amount = document.getElementById('card_pay_amount').value;
        } else {
            var card_amount = "0";
        }


        if (document.getElementById('cheque_pay_amount').value) {
            //alert("enter");
            var cheque_amount = document.getElementById('cheque_pay_amount').value;
        } else {
            var cheque_amount = "0";
        }

        if (document.getElementById('online_pay_amount').value) {
            //alert("enter");
            var online_amount = document.getElementById('online_pay_amount').value;
        } else {
            var online_amount = "0";
        }


        //alert(pay_amount);
        var return_amount = ((document.getElementById('netamount_v').value) - cash_amount - card_amount - cheque_amount - online_amount);
        //alert(document.getElementById('netamount_v').value);
        //alert(return_amount);

        var return_amt = document.getElementById('return_amount').value = return_amount + '.00';
        //alert(return_amt);

    }

    function tabelshow_default(order) {
        if (order == 'dine') {
            document.getElementById('showtabel').style.display = 'table-row';
        }

    }

    function tabelshow(order) {
        //alert(order);	
        /* if(order!=''){
        	//alert(order);
        	document.getElementById('showsearch').style.display = 'table-row';
        	//document.getElementsByTagName('tableid').value = 1;
        } */
        if (order == 'dine') {
            // alert(order);
            // document.getElementById("tableid").innerHTML = "";
            document.getElementById('showtabel').style.display = 'table-row';
            document.getElementById('bill_row').style.display = 'none';
            //document.getElementsByTagName('tableid').value = 1;
        }
        if (order == 'parcel') {
            //alert(order);
            // document.getElementById("tableid").options.length=0;
            document.getElementById('showtabel').style.display = 'none';
            document.getElementById('bill_row').style.display = 'none';
            //document.getElementById("tableid").options.length = 0;
            $('#tableid').val('');
        }
    }


    function show_full() {

        if (document.getElementById('full').checked == true && document.getElementById('partial').checked == true) {
            document.getElementById("partial").checked = false;
            document.getElementById('partial_customer').style.display = 'none';

            document.getElementById('customer_name').value = '';
            document.getElementById('mobile').value = '';
            document.getElementById('address').value = '';

        }

        if (document.getElementById('full').checked == false && document.getElementById('partial').checked == false) {
            document.getElementById("partial").checked = true;
            document.getElementById('partial_customer').style.display = '';
        }

    }

    function show_partial() {
        if (document.getElementById('full').checked == true && document.getElementById('partial').checked == true) {
            document.getElementById("full").checked = false;
            document.getElementById('partial_customer').style.display = '';
        }

        if (document.getElementById('full').checked == false && document.getElementById('partial').checked == false) {
            document.getElementById("full").checked = true;
            document.getElementById('partial_customer').style.display = 'none';

            document.getElementById('customer_name').value = '';
            document.getElementById('mobile').value = '';
            document.getElementById('address').value = '';

        }
    }


    function show_cash() {

        if (document.getElementById('cash').checked == true && document.getElementById('card').checked == true && document.getElementById('cheque').checked == true) {
            alert("Your Select more than two mode");
            document.getElementById("cash").checked = false;
            return false;
        }
        if (document.getElementById('cash').checked == true && document.getElementById('card').checked == true && document.getElementById('online').checked == true) {
            alert("Your Select more than two mode");
            document.getElementById("cash").checked = false;
            return false;
        }
        if (document.getElementById('cash').checked == true && document.getElementById('cheque').checked == true && document.getElementById('online').checked == true) {
            alert("Your Select more than two mode");
            document.getElementById("cash").checked = false;
            return false;
        }
        if (document.getElementById('card').checked == true && document.getElementById('cheque').checked == true && document.getElementById('online').checked == true) {
            alert("Your Select more than two mode");
            document.getElementById("cash").checked = false;
            return false;
        }

        if (document.getElementById('cash').checked == false) {
            document.getElementById('customer_details').style.display = 'none';
            /*document.getElementById('card_details').style.display = 'none';
        document.getElementById('cheque_details').style.display = 'none';
        document.getElementById('online_payment').style.display = 'none';
        
        document.getElementById('card').checked=false;
        document.getElementById('cheque').checked=false;
         document.getElementById('online').checked=false; */
        } else {
            document.getElementById('customer_details').style.display = '';
            document.getElementById('cash_pay_amount').value = '';
            document.getElementById('return_amount').value = '';
            /*document.getElementById('card_details').style.display = 'none';
        document.getElementById('cheque_details').style.display = 'none';
        document.getElementById('online_payment').style.display = 'none';
        
        document.getElementById('card').checked=false;
        document.getElementById('cheque').checked=false;
         document.getElementById('online').checked=false;   */
        }
    }

    function show_card() {

        if (document.getElementById('cash').checked == true && document.getElementById('card').checked == true && document.getElementById('cheque').checked == true) {
            alert("Your Select more than two mode");
            document.getElementById("card").checked = false;
            return false;
        }

        if (document.getElementById('cash').checked == true && document.getElementById('card').checked == true && document.getElementById('online').checked == true) {
            alert("Your Select more than two mode");
            document.getElementById("card").checked = false;
            return false;
        }


        if (document.getElementById('cash').checked == true && document.getElementById('cheque').checked == true && document.getElementById('online').checked == true) {
            alert("Your Select more than two mode");
            document.getElementById("card").checked = false;
            return false;
        }


        if (document.getElementById('card').checked == true && document.getElementById('cheque').checked == true && document.getElementById('online').checked == true) {
            alert("Your Select more than two mode");
            document.getElementById("card").checked = false;
            return false;
        }
        if (document.getElementById('card').checked == true) {

            /*document.getElementById('customer_details').style.display = 'none';*/
            document.getElementById('card_details').style.display = 'inherit';
            /* document.getElementById('cheque_details').style.display = 'none';
             document.getElementById('online_payment').style.display = 'none';
             
              document.getElementById('cash').checked=false;
              document.getElementById('cheque').checked=false;
              document.getElementById('online').checked=false;*/

        } else {
            document.getElementById('card_pay_amount').value = '';
            document.getElementById('card_no').value = '';
            document.getElementById('card_name').value = '';
            document.getElementById('exp_date').value = '';
            document.getElementById('return_amount').value = '';

            /*document.getElementById('customer_details').style.display = 'none';*/
            document.getElementById('card_details').style.display = 'none';
            /* document.getElementById('cheque_details').style.display = 'none';
             document.getElementById('online_payment').style.display = 'none';
             
              document.getElementById('cash').checked=false;
              document.getElementById('cheque').checked=false;
              document.getElementById('online').checked=false;*/
        }
    }

    function show_cheque() {

        if (document.getElementById('cash').checked == true && document.getElementById('card').checked == true && document.getElementById('cheque').checked == true) {
            alert("Your Select more than two mode");
            document.getElementById("cheque").checked = false;
            return false;
        }

        if (document.getElementById('cash').checked == true && document.getElementById('card').checked == true && document.getElementById('online').checked == true) {
            alert("Your Select more than two mode");
            document.getElementById("cheque").checked = false;
            return false;
        }


        if (document.getElementById('cash').checked == true && document.getElementById('cheque').checked == true && document.getElementById('online').checked == true) {
            alert("Your Select more than two mode");
            document.getElementById("cheque").checked = false;
            return false;
        }


        if (document.getElementById('card').checked == true && document.getElementById('cheque').checked == true && document.getElementById('online').checked == true) {
            alert("Your Select more than two mode");
            document.getElementById("cheque").checked = false;
            return false;
        }
        if (document.getElementById('cheque').checked == true) {

            /*document.getElementById('customer_details').style.display = 'none';
            document.getElementById('card_details').style.display = 'none';*/
            document.getElementById('cheque_details').style.display = 'inherit';
            /*  document.getElementById('online_payment').style.display = 'none';
              
               document.getElementById('cash').checked=false;
               document.getElementById('card').checked=false;
               document.getElementById('online').checked=false;*/

        } else {

            document.getElementById('cheque_pay_amount').value = '';
            document.getElementById('cheque_no').value = '';
            document.getElementById('ceq_name').value = '';
            document.getElementById('ceq_date').value = '';
            document.getElementById('return_amount').value = '';
            /*document.getElementById('customer_details').style.display = 'none';
            document.getElementById('card_details').style.display = 'none';*/
            document.getElementById('cheque_details').style.display = 'none';
            /* document.getElementById('online_payment').style.display = 'none';
             
              document.getElementById('cash').checked=false;
              document.getElementById('card').checked=false;
              document.getElementById('online').checked=false;*/
        }
    }

    function show_online_payment() {
        if (document.getElementById('cash').checked == true && document.getElementById('card').checked == true && document.getElementById('cheque').checked == true) {
            alert("Your Select more than two mode");
            document.getElementById("online").checked = false;
            return false;
        }

        if (document.getElementById('cash').checked == true && document.getElementById('card').checked == true && document.getElementById('online').checked == true) {
            alert("Your Select more than two mode");
            document.getElementById("online").checked = false;
            return false;
        }

        if (document.getElementById('cash').checked == true && document.getElementById('cheque').checked == true && document.getElementById('online').checked == true) {
            alert("Your Select more than two mode");
            document.getElementById("online").checked = false;
            return false;
        }

        if (document.getElementById('card').checked == true && document.getElementById('cheque').checked == true && document.getElementById('online').checked == true) {
            alert("Your Select more than two mode");
            document.getElementById("online").checked = false;
            return false;
        }

        if (document.getElementById('online').checked == true) {

            /*document.getElementById('customer_details').style.display = 'none';
	document.getElementById('card_details').style.display = 'none';
        document.getElementById('cheque_details').style.display = 'none';*/
            document.getElementById('online_payment').style.display = 'inherit';

            /*  document.getElementById('cash').checked=false;
              document.getElementById('card').checked=false;
              document.getElementById('cheque').checked=false;*/
        } else {

            document.getElementById('online_pay_amount').value = '';
            document.getElementById('on_card_no').value = '';
            document.getElementById('on_card_name').value = '';
            document.getElementById('on_exp_date').value = '';
            document.getElementById('transactions_id').value = '';
            document.getElementById('return_amount').value = '';
            /*	document.getElementById('customer_details').style.display = 'none';
	document.getElementById('card_details').style.display = 'none';
        document.getElementById('cheque_details').style.display = 'none';*/
            document.getElementById('online_payment').style.display = 'none';

            /*   document.getElementById('cash').checked=false;
              document.getElementById('card').checked=false;
              document.getElementById('cheque').checked=false; */

        }
    }


    function carrytobill() {
        $("#carry").show();
    }

    function getcustomername(room) {

        $.ajax({
            type: "POST",
            url: "updatequantity.php",
            data: 'action=' + "getcustomername" + '&room=' + room,
            success: function(data) {
                $("#cus_name").val(data);
            }
        });
    }
</script>

<script>
    function show_bill_list() {

        document.getElementById('show_list_bill').style.display = "";
    }
</script>

<script type="text/javascript" language="JavaScript">
    function Get_tax() {
        if (document.getElementById('tax_box').checked == true) {
            // alert("true");
            $("#tax_div").hide();
            $("#tax_div1").show();
            Gettax();
        } else {
            $("#tax_div1").hide();
            $("#tax_div").show();
            Gettax1();
        }
    }
</script>

<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/dist/tinyNotice.js"></script>

<script>
    function show_list_bill() {
        // alert("enter");
        $(document).ready(function() {
            $("#show_list_bill").click(function() {
                $("#save_bill_content").slideToggle("slow");
            });




        });

    }

    var ordertype = $("#ordertype").val();
    if (ordertype == 'dine')
        tabelshow_default(ordertype);
	
</script>


<style type="text/css">
    div #carry {
        display: none;
    }
</style>