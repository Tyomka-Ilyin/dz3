<?php

	if($_POST['pole_id']!="")
	{
		$id=$_POST['pole_id'];

		echo "<table style='border: solid 1px black;'>";
		echo "<tr><th>word</th><th>count</th></tr>";

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
 		$stmt = $conn->prepare("SELECT word,count FROM word WHERE text_id = $id");
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
