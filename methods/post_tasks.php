<?php

$link = mysql_connect('localhost','root','');
$db = mysql_select_db('simple_tasks');

$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$dateCreated = time();
$dateUpdated = time();

$param = "'$id', '$name', '$description', $dateCreated, $dateUpdated";

$query = mysql_query("insert into tasks values(".$param.")");

header('Content-type: application/json');
echo json_encode(true);

?>