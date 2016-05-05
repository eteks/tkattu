<?php 
   if(!empty($_GET["video_id"])) {
	 $select_videodetails ="SELECT * FROM video_details WHERE video_id ='" . $_GET["video_id"] . "'";
     $select_videodetails_result=dbQuery($select_videodetails); 
     if ($myVals = dbFetchArray($select_videodetails_result)) {
	// print_r($myVals);

	
	
	
?>


<table class="lft-border" align="center" border="0" cellpadding="5" cellspacing="0" width="100%">
   <input type="hidden" value="<?=$_GET["video_id"]?>" name="video_id">
  	<?php
    if (count($_SESSION["error"]) > 0) {
    ?>
    <tr>
      <td colspan="2" class="arialbluebold">
        <div class="warning">
          <p><strong>Please enter the following <font color="red">*</font>Required fields below</strong></p>
          <?php
          $i=1;
          foreach ($_SESSION["error"] as $key => $val) {
              ?>
                <p><font color="red" style="font-family:'Courier New', Courier, monospace"><?php echo $i . " . " .$val;?></font></p>
              <?php
                $i++;
              }      
          ?>
        </div>
      </td>
    </tr>
    <?php
    }
    ?>
      <tr>
		  <td align="right"><span class="arial_12_black">Upload Video<font color="red">*</font></span></td>
		  <td><input type="file" name="image_name" class="file" /></td>
	  </tr>
      <tr align="center"><td colspan="2">
      <object width="425" height="344"><param name="movie" value="http://www.youtube.com/v/bbqBxPOOoeE&hl=en&fs=1"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="uploadvideo/<?php echo $myVals["video_name"];?>" type="Windows Media Audio/Video file" allowscriptaccess="always" allowfullscreen="true" width="425" height="344"></embed></object>
      </td>
      </tr>
	  <tr>
		  <td align="right"></td>
		  <td>
              <input type="submit" name="submit" id="submit" value="Update" size="47" class="but"/>
             <input type="button" name="cancel" id="cancel" value="Cancel"  onClick="window.location.href='managevideo.php?action=list'" class="but" />
          </td>
	  </tr>
           </table>
<?php
   }
  } else {
?>

<table class="lft-border" align="center" border="0" cellpadding="5" cellspacing="0" width="100%">
	<?php
    if (count($_SESSION["error"]) > 0) {
    ?>
    <tr>
      <td colspan="2" class="arialbluebold">
        <div class="warning">
          <p><strong>Please enter the following <font color="red">*</font>Required fields below</strong></p>
          <?php
          $i=1;
          foreach ($_SESSION["error"] as $key => $val) {
              ?>
                <p><font color="red" style="font-family:'Courier New', Courier, monospace"><?php echo $i . " . " .$val;?></font></p>
              <?php
                $i++;
              }      
          ?>
        </div>
      </td>
    </tr>
    <?php
    }
    ?>
      <tr>
		  <td align="right"><span class="arial_12_black">Upload Video<font color="red">*</font></span></td>
		  <td><input type="file" name="image_name" class="file" /></td>
	  </tr>
	  <tr>
		  <td align="right">&nbsp;</td>
		  <td>
              <input type="submit" name="submit" id="submit" value="Submit" size="47" class="but" />
              <input type="button" name="cancel" id="cancel" value="Cancel"  onClick="window.location.href='managevideo.php?action=list'" class="but" />
          </td>
	  </tr>
</table>
<?php
  }
?>