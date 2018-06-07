<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>laba4</title>
</head>
<body style="background-color: #C0C0C0">
<form name="input" action="" method="get">
    <p align="left" style="color: #696969; font-size:30px; margin: 0px;"> Введите текст</p>
    <textarea style="height: 300px; width: 500px; background-color: white;" type="text" name="text">Много 8(029)8576028 лет 8(033)-600-03-16 назад Редьярд 8(033)771-91-83 Киплинг выступал 9(029)8576028 с речью в +575298576028 Университете Макгилла в Монреале. И там он сказал одну очень важную вещь, достойную запоминания. +375-29-857-60-28 Предостерегая студентов от чрезмерной зацикленности на деньгах, власти или славе, он сказал так: "Однажды вы повстречаете +375298576028 человека, +375(33)5676329 для которого все это не имеет значения. +375(44)857-60-28 И тогда вы поймете, как вы бедны. 8(017)-300-03-16 " </textarea>
	<p></p>
	<input style="height: 50px; width: 505px; background-color: #696969; color: white;" type="submit" name="done" value="Выполнить">
    <p></p>
</form>
</body>
</html>

<?php
define ("DEFAULT_FONT", "");
define ("NUMBER_FONT", "style='color: green;'");
define ("UNDERLINE_FONT", "style='text-decoration: underline; color: green;'");
define ("FONT", "style='color: red;'");

define ("NUMBER_PAT", "((^((\+375)((\((29|33|44)\))|((29|33|44)))((\d{3}\-\d{2}\-\d{2})|(\d{3}\d{2}\d{2}))|^(8(\((029|033|044)\))((\d{3}\-\d{2}\-\d{2})|(\d{3}\d{2}\d{2}))))))");
define ("UNDERLINE_PAT", "^(\+375)((\((29|33|44)\))|((29|33|44)))(\d{3}\-\d{2}\-\d{2})$");
define ("PAT", "^(8(\((017|033|044)\))((\-\d{3}\-\d{2}\-\d{2})))$");
//Check if word accords to pattern.
function answerTheDescription($word, $pattern)
{
    $local_pat = "/".$pattern."/i";
    return (preg_match($local_pat, $word) > 0);
}

//Output function
function printWord($word, $font)
{
    echo "<font "."$font".">"."$word[0]"."</font>";
    echo " ";
}

$str = ($_GET['text']);
$words = explode(" ", $str);

echo "<p>Результат: ";

foreach ($words as $word)
{
    $font = DEFAULT_FONT;
    $splited_word = array("0" => $word); //all the words, include numbers

    //Is word is number
    if (answerTheDescription($word, NUMBER_PAT)) {
        $font = NUMBER_FONT;
    }
	
	if (answerTheDescription($word, UNDERLINE_PAT)) {
        $font = UNDERLINE_FONT;
    }
	
	if (answerTheDescription($word, PAT)) {
		$font = FONT;
	}

    //Output
    printWord($splited_word, $font);
}

echo "</p>";