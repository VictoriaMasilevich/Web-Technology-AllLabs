<?php
if (isset($_POST['add'])){
	$NameofCookie = $_POST['NameofCookie']; 
	$ValueofCookie = $_POST['ValueofCookie'];
	$TimetoLive = $_POST['TimetoLive'];
if(strlen($NameofCookie) != 0 && strlen($ValueofCookie) != 0 && strlen($TimetoLive) != 0) {	
	if (setcookie ($NameofCookie, $ValueofCookie, time()+$TimetoLive)){
		echo "<div align='center' style='margin-left: 100px; margin-top: 50px; margin-bottom: 50px; margin-right: 100px; background-color: #FFF080; color:#800000; font-size:40px;'>Cookie успешно создана</div>";
	}
	else {
		echo "<div align='center' style='margin-left: 100px; margin-top: 50px; margin-bottom: 50px; margin-right: 100px; background-color: #FFF080; color:#800000; font-size:40px;'>Ошибка создания cookie</div>";
		return 0;
	}
}
else {
	echo "<div align='center' style='margin-left: 100px; margin-top: 50px; margin-bottom: 50px; margin-right: 100px; background-color: #FFF080; color:#800000; font-size:40px;'>Ошибка заполнения поля (1, 2 или 3)</div>";
	return 0;
	}
}
elseif (isset($_POST['delete'])){
	$NameofCookietoDelete = $_POST['NameofCookietoDelete'];
    if(strlen($NameofCookietoDelete) != 0) {	
		setcookie( $NameofCookietoDelete, "", time()- 60);
		echo "<div align='center' style='margin-left: 100px; margin-top: 50px; margin-bottom: 50px; margin-right: 100px; background-color: #FFF080; color:#800000; font-size:40px;'>Cookie удалена</div>";
	}
	else {
		echo "<div align='center' style='margin-left: 100px; margin-top: 50px; margin-bottom: 50px; margin-right: 100px; background-color: #FFF080; color:#800000; font-size:40px;'>Ошибка заполнения поля 4</div>";
	    return 0;
	}
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>
<body style="background-image: url(poligon-2560x1600-4k-hd-cvetnoy-zeleniy-fon-225.jpg)">
    <div style="padding-left: 30px; padding-bottom: 10px; margin-left: 100px; margin-top: 50px; margin-bottom: 50px; margin-right: 100px; background-color: #FFF080">
	<div align="left" style="color: #800000; font-size:40px;">Добавить cookie</div>
	<form method="POST">
		<p style="color: #800000; font-size:20px;">1. Введите имя cookie:<br> 
		<input type="text" name="NameofCookie" value="" /></p>
		<p style="color: #800000; font-size:20px;">2. Введите значение cookie:<br> 
		<input type="text" name="ValueofCookie" value=""/></p>
		<p style="color: #800000; font-size:20px;">3. Введите время(в секундах):<br> 
		<input type="text" name="TimetoLive" value=""/></p>
		<input type="submit" name="add" value="Добавить"></p>
	<div align="left" style="color: #800000; font-size:40px;">Удалить cookie</div>
		<p style="color: #800000; font-size:20px;">4. Введите имя cookie для удаления:<br> 
		<input type="text" name="NameofCookietoDelete" value="" /></p>
		<input type="submit" name="delete" value="Удалить">
	</form>
	</div>	
</body>
</html>