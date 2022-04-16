<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>Meester en Juf</title>

  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta name="MSSmartTagsPreventParsing" content="true" />
<meta name="generator" content="Blogger" />
<link rel="alternate" type="application/atom+xml" title="Meester en Juf" href="http://www.meester-en-juf.nl/atom.xml" />
<style type="text/css">
@import url("http://www.meester-en-juf.nl/tpl/site.css");
</style>
</head>

<body>

<div id="wrap"> <!-- #wrap - for centering -->

<!-- Blog Header -->
<div id="blog-header">
  <h1>
    
	Meester en Juf
	
  </h1>
</div>


<div id="content"> <!-- #content wrapper -->

<!-- Begin #main-content -->
<div id="main-content">

<!--
body {
  background-color: white;
  font: 10pt Arial, Helvetica;
  color: black;
}

table.somType {
}

table.somList {
  width: 100%;
}

table.somList td {
  width: 25%;
  text-align: left;
  font: 12pt Courier new, Courier;
}

table.somType th {
  font: 10pt Arial, Helvetica;
  font-weight: bold;
}  

table.somType td {
  margin: 3px 3px 3px 3px;
  border: 1px solid gray; 
  font: 10pt Arial, Helvetica;
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
<body>
<?php
// zaai met microseconden
function make_seed() {
   list($usec, $sec) = explode(' ', microtime());
   return (float) $sec + ((float) $usec * 100000);
}


srand(make_seed());

 
  if($_POST && isset($_POST['types']))
  {
    $add_max = intval($_POST['add_max']);
    $minus_max = intval($_POST['minus_max']);
    $keer_max = intval($_POST['keer_max']);
    $deel_max = intval($_POST['deel_max']);
    
    $som_count = intval($_POST['som_count']);
    $som_types = $_POST['types'];
    $times_use = $_POST['times_use'];
    $div_use = $_POST['div_use'];
    $layout_types = $_POST['layout_types'];
    
    if(!$times_use)
      $times_use = array(1);
      
    if(!$div_use)
      $div_use = array(1);
      
    if(!$layout_types)
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
      
      return str_pad($n, $max_width, ' ', STR_PAD_LEFT);  
    }
    
    function print_som($x1, $xo, $x2)
    {
      global $layout_types;
      
      $lt = $layout_types[rand() % count($layout_types)];
      
      if($lt == 'z')
      {
        echo f_num($x1) . ' ' . $xo . ' ' . f_num($x2) . ' = ' . f_num('..');
        return;
      }
      
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
      
      
      switch($lt)
      {
        case 'x':
          echo f_num('..') . ' ' . $xo . ' ' . f_num($x2) . ' = ' . f_num($z);
          break;
        case 'y':
          echo f_num($x1) . ' ' . $xo . ' ' . f_num('..') . ' = ' . f_num($z);
          break;
        case 'zr':
          echo f_num('..') . ' =  ' . f_num($x1) . ' ' . $xo . ' ' . f_num($x2);
          break;
        case 'xr':
          echo f_num($z) . ' =  ' . f_num('..') . ' ' . $xo . ' ' . f_num($x2);
          break;          
        case 'yr':
          echo f_num($z) . ' =  ' . f_num($x1) . ' ' . $xo . ' ' . f_num('..');
          break;
        default:
          echo f_num($x1) . ' ' . $xo . ' ' . f_num($x2) . ' = ' . f_num('..');
      }
    }
?>
<table style="width: 100%; border-bottom: 1px solid black">
<tr>
  <td align="left">
    <B>Naam: .............................</B>
  </td>
  <td align="right">
    <B>Datum: .... - .... - ........</B>
  </td>
  
</tr>
</table>
<div>&nbsp;</div>

<?php
    
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
              $x1 = rand(1, 10);
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
                if(rand() %3)
                {
                  $x1 = rand(1, $keer_max);
                  $x2 = rand(1, $keer_max);
                }
                else
                {
                  $x1 = rand(1, $keer_max / 10);
                  $x2 = rand(1, $keer_max / 8);
                }
              }
              while((strlen($x1 . $x2) < 10) && ($x1 * $x2) > $keer_max);
              
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
                echo "1 + 1 = ";
                break;
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
  }
  else
  {
  ?>
  <form method="POST">
    <table class="somType">
      <tr>
        <th>&nbsp;</th>
        <th>Soort som</th>
        <th>Instellingen</th>
      </tr>
      <tr>
        <td><input type="checkbox" name="types[]" value="add" /></td>
        <td><label>Optellen</label></td>
        <td>
          <input type="radio" name="add_max" value="10" checked>
          <label>tot 10</label>
          <input type="radio" name="add_max" value="20">
          <label>tot 20</label>
          <input type="radio" name="add_max" value="100">
          <label>tot 100</label>
          <input type="radio" name="add_max" value="1000">
          <label>tot 1000</label>
          <input type="radio" name="add_max" value="100000">
          <label>boven 1000</label>
        </td>
      </tr>
      <tr>
        <td><input type="checkbox" name="types[]" value="minus" /></td>
        <td><label>Aftrekken</label></td>
        <td>
          <input type="radio" name="minus_max" value="10" checked>
          <label>tot 10</label>
          <input type="radio" name="minus_max" value="20">
          <label>tot 20</label>
          <input type="radio" name="minus_max" value="100">
          <label>tot 100</label>
          <input type="radio" name="minus_max" value="1000">
          <label>tot 1000</label>
          <input type="radio" name="minus_max" value="100000">
          <label>boven 1000</label>
        </td>
      </tr>
      <tr>
        <td><input type="checkbox" name="types[]" value="keer" /></td>
        <td><label>Vermenigvuldigen</label></td>
        <td>
          <input type="radio" name="keer_max" value="10" checked>
          <label>tot 10</label>
          <input type="radio" name="keer_max" value="20">
          <label>tot 20</label>
          <input type="radio" name="keer_max" value="100">
          <label>tot 100</label>
          <input type="radio" name="keer_max" value="1000">
          <label>tot 1000</label>
          <input type="radio" name="keer_max" value="100000">
          <label>boven 1000</label>
        </td>
      </tr>
       <tr>
        <td><input type="checkbox" name="types[]" value="deel" /></td>
        <td><label>Delen</label></td>
        <td>
          <input type="radio" name="deel_max" value="10" checked>
          <label>tot 10</label>
          <input type="radio" name="deel_max" value="20">
          <label>tot 20</label>
          <input type="radio" name="deel_max" value="100">
          <label>tot 100</label>
          <input type="radio" name="deel_max" value="1000">
          <label>tot 1000</label>
          <input type="radio" name="deel_max" value="100000">
          <label>boven 1000</label>
        </td>
      </tr>
      <tr>
        <td><input type="checkbox" name="types[]" value="times" /></td>
        <td><label>Keertafels</label></td>
        <td>
          <input type="checkbox" name="times_use[]" value="1" checked>
          <label>1</label>
          <input type="checkbox" name="times_use[]" value="2" checked>
          <label>2</label>
          <input type="checkbox" name="times_use[]" value="3" checked>
          <label>3</label>
          <input type="checkbox" name="times_use[]" value="4" checked>
          <label>4</label>
          <input type="checkbox" name="times_use[]" value="5" checked>
          <label>5</label>
          <input type="checkbox" name="times_use[]" value="6" checked>
          <label>6</label>
          <input type="checkbox" name="times_use[]" value="7" checked>
          <label>7</label>
          <input type="checkbox" name="times_use[]" value="8" checked>
          <label>8</label>
          <input type="checkbox" name="times_use[]" value="9" checked>
          <label>9</label>
          <input type="checkbox" name="times_use[]" value="10" checked>
          <label>10</label>
        </td>
      </tr>
      <tr>
        <td><input type="checkbox" name="types[]" value="div" /></td>
        <td><label>Deeltafels</label></td>
        <td>
          <input type="checkbox" name="div_use[]" value="1" checked>
          <label>1</label>
          <input type="checkbox" name="div_use[]" value="2" checked>
          <label>2</label>
          <input type="checkbox" name="div_use[]" value="3" checked>
          <label>3</label>
          <input type="checkbox" name="div_use[]" value="4" checked>
          <label>4</label>
          <input type="checkbox" name="div_use[]" value="5" checked>
          <label>5</label>
          <input type="checkbox" name="div_use[]" value="6" checked>
          <label>6</label>
          <input type="checkbox" name="div_use[]" value="7" checked>
          <label>7</label>
          <input type="checkbox" name="div_use[]" value="8" checked>
          <label>8</label>
          <input type="checkbox" name="div_use[]" value="9" checked>
          <label>9</label>
          <input type="checkbox" name="div_use[]" value="10" checked>
          <label>10</label>
        </td>
      </tr>
      <tr class="spacer"></tr>
      <tr>
        <td colspan=3">
          <input type="text" name="som_count" value="100" size=4>
          <label><b>Aantal sommen</b></label>
        </td>
      </tr>
      <tr>
        <td colspan=3">
          <input type="checkbox" name="layout_types[]" value="z" checked>
          x @ y = ..<br>
          
          <input type="checkbox" name="layout_types[]" value="y">
          x @ .. = z<br>
          
          <input type="checkbox" name="layout_types[]" value="x">
          .. @ y = z<br>
          
          <input type="checkbox" name="layout_types[]" value="zr">
          .. = x @ y<br>
          
          <input type="checkbox" name="layout_types[]" value="xr">
          z = .. @ y<br>

          <input type="checkbox" name="layout_types[]" value="yr">
          z = x @ ..<br>          
    </table>
    <input type="submit" />
  </form>
  <?php
  }
?>
<div class="noprint">
  <a href="./">Terug naar de instellingen</a>
</div>


</div><!-- End #main-content -->
</div><!-- End #content -->



<!-- Begin #sidebar -->
<div id="sidebar">

  <h2 class="sidebar-title">Over</h2>
  
  <p>Zonder meesters en juffen kunnen we niet. Daarom deze blog. Om samen aan het onderwijs te werken en onze ervaringen te delen (wil je meeschrijven, laat het ons weten).</p>
  <p><a href="http://www.meester-en-juf.nl">Terug naar de log</a>

<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/tpl/sidebar.html';
?>
</div>
<!-- End #sidebar -->

<div class="clear">&nbsp;</div>
<div id="blog-header">
  <h1>
    
  </h1>
</div>


</div> <!-- end #wrap -->

<!-- c(~) -->
</body>
</html>