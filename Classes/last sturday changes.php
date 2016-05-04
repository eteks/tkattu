<?php include("header.php");?>
<!-- Magnific Popup core JS file -->
<link rel="stylesheet" href="css/magnific-popup.css">
<link rel="stylesheet" href="css/popup.css">
<script src="js/jquery.magnific-popup.js"></script> 
<script>
     $(document).ready(function() {
         
         var s = $("#selectprize").val();
         $('.popupdisplay').magnificPopup({
            type: 'inline',
            preloader: false,
         modal:false,
            closeOnBgClick: false, 
            focus: '#name',
          closeOnContentClick: false,
            // When elemened is focused, some mobile browsers in some cases zoom in
            // It looks not nice, so we disable it:
            callbacks: {
                beforeOpen: function() {
                    if (jQuery(window).width() < 700) {
                        this.st.focus = false;
                    } else {
                        this.st.focus = '#name';
                    }
                }
            }
        });
        
    });

</script>
<!--------magnific popup----------->
<?php

function confirm($msg)
{
	echo "<script type='text/javascript'>alert('$msg');</script>";

	}
?>
<form id="res_form" name="res_form" method="post" action="result.php" onsubmit="return validate();">
<div class="row">
<h3  style="color:#000;">Lottery Result Generation</h3>
</div>
<div class="row prize_sec">
<div class="row upload_pur">
<div class="col-xs-2"> Lottery Code</div>
<div class="col-xs-3">
<select id="lot_code" class="form-control" name="lot_code" onchange="getresultcode(this.value);"><option value="">-- Select --</option>
<?php $selectoption = db_query("SELECT lot_code,lot_id FROM ".MST_LOTTERY." WHERE lot_status='A' ORDER BY lot_id DESC");
while($fetchoption  = db_fetch_array($selectoption))
{?>
<option value="<?php echo $fetchoption['lot_id'];?>" <?php  if($_POST['lot_code']== $fetchoption['lot_id']){?> selected="selected" <?php }?>><?php echo $fetchoption['lot_code'] ;?></option>      
<?php  }
?>
</select>
</div>
<div class="col-xs-2">Result Code</div>
<div class="col-xs-3">
<input type="text" class="form-control" id="lot_resultcode" name="lot_resultcode"  value="<?php echo $_POST['lot_code'];?>" />
</div>
</div>
<div class="row upload_pur">
<div class="col-xs-2"> Sales</div>
<div class="col-xs-3">
<input type="text" class="form-control" id="lot_sale_per" name="lot_sale_per"  value="<?php echo $_POST['lot_sale_per'];?>"   />%
</div>
<div class="col-xs-2"> Return</div>
<div class="col-xs-3">
<input type="text" class="form-control" id="lot_return_per" name="lot_return_per" value="<?php echo $_POST['lot_return_per'];?>"   />%
<input type="hidden" id="lot_dav" name="lot_dav" />
</div>
</div>
<div class="col-xs-12 text-center">
<input type="submit" id="res_submit" name="res_submit" value="Submit" class="submit" />
<input type="button" id="res_reset" name="res_reset" value="Reset" onclick="window.location.href='result.php'" class="submit" />
</div>
</div>
</form>
<?php 
$randamcolor = 'style="color:#000000;';
if($_POST['res_submit']=="Submit")
{

$lot_code = $_POST['lot_code']; 
$lot_sale_per = $_POST['lot_sale_per']; 
$lot_return_per = $_POST['lot_return_per']; 
$select = db_query("SELECT lot_day,lot_name,lot_code FROM ".MST_LOTTERY." WHERE lot_id='".$lot_code."'");
$fetch  = db_fetch_array($select);
$resselect = db_query("SELECT * FROM ".RESULT." WHERE res_lot_code='".$fetch[lot_code]."'");

?>

<div class="row" id="resultext">
<h3  style="color:#000;">Results</h3>
</div>
<div class="row prize_result_sec" id="percentgrid">
<div class="col-xs-4 overall_sales">
<div class="col-xs-6 prize_win">Overall Sales</div>
<div class="col-xs-3 prize_per1">
<h1><?php echo overallsales();?></h1>
</div>
<div class="col-xs-3" style="	padding-top: 15px;
padding-bottom: 15px;"><strong>%</strong></div>
</div>
<div class="col-xs-4 overall_sales">
<div class="col-xs-6 prize_win">Sales</div>
<div class="col-xs-3 prize_per1">
<h1><?php echo $_POST['lot_sale_per'];?></h1>
</div>
<div class="col-xs-3" style="	padding-top: 15px;
padding-bottom: 15px;"><strong>%</strong></div>
</div>
<div class="col-xs-4 overall_sales">
<div class="col-xs-6 prize_win">Return</div>
<div class="col-xs-3 prize_per1">
<h1><?php echo $_POST['lot_return_per'];?></h1>
</div>
<div class="col-xs-3" style="padding-top: 15px;
padding-bottom: 15px;"><strong>%</strong></div>
</div>
</div>

<input type="hidden" id="gen" name="gen" value="<?php echo $resselect;?>" />

<div id="resultgrid" style="display: block; font-size: 15px; color: #D6D6D6;">
<?php if(db_num_rows($resselect)==0){?>  
<div class="row prize_six">
<h3 class="text-center"><?php echo $fetch['lot_day'].' '.$fetch['lot_name'].' Results' ;?></h3>
<div class="row">
<div class="col-xs-2">First Prize</div>
<?php 
$firstprize  = db_query("SELECT ret_lot_code, ret_drawn_no, ret_lot_num, ret_lot_type, ret_series FROM ".NEW_SALERETURN." WHERE ret_lot_type='R' AND ret_lot_code='".$fetch['lot_code']."' AND ret_lot_num  NOT IN ( SELECT res_num_full  FROM ".RESULT."  WHERE res_lot_code ='".$fetch['lot_code']."') order by RAND() limit 0,1");

$row1 = db_fetch_array($firstprize);
db_query("INSERT INTO ".RESULT." SET res_lot_code='".$row1['ret_lot_code']."',res_drawnno='".$row1['ret_drawn_no']."',res_prize='01', res_lot_num='".$row1['ret_lot_num']."' , res_type='".$row1['ret_lot_type']."',res_code='".resultcode($fetch['lot_code'])."', res_series='".$row1['ret_series']."',res_num_full='".$row1['ret_lot_num']."'");
?>
<div class="col-xs-3" >
    <input type="text" id="firstprize_series" maxlength="1" name="firstprize_series" value="<?php echo $row1['ret_series'];?>" disabled="dsiabled"  class="text-field" style="margin-left:16px;"/>
<input type="text" id="firstprize" maxlength="6" name="firstprize" value="<?php echo $row1['ret_lot_num'];?>" disabled="dsiabled" class="wholee text-field-prize" />
<input type="text" id="firstprize_type" maxlength="1" name="firstprize_type" value="<?php echo $row1['ret_lot_type'];?>" disabled="dsiabled" class="text-field" />
<input type="hidden" id="firstprize_full" maxlength="1" name="firstprize_full" value="<?php echo $row1['ret_lot_num'];?>" disabled="dsiabled" class="text-field" />
</div>
<div class="col-xs-9 col-xs-offset-2" style="margin-top:25px; margin-bottom:25px; margin-left: 45px;">
<a href="#viewDtlsPopup" class="popupdisplay lottery-btn-edit" onclick="selectedit(1);resetlogin();" style="margin-left: 192px;" >Edit</a>    
<!--<input type="button" id="first_edit" onclick="enabled(1,'E');" name="first_edit" value="Edit" class="submit_btn" />-->
<input type="button" id="first_save" name="second_save" value="Save" class="submit_btn_save" />
</div>
</div>

<div class="row">
<div class="col-xs-2">Second Prize</div>
<?php
$secondprize  = db_query("SELECT ret_lot_code, ret_drawn_no, ret_lot_num, ret_lot_type, ret_series FROM ".NEW_SALERETURN." WHERE ret_lot_type='R' AND ret_lot_code='".$fetch['lot_code']."' AND ret_lot_num  NOT IN ( SELECT res_num_full  FROM ".RESULT."  WHERE res_lot_code ='".$fetch['lot_code']."') order by RAND() limit 0,1");
$row2 = db_fetch_array($secondprize);
db_query("INSERT INTO ".RESULT." SET res_lot_code='".$row2['ret_lot_code']."',res_drawnno='".$row2['ret_drawn_no']."',res_prize='02', res_lot_num='".$row2['ret_lot_num']."' , res_type='".$row2['ret_lot_type']."',res_code='".resultcode($fetch['lot_code'])."',res_num_full='".$row2['ret_lot_num']."'");
?>
<div class="col-xs-2">
<input type="text" id="secondprize" maxlength="5" name="secondprize" value="<?php echo substr($row2['ret_lot_num'],-5);?>" class="wholee text-field-prize" disabled="dsiabled" style="margin-left:15px;"/> 
<input type="text" id="secondprize_type" maxlength="1" name="secondprize_type" disabled="dsiabled" value="<?php echo $row2['ret_lot_type'];?>" class="text-field" />  
<input type="hidden" id="secondprize_full" maxlength="1" name="secondprize_full" value="<?php echo $row2['ret_lot_num'];?>" disabled="dsiabled" class="text-field" />
</div>
<div class="col-xs-9 col-xs-offset-2" style="margin-top:25px; margin-bottom:25px;">
<a href="#viewDtlsPopup" class="popupdisplay lottery-btn-edit" onclick="selectedit(2);resetlogin();" style="margin-left:49px;">Edit</a>     
<!--<input type="button" id="second_edit" onclick="enabled(2,'E');" name="second_edit" value="Edit" class="submit_btn" />-->
<input type="button" id="second_save" name="second_save" value="Save" class="submit_btn_save" />
</div>
</div>

<div class="row">
<div class="col-xs-2">Third Prize</div>
<div class="col-xs-10">
    
 <?php   
$lot_sale_per345 = $lot_sale_per/10;
$lot_return_per345 = $lot_return_per/10;

 for($i=0;$i<=10-1;$i++)
 { 
 
$thirdprize_n  = db_query("SELECT SUBSTRING( `ret_lot_num` , 2) as num,ret_lot_code, ret_drawn_no, ret_lot_num, ret_lot_type FROM ".NEW_SALERETURN." WHERE  ret_lot_code='".$fetch['lot_code']."' AND ret_lot_type='R' AND ret_lot_num  NOT IN ( SELECT res_num_full  FROM ".RESULT."  WHERE res_lot_code ='".$fetch['lot_code']."') order by RAND()");  

	$thirdprize  = db_query("SELECT SUBSTRING( `ret_lot_num` , 2) as num,ret_lot_code, ret_drawn_no, ret_lot_num, ret_lot_type FROM ".NEW_SALERETURN." WHERE SUBSTRING( `ret_lot_num` , 2 ) LIKE '".$i."%' AND  ret_lot_code='".$fetch['lot_code']."' AND ret_lot_num  NOT IN ( SELECT res_num_full  FROM ".RESULT."  WHERE res_lot_code ='".$fetch['lot_code']."') AND ret_lot_type='S' order by RAND()"); 	
 
$sale=db_query("SELECT COUNT(*) as res_type FROM ".RESULT." WHERE res_lot_code='".$fetch['lot_code']."' AND res_prize='03' AND res_type='S'"); 
 while($count=db_fetch_array($sale))
 {
$count1 = $count['res_type'];		
 }
if($count1 < $lot_sale_per345)
{
if(db_num_rows($thirdprize)>0)
	{ 
while($row3 = db_fetch_array($thirdprize))
	{	
if($i==substr($row3['num'],0,1))    

     db_query("INSERT INTO ".RESULT." SET res_lot_code='".$fetch['lot_code']."',res_drawnno='".$row3['ret_drawn_no']."',res_prize='03', res_lot_num='".$row3['num']."' , res_type='".$row3['ret_lot_type']."',res_code='".resultcode($fetch['lot_code'])."',res_num_full='".$row3['res_num_full']."'"); 
	if($thirdstore=='')
    $thirdstore =$row3['num'].'_'.$row3['ret_lot_type'].'_'.$row3['ret_drawn_no'].'_'.$row3['ret_lot_num'];
    else
    $thirdstore .=','.$row3['num'].'_'.$row3['ret_lot_type'].'_'.$row3['ret_drawn_no'].'_'.$row3['ret_lot_num'];
    break;

}
}
else
{
if(db_num_rows($thirdprize_n)>0)
{
 while($row3 = db_fetch_array($thirdprize_n))
{
     db_query("INSERT INTO ".RESULT." SET res_lot_code='".$fetch['lot_code']."',res_drawnno='".$row3['ret_drawn_no']."',res_prize='03', res_lot_num='".$row3['num']."' , res_type='".$row3['ret_lot_type']."',res_code='".resultcode($fetch['lot_code'])."',res_num_full='".$row3['res_num_full']."'"); 
	  if($thirdstore=='')
    $thirdstore =$row3['num'].'_'.$row3['ret_lot_type'].'_'.$row3['ret_drawn_no'].'_'.$row3['ret_lot_num'].'_'.$randamcolor;
    else
    $thirdstore .=','.$row3['num'].'_'.$row3['ret_lot_type'].'_'.$row3['ret_drawn_no'].'_'.$row3['ret_lot_num'].'_'.$randamcolor;
    break; 
}
}
}
}
 else
{
 if(db_num_rows($thirdprize_n)>0)
{
 while($row3 = db_fetch_array($thirdprize_n))
{
     db_query("INSERT INTO ".RESULT." SET res_lot_code='".$fetch['lot_code']."',res_drawnno='".$row3['ret_drawn_no']."',res_prize='03', res_lot_num='".$row3['num']."' , res_type='".$row3['ret_lot_type']."',res_code='".resultcode($fetch['lot_code'])."',res_num_full='".$row3['res_num_full']."'"); 
	   if($thirdstore=='')
    $thirdstore =$row3['num'].'_'.$row3['ret_lot_type'].'_'.$row3['ret_drawn_no'].'_'.$row3['ret_lot_num'].'_'.$randamcolor;
    else
    $thirdstore .=','.$row3['num'].'_'.$row3['ret_lot_type'].'_'.$row3['ret_drawn_no'].'_'.$row3['ret_lot_num'].'_'.$randamcolor;
    break; 
}
}
} 
 }
 $thirddata = explode(',',$thirdstore); 
for($ii=0;$ii<=10-1;$ii++)
{
$thirdsplit = explode('_',$thirddata[$ii]); 
$third_lot_nums   = $thirdsplit[0];
$third_lot_types  = $thirdsplit[1];
$third_lot_drawn  = $thirdsplit[2];
$third_num_full   = $thirdsplit[3];
$third_style            = $thirdsplit[4];
?>   
<div class="col-xs-2">
<input type="text" id="thirdprize_series<?php echo $ii+1;?>" maxlength="1" name="thirdprize_series<?php echo $ii+1;?>>" value="<?php echo $ii;?>" disabled="dsiabled" class="text-field" />
<input type="text" id="thirdprize<?php echo $ii+1;?>" maxlength="4" <?php echo $third_style;?>  name="thirdprize<?php echo $ii+1;?>" value="<?php echo substr($third_lot_nums,-4);?>" disabled="dsiabled" class="whole thirdcls text-field-prize" />
<input type="text" disabled="dsiabled" maxlength="1" id="thirdprize_type<?php echo $ii+1;?>" name="thirdprize_type<?php echo $ii+1;?>" value="<?php echo $third_lot_types;?>" class="text-field" />
<input type="hidden" id="thirdprize_full<?php echo $ii+1;?>" maxlength="1" name="thirdprize_full<?php echo $ii+1;?>" value="<?php echo $row3['ret_lot_num'];?>" disabled="dsiabled" class="text-field" />
</div>
<?php } ?>
<?php    
//for($i=10;$i<=9;$i++)
// {
// $thirdprize  = db_query("SELECT SUBSTRING( `ret_lot_num` , 2) as num,ret_lot_code, ret_drawn_no, ret_lot_num, ret_lot_type FROM ".NEW_SALERETURN." WHERE SUBSTRING( `ret_lot_num` , 2 ) LIKE '".$i."%' AND  ret_lot_code='".$fetch['lot_code']."' AND ret_lot_type='R'  AND ret_lot_num  NOT IN ( SELECT res_num_full  FROM ".RESULT."  WHERE res_lot_code ='".$fetch['lot_code']."') order by RAND() limit 0,$lot_return_per345");
// 
// 
// $thirdprize_n  = db_query("SELECT SUBSTRING( `ret_lot_num` , 2) as num,ret_lot_code, ret_drawn_no, ret_lot_num, ret_lot_type FROM ".NEW_SALERETURN." WHERE   ret_lot_code='".$fetch['lot_code']."' AND ret_lot_type='R' AND ret_lot_num  NOT IN ( SELECT res_num_full  FROM ".RESULT."  WHERE res_lot_code ='".$fetch['lot_code']."')  order by RAND() limit 0,$lot_return_per345");
//if(db_num_rows($thirdprize)>0)
//{
// while($row3 = db_fetch_array($thirdprize))
//{
//if($i==substr($row3['num'],0,1))    
//{
//    if($thirdstore=='')
//    $thirdstore =$row3['num'].'_'.$row3['ret_lot_type'].'_'.$row3['ret_drawn_no'].'_'.$row3['ret_lot_num'];
//    else
//    $thirdstore .=','.$row3['num'].'_'.$row3['ret_lot_type'].'_'.$row3['ret_drawn_no'].'_'.$row3['ret_lot_num'];
//    break;    
//}
//} 
//}
// else
//{
//if(db_num_rows($thirdprize_n)>0)
//{
// while($row3 = db_fetch_array($thirdprize_n))
//{
//   if($thirdstore=='')
//    $thirdstore =$row3['num'].'_'.$row3['ret_lot_type'].'_'.$row3['ret_drawn_no'].'_'.$row3['ret_lot_num'].'_'.$randamcolor;
//    else
//    $thirdstore .=','.$row3['num'].'_'.$row3['ret_lot_type'].'_'.$row3['ret_drawn_no'].'_'.$row3['ret_lot_num'].'_'.$randamcolor;
//} 
//}
//}
//}
//$thirddata = explode(',',$thirdstore); 
//for($ii=10;$ii<=9;$ii++)
//{
//$thirdsplit = explode('_',$thirddata[$ii]); 
//$third_lot_nums   = $thirdsplit[0];
//$third_lot_types  = $thirdsplit[1];
//$third_lot_drawn  = $thirdsplit[2];
//$third_num_full   = $thirdsplit[3];
//$third_style            = $thirdsplit[4];
//db_query("INSERT INTO ".RESULT." SET res_lot_code='".$fetch['lot_code']."',res_drawnno='".$third_lot_drawn."',res_prize='03', res_lot_num='".substr($third_lot_nums,-4)."' , res_type='".$third_lot_types."',res_code='".resultcode($fetch['lot_code'])."',res_num_full='".$third_num_full."'");
?>   
<div class="col-xs-2">
<!--<input type="text" id="thirdprize_series<?php echo $ii+1;?>" maxlength="1" name="thirdprize_series<?php echo $ii+1;?>>" value="<?php echo $ii;?>" disabled="dsiabled" class="text-field" />
<input type="text" id="thirdprize<?php echo $ii+1;?>" maxlength="4" <?php echo $third_style;?>  name="thirdprize<?php echo $ii+1;?>" value="<?php echo substr($third_lot_nums,-4);?>" disabled="dsiabled" class="whole thirdcls text-field-prize" />
<input type="text" disabled="dsiabled" maxlength="1" id="thirdprize_type<?php echo $ii+1;?>" name="thirdprize_type<?php echo $ii+1;?>" value="<?php echo $third_lot_types;?>" class="text-field" />
<input type="hidden" id="thirdprize_full<?php echo $ii+1;?>" maxlength="1" name="thirdprize_full<?php echo $ii+1;?>" value="<?php echo $row3['ret_lot_num'];?>" disabled="dsiabled" class="text-field" />-->
</div>
<?php //} ?>    

<div class="col-xs-9 col-xs-offset-2" style="margin-top:25px; margin-bottom:25px;">
<a href="#viewDtlsPopup" class="popupdisplay lottery-btn-edit" onclick="selectedit(3);resetlogin();" style="margin-left:-148px;">Edit</a>   
<!--<input type="button" id="third_edit" onclick="enabled(3,'E');" name="third_edit" value="Edit" class="submit_btn" />-->
<input type="button" id="third_save" name="third_save" value="Save" class="submit_btn_save" />
<input type="hidden" id="thirdcount" name="thirdcount" value="<?php echo $ii+1;?>"  />
</div>
</div>  
</div>
<div class="row">
<div class="col-xs-2">Fourth Prize</div>
<div class="col-xs-10">
    
 <?php   

 for($i4=0;$i4<=10-1;$i4++)
 { 
 
 
 $fourthprize  = db_query("SELECT SUBSTRING( `ret_lot_num` , 3) as num,ret_lot_code, ret_drawn_no, ret_lot_num, ret_lot_type FROM ".NEW_SALERETURN." WHERE SUBSTRING( `ret_lot_num` , 3 ) LIKE '".$i4."%' AND  ret_lot_code='".$fetch['lot_code']."' AND ret_lot_type='S' AND ret_lot_num  NOT IN ( SELECT res_num_full  FROM ".RESULT."  WHERE res_lot_code ='".$fetch['lot_code']."') order by RAND() limit 0,$lot_sale_per345"); 
 
$fourthprize_n  = db_query("SELECT SUBSTRING( `ret_lot_num` , 3) as num,ret_lot_code, ret_drawn_no, ret_lot_num, ret_lot_type FROM ".NEW_SALERETURN." WHERE  ret_lot_code='".$fetch['lot_code']."' AND ret_lot_type='R' AND ret_lot_num  NOT IN ( SELECT res_num_full  FROM ".RESULT."  WHERE res_lot_code ='".$fetch['lot_code']."') order by RAND()");   
 
 $sale=db_query("SELECT COUNT(*) as res_type FROM ".RESULT." WHERE res_lot_code='".$fetch['lot_code']."' AND res_prize='04' AND res_type='S'"); 
 while($count=db_fetch_array($sale))
 {
$count1 = $count['res_type'];		
 }
 
if($count1 < $lot_sale_per345)
{
if(db_num_rows($fourthprize)>0)
{
 while($row4 = db_fetch_array($fourthprize))
{
if($i4==substr($row4['num'],0,1))    
{
	db_query("INSERT INTO ".RESULT." SET res_lot_code='".$fetch['lot_code']."',res_drawnno='".$row4['ret_drawn_no']."',res_prize='04', res_lot_num='".$row4['num']."' , res_type='".$row4['ret_lot_type']."',res_code='".resultcode($fetch['lot_code'])."',res_num_full='".$row4['res_num_full']."'");
    if($fourthstore=='')
    $fourthstore =$row4['num'].'_'.$row4['ret_lot_type'].'_'.$row4['ret_drawn_no'].'_'.$row4['ret_lot_num'];
    else
    $fourthstore .=','.$row4['num'].'_'.$row4['ret_lot_type'].'_'.$row4['ret_drawn_no'].'_'.$row4['ret_lot_num'];
    break;    
}
} 
}
else
{
if(db_num_rows($fourthprize_n)>0)
{
 while($row4 = db_fetch_array($fourthprize_n))
{
	db_query("INSERT INTO ".RESULT." SET res_lot_code='".$fetch['lot_code']."',res_drawnno='".$row4['ret_drawn_no']."',res_prize='04', res_lot_num='".$row4['num']."' , res_type='".$row4['ret_lot_type']."',res_code='".resultcode($fetch['lot_code'])."',res_num_full='".$row4['res_num_full']."'");
    if($fourthstore=='')
    $fourthstore =$row4['num'].'_'.$row4['ret_lot_type'].'_'.$row4['ret_drawn_no'].'_'.$row4['ret_lot_num'].'_'.$randamcolor;
    else
    $fourthstore .=','.$row4['num'].'_'.$row4['ret_lot_type'].'_'.$row4['ret_drawn_no'].'_'.$row4['ret_lot_num'].'_'.$randamcolor;
    break; 
}
}
}
}
 else
{
  if(db_num_rows($fourthprize_n)>0)
{
 while($row4 = db_fetch_array($fourthprize_n))
{
	db_query("INSERT INTO ".RESULT." SET res_lot_code='".$fetch['lot_code']."',res_drawnno='".$row4['ret_drawn_no']."',res_prize='04', res_lot_num='".$row4['num']."' , res_type='".$row4['ret_lot_type']."',res_code='".resultcode($fetch['lot_code'])."',res_num_full='".$row4['res_num_full']."'");
    if($fourthstore=='')
    $fourthstore =$row4['num'].'_'.$row4['ret_lot_type'].'_'.$row4['ret_drawn_no'].'_'.$row4['ret_lot_num'].'_'.$randamcolor;
    else
    $fourthstore .=','.$row4['num'].'_'.$row4['ret_lot_type'].'_'.$row4['ret_drawn_no'].'_'.$row4['ret_lot_num'].'_'.$randamcolor;
    break; 
}
}
} 
}

$fourthdata = explode(',',$fourthstore); 
for($i4i=0;$i4i<=10-1;$i4i++)
{
$fourthsplit = explode('_',$fourthdata[$i4i]); 
$fourth_lot_nums   = $fourthsplit[0];
$fourth_lot_types  = $fourthsplit[1];
$fourth_lot_drawn  = $fourthsplit[2];
$fourth_num_full  = $fourthsplit[3];
$fourth_style  = $fourthsplit[4];
?>   
<div class="col-xs-2">
<input type="text" id="fourthprize_series<?php echo $i4i+1;?>" maxlength="1" name="fourthprize_series<?php echo $i4i+1;?>>" value="<?php echo $i4i;?>" disabled="dsiabled" class="text-field" />
<input type="text" id="fourthprize<?php echo $i4i+1;?>" maxlength="3" <?php echo $fourth_style;?> name="fourthprize<?php echo $i4i+1;?>" value="<?php echo substr($fourth_lot_nums,-3);?>" disabled="dsiabled" class="whole fourthcls text-field-prize" />
<input type="text" disabled="dsiabled" maxlength="1" id="fourthprize_type<?php echo $i4i+1;?>" name="fourthprize_type<?php echo $i4i+1;?>" value="<?php echo $fourth_lot_types;?>" class="text-field" />
<input type="hidden" id="fourthprize_full<?php echo $ii+1;?>" maxlength="1" name="fourthprize_full<?php echo $ii+1;?>" value="<?php echo $row4['ret_lot_num'];?>" disabled="dsiabled" class="text-field" />
</div>
<?php } ?>
<?php    
 //for($i4=10;$i4<=9;$i4++)
// {
// $fourthprize  = db_query("SELECT SUBSTRING( `ret_lot_num` , 3) as num,ret_lot_code, ret_drawn_no, ret_lot_num, ret_lot_type FROM ".NEW_SALERETURN." WHERE SUBSTRING( `ret_lot_num` , 3 ) LIKE '".$i4."%' AND  ret_lot_code='".$fetch['lot_code']."' AND ret_lot_type='R' AND ret_lot_num  NOT IN ( SELECT res_num_full  FROM ".RESULT."  WHERE res_lot_code ='".$fetch['lot_code']."')  order by RAND() limit 0,$lot_return_per345");
// 
// $fourthprize_n  = db_query("SELECT SUBSTRING( `ret_lot_num` , 3) as num,ret_lot_code, ret_drawn_no, ret_lot_num, ret_lot_type FROM ".NEW_SALERETURN." WHERE   ret_lot_code='".$fetch['lot_code']."' AND ret_lot_type='R'  AND ret_lot_num  NOT IN ( SELECT res_num_full  FROM ".RESULT."  WHERE res_lot_code ='".$fetch['lot_code']."') order by RAND() ");
//if(db_num_rows($fourthprize)>0)
//{
// while($row4 = db_fetch_array($fourthprize))
//{
//if($i4==substr($row4['num'],0,1))    
//{
//    if($fourthstore=='')
//    $fourthstore =$row4['num'].'_'.$row4['ret_lot_type'].'_'.$row4['ret_drawn_no'].'_'.$row4['ret_lot_num'];
//    else
//    $fourthstore .=','.$row4['num'].'_'.$row4['ret_lot_type'].'_'.$row4['ret_drawn_no'].'_'.$row4['ret_lot_num'];
//    break;    
//}
//} 
//}
// else
//{
//if(db_num_rows($fourthprize_n)>0)
//{
// while($row4 = db_fetch_array($fourthprize_n))
//{
//   if($fourthstore=='')
//    $fourthstore =$row4['num'].'_'.$row4['ret_lot_type'].'_'.$row4['ret_drawn_no'].'_'.$row4['ret_lot_num'].'_'.$randamcolor;
//    else
//    $fourthstore .=','.$row4['num'].'_'.$row4['ret_lot_type'].'_'.$row4['ret_drawn_no'].'_'.$row4['ret_lot_num'].'_'.$randamcolor;
//} 
//}
//}
//}
//
//$fourthdata = explode(',',$fourthstore); 
//for($i4i=10;$i4i<=9;$i4i++)
//{
//$fourthsplit = explode('_',$fourthdata[$i4i]); 
//$fourth_lot_nums   = $fourthsplit[0];
//$fourth_lot_types  = $fourthsplit[1];
//$fourth_lot_drawn  = $fourthsplit[2];
//$fourth_num_full = $fourthsplit[3];
//$fourth_style  = $fourthsplit[4];
//db_query("INSERT INTO ".RESULT." SET res_lot_code='".$fetch['lot_code']."',res_drawnno='".$fourth_lot_drawn."',res_prize='04', res_lot_num='".substr($fourth_lot_nums,-3)."' , res_type='".$fourth_lot_types."',res_code='".resultcode($fetch['lot_code'])."',res_num_full='".$fourth_num_full."'");
?>   
<div class="col-xs-2">
<!--<input type="text" id="fourthprize_series<?php echo $i4i+1;?>" maxlength="1" name="fourthprize_series<?php echo $i4i+1;?>>" value="<?php echo $i4i;?>" disabled="dsiabled" class="text-field" />
<input type="text" id="fourthprize<?php echo $i4i+1;?>" maxlength="3" <?php echo $fourth_style;?> name="fourthprize<?php echo $i4i+1;?>" value="<?php echo substr($fourth_lot_nums,-3);?>" disabled="dsiabled" class="whole fourthcls text-field-prize" />
<input type="text" disabled="dsiabled" maxlength="1" id="fourthprize_type<?php echo $i4i+1;?>" name="fourthprize_type<?php echo $i4i+1;?>" value="<?php echo $fourth_lot_types;?>" class="text-field" />
<input type="hidden" id="fourthprize_full<?php echo $ii+1;?>" maxlength="1" name="fourthprize_full<?php echo $ii+1;?>" value="<?php echo $row4['ret_lot_num'];?>" disabled="dsiabled" class="text-field" />-->
</div>
<?php //} ?>    

<div class="col-xs-9 col-xs-offset-2" style="margin-top:25px; margin-bottom:25px;">
<a href="#viewDtlsPopup" class="popupdisplay lottery-btn-edit" onclick="selectedit(4);resetlogin();" style="margin-left:-148px;">Edit</a>   
<!--<input type="button" id="fourth_edit" onclick="enabled(3,'E');" name="fourth_edit" value="Edit" class="submit_btn" />-->
<input type="button" id="fourth_save" name="fourth_save" value="Save" class="submit_btn_save" />
<input type="hidden" id="fourthcount" name="fourthcount" value="<?php echo $i4i+1;?>"  />
</div>
</div>  
</div>

<div class="row">
<div class="col-xs-2">Fifth Prize</div>
<div class="col-xs-10">
    
 <?php   

 for($i5=0;$i5<=10-1;$i5++)
 { 
 $fifthprize  = db_query("SELECT SUBSTRING( `ret_lot_num` , 3) as num,ret_lot_code, ret_drawn_no, ret_lot_num, ret_lot_type FROM ".NEW_SALERETURN." WHERE SUBSTRING( `ret_lot_num` , 3 ) LIKE '".$i5."%' AND  ret_lot_code='".$fetch['lot_code']."' AND ret_lot_type='S' AND ret_lot_num  NOT IN ( SELECT res_num_full  FROM ".RESULT."  WHERE res_lot_code ='".$fetch['lot_code']."') order by RAND() limit 0,$lot_sale_per345"); 
 
 $fifthprize_n  = db_query("SELECT SUBSTRING( `ret_lot_num` , 3) as num,ret_lot_code, ret_drawn_no, ret_lot_num, ret_lot_type FROM ".NEW_SALERETURN." WHERE  ret_lot_code='".$fetch['lot_code']."' AND ret_lot_type='R' AND ret_lot_num  NOT IN ( SELECT res_num_full  FROM ".RESULT."  WHERE res_lot_code ='".$fetch['lot_code']."') order by RAND()");  
 
 
 $sale=db_query("SELECT COUNT(*) as res_type FROM ".RESULT." WHERE res_lot_code='".$fetch['lot_code']."' AND res_prize='05' AND res_type='S'"); 
 while($count=db_fetch_array($sale))
 {
$count1 = $count['res_type'];		
 }
 
if($count1 < $lot_sale_per345)
{
if(db_num_rows($fifthprize)>0)
{
 while($row5 = db_fetch_array($fifthprize))
{
if($i5==substr($row5['num'],0,1))    
{
	db_query("INSERT INTO ".RESULT." SET res_lot_code='".$fetch['lot_code']."',res_drawnno='".$row5['ret_drawn_no']."',res_prize='05', res_lot_num='".$row4['num']."' , res_type='".$row5['ret_lot_type']."',res_code='".resultcode($fetch['lot_code'])."',res_num_full='".$row5['res_num_full']."'");
    if($fifthstore==''){
    $fifthstore =$row5['num'].'_'.$row5['ret_lot_type'].'_'.$row5['ret_drawn_no'].'_'.$row5['ret_lot_num']; 
	}
    else{
	    $fifthstore.=','.$row5['num'].'_'.$row5['ret_lot_type'].'_'.$row5['ret_drawn_no'].'_'.$row5['ret_lot_num'];
    break; 
	}   
}
} 
}
else
 
{
	 
  if(db_num_rows($fifthprize_n)>0)
{
 while($row5 = db_fetch_array($fifthprize_n))
{
	db_query("INSERT INTO ".RESULT." SET res_lot_code='".$fetch['lot_code']."',res_drawnno='".$row5['ret_drawn_no']."',res_prize='05', res_lot_num='".$row5['num']."' , res_type='".$row5['ret_lot_type']."',res_code='".resultcode($fetch['lot_code'])."',res_num_full='".$row5['res_num_full']."'");
    if($fifthstore=='')
    $fifthstore =$row5['num'].'_'.$row5['ret_lot_type'].'_'.$row5['ret_drawn_no'].'_'.$row5['ret_lot_num'].'_'.$randamcolor;
    else
    $fifthstore .=','.$row5['num'].'_'.$row5['ret_lot_type'].'_'.$row5['ret_drawn_no'].'_'.$row5['ret_lot_num'].'_'.$randamcolor;
    break; 
}
}
} 

}
 else
 
{
	 
  if(db_num_rows($fifthprize_n)>0)
{
 while($row5 = db_fetch_array($fifthprize_n))
{
	db_query("INSERT INTO ".RESULT." SET res_lot_code='".$fetch['lot_code']."',res_drawnno='".$row5['ret_drawn_no']."',res_prize='05', res_lot_num='".$row5['num']."' , res_type='".$row5['ret_lot_type']."',res_code='".resultcode($fetch['lot_code'])."',res_num_full='".$row5['res_num_full']."'");
    if($fifthstore=='')
    $fifthstore =$row5['num'].'_'.$row5['ret_lot_type'].'_'.$row5['ret_drawn_no'].'_'.$row5['ret_lot_num'].'_'.$randamcolor;
    else
    $fifthstore .=','.$row5['num'].'_'.$row5['ret_lot_type'].'_'.$row5['ret_drawn_no'].'_'.$row5['ret_lot_num'].'_'.$randamcolor;
    break; 
}
}
} 
}

$fifthdata = explode(',',$fifthstore); 
for($i5i=0;$i5i<=10-1;$i5i++)
{
$fifthsplit = explode('_',$fifthdata[$i5i]); 
$fifth_lot_nums   = $fifthsplit[0];
$fifth_lot_types  = $fifthsplit[1];
$fifth_lot_drawn  = $fifthsplit[2];
$fifth_num_full   = $fifthsplit[3];
$fifth_style      = $fifthsplit[4];
?>   
<div class="col-xs-2">
<input type="text" id="fifthprize_series<?php echo $i5i+1;?>" maxlength="1" name="fifthprize_series<?php echo $i5i+1;?>>" value="<?php echo $i5i;?>" disabled="dsiabled" class="text-field" />
<input type="text" id="fifthprize<?php echo $i5i+1;?>" maxlength="3" <?php echo $fifth_style;?> name="fifthprize<?php echo $i5i+1;?>" value="<?php echo substr($fifth_lot_nums,-3);?>" disabled="dsiabled" class="whole fifthcls text-field-prize" />
<input type="text" disabled="dsiabled" maxlength="1" id="fifthprize_type<?php echo $i5i+1;?>" name="fifthprize_type<?php echo $i5i+1;?>" value="<?php echo $fifth_lot_types;?>" class="text-field" />
<input type="hidden" id="fifthprize_full<?php echo $ii+1;?>" maxlength="1" name="fifthprize_full<?php echo $ii+1;?>" value="<?php echo $row5['ret_lot_num'];?>" disabled="dsiabled" class="text-field" />
</div>
<?php } ?>
<?php    
// for($i5=10;$i5<=9;$i5++)
// {
// $fifthprize  = db_query("SELECT SUBSTRING( `ret_lot_num` , 3) as num,ret_lot_code, ret_drawn_no, ret_lot_num, ret_lot_type FROM ".NEW_SALERETURN." WHERE SUBSTRING( `ret_lot_num` , 3 ) LIKE '".$i5."%' AND  ret_lot_code='".$fetch['lot_code']."' AND ret_lot_type='R'  AND ret_lot_num  NOT IN ( SELECT res_num_full  FROM ".RESULT."  WHERE res_lot_code ='".$fetch['lot_code']."') order by RAND() limit 0,$lot_return_per345");
// 
// $fifthprize_n  = db_query("SELECT SUBSTRING( `ret_lot_num` , 3) as num,ret_lot_code, ret_drawn_no, ret_lot_num, ret_lot_type FROM ".NEW_SALERETURN." WHERE   ret_lot_code='".$fetch['lot_code']."' AND ret_lot_type='R'  AND ret_lot_num  NOT IN ( SELECT res_num_full  FROM ".RESULT."  WHERE res_lot_code ='".$fetch['lot_code']."') order by RAND() limit 0,$lot_return_per345");
//if(db_num_rows($fifthprize)>0)
//{
// while($row5 = db_fetch_array($fifthprize))
//{
//if($i5==substr($row5['num'],0,1))    
//{
//    if($fifthstore=='')
//    $fifthstore =$row5['num'].'_'.$row5['ret_lot_type'].'_'.$row5['ret_drawn_no'].'_'.$row5['ret_lot_num'];
//    else
//    $fifthstore .=','.$row5['num'].'_'.$row5['ret_lot_type'].'_'.$row5['ret_drawn_no'].'_'.$row5['ret_lot_num'];
//    break;    
//}
//} 
//}
// else
//{
//if(db_num_rows($fifthprize_n)>0)
//{
// while($row5 = db_fetch_array($fifthprize_n))
//{
//   if($fifthstore=='')
//    $fifthstore =$row5['num'].'_'.$row5['ret_lot_type'].'_'.$row5['ret_drawn_no'].'_'.$row5['ret_lot_num'].'_'.$randamcolor;
//    else
//    $fifthstore .=','.$row5['num'].'_'.$row5['ret_lot_type'].'_'.$row5['ret_drawn_no'].'_'.$row5['ret_lot_num'].'_'.$randamcolor;
//} 
//}
//}
//}
//
//$fifthdata = explode(',',$fifthstore); 
//for($i5i=10;$i5i<=9;$i5i++)
//{
//$fifthsplit = explode('_',$fifthdata[$i5i]); 
//$fifth_lot_nums   = $fifthsplit[0];
//$fifth_lot_types  = $fifthsplit[1];
//$fifth_lot_drawn  = $fifthsplit[2];
//$fifth_num_full   = $fifthsplit[3];
//$fifth_style      = $fifthsplit[4];
//db_query("INSERT INTO ".RESULT." SET res_lot_code='".$fetch['lot_code']."',res_drawnno='".$fifth_lot_drawn."',res_prize='05', res_lot_num='".substr($fifth_lot_nums,-3)."' , res_type='".$fifth_lot_types."',res_code='".resultcode($fetch['lot_code'])."',res_num_full='".$fifth_num_full."'");
?>   
<div class="col-xs-2">
<!--<input type="text" id="fifthprize_series<?php echo $i5i+1;?>" maxlength="1" name="fifthprize_series<?php echo $i5i+1;?>>" value="<?php echo $i5i;?>" disabled="dsiabled" class="text-field" />
<input type="text" id="fifthprize<?php echo $i5i+1;?>" maxlength="3"  <?php echo $fifth_style;?> name="fifthprize<?php echo $i5i+1;?>" value="<?php echo substr($fifth_lot_nums,-3);?>" disabled="dsiabled" class="whole fifthcls text-field-prize" />
<input type="text" disabled="dsiabled" maxlength="1" id="fifthprize_type<?php echo $i5i+1;?>" name="fifthprize_type<?php echo $i5i+1;?>" value="<?php echo $fifth_lot_types;?>" class="text-field" />
<input type="hidden" id="fifthprize_full<?php echo $ii+1;?>" maxlength="1" name="fifthprize_full<?php echo $ii+1;?>" value="<?php echo $row5['ret_lot_num'];?>" disabled="dsiabled" class="text-field" />-->
</div>
<?php //} ?>    

<div class="col-xs-9 col-xs-offset-2" style="margin-top:25px; margin-bottom:25px;">
<a href="#viewDtlsPopup" class="popupdisplay lottery-btn-edit" onclick="selectedit(5);resetlogin();" style="margin-left:-148px;">Edit</a>   
<!--<input type="button" id="fifth_edit" onclick="enabled(3,'E');" name="fifth_edit" value="Edit" class="submit_btn" />-->
<input type="button" id="fifth_save" name="fifth_save" value="Save" class="submit_btn_save" />
<input type="hidden" id="fifthcount" name="fifthcount" value="<?php echo $i5i+1;?>"  />
</div>
</div>  
</div>

<div class="row">
<div class="col-xs-2">Sixth Prize</div>
<div class="col-xs-10">
    
 <?php   
 for($i6=0;$i6<=100-1;$i6++)
 { 
 if(strlen($i6)==2) 
 $i62 = substr($i6,1,2); 
else
 $i62 = $i6;  
 

 $sixthprize = db_query("SELECT SUBSTRING( `ret_lot_num` , 3) as num,ret_lot_code, ret_drawn_no, ret_lot_num, ret_lot_type FROM ".NEW_SALERETURN." WHERE SUBSTRING( `ret_lot_num` , 3 ) LIKE '".$i62."%' AND  ret_lot_code='".$fetch['lot_code']."' AND ret_lot_type='S' AND ret_lot_num  NOT IN ( SELECT res_num_full  FROM ".RESULT."  WHERE res_lot_code ='".$fetch['lot_code']."') order by RAND() ");
 
 $sixthprize_n  = db_query("SELECT SUBSTRING( `ret_lot_num` , 3) as num,ret_lot_code, ret_drawn_no, ret_lot_num, ret_lot_type FROM ".NEW_SALERETURN." WHERE  ret_lot_code='".$fetch['lot_code']."' AND ret_lot_type='R' AND ret_lot_num  NOT IN ( SELECT res_num_full  FROM ".RESULT."  WHERE res_lot_code ='".$fetch['lot_code']."') order by RAND()");  
 
 $sale=db_query("SELECT COUNT(*) as res_type FROM ".RESULT." WHERE res_lot_code='".$fetch['lot_code']."' AND res_prize='06' AND res_type='S'"); 
 while($count=db_fetch_array($sale))
 {
$count1 = $count['res_type'];		
 }
 
if($count1 < $lot_sale_per)
{
 
if(db_num_rows($sixthprize)>0)
{
 while($row6 = db_fetch_array($sixthprize))
{
if($i62==substr($row6['num'],0,1))    
{
	db_query("INSERT INTO ".RESULT." SET res_lot_code='".$fetch['lot_code']."',res_drawnno='".$row6['ret_drawn_no']."',res_prize='06', res_lot_num='".$row6['num']."' , res_type='".$row6['ret_lot_type']."',res_code='".resultcode($fetch['lot_code'])."',res_num_full='".$row6['res_num_full']."'");
    if($sixthstore=='')
    $sixthstore =$row6['num'].'_'.$row6['ret_lot_type'].'_'.$row6['ret_drawn_no'].'_'.$row6['ret_lot_num']; 
    else
	    $sixthstore.=','.$row6['num'].'_'.$row6['ret_lot_type'].'_'.$row6['ret_drawn_no'].'_'.$row6['ret_lot_num'];
    break; 
}
} 
}

else
{
if(db_num_rows($sixthprize_n)>0)
{
 while($row6 = db_fetch_array($sixthprize_n))
{
	db_query("INSERT INTO ".RESULT." SET res_lot_code='".$fetch['lot_code']."',res_drawnno='".$row6['ret_drawn_no']."',res_prize='06', res_lot_num='".$row6['num']."' , res_type='".$row6['ret_lot_type']."',res_code='".resultcode($fetch['lot_code'])."',res_num_full='".$row6['res_num_full']."'");
    if($sixthstore=='')
    $sixthstore =$row6['num'].'_'.$row6['ret_lot_type'].'_'.$row6['ret_drawn_no'].'_'.$row6['ret_lot_num'].'_'.$randamcolor; 
    else
    $sixthstore .=','.$row6['num'].'_'.$row6['ret_lot_type'].'_'.$row6['ret_drawn_no'].'_'.$row6['ret_lot_num'].'_'.$randamcolor;
    break; 
}
}
} 
}
else
 
{
	 
	
  if(db_num_rows($sixthprize_n)>0)
{
 while($row6 = db_fetch_array($sixthprize_n))
{
	db_query("INSERT INTO ".RESULT." SET res_lot_code='".$fetch['lot_code']."',res_drawnno='".$row6['ret_drawn_no']."',res_prize='05', res_lot_num='".$row6['num']."' , res_type='".$row6['ret_lot_type']."',res_code='".resultcode($fetch['lot_code'])."',res_num_full='".$row6['res_num_full']."'");
    if($sixthstore=='')
    $sixthstore =$row6['num'].'_'.$row6['ret_lot_type'].'_'.$row6['ret_drawn_no'].'_'.$row6['ret_lot_num'].'_'.$randamcolor; 
    else
    $sixthstore .=','.$row6['num'].'_'.$row6['ret_lot_type'].'_'.$row6['ret_drawn_no'].'_'.$row6['ret_lot_num'].'_'.$randamcolor;
    break; 
}
}
} 
}

$sixthdata = explode(',',$sixthstore); 
for($i6i=0;$i6i<=100-1;$i6i++)
{
if(strlen($i6i)==2)   
$i62 = substr($i6i,1,2);
else 
$i62 = $i6i;

$sixthsplit = explode('_',$sixthdata[$i6i]); 
$sixth_lot_nums   = $sixthsplit[0];
//echo $sixth_lot_nums;
$sixth_lot_types  = $sixthsplit[1];
$sixth_lot_drawn  = $sixthsplit[2];
$sixth_num_full   = $sixthsplit[3];
$sixth_style      = $sixthsplit[4];

 
?>   
<div class="col-xs-2">
<input type="text" id="sixthprize_series<?php echo $i6i+1;?>" maxlength="1" name="sixthprize_series<?php echo $i6i+1;?>>" value="<?php echo $i62;?>" disabled="dsiabled" class="text-field" />
<input type="text" id="sixthprize<?php echo $i6i+1;?>" maxlength="3"  <?php echo $sixth_style;?> name="sixthprize<?php echo $i6i+1;?>" value="<?php echo substr($sixth_lot_nums,-3);?>" disabled="dsiabled" class="whole sixthcls text-field-prize" />
<input type="text" disabled="dsiabled" maxlength="1" id="sixthprize_type<?php echo $i6i+1;?>" name="sixthprize_type<?php echo $i6i+1;?>" value="<?php echo $sixth_lot_types;?>" class="text-field" />
<input type="hidden" id="sixthprize_full<?php echo $ii+1;?>" maxlength="1" name="sixthprize_full<?php echo $ii+1;?>" value="<?php echo $row6['ret_lot_num'];?>" disabled="dsiabled" class="text-field" />
<input type="hidden" id="sixthcode" value="<?php echo $fetch['lot_code']; ?>" >
</div>
<?php } ?>
<?php   
	  
 //for($i6=100;$i6<=99;$i6++)
// {
//if(strlen($i6)==2){   
//$i62 = substr($i6,1,2);  
// }
//else {
//$i62 = $i6;
// }      
// $sixthprize  = db_query("SELECT SUBSTRING( `ret_lot_num` , 3) as num,ret_lot_code, ret_drawn_no, ret_lot_num, ret_lot_type FROM ".NEW_SALERETURN." WHERE SUBSTRING( `ret_lot_num` , 3 ) LIKE '".$i62."%' AND  ret_lot_code='".$fetch['lot_code']."' AND ret_lot_type='R' AND ret_lot_num  NOT IN ( SELECT res_num_full  FROM ".RESULT."  WHERE res_lot_code ='".$fetch['lot_code']."') order by RAND() limit 0,$lot_return_per");
// 
// 
// $sixthprize_n  = db_query("SELECT SUBSTRING( `ret_lot_num` , 3) as num,ret_lot_code, ret_drawn_no, ret_lot_num, ret_lot_type FROM ".NEW_SALERETURN." WHERE   ret_lot_code='".$fetch['lot_code']."' AND ret_lot_type='R' AND ret_lot_num  NOT IN ( SELECT res_num_full  FROM ".RESULT."  WHERE res_lot_code ='".$fetch['lot_code']."')  order by RAND() limit 0,$lot_return_per");
//
//
//if(db_num_rows($sixthprize)>0)
//{
// while($row6 = db_fetch_array($sixthprize))
//{
//if($i62==substr($row6['num'],0,1))    
//{
//    if($sixthstore=='')
//    $sixthstore =$row6['num'].'_'.$row6['ret_lot_type'].'_'.$row6['ret_drawn_no'].'_'.$row6['ret_lot_num'];
//    else
//    $sixthstore .=','.$row6['num'].'_'.$row6['ret_lot_type'].'_'.$row6['ret_drawn_no'].'_'.$row6['ret_lot_num'];
//    break;    
//}
//} 
//}
// else
//{
//if(db_num_rows($sixthprize_n)>0)
//{
// while($row6 = db_fetch_array($sixthprize_n))
//{
//   if($sixthstore=='')
//    $sixthstore =$row6['num'].'_'.$row6['ret_lot_type'].'_'.$row6['ret_drawn_no'].'_'.$row6['ret_lot_num'].'_'.$randamcolor;
//    else
//    $sixthstore .=','.$row6['num'].'_'.$row6['ret_lot_type'].'_'.$row6['ret_drawn_no'].'_'.$row6['ret_lot_num'].'_'.$randamcolor;
//} 
//}
//}
//}
//
//
//$sixthdata = explode(',',$sixthstore); 
//for($i6i=$lot_sale_per;$i6i<=99;$i6i++)
//{
//if(strlen($i6i)==2)   
//$i62 = substr($i6i,1,2);  
//else 
//$i62 = $i6i;    
//$sixthsplit = explode('_',$sixthdata[$i62]); 
//$sixth_lot_nums   = $sixthsplit[0];
//$sixth_lot_types  = $sixthsplit[1];
//$sixth_lot_drawn  = $sixthsplit[2];
//$sixth_num_full  = $sixthsplit[3];
//$sixth_style      = $sixthsplit[4];
//db_query("INSERT INTO ".RESULT." SET res_lot_code='".$fetch['lot_code']."',res_drawnno='".$sixth_lot_drawn."',res_prize='06', res_lot_num='".substr($sixth_lot_nums,-3)."' , res_type='".$sixth_lot_types."',res_code='".resultcode($fetch['lot_code'])."',res_num_full='".$sixth_num_full."'");
?>   
<div class="col-xs-2">
<!--<input type="text" id="sixthprize_series<?php echo $i6i+1;?>" maxlength="1" name="sixthprize_series<?php echo $i6i+1;?>>" value="<?php echo $i62;?>" disabled="dsiabled" class="text-field" />
<input type="text" id="sixthprize<?php echo $i6i+1;?>" maxlength="3" <?php echo $sixth_style;?> name="sixthprize<?php echo $i6i+1;?>" value="<?php echo substr($sixth_lot_nums,-3);?>" disabled="dsiabled" class="whole sixthcls text-field-prize" />
<input type="text" disabled="dsiabled" maxlength="1" id="sixthprize_type<?php echo $i6i+1;?>" name="sixthprize_type<?php echo $i6i+1;?>" value="<?php echo $sixth_lot_types;?>" class="text-field" />
<input type="hidden" id="sixthprize_full<?php echo $ii+1;?>" maxlength="1" name="sixthprize_full<?php echo $ii+1;?>" value="<?php echo $row6['ret_lot_num'];?>" disabled="dsiabled" class="text-field" />-->
</div>
<?php //} ?>    

<div class="col-xs-9 col-xs-offset-2" style="margin-top:25px; margin-bottom:25px;">
<a href="#viewDtlsPopup" class="popupdisplay lottery-btn-edit" onclick="selectedit(6);resetlogin();" style="margin-left:-148px;">Edit</a>   
<!--<input type="button" id="sixth_edit" onclick="enabled(3,'E');" name="sixth_edit" value="Edit" class="submit_btn" />-->

<input type="button" id="sixth_save" name="sixth_save" value="Save" class="submit_btn_save" />
<input type="hidden" id="sixthcount" name="sixthcount" value="<?php echo $i6i+1;?>"  />
</div>
</div>  
</div>

  <?php }?>
  <div class="col-xs-12"  align="center" style="height:100px;display:<?php if(db_num_rows($resselect)==0){?>none<?php } else {?>block<?php }?>" id="exportgrid">
    <input type="button" value="Export" class="submit" onClick="exportoption('<?php echo $fetch['lot_code'] ;?>')" />
    <input type="hidden" value="<?php echo $fetch['lot_code']; ?>" id="lot_code" name="lot_code" />
    
    <input type="button" value="New Result" class="submit" onClick="window.location.href='result.php'">
    <input type="button" value="Exit" class="submit" onClick="window.location.href='index.php'">
  </div>
 
  <?php if(db_num_rows($resselect)==0){?>   
  <div class="col-xs-12" style="height:100px;" align="center">
    <input type="button" value="Sales Number" class="submit" style="width: 120px; height: 35px;" onClick="window.open('lotterynumber.php?type=S&code=<?php echo $fetch['lot_code'];?>')" >
    <input type="button" value="Return Number" class="submit-ret" style="width: 120px; height: 35px;" onClick="window.open('lotterynumber.php?type=R&code=<?php echo $fetch['lot_code'];?>')" >

  </div>
  <?php } ?> </div> <?php }?>

