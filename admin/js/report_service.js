function order_act_total(obj) {

//alert("hi");
var formdate = document.getElementById("ddDateFrom").value;
var todate   = document.getElementById("ExDate").value;
    frm = obj;
    var errs=0;
	var reqFaq1 = new XMLHttpRequest();
	  reqFaq1.onreadystatechange = function () {
		if (reqFaq1.readyState == 4) {
			  if (reqFaq1.status == 200) {
					frm.submit();
			 } else {
				  alert("Error: While trying to process whatever you requested");
			 }
		  }
	 }
	 var pars = "formdate=" + formdate + "&todate" + todate;
	 reqFaq1.open("GET", "report_service.php?" + pars, true);
	 reqFaq1.send("");
}