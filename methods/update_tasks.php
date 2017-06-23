<?php

$link = mysql_connect('localhost','root','');
$db = mysql_select_db('simple_tasks');

$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$dateUpdated = time();

$param = "'$id', '$name', '$description', $dateCreated, $dateUpdated";

$query = mysql_query("update tasks set name = '" . $name . "', description = '" . $description . "', dateUpdated = '" . $dateUpdated . "' where id = '" . $id . "'");

header('Content-type: application/json');
echo json_encode(true);

?>