<script type="text/javascript">
function getresultcode(value){

$.ajax({
data:'action=resultcode&value='+value,
url:'include/blmodules/bl_general.php',
success:function(data)
{
var ress = data.split("***");    
if(ress[0]=='EXIST')
{
$("#lot_resultcode").val(ress[3]);    
$("#lot_sale_per").val(ress[1]);
$("#lot_return_per").val(ress[2]);
$("#lot_sale_per").attr("readonly","readonly");
$("#lot_return_per").attr("readonly","readonly");
$("#lot_dav").val(ress[4]);
}
else
{
$("#lot_resultcode").val(ress[0]);
$("#lot_sale_per").val("");
$("#lot_return_per").val("");
$("#percentgrid").hide();
$("#resultext").hide();
$("#lot_sale_per").removeAttr("readonly");
$("#lot_return_per").removeAttr("readonly");
$("#lot_dav").val("");
}
}
})
$("#resultgrid").hide();
}    

function validate()
{
if($("#lot_code").val()=="")   
{
alert("Please Select Lottery Code");
$("#lot_code").focus();
return false;
}
if($("#lot_sale_per").val()=="")   
{
alert("Please Enter Sale Percentage");
$("#lot_sale_per").focus();
return false;
}
if($("#lot_return_per").val()=="")   
{
alert("Please Select Return Percentage");
$("#lot_return_per").focus();
return false;
}
if(parseInt($("#lot_sale_per").val()) + parseInt($("#lot_return_per").val()) > 100 )
{
alert("Percentage Value Exceeds");
$("#lot_sale_per").focus();
return false;
}
if(parseInt($("#lot_sale_per").val()) + parseInt($("#lot_return_per").val()) < 100 )
{
alert("Percentage Value is Less than 100");
$("#lot_sale_per").focus();
return false;
}
if(!$("#lot_sale_per").val().match("0") && $("#lot_dav").val()!='dav')
{
alert("Please Enter Nearst Whole Number");
$("#lot_sale_per").focus();
return false;
}
if(!$("#lot_return_per").val().match("0") && $("#lot_dav").val()!='dav')
{
alert("Please Enter Nearst Whole Number");
$("#lot_return_per").focus();
return false;
}
$("#percentgrid").show();
$("#resultext").show();
}
function enabled(prize,att)
{
if(prize=='1')
{
if(att=='E')
{
$("#firstprize_series").removeAttr("disabled");
$("#firstprize").removeAttr("disabled");
$("#firstprize_type").removeAttr("disabled");
}
if(att=='D')
{   
$("#firstprize_series").attr("disabled","disabled");
$("#firstprize").attr("disabled","disabled");
$("#firstprize_type").attr("disabled","disabled");
}
}
if(prize=='2')
{
if(att=='E')
{
$("#secondprize").removeAttr("disabled");
$("#secondprize_type").removeAttr("disabled");
}
if(att=='D')
{
$("#secondprize").attr("disabled","disabled");
$("#secondprize_type").attr("disabled","disabled");
}
}

if(prize=='3')
{
if(att=='E')
{
for(i=1;i<=10;i++){
$("#thirdprize"+i).removeAttr("disabled");
$("#thirdprize_type"+i).removeAttr("disabled");
}
}
if(att=='D')
{
for(i=1;i<=10;i++){    
$("#thirdprize"+i).attr("disabled","disabled");
$("#thirdprize_type"+i).attr("disabled","disabled");
}
}
}

if(prize=='4')
{
if(att=='E')
{
for(i=1;i<=10;i++){
$("#fourthprize"+i).removeAttr("disabled");
$("#fourthprize_type"+i).removeAttr("disabled");
}
}
if(att=='D')
{
for(i=1;i<=10;i++){    
$("#fourthprize"+i).attr("disabled","disabled");
$("#fourthprize_type"+i).attr("disabled","disabled");
}
}
}
if(prize=='5')
{
if(att=='E')
{
for(i=1;i<=10;i++){
$("#fifthprize"+i).removeAttr("disabled");
$("#fifthprize_type"+i).removeAttr("disabled");
}
}
if(att=='D')
{
for(i=1;i<=10;i++){    
$("#fifthprize"+i).attr("disabled","disabled");
$("#fifthprize_type"+i).attr("disabled","disabled");
}
}
}
if(prize=='6')
{
if(att=='E')
{
for(i=1;i<=100;i++){
$("#sixthprize"+i).removeAttr("disabled");
$("#sixthprize_type"+i).removeAttr("disabled");
}
}
if(att=='D')
{
for(i=1;i<=100;i++){    
$("#sixthprize"+i).attr("disabled","disabled");
$("#sixthprize_type"+i).attr("disabled","disabled");
}
}
}
}

