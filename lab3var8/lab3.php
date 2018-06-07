<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Shedule</title>
</head>
<body style="background-color: #CD5C5C">
    <div style="padding-left: 30px; padding-bottom: 10px; margin-left: 100px; margin-top: 50px; margin-bottom: 50px; margin-right: 100px; background-color: #F08080">
		<form name="year_input" action="" method="get">
        <div align="left" style="color: #800000; font-size:40px;">Введите год</div>
        <input type="number" placeholder="2018" value="2018" step="1" min="1900" max="3000" name="year"">
        <p></p>
        <div align="left" style="color: #800000; font-size:40px;">Введите курс</div>
        <input type="number" placeholder="2" value="2" min="1" max="4" step="1" name="course">
        <p></p>
		<button style="height: 50px; width: 120px; color: #333;"> Готово </button>
        </form>
	</div>
</body>
</html>


<?php
define("WINTER_BACKGROUND", "img/winter.jpg");
define("SPRING_BACKGROUND", "img/spring.jpg");
define("SUMMER_BACKGROUND", "img/summer.jpg");
define("AUTUMN_BACKGROUND", "img/autumn.jpg");
define("INITIAL_DAY", 1);
define("INITIAL_MONTH", 9);
define("DAYS_IN_CALENDAR", 364);


$calendar = array();
$holidays = array(
    array("day" => 1, "mon" => 1),
    array("day" => 8, "mon" => 3),
    array("day" => 1, "mon" => 5),
    array("day" => 9, "mon" => 5),
    array("day" => 3, "mon" => 7),
    array("day" => 7, "mon" => 11),
	
);


function getFirstDay($year, $month, $day)
{
    //Current week day
    $time = mktime(0, 0, 0, $month, $day, $year);
    $first_day = date("N", $time);
    //Calculation of the first day of week
    $first_week_day = mktime(0, 0, 0, $month, $day - $first_day + 1, $year);

    return $first_week_day; //Return day, month, year
}

//Getting next day
function nextDay($time)
{
    $day = date("d", $time);
    $month = date("m", $time);
    $year = date("y", $time);

    return mktime(0, 0, 0, $month, $day + 1, $year);
}


function fillCalendar(&$calendar, $time)
{
    $index = 1;
    $day = getdate($time); //array of mday, month and other

    do
    {
        $calendar[$index] = $day;
        $time = nextDay($time);
        $day = getdate($time);
        $index++;

    } while ($index <= DAYS_IN_CALENDAR);
}


function createTable($calendar)
{
    for ($i = 0; $i < 13; $i++) {
        showMonth($calendar, $i * 28 + 1); //28 days in 4 weeks, we need next
    }
}

//Checking if the current day is a holiday
function checkHolidays($day)
{
    foreach ($GLOBALS["holidays"] as $item) {
        if (($item["day"] == $day["mday"]) && ($item["mon"] == $day["mon"]))
            return "red";
    }
	
	foreach ($GLOBALS["holidays"] as $item) {
        if (($day["mon"] == 7) || ($day["mon"] == 8))
            return "red";
    }
	
    foreach ($GLOBALS["holidays"] as $item) {
        if (($day["mday"] >= 23) && ($day["mday"] <= 30) && ($day["mon"] == 1))
            return "red";
    }	
	
	    foreach ($GLOBALS["holidays"] as $item) {
        if (($day["mday"] >= 8) && ($day["mday"] <= 22) && ($day["mon"] == 1))
            return "green";
    }
		
		
	    foreach ($GLOBALS["holidays"] as $item) {
        if (($day["mday"] >= 8) && ($day["mday"] <= 30) && ($day["mon"] == 6))
            return "green";
    }	
    return "black";
}

//Creating of 4-weeks table
function showMonth($calendar, $index)
{
    echo "<table border='4' 
            cellpadding='4' 
            width='1335px' 
            height='40%' 
            align='left' 
            background='" . Background($calendar[$index + 15]["mon"]) ."'>";
    //Table header
    echo "<tr><td colspan='8' 
            align='center'><font size='5' color='#800000'><b> " . $calendar[$index + 15]["year"] . "</b></font></td></tr>";
    //Cells contained month and the number of a day
    for ($i = 1; $i <= 4; $i++) {
        echo "<tr>";
        echo "<td width='4%' align='center'><font color='#800000'><b>" . $i . "</b></font>";
        for ($j = 0; $j < 7; $j++) {
			if (checkHolidays($calendar[$index])== "red" || checkHolidays($calendar[$index])== "green"){
				$bold = true;
			}
			else {
				$bold = false;
			}
			if ($bold == false){
            echo "<td align='center'
                width='300'><font size='4' color='".checkHolidays($calendar[$index])."'>" .$calendar[$index]["month"] . "<br>" . $calendar[$index]["mday"]. "</font>";
            $index++;
			}
			else {
			echo "<td align='center' 
                valign='center' 
                width='300' ><font size='4' color='".checkHolidays($calendar[$index])."'><b>" .$calendar[$index]["month"] . "</b><br><b>" . $calendar[$index]["mday"]. "</b></font>";
            $index++;
			}
            }
            echo "</tr>";
        }
    echo "</table>";
}


function Background($month)
{
    switch ($month) {
        case 1:
        case 2:
        case 12:
            return WINTER_BACKGROUND;
        case 3:
        case 4:
        case 5:
            return SPRING_BACKGROUND;
        case 6:
        case 7:
        case 8:
            return SUMMER_BACKGROUND;
        case 9:
        case 10:
        case 11:
            return AUTUMN_BACKGROUND;
    }
}

$year = intval($_GET["year"]);
$course = intval($_GET["course"]);

if (($year) && ($course)) {
	echo "<table width='100%' >";
	echo "<tr><td align='center'><font size='5' color='#800000'><b>" . "КУРС " . $course . "</b></font></td></tr>";
	echo "<table/><br />";
    $first_day = getFirstDay($year, INITIAL_MONTH, INITIAL_DAY);
    fillCalendar($calendar, $first_day);
    createTable($calendar);
}
else {
	$course = 2;
	echo "<table width='100%' >";
	echo "<tr><td align='center'><font size='5' color='#800000'><b>" . "КУРС " . $course . "</b></font></td></tr>";
	echo "<table/><br />";
    $first_day = getFirstDay(date("Y", time()), INITIAL_MONTH, INITIAL_DAY);
    fillCalendar($calendar, $first_day);
    createTable($calendar);
}
?>

