<?php
	// include_once "encrypt.php";
	/*$file = fopen("connect.php", "r") or exit("Unable to open file!");

	//Output a line of the file until the end is reached
	while(!feof($file))
	{
		$string = fgets($file);
		$string = trim($string);
				
		echo(decode64($string));
	}*/
	//echo(decode64('5GndNzz1g25Y'));
	//echo encode64("$link = mysql_connect('localhost','root','');$db = mysql_select_db('db_tng');");
	$link = mysql_connect('localhost','root','');$db = mysql_select_db('simple_tasks');
		
?>