$("#first_save").click(function(){
var firstprize_series    =   $("#firstprize_series").val();
var firstprize           =   $("#firstprize").val();
var lot_code             =   $("#lot_code").val();
var firstprize_type      =   $("#firstprize_type").val();	
var firstprize_full      =   $("#firstprize_full").val();

if($("#firstprize_series").val()=='')
{
alert("Please Enter Series");
$("#firstprize_series").focus();
return false;    
}
if($("#firstprize").val()=='')
{
alert("Please Enter First Prize Number");
$("#firstprize").focus();
return false;    
}
if($("#firstprize_type").val()=='')
{
alert("Please Enter First Prize Type");
$("#firstprize_type").focus();
return false;    
}
$.ajax({
url:'include/blmodules/bl_general.php',
type:'POST',
data:'firstprize_series='+firstprize_series+'&firstprize='+firstprize+'&lot_code='+lot_code+'&action=fp&firstprize_type='+firstprize_type+'&firstprize_full='+firstprize_full,
success:function(data){
var result = data.split("***");  
$("#rsp").html(result[0]+'%');
$("#rrp").html(result[1]+'%');
alert("Updated Sucessfully");
enabled(1,'D');
//$("#exportgrid").show();
$("#percentgrid").show();
$("#resultext").show();
$("#selectprize").val("");
$("#firstprizesavecheck").val("1");
$("#firstprize").css("border","") 
}
})
return false; 
}); 

