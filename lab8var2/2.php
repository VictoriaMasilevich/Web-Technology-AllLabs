<!DOCTYPE html> 
<html lang="en"> 
<head> 
<meta charset="UTF-8"> 
<title>Lab8</title> 
</head> 
<body> 

<H1 style= "color: #FFD320">Операционные системы по посещениям</H1> 
<?php 

$host = 'localhost'; 
$database = 'my'; 
$user = 'root'; 

$link = mysqli_connect($host, $user, '', $database) 
or die("Ошибка".mysql_error($link)); 

$OS = $_SERVER['HTTP_USER_AGENT'];
if (strpos($OS, "Firefox") !== false) $browser = "Firefox";
  elseif (strpos($OS, "Opera") !== false) $browser = "Opera";
  elseif (strpos($OS, "Chrome") !== false) $browser = "Chrome";
  elseif (strpos($OS, "Mozilla/5.0") !== false) $browser = "Internet Explorer";
  elseif (strpos($OS, "Safari") !== false) $browser = "Safari";
  else $browser = $OS;

$query = "SELECT * FROM os"; 
$result = mysqli_query($link, $query) 
or die("Ошибка".mysqli_error($link)); 

$count = 1; 
$bool = 0; 
$id = 1; 

if($result){ 
	while($row = mysqli_fetch_array($result)){ 
	$id++; 
		if ($row["system"] == $browser){ 
		$query = "UPDATE os SET num=num + 1 WHERE id = $row[id]"; 
		$result = mysqli_query($link, $query) 
		or die("Ошибка".mysqli_error($link)); 
		$bool = 1; 
		break; 
		} 
	} 

	if(!$row || $bool == 0){ 
	$query = "INSERT INTO os VALUES('$id','$browser', '$count')"; 
	$result = mysqli_query($link, $query) 
	or die("Ошибка".mysqli_error($link)); 
	} 
} 

$query = "SELECT * FROM os ORDER BY num desc"; //Взять имена по убыванию пользователей
$result = mysqli_query($link, $query) 
or die("Ошибка".mysqli_error($link)); 

if($result){ 
	echo '<table border="1"; cellpadding="10">'.'<tr>'; 
	echo '<th style="color: #364728; background: #FFF320;">'."ОС".'</th>'; 
	echo '<th style="color: #DDDDDD">'."Количество пользователей".'</th>'.'</tr>'; 
	while($row = mysqli_fetch_array($result)){ 
		echo '<tr>'.'<td style="color: #364728; background: #FFF320;">'.$row["system"].'</td>'; 
		echo '<td style="color: #739284">'.$row["num"].'</td>'.'</tr>'; 
	} 
echo '</table>'; 
} 

mysqli_close($link); 
?> 
</body> 
</html> 
