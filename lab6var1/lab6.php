<?php
    $title = "lab6";
	//include("1.html");
	$host = 'localhost';
	$database = 'accounts';
	$user = 'root';
	$link = mysqli_connect($host, $user, '', $database)
		or die("Ошибка".mysql_error($link));

	$query = "SELECT * FROM info";
	$result = mysqli_query($link, $query)
		or die("Ошибка".mysql_error($link));

	if (isset($_POST['button']))
	{
		$qurey = "SELECT * FROM info";
		$result = mysqli_query($link, $query)
			or die("Ошибка".mysql_error($link));
		$login = $_POST['login'];
		$patternlog = '/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/';
		$patternpassw = '/^\S*(?=\S{5,25})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/';
		$password = $_POST['password'];
		if ($login == '' or $password == ''){echo "Заполните все поля!"; return 1;};
		if (!(preg_match($patternlog, $login))) {echo "Проверьте логин!"; return 1;};
		if (!(preg_match($patternpassw, $password))) {echo "Проверьте пароль! Должен содержать хотя бы 1 маленькую, 1 большую буквы и 1 цифру. Длина от 5 до 25 символов."; return 1;};
		$query = "INSERT INTO info VALUES ('$login', '$password')";
		mysqli_query($link, $query)
			or die("Ошибка, такой логин уже существует!");
	}
	mysqli_close($link);
	echo "Done";
?>