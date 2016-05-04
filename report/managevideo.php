<?
include("includes/applicationTop.php");


if ($_GET["action"]=="delete") {

    $SELECT_IMAGE = "SELECT video_name   FROM video_details WHERE video_id='" . $_GET["video_id"] . "' ";
    $result_image = dbQuery($SELECT_IMAGE);
    $teamimage = dbFetchArray($result_image);
	
	print_R($teamimage);
    	
    @unlink("uploadvideo/".$teamimage['video_name']);
  //  @unlink("uploadvideo/thumb/".$teamimage['video_name']);
  $category_delete    = dbQuery("DELETE FROM  video_details WHERE video_id='" . $_GET["video_id"] . "'");
	
  redirect("managevideo.php?action=list&a=sucess&ms=3");
}



if (($_POST['submit'] == "Submit")||($_POST['submit'] == "Update")) {
  // print_R($_POST);
    session_unregister("values");
    session_unregister("error");
    $error = array();
    $fname          = basename($_FILES['image_name']['name']);

 	if (trim($fname) == '') {
	  $error[] = " Image";
	}  	


    print_R($_FILES);
	$_SESSION["values"] = $_POST;
	$_SESSION["error"] = $error;	
	
	if (count($error) > 0) {
	 if (empty($_POST["video_id"])){
    	 header("location:managevideo.php?action=add");
	 } else
	 {
    	 header("location:managevideo.php?action=add&categoryid=".$_POST["video_id"]);
	 }	 
	// redirect(FILENAME_USER);
  } else {
  
         if(empty($_POST["video_id"])) {

		  $uploaddir  = 'uploadvideo/';
		  $filename   = basename($_FILES['image_name']['name']);
		  $image_name = $filename;
		  $uploadfile = $uploaddir .$fname;
		  $thumbdir   = 'uploadvideo/thumb';
		  if (!is_dir($thumbdir)) {
			mkdir('uploadvideo/thumb', 0777);
			chmod('uploadvideo/thumb', 0777);
		  }
		  $destinationfile_thumb = 'uploadvideo/thumb/'.$filename;
		
		  //echo $uploadfile;
		  if (move_uploaded_file($_FILES['image_name']['tmp_name'], $uploadfile)) {
			//echo "No";
		  }
		
		//  $image_size = GetThumbnailSize($uploadfile,75 ,75 );
		 // $s = CreateThumbnail($uploadfile,$destinationfile_thumb,ceil($image_size[0]), ceil($image_size[1]));
  
			 $video_insert = dbQuery("INSERT INTO video_details SET video_name='" .  $image_name . "'");
			  session_unregister($_SESSION["values"]);
			  session_unregister($_SESSION["error"]);
			  redirect("managevideo.php?action=list&a=sucess&ms=1");
	  	} else {

	if ($fname!='') {
    $SELECT_IMAGE = "SELECT video_name   FROM video_details WHERE video_id='" . $_POST["video_id"] . "' ";
    $result_image = dbQuery($SELECT_IMAGE);
    $teamimage = dbFetchArray($result_image);
    @unlink("uploadvideo/".$teamimage['video_name']);
  //  @unlink("uploadvideo/thumb/".$teamimage['video_name']);
    $fname = basename($_FILES['image_name']['name']);
    $uploaddir = 'uploadvideo/';
    $filename = basename($_FILES['image_name']['name']);
    $image_name = $filename;
    $uploadfile = $uploaddir .$fname;
    $thumbdir   = 'uploadvideo/thumb';
    if (!is_dir($thumbdir)) {
      mkdir('uploadvideo/thumb', 0777);
      chmod('uploadvideo/thumb', 0777);
    }
    $destinationfile_thumb = 'uploadvideo/thumb/'.$filename;
    //echo $uploadfile;
    if (move_uploaded_file($_FILES['image_name']['tmp_name'], $uploadfile)) {
      //echo "No";
    }
   // $image_size = GetThumbnailSize($uploadfile,75 ,75 );
    //$s = CreateThumbnail($uploadfile,$destinationfile_thumb,ceil($image_size[0]), ceil($image_size[1]));
	   $video_update="UPDATE  video_details SET             
	  
		    video_name  ='".$image_name."'
 			 WHERE video_id='". $_POST["video_id"]."'";//exit;
        dbQuery($video_update);
     } 
  
		    session_unregister($_SESSION["values"]);
			session_unregister($_SESSION["error"]);
			redirect("managevideo.php?action=list&a=sucess&ms=2");
		}	 
  }		  
}
?>

<LINK href="main.css" type=text/css rel=stylesheet>
<form name="category" method="post" action="" enctype="multipart/form-data">

<TABLE  width="100%" cellSpacing=10 cellPadding=0  border=0 >
   <TR> 
      <TD width="73%" class=h1>Manage  Videos </TD>
	      <TD width="27%" align="right" >&nbsp; </TD>
    </TR>
  <TR>
    <TD  colspan="2" background="images/vdots.gif"><IMG height=1 
      src="images/spacer.gif" width=1 border=0></TD></TR>
  <TR>
              <TD align="right" colspan="2"><!--options-->&nbsp;&nbsp;
                  <IMG height=11 src="images/001.gif" width=8 border=0>
				   <A class="la" href="managevideo.php?action=add">
				   Insert  Videos </A> 
                  <!--/options-->                </TD>
            </TR>
</table><br />

  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="tblbg">

	  <?php
         if ((!empty($_GET["ms"]))&&($_GET["ms"]=="2") ) {
      ?>	 
    <tr>
      <td colspan="9" height="5">
      		  <strong><font color="green">Updated Successfully</font></strong>
      </td>
     </tr>
     <?php		 
		 }
	  ?>
      
	  <?php
         if ((!empty($_GET["ms"]))&&($_GET["ms"]=="1") ) {
      ?>	 
    <tr>
      <td colspan="9" height="5">
      		  <strong><font color="green">Added Successfully</font></strong>
      </td>
     </tr>
     <?php		 
		 }
	  ?>
	  <?php
         if ((!empty($_GET["ms"]))&&($_GET["ms"]=="3") ) {
      ?>	 
    <tr>
      <td colspan="9" height="5">
      		  <strong><font color="green">Deleted Successfully</font></strong>
      </td>
     </tr>
     <?php		 
		 }
	  ?>
      

      
	  <tr>
      <td valign="top" width="89%"  height="415" >
          
          <?php 
		  if($_GET["action"]=="add") {
		    include_once ("managevideobody.php");
		   }	
		  if($_GET["action"]=="list") {
		    include_once ("managevideolist.php");
		   }	
	      ?>
      
           </td>
           </tr>   
    </table>
      </td>
    </tr>
  </table>
</form>
