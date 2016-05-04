function getMainRestaurant() {
	
	$.ajax({
      type:'POST',
      url:'restaurantOrderEntry.php',
      data:'',
      success: function(result){
      			              
               $("#divmiddlecontent").html(result);
               $('#ordertype').focus();
			   $("#bill_row").hide();
      }
      });
 }

function getMainLogout() {
        var pars = '';
        var url  = 'logout_menu.php';
        var myAjax = new Ajax.Updater(
        { success: 'divmiddlecontent' },
        url, {
            method: 'post',
            evalScripts: true,
            parameters: pars,
            oncomplete : function (req) {
            }
        });
}
function getMainAdmin() {
        var pars = '';
        var url  = 'admin_menu.php';
        var myAjax = new Ajax.Updater(
        { success: 'divmiddlecontent' },
        url, {
            method: 'post',
            evalScripts: true,
            parameters: pars,
            oncomplete : function (req) {
            }
        });
}