$("#second_save").click(function(){
var secondprize           =   $("#secondprize").val();
var lot_code              =   $("#lot_code").val();
var secondprize_type      =   $("#secondprize_type").val();
var secondprize_full      =   $("#secondprize_full").val();
if($("#secondprize_series").val()=='')
{
alert("Please Enter Series");
$("#secondprize_series").focus();
return false;    
}
if($("#secondprize").val()=='')
{
alert("Please Enter First Prize Number");
$("#secondprize").focus();
return false;    
}
if($("#secondprize_type").val()=='')
{
alert("Please Enter First Prize Type");
$("#secondprize_type").focus();
return false;    
}
$.ajax({
url:'include/blmodules/bl_general.php',
type:'POST',
data:'secondprize='+secondprize+'&lot_code='+lot_code+'&action=sp&secondprize_type='+secondprize_type+'&secondprize_full='+secondprize_full,
success:function(data){
var result = data.split("***");  
$("#rsp").html(result[0]+'%');
$("#rrp").html(result[1]+'%');    
alert("Updated Sucessfully");
enabled(2,'D');
//$("#exportgrid").show();
$("#percentgrid").show();
$("#resultext").show();
$("#selectprize").val("");
$("#secondprizesavecheck").val("2");
$("#secondprize").css("border","") 
}
})
return false; 
});

