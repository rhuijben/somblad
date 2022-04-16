<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <title>SomBlad.QQn.nl Somblad</title>
<style type="text/css">
<!--
body {
  background-color: white;
  font: 12pt Arial, Helvetica;
  color: black;
}

table.somType {
  background: #EEEEEE;
  border: 1px solid gray;
}

table.somList {
  width: 100%;
}

table.somList td {
  width: 25%;
  text-align: left;
  font: 10pt Courier new, Courier;
}

table.somType th {
  font: 10pt Arial, Helvetica;
  font-weight: bold;

}  

body.blad a {
padding: 4px;
border: 1px solid lightyellow;
}
body.blad a:hover {
background: #EEEEFF;
border: 1px solid black;
}

table.somType td {
  margin: 3px 3px 3px 3px;
  border: 1px solid gray; 
  font: 10pt Arial, Helvetica;
  padding: 5px 10px;
  background: #F8F8F8;
}

div.answers {
  page-break-before: always;
}

@media print {
  .noprint {
    display: none;
    visibility: hidden;
  }
}
  
// -->
</style>
</head>
<?php
// zaai met microseconden
function make_seed() {
   list($usec, $sec) = explode(' ', microtime());
   return (float) $sec + ((float) $usec * 100000);
}

    $answers = array();

