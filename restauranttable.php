<table cellpadding="0" cellspacing="0" border="0" width="100%" class="verdanablack tmss"  style="color: #3a6997;">
<tr>
<?php 
if(db_num_rows($tabletree)>0)
{$i=1;
while($fetchtable = db_fetch_array($tabletree)){
if($fetchtable['table_entry_id']=='4')
$chairstr = $i.'a,'.$i.'b';
else if($fetchtable['table_entry_id']=='8')
$chairstr = $i.'a,'.$i.'b,'.$i.'c,'.$i.'d,'.$i.'e,'.$i.'f';    
else
$chairstr = $i.'a,'.$i.'b,'.$i.'c,'.$i.'d';    
?>
    <td>
        <table cellpadding="0" cellspacing="0" border="0" width="20%">
            <tr>
                <td width="5"></td>
                <td width="10">
                    <input class="chairs" onclick="return false" <?php if($editstatus=='editcart' && in_array($i.'a',$chairedit)){?> checked="checked" <?php } else if(chairschecking($i.'a')==1) {?> checked="checked" <?php } else if(chairschecking($i.'a')==2) {?> disabled="disabled" <?php }?> type="checkbox" id="chair<?php echo $i;?>a" name="chairs" value="<?php echo $i;?>a_<?php echo $i;?>" />
                    <label for="chair<?php echo $i;?>a" title="chair<?php echo $i;?>a"></label>
                    <?php if($i==8){?>
                    <input class="chairs" onclick="return false" <?php if($editstatus=='editcart' && in_array($i.'e',$chairedit)){?> checked="checked" <?php } else if(chairschecking($i.'e')==1) {?> checked="checked" <?php } else if(chairschecking($i.'e')==2) {?> disabled="disabled" <?php }?> type="checkbox" id="chair<?php echo $i;?>e" name="chairs" value="<?php echo $i;?>e_<?php echo $i;?>" />
                    <label for="chair<?php echo $i;?>e" title="chair<?php echo $i;?>e"></label>
                    <?php }?>
                </td>
                <td width="5"></td>
            </tr>
            <tr>
                <td width="5">
                    <input class="chairs" type="checkbox" onclick="return false" <?php if($editstatus=='editcart' && in_array($i.'b',$chairedit)){?> checked="checked" <?php } else if(chairschecking($i.'b')==1) {?> checked="checked" <?php } else if(chairschecking($i.'b')==2) {?> disabled="disabled" <?php }?> id="chair<?php echo $i;?>b" name="chairs" value="<?php echo $i;?>b_<?php echo $i;?>" />
                    <label for="chair<?php echo $i;?>b" title="chair<?php echo $i;?>b"></label>
                </td>
                <td width="10"><div><input type="checkbox" onclick="return false" <?php if($editstatus=='editcart' && editcarttablechk($_POST['cart_id'],$fetchtable['table_entry_id'])==1){?> checked="checked" <?php } else if(tablechecking($chairstr,$cartids,$fetchtable['table_entry_id'])==1) {?> checked="checked" <?php } else if(tablechecking($chairstr,'',$fetchtable['table_entry_id'])==2) {?> disabled="disabled" <?php }?>  name="tableid"  class="gettableid chktableicon" id="tableid<?php echo $i;?>" value="<?php echo $fetchtable['table_entry_id'];?>" />
                <label for="tableid<?php echo $i;?>" title="<?php echo $fetchtable['table_no'];?>"><div class="chktabletext"><p><?php echo $fetchtable['table_no'];?></p></div></label></div>
                </td>
                <td width="5">
                    <?php if($i!=4){?><input class="chairs" onclick="return false" type="checkbox" <?php if($editstatus=='editcart' && in_array($i.'c',$chairedit)){?> checked="checked" <?php } else if(chairschecking($i.'c')==1) {?> checked="checked" <?php } else if(chairschecking($i.'c')==2) {?> disabled="disabled" <?php }?> id="chair<?php echo $i;?>c" name="chairs" value="<?php echo $i;?>c_<?php echo $i;?>" />
                    <label for="chair<?php echo $i;?>c" title="chair<?php echo $i;?>c"></label><?php }?>
                </td>
            </tr>
            <?php if($i!=4){?> <tr>
                <td width="5"></td>
                <td width="10">
                    <input class="chairs" type="checkbox" onclick="return false" <?php if($editstatus=='editcart' && in_array($i.'d',$chairedit)){?> checked="checked" <?php } else if(chairschecking($i.'d')==1) {?> checked="checked" <?php } else if(chairschecking($i.'d')==2) {?> disabled="disabled" <?php }?> id="chair<?php echo $i;?>d" name="chairs" value="<?php echo $i;?>d_<?php echo $i;?>" />
                    <label for="chair<?php echo $i;?>d" title="chair<?php echo $i;?>d"></label>
                    <?php if($i==8){?>
                    <input class="chairs" onclick="return false" <?php if($editstatus=='editcart' && in_array($i.'f',$chairedit)){?> checked="checked" <?php } else if(chairschecking($i.'f')==1) {?> checked="checked" <?php } else if(chairschecking($i.'f')==2) {?> disabled="disabled" <?php }?> type="checkbox" id="chair<?php echo $i;?>f" name="chairs" value="<?php echo $i;?>f_<?php echo $i;?>" />
                    <label for="chair<?php echo $i;?>f" title="chair<?php echo $i;?>f"></label>
                    <?php }?>
                </td>
                <td width="5"></td>
            </tr><?php }?>
        </table>
    </td>    
  

    <?php 
if($i%4==0){echo '</tr><tr>';}
$i++;}}?>
</tr>
</table>
 <style>

.chairs[type=checkbox] {
display:none;
}

.chairs[type=checkbox] + label
 {
        background: #826548;
        display: inline-block;
        width: 11px;
        height: 11px;
        border-radius: 11%;
        text-align: center;
        background-size: cover;
        cursor: pointer;

 }

.chairs[type=checkbox]:checked + label
{
     display: inline-block;
      width: 11px;
      height: 11px;
      border-radius: 11%;
      text-align: center;
      background-size: cover;
      cursor: pointer;
      background: #FCC42F;

}
.chairs[type=checkbox]:disabled + label
{
      display: inline-block;
      width: 11px;
      height: 11px;
      border-radius: 11%;
      text-align: center;
      background-size: cover;
      background: #5E851E;
      cursor: default !important;

}
.chktableicon[type=checkbox] {
  display:none;
}

.chktableicon[type=checkbox] + label
 {
       background: url('images/table.jpg') no-repeat;
       display: inline-block;
        width: 31px;
        height: 31px;
        text-align: center;
        background-size: cover;
        cursor: pointer;

 }

.chktableicon[type=checkbox]:checked + label
{
     display: inline-block;
      width: 31px;
      height: 31px;
      border-radius: 31%;
      text-align: center;
      background-size: cover;
      cursor: pointer;
      opacity: 0.4;
      filter: alpha(opacity=31);

}
.chktableicon[type=checkbox]:disabled + label
{
      display: inline-block;
      width: 31px;
      height: 31px;
      border-radius: 31%;
      text-align: center;
      background-size: cover;
      background-color:#5E851E;
      cursor: default !important;

}
.chktabletext p
{
font-size:11px !important; 
}
.tmss td {
    width: 10px;
    padding: 5px 3px;
    text-align: center;
}
</style> 