$("#third_save").click(function(evt){
//evt.preventDefault();
//var hashTable=new Array();
//var valid =true;
//var er;
//var er1;
//$('input.thirdcls').each(function(index,item){
//   er1 = $(item);
//   var itemVal =$(item).val();
//   er =  itemVal; 
//   if($.inArray(itemVal,hashTable)==-1)
//    {
//        hashTable.push(itemVal);
//    }
//    else{
//        valid=false;   
//        return false;
//    }

//if(valid)
//{
var thirdprize=0;
var lot_code              =   $("#lot_code").val();
//alert(lot_code);
var thirdcount            =   $("#thirdcount").val();
//alert(thirdcount);
if($("#lot_code").val()=='')
{
alert("lottery code empty");
return false;    
}

for(i=1;i<=thirdcount;i++)
{
if(thirdprize==0)

thirdprize = $("#thirdprize_series"+i).val()+'_'+$("#thirdprize"+i).val()+'_'+$("#thirdprize_type"+i).val()+'_'+$("#thirdprize_full"+i).val(); 
else
thirdprize +=','+$("#thirdprize_series"+i).val()+'_'+$("#thirdprize"+i).val()+'_'+$("#thirdprize_type"+i).val()+'_'+$("#thirdprize_full"+i).val();    
}

$.ajax({
url:'include/blmodules/bl_general.php',
type:'POST',
data:'thirdprize='+thirdprize+'&lot_code='+lot_code+'&action=tp',
success:function(data){
var result = data.split("***");  
$("#rsp").html(result[0]+'%');
$("#rrp").html(result[1]+'%');    
alert("Updated Sucessfully");
enabled(3,'D');
//$("#exportgrid").show();
$("#percentgrid").show();
$("#resultext").show();
$("#selectprize").val("");
$("#thirdprizesavecheck").val("3");
$("#thirdprize1").css("border","") 
$(".thirdcls").css("color","#000000");
}
})
return false; 
});
//}
//else
//{
//alert("Number: "+er+" Already Exist");
//er1.css("color","red");
////$("input[value='"+er+"']").css("border",'2px solid red');
//return false;    
//}
//}); 