srand(make_seed());

 
  if($_POST && isset($_POST['types']))
  {
    $add_max = intval($_POST['add_max']);
    $minus_max = intval($_POST['minus_max']);
    $keer_max = intval($_POST['keer_max']);
    $deel_max = intval($_POST['deel_max']);
    
    $som_count = intval($_POST['som_count']);
    $som_types = $_POST['types'];
    $times_use = isset($_POST['times_use']) ? $_POST['times_use'] : false;
    $div_use = isset($_POST['div_use']) ? $_POST['div_use'] : false;
    $layout_types = isset($_POST['layout_types']) ? $_POST['layout_types'] : false;
    
    if(!$times_use || !is_array($times_use))
      $times_use = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
      
    if(!$div_use || !is_array($div_use))
      $div_use = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
      
    if(!$layout_types || !is_array($layout_types))
      $layout_Types = array('z');
      
    $max_width = 2;
    
    if(in_array('add', $som_types) && (strlen($add_max) > $max_width))
      $max_width = strlen($add_max);
      
    if(in_array('minus', $som_types) && (strlen($minus_max) > $max_width))
      $max_width = strlen($minus_max);
        
    if(in_array('keer', $som_types) && (strlen($keer_max) > $max_width))
      $max_width = strlen($keer_max);
      
    if(in_array('deel', $som_types) && (strlen($deel_max) > $max_width))
      $max_width = strlen($deel_max);

    if(in_array('times', $som_types) && ((strlen($times_use[count($times_use)-1])) > $max_width))
      $max_width = strlen($div_use[count($times_use)-1]);
  
    if(in_array('div', $som_types) && ((strlen($div_use[count($div_use)-1])+1) > $max_width))
      $max_width = (strlen($div_use[count($div_use)-1])+1);
      
      
    function f_num($n)
    {
      global $max_width;
      
      $t = '';
      
      for($i = 0; $i < ($max_width - strlen($n)); $i++)
        $t .= '&nbsp;';
      
    
      return $t . $n;
    }
    

    
    function print_som($x1, $xo, $x2)
    {
      global $layout_types, $answers;
      
      $lt = $layout_types[rand() % count($layout_types)];      
      
      switch($xo)
      {
        case '+':
          $z = $x1 + $x2;
          break;
        case '-':
          $z = $x1 - $x2;
          break;
        case '*':
        case 'x':
          $z = $x1 * $x2;
          break;
        case '/':
        case ':':
          $z = $x1 / $x2;
          break;
        default:
          $z = 0;
      }
      
      if($lt == 'z')
      {
        echo f_num($x1) . ' ' . $xo . ' ' . f_num($x2) . ' = ' . f_num('..');
        
        $a = f_num($x1) . ' ' . $xo . ' ' . f_num($x2) . ' = ' . f_num($z);
        
        array_push($answers, $a);
        return;
      }
      
      
      switch($lt)
      {
        case 'x':
          echo f_num('..') . ' ' . $xo . ' ' . f_num($x2) . ' = ' . f_num($z);
          break;
        case 'y':
          echo f_num($x1) . ' ' . $xo . ' ' . f_num('..') . ' = ' . f_num($z);
          break;
        case 'zr':
          echo f_num('..') . ' = ' . f_num($x1) . ' ' . $xo . ' ' . f_num($x2);
          break;
        case 'xr':
          echo f_num($z) . ' = ' . f_num('..') . ' ' . $xo . ' ' . f_num($x2);
          break;          
        case 'yr':
          echo f_num($z) . ' = ' . f_num($x1) . ' ' . $xo . ' ' . f_num('..');
          break;
        default:
          echo f_num($x1) . ' ' . $xo . ' ' . f_num($x2) . ' = ' . f_num('..');
      }
      
      if($lt != 'zr' && $lt != 'xr' && $lt != 'yr')
        $a = f_num($x1) . ' ' . $xo . ' ' . f_num($x2) . ' = ' . f_num($z);
      else      
        $a = f_num($z) . ' = ' . f_num($x1) . ' ' . $xo . ' ' . f_num($x2);
        
      array_push($answers, $a);
    }
?>
<body class="blad">
<div class="noprint" style="height: 30px">
<div style="background: lightyellow; padding: 7px;position: absolute; top: 0; left: 0; width: 98%; border: 1px solid yellow; text-align: center">
<b>Somblad</b> -
<a href="#" onclick="window.print()">Afdrukken</a> of <a href="./" onclick="history.go(-1)" onmouseover="this.href='#'">Terug</a></div>

</div>
<table style="width: 100%; border-bottom: 1px solid black">
<tr>
  <td align="left" width="33%">
    <B>Naam: .............................</B>
  </td>
  <td width="33%">&nbsp;</td>
  <td align="right" width="33%">
    <B>Datum: .... - .... - ........</B>
  </td>
  
</tr>
</table>
<div>&nbsp;</div>

<?php
    $soms = $som_count;
    while($som_count > 0)
    {
      echo '<table class="somList">' . "\n";
     
      for($row = 0; $row < 5; $row++)
      {
        echo "  <tr>\n";
        for($col = 0; $col < 4; $col++)
        {
          echo "    <td>";
          
          if($som_count > 0)
          {
            $som_count--;
            
            $doit = true;
            while($doit)
            {
              $doit = false;
            $tp = $som_types[rand() % count($som_types)];
//            var_dump($tp);
            switch($tp)
            {
            case 'add':
              $x1 = rand(1, intval($_POST['add_max'])-1);
              $x2 = rand(1, intval($_POST['add_max'])-$x1);
              
              print_som($x1, '+', $x2);
              break;
            case 'minus':
              $x1 = rand(1, intval($_POST['minus_max']));
              $x2 = rand(1, intval($_POST['minus_max']));
              
              if($x1 < $x2)
                print_som($x2, '-', $x1);
              else
                print_som($x1, '-', $x2);
              break;
            case 'times':
              $x1 = rand(rand(0, 3) ? 2 : 1, 10);
              $x2 = $times_use[rand() % count($times_use)];
              
              print_som($x1, 'x', $x2);
              break;
            
            case 'div':
              $x1 = rand(1, 10);
              $x2 = $div_use[rand() % count($div_use)];
              
              print_som($x2 * $x1, ':', $x2);
              break;
            case 'keer':
              $keer_max = intval($_POST['keer_max']);
              do
              {
                if(rand() %5)
                {
                  $x1 = rand(1, $keer_max);
                  $x2 = rand(1, $keer_max);
                }
                else
                {
                  $x1 = rand(1, $keer_max / 10);
                  $x2 = rand(1, $keer_max / 8);
                }
                
                if($x1 === 1 && $x2 === 1 && rand(0, 3))
                  continue;
              }
              while((strlen($x1 . $x2) > 10) || ($x1 * $x2) > $keer_max);
              
              print_som($x1, 'x', $x2);
              break;
            case 'deel':
              $deel_max = intval($_POST['deel_max']);
              do
              {
                $x1 = rand(1, $deel_max);
                $x2 = rand(1, $deel_max);
              }
              while((strlen($x1 . $x2) < 10) && ($x1 * $x2) > $deel_max);
              
              print_som($x1*$x2, ':', (rand() % 2) ? max($x1, $x2) : $x1);
              break;
            default:
                $doit = true;
                break;
            }
            
            }
          }
          
          echo "</td>\n";
        }
        echo "  </tr>\n";
        if($som_count <= 0)
          break;
      }
      
      echo '</table>' . "\n";
      
      if($som_count > 0)
      {
        echo "<div class=\"somSpacer\">&nbsp;</div>\n";
      }
      

    }
    ?>
<div class="noprint" style="padding: 30px">
  <hr />
</div>
<?php

      if(isset($_POST['add_answers']))
      {
      ?>
        <div class="answers">
     
     
     <table style="width: 100%; border-bottom: 1px solid black">
<tr>
  <td align="left" width="33%">
    <B>Antwoordblad
  </td>
  <td align="center" width="33%" style="font-size: 8pt;">SomBlad.QQn.nl</td>
  <td align="right" width="33%">
    <B>Datum: .... - .... - ........</B>
  </td>
  
</tr>
</table>   

<div>&nbsp;</div>
<?php
    while($som_count < $soms)
    {
        echo '<table class="somList">' . "\n";

                       
        for($row = 0; $row < 5; $row++)
        {
            echo "  <tr>\n";
            for($col = 0; $col < 4; $col++)
            {
                echo "    <td>";
                
                echo $answers[$som_count++];
                echo "</td>\n";
            }
            echo "  </tr>\n";
        }
        
        echo '</table>';
        if($som_count > 0)
        {
          echo "<div class=\"somSpacer\">&nbsp;</div>\n";
        }
    }
    
    
?>                
        </div>
        <?php
      }

  }
  else
  {
  ?>
  <body class="welkom">
  <div style="padding-left:30px; padding-right: 30px">
  <h1 align="Center">SomBlad.QQn.nl Somblad</h1>

  <p><br /></p>
  <p><br /></p>

  <form method="POST">
    <table class="somType">
      <tr>
        <th>Soort som</th>
        <th>Instellingen</th>
      </tr>
      <tr>
        <td>
          <input type="checkbox" id="tadd" name="types[]" value="add" />
          <label for="tadd">Optellen</label>
        </td>
        <td>
          <input type="radio" id="add10" name="add_max" value="10" checked>
          <label for="add10">tot 10</label>
          <input type="radio" id="add20" name="add_max" value="20">
          <label for="add20">tot 20</label>
          <input type="radio" id="add50" name="add_max" value="50">
          <label for="add50">tot 50</label>
          <input type="radio" id="add100" name="add_max" value="100">
          <label for="add100">tot 100</label>
          <input type="radio" id="add1000" name="add_max" value="1000">
          <label for="add1000">tot 1000</label>
          <input type="radio" id="add100000" name="add_max" value="100000">
          <label for="add100000">boven 1000</label>
        </td>
      </tr>
      <tr>
        <td>
          <input type="checkbox" id="tmin" name="types[]" value="minus" />
          <label for="tmin">Aftrekken</label>
        </td>
        <td>
          <input type="radio" id="min10" name="minus_max" value="10" checked>
          <label for="min10">tot 10</label>
          <input type="radio" id="min20" name="minus_max" value="20">
          <label for="min20">tot 20</label>
          <input type="radio" id="min50" name="minus_max" value="50">
          <label for="min50">tot 50</label>
          <input type="radio" id="min100" name="minus_max" value="100">
          <label for="min100">tot 100</label>
          <input type="radio" id="min1000" name="minus_max" value="1000">
          <label for="min1000">tot 1000</label>
          <input type="radio" id="min100000" name="minus_max" value="100000">
          <label for="min100000">boven 1000</label>
        </td>
      </tr>
      <tr>
        <td>
          <input type="checkbox" id="tkm" name="types[]" value="keer" />
          <label for="tkm">Vermenigvuldigen</label>
        </td>
        <td>
          <input type="radio" id="km50" name="keer_max" value="50" checked>
          <label for="km50">tot 50</label>
          <input type="radio" id="km100" name="keer_max" value="100">
          <label for="km100">tot 100</label>
          <input type="radio" id="km1000" name="keer_max" value="1000">
          <label for="km1000">tot 1000</label>
          <input type="radio" id="km10000" name="keer_max" value="10000">
          <label for="km10000">tot 10000</label>
          <input type="radio" id="km100000" name="keer_max" value="100000">
          <label for="km100000">boven 10000</label>
        </td>
      </tr>
       <tr>
        <td>
          <input type="checkbox" id="tdm" name="types[]" value="deel" />
          <label for="tdm">Delen</label>
        </td>
        <td>
          <input type="radio" id="dm50" name="deel_max" value="50" checked>
          <label for="dm50">tot 50</label>
          <input type="radio" id="dm100" name="deel_max" value="100">
          <label for="dm100">tot 100</label>
          <input type="radio" id="dm1000" name="deel_max" value="1000">
          <label for="dm1000">tot 1000</label>
          <input type="radio" id="dm10000" name="deel_max" value="10000">
          <label for="dm10000">tot 10000</label>
          <input type="radio" id="dm100000" name="deel_max" value="100000">
          <label for="dm100000">boven 10000</label>
        </td>
      </tr>
      <tr>
        <td>
          <input type="checkbox" id="ttimes" name="types[]" value="times" />
          <label for="ttimes">Keertafels</label>
        </td>
        <td>
          <input type="checkbox" id="t1" name="times_use[]" value="1" checked>
          <label for="t1">1</label>&nbsp;
          <input type="checkbox" id="t2" name="times_use[]" value="2" checked>
          <label for="t2">2</label>&nbsp;
          <input type="checkbox" id="t3" name="times_use[]" value="3" checked>
          <label for="t3">3</label>&nbsp;
          <input type="checkbox" id="t4" name="times_use[]" value="4" checked>
          <label for="t4">4</label>&nbsp;
          <input type="checkbox" id="t5" name="times_use[]" value="5" checked>
          <label for="t5">5</label>&nbsp;
          <input type="checkbox" id="t6" name="times_use[]" value="6" checked>
          <label for="t6">6</label>&nbsp;
          <input type="checkbox" id="t7" name="times_use[]" value="7" checked>
          <label for="t7">7</label>&nbsp;
          <input type="checkbox" id="t8" name="times_use[]" value="8" checked>
          <label for="t8">8</label>&nbsp;
          <input type="checkbox" id="t9" name="times_use[]" value="9" checked>
          <label for="t9">9</label>&nbsp;
          <input type="checkbox" id="t10" name="times_use[]" value="10" checked>
          <label for="t10">10</label>
        </td>
      </tr>
      <tr>
        <td>
          <input type="checkbox" id="tdiv" name="types[]" value="div" />
          <label for="tdiv">Deeltafels</label>
        </td>
        <td>
          <input type="checkbox" id="d1" name="div_use[]" value="1" checked>
          <label for="d1">1</label>&nbsp;
          <input type="checkbox" id="d2" name="div_use[]" value="2" checked>
          <label for="d2">2</label>&nbsp;
          <input type="checkbox" id="d3" name="div_use[]" value="3" checked>
          <label for="d3">3</label>&nbsp;
          <input type="checkbox" id="d4" name="div_use[]" value="4" checked>
          <label for="d4">4</label>&nbsp;
          <input type="checkbox" id="d5" name="div_use[]" value="5" checked>
          <label for="d5">5</label>&nbsp;
          <input type="checkbox" id="d6" name="div_use[]" value="6" checked>
          <label for="d6">6</label>&nbsp;
          <input type="checkbox" id="d7" name="div_use[]" value="7" checked>
          <label for="d7">7</label>&nbsp;
          <input type="checkbox" id="d8" name="div_use[]" value="8" checked>
          <label for="d8">8</label>&nbsp;
          <input type="checkbox" id="d9" name="div_use[]" value="9" checked>
          <label for="d9">9</label>&nbsp;
          <input type="checkbox" id="d10" name="div_use[]" value="10" checked>
          <label for="d10">10</label>
        </td>
      </tr>
      <tr class="spacer"></tr>
      <tr>
        <td><label for="som_count">Aantal sommen</label></td>
        <td>
          <input type="text" id="som_count" name="som_count" value="100" size=4>
        </td>
      </tr>
      <tr>
        <td valign="top">Vraagtype:</td>
        <td>
          <input type="checkbox" id="fz" name="layout_types[]" value="z" checked>
          <label for="fz">x @ y = ..</label><br>
          
          <input type="checkbox" id="fy" name="layout_types[]" value="y">
          <label for="fy">x @ .. = z</label><br>
          
          <input type="checkbox" id="fx" name="layout_types[]" value="x">
          <label for="fx">.. @ y = z</label><br>
          
          <input type="checkbox" id="fzr" name="layout_types[]" value="zr">
          <label for="fzr">.. = x @ y</label><br>
          
          <input type="checkbox" id="fxr" name="layout_types[]" value="xr">
          <label for="fxr">z = .. @ y</label><br>

          <input type="checkbox" id="fyr" name="layout_types[]" value="yr">
          <label for="fyr">z = x @ ..</label><br>
        </td>
      </tr>
      <tr>
        <td valign="top">Opties:</td>
        <td>
          <input type="checkbox" id="add_answers" name="add_answers" value="yes">
          <label for="add_answers">Antwoordblad als 2e pagina</label>
        </td>
      </tr>
    </table>
    <p>
    <input type="submit" value="Genereren" style="margin-left: 300px;padding: 2px 10px" />
    </p>
  </form>
  
  <p><br /></p>
  <p><br /></p>
</div>
  <?php
  }

?>
</body>
</html>