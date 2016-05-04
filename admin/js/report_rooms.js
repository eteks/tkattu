function submitfrmStudentUser(obj) {

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
		reqFaq1.open("GET", "report_rooms.php?" + pars, true);
		reqFaq1.send("");
}
function getViewList(customer_id,status) {

    var x,y;

    x = 700;

    y = 520;

    var url_is = 'report_rooms_view.php?id='+ customer_id + '&status=' + status;
//alert(url_is);
    window.open(url_is,this.target,'width='+x+',height='+y+',left=5,top=5,toolbar=no,menubar=no,scrollbars=no, resizable=yes');

}