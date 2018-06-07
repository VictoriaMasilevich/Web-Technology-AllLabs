<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>
<body style="background-image: url(poligon-2560x1600-4k-hd-cvetnoy-zeleniy-fon-225.jpg)">
    <div style="padding-left: 30px; padding-bottom: 10px; margin-left: 100px; margin-top: 50px; margin-bottom: 50px; margin-right: 100px; background-color: #F08080">
	<div align="left" style="color: #800000; font-size:40px;">Добавить новую таблицу</div>
	<form method="POST">
	
		<p style="color: #800000; font-size:20px;">Введите имя таблицы:<br> 
		<input type="text" name="NameofTable" value="MyTable" /></p>
		<p style="color: #800000; font-size:20px;">Введите поля(через пробел):<br> 
		<input type="text" name="cols" value="Team Points"/></p>
		<p style="color: #800000; font-size:20px;">Введите типы полей(через пробел):<br> 
		<input type="text" name="typeofcol" value="TEXT INT"/></p>
		<p style="color: #800000; font-size:20px;">Введите число новых записей:<br> 
		<input type="text" name="new" value="7"/></p>
		<input type="submit" value="Добавить">
	</form>
	</div>	
</body>
</html>
<?php
	$arrayTEXT[0] = "Chelsea";
	$arrayTEXT[1] = "Liverpool";
	$arrayTEXT[2] = "Arsenal";
	$arrayTEXT[3] = "Manchester United";
	$arrayTEXT[4] = "Manchester City";

//require_once 'lab5.php'; // подключаем скрипт

if((isset($_POST['NameofTable'])) &&(isset($_POST['cols'])) && (isset($_POST['typeofcol'])) && (isset($_POST['new']))){	

$link = mysqli_connect('127.0.0.1', 'root', '', 'my') 
    or die("Ошибка" . mysqli_error($link));
    	
	$NameofTable = $_POST['NameofTable'];
	$cols = $_POST['cols'];
	$typeofcol = $_POST['typeofcol'];
	$new = $_POST['new'];
	
	$col = explode(" ", $cols);
	$n = count($col);	
	$type = explode(" ", $typeofcol);
	
	if (count($col) != count($type)){
		echo "<div align='center' style='margin-left: 100px; margin-top: 50px; margin-bottom: 50px; margin-right: 100px; background-color: #F08080; color:white;  font-size:40px;'>Введите равное число типов и полей</div>";
	    return(0);
	}
	
	for($i=0; $i<$n; $i++){
		if ($type[$i] == 'INT'){
			$bools[$i]=0;
		}
		if ($type[$i] == 'TEXT'){
			$bools[$i]=1;
		}
	}
		
	$query ="CREATE Table $NameofTable
	(
		NUM INT NOT NULL
	)";
	
	$result = mysqli_query($link, $query) or die("<div align='center' style='margin-left: 100px; margin-top: 50px; margin-bottom: 50px; margin-right: 100px; background-color: #F08080; color:white; font-size:40px;'>Ошибка создания таблицы</div>"); 

	for($i=0; $i<$n; $i++){
		$c=$col[$i];
		$t=$type[$i];
		$query ="ALTER TABLE $NameofTable ADD $c $t NOT NULL"; //добавляем поле
		$result = mysqli_query($link, $query) or die("<div align='center' style='margin-left: 100px; margin-top: 50px; margin-bottom: 50px; margin-right: 100px; background-color: #F08080; color:white; font-size:40px;'>Ошибка создания полей</div>"); 
	}

	for ($j=0; $j<$new; $j++){ //по записям
					if($bools[0] == 0){
							$temp = rand(30, 50);
					}
					else {
						$pos = rand(0, 4);
						$temp = '\''. $arrayTEXT[$pos] . '\'';
					}
					$str = $temp;
					for($i=1; $i<$n; $i++){
						if($bools[$i] == 0){
							$temp = rand(30, 50);
						}
						else{
							$pos = rand(0, 4);
							$temp = '\''. $arrayTEXT[$pos] . '\'';
						}
						$str = $str . ', ' .$temp;
					}
		$query ="INSERT INTO $NameofTable VALUES($j, $str)";
		$result = mysqli_query($link, $query) or die("<div align='center' style='margin-left: 100px; margin-top: 50px; margin-bottom: 50px; margin-right: 100px; background-color: #F08080; color:white; font-size:40px;'>Ошибка создания записей</div>"); 
	}
	echo "<div align='center' style='margin-left: 100px; margin-top: 50px; margin-bottom: 50px; margin-right: 100px; background-color: #F08080; color:white; font-size:40px;'>Таблица готова</div>";

// закрываем подключение
mysqli_close($link);
}
?>