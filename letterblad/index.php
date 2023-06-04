<html lang="nl">
    <head>
        <title>Letterblad</title>
        <style>
<!--
table {
    border-collapse: collapse;
    font-size: 80pt;
}

tr.s td.s {
    border: 0;
    padding: 0;
    margin: 0;
}

td {
    border: 0;
    padding: 0.15em;
    margin: 0;
    text-align: center;
    vertical-align: middle;
}


tr.s td.s s {
    display: block;
    height: 0.3em;
    //background-color: red;
}

td em {
    display: block;
    font-style: normal;
}

tr td:first-of-type {
    margin-left: 0.15em;
}

tr td:last-of-type {
    margin-right: 0.15em;
}

table tr:first-of-type {
    margin-top: 0.15em;
}

table tr:last-of-type {
    margin-bottom: 0.15em;
}

-->
        </style>
    </head>
    <body>
    <table>
<?php
    $letter = isset($_GET['letter']) ? $_GET['letter'] : '$letter';

    $rows = (int)(11 - strlen($letter)/3);
    $cols = (int)(30 / (1.5+strlen($letter)));

    $cellcolor = [];
    for($y = 0; $y < $rows; $y++) {
        $cellcolor[$y] = [];

        for($x = 0; $x < $cols; $x++) {
            $cellcolor[$y][$x] = generate_color();
        }
    }
    for($y = 0; $y < $rows; $y++) {
        echo("  <tr>\n");

        for($x = 0; $x < $cols; $x++) {

            echo("    <td style=\"");
            echo("background-color: " . $cellcolor[$y][$x] . ";");

            echo "\">\n";
            echo '<em style="';
            
            if (rand(1,3) != 1) {
                echo "transform: rotate(" . (strlen($letter) <= 4 ? (rand(0, 60)-30) : (rand(0, 40)-20)) . "deg);";
            }
            if (rand(1,2) != 1) {
                echo "font-size: " . (rand(9, 14) / 10) . "em;";
            }
            if (rand(1,5) == 1) {
                echo "font-weight: bold;";
            }
            if (rand(1,5) == 1) {
                echo "font-style: italic;";
            }
            if (rand(1,4) != 1) {
                
                echo "font-family: " . rand_item(["serif", "sans-serif", "monospace", "cursive", "fantasy"])  . ";";
            }
            if (rand(1,3) == 1) {
                echo "color: " . rand_item(['darkred', 'darkblue', 'darkgreen', 'darkorange', 'darkblue', 'brown']) . ";";
            }
            if (rand(1,40) == 1) {
                echo "text-decoration: underline;";
            }
            if (rand(1,4) == 1) {
                echo "letter-spacing: " . rand(strstr($letter, 'i') ? -1 : -4, 4) / 30 . "em;";
            }
            if (rand(1,7) == 1) {
                echo "-webkit-text-fill-color: transparent;";
                echo "-webkit-text-stroke: 0.0" . rand(2,3) . "em;";
            }


            if (rand(1,5) <= 2) {
                echo "text-shadow:" . rand_item(['#FC0 1px 0 10px;', '5px 5px #558ABB']) . ';';
            }

            $txt = $letter;

            if (rand(1, 15) == 1) {
                $txt = strtoupper($txt);
            }

            echo "\">" .htmlentities($txt);
            echo("</em></td>\n");

            if ($x < $cols-1) {
                echo("<td class=\"s\" style=\"");
                echo "background-image: linear-gradient(to right, " . $cellcolor[$y][$x] . ', ' . $cellcolor[$y][$x+1] . ')';
                echo "\">";
                echo "</td>\n";
            }
        }

        echo("  </tr>\n");
       echo("  <tr class=\"s\">\n");
        if ($y < $rows-1) {
            for($x = 0; $x < $cols; $x++) {

            echo("    <td style=\"");
            echo "background-image: linear-gradient(to bottom, " . $cellcolor[$y][$x] . ', ' . $cellcolor[$y+1][$x] . ')';

            echo("\">\n");
            echo("</td>\n");

            if ($x < $cols-1) {
                echo "<td class=\"s\" style=\"";
                
                echo "background-image: ";

                echo "linear-gradient(to bottom, " . $cellcolor[$y][$x] . ', ' . $cellcolor[$y+1][$x] . ')';
                
                echo "\"><s style=\"";
                
                echo "background-image: linear-gradient(to bottom, " . $cellcolor[$y][$x+1] . ', ' . $cellcolor[$y+1][$x+1] . '); ';
                echo "-webkit-mask-image: linear-gradient(to right, transparent, black);";
                echo "\"></s></td>\n";
            }
        }   
        }
    }

function generate_color()
{
    $r = rand(128, 255);
    $g = rand(128, 255);
    $b = rand(128, 255);

    $sum = $r + $b + $g;
    if ($sum < 450 || $sum > 725)
        return generate_color();

    return '#' . dechex($r) . dechex($g) . dechex($b);
}

function svg_color($c)
{
    $r = hexdec(substr($c, 1, 2));
    $g = hexdec(substr($c, 3, 2));
    $b = hexdec(substr($c, 5, 2));

    return 'rgb(' . $r . ',' . $g . ',' . $b . ')';
}

function rand_item($t)
{
    return $t[rand(0, count($t)-1)];
}
?>
</table>
</body>
</html>