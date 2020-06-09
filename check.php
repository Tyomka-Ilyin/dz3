<?php

function func_text($post_text){

	$text=$post_text;

	$text_bzp=preg_replace("|[^\d\wа-яА-Я ]+|i","",$text);

	$mas_text=explode(" ", $text_bzp);

	$kol_sl=count($mas_text);

	$array_count=array_count_values($mas_text);

	$fp = fopen("text_Начало-$mas_text[0].csv", 'w');
	fwrite($fp, print_r($array_count, TRUE)); 
	fclose($fp);

	file_put_contents("text_Начало-$mas_text[0].csv",  iconv('utf-8', 'windows-1251', "Колличество слов в тексте = ".$kol_sl) , FILE_APPEND); 

	echo "Результат текстового поля в файле text_Начало-$mas_text[0].csv<br/>";
}

function func_file($f_file){
	$text_file = file_get_contents($f_file);

	$text_cod = mb_convert_encoding($text_file, 'utf-8', 'cp1251');

	$text_bzp=preg_replace("|[^\d\wа-яА-Я ]+|i","",$text_cod);

	$mas_text=explode(" ", $text_bzp);

	$kol_sl=count($mas_text);

	$array_count=array_count_values($mas_text);

	$fp = fopen("file_Начало-$mas_text[0].csv", 'w'); 
	fwrite($fp, print_r($array_count, TRUE)); 
	fclose($fp);

	file_put_contents("file_Начало-$mas_text[0].csv",  iconv('utf-8', 'windows-1251', "Колличество слов в тексте = ".$kol_sl) , FILE_APPEND);

	echo "Результат файлового поля в файле file_Начало-$mas_text[0].csv";
}

if($_POST['text']!="" and (isset($_FILES) && $_FILES['file']['error'] == 0))
{
	func_text($_POST['text']);

	func_file($_FILES['file']['name']);
}
elseif ($_POST['text']!="" and !empty($_FILES['file']))
{
	func_text($_POST['text']);
}
elseif ($_POST['text']=="" and (isset($_FILES) && $_FILES['file']['error'] == 0))
{
	func_file($_FILES['file']['name']);
}

?>