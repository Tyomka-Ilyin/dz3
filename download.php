<?php

if($_POST['text']!=""){

	$text=$_POST['text'];
	$text_bzp=mb_ereg_replace("|[^\d\wа-яА-Я ]+|i","",$text);
	$text_bzp=mb_convert_encoding($text_bzp, "UTF8");
	$mas_text=explode(" ", $text_bzp);
	$kol_sl=count($mas_text);
	$array_count=array_count_values($mas_text);

	$servername = "localhost:3305"; // локалхост
	$username = "root"; // имя пользователя
	$password = "artyom56"; // пароль если существует
	$dbname = "wordsbase"; // база данных
	

// Создание соединения и исключения
	try {
   $conn = new PDO("mysql:dbname=$dbname;host=$servername;charset=UTF8", $username, $password);
   // Установить режим ошибки PDO в исключение
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   // Установка данных в таблицу
   $sql = "INSERT INTO uploaded_text(content, `date`, words_count)
   VALUES('$text','2020.06.10','$kol_sl')";

   // Используйте exec (), поскольку результаты не возвращаются
   $conn->exec($sql);
   echo "Успешно создана новая запись<br>"."Текст:<br>"."$text<br>"."Колличество слов = $kol_sl";

   $sth = $conn->prepare("SELECT id FROM uploaded_text ORDER BY id DESC LIMIT 1");
   $sth->execute();
   $lastId = $sth->fetch(PDO::FETCH_COLUMN);

   $povt_sl=[];
   foreach ($mas_text as $value) {
   		if(!in_array($value, $povt_sl)){
   			$sqlInsert ="INSERT INTO word(text_id, word, count)
   			VALUES('$lastId','$value','$array_count[$value]')";
   			$conn->exec($sqlInsert);
   			array_push($povt_sl, $value);
   		}
   }

   }
	catch(PDOException $e)
   {
    echo $sqlInsert . "<br>" . $e->getMessage();
   }
}

?>

<html>
 <head>
  <meta charset="utf-8">
  <title>Дз3</title>
 </head>
 <body>
	<form method="post" action="form.php" enctype="multipart/form-data">
		<input name="Button" type="submit" value="Вернуться на главную" />
	</form>
 </body>
</html>