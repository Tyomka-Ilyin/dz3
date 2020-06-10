<html>
 <head>
  <meta charset="utf-8">
  <title>Дз3</title>
 </head>
 <body>
	<form method="post" action="form_download.php" enctype="multipart/form-data">
		<input name="Button" type="submit" value="Загрузить" />
	</form>

	<form method="post" action="check_id.php" enctype="multipart/form-data">
		<input type="text" name="pole_id" placeholder="Введите id текста">
		<input name="Button" type="submit" value="Посмотреть детальный разбор" />
	</form>
 </body>
</html>

<?php
	
	echo "<table style='border: solid 1px black;'>";
	echo "<tr><th>Id</th><th>content</th><th>date</th><th>words_count</th></tr>";

class TableRows extends RecursiveIteratorIterator {
  function __construct($it) {
    parent::__construct($it, self::LEAVES_ONLY);
  }

  function current() {
    return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
  }

  function beginChildren() {
    echo "<tr>";
  }

  function endChildren() {
    echo "</tr>" . "\n";
  }
}

$servername = "localhost:3305"; // локалхост
$username = "root"; // имя пользователя
$password = "artyom56"; // пароль если существует
$dbname = "wordsbase"; 

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT * FROM uploaded_text");
  $stmt->execute();

  // set the resulting array to associative
  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
    echo $v;
  }
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";

?>