$("#fourth_save").click(function(evt){


var fourthprize=0;
var lot_code             =   $("#lot_code").val();
var fourthcount          =   $("#fourthcount").val();
if($("#lot_code").val()=='')
{
alert("lottery code empty");
return false;    
}

for(i=1;i<=fourthcount;i++)
{
if(fourthprize==0)

fourthprize =$("#fourthprize_series"+i).val()+'_'+ $("#fourthprize"+i).val()+'_'+$("#fourthprize_type"+i).val()+'_'+$("#fourthprize_full"+i).val(); 
else
fourthprize +=','+$("#fourthprize_series"+i).val()+'_'+$("#fourthprize"+i).val()+'_'+$("#fourthprize_type"+i).val()+'_'+$("#fourthprize_full"+i).val(); 
}

$.ajax({
url:'include/blmodules/bl_general.php',
type:'POST',
data:'fourthprize='+fourthprize+'&lot_code='+lot_code+'&action=frtp',
success:function(data){
var result = data.split("***");  
$("#rsp").html(result[0]+'%');
$("#rrp").html(result[1]+'%');    
alert("Updated Sucessfully");
enabled(4,'D');
//$("#exportgrid").show();
$("#percentgrid").show();
$("#resultext").show();
$("#selectprize").val("");
$("#fourthprizesavecheck").val("4");
$("#fourthprize1").css("border","") 
$(".fourthcls").css("color","#000000");
}
})
return false; 
}); 

