<?php

  $sz = 800;
  $tw = (int)($sz / 2);
  $margin= 10;
  $tb = 8;

  $b = $tw / 15;

  $cw  = $b * 4;
  $cmw = $b * 6;
  $mw  = $b * -4;
  $mow = $b * 0;
  $ow  = $b * 0.5;

  $lines = isset($_GET['times']) ? (int)$_GET['times'] : 10;

  $start_angle = (360 / $lines);

  $tafel = isset($_GET['tafel']) ? (int)$_GET['tafel'] : false;
  $div = isset($_GET['div']) ? true : false;

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
    #echo '  <circle cx="' . f($cx) . '" cy="' . f($cy) . '" r="' . $cw . '" stroke="black" stroke-width="3" fill="none" />' . "\n";
    
    #if ($tafel)
    #    echo '  <text x="' . f($cx) . '" y="' . f($cy+ $tb) . '" dominant-baseline="middle" text-anchor="middle" style="font: 96pt bold;">' . htmlentities($tafel) . '</text>' . "\n";

    echo "\n";
    for ($i = 0; $i < $lines; $i++) {
      $angle = $start_angle + (360 / $lines) * $i * $direction;

      #echo '  <line x1="' . f($margin + $tw + sin_deg($angle) * ($cw)) . '" ' .
      #             'y1="' . f($margin + $tw - cos_deg($angle) * ($cw)) . '" ' .
      #             'x2="' . f($margin + $tw + sin_deg($angle) * ($cw + $cmw)) . '" ' .
      #             'y2="' . f($margin + $tw - cos_deg($angle) * ($cw + $cmw)) . '" ' .
      #             'stroke="black" />' . "\n";
                 
      if ($tafel && !$div) {
        $cx = $margin + $tw + sin_deg($angle) * ($cw + $cmw  / 2);
        $cy = $margin + $tw - cos_deg($angle) * ($cw + $cmw  / 2);
        echo '  <text x="' . f($cx) . '" y="' . f($cy+ $tb) . '" dominant-baseline="middle" text-anchor="middle" style="font: 48pt bold;">&#x00B7;</text>' . "\n";
      }
      
      $cx = $margin + $tw + sin_deg($angle) * ($cw + $cmw + $mw / 2);
      $cy = $margin + $tw - cos_deg($angle) * ($cw + $cmw + $mw / 2);
      #echo '  <circle cx="' . f($cx) . '" ' .
      #               'cy="' . f($cy) . '" ' .
      #                'r="' . (int)($mw / 2) . '" stroke="black" stroke-width="2" fill="none" />' . "\n";

      if ($tafel)
        echo '  <text x="' . f($cx) . '" y="' . f($cy+ $tb) . '" dominant-baseline="middle" text-anchor="middle" style="font: 24pt bold;">' . htmlentities(($i+1) % 10) . '</text>' . "\n";

      #echo '  <line x1="' . f($margin + $tw + sin_deg($angle) * ($cw + $cmw + $mw)) . '" ' .
      #             'y1="' . f($margin + $tw - cos_deg($angle) * ($cw + $cmw + $mw)) . '" ' .
      #             'x2="' . f($margin + $tw + sin_deg($angle) * ($cw + $cmw + $mw + $mow)) . '" ' .
      #             'y2="' . f($margin + $tw - cos_deg($angle) * ($cw + $cmw + $mw + $mow)) . '" ' .
      #             'stroke="black" />' . "\n";

#      if ($tafel && $div) {
#        $cx = $margin + $tw + sin_deg($angle) * ($cw + $cmw + $mw + $mow / 2);
#        $cy = $margin + $tw - cos_deg($angle) * ($cw + $cmw + $mw + $mow / 2);
#        echo '  <text x="' . f($cx) . '" y="' . f($cy+ $tb) . '" dominant-baseline="middle" text-anchor="middle" style="font: 48pt bold;">&#B7;</text>' . "\n";
#      }

      $cx = $margin + $tw + sin_deg($angle) * ($cw + $cmw + $mw + $mow + $ow / 2);
      $cy = $margin + $tw - cos_deg($angle) * ($cw + $cmw + $mw + $mow + $ow / 2);
#      echo '  <circle cx="' . f($cx) . '" ' .
#                     'cy="' . f($cy) . '" ' .
#                      'r="' . (int)($ow / 2) . '" stroke="black" stroke-width="2" fill="none" />' . "\n";

#      if ($tafel)
#        echo '  <text x="' . f($cx) . '" y="' . f($cy+ $tb) . '" dominant-baseline="middle" text-anchor="middle" style="font: 48pt bold;">' . htmlentities(($i+1) * $tafel) . '</text>' . "\n";
        
      echo "\n";
    }

    echo '</svg>';
  }
  else
  {
    echo "<html><body>\n";
    for ($i = 1; $i <= 12; $i++)
      echo "<img src=\"./?svg&tafel=$i&times=10\" />\n";
      for ($i = 1; $i <= 12; $i++)
      echo "<img src=\"./?svg&tafel=$i&times=10&div\" />\n";
    echo "</body></html>";
  }