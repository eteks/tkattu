<?php
$fetch=$_SERVER["PHP_SELF"];
$expval=explode("/",$fetch);
$fcnt=count($expval);
$self=$expval[$fcnt-1];

if ($s == 1)
{
  $prev = $s-$perpage;
  $next=$s+$perpage;
  $startval = 1;
} else {
    $startval = $_GET["page"];
}

$noburs = 10;
  echo "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"right\"> <tr class=\"gride_header2\">";
  if($MaxPageNo > 1 && $startval <= $noburs ) {
      for($k=1; $k <= $noburs; $k++) {
          if($k > $MaxPageNo) break;
          if($k == $startval) {
            echo "<th>&nbsp;".$k."&nbsp;</td>";
          }
          else 
              echo '<td><a style="color:#FFFFFF;font-family:"Trebuchet MS",arial;font-size:10px;font-style:normal;" href="javascript:populateDynamicFormLists(\'\', \'\', \'\', \''.$formid.'\', \''.$k .'\', \''. $institute_admin .'\')">&nbsp;'.$k.'&nbsp;</a></th>';

      }
      if($MaxPageNo > $noburs) echo '<th><a style="color:#FFFFFF;font-family:"Trebuchet MS",arial;font-size:10px;font-style:normal;" href="javascript:populateDynamicFormLists(\'\', \'\', \'\', \''.$formid.'\', \''.($noburs+1) .'\', \''. $institute_admin .'\')">&nbsp;Next&nbsp;</th>';
    } elseif ($MaxPageNo > 1 && $noburs <= $startval && $startval <= (2*$noburs)) {
        echo '<th><a style="color:#FFFFFF;font-family:"Trebuchet MS",arial;font-size:10px;font-style:normal;" href="javascript:populateDynamicFormLists(\'\', \'\', \'\', \''.$formid.'\', \''.($startval-$noburs) .'\', \''. $institute_admin .'\')">&nbsp;Prev&nbsp;</th>';
        for($k=($noburs+1); $k <= (2*$noburs); $k++ ) {
        if($k > $MaxPageNo) break;
        if($k == $startval)
                    echo "<th>".$k."</th>";
        else
            echo '<th><a style="color:#FFFFFF;font-family:"Trebuchet MS",arial;font-size:10px;font-style:normal;" href="javascript:populateDynamicFormLists(\'\', \'\', \'\', \''.$formid.'\', \''.$k .'\', \''. $institute_admin .'\')">&nbsp;'.$k.'&nbsp;</a></th>';
        }
        $newnext = $k;
        if($MaxPageNo > $newnext)
        echo '<th><a style="color:#FFFFFF;font-family:"Trebuchet MS",arial;font-size:10px;font-style:normal;" href="javascript:populateDynamicFormLists(\'\', \'\', \'\', \''.$formid.'\', \''.$k .'\', \''. $institute_admin .'\')">&nbsp;Next&nbsp;</a></th>';
    } elseif ($MaxPageNo > 1 && (2*$noburs) <= $startval && $startval <= (3*$noburs)) {
        echo '<th><a style="color:#FFFFFF;font-family:"Trebuchet MS",arial;font-size:10px;font-style:normal;" href="javascript:populateDynamicFormLists(\'\', \'\', \'\', \''.$formid.'\', \''.($startval-$noburs) .'\', \''. $institute_admin .'\')">&nbsp;Prev&nbsp;</th>';
        for($k=(2*$noburs+1); $k <= (3*$noburs); $k++ ) {
        if($k > $MaxPageNo) break;
        if($k == $startval)
                    echo "<th >".$k."</th>";
        else
            echo '<th><a style="color:#FFFFFF;font-family:"Trebuchet MS",arial;font-size:10px;font-style:normal;" href="javascript:populateDynamicFormLists(\'\', \'\', \'\', \''.$formid.'\', \''.$k .'\', \''. $institute_admin .'\')">&nbsp;'.$k.'&nbsp;</a></th>';
        }
        $newnext = $k;
        if($MaxPageNo > $newnext)
        echo '<th><a style="color:#FFFFFF;font-family:"Trebuchet MS",arial;font-size:10px;font-style:normal;" href="javascript:populateDynamicFormLists(\'\', \'\', \'\', \''.$formid.'\', \''.$k .'\', \''. $institute_admin .'\')">&nbsp;Next&nbsp;</a></th>';
    } elseif ($MaxPageNo > 1 && (3*$noburs) <= $startval && $startval <= (4*$noburs)) {
        echo '<th><a style="color:#FFFFFF;font-family:"Trebuchet MS",arial;font-size:10px;font-style:normal;" href="javascript:populateDynamicFormLists(\'\', \'\', \'\', \''.$formid.'\', \''.($startval-$noburs) .'\', \''. $institute_admin .'\')">&nbsp;Prev&nbsp;</th>';
        for($k=(3*$noburs+1); $k <= (4*$noburs); $k++ ) {
        if($k > $MaxPageNo) break;
        if($k == $startval)
                    echo "<th>".$k."</th>";
        else
            echo '<th><a style="color:#FFFFFF;font-family:"Trebuchet MS",arial;font-size:10px;font-style:normal;" href="javascript:populateDynamicFormLists(\'\', \'\', \'\', \''.$formid.'\', \''.$k .'\', \''. $institute_admin .'\')">&nbsp;'.$k.'&nbsp;</a></th>';
        }
        $newnext = $k;
        if($MaxPageNo > $newnext)
        echo '<th><a style="color:#FFFFFF;font-family:"Trebuchet MS",arial;font-size:10px;font-style:normal;" href="javascript:populateDynamicFormLists(\'\', \'\', \'\', \''.$formid.'\', \''.$k .'\', \''. $institute_admin .'\')">&nbsp;Next&nbsp;</a></th>';
    } elseif ($MaxPageNo > 1 && (4*$noburs) <= $startval && $startval <= (5*$noburs)) {
        echo '<th><a style="color:#FFFFFF;font-family:"Trebuchet MS",arial;font-size:10px;font-style:normal;" href="javascript:populateDynamicFormLists(\'\', \'\', \'\', \''.$formid.'\', \''.($startval-$noburs) .'\', \''. $institute_admin .'\')">&nbsp;Prev&nbsp;</th>';
        for($k=(4*$noburs+1); $k <= (5*$noburs); $k++ ) {
        if($k > $MaxPageNo) break;
        if($k == $startval)
                    echo "<th>".$k."</th>";
        else
            echo '<th><a style="color:#FFFFFF;font-family:"Trebuchet MS",arial;font-size:10px;font-style:normal;" href="javascript:populateDynamicFormLists(\'\', \'\', \'\', \''.$formid.'\', \''.$k .'\', \''. $institute_admin .'\')">&nbsp;'.$k.'&nbsp;</a></th>';
        }
        $newnext = $k;
        if($MaxPageNo > $newnext)
        echo '<th><a style="color:#FFFFFF;font-family:"Trebuchet MS",arial;font-size:10px;font-style:normal;" href="javascript:populateDynamicFormLists(\'\', \'\', \'\', \''.$formid.'\', \''.$k .'\', \''. $institute_admin .'\')">&nbsp;Next&nbsp;</a></th>';
    } elseif ($MaxPageNo > 1 && (5*$noburs) <= $startval && $startval <= (6*$noburs)) {
        echo '<th><a style="color:#FFFFFF;font-family:"Trebuchet MS",arial;font-size:10px;font-style:normal;" href="javascript:populateDynamicFormLists(\'\', \'\', \'\', \''.$formid.'\', \''.($startval-$noburs) .'\', \''. $institute_admin .'\')">&nbsp;Prev&nbsp;</th>';
        for($k=(5*$noburs+1); $k <= (6*$noburs); $k++ ) {
        if($k > $MaxPageNo) break;
        if($k == $startval)
                    echo "<th>".$k."</th>";
        else
            echo '<th><a style="color:#FFFFFF;font-family:"Trebuchet MS",arial;font-size:10px;font-style:normal;" href="javascript:populateDynamicFormLists(\'\', \'\', \'\', \''.$formid.'\', \''.$k .'\', \''. $institute_admin .'\')">&nbsp;'.$k.'&nbsp;</a></th>';
        }
        $newnext = $k;
        if($MaxPageNo > $newnext)
        echo '<th><a style="color:#FFFFFF;font-family:"Trebuchet MS",arial;font-size:10px;font-style:normal;" href="javascript:populateDynamicFormLists(\'\', \'\', \'\', \''.$formid.'\', \''.$k .'\', \''. $institute_admin .'\')">&nbsp;Next&nbsp;</a></th>';
    } elseif ($MaxPageNo > 1 && (6*$noburs) <= $startval && $startval <= (7*$noburs)) {
        echo '<th><a style="color:#FFFFFF;font-family:"Trebuchet MS",arial;font-size:10px;font-style:normal;" href="javascript:populateDynamicFormLists(\'\', \'\', \'\', \''.$formid.'\', \''.($startval-$noburs) .'\', \''. $institute_admin .'\')">&nbsp;Prev&nbsp;</th>';
        for($k=(6*$noburs+1); $k <= (7*$noburs); $k++ ) {
        if($k > $MaxPageNo) break;
        if($k == $startval)
                    echo "<th>".$k."</th>";
        else
            echo '<th><a style="color:#FFFFFF;font-family:"Trebuchet MS",arial;font-size:10px;font-style:normal;" href="javascript:populateDynamicFormLists(\'\', \'\', \'\', \''.$formid.'\', \''.$k .'\', \''. $institute_admin .'\')">&nbsp;'.$k.'&nbsp;</a></th>';
        }
        $newnext = $k;
        if($MaxPageNo > $newnext)
        echo '<th><a style="color:#FFFFFF;font-family:"Trebuchet MS",arial;font-size:10px;font-style:normal;" href="javascript:populateDynamicFormLists(\'\', \'\', \'\', \''.$formid.'\', \''.$k .'\', \''. $institute_admin .'\')">&nbsp;Next&nbsp;</a></th>';
    } elseif ($MaxPageNo > 1 && (7*$noburs) <= $startval && $startval <= (8*$noburs)) {
        echo '<th><a style="color:#FFFFFF;font-family:"Trebuchet MS",arial;font-size:10px;font-style:normal;" href="javascript:populateDynamicFormLists(\'\', \'\', \'\', \''.$formid.'\', \''.($startval-$noburs) .'\', \''. $institute_admin .'\')">&nbsp;Prev&nbsp;</th>';
        for($k=(7*$noburs+1); $k <= (8*$noburs); $k++ ) {
        if($k > $MaxPageNo) break;
        if($k == $startval)
                    echo "<th>".$k."</th>";
        else
            echo '<th><a style="color:#FFFFFF;font-family:"Trebuchet MS",arial;font-size:10px;font-style:normal;" href="javascript:populateDynamicFormLists(\'\', \'\', \'\', \''.$formid.'\', \''.$k .'\', \''. $institute_admin .'\')">&nbsp;'.$k.'&nbsp;</a></th>';
        }
        $newnext = $k;
        if($MaxPageNo > $newnext)
        echo '<th><a style="color:#FFFFFF;font-family:"Trebuchet MS",arial;font-size:10px;font-style:normal;" href="javascript:populateDynamicFormLists(\'\', \'\', \'\', \''.$formid.'\', \''.$k .'\', \''. $institute_admin .'\')">&nbsp;Next&nbsp;</a></th>';
    } elseif ($MaxPageNo > 1 && (8*$noburs) <= $startval && $startval <= (9*$noburs)) {
        echo '<th ><a style="color:#FFFFFF;font-family:"Trebuchet MS",arial;font-size:10px;font-style:normal;" href="javascript:populateDynamicFormLists(\'\', \'\', \'\', \''.$formid.'\', \''.($startval-$noburs) .'\', \''. $institute_admin .'\')">&nbsp;Prev&nbsp;</th>';
        for($k=(8*$noburs+1); $k <= (9*$noburs); $k++ ) {
        if($k > $MaxPageNo) break;
        if($k == $startval)
                    echo "<th>".$k."</th>";
        else
            echo '<th><a style="color:#FFFFFF;font-family:"Trebuchet MS",arial;font-size:10px;font-style:normal;" href="javascript:populateDynamicFormLists(\'\', \'\', \'\', \''.$formid.'\', \''.$k .'\', \''. $institute_admin .'\')">&nbsp;'.$k.'&nbsp;</a></th>';
        }
        $newnext = $k;
        if($MaxPageNo > $newnext)
        echo '<th><a style="color:#FFFFFF;font-family:"Trebuchet MS",arial;font-size:10px;font-style:normal;" href="javascript:populateDynamicFormLists(\'\', \'\', \'\', \''.$formid.'\', \''.$k .'\', \''. $institute_admin .'\')">&nbsp;Next&nbsp;</a></th>';
    } elseif ($MaxPageNo > 1 && (9*$noburs) <= $startval && $startval <= (10*$noburs)) {
        echo '<th><a class="navigation" href="javascript:populateDynamicFormLists(\'\', \'\', \'\', \''.$formid.'\', \''.($startval-$noburs) .'\', \''. $institute_admin .'\')">&nbsp;Prev&nbsp;</th>';
        for($k=(9*$noburs+1); $k <= (10*$noburs); $k++ ) {
        if($k > $MaxPageNo) break;
        if($k == $startval)
                    echo "<th>".$k."</th>";
        else
            echo '<th><a style="color:#FFFFFF;font-family:"Trebuchet MS",arial;font-size:10px;font-style:normal;" href="javascript:populateDynamicFormLists(\'\', \'\', \'\', \''.$formid.'\', \''.$k .'\', \''. $institute_admin .'\')">&nbsp;'.$k.'&nbsp;</a></th>';
        }
        $newnext = $k;
        if($MaxPageNo > $newnext)
        echo '<th><a style="color:#FFFFFF;font-family:"Trebuchet MS",arial;font-size:10px;font-style:normal;" href="javascript:populateDynamicFormLists(\'\', \'\', \'\', \''.$formid.'\', \''.$k .'\', \''. $institute_admin .'\')">&nbsp;Next&nbsp;</a></th>';
    }
  echo "</tr></table>";
?>