$("#fifth_save").click(function(evt){


var fifthprize=0;
var lot_code             =   $("#lot_code").val();
var fifthcount           =   $("#fifthcount").val();
if($("#lot_code").val()=='')
{
alert("lottery code empty");
return false;    
}
for(i=1;i<=fifthcount;i++)
{
if(fifthprize==0)

fifthprize =  $("#fifthprize_series"+i).val()+'_'+$("#fifthprize"+i).val()+'_'+$("#fifthprize_type"+i).val()+'_'+$("#fifthprize_full"+i).val(); 
else
fifthprize +=','+$("#fifthprize_series"+i).val()+'_'+$("#fifthprize"+i).val()+'_'+$("#fifthprize_type"+i).val()+'_'+$("#fifthprize_full"+i).val();    
}
$.ajax({
url:'include/blmodules/bl_general.php',
type:'POST',
data:'fifthprize='+fifthprize+'&lot_code='+lot_code+'&action=ftp',
success:function(data){
var result = data.split("***");  
$("#rsp").html(result[0]+'%');
$("#rrp").html(result[1]+'%');    
alert("Updated Sucessfully");
enabled(5,'D');
$("#exportgrid").show();
$("#percentgrid").show();
$("#resultext").show();
$("#selectprize").val("");
$("#fifthprizesavecheck").val("5");
$("#fifthprize1").css("border","") 
$(".fifthcls").css("color","#000000");
}
})
return false;     
   }); 

