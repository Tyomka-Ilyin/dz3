<html>
 <head>
  <meta charset="utf-8">
  <title>Дз2</title>
 </head>
 <body>
	<form method="post" action="check.php" enctype="multipart/form-data">
		<b>Выберите файл</b><br>
		<input type="file" name="file" multiple><br>
		<b>Введите текст</b><br>
		<textarea name="text" cols="40" rows="3"></textarea><br>
		<input name="Button" type="submit" value="Выполнить" />
	</form>
 </body>
</html>