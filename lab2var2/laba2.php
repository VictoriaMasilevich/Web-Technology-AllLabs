<?php
Function toColor($number)
{
	return("#".substr("000000".dechex($number),-6));
}

$colors = array (
	"#000000" => "Black", //$key is #000000, $text is Black
	"#FFFFFF" => "White", 
	"#00FFFF" => "Aqua",
	"#0000FF" => "Blue",
	"#0000CD" => "MediumBlue",
	"#808080" => "Gray",
	"#008000" => "Green",
	"#00FF00" => "Lime",
	"#800000" => "Maroon",
	"#000080" => "Navy",
	"#008080" => "Teal",
	"#FFFF00" => "Yellow",
	"#FF0000" => "Red",
	"#800080" => "Purple",
	"#FFC0CB" => "Pink",
	"#FFA500" => "Orange",
	"#00008B" => "DarkBlue" );

$rows = 50000; 
$color = 0;

$table = '<table style="border: 5px solid #000;">';
$bgr = toColor($color);
$text = strtoupper($bgr);
$tempcolor = '#FFFFFF';

for ($tr = 1; $tr <= $rows; $tr++) {
    $table .= '<tr>';
        if ($tr % 5 == 0) {
            $table .= '<td style="font-weight:bold; color:white; width:1000px; font-size:35px; background-color:#000080;">'. '.....' .'</td>'; //every fifth line
        } 
		else {
			foreach($colors as $key => $value) { 
				if (strtoupper($key) == strtoupper($bgr)) {
					$text = $value;
					$tempcolor = '#FF0000'; //red color
				}
			} 	 
            $table .= '<td style="font-weight:bold; color:'. $tempcolor .'; width:1000px; font-size:25px; background-color:'. $bgr .';">'. $text .'</td>'; //other lines
            $color++;
			$bgr = toColor($color);	
			$text = strtoupper($bgr);
			$tempcolor = '#FFFFFF';
		}
    $table .= '</tr>';
}
$table .= '</table>';
echo $table; 
?>