$("#sixth_save").click(function(evt){

var sixthprize=0;
var lot_code1             =   $("#sixthcode").val();
alert(lot_code1);
var sixthcount           =   $("#sixthcount").val();
if($("#lot_code").val()=='')
{
alert("lottery code empty");
return false;    
}
for(i=1;i<=sixthcount;i++)
{
if(sixthprize==0)

sixthprize = $("#sixthprize_series"+i).val()+'_'+$("#sixthprize"+i).val()+'_'+$("#sixthprize_type"+i).val()+'_'+$("#sixthprize_full"+i).val();  
else
sixthprize +=','+$("#sixthprize_series"+i).val()+'_'+$("#sixthprize"+i).val()+'_'+$("#sixthprize_type"+i).val()+'_'+$("#sixthprize_full"+i).val();   
}

$.ajax({
url:'include/blmodules/bl_general.php',
type:'POST',
data:'sixthprize='+sixthprize+'&lot_code='+lot_code+'&action=stp',
success:function(data){
var result = data.split("***");  
$("#rsp").html(result[0]+'%');
$("#rrp").html(result[1]+'%');    
alert("Updated Sucessfully");
enabled(6,'D');
$("#exportgrid").show();
$("#percentgrid").show();
$("#resultext").show();
$("#selectprize").val("");
$("#sixthprizesavecheck").val("6");
$("#sixthprize1").css("border","") 
$(".sixthcls").css("color","#000000");
//alert(lot_code);
exportoption(lot_code1);
}
})
return false;    

}); 


function closepopup()
{
var magnificPopup = jQuery.magnificPopup.instance;
// save instance in magnificPopup variable
magnificPopup.close();
}

function selectedit(prize)
{
/*var pr = $("#selectprize").val();     
if(pr!="")    
{
alert("Please Save "+pr+" Prize Result");
return false;
}
else*/
$("#selectprize").val(prize);    
}


function check()
{
var sel = $("#selectprize").val();  
  
if($('#username').val()=='')
{
$('#msgbox').html("Please Enter username");
$('#username').focus();
return false;
} 
if($('#passwordd').val()=='')
{
$('#msgbox').html("Please Enter Password");
$('#passwordd').focus();
return false;
} 


$.ajax({
type:'POST',
url: 'include/blmodules/bl_general.php',
data: $('#loginn').serialize(),
success:function(data)
{
$('#passwordd').val("");   
if(data=='ok')
{
enabled(sel,'E');
if(sel==1)
$("#firstprize").css("border","3px solid red") ; 
if(sel==2)
$("#secondprize").css("border","3px solid red"); 
if(sel==3)
$("#thirdprize1").css("border","3px solid red") ;
if(sel==4)
$("#fourthprize1").css("border","3px solid red") ;
if(sel==5)
$("#fifthprize1").css("border","3px solid red") ;
if(sel==6)
$("#sixthprize1").css("border","3px solid red") ;
closepopup();
}
else
{
$('#msgbox').html("Please Enter Correct Password"); 
$("#passwordd").val("");
enabled(sel,'D');
if(sel==1)
$("#firstprize").css("border",""); 
if(sel==2)
$("#secondprize").css("border","");
if(sel==3)
$("#thirdprize1").css("border",""); 
if(sel==4)
$("#fourthprize1").css("border",""); 
if(sel==5)
$("#fifthprize1").css("border",""); 
if(sel==6)
$("#sixthprize1").css("border",""); 
}
}
})

}

function resetlogin()
{
  $("#msgbox").html("");
  $("#passwordd").val("");
}

function exportoption(lot_code)
{
	
  $(function()
        {
           	$.ajax({  
          url    : 'duplicate.php',
          data   : 'lot_code='+lot_code,
          type   : 'post',
          success : function(data) {
			 if(data!=="")
			  {
			  alert(data +"duplicate values found");
			  }
			  else
			  { 
			  n=confirm("Do you Want to export?");
              if(n==true)
			  window.location.href="exporter.php?lc="+lot_code;  
			  }
			
          }
		  
        });
	});
}


</script>

<input type="hidden" id="firstprizesavecheck" name="firstprizesavecheck" />
<input type="hidden" id="secondprizesavecheck" name="secondprizesavecheck" />
<input type="hidden" id="thirdprizesavecheck" name="thirdprizesavecheck" />
<input type="hidden" id="fourthprizesavecheck" name="fourthprizesavecheck" />
<input type="hidden" id="fifthprizesavecheck" name="fifthprizesavecheck" />
<input type="hidden" id="sixthprizesavecheck" name="sixthprizesavecheck" />

<div id="viewDtlsPopup" class="mfp-hide white-popup-block">
<div class="certi_title">
Login
</div>

<div class="certi_content_div">

      <form id="loginn" name="loginn" method="post" > 
          <div id="msgbox"></div>
          <div>
        <div>username</div>
            <div><input type="text"  id="username" name="password" autocomplete="off" />
            <div>Password</div>
            <div><input type="password"  id="passwordd" name="passwordd" autocomplete="off" />
            <input type="hidden"  id="passcheck" name="passcheck" autocomplete="off" value="passcheck" />
            <input type="hidden"  id="selectprize" name="selectprize" autocomplete="off" /></div>
         </div>
         <div style="margin-top: 10px;">
            <input type="button" value="Login" onclick="check();" />
            <input type="button" value="Reset" onclick="resetlogin();" />
        </div> 
      </form>
    </div>
       
</div>
  
</div>