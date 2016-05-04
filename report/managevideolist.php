<?php
   $select_video = "SELECT * FROM video_details";

   $select_video_result=dbQuery($select_video); 
   
   if (isset($_GET['starting'])&& !isset($_REQUEST['submit'])) {
	$starting=$_GET['starting'];
  } else {
	$starting=0;
  }
  $recpage= 12;
  $obj= new pagination_class($select_video,$starting,$recpage); 
  $select_video_result = $obj->result;

?>
<script language="JavaScript">
function pagination(page) {
    window.location = "managevideo.php?&starting="+page+"&action=list";
}
</script>


  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="tblbg">

    <tr> 
      <td> 
        <table width="100%" border="0" cellpadding="2" cellspacing="1" class="t-a">
          <tr class="th-a"> 
            <td width="60%">Video Name</td>
            <td width="30%" align="center">Action</td>
          </tr>
          <?
       if(dbNumRows($select_video_result)>0) {
       while ($arow = dbFetchArray($select_video_result)) {
      ?>  
          <tr> 
            <td width="84%" class="tblrow"> 
              <?=$arow["video_name"]?>
            </td>
            <td  width="10%" class="tblrow" align="center">
            <a href="managevideo.php?video_id=<?php echo $arow["video_id"];?>&action=add&starting=<?php if(isset($_GET["starting"])){ echo $_GET["starting"];} else{ echo $starting;}?>"><img src="<?php echo DIR_WS_IMAGES?>edit.gif" alt="edit" title="edit" border="0" ></a>
            <a href="managevideo.php?video_id=<?php echo $arow["video_id"];?>&action=delete" onclick="return confirm('Are you sure you want to delete?')"><img src="images/delete.gif" border="0" alt="delete" title="delete"></a>
            </td>
           
          </tr>
          <?
			$k++;
	} if((!isset($_POST["go_x"])) &&(empty($_POST["searchtext"]))&&(empty($_GET["searchtext"]))){
?>   
<tr>
  <td colspan="4" align="right"><? echo $obj->anchors; ?></td>
</tr>
<?php
    }
  } else{
  ?>
  <tr>
    <td colspan="4" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" align="center"><font color="#FF0000"><strong>No Videos Available</strong></font></td>
  </tr>
 <?php  
  } 
 ?>    
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
<?php
    session_unregister("values");
    session_unregister("error");
?>