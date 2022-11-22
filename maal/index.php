<?php

  $sz = 1000;
  $tw = (int)($sz / 2);
  $margin= 60;
  $tb = 8;

  $b = $tw / 15;

  $cw  = $b * 4.5
  ;
  $cmw = $b * 3;
  $mw  = $b * 3;
  $mow = $b * 2;
  $ow  = $b * 4;
  
  $colortable = [
'#0000ff',
'#ffa500',//
'#00ff00',
'#1e90ff',
'#ff0000',
'#98fb98',
'#ffff00',
'#dda0dd',
'#afaf19', // 4f
'#ff00ff',
'#deb887',
'#ff1493',
'#00ced1',
'#a52a2a',
'#191970',
'#006400'];

  $lines = isset($_GET['times']) ? (int)$_GET['times'] : 10;

  $start_angle = (360 / $lines);

  $tafel = isset($_GET['tafel']) ? (int)$_GET['tafel'] : false;  
  $div = isset($_GET['div']) ? true : false;
  
  $max = isset($_GET['max']) ? (int)$_GET['max'] : 10;
  $cnt = isset($_GET['cnt']) ? (int)$_GET['cnt'] : 12;

  $direction = 1; // -1 = met klok mee. 1 tegen klok in

  function sin_deg($v)
  {
     return sin($v / 360 * 2 * M_PI);
  }

  function cos_deg($v)
  {
     return cos($v / 360 * 2 * M_PI);
  }

  function f($v)
  {
    return rtrim(number_format($v, 3, '.', ''), '0');
  }

  if (isset($_GET['svg']))
  {
    header('Content-Type: image/svg+xml');
    echo '<svg height="' . ($sz + 2 * $margin) . '" width="' . ($sz + 2 * $margin) . '" xmlns="http://www.w3.org/2000/svg">' . "\n";

    // Center Circle
    $cx = $margin + $tw;
    $cy = $margin + $tw;
    $fill = /* $div ? 'none' :*/ ($colortable[($tafel-1) % count($colortable)]);
    echo '  <circle cx="' . f($cx) . '" cy="' . f($cy) . '" r="' . $cw . '" stroke="black" stroke-width="3" fill="' . $fill . '" fill-opacity="0.4" />' . "\n";
    
    if ($tafel)
        echo '  <text x="' . f($cx) . '" y="' . f($cy+ $tb) . '" dominant-baseline="middle" text-anchor="middle" style="font: 122pt bold; font-family: Arial Black">' . htmlentities($tafel) . '</text>' . "\n";

    echo "\n";
    for ($i = 0; $i < $lines; $i++) {
      $angle = $start_angle + (360 / $lines) * $i * $direction;

      echo '  <line x1="' . f($margin + $tw + sin_deg($angle) * ($cw)) . '" ' .
                   'y1="' . f($margin + $tw - cos_deg($angle) * ($cw)) . '" ' .
                   'x2="' . f($margin + $tw + sin_deg($angle) * ($cw + $cmw)) . '" ' .
                   'y2="' . f($margin + $tw - cos_deg($angle) * ($cw + $cmw)) . '" ' .
                   'stroke="black" />' . "\n";
                 
      if ($tafel !== false && !$div) {
        $cx = $margin + $tw + sin_deg($angle) * ($cw + $cmw  / 2);
        $cy = $margin + $tw - cos_deg($angle) * ($cw + $cmw  / 2);
        echo '  <text x="' . f($cx) . '" y="' . f($cy+ $tb) . '" dominant-baseline="middle" text-anchor="middle" style="font: 48pt heavy; font-family: Arial black">' . ($div ? '&#xF7;' : '&#xD7;') . '</text>' . "\n";
      }
      
      $cx = $margin + $tw + sin_deg($angle) * ($cw + $cmw + $mw / 2);
      $cy = $margin + $tw - cos_deg($angle) * ($cw + $cmw + $mw / 2);
      echo '  <circle cx="' . f($cx) . '" ' .
                     'cy="' . f($cy) . '" ' .
                      'r="' . (int)($mw / 2) . '" stroke="black" stroke-width="2" fill="' . $fill . '" fill-opacity="0.3" />' . "\n";

      if ($tafel)
        echo '  <text x="' . f($cx) . '" y="' . f($cy+ $tb) . '" dominant-baseline="middle" text-anchor="middle" style="font: 48pt bold;font-family: Arial Black">' . htmlentities($i+1) . '</text>' . "\n";

      echo '  <line x1="' . f($margin + $tw + sin_deg($angle) * ($cw + $cmw + $mw)) . '" ' .
                   'y1="' . f($margin + $tw - cos_deg($angle) * ($cw + $cmw + $mw)) . '" ' .
                   'x2="' . f($margin + $tw + sin_deg($angle) * ($cw + $cmw + $mw + $mow)) . '" ' .
                   'y2="' . f($margin + $tw - cos_deg($angle) * ($cw + $cmw + $mw + $mow)) . '" ' .
                   'stroke="black" />' . "\n";

      if ($tafel !== false && $div) {
        $cx = $margin + $tw + sin_deg($angle) * ($cw + $cmw + $mw + $mow / 2);
        $cy = $margin + $tw - cos_deg($angle) * ($cw + $cmw + $mw + $mow / 2);
        echo '  <text x="' . f($cx) . '" y="' . f($cy+ $tb) . '" dominant-baseline="middle" text-anchor="middle" style="font: 48pt heavy;font-family: Arial Black">' . ($div ? '&#xF7;' : '&#xD7;') . '</text>' . "\n";
      }

      $cx = $margin + $tw + sin_deg($angle) * ($cw + $cmw + $mw + $mow + $ow / 2);
      $cy = $margin + $tw - cos_deg($angle) * ($cw + $cmw + $mw + $mow + $ow / 2);
      echo '  <circle cx="' . f($cx) . '" ' .
                     'cy="' . f($cy) . '" ' .
                      'r="' . (int)($ow / 2) . '" stroke="black" stroke-width="2" fill="' . $fill . '" fill-opacity="0.2" />' . "\n";

      if ($tafel)
        echo '  <text x="' . f($cx) . '" y="' . f($cy+ $tb) . '" dominant-baseline="middle" text-anchor="middle" style="font: 48pt bold; font-family: Arial Black">' . htmlentities(($i+1) * $tafel) . '</text>' . "\n";
        
      echo "\n";
    }

    echo '</svg>';
  }
  else
  {
    echo "<html><body>\n";
    for ($i = 1; $i <= $cnt; $i++)
      echo "<img src=\"./?svg&tafel=$i&times=$max\" />\n";
    for ($i = 1; $i <= $cnt; $i++)
      echo "<img src=\"./?svg&tafel=$i&times=$max&div\" />\n";
    if (isset($_GET['empty'])) {
            $i = 0;
            echo "<img src=\"./?svg&tafel=$i&times=$max&empty\" />\n";
            echo "<img src=\"./?svg&tafel=$i&times=$max&div\" />\n";
    }
    echo "</body></html>";
  }